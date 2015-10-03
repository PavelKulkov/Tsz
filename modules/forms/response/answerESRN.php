<?php
	$answer = $smevClient->getAnswerFile();
	$xml = simplexml_load_file($answer);
	$xml->registerXPathNamespace('smev', 'http://smev.gosuslugi.ru/rev120315');
	$xml->registerXPathNamespace('rinf', 'http://oep-penza.ru/com/oep/esrn/header');
	$result = $xml->xpath('//rinf:RespounseInfo');
	if(count($result)==0){
		die("�� ������ ����� �� ��������� �������! ���������� � ������ ���������!");
	}
	$code = $xml->xpath('//rinf:Code');
	if (count($code)>0){
		$code = $code[0];
		if ($code == '1' || $code == '2' || $code == '3' || $code == '040')	{
			$comment = $xml->xpath('//rinf:Comment');
			echo "<br/>���� ��������� ������� ����������!";
			echo "<br/>".$comment[0];
			$smevClient->comment = $comment[0];
		}else{
			echo "� ��������� �� ������� ��������� ���������.<br/>���������� � �������������� �������!<br/>";
		}
	}else{
		echo "� ��������� �� ������� ��������� ���������.<br/>���������� � �������������� �������!<br/>";
	}

?>