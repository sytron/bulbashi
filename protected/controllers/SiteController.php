<?php

class SiteController extends Controller
{
    public $layout = '//layouts/column2';

    /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        Yii::app()->request->redirect(Yii::app()->createUrl('client/old'));
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function actionC()
    {
        $items = Item::model()->findAll();
        foreach( $items as $item ) {
            echo "До ".$item->name;
            $a = strpos($item->name, '</td>' );
            if( $a !== false ) {
                $item->name = mb_strcut( $item->name, 0, $a);
                $item->save();
            }
            echo " После ".$item->name. "\n";

        }
    }

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionImportItems() {
        $dir = Yii::app()->basePath.'/../ImportItems/';
        $dh = opendir($dir);
        while($filename = readdir($dh))
        {
            if( $filename == '.' || $filename == '..')
                continue;
            // любые операции с вашим файлом, например
            //$fs = filesize($filename);
            //$ft = filetype($filename);

            $categoryName = str_replace('.HTM','',$filename);
            $categoryName = mb_convert_encoding($categoryName, 'UTF-8', 'Windows-1251');

            $cat = ItemsCategory::model()->findByAttributes(array('name'=>$categoryName));
            if( $cat->id ) {
                $categoryId = $cat->id;
                echo "Категория ".$categoryName." есть<br>";
            } else {
                $cat = new ItemsCategory();
                $cat->name = $categoryName;
                $cat->parent = 0;
                $cat->save();
                $categoryId = $cat->id;
                echo "Категория ".$categoryName." создана<br>";
            }


            $file = file_get_contents($dir.$filename);
            //$file = mb_convert_encoding($file, 'UTF-8');

            $match = array();
            preg_match_all("#<tr bgcolor=\"\#f0f0f0\"><td>([\s\S]*?)<\/td><td align=\"right\">[\s]*([\d]*)<\/td><td align=\"right\">[\s]*([\w,]*)#is", $file, $match);

            for($i = 0 ; $i< count($match[1]); $i++) {
                $item = Item::model()->findByAttributes(array('name' => mb_convert_encoding($match[1][$i], 'UTF-8', 'Windows-1251')));
                if( !empty($item->id) ) {
                    continue;
                }
                $item = new Item();
                $item->name = mb_convert_encoding($match[1][$i], 'UTF-8', 'Windows-1251');
                $item->price_m = $match[2][$i];
                $item->price_s = $match[2][$i];
                $item->price_z = $match[2][$i];
                $item->amount = $match[3][$i];
                $item->minimal_amount = 0;
                $item->category_id = $categoryId;
                if( $item->save() ) {
                    echo "Item ".$item->name." сохранен<br>";
                } else {
                    echo "Item ".$item->name." НЕ СОХРАНЕН!!!<br>";
                }
            }
            //print_r($match);
        }
    }

    public function actionCreateDefaultLinks()
    {
        $itemId = 17757;

        $criteria = new CDbCriteria;
        $criteria->condition = 'item_id = '.$itemId;
        $criteria->order = 'model_id DESC';
        $criteria->limit = '1';
        $maxModel = ItemsModels::model()->findBySql('SELECT * FROM items_models WHERE item_id = '.$itemId.' ORDER BY model_id DESC LIMIT 1');
        $models = ModelCar::model()->findAllBySql('SELECT * FROM models WHERE id > '.$maxModel->model_id.' ORDER BY id ASC LIMIT 5000');

        $item = Item::model()->findByPk($itemId);

        $links = 0;

        foreach( $models as $m ) {

            //if( $m->id < 1448 )
            //    continue;
            //foreach( $items as $i ) {
                //if( $i->id < 17757 )
                //    continue;
                $link = new ItemsModels();
                $link->model_id = $m->id;
                $link->modelrow_id = $m->modelrow->id;
                $link->vendor_id = $m->modelrow->vendor->id;
                $link->item_id = $item->id;
                if( $link->save() ) {
                    $links++;
                    //echo $link->model_id."<br>";
                } else {
                    print_r($link->getErrors()); die();
                }
            //}
        }
        echo $links;
    }

    public function actionParseFilters() {
        $filters = Filter::model()->findAll();

        $not = 0;
        $yes = 0;
        foreach( $filters as $filter ) {
            if( count(Yii::app()->db->createCommand("SELECT * FROM items where name like '".$filter->name."'" )->queryAll()) > 0 )
                continue;
            if(  $filter->type != 1 &&  $filter->type!= 2 &&  $filter->type!=4 ) {
                $not++;
            }

            $item = new Item();
            $item->amount = $filter->amount;
            $item->price_m = $filter->price;
            $item->price_s = $filter->price;
            $item->price_z = $filter->price;
            $item->name = $filter->name;
            $item->minimal_amount = 0;
            switch( $filter->type ) {
                case 1 : $item->category_id = 19; break; //19 маслянный
                case 2 : $item->category_id = 20; break; //20 воздушный
                case 4 : $item->category_id = 24; break; //24 салонный
            }
            if( !$item->save()) {
                //var_dump(  $item->getErrors()  );
            } else {
                $yes++;
            }

            $links = Yii::app()->db->createCommand("SELECT DISTINCT * FROM models_filters where filter_id =".$filter['id'] )->queryAll();
            foreach( $links as $link ) {
                $itemmodel = new ItemsModels();
                $itemmodel->model_id = $link['model_id'];
                $itemmodel->item_id = $item->id;
                $itemmodel->save();
                //if( !$itemmodel->save() )
                    //var_dump(  $item->getErrors() );
            }
        }
        echo "+: $yes <br> -: $not";
    }

    public function actionParseOils() {
        $filters = Oil::model()->findAll();

        $not = 0;
        $yes = 0;
        foreach( $filters as $filter ) {
            if( count(Yii::app()->db->createCommand("SELECT * FROM items where name like '".$filter->name."'" )->queryAll()) > 0 )
                continue;

            $item = new Item();
            $item->amount = 100000;
            $item->price_m = $filter->price;
            $item->price_s = $filter->price;
            $item->price_z = $filter->price;
            $item->name = $filter->name;
            $item->minimal_amount = 0;
            $item->category_id = 19;
            if( !$item->save()) {
                //var_dump(  $item->getErrors()  );
            } else {
                $yes++;
            }

            $links = Yii::app()->db->createCommand("SELECT DISTINCT * FROM models_oils where oil_id =".$filter->id )->queryAll();
            foreach( $links as $link ) {
                $itemmodel = new ItemsModels();
                $itemmodel->model_id = $link['model_id'];
                $itemmodel->item_id = $item->id;
                $itemmodel->save();
                //if( !$itemmodel->save() )
                //var_dump(  $item->getErrors() );
            }
        }
        echo "+: $yes <br> -: $not";
    }
}