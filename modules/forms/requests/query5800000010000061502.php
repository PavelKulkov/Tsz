<?php

switch ($_POST['certificationOfTeachers']) {

case "N1": 
require("teachersValidation/N1.php");
break;


case "N2": 
require("teachersValidation/N2.php");
break;


}

?>