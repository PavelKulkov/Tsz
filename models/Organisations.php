<?php
class Organisations {

	private $db;
	private $request;
	private $lng_prefix;

	function __construct($request = NULL, $db) 	{
		$this->db = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
		$this->db->changeDB("regportal_services");
	}

	function getMunicipalDistricts(){
		$query = "SELECT * FROM `municipal_districts`";
		$item = $this->db->select($query);
		
		return ($item) ? $item : false;
	}
	
	function getCompanyType($company_type_id){
		$item = $this->db->selectRow("SELECT * FROM `type_company` WHERE `id`= ? ", $company_type_id);
		
		return ($item) ? $item : false;
	}
	
	function getCompany($company_id){
		$item = $this->db->selectRow("SELECT * FROM `company` WHERE `id`= ? ", $company_id);
		
		return ($item) ? $item : false;
	}

	function getSubservices($service_id){
		$query = "SELECT * FROM `subservice` WHERE `service_id` IN (%s) LIMIT ".count($service_id['id']);
		$item = $this->db->select($query, $service_id['id']);
		
		return ($item) ? $item : false;
	}
	
	
	function getOrganizationsServices(){
		$query = "SELECT `id`, `s_name`, `company_id` FROM `service`";
		$item = $this->db->select($query);
		
		return ($item) ? $item : false;
	}	
}

