<?php
class PartneryAndProject {

	private $db_instance;
	private $request;
	public $sql;
	public $items=array('image','title','text','site');
	
	
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
	function getPartner($idPartner){
		
		$sql = "SELECT * FROM `partners` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $idPartner);
		if(!$item) return false;
		
		return  $item;		
	}
	function savePartner($partner){
		return $this->db_instance->saveData($partner,'partners',$this->items);	
	}
	function deletePartner($idPartner){
		$sql = "DELETE FROM `partners` WHERE `id`= ?";
		$this->db_instance->delete($sql, $idPartner);
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
	function getProject($idProject){
		
		$sql = "SELECT * FROM `projects` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $idProject);
		if(!$item) return false;
		
		return  $item;		
	}
	function saveProject($project){
		return $this->db_instance->saveData($project,'projects',$this->items);	
	}
}