<?php
class Questions{
	private $db_instance;
	private $request;
	public $sql;
	public $itemsQuestion=array('title','answer');
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->request 	= $request;
	}
	
	function getQuestions(){
		$sql= "SELECT *  FROM `questions`";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getQuestion($idQuestion){
		$sql = "SELECT * FROM `questions` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $idQuestion);
		if(!$item) return false;
		
		return  $item;		
	}	
	function saveQuestion($question){
		return $this->db_instance->saveData($question,'questions',$this->itemsQuestion);
	}
}
?>