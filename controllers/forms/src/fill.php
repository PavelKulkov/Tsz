<?php

$formPath = $modules_root."forms/test/test".$subservice_id.".xml";
if(!file_exists(ModuleHome::getDocumentRoot()."/".$formPath)){
  $text = "Форма не найдена, обратитесь в службу поддержки.";
  return;
}
$text.= '<style type="text/css">'.file_get_contents($modules_root."forms/style/style.css");
$text.= '<script src="'.$modules_root.'forms/scripts/script.js"></script>';
$xml = simplexml_load_file($formPath);
$text = mb_convert_encoding(urldecode($xml->process['name']), 'windows-1251', 'windows-1251');
$text = "<legend>".$text."</legend>";
$processId = $xml->process['id'];	//идентификатор процедуры
$extensionElements  = $xml->process->startEvent->extensionElements->children('http://activiti.org/bpmn')->formProperty;
//$text .= "<form id=\"$processId\" method='POST' action='toSIU.php' enctype='multipart/form-data'><div id='requestContent'>";  //enctype='multipart/form-data'
$text .= "<form id=\"$processId\" method='POST' enctype='multipart/form-data'><div id='requestContent'>";  //enctype='multipart/form-data'
foreach ($extensionElements as $formProperty) {
$atts_object = $formProperty->attributes();
$atts_array = (array) $atts_object;
$atts_array = $atts_array['@attributes'];
		$readable = $atts_array['readable'];
		$writable = $atts_array['writable'];
		$variable = $atts_array['variable'];
		$typeFromXml = $atts_array['type'];
		if (isset($writable)&&($writable != "true")) {
				$writable = "readonly";
		}
		else {
		$writable = "";
		}
				if ((isset($readable)&&($readable == 'false')&&($variable != "procedureCode"))||($typeFromXml == "signature"))
			continue;
			$val = "";
			if ($variable == "procedureCode")
			$val = $atts_array['default'];
		$required = ""; $required_abbr = "";
		if ($atts_array['required'] == 'true') {
				$required = "required";//=".$atts_array['required'];
				$required_abbr = '<abbr style="color: red" title="required">*</abbr>';
				}
				if ($typeFromXml == "enum") {
				$text .= "<div style='margin-left: 20px' class=\"control-group ".$required."\">";
				$text .= "<label class=\"control-label ".$required."\" for=\"".$atts_array['id']."\">".$required_abbr.$atts_array['name'].":</label>";
				$text .= '<div class="controls">';
				$text .=  "<select ".$required." id=\"".$atts_array['id']."\" name=\"".$atts_array['id']."\">";
				foreach ($formProperty as $optionValue)
				{
					$atts_option = $optionValue->attributes();
					$option_array = (array) $atts_option;
					$option_array = $option_array['@attributes'];
					$text .= "<option value='".$option_array['id']."'>".$option_array['name']."</option>";
				}
				$text .=  '</select>';
				$text .= '</div>';
				$text .= "</div>";
				continue;
				}
				$type = 'size="50" type=text';
				switch ($typeFromXml) {
					case "string":
						$type = 'size="50" type=text';
						break;
					case "string":
						$type = 'type=text';
						break;
					case "attachment":
						$type = 'type=file';
						break;
					case "boolean":
						$type = 'type=checkbox';
						break;
					default:
						$type = 'type='.$typeFromXml;
						break;
				}
				$text .= "<div style='margin-left: 20px' class=\"control-group ".$required."\">";

				$text .= "<label class=\"control-label ".$required."\" for=\"".$atts_array['id']."\">".$required_abbr.$atts_array['name'].":</label>";
				$text .= '<div class="controls">';
				$text .= "<input ".$required." ".$writable." class=\"".$required."\" id=\"".$atts_array['id']."\" value='".$val."' name=\"".$atts_array['id']."\" ".$type.">";
				$text .= '</div>';
				$text .= "</div>";
}
$text .= "<div align='center'><button type='submit' class='btn btn-success'><i class='icon-share icon-white'></i>Отправить</button></div></div></form>";
?>
