<?php
class Contact{
	private $db_instance;
	private $request;
	public $sql;
	public $count;
	//public $itemsDoc = array('title','date','name');
	
	function __construct($request=NULL,$db){
		$this->db_instance = $db;
		$this->request 	= $request;
	}
	function getServices(){
		
		$sql= "SELECT *  FROM `emergency_services`";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	function getCont($id) {
		
		$sql = "SELECT * FROM `contact` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $id);
		if(!$item) return false;
		
		return  $item;		
	}/*
	function delete($idDoc){	
		$pathDoc = $_SERVER['DOCUMENT_ROOT']."/files/Docs/"; 
		$doc = $this -> getDoc($idDoc);
		$pathDoc .= $doc['name'];
		unlink($pathDoc);
		$sql = "DELETE FROM `documentation` WHERE `id`= ?";
		$this->db_instance->delete($sql, $idDoc);
	}
	
	function save($doc){
		return $this->db_instance->saveData($doc,'documentation',$this->itemsDoc);
	}*/
}