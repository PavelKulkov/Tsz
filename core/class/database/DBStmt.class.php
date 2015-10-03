<?php

class DBStmt {
	
    private $conn;

    /**
    * Имя метода подготовки данных для выбора типа запроса:
    * для выбора ассоциативного массива, либо ячейки, либо строки, либо столбца
    * @var string
    */
	private $returnMethod;
    				
  	/**
    * Ассоциативный массив с информацией запроса
    * query_info(affected_rows,num_rows,etc)
    * @var array
    */
    public $queryInfo;

    private $stmt;   
    
    
    function __construct($conn){
      	$this->conn = $conn;   
      	if ($this->stmt) $this->stmt->close();  
    }

	
    /**
    *	Метод общей подготовки запроса stmt
    *  
    */
    public function stmt_query($arguments) {
        $this->prepareQuery($arguments);
        $query = $arguments[0];

        if ($this->stmt) $this->stmt->close();

        $this->stmt = $this->conn->prepare($query);
        if (!$this->stmt) return false;

        if (count($arguments) > 1) {
            $bindVars = $arguments;
            unset($bindVars[0]);
            $params = array();
            $binding = $this->bindParams($bindVars, $params);
            if (!$binding) return false;
        }
        return true;
    }
    
    
    /**
    * Метод для запросов типа SELECT
    * @return array|string|bool false=fail;<br>array=Методы, подобные select, selectCol и др.<br> string=метод, типа selectCell
    */
    public function s_query() {
        $data = null;
        $arguments = func_get_args();
        
        // метод обработки содержитсяв конце масива с аргументами
        $this->returnMethod = end($arguments);
        
        // после определения конечного метода обработки удаляем его из массива
        // чтобы не стоял вместе с переменными для биндига
        array_pop($arguments);  
        
        $this->stmt_query($arguments);
        if (!$this->stmt) return false;

        $execute = $this->stmt->execute();
        if (!$execute) return false;

        $result = $this->bindResult($data);
        if (!$result) return false;

        $returnPrepareMethod = $this->returnMethod;
        $rows = $this->$returnPrepareMethod($data);
        $this->setQueryInfo();
        return $rows;
    }


    /**
    * Метод для запросов типа INSERT/DELETE
    * @return bool|MySQLi_STMT
    */
    public function i_query() {
        $arguments = func_get_args();
        $this->stmt_query($arguments);
        if (!$this->stmt) return false;

        $execute = $this->stmt->execute();
        if (!$execute) return false;
        $this->setQueryInfo();
        return true;
    }
    
    
    /**
    * Раширение заполнителя %s (array)<br>
    * @param  $arguments
    * @return void
    */
    public function prepareQuery(&$arguments) {
        $sprintfArg = array();
        $sprintfArg[] = $arguments[0];
        foreach ($arguments as $pos => $var) {
            if (is_array($var)) {
                $insertAfterPosition = $pos;
                $replaceWith = array();
                unset($arguments[$pos]);
                foreach ($var as $arrayVar) {
                    array_splice($arguments, $insertAfterPosition, 0, $arrayVar);
                    $insertAfterPosition++;
                    $replaceWith[] = '?';
                }
                $sprintfArg[] = implode(',', $replaceWith);
            }
        }
        $arguments[0] = call_user_func_array('sprintf', $sprintfArg);
    }

    
    /**
    * @param  объект $stmt класса MySQLi_STMT
    * @param  array $bindVars vars, содержит значения для замены
    * @param  array $params параметры для связи
    * @return void
    */
    public function bindParams($bindVars, &$params) {
        $params[] = $this->getParamTypes($bindVars);
        foreach ($bindVars as $key => $param) {
            $params[] = &$bindVars[$key]; // pass by reference, not value
        }
        return call_user_func_array(array($this->stmt, 'bind_param'), $params);
    }

    
    /**
    * Возвращает строку типа  iis (integer,integer,string) для биндинга (bindParams)
    * @param  $arguments
    * @return string
    */
    public function getParamTypes($arguments) {
        unset($arguments[0]);
        $retval = '';
        foreach ($arguments as $arg) {
            $retval .= $this->getTypeByVal($arg);
        }
        return $retval;
    }

    
    /**
    * Метод для определения типа переменной в запросе (int,float or string)
    * @param  $variable
    * @return string
    */
    public function getTypeByVal($variable) {
        switch (gettype($variable)) {
            case 'integer':
                $type = 'i';
                break;
            case 'double':
                $type = 'd';
                break;
            default:
                $type = 's';
        }
        return $type;
    }
    
    
    /**
    * Bind results
    * @param  $data
    * @return mixed
    */
    public function bindResult(&$data) {
        $this->stmt->store_result();
        $variables = array();

        $meta = $this->stmt->result_metadata();
        /**
         * @var  mysqli_result $field
         */
        while ($field = $meta->fetch_field()) {
            $variables[] = &$data[$field->name]; // pass by reference, not value
        }
        return call_user_func_array(array($this->stmt, 'bind_result'), $variables);
    }
    
    
    /**
    * Связь с переменной queryInfo. - дополнительная информация,
    * например:  "num_rows" and "affected_rows"
    * @return void
    */
    public function setQueryInfo() {
        $info = array(
            'affected_rows' => $this->stmt->affected_rows,
            'insert_id' => $this->stmt->insert_id,
            'num_rows' => $this->stmt->num_rows,
            'field_count' => $this->stmt->field_count,
            'sqlstate' => $this->stmt->sqlstate,
        );
        $this->queryInfo = $info;
    }


    /**
    * 
    * @param  $data
    * @return array
    */
    public function mysqliFetchAssoc(&$data) {
        $i = 0;
        $array = array();
        while ($this->stmt->fetch())
        {
            $array[$i] = array();
            foreach ($data as $k => $v) {
                $array[$i][$k] = $v;
            }
            $i++;
        }
        return $array;
    }

    /**
    * 
    * @param  $data
    * @return array
    */
    public function mysqliFetchCol(&$data) {
        $i = 0;
        $array = array();
        while ($this->stmt->fetch())
        {
            $array[$i] = array();
            foreach ($data as $v) {
                $array[$i] = $v;
                break;
            }
            $i++;
        }
        return $array;
    }

    /**
    * 
    * @param  $data
    * @return array
    */
    public function mysqliFetchRow(&$data) {
        $this->stmt->fetch();
        return $data;
    }

    /**
    *
    * @param  $data
    * @return string
    */
    public function mysqliFetchCell(&$data){
        $this->stmt->fetch();
        return $data[key($data)];
    }

    
    public function transactionStart() {
        $this->conn->autocommit(false);
    }

    /**
    * Закнчивает транзакцию и коммитит данные
    * @return void
    */
    public function transactionCommit() {
        $this->conn->commit();
        $this->conn->autocommit(true);
    }

    /**
    * Откат транзации
    * Пример:
    * $db=new simpleMysqli($config);
    * $db->transactionStart();
    * $db->insert('INSERT INTO `test` set testval=?',20);
    * $db->insert('INSERT INTO `test` set testval=?',10);
    * $db->insert('INSERT INTO `test` set testval=?',123);
    * $db->transactionRollBack(); // rollback changes
    * $db->transactionCommit(); // insert did not occur
    * @return void
    */
    public function transactionRollBack() {
        $this->conn->rollback();
    }
    /**
     * Возвращает обьект класса mysqli для нереализованных операций
     * @return mysqli
     */
    public function _getObject(){
        return $this->conn;
    }	
}