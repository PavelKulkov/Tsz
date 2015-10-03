<?php

switch ($_POST['applicantType']) {

case "N1": 
require("buildPlanLand/Ur.php");
break;


case "N2": 
require("buildPlanLand/Ip.php");
break;

case "N3": 
require("buildPlanLand/Phys.php");
break;

}

?>