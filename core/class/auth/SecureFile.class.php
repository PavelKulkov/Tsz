<?php
class SecureFile {
	
	private $indexSecure;
	
	
	public function __construct(){
      $this->indexSecure = $_GET["indexSecure"];
      $_SERVER["QUERY_STRING"] = str_ireplace("indexSecure=".$this->indexSecure,"", $_SERVER["QUERY_STRING"]);
      if(strpos($_SERVER["QUERY_STRING"], '&')==0){
      	$_SERVER["QUERY_STRING"] = substr($_SERVER["QUERY_STRING"], 1);
      }
      unset($_GET["indexSecure"]);
	}
	
	private function createTempFile($prefix){
		$this->fileName = tempnam(sys_get_temp_dir(), $prefix);
		return $this->fileName; 
	}
	
	
	public function loadFromSession(){
		$dbConfFile = $_SESSION["dbConfFile"];
		$dbConf = NULL;
		if(substr($dbConfFile,0,3)!='UEs'){
		  $dbConf = explode(' ', $dbConfFile);
		}else{
		  $archiveFile = $this->createTempFile('zip');
		  $handle = fopen($archiveFile,"w");
		  fwrite($handle,base64_decode($dbConfFile));
		  fclose($handle);
		  $dbConf = $this->load($archiveFile);			
		  unlink($archiveFile);
		}
		
		return $dbConf;
	}
	
	
	
	public function save($login,$password){
		/*TODO: ошибки обработать*/
		$fileName = $this->createTempFile('db');
		$handle = fopen($fileName, "w");
		fwrite($handle,$login." ".$password);
		fclose($handle);
		$archiveFile = $this->createTempFile('zip');
		$res = exec("zip -jm -P ".$this->indexSecure." ".$archiveFile." ".$fileName);
		$data = NULL;
		if($res!=""){	
		  $data = $archiveFile;
		  $data = $data.".zip";
		  $handle  = fopen($data,"r");
		  $info = fread($handle,filesize($data));
		  fclose($handle);
		  unlink($data);
		  $data = base64_encode($info);
		}else{
		  $data = $login." ".$password;
		  unlink($fileName);
		}
		unlink($archiveFile);
		return $data;
	}
	
	
	
	public function load($archiveFile){
		$dbConf =  exec("unzip -p -P ".$this->indexSecure." ".$archiveFile." db*");
		if(isset($dbConf)){
			$dbConf = explode(" ", $dbConf);
			if(count($dbConf)==2){
				$result = $dbConf;
			}
		}
		if($dbConf=="") return false;
		return $dbConf;	
	}
	
	
	
	
	
	
}
?>