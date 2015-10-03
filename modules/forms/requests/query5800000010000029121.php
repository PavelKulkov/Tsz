<?php
	switch ($_POST['usluga']) {
		case "1":
			require("hunt/huntLegal.php");
			break;
		case "2":
			require("hunt/huntIndividual.php");
			break;
	}
?>