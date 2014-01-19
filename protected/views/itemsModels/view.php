<?php
$this->breadcrumbs=array(
	'Items Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List ItemsCategory','url'=>array('index')),
array('label'=>'Create ItemsCategory','url'=>array('create')),
array('label'=>'Update ItemsCategory','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ItemsCategory','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ItemsCategory','url'=>array('admin')),
);
?>

<h1>View ItemsCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'parent',
),
)); ?>
