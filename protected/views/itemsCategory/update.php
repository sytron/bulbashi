<?php
$this->breadcrumbs=array(
	'Управление категориями'=>array('admin'),
	'Редактирование',
);

	$this->menu=array(
	array('label'=>'Создать новую категорию','url'=>array('create')),
	array('label'=>'Управление категориями','url'=>array('admin')),
	);
	?>

	<h1>Редактирование категрии <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>