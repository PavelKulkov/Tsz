<?php

switch ($_POST['applicantType']) {

case N1: 
include(__DIR__."/noticeRegistration/Ur.php");
break;
 
case N2: 
include(__DIR__."/noticeRegistration/Ip.php");
break;

}

?>