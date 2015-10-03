<?php
require_once('DBStmt.class.php');
class DB
{
		private $conn = null;

		private  $result = null;

		private $exeption = "Sorry for convinience. Database is down. Please visit us later.";

		private static $instance = null;
		
		private $activeDB;
		
		private $bufferDB;
    	
    	private $db_stmt;


		function __construct(){}

		public function connect($dbRegInfo) {
          $this->conn = $dbRegInfo->createConnection();
          $this->activeDB = $dbRegInfo->getDBName();
		}
		
		
		private function selectDB(){
		  if (!$this->conn->select_db($this->activeDB)) throw new DbException("Не возможно переключиться на БД " + $this->dbName);
		}

		public function changeDB ($newDBName){
			$this->bufferDB = $this->activeDB;
			$this->activeDB = $newDBName;
			$this->selectDB();
		}

		public function revertDB(){
			if(isset($this->bufferDB)){
			  $this->activeDB = $this->bufferDB;
			  $this->selectDB();
			}
		}		
		
		
		public function disconnect(){
		  $this->conn->close();	
		}

		public static function getInstance() {
			if (self::$instance == null) {
				self::$instance = new DB();
			}
			return self::$instance;
		}
		
		public static function setInstance($db){
		  self::$instance = $db;	
		} 

		public function query($sql)	{
			$this->result = $this->conn->query($sql);
			$error = $this->errorNo(); 
			if($error) {
				if($GLOBALS['debug_mode']) {
					$this->exeption .= $error . " In query '" . $sql . "' ";
					throw new DbException($this->exeption);
				} else {
					echo "Database error.\n";
					return false;
				}
			}
			return $this->result;
		}

		public function fetchArray($result = null) {
			if($result) {
				return $result->fetch_array(MYSQLI_ASSOC);
			} else {
				if($this->result) {
					return $this->result->fetch_array(MYSQLI_ASSOC);
				} else {
					return false;
				}
			}
		}

		public function dataSeek($row_number) {
			return $this->conn->data_seek ($this->result, $row_number );
		}

		public function insertId() {
			return $this->conn->insert_id($this->conn);
		}

		public function numRow($result = null) {
			if($result) {
				return mysqli_num_rows($result);
			} else {
				return mysqli_num_rows($this->result);
			}
		}

		public function numFields() {
			return $this->conn->num_fields($this->result);
		}

		public function error()	{
			return $this->conn->error();
		}

		public function errorNo() {
			return $this->conn->error;
		}

		public function fetchAssoc() {
			return $this->conn->fetch_assoc($this->result);
     	}

	public function getCountData($sql,$field) {
		$result = $this->query($sql);
		$error  = $this->conn->error;
		if($this->numRow($result)) {
			if($rs = $this->fetchArray()) {
				return $rs[$field];
			}
		}
		return 0;
	}

	
	public function insertRowIntoTable($table,$fields){
	  if(count($fields)==0){
	    throw new Exception('Не указанны значения полей');	
	  }	
	  $sql = 'INSERT INTO `'.$table.'` SET ';
	  foreach ($fields as $field => $value){
        $sql.=$field.'='.$value;
        if(next($fields)){
          $sql.= ',';	
        }
	  }
	  $result = $this->query($sql);
	  if($result){
	  	return $this->conn->insert_id;
	  }
	  return $result;
	}
	
