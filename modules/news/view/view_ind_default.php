<?php

	if ($new) {
	include ($modules_root.'news/view/view.php');
	} else {
		include ($modules_root.'news/view/list.php');
	}

	$module['text'] = $text;