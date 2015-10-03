<?php

switch ($_POST['applicantType']) {

case "N1": 
require("landForSale/Ur.php");
break;


case "N2": 
require("landForSale/Ip.php");
break;

case "N3": 
require("landForSale/Phys.php");
break;
}

?>