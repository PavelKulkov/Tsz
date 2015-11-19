<?php
class PartneryAndProject {

	private $db_instance;
	private $request;
	public $sql;
	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->request 	= $request;
	}
	
	function getPartners(){
		$sql= "SELECT *  FROM `partners`";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getProjects(){
		$sql= "SELECT *  FROM `projects`";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
}