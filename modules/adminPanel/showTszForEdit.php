<?php
	require_once("../registry/class/Registry.class.php");
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
	if(!isset($registry)) $registry = new Registry($request, $db);
	
	$tsz = $registry -> getTsz($_GET['idTsz']); 
	$text = '<form method="post" action="saveEditedTsz.php">
				<input type="hidden" name="idTsz" value="'.$tsz['id'].'"></br> 
				Название 
				<input type="text" name="titleTsz" value="'.$tsz['title'].'"></br> 
				Адрес
				<input type="text" name="addressTsz" value="'.$tsz['address'].'"></br>
				Номер телефона
				<input type="text" name="phoneNumberTsz" value="'.$tsz['phoneNumber'].'"></br>
				E-mail
				<input type="text" name="e-mailTsz" value="'.$tsz['E-mail'].'"></br>
				Факс
				<input type="text" name="faxTsz" value="'.$tsz['fax'].'"></br>
				Глава ТСЖ
				<input type="text" name="PresidentTsz" value="'.$tsz['President'].'"></br>
				<input type="submit" value="Изменить"></br>
			</form>
			';
	echo($text);
	$db->disconnect();
	
?>