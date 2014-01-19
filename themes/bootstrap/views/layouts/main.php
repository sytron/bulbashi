<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>


	<?php Yii::app()->bootstrap->register(); ?>

    <script type="text/javascript" src="/js/moment.js"></script>
    <script type="text/javascript" src="/js/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/daterangepicker-bs2.css" />

</head>

<body>

<?php
if( Yii::app()->user->id == 'admin' ) {
    $this->widget('bootstrap.widgets.TbNavbar',array(
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(


                    array('label'=>'Заказ-наряды', 'url'=>array('/order/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Склад', 'url'=>array('/incoming/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label' => 'Работы и материалы', 'items' => array(
                        array('label'=>'Категории', 'url'=>array('/ItemsCategory/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Материалы', 'url'=>array('/item/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Связь товар-модель', 'url'=>array('/ItemsModels/index'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                    array('label' => 'Справочники', 'items' => array(
                        array('label'=>'Клиенты', 'url'=>array('/client/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Бригады', 'url'=>array('/team/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Контрагенты', 'url'=>array('/contragent/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Статьи расходов', 'url'=>array('/article/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                    array('label'=>'Отчеты', 'url'=>array('/report/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Деньги', 'url'=>array('/cashbox/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Бронь', 'url'=>array('/booking/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
        ),
    ));
} elseif( Yii::app()->user->id == 'mf' ) {
    $this->widget('bootstrap.widgets.TbNavbar',array(
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array('label'=>'Заказ-наряды', 'url'=>array('/order/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Бронь', 'url'=>array('/booking/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
        ),
    ));
} else {
    $this->widget('bootstrap.widgets.TbNavbar',array(
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(


                    array('label'=>'Заказ-наряды', 'url'=>array('/order/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Склад', 'url'=>array('/incoming/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label' => 'Работы и материалы', 'items' => array(
                        array('label'=>'Категории', 'url'=>array('/ItemsCategory/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Материалы', 'url'=>array('/item/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Связь товар-модель', 'url'=>array('/ItemsModels/index'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                    array('label' => 'Справочники', 'items' => array(
                        array('label'=>'Клиенты', 'url'=>array('/client/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Бригады', 'url'=>array('/team/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Контрагенты', 'url'=>array('/contragent/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                    array('label'=>'Отчеты', 'url'=>array('/report/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Касса', 'url'=>array('/cashbox/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Бронь', 'url'=>array('/booking/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
        ),
    ));
}

?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">

	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
