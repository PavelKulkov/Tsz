<?php    
      
class aboutController extends AppController  {
	
	function __construct() {
		parent::__construct();
	}

	function index() {
		$portal_info = self::$model->getInfo();
		
        $admin = self::$authHome->isAdminMode();
       
        self::$view->setVars(array('portal_info' => $portal_info, 'admin' => $admin));
        self::$view->render('index');
	}
	
	
	function edit() {
		$portal_info = self::$model->getInfo();
		$admin = self::$authHome->isAdminMode();
		if ($admin) {
			self::$view->setVars('portal_info', $portal_info);
			self::$view->render('edit');
		} else {
			echo 'У Вас недостаточно прав, для просмотра данной страницы!';
		}
	}
	
	
	function save() {
		$admin = self::$authHome->isAdminMode();
		if ($admin) {
			$contact_info = array('id'=>self::$request->getValue('info_id'),'content'=>self::$request->getValue('text'));
			self::$model->save($contact_info);
			echo '<meta http-equiv="refresh" content="0; url=/about">';
		}
	}
}