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
	
	$new = $news -> getNew($_GET['idNews']); 
	$text = '<form method="post" action="saveEditedNews.php">
				<input type="hidden" name="idNews" value="'.$new['id'].'"></br> 
				Заголовок
				<input type="text" name="titleNews" value="'.$new['title'].'"></br> 
				Текст новости
				<textarea name="content">'.$new['text'].'</textarea></br>
				Опубликовать
				<input type="checkbox" name="isPublished"></br>
				<input type="submit" value="Изменить"></br>
			</form>
			';
	echo($text);
	$db->disconnect();
	
?>