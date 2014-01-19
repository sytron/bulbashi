<?php
$this->breadcrumbs=array(
	'Приходные'=>array('admin'),
	'Создать',
);

$this->menu=array(
array('label'=>'Управление приходными','url'=>array('admin')),
);
?>

<h1>Создать приходную</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?/*
    <h3>Товары</h3>

<?
$tabsArray = array();
foreach( ItemsCategory::model()->findAll() as $cat ) {
    $temp = array(
        'label' => $cat->name,
        'content' => $this->renderPartial('itemsAdd', array('category' => $cat->id), true),
    );
    if( empty($tabsArray) ) {
        $temp['active'] = true;
    }
    $tabsArray[] = $temp;
}
?>

<? $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=> 'tabs', // 'tabs' or 'pills'
    'tabs'=> $tabsArray
)); ?>
*/?>


<h3>Товары:</h3>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'client-form',
    'enableAjaxValidation' => false,
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<?  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'model'=>Item::model(), // модель
    'attribute'=>'name', // атрибут модели
    'id' => 'Item_name',
    // "источник" данных для выборки
    // может быть url, который возвращает JSON, массив
    // или функция JS('js: alert("Hello!");')
    'source'=>$this->createUrl('order/autocompleteitems', array()),
    'options'=>array(
        // минимальное кол-во символов, после которого начнется поиск
        'minLength'=>'2',
        'showAnim'=>'fold',
        // обработчик события, выбор пункта из списка
        'select' =>'js: function(event, ui) {
                    currentItemId = parseInt(ui.item.value);
                    currentItemPrice = parseInt(ui.item.price);
                    currentItemName = ui.item.label;
                    this.value = ui.item.label;
                    return false;
                }',
    ),
    // additional javascript options for the autocomplete plugin
    'htmlOptions'=>array(
        'style'=>'width:300px;'
    ),
)); ?>

<?php echo CHtml::textField('count', '1', array('style' => 'width:30px', 'id' => 'countAddItems')) ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'secondary',
    'label'=>'Добавить',
    'id' => 'addItemButton'
)); ?>

<?php $this->endWidget(); ?>

<div class="grid-view">
    <table class="items table">
        <thead>
        <tr>
            <th><a class="sort-link" href="#">Название</a></th><th><a class="sort-link" href="#">Количество</a></th><th id="yw1_c2"><a class="sort-link" href="/index.php?r=order/update&amp;id=2&amp;id_sort=price">price<span class="caret"></span></a></th></tr>
        </thead>
        <tbody>


        </tbody>
    </table>
</div>



<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary',
    'htmlOptions' => array(
        'onclick' => "js:$('#incoming-form').submit();",
    ),
    'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
)); ?>

<script type="text/javascript">
    $(document).ready( function() {
        $('#addItemButton').click(function() {
            if( currentItemName !== undefined ) {
                var countAddItems = parseInt($("#countAddItems").val());
                items.push({'id':currentItemId, 'name':currentItemName, 'count':countAddItems, 'price':currentItemPrice });
                $('input[name="Incoming[items]"]').val(JSON.stringify(items));
                //alert(JSON.stringify(items));
                $('table.items tbody').append('<tr class="odd"><td>'+currentItemName+'</td><td>'+countAddItems+'</td><td>'+currentItemPrice+'</td></tr>');
                currentItemName = undefined;
                return false;
            } else {
                alert("Выберите добавляемый товар!")
                return false;
            }
        });
    });
</script>

    <script type="text/javascript">
        var currentItemId;
        var currentItemName = undefined;
        var currentItemPrice;
        var items = [];

        items.getItogo = function() {
            var itog = 0;
            for(var i=0; i<items.length; i++) {
                itog = itog + items[i]['count']*items[i]['price'];
            }
            return itog.toFixed(2);
        }
        items.remove = function( x ) {
            for(var i=0; i<items.length; i++) {
                if( items[i]['i'] == x ) {
                    items.splice(i,1);
                    return;
                }
            }

        }
    </script>
