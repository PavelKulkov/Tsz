<?php
	require_once($modules_root."documentation/class/Documentation.class.php");
	if(!isset($doc)) $doc = new Documentation($request, $db);

				$limit = 50;
				require_once($modules_root."general/class/Paginator.class.php");
				if(!isset($paginatorObj)) $paginatorObj = new Paginator($request, $db, "documentation", $limit, $admin);
				$count = $paginatorObj->getCountGlobal();
				$paginator = $paginatorObj->getPaginator($request, "documentaion", $count);
				
		
				$list = $paginatorObj->getListGlobal($paginator['index'], "title");
				
				
			
	include ($modules_root.'documentation/view/doc.php');	
  	
?>