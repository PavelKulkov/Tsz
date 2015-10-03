<?php

	$text = '<form id="organisationsType" class="form-search" action="/organisations" method="POST">';
	$text .= '<p>Выбор организации по району:</p>';
	$text .= '<select name=municipal_district>';
	
	foreach ($output_params['municipal_districts'] as $entry) {
		$text .= '<option value='.$entry['id'];
		$text .= $output_params['municipal_district'] == $entry['id'] ? ' selected>' : '>';
		$text .= $entry['name'].'</option>';
	}
	
	$text .= '</select>
			<button type="submit" class="btn btn-info"><i class="icon-ok-circle icon-white"></i>Отфильтровать</button>';
	if ($output_params['municipal_filtered']){
		$text .= '<a href="/organisations" class="btn btn-danger"><i class="icon-ban-circle icon-white"></i>Сбросить фильтр</a>';
	}
	
	$text .= '</form>';
	
	if ($output_params['list']) {
		$text .= $paginator['text'];
		
		foreach ($output_params['list'] as $entry) {		
			$text .= '	<article class = "well">
							<span class="label label-info pull-right">'.$entry['type_item']['name'].'</span>
							<p><a href="/organisations?id_organisation='.$entry['id'].'">'.$entry['c_name'].'</a></p>
							<p><small>Руководитель: '.$entry['c_head'].'</small></p>
							<p><small><a href="http://'.$entry['c_web_site'].'">Официальный сайт</a></small></p>
							<p>Контактная информация: '.$entry['c_contacts'].'</p>
							<p>Автоинформатор: '.( !empty($entry['autoinformer']) ? $entry['autoinformer']: 'Не указано' ).'</p>
							<p align="right"><a class="btn btn-success" href="/organisations?id_organisation='.$entry['id'].'">Подробнее<i class="icon-chevron-right icon-white"></i></a></p>
						</article>';
		}
		
		$text .= $paginator['text'];
	} else {
		$text .= 'По вашему запросу ничего не найдено';
	}