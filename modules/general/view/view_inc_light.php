<?php

$paginatorText = "<div align=\"center\" class=\"pagination\">
				<ul>";
$disabled = "class=\"disabled\"";
// Проверяем нужны ли ссылки назад
if ($cur_page_num != 1) $pervpage = "<li><a href=\"".$href."=1\"><<</a></li>
				<li><a href=\"".$pervpageHref."\"><</a></li>";
// Проверяем нужны ли ссылки вперед
if ($cur_page_num != $page_count) $nextpage =  "<li><a href=\"".$nextpageHref."\">></a></li>
				<li><a href=\"".$endPageHref."\">>></a></li>";

// Находим ближайшие станицы с обоих краев, если они есть
for ($i = 0; $i < count($prevHrefs); $i++){
	$pageLeft .=  "<li class=\"li\"><a href=\"".$href."=".$prevHrefs[$i]."\">".$prevHrefs[$i]."</a></li>";
}
for ($i = 0; $i < count($nextHrefs); $i++){
	$pageRight =  "<li class=\"li\"><a href=\"".$href."=".$nextHrefs[$i]."\">".$nextHrefs[$i]."</a></li>".$pageRight;
}

// Вывод меню
$paginatorText .= $pervpage.$pageLeft."<li class=\"active\"><a href=\"\">".$cur_page_num."</a></li>".$pageRight.$nextpage;
$paginatorText .= "</ul><h6 align='right'>Страница ".$cur_page_num." - из ".$page_count."</h6></div>";
echo $paginatorText;