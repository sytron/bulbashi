<?php

class ClientController extends Controller
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
                'actions' => array('old', 'new', 'Autocomplete', 'RenderDocuments' ),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@','mf'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'LoadModelrows', 'LoadModelCars', 'update2'),
                'users' => array('admin','mf'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAutocomplete() {
        if (isset($_GET['term'])) {
            $c3 = new CDbCriteria();
            $c3->addSearchCondition($_GET['field'], htmlspecialchars_decode($_GET['term']));
            $clients = Client::model()->findAll($c3);

            $result = array();
            foreach($clients as $client) {
                //$vendor = Vendor::model()->findByPk($client['vendor_id']);
                //$modelrow = Modelrow::model()->findByPk($client['modelrow_id']);
                //$modelcar = ModelCar::model()->findByPk($client['model_id']);
                $lable = $client[$_GET['field']].' - '.$client->CarName;
                $result[] = array_merge(array(
                    'id'=>$client['id'],
                    'label'=>$lable,
                    'value'=>$client[$_GET['field']],
                    'car_label'=>$client->CarName,
                    'barcode_img'=>$client->BarcodeImageUrl,
                    'lastvisit'=>date("d-m-Y",$client['time_lastvisit'])
                ), $client->attributes);
            }
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    public function actionRenderDocuments( $id ) {
        $order = new Order();
        $order->client_id = $id;
        $this->renderPartial('documents', array('model' => $order));
    }

    public function actionOld()
    {

        $this->layout = '//layouts/column1';
        $model = new Client;

        if( isset($_GET['id'] ) ) {
            $model = Client::model()->findByPk($_GET['id']);
        }

        Yii::app()->clientScript->registerCoreScript('cookie');
        $this->render('old', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Client;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);
        $model->name = "Частное лицо";
        if (isset($_POST['Client'])) {
            $model->attributes = $_POST['Client'];
            $model->barcode = time();
            $model->time_register = time();
            if ($model->save())
                $this->redirect(array('order/create', 'client_id' => $model->id, 'new_client' => 1));
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
// $this->performAjaxValidation($model);

        if (isset($_POST['Client'])) {
            $model->attributes = $_POST['Client'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdate2($id)
    {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Client'])) {
            $model->attributes = $_POST['Client'];
            if ($model->save())
                $this->redirect(array('order/admin'));
        }

        $this->render('update2', array(
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
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Client('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Client']))
            $model->attributes = $_GET['Client'];

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
        $model = Client::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'client-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLoadModelrows(  )
    {
        $vendor_id = $_REQUEST['Client']['vendor_id'];
        $modlerows = Modelrow::getArrayList( $vendor_id );
        foreach( $modlerows as $id => $name ) {
            echo CHtml::tag('option',
                array('value'=>$id),CHtml::encode($name),true);
        }

    }

    public function actionLoadModelCars(  )
    {
        $modelrow_id = $_REQUEST['Client']['modelrow_id'];
        $models = ModelCar::getArrayList( $modelrow_id );
        foreach( $models as $id => $name ) {
            echo CHtml::tag('option',
                array('value'=>$id),CHtml::encode($name),true);
        }
    }


}
