<?php
	if(!isset($leftHome))	$leftHome = new Menu($request,$db);
	
	if ($admin) {
		$list = $templateHome->getList();
		$operation = NULL;
		if($request->hasValue('operation')){
			$operation = $request->getValue('operation');
		}else{
			$operation = "show";
		}

		switch ($operation) {
			case "show" :
				include($modules_root."leftMenu/view/show.php");
				break;
			case "new" :
				include($modules_root."leftMenu/view/new.php");
				break;				
			case "edit":
				include($modules_root."leftMenu/view/edit.php");
				break;
			case "save":
				$leftHome->save();
				$text = '<script type="text/javascript">
							window.location = "/modules/auth/leftMenu"
						</script>';
				$module['text'] = $text;
				break;
			case "delete":
				$leftHome->delete();
				$text = '<script type="text/javascript">
							window.location = "/modules/auth/leftMenu"
						</script>';
				$module['text'] = $text;
				break;
		}
	}


$module['text'] = $text;