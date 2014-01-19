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

<center><h4>Расчет&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дата <?=date("d.m.Y")?></h4></center>
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

	<? foreach ($items as $item) {
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
				<span>Итого: <b><?=$itog?> руб.</b></span><br>
				<span>Без налога(НДС): <b>-</b></span><br>
								<span>Всего к оплате: <b><?=$itog?> руб.</b></span><br>
			</div>
		</td>
	</tr>
</table>



</div>

</div>

