<?php
 
if(isset($_SESSION) && isset($_SESSION['login'])){

	$text = '';
	ob_start();
	include $modules_root.'/generate/index.php';
	$text = ob_get_clean();

	include $modules_root.'/generate/view/light/index.php';
	$module['text'] = $text;

} else {
	
	echo "<script type=\"text/javascript\">"."setTimeout(function () { window.location = '/admin.html'; }, 0);  </script>";

}