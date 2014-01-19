<?php

class BookingController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin', 'mf'),
            ),
            array('deny', // deny all users
                'actions' => array('admin', 'delete'),
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionIndex()
    {
        $this->layout = '//layouts/booking';
        $model = new Booking;

        if (isset($_POST['Booking'])) {
            $model->attributes = $_POST['Booking'];
            if ($model->save()) {
                $to  = "maslofilter@mail.ru" ;

                $subject = "Новая заявка! Онлайн-бронирование";

                $message = "Клиент: ".$model->name." <br>Дата: ".$model->day." <br>Время: ".$model->time." <br>Тип работ: ".$model->getTypeName()." <br>Контактный телефон: ".$model->phone." <br>Комментарий: ".$model->comment." <br> ";

                $headers  = "Content-type: text/html; charset=UTF-8 \r\n";
                $headers .= "From: Система бронирования <maslofilter@mail.ru>\r\n";

                mail($to, $subject, $message, $headers);
                $this->redirect(array('index', 'success' => true));
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionGetTimes() {
        $post = $_GET;
        if( !isset($post['Booking']['day']) || !isset($post['Booking']['type']) )
            Yii::app()->end();

        $bookings = Booking::model()->findAllByAttributes(array('day'=>$post['Booking']['day'] ));

        $managers = array();
        $manager0 = Booking::getAllTimes(1);
        $manager1 = Booking::getAllTimes(1);

        foreach( $bookings as $keyb => &$booking ) {
            foreach( $manager0 as $key => &$time ) {
                if( $booking->checked == 0 ) {
                    if( $booking->time == $time ) {
                        if( $booking->type == 1 || $booking->type == 3 ) {
                            //print_r($managers[$keym]);
                            unset($manager0[$key]);
                            $booking->checked = 1;
                            if( strpos($time, '30') !== false && $post['Booking']['type'] == 2){
                                unset($manager0[$key-1]);
                            }
                            // "del time $time from manager 0" ;
                            break;
                        }
                        if( $booking->type == 2 ) {
                            unset($manager0[$key]);
                            unset($manager0[$key+1]);
                            //echo "del time $time + 30 from manager 0" ;
                            $booking->checked = 1;

                            break;
                        }
                    }
                }
            }
        }

        foreach( $bookings as $keyb => &$booking ) {
            foreach( $manager1 as $key => &$time ) {
                if( $booking->checked == 0 ) {
                    if( $booking->time == $time ) {
                        if( $booking->type == 1 ) {
                            unset($manager1[$key]);
                            $booking->checked = 1;
                            if( strpos($time, '30') !== false && $post['Booking']['type'] == 2){
                                unset($manager1[$key-1]);
                            }
                            break;
                        }
                        if( $booking->type == 2 ) {
                            unset($manager1[$key]);
                            unset($manager1[$key+1]);
                            $booking->checked = 1;
                            break;
                        }
                    }
                }
            }
        }



        $res = array_merge($manager0,$manager1);
        asort($res);
        $res = array_unique ($res);

        if( $post['Booking']['type'] == 2 ) {
            foreach($res as $k => $v ) {
                if( strpos($v, '30') !== false ){
                    unset($res[$k]);
                }
            }
        }

        foreach( $res as $t ) {
            echo CHtml::tag('option',
                array('value'=>$t),CHtml::encode($t),true);
        }

    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
// we only allow deletion via POST request
            $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Booking('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Booking']))
            $model->attributes = $_GET['Booking'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Booking::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'incoming-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
