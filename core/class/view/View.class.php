<?php

class View extends Object {
	
	public static $admin_mode = null;
	public $path = null;
	public $module_name = null;
	public static $vars = null;
	
	
	function init($view_path, $module) {
		$this->path = $view_path;
		$this->module_name = $module;
	}
	
	
	function render($tpl) {
		// формироавние переменных
		if (self::$vars !== null) {
			foreach (self::$vars as $k => $v) {
				$$k = $v;
				//echo $k.' - '.$v.'<br />';
				unset($k, $v);
			}
		}


// 		$site_theme = ($this->admin_mode) ?  'light' : SITE_THEME;

		$admin_tpl = AppController::$db->selectCell('	SELECT t.is_admin
													FROM templates t
													LEFT JOIN module_location m
													ON t.id = m.id_template
													WHERE m.id = ?', AppController::$currentModule['id_location']);

		$admin_tpl = ($admin_tpl == 1) ?  'admin/' : '';
		
		$path = 'views/theme/'.SITE_THEME.'/templates/'.$this->module_name;
		if ($this->path == 'include') {		
			ob_start();			
			include($path.'/include/'.$tpl.'.phtml');
// 			echo $path.'/include/'.$tpl.'.phtml';
			$output = ob_get_clean();
			AppController::$module['text'] = $output;
			return $output;
		} else {
			ob_start();
			include($path.'/index/'.$tpl.'.phtml');
// 			echo $path.'/index/'.$tpl.'.phtml';
			echo ob_get_clean();	
		}
	}
	
	
	public static function getViewMode() {
		return self::$admin_mode;
	}
	
	
	public static function setViewMode($mode) {
		self::$admin_mode = $mode;
	}
	
	
	function setVars($vars, $value = null) {
		if (is_array($vars)) {
			self::$vars = $vars;
		} else {
			self::$vars[$vars] = $value;
		}
	}
}