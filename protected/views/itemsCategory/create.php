<?php
$this->breadcrumbs=array(
	'Управление категориями'=>array('admin'),
	'Создать',
);

$this->menu=array(
array('label'=>'Управление категориями','url'=>array('admin')),
);
?>

<h1>Создать категорию</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>