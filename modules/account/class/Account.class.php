<?php
class Account {
	private $db_instance;
	private $request;
	public $sql;
	private $lng_prefix;
	public $count;
	public $items_news = array('id','content');

	
	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	function showRequests($user_id) {
		$sql = '
SELECT a.id, a.startTime, r.id, r.id_subservice, r.time, rs.state, rs.id_request, rs.id_out, rs.comment, rs.user_action, sub.s_name, sub.registry_number
FROM regportal_share.auth a
LEFT JOIN regportal_share.request r ON a.id = r.id_auth
LEFT JOIN regportal_share.response rs ON r.id = rs.id_request
LEFT JOIN regportal_services.subservice sub ON r.id_subservice = sub.id
WHERE a.id=r.id_auth AND
      a.passInfo = ? AND
      r.id = rs.id_request AND
       rs.state >= 7 AND rs.state <= 17 AND 
  rs.time = (
   SELECT MAX(TIME) FROM regportal_share.response WHERE response.id_request = r.id 
  ) 
GROUP BY r.id
ORDER BY rs.id DESC';

		$user_data = $this->db_instance->select($sql, $_SESSION['login']);

		return $user_data;
	}
	
	function getRequestForm($id_subservice, $registry_number){
		$checkStatusFile = "forms/status/check_".$registry_number.".php";					
		$this->db_instance->changeDB("regportal_services");
		$is_form_generate = $this->db_instance->selectCell('SELECT `generated` FROM `forms` WHERE id = (SELECT `form_id` FROM `subservice` WHERE `id` = ?)', $id_subservice);
		$this->db_instance->revertDB();
		if(!file_exists($checkStatusFile)){	
			if ($is_form_generate == 1) {
				$checkStatusFile = 'generate/src/xmlStatus.php';			
			}
			if($is_form_generate == 2){
				$checkStatusFile = "forms/status/check_ESRN.php";
			}
		}
		return $checkStatusFile;
	}
}
