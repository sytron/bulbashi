<?php
$this->breadcrumbs = array(
    'Онлайн-бронь' => array('index'),
    'Управление',
);
?>

<h1>Онлайн бронирование</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'booking-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'emptyText' => 'Брони не найдено',
    'summaryText' => 'Бронь {start}-{end} из {count}.',
    'columns' => array(
        'day',
        'time',
        array(
            'name'=>'type',
            'value'=>'Booking::convTypeName($data->type)',
            'filter'=>CHtml::listData(Booking::getTypes(), 'id', 'title'),
        ),
        'name',
        'phone',
        'comment',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
        ),
    ),
)); ?>
