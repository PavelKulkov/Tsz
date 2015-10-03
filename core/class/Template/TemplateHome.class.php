<?php
class TemplateHome {

	private $db_instance;
	private $file;
	private $file_name;
	public $items = array('id','name','description');

	function __construct($db)	{
		$this->db_instance = $db;
	}

	public function getBy($par,$value){
		$fields['is_deleted'] = '0';
		return getByFields($par,$val,$fields);
	}
	
	public function getByFields($par,$value,$fields){
		$sql = "SELECT t.* \r\n".
		       "FROM `templates` t \r\n".
		       "WHERE t.`".$par."`= ? \r\n";
		
		
		foreach ($fields  as $key => $val){
		  $sql .= " AND t.`" .  $key."` = '".$val."'";  	
		}

		$sql.= "\r\nLIMIT 1;";
//		echo $sql;
		return $this->db_instance->selectRow($sql, $value);
	}

	public function getList(){
		$sql = "SELECT * FROM `templates` WHERE `is_deleted`='0'";
		return $this->db_instance->select($sql);
	}

    
    public function save($template){
    	return $this->db_instance->saveData($template,'templates',$this->items);
    }

	public function delete($id_template){
		$sql = "UPDATE `templates` SET `is_deleted`='1' WHERE `id`='".$id_template."'";
		$this->db_instance->query($sql);
		return true;
	}

}
?>