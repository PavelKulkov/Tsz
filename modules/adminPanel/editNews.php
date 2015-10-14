<?php
	require_once("../news/class/News.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
	$db = new DB();
	DBRegInfo::initParams($guestUser[0],
	  			              $guestUser[1],
	  			              $guestUser[2],
	  			              $guestUser[3]);	  	
	  	  
	  $regInfo = DBRegInfo::getInstance();
	try{
	  	$db->connect($regInfo);
	  }catch(Exception $e){
	  	 die("DB Connection error");
	  }
	if(!isset($news)) $news = new News($request, $db);
	
	$new =  $news -> getNew($_POST['idNews']);
	$text = "Заголовок ";
	$text .='<input type="text" name="title" value="'.$new['title'].'"/>';
	$text .= "</br> ";
	$text .= "</br>  Текст новости ";
	$text .='<textarea type="textarea">'.$new['text'].'</textarea>';
	
	echo($text);
	$db->disconnect();
	
?>