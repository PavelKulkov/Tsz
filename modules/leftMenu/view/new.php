<?php
include($modules_root."leftMenu/scripts/newMenu.js");
$text = '<form id="add" action="/modules/auth/leftMenu?operation=save" method="POST">
<table border="0" cellpadding="3" cellspacing="0">
<tr  align="center">
<td>
Название:
</td>
<td>
Шаблон:
</td>
<td>
Модуль:
</td>
<td>
Подменю
</td>
<td>
url
</td>
</tr>
<tr>
<td>
<input type="text" name="name_menu" id="name_menu" style="height: 30px;"/>
</td>
<td>
<select name="id_template" id="id_template" style="width : 200">
<option value="">Выберите шаблон</option>';
foreach ($list as $key){
	$text .= '<option value="'.$key['id'].'">'.$key['description'].'</option>';
}
$text .='</select>
</td>
<td>
<select name="id_module" id="id_module" style="width : 200">
<option value="">Выберите модуль</option>
</select>
</td>
<td>
<select name="sub_menu" disabled="disabled" id="sub_menu" style="width : 200">
<option value="">Нет</option>
</select>
</td>
<td>
<input type="text" name="module_url" id="module_url" value="/" style="height: 30px;"/>
</td>
</tr>
<tr>
<td>
Описание<br />
<input type="text" name="descr" style="height: 30px;" /><br />
Вес<br />
<input type="text" name="weight" id="weight" value="0" style="height: 30px;" /><br />
</td>
</tr>
<tr>
<td>
<input type="submit" value="Сохранить" id="save_menu" />
</td>
</tr>
</table>
</form>';
?>