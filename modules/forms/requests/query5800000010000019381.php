<?php
	switch ($_POST['usluga']) {
		case "1":
			require("workCondition/workCondLegal.php");
			break;
		case "2":
			require("workCondition/workCondPrivate.php");
			break;
	}
?>