


<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'client-form_'.$category,
    'enableAjaxValidation' => false,
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<?=ItemsCategory::model()->findByPk($category)->name?><br><br>

<? $items = Order::getItemsForOrder($category, $modelId, $discount); ?>

<?
/*
работы
материалы
  фильтры
  масла
*/
?>

<?
$rabots = array();
$filters = array();
$oils = array();
$materials = array();
foreach ($items as $item) {
    if( strpos($item['name'], 'Ф/м') !== false || strpos($item['name'], 'Ф/с') !== false || strpos($item['name'], 'Ф/в') !== false || strpos($item['name'], 'Ф/т') !== false ) {
        $filters[] = $item;
        continue;
    }
    if( strpos($item['name'], 'Работа') !== false ) {
        $rabots[] = $item;
        continue;
    }
    if( strpos($item['name'], 'Материал') !== false ) {
        $materials[] = $item;
        continue;
    }
    if( strpos($item['name'], 'Castrol') !== false || strpos($item['name'], 'Total') !== false || strpos($item['name'], 'Shell') !== false || strpos($item['name'], 'ELF') !== false || strpos($item['name'], 'Mobil') !== false  ) {
        $oils[] = $item;
        continue;
    }
}
?>
<? if( count($rabots) != 0 ) : ?>
    <button type="button" class="btn" data-toggle="collapse" data-target="#rabota_<?=$category?>">
    Работы (<?=count($rabots)?>)
    </button>
<? endif ?>
<? if( count($materials) != 0 ) : ?>
    <button type="button" class="btn" data-toggle="collapse" data-target="#materials_<?=$category?>">
    Материалы (<?=count($materials)?>)
    </button>
<? endif ?>
<? if( count($filters) != 0 ) : ?>
    <button type="button" class="btn" data-toggle="collapse" data-target="#filters_<?=$category?>">
    Фильтры (<?=count($filters)?>)
    </button>
<? endif ?>
<? if( count($oils) != 0 ) : ?>
    <button type="button" class="btn" data-toggle="collapse" data-target="#oils_<?=$category?>">
    Масла (<?=count($oils)?>)
    </button>
 <? endif ?>
 <br><br>
<div id="rabota_<?=$category?>" class="collapse">
<? foreach ($rabots as $item) { ?>
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => $item['label'].' '.$item['price'].' руб.',
        'type' => 'primary',
        'id' => 'ItemButton_'.$category.'_'.$item['id'],
        
        'htmlOptions' => array(
            'item-id' => $item['id'],
            'item-price' => $item['price'],
            'item-label' => $item['label'],
            'data-toggle' => 'modal',
            'data-target' => '#myModal_'.$category,
            'onclick' => 'js:
                            currentItemId = parseInt( $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-id") );
                            currentItemPrice = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-price")*currentCoef;
                            currentItemName = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-label");
                            $("#priceAddItems_'.$category.'").val(currentItemPrice);
                            $("#countAddItems_'.$category.'").val("1");
                        ',
            )
    )); ?>
    <?
    $infos = array();
    foreach (Info::model()->findAllByAttributes(array('type'=>'item', 'type_id'=>$item['id'])) as $info) {
        $infos[] = array(
            'label' => $info->name,
            'url' => Yii::app()->createUrl('info/update', array('type'=>'item','type_id' => $item['id'], 'id' => $info->id )),
            'linkOptions' => array(     // use linkOptions for sub-menu
                'target' => '_blank'
            )
        );
    }
    $infos[] = '---';
    $infos[] = array(
        'label' => 'Добавить новую заметку к товару',
        'url' => Yii::app()->createUrl('info/create', array('type'=>'item','type_id' => $item['id'] )),
        'linkOptions' => array(     // use linkOptions for sub-menu
            'target' => '_blank'
        )
    );
    ?>
    <span class="infos">
        <? $this->widget(
            'bootstrap.widgets.TbButtonGroup',
            array(
                'buttons' => array(
                    array(
                        'label' => 'Заметки ('.(count($infos)-2).')', 'url' => '#',
                        'items' => $infos
                    ),
                ),
            )
        ); ?>
    </span>
    <br><br>
<? } ?> 

</div>

