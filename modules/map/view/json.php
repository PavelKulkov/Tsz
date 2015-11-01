<?php
    $host='localhost'; // имя хоста (уточняется у провайдера)
    $database='regportal_cms'; // имя базы данных, которую вы должны создать
    $user='root'; // заданное вами имя пользователя, либо определенное провайдером
    $pswd=''; // заданный вами пароль
	$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
	mysql_select_db($database) or die("Не могу подключиться к базе.");
	
	function getTable($query){
       $res = mysql_query($query);
	    return $res;
	}
	$res1 = getTable("SELECT * FROM `registered_home`");
	$res2 = getTable("SELECT * FROM `request`");
	
	$registeredHome = array();
	$request = array();
	    //Заполнение массива для отправки
	while($row1 = mysql_fetch_array($res1)){
		$registeredHome[] = array("id" => $row1["id"], "breadth" => $row1["breadth"], "longitude" => $row1["longitude"], "street_name" => $row1["street_name"] );
	}
	
	//Заполнение массива для отправки
	/*while($row2 = mysql_fetch_array($res2)){
		$request[] = array("id" => $row2["id"], "text" => $row2["text"], "$request" => $row2["$request"], "id_register_home" => $row2["id_register_home"] );
	}*/

	switch ($_REQUEST['action']) {
    //Передача данных из таблицы registered_home
    case 'registeredHome':
		echo json_encode($registeredHome);
        break;
	/*case 'request':
	    echo json_encode($request);
        break;*/
	}
?>