<style>

#generateForm .cloneBlock, #generateForm .cloneBlockStep {
    background-color: rgb(223, 240, 216);
    border-radius: 10px;
    margin-top: 20px;
	width: 100%;
} 

</style>

<script type="text/javascript">

function callAjax(urlReq, callback, asnc) {
 
    //asnc = asnc || false;
    $.ajax({
        dataType: "json",
        type: "GET",
        async: false,
        url: urlReq,
        success: function (data) {
            response = data;
            if (isResult([data])) {
                callback(data);
            }
        },
        complete: function () {}
    });

}


function setDictionary(dic, id, default_value, text) {
    callAjax("/scripts/ajax.php?module_name=webservice&name=getDictionary&dictionaryName=" + dic, getDictionary_callback);

    function getDictionary_callback(dataResponse) {
        dic = dataResponse.data;
        if (isResult([dic])) {
            var options = "<option value='' selected='selected'>--- выберите ---</option>";
            if (text == 'true') {
                for (var i = 0; i < dic.length; i++) {
                    options += "<option title='" + dic[i].value + "' value='" + dic[i].value + "'>" + dic[i].value + "</option>";
                }
            } else {
                for (var i = 0; i < dic.length; i++) {
                    options += "<option title='" + dic[i].value + "' value='" + dic[i].name + "'>" + dic[i].value + "</option>";
                }
            }
            if ($.isArray(id)) {
                for (var i = 0; i < id.length; i++) {
                    $("." + id[i]).html(options);
                }
            } else {
                $("." + id).html(options);
            }
            if (isDefined(default_value)) {
                if ($.isArray(id)) {
                    for (var i = 0; i < id.length; i++) {
                        $("." + id[i] + " option[value='" + default_value + "']").attr("selected", "selected");
                    }
                } else {
                    $("." + id + " option[value='" + default_value + "']").attr("selected", "selected");
                }
            }
        }
        return dic;
    }
}

function isDefined(val) {
    return !(typeof val == 'undefined');
}

function isResult(listArray) {
    for (var i = 0; i < listArray.length; i++) {
        if (($.isEmptyObject(listArray[i])) || (typeof listArray[i] == 'undefined') || (listArray[i] == null) || (listArray[i] == '{}') || (listArray[i] == '[]'))
            return false;
    }
    return true;
}


function loadDictionaries() {

    if ($("#blocksFields").size() < 1) {

        $("#generateForm select[dictionary!='']").each(function () {

            if ($(this).attr("id") == undefined) {
                $(this).attr("id", $(this).attr("name"));
                setDictionary($(this).attr("dictionary"), $(this).attr("id"));
            }

        });
		

		if ($("#generateForm #myTab a[id=2]").size() < 1) {
			$(".applicantType").find("option[value=N1]").remove();
		}

		if ($("#generateForm #myTab a[id=3]").size() < 1) {
			$(".applicantType").find("option[value=N2]").remove();
		}

		if ($("#generateForm #myTab a[id=4]").size() < 1) {
			$(".applicantType").find("option[value=N3]").remove();
		}

	
	
    }
}


$(document).ready(function () {

    $("#generateForm #myTab a:first").tab("show");

    if ($("#blocksFields").size() > 0) {
        $("#myTab").find("a").eq($("#blocksFields .fields:visible").index() - 1).click();
        $(".deleteStep").show();
    }

    $("#generateForm .stepNext:last").remove();
    $("#generateForm .stepPrev:first").remove();
    $("#generateForm button[type=submit]").not(":last").remove();
    $("#generateForm button[type=submit]").show();
    $("#generateForm .stepNext, #generateForm .stepPrev").show();


    $(".cloneBlockStep").each(function () {

        var clone_block_min = $(this).closest(".tab-pane").find(".clone_block_min").val();

        if (clone_block_min > 1) {

            var tab = $(this).closest(".tab-pane");

            for (i = 1; i < clone_block_min; i++) {
                tab.find(".cloneBlockStep:first").after(tab.find(".cloneBlockStep:first").clone());
            }

            tab.find(".addCloneBlockStep").not(":last").remove();
            tab.find(".deleteCloneBlockStep").not(":last").remove();

        }

    });


    $(function ($) {
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ],
            monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
                'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'
            ],
            dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
            dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            weekHeader: 'Не',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ru']);

        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true,
            //maxDate: "+0m +0w +0d"
        });
    });

    $("#generateForm .hidden").each(function () {
        $(this).closest("tr").hide();
    });
	
	
    $(".tab-pane").find(".cloneBlockStep:first").each(function () {
        $(this).before($(this).clone());
		$(this).closest(".tab-pane").find(".cloneBlockStep:first").removeClass("cloneBlockStep").addClass("templateCloneBlockStep").hide();
    });
			
});
				
