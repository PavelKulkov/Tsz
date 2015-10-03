<?php 
			include($requestForm);
			
			$query = ob_get_clean();

			$serviceURL = new ServiceURL($db);
			if (isset($subservice_url_id)) {
				$url = $serviceURL->getUrlById($subservice_url_id);
			} else {
				$url = $serviceURL->getUrlBySubserviceAndAction($subservice_id, $soapAction);
			}
			if (empty($url)) {
				throw new Exception("Невозможно отправить данные, адрес отправки URL недоступен."); 
			}
			if (strlen($query) == 0) {
				throw new Exception("Запрос не сформирован.");
			}
			
			$sign = true;
			$port = $smevService[1];
			$address = $smevService[0];
			$smevClient = new SmevClient($db,$forms);
			$smevResult = "";
			try{
				$smevClient->signType = "signUnitaler";
				$smevClient->open($address, $port);
				$smevClient->setValidatingSmevFormat(false);
				$smevClient->setSoapAction($soapAction);
				$smevClient->saveQuery($query,$idRequest,$date);
				$smevClient->setReadTimeOut(1200);
				$smevClient->remoteRun($url,$sign);
			}catch(SmevException $e){
			  if($e->isWarning()){
				$log->warning("FormDataError,".$subservice_id, $e->getMessage());
			  }else{
				$log->error("ConnectionError,".$address.",".$subservice_id, $e->getMessage());
			  }
			  $smevResult = $e->getMessage();
			  echo $smevResult;
			  $smevClient->close();
			  return false;
			}
			$smevClient->close();
?>