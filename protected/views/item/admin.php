<?php
$this->breadcrumbs=array(
	'Управление',
);

$this->menu=array(
array('label'=>'Создать новое наименование','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('item-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление работами\материалами</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'item-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'emptyText' => 'Наименований не найдено',
'summaryText' => 'Наименования {start}-{end} из {count}.',
'columns'=>array(
		'id',
		'name',
		'category_id' => array(
            'name' => 'category_id',
            'value' => '$data->category->name',
            'filter' => ItemsCategory::getArrayList(), // фильтр в виде выпадающего списка
        ),
		'amount',
    /*'price_z',
    'price_s',

    'price_m',
    'dependence',
    'barcode',
    'unit',
    'minimal_amount',
    */
    array(
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}  {delete}',
    ),
),
)); ?>
