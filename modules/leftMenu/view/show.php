<?php
include($modules_root."leftMenu/scripts/onCreate.js");
$menus = $leftHome->getAllMenus();

$text = '<b>Управление меню: </b><br /><br />';
$text .= '<div class="control_menu" style="margin-bottom:40px;">
<a href="/modules/auth/leftMenu?operation=new" ><img src="/templates/images/icon-32-new.png" /></a> &nbsp &nbsp
<a href="#" id="link_edit"><img src="/templates/images/icon-32-edit.png" /></a> &nbsp &nbsp
<a href="#" id="link_delete" ><img src="/templates/images/icon-32-trash.png" /></a> &nbsp &nbsp
<select name="id_template" id="id_template" style="width: 200px; margin-bottom:0px;">';
$text .= '<option value="">Выберите шаблон</option>';
foreach ($list as $key){
	$text .= '<option value="'.$key['id'].'">'.$key['description'].'</option>';
}
$text .= '</select>'."\r\n";

$text .= '<select name="id_module" id="id_module" style="width: 200px; margin-bottom:0px;">';
$text .= '<option value="">Выберите модуль</option>';
$text .= '</select>'."\r\n";

$text .= '</div>';
$text .= '<div id="menu_content">
<form action="#" id="form_operation" method = "POST">

	<table  class="table table-bordered">
		<tr>
			<td><input type="checkbox" onclick="toggleChecked(this.checked)" /></td>
			<td>
				Название
			</td>
			<td>
				Описание
			</td>
			<td>
				Подменю
			</td>
			<td>
				Вес
			</td>
			<td>
				url
			</td>
			<td>
				Шаблон
			</td>
		</tr>';

foreach ($menus as $menu) {
	$text .= '<tr>
	<td>
	<input type="checkbox" name="check_value[]" class="checkbox" value="';
	$text .= $menu['id'];
	$text .= '" /></td><td>';
	$text .= $menu['name'];
	$text .='	</td>
	<td>';
	$text .= ($menu['descr'] == NULL  || $menu['descr'] == '') ? 'Описание отсутствует' : $menu['descr'];
	$text .='	</td>
	<td>';
	$text .= ($menu['sub_menu'] != NULL) ? $menu['sub_menu'] : 'Нет';
	$text .='	</td>
	<td>';
	$text .= $menu['weight'];
	$text .='	</td>
	<td>';
	$text .= $menu['url'];
	$text .='	</td>
	<td>';
	//////////TODO: WTF???
	if(isset($menu['id_template'])){
		$template_id = $menu['id_template'];
		$descr = $leftHome->findTemplateDescription($list, $template_id);
		if(isset($descr)){
			$text.=  $descr;
		}
	}

	$text .='	</td>
	</tr>';
}

$text .= '</table>
</form>
</div>';
?>