<div id="materials_<?=$category?>" class="collapse">
<? foreach ($materials as $item) { ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => $item['label'].' '.$item['price'].' руб.',
        'type' => 'primary',
        'id' => 'ItemButton_'.$category.'_'.$item['id'],

        'htmlOptions' => array(
            'item-id' => $item['id'],
            'item-price' => $item['price'],
            'item-label' => $item['label'],
            'data-toggle' => 'modal',
            'data-target' => '#myModal_'.$category,
            'onclick' => 'js:
                            currentItemId = parseInt( $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-id") );
                            currentItemPrice = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-price")*currentCoef;
                            currentItemName = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-label");
                            $("#priceAddItems_'.$category.'").val(currentItemPrice);
                            $("#countAddItems_'.$category.'").val("1");
                        ',
            )
    )); ?>
    <?
    $infos = array();
    foreach (Info::model()->findAllByAttributes(array('type'=>'item', 'type_id'=>$item['id'])) as $info) {
        $infos[] = array(
            'label' => $info->name,
            'url' => Yii::app()->createUrl('info/update', array('type'=>'item','type_id' => $item['id'], 'id' => $info->id )),
            'linkOptions' => array(     // use linkOptions for sub-menu
                'target' => '_blank'
            )
        );
    }
    $infos[] = '---';
    $infos[] = array(
        'label' => 'Добавить новую заметку к товару',
        'url' => Yii::app()->createUrl('info/create', array('type'=>'item','type_id' => $item['id'] )),
        'linkOptions' => array(     // use linkOptions for sub-menu
            'target' => '_blank'
        )
    );
    ?>
    <span class="infos">
        <? $this->widget(
            'bootstrap.widgets.TbButtonGroup',
            array(
                'buttons' => array(
                    array(
                        'label' => 'Заметки ('.(count($infos)-2).')', 'url' => '#',
                        'items' => $infos
                    ),
                ),
            )
        ); ?>
    </span>
    <br><br>
<? } ?>

</div>

<div id="filters_<?=$category?>" class="collapse">
<? foreach ($filters as $item) { ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => $item['label'].' '.$item['price'].' руб.',
        'type' => 'primary',
        'id' => 'ItemButton_'.$category.'_'.$item['id'],

        'htmlOptions' => array(
            'item-id' => $item['id'],
            'item-price' => $item['price'],
            'item-label' => $item['label'],
            'data-toggle' => 'modal',
            'data-target' => '#myModal_'.$category,
            'onclick' => 'js:
                            currentItemId = parseInt( $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-id") );
                            currentItemPrice = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-price")*currentCoef;
                            currentItemName = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-label");
                            $("#priceAddItems_'.$category.'").val(currentItemPrice);
                            $("#countAddItems_'.$category.'").val("1");
                        ',
            )
    )); ?>
    <?
    $infos = array();
    foreach (Info::model()->findAllByAttributes(array('type'=>'item', 'type_id'=>$item['id'])) as $info) {
        $infos[] = array(
            'label' => $info->name,
            'url' => Yii::app()->createUrl('info/update', array('type'=>'item','type_id' => $item['id'], 'id' => $info->id )),
            'linkOptions' => array(     // use linkOptions for sub-menu
                'target' => '_blank'
            )
        );
    }
    $infos[] = '---';
    $infos[] = array(
        'label' => 'Добавить новую заметку к товару',
        'url' => Yii::app()->createUrl('info/create', array('type'=>'item','type_id' => $item['id'] )),
        'linkOptions' => array(     // use linkOptions for sub-menu
            'target' => '_blank'
        )
    );
    ?>
    <span class="infos">
        <? $this->widget(
            'bootstrap.widgets.TbButtonGroup',
            array(
                'buttons' => array(
                    array(
                        'label' => 'Заметки ('.(count($infos)-2).')', 'url' => '#',
                        'items' => $infos
                    ),
                ),
            )
        ); ?>
    </span>
    <br><br>
<? } ?>

</div>

<div id="oils_<?=$category?>" class="collapse">
<? $oilsfirms = array(); ?>
<? foreach ($oils as $item) {
    if( strpos($item['name'], 'Castrol') !== false ) {
        $oilsfirms['Castrol'][] = $item;
        continue;
    }
    if( strpos($item['name'], 'Total') !== false ) {
        $oilsfirms['Total'][] = $item;
        continue;
    }
    if( strpos($item['name'], 'Shell') !== false ){
        $oilsfirms['Shell'][] = $item;
        continue;
    }
    if( strpos($item['name'], 'ELF') !== false ) {
        $oilsfirms['ELF'][] = $item;
        continue;
    }
    if( strpos($item['name'], 'Mobil') !== false ) {
        $oilsfirms['Mobil'][] = $item;
        continue;
    } ?>
<? } ?>

    <? foreach ($oilsfirms as $firm => $oilsarr) { ?>
        <button type="button" class="btn" data-toggle="collapse" data-target="#oils_firm_<?=$firm?>">
            <?=$firm?>
        </button>

    <? } ?>
    <br><br>
