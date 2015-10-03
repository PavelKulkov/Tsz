<?php

class Account {
	
	private $db;
	private $request;
	private $lng_prefix;

	
	function __construct($request = NULL, $db) 	{
		$this->db = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}

	
	function showRequests($user_id) {
		$sql = '
SELECT a.id, a.startTime, r.id, r.id_subservice, r.time, rs.state, rs.id_request, rs.id_out, rs.comment, sub.s_name, sub.registry_number
FROM regportal_share.auth a
LEFT JOIN regportal_share.request r ON a.id = r.id_auth
LEFT JOIN regportal_share.response rs ON r.id = rs.id_request
LEFT JOIN regportal_services.subservice sub ON r.id_subservice = sub.id
WHERE a.id=r.id_auth AND
      a.passInfo = ? AND
      r.id = rs.id_request AND
       rs.state >= 7 AND rs.state <= 10 AND 
  rs.time = (
   SELECT MAX(TIME) FROM regportal_share.response WHERE response.id_request = r.id 
  ) 
GROUP BY r.id
ORDER BY rs.id DESC';

		$user_data = $this->db->select($sql, $_SESSION['login']);
		
		return $user_data;
	}
}