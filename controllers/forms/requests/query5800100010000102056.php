<?php

switch ($_POST['applicantType']) {

case "N1": 
require("buildEnd/Ur.php");
break;

case "N2": 
require("buildEnd/Ip.php");
break;

case "N3": 
require("buildEnd/Phys.php");
break;


}

?>