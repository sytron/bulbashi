<?php
$this->breadcrumbs=array(
	'Клиенты'=>array('admin'),
	'Управление',
);

$this->menu=array(
array('label'=>'Создать новую запись','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('client-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление клиентами</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'client-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'emptyText' => 'Клиентов не найдено',
'summaryText' => 'Клиенты {start}-{end} из {count}.',
'columns'=>array(
		'id',
		'name',
		'gosnomer',
		'vin',
        'CarName',
        /*
		'vendor_id',
		'modelrow_id',

		'model_id',
		'barcode',
		'time_register',
		'time_lastvisit',
		'comment',
		'mileage',
		'howknow',
		'card',
		*/
    array(
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}  {delete}',
    ),
    ),
)); ?>
