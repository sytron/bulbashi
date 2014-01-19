<?php
$this->breadcrumbs=array(
    'Клиенты'=>array('admin'),
    'Редактирование'.$model->name,
);

	$this->menu=array(
    array('label'=>'Управление','url'=>array('admin')),
	array('label'=>'Создать новую запись','url'=>array('create')),
	);
	?>

	<h1>Редактирование клиента №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form2',array('model'=>$model)); ?>