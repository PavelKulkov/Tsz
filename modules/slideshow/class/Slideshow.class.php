<?php
class Slideshow {

	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	function getSlides(){
		$sql = "select * from slideshow";
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