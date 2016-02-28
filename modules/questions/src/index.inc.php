<?php

require_once($modules_root."questions/class/Questions.class.php");
	if(!isset($questions)) $questions = new Questions($request, $db);
	$groups = $questions->getGroupsQuestion();
	$questions = $questions->getAllQuestions();

	/*
	$limit = 10;
	require_once($modules_root."general/class/Paginator.class.php");
	if(!isset($paginatorQuestions)) $paginatorQuestions = new Paginator($request, $db, "questions", $limit, $admin);
	$count = $paginatorQuestions->getCountGlobal();
	$paginator = $paginatorQuestions->getPaginator($request, "questions", $count);
			
	$list = $paginatorQuestions->getListGlobal($paginator['index'], "title");
	*/		
	include ($modules_root.'questions/view/questions.php');
	
?>