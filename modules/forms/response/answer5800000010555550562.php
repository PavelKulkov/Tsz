<?php
	$answer = $smevClient->getAnswerFile();
	$xml = simplexml_load_file($answer);
	
	$xml->registerXPathNamespace('smev', 'http://smev.gosuslugi.ru/rev120315');

	$rows = $xml->xpath('//Row');
	
	foreach ($rows as $row) {
	
	echo "<hr><br><table class='table table-condensed'>";
	
		$cells = $row->xpath('//Cell');
		$i = 0;
		foreach ($row as $cel) {
			$cell = $cells[$i];
			
			if ($cell[0]->attributes()->name == "number")
				echo "<tr><td <td width='23%'><i>Номер запроса:</i></td><td><strong>".$cel[0]."</strong></td></tr>";
			
			if ($cell[0]->attributes()->name == "date")
				echo "<tr><td><i>Дата запроса:</i></td><td><strong>".$cel[0]."</strong></td></tr>";
			
			if ($cell[0]->attributes()->name == "time")
				echo "<tr><td><i>Время запроса:</i></td><td><strong>".$cel[0]."</strong></td></tr>";
			
			if ($cell[0]->attributes()->name == "status")
				echo "<tr><td><i>Статус запроса:</i></td><td><strong>".$cel[0]."</strong></td></tr>";
			
			if ($cell[0]->attributes()->name == "agency_fullname")
				echo "<tr><td><i>Название организации:</i></td><td><strong>".$cel[0]."</strong></td></tr>";

			if ($cell[0]->attributes()->name == "service_fullname")
				echo "<tr><td><i>Название услуги:</i></td><td><strong>".$cel[0]."</strong></td></tr>";
			
			if ($cell[0]->attributes()->name == "date_planed")
				echo "<tr><td><i>Дата выдачи результата:</i></td><td><strong>".$cel[0]."</strong></td></tr>";
			
			$i++;
		}
	
	echo "</table><br>";
	}
	
	if (!$rows) {
		echo "<br><br><br><h3>Информация не найдена!</h3>";
	}


 
?>
