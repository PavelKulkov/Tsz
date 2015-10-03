<?php

class AppController {
	protected static $instance;
	
	public static $path = null;	
	public static $module;
	public static $currentModule;
	
	public $fields = array('lang' => 'ru',
							'is_admin' => 0,
							'style' => 'default'
	
						);
	public static $template = null;
						
	public static $request = null;
	public static $response = null;
	public static $authHome = null;
	public static $log = null;
	public static $menu = null;
	public static $dumper = null;
	public static $db = null;
	public static $moduleHome = null;
	public static $domenHome = null;
	public static $templateHome = null;
	public static $view = null;
	public static $model = null;
	public $connectTime = null;
	
	
	function __construct() { 
		$this->connectTime = microtime(true);
		$this->executeMethod();
	}
	
	private function __clone(){ }
	
	function render() {	}
	
	function output() {	}
	
	function executeMethod() {
		if (isset(self::$request)) {
			if ( count(self::$request->export()) > 1 ) {
				$operation = self::$request->getValue('operation'); 
				
				// Определяем имя текущего класса и имя вызванного модуля, если совпадают, то вызвыаем метод текущего класса
				$module_name = array_shift((self::$request->getSelectedModule()));
				$current_class_name = array_shift(explode('Controller', get_class($this)));
				
				if ($current_class_name == $module_name) {
					if (method_exists($this, $operation)) {
						//call_user_func_array(array($this, $operation), array());
						$this->$operation();
					} else {
						//call_user_func_array(array($this, 'index'), array());
						$this->index();
					}
				} else {
					
					//call_user_func_array(array($this, 'index'), array());
					$this->index();
				}
			} else {
				//call_user_func_array(array($this, 'index'), array());
				$this->index();
			}
		}
	}
	
	function view() { 
		
		$item = self::$domenHome->getDomenBy('link', self::$request->domen, $this->fields['lang']);
		if ($item == false){
		 	die( "Не найден домен ".$request->domen);
		}
	
		if (isset($_COOKIE['theme'])) {
			$this->fields['style']= $_COOKIE['theme'];
		} else {
			self::$authHome->setCookieTheme('default');	
			$this->fields['style']="default";
		}
			
		if (isset($_POST['theme_value']) && $_POST['theme_value'] != '') {
			self::$authHome->setCookieTheme($_POST['theme_value']);	
			$this->fields['style']= $_POST['theme_value'];
		} 
		
// 		if(self::$authHome->isAdminMode()){
		if (isset($_SESSION) && $_SESSION['admin'] == 1) {
			$this->fields['is_admin'] = 1;
			$this->fields['style']="light";
		}
		
		
		
		$modules = array();
		$skip = array('.', '..');
		
		##########################
		# выборка всех модулей, для корреткного отображения темплейта index или остальных страниц
		# begin
		
		$files = scandir(MODULES_ROOT);
		foreach($files as $file) {
			if (file_exists(MODULES_ROOT.$file.'/class/')) {
				if(!in_array($file, $skip)) {
					$subfiles = scandir(MODULES_ROOT.$file.'/class/');
					foreach ($subfiles as $sub) {
						if(!in_array($sub, $skip)) {
							$name_module_parts = explode('.class.php', $sub);
							$modules[] = strtolower($name_module_parts[0]);
						}
					}
				}
			}
		}
			
		
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = array_shift(explode('/', $url));
		if (!empty($url) && in_array($url, $modules) && $this->fields['style'] =="default") {
			$type = 'pages';
		} else {
			$type = 'index';
		}
		
		#
		# отображение нужного темплейта
		# end
		#########################
		
		$this->fields['type'] = $type;
		self::$template = $template = self::$templateHome->getByFields('domain_id',$item['id'],$this->fields);
		
		define('SITE_THEME', $template['style']);
		$templ = fopen(TEMPLATE_ROOT.$template['name'].'.tpl', "r");
		if(!$templ) {
		  echo "Error open file: ".TEMPLATE_ROOT."/".$template['name'].'.tpl';
		  exit;
		}
		self::$moduleHome->getModulesByTemplate($template['id']);
		
		
		while (!feof($templ)) {
			$buffer = fgets($templ, 4096);
			$pos = 0;
			$area = NULL;
			$prev = 0;
			$outHTML = "";
			unset($currentModule);
			//$path = "";
			
			while(ModuleHome::hasModuleMatch($buffer, $area, $pos)){
				$beforeInclude = microtime(true);
				$prev = $pos;
				$pos = $area[0][1] + strlen($area[0][0]);
				$outHTML = substr($buffer,$prev,$area[0][1] - $prev);
				echo $outHTML;
				
				/*
				 * @TO DO в строках где $area[0][0]=='{#content}'.... подключение контроллера и моделей, для новой идеологии
				$files = scandir($controllers_root);
				foreach($files as $file) {
					if (file_exists($controllers_root.$file)) {
						if(!in_array($file, $skip)) {
							if (file_exists($controllers_root.$file.'/include.inc.php')) {
								require 'controllers/'.$file.'/include.inc.php';										
							}
							if (file_exists($controllers_root.$file.'/index.inc.php')) {
								require 'controllers/'.$file.'/index.inc.php';
							}
							
						}
					}	
				}
				
				*/
				
				if($area[0][0]=='{#content}'){
				  $currentModule = self::$moduleHome->findActiveModule(self::$request, DEFINED_MODULE);
				  self::$log->info("ActiveModule,".$_SERVER['REMOTE_ADDR'], $currentModule['name']);
				  $path = "index.inc.php";
				  self::$path = 'index';
				}else{
				  $currentModule = self::$moduleHome->getModuleInCacheByArea($area[0][0]);
				  $path = "include.inc.php";
				  self::$path = 'include'; 
				}
				
				if($currentModule!=false){
					self::$module = self::$currentModule = $currentModule;
// 					print_r(self::$currentModule);
					$path = self::$moduleHome->generateModulePath(self::$module).$path;
					if(self::$moduleHome->isModuleExist($path)){
						//$res = include_once($path);
						
						$controller_path = CONTROLLERS_ROOT.$currentModule['name'].'Controller.php';
						
						$this->loadModel($currentModule['name']);				
							
						self::$view->init(self::$path, $currentModule['name']);
						
						if (file_exists($controller_path)) {
							include_once $controller_path;
							$controller = $currentModule['name'].'Controller';
							new $controller();	
						}
						
						if(isset(self::$module['text'])){
							$data = self::$module['text'];
							echo self::$module['text'];
							if($res == 1)self::$moduleHome->updateCacheModuleText(self::$module);
						}
						if(isset($saveIncludeTime) && $saveIncludeTime!==false){
						  self::$log->info("Include,".$_SERVER['REMOTE_ADDR'].",".self::$module['name'], "time=".(microtime(true) - $beforeInclude));
						}
						
						
					}			
				}
				
			
				
				unset($currentModule);
				self::$module = array();
				//unset($module);
				
				
			};
			$outHTML = substr($buffer,$pos);
			echo $outHTML;
		}
		
		
		fclose($templ);
		
	}

