<?php
			ob_start();
			include($requestForm);
			$query = ob_get_clean();	
            //die($query);
			$responseSmevValidation = false;
		
		    include($modules_root."forms/test/callExt.php");
			

			$data = file_get_contents($smevClient->getAnswerFile());
			$data = str_replace("tns:","",$data);
			$handle = fopen($smevClient->getAnswerFile(),"w");
			fwrite($handle,$data);
			fclose($handle);
			$xml = simplexml_load_file($smevClient->getAnswerFile());
			$result = $xml->xpath('//cancelResult');
			if(count($result)==0){
				die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
			}
		
			
			$list = $result;
			  
?>