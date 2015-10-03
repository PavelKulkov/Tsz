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