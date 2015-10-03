<?php

class generateForms {

    private $db_instance;
    private $request;
    public $count;
    private $list;
	
    function __construct($request = NULL, $db) {
        $this->db_instance = $db;
        $this->db_instance->changeDB('generate');
    }
	
    public function addField() {
	
		$_GET['addFormat'] = str_replace("undefined","",$_GET['addFormat']);
		
        $sql = "INSERT INTO `fields` (`label`, `name`, `type`, `required`, `disabled`, `clone`, `maxlength`, `format`, `class`, `dictionary`, `comment`, `value`, `hidden`, `mask`, `header`, `placeholder`) VALUES ( ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $last_insert = $this->db_instance->insert($sql, trim($_GET['addLabel']), trim($_GET['addName']), trim($_GET['addType']), trim($_GET['addRequired']), trim($_GET['addDisabled']), trim($_GET['addClone']), trim($_GET['addMaxlength']), trim($_GET['addFormat']), trim($_GET['addClass']), trim($_GET['addDictionary']), trim($_GET['addComment']), trim($_GET['addValue']), trim($_GET['addHidden']), trim($_GET['addMask']), trim($_GET['addHeader']), trim($_GET['addPlaceholder']));
        
		if ($_GET['addFormat'] == "document") {
			
			$_GET['addName'] = str_replace("_type","",$_GET['addName']);
			
			$sql = "SELECT * FROM `fields` WHERE `name`=? OR `name`=? OR `name`=? OR `name`=?";
			$result = $this->db_instance->select($sql, $_GET['addName']."_number", $_GET['addName']."_series", $_GET['addName']."_dateIssue", $_GET['addName']."_organistation");
		
		}
		
		if (count($result) > 0) {
			$last_insert['insert_id'] .= ":document";
		}
		
		echo $last_insert['insert_id'];
    }
	
    public function bindField() {
	
        $sql = "INSERT INTO `fields_steps` (`id_step`, `id_field`, `id_form`) VALUES (?, ?, ?)";
        $info = $this->db_instance->insert($sql, $_GET['idStep'], $_GET['idField'], $_GET['idForm']);
        return true;
    }
	
    public function unbindField() {
	
        $sql = "DELETE FROM `fields_steps` WHERE id_field = ? AND id_step = ? AND id_form = ?";
        $this->db_instance->delete($sql, $_GET['idField'], $_GET['idStep'], $_GET['idForm']);
        return true;
    }

    public function searchStep() {
	
        $sql = "SELECT * FROM `steps` WHERE MATCH(`label`) AGAINST(? IN BOOLEAN MODE)";
        $data = $this->db_instance->select($sql, $_GET['stepName'] . "*");
        return $data;
    }
	
