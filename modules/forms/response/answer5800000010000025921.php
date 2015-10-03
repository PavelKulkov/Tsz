<?php
		if (($smevClient->exchangeCode==0 || $smevClient->exchangeCode==7)){
			
			  $answer = $smevClient->getAnswerFile();
			  $data = file_get_contents($answer);
			  $data = str_replace("ns1:","",$data);
			  $handle = fopen($answer,"w");
			  fwrite($handle,$data);
			  fclose($handle);
			  $xml = simplexml_load_file($answer);
			  $result = $xml->xpath('//error');
			  if(count($result)==0){
				die("Не верный ответ от удаленной системы! Обратитесь в службу поддержки!");
			  }
			  $param = array();
			  foreach($result as $node){
			    $children = $node->children();
			    for($i=0;$i<count($children);$i++){
				  $value = $children[$i];
				  $param[$value->getName()] = $value; 
				}
			  }
			  $result = $xml->xpath('//eServiceResult');
			  foreach($result as $node){
			    $children = $node->children();
			    for($i=0;$i<count($children);$i++){
				  $value = $children[$i];
				  $param[$value->getName()] = $value; 
				}
			  }			  
			  if(isset($param['errorCode'])&& $param['errorCode']!='0'){
			    echo ".В удаленной ситеме произошла ошибка:".$param['errorMessage'];
                                                              return;
			  }
			  echo ".Внимание Ваш номер заявки ".$param['extOrderNumber'].". Запомните или сохраните его на локальном компьютре.";
			  
		}
			  
			  
?>