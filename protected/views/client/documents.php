<? $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'filter'=>$model,
    'type'=>'striped bordered',
    'dataProvider' =>  $model->search(),
    'template' => "{items}",
    'emptyText' => 'Документов не найдено',
    'summaryText' => 'Документы {start}-{end} из {count}.',
    'columns' => array(
        'id',
        array(
            'name' => 'time_created',
            'type' => 'datetime'
        ),
        'statusName' => array(
            'name' => 'status',
            'value' => '$data->statusName',
            'filter' => Order::getStatusList(), // фильтр в виде выпадающего списка
        ),
        'cost',

        array(
            'header' => '',
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update}  {print}',
            'buttons'=>array
            (
                'update' => array(
                    'label'=>'Редактировать',
                    'url'=>'Yii::app()->createUrl("order/update", array("id"=>$data->id))',
                    'visible' => '!$data->isClosed'
                ),
                'print' => array
                (
                    'label'=>'Распечатать',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/print.png',
                    'url'=>'Yii::app()->createUrl("print/order", array("orderid"=>$data->id))',
                    'options' => array('target' => '_blank')
                ),
            )
        ),
    ),
)); ?>

<? $this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Добавить новый',
    'type' => 'primary',
    'size' => 'large',
    'url' => Yii::app()->createUrl( "order/create", array("client_id" => $model->client_id) ),
)); ?>

<? /*$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Добавить новый (со скидкой)',
    'type' => 'primary',
    'size' => 'large',
    'url' => Yii::app()->createUrl( "order/create", array("client_id" => $model->client_id, 'discount' => true) ),
)); */ ?>

<? /*$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Добавить пробный',
    'type' => 'secondary',
    'size' => 'large',
    'url' => Yii::app()->createUrl( "order/create", array("client_id" => $model->client_id, 'test' => true) ),
)); */?>
