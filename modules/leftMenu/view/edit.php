<?php
include($modules_root."leftMenu/scripts/editMenu.js");
$menu = $leftHome->edit();
$text = '<form id="update" action="/modules/auth/leftMenu?operation=save" method="POST">
<input type="hidden" name="id_menu" value="';
$text .= $menu['id'];
	
$text .='" />
<table border="0" cellpadding="3" cellspacing="0">
<tr  align="center">
<td>
Название:
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
<input type="text" name="name_menu" id="name_menu" value="';
$text .= $menu['name'];
$text .= '" style="height: 30px;"/>
</td>
<td>
<select name="sub_menu" id="sub_menu" style="width : 200">
<option value="">Нет</option>';
foreach ($menu['sub_menu'] as $sub)	{
	$text .= '<option value="'.$sub['id'].'"';
	$text .= ($menu['id_parent'] == $sub['id'] ? 'selected' : '' );
	$text .='>'.$sub['name'].'</option>';
}

$text .='</select>
</td>
<td>
<input type="text" name="module_url" id="module_url" value="';
$text .= $menu['url'];
$text .= '" style="height: 30px;"/>
</td>
</tr>
<tr>
<td>
Описание<br />
<input type="text" name="descr" value="';
$text .= $menu['descr'];
$text .='" style="height: 30px;" /><br />
Вес<br />
<input type="text" name="weight" id="weight" value="';
$text .= $menu['weight'];
$text .= '" style="height: 30px;" /><br />
</td>
</tr>
<tr>
<td>
<input type="submit" value="Сохранить" id="submit_update" />
</td>
</tr>
</table>
</form>';
$module['text'] = $text;
?>