<?php
$this->breadcrumbs=array(
    'Отчеты'=>array('admin'),
    'Установка параметров',
);

$this->menu=array(
);
?>

<h1>Установка параметров</h1>

<?php echo $this->renderPartial($form, array('model'=>$model)); ?>
