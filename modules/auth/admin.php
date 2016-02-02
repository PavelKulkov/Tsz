<?php
session_start();

if($_GET['do'] == 'logout'){
	unset($_SESSION['admin']);
	session_destroy();
	header("Location: /");
	exit;
}
$admin = 'admin';
$pass = 'a029d0df84eb5549c641e04a9ef389e5';


	if($admin == $_POST['login'] && $pass == md5($_POST['password'])){
		$_SESSION['admin'] = $admin;
		header("Location: /registry");
		exit;
	}else echo '<p>Логин или пароль неверны!</p>';

?>