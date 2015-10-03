<?php

switch ($_POST['applicantType']) {

case N1: 
include(__DIR__."/properyForFree/Ur.php");
break;

case N2: 
include(__DIR__."/properyForFree/Ip.php");
break;

case N3: 
include(__DIR__."/properyForFree/Phys.php");
break;

}

?>