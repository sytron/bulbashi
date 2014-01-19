<?php
$this->breadcrumbs=array(
	'Деньги'=>array('admin'),
	'Создать',
);

$this->menu=array(
array('label'=>'Журнал операций','url'=>array('admin')),
);
?>

<h1>Ручное списание средств</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
