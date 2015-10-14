<?php
class Registry {
	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;	
	public $count;
	public $items_registry = array('logo','title','address','id_template','phoneNumber','E-mail','fax','President');

	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	
	function getNews($id_template){
		$sql = "SELECT * FROM `registry` WHERE `id_template`= ? ";
		$item = $this->db_instance->select($sql, $id_template);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getList($begin=0,$limit=5){
		$sql = "SELECT *  FROM `registry`";
		$item = $this->db_instance->select($sql); 
		
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getCount($is_published=0){
		$sql = "SELECT count(`id`) FROM `registry` WHERE is_published<>".$is_published;
		$this->count = $this->db_instance->getCountData($sql,'count(`id`)');
		return $this->count;
	}
	
	function getTsz($id) {
		
		$sql = "SELECT * FROM `registry` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $id);
		if(!$item) return false;
		
		return  $item;		
	}
	
	function delete($id_news){	
		$sql = "DELETE FROM `registry` WHERE `id`= ?";
		$this->db_instance->delete($sql, $id_news);
	}
	
	function save($registry_item){
		return $this->db_instance->saveData($registry_item,'registry',$this->items_registry);
	}
	
	/*
	function Time_To_Show($value) {
		$montharray = array('1' => 'Января','2' => 'Февраля','3' => 'Марта','4' => 'Апреля','5' => 'Мая','6' => 'Июня','7' => 'Июля','8' => 'Августа','9' => 'Сентября','10' => 'Октября','11' => 'Ноября','12' => 'Декабря');
		$time           = explode(' ',$value);
		$date = $time[0];
		$dateconvert = explode('-',$date);
		$year  = $dateconvert[0];
		$month = $montharray[($dateconvert[1])];
		$day   = $dateconvert[2];
		$time = $time[1];
		return $day." ".$month." ".$year." ".$time;
	}
	*/
}