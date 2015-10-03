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

$db->revertDB();
$db->disconnect();
