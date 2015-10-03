<?php
define('MOST_RECENTLY_USED_LIMIT',5);
$saveIncludeTime   = false;
$smevMaxPacketSize = 10000000; 
$smevService = array("localhost",7222);
$maxCertificateSize = 7000;
###################################
###	���� ������                 ###
###################################
$guestUser = array("127.0.0.1","user","pass","regportal_cms");
###################################

$debug_mode = true;
date_default_timezone_set("Europe/Kaliningrad");


$sender = array('382801','"Региональный портал государственных и муниципальных услуг Пензенской области"');
$siuRecipient = array('008201','"Комплексная система предоставления государственных и муниципальных услуг Пензенской области"');


###################################
###	���������� ����             ###
###################################

$modules_root 		= "modules/";
$temp_root 			= "tmp/";
$files_dir 			= "files/";
$template_dir 		= "templates/";
$error_log			= "../logs/error404.log";
$price_file			= "files/diler.txt";
$cache_img 		  	= "cache/img/";
$lng_prefix			= "ru";

define('MODULES_ROOT', 'modules/');
define('CONTROLLERS_ROOT', 'controllers/');
define('MODELS_ROOT', 'models/');
define('VIEWS_ROOT', 'views/');
define('TMP_ROOT', 'tmp/');
define('FILES_ROOT', 'files/');
define('TEMPLATE_ROOT', 'templates/');
define('ERROR_LOG', '../logs/error404.log');
define('PRICE_FILE', '../logs/error404.log');
define('CACHE_IMG', 'cache/img/');
define('LNG_PREFIX', 'ru');
###################################
###	�������� �� ���������       ###
###################################

$sessionName 		  = "oep";
$def_module 		  = "pages";
$def_template_id	  = "1";
$site_name 		 	  = "PGU";
//$domen = 		= "pnzgu.ru";
$admin_email 		  = "webadmin@video.ru";

define('SESSION_NAME', 'oep');
define('DEFINED_MODULE', 'pages');
define('DEFINED_TEMPLATE_ID', '1');
define('SITE_NAME', 'PGU');
define('ADMIN_EMAIL', 'webadmin@video.ru');


$image_height 		  = 200;
$image_small = 350;
$image_small_a = 65;
$image_small_th = 150;
$image_m = 550;
$image_mh = 380;
$image_banner = 50;
$image_f = 209;
$image_car = 90;
$image_pr = 150;
$image_water_font 	  = 'arial.ttf';
$catalog_image_ext 	  = 'gif';
$security 			  = false;
$item_per_page		  = 20;

$modAddPars  = array("asc", "desc","none","All");
$modSpecPars = array('title_sheet', 'link_sheet','p',"search_text");
$sessionPars = array('type_id');

##########################################
# для поиска организации по первой букве #
##########################################
$letters_rus = array('а', 'б', 'в', 'г', 'д', 'е', 'ж', 
			         'з', 'и', 'к', 'л', 'м', 'н', 'о', 
					 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 
					 'ц', 'ч', 'ш', 'щ', 'э', 'ю', 'я'
				);
?>
