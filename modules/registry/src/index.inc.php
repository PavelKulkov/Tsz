<?php
	
	require_once($modules_root."registry/class/Registry.class.php");
	if(!isset($registry)) $registry = new Registry($request, $db);
	$tsz = false;
	
	if ($request->hasValue('id_tsz')) {
			$id_tsz = $request->getValue('id_tsz');
			if ($id_tsz) $tsz = $registry->getTsz($id_tsz);
			
		}
	
	$url = "?";
	if ($request->hasValue('id'))
		$url .=  "id=".$request->getValue('id')."&";
	$limit =5;
	require_once($modules_root."general/class/Paginator.class.php");
	if(!isset($paginatorObj)) $paginatorObj = new Paginator($request, $db, "registry", $limit, $admin);
	$count = $paginatorObj->getCountGlobal();
	$paginator = $paginatorObj->getPaginator($request, "registry", $count);
	$list = $paginatorObj->getListGlobal($paginator['index'], "title");
				
	include ($modules_root.'registry/view/view_ind.php');	
  ?>