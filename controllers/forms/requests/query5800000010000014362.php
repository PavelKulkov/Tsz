<?php

switch ($_POST['applicantType']) {

case "N1": 
require("buildReassigment/Ur.php");
break;

case "N2": 
require("buildReassigment/Ip.php");
break;

case "N3": 
require("buildReassigment/Phys.php");
break;


}

?>