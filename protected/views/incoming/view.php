<?php
$this->breadcrumbs=array(
	'Incomings'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Incoming','url'=>array('index')),
array('label'=>'Create Incoming','url'=>array('create')),
array('label'=>'Update Incoming','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Incoming','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Incoming','url'=>array('admin')),
);
?>

<h1>View Incoming #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'time_register',
		'supplier',
		'items',
),
)); ?>
