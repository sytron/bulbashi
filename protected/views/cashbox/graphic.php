<?php
$this->breadcrumbs=array(
	'Деньги'=>array('admin'),
	'Графики',
);

$this->menu=array(
	array('label'=>'Журнал операций','url'=>array('admin')),
	);	
	
?>

<h1>Кассовый баланс на данный момент: <?=Cashbox::getCurrentBalance()?>р.</h1>



<?php $this->widget(
    'application.extensions.OpenFlashChart2Widget.OpenFlashChart2Widget',
    array(
        'chart' => $chart,
        'width' => '800',
        'height' => '800'
    )
); ?>

<? /*$this->widget('bootstrap.widgets.TbDateRangePicker', array(
    'model' => $model,
    'attribute' => 'range',

    'htmlOptions' => array(

        //    'id' => 'daterange',
    ),
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
                                        alert(start);
                                        alert(end);
                                    } ',
    //'callback'=>'js:function(start,end){return;}',
));
 КАК-ТО КОНФЛИКТУЕТ С ГРАФИКОМ!!
 */ ?>