<?php

class InfoController extends Controller
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
                'actions' => array('create', 'update'),
                'users' => array('@','mf'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'ImageUpload', 'FileUpload'),
                'users' => array('admin','mf'),
            ),
            array('deny', // deny all users
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
        $model = new Info;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Info'])) {
            $model->attributes = $_POST['Info'];
            if ($model->save())
                $this->redirect(array('client/old'));
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

        if (isset($_POST['Info'])) {
            $model->attributes = $_POST['Info'];
            if ($model->save())
                $this->redirect(array('client/old'));
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
        $model = new Info('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Info']))
            $model->attributes = $_GET['Info'];

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
        $model = Info::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'info-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionImageUpload() {
        $directory = realpath(Yii::app()->basePath.'/../images/upload/').'/';
        $file = md5(date('YmdHis')).'.'.pathinfo(@$_FILES['file']['name'], PATHINFO_EXTENSION);

        if (move_uploaded_file(@$_FILES['file']['tmp_name'], $directory.$file)) {
            $array = array(
                'filelink' => '/images/upload/'.$file
            );
        }

        echo CJSON::encode($array);
        exit ;
    }

    public function actionFileUpload()
    {
        $directory = realpath(Yii::app()->basePath.'/../data/upload/').'/';
        $fileDir = md5(date('YmdHis'));
        @mkdir(realpath(Yii::app()->basePath.'/../data/upload/').'/'.$fileDir);
        $fname = $_FILES['file']['name'];
        $_FILES['file']['name'] = iconv('utf-8', 'windows-1251', $_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $directory.$fileDir.'/'.$_FILES['file']['name']))
        {
            $array = array(
                'filelink' => '/data/upload/'.$fileDir.'/'.$fname,
                'filename' => $fname
            );
        }

        echo CJSON::encode($array);
        exit ;
    }
}
