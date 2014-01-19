<?php
$this->breadcrumbs=array(
	'Категории товара'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Создать новую категорию товаров','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('items-category-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление категориями</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'items-category-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'emptyText' => 'Категорий не найдено',
'summaryText' => 'Категории {start}-{end} из {count}.',
'columns'=>array(
		'id',
		'name',

    array(
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}  {delete}',
    ),
),
)); ?>
