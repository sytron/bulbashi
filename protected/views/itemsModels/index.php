<?php
$this->breadcrumbs=array(
	'Связывание товаров и моделей',
);

$this->menu=array(
array('label'=>'Добавить связь','url'=>array('create')),
);
?>

<h1>Соответствия</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'items-models-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'emptyText' => 'Связей не найдено',
    'summaryText' => 'Связи {start}-{end} из {count}.',
    'columns'=>array(
        'itemName',
        'modelName',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
        ),
    ),
)); ?>