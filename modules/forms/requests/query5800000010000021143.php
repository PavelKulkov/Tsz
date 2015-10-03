<?php

switch ($_POST['applicantType']) {
	
	case "N1": 
	require("arenda/arendaUr.php");
	break;
	
	case "N2": 
	require("arenda/arendaIp.php");
	break;
	
	case "N3": 
	require("arenda/arendaPhys.php");
	break;
}

?>