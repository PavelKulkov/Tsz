<?php

switch ($_POST['applicantType']) {

case "N1": 
include(__DIR__."/licensePharmReformTwo/Ur.php");

break;

case "N2": 
include(__DIR__."/licensePharmReformTwo/Ip.php");
break;

}

?>