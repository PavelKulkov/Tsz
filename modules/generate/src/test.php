<?php

require_once($modules_root."generate/class/generate.class.php");

$generate = new generateForms($request, $db);


	switch ($_POST['action']) {
	
		case "saveSource" : {
		$generate->saveSource();
		break;
		}	
	
	};
	
	switch ($_GET['action']) {
	
		case "queryEditField" : {
		$list = $generate->queryEditField();
		break;
		}
		
		case "editField" : {
		$generate->editField();
		break;
		}
		
		
		case "addField" : {
		$data = $generate->addField();
		break;
		}
		
		case "bindField" : {
		$generate->bindField();
		break;
		}
		
		case "unbindField" : {
		$generate->unbindField();
		break;
		}
		
		case "searchStep" : {
		$list = $generate->searchStep();
		break;
		}
		
		case "queryFields" : {
		$data = $generate->queryFields();
		break;
		}

		
		case "searchField" : {
		$data = $generate->searchField();
		break;
		}
		
		
		case "checkEditField" : {
		$data = $generate->checkEditField();
		break;
		}	

		case "searchSubservice" : {
		$data = $generate->searchSubservice();
		break;
		}

		case "loadSource" : {
		$data = $generate->loadSource();
		break;
		}			

		case "saveSource" : {
		$generate->saveSource();
		break;
		}	
		
		case "deleteStep" : {
		$generate->deleteStep();
		break;
		}	
		
		case "addStep" : {
		$generate->addStep();
		break;
		}	

		case "addStepsApplicants" : {
		$generate->addStepsApplicants();
		break;
		}	
		
		case "addSortingFields" : {
		$generate->addSortingFields();
		break;
		}	

		case "addSortingSteps" : {
		$generate->addSortingSteps();
		break;
		}	
		
		case "addCondition" : {
		$generate->addCondition();
		break;
		}
		
		case "loadForm" : {
		include($modules_root."/generate/class/create.class.php");
		break;
		}	

		case "uploadTz" : {
		include($modules_root."/generate/class/PHPExcel/index.php");
		break;
		}
		
		case "loadConditions" : {
		$data = $generate->loadConditions();
		break;
		}

		case "deleteCondition" : {
		$generate->deleteCondition();
		break;
		}

		case "searchConditions" : {
		$data = $generate->searchConditions();
		break;
		}
		
		
		case "addCloneBlock" : {
		$generate->addCloneBlock();
		break;
		}

		case "loadCloneBlocks" : {
		$data = $generate->loadCloneBlocks();
		break;
		}	

		case "queryEditCloneBlock" : {
		$list = $generate->queryEditCloneBlock();
		break;
		}

		case "editCloneBlock" : {
		$generate->editCloneBlock();
		break;
		}
		
		case "deleteCloneBlock" : {
		$generate->deleteCloneBlock();
		break;
		}
		
		case "queryConditionCloneBlock" : {
		$list = $generate->queryConditionCloneBlock();
		break;
		}

		case "copyForm" : {
		$generate->copyForm();
		break;
		}
		
	};

	if ($list) {
	$result = array('data'=>$list);
	echo json_encode($result);
	}
	
	echo $data;