<?php

			ob_start();
			include($requestForm);
			$query = ob_get_clean();	
            //die($query);
			$responseSmevValidation = false;
			
		    include($modules_root."forms/test/callExt.php");

		    

		    $answer = $smevClient->getAnswerFile();
		    
		    $data = file_get_contents($answer);
		    $result = str_replace('oep:', '', $data);
		    file_put_contents($answer, $result);
		    $xml = simplexml_load_file($answer);

		    $dataRow = $xml->xpath("//dataRow");
		    
			
			if(count($result)==0){
				$dataRow = '';
			}
			
			$list = $dataRow;
			  
?>