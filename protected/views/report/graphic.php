<?php
$this->breadcrumbs=array(
	'Касса'=>array('admin'),
	'Графики',
);

$this->menu=array(
	array('label'=>'Общая сводка','url'=>array('admin')),
	);	
	
?>

<h1>Кассовый баланс на данный момент: <?=Cashbox::getCurrentBalance()?>р.</h1>

<?php $this->widget(
    'application.extensions.OpenFlashChart2Widget.OpenFlashChart2Widget',
    array(
        'chart' => $chart,
        'width' => '800',
        'height' => '800'
    )
); ?>
