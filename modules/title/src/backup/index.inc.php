<?php
//var_dump($main_module);

/*TODO: непонятный код
 * 
 * if($request->level && in_array($lng_prefix, $request->variables_level) && $lng_prefix!='ru') $lng = $lng_prefix;
 * else $lng = ''; 
 */	
$lng = $lng_prefix;
//echo $request->query;
//var_dump($request->variables_level);
//echo $lng;


if($module['id_location']==1) {
	
	
	    /*TODO Непонятный код
	     * 		if($module['title']){
		//	echo 'test';
		}
	     * 
	     * */

		if($main_module['title']) {
			if($lng) $pars["title"] = strip_tags($main_module['title']).". ".strip_tags($module['description_'.$lng]);
			else $pars["title"] = strip_tags(	$main_module['title']).". ".strip_tags($module['description']);
			if(!$request->level) $pars["title"] = strip_tags($module['description']);
		} else {
			if($lng) $pars["title"] = strip_tags($module['description_'.$lng]);
			else $pars["title"] = strip_tags($module['description']);
		}
		
	$module['text'] = $templateHome->parse($modules_root."title/tpl/maintitle.tpl",$pars);

} elseif($module['id_location']==2) {
	
//	echo $module['description'].' - '.$main_module['description'];
/*	if($main_module['meta_description']) {
		$pars["title"] = strip_tags($module['description']).' '.$main_module['description'].': '.strip_tags($main_module['meta_description']);
	} elseif($main_module['description']) {
		$pars["title"] = strip_tags($module['description']).': '.strip_tags($main_module['description']);
	}
	*/
	if($main_module['meta_description']) {
		$pars["title"] = strip_tags($main_module['meta_description']);
	} elseif($module['description']) {
		$pars["title"] = strip_tags($main_module['title'].'. '.$module['description']);
	}
	$module['text'] = $templateHome->parse($modules_root."title/tpl/maintitle.tpl",$pars);
} elseif($module['id_location']==3) {
	
	if($main_module['keywords']) {
		$pars["title"] = strip_tags($main_module['keywords']);
	} else {
		$pars["title"] = $functions->getKeywords($main_module['title']);
	}
	$module['text'] = $templateHome->parse($modules_root."title/tpl/maintitle.tpl",$pars);
} elseif($module['id_location']==4) {
	if($main_module['id_template']==7) {
		$module['text'] = $templateHome->parse($modules_root."title/tpl/title_print.tpl",$pars);
	} else {
		$pars['title'] = $item_domen['name'];
		//$pars['address'] = $item_domen['address'];
		if($usersHome)	$options = $usersHome->getSite($item_domen['id_site'], $lng_prefix);
		if($request->level) {
		    if(in_array($lng_prefix, $request->variables_level)) $pars['lng_prefix']=$lng_prefix;
		}
		$pars['topbanner'] = $options['topbanner'];
		$pars['title'] = $options['title'];
		$module['text'] = $templateHome->parse($modules_root."title/tpl/title.tpl",$pars);
	}
} elseif($module['id_location']==6) {
	
	if($main_module['title']) {
		$pars["title"]  = $main_module['title'];
	} else {
		$pars["title"]  = $title;
	}
	if(!$main_module['url'] || $request->variables_level>count($main_module['url'])){
	    $make_url_by_page = true;
	    include($modules_root."pages/src/include.inc.php");
	    if(is_array($mass_url)) {
		if(!is_array($main_module['url'])) $main_module['url'] = $mass_url;
		else $main_module['url'] = array_merge($mass_url,$main_module['url']);
	    }
	}
	if($main_module['url'] && is_array($main_module['url'])){
		$k = 0;
		
		if($news_item['title'] || $album_item['title']) {
			$news_item_arr = array();
			array_push($main_module['url'],$news_item_arr);
		}
		$is_last = count($main_module['url']);
		foreach ($main_module['url'] as $item) {
			$k++;
			if($default_page) $item['non_def'] = true;
			if($lng) $item['lng'] = $lng;
			if($k==$is_last) $item['last'] = true;
			$pars['url'] .= $templateHome->parse($modules_root."title/tpl/url.tpl",$item);
		}
	}
	/*else {
	//echo '11';
	
	if($lng) $main_module['title'] = $main_module['description_'.$lng];
	else $main_module['title'] = $main_module['description'];
		
		$pars['url'] = $templateHome->parse($modules_root."title/tpl/url.tpl",$main_module);
	}*/
	if($default_page) $pars['main'] = true;
	//if($default_page) $pars['non_def'] = true;
	if($lng) $pars['lng'] = $lng;
	if($request->hasValue('print')) {
		$pars["title"] = mb_strtoupper($pars["title"], 'utf-8');
		$module['text'] = $templateHome->parse($modules_root."title/tpl/h1_print.tpl",$pars);
	}
	else $module['text'] 	= $templateHome->parse($modules_root."title/tpl/h1.tpl",$pars);
	
} elseif($module['id_location']==18) {
	if($usersHome)	$options = $usersHome->getSite($item_domen['id_site'], $lng);
	//if($lng) $options['lng'] = $lng;
	$options['id_tpl']=$template['id'];
	$module['text'] 	.= $templateHome->parse($modules_root."title/tpl/contacts.tpl",$options);
} elseif($module['id_location']==20) {
	if($usersHome)	$options = $usersHome->getSite($item_domen['id_site'], $lng);
	if($lng) $options['lng'] = $lng;
	$module['text'] 	.= $templateHome->parse($modules_root."title/tpl/bottom.tpl",$options);
} elseif($module['id_location']==30) {
	if($usersHome)	$options = $usersHome->getSite($item_domen['id_site'], $lng);
	if($lng) $options['lng'] = $lng;
	$module['text'] 	.= $templateHome->parse($modules_root."title/tpl/thank.tpl",$options);
}
?>
