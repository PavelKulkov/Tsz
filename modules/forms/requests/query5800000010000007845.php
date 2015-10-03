<?php

switch ($_POST['applicantType']) {

case "N1": 
require("licensePharm/Ur.php");
break;


case "N2": 
require("licensePharm/Ip.php");
break;


}

?>