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
	
	$listNews = $news -> getList();
	
	$text = '	<form method="post" action="delNews.php" >';
	foreach ($listNews as $entry) {
		$text .= '<input type="checkbox" name="newsForDel[]" value="'.$entry['id'].'"/>'.$entry['title'].'</br>';
	}
	$text .= '<input type="submit" value="Удалить">
			</form>';
	echo($text);
	$db->disconnect();
	//header("Location:/news");
?>