<?php
define('APP_ROOT_PATH', dirname(__FILE__).'/../');
require_once(APP_ROOT_PATH."config.inc.php");
require_once(APP_ROOT_PATH."config_system.inc.php");
DBRegInfo::initParams($guestUser[0],
	$argv[1],
	$argv[2],
	"regportal_services");
		
	$db = new DB();
	$regInfo = DBRegInfo::getInstance();
	$db->connect($regInfo);

$db->changeDB('regportal_services');

// Реестр
//$dbconn3 = pg_connect("host=192.168.0.98 port=5434 dbname=rgu user=rguro password=ded8Fum1ga");    // тест  стучимся с локалхоста
// $dbconn3 = pg_connect("host=192.168.1.98 port=5433 dbname=rgu user=rguro password=ded8Fum1ga");  //реалка  стучимся с локалхоста 
$dbconn3 = pg_connect("host=194.85.124.1 port=25433 dbname=rgu user=rguro password=ded8Fum1ga");  //реалка




// --- организации ---
$organisations_regnum = $db->select('SELECT registry_number FROM company');
foreach($organisations_regnum as $num) {
	$organisations[] = $num['registry_number'];
}


// выборка id, название организации (title),  ФИО директора (director_person), email, сайт (web_resource), режим работы (schedule), автоинформатор (call_center_phone), сслыка на родительскую орг.-ию (parent)


/* была выборка без учета опубликованности организации
$result = pg_query($dbconn3, '	SELECT id, title, director_person, email, web_resource, schedule, call_center_phone, parent
								FROM r_state_structure
								ORDER BY id DESC');
								
*/

