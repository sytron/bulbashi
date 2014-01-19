<?php
$this->breadcrumbs=array(
	'Отчеты'=>array('admin'),
	'Выбор',
);

$this->menu=array(
	);
?>

<h1>Выберите тип отчета:</h1>

<a href="<?=$this->createUrl('create', array('type' => 'doneworks'))?>">Выполненые работы</a><br>
<a href="<?=$this->createUrl('create', array('type' => 'rashod'))?>">Расход запчастей</a><br>
<a href="<?=$this->createUrl('create', array('type' => 'perechen'))?>">Ремонт - перечень документов</a><br>
<a href="<?=$this->createUrl('create', array('type' => 'pribil_zapchasti'))?>">Прибыль - запчасти</a><br>
<a href="<?=$this->createUrl('create', array('type' => 'doneworks_month'))?>">Выполненные работы по месяцам</a><br>
<a href="<?=$this->createUrl('create', array('type' => 'rashod_months'))?>">Расход запчастей по месяцам</a><br>
<a href="<?=$this->createUrl('create', array('type' => 'teams'))?>">Отчет по бригадам</a><br>

