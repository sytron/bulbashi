<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'incoming-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<p class="help-block">Поля, помеченные <span class="required">*</span> обязательны.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'contragent_id', Contragent::getArrayList(), array() ); ?>

<?php echo $form->textFieldRow($model,'number',array('class'=>'span5','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'date',array('class'=>'span5','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'osnovanie',array('class'=>'span5','maxlength'=>255)); ?>




<?php echo CHtml::hiddenField('Incoming[items]', '', array() ) ?>


<?php $this->endWidget(); ?>
