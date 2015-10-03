<?php
	$answer = $smevClient->getAnswerFile();
	$xml = simplexml_load_file($answer);
	$xml->registerXPathNamespace('smev', 'http://smev.gosuslugi.ru/rev120315');
	$xml->registerXPathNamespace('rinf', 'http://oep-penza.ru/com/oep/esrn/header');
	$result = $xml->xpath('//rinf:RespounseInfo');
	if(count($result)==0){
		die("Не верный ответ от удаленной системы! Обратитесь в службу поддержки!");
	}
	$code = $xml->xpath('//rinf:Code');
	if (count($code)>0){
		$code = $code[0];
		if ($code == '1' || $code == '2' || $code == '3' || $code == '040')	{
			$comment = $xml->xpath('//rinf:Comment');
			echo "<br/>Ваше заявление успешно отправлено!";
			echo "<br/>".$comment[0];
			$smevClient->comment = $comment[0];
		}else{
			echo "К сожалению не удалось отправить заявление.<br/>Обратитесь к администратору системы!<br/>";
		}
	}else{
		echo "К сожалению не удалось отправить заявление.<br/>Обратитесь к администратору системы!<br/>";
	}

?>