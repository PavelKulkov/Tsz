<?php 
	require_once($modules_root."registry/class/Registry.class.php");
	if(!isset($registry)) $registry = new Registry($request,$db);
	$listTsz = $registry->getList();
	
	include ($modules_root.'search/view/view_inc_default.php');
?>
	

