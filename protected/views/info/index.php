<?php
$this->breadcrumbs=array(
	'Infos',
);

$this->menu=array(
array('label'=>'Create Info','url'=>array('create')),
array('label'=>'Manage Info','url'=>array('admin')),
);
?>

<h1>Infos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
