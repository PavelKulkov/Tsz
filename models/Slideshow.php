<?php
class Slideshow {

	private $db_instance;
	private $request;
	private $lng_prefix;

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	function getSlides(){
		$query = "SELECT * FROM slideshow";
		$item = $this->db_instance->select($query);
		
		return ($item) ? $item : false;
	}
}