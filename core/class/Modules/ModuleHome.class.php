<?php
class ModuleHome
{
	private $db_instance;
	private $lng_prefix;
	public $items = NULL;
	public $items_location = array('id','id_module','locationNum','id_template');
	private $rows;
	private $modules_root;
	private $namesCache;
	private $areasCache;

	function __construct($path,$db)
	{
		$this->db_instance = $db;
		$this->rows['`md`.`id`'] = "`id`";
		$this->rows['`md`.`name`'] = "`name`";
		$this->rows['`md`.`description`'] = '`description`';
		$this->rows['`ml`.`locationNum`'] = "`locationNum`";
		$this->rows['`ml`.`id`'] = "`id_location`";
		$this->rows['`lt`.`name`'] = "`locationName`";
		foreach($this->rows as $key=>$value){
		  $value = str_replace("`", "",$value);
		  $this->items[] = $value;	
		}
		$this->modules_root = $path;
	}
	
	
	private function saveRowsInSQL(){
	  $result = "";
	  $count = count($this->rows);
	  $i = 1;
	  foreach($this->rows as $row=>$alias){
	    $result.=$row." AS ".$alias;
	    if($i<$count){
	    	$result.=",\r\n";
	    }
	    $i++;	
	  }
	  $result.="\r\n";
	  return $result;	
	}
	
	private function createViewForTemplate($id){
		$sql = "SELECT " . $this->saveRowsInSQL().
		       "FROM (`modules` md INNER JOIN `module_location` ml USE INDEX(temp_mod) \r\n".
               "      ON (`ml`.id_template=".$id." AND `ml`.id_module=`md`.id)) INNER JOIN `locationtype` lt\r\n".
		       "ON(ml.id_locationType=lt.id)";
		
		return $sql; 
	}
	
	
	/**
	 * пїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ 
	 * @param $params 
	 * @param $templateId пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ
	 * */
	private function getModuleBy($templateId,$params)	{
		$sql = "SELECT * \r\n".
		       "FROM (".$this->createViewForTemplate($templateId).") m1\r\n".
		"WHERE \r\n";
		$count = count($params);
		$i = 1;
		foreach($params as $key=>$value){
		  $sql .= $key.$value;
		  if($i<$count){
		  	$sql .= " AND \r\n";
		  }
		  $i++;
		}
		$sql .= "\r\n LIMIT 1";
		
		$module = $this->db_instance->selectRow($sql);
		return $module;
	}

	
	
	
	private static function getDirectory($haystack)
	{
		$length = strlen($haystack) - 1;
		$last = substr($haystack,$length); 
        if($last=='/' || $last=='\\'){
          return substr($haystack,0,$length);
        }
		return $haystack;
	}
	
	
	public static function getTemp(){
      return self::getDirectory(sys_get_temp_dir());
	}
	
	
	public static function getDocumentRoot(){
	  return self::getDirectory($_SERVER["DOCUMENT_ROOT"]);
	}
	
	
	/*
	 * пїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ(пїЅпїЅпїЅпїЅпїЅпїЅпїЅ)
	 * */
	function getModulesByTemplate($templateId)	{
		$sql = $this->createViewForTemplate($templateId);
		$this->areasCache = array();
		$this->namesCache = array();
    	$modules = $this->db_instance->select($sql);
		if(!isset($modules)||$modules==false){
		  return false;  	
		}
		foreach($modules as $module) {
			if($module['locationName']=='area'){
			  $this->areasCache[$module['locationNum']] = $module;
			}else{
			  $this->namesCache[$module['name']] = $module;
			}
		}
		return $modules;
	}


	function getAllModules() {
		$sql = "SELECT * FROM `modules`";
		
		$modules = $this->db_instance->select($sql);
		
		return $modules;
	}

	function getFolders() {
		if($dir=opendir($this->modules_root)) {
			$list = array();
			$i=0;
			while ($file = readdir($dir)) {
				if($file!="." && $file!="..") {
					$list[$i].=$file;
					$i++;
				}
			}
			closedir($dir);
		}
		return $list;
	}

	function save($module)	{
		return $this->db_instance->saveData($module,'modules',$this->items);
	}

	function delete($module_id)	{
		$sql = "UPDATE `modules` SET `is_deleted`='1' WHERE `id`='" .$module_id."'";
		$this->db_instance->query($sql);
		return true;
	}

	function saveLocation($module_location)	{
		return $this->db_instance->saveData($module_location,'module_location',$this->items_location);
	}

	function deleteLocation($location_id)	{
		$sql = "UPDATE `module_location` SET `is_deleted`='1' WHERE `id`='" .$location_id."'";
		$this->db_instance->query($sql);
		return true;
	}

	/*
	 * пїЅпїЅпїЅпїЅ пїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ пїЅ GET пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅ config.inc.php $def_module
	 * */	
	public function findActiveModule($request,$defaultModuleName){
        $path = $request->getSelectedModule();
		//TODO: пїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅ
		if((isset($path[0])&& strstr($path[0],'index.php'))||!isset($path[0])){
		  $result = $defaultModuleName;
		}else{
		  $result = $path[0];	
		} 
		$result = $this->getModuleInCacheByName($result);
		if(!$result){
			$result = $this->getModuleInCacheByName($defaultModuleName);
		}
		return $result;
	}
	
	
	
	public function generateModulePath($module){
		$path = $this->modules_root.$module['name']."/src/";		
		return $path;
	}
	
	public function isModuleExist($path){
		if(is_file($path)){
			return true;
		}
		return false;
	}
	
	public function getModuleForTemplateByArea($templateId,$area){
		preg_match_all("/[0-9]+/",$area,$num);
		$area_num = $num[0][0];
		$params['locationNum'] = "=".$area_num;
		$module = $this->getModuleBy($templateId, $params);
		if(isset($module)&&$module) {
		  return $this->isModuleExist($module);
		}
		return false;
	}
	
	
	
	public function getModuleForTemplateByName($templateId,$moduleName){
		$params['name'] = "='".$moduleName."'";
		$module = $this->getModuleBy($templateId, $params);
		if(!isset($module)||$module==false){
		  return $this->isModuleExist($module);
		}
		return false;
	}
	
	
	
	public function getModuleInCacheByArea($area){
		preg_match_all("/[0-9]+/",$area,$num);
		$area_num = $num[0][0];	
		if(isset($area_num)&&
		   isset($this->areasCache)&&
		   array_key_exists($area_num,$this->areasCache)) {
		   $module = $this->areasCache[$area_num];
		   return $module;
		}
		return false;
	}
	
	
	
	public function updateCacheModuleText($localModule){
	   if(isset($localModule)&&isset($localModule['text'])){
	     $locationNum = $localModule['locationNum'];
	     if(isset($localModule['text'])){
	     	$this->areasCache[$locationNum]['text'] = $localModule['text'];
	     }
	   }	
	}
	
	
	public function getModuleInCacheByName($moduleName){
		if(isset($moduleName)&&
		   isset($this->namesCache) &&
		   array_key_exists($moduleName,$this->namesCache)){
			$module = $this->namesCache[$moduleName];
			return $module;
		}
		return false;
	}

	
	public static function hasModuleMatch($buffer,&$area,&$pos){
		return preg_match("/\\{#[a-z,0-9]+\\}/", $buffer, $area, PREG_OFFSET_CAPTURE, $pos); 
	}
	
	
}