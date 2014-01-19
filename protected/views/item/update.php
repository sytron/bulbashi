<?php
$this->breadcrumbs=array(
	'Управление товарами'=>array('admin'),
	'Редактирование',
);

	$this->menu=array(
	array('label'=>'Создать новый товар','url'=>array('create')),
	array('label'=>'Управление товарами','url'=>array('admin')),
	);
	?>

	<h1>Редактирование товара №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>