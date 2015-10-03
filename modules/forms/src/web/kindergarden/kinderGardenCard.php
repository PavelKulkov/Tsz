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
			  $result = $xml->xpath('//list');
			  if(count($result)==0){
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
			  }

			  $list = array();
			  foreach($result as $node){
			    $children = $node->children();
				
				$param = array();
			    foreach($children as $child){
				
				  list(,$value) = each($child);

				  switch($child->getName()){
				  
				    case "address" : {
					  $addressText = $child->children();
					  $addressText = $addressText[0];
					  
					  list(,$value) = each($addressText);
					  
					  $param['addressText'] = $value;
					  break;
				    }
					case "headName" : {
					  $headName = $child->children();
					  $firstName = $headName[0];
					  list(,$value) = each($firstName);
					  $param['firstName'] = $value;
					}
					default:{
					  $param[$child->getName()] = $value;
					  break;
					}
                  }						   
				}
				if($param['type_descr']!='raion'){
				  $list[$param['id']]=array($param['name'],
				                            $param['addressText'],
											$param['firstName']);	
				}
			  }
			  
			  ?>