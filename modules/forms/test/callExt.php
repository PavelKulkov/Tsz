<?php
require_once($modules_root."../core/class/url/ServiceURL.class.php");
require_once($modules_root."forms/class/SmevClient.class.php");
require_once($modules_root."forms/class/SmevException.class.php");

$serviceURL = new ServiceURL($db);
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
$smevClient = new SmevClient($db,$forms);
$smevResult = "";
$account_ref = '<br/><a class="btn btn-success" href="/account">В личный кабинет<i class="icon-chevron-right icon-white"></i></a>';
try{
	$smevClient->open($address, $port);
	$smevClient->setValidatingSmevFormat($responseSmevValidation);
	$smevClient->setSoapAction($soapAction);
	$smevClient->saveQuery($query,$idRequest,$date);
	$smevClient->setReadTimeOut(1200);
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