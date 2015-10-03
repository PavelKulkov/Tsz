<?php

switch ($_POST['applicantType']) {

case "N1": 
require("buildReclame/Ur.php");
break;

case "N2": 
require("buildReclame/Ip.php");
break;

case "N3": 
require("buildReclame/Phys.php");
break;


}

?>