	// для всего работает пока что старое сохранение как это:
	public function saveData($item,$table,$items_array) {
		
		if(isset($item['id'])) {
			$sql = 'UPDATE `'.$table.'` SET ';
		} else {
			$sql = 'INSERT INTO `'.$table.'` SET ';
		}
		$sql_add = "";
		foreach ($items_array as $item_name) {
			if(isset($item[$item_name])) {
				if($sql_add) $sql_add .= ', ';
				$sql_add .= " `".$item_name."`='".addcslashes(stripcslashes($item[$item_name]),"'")."' ";
			}
		}
		$sql .= $sql_add;
		if(isset($item['id'])) {
			$sql .= " WHERE `id`='".$item['id']."' ";
		}
		
		
		$result = $this->query($sql);
		
		if($result) {
			if(!$item['id']) {
				$item['id'] = $this->insertId();
			}
			return $item['id'];
		}
		return false;
	}
	        
	
	/**
	* новое сохранение будет для всех..наверное такое....хз
	* пока работают NEWS и ABOUT
	* 
	*/
	public function save($item,$table,$items_array) {
		$sql_add = "";
		$bind_params = array();
		foreach ($items_array as $item_name) {			
			if(isset($item[$item_name])) {
				if($sql_add) $sql_add .= ', ';
				$sql_add .= " `".$item_name."`= ? ";
				$bind_params[]= addcslashes(stripcslashes($item[$item_name]),"'");
			}
		}
		
		if(isset($item['id']) && $item['id'] != '') {
			$sql = 'UPDATE `'.$table.'` SET ';
			$sql .= $sql_add.' WHERE `id` = '.$item['id'];
			$result = $this->update($sql, $bind_params);
		} else {
			$sql = 'INSERT INTO `'.$table.'` SET ';
			$sql .= $sql_add;
			$result = $this->insert($sql, $bind_params);
		}

		if($result) {
			if(!$item['id']) {
				$item['id'] = $result['insert_id'];
			}
			return $item['id'];
		}
		return false;
	}
	
