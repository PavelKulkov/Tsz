<?php
	require_once($modules_root."documentation/class/Documentation.class.php");
	require_once($modules_root."general/class/Paginator.class.php");
	
	if(!isset($doc)) $doc = new Documentation($request, $db);
				$groups = $doc->getGroupsOfDocs();
				$docs = $doc->getDocs();
				
				/*
				$limit = 50;
				if(!isset($paginatorObj)) $paginatorObj = new Paginator($request, $db, "documentation", $limit, $admin);
				$count = $paginatorObj->getCountGlobal();
				$paginator = $paginatorObj->getPaginator($request, "documentation", $count);
				
		
				$list = $paginatorObj->getListGlobal($paginator['index'], "title");
				*/
				
			
	include ($modules_root.'documentation/view/doc.php');	
  	
?>