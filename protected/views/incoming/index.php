<?php
$this->breadcrumbs=array(
	'Incomings',
);

$this->menu=array(
array('label'=>'Create Incoming','url'=>array('create')),
array('label'=>'Manage Incoming','url'=>array('admin')),
);
?>

<h1>Incomings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