	public static function getInstance($guestUser) {
        if (self::$instance === null) {
            self::$instance = new self();
            
            self::initCoreClasses($guestUser);
        }
       	
        self::$instance->view();
        return self::$instance;
        
        
    }
	
	static function initCoreClasses($guestUser) {
		self::$request = new HttpRequest();
		self::$response = new HttpResponse();
		self::$authHome = new AuthHome(NULL);
		self::$authHome->initGuestConnection($guestUser);
		self::$db = self::$authHome->getCurrentDBConnection();
		self::$log = new Logger(self::$db);
		self::$menu = new Menu(self::$request,self::$db);
		self::$dumper = new Dumper(self::$db);
		self::$dumper->dumpClientConnection();
		
		self::$moduleHome = new ModuleHome(MODULES_ROOT, self::$db);
		self::$domenHome = new DomenHome(self::$request, self::$db);
		self::$templateHome = new TemplateHome( self::$db);
		self::$view = new View();
	}
	
 	public function loadModel($modelName, $modelPath = MODELS_ROOT) {
        $modelPath = $modelPath . $modelName.'.php';
        if (!class_exists($modelName)) {
	        if (file_exists($modelPath)) {	        	
	            require $modelPath;
	            self::$model = new $modelName(self::$request, self::$db);
	        }
        } else {
        	 self::$model = new $modelName(self::$request, self::$db);
        } 
    }
	

    
    public static function setModel($modelName) {
    	self::$model = new $model(self::$request, self::$db);
    } 
    
    
    public static function getModel() {
    	return self::$model;
    }
    
    /*
	function __destruct() {
		self::$log->info("Disconnect,".$_SERVER['REMOTE_ADDR'], (microtime(true) - $this->connectTime));
	//	self::$db->disconnect();
	}
	*/
}