    public function queryFields() {
	
        $this->db_instance->changeDB('generate');
        $data = "";
		
        if ($_GET['editForm'] === "false") {
		
            $sql = "SELECT * FROM `fields` WHERE id=?";
            $list = $this->db_instance->selectRow($sql, $_GET['idField']);
			
			if (!empty($list['comment'])) {
				$comment = " <span style='color: green; font-weight: bold;'>[ ".$list['comment']." ]</span>";
			}
			
            if ($_GET['checked'] === "true") {
                $checked = "checked='checked'";
                $style = "style='background-color: #FFF6EB;'";
            }
			
            $data.= "
                    
                <tr height='40' " . $style . ">
                    <td width='45'># " . $list['id'] . "</td>
                    <td>" . $list['label'].$comment . "</td>
                    <td>" . $list['name'] . "</td>
                    <td>".$list['type']." ".$list['format']."</td>
                    <td width='45'><input type='checkbox' id='" . $list['id'] . "' class='bindField' " . $checked . "> <i style='cursor: pointer; left: 35px; position: relative;' class='icon-pencil'></i></td>
                </tr>";
        } else {
		
            $sql = "SELECT * FROM `fields_steps` LEFT JOIN fields ON fields.id = id_field WHERE id_form = ? && id_step = ? ORDER BY sort ASC";
            $rowFields = $this->db_instance->select($sql, $_GET['idForm'], $_GET['idStep']);
		
            foreach($rowFields as $key) {
			
			if (!empty($key['comment'])) {
				$comment = " <span style='color: green; font-weight: bold;'>[ ".$key['comment']." ]</span>";
			} else {unset($comment);}
			
                $data.= "
                    
                <tr height='40' style='background-color: #FFF6EB;'>
                    <td width='45'># " . $key['id'] . "</td>
                    <td>" . $key['label'].$comment . "</td>
                    <td>" . $key['name'] . "</td>
                    <td>".$key['type']." ".$key['format']."</td>
                    <td width='45'><input type='checkbox' id='" . $key['id'] . "' class='bindField' checked='checked'> <i style='cursor: pointer; left: 35px; position: relative;' class='icon-pencil'></i></td>
                </tr>";
            }
        }
        return $data;
    }
	
	
    public function searchField() {
	
        $sql = "SELECT * FROM `fields` WHERE MATCH(`label`) AGAINST(? IN BOOLEAN MODE) OR id=? OR name=? ORDER BY `rank` DESC";
        //$sql = "SELECT * FROM `fields` WHERE id=? OR label=? OR name=?";  
		
		//$list = $this->db_instance->select($sql, $_GET['searchString'] . "*");
		$list = $this->db_instance->select($sql, $_GET['searchString'] . "*", $_GET['searchString'], $_GET['searchString']);
		
        $data = "";
		
        foreach($list as $key) {
		
			if (!empty($key['comment'])) {
				$comment = " <span style='color: green; font-weight: bold;'>[ ".$key['comment']." ]</span>";
			} else {unset($comment);}
			
            $data.= "
            
        <tr class='searchField' height='40' style='background-color: #FDD6B4;'>
            <td width='45'># " . $key['id'] . "</td>
            <td>" . $key['label'].$comment . "</td>
            <td>" . $key['name'] . "</td>
            <td>".$key['type']." ".$key['format']."</td>
            <td width='45'><input type='checkbox' id='" . $key['id'] . "' class='bindField'> <i style='cursor: pointer; left: 35px; position: relative;' class='icon-pencil'></i></td>
        </tr>";
        }
        return $data;
    }
	
    public function searchSubservice() {
	
        $this->db_instance->changeDB('regportal_services');
        $sql = "SELECT * FROM `subservice` WHERE MATCH(`registry_number`) AGAINST(? IN BOOLEAN MODE) OR `id` = ?";
        $result = $this->db_instance->selectRow($sql, $_GET['searchSubserviceString'] . "*", $_GET['searchSubserviceString']);
		
        if (isset($result['id'])) {
			
            if ($result['form_id'] == NULL || $result['form_id'] == "") {
            $sql = "INSERT INTO `forms` (`name`, `generated`) VALUES (?,1)";
            $last_insert = $this->db_instance->insert($sql, $_GET['nameSubservice']);
            echo $last_insert['insert_id'];
            $sql = "UPDATE `subservice` SET form_id='" . $last_insert['insert_id'] . "' WHERE id=?";
            $this->db_instance->update($sql, $result['id']);
			
			$this->db_instance->changeDB('generate');
			$sql = "UPDATE `fields` f SET f.rank=(SELECT count(*) FROM `fields_steps` fs WHERE f.id = fs.id_field GROUP BY `id_field` LIMIT 1)";
            $this->db_instance->update($sql);
			
			 
			} else {
			
				$sql = "SELECT * FROM `forms` WHERE `id`=?";
				$generated = $this->db_instance->selectRow($sql, $result['form_id']);	
				if ($generated['generated'] == 1 || $generated['generated'] == 3) {
					$data = "edit:".$result['form_id']."";
				} else {
					$data =  "error:Форма не создавалась через генератор форм (параметр формы generated=0) !";
				}
				
			}
		
			} else {
				$data =  "error:Подуслуги c таким реестровым номером не найдено!";
			}
			
        return $data;
    }
	
