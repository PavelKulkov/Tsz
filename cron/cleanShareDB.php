<?php 
  define('APP_ROOT_PATH', dirname(__FILE__).'/../');
  require_once(APP_ROOT_PATH."config.inc.php");
  require_once(APP_ROOT_PATH."config_system.inc.php");
  if (!isset($argv)){
  	die('Run in shell mode and get login and password params');
  }
  if (!isset($argv[1])){
  	die('missing login param');
  }  
  $_SERVER['REQUEST_URI']="/";
  echo "Starting clear with user=".$argv[1]."\r\n";
  DBRegInfo::initParams($guestUser[0],
					    $argv[1],
					    $argv[2],
	 				    "regportal_share");	
  					
  $db = new DB();
  $regInfo = DBRegInfo::getInstance();
  $db->connect($regInfo);
  $date = new DateTime();
  $fileDump = ModuleHome::getTemp()."/"."share_".$date->format('Y-m-d').".dump";
  echo "out dump = ".$fileDump."\r\n";
  exec("mysqldump -u ".$argv[1]." --password=".$argv[2]." regportal_share >".$fileDump);
  echo "DELETE auth\r\n";
  $db->query("DELETE FROM `auth`");
  echo "DELETE log\r\n";
  $db->query("DELETE FROM `log`");
  echo "DELETE events_hash\r\n";
  $db->query("DELETE FROM `events_hash` WHERE `type`=1");
  echo "disconnect\r\n";
  $db->disconnect();
?>