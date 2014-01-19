<?php
$this->breadcrumbs=array(
	'Контрагенты'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Создать нового контрагента','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('info-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление контрагентами</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'info-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
        'address',
array
    (
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}  {delete}',
        
    ),
),
)); ?>
