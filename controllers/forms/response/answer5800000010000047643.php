<?php
			  $answer = $smevClient->getAnswerFile();
			  $xml = simplexml_load_file($answer);
			  $xml->registerXPathNamespace('ns2', 'http://smev.gosuslugi.ru/rev120315');
			  $xml->registerXPathNamespace('ns3', 'http://idecs.nvg.ru/privateoffice/ws/types/');
			  $result = $xml->xpath('//result');
			  if(count($result)==0){
			  	die("Не верный ответ от удаленной системы! Обратитесь в службу поддержки!");
			  }
			  $comment = $xml->xpath('//ns3:comment');
			  echo "<br/>".$comment[0]; 
			  if ($smevClient->exchangeCode == 7){
			  	$extOrderNumber = $xml->xpath('//ns3:extOrderNumber');
			  	$smevClient->outId = $extOrderNumber;
			  	echo "<br/>Внимание! Ваш номер заявки ".$extOrderNumber[0]."";
			  }
?>