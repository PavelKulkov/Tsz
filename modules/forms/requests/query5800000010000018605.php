<?php

switch ($_POST['applicantType']) {

case "N1": 
require("informationRent/Ur.php");
break;

case "N2": 
require("informationRent/Ip.php");
break;

case "N3": 
require("informationRent/Phys.php");
break;

}

?>