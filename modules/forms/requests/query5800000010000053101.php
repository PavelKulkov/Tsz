<?php
	switch ($_POST['usluga']) {
		case "1":
			require("animalhas/animalhasLegal.php");
			break;
		case "2":
			require("animalhas/animalhasPrivate.php");
			break;
	}
?>