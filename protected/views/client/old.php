<? $this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Новый клиент',
    'size' => 'large',
    'url'=>Yii::app()->createUrl('client/create'),
)); ?>

	<h1>Поиск клиента</h1>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'client-form',
    'enableAjaxValidation' => false,
    'htmlOptions'=>array('class'=>'well'),
)); ?>
<div class="row">
<div class="span4">

    <?php echo $form->label($model,'name'); ?>
    <?  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'model'=>$model, // модель
            'attribute'=>'name', // атрибут модели
            // "источник" данных для выборки
            // может быть url, который возвращает JSON, массив
            // или функция JS('js: alert("Hello!");')
            'source'=>$this->createUrl('client/autocomplete', array('field'=>'name')),
            'options'=>array(
                // минимальное кол-во символов, после которого начнется поиск
                'minLength'=>'2',
                'showAnim'=>'fold',
                // обработчик события, выбор пункта из списка
                'select' =>'js: function(event, ui) {
                    this.value = ui.item.value;
                    updateView(ui.item);
                    return false;
                }',
            ),
            // additional javascript options for the autocomplete plugin
            'htmlOptions'=>array(
                'style'=>'height:20px;width:300px;'
            ),
    )); ?>

    <?php echo $form->label($model,'gosnomer'); ?>
    <?  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model, // модель
        'attribute'=>'gosnomer', // атрибут модели
        // "источник" данных для выборки
        // может быть url, который возвращает JSON, массив
        // или функция JS('js: alert("Hello!");')
        'source'=>$this->createUrl('client/autocomplete', array('field'=>'gosnomer')),
        'options'=>array(
            // минимальное кол-во символов, после которого начнется поиск
            'minLength'=>'2',
            'showAnim'=>'fold',
            // обработчик события, выбор пункта из списка
            'select' =>'js: function(event, ui) {
                    this.value = ui.item.value;
                    updateView(ui.item);
                    return false;
                }',
        ),
        // additional javascript options for the autocomplete plugin
        'htmlOptions'=>array(
            'style'=>'height:20px;width:300px;'
        ),
    )); ?>

    <?php echo $form->label($model,'vin'); ?>
    <?  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model, // модель
        'attribute'=>'vin', // атрибут модели
        // "источник" данных для выборки
        // может быть url, который возвращает JSON, массив
        // или функция JS('js: alert("Hello!");')
        'source'=>$this->createUrl('client/autocomplete', array('field'=>'vin')),
        'options'=>array(
            // минимальное кол-во символов, после которого начнется поиск
            'minLength'=>'2',
            'showAnim'=>'fold',
            // обработчик события, выбор пункта из списка
            'select' =>'js: function(event, ui) {
                    this.value = ui.item.value;
                    updateView(ui.item);
                    return false;
                }',
        ),
        // additional javascript options for the autocomplete plugin
        'htmlOptions'=>array(
            'style'=>'height:20px;width:300px;'
        ),
    )); ?>
</div>

<div class="span7">
    <label>Автомобиль:</label>
    <label id="car_label"></label>

    <label>Последний визит:</label>
    <label id="lastvisit_label"></label>

    <label>Пробег:</label>
    <label id="milleage_label"></label>

    <label>Примечания:</label>
    <label id="comment_label"></label>

    <div id="documents_div"></div>
</div>
</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    <? if ( isset($model->id) ) { ?>
    $(document).ready(function(){
        $.get('/index.php?r=client/autocomplete&&field=name&term=<?=$model->name?>', null, function(data) {
            updateView(data[0]);
        },'json');
    });
    <? } ?>
    $(document).ready(function(){
        if($.cookie('name')) {
            $.get('/index.php?r=client/autocomplete&&field=name&term='+$.cookie('name'), null, function(data) {
                updateView(data[0]);
                $.cookie('name', '');
            },'json');
        }
    });
    function updateView( item ) {
        $("#Client_name").val(item.name);
        $("#Client_gosnomer").val(item.gosnomer);
        $("#Client_vin").val(item.vin);
        //$("#Client_barcode").val(item.barcode);
        $("#car_label").text(item.car_label);
        $("#lastvisit_label").text(item.lastvisit);
        $("#comment_label").text(item.comment);
        $("#milleage_label").text(item.milleage);
        //$("#barcode_img").attr("src",item.barcode_img);
        //$("#barcode_img").parent().parent().find('a').show();
        $.get('/index.php?r=client/renderdocuments&id='+item.id, null, function(data) {
           $('#documents_div').html(data);
        },'html');
        $.cookie('name', item.name);
    }
</script>

<?php //echo $this->renderPartial('_form',array('model'=>$model)); ?>