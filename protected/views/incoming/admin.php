<?php
$this->breadcrumbs=array(
	'Приходные'=>array('admin'),
	'Управление',
);

$this->menu=array(
array('label'=>'Создать новую приходную','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('incoming-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Поступления материалов</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'incoming-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'emptyText' => 'Приходов не найдено',
'summaryText' => 'Приходы {start}-{end} из {count}.',
'columns'=>array(
		'id',
		'time_register:datetime',
        'date',
        'number',
        'osnovanie',
        'contragent' => array(
            'name' => 'contragent_id',
            'value' => '$data->contragent',
            'filter' => Contragent::getArrayList(), // фильтр в виде выпадающего списка
        ),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
    'template'=>'{update}  {delete}'
),
),
)); ?>
