<?php 

 $db->changeDB("regportal_services");

	switch ($_GET['action']) {
		
		case "getMunicipalDistricts" :
			
			$query = "SELECT * FROM `municipal_districts`";
			$result=$db->select($query);
			
			if ($result) {
				
				$data = "<option value='' selected='selected' disabled='disabled'>--- выберите ---</option>"; 
				
				foreach ($result as $key) {
													
					$data .= "<option value='".$key['id']."'>".$key['name']."</option>";
				
				}
			}
			$db->revertDB();
		
		break;

		
		case "getCompany" :
			
			if (!empty($_GET['municipal_district'])) {
				
				$query = "SELECT * FROM `company_temp` WHERE `municipal_district`=?  AND (`parent_id` = 0 OR `parent_id` IS NULL  OR `parent_id` = 1)";
				$result=$db->select($query, $_GET['municipal_district']);				

			}
			
			if (!empty($_GET['parent_id'])) {
				
				$query = "SELECT * FROM `company_temp` WHERE `parent_id`=?";
				$result=$db->select($query, $_GET['parent_id']);				

			}

			if (count($result) > 0) {
				
				
				foreach ($result as $key) {
													
					$data .= "<option id='".$key['id']."' value='".$key['registry_number']."'>".$key['c_name']."</option>";
				
				}
			}
			
			$db->revertDB();
		
		break;
		
		
		
		
		case "getServices" :
			
			
			$query = "SELECT * FROM `service` WHERE `company_id`=?";
			$result=$db->select($query, $_GET['company_id']);				

			

			
			foreach ($result as $key) {
												
				$data .= "<option value='".$key['registry_number']."'>".$key['s_name']."</option>";
			
			}
	
			$db->revertDB();
		
		break;
		
		
		
		case "autoComplete" :
			
			$query = "SELECT `company_id`,`registry_number` FROM `service` WHERE `id`= (SELECT `service_id` FROM `subservice` WHERE `id`=?)";
			$service=$db->selectRow($query, $_GET['subservice']);
						
			$query = "SELECT `municipal_district`,`registry_number`, `parent_id` FROM `company_temp` WHERE `id`= ?";
			$company=$db->selectRow($query, $service['company_id']);

			if ($company['parent_id'] > 0) {
				$query = "SELECT `municipal_district`,`registry_number`, `parent_id` FROM `company_temp` WHERE `id`= ?";
				$parentCompany=$db->selectRow($query, $company['parent_id']);
				if ($parentCompany['municipal_district'] == 0) {
					unset($parentCompany['municipal_district']);
				}
			}
			
			
			$list = array(
			  "municipal_district" => $company1['municipal_district'].$parentCompany['municipal_district'],
			  "company" => $parentCompany['registry_number'],
			  "subCompany" => $company['registry_number'], 
			  "service" => $service['registry_number']
			);


	
			$db->revertDB();
		
		break;
		
		
		
		
	};