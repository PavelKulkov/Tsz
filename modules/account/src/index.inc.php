<?php
if ($authHome->checkSession()!=1){
	$text = '<script type="text/javascript">
			$(document).ready(function(){
			    	$("div#content_content").removeClass().addClass("content");
				$("div#content_center").removeClass().addClass("center");
				$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Личный кабинет");
				$("div#content_line").removeClass().addClass("blue_linecab").html("<div class=\"sub_menucab\"><ul class=\"topsub_menucab\"> <li class=\"current\"><a href=\"#tab-2\" data-toggle=\"tab\">Платежи</a></li><li> </ul>  <div class=\"cl\"></div>");
				$("head").append("<script src=\"/templates/assets/js/payments.js\"/>");	
			});
		</script>';
	$text .= '<div class="tab-pane" id="tab-2">';
	include $modules_root.'payments/view/paymentsView.php';
	$text .= '</div>';
	echo $text;
	//echo "Личный кабинет доступен только авторизованным пользователям!";
}else{

	require_once($modules_root."account/class/Account.class.php");
	require_once($modules_root."account/class/State.class.php");
	require_once($modules_root."general/class/Paginator.class.php");

	$db->changeDB("regportal_share");
	if(!isset($account))	$account = new Account($request,$db);

	if ($request->hasValue('showRequest') && $request->getValue('showRequest') == 'on') {
		include $modules_root.'/account/view/'.SITE_THEME.'/showRequest.php';
	} else {

		if(isset($_GET['request_id']) && $_GET['request_id'] != '') {
			/*$postProc = $account->isPostProcessing();
			if (($postProc['content_status'] != NULL)||$postProc['content_status'] != ""){
				echo '<meta http-equiv="refresh" content="0;URL=forms?subservice_id='.$postProc["id_subservice"].'&request_id='.$postProc["id"].'&outId='.$_GET['outId'].'">';
				//header('Location: /forms?subservice_id='.$postProc['id_subservice']);
				return false;
			}*/
			$idRequest = $_GET['request_id'];
			$id_subservice = $_GET['id_subservice'];
			if(isset($_GET['outId'])) {
				$id_out = $_GET['outId'];
			}
			if ($_GET['user_action'] == 'cancel')
				include $modules_root.'/account/src/cancel_wrapper.php';
			else
				include $modules_root.'/account/src/status_check.php';
		}
		
		if(!isset($requests_paginator)) 	$requests_paginator = new Paginator($request, $db,  "auth",  30);
				$requests_paginator->setStyle(SITE_THEME);
				$requests_paginator->setOrder(false);
				$requests_paginator->setAddParams(false);
				
		
		
		$requests = $account->showRequests($_SESSION['ID']);
		$requests_count = count($requests);
		
		
		$paginator = $requests_paginator->getPaginator($request, "/account", $requests_count);
		$requests_paginator->setOrder(true);				
		$requests = $requests_paginator->getListSql($paginator['index'], 'SELECT a.id, a.startTime, r.id, r.id_subservice, r.time, rs.state, rs.id_request, rs.id_out, rs.comment, rs.user_action, sub.s_name, sub.registry_number
																			FROM regportal_share.auth a
																			LEFT JOIN regportal_share.request r ON a.id = r.id_auth
																			LEFT JOIN regportal_share.response rs ON r.id = rs.id_request
																			LEFT JOIN regportal_services.subservice sub ON r.id_subservice = sub.id
																			WHERE a.id=r.id_auth AND
																				  a.passInfo = "'.$_SESSION['login'].'" AND
																				  r.id = rs.id_request AND
																				   rs.state >= 7 AND rs.state <= 17 AND 
																			  rs.time = (
																			   SELECT MAX(TIME) FROM regportal_share.response WHERE response.id_request = r.id 
																			  ) 
																			GROUP BY r.id', 'rs.id');
		
		include $modules_root.'/account/view/view_ind_'.SITE_THEME.'.php';
	}

}
