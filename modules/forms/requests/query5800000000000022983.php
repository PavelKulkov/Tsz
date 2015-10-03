<?php
	switch ($_POST['usluga']) {
		case "1":
			require("stead/steadLegal.php");
			break;
		case "2":
			require("stead/steadIndividual.php");
			break;
		case "3":
			require("stead/steadPrivate.php");
			break;
	}
?>