<?php
	require_once("../news/class/News.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
	
	$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/imageForNews/";
	$uploadfile = $uploaddir . basename($_FILES['image']['name']);

	
	move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
	
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
	$items_news = array('id'=>$_POST['idNews'],'title'=>$_POST['title'],'date'=>date("Y-m-d H:i:s"),'annotation'=>'', 
						'image'=>$_FILES['image']['name'], 'text'=>$_POST['news'],'is_published'=>'','id_template'=>1);
	$news -> save($items_news);
	$db->disconnect();
	header("Location:/news");
?>