<?php

switch ($_POST['applicantType']) {

case "N1": 
require("landСategories/Ur.php");
break;


case "N2": 
require("landСategories/Ip.php");
break;


}

?>