    public function addStep() {
        if ($_GET['tieStep'] == "true") {
            $sql = "INSERT INTO `forms_steps` (`id_step`, `id_form`) VALUES (?, ?)";
            $this->db_instance->insert($sql, $_GET['idStep'], $_GET['idForm']);
        }
		
        if ($_GET['createStep'] == "true") {
		
            $sql = "INSERT INTO `steps` (`label`,`clone`,`clone_block_min`,`clone_block_max`,`clone_block_name`) VALUES (?,?,?,?,?)";
            $last_insert = $this->db_instance->insert($sql, $_GET['stepName'], $_GET['cloneStep'], $_GET['cloneBlockMin'], $_GET['cloneBlockMax'], $_GET['cloneBlockName']);
            
			echo $last_insert['insert_id'];
			
            $sql = "INSERT INTO `forms_steps` (`id_step`,`id_form`) VALUES ('" . $last_insert['insert_id'] . "', ?)";
            $this->db_instance->insert($sql, $_GET['idForm']);
        }
    }
	
	
    public function addStepsApplicants() {
        
		if (isset($_GET['applicants'])) {
			
			$applicants = explode(",", $_GET['applicants']);
		
			$sql = "INSERT INTO `forms_steps` (`id_step`, `id_form`) VALUES (?, ?)";
			$this->db_instance->insert($sql, 1, $_GET['idForm']);

			$sql = "INSERT INTO `fields_steps` (`id_form`, `id_step`, `id_field`) VALUES (?, ?, ?)";
			$this->db_instance->insert($sql, $_GET['idForm'], 1, 1);			
		
			if (in_array("UL", $applicants)) {

				$sql = "INSERT INTO `forms_steps` (`id_step`, `id_form`) VALUES (?, ?)";
				$this->db_instance->insert($sql, 2, $_GET['idForm']);
			
			}
			
			if (in_array("IP", $applicants)) {

				$sql = "INSERT INTO `forms_steps` (`id_step`, `id_form`) VALUES (?, ?)";
				$this->db_instance->insert($sql, 3, $_GET['idForm']);
			
			}
			
			if (in_array("FL", $applicants)) {

				$sql = "INSERT INTO `forms_steps` (`id_step`, `id_form`) VALUES (?, ?)";
				$this->db_instance->insert($sql, 4, $_GET['idForm']);
			
			}

        }
		
    }
	
	
    public function deleteStep() {
		
		$sql = "DELETE FROM `fields_steps` WHERE id_form = ? AND id_step = ?";
		$this->db_instance->delete($sql, $_GET['idForm'], $_GET['idStep']);
		
		$sql = "DELETE FROM `forms_steps` WHERE id_form = ? AND id_step = ?";
		$this->db_instance->delete($sql, $_GET['idForm'], $_GET['idStep']);
		
		$sql = "DELETE FROM `clone_blocks` WHERE id_form = ? AND id_step = ?";
		$this->db_instance->delete($sql, $_GET['idForm'], $_GET['idStep']);
        
    }
	
	
    public function queryEditField() {
        $sql = "SELECT * FROM `fields` WHERE `id`=?";
        $list = $this->db_instance->select($sql, $_GET['idField']);
        return $list;
    }
	
	
    public function checkEditField() {
        $sql = "SELECT * FROM `fields_steps` WHERE `id_field`=? && id_form !=?";
        $result = $this->db_instance->select($sql, $_GET['idField'], $_GET['idForm']);
        
		if (count($result) > 0) {
			foreach ($result as $key) {
				$data .= $key['id_form'].", ";
			}
		} else {
				$data = "false";
		}
		
		echo $data;
    }
	
	
    public function editField() {
	
		$_GET['addFormat'] = str_replace("undefined","",$_GET['addFormat']);
		
        $sql = "UPDATE `fields` SET label=?, name=?, type=?, required=?, disabled=?, clone=?, maxlength=?, format=?, class=?, comment=?, value=?, hidden=?, dictionary=?, mask=?, header=?, placeholder=? WHERE id=?";
        $this->db_instance->update($sql, trim($_GET['addLabel']), trim($_GET['addName']), trim($_GET['addType']), trim($_GET['addRequired']), trim($_GET['addDisabled']), trim($_GET['addClone']), trim($_GET['addMaxlength']), trim($_GET['addFormat']), trim($_GET['addClass']), trim($_GET['addComment']), trim($_GET['addValue']), trim($_GET['addHidden']), trim($_GET['addDictionary']), trim($_GET['addMask']), trim($_GET['addHeader']), trim($_GET['addPlaceholder']), trim($_GET['idField']));
        echo $_GET['idField'];
    }
	
	
    public function addSortingFields() {
		
		$listFieldsArr = explode(",", substr($_GET['listFields'],0,-1));
		
			$sql = "
			
			UPDATE fields_steps
				SET sort = CASE id_field ";
				
				
		foreach ($listFieldsArr as $key) {
		
			$i++;
			$sql .= "WHEN ".$key." THEN ".$i." ";
					
		}
		
			$sql .= " END WHERE id_field IN (".substr($_GET['listFields'],0,-1).") AND id_form = ".$_GET['idForm']." AND id_step = ".$_GET['idStep']."";
			
        $this->db_instance->update($sql);
		
	}
	
	
	
