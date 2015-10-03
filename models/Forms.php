<?php
class Forms {
	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;
	public $count;
	public $items_news = array('id','content_light');

	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	

	public function test() {
		$sql = 'SELECT content_'.SITE_THEME.' FROM forms WHERE id = ?';
		$ttt = $this->db_instance->selectRow($sql, 4);

		return $ttt;
	}
	
	public function getAllForms() {
		$forms = $this->db_instance->select("SELECT id, name, content_".SITE_THEME." FROM `forms` ");

		return $forms;	
	}
	
	public function edit(){	
		$sql = "SELECT id, name, content_".SITE_THEME." FROM `forms` WHERE id = ?";
		$form = $this->db_instance->selectRow($sql, $_POST['check_value'][0]);

		return $form;
	}


	public function save() {
		$name = $_POST['name'];
		$content = $_POST['content'];

		if (isset($_POST['id_form']) && $_POST['id_form'] != '') {
			$id_form = $_POST['id_form'];
			$sql = "UPDATE `forms` SET `content_".SITE_THEME."`= ?, `name` = ? WHERE `id`= ?";
			
			$info = $this->db_instance->update($sql, $content, $name, $id_form);
		} else {
			$sql = "INSERT INTO `forms` (`content_".SITE_THEME."`, `name`) VALUES (?, ?)";

			$info = $this->db_instance->insert($sql, $content, $name);
		}
		
		return $info['insert_id'];	
	}
	
	
	public function delete() {
		$chk_values = '';
		foreach ($_POST['check_value'] as $value) {
			$chk_values .= $value.',';
		}		
		$chk_values = substr($chk_values, 0, strlen($chk_values)-1) ;	
		
		$sql = "DELETE FROM `forms` WHERE id IN (%s)";

		$this->db_instance->delete($sql, $_POST['check_value']);	
	}
	
	
	public function saveResponse(&$data,$idRequest,$code,$id_out,$currentDate, $comment = ''){
		$this->db_instance->changeDB("regportal_share");
		$time = $currentDate->format("Y-m-d H:i:s");
		$hash = md5($data);
		$this->db_instance->insert('INSERT INTO `response` (`id_request`, `time`, `state`, `id_out`, `hash`, `comment`) VALUES (?, ?, ?, ?, ?, ?)', $idRequest, $time , $code, $id_out, $hash, $comment);
		$this->db_instance->revertDB();
	}
	
	
	public function saveRequestData($subservice_id,$currentDate) {
		$this->db_instance->changeDB("regportal_share");
		$sql = 'INSERT INTO `request` (`id_auth`,`id_subservice`, `time`) VALUES (?, ?, ?)';
		$time = $currentDate->format("Y-m-d H:i:s");
		$id_auth = isset($_SESSION['ID'])?$_SESSION['ID']:0;
		$info = $this->db_instance->insert($sql,$id_auth, $subservice_id, $time);
		$this->db_instance->revertDB();
		return $info['insert_id'];
	}

}