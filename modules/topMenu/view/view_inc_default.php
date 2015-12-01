<?php

	$text = '';
	$text .= '<ul class="top_menu">';
	$i = 0;	
	
	if($topMenuList['menu_part'] && count($topMenuList['menu_part']) > 0) {
		$ij = 1;
		foreach ($topMenuList['menu_part'] as $item) {
			if (strpos($item['url'], 'account') !== false) {

				continue;
			}
			if ($i == (count($topMenuList['menu_part']) - 1)) {
				$bg = 'bg2';
			} elseif ($i == (count($topMenuList['menu_part']) - 3)) {
				$bg = 'bg3';
			}  elseif ($i == (count($topMenuList['menu_part']) - 2)) {
				$bg = '';
			} else {
				$bg = 'bg1';
			}
			
				$text .= '<li id="select_'.$ij.'" ><a href="'.$item['url'].'">'.$item['name'].'</a></li>';
				$i++;
			$ij++;
		}
	}
	
	
	$text .= '</ul>';

	
	if(isset($_SESSION)&&isset($_SESSION['login'])){
		if($topMenuList['menu_part'] && count($topMenuList['menu_part']) > 0) {
			foreach ($topMenuList['menu_part'] as $item) {
				if (strpos($item['url'], 'account') !== false) {
					$text .= '<div class="current_cab"><a href="/account">Мой кабинет</a></div>';
				}
			}
		}
	}
	
	//print_r($topMenuList);
	if(isset($topMenuList['link']) && count($topMenuList['link']) > 0) {
		foreach ($topMenuList['link'] as $item) {
			$text .= '<div class="enter" '.( (isset($_SESSION)&&isset($_SESSION['login'])) ? 'style="margin-left: 0px;"' : '' ).'>'.$item.'</div>';
		}
	} else {
		$text .= '';
	}
	
	
	