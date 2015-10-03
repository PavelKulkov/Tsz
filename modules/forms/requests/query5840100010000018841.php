<?php

switch ($_POST['applicantType']) {

case 1: 
require("buildResiting/Ur.php");
break;

case 2: 
require("buildResiting/Phys.php");
break;

}

?>