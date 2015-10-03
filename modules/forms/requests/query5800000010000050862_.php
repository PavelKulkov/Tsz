<?php
	switch ($_POST['usluga']) {
		case "1":
			require("RegArchInfo/regArchInfoLegal.php");
			break;
		case "2":
			require("RegArchInfo/regArchInfoPrivate.php");
			break;
	}
?>