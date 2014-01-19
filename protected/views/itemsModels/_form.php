<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'items-category-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'vendor_id', Vendor::getArrayList(),
    array(
        'ajax' => array(
            'type' => 'POST', //request type
            'url' => $this->createUrl("ItemsModels/LoadModelrows"),
            'update'=>'#ItemsModels_modelrow_id',
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
            'url' => "/?r=ItemsModels/LoadModelCars",
            'update'=>'#ItemsModels_model_id',
        ))

); ?>

<?php
if( !empty($model->vendor_id) ) {
    $data = ModelCar::getArrayList($model->modelrow_id);
} else {
    $data = array();
}
echo $form->dropDownListRow($model, 'model_id', $data); ?>

<?php
echo $form->dropDownListRow($model, 'item_id', Item::getArrayListAll()); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
</div>

<?php $this->endWidget(); ?>
