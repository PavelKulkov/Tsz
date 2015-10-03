<?php

class Map {
	
	private $db;
	private $request;
	private $lng_prefix;

	function __construct($request = NULL, $db) 	{
		$this->db = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	
	
	function getRegionsList(){
		$sql = "SELECT * FROM `regions` ORDER BY `name`";
		$regions = $this->db->select($sql);
		
		return $regions;
	}
}