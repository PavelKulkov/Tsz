<?php
			ob_start();
			include($requestForm);
			$query = ob_get_clean();	
            
			$responseSmevValidation = false;
		    include($modules_root."forms/test/callExt.php");
			
			  $data = file_get_contents($smevClient->getAnswerFile());
			  $data = str_replace("ns1:","",$data);
			  $handle = fopen($smevClient->getAnswerFile(),"w");
			  fwrite($handle,$data);
			  fclose($handle);
			  $xml = simplexml_load_file($smevClient->getAnswerFile());
			  $result = $xml->xpath('//item');
			  if(count($result)==0){
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
			  }
			  
			  $list = $result;
			  
			  ?>