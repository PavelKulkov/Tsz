<?php
class Meta {
	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;
	public $count;
	public $items_news = array('id','content');

	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	
	
	
	function getTitleSubservice() {
		$titleSubservice =  $this->db_instance->selectRow("SELECT s_short_name
														FROM `subservice` sub
														WHERE sub.id = ?", $_GET['subservice_id']);
		return $titleSubservice;
	}
	
	
	
	function getTitleService($service_id) {
		$titleService =  $this->db_instance->selectRow("SELECT s.s_name, s.s_short_name, s.s_appeal_description, s.consultation
														FROM `subservice` sub
														LEFT JOIN service s
														ON sub.service_id = s.id
														WHERE s.id = ?", $service_id);					
		return $titleService;
	}
	
	
	function getTitleForm() {
		$titleForm =  $this->db_instance->selectRow("SELECT f.`name`
							FROM forms f
							LEFT JOIN subservice sub
							ON f.id = sub.form_id
							WHERE sub.id = ?", $_GET['subservice_id']);
		return $titleForm;
	}
	


	function getTitleNews() {
		
		$this->db_instance->changeDB('regportal_cms');
		$titleNews = $this->db_instance->selectRow("SELECT `title` FROM `news` WHERE `id`= ?", $_GET['id_news']);
		$this->db_instance->changeDB('regportal_services');
		return  $titleNews;	
	
	}

	
	
	function getTitleCompany(){
		$titleCompany = $this->db_instance->selectRow("select * from `company` where `id`= ? ", $_GET['id_organisation']);
		return $titleCompany;
	}
	
	

	
	function getAllMeta() {
		$metaDescription =  $this->db_instance->select("SELECT s.s_name
														FROM `subservice` sub
														LEFT JOIN service s
														ON sub.service_id = s.id
														WHERE sub.s_digital_form != 0");
		return $metaDescription;
	}
	
	
	function getMetaDescription($service_id) {
		$metaDescription =  $this->db_instance->selectRow("SELECT s.s_name, s.s_short_name, s.s_appeal_description, s.consultation
														FROM `subservice` sub
														LEFT JOIN service s
														ON sub.service_id = s.id
														WHERE sub.s_digital_form != 0 AND s.id = ?", $service_id);
		
		
		return $metaDescription;
	}
	
}