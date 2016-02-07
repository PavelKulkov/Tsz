<?php
require_once($modules_root."buttomNews/class/ButtomNews.class.php");
if(!isset($buttomNews)) $buttomNews = new ButtomNews($request, $db);
$list = $buttomNews->getButtomNews();

if(count($list) >= 1){
	$i = 0;
	foreach ($list as $entry) {
		$mas[$i] = $entry;
		$i++;
		if($i == 4){
			break;
		}
	}
}

$currentModule['text'] = $text;
$module = &$currentModule;

include ($modules_root.'buttomNews/view/buttomNews.php');