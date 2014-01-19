<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<label>Клиент: <?=$model->client->name?></label>

<?php echo $form->hiddenField($model,'client_id', array() ); ?>

<?php echo $form->dropDownListRow($model, 'team_id', Order::getTeamList(), array() ); ?>

<?php echo $form->dropDownListRow($model, 'status', Order::getStatusList(), array() ); ?>

<label>Авто: <?=$model->client->getCarName()?></label>

<label>Объем необходимого масла: <?=$model->client->modelcar->volume?></label>

<a href="#" id="adv_b">Рекомендации</a> <br>
<div id="adv" style="display:none">
    <?php echo $form->textAreaRow($model, 'advice', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>
</div>

<a href="#" id="prob_b">Пробег</a> <br>
<div id="prob" style="display:none">
    <? if (Yii::app()->controller->action->id == 'update') { ?>
        <label>Текущий пробег: <?=$model->client->mileage?></label>
    <? } else { ?>
        <label>Пробег при предыдущем посещении: <?=$model->client->mileage?></label>
        <label>Текущий пробег: <input type="text" name="mileage_now" /></label>
    <? } ?>

    <label>Пробег следующей замены масла: <input type="text" name="mileage_next" /></label>
</div>

<label>
    <?php echo CHtml::checkBox('disc', false, array( 'id' => 'check_discount' ) ) ?>
    Скидка
</label>

<?php echo CHtml::hiddenField('Order[items]', '', array() ) ?>

<?php $this->endWidget(); ?>




<script type="text/javascript">
    var currentCoef = 1;
    $(document).ready(function(){
        $("#adv_b").click(function(){
            $("#adv").slideToggle();
        });

        $("#check_discount").click(function(){
            if( currentCoef == 1 ) {
                currentCoef = 1 - 0.05;
                items.reCalc(100, 95);
            } else {
                currentCoef = 1;
                items.reCalc(95, 100);
            }
        });

        $("#prob_b").click(function(){
            $("#prob").slideToggle();
        });
        $('#order-form').submit(function(){
            if( $('select[name="Order[team_id]"]').val() == "0" ) {
                alert("Пожалуйста, выберите бригаду!");
                return false;
            } else {
                return true;
            }
        });
    });
</script>