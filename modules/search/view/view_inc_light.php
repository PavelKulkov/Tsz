<?php
	$text = '';
	$text .= "<form id=\"searchEngine\" class=\"form-search\" action=\"/search?is_news=true&is_service=true&is_organisation=true\" method = \"GET\" onsubmit=\"if(getElementById('search_string').value=='') {alert('Поле поиска не может быть пустым!'); return false; }\">";
	$text .= '<input class="search-query" type="text" placeholder="Поиск" name="search_string" id="search_string" />';
	if (!isset($showFull)) {
	  $showFull = 'hidden';
	} else {
	  $text .= '<p>Искать по разделам:</p>';
	}
	
	$text .= '<div class="'.$showFull.'">';
	
	if ((isset($is_news)&&$is_news)||!isset($is_news)) {
		$text .= '<label class="checkbox"><input type="checkbox" name="is_news" checked> Новости </label>';
	} else {
		$text .= '<label class="checkbox"><input type="checkbox" name="is_news"> Новости </label>';
	}
	
	if ((isset($is_service)&&$is_service)||!isset($is_service)) {
		$text .= '<label class="checkbox"><input type="checkbox" name="is_service" checked> Услуги </label>';
	} else {
		$text .= '<label class="checkbox"><input type="checkbox" name="is_service"> Услуги </label>';
	}
	if ((isset($is_organisation)&&$is_organisation)||!isset($is_organisation)) {
		$text .= '<label class="checkbox"><input type="checkbox" name="is_organisation" checked> Организации </label>';
	} else {
		$text .= '<label class="checkbox"><input type="checkbox" name="is_organisation"> Организации </label>';
	}
	
	$text .= '</div>';
	
	if ($showFull != 'hidden') {
	  $text .= '<button type="submit" class="btn btn-info"><i class="icon-search icon-white"></i>Поиск</button>';
	}
	
	$text .= '</form>';
