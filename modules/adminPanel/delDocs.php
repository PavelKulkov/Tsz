<?php
	require_once("../documentation/class/Documentation.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
    
	$docsForDel = $_POST['docsForDel'];
	if(empty($docsForDel)){
		echo("Вы не выбрали не одного документа!");
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
		
	
		if(!isset($documentation)) $documentation = new Documentation($request, $db);
		$n = count($docsForDel);
		
		for($i=0;$i<=$n;$i++){
		
			$documentation -> delete($docsForDel[$i]);
		}
		$db->disconnect();
		
		//header("Location:/registry");
	}
?>