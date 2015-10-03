<?php
class Pages {

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

	
	function getInfo($action) {
		$sql = "SELECT * FROM `pages` WHERE `name`= 'about'";
		$about = $this->db_instance->selectRow($sql);
		if($about) {
			return  $about;
		}
		else {
			return false;
		}
	}
	
	
	function save($contact_info){
		return $this->db_instance->saveData($contact_info,'pages',$this->items_pages);
	}
	
	function serviceCategories() {
		$moduleHome = new ModuleHome($this->request, $this->db_instance);
		$fileName = $moduleHome->getTemp()."/service_categories.html";
		if(!is_file($fileName)){
			$categories =  $this->db_instance->select("SELECT sc.id, sc.category, sc.image, r.eng_socr 
														FROM `service_categories` sc
														LEFT JOIN `recipient` r
														ON sc.recipient_id = r.id
														ORDER BY eng_socr DESC, category ASC"
												);
			$file = serialize($categories);
			file_put_contents($fileName, $file);
		} else {
			$file = file_get_contents($fileName);
			$categories = unserialize($file);
		}
		
			
		$categories_items = array();
		foreach ($categories as $category) {
			if ($category['eng_socr'] == 'phys') {
				$categories_items['phys'][] = $category; 
			}
			if ($category['eng_socr'] == 'juri') {
				$categories_items['juri'][] = $category;
			}
		}
											
		$result = array('categories'=>$categories_items); 
		echo json_encode($result);
 		exit();
	}
}

