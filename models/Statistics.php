<?php
class Statistics {

	private $db;
	private $request;
	private $lng_prefix;

	function __construct($request = NULL, $db) 	{
		$this->db = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	function getServicesCount() {
		$query = "SELECT COUNT(id) FROM service";
		$item = $this->db->selectCell($query);
		
		return ($item) ? $item : false;
	}
	
	function getGosServicesCount() {
		$query = "SELECT COUNT(id) FROM service WHERE type_serviсe_id = 2";
		$item = $this->db->selectCell($query);
		
		return ($item) ? $item : false;
	}
	
	function getMunServicesCount() {
		$query = "SELECT COUNT(id) FROM service WHERE type_serviсe_id = 1";
		$item = $this->db->selectCell($query);
		
		return ($item) ? $item : false;
	}
	
	function getDigitalServicesCount(){
		$query = "SELECT COUNT(id) FROM service WHERE id IN (SELECT service_id FROM subservice WHERE s_digital_form IN (1,2))";
		$item = $this->db->selectCell($query);
		
		return ($item) ? $item : false;
	}
	
	function getDigitalSubservicesCount(){
		$query = "SELECT COUNT(id) FROM subservice WHERE s_digital_form IN (1,2)";
		$item = $this->db->selectCell($query);
		
		return ($item) ? $item : false;
	}
	
	function getCompanyCount(){
		$query = "SELECT COUNT(id) FROM company";
		$item = $this->db->selectCell($query);
		
		return ($item) ? $item : false;
	}

}