<?php
header("content-type: application/xhtml+xml");
$sitemap = true;

//Выбор ведущего модуля
$links = $moduleHome->getLinks();
foreach ($links as $mod_link) {
	if($mod_link) {
		if($request->hasValue($mod_link)) {
			$def_module = $mod_link;
			break;
		}
	}
}
$module = $moduleHome->getModuleBy('links',$def_module);

if($module->name=='pages') {
	require_once($modules_root."pages/src/index.inc.php");
} elseif($module->name=='billboard') {
	require_once($modules_root."billboard/src/index.inc.php");
} elseif($module->name=='news') {
	require_once($modules_root."news/src/index.inc.php");
} elseif($module->name=='catalog') { 
	require_once($modules_root."catalog/src/tree.inc.php");
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
if($request->level==1 && strtolower($request->variables_level[0])=='sitemap.xml') {
	echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	if($text2) echo $text2;
	echo '</sitemapindex>';
} else {
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	if($text2) echo $text2;
	echo '</urlset>';
}
?>