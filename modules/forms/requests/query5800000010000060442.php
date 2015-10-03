<?php

switch ($_POST['applicantType']) {

case N1: 
include(__DIR__."/cultureSaveForMunicipal/Ur.php");
break;
 
case N3: 
include(__DIR__."/cultureSaveForMunicipal/Phys.php");
break;

}

?>