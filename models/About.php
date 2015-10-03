<?php

class About {

	private $db;
	private $request;
	private $lng_prefix;

	
	function __construct($request = NULL, $db) 	{
		$this->db = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	
	function getInfo() {
		$query = "SELECT * FROM `pages` WHERE `name`= 'about'";
		$about = $this->db->selectRow2(null, 'pages', '`name`= "about"');
		
		return (!$about) ? false : $about;
	}
	
	
	function save($contact_info){
		$items_pages = array('id', 'content');
		
		return $this->db->save($contact_info, 'pages', $items_pages);
	}
	
}

