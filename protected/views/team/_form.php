<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'info-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<? Yii::app()->clientScript->registerCss('redactor-fix', '.redactor_editor {width:100%;} .redactor_box {overflow:hidden;} '); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

<br><br>
	

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>

</div>

<?php $this->endWidget(); ?>
