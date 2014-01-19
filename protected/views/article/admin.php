<?php
$this->breadcrumbs=array(
	'Статьи расходов'=>array('index'),
	'Управление',
);

$this->menu=array(
array('label'=>'Создать новую статью','url'=>array('create')),
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

<h1>Управление статьями расходов</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'info-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'type',
		'name',
array
    (
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}  {delete}',
        
    ),
),
)); ?>
