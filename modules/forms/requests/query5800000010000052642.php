<?php

switch ($_POST['applicantType']) {

case "N1": 
require("forestRent/Ur.php");
break;

case "N2": 
require("forestRent/Ip.php");
break;

case "N3": 
require("forestRent/Phys.php");
break;

}

?>