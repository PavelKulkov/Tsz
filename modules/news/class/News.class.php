<?php
class News {
	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;
	public $count;
	public $items_news = array('id','title','date','annotation', 'image', 'text', 'keywords', 'id_template', 'is_published');

	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	
	function getNews($id_template){
		$sql = "SELECT * FROM `news` WHERE `id_template`= ? ";
		$item = $this->db_instance->select($sql, $id_template);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getList($begin=0,$limit=7){
		$sql = "SELECT *  FROM `news`";
		//$sql .= " ORDER BY `date` DESC,`id` DESC";
		//$sql .=" LIMIT ".$begin.", ".$limit." ";
		$item = $this->db_instance->select($sql); 
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getCount($is_published=0){
		$sql = "SELECT count(`id`) FROM `news` WHERE is_published<>".$is_published;
		$this->count = $this->db_instance->getCountData($sql,'count(`id`)');
		return $this->count;
	}
	
	function getNew($id) {
		
		$sql = "SELECT * FROM `news` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $id);
		if(!$item) return false;
		
		return  $item;		
	}
	
	function delete($id_news){	
		$sql = "DELETE FROM `news` WHERE `id`= ?";
		$this->db_instance->delete($sql, $id_news);
	}
	
	function save($news_item){
		return $this->db_instance->saveData($news_item,'news',$this->items_news);
	}
	function deleteLogo($idNew){
		$pathLogo = $_SERVER['DOCUMENT_ROOT']."/files/imageForNews/"; 
		$new = $this->getNew($idNew);
		$pathLogo .= $new['image']; 
		//chmod($pathLogo,0775);
		unlink($pathLogo);
	}
	
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
	//Кол-во файлов в дериктории
	function count_files($dir){
		$c = 0;
		$d = dir($dir);
		while($str = $d->read()){
			
			if($str{0} != '.'){
				if(is_dir($dir.'/'.$str)){
					$c += count_files($dir.'/'.$str);
				}
				else{
					$masName[] = $str;
					$c++;
				}
			}
		}
		$d->close();
		return $masName;
	}
	
}