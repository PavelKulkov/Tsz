<?php


// Со старого РПГУ
/*
require_once("config.inc.php");
require_once("config_system.inc.php");
$authHome = new AuthHome(NULL);
$authHome->initGuestConnection($guestUser);
$db = $authHome->getCurrentDBConnection();
$db->changeDB("regportal_services");
$dbconn3 = pg_connect("host=192.168.1.32 port=5432 dbname=pgmu user=postgres password=postgres");
//очищаем временную таблицу
$db->query("delete from service_tmp");
$query = "INSERT INTO service_tmp (`id`,`s_short_name`,`s_name`,company_id, general_info, consultation, result, registry_number) VALUES(?,?,?,?,?,?,?,?)";
//вставляем региональные услуги
$result = pg_query($dbconn3, "select this_.id, short_name as s_short_name, full_name as s_name, fk_organization as company_id, general_info, consultation, result, registry_number from pgmu.FAVOUR this_ inner join pgmu.STATUS status1_ on this_.id=status1_.id where (status1_.STATE='PUBLISHED_NO_SIGN' or status1_.STATE='PUBLISHED_SIGN' or status1_.STATE='PUBLISHED_LOCAL') and this_.FAVOUR_TYPE='SERVICE' and this_.FK_ORGANIZATION in (select this_.id as y0_ from PGMU.ORGANIZATION this_ where this_.ORG_TYPE in ('REGIONAL'))");
while ($row = pg_fetch_row($result)) {
	$db->insert($query,$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
}
$db->query("update service_tmp set type_serviсe_id = 2 where type_serviсe_id is null");
//вставляем муниципальные услуги
$result = pg_query($dbconn3, "select this_.id, short_name as s_short_name, full_name as s_name, fk_organization as company_id, general_info, consultation, result, registry_number from pgmu.FAVOUR this_ inner join pgmu.STATUS status1_ on this_.id=status1_.id where (status1_.STATE='PUBLISHED_NO_SIGN' or status1_.STATE='PUBLISHED_SIGN' or status1_.STATE='PUBLISHED_LOCAL') and this_.FAVOUR_TYPE='SERVICE' and this_.FK_ORGANIZATION in (select this_.id as y0_ from PGMU.ORGANIZATION this_ where this_.ORG_TYPE in ('MUNICIPAL'))");
while ($row = pg_fetch_row($result)) {
	$db->insert($query,$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
}
$db->query("update service_tmp set type_serviсe_id = 1 where type_serviсe_id is null");
//вставляем федеральные услуги;
$result = pg_query($dbconn3, "select this_.id, short_name as s_short_name, full_name as s_name, fk_organization as company_id, general_info, consultation, result, registry_number from pgmu.FAVOUR this_ inner join pgmu.STATUS status1_ on this_.id=status1_.id where (status1_.STATE='PUBLISHED_NO_SIGN' or status1_.STATE='PUBLISHED_SIGN' or status1_.STATE='PUBLISHED_LOCAL') and this_.FAVOUR_TYPE='SERVICE' and this_.FK_ORGANIZATION in (select this_.id as y0_ from PGMU.ORGANIZATION this_ where this_.ORG_TYPE in ('FEDERAL'))");
while ($row = pg_fetch_row($result)) {
	$db->insert($query,$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
}
$db->query("update service_tmp set type_serviсe_id = 3 where type_serviсe_id is null");
$db->disconnect();
*/


require_once("../../config.inc.php");
require_once("../../config_system.inc.php");
$authHome = new AuthHome(NULL);
$authHome->initGuestConnection($guestUser);
$db = $authHome->getCurrentDBConnection();

$db->changeDB('regportal_services');

$dbconn3 = pg_connect("host=192.168.1.98 port=5433 dbname=rgu user=rguro password=ded8Fum1ga");  //реалка



// --- услуги ---
$services_regnum = $db->select('SELECT registry_number FROM service');
foreach($services_regnum as $num) {
	$services[] = $num['registry_number'];
}


// выборка id, полное и короткое название (full_title, short_title), порядок обжалования (appeal_description), консультирование (info_description), результат (result), дата (reglament_approval_date)
// left join  регламент (WORK_DOCUMENT)  выбор регламента (title),  ссылка на ресурс (url)
$result = pg_query($dbconn3, '	SELECT p.id, p.full_title, p.short_title, p.r_state_structure,  p.appeal_description, 
										p.info_description, p.result, p.reglament_approval_date, w.title AS reglament_name, w.url AS reglament_url
								FROM PS_PASSPORT p
								LEFT JOIN work_document w
								ON w.id = p.reglament
								ORDER BY id DESC');

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
echo $text;



$db->revertDB();
$db->disconnect();