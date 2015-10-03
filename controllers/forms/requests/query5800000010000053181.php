<?php

switch ($_POST['applicantType']) {


case 1: 
require("licenseMedic/Ur.php");
break;

case 2: 
require("licenseMedic/Ip.php");
break;



}

?>