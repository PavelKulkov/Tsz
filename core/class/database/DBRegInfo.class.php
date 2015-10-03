<?php
class DBRegInfo
{
	#################################
	###	Параметры соединения с БД ###
	#################################
	//	Хост БД
	private $dbHost;
	//	Пользователь БД
	private $dbUser;
	//	Пароль БД
	private $dbPasswd;
	// База данных
	private $dbName;
	private static $instance;

	public function __construct()
	{}	
	
	
	public static function initParams($dbHost,$dbUser,$dbPasswd,$dbName) {
		$info = self::getInstance();
		$info->dbHost = $dbHost;
		$info->dbUser = $dbUser;
		$info->dbPasswd = $dbPasswd;
		$info->dbName = $dbName;
		return true;				
	}	
	
	public static function getInstance() {
		if(!(strpos($_SERVER['REQUEST_URI'],"/index.php")==0 || $_SERVER['REQUEST_URI']=="/")){
		  return false;	
		}
		if (!isset(self::$instance)) {
			self::$instance = new DBRegInfo();
		}
		return self::$instance;
	}
	
	public function createConnection(){
		$handle = mysqli_connect($this->dbHost, 
				                 $this->dbUser, 
				                 $this->dbPasswd);
		if (mysqli_connect_errno()) throw new DbException($this->exeption);
		if (!$handle->select_db($this->dbName)) throw new DbException("Не возможно переключиться на БД " + $this->dbName);

		$res = $handle->set_charset('utf8');
		$handle->query ("set character_set_client=utf8");
		$handle->query ("set character_set_results='utf8'");
		$handle->query ("set collation_connection='utf8_general_ci'");
		//$handle->query ("SET NAMES binary");
		
		return $handle;	  	
	}
	
	public function setDBHost($dbHost){
	  $this->dbHost = $dbHost;	
	}

	public function setDBUser($dbUser){
		$this->dbUser = $dbUser;
	}	
	
	public function setDBPasswd($dbPasswd){
		$this->dbPasswd = $dbPasswd;
	}

	public function setDBName($dbName){
		$this->dbName = $dbName;
	}	
	
	public function getDBName(){
		return $this->dbName;
	}
	
}
?>