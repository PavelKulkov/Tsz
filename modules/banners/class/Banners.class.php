<?php
class Banners {
	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;
	public $count;
	public $items_news = array('title','date','annotation', 'image', 'text', 'keywords', 'id_template', 'is_published');

	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
}