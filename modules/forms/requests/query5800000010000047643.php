<?php

	switch ($_POST['usluga_form']) {
		case "1":
			require("zags/formaRO1.php");
			break;
		case "2":
			require("zags/formaRO2.php");
			break;
	}

?>