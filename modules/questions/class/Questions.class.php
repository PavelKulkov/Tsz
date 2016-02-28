<?php
class Questions{
	private $db_instance;
	private $request;
	public $sql;
	public $itemsQuestion=array('title','answer', 'groupsQuestion');
	public $itemsGroup=array('groupsQuestion');
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
	function getAllQuestions(){
		$sql= "SELECT t1.id, t1.title, t1.answer,  t2.groupsQuestion AS groupsQuestion
		       FROM questions t1
			   LEFT OUTER JOIN groups_questions t2
			   ON t1.groupsQuestion = t2.id";
		
		
		$item  =$this->db_instance->select($sql);
		if($item)
			return $item;
		else
			return false;
	}
	function getQuestion($idQuestion){
		$sql = "SELECT * FROM `questions` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $idQuestion);
		if(!$item) return false;
		
		return  $item;		
	}
	function getGroup($idQuestion){
		$sql = "SELECT * FROM `groups_questions` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $idQuestion);
		if(!$item) return false;
		
		return  $item;		
	}
	function getGroupsQuestion(){
		$sql= "SELECT *  FROM `groups_questions`";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	function saveQuestion($question){
		return $this->db_instance->saveData($question,'questions',$this->itemsQuestion);
	}
	function saveGroup($group){
		return $this->db_instance->saveData($group,'groups_questions',$this->itemsGroup);
	}
}
?>