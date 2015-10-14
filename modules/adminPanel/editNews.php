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
	$text = '
	<form method="post" action="/modules/adminPanel/saveNews.php">';
	$text.='
        <table>
          <tr>
            <td><input type="hidden" name="idNews" value="'.$new['id'].'"/></td>
          </tr>
		  <tr>
            <td>Заголовок</td>
            <td><input type="text" name="title" value="'.$new['title'].'"/></td>
          </tr>
		  <tr>
            <td>Текст новости</td>
            <td><textarea name="text">'.$new['text'].'</textarea></td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" value="Изменить"/></td>
          </tr>                   
        </table>        
    </form>';
	
	echo($text);
	$db->disconnect();
	
?>