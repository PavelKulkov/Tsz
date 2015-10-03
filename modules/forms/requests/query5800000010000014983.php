<?php

switch ($_POST['applicantType']) {

case "N1": 
require("duplicateHarmfulSubstances/Ur.php");
break;

case "N2": 
require("duplicateHarmfulSubstances/Ip.php");
break;

}

?>