<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'info-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<? Yii::app()->clientScript->registerCss('redactor-fix', '.redactor_editor {width:100%;} .redactor_box {overflow:hidden;} '); ?>

<?php echo $form->errorSummary($model); ?>

    <input name="Info[type]" type="hidden" value="<?=$_GET['type']?>">
	<input name="Info[type_id]" type="hidden" value="<?=$_GET['type_id']?>">

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

<br><br>
<div class="well">
        <?=$model->info?>
    </div>
<br><br>

    <a href="#" id="editor_turn">Редактировать</a> <br>
    <div id="editor" style="display:none">
        <?php echo $form->redactorRow($model, 'info', array('class'=>'span5', 'rows'=>5,'options'=>array(
            'imageUpload' => $this->createUrl('info/ImageUpload'),
            'fileUpload' => $this->createUrl('info/FileUpload'),
        ))); ?>
    </div>

	

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'id' => 'closebut',
        'label'=> 'Закрыть',
    )); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#editor_turn").click(function(){
            $("#editor").slideToggle();
        });
        $('#closebut').click(function(){
            window.close();
        });
    });
</script>