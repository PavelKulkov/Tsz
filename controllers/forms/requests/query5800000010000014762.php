<?php

switch ($_POST['applicantType']) {

case 1: 
require("licenseTermPharm/Ur.php");
break;
 
case 2: 
require("licenseTermPharm/Ip.php");
break;

}

?>