<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contragent-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<? Yii::app()->clientScript->registerCss('redactor-fix', '.redactor_editor {width:100%;} .redactor_box {overflow:hidden;} '); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->redactorRow($model, 'address', array('class'=>'span5', 'rows'=>5,'options'=>array(
    'imageUpload' => $this->createUrl('info/ImageUpload'),
    'fileUpload' => $this->createUrl('info/FileUpload'),
))); ?>

<?php echo $form->redactorRow($model, 'details', array('class'=>'span5', 'rows'=>5,'options'=>array(
    'imageUpload' => $this->createUrl('info/ImageUpload'),
    'fileUpload' => $this->createUrl('info/FileUpload'),
))); ?>

<br><br>
	

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>

</div>

<?php $this->endWidget(); ?>
