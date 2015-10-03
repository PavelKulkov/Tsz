<?php
class Dumper
{

		private $db = null;
		public function __construct($db){
		  $this->db = $db;
		}
		
		function __autoload($classname) {
			 require("models/". $classname .".php");
    		
		}
		
		private function dumpGlobal($item){
			$this->db->changeDB('regportal_share');
			$id = $this->db->insertRowIntoTable('events_hash',$item);
			if(!$id){
				die('Не возможно сохранить дамп!');
			}
			$this->db->revertDB();
			return $id;		
	
		} 
		
		public function dumpClientConnection(){
			$item['hash'] = "'".$_SERVER['REMOTE_ADDR']."'";
			$item['value'] = "'uri=".$_SERVER['REQUEST_URI'].";browser=".$_SERVER['HTTP_USER_AGENT']."'";
			$item['type'] = 1;
			$item['time'] = 'now()';
			return $this->dumpGlobal($item);;
		}
		
		
		public function checkClientOnCaptcha(){
		  $params = $this->getProperty($_SERVER['REMOTE_ADDR']);
		  if(isset($params) && $params){
		  	$params = unserialize($params);
		  	if(isset($params['captcha'])){
		  	  return true;	
		  	}
		  }else{
		  	  $sql = "SELECT count(e.`id`)\r\n".
                     "FROM regportal_share.events_hash e\r\n".
                     "WHERE e.`hash`='".$_SERVER['REMOTE_ADDR']."' and e.`time` >= now() - 5.0;";
		  	  $count = $this->db->getCountData($sql,'count(e.`id`)');
		  	  if($count>6){
		  	  	$params['captcha'] = 'true';
		  	  	$params = serialize($params);
		  	  	$this->setProperty($_SERVER['REMOTE_ADDR'], $params);
		  	  	return true;		  	  	
		  	  }
		  	}
		  
		  return false;
		}
		
		
		public function setProperty($key,$value){
			$item['hash'] = "'".$key."'";
			$item['value'] = "'".$value."'";
			$item['type'] = 2;
			$item['time'] = 'now()';
			return $this->dumpGlobal($item);;			
		}
		
		public function getProperty($key){
		  $sql = "SELECT e.`value`\r\n".
                 "FROM regportal_share.events_hash e\r\n".
                 "WHERE e.`hash` = ? AND e.`type`=2\r\n".
                 "ORDER BY e.`time` desc\r\n".
                 "LIMIT 1";
		  $fields = array('value');
		  $item = $this->db->selectRow($sql, $key);
		  if(!$item){
		    return false;	
		  } 
		  return $item['value'];
		}

}