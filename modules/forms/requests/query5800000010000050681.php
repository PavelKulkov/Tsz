<?php

switch ($_POST['applicantType']) {

case "N1": 
require("forestGratuitous/Ur.php");
break;

case "N2": 
require("forestGratuitous/Phys.php");
break;

}

?>