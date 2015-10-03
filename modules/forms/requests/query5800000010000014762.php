<?php

switch ($_POST['applicantType']) {

case N1: 
include(__DIR__."/licenseTermPharm/Ur.php");
break;
 
case N2: 
include(__DIR__."/licenseTermPharm/Ip.php");
break;

}

?>