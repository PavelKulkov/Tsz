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
$db->query("delete from company_tmp");
$query = "INSERT INTO company_tmp (`id`,`municipal_district`,`c_name`,c_contacts, c_head, c_email, c_web_site, company_type_id, c_shedule, parent_id, registry_number ) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
//вставляем региональные услуги
$orgs = $db->select('select distinct company_id from service_tmp');
foreach ($orgs as $org){
	$cond = "id=".$org['company_id'];
	$result = pg_query($dbconn3, "select id, fk_municipality as municipal_district, org_name as c_name, phone as c_contacts, manager as c_head, email as c_email, www as c_web_site,  fk_organization_kind as company_type_id, office_hours as c_shedule, fk_org as parent_id, registry_number   from pgmu.organization where ".$cond);
	while ($row = pg_fetch_row($result)) {
		$db->insert($query,$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7], $row[8], $row[9], $row[10]);
	}
}
return;
$db->disconnect();
*/

require_once("../../config.inc.php");
require_once("../../config_system.inc.php");
$authHome = new AuthHome(NULL);
$authHome->initGuestConnection($guestUser);
$db = $authHome->getCurrentDBConnection();

$db->changeDB('regportal_services');

$dbconn3 = pg_connect("host=192.168.1.98 port=5433 dbname=rgu user=rguro password=ded8Fum1ga");  //реалка

// --- организации ---
$organisations_regnum = $db->select('SELECT registry_number FROM company');
foreach($organisations_regnum as $num) {
	$organisations[] = $num['registry_number'];
}


// выборка id, название организации (title),  ФИО директора (director_person), email, сайт (web_resource), режим работы (schedule), автоинформатор (call_center_phone), сслыка на родительскую орг.-ию (parent)
$result = pg_query($dbconn3, '	SELECT id, title, director_person, email, web_resource, schedule, call_center_phone, parent
								FROM r_state_structure 
								ORDER BY id DESC');

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
		if (in_array($row['id'], $organisations, true)) {
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
echo $text;

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



$db->revertDB();
$db->disconnect();