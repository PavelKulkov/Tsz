<?php

switch ($_POST['applicantType']) {

case 1: 
require("infoReestr/Ur.php");
break;

case 2: 
require("infoReestr/Phys.php");
break;

}

?>