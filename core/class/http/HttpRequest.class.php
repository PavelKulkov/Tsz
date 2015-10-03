<?php
class HttpRequest {
	public $variables;
	public  $variables_level;
	public  $level;
	public  $domen;
	private $modAddPars;
	private $modSpecPars;
	private $global_prefix;


	public function __construct()	{
		$this->modAddPars 		= $GLOBALS['modAddPars'];
		$this->modSpecPars 		= $GLOBALS['modSpecPars'];
		if(isset($GLOBALS['global_prefix'])){
			$this->global_prefix 	= $GLOBALS['global_prefix'];
		}
		
		$this->variables = $_GET;
		$query = $_SERVER['REQUEST_URI'];
		$pos = strpos($query,'?');
		if($pos!=false){
		  $query = substr($query,0,$pos);
		}
		$query = explode("/",$query);

		$params = array();
		$name = null;
		$value = null;
		$size = count($query);
		for($i=2;$i<$size;$i++){
		  if($i%2==0){
		    $name = $query[$i];
		  }else{
		    $value = $query[$i];
			$params[$name] = $value;
		  }          
		}
		$this->variables = array_merge($this->variables,$params);
		$this->variables = array_merge($this->variables,$_POST);
		
		$this->domen = $_SERVER['HTTP_HOST'];
	}

	public function headerLocation($controller, $method = null) {
		$method = ($method == null || $method = 'index') ? '' : '?operation='.$method;
		echo '<meta http-equiv="refresh" content="0; url=/'.$controller.$method.'">';
		exit();
	}
	
	private function replace($var) {
		return str_replace("'","s",str_replace("\\"," ",$var));
	}

	public function hasValue($name)	{
		if(isset($this->variables[$name]))		{
			return true;
		} else {
			return false;
		}
	}

	public function getValue($name) 	{
		if (isset($this->variables[$name]))		{
			return $this->variables[$name];
		} else	{
			return NULL;
		}
	}

	public function valueNoEmpty($value) {
		if(empty($this->variables[$value])) 	{
			return false;
		} else {
			return true;
		}
	}

	public function export() {
		return $this->variables;
	}

	
	public function getSelectedModule(){
		$path = array();
		$uri = $this->getValue('url');
		if(isset($uri)){
			$path = explode("/", $uri);
		}
		return $path;	  	
	}
	
	
	public function setValue($name,$val) {
		if(array_key_exists($name,$this->variables)) {
			if($val) {
				if($val=='set') {
					$this->variables[$name] = '';
				} else {
					$this->variables[$name] = $val;
				}
			} else {
				unset($this->variables[$name]);
			}
		} else {
			$var = array();
			$var[$name] = $val;
			$this->variables = array_merge($this->variables,$var);
		}
	}

}
?>