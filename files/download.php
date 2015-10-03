<?php

	$f_name = "/tmp/".$_GET['name'];

	if(file_exists($f_name)){ 

		header ("Content-Type: application/octet-stream"); 
		header ("Accept-Ranges: bytes"); 
		header ("Content-Length: ".filesize($f_name)); 
		header ("Content-Disposition: attachment; filename=".basename($f_name)); 
		echo file_get_contents($f_name); 
	}else{ 
		die("error"); 
	} 

?>
