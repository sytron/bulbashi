<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<p class="help-block">Поля, помеченные <span class="required">*</span> обязательны.</p>

<?
$arr = ItemsCategory::getArrayList();
unset($arr[0]);
?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->dropDownListRow($model, 'category_id',  $arr, array( ) ); ?>

	<?php echo $form->textFieldRow($model,'amount',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price_z',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price_s',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price_m',array('class'=>'span5')); ?>

	<?php //echo $form->textAreaRow($model,'dependence',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textFieldRow($model,'barcode',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'unit',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'minimal_amount',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
