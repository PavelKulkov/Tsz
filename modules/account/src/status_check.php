<?php
	$query = "";
	$date = new DateTime();
	$nowTimeWithFormat  = $date->format('Y-m-d');
	$nowTimeWithFormat .= "T".$date->format('H:i:s.')."228Z";
	
	$passInfo = $db->selectCell('SELECT a.passInfo, r.id_subservice
                                 FROM request r, auth a
                                 WHERE r.id_auth = a.id AND
						               r.id = ? AND
						               r.id_subservice = ?',
					$idRequest,
					$id_subservice);
	if(!isset($passInfo) ||
	   $passInfo===false){
	  echo "<b>Uncheckable status!</b>";   
	  return;
	}
	if($passInfo!=$_SESSION['login']){
	  echo "<b>Request for other user</b>";
	  return;
	}
	
	/*
	  TODO: check subservice on digital form 
	*/
	$regNum = $db->selectCell('SELECT registry_number FROM regportal_services.subservice WHERE id=?',$id_subservice);
/*	$registrNumber = $regNum;
	//$esrn = array("5800000010000014261", "5800000010000013584", "3", "4");	//перенесено в конфиг
	if (in_array($regNum, $esrn)) {
	    $registrNumber = "ESRN";
	}	*/
	
	$requestForm = $modules_root.'forms/status/check_'.$regNum.'.php';
	$db->changeDB("regportal_services");
	$is_form_generate = $db->selectCell('SELECT `generated` FROM `forms` WHERE id = (SELECT `form_id` FROM `subservice` WHERE `id` = ?)', $id_subservice);
	$db->revertDB();
	if(!file_exists($requestForm)){
		switch ($is_form_generate) {
			case 0:
				echo "Проверка статуса для данной услуги не возможна.<br/>";
				return;
			case 1:
				$requestForm = $modules_root.'generate/src/xmlStatus.php';
			    break;
			case 2:
				$requestForm = $modules_root.'forms/status/check_ESRN.php';
			    break;
			default:
				echo "Проверка статуса для данной услуги не возможна.<br/>";
				return;
		}	
	}
    
	ob_start();
	$responseSmevValidation = true;
	include($requestForm);
	
	$query = ob_get_clean();
	
	$subservice_id = $id_subservice;
	$result = include($modules_root."forms/test/callExt.php");
	
	$answer = $smevClient->getAnswerFile();
	
	$data = file_get_contents($answer);
	$result = str_replace('oep:', '', $data);
	file_put_contents($answer, $result);
	$comment = '';
	$user_action = NULL;	//ожидаемое дествие пользователя	
	try {
		$xml = simplexml_load_file($answer);
		$xml->registerXPathNamespace('smev', 'http://smev.gosuslugi.ru/rev120315');
		
		if ($xml===false) {
			throw new Exception('Не верный ответ от сервиса, попробуйте попытку позже!');
		}
		if (isset($isZagsService)&&$isZagsService){
			include("check_zags.php"); 
		}else{
			$dataRow = $xml->xpath("//dataRow");
			$list = array();
			foreach($dataRow as $node){
				$children = $node->children();
				$param = array();
				foreach($children as $child){
					list(,$value) = each($child);
					$param[$child->getName()] = $value;
				}
				$list[$param['name']] = $param['value'];
			}
			if (isset($list['comment'])) {
				$comment =$list['comment'];
			} else {
				$status_title = $xml->xpath("//status_title");
				if (isset($status_title[0]))
					$comment = $status_title[0];
				else
					$comment = $smevClient->comment;
			}
			
			$status_pgu = $xml->xpath("//status_pgu");
			if (isset($status_pgu[0])) {
				$status = $status_pgu[0];
			}
			if (!isset($status)) {
				if (isset($list['resultType'])) {
					$status =$list['resultType'];
				}else{
					$status_code = $xml->xpath("//status_code");
					if (isset($status_code[0])){
						switch ($status_code[0]) {
							case "В обработке":
								$status = 2;
								break;
							case "Исполнено":
								$status = 3;
								break;		//Ниже описаны статусы, которые нужно будет убрать. Из СИУ передается текст, нужно в маршрутах заменить на код, и всегда передавать код 
							case "На ожидании":
								$status = 14;
								break;
							case "На рассмотрении":
								$status = 15;
								break;
							case "На регистрации":
								$status = 16;
								break;
							case "Лично предоставляемые документы получены, документы, получаемые посредством межведомственного взаимодействия ожидаются":
								$status = 17;
								break;
							default:
								//$comment = ($comment == '') ? $status_code[0] : $status_code[0].";<br/>".$comment;
								$status = (is_int($status_code[0]) && $status_code[0] > 17) ? 2 : $status_code[0];
								break;
						}
					}
				}
			}
			//перевод в коды портала
			if (isset($status)) {
				switch ($status) {
					case 2:
						$status = 8;
						break;
					case 3:
						$status = 10;
						break;
					case 4:
						$status = 9;
						break;
				}
			} else {
				return;
			}			
		}
		$appDocument = $xml->xpath("//smev:AppDocument");
		if (isset($appDocument[0])) {
			$appDocument = $appDocument[0];
			$binaryData  = $xml->xpath("//smev:BinaryData");
			if (isset($binaryData[0])) {
				$binaryData = $binaryData[0];
				$originRequestIdRef = $xml->xpath("//smev:OriginRequestIdRef");
				if (isset($originRequestIdRef[0])) {
					$originRequestIdRef = $originRequestIdRef[0];
					$fileName = 'Result_'.$originRequestIdRef.'.zip';
					file_put_contents("/tmp/".$fileName, base64_decode($binaryData));
					$fileUrl = "/files/download.php?name=/".$fileName;
				}
			}
		} 
	} catch (Exception $e) {
		$comment =  $e->getMessage();
		$status = 7;
	}
	
	require_once($modules_root."forms/class/Forms.class.php");
	if(!isset($forms)) $forms = new Forms($request, $db);
	if(!isset($id_out)) $id_out = $idRequest;
	
	$forms->saveResponse($data, $idRequest, $status, $id_out, $date, $comment, $user_action);	
?>
