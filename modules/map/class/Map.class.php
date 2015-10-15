<?php

class Map {
	
	private $db_instance;
	private $request;
	public $sql;

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->request 	= $request;
	}
	
	function getMap(){
		$sql = "SELECT * FROM `pages` WHERE `name`= 'map'";
		$item = $this->db_instance->selectRow($sql);
		if ($item){
			return $item;
		}else{
			return false;
		}
	}

	/*function getRequest(){
		$sql = "SELECT * FROM `request`";
		$item = $this->db_instance->selectRow($sql);
		$res = mysql_query($item);

	    $mas = array();
	    while($row = mysql_fetch_array($res)){
		    $mas[] = array("id" => $row["id"], "text" => $row["text"]);
	    }
		echo json_encode($mas);			
	}*/
}