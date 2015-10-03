<?php
 class State {
	function __construct() 	{
		$this->lng_prefix = $GLOBALS["lng_prefix"];
	}
	
	private static $enum = array(
			1 => "Запрос подготовлен к отправке", 
			2 => "OEP-SIGNER не может отправить запрос",
			3 => "OEP-SIGNER не ответил",
			4 => "Cтатус ответа не найден",
			5 => "Ошибка в данных запроса",
			6 => "Удаленный сервер не смог обработать запрос",
			7 => "В ведомстве",
			8 => "В обработке",
			9 => "Отказано в предоставлении услуги",
			10 => "Выполнено",
			11 => "Ожидается дополнительное действие пользователя",
			12 => "Отменена с возможностью возобновления",
			13 => "Отменена",
			14 => "На ожидании",
			15 => "На рассмотрении",
			16 => "На регистрации",
			17 => "Лично предоставляемые документы получены, документы, получаемые посредством межведомственного взаимодействия ожидаются"
	);
	
	private static $enum_class = array(
			1 => "",
			2 => "",
			3 => "",
			4 => "",
			5 => "",
			6 => "",
			7 => "in_line_msg",
			8 => "in_smev_msg",
			9 => "error_msg",
			10 => "success_msg",
			11 => "in_waitUser_msg",
			12 => "",
			13 => "error_msg",
			14 => "in_waitUser_msg",
			15 => "in_line_msg",
			16 => "in_smev_msg",
			17 => "in_waitUser_msg"
	);
	
	public static function isCanceled($state) {
		$arr = array(9, 10, 12, 13);
		return !in_array($state, $arr);
	}
	
	public static function toState($name) {
		return array_search($name, self::$enum);
	}
	
	public static function getStateName($state) {
		return (isset(self::$enum[$state])) ? self::$enum[$state] : $state;
	}
	
	public static function getClass($state) {
		return (isset(self::$enum_class[$state])) ? self::$enum_class[$state] : "";
	}
	
}
