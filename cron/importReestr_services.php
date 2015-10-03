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


$db->revertDB();
$db->disconnect();