    public function addSortingSteps() {
		
		$listStepsArr = explode(",", substr($_GET['listSteps'],0,-1));
		
			$sql = "
			
			UPDATE forms_steps
				SET sort = CASE id_step ";
				
			foreach ($listStepsArr as $key) {
			
				$i++;
				$sql .= "WHEN ".$key." THEN ".$i." ";
						
			}
		
			$sql .= " END WHERE id_step IN (".substr($_GET['listSteps'],0,-1).") AND id_form = ".$_GET['idForm']."";
			
        $this->db_instance->update($sql);
		
	}
	
	
    public function loadSource() {
	
        $this->db_instance->changeDB('regportal_services');
        $sql = "SELECT * FROM `forms` WHERE id=?";
        $source = $this->db_instance->selectRow($sql, $_GET['idForm'] . "*");
		
		if (empty($source['content_default'])) {
			$source['content_default'] = 
			'
<script type="text/javascript">

	$(document).ready(function(){ 
							   
	});

</script>';
		}
        echo $source['content_default'];
    }
	
	
    public function saveSource() {
		
		$this->db_instance->changeDB('regportal_services');
        $sql = "UPDATE `forms` SET content_default=?, content_light=? WHERE id=?";
        $this->db_instance->update($sql, $_POST['source'], $_POST['source'], $_POST['idForm']);

    }


