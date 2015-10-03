<?php

switch ($_POST['applicantType']) {

case "N1": 
require("technicalInspection/Ur.php");
break;

case "N2": 
require("technicalInspection/Phys.php");
break;

}

?>