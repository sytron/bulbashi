<?php

class OrderController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'autocompleteitems'),
                'users' => array('@','mf'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('admin', 'mf'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getArrayFromJson( $jsonStr ) {
        $items = json_decode($jsonStr);
        $res = array();
        foreach( $items as $item ) {
            $newitem = array(
                'id' => $item->id,
                'count' => $item->count,
                'price' => $item->price,
                'name' => $item->name,
            );
            $res[] = $newitem;
        }
        return $res;
    }

    private function getSummaryCost( $items ) {
        $sum = 0;
        foreach( $items as $item ) {
            $sum = $sum + $item['price']*$item['count'];
        }

        return round($sum,2);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Order;

        if( isset($_GET['client_id'] ) ) {
            $model->client_id = $_GET['client_id'];
        }
        if( isset($_GET['discount'] ) ) {
            $model->withDiscount = 1;
        }
        if( isset($_GET['test'] ) ) {
            $model->test = 1;
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'])) {
            //$model->attributes = $_POST['Order'];
            $model->client->mileage = $_POST['mileage_now'];
            $model->client->save();
            $model->advice = $_POST['Order']['advice']."<br>Рекомендуемый пробег для следующего обслуживания: ".$_POST['mileage_now']."км";
            $items = $this->getArrayFromJson($_POST['Order']['items']);
            $model->cost = $this->getSummaryCost($items);
            $model->items = serialize($items);
            $model->team_id = $_POST['Order']['team_id'];
            $model->time_created = time();
            //print_r($this->getArrayFromJson($_POST['Order']['items']));die();
            if ($model->save(false)) {
                if( $model->isClosed && !$model->test ) {
                    foreach( $items as $item ) {
                        $i = Item::model()->findByPk($item['id']);
                        $i->amount = $i->amount - $item['count'];
                        $i->save();
                    }
                    Cashbox::registerChange("Заказ-наряд №".$model->id, $model->cost, "Order");
                }
                if( isset($_GET['new_client']) ) {
                    $this->redirect(array('client/update2', 'id' => $model->client_id));
                } else {
                    $this->redirect(array('admin'));
                }


            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);


// Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);


        if (isset($_POST['Order'])) {
            //$model->attributes = $_POST['Order'];
            //$model->client->mileage = $_POST['mileage_now'];
            $model->client->save();
            $model->advice = $_POST['Order']['advice']."<br>Рекомендуемый пробег для следующего обслуживания: ".$_POST['mileage_next']."км";
            $model->advice = $_POST['Order']['advice'];
            $items = $this->getArrayFromJson($_POST['Order']['items']);
            $model->cost = $this->getSummaryCost($items);
            $model->items = serialize($items);
            $model->team_id = $_POST['Order']['team_id'];

            $model->status = $_POST['Order']['status'];
            //print_r($this->getArrayFromJson($_POST['Order']['items']));die();
            if ($model->save(false)) {
                if( $model->isClosed && !$model->test ) {
                    foreach( $items as $item ) {
                        $i = Item::model()->findByPk($item['id']);
                        $i->amount = $i->amount - (int)$item['count'];
                        $i->save();
                    }
                    Cashbox::registerChange("Заказ-наряд №".$model->id, $model->cost, "Order");
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
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
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->redirect(array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Order('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

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
        $model = Order::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAutocompleteItems() {
        if (isset($_GET['term'])) {
            $c3 = new CDbCriteria();
            //$c3->compare('category_id', $_GET['category']);
            $c3->addSearchCondition('name', $_GET['term']);
            $items = Item::model()->findAll($c3);

            $result = array();
            foreach($items as $item) {
                //if( $item->isConnectedToModel($_GET['modelId'] ) ) {
                   if( $item['amount'] < 1 ) {
                        $lable = $item['name'].' (нет в наличии)';    
                    } else {
                        $lable = $item['name'];    
                    }
                    
                    $result[] = array_merge(array(
                        'id'=>$item['id'],
                        'label'=>$lable,
                        'value'=>$item['id'],
                        'price'=>$item['price_s']
                    ), $item->attributes);
                //}
            }
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }
}
