<?php
class Logger
{

		private $db = null;
		
		private static $instance;
		
		public function __construct($db){
		  $this->db = $db;
		}
		
		
		public static function getInstance(){
		   if(self::$instance==null){
		     self::$instance = new Logger(DB::getInstance());
		   }
		   return self::$instance;	
		}
		

		private function putIntoLog($type,$meta,$message){
		  $item['meta'] = "'".$meta."'";
		  $item['message'] = "'".$message."'";
		  $item['module'] = "'".$this->getCallingModule()."'";
		  $item['type'] = $type;
		  $item['time'] = 'now()'; 
		  $this->db->changeDB('regportal_share');
          $id = $this->db->insertRowIntoTable('log',$item);
          $this->db->revertDB();
          return $id;    			
		}

		private function pathToUnixStyle($path){
		  return str_replace("\\", "/", $path);	
		}

		private function getCallingModule(){
			$debugTrace = debug_backtrace();
			$modulePath = $this->pathToUnixStyle($debugTrace[2]['file']);
			$root = $this->pathToUnixStyle(ModuleHome::getDocumentRoot());
			$modulePath = str_replace($root, '', $modulePath); 
			return $modulePath;
		}
		
		public function info($meta,$message){
		  return $this->putIntoLog(1, $meta, $message);	
		}
		
		
		public function warning($meta,$message){
		  return $this->putIntoLog(2, $meta, $message);
		}
		
		public function error($meta,$message){
			return $this->putIntoLog(3, $meta, $message);
		}		
		
}
?>