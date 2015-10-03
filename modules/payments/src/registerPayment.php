<?php 			
			require_once("../../../config.inc.php");
			require_once("../../../config_system.inc.php");
			$modules_root = "../../../".$modules_root;
			$template_dir = "../../../".$template_dir;			
			
			$authHome = new AuthHome(null);
			$authHome->initGuestConnection($guestUser);
//			if ($authHome->checkSession()!=1)
//				die("Функционал доступен только авторизованным пользователям!");
			$db = $authHome->getCurrentDBConnection();
			$moduleHome = new ModuleHome($modules_root,$db);
			$domenHome = new DomenHome($request,$db);
			$templateHome = new TemplateHome($db);
			$log = new Logger($db);
			
			require_once($modules_root."forms/class/SmevException.class.php");
			require_once($modules_root."payments/class/UUID.class.php");
			
			require_once($modules_root."../core/class/url/ServiceURL.class.php");
			require_once($modules_root."forms/class/SmevClient.class.php");
			require_once($modules_root."forms/class/SmevException.class.php");
			
			$date = new DateTime();
			$billDate = $date->format('Y-m-d');
			$nowTimeWithFormat  = $date->format('Y-m-d');
			$nowTimeWithFormat .= "T".$date->format('H:i:s.')."228Z";
			$requestUUID = "";
			$paymentUUID = "";
			
			$query = "";
			ob_start();
			
			$responseSmevValidation = true;
			unset($url);
			
			if ((double)$_POST['total_amount'] > 1500000){
				$error = array('error'=>'Нельзя производить оплату на сумму более 15000 рублей');
				die(json_encode($error));
			}
			
			$operation = $_POST['soapAction'];
			if (!isset($operation)){
				$error = array('error'=>'Не указана требуемая операция');
				die(json_encode($error));
			}
											
			if ($operation == 'registerPaymentRequest'){
				$requestUUID = UUID::v4();
				$paymentUUID = UUID::v4();	
				//TODO регистрируем платеж в нашей базе
				$requestForm = $modules_root.'payments/src/requests/registerPaymentRequestDB.php';	
				include $modules_root."payments/src/requests/callPaymentService.php";
				$data = file_get_contents($smevClient->getAnswerFile());
				$data = str_replace("rp:","",$data);
				$data = str_replace("oep:","",$data);
				$handle = fopen($smevClient->getAnswerFile(),"w");
				fwrite($handle,$data);
				fclose($handle);
				$xml = simplexml_load_file($smevClient->getAnswerFile());
				$params = $xml->xpath('//params');
				if(count($params)==0){
					$error = array('error'=>'Не верный ответ от сервиса, не удалось сохранить данные в платежной базе. Обратитесь в службу поддержки!');
					die(json_encode($error));
				}
				$params = $params[0];
				$status_code = $params->xpath('//status_code');
				if (count($status_code)==0 || $status_code[0] != "01"){
					$status_title = $params->xpath('//status_title');
					if ((count($status_title) !=0 && $status_title[0] != ""))
						$text = (string)$status_title[0];
					else
						$text = 'Не верный ответ от сервиса, не удалось сохранить данные в платежной базе. Обратитесь в службу поддержки!';
					$error = array('error'=> $text);
					die(json_encode($error));
				}
			}
			
			$requestForm = $modules_root.'payments/src/requests/registerPaymentRequest.php';
			
			include $modules_root."payments/src/requests/callPaymentService.php";
			
			$answerName = $smevClient->getAnswerFile(); 	//	"/tmp/respYiSNNv";
			$data = file_get_contents($answerName);
			$data = str_replace("SOAP-ENV:","",$data);
			$data = str_replace("ns1:","",$data);
			$handle = fopen($answerName,"w");
			fwrite($handle,$data);
			fclose($handle);
			$xml = simplexml_load_file($answerName);
			
			$fault = $xml->xpath('//Fault');
			if (count($fault) > 0){
				$faultArr = array('error'=>$fault[0]);
				echo json_encode($faultArr);
			}else{
				if ($operation == 'registerPaymentRequest'){
						$result = $xml->xpath('//responseResult');
						if(count($result)==0){
							$error = array('error'=>'Не верный ответ от сервиса. Обратитесь в службу поддержки!');
							die(json_encode($error));
						}else{
							$result = $result[0];
							$resultCode = $result->xpath('//resultCode');
							$formURL = $result->xpath('//formURL');
							if (count($formURL)==0 || count($resultCode)==0 || ($resultCode[0] != "0" && $resultCode[0] != 0) ){
								$error = array('error'=>'Не верный ответ от сервиса. Ссылка не получена. Обратитесь в службу поддержки!');
								die(json_encode($error));
							}else{
								//Сохраняем formURL для текущего платежного поручения
								$form_url = $formURL[0];
								$_POST["operation"] = "setPaymentFormURL";
								$_POST["data_id"] = $paymentUUID;
								$_POST["data"] = htmlspecialchars($form_url[0]);
								$requestForm = $modules_root.'payments/src/requests/getData.php';
								include $modules_root."payments/src/requests/getDataParse.php";
								//возвращем результат - ссылку на форму оплаты
								if ($authHome->checkSession()!=1)
									$resultUrl = array('data'=>$form_url, 'paymentUUID'=>$paymentUUID);
								else
									$resultUrl = array('data'=>$form_url);
								echo json_encode($resultUrl);
							}
						}
				}elseif($operation == 'clarifyCommissionRequest'){
					$clarifyCommissionResult = $xml->xpath('//clarifyCommissionResult');
					if(count($clarifyCommissionResult)==0){
						$error = array('error'=>'Не верный ответ от сервиса. Обратитесь в службу поддержки!');
						die(json_encode($error));
					}else{
						$clarifyCommissionResultArr = array('data'=>$clarifyCommissionResult[0]);
						echo json_encode($clarifyCommissionResultArr);
					}
				}elseif($operation == 'receiveCommissionRequest'){
					$receiveCommissionResult = $xml->xpath('//receiveCommissionResult');
					if(count($receiveCommissionResult)==0){
						$error = array('error'=>'Не верный ответ от сервиса. Обратитесь в службу поддержки!');
						die(json_encode($error));
					}else{
						$receiveCommissionResultArr = array('data'=>$receiveCommissionResult[0]);
						echo json_encode($receiveCommissionResultArr);
					}
				}
			}
?>