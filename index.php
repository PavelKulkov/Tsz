<?php
require_once("config.inc.php");
require_once("config_system.inc.php");

/*
AppController::getInstance($guestUser);
*/


$request = new HttpRequest(); 				// в main пересоздал
$response = new HttpResponse(); 			// в main пересоздал

$connectTime = microtime(true);				 // main construct
$authHome = new AuthHome(NULL); 			// в main пересоздал
$authHome->initGuestConnection($guestUser); // в main пересоздал
$db = $authHome->getCurrentDBConnection(); 	// в main пересоздал
$log = new Logger($db);						// в main пересоздал
$dumper = new Dumper($db);					// в main пересоздал


/*if($dumper->checkClientOnCaptcha()){
	header('Refresh: 3; URL=/captcha.php');
	exit();
}*/

$dumper->dumpClientConnection();			// в main пересоздал

$moduleHome = new ModuleHome($modules_root,$db);	// в main пересоздал
$domenHome = new DomenHome($request,$db);			// в main пересоздал
$templateHome = new TemplateHome($db);				// в main пересоздал



include("scripts/index.php");
$log->info("Disconnect,".$_SERVER['REMOTE_ADDR'], (microtime(true) - $connectTime)); // main destruct
$db->disconnect();																	 // main destruct
