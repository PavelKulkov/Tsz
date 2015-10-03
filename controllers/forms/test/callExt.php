<?php
require(CONTROLLERS_ROOT."../core/class/url/ServiceURL.class.php");
require(CONTROLLERS_ROOT."forms/class/SmevClient.class.php");


$serviceURL = new ServiceURL(self::$db);
if (isset($subservice_url_id)) {
	$url = $serviceURL->getUrlById($subservice_url_id);
} else {
	$url = $serviceURL->getUrlBySubserviceAndAction($subservice_id, $soapAction);
}

if (empty($url)) {
	throw new Exception("Невозможно отправить данные, адрес отправки URL недоступен."); 
}
 
if (strlen($query) == 0) {
	throw new Exception("Запрос не сформирован.");
}


if(!isset($responseSmevValidation)) $responseSmevValidation = true;
if(!isset($sign))$sign = true;
$port = $smevService[1];
$address = $smevService[0];

$smevClient = new SmevClient(self::$db,$forms);
$smevResult = "";
$account_ref = '<br/><a class="btn btn-success" href="/account">В личный кабинет<i class="icon-chevron-right icon-white"></i></a>';

try{
	$smevClient->open($address, $port);
	$smevClient->setValidatingSmevFormat($responseSmevValidation);
	$smevClient->setSoapAction($soapAction);
	$smevClient->saveQuery($query,$idRequest,$date);
	$smevClient->setReadTimeOut(3600);
	$smevClient->remoteRun($url,$sign);
	$smevResult = 'Заявка успешно принята'.$account_ref;
}catch(SmevException $e){
  if($e->isWarning()){
  	$log->warning("FormDataError,".$subservice_id, $e->getMessage());
  }else{
  	$log->error("ConnectionError,".$address.",".$subservice_id, $e->getMessage());
  }
  $smevResult = $e->getMessage();
  $smevResult .= $account_ref;
  $smevClient->close();
  return false;
}
$smevClient->close();
?>