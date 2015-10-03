<?php
require_once("../../config.inc.php");
require_once("../../config_system.inc.php");
$request = new HttpRequest();
$response = new HttpResponse();

$secureFile = new SecureFile();
$authHome = new AuthHome($secureFile);
$authHome->initAdminConnection($request, $guestUser);

$modules_root = "../../".$modules_root;
$template_dir = "../../".$template_dir;
$db = $authHome->getCurrentDBConnection();
$log = new Logger($db);
$moduleHome = new ModuleHome($modules_root,$db);
$domenHome = new DomenHome($request,$db);
$templateHome = new TemplateHome($db);

include("../../scripts/index.php");
$db->disconnect();
?>