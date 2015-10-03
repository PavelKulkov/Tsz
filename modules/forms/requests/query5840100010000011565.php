<?php

switch ($_POST['applicantType']) {

case "N1": 
require("expertiseForest/Ur.php");
break;

case "N2": 
require("expertiseForest/Ip.php");
break;

case "N3": 
require("expertiseForest/Phys.php");
break;

}

?>