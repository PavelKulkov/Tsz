<?php
	require_once($modules_root."news/class/News.class.php");
	
	if(!isset($news)) $news = new News($request, $db);
	
	$new = false;
	
	if ($request->hasValue('id_news')) {
		$id_new = $request->getValue('id_news');
		if ($id_new) 
			$new = $news->getNew($id_new);	
	}
	
	if ($new) { //вывод новости
		$latestNews = $news->getList(0, 7, 0);
	} else { //вывод списка новостей
		$url = "?";
		if ($request->hasValue('id'))
		$url .=  "id=".$request->getValue('id')."&";
		$limit = 5;
		require_once($modules_root."general/class/Paginator.class.php");
		if(!isset($paginatorObj)) $paginatorObj = new Paginator($request, $db, "news", $limit, $admin);
		$count = $paginatorObj->getCountGlobal();
		$paginator = $paginatorObj->getPaginator($request, "news", $count);
		$list = $paginatorObj->getListGlobal($paginator['index'], "date");
	}
	
	if($_SESSION['admin']){
		$years = array();
		$count = count($list);
		$flag = true;
		for($i=0;$i<$count;$i++){
			$tmp = substr($list[$i]['date'],0,4);
			for($j=0;$j<$count;$j++){
				if(strcmp($tmp,$years[$j]) == 0){
					$flag = false;
				}
			}
			if($flag){
				$years[count($years)] = $tmp;
			}
			$flag = true;
		}
		if ($request->hasValue('admin')){
			$funct = $request->getValue('admin');
			include ($modules_root.'news/src/'.$funct.'.php');
			exit;
		}
	}		
	
	include ($modules_root.'news/view/view_ind_'.SITE_THEME.'.php');
		
	$module['text'] = $text;
	
	
	
	
?>


