<?php
$this->breadcrumbs=array(
	'Деньги'=>array('admin'),
	'Журнал операций',
);

$this->menu=array(
    array('label'=>'Деньги(доходы/расходы)','url'=>array('create')),
    array('label'=>'График изменения баланса','url'=>array('graphic', 'type' => 'balance')),
    array('label'=>'График суточной прибыли','url'=>array('graphic', 'type' => 'daily')),
	);

?>

<h1>Деньги: <?=Cashbox::getCurrentBalance()?>р.</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'incoming-grid',
'dataProvider'=>$model->search(),
'afterAjaxUpdate' => 'reinstallDatePicker',
'filter'=>$model,
'emptyText' => 'Записей не найдено',
'selectableRows'=>1,
'summaryText' => 'Записи {start}-{end} из {count}.',
'columns'=>array(
        'id',
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
                                        $(\'[name|="Cashbox[time_created]"]\').trigger(e);
                                    } ',
                    //'callback'=>'js:function(start,end){return;}',
                ), true),
        ),
        'type',
        array(
            'name' => 'article_id',
            'value' => '$data->article->name',
            'filter' => Article::getArrayList()
        ),
        'name',
		'change',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
            'buttons'=>array
            (
                'update' => array(
                    'visible' => '$data->isManual'
                ),
                'delete' => array(
                    'visible' => '$data->isManual'
                ),
            ),
        ),
),
)); ?>



<script type="text/javascript">
    var updateId;

    $('#incoming-grid tbody tr').dblclick(function() {
        var updateId = $.fn.yiiGridView.getKey(
            'incoming-grid',
            $(this).prevAll().length
        );
        //alert(id);
        var win=window.open('<?=Yii::app()->createUrl("cashbox/update")?>&id='+updateId, '_blank');
        win.focus();
        //location.href = ;
    });

    function reinstallDatePicker() {
        $("#Cashbox_time_created").daterangepicker({'locale':{'applyLabel':'Применить фильтр','clearLabel':'Очистить','fromLabel':'От','toLabel':'До','customRangeLabel':'Свой диапазон','daysOfWeek':['В','П','В','С','Ч','П','С'],'monthNames':['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь']}},  function(start, end) {
            var e = $.Event("change");
            $('[name|="Cashbox[time_created]"]').trigger(e);
        } );
    }
</script>
