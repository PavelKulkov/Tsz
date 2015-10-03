<?php

class Pass {
	private $db_instance;
	private $request;
	private $lng_prefix;
	public $items_news = array('id','content');
	
	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	
	public function saveLogin(&$password,$login){
		$this->db_instance->changeDB("regportal_share");
		$currentDate = new DateTime();
		$time = $currentDate->format("Y-m-d H:i:s");
		$salt = md5(time());
		$hash = md5($salt.$password);
		$this->db_instance->insert('INSERT INTO `user_pas` (`login`, `salt`, `hash`, `time`) VALUES (?, ?, ?, ?)', $login, $salt, $hash, $time);
		$this->db_instance->revertDB();
	}
	
	public function isLogin(&$password,$login){
		$this->db_instance->changeDB("regportal_share");
		$sql = "SELECT `hash`, `salt` FROM `user_pas` WHERE `login` = ? AND `time` = (
   					SELECT MAX(TIME) FROM `user_pas` WHERE login = ? 
  				)";
		$user_pasRow = $this->db_instance->selectRow($sql, $login, $login);
		$salt = $user_pasRow["salt"];
		$hash_db = $user_pasRow["hash"]; 
		$hash = md5($salt.$password);
		$this->db_instance->revertDB();
		return $hash == $hash_db;  
	}
	
}

?>