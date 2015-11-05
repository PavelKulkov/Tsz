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
	
	$new = array('id'=>$_POST['idNews'],'title'=>$_POST['titleNews'],'date'=>date("Y-m-d H:i:s"),'annotation', 'image', 'text'=>$_POST['content'], 'keywords', 'id_template'=>1, 'is_published');
	$news -> save($new);
	$db->disconnect();
	header("Location:/news?id_news=".$_POST['idNews']."");
?>