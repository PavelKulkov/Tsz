<?php
	if(!(isset($form) && isset($form['content_'.SITE_THEME]))){
    $text = "Не найдено формы для данной услуги! Обратитесь в службу поддержки!";
  	} else {
    	$text = $form['content_'.SITE_THEME];
  	}