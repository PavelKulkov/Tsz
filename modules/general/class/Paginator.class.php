<?php
class Paginator {

	private $order = "DESC";
	private $adminMode;
	private $root;
	private $style;
	private $join;
	private $isAddParams;

	function __construct($request=NULL,$db, $table, $limit=1000, $adminMode = false) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
		$this->limit = $limit;
		$this->table = $table;
		$this->adminMode = $adminMode;
		$this->root = preg_replace('/class/', '', dirname(__FILE__));
		$this->style = 'default';
		$this->join = "";
		$this->isAddParams = true;
	}
	
	function setStyle($style) {
		$this->style = $style;
		
	}

	function setAddParams($isAdd) {
		$this->isAddParams = $isAdd;	
	}

	function getPaginator($request, $need_href=NULL, $count, $coming_pages = 2) {
		$cur_page_num = 1;
		$param_name = 'page_num';
		if ($this->request->hasValue($param_name)) {
			$cur_page_num = $this->request->getValue($param_name);
		}
		$page_count = ceil($count/$this->limit);
		$index =  $this->limit*($cur_page_num - 1);
		//paginator {
		$i=1;

		unset($_GET[$param_name]);
		if(isset($need_href)&&isset($_GET['url'])){
			if ($this->adminMode){
				$need_href = "/modules/auth/".$_GET['url'];
			}else{
				$need_href = "/".$_GET['url'];
			}
		}
		unset($_GET['url']);
		$sign = '?';
		if(count($_GET)>0 && $this->isAddParams){
			foreach($_GET as $key => $value) {
				$need_href .= $sign.$key."=".$value;
				$sign = '&';
			}
		}
		$href = $need_href.$sign.$param_name;

		$pervpage = "";
		$nextpage = "";
		$pageLeft = "";
		$pageRight = "";
		
		$firstPageHref = $href."=1";
		$pervpageHref = $href."=".($cur_page_num - 1);
		$nextpageHref = $href."=".($cur_page_num + 1);
		$endPageHref = $href."=".$page_count;
		$prevHrefs = array();$nextHrefs = array();
		$j = 0;
		$k = 0;
		// Находим ближайшие станицы с обоих краев, если они есть
		for ($i = $coming_pages; $i >= 1 ; $i--) {
			if($cur_page_num - $i > 0) $prevHrefs[$j++] = ($cur_page_num - $i);;
			if($cur_page_num + $i <= $page_count) $nextHrefs[$k++]	=  ($cur_page_num + $i);;
		}
		
		$needEndPageHref = $cur_page_num + $coming_pages < $page_count;
		$needDots = $cur_page_num + $coming_pages < $page_count - 1;
		//echo $this->root.'/view/view_inc_'.$this->style.'.php';
		ob_start();
		include $this->root.'view/view_inc_'.$this->style.'.php';
		$paginatorText = ob_get_clean();
		// }  ---end paginator

		$paginator = array('text' => $paginatorText, 'index' => $index);
		
		return $paginator;
	}


	function getCountGlobal($where=" "){
		$sql = "SELECT count(`".$this->table."`.`id`) FROM `".$this->table."` ";
		$count = $this->db_instance->getCountData($sql,'count(`'.$this->table.'`.`id`)');
		return $count;
	}

	function setJoinTable($join){
	  $this->join = $join;
	}
	

	function setOrder($order){
		if($order) $this->order="DESC"; else $this->order="ASC";
	}

	function getListGlobal($begin=0,$fieldName, $where=" "){
		$order = (!isset($fieldName) || !empty($fieldName)) ? $fieldName."` ".$this->order : ' `id` DESC' ;
		$sql = "SELECT `".$this->table."`.*  FROM `".$this->table."` ";
		$sql .= " ORDER BY `".$order;
		$sql .=" LIMIT ".$begin.", ".$this->limit." ";
		$item = $this->db_instance->select($sql);
		
		if(!$item) return false;

		return  $item;

	}

	function getListSql($begin=0, $sql, $fieldName){
		if (isset($sql))
		{
			$order = (!isset($fieldName) || !empty($fieldName)) ? $fieldName." ".$this->order : ' `id` DESC' ;
			$sql .= " ORDER BY ".$order;
			$sql .=" LIMIT ".$begin.", ".$this->limit." ";

			$item = $this->db_instance->select($sql);
			//die(print_r($item));
			if(!$item) return false;
			return  $item;
		}
		else
			return false;

	}

	function getCountSql($sql){
		if (isset($sql))
		{
			$count = $this->db_instance->getCountData($sql,'count(`id`)');
			return $count;
		}
		else
			return false;
	}
}