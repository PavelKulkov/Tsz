<?php
class ServiceURL {

	private $db_instance;
	const REQUEST_URL = 'test_url';

	function __construct($db)	{
		$this->db_instance = $db;
	}
	
	
	function getUrlById($id) {
		$this->db_instance->changeDB('regportal_services');
		$sql = "SELECT `".self::REQUEST_URL."` FROM `service_url` WHERE `id`= ?";
		
		$item = $this->db_instance->selectCell($sql, $id);
		$this->db_instance->revertDB();
		
		return ($item) ? $item : false;
	}
	
	
	function getUrlBySubserviceAndAction($subservice_id, $soapAction) {
		$this->db_instance->changeDB('regportal_services');
		$sql = "SELECT `".self::REQUEST_URL."` FROM `service_url` WHERE `subservice_id`= ? AND `soapAction` = ?";
		$item = $this->db_instance->selectCell($sql, $subservice_id, $soapAction);
		
		$this->db_instance->revertDB();
		
		return ($item) ? $item : false;
	}
}