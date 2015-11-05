<?php
	require_once("../registry/class/Registry.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
    
	$tszForDel = $_POST['tszForDel'];
	if(empty($tszForDel)){
		echo("Вы не выбрали не одного ТСЖ!");
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
		
	
		if(!isset($registry)) $registry = new Registry($request, $db);
		$n = count($tszForDel);
		
		for($i=0;$i<=$n;$i++){
			$registry -> deleteLogo($tszForDel[$i]);
			$registry -> delete($tszForDel[$i]);		    
		}
		$db->disconnect();
		
		//header("Location:/registry");
	}
?>