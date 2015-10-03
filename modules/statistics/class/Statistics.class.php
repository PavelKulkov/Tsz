<?php
class Statistics {

	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	function getServicesCount() {
		$sql = "select count(id) from service";
		$item = $this->db_instance->select($sql);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getGosServicesCount() {
		$sql = "select count(id) from service where type_serviсe_id = 2";
		$item = $this->db_instance->select($sql);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getMunServicesCount() {
		$sql = "select count(id) from service where type_serviсe_id = 1";
		$item = $this->db_instance->select($sql);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getDigitalServicesCount(){
		$sql = "select count(id) from service where id in (select service_id from subservice where s_digital_form in (1,2,3))";
		$item = $this->db_instance->select($sql);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getDigitalSubservicesCount(){
		$sql = "select count(id) from subservice where s_digital_form in (1,2,3)";
		$item = $this->db_instance->select($sql);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getCompanyCount(){
		$sql = "select count(id) from company";
		$item = $this->db_instance->select($sql);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}

}
?>