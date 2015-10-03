<?php

switch ($_POST['applicantType']) {

case "N1": 
require("forestStudy/Ur.php");
break;

case "N2": 
require("forestStudy/Ip.php");
break;

}

?>