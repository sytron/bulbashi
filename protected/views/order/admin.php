<?php
$this->breadcrumbs=array(
	'Заказ-наряды'=>array('index'),
	'Управление',
);

$this->menu=array(
//array('label'=>'Создать новый заказ-наряд','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('order-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Управление Заказ-нарядами</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'order-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'afterAjaxUpdate' => 'reinstallDatePicker',
'emptyText' => 'Документов не найдено',
'summaryText' => 'Документы {start}-{end} из {count}.',
'selectableRows'=>1,
//'selectionChanged'=>'function(id){ updateId = $.fn.yiiGridView.getSelection(id); }',
'columns'=>array(
		'id',
		'client_id' => array(
            'name' => 'client_id',
            'value' => '$data->client->name',
        ),
        'client_car' => array(
            'name' => 'client_car',
            'value' => '$data->client->getCarName()',
            'filter' => Order::getCarsList(), // фильтр в виде выпадающего списка
        ),
		'statusName' => array(
            'name' => 'status',
            'value' => '$data->statusName',
            'filter' => Order::getStatusList(), // фильтр в виде выпадающего списка
        ),
        array(
            'name' => 'time_created',
            'value' => 'date("d.m.Y H:i:s", $data->time_created)',
            'filter' => $this->widget('bootstrap.widgets.TbDateRangePicker', array(
                    'model'=>$model,
                    'attribute'=>'time_created',
                    'options'=> array(
                        'locale' => array(
                            'applyLabel' => 'Применить фильтр',
                            'clearLabel' => 'Очистить',
                            'fromLabel' => 'От',
                            'toLabel' => 'До',
                            'customRangeLabel' => 'Свой диапазон',
                        ),
                    ),
                    'callback' => 'js: function(start, end) {
                                    var e = $.Event("change");
                                    $(\'[name|="Order[time_created]"]\').trigger(e);
                                } ',
                    //'callback'=>'js:function(start,end){return;}',
                ), true),
                /*$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'time_created',
                        //'language' => 'ru',
                        //'i18nScriptFile' => 'jquery.ui.datepicker-ru.js',
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_due_date',
                            'size' => '10',
                        ),
                        'defaultOptions' => array(  // (#3)
                            'showOn' => 'focus',
                            'dateFormat' => 'dd.mm.yy',
                            'showOtherMonths' => true,
                            'selectOtherMonths' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showButtonPanel' => true,
                        )
                    ),
                    true),*/
        ),
		//'time_created:datetime',
		'cost',
    array
    (
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}  {delete}  {print}',
        'buttons'=>array
        (
            'update' => array(
                'visible' => '!$data->isClosed'
            ),
            'delete' => array(
                'visible' => '!$data->isClosed'
            ),
            'print' => array
            (
                'label'=>'Распечатать',
                'imageUrl'=>Yii::app()->request->baseUrl.'/images/print.png',
                'url'=>'Yii::app()->createUrl("print/order", array("orderid"=>$data->id))',
                'options' => array('target' => '_blank')
            ),
        ),
    ),
),
));


?>

<script type="text/javascript">
    var updateId;

    $('#order-grid tbody tr').dblclick(function() {
        var updateId = $.fn.yiiGridView.getKey(
            'order-grid',
            $(this).prevAll().length 
        );
        //alert(id);
        var win=window.open('<?=Yii::app()->createUrl("order/update")?>&id='+updateId, '_blank');
        win.focus();
        //location.href = ;
    });

    function reinstallDatePicker() {
        $("#Order_time_created").daterangepicker({'locale':{'applyLabel':'Применить фильтр','clearLabel':'Очистить','fromLabel':'От','toLabel':'До','customRangeLabel':'Свой диапазон','daysOfWeek':['В','П','В','С','Ч','П','С'],'monthNames':['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь']}},  function(start, end) {
            var e = $.Event("change");
            $('[name|="Order[time_created]"]').trigger(e);
        } );
    }
</script>
