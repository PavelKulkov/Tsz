<?php


$requestForm = $modules_root.'payments/src/requests/getData.php';
include $modules_root."payments/src/requests/getDataParse.php";

/*require_once($modules_root."payments/class/Payment.class.php");

$db->changeDB("regportal_payments");
if(!isset($payment))	$payment = new Payment($db);
			
	switch ($_GET['operation']) {
		case "getSuppliers" : {
			//$list = $payment->getSuppliers();
			$requestForm = $modules_root.'payments/src/requests/getSuppliers.php';
			include $modules_root."payments/src/requests/getSuppliersParse.php";
			break;
		}
		case "getOrgService" : {
			$list = $payment->getOrgService($_GET['supplier_id']);
			break;
		}
		case "getOrgAccounts" : {
			$list = $payment->getOrgAccounts($_GET['supplier_id']);
			break;
		}
		case "getOrgAddress" : {
			$list = $payment->getOrgAddress($_GET['supplier_id']);
			break;
		}
		case "getOrgContacts" : {
			$list = $payment->getOrgContacts($_GET['supplier_id']);
			break;
		}
		case "registerPayment" : {	//TODO добавление в базу + отправка XML
			$requestForm = $modules_root.'payments/src/registerPayment.php';
			break;
		}
		case "registerPaymentRequest" : {	//TODO сделать формирование XML
			$requestForm = $modules_root.'payments/src/registerPaymentRequest.php';
			ob_start();
			include($requestForm);
			$query = ob_get_clean();	
			$list = $query;
			//include $modules_root."payments/src/registerPaymentParse.php";
			break;
		}
		default: {
			$list = 'Non supported operation';
		}
	}

$db->revertDB();
*/