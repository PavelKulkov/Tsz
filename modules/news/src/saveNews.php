<?php
	require_once("../class/News.class.php");
	require_once("../../../config.inc.php");
	require_once("../../../config_system.inc.php");
	
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
	if($_POST['idNew']){
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files".$_POST['nameDir'];
		
		$uploadImage1 = $uploaddir . basename($_FILES['uploaded_file_news_one']['name']);
		move_uploaded_file($_FILES['uploaded_file_news_one']['tmp_name'], $uploadImage1);
		$info = pathinfo($uploadImage1);
		@rename($uploadImage1,$uploaddir."/image1".'.'.$info['extension']);
		
		$uploadImage2 = $uploaddir . basename($_FILES['uploaded_file_news_two']['name']);
		move_uploaded_file($_FILES['uploaded_file_news_two']['tmp_name'], $uploadImage2);
		$info = pathinfo($uploadImage2);
		@rename($uploadImage2,$uploaddir."/image2".'.'.$info['extension']);
			
		$uploadImage3 = $uploaddir . basename($_FILES['uploaded_file_news_three']['name']);
		move_uploaded_file($_FILES['uploaded_file_news_three']['tmp_name'], $uploadImage3);
		$info = pathinfo($uploadImage3);
		@rename($uploadImage3,$uploaddir."/image3".'.'.$info['extension']);
		
		if(!isset($news)) $news = new News($request, $db);
		
		$new = array('id'=>$_POST['idNew'],'title'=>$_POST['titleNews'],'date'=>date("Y-m-d H:i:s"),'annotation'=>'', 'image'=>$_POST['nameDir'], 'text'=>$_POST['textNews'],'is_published'=>'','id_template'=>1);
		$news ->save($new);
	}
	else{
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/News/".md5($_POST['titleNews']);
			mkdir($uploaddir);
			
			$uploadImage1 = $uploaddir ."/". basename($_FILES['uploaded_file_news_one']['name']);
			move_uploaded_file($_FILES['uploaded_file_news_one']['tmp_name'], $uploadImage1);
			$info = pathinfo($uploadImage1);
			@rename($uploadImage1,$uploaddir."/image1".'.'.$info['extension']);
			
			$uploadImage2 = $uploaddir ."/". basename($_FILES['uploaded_file_news_two']['name']);
			move_uploaded_file($_FILES['uploaded_file_news_two']['tmp_name'], $uploadImage2);
			$info = pathinfo($uploadImage2);
			@rename($uploadImage2,$uploaddir."/image2".'.'.$info['extension']);
			
			$uploadImage3 = $uploaddir ."/". basename($_FILES['uploaded_file_news_three']['name']);
			move_uploaded_file($_FILES['uploaded_file_news_three']['tmp_name'], $uploadImage3);
			$info = pathinfo($uploadImage3);
			@rename($uploadImage3,$uploaddir."/image3".'.'.$info['extension']);
			
			$path = "/News/".md5($_POST['titleNews'])."/";
		
		if(!isset($news)) $news = new News($request, $db);
		
		$new = array('title'=>$_POST['titleNews'],'date'=>date("Y-m-d H:i:s"),'annotation'=>'', 'image'=>$path, 'text'=>$_POST['textNews'],'is_published'=>'','id_template'=>1);
		$news ->save($new);
	}
	$db->disconnect();
	header("Location:/news");
?>