    public function addCondition() {
		
		$_GET['element'] = str_replace("[","",$_GET['element']);
		$_GET['element'] = str_replace("]","",$_GET['element']);
		
		$_GET['condition'] = str_replace("AND","&&",trim($_GET['condition']));
		
		$this->db_instance->changeDB('generate');
		$sql = "INSERT INTO `conditions` (`id_form`, `element`, `action`, `condition`) VALUES (?, ?, ?, ?)";
		$this->db_instance->insert($sql, $_GET['idForm'], trim($_GET['element']), trim($_GET['actionElement']), trim($_GET['condition']));

    }
	
	
    public function loadConditions() {
	
        $sql = "SELECT * FROM `conditions` WHERE id_form=?";
        $list = $this->db_instance->select($sql, $_GET['idForm']);
		
        $data = "";
		
        foreach($list as $key) {
			
		$condition = $key['condition'];
		
		$key['condition'] = str_replace("&&","<span style='color: green; font-weight: bold; padding-left: 5px; padding-right: 5px;'>И</span> ",$key['condition']);
		$key['condition'] = str_replace("||","<span style='color: green; font-weight: bold; padding-left: 5px; padding-right: 5px;'>ИЛИ</span> ",$key['condition']);

		$key['condition'] = str_replace("[","",$key['condition']);
		$key['condition'] = str_replace("]","",$key['condition']);

		
		
        $data.= "
            
         <div id=".$key['id']." class='loadCondition alert alert-info'>
			<!-- <span class='editCondition icon-pencil' style='float: right; margin-right: -11px;' title='Редактировать условие'></span> -->
            <button type='button' class='deleteCondition' title='Удалить условие'>&times;</button>
			<div>";
			
			if ($key['action'] == "show") {$key['action'] = "ПОКАЗАТЬ ЕСЛИ";}
			if ($key['action'] == "required") {$key['action'] = "ОБЯЗАТЕЛЬНОЕ ЕСЛИ";}
			if ($key['action'] == "hidden") {$key['action'] = "СКРЫТЬ ЗНАЧЕНИЯ";}
			
			
			$data.= "<span style='color: #001BD5;'><strong>".$key['element']."</strong></span> <span style='color: red; padding-left: 10px;'>".$key['action']." </span>
			<div style='font-size: 18px; padding-top: 10px;'>".$key['condition']."</div><div><textarea style='width: 910px; margin-top: 5px; display: none;'>".$condition."</textarea></div></div>
		 
		 </div>";
        }
		
        return $data;
    }
	
	
	
	
    public function searchConditions() {
	
		$_GET['element'] = str_replace("[","",$_GET['element']);
		$_GET['element'] = str_replace("]","",$_GET['element']);
		
        $sql = "SELECT * FROM `conditions` WHERE element=? GROUP BY `condition`";
        $list = $this->db_instance->select($sql, trim($_GET['element']));
		
        $data = "";
		
        foreach($list as $key) {
		
		$condition = trim(str_replace("&&","AND",$key['condition']));
		
		$key['condition'] = str_replace("&&","<span style='color: green; font-weight: bold; padding-left: 5px; padding-right: 5px;'>И</span> ",$key['condition']);
		$key['condition'] = str_replace("||","<span style='color: green; font-weight: bold; padding-left: 5px; padding-right: 5px;'>ИЛИ</span> ",$key['condition']);

		$key['condition'] = str_replace("[","",$key['condition']);
		$key['condition'] = str_replace("]","",$key['condition']);


        $data.= "
            
         <div class='searchCondition alert alert-info' style='cursor: pointer;'>
		 
			<input class='searchConditionElement' type='hidden' value='".$_GET['element']."'>
			<input class='searchConditionAction' type='hidden' value='".$key['action']."'>
			<input class='searchConditionSource' type='hidden' value=\"".$condition."\">
			
			<div>
			";
			
			if ($key['action'] == "show") {$key['action'] = "ПОКАЗАТЬ ЕСЛИ";}
			if ($key['action'] == "required") {$key['action'] = "ОБЯЗАТЕЛЬНОЕ ЕСЛИ";}
			if ($key['action'] == "hidden") {$key['action'] = "СКРЫТЬ ЗНАЧЕНИЯ";}
			
			
			$data.= "<span style='color: #001BD5;'><strong>".$key['element']."</strong></span> <span style='color: red; padding-left: 10px;'>".$key['action']." </span>
			<div style='font-size: 18px; padding-top: 10px;'>".$key['condition']."</div></div>
		 
		 </div>";
        }
		
        return $data;
    }
	
	
	
    public function deleteCondition() {
		
		$sql = "DELETE FROM `conditions` WHERE id_form = ? AND id = ?";
		$this->db_instance->delete($sql, $_GET['idForm'], $_GET['idCondition']);		
		
    }
	

    public function addCloneBlock() {
	
		$this->db_instance->changeDB('generate');
		
		if (empty($_GET['blockName'])) {
			$_GET['blockName'] = "tmp_".$_GET['idForm']."_".rand(0,9).rand(10,99).rand(100,999).rand(1000,9999);
		}
							
		$sql = "INSERT INTO `clone_blocks` (`id_form`, `id_step`, `name`, `fields`, `position`) VALUES (?, ?, ?, ?, ?)";
		$this->db_instance->insert($sql, $_GET['idForm'], $_GET['idStep'], $_GET['blockName'], str_replace("|","&#44",$_GET['fields']), $_GET['position']);

    }
	
	
	
