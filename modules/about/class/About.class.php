<?php
class About {

	private $db_instance;
	private $request;
	private $lng_prefix;
	private $sql;
	public $items_pages = array('id','content');

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	
	function getInfo() {
		$sql = "SELECT * FROM `pages` WHERE `name`= 'about'";
		$about = $this->db_instance->selectRow($sql);
		if(!$about) return false;
		
		return  $about;
	}
	
	
	function save($contact_info){
		return $this->db_instance->save($contact_info,'pages',$this->items_pages);
	}
	
}

