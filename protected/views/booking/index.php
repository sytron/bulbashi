<style type="text/css">
    body {
        background-color: #083a99;
    }
    h2, label, p {
        color: #fad906;
    }
    .form-actions {
        background-color: inherit;
        border-top: none;
    }

</style>

<h2>Онлайн-бронирование обслуживания</h2>


<? if( !isset($_GET['success']) ) { ?>

    <p>На данной странице Вы можете забронировать время для обслуживания Вашего автомобиля.</p>

    <? $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'horizontalForm',
        'type'=>'horizontal',
    )); ?>

    <fieldset>
        <?php echo $form->datepickerRow($model, 'day',
            array(
                'prepend'=>'<i class="icon-calendar"></i>',

                'options'=>array(
                    'language' => 'ru',
                    'format' => 'dd.mm.yyyy',
                    'autoclose' => true
                )
            )
        ); ?>

        <?php echo $form->dropDownListRow($model, 'type', array(0 => 'Выберите...', 1 => 'Замена масла и фильтров', 3 => 'Обслуживание тормозных систем' , 2 => 'Другое'),
            array(
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => $this->createUrl("Booking/getTimes"),
                    'update'=>'#Booking_time',
                ))

        ); ?>

        <?php echo $form->dropDownListRow($model, 'time', array() ); ?>

        <?php echo $form->textFieldRow($model, 'name', array( ) ); ?>

        <?php echo $form->textFieldRow($model, 'phone', array()); ?>
        <div class="control-group ">
            <div class="controls">
                <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#comment">
                    Добавить комментарий
                </button>
            </div>
        </div>


        <div id="comment" class="collapse">
            <?php echo $form->textAreaRow($model, 'comment', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>
        </div>


    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'warning', 'label'=>'Отправить заявку')); ?>
    </div>

    <?php $this->endWidget(); ?>

<? } else { ?>


    <p>Спасибо за заявку! Время забронировано, ждем Вас!</p>
    <br>
    <p><a href="http://масло-фильтр.рф" class="btn btn-warning"><i class="icon-arrow-left"></i> Обратно на сайт</a></p>

<? } ?>