

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'client-form_'.$category,
    'enableAjaxValidation' => false,
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<?  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'model'=>Item::model(), // модель
    'attribute'=>'name', // атрибут модели
    'id' => 'Item_name_'.$category,
    // "источник" данных для выборки
    // может быть url, который возвращает JSON, массив
    // или функция JS('js: alert("Hello!");')
    'source'=>$this->createUrl('order/autocompleteitems', array('category'=>$category)),
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

<?php echo CHtml::textField('count', '1', array('style' => 'width:30px', 'id' => 'countAddItems_'.$category )) ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'secondary',
    'label'=>'Добавить',
    'id' => 'addItemButton_'.$category
)); ?>

<?php $this->endWidget(); ?>

<h3>Товары:</h3>
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

<script type="text/javascript">
    $(document).ready( function() {
        $('#addItemButton_<?=$category?>').click(function() {
            if( currentItemName !== undefined ) {
                var countAddItems = parseInt($("#countAddItems_<?=$category?>").val());
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