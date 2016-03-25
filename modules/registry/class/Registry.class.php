<?php
class Registry {
	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;	
	public $count;
	public $items_registry = array('id','logo','title','town','street','house','id_template','phoneNumber','E-mail','fax','President');
	//public $items_reg = array('breadth', 'longitude','logo','title','address','id_template','phoneNumber','e_mail','fax','surnamePresident', 'namePresident', 'patronymicPresident', 'site', 'area', 'man', 'groupsArea');
	public $items_reg = array('breadth', 'longitude','logo','title','town','street','house','id_template','phoneNumber','e_mail','fax','surnamePresident', 'namePresident', 'patronymicPresident', 'site', 'area', 'man', 'groupsArea');

	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	
	function getRegistryGroupsTsz(){
		$sql = 'SELECT * FROM `groups_area`';
		$item  =$this->db_instance->select($sql);
		if($item)
			return $item;
		else
			return false;
	}
	
	function getRegistryTsz(){
		/*$sql= "SELECT *
		       FROM registry LEFT JOIN groups_area
			   ON registry.groupsArea = groups_area.id";*/
		
		$sql= "SELECT t1.id, t1.title, t1.town, t1.street, t1.house, t1.phoneNumber, t1.e_mail, t1.fax, t1.surnamePresident, t1.namePresident, t1.patronymicPresident, t1.site, t2.groupsArea AS groupsArea
		       FROM registry t1
			   LEFT OUTER JOIN groups_area t2
			   ON t1.groupsArea = t2.id";
		
		
		$item  =$this->db_instance->select($sql);
		if($item)
			return $item;
		else
			return false;
	}
	
	function getAllReg(){
		$sql= "SELECT t1.id, t1.breadth, t1.longitude, t1.logo, t1.title, t1.town, t1.street, t1.house, t1.phoneNumber, t1.e_mail, t1.fax, t1.surnamePresident, t1.namePresident, t1.patronymicPresident, t1.site, t2.groupsArea AS groupsArea
		       FROM registry t1
			   LEFT OUTER JOIN groups_area t2
			   ON t1.groupsArea = t2.id";
			   $item  =$this->db_instance->select($sql);
	    if(!$item) return false;
		
	    return $item;
	}
	function getReg($id) {
		
		$sql = "SELECT * FROM `registry` WHERE `id`= ?";
		$item = $this->db_instance->selectRow($sql, $id);
		if(!$item) return false;
		
		return  $item;		
	}
	
	function saveReg($reg){
		return $this->db_instance->saveData($reg,'registry',$this->items_reg);
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
	
	function delete($id_tsz){	
		$sql = "DELETE FROM `registry` WHERE `id`= ?";
		$this->db_instance->delete($sql, $id_tsz);
	}
	
	function save($registry_item){
		return $this->db_instance->saveData($registry_item,'registry',$this->items_registry);
	}
	function deleteLogo($idTsz){
		$pathLogo = $_SERVER['DOCUMENT_ROOT']."/files/logos/"; 
		$tsz = $this->getTsz($idTsz);
		$pathLogo .= $tsz['logo']; 
		//chmod($pathLogo,0775);
		unlink($pathLogo);
	}
	/*
	function Time_To_Show($value) {
		$montharray = array('1' => '������','2' => '�������','3' => '�����','4' => '������','5' => '���','6' => '����','7' => '����','8' => '�������','9' => '��������','10' => '�������','11' => '������','12' => '�������');
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