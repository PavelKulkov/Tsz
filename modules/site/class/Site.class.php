<?php
class Site{
	private $db_instance;
	private $request;
	public $sql;
	public $count;
	//public $itemsDoc = array('title','date','name');
	
	function __construct($request=NULL,$db){
		$this->db_instance = $db;
		$this->request 	= $request;
	}
}