    public function loadCloneBlocks() {
	
        $sql = "SELECT * FROM `clone_blocks` WHERE id_form=? && id_step=?";
		$list = $this->db_instance->select($sql, $_GET['idForm'], $_GET['idStep']);
        $data = "";
		
        foreach($list as $key) {
		
        $data.= "
            
         <div id=".$key['id']." class='loadCloneBlock alert alert-info'>
            <button type='button' class='buttonDeleteCloneBlock' title='Удалить клонируемый блок'>&times;</button>
			<i class='editCloneBlock icon-edit' title='Редактировать клонируемый блок' style='cursor: pointer; background-position: 0 -72px;'></i>
			<div>";
			
			$data.= "<span style='color: #001BD5;'><strong>".$key['name']."</strong></span>
			<div style='font-size: 18px; padding-top: 10px;'>".str_replace("&#44",",",$key['fields'])."</div></div>
		 
		 </div>";
        }
		
        return $data;
		
    }
	
	
    public function editCloneBlock() {
		
		$this->db_instance->changeDB('generate');
		
		if (empty($_GET['blockName'])) {
			$_GET['blockName'] = "tmp_".$_GET['idForm']."_".rand(0,9).rand(10,99).rand(100,999).rand(1000,9999);
		}
		
        $sql = "UPDATE `clone_blocks` SET name=?, fields=?, position=? WHERE id=?";
        $this->db_instance->update($sql, $_GET['blockName'], str_replace("|","&#44",$_GET['fields']), $_GET['position'], $_GET['idCloneBlock']);

    }
	
	
    public function queryEditCloneBlock() {
		$this->db_instance->changeDB('generate');
        $sql = "SELECT * FROM `clone_blocks` WHERE `id`=?";
        $list = $this->db_instance->select($sql, $_GET['idCloneBlock']);
        return $list;
    }
	
    public function deleteCloneBlock() {
		
		$sql = "DELETE FROM `clone_blocks` WHERE id = ?";
		$this->db_instance->delete($sql, $_GET['idCloneBlock']);	
		
    }

	
    public function queryConditionCloneBlock() {
		$this->db_instance->changeDB('generate');
        $sql = "SELECT * FROM `clone_blocks` WHERE `id_form`=?";
        $list = $this->db_instance->select($sql, $_GET['idForm']);
        return $list;
    }



    public function copyForm() {

		$this->db_instance->changeDB('regportal_services');
		
        $sql = "SELECT `form_id` FROM `subservice` WHERE MATCH(`registry_number`) AGAINST(? IN BOOLEAN MODE) OR `id` = ?";
        $result = $this->db_instance->selectRow($sql, $_GET['copySubservice'] . "*", $_GET['copySubservice']);
		
		$this->db_instance->changeDB('generate');
		
        $sql = "SELECT * FROM forms_steps WHERE id_form = ? ORDER BY sort ASC";
        $rowSteps = $this->db_instance->select($sql, $result['form_id']);
		
        foreach($rowSteps as $step) {
			
            $sql = "INSERT INTO `forms_steps` (`id_step`, `id_form`, `sort`) VALUES (?, ?, ?)";
            $this->db_instance->insert($sql, $step['id_step'], $_GET['idForm'], $step['sort']);
	
		}


		$sql = "SELECT * FROM `fields_steps` WHERE id_form = ? ORDER BY sort ASC";
		$rowFields = $this->db_instance->select($sql, $result['form_id']);		

        foreach($rowFields as $field) {
			
			$sql = "INSERT INTO `fields_steps` (`id_step`, `id_field`, `id_form`, `sort`) VALUES (?, ?, ?, ?)";
			$info = $this->db_instance->insert($sql, $field['id_step'], $field['id_field'], $_GET['idForm'], $field['sort']);
	
		}
		
	
		if (isset($_GET['copyConditions'])) {
			$sql = "SELECT * FROM `conditions` WHERE id_form = ?";
			$rowConditions = $this->db_instance->select($sql, $result['form_id']);

			foreach($rowConditions as $condition) {
			
				$sql = "INSERT INTO `conditions` (`id_form`, `element`, `action`, `condition`) VALUES (?, ?, ?, ?)";
				$this->db_instance->insert($sql, $_GET['idForm'], trim($condition['element']), trim($condition['action']), trim($condition['condition']));
		
			}
		}
		
	
		if (isset($_GET['copyCloneBlocks'])) {
		
			$sql = "SELECT * FROM `clone_blocks` WHERE id_form = ?";
			$cloneBlocks = $this->db_instance->select($sql, $result['form_id']);		   
				
            foreach($cloneBlocks as $block) {
			
				$sql = "INSERT INTO `clone_blocks` (`id_form`, `id_step`, `name`, `fields`, `position`) VALUES (?, ?, ?, ?, ?)";
				$this->db_instance->insert($sql, $_GET['idForm'], $block['id_step'], $block['name'], $block['fields'], $block['position']);
		
			}
		}	
		
		
		
        return true;
    }
	
}