<?php
$this->breadcrumbs=array(
	'Items Categories',
);

$this->menu=array(
array('label'=>'Create ItemsCategory','url'=>array('create')),
array('label'=>'Manage ItemsCategory','url'=>array('admin')),
);
?>

<h1>Items Categories</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
