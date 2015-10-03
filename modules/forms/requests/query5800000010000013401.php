<?php

switch ($_POST['applicantType']) {

case "N1": 
require("issueHarmfulSubstances/Ur.php");
break;

case "N2": 
require("issueHarmfulSubstances/Ip.php");
break;

}

?>