<?php
	switch ($_POST['act']) {
		case "AZ_RO":
			require("zags/Istreb/putZjvIstrebRo.php");
			break;
		case "AZ_ZB":
			require("zags/Istreb/putZjvIstrebZB.php");
			break;
		case "AZ_RB":
			require("zags/Istreb/putZjvIstrebRB.php");
			break;
		case "AZ_UO":
			require("zags/Istreb/putZjvIstrebUO.php");
			break;
		case "AZ_US":
			require("zags/Istreb/putZjvIstrebUs.php");
			break;
		case "AZ_PI":
			require("zags/Istreb/putZjvIstrebPI.php");
			break;
		case "AZ_SM":
			require("zags/Istreb/putZjvIstrebSm.php");
			break;
	}
?>