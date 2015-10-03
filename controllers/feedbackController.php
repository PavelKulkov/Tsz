<?php

class feedbackController extends AppController  {
	
	function __construct() {
		parent::__construct();
	}

	function index() {
		
		
        $admin = self::$authHome->isAdminMode();
       

   	   	$operation = self::$request->getValue('operation');
	   	
	   	if ($admin) {
	   		switch ($operation) {
				case "close":
					self::$model->close(self::$request->getValue('feedback_id'));
					echo '<meta http-equiv="refresh" content="0; url=/modules/auth/feedback">';
					
				case "":
					$feedbacks = self::$model->show();
					 self::$view->setVars(array('feedbacks' => $feedbacks, 'admin' => $admin));
	   				 self::$view->render('list');			
			}	
	   	} else {   	   	
			switch ($operation) {
				case "save":
					if(self::$model->save() == false) {
						$error_message = self::$model->message;
						self::$view->setVars(array('error_message' => $error_message));	
						self::$view->render('index');
					} else {
						echo '<meta http-equiv="refresh" content="2; url=/feedback">';
						$success_message = self::$model->message;
						self::$view->setVars(array('success_message' => $success_message));
						self::$view->render('index');					
					}
					

	   				 
					break;
				case "":
	   				self::$view->render('index');
			}
		
	   	}
	}
	
	
}