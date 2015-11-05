<?php
	require_once("../news/class/News.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
    
	$newsForDel = $_POST['newsForDel'];
	if(empty($newsForDel)){
		echo("Вы не выбрали не одну новость!");
	}
	else{
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
		$n = count($newsForDel);
		for($i=0;$i<=$n;$i++){
			$news -> deleteLogo($newsForDel[$i]);
			$news -> delete($newsForDel[$i]);	
		}
		$db->disconnect();
		header("Location:/news");
	}
?>