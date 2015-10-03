<?php
class AuthHome {
	
	private $db;
	private $secureFile;
	private $adminMode;
	const SESSION_LIVE_TIME = 1800;  
	
	public function __construct($secureFile){
      $this->secureFile = $secureFile;
      $this->adminMode = false;
	}

	public function setCookieTheme($theme) {
		setcookie('theme', $theme);
	}
	
	public function checkSession(){
		$coonectionType = 0;
		//TODO: обраюотка если нет куков!
		if(isset($_COOKIE['PHPSESSID'])){
            if(!isset($_SESSION))
            {
			  session_start();
		    }
			//TODO: проверяем на выгоревшую сессию;
			if(isset($_SESSION['IP']) && isset($_SESSION['login'])){
				if($_SESSION['IP']==$_SERVER['REMOTE_ADDR']){
					$time = microtime(true) - $_SESSION['date'];
					if($time >=constant("AuthHome::SESSION_LIVE_TIME")){
						$coonectionType = 2;
					}else{
						$_SESSION['date'] = microtime(true);
						$coonectionType = 1;
					}
				}				
			}
		}
		return 	$coonectionType;	
	}

	
	public function removeAuth(){
	  $id = $_SESSION['ID'];
	  Logger::getInstance()->warning("Logout,ID=".$id, "Exit");
      session_destroy();
	}
	
	public function initAdminConnection($request,$guestUser){
	  $db = false;
	  $dbRegInfo = false;
	  $db = new DB();
	  $saveToSecureFile = false;
	  $connectionState = $this->checkSession();
	  $inited = false;
	  
	  if($_SERVER['REQUEST_URI']=='/modules/auth/logout'){
// 	  if($_SERVER['REQUEST_URI']=='/auth/logout'){
	  	$this->initGuestConnection($guestUser);
	  	DB::setInstance($this->getCurrentDBConnection());
	  	$this->removeAuth();
	  	echo "Сессия завершена успешно!";
	  	header('Content-Type: text/html; charset=utf-8');
	  	header('Refresh: 3; URL=/index.php');
	  	exit();
	  }
	  if($connectionState==2){
	  	$this->initGuestConnection($guestUser);
	  	DB::setInstance($this->getCurrentDBConnection());
	  	$this->removeAuth();	  	
	  	echo "Авторизация была завершена по таймауту!";
	  	header('Content-Type: text/html; charset=utf-8');
	  	header('Refresh: 3; URL=/index.php');
	  	exit();	  	
	  }	

	  $path = $request->getSelectedModule();
	  $login = "";
	  $password = "";
	  
	  //Ветка администратора! Доступна только для определенного IP
	  if(strpos($_SERVER['REQUEST_URI'], '/modules/auth/')==0){
// 	  if(strpos($_SERVER['REQUEST_URI'], '/auth/')==0){
	  	if(isset($_SESSION) && isset($_SESSION["dbConfFile"])){
	  	  $dbConf   = $this->secureFile->loadFromSession();
	  	  $login    = $dbConf[0];
	  	  $password = $dbConf[1];
	  	}else{
	  	  if(!isset($_POST['login']) || $_POST['login']==null || $_POST['login']==""){
	  		echo "Не задано имя пользователя";
	  		header('Content-Type: text/html; charset=utf-8');
	  		header('Refresh: 3; URL=/admin.html');
	  		exit();
	  	  }
	  	  $saveToSecureFile = true;
	  	  $login    = $_POST['login'];
	  	  $password = $_POST['password'];
	  	  unset($_POST['login']);
	  	  unset($_POST['password']);
	  	}
	  	$this->adminMode = true;
	  	DBRegInfo::initParams($guestUser[0],
	  			              $login,
	  			              $password,
	  			              $guestUser[3]);	  	
	  }	  
	  $regInfo = DBRegInfo::getInstance();
	  try{
	  	$db->connect($regInfo);
	  	$this->db = $db;
	  }catch(Exception $e){
	  	 die("DB Connection error");
	  }
	  if($saveToSecureFile){
	  	$data = $this->secureFile->save($login,$password);
        $this->startSession($login,"0");
	  	$_SESSION["dbConfFile"] = $data;
	  }
	}
	
	
	public function startSession($login,$type){
		if(!isset($_SESSION)){
			session_start();
		}	
		$_SESSION["login"] = $login;
		$_SESSION["IP"] = $_SERVER['REMOTE_ADDR'];
		$_SESSION["date"] = microtime(true);
        $_SESSION["type"] = $type;
		$id = $this->saveAuth();
		$_SESSION["ID"] = $id;
	}
	
	
	public function saveAuth(){
	    $this->db->changeDB("regportal_share");
        $fields['type'] = $_SESSION["type"];
	    $fields['startTime'] = "now()";
        $fields['passInfo'] = "'".$_SESSION["login"]."'";	  
		$id = $this->db->insertRowIntoTable('auth', $fields);
		$this->db->revertDB();						
		return $id;
	}
	
	
	public function initGuestConnection($guestUser){
		
		DBRegInfo::initParams($guestUser[0],
				              $guestUser[1],
				              $guestUser[2],
				              $guestUser[3]);
		$regInfo = DBRegInfo::getInstance();
		$db = new DB();
		try{
		  $db->connect($regInfo);
		}catch(Exception $e){
		  die("DB Connection error");
		}
		$this->db = $db;
		$connectionState = $this->checkSession();
		if($connectionState==1){
		  //For ESIA
		  if(!isset($_SESSION['ID'])){
		    $id = $this->saveAuth();
			$_SESSION['ID'] = $id;
		  }
		}
		if($connectionState==2){
			DB::setInstance($this->getCurrentDBConnection());
			$this->removeAuth();
			echo "Авторизация была завершена по таймауту!";
			header('Content-Type: text/html; charset=utf-8');
			header('Refresh: 3; URL=/index.php');
			exit();
		}
	}
	
	
	public function getCurrentDBConnection(){
	  return $this->db;	
	}
	
	
	public function isAdminMode(){
	  return $this->adminMode;	
	}
	
}
?>