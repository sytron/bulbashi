<form class="well" method=POST>
    <fieldset>
        <div class="control-group">
            <label class="control-label clear" for="daterange" style="display:block; float:none;">Интервал:</label>
            <div class="controls" style="margin:0!important">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-calendar"></i></span><input type="text" name="daterange" id="daterange" value="" size="20" />
                </div>
            </div>


        </div>

        <div class="control-group "><label class="control-label" for="client">Клиент</label><div class="controls"><select name="client" id="client">
        <? foreach(Client::getArrayList() as $k => $v ) { ?>
            <option value="<?=$k?>"><?=$v?></option>
        <? } ?>
        </select></div></div>

        <div class="control-group "><label class="control-label" for="category">Категория</label><div class="controls"><select name="category" id="category">
                    <? foreach(ItemsCategory::getArrayList() as $k => $v ) { ?>
                        <option value="<?=$k?>"><?=$v?></option>
                    <? } ?>
                </select></div></div>

        <div class="control-group "><label class="control-label" for="mask">Подстрока</label><div class="controls">
                <input name="mask" id="mask" type="text"><p class="help-block">
                    </p></div></div>

        <input type="submit" value="Получить отчет">
    </fieldset>

</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#daterange').daterangepicker({format: 'DD.MM.YYYY'});
    });
</script>