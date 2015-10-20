<?php
	require_once("../news/class/News.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
	$db = new DB();
	DBRegInfo::initParams($guestUser[0],z
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
	$items_news = array('id'=>$_POST['id'],'title'=>$_POST['title'],'date'=>date("Y-m-d H:i:s"),'annotation'=>'', 'image'=>'', 'text'=>$_POST['text'],'is_published'=>'','id_template'=>1);
	$news -> save($items_news);
	$db->disconnect();
	header("Location:/news");
?>