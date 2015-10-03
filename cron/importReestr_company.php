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

//echo $text;


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

$db->revertDB();
$db->disconnect();