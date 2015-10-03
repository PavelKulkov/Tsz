<?php
require_once($modules_root."../core/lib/captcha/recaptchalib.php");
class Feedback {

	private $db_instance;
	private $request;
	private $lng_prefix;
	private $sql;
	public $message = '';

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
	}
	
	
	function show() {
		$this->db_instance->changeDB('regportal_share');
		$feedbacks = $this->db_instance->select('SELECT * FROM feedback ORDER BY `date` DESC');
		
		$this->db_instance->revertDB();
		if(!$feedbacks) return false;
		
		return  $feedbacks;
	}

	
	function save() {
		$this->db_instance->changeDB('regportal_share');
		
		# the response from reCAPTCHA
		$resp = null;
		# the error code from reCAPTCHA, if any
		$error = null;
		$privatekey = $_POST['privatekey'];
		# was there a reCAPTCHA response?
		
		
		if (isset($_POST["recaptcha_response_field"])) {
		        $resp = recaptcha_check_answer ($privatekey,
		                                        $_SERVER["REMOTE_ADDR"],
		                                        $_POST["recaptcha_challenge_field"],
		                                        $_POST["recaptcha_response_field"]);
		
		        if ($resp->is_valid) {
		          //echo "Подтверждение получено!";
		          //$this->message = 'ok';
		        } else {
		          # set the error code so that we can display it
		           
		          $error = $resp->error;
		          $this->message = 'Введеные неправильные символы с изображения!';
		          return false;
		        }
		}
				
		if (!isset($_POST['fio']) || (isset($_POST['fio']) && empty($_POST['fio']))) {
			$this->message = 'Не заполненные обязательные поля (со звездочкой)!';
			return false;
		}
		
		if (!isset($_POST['contacts']) || (isset($_POST['contacts']) && empty($_POST['contacts']))) {
			$this->message = 'Не заполненные обязательные поля (со звездочкой)!';
			return false;
		}
		
		if (!isset($_POST['text']) || (isset($_POST['text']) && empty($_POST['text']))) {
			$this->message = 'Не заполненные обязательные поля (со звездочкой)!';
			return false;
		}
		
		$items_feedback = array('id', 'fio', 'contacts', 'text', 'date', 'status');
		$this->db_instance->save(array('fio' => $_POST['fio'], 'contacts' => $_POST['contacts'], 'text' => $_POST['text'], 'date' => date('Y-m-d H:i:s'), 'status' =>'0'), 'feedback', $items_feedback);
	
		$this->message = 'Заявка успешно отправлена!';
		$this->db_instance->revertDB();
		return true;
	}
	
	
	function close($feedback_id) {
		$this->db_instance->changeDB('regportal_share');
		$this->db_instance->update("UPDATE feedback SET status = 1 WHERE id = ?", $feedback_id);
		$this->db_instance->revertDB();
	}
	
}