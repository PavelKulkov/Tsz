<?php
	if ($new) {
		include ($modules_root.'news/view/'.SITE_THEME.'/view.php');
	} else {
		include ($modules_root.'news/view/'.SITE_THEME.'/list.php');
	}
