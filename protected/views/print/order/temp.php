<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<div style="width:1000px;margin:0 auto;">

<h3>ООО "Масло+"</h3>
<table>
	<tr>
		<td align="right">ИНН/КПП&nbsp;&nbsp;</td>
		<td align="left">7802769361</td>
	</tr>
	<tr>
		<td align="right">Адрес&nbsp;&nbsp;</td>
		<td align="left">СПб, ул. Доблести 19а</td>
	</tr>
	<tr>
		<td align="right">Тел.&nbsp;&nbsp;</td>
		<td align="left">+79211887219</td>
	</tr>
</table>

<center><h4>Заказ-наряд №<?=$order->id?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дата <?=date("d.m.Y")?></h4></center>
<table width="100%">
	<tr>
		<td width="50%">
			<table width="100%">
				<tr>
					<td align="right">Клиент</td>
					<td align="left"><?=$order->client->name?></td>
				</tr>
				<!--<tr>
					<td align="right">Адрес</td>
					<td align="left">проспект стачек дом собаче</td>
				</tr>
				<tr>
					<td align="right">Тел</td>
					<td align="left">123234345</td>
				</tr>-->
			</table>
		</td>
		<td width="50%">
			<table width="100%">
				<tr>
					<td align="right">Автомобиль</td>
					<td align="left"><?=$order->client->CarName?></td>
				</tr>
				<tr>
					<td align="right">Гос.номер</td>
					<td align="left"><?=$order->client->gosnomer?></td>
				</tr>
				<tr>
					<td align="right">VIN</td>
					<td align="left"><?=$order->client->vin?></td>
				</tr>
				<!--<tr>
					<td align="right">№ двигателя</td>
					<td align="left"></td>
				</tr>
				<tr>
					<td align="right">Цвет</td>
					<td align="left"></td>
				</tr>-->
				<tr>
					<td align="right">Пробег</td>
					<td align="left"><?=$order->client->mileage?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br>
<div>
<table width="100%" border="1">
	<tr>
		<td>
			№
		</td>
		<td>
			Товары (работы, услуги)
		</td>
		<td>
			Кол-во
		</td>
		<td>
			Ед.
		</td>
		<td>
			Цена
		</td>
		<td>
			Сумма
		</td>
	</tr>
	<? $i = 0; ?>

	<? foreach ($order->items as $item) { 
		$i++; 
	?>
		<tr>
			<td>
				<?=$i?>
			</td>
			<td>
				<?=$item['name']?>
			</td>
			<td>
				<?=$item['count']?>
			</td>
			<td>
				
			</td>
			<td>
				<?=$item['price']?>
			</td>
			<td>
				<?=$item['price']*$item['count']?>
			</td>
		</tr>	
	<? } ?>
	
	
		<tr >
		<td colspan="6">
			<div style="text-align:right;">
				<span>Итого: <b><?=$order->cost?> руб.</b></span><br>
				<span>Без налога(НДС): <b>-</b></span><br>
								<span>Всего к оплате: <b><?=$order->cost?> руб.</b></span><br>
			</div>
		</td>
	</tr>
</table>



</div>

<b>Всего наименований <?=count($order->items)?>, на сумму <?=$order->cost?> руб.</b>

<br><br>
Автомобиль из ремонта получил.
<br>
Претензий по качеству выполненных работ и замененных запчастей не имею.

<br><br>
Подпись клиента ______________/ ______________ /  М.П.  Подпись исполнителя ______________ / ______________ /

<? if( !empty($order->advice) ) : ?>
    <br><br><br><br>
    <h3>Рекомендации:</h3>
    <p><?=$order->advice?></p>
<? endif ?>


</div>

