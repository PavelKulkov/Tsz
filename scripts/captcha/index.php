<?php
require_once("scripts/captcha/kcaptcha.php");
$captcha = new KCAPTCHA();
$session->setValue('captcha_code', $captcha->getKeyString());
?>