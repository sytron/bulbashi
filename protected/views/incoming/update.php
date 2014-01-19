<?php
$this->breadcrumbs=array(
	'Приходные'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Редактирование',
);

	$this->menu=array(
	array('label'=>'Создать новую приходную','url'=>array('create')),
	array('label'=>'Управление приходными','url'=>array('admin')),
	);
	?>

	<h1>Редактирование приходной <?php echo $model->id; ?></h1>
<? //print_r($model->items); die; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>


<h3>Товары</h3>
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
            <th><a class="sort-link" href="#">Название</a></th><th><a class="sort-link" href="#">Количество</a></th><th id="yw1_c2"><a class="sort-link" href="/index.php?r=order/update&amp;id=2&amp;id_sort=price">Цена<span class="caret"></span></a></th>
        </tr>

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

<? /* $this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$model->itemsDataProvider,
    'template'=>"{items}",
    'columns'=>array(
        'name',
        'count',
        'price',

    ),
)); */ ?>


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
    $(document).ready(function(){
        <? $i=0; ?>

        <? if( count($model->items) > 0 ) : ?>
            <? foreach(unserialize($model->items) as $item ) : ?>
            items.push({'i':<?=$i?>,'id':<?=$item['id']?>, 'name':'<?=$item['name']?>', 'count':<?=$item['count']?>, 'price':<?=$item['price']?> });
            $('table.items tbody').prepend('<tr class="odd"><td><?=$item['name']?></td><td><?=$item['count']?></td><td><?=$item['price']?></td>' +
                '<td class="button-column"> <a class="delete" title="" rel="tooltip" href="#" itemsId="'+(items.length-1)+'" data-original-title="Удалить"><i class="icon-trash"></i></a></td></tr>');
            <? $i++; ?>
            <? endforeach ?>
        <? endif ?>
        $('input[name="Incoming[items]"]').val(JSON.stringify(items));
        $('a.delete').on('click', function() {
            items.remove( $(this).attr('itemsId') );
            $(this).parent().parent().remove();
            $('td#itogo').text( items.getItogo() );
            $('input[name="Incoming[items]"]').val(JSON.stringify(items));
            return false;
        });
        $('td#itogo').text( items.getItogo() );
    });
</script>