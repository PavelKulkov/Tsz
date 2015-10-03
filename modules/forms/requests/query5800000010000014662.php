<?php

switch ($_POST['applicantType']) {

case "N1": 
require("licenseRestructuringPharm/Ur.php");
break;


case "N2": 
require("licenseRestructuringPharm/Ip.php");
break;


}

?>