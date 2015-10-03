<?php
	$text = "";

	if(isset($_SESSION)&&isset($_SESSION['login'])){
    	$text .= "<div class='well'>";
     	$text .= "<br/><b>Личный кабинет</b>";
     	$text .="<br/><a href='/account'>Мои заявки</a>";
     	$text .= "</div>";
   	}
   
   	$module['text'] = $text;