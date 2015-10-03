<?php
include CONTROLLERS_ROOT.'formsController.php';
include MODELS_ROOT.'Forms.php';

class accountController extends AppController  {

	function __construct() {
		parent::__construct();
	}

	
	function index() {
		self::$db->changeDB("regportal_share");
		
		if(isset($_GET['request_id']) && $_GET['request_id'] != '') {
			$idRequest = $_GET['request_id'];
			$id_subservice = $_GET['id_subservice'];
			$id_out = isset($_GET['outId']) ? $_GET['outId'] : null; 
			
			if(isset($_GET['outId'])) {
				$id_out = $_GET['outId'];
			}
			
			$this->checkStatus($idRequest, $id_subservice);
			//include MODULES_ROOT.'/account/src/status_check.php';
		}
		
		$requests = self::$model->showRequests($_SESSION['ID']);
		$requests_count = count($requests);
		
		$requests_paginator = new Paginator(self::$request, self::$db, 'account');
		$paginator = $requests_paginator->getPaginator($request, "/account", $requests_count);
		$requests_paginator->setOrder(true);				
		$requests = $requests_paginator->getListSql($paginator['index'], 'SELECT a.id, a.startTime, r.id, r.id_subservice, r.time, rs.state, rs.id_request, rs.id_out, rs.comment, sub.s_name, sub.registry_number
																			FROM regportal_share.auth a
																			LEFT JOIN regportal_share.request r ON a.id = r.id_auth
																			LEFT JOIN regportal_share.response rs ON r.id = rs.id_request
																			LEFT JOIN regportal_services.subservice sub ON r.id_subservice = sub.id
																			WHERE a.id=r.id_auth AND
																			      a.passInfo = "'.$_SESSION['login'].'" AND
																			      r.id = rs.id_request AND
																			       rs.state >= 7 AND rs.state <= 10 AND 
																			  rs.time = (
																			   SELECT MAX(TIME) FROM regportal_share.response WHERE response.id_request = r.id 
																			  ) 
																			GROUP BY r.id', 'rs.id');

		self::$view->setVars(array('requests' => $requests, 'status' => $status));
        self::$view->render('index');
        
		self::$db->revertDB();
	}
	
	
	function checkStatus($idRequest, $id_subservice) {
		global $smevService;
		global $siuRecipient;
		
		$query = '';
		$date = new DateTime();
		$nowTimeWithFormat  = $date->format('Y-m-d');
		$nowTimeWithFormat .= "T".$date->format('H:i:s.')."228Z";
		
		$passInfo = self::$db->selectCell('SELECT a.passInfo, r.id_subservice
				FROM request r, auth a
				WHERE r.id_auth = a.id AND
				r.id = ? AND
				r.id_subservice = ?',
				$idRequest,
				$id_subservice);
		if(!isset($passInfo) ||
				$passInfo === false){
			echo "<b>Uncheckable status!</b>";
			return;
		}
		if($passInfo != $_SESSION['login']){
			echo "<b>Request for other user</b>";
			return;
		}
		
		/*
		TODO: check subservice on digital form
		*/
		$regNum = self::$db->selectCell('SELECT registry_number FROM regportal_services.subservice WHERE id= ?', $id_subservice);
		$requestForm = CONTROLLERS_ROOT.'forms/status/check_'.$regNum.'.php';
		if(!file_exists($requestForm)){
			echo "Проверка статуса для данной услуги не возможна.<br/>";
			return;
		}
		
		ob_start();
		$responseSmevValidation = true;
		include($requestForm);
		
		$query = ob_get_clean();
		
		$subservice_id = $id_subservice;
		//$result = include(CONTROLLERS_ROOT."forms/test/callExt.php");
		//$formsController = new formsController();
		
		
		formsController::$forms = null;
		$result = formsController::callExt($query, $date, $_GET['request_id'], $subservice_url_id, $subservice_id, $soapAction, $responseSmevValidation);
		
		$answer = $result;
		
		$data = file_get_contents($result);
		$result = str_replace('oep:', '', $data);
		file_put_contents($answer, $result);
		$comment = '';
		try {
			$xml = simplexml_load_file($answer);
		
			if ($xml===false) {
				throw new Exception('Не верный ответ от сервиса, попробуйте попытку позже!');
			}
		
			if (isset($isZagsService) && $isZagsService) {
				$this->checkZags();
				//include("check_zags.php");
			} else {
				$dataRow = $xml->xpath("//dataRow");
				$list = array();
				foreach($dataRow as $node){
					$children = $node->children();
					$param = array();
					foreach($children as $child){
						list(,$value) = each($child);
						$param[$child->getName()] = $value;
					}
					$list[$param['name']] = $param['value'];
				}
				
				if (isset($list['comment'])) {
					$comment =$list['comment'];
				} else {
					//$comment = $smevClient->comment;
					$comment = '';
				}
					
				$status_pgu = $xml->xpath("//status_pgu");
				
				if (isset($status_pgu[0])) {
					$status = $status_pgu[0];
				}
				
				if (!isset($status)) {
					if (isset($list['resultType'])) {
						$status =$list['resultType'];
					} else {
						$status_code = $xml->xpath("//status_code");
						if (isset($status_code)) {
							switch ($status_code) {
								case "В обработке":
									$status = 2;
									break;
								case "Исполнено":
									$status = 3;
									break;
							}
						}
					}
				}
				
				//перевод в коды портала
				if (isset($status)) {
					switch ($status) {
						case 2:
							$status = 8;
							break;
						case 3:
							$status = 10;
							break;
						case 4:
							$status = 9;
							break;
					}
				} else {
					return;
				}
			}
		} catch (Exception $e) {
			$comment =  $e->getMessage();
			$status = 7;
		}
		
		//require_once(CONTROLLERS_ROOT."forms/class/Forms.class.php");
		//if(!isset($forms)) $forms = new Forms(self::$request, self::$db);
		if(!isset($id_out)) $id_out = $idRequest;
		self::$model = new Forms(null, self::$db);
		self::$model->saveResponse($data, $idRequest, $status, $id_out, $date, $comment);
		self::$model = new Account(null, self::$db);
		self::$request->headerLocation('account', 'index');
	}
	
	
	function checkZags() {
		$status = 4;
		
		$xml->registerXPathNamespace('ns2', 'http://smev.gosuslugi.ru/rev120315');
		$result = $xml->xpath('//result');
		if(isset($result)&&count($result)>0){
			$statusService = $xml->xpath('//statusService');
			if (isset($statusService)&&(count($statusService) > 0)){
				$statusService = $statusService[0];
				switch ($statusService) {
					case "ST_SERV_NO":	//Статус не определён
						$status = 7;
						break;
					case "ST_SERV_EXEC":		//Услуга выполняется
						$status = 8;
						break;
					case "ST_SERV_WAITUSER":	//Ожидается действие пользователя: оказание услуги при этом не останавливается
						$status = 8;
						break;
					case "ST_SERV_END_OK":	//Услуга оказана успешно
						$status = 10;
						break;
					case "ST_SERV_END_CANC_ZAGS":	//Услуга отменена органом ЗАГС
						$status = 9;
						break;
					default:
						$status = 7;
						break;
				}
			}
			$items = $xml->xpath('//items');
			if (($smevClient->exchangeCode == 7)&&isset($items)&&(count($items) > 0)){
				$comment = "";
				foreach($items as $item){
					$comment .= $item->numPP.")"." ".$item->dat." - ".$item->text."<br/>";
				}
			}
		}
	}
	
}
