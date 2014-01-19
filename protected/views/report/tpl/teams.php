
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD><meta charset="utf-8"> </head>
<BODY><FONT size=+1><B>Отчет по бригадам</B></FONT><BR><B>с <?=$a['start']?> по
    <?=$a['end']?></B><BR>Валюта: Рубли
<HR>

<TABLE borderColor=#a0a0a0 cellSpacing=0 borderColorDark=#ffffff
       borderColorLight=#a0a0a0 border=1>
    <TBODY>
    <TR align=middle bgColor=#c0c0c0>
        <TD>Запчасть</TD>
        <TD>Цена руб.</TD>
        <TD>Кол-во</TD>
        <TD>Сумма</TD>
    <? foreach( $a['out'] as $cat => $data ) : ?>
        <TR align=middle bgColor=#e0e0e0>
            <TD colSpan=4><?=$cat?></TD></TR>
        <? foreach( $data as $item ) : ?>
            <TR bgColor=#f0f0f0>
                <TD><?=$item['name']?></TD>
                <TD align=right><?=$item['price']?></TD>
                <TD align=right><?=$item['count']?></TD>
                <TD align=right><?=($item['price']*$item['count'])?></TD>
        <? endforeach ?>

    <? endforeach ?>

    <TR bgColor=#c0c0c0>
        <TD>&nbsp;</TD>
        <TD>&nbsp;</TD>
        <TD align=right><B> <?=$a['summary']['count']?> </B></TD>
        <TD align=right><B> <?=$a['summary']['money']?> </B></TD>
    </TR>
    </TBODY></TABLE><FONT size=-1><I><?=date("d.m.Y H:i")?></I></FONT> </BODY></HTML>
