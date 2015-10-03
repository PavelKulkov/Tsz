<?php
	$status = 4;
	
	$xml->registerXPathNamespace('ns2', 'http://smev.gosuslugi.ru/rev120315');
	$result = $xml->xpath('//result');
	if(isset($result)&&count($result)>0){
		$statusService = $xml->xpath('//statusService');
		if (isset($statusService)&&(count($statusService) > 0)){
			$statusService = $statusService[0];
			switch ($statusService) {
				case "ST_SERV_NO":	//Статус не определён
					$status = 7;
					break;
				case "ST_SERV_EXEC":		//Услуга выполняется
					$status = 8;	
					break;
				case "ST_SERV_WAITUSER":	//Ожидается действие пользователя: оказание услуги при этом не останавливается
					$status = 11;
					break;
				case "ST_SERV_END_OK":	//Услуга оказана успешно
					$status = 10;
					break;
				case "ST_SERV_END_CANC_ZAGS":	//Услуга отменена органом ЗАГС
					$status = 9;
					break;
				default:
					$status = 7;
					break;
			}
			if ($status != 7){
				$userActs = $xml->xpath('//userActs');
				if (isset($userActs)&&(count($userActs) > 0)){
					$user_action = "";
					for ($i = 0; $i < count($userActs)-1; $i++) {
						$user_action .= $userActs[$i].",";
					}
					$user_action .= $userActs[count($userActs)-1];
					$idZags = $xml->xpath('//idZags');
					$user_action .= "|".$idZags[0];
					$status = 11;
				}	
			}
		}
		$items = $xml->xpath('//items');
		if (($smevClient->exchangeCode == 7)&&isset($items)&&(count($items) > 0)){
			if ($status == "7") $status = 13;
			$comment = "";
			foreach($items as $item){
				$comment .= $item->numPP.")"." ".substr($item->dat, 0, strlen($item->dat)-1)." - ".$item->text."<br/>";
			}
		}
	}
?>