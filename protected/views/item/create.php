<?php
$this->breadcrumbs=array(
	'Управление товарами'=>array('admin'),
	'Создать',
);

$this->menu=array(
array('label'=>'Управление товарами','url'=>array('admin')),
);
?>

<h1>Создать товар</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>