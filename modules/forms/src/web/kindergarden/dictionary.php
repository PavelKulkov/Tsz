<?php
			ob_start();
			include($requestForm);
			$query = ob_get_clean();	
            
			$responseSmevValidation = false;
		    include($modules_root."forms/test/callExt.php");
			if($smevClient->getExchangeCode()==0){

			
			  $answer = $smevClient->getAnswerFile();
			  $data = file_get_contents($answer);
			  $data = str_replace("ns1:","",$data);
			  $handle = fopen($answer,"w");
			  fwrite($handle,$data);
			  fclose($handle);
			  $xml = simplexml_load_file($answer);
			  $result = $xml->xpath('//return');
			  if(count($result)==0){
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
			  }
			  $list = array();
			  foreach($result as $node){
			     $children = $node->children();
			     $param = array();
			     foreach($children as $child){
			        list(,$value) = each($child);
			        $param[$child->getName()] = $value; 
			     }
                                                               $list[$param['id']] = $param['name'];
			  }

		    }
?>