<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name),
)); ?>
<br><br>

<div class="row">
    <div class="span2">
<? $this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Старый клиент',
    'type' => 'primary',
    'size' => 'large',
    'url'=>Yii::app()->createUrl('client/old'),
)); ?>
</div><div class="span2">
<? $this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Новый клиент',
    'size' => 'large',
    'url'=>Yii::app()->createUrl('client/create'),
)); ?>
</div>

    <?
$this->endWidget(); ?>

<p></p>