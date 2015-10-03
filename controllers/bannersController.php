<?php

class bannersController extends AppController  {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		self::$view->render('index');
	}
}