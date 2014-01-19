<?php
$this->breadcrumbs=array(
    'Клиенты'=>array('admin'),
    'Создать новую запись',
);

$this->menu=array(
array('label'=>'Управление','url'=>array('admin')),
);
?>

<h1>Создание новой записи</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>