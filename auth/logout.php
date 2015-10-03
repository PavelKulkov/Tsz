<?php
  require_once("../config.inc.php");
  require_once("../config_system.inc.php");
  $authHome = new AuthHome(NULL);
  $state = $authHome->checkSession();
  if($state==1){
  	$authHome->initGuestConnection($guestUser);
  	$db = $authHome->getCurrentDBConnection();
  	DB::setInstance($db);
  	$authHome->removeAuth();
	$db->disconnect();
    header('Location: /index.php');
  }
?>