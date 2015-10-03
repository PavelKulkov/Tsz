<?php

	if ($tsz) {
	include ($modules_root.'registry/view/registry_member.php');
	} else {
		include ($modules_root.'registry/view/registry.php');
	}

	$module['text'] = $text;