<?php
class Documentation{
	private $db_instance;
	private $request;
	public $sql;
	public $count;
	public $itemsDoc = array('title','date','groupOfDocs','Name');
	public $itemsGroup = array('groupOfDoc','image');
	
	function __construct($request=NULL,$db){
		$this->db_instance = $db;
		$this->request 	= $request;
	}
	function getDocs(){
		$sql= "SELECT `doc`.`id` AS `idDoc`,`doc`.`title` AS `title`,`doc`.`date` AS `date`,`doc`.`groupOfDocs` AS `groupOfDocs`,`doc`.`Name` AS `Name`,`god`.`id` AS `idGroup`,`god`.`groupOfDoc` AS `groupOfDoc`,`god`.`image` AS `image` FROM  `documentation` AS  `doc`
			LEFT JOIN  `groups of documents` AS  `god` ON  `god`.`id` =  `doc`.`groupOfDocs` 
			LIMIT 0 , 50";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	function getDoc($id) {
		
		$sql = "SELECT * FROM `documentation` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $id);
		if(!$item) return false;
		
		return  $item;		
	}
	function deleteDoc($idDoc){	
		
		$pathDoc = $_SERVER['DOCUMENT_ROOT']."/files/Docs/"; 
		$doc = $this -> getDoc($idDoc);
		$pathDoc .= $doc['name'];
		
		@unlink($pathDoc);
		
		$sql = "DELETE FROM `documentation` WHERE `id`= ?";
		$this->db_instance->delete($sql, $idDoc);
	}
	
	function saveDoc($doc){
		return $this->db_instance->saveData($doc,'documentation',$this->itemsDoc);
	}
	function getGroupsOfDocs(){
		$sql = 'SELECT * FROM `groups of documents`';
		$item  =$this->db_instance->select($sql);
		if($item)
			return $item;
		else
			return false;
	}
	function getGroup($idGroup){
		$sql = "SELECT * FROM `groups of documents` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $idGroup);
		if(!$item) return false;
		
		return  $item;		
	}
	function saveGroup($group){
		return $this->db_instance->saveData($group,'groups of documents',$this->itemsGroup);
	}
	function deleteGroup($idGroup){	
		$sql = "DELETE FROM `groups of documents` WHERE `id`= ?";
		$this->db_instance->delete($sql, $idGroup);
	}
}