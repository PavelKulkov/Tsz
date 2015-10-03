<?php

switch ($_POST['applicantType']) {

case N1: 
include(__DIR__."/landWithBuildings/Ur.php");
break;

case N2: 
include(__DIR__."/landWithBuildings/Ip.php");
break;

case N3: 
include(__DIR__."/landWithBuildings/Phys.php");
break;

}

?>