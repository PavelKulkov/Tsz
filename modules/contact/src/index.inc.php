<?php
	require_once($modules_root."contact/class/Contact.class.php");
	if(!isset($contact)) $contact = new Contact($request, $db);
				/*$limit = 10;
				require_once($modules_root."general/class/Paginator.class.php");
				if(!isset($paginatorObj)) $paginatorObj = new Paginator($request, $db, "contact", $limit, $admin);
				$count = $paginatorObj->getCountGlobal();
				$paginator = $paginatorObj->getPaginator($request, "contact", $count);
				
		
				$list = $paginatorObj->getListGlobal($paginator['index'], "title");*/
				$lisServices = $contact->getServices();
				$list = $contact->getCont(1);
	include ($modules_root.'contact/view/contact.php');	
?>