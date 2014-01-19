<?php
$this->breadcrumbs=array(
	'Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Info','url'=>array('index')),
array('label'=>'Create Info','url'=>array('create')),
array('label'=>'Update Info','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Info','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Info','url'=>array('admin')),
);
?>

<h1>View Info #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'model_id',
		'info',
		'name',
),
)); ?>
