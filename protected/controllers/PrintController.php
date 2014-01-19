<?php

class PrintController extends Controller
{


	public function actionOrder()
	{
        if( empty($_GET['orderid'] ) )
            die();

        $order = Order::model()->findByPk( $_GET['orderid'] );

        if( !$order->id )
            die();

        if( $order->test ) {
            switch( $_GET['type'] ) {
                default:
                    $this->renderPartial('order/temp', array('order' => $order) );
                    break;
            }

        } elseif ( !$order->isClosed && !isset($_GET['close'])) {
            $this->layout = '//layouts/column2';
            $this->render('order/notclosed', array('model' => $order) );
        } elseif ( !$order->isClosed && isset($_GET['close']) ) {
            $order->close();

            //$order->items = unserialize($order->items);

            switch( $_GET['type'] ) {
                default:
                    $this->renderPartial('order/temp', array('order' => $order) );
                    break;
            }
        } else {
            //$order->items = unserialize($order->items);

            switch( $_GET['type'] ) {
                default:
                    $this->renderPartial('order/temp', array('order' => $order) );
                    break;
            }
        }


	}

    public function actionRaschet()
    {
        if( empty($_POST['items'] ) )
            die();

        $items = CJSON::decode($_POST['items']);
        $itog = 0;
        foreach( $items as $item ) {
            $itog += $item['count'] * $item['price'];
        }

        $this->renderPartial('order/raschet', array('items' => $items, 'itog' => $itog) );


    }

    public function actionSticker( ) {
        //$_GET['oil']
        //$_GET['probeg']
        $this->renderPartial('sticker/oil', array('oil'=>$_GET['oil'], 'probeg'=>$_GET['probeg']) );
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
}