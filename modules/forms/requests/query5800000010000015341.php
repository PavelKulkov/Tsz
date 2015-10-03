<?php

switch ($_POST['applicantType']) {
	
	case 1: 
	require("taxi/taxiUr.php");
	break;
	
	case 2: 
	require("taxi/taxiIp.php");
	break;
	
}

?>