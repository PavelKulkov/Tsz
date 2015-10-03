<?php
class Search {
	
	private $db_instance;
	private $request;
	private $lng_prefix;
	private $is_selected;
	private $is_selected_real;
	public $count;
	public $id_menu;
	private $list;
	private $searchString;
	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
		$this->list		= null;
		$this->id_menu 	= null;
	}
	//Delete posible crap in search string
	function prepareSearchString ($search_string){
		$search_string = trim($search_string);
		$search_string = stripcslashes($search_string);
		$search_string = htmlspecialchars($search_string);
		$this->searchString = $search_string;
		return $search_string;
	}
	
	function search ($search_string = "")
	{
	    
		return $this->prepareSearchString($search_string);
	}
	
	function getLocalData() {
		
		$file = ModuleHome::getDocumentRoot().'/modules/search/local_search';
		$result = file_get_contents($file);
		echo $result;
 		exit();
	}
	
	
	function createFilter($table){
	  $search_string = $this->searchString;
	  $condition = "MATCH ";
	  $fields = "";
	  switch($table){
	    case "service":{
		  $fields = "s_name,s_short_name";
		  break;
		}
		case "company":{
		  $fields = "c_name";
		  break;
		}
		case "news":{
		  $fields = "title,annotation";
		}
	  }
	  if(isset($this->district)){
	    $district = $this->district;
	    if($district!=""){
		  if($table!="news"){
		    $condition = " municipal_district=".$district." AND ".$condition;
		  }
		}
	  }
	  $condition = "WHERE ". $condition ."(".$fields.") AGAINST('".$search_string."')";
      return $condition;
	}
	
	function setDistrict($district){
	  $this->district = $district;
	}
	
}
?>