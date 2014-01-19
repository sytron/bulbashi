<?php

class CashboxController extends Controller
{

    public $layout = '//layouts/column2';


	public function actionIndex()
	{

		$this->redirect(array('cashbox/admin'));
	}

    public function actionAdmin()
    {
        $model = new Cashbox('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Cashbox']))
            $model->attributes = $_GET['Cashbox'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionGraphic() {
    	$type = $_GET['type'];

    	$this->{$type}();
    }



    public function balance() {
    	Yii::import("application.extensions.OpenFlashChart2Widget.*");
        OpenFlashChart2Loader::load();

 		$res = array();
        $dates = array();

        for ($i = 30; $i >= 0 ; $i--) {
        	$dates[] = date("d-m-Y", time()-$i*86400 );
        }

        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('time_created', 0, strtotime($dates[0]));
        $temp = Cashbox::model()->findAll($criteria);
        $init = 0;
        foreach ($temp as $key => $value) {
            $init += $value->change;
        }

        foreach ($dates as $key => $value) {
            $criteria = new CDbCriteria;
            $criteria->addBetweenCondition('time_created', strtotime($value), strtotime($value)+86400);
            $temp = Cashbox::model()->findAll($criteria);
            foreach ($temp as $cb) {
                $init += $cb->change;
            }
            $res[] = $init;
        }

//        $res = array_reverse($res);
//        $dates = array_reverse($dates);

        $title = new title( 'Изменение баланса за последний месяц' );

        $d = new anchor();
        $d->size(6)
            ->halo_size(1)
            ->colour('#3D5C56')
            ->rotation(90)
            ->sides(3);

        $line_1 = new line();
        $line_1->set_default_dot_style($d);
        $line_1->set_values( $res );
        $line_1->set_width( 1 );
        $line_1->set_colour( '#3D5C56' );

        $y = new y_axis();
        $y->set_range(  min($res) - 5000,  max($res) + 5000, 5000 );

        $x_labels = new x_axis_labels();
        $x_labels->set_vertical();
        $x_labels->set_labels( $dates );

        $x = new x_axis();
        // Add the X Axis Labels to the X Axis
        $x->set_labels( $x_labels );

        $chart = new open_flash_chart();
        $chart->set_title( $title );
        $chart->add_element( $line_1 );
        $chart->set_y_axis( $y );
        $chart->set_x_axis( $x );

        $this->render('graphic', array('model' => new GraphicForm,'chart' => $chart));
    }


    public function daily( ) {
        Yii::import("application.extensions.OpenFlashChart2Widget.*");
        OpenFlashChart2Loader::load();

        $res = array();
        $dates = array();

        for ($i = 30; $i >= 0 ; $i--) {
            $dates[] = date("d-m-Y", time()-$i*86400 );
        }

        foreach ($dates as $key => $value) {
            $criteria = new CDbCriteria;
            $criteria->addBetweenCondition('time_created', strtotime($value), strtotime($value)+86400);
            $temp = Cashbox::model()->findAll($criteria);
            $summ = 0;
            foreach ($temp as $cb) {
                $summ += $cb->change;
            }
            $res[] = $summ;
        }

        //$res = array_reverse($res);
        //$dates = array_reverse($dates);

        $title = new title( 'Суточный доход за последний месяц' );

        $d = new anchor();
        $d->size(6)
            ->halo_size(1)
            ->colour('#3D5C56')
            ->rotation(90)
            ->sides(3);

        $line_1 = new bar();
        //$line_1->set_default_dot_style($d);
        $line_1->set_values( $res );
        $line_1->set_on_show( true );
        //$line_1->set_width( 1 );
        //$line_1->set_colour( '#3D5C56' );

        $y = new y_axis();
        $y->set_range( 0, max($res) + 25, 100 );

        $x_labels = new x_axis_labels();
        $x_labels->set_vertical();
        $x_labels->set_steps(1);
        $x_labels->visible_steps(1);
        $x_labels->set_labels( $dates );

        $x = new x_axis();
        // Add the X Axis Labels to the X Axis
        $x->set_labels( $x_labels );



        $chart = new open_flash_chart();
        $chart->set_title( $title );
        $chart->add_element( $line_1 );
        $chart->set_y_axis( $y );
        $chart->set_x_axis( $x );

        $this->render('graphic', array('chart' => $chart));
    }


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

    public function actionCreate() {
        {
            $model = new Cashbox();

// Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            $model->id = $model->getNextId();
            $model->tempDate = date("d.m.Y");

            if (isset($_POST['Cashbox'])) {
                $model->attributes = $_POST['Cashbox'];
                //$model->time_created = time();
                $model->object = 'manual';

                $art = Article::model()->findByPk($model->article_id);
                $model->type = $art->type;

                if ($model->save())
                    $this->redirect(array('admin'));
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }

    }

    public function actionUpdate( $id ) {
        {
            $model = $this->loadModel($id);

            if( !$model->isManual ) {
                throw new CHttpException(403, 'Автоматически созданные проводки не подлежат редактированию!');
            }

// Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            $model->tempDate = date("d.m.Y", $model->time_created);

            if (isset($_POST['Cashbox'])) {
                $model->attributes = $_POST['Cashbox'];
                //$model->time_created = time();
                $model->object = 'manual';

                $art = Article::model()->findByPk($model->article_id);
                $model->type = $art->type;

                if ($model->save())
                    $this->redirect(array('admin'));
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }

    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'incoming-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
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
    public function loadModel($id)
    {
        $model = Cashbox::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}