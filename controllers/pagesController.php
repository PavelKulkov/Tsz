<?php
include CONTROLLERS_ROOT.'newsController.php';
include MODELS_ROOT.'News.php';
include CONTROLLERS_ROOT.'mostRecentlyUsedController.php';
include MODELS_ROOT.'mostRecentlyUsed.php';
include CONTROLLERS_ROOT.'mapController.php';
include MODELS_ROOT.'Map.php';
include CONTROLLERS_ROOT.'bannersController.php';
include MODELS_ROOT.'Banners.php';
class pagesController extends AppController  {
	
	function __construct() {
		parent::__construct();
		
	}

	function index() {
		self::$model = new mostRecentlyUsed(null, self::$db);
		self::$view->init('index', 'mostRecentlyUsed');
		new mostRecentlyUsedController();
		
		if (SITE_THEME !== 'default') {
			self::$model = new Map(null, self::$db);
			self::$view->init('index', 'map');
			new mapController();
			
			self::$model = new Banners(null, self::$db);
			self::$view->init('index', 'banners');
			new bannersController();
		} else {
			self::$model = new News(null, self::$db);
			self::$view->init('last_news', 'news');
			newsController::lastNews();
		}
		
		self::$model = new Pages(null, self::$db);
		self::$view->init('index', 'pages');
		
		//self::$view->render('index');	
	}
	
}