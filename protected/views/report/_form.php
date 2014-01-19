<?php
echo "test"; die();
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'incoming-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>


    <?php echo $form->textFieldRow($model,'change',array('class'=>'span5','maxlength'=>255)); ?>
<p>Сумму изменения необходимо указывать со знаком "-", в случае изьятия средств из кассы.</p>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Зарегистрировать' : 'Сохранить',
		)); ?>
</div>


<?php $this->endWidget(); ?>
