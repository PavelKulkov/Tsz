<?php
    $host='localhost'; // имя хоста (уточняется у провайдера)
    $database='regportal_cms'; // имя базы данных, которую вы должны создать
    $user='root'; // заданное вами имя пользователя, либо определенное провайдером
    $pswd=''; // заданный вами пароль
 
    $dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
    mysql_select_db($database) or die("Не могу подключиться к базе.");
    $query = "SELECT * FROM `request`";
    $res = mysql_query($query);

	$mas = array();
	//Заполнение массива для отправки
	while($row = mysql_fetch_array($res)){
		$mas[] = array("id" => $row["id"], "text" => $row["text"]);
	}
    echo json_encode($mas);	
?>