	/**
	* Запросы со множеством типа IN() должны быть в следующем виде:
	* массив множества:  $list = array(1,5,9,35,465,87,345, etc)
	* запрос, пример: SELECT foo, bar, etc FROM table WHERE id IN(%s
	* %s - универсальный плейсхолдер, в котором все элементы массива
	* с помошью метода prepareQuery()
	* заменяются на плейсходеры бинднга типа "?"
	* prepareQuery() вернет уже корректный запрос вида SELECT foo, bar, etc FROM table WHERE id IN(?,?,?,?,?,?,?, etc)
	*/
	public function select($query) {
        $arguments = func_get_args();       
        $arguments[]= 'mysqliFetchAssoc';    
        
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 's_query'), $arguments);
    }
    

    public function selectRow($query) {
        $arguments = func_get_args();       
        $arguments[]= 'mysqliFetchRow';
        
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 's_query'), $arguments);
    }
	

    public function selectCol($query) {
        $arguments = func_get_args();
        $arguments[]= 'mysqliFetchCol';
        
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 's_query'), $arguments);
    }

    
    public function selectCell($query) {
        $arguments = func_get_args();
        $arguments[]= 'mysqliFetchCell';
        
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 's_query'), $arguments);
    }
    

    public function insert($query) {
        $arguments = func_get_args();
        
        $this->db_stmt = new DBStmt($this->conn);
        call_user_func_array(array($this->db_stmt, 'i_query'), $arguments);
        
        $info = $this->db_stmt->queryInfo;
        return $info;
    }


    public function update($query) {
        $arguments = func_get_args();
        
        $this->db_stmt = new DBStmt($this->conn);
        call_user_func_array(array($this->db_stmt, 'i_query'), $arguments);
        
        $info = $this->db_stmt->queryInfo;
        return $info;
    }

    
    
    /**
     * 
     *  Новые версии запросов к БД  (кроме selectCol и selectCell)
     *  
     */
    
	public function query2($query, $params = null, $returnMethod) {
		$arguments = array($query);       	
				
		if ($params !== null) {
    		foreach ($params as $param) {
				array_push($arguments, $param);
    		}
    	}
    	
        $arguments[]= $returnMethod;
		$this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 's_query'), $arguments);
	}
    
	
	public function select2($fields = null, $table, $where = null, $params = null, $order = null, $limit_F = null, $limit_S = null) {
		if ($fields == null || (is_array($fields) && in_array('*', $fields))) {
    		$fields_string = '*';
    	} else {
	    	$fields_string = '';
    		foreach ($fields as $value) {
    			$fields_string .= '`'.$value.'`,';	
    		}
    		
    		$fields_string = substr($fields_string, 0, -1);
    	}
    	
    	$query = 'SELECT '.$fields_string.' FROM `'.$table.'`'.
				( $where !== null ? ' WHERE '.$where : '').
				( $order !== null ? ' ORDER BY '.$order: '').
				( $limit_F !== null ? ' LIMIT '.( $limit_S === null ? $limit_F : $limit_F.', '.$limit_S ): '');

		
		$arguments = array($query);       	
				
		if ($params !== null) {
    		foreach ($params as $param) {
				array_push($arguments, $param);
    		}
    	}
    	
        $arguments[]= 'mysqliFetchAssoc';    
		
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 's_query'), $arguments);
    }
	
    
	public function selectRow2($fields = null, $table, $where = null, $params = null) {
		
        if ($fields == null || (is_array($fields) && in_array('*', $fields))) {
    		$fields_string = '*';
    	} else {
	    	$fields_string = '';
    		foreach ($fields as $value) {
    			$fields_string .= '`'.$value.'`,';	
    		}
    		
    		$fields_string = substr($fields_string, 0, -1);
    	}

    	
    	
     	$query = 'SELECT '.$fields_string.' FROM `'.$table.'`'.( $where !== null ? ' WHERE '.$where : '');
		
     	$arguments = array($query);
     	
     	if ($params !== null) {
    		foreach ($params as $param) {
				array_push($arguments, $param);
    		}
    	}
    	
        $arguments[]= 'mysqlifetchRow';
//        var_dump($arguments);
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 's_query'), $arguments);
    }
    
    
    public function insert2($fields, $table, $params = null) {
    	
    	$v = '(';
		foreach ($fields as $value) {
			$v .= (is_array($value) ? $value[0] : 
				(($value == '?') ? $value = '?': 
					 ( is_numeric($value) ? $value : '"'.mysql_escape_string($value).'"'))     ).',';
		}
		$v = substr($v, 0, -1).')';

		$c = '(';
		$keys = array_keys($fields);
		foreach ($keys as $key) $c .= '`'.$key.'`,';
		$c = substr($c, 0, -1).')';

		$query = 'INSERT INTO `'.$table.
				'` '.$c.
				' VALUES '.$v.
				($onDuplicateKeyUpdate != null ? ' ON DUPLICATE KEY UPDATE '.$onDuplicateKeyUpdate : '');
    	
    	$arguments = array($query);       	
				
		if ($params !== null) {
    		foreach ($params as $param) {
				array_push($arguments, $param);
    		}
    	}
    	
        $this->db_stmt = new DBStmt($this->conn);
        call_user_func_array(array($this->db_stmt, 'i_query'), $arguments);
        
        $info = $this->db_stmt->queryInfo;
        
        return $info;
    }


    public function update2($fields, $table, $where = null, $params = null) {
    	foreach ($fields as $column => $newValue) {
			$set[] = '`'.$column.'` = '.( is_array($newValue) ? $newValue[0] : (($newValue == '?') ? $newValue = '?': '\''.mysql_escape_string($newValue).'\''));
		}
    	$query = 'UPDATE `'.$table.'` SET '.implode(', ', $set).( $where != null ? ' WHERE '.$where : '');
    	
    	$arguments = array($query);       	
				
		if ($params !== null) {
    		foreach ($params as $param) {
				array_push($arguments, $param);
    		}
    	}

        $this->db_stmt = new DBStmt($this->conn);
        call_user_func_array(array($this->db_stmt, 'i_query'), $arguments);
        
        $info = $this->db_stmt->queryInfo;
        return $info;
    }
    
    /**
    * @param  $query
    * @return boolean
    */
    public function delete2($table, $where,  $params = null) {
    	
    	$query = 'DELETE FROM `'.$table.'` WHERE '.$where;
    	
        $arguments = array($query);       	
				
		if ($params !== null) {
    		foreach ($params as $param) {
				array_push($arguments, $param);
    		}
    	}

        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 'i_query'), $arguments); 
    }
    
    /**
    * @param  $query
    * @return boolean
    */
    public function delete($query) {
        $arguments = func_get_args();
        
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 'i_query'), $arguments); 
    }
     

    public function replace($query) {
        $arguments = func_get_args();
        
        $this->db_stmt = new DBStmt($this->conn);
        return call_user_func_array(array($this->db_stmt, 'i_query'), $arguments);
    }
   
}