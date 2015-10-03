<?php
	$query = "";
	$date = new DateTime();
	$nowTimeWithFormat  = $date->format('Y-m-d');
	$nowTimeWithFormat .= "T".$date->format('H:i:s.')."228Z";
	
	$passInfo = $db->selectCell('SELECT a.passInfo, r.id_subservice
	                                 FROM request r, auth a
	                                 WHERE r.id_auth = a.id AND
							               r.id = ? AND
							               r.id_subservice = ?',
			$idRequest,
			$id_subservice);
	if(!isset($passInfo) ||
			$passInfo===false){
		echo "<b>Uncanceled request!</b>";
		return;
	}
	if($passInfo!=$_SESSION['login']){
		echo "<b>Request for other user</b>";
		return;
	}
	$regNum = $db->selectCell('SELECT registry_number FROM regportal_services.subservice WHERE id=?',$id_subservice);
	$requestForm = $modules_root.'forms/cancels/cancel_'.$regNum.'.php';
	if(!file_exists($requestForm)){
		echo "Отмена для данной услуги не возможна.<br/>";
		return;
	}
	
	ob_start();
	$responseSmevValidation = true;
	include($requestForm);
	
	$query = ob_get_clean();
	
	$subservice_id = $id_subservice;
	$result = include($modules_root."forms/test/callExt.php");
	
	$answer = $smevClient->getAnswerFile();
	$comment = '';
	$user_action = NULL;	//ожидаемое дествие пользователя
	$status = $_GET['state'];
	
	try {
		$xml = simplexml_load_file($answer);
		if ($xml===false) {
			throw new Exception('Не верный ответ от сервиса, попробуйте попытку позже!');
		}
		//$cancel_answer = $modules_root.'forms/cancels/answers/cancel_answer_'.$regNumber.'.php';
		if(isset($cancel_answer)&&file_exists($cancel_answer)){
			include($cancel_answer);
		}
	} catch (Exception $e) {
			$comment =  $e->getMessage();
			$status = 7;
	}
	
	require_once($modules_root."forms/class/Forms.class.php");
	if(!isset($forms)) $forms = new Forms($request, $db);
	if(!isset($id_out)) $id_out = $idRequest;
	
	$forms->saveResponse($data, $idRequest, $status, $id_out, $date, $comment, $user_action);


?>