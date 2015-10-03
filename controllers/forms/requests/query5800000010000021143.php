<?php

switch ($_POST['applicantType']) {
	
	case 1: 
	require("arenda/arendaUr.php");
	break;
	
	case 2: 
	require("arenda/arendaIp.php");
	break;
	
	case 3: 
	require("arenda/arendaPhys.php");
	break;
}

?>