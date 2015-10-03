<?php
class PartneryAndProject {

	private $db_instance;
	private $request;
	public $sql;
	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->request 	= $request;
	}

	function getListOfPartners(){
		$sql = "SELECT * FROM `pages` WHERE `name`= 'partneryAndProject'";
		$item = $this->db_instance->selectRow($sql);
		if ($item){
			return $item;
		}else{
			return false;
		}
	}
}