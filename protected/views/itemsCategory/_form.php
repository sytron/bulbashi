<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'items-category-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<p class="help-block">Поля, помеченные <span class="required">*</span> обязательны.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($model, 'parent', ItemsCategory::getArrayList(), array( ) ); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
