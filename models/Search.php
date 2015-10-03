<?php

class Search {
	
	private $db;
	private $request;
	private $lng_prefix;
	
	function __construct($request = NULL, $db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	//Delete posible crap in search string
	function prepareSearchString($search_string) {
		$search_string = trim($search_string);
		$search_string = stripcslashes($search_string);
		$search_string = htmlspecialchars($search_string);
		return $search_string;
	}
	
	function search($search_string = "") {
		return $this->prepareSearchString($search_string);
	}
	
	function getLocalData() {
		
		$file = ModuleHome::getDocumentRoot().'/modules/search/local_search';
		$result = file_get_contents($file);
		echo $result;
 		exit();
	}
}