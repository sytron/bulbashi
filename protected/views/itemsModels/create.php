<?php
$this->breadcrumbs=array(
	'Управление связями'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Управление связями','url'=>array('index')),
);
?>

<h1>Создать связь</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>