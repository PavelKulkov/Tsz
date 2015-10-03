<?php 

class slideshowController extends AppController  {
	
	function __construct() {	
		parent::__construct();
	}
	
	function index() {
		$slides = self::$model->getSlides();
		
		self::$view->setVars('slides', $slides);
		self::$view->render('index');
	}
}