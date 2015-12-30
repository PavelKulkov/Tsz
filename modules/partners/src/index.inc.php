<?php
	require_once($modules_root."partners/class/Partners.class.php");
	if(!isset($partneryAndProject)) $partneryAndProject = new PartneryAndProject($request, $db);
	$partners = $partneryAndProject->getPartners();
	$projects = $partneryAndProject->getProjects();
	/*
	$limit = 50;
	require_once($modules_root."general/class/Paginator.class.php");
	if(!isset($paginatorPartners)) $paginatorPartners = new Paginator($request, $db, "partners", $limit, $admin);
	$count = $paginatorPartners->getCountGlobal();
	$paginator = $paginatorPartners->getPaginator($request, "partners", $count);
			
	$list = $paginatorPartners->getListGlobal($paginator['index'], "title");
				
				
	if(!isset($paginatorProjects)) $paginatorProjects = new Paginator($request, $db, "projects", $limit, $admin);
	$count2 = $paginatorProjects->getCountGlobal();
	$paginator = $paginatorProjects->getPaginator($request, "projects", $count2);
				
	$list2 = $paginatorProjects->getListGlobal($paginator['index'], "title");
		*/		
	include ($modules_root.'partners/view/partners.php');
?>