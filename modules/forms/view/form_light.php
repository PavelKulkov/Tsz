<?php
	if(!(isset($form) && isset($form['content_'.SITE_THEME]))){
    $text = "Не найдено формы для данной услуги! Обратитесь в службу поддержки!";
  	} else {
    	$text = $form['content_'.SITE_THEME];
  	}
  	
  	if (preg_match('/^(192.168){1}\.{1}\d{1,3}\.{1}\d{1,3}$/', $_SERVER['REMOTE_ADDR']) && !in_array($_SERVER['REMOTE_ADDR'], $ip_list)) {
  		include 'templates/virtualKeyboard.html';
  	
  	}