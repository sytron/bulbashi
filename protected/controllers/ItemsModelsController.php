<?php

class ItemsModelsController extends Controller
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
                'actions' => array('create', 'index'),
                'users' => array('@'),
            ),
            array('allow', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new ItemsModels();

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

        if (isset($_POST['ItemsModels'])) {
            $model->attributes = $_POST['ItemsModels'];
            try {
                if ($model->save())
                    $this->redirect(array('index'));
            } catch( Exception $e ) {
                $this->redirect(array('index'));
            }

        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

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
        $model = new ItemsModels('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['ItemsModels']))
            $model->attributes = $_GET['ItemsModels'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = ItemsModels::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }


    public function actionLoadModelrows(  )
    {
        $vendor_id = $_REQUEST['ItemsModels']['vendor_id'];
        $modlerows = Modelrow::getArrayList( $vendor_id );
        foreach( $modlerows as $id => $name ) {
            echo CHtml::tag('option',
                array('value'=>$id),CHtml::encode($name),true);
        }

    }

    public function actionLoadModelCars(  )
    {
        $modelrow_id = $_REQUEST['ItemsModels']['modelrow_id'];
        $models = ModelCar::getArrayList( $modelrow_id );
        foreach( $models as $id => $name ) {
            echo CHtml::tag('option',
                array('value'=>$id),CHtml::encode($name),true);
        }
    }


}
