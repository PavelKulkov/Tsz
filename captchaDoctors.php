<?php

	// создаем случайное число и сохраняем в сессии
 
	$randomnr = rand(100000, 999999);
	$_SESSION['randomnr2'] = md5($randomnr);
 
	$im = imagecreatetruecolor(125, 38);
 
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 150, 150, 150);
	$black = imagecolorallocate($im, 0, 0, 0);
 
	$font = 'Karate.ttf';

	imagettftext($im, 19, 4, 18, 30, $grey, $font, $randomnr);
 
	imagettftext($im, 19, 4, 15, 32, $white, $font, $randomnr);
 
 
// 	//отсылаем изображение браузеру
// 	header ("Content-type: image/gif");
	imagegif($im);
	imagedestroy($im);
?>