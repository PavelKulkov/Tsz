<?php		
		ob_start();
		include($requestForm);
		$query = ob_get_clean();
		try {
			if (true){
				$responseSmevValidation = false;
				include($modules_root."forms/test/callExt.php");
			
				$data = file_get_contents($smevClient->getAnswerFile());
				$data = str_replace("oep:","",$data);
				$handle = fopen($smevClient->getAnswerFile(),"w");
				fwrite($handle,$data);
				fclose($handle);
				$xml = simplexml_load_file($smevClient->getAnswerFile());
				$result = $xml->xpath('//result');
				if(count($result)==0){
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
				}
				$params = $xml->xpath('//params');
				if(count($result)==0){
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
				}
				$params = $xml->xpath("//params");
				if(count($params)==0){
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
				}
				$list = $params[0];
				$status_code = $xml->xpath("//status_code");
				if (isset($status_code)&&count($status_code) > 0){
					$status_code = $status_code[0];
					$meta = "AuthSMSResponse,".$_SERVER['REMOTE_ADDR'];
					$log->info($meta, $status_code);
				}
				$status_title = $xml->xpath("//status_title");
				if (isset($status_title)&&count($status_title) > 0)
					$status_title = $status_title[0];
			}else
				$list = $password."|".$phone;
			//$db->changeDB("regportal_share");
			$pass = new Pass($request, $db);
			$pass->saveLogin($password, $phone);
		} catch (Exception $e) {
			$list = $e->getTraceAsString();
		}
?>