<?php 

	$db->changeDB("regportal_services");

	$query = "SELECT s.id, s.s_name, sub.s_digital_form FROM service s LEFT JOIN subservice sub ON s.id = sub.service_id WHERE sub.s_digital_form IN (3)";
	$result=$db->select($query);

	$data .= "<option value=''>--- выберите ---</option>";
	
	foreach ($result as $key) {
												
		$data .= "<option value='".$key['id']."'>".$key['s_name']."</option>";
			
	}


	$db->revertDB();