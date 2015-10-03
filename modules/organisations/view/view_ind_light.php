<?php

	//one organisation
	if (isset($organisation_id)){
		include ($modules_root."organisations/view/".SITE_THEME."/view.php");
	} else { //many organisations
		include ($modules_root."organisations/view/".SITE_THEME."/list.php");
	}