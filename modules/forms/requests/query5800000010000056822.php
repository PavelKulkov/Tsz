<?php

switch ($_POST['applicantType']) {

case "N1": 
require("landWork/Ur.php");
break;

case "N2": 
require("landWork/Ip.php");
break;

case "N3": 
require("landWork/Phys.php");
break;

}

?>