<? foreach ($oilsfirms as $firm => $oilsarr) { ?>
    <div id="oils_firm_<?=$firm?>" class="collapse">
    <? foreach( $oilsarr as $item ) { ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => $item['label'].' '.$item['price'].' руб.',
            'type' => 'primary',
            'id' => 'ItemButton_'.$category.'_'.$item['id'],

            'htmlOptions' => array(
                'item-id' => $item['id'],
                'item-price' => $item['price'],
                'item-label' => $item['label'],
                'data-toggle' => 'modal',
                'data-target' => '#myModal_'.$category,
                'onclick' => 'js:
                            currentItemId = parseInt( $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-id") );
                            currentItemPrice = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-price")*currentCoef;
                            currentItemName = $("#ItemButton_'.$category.'_'.$item['id'].'").attr("item-label");
                            $("#priceAddItems_'.$category.'").val(currentItemPrice);
                            $("#countAddItems_'.$category.'").val("'.$volume.'");
                            oilName = \''.$item["label"].'\';
                            changeButtons();
                        ',
            )
        )); ?>
        <?
        $infos = array();
        foreach (Info::model()->findAllByAttributes(array('type'=>'item', 'type_id'=>$item['id'])) as $info) {
            $infos[] = array(
                'label' => $info->name,
                'url' => Yii::app()->createUrl('info/update', array('type'=>'item','type_id' => $item['id'], 'id' => $info->id )),
                'linkOptions' => array(     // use linkOptions for sub-menu
                    'target' => '_blank'
                )
            );
        }
        $infos[] = '---';
        $infos[] = array(
            'label' => 'Добавить новую заметку к товару',
            'url' => Yii::app()->createUrl('info/create', array('type'=>'item','type_id' => $item['id'] )),
            'linkOptions' => array(     // use linkOptions for sub-menu
                'target' => '_blank'
            )
        );
        ?>
        <span class="infos">
            <? $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'buttons' => array(
                        array(
                            'label' => 'Заметки ('.(count($infos)-2).')', 'url' => '#',
                            'items' => $infos
                        ),
                    ),
                )
            ); ?>
        </span>
        <br><br>
    <? } ?>
    </div>
<? } ?>

</div>



<? $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal_'.$category)); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Добавить в ЗН</h4>
</div>

<div class="modal-body">
    <p>
        Количество:
        <?php echo CHtml::textField('count', '1', array('style' => 'width:30px', 'id' => 'countAddItems_'.$category )) ?>
        <br><br>
        Цена:
        <?php echo CHtml::textField('price', '', array('style' => 'width:30px', 'id' => 'priceAddItems_'.$category )) ?>
    </p>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Добавить',
        'id' => 'addItemButton_'.$category,
        'htmlOptions' => array('data-dismiss' => 'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Отмена',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    )); ?>
</div>

<?php $this->endWidget(); ?>




 
<? /* $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'model'=>Item::model(), // модель
    'attribute'=>'name', // атрибут модели
    'id' => 'Item_name_'.$category,
    // "источник" данных для выборки
    // может быть url, который возвращает JSON, массив
    // или функция JS('js: alert("Hello!");')
    'source'=>$this->createUrl('order/autocompleteitems', array('category'=>$category, 'modelId' => $modelId)),
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
        'placeholder' => 'Начните вводить наименование',
        'style'=>'width:300px;'
    ),
)); 

echo CHtml::textField('count', '1', array('style' => 'width:30px', 'id' => 'countAddItems_'.$category )) 

 $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'secondary',
    'label'=>'Добавить',
    'id' => 'addItemButton_'.$category
)); */ ?> 

<? $this->endWidget();  ?>


<script type="text/javascript">
    $(document).ready( function() {
        $("button[type=button]").click(function(){
            if( $(this).hasClass('btn-warning') ) {
                $(this).removeClass('btn-warning');
            } else {
                $(this).addClass('btn-warning');
            }

        });

        $('#addItemButton_<?=$category?>').click(function() {
            if( currentItemName !== undefined ) {
                var countAddItems = $("#countAddItems_<?=$category?>").val();
                currentItemPrice = $("#priceAddItems_<?=$category?>").val();
                items.push({'i':items.length,'id':currentItemId, 'name':currentItemName, 'count':countAddItems, 'price':currentItemPrice });
                $('input[name="Order[items]"]').val(JSON.stringify(items));
                //alert(JSON.stringify(items));
                $('table.items tbody').prepend('<tr class="odd" itemsId="'+(items.length-1)+'"><td>'+currentItemName+'</td><td class="count">'+countAddItems+'</td><td class="price">'+currentItemPrice+'</td>' +
                    '<td class="button-column">'+
                    '<a class="update" title="" rel="tooltip" href="#" itemsId="'+(items.length-1)+'" data-toggle = "modal" data-target = "#myModal_edit" data-original-title="Редактировать"><i class="icon-pencil"></i></a>'+
                    '  <a class="delete" title="" rel="tooltip" href="#" itemsId="'+(items.length-1)+'"  data-original-title="Удалить"><i class="icon-trash"></i></a>'+
                    '</td></tr>');
                currentItemName = undefined;
                $('td#itogo').text( items.getItogo() );

                // сворачиваем товары
                $('div.collapse.in').collapse('hide');
                $("button[type=button]").each(function(){
                    if( $(this).hasClass('btn-warning') ) {
                        $(this).removeClass('btn-warning');
                    } 
                });
            } else {
                alert("Выберите добавляемый товар!")
                
            }
        });


    });
</script>