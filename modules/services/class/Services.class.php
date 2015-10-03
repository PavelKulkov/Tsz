<?php
class Services {

	private $db_instance;
	private $request;
	public $sql;
	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->request 	= $request;
	}

	function getListOfServices(){
		$sql = "SELECT * FROM `pages` WHERE `name`= 'services'";
		$item = $this->db_instance->selectRow($sql);
		if ($item){
			return $item;
		}else{
			return false;
		}
	}

}