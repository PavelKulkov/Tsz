<?php

	$paginatorText =  "<div class=\"pagination\">";
	
	for ($i = 0; $i < count($prevHrefs); $i++){
		$pageLeft .=  "<div class=\"nextPages\"><a href=\"".$href."=".$prevHrefs[$i]."\">".$prevHrefs[$i]."</a></div>";
	}
	for ($i = 0; $i < count($nextHrefs); $i++){
		$pageRight =  "<div class=\"nextPages\"><a href=\"".$href."=".$nextHrefs[$i]."\">".$nextHrefs[$i]."</a></div>".$pageRight;
	}
	
	// Проверяем нужны ли ссылки назад
	if ($cur_page_num != 1) {
		
		$pervpage =	"<div class=\"page_next\"><a href=\"".$pervpageHref."\"><... </a></div>";
		
		
		//$pervpage =	"<div ><a href=\"".$pervpageHref."\"><img src=\"/templates/newdesign/images/pagination_lefttarr.gif\" alt=\"\" title=\"\" class=\"for_ie\"></a></div>";
		//$pervpage .= "<div><a href=\"".$firstPageHref."\">1</a></div>";
	}
	/*else 
		$pervpage =	"<div ><a class='noActiv' href=\"\"><...</a></div>";*/
	if ($needDots)
		$pageRight .= "<div ><a href=\"\">...</a></div>";
	if ($cur_page_num != $page_count) {
		if ($needEndPageHref)	// Проверяем нужны ли ссылки вперед
			$nextpage =	"<div ><a href=\"".$endPageHref."\">".$page_count."</a></div>";
		
		$nextpage .= "<div class=\"page_next\"><a href=\"".$nextpageHref."\"> ...></a></div>";
		
		
		//$nextpage .= "<div><a href=\"".$nextpageHref."\"><img src=\"/templates/newdesign/images/pagination_rightarr.gif\" alt=\"\" title=\"\" class=\"for_ie\"></a></div>";
		
		/**/
		$paginatorText .= $pervpage.$pageLeft."<div class=\"activHref\"><span>".$cur_page_num."</span></div>".$pageRight.$nextpage;
	}else	{
		$nextpage =	"<div class=\"activHref\"><span>".$page_count."</span></div>";
		//$nextpage .= "<div ><a href=\"\"><img src=\"/templates/newdesign/images/pagination_rightarrcur.gif\" alt=\"\" title=\"\" class=\"for_ie\"></a></div>";
		$paginatorText .= $pervpage.$pageLeft.$pageRight.$nextpage;
	}
	//$paginatorText .= "</ul><h6 align='right'>Страница ".$cur_page_num." - из ".$page_count."</h6></div>";
	$paginatorText .= "<div class=\"cl\"></div></div>";

	echo $paginatorText;