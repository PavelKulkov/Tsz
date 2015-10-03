<?php

switch ($_POST['applicantType']) {

case "N1": 
include(__DIR__."/licenseCopyPharm/Ur.php");

break;

case "N2": 
include(__DIR__."/licenseCopyPharm/Ip.php");
break;

}

?>