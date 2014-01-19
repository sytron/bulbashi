<?php
$this->breadcrumbs=array(
	'Infos'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Создать новую запись Info','url'=>array('create')),
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

<h1>Управление Infos</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'info-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'model_id',
		'info',
		'name',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