/* Запрос с учетом опубликованности организации */
$result = pg_query($dbconn3, '	SELECT r.id, r.title, r.director_person, r.email, r.web_resource, r.schedule, r.call_center_phone, r.parent 
								FROM r_state_structure r, status s
								WHERE s.id = r.id AND s.published_root = true
								ORDER BY r.id DESC');

$text = '<table border="1">';
$text .= '<tr><td>№ пп</td><td>id</td><td>Наименование</td><td>Адрес</td><td>Контакты</td><td>ФИО начальника</td><td>email</td><td>Сайт</td><td>Тип компании</td><td>Режим работы</td><td>Платежные реквизиты</td><td>автоинформатор</td><td>ид родительской организации</td><td>letter</td></tr>';
$i = 1;
while ($row = pg_fetch_assoc($result)) {
	
	if (strlen($row['id']) > 11) {
		// адреса
		$result2 = pg_query($dbconn3, 'SELECT o.zip, o.city_type, o.city, o.street, o.house FROM office o WHERE state_structure = '.$row['id']);
		while ($row2 = pg_fetch_assoc($result2)) {		
			$row['address'] .= $row2['zip'].' '.$row2['city_type'].' '.$row2['city'].', '.$row2['street'].' '.$row2['house'].'<br />';
		}
		// Телефоны
		$result3 = pg_query($dbconn3, 'SELECT work_phone FROM contact WHERE state_structure = '.$row['id']);
		while ($row3 = pg_fetch_assoc($result3)) {
			$row['phone'] .= $row3['work_phone'].' <br />';
		}
		
		//id родительской организации
		$parent_id = $db->selectRow('SELECT parent_id FROM company WHERE registry_number = '.$row['id']);
		
		$letter = iconv('UTF-8','windows-1251', $row['title'] ); //Меняем кодировку на windows-1251 чтобы корректно обрезать
		$letter = substr($letter ,0,1); //Обрезаем строку	
		$letter = iconv('windows-1251','UTF-8',$letter ); //Возвращаем кодировку в utf-8
		$letter = strtoupper($letter);
	
		$text .= '<tr>';
		$text .= '<td>'.$i.'</td><td>'.$row['id'].'</td><td>'.$row['title'].'</td><td>'.$row['address'].'</td><td>'.$row['phone'].'</td><td>'.$row['director_person'].'</td>';
		$text .= '<td>'.$row['email'].'</td><td>'.$row['web_resource'].'</td><td>тип компании</td><td>'.$row['schedule'].'</td><td>реквизиты</td>';
		$text .= '<td>'.$row['call_center_phone'].'</td><td>'.$parent_id['parent_id'].'</td><td>'.$letter.'</td>';
		$text .= '</tr>';
		
		$row['title'] = ($row['title'] == null) ? '' : $row['title'];
		$row['address'] = ($row['address'] == null) ? '' : $row['address'];
		$row['phone'] = ($row['phone'] == null) ? '' : $row['phone'];
		$row['director_person'] = ($row['director_person'] == null) ? '' : $row['director_person'];
		$row['email'] = ($row['email'] == null) ? '' : $row['email'];
		$row['web_resource'] = ($row['web_resource'] == null) ? '' : $row['web_resource'];
		$row['schedule'] = ($row['schedule'] == null) ? '' : $row['schedule'];
		$row['call_center_phone'] = ($row['call_center_phone'] == null) ? '' : $row['call_center_phone'];
		$parent_id['parent_id'] = ($row['parent_id'] == null) ? '' : $row['parent_id'];
		$letter = ($letter == null) ? '' : $letter;
		$row['id'] = ($row['id'] == null) ? '' : $row['id'];
		
		
		// isnert or update DB company  
		if (in_array($row['id'], $organisations)) {
			// update
			$query = 'UPDATE `company` SET `c_name`= ?,`c_adress`= ?,`c_contacts`= ?,`c_head`= ?,`c_email`= ?,`c_web_site`= ?, `c_shedule`= ?, `autoinformer`= ?,`parent_id`= ?, `letter`= ? WHERE registry_number = ?';
			$db->update($query, $row['title'], $row['address'], $row['phone'], $row['director_person'], $row['email'], $row['web_resource'], $row['schedule'], $row['call_center_phone'], $parent_id['parent_id'], $letter, $row['id']);	
		} else {
			// insert
			$query = 'INSERT INTO `company`(`c_name`, `c_adress`, `c_contacts`, `c_head`, `c_email`, `c_web_site`, `c_shedule`, `autoinformer`, `parent_id`, `registry_number`, `letter`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$db->insert($query, $row['title'], $row['address'], $row['phone'], $row['director_person'], $row['email'], $row['web_resource'], $row['schedule'], $row['call_center_phone'], $parent_id['parent_id'], $row['id'], $letter);	
		}		
		
	
		$i++;
	}
}

$text .= '</table>';
// echo $text;


// Заносим  в таблицу COMPANY parent_id -> ИД головной организации
$organisations_regnum = $db->select('SELECT registry_number FROM company');
foreach($organisations_regnum as $num) {
	
	$result = pg_query($dbconn3, '	SELECT id, parent
									FROM r_state_structure 
									WHERE id = '.$num['registry_number'].' 
									ORDER BY id DESC');
	
	while ($row = pg_fetch_assoc($result)) {
		$organisation_id = $db->selectCell('SELECT id FROM company WHERE registry_number = "'.$row['parent'].'"');
	}
	// update
	$query = 'UPDATE `company` SET `parent_id`= ? WHERE registry_number = ?';
	$db->update($query, $organisation_id, $num['registry_number']);	
	
}








// --- услуги ---
$services_regnum = $db->select('SELECT registry_number FROM service');
foreach($services_regnum as $num) {
	$services[] = $num['registry_number'];
}

// выборка id, полное и короткое название (full_title, short_title), порядок обжалования (appeal_description), консультирование (info_description), результат (result), дата (reglament_approval_date)
// left join  регламент (WORK_DOCUMENT)  выбор регламента (title),  ссылка на ресурс (url)
/* была выборка без учета опубликованности услуги
$result = pg_query($dbconn3, '	SELECT p.id, p.full_title, p.short_title, p.r_state_structure,  p.appeal_description, 
										p.info_description, p.result, p.reglament_approval_date, w.title AS reglament_name, w.url AS reglament_url
								FROM PS_PASSPORT p
								LEFT JOIN work_document w
								ON w.id = p.reglament
								ORDER BY id DESC');
*/

/* Запрос с учетом опубликованности услуги */
$result = pg_query($dbconn3, '	SELECT p.id, p.full_title, p.short_title, p.r_state_structure,  p.appeal_description, 
										p.info_description, p.result, p.reglament_approval_date, w.title AS reglament_name, w.url AS reglament_url
								FROM PS_PASSPORT p
								LEFT JOIN work_document w
								ON w.id = p.reglament
								LEFT JOIN status s
								ON s.id = p.id
								WHERE s.published_root = true
								ORDER BY p.id DESC');

$text = '<table border="1">';
$text .= '<tr><td>№ пп</td><td>id</td><td>название полное</td><td>название короткое</td><td>company_id</td><td>reglament_name</td><td>reglament_source</td>
			<td>Порядок обжалования</td><td>consultation</td><td>result</td><td>approval_date</td></tr>';
$i = 1;			
while ($row = pg_fetch_assoc($result)) {
	if (strlen($row['id']) > 11) {
		//id ведомственной организации
		$organisation = $db->selectCell('SELECT id FROM company WHERE registry_number = "'.$row['r_state_structure'].'"');
		
		
		$text .= '<tr>';
		$text .= '<td>'.$i.'</td><td>'.$row['id'].'</td><td>'.$row['full_title'].'</td><td>'.$row['short_title'].'</td><td>'.$organisation.'</td>';
		$text .= '<td>'.$row['reglament_name'].'</td><td>'.$row['reglament_url'].'</td><td>'.$row['appeal_description'].'</td>';
		$text .= '<td>'.$row['info_description'].'</td><td>'.$row['result'].'</td></td><td>'.$row['reglament_approval_date'].'</td>';
		$text .= '<tr>';
		

		$row['full_title'] = ($row['full_title'] == null) ? '' : $row['full_title'];
		$row['short_title'] = ($row['short_title'] == null) ? '' : $row['short_title'];
		$organisation = ($organisation == null) ? '' : $organisation;
		$row['reglament_name'] = ($row['reglament_name'] == null) ? '' : $row['reglament_name'];
		$row['reglament_url'] = ($row['reglament_url'] == null) ? '' : $row['reglament_url'];
		$row['appeal_description'] = ($row['appeal_description'] == null) ? '' : $row['appeal_description'];
		$row['info_description'] = ($row['info_description'] == null) ? '' : $row['info_description'];
		$row['result'] = ($row['result'] == null) ? '' : $row['result'];
		$parent_id['reglament_approval_date'] = ($row['reglament_approval_date'] == null) ? '' : $row['reglament_approval_date'];
		$row['id'] = ($row['id'] == null) ? '' : $row['id'];
		
		// isnert or update DB service
		if (in_array($row['id'], $services, true)) {
			// update
			$query = 'UPDATE `service` SET `s_name`= ?, `s_short_name`= ?,`company_id`= ?, `s_reglament_name`= ?, `s_reglament_source`= ?, `s_appeal_description`= ?, `consultation`= ?, `result`= ?, `approval_date`= ? WHERE registry_number = ?';
			$db->update($query, $row['full_title'], $row['short_title'], $organisation, $row['reglament_name'], $row['reglament_url'], $row['appeal_description'], $row['info_description'], $row['result'], $parent_id['reglament_approval_date'], $row['id']);
		} else {
			// insert
			$query = 'INSERT INTO `service`(`s_name`, `s_short_name`,`company_id`, `s_reglament_name`, `s_reglament_source`, `s_appeal_description`, `consultation`, `result`, `registry_number`, `approval_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$db->insert($query, $row['full_title'], $row['short_title'], $organisation, $row['reglament_name'], $row['reglament_url'], $row['appeal_description'], $row['info_description'], $row['result'], $row['id'], $parent_id['reglament_approval_date']);
		}		
		
	}
	$i++;
}
$text .= '</table>';
// echo $text;






// --- подуслуги --- 
// выборка id,  название (title), порядок обжалования (appeal_description), основания для оказания услуги (ground_for_action), результат (result), сроки исполнения (term)
// PASSPORT_SERVICES(passport_id, service_id) ­> ps_passport (id) и service (id)

$subservices_regnum = $db->select('SELECT registry_number FROM subservice');
foreach($subservices_regnum as $num) {
	$subservices[] = $num['registry_number'];
}

/* была выборка без учета опубликованности подуслуги
$result = pg_query($dbconn3, '	SELECT s.id, s.title, s.ground_for_action, s.result, s.term, pp.appeal_description, ps.passport_id
								FROM service s
								LEFT JOIN passport_services ps
								ON s.id = ps.service_id
								LEFT JOIN ps_passport pp
								ON ps.passport_id = pp.id								
								ORDER BY s.id DESC');
*/

/* Запрос с учетом опубликованности подуслуги */
$result = pg_query($dbconn3, '	SELECT s.id, s.title, s.ground_for_action, s.result, s.term, pp.appeal_description, ps.passport_id
								FROM service s
								LEFT JOIN passport_services ps
								ON s.id = ps.service_id
								LEFT JOIN ps_passport pp
								ON ps.passport_id = pp.id	
								LEFT JOIN status ss
								ON ss.id = ps.passport_id
								WHERE ss.published_root = true							
								ORDER BY s.id DESC');
$text = '<table border="1">';
$text .= '<tr><td>№ пп</td><td>id</td><td>название</td><td>порядок обжалования</td><td>service_id</td><td>основания для оказания</td>
			<td>основания для отказа</td><td>результат</td><td>стоимость</td><td>срок исполнения (due_time)</td></tr>';
$i = 1;	
while ($row = pg_fetch_assoc($result)) {
	if (strlen($row['id']) > 11) {
		//id ведомственной услуги
		$service_id = $db->selectCell('SELECT id FROM service WHERE registry_number = "'.$row['passport_id'].'"');
		// Основания для отказа
		$result2 = pg_query($dbconn3, '	SELECT description, title FROM ground_of_refusal
										LEFT JOIN  service2ground_of_refusal 
										ON  service2ground_of_refusal.groundofrefusal_id =  ground_of_refusal.id
										WHERE service_id = '.$row['id']);
		while ($row2 = pg_fetch_assoc($result2)) {		
			$row['refusal_description'] .= '<p>'.$row2['title'].'</p>';
		}
			
		// Стоимость и порядок оплаты
		$result3 = pg_query($dbconn3, '	SELECT p.description
										FROM service_payment s
										LEFT JOIN payment_info p
										ON p.id = s.paymentinfo_id
										WHERE service_id = '.$row['id']);
		while ($row3 = pg_fetch_assoc($result3)) {		
			$row['s_payment_description'] .= '<p>'.$row3['description'].'</p>';
		}
		
		$text .= '<tr>';
		$text .= '<td>'.$i.'</td><td>'.$row['id'].'</td><td>'.$row['title'].'</td><td>'.$row['appeal_description'].'</td><td>'.$service_id.'</td><td>'.$row['ground_for_action'].'</td>';
		$text .= '<td>'.$row['refusal_description'].'</td><td>'.$row['result'].'</td><td>'.$row['s_payment_description'].'</td><td>'.$row['term'].'</td>';
		$text .= '<tr>';

		$row['title'] = ($row['title'] == null) ? '' : $row['title'];
		$row['appeal_description'] = ($row['appeal_description'] == null) ? '' : $row['appeal_description'];
		$service_id = ($service_id == null) ? '' : $service_id;
		$row['ground_for_action'] = ($row['ground_for_action'] == null) ? '' : $row['ground_for_action'];
		$row['refusal_description'] = ($row['refusal_description'] == null) ? '' : $row['refusal_description'];
		$row['result'] = ($row['result'] == null) ? '' : $row['result'];
		$row['s_payment_description'] = ($row['s_payment_description'] == null) ? '' : $row['s_payment_description'];
		$row['term'] = ($row['term'] == null) ? '' : $row['term'];
		$row['id'] = ($row['id'] == null) ? '' : $row['id'];	
		
		// isnert or update DB subservice	
		if (in_array($row['id'], $subservices, true)) {
			// update
			$query = 'UPDATE `subservice` SET `s_name`= ?, `s_appeal_description`= ?, `service_id`= ?, `s_provide_description`= ?,`s_refusal_description`= ?,`s_result_description`= ?, `s_payment_description`= ?, `due_time`= ?, WHERE registry_number = ?';
			$db->update($query, $row['title'], $row['appeal_description'], $service_id, $row['ground_for_action'], $row['refusal_description'], $row['result'], $row['s_payment_description'], $row['term'], $row['id']);
		} else {
			// insert
			$query = 'INSERT INTO `subservice` (`s_name`, `s_appeal_description`, `service_id`, `s_provide_description`, `s_refusal_description`, `s_result_description`, `s_payment_description`, `due_time`, `registry_number`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$db->insert($query, $row['title'], $row['appeal_description'], $service_id, $row['ground_for_action'], $row['refusal_description'], $row['result'], $row['s_payment_description'], $row['term'], $row['id']);
		}		
		
		
		$i++;
	}
}

$text .= '</table>';
// echo $text;





// --- формы обращения r_communication_form ---
// таблица SERVICE  - связь подуслуги с услугой   через таблицу PASSPORT_SERVICES

$r_communication_form_id = $db->select('SELECT id FROM r_communication_form');
$numbers = array();
foreach($r_communication_form_id as $num) {
	$numbers[] = $num['id'];
}

$result = pg_query($dbconn3, 'SELECT id, description, title FROM r_communication_form ORDER BY id ASC');
while ($row = pg_fetch_row($result)) {
	if (in_array($row[0], $numbers)) {
		$query = 'UPDATE r_communication_form SET description= ?, title = ? WHERE id = ?';
		$db->update($query, $row[1], $row[2], $row[0]);	
	} else {
		$query = 'INSERT INTO r_communication_form (`id`, `description`, title) VALUES (?, ?, ?)';
		$db->insert($query, $row[1], $row[2], $row[0]);	
	}
}



// выбор из нашей таблицы реестровых номеров подуслуг, чтобы при апдейте ЗАПРОСА И ОТВЕТА номера совпадали
$subservice_registry_number = $db->select('SELECT registry_number FROM subservice');
$numbers = array();
foreach($subservice_registry_number as $num) {
	$numbers[] = $num['registry_number'];
}


// --- Формы обращения и ответа ---

// выбор из таблицы SERVICE_REQUEST и SERVICE_RESPONSE для дальнейшего импорта к нам
// таблица обращения запрос  SERVICE_REQUEST в реестре
// таблица обращения ответ  SERVICE_RESPONSE в реестре


$result = pg_query($dbconn3, 'SELECT service_id, communicationform_id FROM service_request ORDER BY service_id ASC');
$result = pg_query($dbconn3, 'SELECT service_id, communicationform_id FROM service_response ORDER BY service_id ASC');
while ($row = pg_fetch_row($result)) {
	if (strlen($row[0]) == 19) {
		if (in_array($row[0], $numbers)) {
			$query = 'UPDATE subservice_request SET communicationform_id = ? WHERE subservice_id = ?';
			$db->UPDATE($query, $row[0], $row[1]);	
			$query = 'UPDATE subservice_response SET communicationform_id = ? WHERE subservice_id = ?';
			$db->UPDATE($query, $row[0], $row[1]);	
		} else {	
			$query = 'INSERT INTO subservice_request (`subservice_id`, `communicationform_id`) VALUES (?, ?)';
			$db->insert($query, $row[0], $row[1]);	
			$query = 'INSERT INTO subservice_response (`subservice_id`, `communicationform_id`) VALUES (?, ?)';
			$db->insert($query, $row[0], $row[1]);	
		}
	}
}





// --- Исполнители, участники оказания услуги
// выбор из таблиц r_participant_type (тип участия) и PS_PASSPORT2R_STATE_STRUCTURE (связь услуги, организации и типа участия)
$result = pg_query($dbconn3, 'SELECT statestructure_id, passport_id, participanttype_id FROM ps_passport2r_state_structure ORDER BY statestructure_id ASC');

while ($row = pg_fetch_row($result)) {
	if (strlen($row[0]) == 19) {
		$reg_numbers = $db->selectCell('SELECT COUNT(organisation_registry_number) FROM service_organisation WHERE organisation_registry_number = "'.$row[0].'" AND service_registry_number = "'.$row[1].'" AND participanttype_id = "'.$row[2].'" ');
		if ($reg_numbers == 0) {
				$query = 'INSERT INTO service_organisation (`organisation_registry_number`, `service_registry_number`, participanttype_id) VALUES (?, ?, ?)';
				$db->insert($query, $row[0], $row[1], $row[2]);	
		}
	}
}





$r_participant_type_id = $db->select('SELECT id FROM r_participant_type');
$numbers = array();
foreach($r_participant_type_id as $num) {
	$numbers[] = $num['id'];
}

$result = pg_query($dbconn3, 'SELECT * FROM r_participant_type ORDER BY id ASC');
while ($row = pg_fetch_row($result)) {
	if (in_array($row[0], $numbers)) {
		$query = 'UPDATE r_participant_type SET description = ?, title = ? WHERE id = ?';
		$db->UPDATE($query, $row[1], $row[2], $row[0]);						
	} else {
		$query = 'INSERT INTO r_participant_type (`id`, `description`, title) VALUES (?, ?, ?)';
		$db->insert($query, $row[0], $row[1], $row[2]);		
	}	
}






$db->revertDB();
$db->disconnect();
?>