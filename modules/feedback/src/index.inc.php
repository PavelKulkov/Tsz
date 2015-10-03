<?php
	require_once($modules_root."feedback/class/Feedback.class.php");
            
   	$feedback= new Feedback($request, $db);
   	
   	$admin = $authHome->isAdminMode();
   	$operation = $request->getValue('operation');
   	
   	if ($admin) {
   		switch ($operation) {
			case "close":
				$feedback->close($request->getValue('feedback_id'));
				echo '<meta http-equiv="refresh" content="0; url=/modules/auth/feedback">';
				
			case "":
				$feedbacks = $feedback->show();
   				include ($modules_root.'feedback/view/'.SITE_THEME.'/show.php');				
		}	
   	} else {   	   	
		switch ($operation) {
			case "save":
				if($feedback->save() == false) {
					$error_message = $feedback->message;
					include ($modules_root.'feedback/view/view_ind_'.SITE_THEME.'.php');
				} else {
					echo '<meta http-equiv="refresh" content="2; url=/feedback">';
					$success_message = $feedback->message;
					include ($modules_root.'feedback/view/view_ind_'.SITE_THEME.'.php');					
				}
				
				break;
			case "":
				include ($modules_root.'feedback/view/view_ind_'.SITE_THEME.'.php');
		}
	
   	}
   	
   	$module['text'] = $text;