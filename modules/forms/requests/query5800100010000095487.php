<?php
	switch ($_POST['usluga_form']) {
		case "1":
			require("culture/formLegal.php");
			break;
		case "2":
			require("culture/formPrivate.php");
			break;
	}
