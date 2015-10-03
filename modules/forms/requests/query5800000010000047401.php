<?php 
	  
	  if (isset($_POST['outId']) && $_POST['outId'] != "") {
		require("zags/putTimeQue.php");
	  } else {
		require("zags/putZjvZB.php");
	  }
?>