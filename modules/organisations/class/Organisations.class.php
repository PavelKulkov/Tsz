<?php
class Organisations {

	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;
	public $count;
	public $items_organisations = array('id', 'municipal_district','c_name','c_adress','c_contacts', 'c_head', 'c_email', 'c_web_site', 'company_type_id', 'c_shedule');
	public $items_municipal_districts = array('id', 'name');

	function __construct($request=NULL,$db) 	{
		$db->changeDB("regportal_services");
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	function getMunicipalDistricts(){
		$sql = "SELECT * FROM `municipal_districts`";
		$item = $this->db_instance->select($sql);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	function getCompanyType($company_type_id){
		$item = $this->db_instance->selectRow("select * from `type_company` where `id`= ? ", $company_type_id);
		if ($item){
			return $item;
		}else{
			return false;
		}
	}
	
	function getCompany($company_id){
		$item = $this->db_instance->selectRow("select * from `company` where `id`= ? ", $company_id);
		if ($item){
			return $item;
		}else{
			return false;
		}
	}

	function getSubservices($service_id){
		$sql = "SELECT * FROM `subservice` where `service_id` IN (%s) LIMIT ".count($service_id['id']);
		$item = $this->db_instance->select($sql, $service_id['id']);
		if($item) {
			return  $item;
		}
		else {
			return false;
		}
	}
	
	
	function getOrganizationsServices(){
		$sql = "SELECT `id`, `s_name`, `company_id` FROM `service`";
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