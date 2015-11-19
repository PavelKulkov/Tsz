<?php
class Questions{
	private $db_instance;
	private $request;
	public $sql;
	
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
}
?>