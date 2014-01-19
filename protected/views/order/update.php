<?php
$this->breadcrumbs=array(
	'Заказ-наряды'=>array('index'),
	'Редактирование №'.$model->id,
);

	$this->menu=array(
	array('label'=>'Управление заказ-нарядами','url'=>array('admin')),
	);
	?>

	<h1>Редактирование Заказ-наряда №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

<?php if($this->beginCache('1itemsAdd_'.$model->client->model_id, array('duration'=>3600))) { ?>
<?
$tabsArray = array(
    array(
        'label' => 'Двигатель',
        'items' => array(
                array(
                    'label' => 'Система смазки двигателя',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 19, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Система охлаждения двигателя',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 22, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Топливная система двигателя',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 21, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Система обеспечения воздухом',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 20, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Система зажигания',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 23, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                )
            )
    ),
    array(
        'label' => 'Интерьер',
        'items' => array(
                array(
                    'label' => 'Система кондиционирования (отопления)',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 24, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),                
            )
    ), 
    array(
        'label' => 'Экстерьер',
        'items' => array(
                array(
                    'label' => 'Система освещения/сигнализации',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 25, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Система очистки стекла',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 26, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Защита поддона картера',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 27, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
            )
    ),
    array(
        'label' => 'ГУР',
        'items' => array(
                array(
                    'label' => 'Система гидроусилителя руля',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 28, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),                
            )
    ), 
    array(
        'label' => 'Трансмиссия/подвеска',
        'items' => array(
                array(
                    'label' => 'МКПП',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 29, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'АКПП',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 30, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Раздаточная коробка',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 31, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Дифференциал',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 32, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
            )
    ),
    array(
        'label' => 'Диагностика',
        'items' => array(
                array(
                    'label' => 'Диагностика электронных систем',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 33, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Диагностика подвески',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 34, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Диагностика систем охлаждения и кондиционирования',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 35, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Диагностика АКБ и электрических цепей (низкого/высокого напряжения)',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 36, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
            )
    ),
    array(
        'label' => 'Тормозная система',
        'items' => array(
                array(
                    'label' => 'Гидравлическая система тормозов',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 37, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
                array(
                    'label' => 'Колодки, Диски, Барабаны, Ручной тормоз',
                    'content' => $this->renderPartial('itemsAdd', array('category' => 38, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
                ),
            )
    ),
    array(
        'label' => 'Прочее',
        'content' => $this->renderPartial('itemsAdd', array('category' => 39, 'modelId' => $model->client->model_id, 'discount' => $model->withDiscount, 'volume'=>$model->client->modelcar->volume), true),
    ),
);
?>


<h3>Наименования:</h3>
<div class="grid-view">
    <table class="items table">
        <thead>
        <tr>
            <th><a class="sort-link" href="#">Название</a></th><th><a class="sort-link" href="#">Количество</a></th><th id="yw1_c2"><a class="sort-link" href="/index.php?r=order/update&amp;id=2&amp;id_sort=price">Цена<span class="caret"></span></a></th>
        </tr>

        </thead>
        <tbody>

        <tr>
            <td></td><td><b>Итого:</b></td><td id="itogo"></td><td></td>
        </tr>
        </tbody>
    </table>
</div>


<? $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=> 'tabs', // 'tabs' or 'pills'
    'tabs'=> $tabsArray
)); ?>

    <?php $this->endCache(); } ?>

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
    items.setNewPrice = function( n,x ) {
        for(var i=0; i<items.length; i++) {
            if( items[i]['i'] == n ) {
                items[i]['price'] = x;
                return;
            }
        }

    }
    items.setNewCount = function( n,x ) {
        for(var i=0; i<items.length; i++) {
            if( items[i]['i'] == n ) {
                items[i]['count'] = x;
                return;
            }
        }
    }
    items.reCalc = function( del, mul ) {
        for(var i=0; i<items.length; i++) {
            items[i]['price'] = (parseFloat(items[i]['price']/del)*mul).toFixed(2)
            $('table.items tbody tr[itemsId="'+i+'"] td.price').text(items[i]['price']);
        }
        $('td#itogo').text( items.getItogo() );
        return;
    }


    var hints = 1;

    function hintsFunc() {
        if( hints == 1 ) {
            hints = 0;
            $('.infos').hide();
            $('#hints').hide();
        } else {
            hints = 1;
            $('.infos').show();
            $('#hints').show();
        }
    }


    $(document).ready(function(){
        hintsFunc();

        $('a.showhints').click(function(e){
            hintsFunc();
            e.preventDefault();
        })
        <? $i=0; ?>
        <? foreach($model->items as $item ) : ?>
            items.push({'i':<?=$i?>,'id':<?=$item['id']?>, 'name':'<?=$item['name']?>', 'count':<?=$item['count']?>, 'price':<?=$item['price']?> });
            $('table.items tbody').prepend('<tr class="odd" itemsId="'+(items.length-1)+'"><td><?=$item['name']?></td><td class="count"><?=$item['count']?></td><td class="price"><?=$item['price']?></td><td class="button-column">' +
                '<a class="update" title="" rel="tooltip" href="#" itemsId="'+(items.length-1)+'" data-toggle = "modal" data-target = "#myModal_edit" data-original-title="Редактировать"><i class="icon-pencil"></i></a>' +
                '  <a class="delete" title="" rel="tooltip" href="#" itemsId="'+(items.length-1)+'" data-original-title="Удалить"><i class="icon-trash"></i></a></td></tr>');
            <? $i++; ?>
        <? endforeach ?>
        $('input[name="Order[items]"]').val(JSON.stringify(items));
        $('a.delete').on('click', function() {
            items.remove( $(this).attr('itemsId') );
            $(this).parent().parent().remove();
            $('td#itogo').text( items.getItogo() );
            $('input[name="Order[items]"]').val(JSON.stringify(items));
            return false;
        });
        $('a.update').on('click', function() {
            $("#priceAddItems_edit").val( items[$(this).attr('itemsId')]['price'] );
            $("#countAddItems_edit").val( items[$(this).attr('itemsId')]['count'] );
            currentItemId = $(this).attr('itemsId');
        });
        $('td#itogo').text( items.getItogo() );

        $('#addItemButton_edit').click(function() {
            items[currentItemId]['price'] = parseInt( $("#priceAddItems_edit").val() )*currentCoef;
            items[currentItemId]['count'] = $("#countAddItems_edit").val();
            $('input[name="Order[items]"]').val(JSON.stringify(items));

            $('table.items tbody tr[itemsId="'+currentItemId+'"] td.count').text(items[currentItemId]['count']);
            $('table.items tbody tr[itemsId="'+currentItemId+'"] td.price').text(items[currentItemId]['price']);

            $('td#itogo').text( items.getItogo() );

        });
    });

</script>



<div id="button_raschet">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'htmlOptions' => array(
            'onclick' => "js:printRaschet();",
        ),
        'label'=>'Печать расчета',
    )); ?>
</div>
<br>
<div id="button_print" style="display:block">
    <?php /* $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'htmlOptions' => array(
            'onclick' => "js:printSticker();",
        ),
        'label'=>'Печать наклейки',
    )); */ ?>
</div>
<br>
<div id="button_create">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'htmlOptions' => array(
            'onclick' => "js:$('#order-form').submit();",
        ),
        'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>
</div>
<br><br><br>
<a href="#" class="showhints">Показать\убрать заметки</a>
<div id="hints">
    <h4>По машине клиента имеются следующие заметки:</h4>
    <? foreach (Info::model()->findAllByAttributes(array('type'=>'model', 'type_id'=>$model->client->model_id)) as $info) { ?>
        <a target="_blank" href="<?=Yii::app()->createUrl('info/update', array('type'=>'model','type_id' => $model->client->model_id, 'id' => $info->id ))?>"><?=$info->name?></a>
        <br><br>
    <? } ?>
    <a target="_blank" href="<?=Yii::app()->createUrl('info/create', array('type'=>'model','type_id' => $model->client->model_id ))?>">Добавить новую заметку к модели</a>
    <h4>По модельному ряду:</h4>
    <? foreach (Info::model()->findAllByAttributes(array('type'=>'modelrow', 'type_id'=>$model->client->modelrow_id)) as $info) { ?>
        <a target="_blank" href="<?=Yii::app()->createUrl('info/update', array('type'=>'modelrow','type_id' => $model->client->modelrow_id, 'id' => $info->id ))?>"><?=$info->name?></a>
        <br><br>
    <? } ?>
    <a target="_blank" href="<?=Yii::app()->createUrl('info/create', array('type'=>'modelrow','type_id' => $model->client->modelrow_id ))?>">Добавить новую заметку к модельному ряду</a>
</div>
<br><br>    <br><br>    <br><br>    <br><br>


<div style="display: none">;
    <form action='<?=Yii::app()->createUrl('print/raschet', array() )?>' method="POST" id='raschetForm' target='_blank'>
        <input type='text' name='items' id='raschetItems'/>
        <input type='submit'/>
    </form>
</div>

<script>
    function printRaschet() {
        $('#raschetItems').val(JSON.stringify(items));
        $('#raschetForm').submit();
    }

    function printSticker() {
        window.open("http://sglubokov.ru/index.php?r=print/sticker&oil="+oilName+"&probeg="+$('input[name="mileage_next"]').val());
        //$('#button_print').hide();
        $('#button_create').show();
    }

    function changeButtons() {
        $('#button_print').show();
        $('#button_create').hide();
    }
</script>


<? $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal_edit')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Редактирование пункта</h4>
</div>

<div class="modal-body">
    <p>
        Количество:
        <?php echo CHtml::textField('count', '1', array('style' => 'width:30px', 'id' => 'countAddItems_edit' )) ?>
        <br><br>
        Цена:
        <?php echo CHtml::textField('price', '', array('style' => 'width:30px', 'id' => 'priceAddItems_edit' )) ?>
    </p>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Сохранить',
        'id' => 'addItemButton_edit',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Отмена',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    )); ?>
</div>

<?php $this->endWidget(); ?>

