<?php
$this->breadcrumbs=array(
	'Заказ-наряды'=>array('index'),
	'Печать ЗН №'.$model->id,
);

	$this->menu=array(
	array('label'=>'Управление заказ-нарядами','url'=>array('admin')),
	);
	?>

	<h1>Печать Заказ-наряда №<?php echo $model->id; ?></h1>

    <p>Внимание! Данный заказ-наряд имеет статус <?=$model->StatusName?>. При печати статус изменится на "Закрыт" и отредактировать ЗН будет уже невозможно.</p>
<p><a href="<?=Yii::app()->createUrl("print/order", array("orderid"=>$model->id,'close'=>'1'))?>">Печать с закрытием ЗН.</a></p>