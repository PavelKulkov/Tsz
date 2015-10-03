<?php
			$answer = $smevClient->getAnswerFile();
			$xml = simplexml_load_file($answer);
			$xml->registerXPathNamespace('ns2', 'http://smev.gosuslugi.ru/rev120315');
			$xml->registerXPathNamespace('ns3', 'http://idecs.nvg.ru/privateoffice/ws/types/');
			$result = $xml->xpath('//result');
			if(count($result)==0){
				die("Не верный ответ от удаленной системы! Обратитесь в службу поддержки!");
			}
			$putQueSession = $xml->xpath('//putQueSession');
			if (count($putQueSession) > 0){
				$guidSession = $xml->xpath('//guidSession');
				$smevClient->outId = $guidSession[0];
				if ($smevClient->exchangeCode == 7){
					if ($result[0] == "true"){
						echo "<br/>Заявка на запись на прием отправлена! Ваш номер заявки ".$guidSession[0]."";
						echo "<script>localStorage.setItem('".$guidSession[0]."', true)</script>";
					}else {
						echo "<br/>К сожалению не удалось записаться на выбранное вами время!";
					}
				}else{
					echo "<br/>К сожалению не удалось записаться на выбранное вами время!";
				}
			}else{
				$comment = $xml->xpath('//ns3:comment');
				$idZags = $xml->xpath('//idZags');
				echo "<br/>".$comment[0];
				if ($smevClient->exchangeCode == 7){
					$extOrderNumber = $xml->xpath('//ns3:extOrderNumber');
					$smevClient->outId = $extOrderNumber[0];
					echo "<br/>Внимание! После того, как вашу заявку одобрят, вам необходимо будет записаться на прием, перейдя по ссылке из личного кабинета. <br/> Ваш номер заявки ".$extOrderNumber[0]."";
				}
			}
?>