<?php

switch ($_POST['applicantType']) {

case 1: 
require("reestr/reestrUr.php");
break;

case 2: 
require("reestr/reestrPhys.php");
break;

}

?>