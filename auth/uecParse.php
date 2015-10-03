<?php
require_once("../config.inc.php");
require_once("../config_system.inc.php");
$request = new HttpRequest();
$response = new HttpResponse();

$authHome = new AuthHome(null);
$authHome->initGuestConnection($guestUser);

$modules_root = "../".$modules_root;
$template_dir = "../".$template_dir;
$db = $authHome->getCurrentDBConnection();
$moduleHome = new ModuleHome($modules_root,$db);
$domenHome = new DomenHome($request,$db);
$templateHome = new TemplateHome($db);
$log = new Logger($db);

$snils = '';
if ( isset($_GET['snils']) && $_GET['snils'] != '' ) {
	$snils = $_GET['snils'];
}else{
 	if ( isset($_POST['snils']) && $_POST['snils'] != '' ) {	
		$snils = $_POST['snils'];
	}
}

 if ( $snils != '' ) {
	if (preg_match('/^(192.168){1}\.{1}\d{1,3}\.{1}\d{1,3}$/', $_SERVER['REMOTE_ADDR'])) {
		if (!isset($log))	$log = new Logger($db);
		$meta = "Login,".$_SERVER['REMOTE_ADDR'];
		$authHome->startSession($snils, "4");	//4 - авторизация через УЭК
		$log->info($meta, "Авторизовались через УЭК - ".$snils.", sessionType=4");
		
		echo '<script type="text/javascript">window.location="/";</script>';
	}
 } else {
	echo 'Не задан СНИЛС!';
	$log->info($meta, "Не удалось авторизоваться через УЭК - ".$snils.", отсутствует СНИЛС");
 }