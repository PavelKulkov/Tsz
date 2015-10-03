<?php

class News {
	
	private $db;
	private $request;
	private $lng_prefix;
	public $count;
		
	function __construct($request = NULL, $db) 	{
		$this->db = $db;
		$this->db->changeDB('regportal_cms');
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	
	function getNews($id_template){
		//$query = "SELECT * FROM `news` WHERE `id_template`= ? ";
		$item = $this->db->select2(null, 'news', '`id_template`= ?', array($id_template));
		
		return ($item) ? $item : false;
	}
	
	function getList($begin = 0, $limit = 5, $is_published = 0){
		/*
		$query = "SELECT *  FROM `news` WHERE is_published<> ? ";
		$query .= " ORDER BY `date` DESC,`id` DESC";
		$query .=" LIMIT ".$begin.", ".$limit." ";
		*/
		$item = $this->db->select2(null, 'news', 'is_published <> ?', array($is_published), '`date` DESC', $begin, $limit); 
		
		return ($item) ? $item : false;
	}
	
	function getCount($is_published = 0){
		$query = "SELECT count(`id`) FROM `news` WHERE is_published<>".$is_published;
		$this->count = $this->db->getCountData($query, 'count(`id`)');
		
		return $this->count;
	}
	
	function getNew($id) {

		$item = $this->db->selectRow2(null, 'news', '`id`= ?', array($id));
		
		return ($item) ? $item : false;	
	}
	
	function delete($id_news){	
		//$query = "DELETE FROM `news` WHERE `id`= ?";
		$this->db->delete2('news', '`id`= ?', array($id_news));
	}
	
	function save($news_item){
		$items_news = array('title','date','annotation', 'image', 'text', 'keywords', 'id_template', 'is_published');
		
		return $this->db->save($news_item, 'news', $items_news);
	}
	
	
	function Time_To_Show($value) {
		$montharray = array('1' => 'Января','2' => 'Февраля','3' => 'Марта','4' => 'Апреля','5' => 'Мая','6' => 'Июня','7' => 'Июля','8' => 'Августа','9' => 'Сентября','10' => 'Октября','11' => 'Ноября','12' => 'Декабря');
		$time           = explode(' ', $value);
		$date = $time[0];
		$dateconvert = explode('-', $date);
		$year  = $dateconvert[0];
		$month = $montharray[($dateconvert[1])];
		$day   = $dateconvert[2];
		$time = $time[1];
		
		return $day." ".$month." ".$year." ".$time;
	}
	
}