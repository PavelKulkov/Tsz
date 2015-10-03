<?php
require_once("../../config.inc.php");
require_once("../../config_system.inc.php");
$authHome = new AuthHome(NULL);
$authHome->initGuestConnection($guestUser);
$db = $authHome->getCurrentDBConnection();
$db->changeDB("regportal_services");
$dbconn3 = pg_connect("host=192.168.1.32 port=5432 dbname=pgmu user=postgres password=postgres");
//очищаем временную таблицу
$db->query("delete from reglaments");
$query = "INSERT INTO reglaments (`reglament_name`,`service_registry_number`) VALUES(?,?)";

$servs = $db->select('select id, registry_number from service_tmp');
foreach ($servs as $serv){
	$result = pg_query($dbconn3, "select f.file_name, fav.fk_regulations from pgmu.favour fav, pgmu.db_file f where fav.id=".$serv['id']." and f.id=fav.fk_regulations");
	while ($row = pg_fetch_row($result)) {
		if ($row[1] != 0){
			$info = $db->insert($query,$row[0], $serv['registry_number']);
			$link = 'http://pgu.pnzreg.ru/favour-catalogue/file?id='.$row[1];
			$ept = copy($link,  'D:\\OpenServer\\domains\\dev-1.oep-penza.ru\\files\\reglaments\\'.$info['insert_id']);
			//$ept = exec('wget '.$link.' -O D:\\OpenServer\\domains\\dev-1.oep-penza.ru\\files\\reglaments\\'.$info['insert_id']);
		}
	}
}
$db->disconnect();
?>