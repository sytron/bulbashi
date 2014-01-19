<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'client-form',
    'enableAjaxValidation' => false,
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<p class="help-block">Поля, помеченные <span class="required">*</span> обязательны.</p>

<?php echo $form->errorSummary($model); ?>


    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'gosnomer', array('class' => 'span5', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'vin', array('class' => 'span5', 'maxlength' => 255)); ?>


    <?php echo $form->textAreaRow($model, 'comment', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

    <?php echo $form->textFieldRow($model, 'mileage', array('class' => 'span5')); ?>

    <?php echo $form->dropDownListRow($model, 'howknow', Client::getHowknowArray(), array() ); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>
</div>

<?php $this->endWidget(); ?>

