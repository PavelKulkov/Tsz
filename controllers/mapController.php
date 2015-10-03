<?php 

class mapController extends AppController  {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$fileName = self::$moduleHome->getTemp()."/map.html";
		if(!is_file($fileName)){
			$regions_list = self::$model->getRegionsList();

			$file = serialize($regions_list);
			file_put_contents($fileName, $file);
		}else{
			$file = file_get_contents($fileName);
			$regions_list = unserialize($file);
		}
		
		self::$view->setVars('regions_list', $regions_list);
		$map = self::$view->render('index');
	}

}
