<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'client-form',
    'enableAjaxValidation' => false,
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<p class="help-block">Поля, помеченные <span class="required">*</span> обязательны.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'vendor_id', Vendor::getArrayList(),
    array(
        'ajax' => array(
            'type' => 'POST', //request type
            'url' => $this->createUrl("Client/LoadModelrows"),
            'update'=>'#Client_modelrow_id',
        ))

    ); ?>

<?php
if( !empty($model->vendor_id) ) {
    $data = Modelrow::getArrayList($model->vendor_id);
} else {
    $data = array();
}
echo $form->dropDownListRow($model, 'modelrow_id',  $data,
    array(
        'ajax' => array(
            'type' => 'POST', //request type
            'url' => "/?r=Client/LoadModelCars",
            'update'=>'#Client_model_id',
        ))

); ?>

<?php
if( !empty($model->vendor_id) ) {
    $data = ModelCar::getArrayList($model->modelrow_id);
} else {
    $data = array();
}
echo $form->dropDownListRow($model, 'model_id', $data); ?>
<br><br>
<a href="#" id="adv_b">Полная анкета</a> <br>
<br>
<div id="adv" style="display:none">
    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'gosnomer', array('class' => 'span5', 'maxlength' => 255)); ?>

    <?php echo $form->textFieldRow($model, 'vin', array('class' => 'span5', 'maxlength' => 255)); ?>


    <?php echo $form->textAreaRow($model, 'comment', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

    <?php echo $form->textFieldRow($model, 'mileage', array('class' => 'span5')); ?>

    <?php echo $form->dropDownListRow($model, 'howknow', Client::getHowknowArray(), array() ); ?>

<!--<?php echo $form->textFieldRow($model, 'card', array('class' => 'span5')); ?>-->
</div>



<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>
</div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
    $(document).ready(function(){
        $("#adv_b").click(function(){
            $("#adv").slideToggle();
        });
    });
</script>