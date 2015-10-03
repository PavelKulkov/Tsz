<?php
	if (($smevClient->exchangeCode==0 || $smevClient->exchangeCode==7)){
              echo "<br/>";
              $answer = $smevClient->getAnswerFile();
			  $data = file_get_contents($answer);
			  $data = str_replace("xmlns=\"http://gibdd.ru/rev01\"","",$data);
			  $data = str_replace("xmlns=\"http://smev.gosuslugi.ru/rev111111\"","",$data);
			  $data = str_replace("xmlns=\" >","",$data);
			  
			  
			  $handle = fopen($answer,"w");
			  fwrite($handle,$data);
			  fclose($handle);
			  $xml = simplexml_load_file($answer);

			  

			foreach ($xml->xpath('//resultCount') as $status) {
			  
			  if ($status == 0) {
			  
			     echo("<h4>Административных правонарушений не найдено!</h4>");
			     return;  
			 }
	
			
			}
			  
			  $result = $xml->xpath('//Result');
			  if(count($result)==0){
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
			  }
			  
			  
			$label  = array();
			$label['BreachDateTime'] = 'Дата и время нарушения';
			$label['BreachPlace'] = 'Место нарушения';
			$label['DateSSP'] = 'Дата направления судебным приставам';
			$label['DecisionDate'] = 'Дата вынесения постановления';
			$label['DecisionNumber'] = 'Серия и номер постановления';
			$label['UnicNumber'] = 'Уникальный номер дела';
			$label['DocNumber'] = 'Серия и номер первичного материала';
			$label['KOAPText'] = 'Статья КоАП и состав правонарушения';
			$label['ExecDepartment'] = 'Подразделение, выявившее нарушение';
			$label['ExecutionState'] = 'Состояние делопроизводства по нарушению';
			$label['Penalty'] = 'Вид административного наказания';
			$label['DecisionSumma'] = 'Размер штрафа';
			$label['PostNum'] = 'Серия и номер постановления';
			$label['WhoDecided'] = 'Кем вынесено постановление';
			$label['DepartmentDecided'] = 'Подразеление где вынесено постановление';
			$label['SupplierBillID'] = 'Идентификатор платежа в казначействе';
			$label['roskaznaIn'] = 'Признак, что получено подтвержение оплаты из казначейства';
			$label['VehicleModel'] = 'Марка ТС';
			$label['VehicleOwnerCategory'] = 'Категория владельца ТС';
			$label['VehicleRegPoint'] = 'Гос.рег. знак ТС';
			$label['StateName'] = 'Текущее состояние дела';

			  
			  $list = array();
			  $text = '';
			  $text .= '<div class="accordion" id="accordion2">';
			  $j = 1;
			  foreach($result as $node){
			  
                $children = $node->children();
				$params = array();
                for($i=0;$i<count($children);$i++){
                  $key = $children[$i]; 
				  $params[$key->getName()] = $key;
		        }		
						
						$text .= '<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$j.'">
											Номер дела '.$params['UnicNumber'].'
										</a>
									</div>
									<div id="collapse'.$j.'" class="accordion-body collapse">
										<div class="accordion-inner">';
			  			$text .= "
			
                  <table width='700' cellpadding='10' cellspacing='0' border='1'>
                     <tbody>";
					 
					 
                foreach ($params as $key => $value) {
                  if(isset($label[$key])){
                    $text .= " 
				  
                        <tr>
                           <td align='right'>".$label[$key]."</td>
                           <td><strong>".$value."</strong></td>
                        </tr>
				  ";				  
				  }
		        }	
						

						
						
						$text .="
                     </tbody>
                  </table>
				  <br />
				  <br />
				  <br />
			
			";
			$j++;
			$text .= '		</div>
		</div>
	</div>
	';
			  
			  
			  }
			 			
			  $text .= '</div>';
			  $module['text'] = $text;
			  $query = "";
			  $smevClient->exchangeCode = 10;
              $smevClient->comment = 'Проверка статуса не доступна';
		      
	}
			  
			  
			  
				
				
?>