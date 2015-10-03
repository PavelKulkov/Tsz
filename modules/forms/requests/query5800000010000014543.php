<?php

switch ($_POST['applicantType']) {

case "N1": 
require("licenseDublicatePharm/Ur.php");
break;


case "N2": 
require("licenseDublicatePharm/Ip.php");
break;


}

?>