</script>

 
<?php

class createForm {

    private $db_instance;
    private $request;
    public $count;
    private $list;
    function __construct($request = NULL, $db) {
	
        $this->db_instance = $db;
        $this->db_instance->changeDB('generate');
		
    }
	
	
    function createConditions($form_id) {
	
		$conditions = "<script type='text/javascript'>
		
		$(document).ready(function () {
			
			$('#myTab a').click(function(event){
				return false;
			});
		
		});
		
		function change(changeElement, conditionElement, action) {
		
		}
		
		
		function ShowHideField(changeElement, conditionElement, action) {

			if (action == 'show') {
			
					if ($(\"div.statictext:contains('\" + conditionElement + \"')\").size() > 0) {

						if (changeElement.closest('.cloneBlockStep').size() > 0 || changeElement.closest('.cloneBlock').size() > 0) {

							if (changeElement.closest('.cloneBlockStep').find(\"div.statictext:contains('\" + conditionElement + \"')\").size() > 0 || changeElement.closest('.cloneBlock').find(\"div.statictext:contains('\" + conditionElement + \"')\").size() > 0) {
								changeElement.closest('.cloneBlockStep').find(\"div.statictext:contains('\" + conditionElement + \"')\").show();
								changeElement.closest('.cloneBlock').find(\"div.statictext:contains('\" + conditionElement + \"')\").show();
							} else {
								$(\"div.statictext:contains('\" + conditionElement + \"')\").show();
							}

						} else {
							$(\"div.statictext:contains('\" + conditionElement + \"')\").show();
						}

					} else {


						if (changeElement.closest('.cloneBlockStep').size() > 0 || changeElement.closest('.cloneBlock').size() > 0) {

							if (changeElement.closest('.cloneBlockStep').find(\".\" + conditionElement + \"\").closest('tr').size() > 0 || changeElement.closest('.cloneBlock').find(\".\" + conditionElement + \"\").closest('tr').size() > 0) {
								changeElement.closest('.cloneBlockStep').find(\".\" + conditionElement + \"\").closest('tr').show();
								changeElement.closest('.cloneBlock').find(\".\" + conditionElement + \"\").closest('tr').show();
							} else {
								$(\".\" + conditionElement + \"\").closest('tr').show();
							}


							if (changeElement.closest('.cloneBlockStep').find(\"table[block='\" + conditionElement + \"']\").size() > 0) {
								changeElement.closest('.cloneBlockStep').find(\"table[block='\" + conditionElement + \"']\").show();
							} else {
								$(\"table[block='\" + conditionElement + \"']\").show();
							}

						} else {
							$(\"#myTab a:contains('\" + conditionElement + \"')\").show();
							$(\".\" + conditionElement + \"\").closest('tr').show();
							$(\"table[block='\" + conditionElement + \"']\").show();
						}

					}
			
			
			
			}
			
			
			if (action == 'hide') {
			
			
					if ($(\"div.statictext:contains('\" + conditionElement + \"')\").size() > 0) {

						if (changeElement.closest('.cloneBlockStep').size() > 0 || changeElement.closest('.cloneBlock').size() > 0) {

							if (changeElement.closest('.cloneBlockStep').find(\"div.statictext:contains('\" + conditionElement + \"')\").size() > 0 || changeElement.closest('.cloneBlock').find(\"div.statictext:contains('\" + conditionElement + \"')\").size() > 0) {
								changeElement.closest('.cloneBlockStep').find(\"div.statictext:contains('\" + conditionElement + \"')\").hide();
								changeElement.closest('.cloneBlock').find(\"div.statictext:contains('\" + conditionElement + \"')\").hide();
							} else {
								$(\"div.statictext:contains('\" + conditionElement + \"')\").hide();
							}

						} else {
							$(\"div.statictext:contains('\" + conditionElement + \"')\").hide();
						}

					} else {


						if (changeElement.closest('.cloneBlockStep').size() > 0 || changeElement.closest('.cloneBlock').size() > 0) {

							if (changeElement.closest('.cloneBlockStep').find(\".\" + conditionElement + \"\").closest('tr').size() > 0 || changeElement.closest('.cloneBlock').find(\".\" + conditionElement + \"\").closest('tr').size() > 0) {
								changeElement.closest('.cloneBlockStep').find(\".\" + conditionElement + \"\").closest('tr').hide();
								changeElement.closest('.cloneBlock').find(\".\" + conditionElement + \"\").closest('tr').hide();
							} else {
								$(\".\" + conditionElement + \"\").closest('tr').hide();
							}


							if (changeElement.closest('.cloneBlockStep').find(\"table[block='\" + conditionElement + \"']\").size() > 0) {
								changeElement.closest('.cloneBlockStep').find(\"table[block='\" + conditionElement + \"']\").hide();
							} else {
								$(\"table[block='\" + conditionElement + \"']\").hide();
							}

						} else {
							$(\"#myTab a:contains('\" + conditionElement + \"')\").hide();
							$(\".\" + conditionElement + \"\").closest('tr').hide();
							$(\"table[block='\" + conditionElement + \"']\").hide();
						}

					}
			
			
			}

		}
		
		
		function createConditions() {";
			
        $sql = "SELECT * FROM `conditions` WHERE id_form = ?";
        $rowConditions = $this->db_instance->select($sql, $_GET['idForm'] . $form_id);

		foreach($rowConditions as $condition) {
			
			$vars = "";
			$hidden_condition = "";

			if ($condition['action'] == 'show') {
			
			if (strpos($condition['condition'], "false")) {
			
				$conditions .= "
					
					if ($(\"div.statictext:contains('".$condition['element']."')\").size() > 0) {
					
						$(\"div.statictext:contains('".$condition['element']."')\").show();
					
					} else {
					
					
					$(\"#myTab a:contains('".$condition['element']."')\").show();
					$('.".$condition['element']."').closest('tr').show();
					$(\"table[block='".$condition['element']."']\").show();
					
					}
					
				";			
			
			} else {
			
				$conditions .= "
					
					if ($(\"div.statictext:contains('".$condition['element']."')\").size() > 0) {
					
						$(\"div.statictext:contains('".$condition['element']."')\").hide();
					
					} else {
					
					
					$(\"#myTab a:contains('".$condition['element']."')\").hide();
					$('.".$condition['element']."').closest('tr').hide();
					$(\"table[block='".$condition['element']."']\").hide();
					
					}
					
				";			
			
			}
			

		
			}
			
			if ($condition['action'] == 'required') {
				$conditions .= "
				if ($(\"div.statictext:contains('".$condition['element']."')\").attr('required', false).nextAll('.marker_required').hide()) {} else 
				if ($('.".$condition['element']."').attr('required', false).nextAll('.marker_required').hide()) {}";
			}

			if ($condition['action'] == 'hidden' && strpos($condition['condition'], 'if') == false) {
				
				$values = explode(",", $condition['condition']); 
				
					$conditions .= "
					
					$('select[name=\"".$condition['element']."\"]').each(function () {";

					for ($i=0; $i < count($values); $i++) {
					 
						$conditions .= "
						
							$(this).find('option[value=\"".trim($values[$i])."\"]').hide(); ";
							
					}
					
					$conditions .= "
					
					}); \r\n\r\n\r\n\r\n\r\n\r\n";
						
				
			}

			
			$pattern = "/\[([^\[\]]*)\]/";
			
			$num_match = preg_match_all ($pattern, $condition['condition'], $result);
						
			for ($i=0; $i<$num_match; $i++) {
				
				$result[0][$i] = str_replace("]","",$result[0][$i]);
				$result[0][$i] = str_replace("[","",$result[0][$i]);
				
				$vars .= "
				
					if ($('.".$result[0][$i]."').is('input[type=checkbox]')) {
						
							if ($('.".$result[0][$i]."').closest('.cloneBlockStep').size() > 0) {
								var ".$result[0][$i]." = $(this).closest('.cloneBlockStep').find('.".$result[0][$i]."').is(':checked');
							} else 

							if ($('.".$result[0][$i]."').closest('.cloneBlock').size() > 0) {
								var ".$result[0][$i]." = $(this).closest('.cloneBlock').find('.".$result[0][$i]."').is(':checked');
							} else {
								var ".$result[0][$i]." = $('.".$result[0][$i]."').is(':checked');
							}
						
					}
					else {
					
							if ($('.".$result[0][$i]."').closest('.cloneBlockStep').size() > 0) {
								var ".$result[0][$i]." = $(this).closest('.cloneBlockStep').find('.".$result[0][$i]."').val();
							} else 

							if ($('.".$result[0][$i]."').closest('.cloneBlock').size() > 0) {
								var ".$result[0][$i]." = $(this).closest('.cloneBlock').find('.".$result[0][$i]."').val();
							} else {
								var ".$result[0][$i]." = $('.".$result[0][$i]."').find(\"option[value!='']:selected\").val();
							}

					}
					\r\n";
			
			}
			
			
			for ($i=0;$i<$num_match;$i++) {
				
				$result[0][$i] = str_replace("]","",$result[0][$i]);
				$result[0][$i] = str_replace("[","",$result[0][$i]);
				
				$condition['condition'] = str_replace("]","",$condition['condition']);
				$condition['condition'] = str_replace("[","",$condition['condition']);
				
				
				$hidden_condition = explode(" if ", $condition['condition']);
				
				
				$conditions .= " 
				
					$(document).on('change', '.".$result[0][$i]."', function () {
						
					".$vars."
					
					if (".(count($hidden_condition[1]) > 0 ? trim($hidden_condition[1]) : trim($condition['condition'])).") {";
						
						switch ($condition['action']) {
						
							case "hidden":
							
								if (count($hidden_condition) > 0) {
									
									
									$hidden_values = explode(",", trim($hidden_condition[0])); 
									
										$conditions .= "
										
										if ($(this).closest('.cloneBlockStep').size() > 0) {
										
										$(this).closest('.cloneBlockStep').find('select[name=\"".$condition['element']."\"]').each(function () {";

										for ($i=0; $i < count($hidden_values); $i++) {
										 
											$conditions .= "
											
												$(this).find('option[value=\"".trim($hidden_values[$i])."\"]').hide(); ";
												
										}
										
										$conditions .= "
										
										}); ";  
										
										
										$conditions .= "
										
										} else 

										if ($(this).closest('.cloneBlock').size() > 0) {
										
										$(this).closest('.cloneBlock').find('select[name=\"".$condition['element']."\"]').each(function () {";

										for ($i=0; $i < count($hidden_values); $i++) {
										 
											$conditions .= "
											
												$(this).find('option[value=\"".trim($hidden_values[$i])."\"]').hide(); ";
												
										}
										
										$conditions .= "
										
										}); ";  
										
										
										$conditions .= "
										
										} else {
										
										
										$('select[name=\"".$condition['element']."\"]').each(function () {";

										for ($i=0; $i < count($hidden_values); $i++) {
										 
											$conditions .= "
											
												$(this).find('option[value=\"".trim($hidden_values[$i])."\"]').hide(); ";
												
										}
										
										$conditions .= "
										
										});  

										}";
							
							
										

										
										
										$conditions .= "} else {
										
										if ($(this).closest('.cloneBlockStep').size() > 0) {
										
										$(this).closest('.cloneBlockStep').find('select[name=\"".$condition['element']."\"]').each(function () {";

										for ($i=0; $i < count($hidden_values); $i++) {
										 
											$conditions .= "
											
												$(this).find('option[value=\"".trim($hidden_values[$i])."\"]').show(); ";
												
										}
										
										$conditions .= "
										
										}); ";  
										
										
										$conditions .= "
										
										} else 

										if ($(this).closest('.cloneBlock').size() > 0) {
										
										$(this).closest('.cloneBlock').find('select[name=\"".$condition['element']."\"]').each(function () {";

										for ($i=0; $i < count($hidden_values); $i++) {
										 
											$conditions .= "
											
												$(this).find('option[value=\"".trim($hidden_values[$i])."\"]').show(); ";
												
										}
										
										$conditions .= "
										
										}); ";  
										
										
										$conditions .= "
										
										} else {

										$('select[name=\"".$condition['element']."\"]').each(function () {";

										for ($i=0; $i < count($hidden_values); $i++) {
										 
											$conditions .= "
												$(this).find('option[value=\"".trim($hidden_values[$i])."\"]').show(); ";
												
										}
										
										$conditions .= "
										
										});  

										}";
										
										$conditions .= "  \r\n\r\n\r\n\r\n\r\n\r\n";
								}

							break;
							
										
							case "show":
								$conditions .= "
									ShowHideField($(this),'".$condition['element']."', 'show');
								} else {
									ShowHideField($(this),'".$condition['element']."', 'hide');
								";
							
							break;
							
							case "required":
								$conditions .= '$(".'.$condition['element'].'").attr("required", true).closest("tr").find(".marker_required").show();} else {$(".'.$condition['element'].'").attr("required", false).closest("tr").find(".marker_required").hide();';
							break;

						}
		
						
					$conditions .= "
					
					}	
						
					});			
				";
				
			}
							
		}
		
		$conditions .=" \r\n\r\n\r\n } \r\n\r\n\r\n</script>\r\n\r\n\r\n";
		
		return $conditions;
	}
	
	
    function createField($name, $type, $required, $disabled, $maxlength, $clone, $class, $format, $dictionary, $value, $hidden, $mask, $placeholder) {
	
        $field = "";
        $fieldName = "";
		$fieldformat = "";
		
		
        if ($required == "1") {
            $requiredField = "required='required'";
        }

        if ($value !== "") {
            $valueField = "value='" . $value . "'";
        }
		
        if ($mask !== "") {
            $maskField = "mask='" . $mask . "'";
        }
		
        if ($hidden == "1") {
            $hiddenField = " hidden";
        }
		
        if ($disabled == "1") {
            $disabledField = "disabled='disabled'";
        }
		
        if ($placeholder != "") {
			$placeholderField = "placeholder='" . $placeholder . "'";
        }
		
        if ($maxlength !== "" && $maxlength !== "0") {
            $maxlengthField = "maxlength='" . $maxlength . "'";
        }

        if ($dictionary !== "" && $dictionary !== "0") {
            $dictionary = "dictionary='" . $dictionary . "'";
        }

        if ($format !== "" && $format !== "0") {
            $fieldformat .= " ".$format;
        }
		
        $class = "class='" . $class.$fieldformat.$hiddenField . "'";

		
        if ($clone == 1) {
		
            $fieldName.= $name;
            $clone = "
					<button class='btn btn-danger deleteCloneField' type='button' style='display:none;'>Удалить</button>
					<button class='btn btn-success addCloneField' type='button'>Добавить</button>";
        } else {
            $clone = "";
            $fieldName = $name;
        }
		
        switch ($type) {
		
            case "textfield":
                $field.= "<div><input style='width: 300px;' name='" . $fieldName . "' type='text' " . $requiredField . " " . $disabledField . " " . $valueField . " " . $maskField . " " . $maxlengthField . " " . $class . " " . $placeholderField . ">" . $clone . "</div>";
            break;
            case "radio":
                $field.= "<div><input name='" . $fieldName . "' type='radio' " . $requiredField . " " . $disabledField . " " . $class . ">" . $clone . "</div>";
            break;
            case "textarea":
                $field.= "<div><textarea style='width: 300px; height: 100px;' name='" . $fieldName . "' " . $requiredField . " " . $disabledField . " " . $maskField . " " . $maxlengthField . " " . $class . " " . $placeholderField . ">".$value."</textarea>" . $clone . "</div>";
            break;
            case "checkbox":
                $field.= "<div><input name='" . $fieldName . "' " . $disabledField . " " . $requiredField . " " . $class . " type='checkbox'></div>";
            break;
            case "fileload":
                $field.= "<div><input type='file' name='" . $fieldName . "' " . $requiredField . " " . $disabledField . " " . $class . ">" . $clone . "</div>";
            break;
            case "customLookup":
                $field.= "<div><select style='width: 315px;' name='" . $fieldName . "' " . $requiredField . " " . $disabledField . " " . $class . " " . $dictionary . "></select>" . $clone . "</div>";
            break;
        }
        return $field;
    }
	
	
    function create($form_id, $name) {
		
        $listSteps = "";
        $bodySteps = "";
        $countSteps = 1;
        $countBodySteps = 1;
		
        $sql = "SELECT * FROM forms_steps LEFT JOIN steps ON steps.id = id_step WHERE id_form = ? ORDER BY sort ASC";
        $rowSteps = $this->db_instance->select($sql, $_GET['idForm'] . $form_id);
		
        foreach($rowSteps as $step) {
		
            $buttons = "";
            $buttonsCloneBlockStep = "";
            $cloneStep = "";
			
            $listSteps.= "<li><a href='#tab-" . $step['id'] . "' id='" . $step['id'] . "' data-toggle='tab'>" . $step['label'] . "</a>
			<span class='deleteStep' style='color: red; float: right; position: relative; bottom: 60px; font-size: 20px; cursor: pointer; display: none;'>×</span>
			</li>\n";
			
            $sql = "SELECT * FROM `fields_steps` LEFT JOIN fields ON fields.id = id_field WHERE id_step = ? AND id_form = ? ORDER BY sort ASC";
            $rowFields = $this->db_instance->select($sql, $step['id'], $_GET['idForm'] . $form_id);
			
            if ($step['clone_block_min'] > 0) {
                $cloneStep = "cloneBlockStep";
                $buttonsCloneBlockStep = "
        
                    <tr>
                       <td valign='top' align='left' width='300'></td>
                       <td valign='top' align='left' width='530'>
						     <div style='bottom: 5px; position: relative; left: 350px; width: 200px;'>
                             <button class='btn btn-danger deleteCloneBlockStep' style='display: none;' type='button'>Удалить</button>
                             <button class='btn btn-success addCloneBlockStep' type='button'>Добавить</button>
							 </div>
					   </td>
                    </tr>";
            }
			
            $bodySteps.= "
    
           <div class='tab-pane' id='tab-" . $step['id'] . "'>
              <table cellpadding='10' cellspacing='0' class='" . $cloneStep . "' border='0' style='margin-top: 20px; border-collapse: none;' align='center'>
                 <tbody>";
				 
            foreach($rowFields as $field) {
			
                $required = "";
				$header = "";
				
                if ($field['required'] == 1) {
                    $required.= "<span class='marker_required' style='color: red;'>*</span> ";
                } else {
					$required.= "<span class='marker_required' style='color: red; display: none;'>*</span> ";
				}


                if ($field['header'] == 1) {
                    $header = " background-color: rgb(58, 135, 173); color: rgb(255, 255, 255) !important;";
                }

				switch ($field['type']) {
					case "statictext":
						$field['label'] = "<div name='".$field['label']."' class='statictext' style='padding: 5px; color: #000000; position: relative; width: 300px; text-align: center; left: 330px; font-weight: bold; ".$header." border-radius: 10px; margin-top: 10px;'>".$field['label']."</div>";
					break;
				}
		
		
                $bodySteps.= "
                    <tr>
                       <td valign='top' align='right' width='300'>
                          " . $required . "" . $field['label'] . "
                       </td>
                       <td valign='top' align='left' width='530'>" . $this->createField($field['name'], $field['type'], $field['required'], $field['disabled'], $field['maxlength'], $field['clone'], $field['class'], $field['format'], $field['dictionary'], $field['value'], $field['hidden'], $field['mask'], $field['placeholder']) . "</td>
                    </tr>";

					if ($field['type'] == "statictext" && $field['format'] == "document" && $field['value'] != "") {
					
						$bodySteps.= "
							<tr style='display: none;'>
							   <td></td>
							   <td><input type='hidden' class='document_value' name='".$field['name']."' value='".$field['value']."' />
							</tr>";
					
					}
					
            }
			
			
            $bodySteps.= "
                " . $buttonsCloneBlockStep . "
                 </tbody>
              </table>
              
            <div style='padding-top: 50px;'>
                <button style='float: left; display: none;' class='btn btn-success stepPrev' type='button'><<< Назад</button>
                <button style='float: right; display: none;' class='btn btn-success stepNext' type='button'>Далее >>></button>
                <button style='float: right; display: none;' id='submit' class='btn btn-success' type='submit'>Отправить</button>
            </div>";
			
			
            if ($step['clone_block_min'] > 0) {
                $bodySteps.= "
            <input type='hidden' class='clone_block_min' value='" . $step['clone_block_min'] . "'>
            <input type='hidden' class='clone_block_max' value='" . $step['clone_block_max'] . "'>
            <input type='hidden' class='clone_block_name' name='".$step['clone_block_name']."'>";
            }
			
            $bodySteps.= "
           </div>";
		   
		   
			$sql = "SELECT * FROM `clone_blocks` WHERE id_form = ? && id_step = ?";
			$cloneBlocks = $this->db_instance->select($sql, $form_id, $step['id']);		   
			
				if (count($cloneBlocks) > 0) {
				
				$bodySteps .= '
				
				<script type="text/javascript">
				
				';
				
            foreach($cloneBlocks as $block) {
				
				
				$fields = explode(",", $block['fields']);
				$fields = str_replace("&#44",",",$fields);
				
											
							if ($block['position'] !== "before" && $block['position'] !== "after") {
							
								$bodySteps .= "						
									$('.tab-content #tab-".$block['id_step']."').find('[name=\"".$block['position'] ."\"]').closest('tr').after(\"<tr><td></td><td><table cellpadding='10' block='".$block['name'] ."' cellspacing='0' class='cloneBlock' border='0' style='margin-top: 10px; position: relative; right: 150px;' align='center'></table></td></tr>\");";
							} 
							
							
							if ($block['position'] == "before" || $block['position'] == "after") {
							
								if ($block['position'] == "after") {
								
								$bodySteps .= "						
									$('.tab-content #tab-".$block['id_step']."').find('table:first').not('.cloneBlock').".$block['position']."(\"<table cellpadding='10' block='".$block['name'] ."' cellspacing='0' class='cloneBlock' border='0' align='center'></table>\");";									

								} else {
							
								$bodySteps .= "						
									$('.tab-content #tab-".$block['id_step']."').find('table:first').".$block['position']."(\"<table cellpadding='10' block='".$block['name'] ."' cellspacing='0' class='cloneBlock' border='0' align='center'></table>\");";

								}

							}
							
								
								
					for ($i=0; $i < count($fields); $i++) {
							
						$bodySteps .= "
						
					
							var field = $('.tab-content #tab-".$block['id_step']."').find('[name=\"".trim($fields[$i])."\"]').not('.document_value').closest('tr').detach();
							
							if (field.length > 0) {
								$('.tab-content #tab-".$block['id_step']."').find('.cloneBlock[block=\"".$block['name']."\"]').append('<tr>'+ field.html().replace(/\\n/g, '') +'</tr>');
							} else {
							
							
							
							var field = $('.tab-content #tab-".$block['id_step']."').find('[name=\"".trim($fields[$i])."\"]').closest('tr').prev('tr').find('div.statictext').closest('tr').detach();
							
							if (field.length > 0) {
								$('.tab-content #tab-".$block['id_step']."').find('.cloneBlock[block=\"".$block['name']."\"]').append('<tr>'+ field.html().replace(/\\n/g, '') +'</tr>'); 
							}
							
							}
							
							


						
					";
					
					}
					
			
						$bodySteps .= "
							$('.tab-content #tab-".$block['id_step']."').find('.cloneBlock[block=\"".$block['name']."\"] tbody').append(\"\
							<tr>\
							   <td valign='top' align='left' width='300'></td>\
							   <td valign='top' align='left' width='530'>\
									 <div style='float: right;'>\
									 <button class='btn btn-danger deleteCloneBlock' style='display: none;' type='button'>Удалить</button>\
									 <button class='btn btn-success addCloneBlock' type='button'>Добавить</button>\
									 </div>\
							   </td>\
							</tr>\"); ";
							
							

				
            }
			
			
			
				$bodySteps.= '
				

				
				</script>
				
				
				';
				
				}
				
				
        }
        $form = "
    
    <div style='padding-top: 20px;'>
    <form method='post' enctype='multipart/form-data' id='generateForm' novalidate='novalidate'>
        <legend>
            <div style='margin-left: 10px;'>
            " . $name . "
            </div>
        </legend>
        
        <ul class='nav nav-tabs' id='myTab'>
            " . $listSteps . "
        </ul>

        <div class='tab-content'>
            " . $bodySteps . "        
        </div>
        <input type='hidden' id='metadata' name='metadata' value='true'>
    </form>
    </div>
	
	
	<script type='text/javascript'>

	$(document).ready(function () {
	
		loadDictionaries();
		".($_SERVER['PHP_SELF'] == '/index.php' ? 'createConditions();' : '')."
	
		$('.cloneBlock').each(function () {
					
			$(this).after($(this).clone());
			$(this).attr('template_block', $(this).attr('block')).removeAttr('block').hide();
				
		});
		
		
		$('#generateForm input[mask]').each(function () {
			$(this).mask($(this).attr('mask'));
		});
		
	
	});
	
	</script>

    
";
        return $form;
    }
}

$createForm = new createForm($request, $db);
 
if ($_SERVER['PHP_SELF'] == '/index.php') {
	$conditions_source = $createForm->createConditions($form['id']);
}
		
$form_create = $createForm->create($form['id'], $form['name']);

echo $conditions_source.$form_create;