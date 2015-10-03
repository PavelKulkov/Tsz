<?php

switch ($_POST['applicantType']) {

case "N1": 
require("ecoExpertise/Ur.php");
break;

case "N2": 
require("ecoExpertise/Phys.php");
break;

}

?>