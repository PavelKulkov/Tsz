<?php

class DomenHome {

	private $db_instance;
	private $request;
	public $count;
	public $item = array('id','id_site','link','main','lng');

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->request 	= $request;
	}
	
	function getDomenBy($par, $value, $lng=false){
		$sql = "SELECT * FROM `domens` WHERE `".$par."`= ? ";
		if($lng) $sql .= " AND `lng`= ? ";
		
		//echo $sql;
		return $this->db_instance->selectRow($sql, $value, $lng);
	}
	
	function getList(){
		$sql = "SELECT * FROM `domens` ".
		$sql .= " ORDER BY `link`";
		return $this->db_instance->select($sql);
	}
	
	function getListDomens(){
		$sql = "SELECT * FROM `domens` ".
		$sql .= "WHERE `id_site` not like '0'  ORDER BY `link` ";
		return $this->db_instance->select($sql);
	}
	
	function save($item, $table){
	if($table == 'site'){
		$save_d = $this->db_instance->saveData($item,$table,$this->item_site);
		if(!$item['id']) $item['id'] = $this->db_instance->insertId();
		//var_dump($save_d);
		if($item['id_domens']) {
			if(is_array($item['id_domens'])){
				foreach($item['id_domens'] as $item_d){
					if($item_d!='0'){
					$sql = "UPDATE `domens` SET";
					$sql .= "`id_site`='".$item['id']."' ";
					if($item_d == $item['id_domen']) $sql .= " , `main`='1'";
					$sql .= " WHERE `id`='".$item_d."'";
					
//					echo $sql.'<br>';
					$this->db_instance->query($sql);
					}
				}
			}
			
		}
	} else {
		$this->db_instance->saveData($item,$table,$this->item);
	}
		return true;
	}

/*	function delete($id_domen){
		$sql = "DELETE FROM `domens` WHERE `id`='".$id_domen."'";
		$this->db_instance->query($sql);
	}
	*/
	function delete($table, $id_domen){
		$sql = "DELETE FROM `".$table."` WHERE `id`='".$id_domen."'";
			$this->db_instance->query($sql);
			    }
	
	function clear($id_domen){
		$sql = "UPDATE `domens` SET `id_site`='', `main`='0' WHERE `id_site`='".$id_domen['id']."'";
		$this->db_instance->query($sql);
	}

	function getSiteBy($par, $value){
$sql = "SELECT * FROM `site` WHERE `".$par."`= ? ";
//echo $sql;
return $this->db_instance->selectRow($sql, $value);
}

function getSiteList(){
$sql = "SELECT * FROM `site`";
//echo $sql;
return $this->db_instance->select($sql);
}

function getMainDomen($id_site=1, $lng=false){
$sql = "SELECT * FROM `domens` WHERE `id_site`= ? AND `main`=1;";
if($lng) $sql .= " AND `lng`= ? ";
//echo $sql;
return $this->db_instance->selectRow($sql, $id_site, $lng);
}

function getDomenBySite($id_site=1){
$sql = "SELECT * FROM `site`, `domens` WHERE `site`.`id`= ? AND `domens`.`id_site`=`site`.`id` AND `domens`.`main`=1;";
if($lng) $sql .= " AND `lng`= ? ";
//echo $sql;
return $this->db_instance->selectRow($sql, $id_site, $lng);
}

function getDomenListBy($par, $value){
		$sql = "SELECT * FROM `domens` WHERE `".$par."`= ? ";

		$list = $this->db_instance->selest($sql, $value);
		
/*		for($i=0; $i<=count($list);$i++){
			$num = $list[$i]['id'];
			$list2[$num] = $list[$i];
		}
		var_dump($list2);
		*/
		return $list;
	}
	

}