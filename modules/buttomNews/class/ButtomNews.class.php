<?php
class ButtomNews{
	private $db_instance;
	private $request;
	public $sql;
	public $count;
	
	function __construct($request=NULL,$db){
		$this->db_instance = $db;
		$this->request 	= $request;
	}
	function getButtomNews(){
		
		$sql= "SELECT *  FROM `news` ORDER BY `date` DESC";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
}