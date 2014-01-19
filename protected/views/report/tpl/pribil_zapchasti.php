
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><meta charset="utf-8"> </head>
<BODY><FONT size=+1><B>Прибыль - запчасти</B></FONT><BR><B>с <?=$a['start']?> по
    <?=$a['end']?></B><BR>Валюта: Рубли
<HR>

<TABLE borderColor=#a0a0a0 cellSpacing=0 borderColorDark=#ffffff
       borderColorLight=#a0a0a0 border=1>
    <TBODY>
    <TR align=middle bgColor=#c0c0c0>
        <TD>Запчасть</TD>
        <TD>Закупка</TD>
        <TD>Продажа</TD>
        <TD>Кол-во</TD>
        <TD>Сумма<BR>закупки</TD>
        <TD>Сумма<BR>продажи</TD>
        <TD>Сумма<BR>прибыли</TD>
        <TD>% прибыли</TD></TR>

    <? foreach( $a['out'] as $cat => $data ) : ?>
        <TR align=middle bgColor=#e0e0e0>
            <TD colSpan=8><?=$cat?></TD></TR>
        <? foreach( $data as $item ) : ?>
            <TR bgColor=#f0f0f0>
                <TD><?=$item['name']?></TD>
                <TD align=right><?=round($item['priceZ'],2)?></TD>
                <TD align=right><?=$item['price']?></TD>
                <TD align=right><?=$item['count']?></TD>
                <TD align=right><?=round($item['priceZ']*$item['count'],2)?></TD>
                <TD align=right><?=round($item['price']*$item['count'],2)?></TD>
                <TD align=right><?=round(($item['price']*$item['count'])-($item['priceZ']*$item['count']), 2)?></TD>
                <TD align=right><?=round( ((($item['price']*$item['count'])-($item['priceZ']*$item['count']))/($item['price']*$item['count']+0.0000001))*100 , 2)?>%</TD></TR>
        <? endforeach ?>

    <? endforeach ?>

    <TR bgColor=#c0c0c0>
        <TD>&nbsp;</TD>
        <TD>&nbsp;</TD>
        <TD>&nbsp;</TD>
        <TD align=right><B>1</B></TD>
        <TD align=right><B>0</B></TD>
        <TD align=right><B> <?=$a['summary']['count']?> </B></TD>
        <TD align=right><B> <?=$a['summary']['money']?> </B></TD>
        <TD>&nbsp;</TD></TR>
    </TR>
    </TBODY></TABLE><FONT size=-1><I><?=date("d.m.Y H:i")?></I></FONT> </BODY></HTML>
