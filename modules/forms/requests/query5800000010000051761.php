<?php

switch ($_POST['applicantType']) {

case "N1": 
require("buildRegion/Ur.php");
break;

case "N2": 
require("buildRegion/Ip.php");
break;

case "N3": 
require("buildRegion/Phys.php");
break;


}

?>