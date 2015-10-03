<?php
class Services {

	private $db;
	private $request;
	private $lng_prefix;

	function __construct($request = NULL, $db) 	{
		$this->db = $db;
		$this->db->changeDB("regportal_services");
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	
	function getCompany($company_id){
		$item = $this->db->selectRow("select * from `company` where `id`= ? ", $company_id);
		
		return ($item) ? $item : false;
	}

	
	function getSubservices($service_id, $where = ''){
		$query = "SELECT sub.* , r.name FROM `subservice` sub LEFT JOIN recipient r ON sub.recipient_id = r.id where sub.`service_id` = ".$service_id.' '.$where;
		
		$item = $this->db->select($query);

		return ($item) ? $item : false;
	}

	
	function getTypeService($type_service_id){
		$item = $this->db->selectRow("select * from `type_service` where `id`= ? ", $type_service_id);
		
		return ($item) ? $item : false;
	}

	
	function getCountServices(){
		$item = $this->db->selectCell("select count(id) from `service`");
		
		return ($item) ? $item : false;
	}
	
	
	function getCountSubservice($service_id){
		$item = $this->db->selectRow("select count(id) from `subservice` where `service_id`= ?", $service_id);
		
		return ($item) ? $item : false;
	}

	
	function getSubservice($subservice_id){		
		$item = $this->db->selectRow("SELECT subservice.*, recipient.`name` AS recipient, company.c_name, company.id AS company_id, service.registry_number AS service_registry_number, service.s_short_name AS service_s_name, service.id AS service_id, service.consultation, service.approval_date
												FROM subservice 
												LEFT JOIN recipient
												ON subservice.`recipient_id` = recipient.`id`
												LEFT JOIN service
												ON subservice.`service_id` = service.`id`
												LEFT JOIN company
												ON service.`company_id` = company.`id`
												WHERE subservice.`id` = ? ", 
												$subservice_id
									);
		
		return ($item) ? $item : false;
	}
	
	
	function getRequests($registry_number) {
		$query = 'SELECT rf.title FROM subservice_request sr LEFT JOIN r_communication_form rf ON sr.communicationform_id = rf.id WHERE sr.subservice_id = ?';
		$item = $this->db->select($query, $registry_number);
		
		return ($item) ? $item : false;
	}
	
	
	function getResponses($registry_number) {
		$query = 'SELECT rf.title FROM subservice_response sr LEFT JOIN r_communication_form rf ON sr.communicationform_id = rf.id WHERE sr.subservice_id = ?';
		$item = $this->db->select($query, $registry_number);
		
		return ($item) ? $item : false;
	}

	
	function getSubserviceDigitalForms(){
		$query = "SELECT * FROM `subservice_digital_form` order by `id`";
		$item = $this->db->select($query);
		
		return ($item) ? $item : false;
	}

	
	function getLifeSutuations(){
		$query = "SELECT * FROM `life_situation` order by `id`";
		$item = $this->db->select($query);
	
		return ($item) ? $item : false;
	}

	
	function getLifeSutuationsWithCount(){
		$query = "select t1.*, (select count(subservice_id) from subservice_life_situations t2 where t2.life_situation_id = t1.id) as count from life_situation t1 ";
		$item = $this->db->select($query);
		
		return ($item) ? $item : false;
	}

	
	function getRecipients(){
		$query = "SELECT * FROM `recipient` order by `id`";
		$item = $this->db->select($query);
		
		return ($item) ? $item : false;
	}
	

	function getService($service_id){
		$item = $this->db->selectRow("select t1.*, t2.c_name as company_name, t3.name as service_type from service t1
				join company t2 on t1.company_id = t2.id
				join type_service t3 on t1.`type_serviсe_id` = t3.id where t1.id = ?", $service_id);
	
		return ($item) ? $item : false;
	}
	
	
	function getParticipants($registry_number) {
		$item = $this->db->select("SELECT so.organisation_registry_number, so.service_registry_number, so.participanttype_id, rp.title, rp.description, c.c_name 
											FROM service_organisation so
											LEFT JOIN r_participant_type rp
											ON so.participanttype_id = rp.id											
											LEFT JOIN company c
											ON CHAR(c.registry_number) =  CHAR(so.organisation_registry_number)											
											WHERE so.service_registry_number =?", $registry_number);
		return ($item) ? $item : false;
	}
	
	
	public function getOneRecipient($category_id) {
		$item = $this
				->db
				->selectCell('SELECT recipient.eng_socr
								FROM service_categories
								LEFT JOIN recipient
								ON service_categories.recipient_id = recipient.id
								WHERE service_categories.id = ? ', $category_id);
		
		return ($item) ? $item : false;
	} 
	
	
	function getMenuCategories($category_id) {
		$item = $this
				->db
				->select('SELECT id, short_name, '.$category_id.' AS category_id	
						FROM service_categories
						WHERE recipient_id IN (SELECT recipient_id
												FROM service_categories
												WHERE id = ?
												)
						ORDER BY category', 
						$category_id
				);
	
		return ($item) ? $item : false;
	}
	
	
	function getSubservicesByCatagoryId($category_id, $only_el_flag = false, $district) {
		
		$cond = ($only_el_flag !== false) ? ' AND s_digital_form != 0 ' : '';
		if ($district != '') {
			if ($district == 0) {
				$cond .= ' AND md.id != 0';
			} else {
				$cond .= ' AND md.id = '.$district;
			}
		} else {
			$cond .= 'AND md.id != 0';
		}
		
		$query = 'SELECT sub.id,  sub.s_name, sub.s_digital_form, sub.recipient_id, sub.service_id, sub.form_id, md.name AS municipal_district_name, md.id AS municipal_district_id
						FROM  subservice sub
						LEFT JOIN service 
						ON sub.service_id = service.id
						LEFT JOIN company c
						ON service.company_id = c.id
						LEFT JOIN municipal_districts md
						ON c.municipal_district = md.id
						WHERE sub.service_categories_id = ? '.$cond;
		//echo $query;
		$item = $this->db->select($query, $category_id);
		
		return ($item) ? $item : false;
	}
	
	
	function getServicesBySubserviceArr($services_id_list) {
		$item = $this
				->db
				->select('SELECT id, s_name
							FROM service
							WHERE id IN (%s) 
							ORDER BY s_name', 
						$services_id_list
				);
		
		return ($item) ? $item : false;
	}
	
	
	function __destruct() {
		$this->db->revertDB();
	}
}