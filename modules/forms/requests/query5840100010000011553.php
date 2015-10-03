<?php
	switch ($_POST['usluga_form']) {
		case "1":
			require("forest/forestLegalForm.php");
			break;
		case "2":
			require("forest/forestPrivateForm.php");
			break;
	}
?>