<?php
	
	$text = '	<table id="topMenu">
					<tr>';
					if($topMenuList['menu_part'] && count($topMenuList['menu_part']) > 0) {
						foreach ($topMenuList['menu_part'] as $item) {
							$text .= '<td><a href="'.$item['url'].'">'.$item['name'].'</a></td>';
						}
					}
					if($topMenuList['link'] && count($topMenuList['link']) > 0) {
						foreach ($topMenuList['link'] as $item) {
							$text .= '<td>'.$item.'</td>';
						}
					}
	$text .= '		</tr>
				</table>';