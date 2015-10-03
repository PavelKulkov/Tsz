<?php

$text = "<script>
			    function mainLIclick(el) {
					console.log(el);
				    $('ul.nav-pills.child').attr(\"hidden\", \"hidden\")
				    $('ul.nav-pills.child li').removeClass('active');
				    var str = 'ul.nav-pills.child.children' + el.id;
				    $(str).removeAttr(\"hidden\");
				}

			</script>";

$text.= "<ul class=\"nav nav-pills nav-stacked\">";
foreach ($list as  $entry) {
	$entry['$active'] = $entry['$active'] ? "class=\"active\"" : ""; 
	if (isset($entry['submenu'])&& is_array($entry['submenu'])) {
		$text.="<li onclick=\"mainLIclick(this)\" id =".$entry['id']."><a data-toggle=\"tab\" href=\"/#\"". $entry['url']."&id=".$entry['id']."\">".$entry['name']."</a></li>";
		$text.="<ul ".$entry['$hidden']." class=\"nav-pills nav-stacked child children".$entry['id']."\">";
		foreach ($entry['submenu'] as  $subEntry) {
			$subEntry['$active'] = $subEntry['$active'] ? "class=\"active\"" : "";
			$text.="<li ".$subEntry['$active']." style=\"line-height: 24px;\"><a href=\"". $subEntry['url'].$ch."id=".$subEntry['id']."&p_id=".$subEntry['id_parent']."\">";
			$text.="<span style=\"padding:0px 0px;\">".$subEntry['name']."</span></a></li>";
		}
		$text.="</ul>";
	}
	else {
		if($hasModuleMatchEntry){
			if(isset($module['text'])){
				$item.="<li>".$module['text']."</li>";
				$text = $item;
			}
		}else{
			$text.="<li ".$entry['$active']." id =".$entry['id']."><a href=\"".$entry['url']."\">".$entry['name']."</a></li>";
		}	
	}
}
$text.="</ul>";