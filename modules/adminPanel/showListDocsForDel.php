<?php
	require_once("../documentation/class/Documentation.class.php");
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
	if(!isset($documentation)) $documentation = new Documentation($request, $db);
	
	$listDocs = $documentation -> getDocs();
	
	$text = '	<form method="post" action="delDocs.php" >';
	foreach ($listDocs as $doc) {
		$text .= '<input type="checkbox" name="docsForDel[]" value="'.$doc['id'].'"/>'.$doc['title'].'</br>';
	}
	$text .= '<input type="submit" value="Удалить">
			</form>';
	echo($text);
	$db->disconnect();
?>