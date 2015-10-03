<?php
	require_once($modules_root."auth/class/Pass.class.php");

	if (isset($_GET["phone"])) $phone = $_GET["phone"];
	if (isset($_GET["pass"])) $password = $_GET["pass"];
	if (!isset($log))	$log = new Logger($db);
	if (isset($password)){		//проверка пароля
		$pass = new Pass($request, $db);
		$list = $pass->isLogin($password, $phone);
		//авторизация
		$meta = "Login,".$_SERVER['REMOTE_ADDR'];
		if ($list){
			$authHome->startSession($phone, "3");	//3 - авторизация через телефон
			$log->info($meta, "Авторизация через телефон - ".$phone.", sessionType=3");
		}else
			$log->info($meta, "Неудалось авторизоваться через телефон - ".$phone.", неверный пароль");
	}else{	//генерирование пароля, и отправка смс
		//логгируем
		$meta = "AuthSMSRequest,".$_SERVER['REMOTE_ADDR'];
		$log->info($meta, $phone);
		$list = false;	
		if (isset($phone) && (strlen($phone) == 11)){
			//Генерация пароля
			// Символы, которые будут использоваться в пароле.
			$chars="qazxswedcvfrtgbnhyujmkiolp123456789QAZXSWEDCVFRTGBNHYUJMKILP";
			// Количество символов в пароле.
			$max=6;
			$size=StrLen($chars)-1;
			$password=null;
			while($max--)
				$password.=$chars[rand(0,$size)];
			//Формирование текста смс
			$sms_text = "Ваш пароль на ".$_SERVER['SERVER_NAME']." - ".$password.". Сохраните его";
			$requestForm = $modules_root."forms/src/web/authorize/requests/sms.php";
			include $modules_root."forms/src/web/authorize/responses/smsParse.php";
		}	
    }
?>