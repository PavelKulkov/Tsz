<?php
$text = '';
require_once($modules_root."slideshow/class/Slideshow.class.php");
$slideshow_class = new Slideshow($request, $db);
$output_params['slides'] = $slideshow_class->getSlides();
include ($modules_root.'slideshow/view/view_'.SITE_THEME.'.php');
$module['text'] = $text;
?>