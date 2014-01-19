<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'incoming-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation' => true,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->datepickerRow($model, 'tempDate',
    array(
        'prepend'=>'<i class="icon-calendar"></i>',

        'options'=>array(
            'language' => 'ru',
            'format' => 'dd.mm.yyyy',
            'autoclose' => true
        )
    )
); ?>


<?php echo $form->dropDownListRow($model, 'article_id', Article::getArrayList()); ?>

<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'change',array('class'=>'span5','maxlength'=>255)); ?>
<p>Сумму изменения необходимо указывать со знаком "-", в случае изьятия средств из кассы.</p>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Провести' : 'Сохранить',
		)); ?>
</div>


<?php $this->endWidget(); ?>
