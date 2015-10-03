<?php

class authController extends AppController  {

	function __construct() {
		parent::__construct();
	}

	function index() {
		
		global $guestUser;
		if (isset($_POST['login']) && isset($_POST['password'])) {
			$secureFile = new SecureFile();
			self::$authHome = new AuthHome($secureFile);
			self::$authHome->initAdminConnection(self::$request, $guestUser);
			self::$db = self::$authHome->getCurrentDBConnection();
			$_SESSION['admin'] = 1;
			View::setViewMode(self::$authHome->isAdminMode());
			echo '<script type="text/javascript">window.location="/"</script>';
		}
		/*
		global $guestUser;
		
		self::$authHome->initAdminConnection(self::$request, $guestUser);
		*/
		
		$text = '';
		
		if(isset($_SESSION) && isset($_SESSION['login'])){
	     	if(self::$authHome->isAdminMode()) {
	       		$text.="<a href='/auth/logout?operation=logout'>Выход ";
	     	} else {
	       		$text.="<a href='/auth/logout?operation=logout'>Выход ";
	     	}
		     //$text.=$_SESSION['login'];
	     	$text.="</a>";
	   	} else {
			$text.="<a href='/esia/module.php/core/authenticate.php?as=default-sp' class='hider'>Вход</a> ";
	   	}
		
	   	self::$module['link'] = $text;
		self::$view->setVars('admin', self::$authHome->isAdminMode());
		return self::$view->render('index');
		
	}
	

	function logout() {
		global $guestUser;
		self::$authHome = new AuthHome(NULL);
	  	$state = self::$authHome->checkSession();
	  	if($state==1){
		  	self::$authHome->initGuestConnection($guestUser);
		  	self::$db = self::$authHome->getCurrentDBConnection();
		  	DB::setInstance(self::$db);
		  	self::$authHome->removeAuth();
			self::$db->disconnect();
		    self::$request->headerLocation('');
	  	}
	}
	
}
