/*
 * 
 * 		сommon_functions.js for Penza Universal ESRN 
 * 
 *    By KAVlex, alex_dark, NikolaySEO, Виталий Балаев
 *		
 * 				Пенза, РКС, 2013 (©) 
 * 
 */	
	$.ajax({
		url: '/templates/assets/arcticmodal/jquery.arcticmodal-0.3.min.js',
		dataType: "script",
		async: false
	    });
	$.ajax({
		url: '/scripts/js/wsclient.js',
		dataType: "script",
		async: false
	    });

	var test = true;
	//194.85.124.1:38080
	var VISurl = '/scripts/proxy.php/http://194.85.124.1:38080/VISServiceServletOEP/VisService';
	var ARTKMVurl = '/scripts/proxy.php/http://194.85.124.1:38080/ARandTKMVServletOEP/ARandTKMVService';
	var kladrURL = '/scripts/proxy.php/http://194.85.124.1:8080/ServletKladr/Activity';
	var Transporturl = '/scripts/proxy.php/https://gosuslugi.e-mordovia.ru/services/visPersonalData/TransportService';
	var dicUrl = '/scripts/proxy.php/http://194.85.124.1:38080/VISServiceServletOEP/DictionaryService?dictionaryName=';
	var serviceCode = "1300000010000036760";	//
	var personalDataUrl = '/scripts/proxy.php/https://gosuslugi.e-mordovia.ru/services/visPersonalData/js/personal_data';
	var response = {};
	var Steps = [1];
	var stepIndex = 0;

	var DocumentSeries = 'DocumentSeries'; //'DocumentSeries';		Код атрибута
	var DocumentsNumber = 'DocumentsNumber'; //'DocumentsNumber';
	var GiveDocumentOrg = 'GiveDocumentOrg'; //'GiveDocumentOrg';
	$(document).ready(function(){	

	//------------------------------
	// При загрузке страницы скрываются поля, которые должны быть скрыты по умолчанию
     $('select[name="step_1_category_legal_representative"]').closest("tr").hide();
	 $('select[name="step_1_category_person_self"]').closest("tr").hide();
	 if (!test) {
		 $('#step_1_acting_person_self').attr('disabled', 'disabled');
		 $('#step_1_acting_person_law').attr('disabled', 'disabled');
	 }
	 $('#step_2_is_identification_1_hint').hide();
	 $('#step_4_is_identification_3_hint').hide();
	 $('#step_7_info_2_block').hide();
	 $('fieldset[id="step_8_info_3"]').hide();
	 $('fieldset[id="step_8_info_4"]').hide();
	 $('fieldset[id="step_8_info_5"]').hide();
	 $('fieldset[id="step_8_info_6"]').hide();
	 $('span#step_10_info_3_clone').hide();
	 $('fieldset[id="step_10_info_4"]').hide();
	 $('fieldset[id="step_12_info_2[]"]').hide();
	 $('fieldset[id="step_12_info_3[]"]').hide();
	 $('.step_12_info_4_clone').hide();  
	 $('input[name="step_12_doc_declarant_set_identity_doc_mf[]"]').closest("tr").hide();
	 $('input[name="step_12_doc_declarant_bring_himself_mf[]"]').closest("tr").hide();
	 $('input[name="step_12_in_SMEV_trustee_doc[]"]').closest("tr").hide();
	 $('span#step_12_add_family_member_mf_chk').hide();
	 $('fieldset[id="step_12_info_5_6"]').hide();
	 $('.step_13_relation_degree_sdd_z').closest('td').hide();
	 $('.step_13_relation_degree_label').parent('td').hide();
	 $('fieldset.step_13_info_5').hide();
	 $('fieldset[id="step_13_info_6_7_9"]').hide();
	 $('.step_14_relation_degree_sdd_nz').closest('td').hide();
	 $('.step_14_relation_degree_label').parent('td').hide();
	 $('fieldset.step_14_info_5').hide();
	 $('table.step_14_address_person_table').hide();
	 $('fieldset[id="step_14_info_6_7_8"]').hide();
	 // Конец блока сокрытия полей по умолчанию 
	 //------------------------------
	// Если сервис АР и ТКМВ вернул оба значения «флагов», либо не вернул ни одного значения «флага», то при выборе
	// "Вы действуете как законный представитель" - появляется поле "Категория законного представителя" с атрибутом required
    $('#step_1_acting_person_law').click(function() {
		$('select[name="step_1_category_legal_representative"]').closest("tr").show();
		$('select[name="step_1_category_legal_representative"]').attr('required', 'required');
		setDictionary("CategoryLegalRepresentative", "step_1_category_legal_representative");
		$('select[name="step_1_category_person_self"]').closest("tr").hide();
		$('#step_1_category_person_self').hide();
		$('select[name="step_1_category_person_self"]').removeAttr('required');
	});
	// "Вы действуете за себя" прячется поле "Категория законного представителя" , убирается атрибут required
	// появляется поле "Тип заявителя" с атрибутом required
	$('#step_1_acting_person_self').click(function() {
		showStep_1_category_person_self();
		//$('select[name="step_1_category_person_self"]').closest("tr").show();
		$('#step_1_category_person_self').show();
		$('select[name="step_1_category_person_self"]').attr('required', 'required');
		$('select[name="step_1_category_legal_representative"]').closest("tr").hide();
		$('select[name="step_1_category_legal_representative"]').removeAttr('required');
	});
	// Первый шаг. Если флаг = Вы действуете за себя, то скрывается поле Категория законного представителя	
	if(document.getElementById('step_1_acting_person_law').checked) {
		$('select[name="step_1_category_legal_representative"]').closest("tr").show();
		$('select[name="step_1_category_legal_representative"]').attr('required', 'required');
		
		setDictionary("CategoryLegalRepresentative", "step_1_category_legal_representative");
		
		$('select[name="step_1_category_person_self"]').closest("tr").hide();
		$('select[name="step_1_category_person_self"]').removeAttr('required');
	}else if(document.getElementById('step_1_acting_person_self').checked) {
		showStep_1_category_person_self();	//	18_07_13
		//$('select[name="step_1_category_person_self"]').closest("tr").show();
		$('select[name="step_1_category_person_self"]').attr('required', 'required');
		$('select[name="step_1_category_legal_representative"]').closest("tr").hide();
		$('select[name="step_1_category_legal_representative"]').removeAttr('required');
	}
	// При изменении Типа заявителя или законного представителя в выпаающем списке (selected), значение
	// записывается в скрытое поле id="type_of_person", которое определит на какой шаг со 2 по 6 попадет пользователь
	// с первого шага
	$('#step_1_category_person_self').change(function(){	
		$('div#type_of_person').html($('select#step_1_category_person_self option:selected').val());
	});
	$('#step_1_category_legal_representative').change(function(){	
		$('div#type_of_person').html($('select#step_1_category_legal_representative option:selected').val());
	});
	//---------------------------------------
	// Снятие атрибута disabled с полей в формах 2,3,4,5,6 если пользователь решил подтвердить
	// правильность и достоверность сведений, указанных в форме
	$('input[name="step_2_is_identification_1"]').click(function(){
		if ($(this).is(":checked")) {
	    		$("#step_2_is_identification_1").nextAll().removeAttr('disabled');
		}
	});
	$('input[name="step_3_is_identification_2"]').click(function(){
		if ($(this).is(":checked")) {
		    	$("#step_3_is_identification_2").nextAll().removeAttr('disabled');
		}
	});
	$('input[name="step_4_is_identification_3"]').click(function(){
		if ($(this).is(":checked")) {
		    	$("#step_4_is_identification_3").nextAll().removeAttr('disabled');
		}
	});
	$('input[name="step_5_is_identification_4"]').click(function(){
		if ($(this).is(":checked")) {
		    	$("#step_5_is_identification_4").nextAll().removeAttr('disabled');
		}
	});
	$('input[name="step_6_is_identification_org"]').click(function(){
		if ($(this).is(":checked")) {
			$('#step_6_is_identification_hint').attr("hidden", "hidden");
		    	$("#step_6_is_identification_org").nextAll().removeAttr('disabled');
		}
	});
	// 
	// ---------------------------------------
	//------------------------------------------
	// Зависимость появления групп полей от значения чекбоксов
	$('input[name="step_9_is_postal_bank_fill"]').click(function(){
		if ($(this).is(":checked")) {
			$('fieldset[id="step_9_info_4"]').show();
		} else {
			$('fieldset[id="step_9_info_4"]').hide();
		}
	});
	
	$('input[name="step_10_is_postal_bank_fill"]').click(function(){
		if ($(this).is(":checked")) {
			$('span.step_10_info_3_clone').hide();
			
			$('fieldset[id="step_10_info_4"]').show();
		} else {
			$('fieldset[id="step_10_info_4"]').hide();
			$('span.step_10_info_3_clone').show();
		}
	});

	$('input[name="step_11_is_render_address_true_1[]"]').click(function(){
		if ($(this).is(":checked")) {
			$('fieldset[id="step_11_info_4"]').hide();
		} else {
			$('fieldset[id="step_11_info_4"]').show();
			
		}
	});
	$('input[name="step_12_add_family_member_mf"]').click(function(){
		if ($(this).is(":checked")) {
			$('fieldset[id="step_12_info_5_6"]').show();
		} else {
			$('fieldset[id="step_12_info_5_6"]').hide();
		}
	});
	$('input[name="step_13_add_family_member_sdd_z"]').click(function(){
		if ($(this).is(":checked")) {
			$('fieldset[id="step_13_info_6_7_9"]').show();
//			$('fieldset[class="step_13_info_2"]').hide();
		} else {
			$('fieldset[id="step_13_info_6_7_9"]').hide();
			$('fieldset[class="step_13_info_2"]').show().filter(':first').hide();
			$('span.step_13_info_2_clone').show().filter(':first').hide();
		}
	});
	
	$('input[name="step_14_add_family_member_sdd_nz"]').click(function(){
		if ($(this).is(":checked")) {
			$('fieldset[id="step_14_info_6_7_8"]').show();
//			$('fieldset[class="step_14_info_2"]').hide();
		} else {
			$('fieldset[id="step_14_info_6_7_8"]').hide();
			$('fieldset[class="step_14_info_2"]').show().filter(':first').hide();
			$('span.step_14_info_2_clone').show().filter(':first').hide();
		}
	});
	/*$('input[name="step_15_add_info_money"]').click(function(){
		if ($(this).is(":checked")) {
			$('fieldset[id="step_15_info_4[]"]').show();
		} else {
			$('fieldset[id="step_15_info_4[]"]').hide();
		}
	});*/
	// end of block
	// ШАГ 1. При смене подуслуги, подгружаются категории ей принадлежащие
	$('#step_1_subservices').change(function(){
		$('#step_1_acting_person_law').closest('tr').show();
		$('#step_1_acting_person_self').closest('tr').show();
		$('#step_1_category').attr('disabled', 'disabled');
		$('#step_1_category').html('<option>Идет загрузка... </option>');;
		$('#step_1_social_institution').attr('disabled', 'disabled');
		$('#step_1_social_institution').html('<option></option>');
		
		$('#step_1_acting_person_self').removeAttr('checked');
		$('#step_1_acting_person_law').removeAttr('checked');
		$('#step_1_acting_person_self').attr('disabled', 'disabled');
		$('#step_1_acting_person_law').attr('disabled', 'disabled');
		$('select[name="step_1_category_person_self"]').closest("tr").hide();
		$('select[name="step_1_category_legal_representative"]').closest("tr").hide();
		$('#step_1_category_person_self').hide();
		
		if ($('select#step_1_subservices option:selected').val() != '') {
			dataRequest = {"categories":{"subservice":$('select#step_1_subservices option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_1_categories_callback,true);
		}
	});

	function step_1_categories_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse])){
			if (isResult([dataResponse.categories])){
				categories = dataResponse.categories.category;
				var options = '';
				$.each(categories, function(k, item){
				   options += '<option style="width: 100%" value="' + item.key + '" title="'+item.name+'">' + item.name + '</option>';
				 });
				$('#step_1_category').removeAttr('disabled');
				if (dataResponse.categories.category.length > 1) {
					$('#step_1_category').html('<option style="width: 100%" value="">- Выберите -</option>'+options);
				} else {
					clearSelect(document.getElementById('step_1_category'));
					addOption(document.getElementById('step_1_category'), dataResponse.categories.category[0].name, dataResponse.categories.category[0].key, true, true);
					dataRequest = {"institution":{"subservice":$('select#step_1_subservices option:selected').val(),"category":$('select#step_1_category option:selected').val()}};
					callWebS(ARTKMVurl, dataRequest, step_1_institutions_callback,true);
				}
			}else{
				errorMsg("Не удалось получить из АРиТКМВ категории по выбранной Вами услуге");	
			}
		}	
	}
	
	$('select').bind('mousedown', function(){
		if (!$(this).hasClass('chzn-select'))
			$(this).addClass('chzn-select');
	});
	$('select#step_1_category_legal_representative').bind('mousedown', function(){
		if (!$('select#step_1_social_institution').hasClass('chzn-select'))
			$('select#step_1_social_institution').addClass('chzn-select');
	});
	//При смене категории, подгружается список  Орган/Учреждение в зависимости от выбранной связки «услуга-подуслуга-категория»
	$('#step_1_category').change(function(){
		$('#step_1_acting_person_law').closest('tr').show();
		$('#step_1_acting_person_self').closest('tr').show();
		$('#step_1_social_institution').attr('disabled', 'disabled');
		$('#step_1_social_institution').html('<option>Идет загрузка... </option>');
		$('#step_1_acting_person_self').removeAttr('checked');
		$('#step_1_acting_person_law').removeAttr('checked');
		$('#step_1_acting_person_self').attr('disabled', 'disabled');
		$('#step_1_acting_person_law').attr('disabled', 'disabled');
		$('select[name="step_1_category_person_self"]').closest("tr").hide();
		$('select[name="step_1_category_legal_representative"]').closest("tr").hide();
		$('#step_1_category_person_self').hide();
		if ($('select#step_1_category option:selected').val() != '') {
			dataRequest = {"institution":{"subservice":$('select#step_1_subservices option:selected').val(),"category":$('select#step_1_category option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_1_institutions_callback,true);
		}
	});
		
	function step_1_institutions_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse])){
			if (isResult([dataResponse.institutions.organization])){
				institutions = dataResponse.institutions.organization;
				var options = '';
				$.each(institutions, function(k, item){
				   options += '<option value="' + item.key + '" title="'+item.name+'">' + item.name + '</option>';
				 });
				$('#step_1_social_institution').removeAttr('disabled');
				if (dataResponse.institutions.organization.length > 1) {
					$('#step_1_social_institution').html('<option value="">- Выберите -</option>'+options);
				} else {
					clearSelect(document.getElementById('step_1_social_institution'));
					addOption(document.getElementById('step_1_social_institution'), dataResponse.institutions.organization[0].name, dataResponse.institutions.organization[0].key, true, true);
					dataRequest = {"infPossApplyingService":{"subservice":$('select#step_1_subservices option:selected').val(),"category":$('select#step_1_category option:selected').val()}};
					callWebS(ARTKMVurl, dataRequest, step_1_social_institutions_callback,true);
				}
				//17_07_13 by KAVlex
				/*
				if (location.href.indexOf('1709') != -1) {
					$('#step_1_social_institution option[value="34"]').attr('selected', 'selected');
					dataRequest = {"infPossApplyingService":{"subservice":$('select#step_1_subservices option:selected').val(),"category":$('select#step_1_category option:selected').val()}};
					callWebS(ARTKMVurl, dataRequest, step_1_social_institutions_callback,true);
				}
				if (location.href.indexOf('1672') != -1) {
					$('#step_1_social_institution option[value="7d286151:11918236de7:-7fea:119186e2603"]').attr('selected', 'selected');
					dataRequest = {"infPossApplyingService":{"subservice":$('select#step_1_subservices option:selected').val(),"category":$('select#step_1_category option:selected').val()}};
					callWebS(ARTKMVurl, dataRequest, step_1_social_institutions_callback,true);
				}*/
				var orgID = getParameter('_WorkflowStart_WAR_spuworkflowstart_organization');	
				if (isNotUndefined(orgID)){
					var optn = $('#step_1_social_institution option[value='+orgID+']');
					if (optn.length != 1)
						optn = $('#step_1_social_institution option[value='+organization[orgID]+']');
					if (optn.length == 1){
						optn.attr('selected', 'selected');
						optn.change();
					}
				}
			}
			else {
				alert("Организации, оказывающие услугу не найдены");
			}
		}
		else {
			alert("Ошибка обращения к сервису. Не удалось получить организации");
		}
	}
	
	//При смене категории, вызывается сервис АР и ТКМВ, который возвращает сведения («флаг») о возможности подачи заявления для выбранной связки «услуга-подуслуга-категория» правообладателем и законным представителем. 
	$('#step_1_social_institution').change(function(){
		$('#step_1_acting_person_law').closest('tr').show();
		$('#step_1_acting_person_self').closest('tr').show();
		
		if ($('select#step_1_social_institution option:selected').val() !='') {
			dataRequest = {"infPossApplyingService":{"subservice":$('select#step_1_subservices option:selected').val(),"category":$('select#step_1_category option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_1_social_institutions_callback,true);
		}
	});
	
	function showStep_1_category_person_self() {  //by KAVlex 18_07_13
		 var recipient = getParameter('_WorkflowStart_WAR_spuworkflowstart_recipient');
	     if ((recipient == 322)||(recipient == 321)){
	    	 $('#step_1_category_person_self option[value=phys]').attr("selected", "selected");
	    	 $('#step_1_category_person_self').change();
	    	 $('#step_1_category_person_self').closest('tr').hide();
	     }else
	    	 if (recipient == 341){
	    		 $('#step_1_category_person_self option[value=juri]').attr("selected", "selected");
		    	 $('#step_1_category_person_self').change();
		    	 $('#step_1_category_person_self').closest('tr').hide();	 
	    	 }else
	    		 if (recipient == 384){
	    			 $('#step_1_category_person_self option[value=ip]').attr("selected", "selected");
			    	 $('#step_1_category_person_self').change();
			    	 $('#step_1_category_person_self').closest('tr').hide();	 
	    		 }else
		    	 {
		    		 $('#step_1_category_person_self').closest('tr').show();
		 		     $('#step_1_category_person_self').show();
		    	 }
	}
	
	function step_1_social_institutions_callback(xmlHttpRequest, status, dataResponse){
		$('#step_1_acting_person_self').removeAttr('checked');
		$('#step_1_acting_person_law').removeAttr('checked');
		$('#step_1_acting_person_self').removeAttr('disabled');
		$('#step_1_acting_person_law').removeAttr('disabled');
		$('select[name="step_1_category_person_self"]').closest("tr").hide();
		$('select[name="step_1_category_legal_representative"]').closest("tr").hide();
		$('#step_1_category_person_self').hide();
		if (isResult([dataResponse])){
			if (isResult([dataResponse.infPossApplyingService])){
				if ( (dataResponse.infPossApplyingService.owner === true && dataResponse.infPossApplyingService.legalRepresentative === false) ) {
				     $('#step_1_acting_person_self').attr('checked','checked').attr('disabled','disabled');
				     $('#step_1_acting_person_law').attr('disabled','disabled');
				     showStep_1_category_person_self();
				     $('#step_1_category_legal_representative').closest('tr').hide();
				     $('#step_1_acting_person_law').closest('tr').hide();
			    } 
			    if ( (dataResponse.infPossApplyingService.owner === false && dataResponse.infPossApplyingService.legalRepresentative === true) ){
			    	setDictionary("CategoryLegalRepresentative", "step_1_category_legal_representative");
				    $('#step_1_acting_person_law').attr('checked','checked').attr('disabled','disabled');
				    $('#step_1_acting_person_self').attr('disabled','disabled');
				    $('#step_1_category_person_self').closest('tr').hide();
				    $('#step_1_category_person_self').hide();
				    $('#step_1_category_legal_representative').closest('tr').show();
				    $('#step_1_acting_person_self').closest('tr').hide();
			    } 
			    if ((dataResponse.infPossApplyingService.owner === true && dataResponse.infPossApplyingService.legalRepresentative === true)) {
			    	setDictionary("CategoryLegalRepresentative", "step_1_category_legal_representative");
			    	$('#step_1_acting_person_self').removeAttr('checked');
					$('#step_1_acting_person_law').removeAttr('checked');
					$('#step_1_acting_person_self').removeAttr('disabled');
					$('#step_1_acting_person_law').removeAttr('disabled');
			    }			
			}
		}
	}
	
	$(".flag_identification").change(function () {
	    if ($(this).attr("id").split('_').pop() === "yes") {
	        id = $(this).attr("id").split('_yes')[0];
	        $("#" + id + "").attr("checked", true).change();
	        $("#" + id + "_no").attr("checked", false);

	        if (!$(this).is(":checked")) {
	            $("#" + id + "_no").attr("checked", true);
	            $("#" + id + "").attr("checked", false).change();
	        }
	    }
	    if ($(this).attr("id").split('_').pop() === "no") {
	        id = $(this).attr("id").split('_no')[0];
	        $("#" + id + "").attr("checked", false).change();
	        $("#" + id + "_yes").attr("checked", false);
	        if (!$(this).is(":checked")) {
	            $("#" + id + "_yes").attr("checked", true);
	            $("#" + id + "").attr("checked", true).change();
	        }
	    }
	});
	
});

	function stepIdentity(el) {
		//if (isResult([$('#toolbar')]))
		//	$('#toolbar').hide();
		var type_of_person = $('#type_of_person').text();
		var tab = ($(el).closest('div.tab')).attr('id'); //Определяем текущий таб и его id. id необходим для некоторых операций, принадлежащих конкретному ТАБу.
		var tab_show;
		
		if ($(el).hasClass("next_button")) {
				if (eval('checkErrorStep_'+tab.split('_').pop())() === false){
		//			showTab(tab, false);
					return false;
				}			
		}
		//  В случае, когда на некоторых вкладках требуется подтверждение сведений, а пользователь не подтверждает
		// Появляется сообщение о том, чтобы пользователь зашел в личный кабинет и сменил данные. Поля при этом становятся недоступны для редактирования
		if (tab == 'tab_2' && ( ! $("#step_2_is_identification_1").is(":checked")) ) {
			$("#step_2_is_identification_1").nextAll().attr('disabled', 'disabled').filter('input[type="button"]').removeAttr('disabled');
			errorPersonalData();
			return false;
		} else if (tab == 'tab_3' && ( ! $("#step_3_is_identification_2").is(":checked"))) {
				$("#step_3_is_identification_2").nextAll().attr('disabled', 'disabled').filter('input[type="button"]').removeAttr('disabled');
				errorPersonalData();
				return false;
		} else if (tab == 'tab_4' && ( ! $("#step_4_is_identification_3").is(":checked")) ) {
				$("#step_4_is_identification_3").nextAll().attr('disabled', 'disabled').filter('input[type="button"]').removeAttr('disabled');
				errorPersonalData();
				return false;
		} else if (tab == 'tab_5' && ( ! $("#step_5_is_identification_4").is(":checked"))) {
				$("#step_5_is_identification_4").nextAll().attr('disabled', 'disabled').filter('input[type="button"]').removeAttr('disabled');
				errorPersonalData();
				return false;
		} else if (tab == 'tab_6' && ( ! $("#step_6_is_identification_org").is(":checked"))) {
				$('#step_6_is_identification_hint').removeAttr("hidden", "hidden");
				$("#step_6_is_identification_org").nextAll().attr('disabled', 'disabled').filter('input[type="button"]').removeAttr('disabled');
				errorPersonalData();
				return false;
		}
		$('div.tabs > div').hide(); // прячем все табы
		var personFL = ['Parent', 'GuardianFL', 'Caregiver', 'AdoptiveParent', 'CaregiverFL'];
		var personUL = ['GuardianUL', 'CaregiverUL'];
		if (tab == 'tab_1') {
            Steps = [1];
			if (type_of_person == 'juri') {
				Steps[stepIndex+1] = 6;
				tab_show = 'tab_6';
			} else if (type_of_person == 'ip') {		
				Steps[stepIndex+1] = 5;
				tab_show = 'tab_5';
			} else if (type_of_person == 'phys') {
				Steps[stepIndex+1] = 4;
				tab_show = 'tab_4';
			} else if (isInArray(type_of_person, personUL)) {
				Steps[stepIndex+1] = 3;
				Steps[stepIndex+2] = 4;
				tab_show = 'tab_3';
			} else if (isInArray(type_of_person, personFL)) {
    			Steps[stepIndex+1] = 2;
    			Steps[stepIndex+2] = 4;
				tab_show = 'tab_2';
			}  
		} else if ((tab == 'tab_2')||(tab == 'tab_3')) {
    		Steps[stepIndex + 1] = 4;
		    tab_show = 'tab_4';
		}
	
		tab_show = tab;
		if ($(el).hasClass("next_button")) {
		    if (stepIndex != Steps.length)
				tab_show = 'tab_'+Steps[++stepIndex]; 
		} else	if ($(el).hasClass("preview_button")) {
		    if (stepIndex != 0)
				tab_show = 'tab_'+Steps[--stepIndex];				
		}
//		if (tab == 'tab_1' && isFilledRequired(tab) === false) {
//			showTab(tab, false);
//			alert('Заполните все обязательные поля!');
//		} else {
			if (tab == "tab_1") {
				step_1_callWS_setOfSteps();
			}
			showTab(tab_show, $(el).hasClass("next_button"));
//		}
	}

	function isFilledRequired(tab) {
		var fillFields = true;
		$.each( $('div#' + tab).find('[required=required]') , function(i){
//			if ( ($(this).is(':visible')) &&  ($(this).val() == '') ) {  }
			if ($(this).val() == '') {
				fillFields = false;
			}
		});
		return fillFields;//fillFields; // При переходе на реал  вернуть на return fillFields;
	}
	
	function errorPersonalData() {
		text = 'Для изменения персональных данных перейдите в личный кабинет!';
		if (typeof SCREEN != 'undefined'){
			SCREEN.errorMessage(text);
		}
		else{
			alert(text);
		}
	}
	
	function showTab(tab_show, next) {
		if (next){
			var tabNum = tab_show.split('_').pop();
			if (isNotUndefined(stepInfo[tabNum-1].alias))
				$('#tab_'+tabNum+' .step_label').text(stepInfo[tabNum-1].alias);
	    	eval('openStep_'+tabNum)();
		}
		$('div#'+tab_show).show(); // показываем содержимое текущего
		$('div.tabs ul.tabNavigation a').removeClass('selected'); // у всех убираем класс 'selected'
		$('div.tabs ul.tabNavigation a.'+tab_show).addClass('selected'); // текушей вкладке добавляем класс 'selected'	
		$('.status_tab').attr('value', 'false').filter('input[name="status_'+tab_show+'"]').attr('value', 'true'); // устанавливаем status у активного таба на TRUE для индефикации для построения маршрута
	}

	var organization = {};
	$(function () {

		$("#printDocument").hide();		

		organization = {	//17_07_13 by KAVlex
				1672 : '7d286151:11918236de7:-7fea:119186e2603',	
				1709 : 34,
				1654 : 35,
				1694 : 36,
				1714 : 37,
				1655 : 38,
				1675 : 39,
				1715 : 40,
				1656 : 41, 
				1676 : 42,
				1690 : 43,
				1696 : 44,
				1716 : 45,
				1659 : 46,
				1718 : 47,
				1678 : 48,
				1671 : 49,
				1692 : 50,
				1658 : 51,
				1717 : 52,
				1697 : 53,
				1677 : 54,
				1673 : 55,
				1829 : 3
			};
		
		if (typeof SCREEN != 'undefined'){
    			SCREEN.wait();
    		}
		$('.title').text(getSelectedObject('step_1_service').text);

//		switchStateDateTimePicker(false);
		//***************** Переопределяем цвет элементов fieldset  и table tr с заданного на свой
				
		$('form#universal .label').css({'background-color':'#efebde'});
		$('form#universal input, textarea').css({'width':'auto'});

		$('form#universal table tr').css('background-color', '#efebde');
		$('form#universal fieldset').css('background-color', '#efebde');
		//$('body').css('font-size','14px');
		$('form#universal .indent_clear').css({'margin':'0','padding':'0'});
		$('form#universal input[type=text]').css('width','93%');
		$('form#universal select').css('width','100%');
		$('form#universal textarea').css('width','99%');
		$('form#universal .template textarea').css('max-width','100%');
		$('form#universal input.input_w2').css('width','25%');
		//$('input.step_17_rekvizit_info').css('width','40%');
		//$('input.step_17_name_rekvizit_info').css('width','40%');
		$('form#universal select.select_w1').css('width','65%');
		$('form#universal select.select_w2').css('width','25%');
		$('form#universal textarea').css('height','40px');
		$('form#universal div.tabs').css('padding', '1em');
		//$('div.container').css({'margin': 'auto', 'width': '90%', 'margin-bottom': '10px'});
		$('form#universal div.tabs div h2').css('margin-top','0');
		$('form#universal table').css('width','100%');
		$('form#universal table.statistics-table').css({'width': '97%'});
		$('form#universal table.task-table').css({'width': '100%'});
		$('form#universal table.task-table.org').css({'width': '100%'});
		
		$('form#universal table.mid').css({'width':'94%','margin':'auto'});
		$('form#universal table.mid.right').css({'margin-left':'auto','margin-right':'5px'});
		$('form#universal table.mid.right table').css({'width':'98%','margin-right':'auto'});
		$('form#universal table.mid.right table tr td:first-child').css('width', '9%');
		$('form#universal table.mid2').css({'width':'74%','margin':'auto'});
		$('form#universal table.small').css({'width':'50%','margin':'auto'});
		
		$('form#universal table tr td:first-child').css('width', '17%');
		$('form#universal table tr td:first-child.small').css('width', '10%');
		
		$('form#universal table tr td.td_ext').css('width', '31%');
		$('form#universal table tr td.td_ext2').css('width', '23%');
		$('form#universal fieldset').css({'border':'1px solid #d8d7c7', 'margin-bottom':'15px', 'margin-left':'30px', 'margin-right':'30px', '-webkit-padding-before': '0.35em','-webkit-padding-start': '0.75em',	'-webkit-padding-end': '0.75em','-webkit-padding-after':'0.625em', 'width':'93%'});
		$('form#universal fieldset.mid').css({ 'width':'80%','margin':'auto'});

		$('form#universal span.title').css({'text-align':'center','display':'block', 'color':'#ff0000','font-weight':'bold', 			 'padding-top':'15px', 'color':'#0000FF'});
		$('form#universal legend').css('font-weight','normal');
	    $('form#universal legend.group_label').css({'color':'#0000ff', 'font-style':'italic', 'text-align':'left',  'font-size':'12px'});
	    $('form#universal legend.step_16_name_info').css({'color': 'rgb(137, 137, 137)', 'font-style':'italic', 'text-align':'left',  'font-size':'12px'});
	    $('form#universal legend.step_17_name_info').css({'color': 'rgb(137, 137, 137)', 'font-style':'italic', 'text-align':'left',  'font-size':'12px'});
	    
	    $('form#universal legend.group_label.group_hint').css('color','#898989');
	    $('form#universal span.label').css({'color':'#000000','font-weight':'bold', 'font-size':'12px'});
	    $('form#universal span.step_16_name_info_label').css({'color':'#000000','font-weight':'bold', 'font-size':'12px'});
	    $('form#universal span.step_16_choice_info_label').css({'color':'#000000','font-weight':'bold', 'font-size':'12px'});
	    $('form#universal span.label.label_hint').css('color','#898989');
	    $('form#universal span.step_17_name_rekvizit_info').css({'color':'#898989', 'font-weight':'bold', 'font-size':'12px'});
	    $('form#universal #step_4_identification_check').css('margin-left', '30px');
	    $('form#universal #step_7_add_family_block').css('margin-left', '30px');
	    
	    $('form#universal span.step_label').css({'text-align':'center','display':'block','color':'#0000ff','font-weight':'bold'});
	    $('form#universal span.hint').css({'color':'#898989','font-style':'italic','font-size':'11px', 'margin-left':'25px', 'padding-bottom':'20px'});
	    $('form#universal span.hint.no_indent').css({'margin':'0','padding':'0'});
	    $('form#universal #tabbs').css({'position':'relative', 'padding':'20px', 'margin':'0 auto', 'background-color':'#fff', 'width':'98%', 'min-width':'1006px'});
//	    $('div').css({'font-family':'verdana', 'font-size':'14px'});
	    $('form#universal div.tabs div.select_input').css({'width':'100%', 'height':'30px', 'overflow':'hidden', 'padding':'0px', 'margin':'0px'});
	    
	    $('form#universal div.tabs div.select_input select').css({'width':'120%'});
	    
	    $('form#universal .content').css({'border-left':'1px solid #ddd','border-right':'1px solid #ddd', 'width':'100%', 'margin-left':'0px'});
	    $('form#universal .content div').css({'padding':'7px 20px 20px 13px', 'color':'black'});
	    $('form#universal .clone_text').css('width','355px');
	    $('form#universal .field-requiredMarker').css({'color':'#f00', 'font-style':'italic', 'margin-left': '20px'});
	    $('form#universal .tab').css('width', '95%');
	    /*
		************  конец блока переопределения стилей ************************/
	    $('select[name="step_1_category_legal_representative"]').closest("tr").hide();
		$('select[name="step_1_category_person_self"]').closest("tr").hide();
		$('#step_1_acting_person_law').closest('tr').show();
		$('#step_1_acting_person_self').closest('tr').show();
		$('#step_1_category').css('background-color', '#ffffff !important');

		$('#step_1_acting_person_self').removeAttr('checked');
		$('#step_1_acting_person_law').removeAttr('checked');
		$('#step_1_subservices').closest('tr').hide();
		$('#step_1_category_person_self').hide();
		setDictionary("CategoryLegalRepresentative", "step_1_category_legal_representative");
		
		var service = getSelectedObject('step_1_service');
    	
	    var tabContainers = $('div.tabs > div');
	    tabContainers.hide().filter('#tab_1').show();	//1
	    
	    dataRequest = {"subservices":{"services": service.code}};	//изменить на	 
	    response = callWS(ARTKMVurl, dataRequest);

		if (isResult([window.response])&&isResult([window.response.subservices])&&isResult([window.response.subservices.subservice])){
			$('#step_1_subservices').removeAttr('disabled');
			$('#step_1_subservices').closest('tr').show();
			var subservices = window.response.subservices.subservice;
			var spuworkflowstart_procedure = getParameter("_WorkflowStart_WAR_spuworkflowstart_procedure");
			setDictionary("reestrProcedureCodes", "reestrProcedureCodes");
			var procCode = [];
			$("#reestrProcedureCodes option[value='"+spuworkflowstart_procedure+"']").each(function(i) {
				procCode[i] = $(this).text();
			});
			var options = '';
			if (isResult([procCode])){
				$.each(subservices, function(k, item){
					if (isInArray(item.key, procCode)){
						options += '<option style="width: 100%" value="' + item.key + '" title="'+item.name+'">' + item.name + '</option>';		
					}
				});
			}else{
				$.each(subservices, function(k, item){
					options += '<option style="width: 100%" value="' + item.key + '" title="'+item.name+'">' + item.name + '</option>';
				});
			}    		
			$('#step_1_subservices').html('<option value="">- Выберите -</option>'+options);
			if ($('#step_1_subservices option').length <= 2){
				$("#step_1_subservices :last").attr("selected", "selected");
				$('#step_1_subservices').change();
			}
	    } else {
			var listBox = document.getElementById('step_1_subservices');
			clearSelect(listBox);
			addOption(listBox, service.name, service.code, true, true);
			$('#step_1_social_institution').attr('disabled', 'disabled');
			$('#step_1_social_institution').html('<option></option>');
			dataRequest = {"categories":{"subservice":$('select#step_1_subservices option:selected').val()}};
			response = callWS(ARTKMVurl, dataRequest);
	    		
			if (isResult([window.response])){
				if (isResult([window.response.categories])){
					if (isResult([window.response.categories.category])){
						var categories = window.response.categories.category;
						var options = '';
						$.each(categories, function(k, item){
							options += '<option style="width: 100%" value="' + item.key + '" title="'+item.name+'">' + item.name + '</option>';
						});
						if (categories.length > 1){		//10_07_13 by kavlex
							$('#step_1_category').html('<option value="">- Выберите -</option>'+options);							
						}else if (categories.length == 1){
							clearSelect(document.getElementById('step_1_category'));
							addOption(document.getElementById('step_1_category'), categories[0].name, categories[0].key, true, true);
							$('#step_1_category').change();
						}
						$('#step_1_category').removeAttr('disabled');
					} else {
						errorMsg("Не удалось получить информацию по выбранной Вами услуге");
					}
				} else {
					errorMsg("Не удалось получить информацию по выбранной Вами услуге");
				}
			} else {
				errorMsg("Не удалось получить информацию по выбранной Вами услуге");
			}
	    }
		    
		$('div#toolbar').remove();
		//$('div.toolbar').remove();	by KAVlex 18_07_13
		$('div.tabs ul.tabNavigation a').click(function () {
			tabContainers.hide();
		        
		    tabContainers.filter(this.hash).show();
			
	        $('div.tabs ul.tabNavigation a').removeClass('selected');
	        $(this).addClass('selected');
	        
	        return false;
		}).filter('.tab_1').click();//1
	    
	    $('#step_1_subservices').click(); $('#step_1_category').click();
	    //$('.tabs').show();
	    
	    /*
		$('textarea[disabled=disabled]').css('background-color', 'red');
		$('textarea[disabled=disabled]').each(function() {
			$(this).css('cssText', document.getElementById(this.id).style.cssText.replace('red', '#ebebe4 !important'));
			});
		$('input[disabled=disabled]').css('background-color', 'red');
		$('input[disabled=disabled]').each(function() {
			if (this.id != "")
				$(this).css('cssText', document.getElementById(this.id).style.cssText.replace('red', '#ebebe4 !important'));
		});
		$('select[disabled=disabled]').css('background-color', 'red');
		$('select[disabled=disabled]').each(function() {
			if (this.id != "")
				$(this).css('cssText', document.getElementById(this.id).style.cssText.replace('red', '#ebebe4 !important'));
		});*/
		
		
		if (typeof SCREEN != 'undefined'){
    	   	SCREEN.hide();
    	}
		if (($.browser.version < 10)&&($.browser.msie)){
			errorMsg('Для вашего браузера не гарантируется корректная работа формы подачи заявления!\nНастоятельно рекомендуем заменить браузер!');
		}
		
		//проверка ввода для полей почтового индекса
		$('.postCode').keydown(function(event) {
	        // Разрешаем: backspace, delete, tab и escape
	        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
	             // Разрешаем: Ctrl+A
	            (event.keyCode == 65 && event.ctrlKey === true) || 
	             // Разрешаем: home, end, влево, вправо
	            (event.keyCode >= 35 && event.keyCode <= 39)) {
	                 // Ничего не делаем
	                 return;
	        }
	        else {
	            // Обеждаемся, что это цифра, и останавливаем событие keypress
	            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
	                event.preventDefault(); 
	            }else{	//длина не больше 6 символов
	                if (this.value.length >= 6){
	                	event.preventDefault(); 
	                }
	            }   
	        }
	    });
		
		/*$('.postCode').blur(function(){
			if ((this.value.length != 6)||(!isDigit(this.value))){
				alert('Почтовый индекс должен содержать 6 цифр!');
				this.value = '';
			}  
		});*/
//	   	switchStateDateTimePicker(true);
	   	
	});
	
	function isDigit(val) {
		var re = /^\d+(\.\d+)?$/;
		return re.test(val);
	}

	function step_1_callWS_setOfSteps() {
		dataRequest = {"setOfSteps":{"subservice": $('#step_1_subservices').val(),"category": $('#step_1_category').val()}};
		callWebS(ARTKMVurl, dataRequest, step_1_setOfSteps_callback,true);
	}	
	
	function step_1_setOfSteps_callback(xmlHttpRequest, status, dataResponse){
		setOfSteps = null;
		if (isResult([dataResponse])){
			setOfSteps = dataResponse.SetOfSteps;   
			if (!isResult([setOfSteps])){
	    		errorCallSteps();
			} else {
	    		len = Steps.length;
	    		//Для реалки
	    		if (!test) {
	    			for (var i=0; i<setOfSteps.step.length; i++){
			            Steps[len + i] = setOfSteps.step[i].code.replace(/0(\d)$/, '$1');
			            if (isNotUndefined(setOfSteps.step[i].alias)){
			            	stepInfo[Steps[len + i]-1].name = setOfSteps.step[i].alias;
			            	stepInfo[Steps[len + i]-1].alias = setOfSteps.step[i].alias;
			            }
			            else
			            	stepInfo[Steps[len + i]-1].name = setOfSteps.step[i].name; 
	    			}
	    		} else {
	    			for (i=0; i<setOfSteps.step.length; i++){
			            Steps[len + i] = setOfSteps.step[i].code.replace(/0(\d)$/, '$1');
	    			}
	//    			Для тестирования [7,8,9,10,11,12,13,14,15,16,17,18,19]
	//    			for (i=0; i<13; i++){
	//		            Steps[len + i] = i+13;
	//    			}
	    		}    		
			}
		}
		else {
			errorCallSteps();	
		}
		return setOfSteps;
    }

	function openStep_2() {
			switchStateDateTimePicker(false);
			$('.step_2_category_label').text(getSelectedObject('step_1_category_legal_representative').name);

			if (test) {
//				$('#step_2_last_name_legal_representative').val('Аблаев').removeAttr('disabled');
//				$('#step_2_first_name_legal_representative').val('Николай').removeAttr('disabled');
//				$('#step_2_middle_name_legal_representative').val('Кузьмич').removeAttr('disabled');
		//
//				$('#step_2_birthday_legal_representative').val('8.05.1951').removeAttr('disabled');
//				$('#step_2_doc_legal_representative_type').text('Удостоверения личности').removeAttr('disabled');
//				addOption(document.getElementById('step_2_doc_legal_representative_type'), 'Паспорт гражданина России', 'rusPassport', true, true);
//				$('#step_2_doc_legal_representative_series').val('8902').removeAttr('disabled');
//				$('#step_2_doc_legal_representative_number').val('238785').removeAttr('disabled');
//				$('#step_2_doc_legal_representative_date').val('27.02.2002').removeAttr('disabled');
//				$('#step_2_doc_legal_representative_org').val('').removeAttr('disabled');
//				
//				$('#step_2_address_legal_representative_postal').val('').removeAttr('disabled');
//				$('#step_2_address_legal_representative_house').val('').removeAttr('disabled');
//				$('#step_2_address_legal_representative_region').val('Республика Мордовия').removeAttr('disabled');
//				$('#step_2_address_legal_representative_f_district').val('Старошайговский р-н').removeAttr('disabled');
//				$('#step_2_address_legal_representative_city').val('с Старое Шайгово').removeAttr('disabled');
//				$('#step_2_address_legal_representative_flat').val('2').removeAttr('disabled');
//				$('#step_2_address_legal_representative_settlement').val('28').removeAttr('disabled');
//				$('#step_2_address_legal_representative_street').val('ул Пионерская').removeAttr('disabled');
//				$('#step_2_address_legal_representative_body').removeAttr('disabled');
//				$('#step_2_address_legal_representative_build').removeAttr('disabled');
//				$('#step_2_address_legal_representative_room').removeAttr('disabled');
				

				$('#step_2_last_name_legal_representative').val('Акимов').removeAttr('disabled');
				$('#step_2_first_name_legal_representative').val('Николай').removeAttr('disabled');
				$('#step_2_middle_name_legal_representative').val('Васильевич').removeAttr('disabled');

				$('#step_2_birthday_legal_representative').val('10.08.1938').removeAttr('disabled');
				$('#step_2_doc_legal_representative_type').text('Паспорт гражданина России').removeAttr('disabled');
				addOption(document.getElementById('step_2_doc_legal_representative_type'), 'Паспорт гражданина России', 'rusPassport', true, true);
				$('#step_2_doc_legal_representative_series').val('5600').removeAttr('disabled');
				$('#step_2_doc_legal_representative_number').val('237795').removeAttr('disabled');
				$('#step_2_doc_legal_representative_date').val('03.04.2000').removeAttr('disabled');
				$('#step_2_doc_legal_representative_org').val('').removeAttr('disabled');
				
				$('#step_2_address_legal_representative_postal').val('430013').removeAttr('disabled');
				$('#step_2_address_legal_representative_house').val('30').removeAttr('disabled');
				$('#step_2_address_legal_representative_region').val('Пензенская обл.').removeAttr('disabled');
				$('#step_2_address_legal_representative_f_district').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_city').val('г. Пенза').removeAttr('disabled');
				$('#step_2_address_legal_representative_flat').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_settlement').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_street').val('ул. Коваленко').removeAttr('disabled');
				$('#step_2_address_legal_representative_body').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_build').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_room').val('169').removeAttr('disabled');
			} else {
				$('#step_2_last_name_legal_representative').val('').removeAttr('disabled');
				$('#step_2_first_name_legal_representative').val('').removeAttr('disabled');
				$('#step_2_middle_name_legal_representative').val('').removeAttr('disabled');

				$('#step_2_birthday_legal_representative').val('').removeAttr('disabled');
				setDictionary("document_name", "step_2_doc_legal_representative_type");
				$('#step_2_doc_legal_representative_type').removeAttr('disabled');
				
				$('#step_2_doc_legal_representative_series').val('').removeAttr('disabled');
				$('#step_2_doc_legal_representative_number').val('').removeAttr('disabled');
				$('#step_2_doc_legal_representative_date').val('').removeAttr('disabled');

				$('#step_2_doc_legal_representative_org').val('').removeAttr('disabled');
				
				$('#step_2_address_legal_representative_postal').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_house').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_region').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_f_district').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_city').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_flat').val('').removeAttr('disabled');
				$('#step_2_address_legal_representative_settlement').val('').removeAttr('disabled');;
				$('#step_2_address_legal_representative_street').val('').removeAttr('disabled');;
				$('#step_2_address_legal_representative_body').val('').removeAttr('disabled');;
				$('#step_2_address_legal_representative_build').val('').removeAttr('disabled');;
				$('#step_2_address_legal_representative_room').val('').removeAttr('disabled');;
			}
			
		$('#step_2_info_6').hide();
		$('.step_2_info_6_clone').hide();
		setDictionary("NameDocLegalRepresentative", "step_2_name_doc");
		isIdentification('#step_2_is_identification_1');
		$('#step_2_name_doc').change(function () {
			if (this.value != ""){
				step_2_callWS_DocumentType();
				step_2_callWS_InfDocumentFL();
			}
			else
				$('.step_2_info_6_clone').hide();
		});
		$('#step_2_is_identification_1_hint').hide();	
		setCheckBoxVisible('#step_2_yourself_trustee_doc', false);
		setCheckBoxVisible('#step_2_in_SMEV_trustee_doc', false);	
		switchStateDateTimePicker(true);
	}
	
	//признак документа
	function step_2_callWS_DocumentType() {
		dataRequest = {"documentType":{"doc":$('#step_2_name_doc').val()}};
		//response =  callWS(ARTKMVurl, dataRequest);
		callWebS(ARTKMVurl, dataRequest, step_2_DocumentType_callback,true);
	}
	
	function step_2_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		documentType = null;
		if (isResult([dataResponse]) && isResult([dataResponse.DocumentType])) {
    		documentType = dataResponse.DocumentType;
			setCheckBoxVisible('#step_2_yourself_trustee_doc', documentType.privateStorage, documentType.privateStorage);
    		$('#step_2_yourself_trustee_doc').val(documentType.privateStorage);
			setCheckBoxVisible('#step_2_in_SMEV_trustee_doc', documentType.interagency, documentType.interagency);
		}
		return documentType;
	}

	//InfDocument - реквизиты документа
	function step_2_callWS_InfDocumentFL(){ 	//idGroup - ?
		var idOrg = {"name":$('#step_1_social_institution option:selected').text(),"code":$('#step_1_social_institution').val()};
		var idDoc = {"name":$('#step_2_name_doc option:selected').text(),"code":$('#step_2_name_doc').val()};
		var idGroup = {"name":"Наименование","code":"Код организации"};
		var params = {"param":[{"name":"Серия","code": DocumentSeries,"type":"Integer","value":$('#step_2_doc_legal_representative_series').val()},
					{"name":"Номер","code": DocumentsNumber,"type":"Integer","value":$('#step_2_doc_legal_representative_number').val()},
					{"name":"Кем выдан","code": GiveDocumentOrg,"type":"String","value":$('#step_2_doc_legal_representative_org').val()}]};
		var group = {"name":"Наименование группы","code":"Код группы"};
		var document = {"group":group,"name":$('#step_2_doc_legal_representative_type option:selected').text(),"code":$('#step_2_doc_legal_representative_type').val(),"dateIssue":$('#step_2_doc_legal_representative_date').val(),"params":params};
		var fio = {"surname":$('#step_2_last_name_legal_representative').val(),"patronymic":$('#step_2_middle_name_legal_representative').val(),"name": $('#step_2_first_name_legal_representative').val()};
		var identityFL = {"fio": fio,"dateOfBirth":$('#step_2_birthday_legal_representative').val(),"document": document};

		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup":idGroup,"identityFL":identityFL}};
		//response =  callWS(VISurl, dataRequest);
		callWebS(VISurl, dataRequest, step_2_InfDocumentFL_callback,true);
	}
	
	function step_2_InfDocumentFL_callback(xmlHttpRequest, status, dataResponse){
		infDocumentFL = null;
		if (isResult([dataResponse])&&isResult([dataResponse.infDocument])&&isResult([dataResponse.infDocument.document])) {
        		infDocumentFL = dataResponse.infDocument;
				step_2_info_6_infDocument_length = infDocumentFL.document.length;
				array = [
					'step_2_series_doc',
					'step_2_number_doc',
					'step_2_date_doc',
					'step_2_org_doc',
					'step_2_choice_trustee_rek',
					'step_2_info_6',
					'step_2_info_6_clone',
					'step_2_name_doc'
				];
				processDocumentDetails(infDocumentFL.document, array, 'step_2_yourself_trustee_doc');
		} else {
			$('.step_2_info_6_clone').hide();
		}
		return infDocumentFL;
	}
	
	function openStep_3() {
						$('#step_3_full_name_org').val('').removeAttr('disabled');
						$('#step_3_reduced_name_org').val('').removeAttr('disabled');
						$('#step_3_legal_address_org').val('').removeAttr('disabled');
						$('#step_3_identity_org_reg').val('').removeAttr('disabled');
						$('#step_3_juridical_inn').val('').removeAttr('disabled');
						$('#step_3_juridical_ogrn').val('').removeAttr('disabled');
						$('#step_3_juridical_kpp').val('').removeAttr('disabled');
							
						$('#step_3_lastname_org').val($('[name=lastName]').val()).removeAttr('disabled');
						$('#step_3_name_org').val($('[name=firstName]').val()).removeAttr('disabled');
						$('#step_3_middlename_org').val($('[name=middleName]').val()).removeAttr('disabled');
						$('#step_3_birth_date_org').removeAttr('disabled');
						$('#step_3_pozition_manager').removeAttr('disabled');

			            var doc = getCodeDocByName($('[name=idCardType]').val());
            			if (isResult([doc]))						
			    			addOption(document.getElementById('step_3_step_3_document_type_org'), doc.name, doc.code, true, true);
						$('#step_3_document_series_org').val($('[name=idCardSr]').val()).removeAttr('disabled');
						$('#step_3_document_number_org').val($('[name=idCardNum]').val()).removeAttr('disabled');
						$('#step_3_document_issue_date_org').val($('[name=idCardDate]').val()).removeAttr('disabled');
						$('#step_3_document_org').val($('[name=idCardBy]').val()).removeAttr('disabled');
		$('#step_3_info_6').hide();
		$('.step_3_info_6_clone').hide();
		isIdentification('#step_3_is_identification_2');
		setDictionary("NameDocLegalRepresentative", "step_3_name_doc");
		$('#step_3_name_doc').change(function () {
		    if (this.value != ""){
		    	step_3_callWS_DocumentType();
		    	step_3_callWS_InfDocumentUL();
		    }
		    else{
		    	$('.step_3_info_6_clone').hide();
		    }
		});				
		$('#step_3_is_identification_2_hint').hide();
		setCheckBoxVisible('#step_3_yourself_trustee_doc', false);
		setCheckBoxVisible('#step_3_in_SMEV_trustee_doc', false);
	}
	
	//признак документа
	function step_3_callWS_DocumentType() {
		dataRequest = {"documentType":{"doc":$('#step_3_name_doc').val()}};
		//response =  callWS(ARTKMVurl, dataRequest);
		callWebS(ARTKMVurl, dataRequest, step_3_DocumentType_callback,true);
	}
	
	function step_3_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		documentType = null;
		if (isResult([dataResponse])&&isResult([dataResponse.DocumentType])) {
    		documentType = dataResponse.DocumentType;
			//setCheckBox('#step_3_yourself_trustee_doc', documentType.privateStorage);
			setCheckBoxVisible('#step_3_yourself_trustee_doc', documentType.privateStorage, documentType.privateStorage);
			$('#step_3_yourself_trustee_doc').val(documentType.privateStorage);
			//setCheckBox('#step_3_in_SMEV_trustee_doc', documentType.interagency);
			setCheckBoxVisible('#step_3_in_SMEV_trustee_doc', documentType.interagency, documentType.interagency);
		}
		return documentType;
	}

	//InfDocument - реквизиты документа
	function step_3_callWS_InfDocumentUL(){ 	//idGroup - ?
		var idOrg = {"name":$('#step_1_social_institution option:selected').text(),"code":$('#step_1_social_institution').val()};
		var idDoc = {"name":$('#step_3_name_doc option:selected').text(),"code":$('#step_3_name_doc').val()};
		var idGroup = {"name":"Наименование","code":"Код организации"};
		var identityUL = {"name":$('#step_3_full_name_org').val(),"inn":$('#step_3_juridical_inn').val(),"ogrn":$('#step_3_juridical_ogrn').val(),"kpp":$('#step_3_juridical_kpp').val()};

		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup":idGroup,"identityUL":identityUL}};
		callWebS(VISurl, dataRequest, step_3_InfDocumentUL_callback,true);
	}
	
	function step_3_InfDocumentUL_callback(xmlHttpRequest, status, dataResponse){
		infDocumentUL = null;
		//обработка ответа
		if (isResult([dataResponse])&&isResult([dataResponse.infDocument])&&isResult([dataResponse.infDocument.document])) {
        		infDocumentUL = dataResponse.infDocument;
				step_3_info_6_infDocument_length = infDocumentUL.document.length;
				array = [
					'step_3_series_doc',
					'step_3_number_doc',
					'step_3_date_doc',
					'step_3_org_doc',
					'step_3_choice_trustee_rek',
					'step_3_info_6',
					'step_3_info_6_clone',
					'step_3_name_doc'
				];
				processDocumentDetails(infDocumentUL.document, array, 'step_3_yourself_trustee_doc');
		}
		return infDocumentUL;
	}

	// UTF-8 encode / decode by Johan Sundstr?m
	function encode_utf8( s )
	{
	  return unescape( encodeURIComponent( s ) );
	}

	function decode_utf8( s )
	{
	  return decodeURIComponent( escape( s ) );
	}

	function get_cookie ( cookie_name )
	{
	  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
	 
	  if ( results )
	    return decode_utf8( unescape ( results[2] ) );
	  else
	    return null;
	}

	function openStep_4() {
		switchStateDateTimePicker(false);
		if (test) {

			$('#step_4_last_name_declarant').val("Акимов").removeAttr('disabled');
				$('#step_4_first_name_declarant').val("Николай").removeAttr('disabled');
				$('#step_4_middle_name_declarant').val("Васильевич").removeAttr('disabled');

				$('#step_4_birthday_declarant').val('10.08.1938').removeAttr('disabled');
				$('#step_4_doc_declarant_type').text('Паспорт гражданина России').removeAttr('disabled');
				addOption(document.getElementById('step_4_doc_declarant_type'), 'Паспорт гражданина России', 'rusPassport', true, true);
				$('#step_4_doc_declarant_series').val('5600').removeAttr('disabled');
				$('#step_4_doc_declarant_number').val('237795').removeAttr('disabled');
				$('#step_4_doc_declarant_date').val('03.04.2000').removeAttr('disabled');
				$('#step_4_doc_declarant_org').val('').removeAttr('disabled');
				
				$('#step_4_address_declarant_postal').val('430013').removeAttr('disabled');
				$('#step_4_address_declarant_house').val('30').removeAttr('disabled');
				$('#step_4_address_declarant_region').val('Пензенская область').removeAttr('disabled');
				$('#step_4_address_declarant_district').val('').removeAttr('disabled');
				$('#step_4_address_declarant_city').val('г. Пенза').removeAttr('disabled');
				$('#step_4_address_declarant_flat').val('').removeAttr('disabled');
				$('#step_4_address_declarant_settlement').val('').removeAttr('disabled');
				$('#step_4_address_declarant_street').val('ул. Коваленко').removeAttr('disabled');
				$('#step_4_address_declarant_body').val('').removeAttr('disabled');
				$('#step_4_address_declarant_build').val('').removeAttr('disabled');
				$('#step_4_address_declarant_room').val('169').removeAttr('disabled');
		} else {
			
			$('#step_4_last_name_declarant').val('').removeAttr('disabled');
			$('#step_4_first_name_declarant').val('').removeAttr('disabled');
			$('#step_4_middle_name_declarant').val('').removeAttr('disabled');
			$('#step_4_birthday_declarant').val('').removeAttr('disabled');
			setDictionary("document_name", "step_4_doc_declarant_type");
			$('#step_4_doc_declarant_type').removeAttr('disabled');
			$('#step_4_doc_declarant_series').val('').removeAttr('disabled');
			$('#step_4_doc_declarant_number').val('').removeAttr('disabled');
			$('#step_4_doc_declarant_date').val('').removeAttr('disabled');
			$('#step_4_doc_declarant_org').val('').removeAttr('disabled');
			$('#step_4_address_declarant_postal').val('').removeAttr('disabled');
			$('#step_4_address_declarant_house').val('').removeAttr('disabled');
			$('#step_4_address_declarant_region').val('').removeAttr('disabled');
			$('#step_4_address_declarant_district').val('').removeAttr('disabled');
			$('#step_4_address_declarant_city').val('').removeAttr('disabled');
			$('#step_4_address_declarant_flat').val('').removeAttr('disabled');
			$('#step_4_address_declarant_settlement').val('').removeAttr('disabled');;
			$('#step_4_address_declarant_street').val('').removeAttr('disabled');;
			$('#step_4_address_declarant_body').val('').removeAttr('disabled');;
			$('#step_4_address_declarant_build').val('').removeAttr('disabled');;
			$('#step_4_address_declarant_room').val('').removeAttr('disabled');;
		}
//		var kladrArrayIdNew = ['step_4_declarant_region_kladr','step_4_declarant_district_kladr','step_4_declarant_town_kladr','step_4_declarant_locallity_kladr','step_4_declarant_street_kladr'];
//		loadKladr(kladrArrayIdNew);
		var kladrArrayIdNew = ['step_4_new_region','step_4_new_district','step_4_new_town','step_4_new_locality','step_4_new_street'];
		loadKladr(kladrArrayIdNew);
		if (getCheckedRadioValue('step_1_acting_person') == "self"){  //Если лицо, оформляющее электронную заявку, действует за себя (на Шаге 1 включена радиокнопка «Вы действуете за себя»).
			$('#step_4_label').html('Вы заказываете услугу от своего имени<br/>Укажите сведения о себе');
			$('#step_4_info_2').show();
			$('#step_4_info_3').show();
			$('#step_4_info_4').show();
			$('#step_4_identification_check').show();
			$('step_4_is_identification_3_hint').hide();
			$('.step_4_info_5_clone').hide();
			$('#step_4_add_check').hide();
			hide_step_4_add();
		} else {	//Если лицо, оформляющее электронную заявку, действует как законный представитель (на Шаге 1 включена радиокнопка «Вы действуете как законный представитель»).
			$('#step_4_label').html('Вы заказываете услугу, как законный представитель<br/>Укажите сведения о лице, которое Вы представляете ('+getSelectedObject('step_1_category').name+')');
			$('#step_4_info_2').hide();
			$('#step_4_info_3').hide();
			$('#step_4_info_4').hide();
			$('#step_4_identification_check').hide();

			$('.step_4_info_5_clone').show();
			$('#step_4_add_check').show();
//			SCREEN.wait();
			
			if ($('#step_1_category_legal_representative').val() == 'GuardianUL'){
    			step_4_callWS_copyrightOwnerPersonUL();
    		}
    		else{
        		step_4_callWS_copyrightOwnerPersonFL();
    		}
		}
		isIdentification('#step_4_is_identification_3');
		$('#step_4_add').show();
		$('#step_4_add_label').show();
		$('#step_4_add').removeAttr('checked');
		$('#step_4_add_check').hide();
		$('#step_4_add').unbind('change');
		$('#step_4_add').change(function(e){
			if (this.checked){
				show_step_4_add();
			}
			else{
				hide_step_4_add();
			}
		});
		$('#step_4_document_name_system').unbind('change');
		$('#step_4_document_name_system').change(function(){
			setCheckBoxVisible('#step_4_get_document_name',(this.value != ""), true);
		});
		$('#step_4_doc_other').unbind('change');
		$('#step_4_doc_other').change(function(){
			setCheckBoxVisible('#step_4_document_name_system', this.checked);
			setCheckBoxVisible('#step_4_get_document_name', (this.checked && ($('#step_4_document_name_system').val() != "")), true);
		});
		$('#step_4_info_6').hide();
		$('#step_4_info_7').hide();
		setCheckBoxVisible('#step_4_registration_address_system', false);
		setCheckBoxVisible('#step_4_set_registration_address_system', false);
		$('#step_4_set_registration_address_system').unbind('change');
		$('#step_4_set_registration_address_system').change(function(){
			if (!this.checked){			
				$('#step_4_address_person_table').show();
			}else{
				$('#step_4_address_person_table').hide();
			}
		});
		hide_step_4_add();	
		var kladrArrayIdDeclarant = ['step_4_address_person_region', 'step_4_address_person_district', 'step_4_address_person_city', 'step_4_address_person_settlement', 'step_4_address_person_street'];
		loadKladr(kladrArrayIdDeclarant);
		switchStateDateTimePicker(true);
	}
	
	function step_4_idenDocRegAddrOwner_callback(xmlHttpRequest, status, dataResponse){
		idenDocRegAddrOwner = null;
		if (isResult([dataResponse])&&isResult([dataResponse.idenDocRegAddrOwner])){
			idenDocRegAddrOwner = dataResponse.idenDocRegAddrOwner;
			if (isResult([idenDocRegAddrOwner.identDocRegAddress])){
				if (isResult([idenDocRegAddrOwner.identDocRegAddress.document])&&(idenDocRegAddrOwner.identDocRegAddress.document.length > 0)){
					step_4_info_6_identDocRegAddress_length = idenDocRegAddrOwner.identDocRegAddress.document.length;
					array = [
							'step_4_document_type_system',
							'step_4_document_issue_date_system',
							'step_4_document_series_system',
							'step_4_document_number_system',
							'step_4_documen_org_system',
							'step_4_is_doc_person_system_true',
							'step_4_info_6_doc'
						];
					switchStateDateTimePicker(false);
					newCloneSpan('step_4_info_6_clone', step_4_info_6_identDocRegAddress_length, array);
					switchStateDateTimePicker(true);
					for (var i=0; i < idenDocRegAddrOwner.identDocRegAddress.document.length; i++) {
							if (isResult([idenDocRegAddrOwner.identDocRegAddress.document[i]])){
								var doc = idenDocRegAddrOwner.identDocRegAddress.document[i];
								if (isNotUndefined(doc.name)){
								addOption(document.getElementById('step_4_document_type_system_' + i), doc.name, doc.code, true, true);
								//$('#step_4_document_type_system_' + i).val(idenDocRegAddrOwner.identDocRegAddress[i].document.name);
								$('#step_4_document_issue_date_system_' + i).val(doc.dateIssue);
								var param = doc.params.param;
								var isVisibleBlock = false;
								for (var j=0; j< param.length; j++){
									if (param[j].code == DocumentSeries){
										isVisibleBlock = isNotUndefined(doc.dateIssue)&&(doc.dateIssue != '');
										isVisibleBlock = isVisibleBlock && (param[j].value != null)&&(param[j].value != '')&&(isNotUndefined(param[j].value));
										$('#step_4_document_series_system_' + i).val(param[j].value);		
									}
									else if (param[j].code == DocumentsNumber){
										$('#step_4_document_number_system_' + i).val(param[j].value);
									}
									else if (param[j].code == GiveDocumentOrg){
										$('#step_4_documen_org_system_' + i).val(param[j].value);
									}
								}
								if (isVisibleBlock){
									$('#step_4_info_6_doc_' + i).show();
								}
								else {
									$('#step_4_doc_other').attr("checked", "checked");
									$('#step_4_doc_other').change();
									$('#step_4_info_6_doc_' + i).hide();
								}
						}
					   }
					}
				}
				else{
					dontHaveIdenDocRegAddrOwnerInVis();
				}
			if (isResult([idenDocRegAddrOwner.identDocRegAddress])) {
				if (isResult([idenDocRegAddrOwner.identDocRegAddress.addressRegistration])){
					var addressRegistration = idenDocRegAddrOwner.identDocRegAddress.addressRegistration;
					isStep_4_addresRegistration(addressRegistration);
					setCheckBoxVisible('#step_4_in_SMEV_trustee_doc_registration_address', true, true);//не обязательно	
				}
				else{
					isStep_4_addresRegistration(null);	//$('#step_4_registration_address_system').val('');
				}
			}
			else{
				isStep_4_addresRegistration(null);
			}
			$('.step_4_is_doc_person_system_true').unbind('change');
			$('.step_4_is_doc_person_system_true').change(function(){
				if (this.checked){
					$('.step_4_is_doc_person_system_true').removeAttr("checked", "checked");
					this.checked = true;
					ind =  this.id.substr('step_4_is_doc_person_system_true_'.length, this.id.length);
					//$('#step_4_registration_address_system').val(addressToString(addressRegistration));
					$('#step_4_doc_other').removeAttr("checked");
					setCheckBoxVisible('#step_4_doc_other', false);
					setCheckBoxVisible('#step_4_document_name_system', false);
					setCheckBoxVisible('#step_4_get_document_name', false, false);
                    			hideAllWithoutThis('step_4_info_6_clone', ind);
				}
				else {
					setCheckBoxVisible('#step_4_doc_other', true, false);
					setCheckBoxVisible('#step_4_get_document_name', false);
					showAllWithoutDefault('step_4_info_6_clone');
				}
			});	
		  }
		  else {
				dontHaveIdenDocRegAddrOwnerInVis();
			}
		}
		else {
			dontHaveIdenDocRegAddrOwnerInVis();
		}
		return idenDocRegAddrOwner;
	}

	function dontHaveIdenDocRegAddrOwnerInVis(){
			setCheckBoxVisible('#step_4_doc_other', false);
			$('#step_4_doc_other').attr("checked", "checked");
			setCheckBoxVisible('#step_4_document_name_system', true);
			$('.step_4_info_6_clone').hide();
	}

	var idenDocRegAddrOwner = {}; //
	function step_4_callWS_idenDocRegAddrOwnerFL() {	//код атрибутов ?    group?
				var idOrg = {"name":$('#step_1_social_institution option:selected').text(),"code":$('#step_1_social_institution').val()};
				var i = getCheckedCloneIndex('step_4_is_declarant_system_true');
				var relative = getRelative(['step_4_last_name_system', 'step_4_middle_name_system','step_4_name_system', 'step_4_birth_date_system'], '_'+i);
				var params = {"param":[{"name":"Серия","code":DocumentSeries,"type":"Integer","value":$('#step_2_doc_legal_representative_series').val()},
							{"name":"Номер","code": DocumentsNumber,"type":"Integer","value":$('#step_2_doc_legal_representative_number').val()},
							{"name":"Кем выдан","code": GiveDocumentOrg,"type":"String","value":$('#step_2_doc_legal_representative_org').val()}]};
				var document = {"group":{"name":"Наименование группы","code":"Код группы"},"name":$('#step_2_doc_legal_representative_type option:selected').text(),"code":$('#step_2_doc_legal_representative_type').val(),"dateIssue":$('#step_2_doc_legal_representative_date').val(),"params":params};
				var identityFL = {"fio":{"surname":$('#step_2_last_name_legal_representative').val(),"patronymic":$('#step_2_middle_name_legal_representative').val(),"name": $('#step_2_first_name_legal_representative').val()},"dateOfBirth":$('#step_2_birthday_legal_representative').val(),"document": document};
				dataRequest = {"idenDocRegAddrOwner":{"idOrg": idOrg,"relative":relative,"identityFL": identityFL}};
				//response =  callWS(VISurl, dataRequest);
				callWebS(VISurl, dataRequest, step_4_idenDocRegAddrOwner_callback, true);
	}

	function isStep_4_addresRegistration(addressReg){
		if (addressReg != null){
			$('#step_4_registration_address_system').val(addressToString(addressReg));
			setCheckBoxVisible('#step_4_registration_address_system', true);
			//setCheckBoxVisible('#step_4_set_registration_address_system', true, true);
			setCheckBox('#step_4_set_registration_address_system_yes', true);  //17_08_13
			$('#step_4_set_registration_address_system_yes').change();
			$('#step_4_set_registration_address_system').closest('tr').show();
			$('#step_4_set_registration_address_system_label').show();
			$('#step_4_address_person_table').hide();
		}
		else{
			$('#step_4_registration_address_system').val('');
			setCheckBoxVisible('#step_4_registration_address_system', false);
			setCheckBoxVisible('#step_4_set_registration_address_system', false);
			$('#step_4_address_person_table').show();
		}
	}


	function step_4_copyrightOwnerPerson_callback(xmlHttpRequest, status, dataResponse){
		copyrightOwnerPerson = null;
		if (isResult([dataResponse, dataResponse.copyrightOwnerPerson])){
        		copyrightOwnerPerson = dataResponse.copyrightOwnerPerson;
				step_4_info_5_copyrightOwnerPerson_length = copyrightOwnerPerson.copyrightOwner.length;
				array = [
					'step_4_last_name_system',
					'step_4_name_system',
					'step_4_middle_name_system',
					'step_4_birth_date_system',
					'step_4_is_declarant_system_true',
					'step_4_info_5'
				];
				newCloneSpan('step_4_info_5_clone', step_4_info_5_copyrightOwnerPerson_length, array);
				for (var i=0; i < step_4_info_5_copyrightOwnerPerson_length; i++) {
					if (copyrightOwnerPerson.copyrightOwner[i].fio.surname != null)
						$('#step_4_last_name_system_' + i).val(copyrightOwnerPerson.copyrightOwner[i].fio.surname);
					if (copyrightOwnerPerson.copyrightOwner[i].fio.name != null)
						$('#step_4_name_system_' + i).val(copyrightOwnerPerson.copyrightOwner[i].fio.name);
					if (copyrightOwnerPerson.copyrightOwner[i].fio.patronymic != null)
						$('#step_4_middle_name_system_' + i).val(copyrightOwnerPerson.copyrightOwner[i].fio.patronymic);
					if (copyrightOwnerPerson.copyrightOwner[i].dateOfBirth != null) {
						$('#step_4_birth_date_system_' + i).val(copyrightOwnerPerson.copyrightOwner[i].dateOfBirth);
						$('#step_4_birth_date_system_' + i).attr('disabled', 'disabled');
					}
						
				}
				$('.step_4_is_declarant_system_true').unbind('change');
				$('.step_4_is_declarant_system_true').change(function(){
					if (this.checked){
						$('.step_4_is_declarant_system_true').removeAttr("checked", "checked");
						this.checked = true;
						ind =  this.id.substr('step_4_is_declarant_system_true_'.length, this.id.length);
						setCheckBoxVisible('#step_4_add', false, false);
						hide_step_4_add();
						//вызов сервиса ВИС {
						if ($('#step_1_category_legal_representative').val() == 'GuardianUL'){
    						step_4_callWS_idenDocRegAddrOwnerUL();
						}
						else{
							step_4_callWS_idenDocRegAddrOwnerFL();
						}
						//}
						$('#step_4_info_6').show();
						setDictionary("document_name", "step_4_document_name_system");
						setCheckBoxVisible('#step_4_doc_other', true, false);
						$('#step_4_doc_other').change();
						$('#step_4_info_7').show();
						isStep_4_addresRegistration(null);
                        			hideAllWithoutThis('step_4_info_5_clone', ind);						
					}
					else {
						setCheckBoxVisible('#step_4_add', true, false);
						$('#step_4_add').change();
						//show_step_4_add();
						$('#step_4_info_6').hide();
						setCheckBoxVisible('#step_4_doc_other', true, false);
						$('#step_4_doc_other').change();
						$('#step_4_info_7').hide();
						showAllWithoutDefault('step_4_info_5_clone');
					}
				});
				$('#step_4_add').change();
				$('#step_4_add_check').show();
		}
		else{
			$('.step_4_info_5_clone').hide();
			setCheckBoxVisible('#step_4_add_check', false, false);
			setCheckBox('#step_4_add', true);
			show_step_4_add();
		}		
	    return copyrightOwnerPerson;
	}

	function step_4_callWS_copyrightOwnerPersonFL() {  //код атрибутов ?	group?
		var params = {"param":[{"name":"Серия","code":DocumentSeries,"type":"Integer","value":$('#step_2_doc_legal_representative_series').val()},
					{"name":"Номер","code": DocumentsNumber,"type":"Integer","value":$('#step_2_doc_legal_representative_number').val()},
					{"name":"Кем выдан","code": GiveDocumentOrg,"type":"String","value":$('#step_2_doc_legal_representative_org').val()}]};
		var document = {"group":{"name":"Наименование группы","code":"Код группы"},"name":$('#step_2_doc_legal_representative_type option:selected').text(),"code":$('#step_2_doc_legal_representative_type').val(),"dateIssue":$('#step_2_doc_legal_representative_date').val(),"params":params};
		var identityFL = {"fio":{"surname":$('#step_2_last_name_legal_representative').val(),"patronymic":$('#step_2_middle_name_legal_representative').val(),"name": $('#step_2_first_name_legal_representative').val()},"dateOfBirth":$('#step_2_birthday_legal_representative').val(),"document": document};
		dataRequest = {"copyrightOwnerPerson":{"idOrg":$('#step_1_social_institution').val(),"idCatlegRep":$('#step_1_category_legal_representative').val(),"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_4_copyrightOwnerPerson_callback,true);
	}

	function step_4_callWS_copyrightOwnerPersonUL() {
		var identityUL = {"name":$('#step_3_full_name_org').val(),"inn":$('#step_3_juridical_inn').val(),"ogrn":$('#step_3_juridical_ogrn').val(),"kpp":$('#step_3_juridical_kpp').val()};		
		dataRequest = {"copyrightOwnerPerson":{"idOrg":$('#step_1_social_institution').val(),"idCatlegRep":$('#step_1_category_legal_representative').val(),"identityUL":identityUL}};
		callWebS(VISurl, dataRequest, step_4_copyrightOwnerPerson_callback,true);
	}

	function step_4_callWS_idenDocRegAddrOwnerUL() {
				var idOrg = {"name":$('#step_1_social_institution option:selected').text(),"code":$('#step_1_social_institution').val()};
				var relative = {"fio":{"surname":$('#step_4_last_name_system[]').val(),"patronymic":$('#step_4_middle_name_system[]').val(),"name":$('#step_4_name _system[]').val()},"dateOfBirth":$('#step_4_birth_date_system[]').val()};
				var identityUL = {"name":$('#step_3_full_name_org').val(),"inn":$('#step_3_juridical_inn').val(),"ogrn":$('#step_3_juridical_ogrn').val(),"kpp":$('#step_3_juridical_kpp').val()};
				dataRequest = {"idenDocRegAddrOwner":{"idOrg": idOrg,"relative":relative,"identityUL": identityUL}};
				callWebS(VISurl, dataRequest, step_4_idenDocRegAddrOwner_callback, true);
	}

	function show_step_4_add(){
		$('#step_4_info_8').show();
		$('#step_4_info_9').show();
		setDictionary("document_name", "step_4_document_name_new");
		$('#step_4_info_10').show();	
		$('.step_4_info_5_clone').hide();
	}

	function hide_step_4_add(){
		$('#step_4_info_8').hide();
		$('#step_4_info_9').hide();
		$('#step_4_info_10').hide();
		showAllWithoutDefault('step_4_info_5_clone');
	}
		
	function openStep_5() {
				setDictionary("document_name", "step_5_doc_declarant_type");
				$('#step_5_doc_declarant_type').removeAttr('disabled');
				switchStateDateTimePicker(false);	//KAVlex 21_08_13
				switchStateDateTimePicker(true);
				$('#step_5_last_name_declarant').val($('[name=lastName]').val()).removeAttr('disabled');
				$('#step_5_first_name_declarant').val($('[name=firstName]').val()).removeAttr('disabled');
				$('#step_5_middle_name_declarant').val($('[name=middleName]').val()).removeAttr('disabled');
				$('#step_5_birthday_declarant').removeAttr('disabled');
				$('#step_5_INN').val($('[name=inn]').val()).removeAttr('disabled');
				$('#step_5_OGRNIP').removeAttr('disabled');
				/*var doc = getCodeDocByName($('[name=idCardType]').val());
				if (isResult([doc]))
                    			addOption(document.getElementById('step_5_doc_declarant_type'), doc.name, doc.code, true, true);*/
				$('#step_5_doc_declarant_series').val($('[name=idCardSr]').val()).removeAttr('disabled');
				$('#step_5_doc_declarant_number').val($('[name=idCardNum]').val()).removeAttr('disabled');
				$('#step_5_doc_declarant_date').val($('[name=idCardDate]').val()).removeAttr('disabled');
				$('#step_5_document_org').val($('[name=idCardBy]').val()).removeAttr('disabled');
				
				$('#step_5_address_declarant_postal').val($('[name=zipCode]').val()).removeAttr('disabled');
				$('#step_5_address_declarant_region').val($('[name=subjectRF]').val()).removeAttr('disabled');
				$('#step_5_address_declarant_district').val($('[name=regionTerritory]').val()).removeAttr('disabled');
	    		$('#step_5_address_declarant_city').val($('[name=areaCity]').val()).removeAttr('disabled');
				$('#step_5_address_declarant_settlement').val($('[name=location]').val()).removeAttr('disabled');       
				$('#step_5_address_declarant_street').val($('[name=streetQuarter]').val()).removeAttr('disabled');
				$('#step_5_address_declarant_house').val($('[name=house]').val()).removeAttr('disabled');
				$('#step_5_address_declarant_body').val($('[name=corps]').val()).removeAttr('disabled');
				$('#step_5_address_declarant_build').val($('[name=building]').val()).removeAttr('disabled');
				$('#step_5_address_declarant_flat').val($('[name=apartment]').val()).removeAttr('disabled');   
				$('#step_5_address_declarant_room').removeAttr('disabled');		
		    		$('#step_5_is_identification_4_hint').hide();
        			isIdentification('#step_5_is_identification_4');
	}
	
	function openStep_6() {
		setDictionary("document_name", "step_6_step_6_document_type_org");
		$('#step_6_step_6_document_type_org').removeAttr('disabled');
		$('#step_6_full_name_org').removeAttr('disabled');
		$('#step_6_reduced_name_org').removeAttr('disabled');
		$('#step_6_legal_address_org').removeAttr('disabled');
		$('#step_6_identity_org_reg').removeAttr('disabled');
		$('#step_6_juridical_inn').removeAttr('disabled');
		$('#step_6_juridical_kpp').removeAttr('disabled');
		$('#step_6_juridical_ogrn').removeAttr('disabled');
		$('#step_6_lastname_org').val($('[name=lastName]').val()).removeAttr('disabled');
		$('#step_6_name_org').val($('[name=firstName]').val()).removeAttr('disabled');
		$('#step_6_middlename_org').val($('[name=middleName]').val()).removeAttr('disabled');
		$('#step_6_birth_date_org').removeAttr('disabled');
		switchStateDateTimePicker(false);
		switchStateDateTimePicker(true);
		/*var doc = getCodeDocByName($('[name=idCardType]').val());
		if (isResult([doc]))
	            addOption(document.getElementById('step_6_step_6_document_type_org'), doc.name, doc.code, true, true);*/
		$('#step_6_document_series_org').val($('[name=idCardSr]').val()).removeAttr('disabled');
		$('#step_6_document_number_org').val($('[name=idCardNum]').val()).removeAttr('disabled');
		$('#step_6_document_issue_date_org').val($('[name=idCardDate]').val()).removeAttr('disabled');
		$('#step_6_document_org').val($('[name=idCardBy]').val()).removeAttr('disabled');
		$('#step_6_pozition_manager').removeAttr('disabled');
		
		$('#step_6_is_identification_org').change(function(){
			if (!this.checked){
				$('#step_6_is_identification_hint').removeAttr("hidden", "hidden");				
			}
		});
	}
	
	function openStep_7() {
		if ( $('#step_1_subservices').val() == '1300000010000012637') {
			$('span#step_7_label').html('Укажите сведения об умершем участнике ликвидации последствий радиационных воздействий');
		}
		$('#step_7_last_name_people_two').val('');
		$('#step_7_first_name_people_two').val('');
		$('#step_7_middle_name_people_two').val('');
		$('#step_7_registration_address').hide();
		$('#step_7_info_5').hide();
		$('#step_7_info_2_block').hide();
		$('input[name="step_7_add_family"]').unbind('change');
		$('input[name="step_7_add_family"]').change(function(){
		    if ($(this).is(":checked")) {
		    	$('#step_7_info_2_block').hide();
		        $('.step_7_info_2_clone').hide();
                $('#step_7_registration_address').hide();
		    	$('#step_7_info_5').show();
		    	show_step_7_add_familyBlock();
		    } else {
		    	$('#step_7_info_2_block').show();
		    	
     		   showAllWithoutDefault('step_7_info_2_clone');
//               $('#step_7_registration_address').show();
		       $('#step_7_info_5').hide();
		       hide_step_7_add_familyBlock();
		    }
		});
		setDictionary('relationDegree','step_7_relation_degree');
	    	setCheckBoxVisible('#step_7_add_family', true, false);
		//hide_step_7_add_familyBlock();
		$('input[name="step_7_add_family"]').change();
		var typeOfPerson = $('#step_1_category_person_self option:selected').val();
		if ($('#step_4_add').attr('checked') || ((getCheckedCloneIndex('step_4_is_declarant_system_true') < 0)&&(getCheckedRadioValue('step_1_acting_person') == "law")) ||
				(getCheckedRadioValue('step_1_acting_person') == "self")&&(typeOfPerson != 'phys')){
			$('#step_7_info_5').show();
			step_7_FamilyMembers_dontHaveResult();
		}
		else{
			step_7_callWS_FamilyMembers();
		}
		is_step_7_registration_address(true, false);
		step_7_callWS_GroupOfDocuments();
		setDictionary('relationDegree','step_7_relation_degree_two');
		$("#step_7_set_registration_address_people").change(function(){
			if (this.checked)
				$('fieldset[id="step_7_registration_address_2"]').hide();
			else
				$('fieldset[id="step_7_registration_address_2"]').show();
		});
	}
	
	var step_7_info_2_familyMembers_length;
	function step_7_callWS_FamilyMembers() {	//group - ?
		idOrg = getIdOrg();
		identityFL = getIdentityFLFromStep_4();
		dataRequest = {"familyMembers":{"idOrg":idOrg,"identityFL":identityFL}};		

        $('#step_7_registration_address').hide();       //"Группа полей скрытая по умолчанию. Отображается на форме, если сведения о лице, на основании данных которого может быть оказана услуга, вернулись из ВИС"
		callWebS(VISurl, dataRequest, step_7_FamilyMembers_callback,true);
	}
	
	function is_step_7_registration_address(reset, isAddress){
        if (reset){
            $('#step_7_registration_address').hide();
        }
        else 
            if(isAddress) {
                $('#step_7_registration_address').show();
                setCheckBoxVisible('#step_7_registration_address_people', true);    //не чекбокс, но функция подходящая))
                setCheckBox('#step_7_set_registration_address_people_yes', true);
                $('#step_7_set_registration_address_people_yes').change();
            }
            else{
                $('#step_7_registration_address').hide();
                setCheckBoxVisible('#step_7_registration_address_people', false);    //не чекбокс, но функция подходящая))
                //setCheckBoxVisible('#step_7_set_registration_address_people', false);     //by KAVlex 20_07_13
            }
    	}
    
	function step_7_FamilyMembers_callback(xmlHttpRequest, status, dataResponse){
	    //alert(JSON.stringify(dataResponse));
		familyMembers = null;
		setDictionary('relationDegree','step_7_relation_degree');
		is_step_7_registration_address(true, false);
		if (isResult([dataResponse.familyMembers])) {
    		familyMembers = dataResponse.familyMembers;
		    if (isResult([familyMembers.familyMember])){   
		    $('#step_7_info_2_block').show();
			$('#step_7_info_2_clone').show();
    			step_7_info_2_familyMembers_length = familyMembers.familyMember.length;
//        			is_step_7_registration_address(true, false);   //показываем группу полей адреса регистрации
				        array = [
					        'step_7_last_name_people',
					        'step_7_first_name_people',
					        'step_7_middle_name_people',
					        'step_7_birthday_people',
					        'step_7_relation_degree',
					      //  'step_7_is_dependency',
					        'step_7_is_set_people_true',
					        'step_7_info_2'
				        ];
				        newCloneSpan('step_7_info_2_clone', step_7_info_2_familyMembers_length, array);
				        for (var i=0; i < step_7_info_2_familyMembers_length; i++) {
					        $('#step_7_last_name_people_' + i).val(familyMembers.familyMember[i].fio.surname);
					        $('#step_7_first_name_people_' + i).val(familyMembers.familyMember[i].fio.name);
					        $('#step_7_middle_name_people_' + i).val(familyMembers.familyMember[i].fio.patronymic);
					        $('#step_7_birthday_people_' + i).val(familyMembers.familyMember[i].dateOfBirth);
					        $('#step_7_relation_degree_' + i).val(familyMembers.familyMember[i].relationDegree);  //- так правильно, должен быть код?
					       // setCheckBox('#step_7_is_dependency_' + i, familyMembers.familyMember[i].dependent);   //  не нужно больше
				        }
				        $('.step_7_is_set_people_true').change(function(){
                            if (this.checked){
                                $('.step_7_is_set_people_true').removeAttr("checked", "checked");
                                this.checked = true;
                                setCheckBoxVisible('#step_7_add_family', false, false);
                                $('#step_7_add_family').change();
                                step_7_callWS_DocConfDegreeRelatRegAddress();
                                if (codeSelectDocFromGroup != null){//получаем реквизиты выбранного документа в группе
                                	$('#step_7_doc_true_group_'+codeSelectDocFromGroup).change();
                                }
                                hideAllWithoutThis('step_7_info_2_clone', getCheckedCloneIndex('step_7_is_set_people_true'));
                                step_7_callWS_IdDocFamilyMember(this.id.split('_').pop(), step_7_IdDocFamilyMember_callback);
                                $('#step_7_info_5').show();
                            }
                            else{
                                setCheckBoxVisible('#step_7_add_family', true, false);
                                is_step_7_registration_address(false, false);
                                $('.step_7_info_5_group_document_detail_clone_'+codeSelectDocFromGroup).hide();//убираем реквизиты у выбранного документа, т.к. не выбран пользователь
                                showAllWithoutDefault('step_7_info_2_clone');
                                $('span[name=step_7_info_5_document_detail_clone]').hide();
				$('[name=step_7_choice_trustee_rek_document]').removeAttr("checked", "checked");
                                $('[name=step_7_yourself_trustee_doc_document]').each(function(){   //20_07_13
                                    if (this.value)
                                        setCheckBoxVisible('#'+this.id, true, true);
                                });
                                $('#step_7_info_5').hide();
				$('fieldset[id="step_7_registration_address_2"]').hide();
                            }
                        });
                        $('#step_7_add_family').change();
            } else {
    			step_7_FamilyMembers_dontHaveResult();
            }
		    is_step_7_registration_address(true, false);   //показываем группу полей адреса регистрации
		} else {
			step_7_FamilyMembers_dontHaveResult();
		}
		return familyMembers;
	}

	function step_7_FamilyMembers_dontHaveResult(){
           	setCheckBoxVisible('#step_7_add_family', true, true);
           	$('#step_7_add_family').hide(); $('#step_7_add_family_label').hide();
           	$('#step_7_add_family').change();
	        $('.step_7_info_2_clone').hide();
        	show_step_7_add_familyBlock();
	}

	function step_7_callWS_DocConfDegreeRelatRegAddress(index) {	//Адрес регистрации лица, на основании данных которого оказывается услуга
		idOrg = getIdOrg();
		index = getCheckedCloneIndex('step_7_is_set_people_true');
		var relative = getRelative(['step_7_last_name_people', 'step_7_middle_name_people', 'step_7_first_name_people', 'step_7_birthday_people'], '_'+index);
		var identityFL = getIdentityFLFromStep_4();
		dataRequest = {"docConfDegreeRelatRegAddress":{"idOrg": idOrg, "relative":relative, "identityFL": identityFL}};
		callWebS(VISurl, dataRequest, step_7_DocConfDegreeRelatRegAddress_callback,true);
	}
	
	function getIdentityFLFromStep_4(){
		var group = {"name":"Наименование группы","code":"Код группы"};
		var fio, dateOfBirth, params, name, code, dateIssue;
		if (getCheckedRadioValue('step_1_acting_person') == "self"){  //Если «Вы действуете за себя».
			fio = {"surname":$('#step_4_last_name_declarant').val(),"patronymic": $('#step_4_middle_name_declarant').val(),"name": $('#step_4_first_name_declarant').val()};
			dateOfBirth = $('#step_4_birthday_declarant').val();
			params = {"param":[{"name":"Серия","code":"DocumentSeries","type":"Integer","value":$('#step_4_doc_declarant_series').val()},
					{"name":"Номер","code":"DocumentsNumber","type":"Integer","value":$('#step_4_doc_declarant_number').val()},
					{"name":"Кем выдан","code":"GiveDocumentOrg","type":"String","value":$('#step_4_doc_declarant_org').val()}]};

			name = $('#step_4_doc_declarant_type option:selected').text();
			code = $('#step_4_doc_declarant_type').val();
			dateIssue = $('#step_4_doc_declarant_date').val();
		}
		else {
			//step_4_info_5_length;  //глобальная переменная, в которую нужно сохранять блину клонируемого блока на 4 шаге
			var i = getCheckedCloneIndex('step_4_is_declarant_system_true');
			fio = {"surname":$('#step_4_last_name_system_'+ i).val(),"patronymic": $('#step_4_middle_name_system_' + i).val(),"name": $('#step_4_name_system_'+ i).val()};
			dateOfBirth = $('#step_4_birth_date_system_'+i).val();

			//step_4_info_6_length;  //глобальная переменная, в которую нужно сохранять блину клонируемого блока на 4 шаге
			i = getCheckedCloneIndex('step_4_is_doc_person_system_true');
			params = {"param":[{"name":"Серия","code":"DocumentSeries","type":"Integer","value":$('#step_4_document_series_system_'+ i).val()},
					{"name":"Номер","code":"DocumentsNumber","type":"Integer","value":$('#step_4_document_number_system_'+ i).val()},
					{"name":"Кем выдан","code":"GiveDocumentOrg","type":"String","value":$('#step_4_documen_org_system_'+ i).val()}]};

			name = $('#step_4_document_type_system_'+i+' option:selected').text(); 
			code = $('#step_4_document_type_system_'+i).val();
			dateIssue = $('#step_4_document_issue_date_system_'+i).val();
		}
		var document = {"group":group,"name":name,"code":code,"dateIssue":dateIssue,"params":params};
		var identityFLFromStep_4 = {"fio":fio,"dateOfBirth":dateOfBirth,"document":document};
		return identityFLFromStep_4;
	}
	
	function getFIOFromStep4(){
		var fio = new Object();
		if (getCheckedRadioValue('step_1_acting_person') == "self"){
			fio = {"surname":$('#step_4_last_name_declarant').val(),"patronymic": $('#step_4_middle_name_declarant').val(),"name": $('#step_4_first_name_declarant').val()};
		}
		else{
			var i = getCheckedCloneIndex('step_4_is_declarant_system_true');
			if (i >= 0)
				fio = {"surname":$('#step_4_last_name_system_'+ i).val(),"patronymic": $('#step_4_middle_name_system_' + i).val(),"name": $('#step_4_name_system_'+ i).val()};
			else if ($('#step_4_add').attr('checked'))
				fio = {"surname":$('#step_4_last_name_new').val(),"patronymic": $('#step_4_middle_name_new').val(),"name": $('#step_4_name_new').val()};;
		}
		return fio;
	}
	
	function getDocNameFromStep4(){
		var resDoc = new Object();
		if (getCheckedRadioValue('step_1_acting_person') == "self"){
		    var d = getSelectedObject('step_4_doc_declarant_type');
			resDoc.docName = d.name;
			resDoc.docCode = d.code;
			resDoc.bringPerson = false;
		}
		else{
			var i = getCheckedCloneIndex('step_4_is_declarant_system_true');
			if (i >= 0){
				var docInd = getCheckedCloneIndex('step_4_is_doc_person_system_true');
				if (docInd >= 0){
    				var d = getSelectedObject('step_4_document_type_system_' + docInd);
					resDoc.docName = d.name;  
					resDoc.docCode = d.code;
					resDoc.bringPerson = false;
				}
				else if ($('#step_4_doc_other').attr('checked')){
				    var d = getSelectedObject('step_4_document_name_system');
					resDoc.docName = d.name;
    				resDoc.docCode = d.code;
    				resDoc.bringPerson = true;
				}
			}
			else if ($('#step_4_add').attr('checked')){
			    var d = new Object();
				d = getSelectedObject('step_4_document_name_new');
				resDoc.docName = d.name;
				resDoc.docCode = d.code;
				resDoc.bringPerson = true;
			}
		}
		return resDoc;
	}
	
	function getIdentityIPFromStep_5(){
		var fio = getFIO(['step_5_last_name_declarant','step_5_middle_name_declarant','step_5_first_name_declarant']);
		var identityIP = {"fio": fio,"dateOfBirth": $('#step_5_birthday_declarant').val(),"inn": $('#step_5_INN').val(),"ogrnip":$('#step_5_OGRNIP').val()};
		return identityIP;
	}
	
	function getIdentityULFromStep_6(){
		var identityUL = {"name":$('#step_6_full_name_org').val(),"inn": $('#step_6_juridical_inn').val(),"ogrn": $('#step_6_juridical_ogrn').val(),"kpp": $('#step_6_juridical_kpp').val()};
		return identityUL;
	}
	
	
	function step_7_DocConfDegreeRelatRegAddress_callback(xmlHttpRequest, status, dataResponse){
		docConfDegreeRelatRegAddress = null;
		if (isResult([dataResponse])) {
			docConfDegreeRelatRegAddress = dataResponse.docConfDegreeRelatRegAddress;
			if (isResult([docConfDegreeRelatRegAddress.addressRegistration])){
				var addressRegistration = docConfDegreeRelatRegAddress.addressRegistration;
				is_step_7_registration_address(false, true);
				$('#step_7_registration_address_people').val(addressToString(addressRegistration));	
			} else {
				 $('#step_7_registration_address').hide();
				 $("#step_7_set_registration_address_people").attr("checked", false); 
				 $("#step_7_set_registration_address_people").change();
			}
		}
		else{
    			is_step_7_registration_address(false, false);
			$("#step_7_set_registration_address_people").attr("checked", false); 	//by KAVlex 28_01_14
			$("#step_7_set_registration_address_people").change();	
		}
		return docConfDegreeRelatRegAddress;
    }

	function step_7_callWS_GroupOfDocuments(){		//Перечень необходимых документов
		subservice = $('select#step_1_subservices option:selected').val();
		category = $('select#step_1_category option:selected').val();
		dataRequest = {"groupOfDocuments": {"subservice":subservice,"category":category, "signDocPack":"Person"}};
		callWebS(ARTKMVurl, dataRequest, step_7_GroupOfDocuments_callback, true);
	}
	
	var idenDocCodes = []; //массив кодов документов удостоверяющих личность
	function step_7_GroupOfDocuments_callback(xmlHttpRequest, status, dataResponse){
		$('#step_7_info_5_document_detail_clone').hide();
		$('#step_7_info_5_group_document_detail_clone').hide();
		$('#step_7_in_SMEV_trustee_doc_group').closest('tr').hide();
		$('#step_7_yourself_trustee_doc_group').closest('tr').hide();
		$('#step_7_info_5_group_document_clone').hide();
		// Получение массива кодов документов удостоверяющих личность
			idenDocCodes = getIndenDocFromDic(); 
		
		groupOfDocuments = dataResponse.groupOfDocuments;	
		if (isResult([groupOfDocuments, groupOfDocuments.document])){
			groupAdnDocs = getGroup_Document_Array(groupOfDocuments.document);
			newCloneSpan('step_7_info_5_document_clone', groupAdnDocs.documents.length, null);
			newCloneSpan('step_7_info_5_group_clone', groupAdnDocs.groups.length, null);
			countIdendocs = 0;
			for (var i=0; i < groupAdnDocs.documents.length; i++){
				if (isInArray(groupAdnDocs.documents[i].key, idenDocCodes)){
					addOption(document.getElementById('step_7_doc_name_document_' + countIdendocs), groupAdnDocs.documents[i].name, groupAdnDocs.documents[i].key, true, true);
					$('#step_7_doc_name_document_' + countIdendocs).attr('step_7_identity', 'true');
					$('#step_7_info_5_document_detail_clone_' + countIdendocs).attr('step_7_identity_ownerdoc', 'true');
					
					setCheckBoxVisible('#step_7_yourself_trustee_doc_document_' + countIdendocs, groupAdnDocs.documents[i].privateStorage, groupAdnDocs.documents[i].privateStorage);
					$('#step_7_yourself_trustee_doc_document_' + countIdendocs).val(groupAdnDocs.documents[i].privateStorage);
					setCheckBoxVisible('#step_7_in_SMEV_trustee_doc_document_' + countIdendocs, groupAdnDocs.documents[i].interagency, groupAdnDocs.documents[i].interagency);
					$('#step_7_in_SMEV_trustee_doc_document_' + countIdendocs).val(groupAdnDocs.documents[i].interagency);
					countIdendocs++;
					
					writeDocument(groupAdnDocs.documents[i], 'step_7_doc_name_document_' + countIdendocs);		//15_07_13 by KAVlex
				}
				else{
					j = groupAdnDocs.documents.length + countIdendocs - i - 1;
					addOption(document.getElementById('step_7_doc_name_document_' + j), groupAdnDocs.documents[i].name, groupAdnDocs.documents[i].key, true, true);
					$('#step_7_doc_name_document_' + j).attr('step_7_identity', 'false');
					$('#step_7_info_5_document_detail_clone_' + j).attr('step_7_identity_ownerdoc', 'false');
					setCheckBoxVisible('#step_7_yourself_trustee_doc_document_' + j, groupAdnDocs.documents[i].privateStorage, groupAdnDocs.documents[i].privateStorage);
					$('#step_7_yourself_trustee_doc_document_' + j).val(groupAdnDocs.documents[i].privateStorage);
					setCheckBoxVisible('#step_7_in_SMEV_trustee_doc_document_' + j, groupAdnDocs.documents[i].interagency, groupAdnDocs.documents[i].interagency);					
					$('#step_7_in_SMEV_trustee_doc_document_' + j).val(groupAdnDocs.documents[i].interagency);
					
					writeDocument(groupAdnDocs.documents[i], 'step_7_doc_name_document_' + j);		//15_07_13 by KAVlex
				}
				
			}
			for (var i=0; i < groupAdnDocs.groups.length; i++){
				addOption(document.getElementById('step_7_group_doc_name_' + i), groupAdnDocs.groups[i].name, groupAdnDocs.groups[i].key, true, true);
			}
		}
		else{
			$('#step_7_info_5').remove();	//hide()<-->remove() by KAVlex 26_07_13
		}
		return groupOfDocuments;
    }
	
	var indexOfGroup;
	function getDocsByGroup(el){
		idSplitArr = el.id.split('_');
		indexOfGroup = idSplitArr.pop();
		var step_7_info_5_group_document_clone = $('.step_7_info_5_group_document_clone_'+indexOfGroup);
		if (el.value == '+'){
			if (step_7_info_5_group_document_clone.length > 1){
				step_7_info_5_group_document_clone.show();
				el.value = '-';
			}
			else
				step_7_callWS_Documents();
		}
		else{
			step_7_info_5_group_document_clone.hide();
			el.value = '+';
		}
		$('#step_7_info_5_group_document_clone_'+indexOfGroup).hide();
		
	}
	
	function step_7_callWS_DocumentType(){
		dataRequest = {"documentType":{"doc":$('select#step_7_doc_name_group_'+codeSelectDocFromGroup+ ' option:selected').val()}};	//step_7_doc_true_group_
		callWebS(ARTKMVurl, dataRequest, step_7_DocumentType_callback, true);
	}
	
	function step_7_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse, dataResponse.DocumentType])){
			documentType = dataResponse.DocumentType;
			setCheckBoxVisible('#step_7_yourself_trustee_doc_group_'+codeSelectDocFromGroup, documentType.privateStorage, documentType.privateStorage);
			$('#step_7_yourself_trustee_doc_group_'+codeSelectDocFromGroup).val(documentType.privateStorage); 			
			setCheckBoxVisible('#step_7_in_SMEV_trustee_doc_group_'+codeSelectDocFromGroup, documentType.interagency, documentType.interagency);
			$('#step_7_in_SMEV_trustee_doc_group_'+codeSelectDocFromGroup).val(documentType.interagency);
			return documentType;
		}
		return null;
	}
	
	function show_step_7_add_familyBlock(){
   			$('fieldset[id="step_7_info_4"]').show();
			$('fieldset[id="step_7_registration_address_2"]').show();
			//$('fieldset[id="step_7_info_5[]"]').show();
    }
    
    function hide_step_7_add_familyBlock(){
   			$('fieldset[id="step_7_info_4"]').hide();
			$('fieldset[id="step_7_registration_address_2"]').hide();
			//$('fieldset[id="step_7_info_5[]"]').hide();
    }
    
    function step_7_callWS_IdDocFamilyMember(index, callback){
    	var idOrg = getIdOrg();
    	var relative = getRelative(['step_7_last_name_people', 'step_7_middle_name_people', 'step_7_first_name_people', 'step_7_birthday_people'], '_'+index);
    	var identityFL = getIdentityFLFromStep_4();
		dataRequest = {"idDocFamilyMember":{"idOrg":idOrg,"relative":relative,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, callback, true);
    }
    
    
    var infDocumentWithoutGroupIndex = -1;	//индекс документа без группы, для которого запрашиваются реквизиты
    function step_7_IdDocFamilyMember_callback(xmlHttpRequest, status, dataResponse){
    	idDocFamilyMember = null;
    	if (isResult([dataResponse, dataResponse.idDocFamilyMember])){
    		idDocFamilyMember = dataResponse.idDocFamilyMember;
    		$('select[name=step_7_doc_name_document]').each(function(){
    			if (this.id.indexOf('step_7_doc_name_document_') == 0){
    		    	for (var i=0; i<idDocFamilyMember.document.length; i++){
    		    		if ($(this).val() == idDocFamilyMember.document[i].code){  //для реалки должно быть ==idDocFamilyMember.document[i].code 			//test = 'udPerson13'||$(this).val() == 'udPerson11'
    		    			var ind = this.id.substr('step_7_doc_name_document_'.length, this.id.length);
    		    			var array = [
    		    				'step_7_series_doc_document_'+ind,
    		    				'step_7_number_doc_document_'+ind,
    		    				'step_7_date_doc_document_'+ind,
    		    				'step_7_org_doc_document_'+ind,
    		    				'step_7_choice_trustee_rek_document_'+ind,
    		    				'step_7_info_5_document_detail_'+ind,
    		    				'step_7_info_5_document_detail_clone_'+ind,
    		    				'step_7_doc_name_document_'+ind
    		    			];
    		    			processDocumentDetails(idDocFamilyMember.document, array, 'step_7_yourself_trustee_doc_document_'+ind);
    		    			break;
    		    		}
    		    	}
    			}
    		});
    		$('select[step_7_identity=true]').each(function(){
    			var ind = this.id.substr('step_7_doc_name_document_'.length, this.id.length);
    			$('.step_7_choice_trustee_rek_document_' + ind).change(function(){
    				var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
    				if (this.checked){

    					if ($('[step_7_confirmed=true]').length == 0){
		    				$('select[step_7_identity=false]').each(function() {
		    						infDocumentWithoutGroupIndex = this.id.substr('step_7_doc_name_document_'.length, this.id.length);
		    						step_7_callWS_InfDocument(this.id, ind, step_7_InfDocumentWithoutGroup_callback, false);
							});
    					}
    					$('#step_7_doc_name_document_'+indClass).attr('step_7_confirmed', 'true');
    				}
    				else{
    					$('#step_7_doc_name_document_'+indClass).removeAttr('step_7_confirmed');
    					if ($('[step_7_confirmed=true]').length == 0)
    						$('[step_7_identity_ownerdoc=false]').hide();	//мб remove??
    				}
    			});
    		});
    	}
    	return idDocFamilyMember;
    }
    
    function step_7_callWS_InfDocument(ind, indIdentity, callback, async) {
    	var idOrg = getIdOrg();
    	var idDoc = getIdDoc(ind);
    	var person_index = getCheckedCloneIndex('step_7_is_set_people_true');
    	
		// Получение массива кодов документов удостоверяющих личность
			idenDocCodes = getIndenDocFromDic(); 
		if (indIdentity == -1){
	    	$('select[name=step_7_doc_name_document]').each(function(){
	    		//если это документ удостоверяющий личность
	    		if (isInArray($(this).val(), idenDocCodes)){  //для реалки должно быть ==
	    			var changeOneInd = this.id.substr('step_7_doc_name_document'.length, this.id.length);
	    			if ($('#step_7_choice_trustee_rek_document'+changeOneInd).attr("checked")){	//подтверждены реквизиты дока удостоверяющего личность
	    				indIdentity = this.id.substr('step_7_doc_name_document_'.length, this.id.length);
	    				return false;
	    			}
	    		}
	    	});
	    	if (indIdentity == -1){
	    		return false;
	    	}
		}
    	
    	var doNameId = 'step_7_doc_name_document_'+indIdentity;
    	var changeClass = 'step_7_choice_trustee_rek_document_' + indIdentity;
    	//ind = ind+'_'+codeSelectDocFromGroup;
    	var params = ['step_7_series_doc_document_'+indIdentity,'step_7_number_doc_document_'+indIdentity, 'step_7_org_doc_document_'+indIdentity, 'step_7_date_doc_document_'+indIdentity];
		var documentFL = getDocument(null, doNameId, changeClass, params);
		var fio = getFIO(['step_7_last_name_people_'+person_index, 'step_7_middle_name_people_' + person_index, 'step_7_first_name_people_' + person_index]);
		var identityFL = getIdentityFL(fio, 'step_7_birthday_people_'+person_index, documentFL);
    	
		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup":{"name":"Наименование","code":"Код организации"},"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, callback, async);
	}
    
    function step_7_InfDocument_callback(xmlHttpRequest, status, dataResponse) {
    	if (isResult([dataResponse, dataResponse.infDocument]))
    	{
    		infDocument = dataResponse.infDocument;
			step_7_infDocument_length = infDocument.document.length;
			step_7_proccessInfDocument(infDocument.document);
			return infDocument;
    	}
    	return null;
    }
    
    function step_7_InfDocumentWithoutGroup_callback(xmlHttpRequest, status, dataResponse) {
    	infDocumentWithoutGroup = null;
    	if (isResult([dataResponse])){
    		if (isResult([dataResponse.infDocument])){
    			infDocumentWithoutGroup = dataResponse.infDocument;
    			var array = [
 		    				'step_7_series_doc_document_'+ infDocumentWithoutGroupIndex,
 		    				'step_7_number_doc_document_'+infDocumentWithoutGroupIndex,
 		    				'step_7_date_doc_document_'+infDocumentWithoutGroupIndex,
 		    				'step_7_org_doc_document_'+infDocumentWithoutGroupIndex,
 		    				'step_7_choice_trustee_rek_document_'+infDocumentWithoutGroupIndex,
 		    				'step_7_info_5_document_detail_'+infDocumentWithoutGroupIndex,
 		    				'step_7_info_5_document_detail_clone_'+infDocumentWithoutGroupIndex,
 		    				'step_7_doc_name_document_'+infDocumentWithoutGroupIndex
 		    			];
 		    	processDocumentDetails(dataResponse.infDocument.document, array, 'step_7_yourself_trustee_doc_document_'+infDocumentWithoutGroupIndex);
    		}
    	}
    	return infDocumentWithoutGroup;
    }
    
    function step_7_InfUdPersonDocument_callback(xmlHttpRequest, status, dataResponse) {
    	if (isResult([dataResponse, dataResponse.idDocFamilyMember])){
    		idDocFamilyMemberUdPerson = dataResponse.idDocFamilyMember;
    		var k = 0;
			var doc = [];
    		for (var i=0; i<idDocFamilyMemberUdPerson.document.length; i++){
	    		if ($('#step_7_doc_name_group_' + codeSelectDocFromGroup).val() == idDocFamilyMemberUdPerson.document[i].code){  //для реалки должно быть ==
	    			doc[k++] = idDocFamilyMemberUdPerson.document[i];
	    			//step_7_proccessInfDocument(doc);
	    			//break;
	    		}
    		}
    		step_7_proccessInfDocument(doc);
    		return idDocFamilyMemberUdPerson;
    	}
    	return null;
    }
    
    function step_7_proccessInfDocument(document){
		var array = [
						'step_7_series_doc_group_'+codeSelectDocFromGroup,
						'step_7_number_doc_group_'+codeSelectDocFromGroup,
						'step_7_date_doc_group_'+codeSelectDocFromGroup,
						'step_7_org_doc_group_'+codeSelectDocFromGroup,
						'step_7_choice_trustee_rek_group_'+codeSelectDocFromGroup,
						'step_7_info_5_group_document_detail_'+codeSelectDocFromGroup,
						'step_7_info_5_group_document_detail_clone_'+codeSelectDocFromGroup,
						'step_7_doc_name_group_' +codeSelectDocFromGroup
					];
		processDocumentDetails(document, array, 'step_7_yourself_trustee_doc_group_'+codeSelectDocFromGroup);
    }
    

    function step_7_callWS_Documents() {
    	dataRequest = {"documents":{"doc":$('select#step_7_group_doc_name_'+indexOfGroup+ ' option:selected').val()}};
    	callWebS(ARTKMVurl, dataRequest, step_7_Documents_callback, true);
	}
    
    var codeSelectDocFromGroup;
    function step_7_Documents_callback(xmlHttpRequest, status, dataResponse) {
		documents = dataResponse.documents;	
		if (isResult([dataResponse, dataResponse.documents])){
			documents = dataResponse.documents;
			newCloneSpan('step_7_info_5_group_document_clone_'+indexOfGroup, documents.document.length, null);
			for (var i = 0; i < documents.document.length; i++){
				addOption(document.getElementById('step_7_doc_name_group_'+indexOfGroup+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
				//признак того, к какой группе относится
				$('#step_7_doc_name_group_'+indexOfGroup+'_'+i).attr('group', $('select#step_7_group_doc_name_'+indexOfGroup).attr("id"));
				$('.step_7_doc_true_group_'+indexOfGroup +'_'+ i).attr("class", 'step_7_doc_true_group_'+indexOfGroup);
				writeDocument(documents.document[i], 'step_7_doc_name_group_'+indexOfGroup+'_'+i);		//15_07_13 by KAVlex
			}
			$('.step_7_doc_true_group_'+indexOfGroup).change(function() {
				codeSelectDocFromGroup = getTreeId(this.id);
				tmpSplit = codeSelectDocFromGroup.split('_');
				var indClass = tmpSplit.shift();
				var blockClass = 'step_7_info_5_group_document_clone_'+ indClass;
				if (this.checked){
					$('.'+$(this).attr("class")).removeAttr("checked");
					this.checked = true;
					step_7_callWS_DocumentType();
					hideAllWithoutThis(blockClass, tmpSplit.pop());
					if (getCheckedCloneIndex('step_7_is_set_people_true') >= 0){
						if (isResult([idDocFamilyMember.document])){	//KAVlex 2014_01_27 в ответ на письмо О.Елизаровой от 24_01_14
							for (var l = 0; l < idDocFamilyMember.document.length; l++){
								var dc = idDocFamilyMember.document[l];
								if (dc.code == $('#step_7_doc_name_group_' + codeSelectDocFromGroup +" option:selected").val()){
									step_7_infDocument_length = 1;
									var d = []; d[0] = dc;
									step_7_proccessInfDocument(d);
									return dc;
								}
							}
						}
		    				if ($('#step_7_group_doc_name_'+indClass).val() == 'udPerson'){   //должно быть ==
		    					step_7_callWS_IdDocFamilyMember(getCheckedCloneIndex('step_7_is_set_people_true'), step_7_InfUdPersonDocument_callback);
		    				}
		    				else {
		    					step_7_callWS_InfDocument('step_7_doc_name_group_' + codeSelectDocFromGroup, -1, step_7_InfDocument_callback, true);
		    				}
					}
				}
				else{
					showAllWithoutDefault(blockClass);
					$('.step_7_info_5_group_document_detail_clone_'+codeSelectDocFromGroup).hide();
					setCheckBoxVisible('#step_7_yourself_trustee_doc_group_'+codeSelectDocFromGroup, false, false);
					setCheckBoxVisible('#step_7_in_SMEV_trustee_doc_group_'+codeSelectDocFromGroup, false, false);					
				}
				
			});	
			$('#step_7_add_group_doc_name_'+indexOfGroup).val('-');
			//[name="step_7_doc_name_document"]
			return documents;
		}
    }
	
    function openStep_8() {
		setDictionary("payment_type", "step_8_payment_type");
		$('#step_8_payment_type_block').hide();
		$('#step_8_is_postal_bank_fill_block').hide();
		$('.step_8_info_3_clone').hide();
		$('.step_8_info_4_clone').hide();
		
		var kladrArrayIdDeclarant = ['step_8_post_region', 'step_8_post_district', 'step_8_post_city', 'step_8_post_settlement', 'step_8_address_v'];
		loadKladr(kladrArrayIdDeclarant);	//пока(02_05_13) в сиу нет сервиса
		subservice = $('select#step_1_subservices option:selected').val();
		category = $('select#step_1_category option:selected').val();
		dataRequest = {"infAboutAvailService":{"subservice": subservice,"category":category}};
		callWebS(ARTKMVurl, dataRequest, step_8_InfAboutAvailService_callback,true);		
	}
    
    var step_8_is_recept_check = false;
    var legalRepresentativeFlag = false;
    var ownerFlag = false;
	function step_8_InfAboutAvailService_callback(xmlHttpRequest, status, dataResponse) {
		InfAboutAvailService = response.infAboutAvailService;
		
		if (isResult([InfAboutAvailService])){
			//var step_8_last_name_recept, step_8_first_name_recept, step_8_middle_name_recept, step_8_birthday_recept;
			array = [
						'step_8_last_name_recept',
						'step_8_first_name_recept',
						'step_8_middle_name_recept',
						'step_8_birthday_recept',
						'step_8_is_recept_true',
						'step_8_info_2_clone'
					];
			if (InfAboutAvailService.legalRepresentative === true && InfAboutAvailService.owner === false) {
				legalRepresentativeFlag = true;
				newCloneSpan('step_8_info_2_clone', 1, array);
				$('.step_8_info_2_clone').show().filter(':first').hide();
				$('#step_8_last_name_recept_0').val($('#step_2_last_name_legal_representative').val());
				$('#step_8_first_name_recept_0').val($('#step_2_first_name_legal_representative').val());
				$('#step_8_middle_name_recept_0').val($('#step_2_middle_name_legal_representative').val());
				$('#step_8_birthday_recept_0').val($('#step_2_birthday_legal_representative').val());
			}  
			if (InfAboutAvailService.legalRepresentative === false && InfAboutAvailService.owner === true) {
				ownerFlag = true;
				newCloneSpan('step_8_info_2_clone', 1, array);
				$('.step_8_info_2_clone').show().filter(':first').hide();				
				var fioBirthData = getFioBirthFromStep_4();
				$('#step_8_last_name_recept_0').val(fioBirthData[0]);
				$('#step_8_first_name_recept_0').val(fioBirthData[1]);
				$('#step_8_middle_name_recept_0').val(fioBirthData[2]);
				$('#step_8_birthday_recept_0').val(fioBirthData[3]);
			} 
			if (InfAboutAvailService.legalRepresentative === true && InfAboutAvailService.owner === true) {
				legalRepresentativeFlag = true;
				ownerFlag = true;
				newCloneSpan('step_8_info_2_clone', 2, array);
				$('fieldset.step_8_info_2').show().filter(':first').hide();
				$('#step_8_last_name_recept_0').val($('#step_2_last_name_legal_representative').val());
				$('#step_8_first_name_recept_0').val($('#step_2_first_name_legal_representative').val());
				$('#step_8_middle_name_recept_0').val($('#step_2_middle_name_legal_representative').val());
				$('#step_8_birthday_recept_0').val($('#step_2_birthday_legal_representative').val());
				if (!isInArray(2, Steps)){	//08.07.13	- вдруг небыло второго шага, вследствии ошибки заполнения реестра, то скрываем
					$('#step_8_info_2_clone_0').remove();
				}
				var fioBirthData = getFioBirthFromStep_4();
				$('#step_8_last_name_recept_1').val(fioBirthData[0]);
				$('#step_8_first_name_recept_1').val(fioBirthData[1]);
				$('#step_8_middle_name_recept_1').val(fioBirthData[2]);
				$('#step_8_birthday_recept_1').val(fioBirthData[3]);
			}
			step_8_is_recept_true_check();
			$('#step_8_is_postal_bank_fill').unbind('change');
			$('#step_8_is_postal_bank_fill').change(function(){
				if (this.checked) {
//					$('span.step_8_info_2_clone').hide();
					setDictionary("Banks", "step_8_bank_name");
					if (step_8_is_recept_check) {
						if ($('select#step_8_payment_type option:selected').val() ==  'post' ) {
							$('fieldset[id="step_8_info_5"]').show();
							$('fieldset[id="step_8_info_6"]').hide();
							step_8_calWS_AddressType();
						}
						if ($('select#step_8_payment_type option:selected').val() ==  'bank' ) {
							$('fieldset[id="step_8_info_5"]').hide();
							$('fieldset[id="step_8_info_6"]').show();
						}
					}
					
					if ($('select#step_8_payment_type option:selected').val() ==  '' ) {
						$('fieldset[id="step_8_info_5"]').hide();
						$('fieldset[id="step_8_info_6"]').hide();
					}
					$('span.step_8_info_3_clone').hide();
					$('span.step_8_info_4_clone').hide();
				} else {
					$('span.step_8_info_3_clone').hide();
					$('span.step_8_info_4_clone').hide();
					$('fieldset[id="step_8_info_5"]').hide();
					$('fieldset[id="step_8_info_6"]').hide();
					if (step_8_is_recept_check) {
						if ($('select#step_8_payment_type option:selected').val() !=  '' ) {
							step_8_calWS_Details();
						}
					}
					
				}
			});
			
			$('#step_8_payment_type').unbind('change');
			$('#step_8_payment_type').change(function(){
				if ($(this).val() ==  'post' ) {
					if (step_8_is_recept_check === true) {
						if ( $('#step_8_is_postal_bank_fill').is(':checked') ) {
							$('fieldset[id="step_8_info_5"]').show();
							$('fieldset[id="step_8_info_6"]').hide();
							$('span.step_8_info_3_clone').hide();
							$('span.step_8_info_4_clone').hide();
							step_8_calWS_AddressType();
						} else {
							$('span.step_8_info_2_clone').show().filter(':first').hide();
							step_8_calWS_Details();
							$('fieldset[id="step_8_info_5"]').hide();
							$('fieldset[id="step_8_info_6"]').hide();
						}
					}
				}
				if ($(this).val() ==  'bank' ) {
					if (step_8_is_recept_check === true) {
						if ( $('#step_8_is_postal_bank_fill').is(':checked') ) {
							$('fieldset[id="step_8_info_6"]').show();
							$('fieldset[id="step_8_info_5"]').hide();
							$('span.step_8_info_3_clone').hide();
							$('span.step_8_info_4_clone').hide();
							setDictionary("Banks", "step_8_bank_name");
						} else {
							$('span.step_8_info_2_clone').show().filter(':first').hide();
							step_8_calWS_Details();
							$('fieldset[id="step_8_info_5"]').hide();
							$('fieldset[id="step_8_info_6"]').hide();
						}
					}
				}
				if ($(this).val() ==  '' ) {
					$('fieldset[id="step_8_info_5"]').hide();
					$('fieldset[id="step_8_info_6"]').hide();
				}
			});
			
			$('.step_8_is_recept_true').unbind('change');
			$('.step_8_is_recept_true').change(function(){			
				if (this.checked) {
					$('.step_8_is_recept_true').removeAttr('checked');
					$('#step_8_is_postal_bank_fill').removeAttr('checked');
					this.checked = true;
					step_8_is_recept_check = true;
					if ($('select#step_8_payment_type option:selected').val() ==  'post' || $('select#step_8_payment_type option:selected').val() ==  'bank') {
						$('fieldset[id="step_8_info_5"]').hide();
						$('fieldset[id="step_8_info_6"]').hide();
						step_8_calWS_Details();
					}
					$('#step_8_payment_type_block').show();
					$('#step_8_is_postal_bank_fill_block').show();
				} else {
					step_8_is_recept_check = false;
					$('span.step_8_info_3_clone').hide();
					$('span.step_8_info_4_clone').hide();
					$('fieldset#step_8_info_5').hide();
					$('fieldset#step_8_info_6').hide();
					$('#step_8_is_postal_bank_fill').removeAttr('checked');
					$('#step_8_payment_type_block').hide();
					$('#step_8_is_postal_bank_fill_block').hide();
				}
			});
		} else {
			$('input[name="step_8_is_postal_bank_fill"]').attr('checked', 'checked');
			$('#step_8_payment_type').unbind('change');
			$('#step_8_payment_type').change(function(){
				if ($(this).val() ==  'post' ) {
					$('fieldset[id="step_8_info_5"]').show();
					$('fieldset[id="step_8_info_6"]').hide();
					step_8_calWS_AddressType();
				}
				if ($(this).val() ==  'bank' ) {
					$('fieldset[id="step_8_info_5"]').hide();
					$('fieldset[id="step_8_info_6"]').show();
				}
			});
		}
	}
	
	function step_8_bank_name_change(el) {
		setDictionary("bank_"+$('#step_8_bank_name option:selected').val(), "step_8_bank_subdivision");
	}
		
	function step_8_is_recept_true_check() {		
		$('.step_8_is_recept_true').each(function(){
			if (this.checked) {
				$('#step_8_is_postal_bank_fill').removeAttr('checked');
				$('fieldset[id="step_8_info_5"]').hide();
				$('fieldset[id="step_8_info_6"]').hide();
				step_8_is_recept_check = true;
			}
		});
		
		return step_8_is_recept_check;
	}

	
	function step_8_calWS_Details() {
		var person = getCheckedRadioValue("step_1_acting_person");	
		idOrg = getIdOrg();
		var typeOrganization = {"name":$('#step_8_payment_type option:selected').text(),"code":$('#step_8_payment_type').val()};
		var fioFL = new Object();;
		var dateOfBirthFL = new Object();
		var nameDocFL = new Object();;
		var codeDocFL = new Object();;
		var dateIssueDocFL = new Object();;
		var params = new Object();;
		if (person == 'self' && $('#step_4_is_identification_3').is(":checked")) {
			fioFL = {"surname":$('#step_4_last_name_declarant').val(),"patronymic":$('#step_4_middle_name_declarant').val(),"name":$('#step_4_first_name_declarant').val()};
			dateOfBirthFL = $('#step_4_birthday_declarant').val();
			nameDocFL = $('#step_4_doc_declarant_type option:selected').text();
			codeDocFL = $('#step_4_doc_declarant_type').val();
			dateIssueDocFL = $('#step_4_doc_declarant_date').val();
			params = {"param":[{"name":"Серия","code": DocumentSeries,"type":"Integer","value":$('#step_4_doc_declarant_series').val()},
			   					{"name":"Номер","code": DocumentsNumber,"type":"Integer","value":$('#step_4_doc_declarant_number').val()},
			   					{"name":"Кем выдан","code": GiveDocumentOrg,"type":"String","value":$('#step_4_doc_declarant_org').val()}]};
		}
		if (person == 'law') {
			if ($('#step_2_is_identification_1').is(':checked')) {
				fioFL = {"surname":$('#step_2_last_name_legal_representative').val(),"patronymic":$('#step_2_middle_name_legal_representative').val(),"name":$('#step_2_first_name_legal_representative').val()};
				dateOfBirthFL = $('#step_2_birthday_legal_representative').val();
				nameDocFL = $('#step_2_doc_legal_representative_type option:selected').text();
				codeDocFL = $('#step_2_doc_legal_representative_type').val();
				dateIssueDocFL = $('#step_2_doc_legal_representative_date').val();
				params = {"param":[{"name":"Серия","code":DocumentSeries,"type":"Integer","value":$('#step_2_doc_legal_representative_series').val()},
				   					{"name":"Номер","code":DocumentsNumber,"type":"Integer","value":$('#step_2_doc_legal_representative_number').val()},
				   					{"name":"Кем выдан","code":GiveDocumentOrg,"type":"String","value":$('#step_2_doc_legal_representative_org').val()}]};
			} else {
				fioFL = {"surname":$('#step_4_last_name_system_'+step_4_is_declarant_system_true_num).val(),"patronymic":$('#step_4_middle_name_system_'+step_4_is_declarant_system_true_num).val(),"name":$('#step_4_name_system_'+step_4_is_declarant_system_true_num).val()};
				dateOfBirthFL = $('#step_4_birth_date_system_'+step_4_is_declarant_system_true_num).val();
				var doc_num = getCheckedCloneIndex('step_4_is_doc_person_system_true');
				nameDocFL = $('#step_4_document_type_system_'+doc_num+'  option:selected').text();
				codeDocFL = $('#step_4_document_type_system_'+doc_num).val();
				dateIssueDocFL = $('#step_4_document_issue_date_system_'+doc_num).val();
				params = {"param":[{"name":"Серия","code":DocumentSeries,"type":"Integer","value":$('#step_4_document_series_system_'+doc_num).val()},
				   					{"name":"Номер","code":DocumentsNumber,"type":"Integer","value":$('#step_4_document_number_system_'+doc_num).val()},
				   					{"name":"Кем выдан","code":GiveDocumentOrg,"type":"String","value":$('#step_4_documen_org_system_'+doc_num).val()}]};
			}
		}
		
		
   		var group = {"name":"Наименование группы","code":"Код группы"};
   		var document = {"group":group,"name":nameDocFL,"code":codeDocFL,"dateIssue":dateIssueDocFL,"params":params};
		var identityFL = {"fio":fioFL, "dateOfBirth":dateOfBirthFL,"document":document};
		
		dataRequest =  {"details":{"idOrg":idOrg,"typeOrganization":typeOrganization,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_8_callWS_Details_callback, true);
	}
	
	function step_8_callWS_Details_callback(xmlHttpRequest, status, dataResponse) {
		details = null;
		if (isResult([dataResponse.details])){
			details = dataResponse.details;
			if (isResult([details.posts])){
				if ($('#step_8_payment_type').val() == 'post') {
					var step_8_info_3_details_posts_length = details.posts.post.length;
					array = [
							'step_8_postal_number_system',
							'step_8_postal_address_system',
							'step_8_is_post_true',
							'step_8_info_3_clone'
						];
					newCloneSpan('step_8_info_3_clone', step_8_info_3_details_posts_length, array);
					for (var i=0; i < step_8_info_3_details_posts_length; i++) {
						$('#step_8_postal_number_system_'+i).val(details.posts.post[i].postNumber);
						var address = details.posts.post[i].address;
						isStep_8_address(address, i);
					}
					
					$('span.step_8_info_4_clone').hide();
				}
			}else if ($('#step_8_payment_type').val() == 'post'){
				setCheckBox('#step_8_is_postal_bank_fill', true);
				//$('#step_8_is_postal_bank_fill').closest('span').hide();
				$('#step_8_is_postal_bank_fill').change();
			}
			
			
			if (isResult([details.banks])){
				if ($('#step_8_payment_type').val() == 'bank') {
					var step_8_info_3_details_banks_length = response.details.banks.bank.length;
					array = [
								'step_8_bank_name_system',
								'step_8_bank_subdivision_system',
								'step_8_bank_account_system',
								'step_8_is_bank_true',
								'step_8_info_4_clone'
							];
					newCloneSpan('step_8_info_4_clone', step_8_info_3_details_banks_length, array);
					for (i=0; i < step_8_info_3_details_banks_length; i++) {
						$('#step_8_bank_name_system_'+i).val(details.banks.bank[i].name);
						$('#step_8_bank_name_system_'+i).attr('title', 'БИК: '+details.banks.bank[i].bankIdentificationCode);
						$('#step_8_bank_name_system_'+i).attr('text', details.banks.bank[i].bankIdentificationCode);
						$('#step_8_bank_subdivision_system_'+i).val(details.banks.bank[i].subdivision);
						$('#step_8_bank_subdivision_system_'+i).attr('title', 'БИК: '+details.banks.bank[i].bankIdentificationCodeCH);
						$('#step_8_bank_subdivision_system_'+i).attr('text', details.banks.bank[i].bankIdentificationCodeCH);
						$('#step_8_bank_account_system_'+i).val(details.banks.bank[i].personalAccount);
					}
					$('span.step_8_info_3_clone').hide();
				}
			}else if ($('#step_8_payment_type').val() == 'bank'){
				setCheckBox('#step_8_is_postal_bank_fill', true);
				//$('#step_8_is_postal_bank_fill').closest('span').hide();
				$('#step_8_is_postal_bank_fill').change();
			}
			
			$('.step_8_is_post_true').unbind('change');
			$('.step_8_is_post_true').change(function(){
				var postBlockNum;
				if (this.checked){
					$('.step_8_is_post_true').removeAttr("checked", "checked");
					postBlockNum = this.id.split('_').pop();
					$('span.step_8_info_3_clone').hide().filter('span#step_8_info_3_clone_'+postBlockNum).show();
					this.checked = true;
					$('fieldset#step_8_info_5').hide();
					$('fieldset#step_8_info_6').hide();
					setCheckBoxVisible('#step_8_is_postal_bank_fill', true, false);
					step_8_is_recept_check = true;
					$('#step_8_is_postal_bank_fill_block').hide();
				} else {
					$('span.step_8_info_3_clone').show().filter('first').hide();
					step_8_is_recept_check = false;
					$('#step_8_is_postal_bank_fill_block').show();
				}
			});
			
			$('.step_8_is_bank_true').unbind('change');
			$('.step_8_is_bank_true').change(function(){
				var bankBlockNum;
				if (this.checked){
					$('.step_8_is_bank_true').removeAttr("checked", "checked");
					bankBlockNum = this.id.split('_').pop();
					$('span.step_8_info_4_clone').hide().filter('span#step_8_info_4_clone_'+bankBlockNum).show();
					this.checked = true;
					$('fieldset#step_8_info_5').hide();
					$('fieldset#step_8_info_6').hide();
					setCheckBoxVisible('#step_8_is_postal_bank_fill', true, false);
					step_8_is_recept_check = true;
					$('#step_8_is_postal_bank_fill_block').hide();
				} else {
					$('span.step_8_info_4_clone').show().filter('first').hide();
					step_8_is_recept_check = false;
					$('#step_8_is_postal_bank_fill_block').show();
				}
			});
			
		} else {	//by KAVlex 18_07_13
			setCheckBox('#step_8_is_postal_bank_fill', true);
			$('#step_8_is_postal_bank_fill').change();
		}
		return details;
	}
	
	function isStep_8_address(address,postNum) {
		if (address != null){
			$('#step_8_postal_address_system_'+postNum).val(addressToString(address));
		}
		else{
			$('#step_8_postal_address_system_'+postNum).val('');
		}
	}
	
	function step_8_calWS_AddressType() {
		$('#step_8_postal_address_2').closest('tr').hide();
		
		var subservice = getIdSubservice();
		var category = getIdCategory();
		dataRequest = {"addressType":{"subservice": subservice.code,"category": category.code}};
		callWebS(ARTKMVurl, dataRequest, step_8_calWS_AddressType_callback, true);
	}
	
	function step_8_calWS_AddressType_callback(xmlHttpRequest, status, dataResponse) {
		
		post_addresses = dataResponse.addressType;
		if (isResult([post_addresses, post_addresses.addressOfService])){
			var postAdressesList = document.getElementById('step_8_type_address_v');
			 clearSelect(postAdressesList);
			 addOption(postAdressesList, '- Выберите -', '', true, true);
			for (var i=0; i < post_addresses.addressOfService.length; i++){
				addOption(document.getElementById('step_8_type_address_v'), post_addresses.addressOfService[i].name, post_addresses.addressOfService[i].key, false, false);
			}
			
			$('#step_8_type_address_v').unbind('change');
			$('#step_8_type_address_v').change(function(){
				if ($('#step_8_type_address_v option:selected').text() == 'Адрес регистрации') { // В реалеке должно быть == 'адрес регистрации'
					if (legalRepresentativeFlag === true && ownerFlag === true) {
						var receptNum = getCheckedCloneIndex('step_8_is_recept_true');
						if (receptNum == 0) {
							step_8_post_address_fill_from_step_2();
						}
						if (receptNum == 1) {
							step_8_post_address_in_fill_self_block();
						}
					}
					if (legalRepresentativeFlag === true && ownerFlag === false) {
						step_8_post_address_fill_from_step_2();
					}
					if (legalRepresentativeFlag === false && ownerFlag === true) {
						step_8_post_address_in_fill_self_block();
					}
					
					$('#step_8_postal_address_2').closest('tr').show();
					$('#step_8_postal_data_table').hide();
				} else {
					$('#step_8_postal_address_2').closest('tr').hide();
					$('#step_8_postal_data_table').show();
				}
			});
		}
		
	}
	
	function step_8_post_address_in_fill_self_block() {
		if ($('fieldset#step_4_info_4').css('display') != 'none') {
			var fieldArray  = 
				[
				 	'step_4_address_declarant_region',
				 	'step_4_address_declarant_district',
				 	'step_4_address_declarant_city',
				 	'step_4_address_declarant_settlement',
				 	'step_4_address_declarant_street',
				 	'step_4_address_declarant_house',
				 	'step_4_address_declarant_body',
				 	'step_4_address_declarant_build',
				 	'step_4_address_declarant_flat',
				 	'step_4_address_declarant_room'
				];
			address = addressToString(getAddressFromFields(fieldArray));	
			$('#step_8_postal_address_2').val(address);
		}
		if ( $('#step_4_set_registration_address_system').is(':checked')) {
			if ($('table#step_4_address_person_table').css('display') != 'none') {
				$('#step_8_postal_address_2').val('с 4 шага step_4_address_person_region и пр.');
			} else {
				$('#step_8_postal_address_2').val($('#step_4_registration_address_system').val());
			} 
		} else {
			if ($('fieldset#step_4_info_7').css('display') != 'none') {
				
				var fieldArray  = 	[
					 	'step_4_address_person_region',
					 	'step_4_address_person_district',
					 	'step_4_address_person_city',
					 	'step_4_address_person_settlement',
					 	'step_4_address_person_street',
					 	'step_4_house_person',
					 	'step_4_housing_person',
					 	'step_4_building_person',
					 	'step_4_flat_person',
					 	'step_4_room_person'
					];
				address = addressToString(getAddressFromFields2(fieldArray));	
				$('#step_8_postal_address_2').val(address);

			}
		}

		if ($('fieldset#step_4_info_10').css('display') != 'none') {
			var fieldArray  = 	[
								 	'step_4_new_region',
								 	'step_4_new_district',
								 	'step_4_new_town',
								 	'step_4_new_locality',
								 	'step_4_new_street',
								 	'step_4_house_person_new',
								 	'step_4_housing_person_new',
								 	'step_4_building_person_new',
								 	'step_4_flat_person_new',
								 	'step_4_room_person_new'
								];
			address = addressToString(getAddressFromFields2(fieldArray));	
			$('#step_8_postal_address_2').val(address);
		}
	}
	
	function step_8_post_address_fill_from_step_2() {
		var fieldArray = 
			[
			 	'step_2_address_legal_representative_region',
			 	'step_2_address_legal_representative_f_district',
			 	'step_2_address_legal_representative_city',
			 	'step_2_address_legal_representative_settlement',
			 	'step_2_address_legal_representative_street',
			 	'step_2_address_legal_representative_house',
			 	'step_2_address_legal_representative_body',
			 	'step_2_address_legal_representative_build',
			 	'step_2_address_legal_representative_flat',
			 	'step_2_address_legal_representative_room'
			];
		address = addressToString(getAddressFromFields(fieldArray));	
		$('#step_8_postal_address_2').val(address);
	}
	

	function openStep_9() {
	    setDictionary("Banks", "step_9_bank_name");
	    $('#step_9_last_name_recept').val($('#step_5_last_name_declarant').val());
	    $('#step_9_first_name_recept').val($('#step_5_first_name_declarant').val());
	    $('#step_9_middle_name_recept').val($('#step_5_middle_name_declarant').val());
	    $('#step_9_birthday_recept').val($('#step_5_birthday_declarant').val());

	    function step_9_callWS_ExistingBankDetails() {
	        dataRequest = {
	            "details": {
	                "idOrg": {
	                    "name": "" + $('#step_1_social_institution option:selected').text() + "",
	                    "code": "" + $('#step_1_social_institution option:selected').val() + ""
	                },
	                "typeOrganization": {
	                    "name": "" + $('#step_9_payment_type option:selected').text() + "",
	                    "code": "" + $('#step_9_payment_type option:selected').val() + ""
	                },
	                "identityIP": {
	                    "fio": {
	                        "surname": "" + $('#step_9_last_name_recept').val() + "",
	                        "patronymic": "" + $('#step_9_middle_name_recept').val() + "",
	                        "name": "" + $('#step_9_first_name_recept').val() + ""
	                    },
	                    "dateOfBirth": "" + $('#step_9_birthday_recept').val() + "",
	                    "inn": "" + $('#step_5_INN').val() + "",
	                    "ogrnip": "" + $('#step_5_OGRNIP').val() + ""
	                }
	            }
	        };

	        callWebS(VISurl, dataRequest, step_9_callWS_ExistingBankDetails_callback, true);
	    }
	    step_9_callWS_ExistingBankDetails();
	}

	function step_9_callWS_ExistingBankDetails_callback(xmlHttpRequest, status, dataResponse) {
	    response = JSON.parse(xmlHttpRequest.responseText);
	    var count = 0;
	    if (isResult([response])) {
	        if (isResult([response.details])) {
	            if (isResult([response.details.banks])) {
	                count = response.details.banks.bank.length;
	            }
	        }
	    }
	    if (count > 0) {
	        $(".step_9_clone_block_1:not(:first)").remove();
	        $("#step_9_is_postal_bank_fill").attr("checked", false);
	        for (var i = 0; i < count; i++) {
	            $(".step_9_clone_block_1:last").after($(".step_9_clone_block_1:first").clone());
	            $(".step_9_clone_block_1:last input").each(function () {
	                $(this).attr("id", $(this).attr("name") + "_" + i);
	            });
	            $("#step_9_bank_name_system_" + i).val(response.details.banks.bank[i].name);
	            $("#step_9_bank_name_system_" + i).text(response.details.banks.bank[i].bankIdentificationCode);
	            $("#step_9_bank_subdivision_system_" + i).val(response.details.banks.bank[i].subdivision);
	            $("#step_9_bank_subdivision_system_" + i).text(response.details.banks.bank[i].bankIdentificationCodeCH);
	            $("#step_9_bank_account_system_" + i).val(response.details.banks.bank[i].personalAccount);
	        }
	        $(".step_9_clone_block_1").show();
	        $(".step_9_clone_block_1:first").hide();
	        $("#step_9_info_3").show();

	        if ($(".step_9_clone_block_1:visible").length == 1) {
	            $('input[name="step_9_is_bank_true"]:last').attr("checked", true);
	            $("#step_9_is_postal_bank_fill").attr("checked", false);
	        }
	    } else {
	        $("#step_9_info_4").show();
	        $("#step_9_is_postal_bank_fill").attr("checked", true);
	    }
	}

	$('input[name="step_9_is_bank_true"]').live("click", function () {
	    $("#step_9_is_postal_bank_fill").attr("checked", false);
	    $("#step_9_info_4").hide();
	    if ($(this).attr("checked")) {
	        $('input[name="step_9_is_bank_true"]').attr("checked", false);
	        $('.step_9_clone_block_1').hide();
	        $(this).attr("checked", true);
	        $(this).closest('.step_9_clone_block_1').show();
	    } else {
	        $('.step_9_clone_block_1:first').nextAll('.step_9_clone_block_1').show();
	    }
	    if ($('input[name="step_9_is_bank_true"]:checked').length > 0) {
	        $("#step_9_is_postal_bank_fill_block").hide();
	    } else {
	        $("#step_9_is_postal_bank_fill_block").show();
	    }
	});

	$("#step_9_is_postal_bank_fill").live("click", function () {
	    $('input[name="step_9_is_bank_true"]').attr("checked", false);
	});

	$("#step_9_bank_name").live("change", function () {
	    setDictionary("bank_" + $("#step_9_bank_name option:selected").val(), "step_9_bank_subdivision");
	});
	
	function openStep_10() {
		setDictionary("Banks", "step_10_bank_name");
		$('#step_10_full_name_org_akcept').val( $('#step_6_full_name_org').val() );
		step_10_callWS_Details();
	}
	
	function step_10_bank_name_change(el) {
		setDictionary("bank_"+$('#step_10_bank_name option:selected').val(), "step_10_bank_subdivision");
	}
	
	function step_10_callWS_Details() {
		idOrg = getIdOrg();
		var identityUL,typeOrganization, name, inn, ogrn, kpp;
		name = $('#step_6_full_name_org').val();
		inn = $('#step_6_juridical_inn').val();
		ogrn = $('#step_6_juridical_ogrn').val();
		kpp = $('#step_6_juridical_kpp').val();
		typeOrganization = {"name":$('#step_10_payment_type option:selected').text(),"code":$('#step_10_payment_type').val()};
		identityUL = {"name":name,"inn":inn,"ogrn":ogrn,"kpp":kpp};
		dataRequest = {"details":{"idOrg":idOrg,"typeOrganization":typeOrganization,"identityUL":identityUL}};
		callWebS(VISurl, dataRequest, step_10_callWS_Details_callback, true);
	}
	
	function step_10_callWS_Details_callback(xmlHttpRequest, status, dataResponse) {
		var details = dataResponse.details;
		if (isResult([details]) && isResult([details.banks])){
			var step_10_info_3_details_banks_length = details.banks.bank.length;
			array = [
					'step_10_bank_name_system',
					'step_10_bank_subdivision_system',
					'step_10_bank_account_system',
					'step_10_number_cor_account',
					'step_10_bik',
					'step_10_is_bank_true',
					'step_10_info_3_clone'
				];
			newCloneSpan('step_10_info_3_clone', step_10_info_3_details_banks_length, array);
			for (var i=0; i < step_10_info_3_details_banks_length; i++) {
				$('#step_10_bank_name_system_'+i).val(details.banks.bank[i].name);
				$('#step_10_bank_name_system_'+i).text(details.banks.bank[i].bankIdentificationCode);
				$('#step_10_bank_subdivision_system_'+i).val(details.banks.bank[i].subdivision);
				$('#step_10_bank_subdivision_system_'+i).text(details.banks.bank[i].bankIdentificationCodeCH);	//30_07_13 by KAVlex
				$('#step_10_bank_account_system_'+i).val(details.banks.bank[i].personalAccount);
				$('#step_10_number_cor_account_'+i).val(details.banks.bank[i].correspondingAccount);
				$('#step_10_bik_'+i).val(details.banks.bank[i].bankIdentificationCode);
			}
			
			$('span#step_10_info_3_clone').show();
			
			$('.step_10_is_bank_true').change(function(){
				if (this.checked){
					$('.step_10_is_bank_true').removeAttr("checked", "checked");
					this.checked = true;
					$('fieldset#step_10_info_4').hide();
					setCheckBoxVisible('#step_10_is_postal_bank_fill', true, false);
				}
			});	
		} else {
			$('fieldset#step_10_info_4').show();
			setCheckBoxVisible('#step_10_is_postal_bank_fill', true, true);
		}
	}
	
//	step_11_address; //для построения xml
	function openStep_11() {
    	step_11_address = new Object();
		step_11_callWS_AddressType();
		$('#step_11_info_2').hide();
		$('#step_11_info_3').hide();
		setCheckBoxVisible('#step_11_add_address', false, false);
		$('#step_11_add_address').unbind('change');
		$('#step_11_add_address').change(function() {
			if (this.checked) {
				$('#step_11_info_4').show();		
			}
			else{
				$('#step_11_info_4').hide();
			}
		});
		$('#step_11_add_address').change();
		$('#step_11_info_3').hide();
		var kladrArrayId11 = ['step_11_address_pu_region','step_11_address_pu_raion','step_11_address_pu_city','step_11_address_pu_village','step_11_address_pu_street'];
		loadKladr(kladrArrayId11);
		//
		$('#step_11_render_address_type_system').unbind('change');
		$('#step_11_render_address_type_system').change(function() {
    		step_11_address = new Object();
		    var selObj = $('#step_11_render_address_type_system option:selected');
			if (selObj.val() == ""){      //!isResult([selObj.val()])   17_08_13
				$('#step_11_info_2').hide();
				$('#step_11_info_3').hide();
				setCheckBoxVisible('#step_11_add_address', false, false);
				$('#step_11_add_address').change();
				return false;
			}
			var typeOfPerson = $('#step_1_category_person_self option:selected').val();
			if ((getCheckedRadioValue('step_1_acting_person') == "self")&&((selObj.text() == 'Адрес регистрации')||(selObj.text() == 'Адрес фактического проживания'))){
				$('#step_11_info_2').show();
				var address = '';
				if (typeOfPerson == 'phys'){
					var fieldArray = 
						[
						 	'step_4_address_declarant_region',
						 	'step_4_address_declarant_district',
						 	'step_4_address_declarant_city',
						 	'step_4_address_declarant_settlement',
						 	'step_4_address_declarant_street',
						 	'step_4_address_declarant_house',
						 	'step_4_address_declarant_body',
						 	'step_4_address_declarant_build',
						 	'step_4_address_declarant_flat',
						 	'step_4_address_declarant_room',
						 	'step_4_address_declarant_postal'
						];
					step_11_address = getAddressFromFields(fieldArray);	
					address = addressToString(step_11_address);
				}
				else if (typeOfPerson == 'juri'){
					address = $('#step_6_legal_address_org').val();
					step_11_address.region = new Object();
					step_11_address.region.name = address;
				}
				else if (typeOfPerson == 'ip'){
					var fieldArray = 
						[
						 	'step_5_address_declarant_region',
						 	'step_5_address_declarant_district',
						 	'step_5_address_declarant_city',
						 	'step_5_address_declarant_settlement',
						 	'step_5_address_declarant_street',
						 	'step_5_address_declarant_house',
						 	'step_5_address_declarant_body',
						 	'step_5_address_declarant_build',
						 	'step_5_address_declarant_flat',
						 	'step_5_address_declarant_room',
						 	'step_5_address_declarant_postal'
						];
					step_11_address = getAddressFromFields(fieldArray);	
					address = addressToString(step_11_address);
				}
				$('#step_11_render_address_system').val(address);
				$('#step_11_info_3').hide();
				$('step_11_add_address').hide();
				setCheckBoxVisible('#step_11_add_address', false, false);
				$('#step_11_add_address').change();
			}
			else{
				$('#step_11_info_2').hide();
				$('#step_11_info_3').show();
				$('step_11_add_address').show();
				step_11_callWS_AddressServiceProvision(typeOfPerson);
			}
		});
	}
	
	function step_11_callWS_AddressType() {
		dataRequest = {"addressType":{"subservice": getIdSubservice().code,"category": getIdCategory().code}};
		callWebS(ARTKMVurl, dataRequest, step_11_AddressType_callback, true);
	}
	
	function step_11_AddressType_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse, dataResponse.addressType])){
			addressType = dataResponse.addressType;
			clearSelect(document.getElementById('step_11_render_address_type_system'));
			if (addressType.addressOfService.length > 1){
				addOption(document.getElementById('step_11_render_address_type_system'), '--Выберите значение--', '', true, true);
				for(ind in addressType.addressOfService){
					addOption(document.getElementById('step_11_render_address_type_system'), addressType.addressOfService[ind].name, addressType.addressOfService[ind].key, false, false);
				}
			}
			else{
				var ind = 0;
				addOption(document.getElementById('step_11_render_address_type_system'), addressType.addressOfService[ind].name, addressType.addressOfService[ind].key, false, false);
				$('#step_11_render_address_type_system').change();
			}
			return addressType; 
		}
		return null;
	}
	
	function step_11_callWS_AddressServiceProvision(typeOfPerson){
		var idOrg = getIdOrg();
		if (!isResult([$('#step_11_render_address_type_system').val()]))
			return false;
		var typeAddress = {"name": $('#step_11_render_address_type_system').text(), "code":$('#step_11_render_address_type_system').val()};
		var identityFL = getIdentityFLFromStep_4();
		var identityIP = getIdentityIPFromStep_5();
		var identityUL = getIdentityULFromStep_6();
		if (typeOfPerson == 'phys'){
			dataRequest = {"addressServiceProvision":{"idOrg":idOrg,"typeAddress":typeAddress,"identityFL": identityFL}};	
		}
		else if(typeOfPerson == 'juri'){
			dataRequest = {"addressServiceProvision":{"idOrg":idOrg,"typeAddress":typeAddress,"identityUL": identityUL}};
		}
		else if(typeOfPerson == 'ip'){
			dataRequest = {"addressServiceProvision":{"idOrg":idOrg,"typeAddress":typeAddress,"identityIP": identityIP}};
		}
		callWebS(VISurl, dataRequest, step_11_AddressServiceProvision_callback, true);
	}
	
	function step_11_AddressServiceProvision_callback(xmlHttpRequest, status, dataResponse){
		addressServiceProvision = null;
		if (isResult([dataResponse, dataResponse.addressServiceProvision])){
			addressServiceProvision = dataResponse.addressServiceProvision;
			var step_11_info_3_array = ['step_11_render_address_system_1', 'step_11_is_render_address_true_1'];
			newCloneSpan('step_11_info_3_clone', addressServiceProvision.address.length, step_11_info_3_array);
			$('#step_11_info_3').show();
			for (key in addressServiceProvision.address){
				$('#step_11_render_address_system_1_' + key).val(addressToString(addressServiceProvision.address[key]));
			}
			setCheckBoxVisible('#step_11_add_address', true, false);
			$('#step_11_add_address').change();
			$('.step_11_is_render_address_true_1').change(function() {
				if (this.checked){
					$('.step_11_is_render_address_true_1').removeAttr('checked');
					hideAllWithoutThis('step_11_info_3_clone', this.id.split('_').pop());
					this.checked = true;
					setCheckBoxVisible('#step_11_add_address', false, false);
					$('#step_11_info_4').hide();
				}
				else{
					showAllWithoutDefault('step_11_info_3_clone');
					setCheckBoxVisible('#step_11_add_address', true, false);
					$('#step_11_add_address').change();
				}
			});
		}
		else{
			setCheckBoxVisible('#step_11_add_address', true, true);
			$('#step_11_add_address').change();
			$('#step_11_add_address').hide();	//12_07_13
			$('#step_11_add_address_label').hide();	//12_07_13
			$('#step_11_info_3').hide();
		}
		return addressServiceProvision;
	}
		
	var step_12_udPerson_flag = false;
	var step_12_udPerson_flags = new Object();
	function openStep_12() {
		switchStateDateTimePicker(false);

		$('.step_12_info_6_all_docs_clone').hide();
		$('fieldset#step_12_info_6').hide();
		step_12_info_5_6_all_info_default = $('span.step_12_info_5_6_all_info_clone').html();
		// клонируем блок для ручного ввода данных, для корректной работы логики по запросу документов.
		array = [
					'step_12_last_name_family_member_mf',
					'step_12_first_name_family_member_mf',
					'step_12_middle_name_family_member_mf',
					'step_12_birthday_family_member_mf',
					'step_12_info_5',
					'step_12_info_6_all_docs_clone'
				];
		switchStateDateTimePicker(false);
		newCloneSpan('step_12_info_5_clone', 1, array);
		
		step_12_callWS_FamilyMembers();
		step_12_callWS_GroupOfDocuments();
		switchStateDateTimePicker(true);
	}
	
	function step_12_callWS_FamilyMembers() {
		idOrg = getIdOrg();
		identityFL = getIdentityFLFromStep_4();
		dataRequest = {"familyMembers":{"idOrg":idOrg,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_12_callWS_FamilyMembers_callback, true);
	}
	
	var step_12_chkFamilyMember;
	function step_12_callWS_FamilyMembers_callback(xmlHttpRequest, status, dataResponse) {
		familyMembers = null;
		if (isResult([dataResponse.familyMembers]) && dataResponse.familyMembers.familyMember.length > 0) {
			familyMembers = dataResponse.familyMembers;
			$('fieldset[id="step_12_info_2[]"]').show();
			$('fieldset[id="step_12_info_3[]"]').show();
			step_12_info_2_familyMembers_length = familyMembers.familyMember.length;
			array = [
				'step_12_last_name_declarant_mf',
				'step_12_first_name_declarant_mf',
				'step_12_middle_name_declarant_mf',
				'step_12_birthday_declarant_mf',
				'step_12_set_family_member_mf',
				'step_12_info_2',
				'step_12_info_3_all_docs_clone'
			];
			newCloneSpan('step_12_info_2_clone', step_12_info_2_familyMembers_length, array);
			for (var i = 0; i < step_12_info_2_familyMembers_length; i++) {
				$('#step_12_last_name_declarant_mf_' + i).val(familyMembers.familyMember[i].fio.surname);
				$('#step_12_first_name_declarant_mf_' + i).val(familyMembers.familyMember[i].fio.name);
				$('#step_12_middle_name_declarant_mf_' + i).val(familyMembers.familyMember[i].fio.patronymic);
				$('#step_12_birthday_declarant_mf_' + i).val(familyMembers.familyMember[i].dateOfBirth);
			}
			
			// при Выборе члена семьи
			$('.step_12_set_family_member_mf').click(function(){
				var id = $(this).attr('id');
				var idParts = id.split('_');
				var idNum = idParts.pop();  // вычисляется номер блока, где выбран член семьи
				step_12_chkFamilyMember = idNum;
				if (this.checked){  
					step_12_callWS_idDocFamilyMember(idNum, step_12_callWS_idDocFamilyMember_callback);
					if (typeof step_12_all_docs_default != 'undefined') {
						$('#step_12_info_3_all_docs_clone_'+idNum).html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_12_all_docs_default+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
					}
					// данный блок кода необходим для переноса аттрибута checked 
					// всех чекбоксов из дефолтного блока в выбранный пользователем
						$('fieldset.step_12_info_3').each(function(){      
								if (isNotUndefined($(this).attr('class')) && $(this).attr('class').indexOf('step_12_info_3_document_') == 0 && $(this).attr('class').indexOf('detail') == -1) {
									$('.'+$(this).attr('class')+ ' input[name="step_12_doc_declarant_bring_himself_mf_document"]').each(function(){
										$('#step_12_info_3_all_docs_clone_'+idNum+' fieldset  input[class="'+$(this).attr('class')+'"]').attr('checked','checked');
									});
									$('.'+$(this).attr('class')+ ' input[name="step_12_in_SMEV_trustee_doc_document"]').each(function(){
										$('#step_12_info_3_all_docs_clone_'+idNum+' fieldset  input[class="'+$(this).attr('class')+'"]').attr('checked','checked');
									});
								}								  
						});
					
					//	Всем элементам  принадлежащим одиночным документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
						setCheckNIdAndClass('#step_12_info_3_all_docs_clone_'+idNum+' span.step_12_info_3_document_clone', idNum); 
						// Всем элементам  принадлежащим группе документов документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
						setCheckNIdAndClass('#step_12_info_3_all_docs_clone_'+idNum+' span.step_12_info_3_group_clone', idNum); 
					$('#step_12_info_3_all_docs_clone_'+idNum).show();
					$('fieldset[id="step_12_info_5_6"]').hide();
					$('#step_12_add_family_member_mf').removeAttr('checked');
				} else {
					$('#step_12_info_3_all_docs_clone_'+idNum).hide();
					$('span#step_12_add_family_member_mf_chk').show();
					$('fieldset[id="step_12_info_5_6"]').hide();
					$('input[name="step_12_add_family_member_mf"]').show();
					$('span[id="step_12_add_family_member_mf_label"]').show();
				}
			});
			$('fieldset[id="step_12_info_5_6"]').hide();
			$('span#step_12_add_family_member_mf_chk').hide();
			$('span#step_12_add_family_member_mf_chk').show();
			$('fieldset[id="step_12_info_3[]"]').hide();
		} else {
			$('fieldset[class="step_12_info_2"]').hide();
			$('fieldset[id="step_12_info_5_6"]').show();
			$('#step_12_add_family_member_mf').attr('checked', 'checked');
			$('span#step_12_add_family_member_mf_chk').hide();
		}
		return familyMembers;
	}
	
	function step_12_callWS_idDocFamilyMember(index, callback) {
		var idOrg = getIdOrg();
		var relative = getRelative(['step_12_last_name_declarant_mf', 'step_12_middle_name_declarant_mf', 'step_12_first_name_declarant_mf', 'step_12_birthday_declarant_mf'], '_'+index);
		var identityFL = getIdentityFLFromStep_4();
		dataRequest = {"idDocFamilyMember":{"idOrg":idOrg,"relative":relative,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, callback, true);
    }
    
	
	var step_12_infDocumentWithoutGroupIndex = -1;
	function step_12_callWS_idDocFamilyMember_callback(xmlHttpRequest, status, dataResponse) {
		idDocFamilyMember = null;
		var idNum = step_12_chkFamilyMember;
		if (isResult([dataResponse]) ) {
			if (dataResponse.idDocFamilyMember.document.length > 0) {
				idDocFamilyMember = dataResponse.idDocFamilyMember;
				$('#step_12_info_3_all_docs_clone_'+idNum+' .step_12_info_3_document_clone').each(function(j){
					for (var i = 0; i < idDocFamilyMember.document.length; i++) {
						if ( $('#step_12_name_doc_declarant_mf_document_'+idNum+'_'+j+' option:selected').val() == idDocFamilyMember.document[i].code) {
							$('#step_12_doc_declarant_date_mf_document_'+idNum+'_'+j).val(idDocFamilyMember.document[i].dateIssue);
							$('span.step_12_info_3_document_detail_clone_'+idNum+'_'+j).show();
							var array = [
	    		    				'step_12_doc_declarant_series_mf_document_'+idNum+'_'+j,
	    		    				'step_12_doc_declarant_number_mf_document_'+idNum+'_'+j,
	    		    				'step_12_doc_declarant_date_mf_document_'+idNum+'_'+j,
	    		    				'step_12_doc_declarant_who_issued_mf_document_'+idNum+'_'+j,
	    		    				'step_12_doc_declarant_set_identity_doc_mf_document_'+idNum+'_'+j,
	    		    				'step_12_info_3_document_detail_'+idNum+'_'+j,
	    		    				'step_12_info_3_document_detail_clone_'+idNum+'_'+j,
	    		    				'step_12_name_doc_declarant_mf_document_'+idNum+'_'+j
	    		    			];
							processDocumentDetails(idDocFamilyMember.document, array, 'step_12_doc_declarant_set_identity_doc_mf_document_'+idNum+'_'+j);
							break;
						}
					}
				});
				
				$('select[step_12_identity=true]').each(function(){
					if ( this.id.indexOf('step_12_name_doc_declarant_mf_document_'+idNum == 0) ) {
		    			var ind = this.id.substr('step_12_name_doc_declarant_mf_document_'.length, this.id.length);
		    			$('.step_12_doc_declarant_set_identity_doc_mf_document_' + ind).change(function(){
		    				var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
		    				if (this.checked){
		    					$('#step_12_name_doc_declarant_mf_document_'+indClass).attr('step_12_confirmed', 'true');
		    					step_12_udPerson_flags[idNum] = true;
		    					if ($('[step_12_confirmed=true]').length == 0){
				    				$('select[step_12_identity=false]').each(function() {
				    					step_12_infDocumentWithoutGroupIndex = this.id.substr('step_12_name_doc_declarant_mf_document_'.length, this.id.length);
				    					step_12_callWS_InfDocument(this.id, ind, step_12_InfDocumentWithoutGroup_callback, false);
									});
		    					}
		    				} else {
		    					step_12_udPerson_flags[idNum] = false;
		    					$('#step_12_name_doc_declarant_mf_document_'+indClass).removeAttr('step_12_confirmed');
		    					if ($('[step_12_confirmed=true]').length == 0)
		    						$('[step_12_identity_ownerdoc=false]').hide();	//мб remove??
		    				}
		    			});
					}
	    		});
			}
		}
		return idDocFamilyMember;
	}
	
	
	function step_12_callWS_InfDocument(ind, indIdentity, callback, async) {
		var indClass = ind.split("step_12_name_doc_declarant_mf_document_").pop();
	    	var idOrg = getIdOrg();
	    	var idDoc = getIdDoc(ind);
	    	var person_index = indClass.split('_').shift();
		var documentFL;
		if (typeof indIdentity != 'object'){
			// Получение массива кодов документов удостоверяющих личность
			idenDocCodes = getIndenDocFromDic(); 
			if (indIdentity == -1){
			    	$('select[name=step_12_name_doc_declarant_mf_document]').each(function(){
			    		//если это документ удостоверяющий личность
			    		if (isInArray($(this).val(), idenDocCodes)){  //для реалки должно быть ==
			    			var changeOneInd = this.id.substr('step_12_name_doc_declarant_mf_document'.length, this.id.length);
			    			if ($('#step_12_doc_declarant_set_identity_doc_mf_document_'+changeOneInd).attr("checked")){	//подтверждены реквизиты дока удостоверяющего личность

			    				step_12_udPerson_flags[person_index] = true;
			    				indIdentity = this.id.substr('step_12_name_doc_declarant_mf_document_'.length, this.id.length);
			    				return false;
			    			}
			    		}
			    	});
			    	if (indIdentity = -1){
			    		return false;
			    	}
			}
	    	
		    	var doNameId = 'step_12_name_doc_declarant_mf_document_'+indIdentity;
		    	var changeClass = 'step_12_doc_declarant_set_identity_doc_mf_document_' + indIdentity;
		    	var params = ['step_12_doc_declarant_series_mf_document_'+indIdentity,'step_12_doc_declarant_number_mf_document_'+indIdentity, 'step_12_doc_declarant_who_issued_mf_document_'+indIdentity, 'step_12_doc_declarant_date_mf_document_'+indIdentity];
			documentFL = getDocument(null, doNameId, changeClass, params);
		}else{
			documentFL = indIdentity;
		}

		var fio = getFIO(['step_12_last_name_declarant_mf_'+person_index, 'step_12_middle_name_declarant_mf_' + person_index, 'step_12_first_name_declarant_mf_' + person_index]);
		var identityFL = getIdentityFL(fio, 'step_12_birthday_declarant_mf_'+person_index, documentFL);
		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup":{"name":"Наименование","code":"Код организации"},"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, callback, async);
	}
	
	function step_12_InfDocumentWithoutGroup_callback(xmlHttpRequest, status, dataResponse) {
    	infDocumentWithoutGroup = null;
    	if (isResult([dataResponse])){
    		if (isResult([dataResponse.infDocument])){
    			infDocumentWithoutGroup = dataResponse.infDocument;
    			var array = [
 		    				'step_12_doc_declarant_series_mf_document_'+ step_12_infDocumentWithoutGroupIndex,
 		    				'step_12_doc_declarant_number_mf_document_'+step_12_infDocumentWithoutGroupIndex,
 		    				'step_12_doc_declarant_date_mf_document_'+step_12_infDocumentWithoutGroupIndex,
 		    				'step_12_doc_declarant_who_issued_mf_document_'+step_12_infDocumentWithoutGroupIndex,
 		    				'step_12_doc_declarant_set_identity_doc_mf_document_'+step_12_infDocumentWithoutGroupIndex,
 		    				'step_7_info_5_document_detail_'+step_12_infDocumentWithoutGroupIndex,
 		    				'step_12_info_3_document_detail_clone_'+step_12_infDocumentWithoutGroupIndex,
 		    				'step_12_name_doc_declarant_mf_document_'+step_12_infDocumentWithoutGroupIndex
 		    			];
 		    	processDocumentDetails(dataResponse.infDocument.document, array, 'step_12_doc_declarant_bring_himself_mf_document_'+step_12_infDocumentWithoutGroupIndex);
    		}
    	}
    	return infDocumentWithoutGroup;
    }
	
	
	 function step_12_doc_declarant_set_identity_doc_mf_document(el) {
    		var ind;
	    	//var step_12_self_flag;
		var idNum = step_12_chkFamilyMember;
	    	ind = $(el).attr('class').split('step_12_doc_declarant_set_identity_doc_mf_document_').pop();
		var indClass = $(el).attr('class').substr($(el).attr('name').length + 1, $(el).attr('class').length);
	    	if ($('#step_12_doc_declarant_bring_himself_mf_document_'+ind).is(':checked')) {
	    		$('#step_12_doc_declarant_bring_himself_mf_document_'+ind).attr('step_12_self', 'true');
		}
	    	if ($(el).is(':checked')){    		
		    $('.step_12_doc_declarant_set_identity_doc_mf_document_'+ind).removeAttr("checked");
		    $('#step_12_doc_declarant_bring_himself_mf_document_'+ind).closest("tr").hide();
		    $(el).attr('checked', 'checked');
		    $('span.step_12_info_3_document_detail_clone_'+ind+' > fieldset').hide();
		    $(el).closest('fieldset').show();

			$('#step_12_name_doc_declarant_mf_document_'+indClass).attr('step_12_confirmed', 'true');	//или
			$(el).closest("[name=step_12_info_3_document]").find("[name=step_12_name_doc_declarant_mf_document]").attr('step_12_confirmed', 'true');
			step_12_udPerson_flags[idNum] = true;
			
			if ($(el).closest(".step_12_info_3_document_clone").find("select[step_12_identity=true]").length > 0){
				$(el).closest('.step_12_info_3_all_docs_clone').find("select[step_12_identity=false]").each(function() {
					step_12_infDocumentWithoutGroupIndex = this.id.substr('step_12_name_doc_declarant_mf_document_'.length, this.id.length);
					step_12_callWS_InfDocument(this.id, ind, step_12_InfDocumentWithoutGroup_callback, false);
					$(el).closest('.step_12_info_3_all_docs_clone').find('[step_12_identity_ownerdoc=false]').find("fieldset").show();
				});
			}
		} else {
			$('span.step_12_info_3_document_detail_clone_'+ind+' > fieldset').show();
			if ($('#step_12_doc_declarant_bring_himself_mf_document_'+ind).attr('step_12_self') == 'true') {
				$('#step_12_doc_declarant_bring_himself_mf_document_'+ind).closest("tr").show();
			}

			step_12_udPerson_flags[idNum] = false;
			$('#step_12_name_doc_declarant_mf_document_'+indClass).removeAttr('step_12_confirmed'); //или
			$(el).closest("[name=step_12_info_3_document]").find("[name=step_12_name_doc_declarant_mf_document]").removeAttr('step_12_confirmed');

			if ($(el).closest(".step_12_info_3_document_clone").find("select[step_12_identity=true]").length > 0){
				$(el).closest('.step_12_info_3_all_docs_clone').find('[step_12_identity_ownerdoc=false]').find("fieldset").hide();	//мб remove??
			}
		}
   	}
	
	function step_12_callWS_GroupOfDocuments() {
		subservice = $('select#step_1_subservices option:selected').val();
		category = $('select#step_1_category option:selected').val();
		dataRequest = {"groupOfDocuments": {"subservice":subservice,"category":category, "signDocPack":"MemberOfFamily"}};
		callWebS(ARTKMVurl, dataRequest, step_12_callWS_GroupOfDocuments_callback, true);
	}
	
	var step_12_docs_length;
	var step_12_all_docs_default;
	function step_12_callWS_GroupOfDocuments_callback(xmlHttpRequest, status, dataResponse){
		$('#step_12_info_3_document_detail_clone').hide();
		$('#step_12_info_3_group_document_clone').hide();
		$('#step_12_in_SMEV_trustee_doc_group').closest('tr').hide();
		$('#step_12_doc_declarant_bring_himself_mf_group').closest('tr').hide();
		$('#step_12_info_3_group_document_clone').hide();
		$('#step_12_info_6_document_detail_clone').hide();
		$('#step_12_info_6_group_document_clone').hide();
		$('#step_12_in_SMEV_trustee_doc2_group').closest('tr').hide();
		$('#step_12_doc_declarant_bring_himself_mf2_group').closest('tr').hide();
		$('#step_12_info_6_group_document_clone').hide();
		
		//var groupOfDocuments = null;
		groupAdnDocs = null;
		if (isResult([dataResponse]) ){
			if (dataResponse.groupOfDocuments.document.length > 0) {
				groupAdnDocs = getGroup_Document_Array(dataResponse.groupOfDocuments.document);

				newCloneSpan('step_12_info_3_document_clone', groupAdnDocs.documents.length, null);
				newCloneSpan('step_12_info_3_group_clone', groupAdnDocs.groups.length, null);
				
				newCloneSpan('step_12_info_6_document_clone', groupAdnDocs.documents.length, null);
				newCloneSpan('step_12_info_6_group_clone', groupAdnDocs.groups.length, null);
				
//				отрисовываем документы для блоков ВИС
				drawGroupOfDocumentsResponse(groupAdnDocs, 'step_12_name_doc_declarant_mf_document', 'step_12_doc_declarant_bring_himself_mf_document', 'step_12_in_SMEV_trustee_doc_document', 'step_12_group_name_doc_declarant_mf');		
				step_12_all_docs_default = $('fieldset.step_12_info_3').html();
//				отрисовываем документы для блока заполнения вручную
				drawGroupOfDocumentsResponse(groupAdnDocs, 'step_12_name_doc_declarant_mf2_document', 'step_12_doc_declarant_bring_himself_mf2_document', 'step_12_in_SMEV_trustee_doc2_document', 'step_12_group_name_doc_declarant_mf2');				
				step_12_all_docs_default_fill_self = $('fieldset.step_12_info_6').html();
				if (typeof step_12_all_docs_default_fill_self != 'undefined') {
					$('#step_12_info_6_all_docs_clone_0').html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_12_all_docs_default_fill_self+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
					$('#step_12_info_6_all_docs_clone_0').show();
				}
				
//				Всем элементам  принадлежащим одиночным документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc 
				setCheckNIdAndClass('#step_12_info_6_all_docs_clone_0 span.step_12_info_6_document_clone', '0'); 
				// Всем элементам  принадлежащим группе документов документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
				setCheckNIdAndClass('#step_12_info_6_all_docs_clone_0 span.step_12_info_6_group_clone', '0'); 
				
				// данный блок кода необходим для переноса аттрибута checked 
				// всех чекбоксов из дефолтного блока в выбранный пользователем
				var i=0;
				var j=0;
				$('span#step_12_info_6_all_docs_clone_0 span.step_12_info_6_document_clone').each(function(){
					if ( $(this).css('display') != 'none' ) {
						$('input#step_12_doc_declarant_bring_himself_mf2_document_0_'+j).attr('checked', singleFlagsArray[i]); 
						$('input#step_12_in_SMEV_trustee_doc2_document_0_'+j).attr('checked', groupFlagsArray[i]);											
						i++;
						j++;
					}
				});
			}
		} 
		return groupAdnDocs;
	}
	
	var step_12_indexOfGroup;
	function step_12_getDocsByGroup(el){
		var idSplitArr = el.id.split('step_12_add_group_doc_name_declarant_mf_');
		step_12_indexOfGroup = idSplitArr[1];
		if (el.value == '+'){
			if ($('.step_12_info_3_group_document_clone_'+step_12_indexOfGroup).length > 1){
				$('.step_12_info_3_group_document_clone_'+step_12_indexOfGroup).show();
				el.value = '-';
			} else {
				step_12_callWS_Documents();
			}
		} else {
			$('.step_12_info_3_group_document_clone_'+step_12_indexOfGroup).hide();
			el.value = '+';
		}
		$('#step_12_info_3_group_document_clone_'+step_12_indexOfGroup).hide();		
	}
	
	var step_12_indexOfGroup2;
	function step_12_getDocsByGroup2(el){
		var idSplitArr = el.id.split('step_12_add_group_doc_name_declarant_mf2_');
		step_12_indexOfGroup2 = idSplitArr[1];
		if (el.value == '+'){
			if ($('.step_12_info_6_group_document_clone_'+step_12_indexOfGroup2).length > 1){
				$('.step_12_info_6_group_document_clone_'+step_12_indexOfGroup2).show();
				el.value = '-';
			} else {
				step_12_callWS_Documents();
			}
		}
		else{
			$('.step_12_info_6_group_document_clone_'+step_12_indexOfGroup2).hide();
			el.value = '+';
		}
		$('#step_12_info_6_group_document_clone_'+step_12_indexOfGroup2).hide();		
	}
	
	function step_12_callWS_Documents() {
		var groupDocsCode;
		if ($('#step_12_add_family_member_mf').is(':checked')) {
			groupDocsCode = $('select#step_12_group_name_doc_declarant_mf2_'+step_12_indexOfGroup2+ ' option:selected').val();
			dataRequest = {"documents":{"doc": groupDocsCode}};
	    	callWebS(ARTKMVurl, dataRequest, step_12_Documents_callback2, true); 
		} else {
			groupDocsCode = $('select#step_12_group_name_doc_declarant_mf_'+step_12_indexOfGroup+ ' option:selected').val();
			dataRequest = {"documents":{"doc": groupDocsCode}};
	    	callWebS(ARTKMVurl, dataRequest, step_12_Documents_callback, true); 
		}
	}
	
	var step_12_codeSelectDocFromGroup;
	var step_12_documens_length;
    function step_12_Documents_callback(xmlHttpRequest, status, dataResponse) { 
			idenDocCodes = getIndenDocFromDic();       	
		documents = null;
		if (isResult([dataResponse, dataResponse.documents]) ){
			if (dataResponse.documents.document.length > 0) {
				documents = dataResponse.documents;
				step_12_documens_length = documents.document.length;
				newCloneSpan('step_12_info_3_group_document_clone_'+step_12_indexOfGroup, documents.document.length, null);
				for (var i = 0; i < documents.document.length; i++){
					addOption(document.getElementById('step_12_name_doc_declarant_mf_group_'+step_12_indexOfGroup+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
					$('.step_12_check_doc_declarant_mf_group_'+step_12_indexOfGroup +'_'+ i).attr("class", 'step_12_check_doc_declarant_mf_group_'+step_12_indexOfGroup);
					$('.step_12_info_3_group_document_detail_clone_'+step_12_indexOfGroup +'_'+ i).hide();
					if (isInArray(documents.document[i].key, idenDocCodes)){
						$('#step_12_name_doc_declarant_mf_group_'+step_12_indexOfGroup+'_'+i).attr('step_12_identity_group', 'true');
					}
					writeDocument(documents.document[i], 'step_12_name_doc_declarant_mf_group_'+step_12_indexOfGroup+'_'+i);	//15_07_13 by KAVlex
				}
				$('#step_12_add_group_doc_name_declarant_mf_'+step_12_indexOfGroup).val('-');
			}
			return documents;
		}
    }
    
    var step_12_codeSelectDocFromGroup2;
	var step_12_documens_length2;
    function step_12_Documents_callback2(xmlHttpRequest, status, dataResponse) {
		documents = null;
			idenDocCodes = getIndenDocFromDic();    	
		if (isResult([dataResponse, dataResponse.documents])){
			if (dataResponse.documents.document.length > 0) {
				documents = dataResponse.documents;
				step_12_documens_length2 = documents.document.length;
				newCloneSpan('step_12_info_6_group_document_clone_'+step_12_indexOfGroup2, documents.document.length, null);
				for (var i = 0; i < documents.document.length; i++){
					addOption(document.getElementById('step_12_name_doc_declarant_mf2_group_'+step_12_indexOfGroup2+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
					$('.step_12_check_doc_declarant_mf2_group_'+step_12_indexOfGroup2 +'_'+ i).attr("class", 'step_12_check_doc_declarant_mf2_group_'+step_12_indexOfGroup2);
					if (isInArray(documents.document[i].key, idenDocCodes)){
						$('#step_12_name_doc_declarant_mf2_group_'+step_12_indexOfGroup2+'_'+i).attr('step_12_identity_group', 'true');
					}
					writeDocument(documents.document[i], 'step_12_name_doc_declarant_mf2_group_'+step_12_indexOfGroup2+'_'+i);	//15_07_13 by KAVlex
				}
				$('#step_12_add_group_doc_name_declarant_mf2_'+step_12_indexOfGroup2).val('-');
			}
			return documents;
		}
    }
    
    var step_12_selected_group_num;
    var step_12_selected_group_doc_num;
    function step_12_callWS_DocumentType(ind){
    	step_12_selected_group_num = ind;
		if ($('#step_12_add_family_member_mf').is(':checked')) {
			var cloneNum = getCheckedCloneIndex('step_12_check_doc_declarant_mf2_group_'+step_12_selected_group_num);
			dataRequest = {"documentType":{"doc":$('select#step_12_name_doc_declarant_mf2_group_'+step_12_selected_group_num+'_'+cloneNum+ ' option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_12_DocumentType_callback, true);
		} else {
			var cloneNum = getCheckedCloneIndex('step_12_check_doc_declarant_mf_group_'+step_12_selected_group_num);
			dataRequest = {"documentType":{"doc":$('select#step_12_name_doc_declarant_mf_group_'+step_12_selected_group_num+'_'+cloneNum+ ' option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_12_DocumentType_callback, true);
		}
	}
	
	function step_12_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		var cloneNum = 0;
		if ($('#step_12_add_family_member_mf').is(':checked')) {
			cloneNum = getCheckedCloneIndex('step_12_check_doc_declarant_mf2_group_'+step_12_selected_group_num);
		} else {
			cloneNum = getCheckedCloneIndex('step_12_check_doc_declarant_mf_group_'+step_12_selected_group_num);
		}
		if (isResult([dataResponse, dataResponse.DocumentType])){
			documentType = dataResponse.DocumentType;
			if ($('#step_12_add_family_member_mf').is(':checked')) {
				setCheckBoxVisible('#step_12_doc_declarant_bring_himself_mf2_group_'+step_12_selected_group_num+'_'+cloneNum, documentType.privateStorage, documentType.privateStorage);
				$('#step_12_doc_declarant_bring_himself_mf2_group_'+step_12_selected_group_num+'_'+cloneNum).val(documentType.privateStorage);
				setCheckBoxVisible('#step_12_in_SMEV_trustee_doc2_group_'+step_12_selected_group_num+'_'+cloneNum, documentType.interagency, documentType.interagency);
				$('#step_12_in_SMEV_trustee_doc2_group_'+step_12_selected_group_num+'_'+cloneNum).val(documentType.interagency);
			} else {
				setCheckBoxVisible('#step_12_doc_declarant_bring_himself_mf_group_'+step_12_selected_group_num+'_'+cloneNum, documentType.privateStorage, documentType.privateStorage);
				$('#step_12_doc_declarant_bring_himself_mf_group_'+step_12_selected_group_num+'_'+cloneNum).val(documentType.privateStorage);
				setCheckBoxVisible('#step_12_in_SMEV_trustee_doc_group_'+step_12_selected_group_num+'_'+cloneNum, documentType.interagency, documentType.interagency);
				$('#step_12_in_SMEV_trustee_doc_group_'+step_12_selected_group_num+'_'+cloneNum).val(documentType.interagency);
			}
			return documentType;
		}
		return null;
	}
    
    function step_12_InfDocument_callback(xmlHttpRequest, status, dataResponse) {
    	var cloneNum = getCheckedCloneIndex('step_12_check_doc_declarant_mf_group_'+step_12_selected_group_num);
    	if (isResult([dataResponse, dataResponse.infDocument]))
    	{
    		infDocument = dataResponse.infDocument;
			var array = [
				'step_12_doc_declarant_series_mf_group_'+step_12_selected_group_num+'_'+cloneNum,
				'step_12_doc_declarant_number_mf_group_'+step_12_selected_group_num+'_'+cloneNum,
				'step_12_doc_declarant_date_mf_group_'+step_12_selected_group_num+'_'+cloneNum,
				'step_12_doc_declarant_who_issued_mf_group_'+step_12_selected_group_num+'_'+cloneNum,
				'step_12_doc_declarant_set_identity_doc_mf_group_'+step_12_selected_group_num+'_'+cloneNum,
				'step_12_info_3_group_document_detail_'+step_12_selected_group_num+'_'+cloneNum,
				'step_12_info_3_group_document_detail_clone_'+step_12_selected_group_num+'_'+cloneNum,
				'step_12_name_doc_declarant_mf_group_'+step_12_selected_group_num+'_'+cloneNum
			];
			processDocumentDetails(infDocument.document, array, 'step_12_doc_declarant_bring_himself_mf_group_'+step_12_selected_group_num+'_'+cloneNum);
			for (var i=0; i<infDocument.document.length; i++) {
				if (infDocument.document[i].code != $('#step_12_name_doc_declarant_mf_group_'+step_12_selected_group_num+'_'+cloneNum + ' option:selected').val()) {
					$('fieldset#step_12_info_3_group_document_detail_'+step_12_selected_group_num+'_'+cloneNum+'_'+i).hide();
				}
			}
    		return infDocument; 
    	}
    	return null;
	}
    
    var step_12_chkDocId;
    function step_12_check_doc_declarant_mf_group(el) {
    	var ind;	//, indShort
    	ind = $(el).attr('class').split('step_12_check_doc_declarant_mf_group_').pop();
    	var chkFamilyMember = ind.split('_').shift();
    	var chkDocId = $(el).attr('id');
    	step_12_chkDocId = chkDocId.split('step_12_check_doc_declarant_mf_group_').pop();
    	var idNum = $(el).attr('id').split('step_12_check_doc_declarant_mf_group_').pop();
    	if ($(el).is(':checked')){	
    		step_12_callWS_DocumentType(ind);
    		if ($('#step_12_group_name_doc_declarant_mf_'+ind).val() == 'udPerson'){   //должно быть ==
				step_12_callWS_idDocFamilyMember(chkFamilyMember, step_12_InfUdPersonDocument_callback);
			} else {				
				if (step_12_udPerson_flags[chkFamilyMember] === true) {
					step_12_callWS_InfDocument_groupDocs(chkDocId);
				}				
			}

    		$('.step_12_info_3_group_clone .step_12_info_3_group_document_clone_'+ind).removeAttr("checked");
            $(el).attr('checked', 'checked');
            $('.step_12_info_3_group_clone .step_12_info_3_group_document_clone_'+ind+ ' fieldset').hide();
            $('fieldset#step_12_info_3_group_document_'+idNum).show();
        } else {
        	step_12_udPerson_flags[chkFamilyMember] = false;
        	$('.step_12_info_3_group_document_clone_'+ind+' > fieldset').show();
        	$('.step_12_info_3_group_document_detail_'+idNum).hide();
        	setCheckBoxVisible('#step_12_doc_declarant_bring_himself_mf_group_'+idNum, false, false);
        	setCheckBoxVisible('#step_12_in_SMEV_trustee_doc_group_'+idNum, false, false);
        }
	}
    
    function step_12_InfUdPersonDocument_callback(xmlHttpRequest, status, dataResponse) {
    	if (isResult([dataResponse, dataResponse.idDocFamilyMember])){
    		if (dataResponse.idDocFamilyMember.document.length > 0) {
    			idDocFamilyMemberUdPerson = dataResponse.idDocFamilyMember;
        		var k = 0;
    			var doc = [];
        		for (var i=0; i<idDocFamilyMemberUdPerson.document.length; i++){
    	    		if ($('#step_12_name_doc_declarant_mf_group_' + step_12_chkDocId).val() == idDocFamilyMemberUdPerson.document[i].code){  //для реалки должно быть ==
    	    			doc[k++] = idDocFamilyMemberUdPerson.document[i];
    	    		}
        		}
        		step_12_proccessInfDocument(doc);
        		var idNum = step_12_chkDocId.split('_').shift();
        		$('select[step_12_identity_group=true]').each(function(){
        			if ( this.id.indexOf('step_12_name_doc_declarant_mf_group_'+idNum == 0) ) {
    	    			var ind = this.id.substr('step_12_name_doc_declarant_mf_group_'.length, this.id.length);
    	    			$('.step_12_doc_declarant_set_identity_doc_mf_group_' + ind).change(function(){
    	    				var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
    	    				if (this.checked){
    	    					$('#step_12_name_doc_declarant_mf_group_'+indClass).attr('step_12_confirmed', 'true');
    	    					step_12_udPerson_flags[idNum] = true;
						var group_document = $(this).closest("[name=step_12_info_3_group_document]");
						var doNameId =	group_document.find("[name=step_12_name_doc_declarant_mf_group]").attr("id");
					    	var changeClass = $(this).attr("class");
						var params = [group_document.find("[name=step_12_doc_declarant_series_mf_group]").attr("id"), group_document.find("[name=step_12_doc_declarant_number_mf_group]").attr("id"), group_document.find("[name=step_12_doc_declarant_who_issued_mf_group]").attr("id"), group_document.find("[name=step_12_doc_declarant_date_mf_group]").attr("id")];
						var documentFL = getDocument(null, doNameId, changeClass, params);
						//var ind = $(this).attr('class').split('step_12_doc_declarant_set_identity_doc_mf_group_').pop();
						var el = this;
						$(this).closest('.step_12_info_3_all_docs_clone').find("select[step_12_identity=false]").each(function() {
							step_12_infDocumentWithoutGroupIndex = this.id.substr('step_12_name_doc_declarant_mf_document_'.length, this.id.length);
							step_12_callWS_InfDocument(this.id, documentFL, step_12_InfDocumentWithoutGroup_callback, false);
							$(el).closest('.step_12_info_3_all_docs_clone').find('[step_12_identity_ownerdoc=false]').find("fieldset").show();
						});
    	    				} else {
    	    					$('#step_12_name_doc_declarant_mf_group_'+indClass).removeAttr('step_12_confirmed');
    	    					step_12_udPerson_flags[idNum] = false;
						$(this).closest('.step_12_info_3_all_docs_clone').find('[step_12_identity_ownerdoc=false]').find("fieldset").hide();
    	    				}
    	    			});
        			}
        		});
    		}
    		return idDocFamilyMemberUdPerson;
    	} else  {
    		return null;
    	}
    	
    }
    
    function step_12_proccessInfDocument(document){
    	//var Num = step_12_chkDocId.substr(0, step_12_chkDocId.length - 2);
		var array = [
						'step_12_doc_declarant_series_mf_group_'+step_12_chkDocId,
						'step_12_doc_declarant_number_mf_group_'+step_12_chkDocId,
						'step_12_doc_declarant_date_mf_group_'+step_12_chkDocId,
						'step_12_doc_declarant_who_issued_mf_group_'+step_12_chkDocId,
						'step_12_doc_declarant_set_identity_doc_mf_group_'+step_12_chkDocId,
						'step_12_info_3_group_document_detail_'+step_12_chkDocId,
						'step_12_info_3_group_document_detail_clone_'+step_12_chkDocId,
						'step_12_name_doc_declarant_mf_group_' +step_12_chkDocId
					];
		processDocumentDetails(document, array, 'step_12_doc_declarant_bring_himself_mf_group_'+step_12_chkDocId);
    }
    
    
    var step_12_check_doc_group;
    function step_12_callWS_InfDocument_groupDocs(chkDocId) {
    	var idOrg = getIdOrg();
		var indIdentity = chkDocId.split('step_12_check_doc_declarant_mf_group_').pop();
		var groupNum = indIdentity.substr(0, indIdentity.length - 2); 
		var person_index = indIdentity.split('_').shift();
		step_12_check_doc_group = indIdentity;
		var doNameId = 'step_12_name_doc_declarant_mf_group_'+indIdentity;
    	var changeClass = 'step_12_doc_declarant_set_identity_doc_mf_group_' + indIdentity;
    	
    	var idDoc = {"name": $('#step_12_name_doc_declarant_mf_group_'+indIdentity+' option:selected').text(),"code": $('#step_12_name_doc_declarant_mf_group_'+indIdentity+' option:selected').val()};
    	var idGroup = {"name": $('#step_12_group_name_doc_declarant_mf_'+groupNum+' option:selected').text(),"code": $('#step_12_group_name_doc_declarant_mf_'+groupNum+' option:selected').val()};

    	var params = ['step_12_doc_declarant_series_mf_group_'+indIdentity,'step_12_doc_declarant_number_mf_group_'+indIdentity, 'step_12_doc_declarant_who_issued_mf_group_'+indIdentity, 'step_12_doc_declarant_date_mf_group_'+indIdentity];
		var documentFL = getDocument(null, doNameId, changeClass, params);
		var fio = getFIO(['step_12_last_name_declarant_mf_'+person_index, 'step_12_middle_name_declarant_mf_' + person_index, 'step_12_first_name_declarant_mf_' + person_index]);
		var identityFL = getIdentityFL(fio, 'step_12_birthday_declarant_mf_'+person_index, documentFL);
    	
		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup": idGroup,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_12_callWS_InfDocument_groupDocs_callback, true);
    }
	
	
	function step_12_callWS_InfDocument_groupDocs_callback(xmlHttpRequest, status, dataResponse) {
	    	if (isResult([dataResponse, dataResponse.infDocument]))	{
	    		if (dataResponse.infDocument.document.length > 0) {
	    			//var cloneNum = getCheckedCloneIndex('step_12_check_doc_declarant_mf_group_'+step_12_check_doc_group);
				infDocument = dataResponse.infDocument;
	    			step_12_infDocument_groupDocs_length = infDocument.document.length;
	    			var array = [
	    				'step_12_doc_declarant_series_mf_group_'+step_12_check_doc_group,
	    				'step_12_doc_declarant_number_mf_group_'+step_12_check_doc_group,
	    				'step_12_doc_declarant_date_mf_group_'+step_12_check_doc_group,
	    				'step_18_doc_org_doc_group_'+step_12_check_doc_group,
	    				'step_12_doc_declarant_who_issued_mf_group_'+step_12_check_doc_group,
	    				'step_12_info_3_group_document_detail_'+step_12_check_doc_group,
	    				'step_12_info_3_group_document_detail_clone_'+step_12_check_doc_group,
	    				'step_12_name_doc_declarant_mf_group_'+step_12_check_doc_group
	    			];
	    			processDocumentDetails(infDocument.document, array, 'step_12_doc_declarant_bring_himself_mf_label_group_'+step_12_check_doc_group);
	    		}
	    				
	    		return infDocument; 
	    	} else {
	    		return null;
	    	}
    	
	}
    
    
    function step_12_check_doc_declarant_mf2_group(el) {
    	var ind;
    	ind = $(el).attr('class').split('step_12_check_doc_declarant_mf2_group_').pop();
    	var idNum = $(el).attr('id').split('step_12_check_doc_declarant_mf2_group_').pop();
    	if ($(el).is(':checked')){
    		
    		step_12_callWS_DocumentType(ind);
    		
    		$('.step_12_info_6_group_clone .step_12_info_6_group_document_clone_'+ind).removeAttr("checked");
            $(el).attr('checked', 'checked');
            $('.step_12_info_6_group_clone .step_12_info_6_group_document_clone_'+ind+ ' fieldset').hide();
            $('fieldset#step_12_info_6_group_document_'+idNum).show();
            $('#step_12_doc_declarant_bring_himself_mf2_group_'+idNum).closest('tr').show();
        } else {
        	$('#step_12_doc_declarant_bring_himself_mf2_group_'+idNum).closest('tr').hide();
        	$('.step_12_info_6_group_document_clone_'+ind+' > fieldset').show();
        	$('.step_12_info_6_group_document_detail_'+idNum).hide();
        }
	}
	
  //--> клонирование блока элементов 12 шага
	function add_step_12_info(el) {
		//switchStateDateTimePicker(false);
		var newIdNum = Number($('input.step_12_last_name_family_member_mf:last').attr('id').split('_').pop()) + 1;
		$('<span class="step_12_info_5_6_all_info_clone">'+step_12_info_5_6_all_info_default+'</span>').insertAfter('span[class="step_12_info_5_6_all_info_clone"]:last');
		$('span.step_12_info_5_6_all_info_clone:last span.step_12_info_5_clone').find('*').each(function(i){
			if (isNotUndefined($(this).attr('class'))&& $(this).attr('class').indexOf('step_') == 0) {
				var classEl = $(this).attr('class').split(' ')[0];
				$(this).attr('id', classEl + '_' + newIdNum);
			}
		});

		if (typeof step_12_all_docs_default_fill_self != 'undefined') {
			$('#step_12_info_6_all_docs_clone_' + newIdNum).html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_12_all_docs_default_fill_self+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
			$('#step_12_info_6_all_docs_clone_' + newIdNum).show();
		}
		
		recalcIdAndCopyAttrChecked(newIdNum, 'step_12_info_6_all_docs_clone', 'step_12_info_6_document_clone', 'step_12_info_6_group_clone', 'step_12_doc_declarant_bring_himself_mf2_document', 'step_12_in_SMEV_trustee_doc2_document');

		$("input.delete_step_12_info:last").show();

		$(el).parent().css({'margin-right':'100px', 'margin-top':'-50px'});
		$(el).css({'margin-right':'140px', 'margin-top':'-50px'});
		switchStateDateTimePicker(true);
	}

	function delete_step_12_info(el) {
		$(el).closest('span.step_12_info_5_6_all_info_clone').remove();
		var add_btn = document.getElementsByClassName('add_step_12_info');
		if ($('span.step_12_info_5_6_all_info_clone').length == 1) {
			$(add_btn).parent().css({'margin-right':'0px', 'margin-top':'0px'});
			$(add_btn).css({'margin-right':'30px', 'margin-top':'-20px'});
		}
	}
	
	function recalcIdAndCopyAttrChecked(newIdNum, allDocsCloneSpanId, spanDocsClass, spanGroupDocsClass, bringSelfFlagId, smevFlagId) {
//		Всем элементам  принадлежащим одиночным документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
		setCheckNIdAndClass('#'+allDocsCloneSpanId+'_' + newIdNum +' span.'+spanDocsClass, newIdNum); 
		// Всем элементам  принадлежащим группе документов документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
		setCheckNIdAndClass('#'+allDocsCloneSpanId+'_' + newIdNum +' span.'+spanGroupDocsClass, newIdNum); 
		
		// данный блок кода необходим для переноса аттрибута checked 
		// всех чекбоксов из дефолтного блока в выбранный пользователем
		var i=0;
		var j=0;
		
		$('span#'+allDocsCloneSpanId+'_' + newIdNum +' span.'+spanDocsClass).each(function(){
			if ( $(this).css('display') != 'none' ) {
				$('input#'+bringSelfFlagId+'_' + newIdNum + '_'+j).attr('checked', singleFlagsArray[i]); 
				$('input#'+smevFlagId+'_' + newIdNum + '_'+j).attr('checked', groupFlagsArray[i]);											
				i++;
				j++;
			}
		});
	}
    
    
    var groupOfDocuments;
    var step_13_udPerson_flag = false;
    var step_13_udPerson_flags = new Object();
    var step_13_chkFamilyMember;
    var step_13_all_docs_default;
	function openStep_13() {
		switchStateDateTimePicker(false);
		// Прячем элементы блока документов при запонении полей, пришедших из ВИС
		$('fieldset.step_13_info_5').hide();
		$('.step_13_info_3_all_docs_clone').hide();
		$('fieldset#step_13_info_3').hide();
		$('#step_13_info_3_document_detail_clone').hide();
		$('#step_13_info_3_group_document_clone').hide();
		$('#step_13_in_SMEV_trustee_doc_sdd_z_document_group').closest('tr').hide();
		$('#step_13_doc_declarant_bring_himself_sdd_z_group').closest('tr').hide();
		$('#step_13_info_3_group_document_clone').hide();
		
		// Прячем элементы блока документов при запонении полей вручную
		$('fieldset[id="step_13_info_6_7_9"]').hide();
		$('fieldset.step_13_info_6_7_9').hide();
		$('.step_13_info_7_all_docs_clone').hide();
		$('fieldset#step_13_info_7').hide();
		$('#step_13_info_7_group_document_clone').hide();
		$('#step_13_in_SMEV_trustee_doc_sdd_z2_group').closest('tr').hide();
		$('#step_13_doc_bring_himself_sdd_z_group').closest('tr').hide();
		$('#step_13_info_7_group_document_clone').hide();
		$('.step_13_info_9').hide();
		
		
		step_13_info_6_7_9_all_info_default = $('span.step_13_info_6_7_9_all_info_clone').html();
		// клонируем блок для ручного ввода данных, для корректной работы логики по запросу документов.
		array = [
					'step_13_last_name_family_member_sdd_z',
					'step_13_first_name_family_member_sdd_z',
					'step_13_middle_name_family_member_sdd_z',
					'step_13_birthday_family_member_sdd_z',
					'step_13_relation_degree_family_member_sdd_z',
					'step_13_presence_dependency_family_member_sdd_z',
					'step_13_info_6',
					'step_13_info_9',
					'step_13_in_SMEV_trustee_registration_address2',
					'step_13_info_7_all_docs_clone'
				];
		switchStateDateTimePicker(false);
		newCloneSpan('step_13_info_6_clone', 1, array);
		
//		switchStateDateTimePicker(false);
//		switchStateDateTimePicker(true);
		
		idOrg = getIdOrg();
		var identityFL = getIdentityFLFromStep_4();
		var addressRegistration;
		if (getCheckedRadioValue('step_1_acting_person') == "self") {
			// Адрес берем из СИА
			// TODO  АДРЕС нужен или нет? 
//			addressRegistration =  {"district": $('#step_4_address_declarant_district').val(),"room":$('#step_4_address_declarant_room').val(),"body":$('#step_4_address_declarant_body').val(),"Structure":$('#step_4_address_declarant_build').val(),"region":{"reduction":"сокращение","name":"наименование"},"populatedLocality":{"reduction":"сокращение","name":"наименование"},"downPopulatedLocality":{"reduction":"сокращение","name":"наименование"},"street":{"reduction":"сокращение","name":"наименование","kodKLADR":"235235235"},"house":"1","country":"страна","apartment":"1"};
			addressRegistration =  {};
		} else {
			// Адрес берем из ВИС
			addressRegistration = get_vis_address_from_step_4();
		}
		setDictionary('relationDegree','step_13_relation_degree_sdd_z');
	    dataRequest = {"relationshipRegistration":{"idOrg": idOrg,"addressRegistration": addressRegistration,"identityFL": identityFL}};
	    callWebS(VISurl, dataRequest, step_13_callWS_RelationshipRegistration_callback, true);
	    

	    step_13_14_callWS_GroupOfDocuments();
	    switchStateDateTimePicker(true);
	    setDictionary('relationDegree','step_13_relation_degree_family_member_sdd_z_0');	//by KAVlex 18_07_13
	}
	
	function get_vis_address_from_step_4() {
		//var step_4_document_check_num = getCheckedCloneIndex('step_4_is_doc_person_system_true');
		var address = idenDocRegAddrOwner.identDocRegAddress.addressRegistration;		
		var region = {"reduction": address.region.reduction,"name": address.region.name};
		var populatedLocality = {"reduction": address.populatedLocality.reduction,"name": address.populatedLocality.name};
		var downPopulatedLocality = {"reduction": address.downPopulatedLocality.reduction,"name": address.downPopulatedLocality.name};
		var street = {"reduction": address.street.reduction,"name": address.street.name,"kodKLADR": address.street.kodKLADR};
		addressRegistration = {"district": address.district,"room": address.room,"body": address.body,"Structure": address.structure,"region": region,"populatedLocality": populatedLocality,"downPopulatedLocality": downPopulatedLocality,"street": street,"house": address.house,"country": address.country,"apartment": address.apartment};
		
		return addressRegistration;
	}
	
	function step_13_callWS_RelationshipRegistration_callback(xmlHttpRequest, status, dataResponse) {
		var familyMembers = null; 
				
		array = [
					'step_13_last_name_declarant_sdd_z',
					'step_13_first_name_declarant_sdd_z',
					'step_13_middle_name_declarant_sdd_z',
					'step_13_birthday_declarant_sdd_z',
					'step_13_presence_dependency_sdd_z',
					'step_13_relation_degree_sdd_z',
					'step_13_set_family_member_sdd_z',
					'step_13_info_2',
					'step_13_info_5',
					'step_13_in_SMEV_trustee_registration_address',
					'step_13_info_3_all_docs_clone'
				];
		
		if ( isResult([dataResponse]) ) {
			if (isResult([dataResponse.relationshipRegistration])) {
				if (dataResponse.relationshipRegistration.familyMember.length > 0) {
					familyMembers = dataResponse.relationshipRegistration;
					newCloneSpan('step_13_info_2_clone', familyMembers.familyMember.length, array);
					for (var i=0; i<familyMembers.familyMember.length; i++) {
						$('#step_13_last_name_declarant_sdd_z_'+i).val(familyMembers.familyMember[i].fio.surname);
						$('#step_13_first_name_declarant_sdd_z_'+i).val(familyMembers.familyMember[i].fio.name);
						$('#step_13_middle_name_declarant_sdd_z_'+i).val(familyMembers.familyMember[i].fio.patronymic);
						$('#step_13_birthday_declarant_sdd_z_'+i).val(familyMembers.familyMember[i].dateOfBirth);
						setCheckBox('#step_13_presence_dependency_sdd_z_'+i, familyMembers.familyMember[i].dependent);
						if ( isNotUndefined(familyMembers.familyMember[i].relationDegree) && (familyMembers.familyMember[i].relationDegree != '') ) {
							$('#step_13_relation_degree_sdd_z_' + i).val(familyMembers.familyMember[i].relationDegree);
							$('#step_13_relation_degree_sdd_z_' +i).attr('selected', 'selected');
							$('#step_13_relation_degree_sdd_z_' +i).closest('td').show();
							$('.step_13_relation_degree_label').parent('td').show();		
						}
					}
					$('span#step_13_add_family_member_mf_chk').show();
				} else  {
					step_13_Not_RelationshipRegistration();
				}
			}else{
				step_13_Not_RelationshipRegistration();
			}
		} else {
			step_13_Not_RelationshipRegistration();
		}
		return familyMembers;
	}

	function step_13_Not_RelationshipRegistration(){
			$('fieldset#step_13_info_6_7_9').show();
			$('span.step_13_info_2_clone').hide();
			$('#step_13_add_family_member_sdd_z').attr('checked', 'checked');
			$('#step_13_add_family_member_sdd_z').change();
			$('span#step_13_add_family_member_mf_chk').show();
	}
	
	
	function step_13_14_callWS_GroupOfDocuments() {
		var subservice = getIdSubservice().code;
		var category = getIdCategory().code;
		dataRequest = {"groupOfDocuments": {"subservice":subservice,"category":category, "signDocPack":"MemberOfFamily"}};
		callWebS(ARTKMVurl, dataRequest, step_13_14_callWS_GroupOfDocuments_callback, true);
	}
	
	function step_13_14_callWS_GroupOfDocuments_callback(xmlHttpRequest, status, dataResponse) {
		setDictionary('relationDegree','step_13_relation_degree_family_member_sdd_z');
		
		var arrObjectMembers = ["groupOfDocuments.document[]"];
		
		var groupAdnDocs = null;
		validObjectMembers(dataResponse,arrObjectMembers);
		
		setDictionary('relationDegree','step_14_relation_degree_sdd_nz');
		setDictionary('relationDegree','step_14_relation_degree_family_member_sdd_nz');
	
			if (dataResponse.groupOfDocuments.document.length > 0) {
				groupAdnDocs = getGroup_Document_Array(dataResponse.groupOfDocuments.document);
				if ($('div#tab_13').is(':visible')) {
					newCloneSpan('step_13_info_3_document_clone', groupAdnDocs.documents.length, null); // Клонирование элементов
					newCloneSpan('step_13_info_3_group_clone', groupAdnDocs.groups.length, null);       // заполнения из ВИС
					
					newCloneSpan('step_13_info_7_document_clone', groupAdnDocs.documents.length, null); // Клонирование элементов
					newCloneSpan('step_13_info_7_group_clone', groupAdnDocs.groups.length, null);       // для ручного ввода
					
					// отрисовываем документы для блоков ВИС
					drawGroupOfDocumentsResponse(groupAdnDocs, 'step_13_name_doc_declarant_sdd_z_document', 'step_13_doc_declarant_bring_himself_sdd_z_document', 'step_13_in_SMEV_trustee_doc_sdd_z_document', 'step_13_group_name_doc_declarant_sdd_z');
					step_13_all_docs_default = $('fieldset.step_13_info_3').html();
					// отрисовываем документы для блока заполнения вручную
					drawGroupOfDocumentsResponse(groupAdnDocs, 'step_13_name_doc_sdd_z_document', 'step_13_doc_bring_himself_sdd_z_document', 'step_13_in_SMEV_trustee_doc_sdd_z2_document', 'step_13_group_name_doc_sdd_z');				
					step_13_all_docs_default_fill_self = $('fieldset.step_13_info_7').html();
					if (typeof step_13_all_docs_default_fill_self != 'undefined') {
						$('#step_13_info_7_all_docs_clone_0').html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_13_all_docs_default_fill_self+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
						$('#step_13_info_7_all_docs_clone_0').show();
						//$('fieldset#step_13_info_9_0').show();	//10_07_13
					}
					
//					Всем элементам  принадлежащим одиночным документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc 
					setCheckNIdAndClass('#step_13_info_7_all_docs_clone_0 span.step_13_info_7_document_clone', '0'); 
					// Всем элементам  принадлежащим группе документов документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
					setCheckNIdAndClass('#step_13_info_7_all_docs_clone_0 span.step_13_info_7_group_clone', '0'); 
					
					// данный блок кода необходим для переноса аттрибута checked 
					// всех чекбоксов из дефолтного блока в выбранный пользователем
					var i=0;
					var j=0;
					
					$('span#step_13_info_7_all_docs_clone_0 span.step_13_info_7_document_clone').each(function(){
						if ( $(this).css('display') != 'none' ) {
							$('input#step_13_doc_bring_himself_sdd_z_document_0_'+j).attr('checked', singleFlagsArray[i]); 
							$('input#step_13_in_SMEV_trustee_doc_sdd_z2_document_0_'+j).attr('checked', groupFlagsArray[i]);											
							i++;
							j++;
						}
					});
				}
				if ($('div#tab_14').is(':visible')) {
					newCloneSpan('step_14_info_3_document_clone', groupAdnDocs.documents.length, null); // Клонирование элементов
					newCloneSpan('step_14_info_3_group_clone', groupAdnDocs.groups.length, null);       // заполнения из ВИС
					
					newCloneSpan('step_14_info_7_document_clone', groupAdnDocs.documents.length, null); // Клонирование элементов
					newCloneSpan('step_14_info_7_group_clone', groupAdnDocs.groups.length, null);       // для ручного ввода
					
//					отрисовываем документы для блоков ВИС
					drawGroupOfDocumentsResponse(groupAdnDocs, 'step_14_name_doc_declarant_sdd_nz_document', 'step_14_doc_declarant_bring_himself_sdd_nz_document', 'step_14_in_SMEV_trustee_doc_sdd_nz_document', 'step_14_group_name_doc_declarant_sdd_nz');
					step_14_all_docs_default = $('fieldset.step_14_info_3').html();
					// отрисовываем документы для блока заполнения вручную
					drawGroupOfDocumentsResponse(groupAdnDocs, 'step_14_name_doc_sdd_nz_document', 'step_14_doc_bring_himself_sdd_nz_document', 'step_14_in_SMEV_trustee_doc_sdd_nz2_document', 'step_14_group_name_doc_sdd_nz');				
					step_14_all_docs_default_fill_self = $('fieldset.step_14_info_7').html();
					if (typeof step_14_all_docs_default_fill_self != 'undefined') {
						$('#step_14_info_7_all_docs_clone_0').html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_14_all_docs_default_fill_self+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
						$('#step_14_info_7_all_docs_clone_0').show();
						$('fieldset#step_14_info_8_0').hide();		//show() <--> hide() by KAVlex 18_07_13
					}
					
//					Всем элементам  принадлежащим одиночным документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc 
					setCheckNIdAndClass('#step_14_info_7_all_docs_clone_0 span.step_14_info_7_document_clone', '0');
					// Всем элементам  принадлежащим группе документов документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
					setCheckNIdAndClass('#step_14_info_7_all_docs_clone_0 span.step_14_info_7_group_clone', '0');
					
					// данный блок кода необходим для переноса аттрибута checked 
					// всех чекбоксов из дефолтного блока в выбранный пользователем
					var i=0;
					var j=0;
					
					$('span#step_14_info_7_all_docs_clone_0 span.step_14_info_7_document_clone').each(function(){
						if ( $(this).css('display') != 'none' ) {
							$('input#step_14_doc_bring_himself_sdd_nz_document_0_'+j).attr('checked', singleFlagsArray[i]); 
							$('input#step_14_in_SMEV_trustee_doc_sdd_nz2_document_0_'+j).attr('checked', groupFlagsArray[i]);											
							i++;
							j++;
						}
					});
				}
			} else {$(".step_13_info_2_clone:first").hide();}
		return groupAdnDocs;	
	}
	
	function drawGroupOfDocumentsResponse(groupAdnDocs ,name_doc, bring_himself, smev_trustee, group_name_doc) {
	//  Получение массива кодов документов удостоверяющих личность
		idenDocCodes = getIndenDocFromDic();  

		singleFlagsArray = [];  // необходимы для занесения флага Принести Лично для одиночных док. для клонированных блоков
		groupFlagsArray = [];	// необходимы для занесения флага Запрашивается Ведомством для одиночных док. для клонированных блоков
		
		countIdendocs = 0;
		for (var i=0; i < groupAdnDocs.documents.length; i++){
			if (isInArray(groupAdnDocs.documents[i].key, idenDocCodes)){
				addOption(document.getElementById(name_doc+'_' + countIdendocs), groupAdnDocs.documents[i].name, groupAdnDocs.documents[i].key, true, true);
				setCheckBoxVisible('#'+bring_himself+'_' + countIdendocs, groupAdnDocs.documents[i].privateStorage, groupAdnDocs.documents[i].privateStorage);
				$('#'+bring_himself+'_' + countIdendocs).val(groupAdnDocs.documents[i].privateStorage);
				setCheckBoxVisible('#'+smev_trustee+'_' + countIdendocs, groupAdnDocs.documents[i].interagency, groupAdnDocs.documents[i].interagency);
				$('#'+smev_trustee+'_' + countIdendocs).val(groupAdnDocs.documents[i].interagency);
				
				var hideAttrByCheck = 'undefined';
				if ($('div#tab_12').is(':visible')) {
					$('#'+name_doc+'_' + countIdendocs).attr('step_12_identity', 'true');
					$('#step_12_info_3_document_detail_clone_' + countIdendocs).attr('step_12_identity_ownerdoc', 'true');
				}
				if ($('div#tab_13').is(':visible')) {
					$('#'+name_doc+'_' + countIdendocs).attr('step_13_identity', 'true');
					$('#step_13_info_3_document_detail_clone_' + countIdendocs).attr('step_13_identity_ownerdoc', 'true');
				}
				if ($('div#tab_14').is(':visible')) {
					$('#'+name_doc+'_' + countIdendocs).attr('step_14_identity', 'true');
					$('#step_14_info_3_document_detail_clone_' + countIdendocs).attr('step_14_identity_ownerdoc', 'true');
				}
				
				writeDocument(groupAdnDocs.documents[i], name_doc+'_' + countIdendocs); //15_07_13 by KAVlex
							
				singleFlagsArray[i] = groupAdnDocs.documents[i].privateStorage;
				groupFlagsArray[i] = groupAdnDocs.documents[i].interagency;
				countIdendocs++;
			} else {
				j = groupAdnDocs.documents.length + countIdendocs - i - 1;
				addOption(document.getElementById(name_doc+'_' + j), groupAdnDocs.documents[i].name, groupAdnDocs.documents[i].key, true, true);
				setCheckBoxVisible('#'+bring_himself+'_' + j, groupAdnDocs.documents[i].privateStorage, groupAdnDocs.documents[i].privateStorage);
				$('#'+bring_himself+'_' + j).val(groupAdnDocs.documents[i].privateStorage);
				setCheckBoxVisible('#'+smev_trustee+'_' + j, groupAdnDocs.documents[i].interagency, groupAdnDocs.documents[i].interagency);
				$('#'+smev_trustee+'_' + j).val(groupAdnDocs.documents[i].interagency);
				
				var hideAttrByCheck = 'undefined';
				if ($('div#tab_12').is(':visible')) {
					$('#'+name_doc+'_' + j).attr('step_12_identity', 'false');
					$('#step_12_info_3_document_detail_clone_' + j).attr('step_12_identity_ownerdoc', 'false');	//countIdendocs
				}
				if ($('div#tab_13').is(':visible')) {
					$('#'+name_doc+'_' + j).attr('step_13_identity', 'false');
					$('#step_13_info_3_document_detail_clone_' + j).attr('step_13_identity_ownerdoc', 'false');
				}
				if ($('div#tab_14').is(':visible')) {
					$('#'+name_doc+'_' + j).attr('step_14_identity', 'false');
					$('#step_14_info_3_document_detail_clone_' + j).attr('step_14_identity_ownerdoc', 'false');
				}
				
				writeDocument(groupAdnDocs.documents[i], name_doc+'_' + j);   //15_07_13 by KAVlex
								
				singleFlagsArray[i] = groupAdnDocs.documents[i].privateStorage;
				groupFlagsArray[i] = groupAdnDocs.documents[i].interagency;
			}
		}
		for (var i=0; i < groupAdnDocs.groups.length; i++){
			addOption(document.getElementById(group_name_doc+'_' + i), groupAdnDocs.groups[i].name, groupAdnDocs.groups[i].key, true, true);
		}
	}
	
	function step_13_set_family_member_sdd_z(el) {
		var id = $(el).attr('id');
		var idParts = id.split('_');
		var idNum = idParts.pop();  // вычисляется номер блока, где выбран член семьи
		step_13_chkFamilyMember = idNum;
		if (el.checked){  
			
			if (typeof step_13_all_docs_default != 'undefined') {
				$('#step_13_info_3_all_docs_clone_'+idNum).html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_13_all_docs_default+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
				$('#step_13_info_3_all_docs_clone_'+idNum).show();
				$('fieldset#step_13_info_5_'+idNum).hide();       //07.07.13
			}
			
			$('fieldset[id="step_13_info_6_7_9"]').hide();
			$('#step_13_add_family_member_sdd_z').removeAttr('checked');
									
//			Всем элементам  принадлежащим одиночным документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc 
			setCheckNIdAndClass('#step_13_info_3_all_docs_clone_'+idNum+' span.step_13_info_3_document_clone', idNum);
			// Всем элементам  принадлежащим группе документов документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
			setCheckNIdAndClass('#step_13_info_3_all_docs_clone_'+idNum+' span.step_13_info_3_group_clone', idNum);
			
			// данный блок кода необходим для переноса аттрибута checked 
			// всех чекбоксов из дефолтного блока в выбранный пользователем
			var i=0;
			var j=0;
			
			$('span#step_13_info_3_all_docs_clone_'+idNum+' span.step_13_info_3_document_clone').each(function(){
				if ( $(this).css('display') != 'none' ) {
					$('input#step_13_doc_declarant_bring_himself_sdd_z_document_'+idNum+'_'+j).attr('checked', singleFlagsArray[i]); 
					$('input#step_13_in_SMEV_trustee_doc_sdd_z_document_'+idNum+'_'+j).attr('checked', groupFlagsArray[i]);											
					i++;
					j++;
				}
			});
			
			step_13_callWS_docIDFamilyMember(idNum, step_13_callWS_docIDFamilyMember_callback);
		} else {
			$('#step_13_info_3_all_docs_clone_'+idNum).hide();
			$('fieldset[id="step_13_info_6_7_8"]').hide();
			$('fieldset[class="step_13_info_5"]').hide();
		}
	}
	
	
	function step_13_callWS_docIDFamilyMember(index, callback) {
		idOrg = getIdOrg();
		var fio = {"surname": $('#step_13_last_name_declarant_sdd_z_'+index).val(),"patronymic":$('#step_13_middle_name_declarant_sdd_z_'+index).val(),"name": $('#step_13_first_name_declarant_sdd_z_'+index).val()};
		var dateOfBirth = $('#step_13_birthday_declarant_sdd_z_'+index).val();
		var identityFL = getIdentityFLFromStep_4();
		var addressRegistration;
		if (getCheckedRadioValue('step_1_acting_person') == "self") {
			// Адрес берем из СИА
			// TODO  АДРЕС нужен или нет?
//			addressRegistration = {"district":"район","room":"5","body":"а","Structure":"2","region":{"reduction":"сокращение","name":"наименование"},"populatedLocality":{"reduction":"сокращение","name":"наименование"},"downPopulatedLocality":{"reduction":"сокращение","name":"наименование"},"street":{"reduction":"сокращение","name":"наименование","kodKLADR":"235235235"},"house":"1","country":"страна","apartment":"1"};
			addressRegistration =  {};
		} else {
			// Адрес берем из ВИС
			addressRegistration = get_vis_address_from_step_4();
		}
		
		dataRequest = {"docIDFamilyMember":{"idOrg":idOrg,"relative":{"fio": fio,"dateOfBirth": dateOfBirth},"addressRegistration": addressRegistration,"identityFL": identityFL}};
		callWebS(VISurl, dataRequest, callback, true);

	}
	
	var step_13_infDocumentWithoutGroupIndex = -1;
	function step_13_callWS_docIDFamilyMember_callback(xmlHttpRequest, status, dataResponse) {	
		idDocFamilyMember = null;
		var idNum = step_13_chkFamilyMember;
		
		if (isResult([dataResponse, dataResponse.docIDFamilyMember])) {
			if (dataResponse.docIDFamilyMember.identificationdocument.length > 0) {
				idDocFamilyMember = dataResponse.docIDFamilyMember;
				
				$('select[name="step_13_name_doc_declarant_sdd_z_document"]').each(function(){
	    			if (this.id.indexOf('step_13_name_doc_declarant_sdd_z_document_') == 0){
	    		    	for (var i=0; i<idDocFamilyMember.identificationdocument.length; i++){
	    		    		if ($(this).val() == idDocFamilyMember.identificationdocument[i].code){  
	    		    			var ind = getIndex(this);
	    		    			var array = [
	    		    				'step_13_doc_declarant_series_sdd_z_document'+ind,
	    		    				'step_13_doc_declarant_number_sdd_z_document'+ind,
	    		    				'step_13_doc_declarant_date_sdd_z_document'+ind,
	    		    				'step_13_doc_declarant_who_issued_sdd_z_document'+ind,
	    		    				'step_13_doc_declarant_set_identity_doc_sdd_z_document'+ind,
	    		    				'step_13_info_3_document_detail'+ind,
	    		    				'step_13_info_3_document_detail_clone'+ind,
	    		    				'step_13_name_doc_declarant_sdd_z_document'+ind
	    		    			];
	    		    			processDocumentDetails(idDocFamilyMember.identificationdocument, array, 'step_13_doc_declarant_bring_himself_sdd_z_document'+ind);
	    		    			break;
	    		    		}
	    		    	}
	    			}
	    		});
				
				
				$('select[step_13_identity=true]').each(function(){
					if ( this.id.indexOf('step_13_name_doc_declarant_sdd_z_document_'+idNum == 0) ) {
		    			var ind = this.id.substr('step_13_name_doc_declarant_sdd_z_document_'.length, this.id.length);
		    			$('.step_13_doc_declarant_set_identity_doc_sdd_z_document_' + ind).change(function(){
		    				var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
		    				if (this.checked){
		    					if ($('[step_13_confirmed=true]').length == 0){
				    				$(this).closest(".step_13_info_3_all_docs_clone").find('select[step_13_identity=false]').each(function() {
				    					step_13_infDocumentWithoutGroupIndex = this.id.substr('step_13_name_doc_declarant_sdd_z_document_'.length, this.id.length);
				    					step_13_callWS_InfDocument(this.id, ind, step_13_InfDocumentWithoutGroup_callback, false);
								});
		    					}
		    					$('#step_13_name_doc_declarant_sdd_z_document_'+indClass).attr('step_13_confirmed', 'true');
		    					step_13_udPerson_flags[idNum] = true;
		    				}
		    				else{
		    					step_13_udPerson_flags[idNum] = false;
		    					$('#step_13_name_doc_declarant_sdd_z_document_'+indClass).removeAttr('step_13_confirmed');
		    					if ($('[step_13_confirmed=true]').length == 0)
		    						$('[step_13_identity_ownerdoc=false]').hide();	//мб remove??
		    				}
		    			});
					}
	    		});
			}
						
			return idDocFamilyMember;
		}
		return null;
	}

	function step_13_callWS_InfDocument(ind, indIdentity, callback, async) {
		var indClass = ind.split("step_13_name_doc_declarant_sdd_z_document_").pop();
	    	var idOrg = getIdOrg();
	    	var idDoc = getIdDoc(ind);
	    	var person_index = indClass.split('_').shift();

		var documentFL;
    		if (typeof indIdentity != 'object'){
		// Получение массива кодов документов удостоверяющих личность
			idenDocCodes = getIndenDocFromDic();  
			if (indIdentity == -1){
			    	$('select[name=step_13_name_doc_declarant_sdd_z_document]').each(function(){
			    		//если это документ удостоверяющий личность
			    		if (isInArray($(this).val(), idenDocCodes)){  //для реалки должно быть ==
			    			var changeOneInd = this.id.substr('step_13_name_doc_declarant_sdd_z_document'.length, this.id.length);
			    			if ($('#step_13_doc_declarant_set_identity_doc_sdd_z_document'+changeOneInd).attr("checked")){	//подтверждены реквизиты дока удостоверяющего личность
			    				step_13_udPerson_flags[idNum] = true;
			    				indIdentity = this.id.substr('step_13_name_doc_declarant_sdd_z_document_'.length, this.id.length);
			    				return false;
			    			}
			    		}
			    	});
			    	if (indIdentity = -1){
			    		return false;
			    	}
			}
	    	
	    		var doNameId = 'step_13_name_doc_declarant_sdd_z_document_'+indIdentity;
		    	var changeClass = 'step_13_doc_declarant_set_identity_doc_sdd_z_document_' + indIdentity;
	    		var params = ['step_13_doc_declarant_series_sdd_z_document_'+indIdentity,'step_13_doc_declarant_number_sdd_z_document_'+indIdentity, 'step_7_org_doc_document_'+indIdentity, 'step_13_doc_declarant_date_sdd_z_document_'+indIdentity];
			documentFL = getDocument(null, doNameId, changeClass, params);
		}else{
			documentFL = indIdentity;
		}
		var fio = getFIO(['step_13_last_name_declarant_sdd_z_'+person_index, 'step_13_middle_name_declarant_sdd_z_' + person_index, 'step_13_first_name_declarant_sdd_z_' + person_index]);
		var identityFL = getIdentityFL(fio, 'step_13_birthday_declarant_sdd_z_'+person_index, documentFL);
    	
		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup":{"name":"Наименование","code":"Код организации"},"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, callback, async);
	}
	
	function step_13_InfDocumentWithoutGroup_callback(xmlHttpRequest, status, dataResponse) {
    	infDocumentWithoutGroup = null;
    	if (isResult([dataResponse])){
    		if (isResult([dataResponse.infDocument])){
    			infDocumentWithoutGroup = dataResponse.infDocument;
    			var array = [
 		    				'step_13_doc_declarant_series_sdd_z_document_'+step_13_infDocumentWithoutGroupIndex,
 		    				'step_13_doc_declarant_number_sdd_z_document_'+step_13_infDocumentWithoutGroupIndex,
 		    				'step_13_doc_declarant_date_sdd_z_document_'+step_13_infDocumentWithoutGroupIndex,
 		    				'step_13_doc_declarant_who_issued_sdd_z_document_'+step_13_infDocumentWithoutGroupIndex,
 		    				'step_13_doc_declarant_set_identity_doc_sdd_z_document_'+step_13_infDocumentWithoutGroupIndex,
 		    				'step_13_info_3_document_detail_'+step_13_infDocumentWithoutGroupIndex,
 		    				'step_13_info_3_document_detail_clone_'+step_13_infDocumentWithoutGroupIndex,
 		    				'step_13_name_doc_declarant_sdd_z_document_'+step_13_infDocumentWithoutGroupIndex
 		    			];
 		    	processDocumentDetails(infDocumentWithoutGroup.document, array, 'step_13_doc_declarant_bring_himself_sdd_z_document_'+step_13_infDocumentWithoutGroupIndex);
    		}
    	}
    	return infDocumentWithoutGroup;
    }
	
	function step_13_doc_declarant_set_identity_doc_sdd_z_document(el) {
		var ind;
    	//var step_13_self_flag;
    	   	
    	ind = $(el).attr('class').split('step_13_doc_declarant_set_identity_doc_sdd_z_document_').pop();
    	if ($('#step_13_doc_declarant_bring_himself_sdd_z_document_'+ind).is(':checked')) {
    		$('#step_13_doc_declarant_bring_himself_sdd_z_document_'+ind).attr('step_13_self', 'true');
        }
    	
    	if ($(el).is(':checked')){    		
            $('.step_13_doc_declarant_set_identity_doc_sdd_z_document_'+ind).removeAttr("checked");
            
            $('#step_13_doc_declarant_bring_himself_sdd_z_document_'+ind).closest("tr").hide();
            $(el).attr('checked', 'checked');
            $('span.step_13_info_3_document_detail_clone'+ind+' > fieldset').hide();
            $(el).closest('fieldset').show();
        } else {
        	$('span.step_13_info_3_document_detail_clone'+ind+' > fieldset').show();
        	if ($('#step_13_doc_declarant_bring_himself_sdd_z_document_'+ind).attr('step_13_self') == 'true') {
        		$('#step_13_doc_declarant_bring_himself_sdd_z_document_'+ind).closest("tr").show();
        	}
        }
	}
	
	var step_13_indexOfGroup;
	function step_13_getDocsByGroup(el) {
		var idSplitArr = el.id.split('step_13_add_group_doc_name_');
		step_13_indexOfGroup = idSplitArr[1];
		if (el.value == '+'){
			if ($('.step_13_info_3_group_document_clone_'+step_13_indexOfGroup).length > 1){
				$('.step_13_info_3_group_document_clone_'+step_13_indexOfGroup).show();
				el.value = '-';
			} else {
				step_13_callWS_Documents();
			}
		} else {
			$('.step_13_info_3_group_document_clone_'+step_13_indexOfGroup).hide();
			el.value = '+';
		}
		$('#step_13_info_3_group_document_clone_'+step_13_indexOfGroup).hide();	
	}
	
	var step_13_indexOfGroup2;
	function step_13_getDocsByGroup2(el) {
		var idSplitArr = el.id.split('step_13_add_group_doc_name2_');
		step_13_indexOfGroup2 = idSplitArr[1];
		if (el.value == '+'){
			if ($('.step_13_info_7_group_document_clone_'+step_13_indexOfGroup2).length > 1){
				$('.step_13_info_7_group_document_clone_'+step_13_indexOfGroup2).show();
				el.value = '-';
			} else {
				step_13_callWS_Documents();
			}
		} else {
			$('.step_13_info_7_group_document_clone_'+step_13_indexOfGroup2).hide();
			el.value = '+';
		}
		$('#step_13_info_7_group_document_clone_'+step_13_indexOfGroup2).hide();	
	}
	
	function step_13_callWS_Documents() {
		var groupDocsCode;
		if ($('#step_13_add_family_member_sdd_z').is(':checked')) {
			groupDocsCode = $('select#step_13_group_name_doc_sdd_z_'+step_13_indexOfGroup2+ ' option:selected').val();
			dataRequest = {"documents":{"doc": groupDocsCode}};
	    		callWebS(ARTKMVurl, dataRequest, step_13_Documents_callback2, true);
		} else {
			groupDocsCode = $('select#step_13_group_name_doc_declarant_sdd_z_'+step_13_indexOfGroup+ ' option:selected').val();
			dataRequest = {"documents":{"doc": groupDocsCode}};
		    	callWebS(ARTKMVurl, dataRequest, step_13_Documents_callback, true);
		}
	}
	
	var step_13_documens_length;
    function step_13_Documents_callback(xmlHttpRequest, status, dataResponse) {
		documents = null;
			idenDocCodes = getIndenDocFromDic(); 
		if (isResult([dataResponse, dataResponse.documents])){
			if (dataResponse.documents.document.length > 0) {
				documents = dataResponse.documents;
				step_13_documens_length = documents.document.length;
				if ($('#step_13_add_family_member_sdd_z').is(':checked')) {
					newCloneSpan('step_13_info_7_group_document_clone_'+step_13_indexOfGroup2, documents.document.length, null);
					for (var i = 0; i < documents.document.length; i++){
						addOption(document.getElementById('step_13_name_doc_sdd_z_group_'+step_13_indexOfGroup2+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
						$('.step_13_name_doc_sdd_z_group_'+step_13_indexOfGroup2 +'_'+ i).attr("class", 'step_13_name_doc_sdd_z_group_'+step_13_indexOfGroup2);
						writeDocument(documents.document[i], 'step_13_name_doc_sdd_z_group_'+step_13_indexOfGroup2+'_'+i);	//15_07_13 by KAVlex
					}
					$('#step_13_add_group_doc_name2_'+step_13_indexOfGroup2).val('-');
				} else {
					newCloneSpan('step_13_info_3_group_document_clone_'+step_13_indexOfGroup, documents.document.length, null);
					for (var i = 0; i < documents.document.length; i++){
						addOption(document.getElementById('step_13_name_doc_declarant_sdd_z_group_'+step_13_indexOfGroup+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
						$('.step_13_name_doc_declarant_sdd_z_group_'+step_13_indexOfGroup +'_'+ i).attr("class", 'step_13_check_doc_declarant_sdd_z_group_'+step_13_indexOfGroup);
						$('.step_13_info_3_group_document_detail_clone_'+step_13_indexOfGroup +'_'+ i).hide();
						if (isInArray(documents.document[i].key, idenDocCodes)){
							$('#step_13_name_doc_declarant_sdd_z_group_'+step_13_indexOfGroup+'_'+i).attr('step_13_identity_group', 'true');
						}
						writeDocument(documents.document[i], 'step_13_name_doc_declarant_sdd_z_group_'+step_13_indexOfGroup+'_'+i);	//15_07_13 by KAVlex
					}
					$('#step_13_add_group_doc_name_'+step_13_indexOfGroup).val('-');
				}
				return documents;
			}
			
		}
    }
    
    
    var step_13_codeSelectDocFromGroup2;
	var step_13_documens_length2;
    function step_13_Documents_callback2(xmlHttpRequest, status, dataResponse) {
		documents = null;
			idenDocCodes = getIndenDocFromDic(); 
		if (isResult([dataResponse, dataResponse.documents])){
			if (dataResponse.documents.document.length > 0) {
				documents = dataResponse.documents;
				step_13_documens_length2 = documents.document.length;
				newCloneSpan('step_13_info_7_group_document_clone_'+step_13_indexOfGroup2, documents.document.length, null);
				for (var i = 0; i < documents.document.length; i++){
					addOption(document.getElementById('step_13_name_doc_sdd_z_group_'+step_13_indexOfGroup2+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
					$('.step_13_check_doc_sdd_z_group_'+step_13_indexOfGroup2 +'_'+ i).attr("class", 'step_13_check_doc_sdd_z_group_'+step_13_indexOfGroup2);
					
					if (isInArray(documents.document[i].key, idenDocCodes)){
						$('#step_13_name_doc_sdd_z_group_'+step_13_indexOfGroup2+'_'+i).attr('step_13_identity_group', 'true');
					}
					writeDocument(documents.document[i], 'step_13_name_doc_sdd_z_group_'+step_13_indexOfGroup2+'_'+i);
				}

				$('#step_13_add_group_doc_name2_'+step_13_indexOfGroup2).val('-');

				return documents;
			}
		}
    }
    var step_13_chkDocId;
    function step_13_check_doc_declarant_sdd_z_group(el) {
    	var ind, indShort;
    	ind = $(el).attr('class').split('step_13_check_doc_declarant_sdd_z_group_').pop();
    	var chkFamilyMember = ind.split('_').shift();
    	
    	indShort = ind.substr(0, ind.length - ind.split('_').pop().length - 1); // вырезаем последний ноль из id  для правильного опрееления номера cloneNum
    	var chkDocId = $(el).attr('id');
    	step_13_chkDocId = chkDocId.split('step_13_check_doc_declarant_sdd_z_group_').pop();
    	var idNum = $(el).attr('id').split('step_13_check_doc_declarant_sdd_z_group_').pop();
    	if ($(el).is(':checked')){
    		
    		step_13_callWS_DocumentType(ind);

    		
    		if ($('#step_13_group_name_doc_declarant_sdd_z_'+indShort).val() == 'udPerson'){   //должно быть ==
				step_13_callWS_docIDFamilyMember(chkFamilyMember, step_13_InfUdPersonDocument_callback);
			} else {
				
				if (step_13_udPerson_flags[chkFamilyMember] === true) {
					step_13_callWS_InfDocument_groupDocs(chkDocId);
				}
				
			}
	
    		
    		$('.step_13_info_3_group_clone .step_13_info_3_group_document_clone_'+ind).removeAttr("checked");
            $(el).attr('checked', 'checked');
            $('.step_13_info_3_group_clone .step_13_info_3_group_document_clone_'+indShort+ ' fieldset').hide();
            $('fieldset#step_13_info_3_group_document_'+idNum).show();
        } else {
        	step_13_udPerson_flags[chkFamilyMember] = false;
        	$('.step_13_info_3_group_document_clone_'+indShort+' > fieldset').show();
        	$('.step_13_info_3_group_document_detail_'+idNum).hide();
        	setCheckBoxVisible('#step_13_doc_declarant_bring_himself_sdd_z_group_'+idNum, false, false);
        	setCheckBoxVisible('#step_13_in_SMEV_trustee_doc_sdd_z_document_group_'+idNum, false, false);
        }
	}
    
    
    function step_13_InfUdPersonDocument_callback(xmlHttpRequest, status, dataResponse) {
    	if (isResult([dataResponse, dataResponse.docIDFamilyMember])){
    		if (dataResponse.docIDFamilyMember.identificationdocument.length > 0) {
    			idDocFamilyMemberUdPerson = dataResponse.docIDFamilyMember;
        		var k = 0;
    			var doc = [];

        		for (var i=0; i<idDocFamilyMemberUdPerson.identificationdocument.length; i++){
    	    		if ($('#step_13_name_doc_declarant_sdd_z_group_' + step_13_chkDocId).val() == idDocFamilyMemberUdPerson.identificationdocument[i].code){  //для реалки должно быть ==
    	    			doc[k++] = idDocFamilyMemberUdPerson.identificationdocument[i];
    	    		}
        		}
        		step_13_proccessInfDocument(doc);
        		var idNum = step_13_chkDocId.split('_').shift();
        		$('select[step_13_identity_group=true]').each(function(){
        			if ( this.id.indexOf('step_13_name_doc_declarant_sdd_z_group_'+idNum == 0) ) {
    	    			var ind = this.id.substr('step_13_name_doc_declarant_sdd_z_group_'.length, this.id.length);
    	    			$('.step_13_doc_declarant_set_identity_doc_sdd_z_group_' + ind).change(function(){
    	    				var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
    	    				if (this.checked){
    	    					$('#step_13_name_doc_declarant_sdd_z_group_'+indClass).attr('step_13_confirmed', 'true');
    	    					step_13_udPerson_flags[idNum] = true;

						var group_document = $(this).closest("[name=step_13_info_3_group_document]");
						var doNameId =	group_document.find("[name=step_13_name_doc_declarant_sdd_z_group]").attr("id");
					    	var changeClass = $(this).attr("class");
						var params = [group_document.find("[name=step_13_doc_declarant_series_sdd_z_group]").attr("id"), group_document.find("[name=step_13_doc_declarant_number_sdd_z_group]").attr("id"), group_document.find("[name=step_13_doc_declarant_who_issued_sdd_z_group]").attr("id"), group_document.find("[name=step_13_doc_declarant_date_sdd_z_group]").attr("id")];
						var documentFL = getDocument(null, doNameId, changeClass, params);
						var el = this;
						$(this).closest('.step_13_info_3_all_docs_clone').find("select[step_13_identity=false]").each(function() {
							step_12_infDocumentWithoutGroupIndex = this.id.substr('step_13_name_doc_declarant_sdd_z_document_'.length, this.id.length);
							step_12_callWS_InfDocument(this.id, documentFL, step_12_InfDocumentWithoutGroup_callback, false);
							$(el).closest('.step_13_info_3_all_docs_clone').find('[step_13_identity_ownerdoc=false]').find("fieldset").show();
						});
    	    				} else {
    	    					$('#step_13_name_doc_declarant_sdd_z_group_'+indClass).removeAttr('step_13_confirmed');
    	    					step_13_udPerson_flags[idNum] = false;
						$(this).closest('.step_13_info_3_all_docs_clone').find('[step_13_identity_ownerdoc=false]').find("fieldset").hide();
    	    				}
    	    			});
        			}
        		});
        		
        		return idDocFamilyMemberUdPerson;
    		}
    	}
    	return null;
    }
    
    function step_13_proccessInfDocument(document){
    	//var Num = step_13_chkDocId.substr(0, step_13_chkDocId.length - 2);
		var array = [
						'step_13_doc_declarant_series_sdd_z_group_'+step_13_chkDocId,
						'step_13_doc_declarant_number_sdd_z_group_'+step_13_chkDocId,
						'step_13_doc_declarant_date_sdd_z_group_'+step_13_chkDocId,
						'step_13_doc_declarant_who_issued_sdd_z_group_'+step_13_chkDocId,
						'step_13_doc_declarant_set_identity_doc_sdd_z_group_'+step_13_chkDocId,
						'step_13_info_3_group_document_detail_'+step_13_chkDocId,
						'step_13_info_3_group_document_detail_clone_'+step_13_chkDocId,
						'step_13_name_doc_declarant_sdd_z_group_' +step_13_chkDocId
					];
		processDocumentDetails(document, array, 'step_13_doc_declarant_bring_himself_sdd_z_group_'+step_13_chkDocId);
    }
    
    
    function step_13_check_doc_sdd_z_group(el) {
    	var ind;	//, indShort
    	ind = $(el).attr('class').split('step_13_check_doc_sdd_z_group_').pop();	
    	indId = $(el).attr('id').split('step_13_check_doc_sdd_z_group_').pop();	//class <-->id by KAVlex
    	//indShort = ind.substr(0, ind.length - 2); // вырезаем последний ноль из id  для правильного опрееления номера cloneNum
    	
    	var idNum = $(el).attr('id').split('step_13_check_doc_sdd_z_group_').pop();
    	if ($(el).is(':checked')){
    		
    		step_13_callWS_DocumentType(indId);	//class <-->id by KAVlex
    		
            $(el).attr('checked', 'checked');
            $('.step_13_info_7_group_clone .step_13_info_7_group_document_clone_'+ind+ ' fieldset').hide();
            $('fieldset#step_13_info_7_group_document_'+idNum).show();
        } else {
        	$('.step_13_info_7_group_document_clone_'+ind+' > fieldset').show();
        	$('.step_13_info_7_group_document_detail_'+idNum).hide();
        	setCheckBoxVisible('#step_13_doc_bring_himself_sdd_z_group_'+idNum, false, false);
			setCheckBoxVisible('#step_13_in_SMEV_trustee_doc_sdd_z2_group_'+idNum, false, false);
        }
	}
	
    
    var step_13_selected_group_num;
    function step_13_callWS_DocumentType(ind){
    	step_13_selected_group_num = ind; 
		if ($('#step_13_add_family_member_sdd_z').is(':checked')) {	    	
			dataRequest = {"documentType":{"doc":$('select#step_13_name_doc_sdd_z_group_'+step_13_selected_group_num+' option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_13_DocumentType_callback, true);
		} else {
			dataRequest = {"documentType":{"doc":$('select#step_13_name_doc_declarant_sdd_z_group_'+step_13_selected_group_num + ' option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_13_DocumentType_callback, true);
		}
	}
	
	function step_13_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse, dataResponse.DocumentType])){
			documentType = dataResponse.DocumentType;
			if ($('#step_13_add_family_member_sdd_z').is(':checked')) {
				setCheckBoxVisible('#step_13_doc_bring_himself_sdd_z_group_'+step_13_selected_group_num, documentType.privateStorage, documentType.privateStorage);
				$('#step_13_doc_bring_himself_sdd_z_group_'+step_13_selected_group_num).val(documentType.privateStorage);
				setCheckBoxVisible('#step_13_in_SMEV_trustee_doc_sdd_z2_group_'+step_13_selected_group_num, documentType.interagency, documentType.interagency);
				$('#step_13_in_SMEV_trustee_doc_sdd_z2_group_'+step_13_selected_group_num).val(documentType.interagency);
			} else {
				setCheckBoxVisible('#step_13_doc_declarant_bring_himself_sdd_z_group_'+step_13_selected_group_num, documentType.privateStorage, documentType.privateStorage);
				$('#step_13_doc_declarant_bring_himself_sdd_z_group_'+step_13_selected_group_num).val(documentType.privateStorage);
				setCheckBoxVisible('#step_13_in_SMEV_trustee_doc_sdd_z_document_group_'+step_13_selected_group_num, documentType.interagency, documentType.interagency);
				$('#step_13_in_SMEV_trustee_doc_sdd_z_document_group_'+step_13_selected_group_num).val(documentType.interagency);
			}
			return documentType;
		}
		return null;
	}
	
	var step_13_check_doc_group;
    function step_13_callWS_InfDocument_groupDocs(chkDocId) {
		var indIdentity = chkDocId.split('step_13_check_doc_declarant_sdd_z_group_').pop();
		var groupNum = indIdentity.substr(0, indIdentity.length - 2); 
		var person_index = indIdentity.split('_').shift();
		step_13_check_doc_group = indIdentity;
		
		var doNameId = 'step_13_name_doc_declarant_sdd_z_group_'+indIdentity;
    	var changeClass = 'step_12_doc_declarant_set_identity_doc_mf_group_' + indIdentity;
    	
    	var idDoc = {"name": $('#step_13_name_doc_declarant_sdd_z_group_'+indIdentity+' option:selected').text(),"code": $('#step_13_name_doc_declarant_sdd_z_group_'+indIdentity+' option:selected').val()};
    	var idGroup = {"name": $('#step_13_group_name_doc_declarant_sdd_z_'+groupNum+' option:selected').text(),"code": $('#step_13_group_name_doc_declarant_sdd_z_'+groupNum+' option:selected').val()};
    	var params = ['step_13_doc_declarant_series_sdd_z_group_'+indIdentity,'step_13_doc_declarant_number_sdd_z_group_'+indIdentity, 'step_13_doc_declarant_who_issued_sdd_z_group_'+indIdentity, 'step_13_doc_declarant_date_sdd_z_group_'+indIdentity];
		var documentFL = getDocument(null, doNameId, changeClass, params);
		var fio = getFIO(['step_13_last_name_declarant_sdd_z_'+person_index, 'step_13_middle_name_declarant_sdd_z_' + person_index, 'step_13_first_name_declarant_sdd_z_' + person_index]);
		var identityFL = getIdentityFL(fio, 'step_13_birthday_declarant_sdd_z_'+person_index, documentFL);
    	
		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup": idGroup,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_13_callWS_InfDocument_groupDocs_callback, true);
    }
    
    function step_13_callWS_InfDocument_groupDocs_callback(xmlHttpRequest, status, dataResponse) {
    	if (isResult([dataResponse, dataResponse.infDocument]) ) {
    		if (dataResponse.infDocument.document.length > 0) {
    			infDocument = dataResponse.infDocument;
    			step_13_infDocument_groupDocs_length = infDocument.document.length;
    			var array = [
    				'step_13_doc_declarant_series_sdd_z_group_'+step_13_selected_group_num,
    				'step_13_doc_declarant_number_sdd_z_group_'+step_13_selected_group_num,
    				'step_13_doc_declarant_date_sdd_z_group_'+step_13_selected_group_num,
    				'step_13_doc_declarant_who_issued_sdd_z_group_'+step_13_selected_group_num,
    				'step_13_doc_declarant_set_identity_doc_sdd_z_group_'+step_13_selected_group_num,
    				'step_13_info_3_group_document_detail_'+step_13_selected_group_num,
    				'step_13_info_3_group_document_detail_clone_'+step_13_selected_group_num,
    				'step_13_name_doc_declarant_sdd_z_group_'+step_13_selected_group_num
    			];
    			processDocumentDetails(infDocument.document, array, 'step_13_doc_declarant_bring_himself_sdd_z_group_'+step_13_selected_group_num);
    			
        		return infDocument; 
    		}    		
    	} else {f
    		return null;
    	}
	}
    
    
  //--> клонирование блока элементов 13 шага
	function add_step_13_info(el) {
//		switchStateDateTimePicker(false);
		var newIdNum = Number($('input.step_13_last_name_family_member_sdd_z:last').attr('id').split('_').pop()) + 1;

		$('<span class="step_13_info_6_7_9_all_info_clone">'+step_13_info_6_7_9_all_info_default+'</span>').insertAfter('span[class="step_13_info_6_7_9_all_info_clone"]:last');
		$('span.step_13_info_6_7_9_all_info_clone:last span.step_13_info_6_clone').find('*').each(function(i){
			if (isNotUndefined($(this).attr('class'))&& $(this).attr('class').indexOf('step_') == 0) {
				var classEl = $(this).attr('class').split(' ')[0];
				$(this).attr('id', classEl + '_' + newIdNum);
			}
		});
		
		if (typeof step_13_all_docs_default_fill_self != 'undefined') {
			$('#step_13_info_7_all_docs_clone_' + newIdNum).html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_13_all_docs_default_fill_self+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
			$('#step_13_info_7_all_docs_clone_' + newIdNum).show();
			//$('fieldset#step_13_info_9_' + newIdNum).show();	//10_07_13
		}
		

		recalcIdAndCopyAttrChecked(newIdNum, 'step_13_info_7_all_docs_clone', 'step_13_info_7_document_clone', 'step_13_info_7_group_clone', 'step_13_doc_bring_himself_sdd_z_document', 'step_13_in_SMEV_trustee_doc_sdd_z2_document');
		setDictionary('relationDegree','step_13_relation_degree_family_member_sdd_z_' + newIdNum);
		
		$("input.delete_step_13_info:last").show();


		$(el).parent().css({'margin-right':'100px', 'margin-top':'-50px'});
		$(el).css({'margin-right':'140px', 'margin-top':'-50px'});
		switchStateDateTimePicker(true);
	}

	function delete_step_13_info(el) {
		$(el).closest('span.step_13_info_6_7_9_all_info_clone').remove();
		var add_btn = document.getElementsByClassName('add_step_13_info');
		if ($('span.step_13_info_6_7_9_all_info_clone').length == 1) {
			$(add_btn).parent().css({'margin-right':'0px', 'margin-top':'0px'});
			$(add_btn).css({'margin-right':'30px', 'margin-top':'-20px'});
		}
	}
    
    
	function isConfirmedUdDocs(step, name_doc, name_doc_group, confirmed_flag_doc, confirmed_flag_group, chk_doc) {
		var isConfirmed = false;
		$('select[step_'+step+'_identity=true]').each(function(){
			var ind = this.id.substr(name_doc+'_'.length, this.id.length);
			$('.'+confirmed_flag_doc+'_' + ind).change(function(){
				//var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
				if (this.checked){
					isConfirmed = true;
				} else {
					isConfirmed = false;
				}
			});
		});
		
		if (!isConfirmed) {
			$('select[step_'+step+'_identity_group=true]').each(function(){
				var ind = this.id.substr(name_doc_group+'_'.length, this.id.length);
				$('.'+confirmed_flag__group+'_' + ind).change(function(){
					//var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
					if (this.checked){
						isConfirmed = true;
					} else {
						isConfirmed = false;
					}
				});
			});
		}
		
		$('#'+chk_doc+'_'+ ind).change(function(){
			if (!this.checked) {
				isConfirmed = false;
			}
		});
		
		return isConfirmed;
	}
	
	
	
	var step_14_udPerson_flag = false;
	var step_14_udPerson_flags = new Object();
	var step_14_all_docs_default;
	function openStep_14() {
		switchStateDateTimePicker(false);
		// Прячем элементы блока документов при запонении полей, пришедших из ВИС
		$('fieldset.step_14_info_5').hide();
		$('.step_14_info_3_all_docs_clone').hide();
		$('fieldset#step_14_info_3').hide();
		$('#step_14_info_3_document_detail_clone').hide();
		$('#step_14_info_3_group_document_clone').hide();
		$('#step_14_doc_declarant_bring_himself_sdd_nz_group').closest('tr').hide();
		$('#step_14_in_SMEV_trustee_doc_sdd_nz_group').closest('tr').hide();
		$('#step_14_info_3_group_document_clone').hide();
		$('table.step_14_address_person_table').hide();
		
		
		// Прячем элементы блока документов при запонении полей вручную
		
		$('fieldset[id="step_13_info_6_7_8"]').hide();
		$('.step_14_info_7_all_docs_clone').hide();
		$('fieldset#step_14_info_7').hide();
		$('#step_14_info_7_group_document_clone').hide();
		$('#step_14_in_SMEV_trustee_doc_sdd_nz2_group').closest('tr').hide();
		$('#step_14_doc_bring_himself_sdd_nz_group').closest('tr').hide();
		$('#step_14_info_7_group_document_clone').hide();
		
		
		step_14_info_6_7_8_all_info_default = $('span.step_14_info_6_7_8_all_info_clone').html();
		// клонируем блок для ручного ввода данных, для корректной работы логики по запросу документов.
		array = [
					'step_14_last_name_family_member_sdd_nz',
					'step_14_first_name_family_member_sdd_nz',
					'step_14_middle_name_family_member_sdd_nz',
					'step_14_birthday_family_member_sdd_nz',
					'step_14_relation_degree_family_member_sdd_nz',
					'step_14_presence_dependency_family_member_sdd_nz',
					'step_14_info_6',
					'step_14_info_8',
					'step_14_in_SMEV_trustee_doc_registration_address2',
					'step_14_info_7_all_docs_clone'
				];
		switchStateDateTimePicker(false);
		newCloneSpan('step_14_info_6_clone', 1, array);
		
		idOrg = getIdOrg();
		var identityFL = getIdentityFLFromStep_4();
		var addressRegistration;
		if (getCheckedRadioValue('step_1_acting_person') == "self") {
			// Адрес берем из СИА
			// TODO  АДРЕС нужен или нет?
//			addressRegistration =  {"district":"район","room":"5","body":"а","Structure":"2","region":{"reduction":"сокращение","name":"наименование"},"populatedLocality":{"reduction":"сокращение","name":"наименование"},"downPopulatedLocality":{"reduction":"сокращение","name":"наименование"},"street":{"reduction":"сокращение","name":"наименование","kodKLADR":"235235235"},"house":"1","country":"страна","apartment":"1"};
			addressRegistration =  {};
		} else {
			// Адрес берем из ВИС
			addressRegistration = get_vis_address_from_step_4();
		}
		
		dataRequest = {"relationshipNotRegistration":{"idOrg":idOrg,"addressRegistration":addressRegistration,"identityFL":identityFL}};
	    callWebS(VISurl, dataRequest, step_14_callWS_RelationshipNotRegistration_callback, true);

	    step_13_14_callWS_GroupOfDocuments();
		
//		switchStateDateTimePicker(false);
	    switchStateDateTimePicker(true);
	}
	
	function step_14_callWS_RelationshipNotRegistration_callback(xmlHttpRequest, status, dataResponse) {
		var familyMembers = null;
				
		array = [
					'step_14_last_name_declarant_sdd_nz',
					'step_14_first_name_declarant_sdd_nz',
					'step_14_middle_name_declarant_sdd_nz',
					'step_14_birthday_declarant_sdd_nz',
					'step_14_presence_dependency_sdd_nz',
					'step_14_relation_degree_sdd_nz',
					'step_14_set_family_member_sdd_nz',
					'step_14_info_2',
					'step_14_info_5',
					'step_14_registration_address_sdd_nz',
					'step_14_set_registration_address_sdd_nz',
					'step_14_in_SMEV_trustee_doc_registration_address1',
					'step_14_info_3_all_docs_clone'
				];
		
		
		
		if (isResult([dataResponse])) {
			if (dataResponse.relationshipNotRegistration.familyMember.length > 0) {
				familyMembers = dataResponse.relationshipNotRegistration;
				
				newCloneSpan('step_14_info_2_clone', familyMembers.familyMember.length, array);
				for (var i=0; i<familyMembers.familyMember.length; i++) {
					$('#step_14_last_name_declarant_sdd_nz_'+i).val(familyMembers.familyMember[i].fio.surname);
					$('#step_14_first_name_declarant_sdd_nz_'+i).val(familyMembers.familyMember[i].fio.name);
					$('#step_14_middle_name_declarant_sdd_nz_'+i).val(familyMembers.familyMember[i].fio.patronymic);
					$('#step_14_birthday_declarant_sdd_nz_'+i).val(familyMembers.familyMember[i].dateOfBirth);
					setCheckBox('#step_14_presence_dependency_sdd_nz_'+i, familyMembers.familyMember[i].dependent);
					if ( isNotUndefined(familyMembers.familyMember[i].relationDegree) && (familyMembers.familyMember[i].relationDegree != '') ) {
						$('#step_14_relation_degree_sdd_nz_' + i).val(familyMembers.familyMember[i].relationDegree);
						$('#step_14_relation_degree_sdd_nz_' + i).attr('selected', 'selected');
						$('#step_14_relation_degree_sdd_nz_' +i).closest('td').show();
						$('.step_14_relation_degree_label').parent('td').show();					
					}						
				}		
				$('span#step_14_add_family_member_mf_chk').show();
			} else {
				$('fieldset#step_14_info_6_7_8').show();
				$('span.step_14_info_2_clone').hide();
				$('#step_14_add_family_member_sdd_nz').attr('checked', 'checked');
				$('span#step_14_add_family_member_mf_chk').show();
			}
		} else {
			$('fieldset#step_14_info_6_7_8').show();
			$('span.step_14_info_2_clone').hide();
			$('#step_14_add_family_member_sdd_nz').attr('checked', 'checked');
			$('span#step_14_add_family_member_mf_chk').show();
		}
		return familyMembers;
	}

	function setCheckNIdAndClass(selector, idNum){
			$(selector).find('*').each(function(i){
				if (isNotUndefined($(this).attr('class'))&& $(this).attr('class').indexOf('step_') == 0) {
					var classEl = $(this).attr('class');
					var classParts = classEl.split('_');
					var classNum = classParts.pop(); 
					var newClassEl = classEl.substr(0, classEl.length - 1) + idNum + '_' + classNum; 
					$(this).removeClass(classEl);
					$(this).addClass(newClassEl);
					$(this).attr('id',newClassEl);
				}else
					checkAndCreateDatePicker(this);
			});
	}
	
	var step_14_indexOfFamilyMember;
	function step_14_set_family_member_sdd_nz(el) {
	// данный блок кода необходим занести аттрибута checked пришедих документов
	// для дальнейщего переноса в клонируемые блоки
		var id = $(el).attr('id');
		var idParts = id.split('_');
		var idNum = idParts.pop();  // вычисляется номер блока, где выбран член семьи
		step_14_indexOfFamilyMember = idNum;
		if (el.checked){  
			
			if (typeof step_14_all_docs_default != 'undefined') {
				$('#step_14_info_3_all_docs_clone_'+idNum).html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_14_all_docs_default+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
				$('#step_14_info_3_all_docs_clone_'+idNum).show();
				$('fieldset#step_14_info_5_'+idNum).show();
			}
			
			
			$('fieldset[id="step_14_info_6_7_8"]').hide();
//			$('span#step_14_add_family_member_mf_chk').hide();
			$('#step_14_add_family_member_sdd_nz').removeAttr('checked');
									
//			Всем элементам  принадлежащим одиночным документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc 
			setCheckNIdAndClass('#step_14_info_3_all_docs_clone_'+idNum+' span.step_14_info_3_document_clone', idNum);
			// Всем элементам  принадлежащим группе документов документам проставляется  id и class, изначально проставив номер чекнутого блока, т.e _0_k_l_ etc or _1_k_l etc
			setCheckNIdAndClass('#step_14_info_3_all_docs_clone_'+idNum+' span.step_14_info_3_group_clone', idNum);
			
			// данный блок кода необходим для переноса аттрибута checked 
			// всех чекбоксов из дефолтного блока в выбранный пользователем
			var i=0;
			var j=0;
			
			$('span#step_14_info_3_all_docs_clone_'+idNum+' span.step_14_info_3_document_clone').each(function(){
				if ( $(this).css('display') != 'none' ) {
					$('input#step_14_doc_declarant_bring_himself_sdd_nz_document_'+idNum+'_'+j).attr('checked', singleFlagsArray[i]); 
					$('input#step_14_in_SMEV_trustee_doc_sdd_nz_document_'+idNum+'_'+j).attr('checked', groupFlagsArray[i]);											
					i++;
					j++;
				}
			});
			step_14_callWS_DocIDFamilyMemberRegAddress();
			 
			// TODO  нужно или все брать из MemberRegAddress ???
//			step_14_callWS_docIDFamilyMember(idNum, step_13_callWS_docIDFamilyMember_callback);
		} else {
			$('#step_14_info_3_all_docs_clone_'+idNum).hide();
			$('fieldset[id="step_14_info_6_7_8"]').hide();
			$('fieldset[class="step_14_info_5"]').hide();
		}

	}

	familyMemberUdPersonDoc = new Object();
	step_14_addressReg = new Object();
	function step_14_callWS_DocIDFamilyMemberRegAddress() {
		idOrg = getIdOrg();
		var fio = {"surname": $('#step_14_last_name_declarant_sdd_nz_'+step_14_indexOfFamilyMember).val(),"patronymic":$('#step_14_middle_name_declarant_sdd_nz_'+step_14_indexOfFamilyMember).val(),"name": $('#step_14_first_name_declarant_sdd_nz_'+step_14_indexOfFamilyMember).val()};
		var dateOfBirth = $('#step_14_birthday_declarant_sdd_nz_'+step_14_indexOfFamilyMember).val();
		var identityFL = getIdentityFLFromStep_4();
		var addressRegistration;
		if (getCheckedRadioValue('step_1_acting_person') == "self") {
			// Адрес берем из СИА
			// TODO  АДРЕС нужен или нет?
//			addressRegistration = {"district":"район","room":"5","body":"а","Structure":"2","region":{"reduction":"сокращение","name":"наименование"},"populatedLocality":{"reduction":"сокращение","name":"наименование"},"downPopulatedLocality":{"reduction":"сокращение","name":"наименование"},"street":{"reduction":"сокращение","name":"наименование","kodKLADR":"235235235"},"house":"1","country":"страна","apartment":"1"};
			addressRegistration =  {};
		} else {
			// Адрес берем из ВИС
			addressRegistration = get_vis_address_from_step_4();
		}
		

		dataRequest = {"docIDFamilyMemberRegAddress":{"idOrg":idOrg,"relative":{"fio":fio,"dateOfBirth":dateOfBirth},"addressRegistration":addressRegistration,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_14_callWS_DocIDFamilyMemberRegAddress_callback, true);

	}
	
	
	function step_14_callWS_DocIDFamilyMemberRegAddress_callback(xmlHttpRequest, status, dataResponse) {
		step_14_docIDFamilyMember = null;
		if (isResult([dataResponse, dataResponse.docIDFamilyMemberRegAddress])) {
			step_14_docIDFamilyMember = dataResponse.docIDFamilyMemberRegAddress;
			var addressRegistration = step_14_docIDFamilyMember.addressRegistration;
			is_step_14_registration_address(false, true);
			$('#step_14_registration_address_sdd_nz_'+step_14_indexOfFamilyMember).val(addressToString(addressRegistration));
			familyMemberUdPersonDoc[step_14_indexOfFamilyMember] = step_14_docIDFamilyMember.identificationdocument[0];
			step_14_addressReg[step_14_indexOfFamilyMember] = step_14_docIDFamilyMember.addressRegistration;
			$('#step_14_set_registration_address_sdd_nz_'+step_14_indexOfFamilyMember).change(function(){
				if (this.checked) {
					$('#step_14_registration_address_sdd_nz_'+step_14_indexOfFamilyMember).closest('tr').show();
				} else {
					$('#step_14_registration_address_sdd_nz_'+step_14_indexOfFamilyMember).closest('tr').hide();
				}
			});
		} else {
    		is_step_14_registration_address(false, false);
    		$('#step_14_registration_address_sdd_nz_'+step_14_indexOfFamilyMember).closest('tr').hide();
    		$('#step_14_set_registration_address_sdd_nz_'+step_14_indexOfFamilyMember).closest('tr').hide();
			$('select[name="step_14_name_doc_declarant_sdd_nz_document"]').each(function(){
    			if (this.id.indexOf('step_14_name_doc_declarant_sdd_nz_document_') == 0){
    		    	for (var i=0; i<idDocFamilyMember.identificationdocument.length; i++){
    		    		if ($(this).val() == idDocFamilyMember.identificationdocument[i].code){  
    		    			var ind = this.id.split('_').pop();
    		    			var array = [
    		    				'step_14_doc_declarant_series_sdd_nz_document_'+ind,
    		    				'step_14_doc_declarant_number_sdd_nz_document_'+ind,
    		    				'step_14_doc_declarant_date_sdd_nz_document_'+ind,
    		    				'step_14_doc_declarant_who_issued_sdd_nz_document_'+ind,
    		    				'step_14_doc_declarant_set_identity_doc_sdd_nz_document_'+ind,
    		    				'step_14_info_3_document_detail_'+ind,
    		    				'step_14_info_3_document_detail_clone_'+ind,
    		    				'step_14_name_doc_declarant_sdd_nz_document_'+ind
    		    			];
    		    			processDocumentDetails(idDocFamilyMember.identificationdocument, array, 'step_14_doc_declarant_bring_himself_sdd_nz_document_'+ind);
    		    			break;
    		    		}
    		    	}
    			}
    		});
			$('select[step_14_identity=true]').each(function(){
				if ( this.id.indexOf('step_14_name_doc_declarant_sdd_nz_document_'+idNum == 0) ) {
	    			var ind = this.id.substr('step_14_name_doc_declarant_sdd_nz_document_'.length, this.id.length);
	    			$('.step_14_doc_declarant_set_identity_doc_sdd_nz_document_' + ind).change(function(){
	    				var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
	    				if (this.checked){
	    					if ($('[step_14_confirmed=true]').length == 0){
			    				$('select[step_14_identity=false]').each(function() {
			    						infDocumentWithoutGroupIndex = this.id.substr('step_14_name_doc_declarant_sdd_nz_document_'.length, this.id.length);
			    						step_14_callWS_InfDocument(this.id, ind);
								});
	    					}
	    					$('#step_14_name_doc_declarant_sdd_nz_document_'+indClass).attr('step_14_confirmed', 'true');
	    					step_14_udPerson_flags[idNum] = true;
	    				} else {
	    					step_14_udPerson_flags[idNum] = false;
	    					$('#step_14_name_doc_declarant_sdd_nz_document_'+indClass).removeAttr('step_14_confirmed');
	    					if ($('[step_14_confirmed=true]').length == 0)
	    						$('[step_14_identity_ownerdoc=false]').hide();	//мб remove??
	    				}
	    			});
				}
    		});
			return step_14_docIDFamilyMember;
		}
		return null;
	}
	
	function step_14_callWS_InfDocument(ind, indIdentity) {
    	var person_index = ind.split('_').shift();
		// Получение массива кодов документов удостоверяющих личность
			idenDocCodes = getIndenDocFromDic(); 
		
		newCloneSpan('step_14_info_3_document_detail_clone_'+ind, 1, null);
		
		$('#step_14_doc_declarant_date_sdd_nz_document_'+ind+'_0').val(familyMemberUdPersonDoc[person_index].dateIssue);
		if (typeof familyMemberUdPersonDoc[0].params.param.length == 'undefined') {
			if (familyMemberUdPersonDoc[person_index].params.param.code == DocumentsNumber) {
				$('#step_14_doc_declarant_number_sdd_nz_document_'+ind+'_0').val(familyMemberUdPersonDoc[person_index].params.param.value);
			} else if (familyMemberUdPersonDoc[person_index].params.param.code == DocumentSeries) {
				$('#step_14_doc_declarant_series_sdd_nz_document_'+ind+'_0').val(familyMemberUdPersonDoc[person_index].params.param.value);
			} else if (familyMemberUdPersonDoc[person_index].params.param.code == GiveDocumentOrg) {
				$('#step_14_doc_declarant_who_issued_sdd_nz_document_'+ind+'_0').val(familyMemberUdPersonDoc[person_index].params.param.value);
			}
			if (familyMemberUdPersonDoc[person_index].dateIssue != '' && familyMemberUdPersonDoc[person_index].params.param.code == DocumentsNumber && familyMemberUdPersonDoc[person_index].params.param.value != '') {
				$('span#step_14_info_3_document_detail_clone_'+ind+'_0').show();
			}
		} else {
			for (var j=0; j<familyMemberUdPersonDoc[person_index].params.param.length; j++){
				var param = familyMemberUdPersonDoc[person_index].params.param[j];				
				if (param.code == DocumentsNumber){
					$('#step_14_doc_declarant_number_sdd_nz_document_'+ind+'_0').val(param.value);
					if ( (param.value != null) && (param.value != '') && (isNotUndefined(param.value)) ) {
						$('span#step_14_info_3_document_detail_clone_'+ind+'_0').show();
					}
				} else if (param.code == DocumentSeries){
					$('#step_14_doc_declarant_series_sdd_nz_document_'+ind+'_0').val(param.value);		
				} else if (param.code == GiveDocumentOrg){
					$('#step_14_doc_declarant_who_issued_sdd_nz_document_'+ind+'_0').val(param.value);
				}	
			}
		}
		
		if (indIdentity == -1){
	    	$('select[name=step_14_name_doc_declarant_sdd_nz_document]').each(function(){
	    		//если это документ удостоверяющий личность
	    		if (isInArray($(this).val(), idenDocCodes)){  //для реалки должно быть ==
	    			var changeOneInd = this.id.substr('step_14_name_doc_declarant_sdd_nz_document'.length, this.id.length);
	    			if ($('#step_14_doc_declarant_set_identity_doc_sdd_nz_document'+changeOneInd).attr("checked")){	//подтверждены реквизиты дока удостоверяющего личность
	    				step_14_udPerson_flags[idNum] = true;
	    				indIdentity = this.id.substr('step_14_name_doc_declarant_sdd_nz_document_'.length, this.id.length);
	    				return false;
	    			}
	    		}
	    	});
	    	if (indIdentity = -1){
	    		return false;
	    	}
		}

	}

	
	
	function is_step_14_registration_address(reset, isAddress){
		var familyMemberNum = getCheckedCloneIndex('step_14_set_family_member_sdd_nz');
        if (reset){
            $('#step_14_info_5_'+familyMemberNum).hide();
        } else if (isAddress) {
            $('#step_14_info_5_'+familyMemberNum).show();
            setCheckBoxVisible('#step_14_registration_address_sdd_nz_'+familyMemberNum, true);    //не чекбокс, но функция подходящая))
            $('#step_14_registration_address_sdd_nz_'+familyMemberNum).attr('disabled', 'disabled');
            setCheckBoxVisible('#step_14_set_registration_address_sdd_nz_'+familyMemberNum, true, true);
        } else {
            $('#step_14_info_5_'+familyMemberNum).show();
            setCheckBoxVisible('#step_14_registration_address_sdd_nz_'+familyMemberNum, false);    //не чекбокс, но функция подходящая))
            $('#step_14_registration_address_sdd_nz_'+familyMemberNum).attr('disabled', 'disabled');
            setCheckBoxVisible('#step_14_set_registration_address_sdd_nz_'+familyMemberNum, false);
        }
    }
	
	
	
	var step_14_indexOfGroup;
	function step_14_getDocsByGroup(el) {
		var idSplitArr = el.id.split('step_14_add_group_doc_name_');
		step_14_indexOfGroup = idSplitArr[1];
		if (el.value == '+'){
			if ($('.step_14_info_3_group_document_clone_'+step_14_indexOfGroup).length > 1){
				$('.step_14_info_3_group_document_clone_'+step_14_indexOfGroup).show();
				el.value = '-';
			} else {
				step_14_callWS_Documents();
			}
		} else {
			$('.step_14_info_3_group_document_clone_'+step_14_indexOfGroup).hide();
			el.value = '+';
		}
		$('#step_14_info_3_group_document_clone_'+step_14_indexOfGroup).hide();	
	}
	
	var step_14_indexOfGroup2;
	function step_14_getDocsByGroup2(el) {
		var idSplitArr = el.id.split('step_14_add_group_doc_name2_');
		step_14_indexOfGroup2 = idSplitArr[1];
		if (el.value == '+'){
			if ($('.step_14_info_7_group_document_clone_'+step_14_indexOfGroup2).length > 1){
				$('.step_14_info_7_group_document_clone_'+step_14_indexOfGroup2).show();
				el.value = '-';
			} else {
				step_14_callWS_Documents();
			}
		} else {
			$('.step_14_info_7_group_document_clone_'+step_14_indexOfGroup2).hide();
			el.value = '+';
		}
		$('#step_14_info_7_group_document_clone_'+step_14_indexOfGroup2).hide();	
	}
	
	
	function step_14_callWS_Documents() {
		var groupDocsCode;
		if ($('#step_14_add_family_member_sdd_nz').is(':checked')) {
			groupDocsCode = $('select#step_14_group_name_doc_sdd_nz_'+step_14_indexOfGroup2+ ' option:selected').val();
			dataRequest = {"documents":{"doc": groupDocsCode}};
	    	callWebS(ARTKMVurl, dataRequest, step_14_Documents_callback, true);
		} else {
			groupDocsCode = $('select#step_14_group_name_doc_declarant_sdd_nz_'+step_14_indexOfGroup+ ' option:selected').val();
			dataRequest = {"documents":{"doc": groupDocsCode}};
	    	callWebS(ARTKMVurl, dataRequest, step_14_Documents_callback, true);
		}
	}
	
	
	var step_14_documens_length;
    function step_14_Documents_callback(xmlHttpRequest, status, dataResponse) {
		documents = null;
			idenDocCodes = getIndenDocFromDic(); 
		if (isResult([dataResponse, dataResponse.documents])){
			if (dataResponse.documents.document.length > 0) {
				documents = dataResponse.documents;
				step_14_documens_length = documents.document.length;
				if ($('#step_14_add_family_member_sdd_nz').is(':checked')) {
					newCloneSpan('step_14_info_7_group_document_clone_'+step_14_indexOfGroup2, documents.document.length, null);
					for (var i = 0; i < documents.document.length; i++){
						addOption(document.getElementById('step_14_name_doc_sdd_nz_group_'+step_14_indexOfGroup2+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
						$('.step_14_name_doc_sdd_nz_group_'+step_14_indexOfGroup2 +'_'+ i).attr("class", 'step_14_name_doc_sdd_nz_group_'+step_14_indexOfGroup2);
						
						if (isInArray(documents.document[i].key, idenDocCodes)){
							$('#step_14_name_doc_sdd_nz_group_'+step_14_indexOfGroup2+'_'+i).attr('step_14_identity_group', 'true');
						}
						writeDocument(documents.document[i], 'step_14_name_doc_sdd_nz_group_'+step_14_indexOfGroup2+'_'+i);	//15_07_13 by KAVlex
					}
					$('#step_14_add_group_doc_name2_'+step_14_indexOfGroup2).val('-');
				} else {
					newCloneSpan('step_14_info_3_group_document_clone_'+step_14_indexOfGroup, documents.document.length, null);
					for (var i = 0; i < documents.document.length; i++){
						addOption(document.getElementById('step_14_name_doc_declarant_sdd_nz_group_'+step_14_indexOfGroup+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
						$('.step_14_name_doc_declarant_sdd_nz_group_'+step_14_indexOfGroup +'_'+ i).attr("class", 'step_14_name_doc_declarant_sdd_nz_group_'+step_14_indexOfGroup);
						$('.step_14_info_3_group_document_detail_clone_'+step_14_indexOfGroup +'_'+ i).hide();
						if (isInArray(documents.document[i].key, idenDocCodes)){
							$('#step_14_name_doc_declarant_sdd_nz_group_'+step_14_indexOfGroup+'_'+i).attr('step_14_identity_group', 'true');
						}
						writeDocument(documents.document[i], 'step_14_name_doc_declarant_sdd_nz_group_'+step_14_indexOfGroup+'_'+i);	//15_07_13 by KAVlex
					}
					$('#step_14_add_group_doc_name_'+step_14_indexOfGroup).val('-');
				}
				return documents;
			}
		}
    }
    
    function step_14_check_doc_declarant_sdd_z_group(el) {
    	var ind, indShort;
    	ind = $(el).attr('class').split('step_14_check_doc_declarant_sdd_nz_group_').pop();
    	var chkFamilyMemberNum =  ind.substr(0, 1); // определение номера выбранного члена семьи
    	///indShort = ind.substr(0, ind.length - 2); // вырезаем последний ноль из id  для правильного опрееления номера cloneNum
    	//by KAVLex{		прячем все документы, если один выбран
			var lastInd = ind.split('_').pop();
			indShort = ind.substr(0, ind.length - lastInd.length - 1);
		//}by KAVLex
    	var docNum = ind;
    	var idNum = $(el).attr('id').split('step_14_check_doc_declarant_sdd_nz_group_').pop();
    	if ($(el).is(':checked')){
    		
    		step_14_callWS_DocumentType(docNum);

    		if ( $('#step_14_group_name_doc_declarant_sdd_nz_'+step_14_indexOfGroup+ ' option:selected').val() == 'udPerson' ) {
    			if ( $('#step_14_name_doc_declarant_sdd_nz_group_'+ind+ ' option:selected').val() == familyMemberUdPersonDoc[chkFamilyMemberNum].code) {
    				newCloneSpan('step_14_info_3_group_document_detail_clone_'+ind, 1, null);
    				$('span#step_14_info_3_group_document_detail_clone_'+ind+'_0').show();
//    				$('#step_14_doc_declarant_series_sdd_nz_group_'+step_14_indexOfGroup+'_'+docNum+'_0').val(familyMemberUdPersonDoc[chkFamilyMemberNum].params.param);
    				$('#step_14_doc_declarant_date_sdd_nz_group_'+ind+'_0').val(familyMemberUdPersonDoc[chkFamilyMemberNum].dateIssue);
    				
    				if (typeof familyMemberUdPersonDoc[0].params.param.length == 'undefined') {
    					if (familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.code == DocumentsNumber) {
        					$('#step_14_doc_declarant_number_sdd_nz_group_'+ind+'_0').val(familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.value);
        				} else if (familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.code == DocumentSeries) {
        					$('#step_14_doc_declarant_series_sdd_nz_group_'+ind+'_0').val(familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.value);
        				} else if (familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.code == GiveDocumentOrg) {
        					$('#step_14_doc_declarant_who_issued_sdd_nz_group_'+ind+'_0').val(familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.value);
        				}
    				} else {
    					// TODO если params.param - массив, то обработать как массив
    					for (var j=0; j<familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.length; j++){
    						var param = familyMemberUdPersonDoc[chkFamilyMemberNum].params.param[j];				
    						if (param.code == DocumentsNumber){
    							$('#step_14_doc_declarant_number_sdd_nz_group_'+ind+'_0').val(param.value);
    							if ( (param.value != null) && (param.value != '') && (isNotUndefined(param.value)) ) {
    								$('span#step_14_info_3_document_detail_clone_'+ind+'_0').show();
    							} else {
    								$('span#step_14_info_3_document_detail_clone_'+ind+'_0').hide();
    							}
    						} else if (param.code == DocumentSeries){
    							$('#step_14_doc_declarant_series_sdd_nz_group_'+ind+'_0').val(param.value);		
    						} else if (param.code == GiveDocumentOrg){
    							$('#step_14_doc_declarant_who_issued_sdd_nz_group_'+ind+'_0').val(param.value);
    						}	
    					}
    				}

    				$('.step_14_info_3_group_clone .step_14_info_3_group_document_clone_'+indShort+ ' fieldset').hide();
    	            $('fieldset#step_14_info_3_group_document_'+ind).show();
    	            if (familyMemberUdPersonDoc[chkFamilyMemberNum].dateIssue != '' && familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.code == DocumentsNumber && familyMemberUdPersonDoc[chkFamilyMemberNum].params.param.value != '') {
    	            	$('fieldset#step_14_info_3_group_document_detail_'+ind+'_0').show();
    	    		}
    	            
    	            $('#step_14_doc_declarant_set_identity_doc_sdd_nz_group_'+ind+'_0').attr('document', 'step_14_name_doc_declarant_sdd_nz_group_'+ind);
    	            $('#step_14_doc_declarant_set_identity_doc_sdd_nz_group_'+ind+'_0').change(function(){
    	            	var indClass = $(this).attr('class').substr($(this).attr('name').length + 1, $(this).attr('class').length);
	    				if (this.checked){
	    					$('#step_14_name_doc_declarant_sdd_nz_group_'+indClass).attr('step_14_confirmed', 'true');
	    					step_14_udPerson_flags[chkFamilyMemberNum] = true;
	    					setCheckBoxVisible('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+ind, false, false);
	    				} else {
	    					$('#step_14_name_doc_declarant_sdd_nz_group_'+indClass).removeAttr('step_14_confirmed');
	    					var val = $('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+ind).val();
	    					setCheckBoxVisible('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+ind, val, val);
	    					//$('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+ind).attr('checked', $('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+ind).val());
	    					step_14_udPerson_flags[chkFamilyMemberNum] = false;
	    				}
    	            });
    	            
    			}
    		} else {
    			if (step_14_udPerson_flags[chkFamilyMemberNum] === true) {
    				step_14_callWS_InfDocument_groupDocs(step_14_indexOfGroup, docNum);
        			$('.step_14_info_3_group_clone .step_14_info_3_group_document_clone_'+indShort+ ' fieldset').hide();
        			$('fieldset#step_14_info_3_group_document_'+idNum).show();
        			
    			}
    			
    		}
    		//by KAVLex{		прячем все документы, если один выбран
				//hideAllWithoutThis('step_14_info_3_group_document_'+indShort, lastInd);
    			$('.step_14_info_3_group_document_clone_'+indShort+ ' > fieldset').hide();
    			$('fieldset#step_14_info_3_group_document_'+idNum).show();
    		//}by KAVLex
            $(el).attr('checked', 'checked');
            $('fieldset#step_14_info_3_group_document_'+ind).show();
        } else {
        	step_14_udPerson_flags[chkFamilyMemberNum] = false;
        	$('.step_14_info_3_group_document_clone_'+indShort+' > fieldset').show();
        	$('.step_14_info_3_group_document_detail_'+idNum).hide();
        	$('fieldset#step_14_info_3_group_document_detail_'+ind+'_0').hide();
        	setCheckBoxVisible('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+idNum, false, false);
			setCheckBoxVisible('#step_14_in_SMEV_trustee_doc_sdd_nz_group_'+idNum, false, false);
			//by KAVLex{	показываем, когда убрали галочку
				//showAllWithoutDefault('step_14_info_3_group_document_'+indShort);
			//}by KAVLex
        }
	}
    
    function step_14_check_doc_sdd_nz_group(el) {
    	var ind, indShort;
    	ind = $(el).attr('class').split('step_14_check_doc_sdd_nz_group_').pop();
    	indShort = ind.substr(0, ind.length - 2); // вырезаем последний ноль из id  для правильного опрееления номера cloneNum
    	
    	var idNum = $(el).attr('id').split('step_14_check_doc_sdd_nz_group_').pop();
    	if ($(el).is(':checked')){
    		
    		step_14_callWS_DocumentType(ind);
    		
            $(el).attr('checked', 'checked');
            $('.step_14_info_7_group_clone .step_14_info_7_group_document_clone_'+indShort+ ' fieldset').hide();
            $('fieldset#step_14_info_7_group_document_'+idNum).show();
        } else {
        	$('.step_14_info_7_group_document_clone_'+indShort+' > fieldset').show();
        	$('.step_14_info_7_group_document_detail_'+idNum).hide();
        	setCheckBoxVisible('#step_14_doc_bring_himself_sdd_nz_group_'+idNum, false, false);
			setCheckBoxVisible('#step_14_in_SMEV_trustee_doc_sdd_nz2_group_'+idNum, false, false);
        }
	}
    
    
    var step_14_selected_group_num;
    function step_14_callWS_DocumentType(ind){
    	step_14_selected_group_num = ind; 
    	
		if ($('#step_14_add_family_member_sdd_nz').is(':checked')) { 	
			dataRequest = {"documentType":{"doc":$('select#step_14_name_doc_sdd_nz_group_'+step_14_selected_group_num+' option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_14_DocumentType_callback, true);
		} else {
			//var cloneNum = getCheckedCloneIndex('step_14_name_doc_declarant_sdd_nz_group_'+step_14_selected_group_num);	    	
			dataRequest = {"documentType":{"doc":$('select#step_14_name_doc_declarant_sdd_nz_group_'+step_14_selected_group_num + ' option:selected').val()}};
			callWebS(ARTKMVurl, dataRequest, step_14_DocumentType_callback, true);
		}
	}
	
	function step_14_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse, dataResponse.DocumentType])){
			documentType = dataResponse.DocumentType;
			if ($('#step_14_add_family_member_sdd_nz').is(':checked')) {
				setCheckBoxVisible('#step_14_doc_bring_himself_sdd_nz_group_'+step_14_selected_group_num, documentType.privateStorage, documentType.privateStorage);
				$('#step_14_doc_bring_himself_sdd_nz_group_'+step_14_selected_group_num).val(documentType.privateStorage);
				setCheckBoxVisible('#step_14_in_SMEV_trustee_doc_sdd_nz2_group_'+step_14_selected_group_num, documentType.interagency, documentType.interagency);
			} else {
				//var cloneNum = getCheckedCloneIndex('step_14_check_doc_declarant_sdd_nz_group_'+step_14_selected_group_num);
				setCheckBoxVisible('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+step_14_selected_group_num, documentType.privateStorage, documentType.privateStorage);
				setCheckBoxVisible('#step_14_in_SMEV_trustee_doc_sdd_nz_group_'+step_14_selected_group_num, documentType.interagency, documentType.interagency);
				$('#step_14_doc_declarant_bring_himself_sdd_nz_group_'+step_14_selected_group_num).val(documentType.privateStorage);
			}
			return documentType;
		}
		return null;
	}

    function step_14_callWS_InfDocument_groupDocs(groupNum, docNum) {
//    	var idOrg = getIdOrg();
//    	var idDoc = {"name": $('#step_14_name_doc_declarant_sdd_nz_group_'+docNum+' option:selected').text(),"code": $('#step_14_name_doc_declarant_sdd_nz_group_'+docNum+' option:selected').val()};
//    	var idGroup = {"name": $('#step_14_group_name_doc_declarant_sdd_nz_'+groupNum+' option:selected').text(),"code": $('#step_14_group_name_doc_declarant_sdd_nz_'+groupNum+' option:selected').val()};
//    	var identityFL = getIdentityFLFromStep_4();
//		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup":idGroup,"identityFL": identityFL}};
//		callWebS(VISurl, dataRequest, step_14_InfDocument_callback, true);

    	//TODO доделать request в соответствии с данными из udPersonDocument
    	var idOrg = getIdOrg();
		var person_index = groupNum.split('_').shift();
		//var doNameId = 'step_14_name_doc_declarant_sdd_nz_group_'+groupNum;
    	//var changeClass = 'step_14_doc_declarant_set_identity_doc_sdd_nz_group_' + groupNum;
    	
    	var idDoc = {"name": $('#step_14_name_doc_declarant_sdd_nz_group_'+docNum+' option:selected').text(),"code": $('#step_14_name_doc_declarant_sdd_nz_group_'+docNum+' option:selected').val()};
    	var idGroup = {"name": $('#step_14_group_name_doc_declarant_sdd_nz_'+groupNum+' option:selected').text(),"code": $('#step_14_group_name_doc_declarant_sdd_nz_'+groupNum+' option:selected').val()};
		var params = {"param":[{"name":"Серия","code": DocumentSeries,"type":"Integer","value":''},
		   					{"name":"Номер","code": DocumentsNumber,"type":"Integer","value":familyMemberUdPersonDoc[person_index].params.param.value},
		   					{"name":"Кем выдан","code": GiveDocumentOrg,"type":"String","value": ''}]};
   		var group = {"name":"Наименование группы","code":"Код группы"};
   		var documentFL = {"group":group,"name":$('#step_14_name_doc_declarant_sdd_nz_group option:selected').text(),"code":$('#step_14_name_doc_declarant_sdd_nz_group').val(),"dateIssue":familyMemberUdPersonDoc[person_index].dateIssue,"params":params};

		var fio = getFIO(['step_14_last_name_declarant_sdd_nz_'+person_index, 'step_14_middle_name_declarant_sdd_nz_' + person_index, 'step_14_first_name_declarant_sdd_nz_' + person_index]);
		var identityFL = getIdentityFL(fio, 'step_14_birthday_declarant_sdd_nz_'+person_index, documentFL);
    	
		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup": idGroup,"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_14_InfDocument_groupDocs_callback, true);
		
    }
    
    function step_14_InfDocument_groupDocs_callback(xmlHttpRequest, status, dataResponse) {
    	if (isResult([dataResponse, dataResponse.infDocument])) {
    		if (dataResponse.infDocument.document.length > 0) {
    			infDocument = dataResponse.infDocument;
    			step_14_infDocument_length = infDocument.document.length;
    			var array = [
    				'step_14_doc_declarant_series_sdd_nz_group_'+step_14_selected_group_num,
    				'step_14_doc_declarant_number_sdd_nz_group_'+step_14_selected_group_num,
    				'step_14_doc_declarant_date_sdd_nz_group_'+step_14_selected_group_num,
    				'step_14_doc_declarant_who_issued_sdd_nz_group_'+step_14_selected_group_num,
    				'step_14_doc_declarant_set_identity_doc_sdd_nz_group_'+step_14_selected_group_num,
    				'step_14_info_3_group_document_detail_'+step_14_selected_group_num,
    				'step_14_info_3_group_document_detail_clone_'+step_14_selected_group_num,
    				'step_14_name_doc_declarant_sdd_nz_group_'+step_14_selected_group_num
    			];
    			processDocumentDetails(infDocument.document, array, 'step_14_name_doc_declarant_sdd_nz_group_'+step_14_selected_group_num);
    			
        		return infDocument;
    		} 
    	}
    	return null;
	}
    

  //--> клонирование блока элементов 14 шага
	function add_step_14_info(el) {
//		 switchStateDateTimePicker(false);
		 var newIdNum = Number($('input.step_14_last_name_family_member_sdd_nz:last').attr('id').split('_').pop()) + 1;

		$('<span class="step_14_info_6_7_8_all_info_clone">'+step_14_info_6_7_8_all_info_default+'</span>').insertAfter('span[class="step_14_info_6_7_8_all_info_clone"]:last');
		$('span.step_14_info_6_7_8_all_info_clone:last span.step_14_info_6_clone').find('*').each(function(i){
			if (isNotUndefined($(this).attr('class'))&& $(this).attr('class').indexOf('step_') == 0) {
				var classEl = $(this).attr('class').split(' ')[0];
				$(this).attr('id', classEl + '_' + newIdNum);

			}
		});
		
		if (typeof step_14_all_docs_default_fill_self != 'undefined') {
			$('#step_14_info_7_all_docs_clone_' + newIdNum).html('<fieldset style="border:1px solid #d8d7c7; margin-bottom:15px; margin-left:30px; margin-right:30px; -webkit-padding-before: 0.35em; -webkit-padding-start:0.75em;	-webkit-padding-end:0.75em; -webkit-padding-after:0.625em;">'+step_14_all_docs_default_fill_self+'</fieldset>');  // в span с id + номер выбранного блока вставляется из памяти блок "Необходимые документы члена семьи"
			$('#step_14_info_7_all_docs_clone_' + newIdNum).show();
			//$('fieldset#step_13_info_9_' + newIdNum).show();	//10_07_13
		}
		

		recalcIdAndCopyAttrChecked(newIdNum, 'step_14_info_7_all_docs_clone', 'step_14_info_7_document_clone', 'step_14_info_7_group_clone', 'step_14_doc_bring_himself_sdd_nz_document', 'step_14_in_SMEV_trustee_doc_sdd_nz2_document');

		setDictionary('relationDegree','step_14_relation_degree_family_member_sdd_nz_' + newIdNum);
		
		$("input.delete_step_14_info:last").show();


		$(el).parent().css({'margin-right':'100px', 'margin-top':'-50px'});
		$(el).css({'margin-right':'140px', 'margin-top':'-50px'});
		switchStateDateTimePicker(true);
	}

	function delete_step_14_info(el) {
		$(el).closest('span.step_14_info_6_7_8_all_info_clone').remove();
		var add_btn = document.getElementsByClassName('add_step_14_info');
		if ($('span.step_14_info_6_7_8_all_info_clone').length == 1) {
			$(add_btn).parent().css({'margin-right':'0px', 'margin-top':'0px'});
			$(add_btn).css({'margin-right':'30px', 'margin-top':'-20px'});
		}
	}
	
	$('form#universal fieldset#step_15_main_fieldset').css({ 'border':'0px'});
	$('form#universal fieldset.step_15_table_income_head').css('margin-bottom','0px');
	$('form#universal fieldset.step_15_income').css('margin-bottom','0px');
  	$('form#universal span[name=step_15_add_info_money_label]').css({'color':'#000000','font-weight':'bold', 'font-size':'12px'});
	
    
    function openStep_15() {
		//alert('Данный шаг еще разрабатывается! Приносим свои глубочайшие извинения');
		$('.step_15_info_4_clone').hide();
		step_15_callWS_period();
		$('#step_15_income_clone').hide();
    		$('.step_15_table_income_head').hide();
		$('.step_15_doc_group_clone').hide();
		$('.step_15_info_4_clone').hide();
		$('.step_15_doc_clone').hide();
		$('.step_15_group_clone').hide();
		$('.step_15_doc_confirmed_income').hide();
		$('#step_15_add_info_money').change();
	}
	
	function step_15_delete_info_4(element){
		var ind = '_' + $(element).attr('class').split('_').pop();
		//new{04_07_13
	    var val = $('#step_15_type_profit_w1'+getIndex(element)).val();
	    $('.step_15_type_profit_w1'+ind+' option[value='+val+']').show();
		$(element).closest('fieldset').closest('span').remove();
		//new}
		if ($('.step_15_info_4_clone'+ind).length == 1)
			$('#step_15_add_info_money'+ind).removeAttr('checked');
		if ($('.step_15_delete_info_4_button' + ind).length <= 2){
			$('.step_15_delete_info_4_button' + ind).filter(function(index) {
				return index == 1;
			}).hide();
		}
		$('.step_15_add_info_4_button' + ind).filter(':last').show();
	}
	
	function step_15_add_info_4(element){
		var ind = '_' + $(element).attr('class').split('_').pop();

			newCloneSpanStep15('step_15_info_4_clone' + ind, 1, null, false);
		var step_15_delete_info_4_button =	$('.step_15_delete_info_4_button' + ind); 
		step_15_delete_info_4_button.show();
		step_15_delete_info_4_button.filter(':first').hide();
		if (step_15_delete_info_4_button.length <= 2){
			step_15_delete_info_4_button.filter(function(index) {
				return index == 1;
			}).hide();
		}
		var step_15_add_info_4_button =	$('.step_15_add_info_4_button' + ind); 
			step_15_add_info_4_button.hide();
			step_15_add_info_4_button.filter(':last').show();
		
		//new{04_07_13
		var step_15_type_profit_w1 = $('.step_15_type_profit_w1' + ind);
		step_15_type_profit_w1.each(function(){
			if ($(this).val() != ''){
				$('.step_15_type_profit_w1'+ind+':last option[value='+$(this).val()+']').hide();
			}
		});
		step_15_type_profit_w1.each(function(){
			$(this).attr('prev', $(this).val());
		});
		step_15_type_profit_w1.unbind('change');
		step_15_type_profit_w1.change(function(){
			if ($(this).val() != ''){
			    var before_change = $(this).attr('prev');//get the pre data
			    $(this).attr('prev', $(this).val());//update the pre data
			    $('.step_15_type_profit_w1'+ind+' option[value='+before_change+']').show();
			    $('.step_15_type_profit_w1'+ind+' option[value='+$(this).val()+']').hide();
			    $('#'+this.id+' option[value='+$(this).val()+']').show();
				step_15_callWS_Documents(getIndex(this));
			}
		});
	}
	
	step_15_familyMembers = [];
	function step_15_addFamilyMembers(){
		var familyMembers = [];
		if (isInArray('13', Steps)){
			familyMembers = getFamilyMembersFromStep13();
		}
		if (isInArray('14', Steps)){
			familyMembers = familyMembers.concat(getFamilyMembersFromStep14());
		}
		step_15_familyMembers = familyMembers;
		if (isResult([familyMembers])&&familyMembers.length > 0){
			newCloneSpan('step_15_info_income_clone', familyMembers.length, null);
			$('[name=step_15_add_info_money]').unbind('change');
			$('[name=step_15_add_info_money]').change(function() {
				var ind = getIndex(this);
				if ($(this).attr('checked')){
					$('#step_15_name_declarant_k'+ind).val($('#step_15_step_15_name_declarant_m'+ind).val());
					$('#step_15_birthday_declarant_k'+ind).val($('#step_15_birthday_declarant_m'+ind).val());
					if ($('.step_15_info_4_clone'+ind).length == 1){
						$('.step_15_delete_info_4_button' + ind).filter(':first').hide();
						$('.step_15_add_info_4_button' + ind).filter(':last').show();
						$('.step_15_info_4_clone'+ind).show();
						$('#step_15_add_info_4_button' + ind).click();
					}
					else{
						showAllWithoutDefault('step_15_info_4_clone'+ind);
					}
				}
				else {
					$('.step_15_info_4_clone'+ind).hide();
				}
			});
			
			for (var i = 0; i < familyMembers.length; i++){
				var familyMember = familyMembers[i].familyMember;
				$('#step_15_step_15_name_declarant_m_' + i).val(familyMember.surname + " " + familyMember.name + " " + familyMember.patronymic);
				$('#step_15_birthday_declarant_m_' + i).val(familyMember.birthday);
				if (isResult([familyMember.doc, familyMember.birthday])){
					if (isNotUndefined([familyMember.doc.dateIssue])&&(familyMember.doc.dateIssue != '')){
						//вызов синхронного сервиса
						step_15_callWS_Earnings(familyMember, i);
					}
					else {
						step_15_add_check_self(i);
					}	
				}
				else {
					step_15_add_check_self(i);
				}
			}
			
			$('[name=step_15_type_profit_w1]').unbind('change');
			$('[name=step_15_type_profit_w1]').change(function(){
				if ($(this).val() != ''){
					step_15_callWS_Documents(getIndex(this));
				}
			});
		}
	}
	
	
	function step_15_getDocsByGroup(el){
		var ind = getIndex(el);
		
		if (el.value == '+'){
			if ($('[step_15_group_check='+'step_15_group_name_doc'+ind+']').length > 1){
				$('[step_15_group_check='+'step_15_group_name_doc'+ind+']').closest('span').show();
				el.value = '-';
			}
			else
				step_15_callWS_DocumentsByGroup(ind);
		}
		else{
			$('[step_15_group_check='+'step_15_group_name_doc'+ind+']').closest('span').hide();
			el.value = '+';
		}
		//$('#step_7_info_5_group_document_clone_'+indexOfGroup).hide();
	}
	
	var step_15_indexOfGroup;
	function step_15_callWS_DocumentsByGroup(index){
		step_15_indexOfGroup = index;
		dataRequest = {"documents":{"doc": $('#step_15_group_name_doc'+index+' option:selected').val()}};
		callWebS(ARTKMVurl, dataRequest, step_15_DocumentsByGroup_callback, true);
	}
	
	function step_15_DocumentsByGroup_callback(xmlHttpRequest, status, dataResponse){
		step_15_DocumentsByGroup = null;
		if (isResult([dataResponse])){
			if (isResult([dataResponse.documents])){
				step_15_DocumentsByGroup = dataResponse.documents;
				//use step_15_indexOfGroup
				if (isResult([step_15_DocumentsByGroup.document])&&(step_15_DocumentsByGroup.document.length >= 1)){
					var arrGroupToClone = [
					                       	'step_15_name_doc_sdd_group'+step_15_indexOfGroup,
					                       	'step_15_check_doc'+step_15_indexOfGroup,
					                       	'step_15_doc_bring_himself_group'+step_15_indexOfGroup,
					                       	'step_15_doc_bring_himself_group_label'+step_15_indexOfGroup,
					                       	'step_15_in_SMEV_trustee_doc_group'+step_15_indexOfGroup,
					                       	'step_15_in_SMEV_trustee_doc_group_label'+step_15_indexOfGroup
					                      ];
					$('#step_15_add_group_name_doc' + step_15_indexOfGroup).val('-');
					newCloneSpanStep15('step_15_doc_group_clone' + step_15_indexOfGroup, step_15_DocumentsByGroup.document.length, arrGroupToClone, true);	
					for (var i=0; i < step_15_DocumentsByGroup.document.length; i++){
						    var doc = step_15_DocumentsByGroup.document[i];
						    $('#step_15_check_doc' + step_15_indexOfGroup +'_'+i).attr('step_15_group_check', 'step_15_group_name_doc'+step_15_indexOfGroup);
							addOption(document.getElementById('step_15_name_doc_sdd_group' + step_15_indexOfGroup +'_'+i), doc.name, doc.key, true, true);
							setCheckBoxVisible('#step_15_doc_bring_himself_group' + step_15_indexOfGroup +'_'+i, doc.privateStorage, doc.privateStorage);
							$('#step_15_doc_bring_himself_group' + step_15_indexOfGroup +'_'+i).val(doc.privateStorage);
							setCheckBoxVisible('#step_15_in_SMEV_trustee_doc_group' + step_15_indexOfGroup +'_'+i, doc.interagency, doc.interagency);
							$('#step_15_in_SMEV_trustee_doc_group' + step_15_indexOfGroup +'_'+i).val(doc.interagency);
					}
					$('[step_15_group_check='+'step_15_group_name_doc'+step_15_indexOfGroup+']').unbind('change');
					$('[step_15_group_check='+'step_15_group_name_doc'+step_15_indexOfGroup+']').change(function() {
						var groupId = $(this).attr('step_15_group_check');
						var ind = groupId.split('step_15_group_name_doc').pop();
						var iClass = $(this).attr('class').split('_').pop();
						var hideClass = 'step_15_doc_group';	// 
						if ($(this).attr('checked')){
							$('[step_15_group_check='+groupId+']').removeAttr('checked');
							this.checked = true;
							$('.'+hideClass+'_' + iClass).each(function() {
								if (this.id.indexOf(hideClass+ind) >= 0){
										$(this).hide();
								}
							});
							$(this).closest('span').show();
							$(this).closest('fieldset').show();
							//вызов DocumentType
							step_15_callWS_DocumentType(getIndex(this));
						}
						else{
							var m = 0;
							$('.'+hideClass+'_' + iClass).each(function() {
								if (this.id.indexOf(hideClass+ind) >= 0){
									if (m != 0){
										$(this).show();
										$(this).closest('span').show();			
									}
									m++;
								}
							});
						}
					});
				}
			}
		}
		return step_15_Documents;
	}
	
	step_15_indexOfDoc_byGroup = -1;
	function step_15_callWS_DocumentType(index){
		step_15_indexOfDoc_byGroup = index;
		dataRequest = {"documentType":{"doc":$('select#step_15_name_doc_sdd_group'+index+ ' option:selected').val()}};	
		callWebS(ARTKMVurl, dataRequest, step_15_DocumentType_callback, true);
	}
	
	function step_15_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		step_15_DocumentType = null;
		if (isResult([dataResponse, dataResponse.DocumentType])){
			step_15_DocumentType = dataResponse.DocumentType;
			setCheckBoxVisible('#step_15_doc_bring_himself_group'+step_15_indexOfDoc_byGroup, step_15_DocumentType.privateStorage, step_15_DocumentType.privateStorage);
			$('#step_15_doc_bring_himself_group'+step_15_indexOfDoc_byGroup).val(step_15_DocumentType.privateStorage); 			
			setCheckBoxVisible('#step_15_in_SMEV_trustee_doc_group'+step_15_indexOfDoc_byGroup, step_15_DocumentType.interagency, step_15_DocumentType.interagency);
			$('#step_15_in_SMEV_trustee_doc_group'+step_15_indexOfDoc_byGroup).val(step_15_DocumentType.interagency);
		}
		return step_15_DocumentType;
	}
	
	
	function getFamilyMembersFromStep13(){
		step_13_FamilyMembers = [];
		var i = 0;
		$('[name=step_13_set_family_member_sdd_z]').each(function() {
			if ($(this).attr("checked")){
				var ind = this.id.substr($(this).attr("name").length, this.id.length);
				var familyMember = new Object();
				familyMember = getFIO(['step_13_last_name_declarant_sdd_z' + ind, 'step_13_middle_name_declarant_sdd_z' + ind, 'step_13_first_name_declarant_sdd_z' + ind]);
				familyMember.birthday = getValue('step_13_birthday_declarant_sdd_z' + ind);
				familyMember.doc = getIdenDocFromStep13(ind); 
				step_13_FamilyMembers[i] = new Object();
				step_13_FamilyMembers[i++].familyMember = familyMember;
			}
		});
		if ($('#step_13_add_family_member_sdd_z').attr("checked")){	//если стоит галочка "добавить вручную"
			$('[name=step_13_last_name_family_member_sdd_z]').each(function(j) {
					if (j > 0){
						var ind = this.id.substr($(this).attr("name").length, this.id.length);
						var familyMember = new Object();
						familyMember = getFIO([this.id, 'step_13_middle_name_family_member_sdd_z' + ind, 'step_13_first_name_family_member_sdd_z' + ind]);
						familyMember.birthday = getValue('step_13_birthday_family_member_sdd_z' + ind);
						step_13_FamilyMembers[i] = new Object();
						step_13_FamilyMembers[i++].familyMember = familyMember;
					}
			});
		}
		return step_13_FamilyMembers;
	}
	
	function getIdenDocFromStep(array, index){
		var step = array[0];
		var singleDocName = array[1];
		var date = array[2];
		var series = array[3];
		var number = array[4];
		var who_org = array[5];
		var group = array[6];
		var check_doc = array[7];
		var doc_name_group = array[8];
		var date_group = array[9];
		var series_group = array[10];
		var number_group = array[11];
		var who_org_group = array[12];
		var docum = new Object();
		$('[name='+singleDocName+']').each(function() {
			if ((this.id.indexOf($(this).attr('name')+index) >= 0)&&($(this).attr(step+'_identity'))&&($(this).attr(step+'_confirm'))){	//+'_'
				var group = {"name":"","code":""};
				var doc = getDocNameAndCode(this.id);
				var dateIssue = '';
				var params = new Object();
				$('[document='+this.id+']').each(function() {
					if ($(this).attr('checked')){	//если реквизит подтвержден
						var ind = getIndex(this);
						dateIssue = getValue(date+ind);
						params = getDocParamToRequest([series+ind,number+ind,who_org+ind]);
						return false;
					}
				});
				docum = {"group":group,"name":doc.name,"code":doc.code,"dateIssue":dateIssue,"params":params};
			}
		});
		if (!isResult([docum])){
			$('[name='+group+']').each(function() {
				if (this.id.indexOf($(this).attr('name')+index) >= 0){	//относится к нужному члену семьи?	//+'_'
					if (getSelectedObject(this.id).code == 'udPerson'){	//группа документов удостоверяющих личность?
						var group = {"name": getSelectedObject(this.id).name,"code": getSelectedObject(this.id).code};
						var i = getCheckedCloneIndex(check_doc + getIndex(this));
						if (i >= 0){  //если есть чекнутый документ
							var d = $('#'+doc_name_group+getIndex(this)+'_'+i);
							var doc = getDocNameAndCode(d.attr('id'));
							var dateIssue = '', params = new Object();
							$('[document='+d.attr('id')+']').each(function() {  //бегаем по всем реквизитам
								if ($(this).attr('checked')){	//если реквизит подтвержден
									var ind = getIndex(this);
									dateIssue = getValue(date_group+ind);
									params = getDocParamToRequest([series_group+ind,number_group+ind, who_org_group+ind]);
									return false;
								}
							});
							docum = {"group":group,"name":doc.name,"code":doc.code,"dateIssue":dateIssue,"params":params};
						}
					}
				}
			});
		}
		return docum;	
	}
	
	function getIdenDocFromStep13(index){
		var array = [
			             'step_13',
			             'step_13_name_doc_declarant_sdd_z',
			             'step_13_doc_declarant_date_sdd_z',
			             'step_13_doc_declarant_series_sdd_z',
			             'step_13_doc_declarant_number_sdd_z',
			             'step_13_doc_declarant_who_issued_sdd_z',
			             'step_13_group_name_doc_declarant_sdd_z',
			             'step_13_check_doc_declarant_sdd_z_group',
			             'step_13_name_doc_declarant_sdd_z_group',
			             'step_13_doc_declarant_date_sdd_z_group',
			             'step_13_doc_declarant_series_sdd_z_group',
			             'step_13_doc_declarant_number_sdd_z_group',
			             'step_13_doc_declarant_who_issued_sdd_z_group'
		             ];
		return getIdenDocFromStep(array, index);     //проверить работоспособность и удалить все что снизу!
	}
	
	function getDocParamToRequest(paramArray){
		var param = [];
		param[0] = {"name":"Серия","code": DocumentSeries, "type":"Integer","value": getValue(paramArray[0])};
		param[1] = {"name":"Номер","code": DocumentsNumber, "type":"Integer","value": getValue(paramArray[1])};
		param[2] = {"name":"Кем выдан","code": GiveDocumentOrg, "type":"String","value": getValue(paramArray[2])};
		var params = {"param":param};
		return params; 
	}
	
	function getDocNameAndCode(id){
		var doc = new Object();
		doc.name = $("#" + id + ' option:selected').text();
		doc.code = $("#" + id).val();
		//для инпутов
		//doc.name = $("#" + id').val();
		//doc.code = $("#" + id).text();
		return doc;
	}
	
	function setDocNameAndCode(id, name, code){
		addOption(document.getElementById(id), name, code, true, true);
		doc.code = $("#" + id).val();
		//$("#" + id).val(name);
		//$("#" + id).text(code);
	}	
	
	function getFamilyMembersFromStep14(){
		step_14_FamilyMembers = [];
		var i = 0;
		$('[name=step_14_set_family_member_sdd_nz]').each(function() {
			if ($(this).attr("checked")){
				var ind = this.id.substr($(this).attr("name").length, this.id.length);
				var familyMember = new Object();
				familyMember = getFIO(['step_14_last_name_declarant_sdd_nz' + ind, 'step_14_middle_name_declarant_sdd_nz' + ind, 'step_14_first_name_declarant_sdd_nz' + ind]);
				familyMember.birthday = getValue('step_14_birthday_declarant_sdd_nz' + ind);
				familyMember.doc = getIdenDocFromStep14(ind); 
				step_14_FamilyMembers[i] = new Object();
				step_14_FamilyMembers[i++].familyMember = familyMember;
			}
		});
		if ($('#step_14_add_family_member_sdd_nz').attr("checked")){
			$('[name=step_14_last_name_family_member_sdd_nz]').each(function(j) {
				    if (j > 0){
						var ind = this.id.substr($(this).attr("name").length, this.id.length);
						var familyMember = new Object();
						familyMember = getFIO([this.id, 'step_14_middle_name_family_member_sdd_nz' + ind, 'step_14_first_name_family_member_sdd_nz' + ind]);
						familyMember.birthday = getValue('step_14_birthday_family_member_sdd_nz' + ind);
						step_14_FamilyMembers[i] = new Object();
						step_14_FamilyMembers[i++].familyMember = familyMember;
				    }
			});
		}
		return step_14_FamilyMembers;
	}
	
	function getIdenDocFromStep14(index){
		var array = [
			             'step_14',
			             'step_14_name_doc_declarant_sdd_nz_document',
			             'step_14_doc_declarant_date_sdd_nz_document',
			             'step_14_doc_declarant_series_sdd_nz_document',
			             'step_14_doc_declarant_number_sdd_nz_document',
			             'step_14_doc_declarant_who_issued_sdd_nz_document',
			             'step_14_group_name_doc_declarant_sdd_nz',
			             'step_14_check_doc_declarant_sdd_nz_group',
			             'step_14_name_doc_declarant_sdd_nz_group',
			             'step_14_doc_declarant_date_sdd_nz_group',
			             'step_14_doc_declarant_series_sdd_nz_group',
			             'step_14_doc_declarant_number_sdd_nz_group',
			             'step_14_doc_declarant_who_issued_sdd_nz_group'
		             ];
		return getIdenDocFromStep(array, index);
	}
	
	function step_15_callWS_period(){
		dataRequest = {"period":{"subservice": getIdSubservice().code, "category": getIdCategory().code}};
		callWebS(ARTKMVurl, dataRequest, step_15_period_callback, true);
	}
	
	function step_15_period_callback(xmlHttpRequest, status, dataResponse){
		period = null;
		if (isResult([dataResponse])){
			if (isResult([dataResponse.period])){
				period = dataResponse.period;
				//if (isResult([period.numberOfMonths])){
					$('#step_15_info_2').text(period.numberOfMonths);
				//}
			}
		}
		else {
			
		}
		step_15_callWS_typeIncome();
		return period;
	}
	
	function step_15_callWS_typeIncome(){
		dataRequest = {"typeIncome":{"subservice": getIdSubservice().code, "category": getIdCategory().code}};
		callWebS(ARTKMVurl, dataRequest, step_15_typeIncome_callback, false);
		step_15_addFamilyMembers();
	}
	
	function step_15_typeIncome_callback(xmlHttpRequest, status, dataResponse){
		var step_15_type_profit = 'step_15_type_profit_w1';
		typeIncome = null;
		clearSelect(document.getElementById(step_15_type_profit));
		if (isResult([dataResponse])){
			if (isResult([dataResponse.typeIncome])){
				typeIncome = dataResponse.typeIncome;
				if (isResult([typeIncome.typeOfIncome])&&(typeIncome.typeOfIncome.length > 0)){
					//addOption(document.getElementById(step_15_type_profit), '--Выберите--', '', true, true);
					typeIncome_html = '<option value="" title="--Выберите--" selected="" style="width: 100%;">--Выберите--</option>';
					for (var i = 0; i < typeIncome.typeOfIncome.length; i++){
						typeIncome_html += '<option value="'+typeIncome.typeOfIncome[i].key+'" title="'+typeIncome.typeOfIncome[i].name+'" style="width: 100%;" step_15_income_group="'+typeIncome.typeOfIncome[i].idGroupDoc+'">'+typeIncome.typeOfIncome[i].name+'</option>';
						//addOption(document.getElementById(step_15_type_profit), typeIncome.typeOfIncome[i].name, typeIncome.typeOfIncome[i].key, false, false);
					}
					$('#'+step_15_type_profit).html(typeIncome_html);
				}
			}
		}
		else{
			
		}
		return typeIncome;	
	}
	
	var index_for_callback_Earnings = -1;
	function step_15_callWS_Earnings(familyMember, index){
		var idOrg = getIdOrg();
		var numberOfMonths = $('#step_15_info_2').text();
		var typeOfIncome = [];
		for (var i=0; i< typeIncome.typeOfIncome.length; i++){
			typeOfIncome[i] = new Object();
			typeOfIncome[i].code = typeIncome.typeOfIncome[i].key;
			typeOfIncome[i].name = typeIncome.typeOfIncome[i].name;
		}
		
		index_for_callback_Earnings = index;
		
		var identityFL = {"fio":{"surname":familyMember.surname,"patronymic":familyMember.patronymic,"name":familyMember.name},"dateOfBirth":familyMember.birthday,"document":familyMember.doc};
		dataRequest = {"earnings":{"idOrg": idOrg,"numberOfMonths": numberOfMonths,"itemsOfIncome":{"typeOfIncome":typeOfIncome},"identityFL":identityFL}};
		callWebS(VISurl, dataRequest, step_15_Earnings_callback, false);
	}
	
	function step_15_Earnings_callback(xmlHttpRequest, status, dataResponse){
		earnings = null;
		if (isResult([dataResponse])){
			if (isResult([dataResponse.earnings])){
				earnings = dataResponse.earnings;
				//use index_for_callback_Earnings
				if(isResult([earnings.income])&&(earnings.income.length > 0)){
					var income = earnings.income;					
					var array = [
					             	'step_15_income_' + index_for_callback_Earnings,
					             	'step_15_mm_gg_' + index_for_callback_Earnings,
					             	'step_15_type_profit_' + index_for_callback_Earnings,
					             	'step_15_sum_profit_' + index_for_callback_Earnings,
					             	'step_15_is_income_true_' + index_for_callback_Earnings
					             ];
                    $('#step_15_table_income_head_'+index_for_callback_Earnings).show();
					var count = 0;
					for (var i = 0; i < income.length; i++){
						var len = $('.step_15_income_clone_' + index_for_callback_Earnings).length;
						if (len == 1)
							newCloneSpan('step_15_income_clone_' + index_for_callback_Earnings, income[i].incomeInf.length, array);
						else if (len > 1)
							cloneSpanWithoutDelete('step_15_income_clone_' + index_for_callback_Earnings, income[i].incomeInf.length, array);
						for (var j = 0; j < income[i].incomeInf.length; j++){
							var ind = index_for_callback_Earnings + '_' + (count++);
							//$('#step_15_mm_gg_' + ind).val(dateFormat(new Date(income[i].incomeInf[j].month + " " + income[i].incomeInf[j].year), "MM.YYYY"));
							$('#step_15_mm_gg_' + ind).val(income[i].incomeInf[j].month + "." + income[i].incomeInf[j].year);
							$('#step_15_type_profit_' + ind).val(income[i].incomeType);
							$('#step_15_sum_profit_' + ind).val(income[i].incomeInf[j].sum);
						}
					}
				}
				else {
					step_15_add_check_self(index_for_callback_Earnings);
				}
			}
			else {
				step_15_add_check_self(index_for_callback_Earnings);
			}
		}
		else {
			step_15_add_check_self(index_for_callback_Earnings);
		}
		return earnings;
	}
	
	function step_15_add_check_self(index){
		var step_15_add_info_money = $('#step_15_add_info_money_' + index); 
			step_15_add_info_money.attr('checked','checked');
			step_15_add_info_money.change();
			step_15_add_info_money.hide();
		$('#step_15_add_info_money_label_' + index).hide();
		$('#step_15_info_income_' + index).hide();
	}
	
	function dateFormat(date, format) {
	    // Calculate date parts and replace instances in format string accordingly
	    format = format.replace("DD", (date.getDate() < 10 ? '0' : '') + date.getDate()); // Pad with '0' if needed
	    format = format.replace("MM", (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1)); // Months are zero-based
	    format = format.replace("YYYY", date.getFullYear());
	    return format;
	}
	
	step_15_Documents_index = -1;
	function step_15_callWS_Documents(index){
		step_15_Documents_index = index;
		dataRequest = {"documents":{"doc": $('#step_15_type_profit_w1'+index+' option:selected').attr('step_15_income_group')}};
		callWebS(ARTKMVurl, dataRequest, step_15_Documents_callback, true);
	}
	
	function step_15_Documents_callback(xmlHttpRequest, status, dataResponse){
		step_15_Documents = null;
		if (isResult([dataResponse])){
			if (isResult([dataResponse.documents])){
				step_15_Documents = dataResponse.documents;
				//use step_15_Documents_index
				if (isResult([step_15_Documents.document])&&(step_15_Documents.document.length >= 1)){
					$('#step_15_doc_confirmed_income'+step_15_Documents_index).show();
					var groupAdnDocs = getGroup_Document_Array(step_15_Documents.document);
					var arrDocToClone = [
					                     	'step_15_doc'+step_15_Documents_index,
					                     	'step_15_name_doc_sdd'+step_15_Documents_index,
					                     	'step_15_doc_bring_himself'+step_15_Documents_index,
					                     	'step_15_doc_bring_himself_label'+step_15_Documents_index,
					                     	'step_15_in_SMEV_trustee_doc'+step_15_Documents_index,
					                     	'step_15_in_SMEV_trustee_doc_label'+step_15_Documents_index
					                     ];
					var arrGroupToClone = [
					                       	'step_15_group'+step_15_Documents_index,
					                       	'step_15_doc_group_clone'+step_15_Documents_index,
					                       	'step_15_doc_group'+step_15_Documents_index,
					                       	'step_15_group_name_doc'+step_15_Documents_index,
					                       	'step_15_add_group_name_doc'+step_15_Documents_index,
					                       	'step_15_name_doc_sdd_group'+step_15_Documents_index,
					                       	'step_15_check_doc'+step_15_Documents_index,
					                       	'step_15_doc_bring_himself_group'+step_15_Documents_index,
					                       	'step_15_doc_bring_himself_group_label'+step_15_Documents_index,
					                       	'step_15_in_SMEV_trustee_doc_group'+step_15_Documents_index,
					                       	'step_15_in_SMEV_trustee_doc_group_label'+step_15_Documents_index
					                      ];
					if (step_15_Documents.document.length == 1){
						newCloneSpanStep15('step_15_doc_clone' + step_15_Documents_index, groupAdnDocs.documents.length, arrDocToClone, true);
						newCloneSpanStep15('step_15_group_clone' + step_15_Documents_index, groupAdnDocs.groups.length, arrGroupToClone, true);	
						for (var i=0; i < groupAdnDocs.documents.length; i++){
								addOption(document.getElementById('step_15_name_doc_sdd' + step_15_Documents_index +'_'+i), groupAdnDocs.documents[i].name, groupAdnDocs.documents[i].key, true, true);
								setCheckBoxVisible('#step_15_doc_bring_himself' + step_15_Documents_index +'_'+i, groupAdnDocs.documents[i].privateStorage, groupAdnDocs.documents[i].privateStorage);
								$('#step_15_doc_bring_himself' + step_15_Documents_index +'_'+i).val(groupAdnDocs.documents[i].privateStorage);
								setCheckBoxVisible('#step_15_in_SMEV_trustee_doc' + step_15_Documents_index +'_'+i, groupAdnDocs.documents[i].interagency, groupAdnDocs.documents[i].interagency);
								$('#step_15_in_SMEV_trustee_doc' + step_15_Documents_index +'_'+i).val(groupAdnDocs.documents[i].interagency);
								writeDocument(groupAdnDocs.documents[i], 'step_15_name_doc_sdd' + step_15_Documents_index +'_'+i);
						}
						for (var i=0; i < groupAdnDocs.groups.length; i++){
							addOption(document.getElementById('step_15_group_name_doc' + step_15_Documents_index +'_'+i), groupAdnDocs.groups[i].name, groupAdnDocs.groups[i].key, true, true);
						}
					}else{//25_07_13 заплатка by KAVlex
						newCloneSpanStep15('step_15_doc_clone' + step_15_Documents_index, 0, arrDocToClone, true);
						newCloneSpanStep15('step_15_group_clone' + step_15_Documents_index, 1, arrGroupToClone, true);
						var code = $('#step_15_type_profit_w1'+step_15_Documents_index+' option:selected').attr('step_15_income_group');
						addOption(document.getElementById('step_15_group_name_doc' + step_15_Documents_index +'_0'), 'Документы, подтверждающие данный вид дохода', code, true, true);
						$('#step_15_group' + step_15_Documents_index +'_0').css('border', '0px');
						step_15_indexOfGroup = step_15_Documents_index +'_0';
						step_15_DocumentsByGroup_callback(null,null, dataResponse);
					}
				}
			}
		}
		return step_15_Documents;
	}
	
	function newCloneSpanStep15(id, length, array, delete_) {	//очистка+удаление+клонирование
		var clazz = id;
		if (delete_){
		clazz = $('#'+id).attr('class');		//id.substr(0, id.lastIndexOf('_'));
		/*$('.'+clazz + ' input[type="text"]').each(function(){			//commented by KAVlex 18_07_13
    		if (isNotUndefined(this.id))
        		if (this.id.indexOf(id) >= 0)
        		    this.value = '';
		});
		$('.'+clazz + ' textarea').each(function(){
			if (isNotUndefined(this.id))
        		if (this.id.indexOf(id) >= 0)
        		    this.value = '';
		});
		$('.'+clazz + ' input[type="checkbox"]').each(function(){
			if (isNotUndefined(this.id))
        		if (this.id.indexOf(id) >= 0)
    			    if ($(this).val() != 1)
    				    $(this).removeAttr("checked");    		    
		});*/

        var k = 0;
        $('span[class="' + clazz + '"]').each(function(){
            if ($('span[class="' + clazz + '"]').length > 1)
           		if (isNotUndefined(this.id))
                    if (this.id.indexOf(id) >= 0){
                                if (k != 0)
                                    $(this).remove();
                                k++;
                            }
        });
		}
		var countI = 0;
		if ($('.'+clazz).length > 1){
			countI = $('.'+clazz).filter(':last').find('fieldset').filter(':first').attr('id').split('_').pop();
			countI = parseInt(countI) + 1;
		}
    	$('span[id="' + id + '"]:first').hide();
		for (var i=0; i< length; i++){
			$('span[id="' + id + '"]:first').clone().insertAfter('span[id="' + id + '"]:last').show();
		}
		
		if (array != null){
			for(i in array){
				setIdToCloneElementOtherClassStep15(array[i]);
			}
		}
		else{
			$('span[class="' + clazz + '"]:last').find('*').each(function() {
				if (isNotUndefined(this.id)){
					if (this.id != ''){
						this.id = this.id + '_' + countI;
					}
				}
			});
		}
	}
	
	function setIdToCloneElementOtherClassStep15(id) {	//проставить id к клонируемым элементам на 15 шаге
		clazz = $('#'+id).attr('class');//id.substr(0, id.lastIndexOf('_'));
		if (isResult([id])){
			var i = 0;
			$('.'+ clazz).each(function () {      
			    if (isNotUndefined(this.id)){      
	    			if (this.id.indexOf(id) >= 0){
	   			    			if (i !=0 )
	    	        	        	$(this).attr("id", id + "_" + (i-1));
				        	i++;
		    	        }
			}
			});
		}
	}
    
	function openStep_16() {
		$('#step_16_not_info').hide();
		step_16_callWS_informationRequested();
	}
	
	function step_16_callWS_informationRequested(){
		dataRequest = {"informationRequested":{"subservice": getIdSubservice().code, "category": getIdCategory().code}};
		callWebS(ARTKMVurl, dataRequest, step_16_informationRequested_callback, true);
	}
	
	function step_16_informationRequested_callback(xmlHttpRequest, status, dataResponse){
		informationRequested = null;
	    if (isResult([dataResponse])){
	        if (isResult([dataResponse.InformationRequested])){
	        	informationRequested = dataResponse.InformationRequested;
				if (isResult([informationRequested.infRequest])&& (informationRequested.infRequest.length > 0)){
    	            newCloneSpan('step_16_info_group_clone', informationRequested.infRequest.length, null);
    	            if (informationRequested.infRequest.length == 1){
    	            	$('#step_16_info_group_0').css('border', '1px solid #efebde');
    	            }
					for (var i=0; i < informationRequested.infRequest.length; i++){
						var infRequest = informationRequested.infRequest[i];
						var step_16_name_group_info = $('#step_16_name_group_info_' + i); 
							step_16_name_group_info.val(infRequest.group.name);
							step_16_name_group_info.text(infRequest.group.code);
    	                if (infRequest.group.name == ''){
    	                	step_16_name_group_info.hide();
    	                }
    	                
	                    //$('#step_16_name_info_' + i).val(informationRequested.infRequest[i].name);
	                    //$('#step_16_name_info_' + i).text(informationRequested.infRequest[i].code);
						var reqParams = infRequest.reqParams.reqParam;
						if (isResult([reqParams]) && reqParams.length > 0){
							var step_16_name_info =	$('#step_16_name_info_' + i); 
								step_16_name_info.text(infRequest.name);
								step_16_name_info.val(infRequest.code);
							if (infRequest.name == ''){
								step_16_name_info.hide(); 	//step_16_name_group_info.hide();
	    	                }
    	                    //$('#step_16_name_info_label_' + i).text(informationRequested.infRequest[i].name);
    	                    //$('#step_16_name_info_label_' + i).text(informationRequested.infRequest[i].code);
							var arrToClone = ['step_16_choice_info_label_'+i, 'step_16_choice_info_'+i, 'step_16_choice_info_radio_'+i];//, 'step_16_info_'+i  'step_16_name_info_label_'+i, 'step_16_name_info_'+i, 
							newCloneSpan('step_16_info_clone_' + i, reqParams.length, arrToClone);
        	                for (var j = 0; j < reqParams.length; j++){
        	                	var step_16_choice_info_label = $('#step_16_choice_info_label_'+i + '_' + j); 
        	                		step_16_choice_info_label.text(reqParams[j].name);
        	                		step_16_choice_info_label.val(reqParams[j].code);
        	                	if ((reqParams[j].type == 'радиокнопка')||(reqParams[j].type == 'radio')){
        	                		var step_16_choice_info_radio = $('#step_16_choice_info_radio_'+i + '_' + j); 
        	                			step_16_choice_info_radio.show();
        	                			step_16_choice_info_radio.attr('inForm', 'true');
        	                			step_16_choice_info_radio.val(reqParams[j].code);
        	                		$('#step_16_choice_info_'+i + '_' + j).hide();
        	                			step_16_choice_info_radio.attr('name', 'step_16_choice_info_'+i);
        	                	}
        	                	else{
        	                		var step_16_choice_info = $('#step_16_choice_info_'+i + '_' + j); 
        	                			step_16_choice_info.show();
        	                			step_16_choice_info.attr('inForm', 'true');
        	                			//step_16_choice_info.attr("checked", "checked");
        	                			step_16_choice_info.val(reqParams[j].code);
        	                	}
        	                    //$('#step_16_name_info_' + i + '_' + j).val(reqParams[j].name);
        	                    //$('#step_16_name_info_' + i + '_' + j).text(reqParams[j].code);
        	                }
						}
	                    else
	                        $('.step_16_info_group_clone').hide();    	                
    	            }
    	        }
    	        else
    	            step_16_informationRequestedNotFound();
	        }
	        else 
    	        step_16_informationRequestedNotFound();
	    }
	    else
            step_16_informationRequestedNotFound();
	    return informationRequested;
	}
	
	function step_16_informationRequestedNotFound(){
    	    $('.step_16_info_group_clone').hide();
    	    $('#step_16_not_info').show().text('Нет доступных сведений');	
	}
	
	function openStep_17() {
		//$('#step_17_name_group_info').attr("style","resize:none; height: 60px; width: 100%");
		$('#step_17_not_info').hide();
		step_17_callWS_moreInformation();
	}
	
	function step_17_callWS_moreInformation() {
		dataRequest = {"moreInformation":{"subservice": getIdSubservice().code, "category": getIdCategory().code}};
		callWebS(ARTKMVurl, dataRequest, step_17_moreInformation_callback, true);
	}
	
	function step_17_moreInformation_callback(xmlHttpRequest, status, dataResponse){
		moreInformation = null;
		if (isResult([dataResponse])){
			if (isResult([dataResponse.moreInformation])){
				moreInformation = dataResponse.moreInformation;
				if (isResult([moreInformation.information])&& (moreInformation.information.length > 0)){
					newCloneSpan('step_17_info_clone', moreInformation.information.length, null);
    	            if (moreInformation.information.length == 1){
    	            	$('#step_17_info_0').css('border', '1px solid #efebde');
    	            }
					for (var i=0; i < moreInformation.information.length; i++){
						var information = moreInformation.information[i];
						var step_17_name_group_info = $('#step_17_name_group_info_' + i); 
						if (isResult([information.group])&&isNotUndefined(information.group.name)){
							step_17_name_group_info.val(information.group.name);
							step_17_name_group_info.text(information.group.code);
							if (information.group.name == ''){
								step_17_name_group_info.hide();
							}	
						}
						else
							step_17_name_group_info.hide();
						
						if (isResult([moreInformation.information[i].data])&&moreInformation.information[i].data.length > 0){
							//var arrClone = ['step_17_name_info_'+i,'step_17_name_rekvizit_info_'+i, 'step_17_rekvizit_info_'+i];
        	                newCloneSpan('step_17_name_info_field_clone_' + i, moreInformation.information[i].data.length, null);
        	                for (var j=0; j< moreInformation.information[i].data.length; j++){
        	                	var data = moreInformation.information[i].data[j];
        	                	var step_17_name_info = $('#step_17_name_info_' + i + "_" + j); 
        	                		step_17_name_info.text(data.name);
        	                		step_17_name_info.val(data.code);
        	                		step_17_name_info.attr('step_17_group', 'step_17_name_group_info_' + i);
    							if (data.name == ''){
    								step_17_name_info.hide();
    							}	
        						if (isResult([data.params])){
        							if (isResult([data.params.param])&&(data.params.param.length > 0)){
        								var param = data.params.param;
        								var arrToClone = ['step_17_name_rekvizit_info_'+i + "_" + j, 'step_17_rekvizit_info_'+i + "_" + j,
        								                  'step_17_rekvizit_info_radio_'+i + "_" + j, 'step_17_rekvizit_info_checkbox_'+i + "_" + j,
        								                  'step_17_rekvizit_info_textarea_'+i + "_" + j];
        								newCloneSpan('step_17_rekvizit_info_clone_' + i+ "_" + j, param.length, arrToClone);//
        	        	                for (var k = 0; k < param.length; k++){
        	        	                	var indx = i + '_' + j + "_" + k;
        	        	                	var step_17_name_rekvizit_info = $('#step_17_name_rekvizit_info_' + indx); 
        	        	                		step_17_name_rekvizit_info.text(param[k].name);
        	        	                		step_17_name_rekvizit_info.val(param[k].code);
        	        	                	if (param[k].type == 'календарь'){
        	        	                		    var id = 'step_17_rekvizit_info_' + indx;
            	        	                		step_17_hideOtherType('input', indx);
            	        	                		$('#' + id).addClass('datepicker');
            	        	                		$('#' + id).css('width', '100px');
            	        	                		createDefaultDatePicker(id);
            	        	                }else
	        	        	                	if (param[k].type == 'текстовое поле'){
	        	        	                		step_17_hideOtherType('input', indx);
	        	        	                	}
	        	        	                	else
	        	        	                		if ((param[k].type == 'радиокнопка')||(param[k].type == 'radio')){
	            	        	                		step_17_hideOtherType('radio', indx);
	            	        	                		$('#step_17_rekvizit_info_radio_' + indx).attr('name', 'step_17_rekvizit_info_radio_' + i + '_' + j);
	        	        	                		}
	        	        	                		else
	        	        	                			if ((param[k].type == 'чекбокс')||(param[k].type == 'checkbox')){
	        	        	                				step_17_hideOtherType('checkbox', indx);
	        	        	                			}
	        	        	                			else
	        	        	                				if ((param[k].type == 'текстария')||(param[k].type == 'textarea')){
	        	        	                					step_17_hideOtherType('textarea', indx);
	        	        	                				}
        	        	                }
        	        	                //switchStateDateTimePicker(false);
        	        	                //switchStateDateTimePicker(true);
        	        	                //$('[name=step_17_name_rekvizit_info]').closest('td').css('width', '27%');	// 18_07_13 by KAVlex
        							}
        							else
        								$('#step_17_info_' + i + '_' + j).hide();
        						}
        						else
    								$('#step_17_info_' + i + '_' + j).hide();
        	                }
						}
						else
							step_17_moreInformationNotFound();
					}
				}
				else
					step_17_moreInformationNotFound();
			}
			else
				step_17_moreInformationNotFound();
		}
		return moreInformation; 
	}
	
	function step_17_moreInformationNotFound(){
	    $('.step_17_info_clone').hide();
	    $('#step_17_not_info').show().text('Нет дополнительных сведений, необходимых для данной услуги');	
	}
	
	function step_17_hideOtherType(type, ind){
		switch (type) {
		case 'input':
			$('#step_17_rekvizit_info_' + ind).show();
			$('#step_17_rekvizit_info_' + ind).attr('inForm', 'true');
			$('#step_17_rekvizit_info_radio_' + ind).hide();
			$('#step_17_rekvizit_info_checkbox_' + ind).hide();
			$('#step_17_rekvizit_info_textarea_' + ind).hide();
			$('#step_17_name_rekvizit_info_' + ind).closest('td').attr("style", "width: 17%");
			break;
		case 'radio':
			$('#step_17_rekvizit_info_' + ind).hide();
			$('#step_17_rekvizit_info_radio_' + ind).show();
			$('#step_17_rekvizit_info_radio_' + ind).attr('inForm', 'true');
			$('#step_17_rekvizit_info_radio_' + ind).closest('tr').find('.field-requiredMarker').hide();
			$('#step_17_rekvizit_info_checkbox_' + ind).hide();
			$('#step_17_rekvizit_info_textarea_' + ind).hide();
			$('#step_17_name_rekvizit_info_' + ind).closest('td').removeAttr("style");
			break;
		case 'checkbox':
			$('#step_17_rekvizit_info_' + ind).hide();
			$('#step_17_rekvizit_info_radio_' + ind).hide();
			$('#step_17_rekvizit_info_checkbox_' + ind).show();
			$('#step_17_rekvizit_info_checkbox_' + ind).attr('inForm', 'true');
			$('#step_17_rekvizit_info_checkbox_' + ind).closest('tr').find('.field-requiredMarker').hide();
			$('#step_17_rekvizit_info_textarea_' + ind).hide();
			$('#step_17_name_rekvizit_info_' + ind).closest('td').removeAttr("style");
			break;
		case 'textarea':
			$('#step_17_rekvizit_info_' + ind).hide();
			$('#step_17_rekvizit_info_radio_' + ind).hide();
			$('#step_17_rekvizit_info_checkbox_' + ind).hide();
			$('#step_17_rekvizit_info_textarea_' + ind).show();
			$('#step_17_rekvizit_info_textarea_' + ind).attr('inForm', 'true');
			$('#step_17_name_rekvizit_info_0_0_1').closest('td').attr("style", "width: 17%");
			break;
		default:
			break;
		}
	}
	   
	function openStep_18() {
		$('.step_18_info_2_document_clone').hide();
		$('.step_18_info_2_group_clone').hide();
   		step_18_callWS_GroupOfDocuments();
//   		step_18_callWS_InfDocument();
    }
    
    function step_18_callWS_GroupOfDocuments() {
    	$('#step_18_info_2_document_detail_clone').hide();
		$('#step_18_info_2_group_document_clone').hide();
		$('#step_18_yourself_doc_document').closest('tr').hide();
		$('input[name="step_18_yourself_doc_group"]').closest('tr').hide();
		$('#step_18_in_SMEV_doc_document').closest('tr').hide();
		$('input[name="step_18_in_SMEV_doc_group"]').closest('tr').hide();
		$('#step_18_info_2_group_document_clone').hide();
    	
		subservice = $('select#step_1_subservices option:selected').val();
		category = $('select#step_1_category option:selected').val();
		dataRequest = {"groupOfDocuments": {"subservice":subservice,"category":category, "signDocPack":"Applicant"}};
		callWebS(ARTKMVurl, dataRequest, step_18_callWS_GroupOfDocuments_callback, true);
	}
    
    function prepEnd(id, insertElem){
    	var elem = $('#'+id); 
		if (!elem.is(':visible')){
			elem.show();
		}
		elem.prepend(insertElem);
    }
    
    function step_18_callWS_GroupOfDocuments_callback(xmlHttpRequest, status, dataResponse){
		//  Получение массива кодов документов удостоверяющих личность
			idenDocCodes = getIndenDocFromDic(); 
			$('#step_18_yourself').hide();
			$('#step_18_SMEV').hide();
		if (isResult([dataResponse, dataResponse.groupOfDocuments])){
			groupOfDocuments = dataResponse.groupOfDocuments;
			if (groupOfDocuments.document.length > 0) {
				var countDocs = 0;
				var countGroupDocs = 0;
				for (var i = 0; i<groupOfDocuments.document.length; i++) {
					if (groupOfDocuments.document[i].group === true) {
						countGroupDocs++;
					} else {
						countDocs++;
					}
				}
				var groupAdnDocs = getGroup_Document_Array(groupOfDocuments.document);
				newCloneSpan('step_18_info_2_document_clone', countDocs, null);
				newCloneSpan('step_18_info_2_group_clone', countGroupDocs, null);
				countIdendocs = 0;  
				//new{04_07_13
					//$('#step_18_yourself').html('<legend class="group_label">Документы, предоставляемые заявителем</legend><br/>');
					//$('#step_18_SMEV').html('<legend class="group_label">Документы, имеющиеся в распоряжении органов власти</legend><br/>');
				//}new
				for (var i=0; i < groupAdnDocs.documents.length; i++){
					if (isInArray(groupAdnDocs.documents[i].key, idenDocCodes)){
						addOption(document.getElementById('step_18_name_doc_document_' + countIdendocs), groupAdnDocs.documents[i].name, groupAdnDocs.documents[i].key, true, true);
						writeDocument(groupAdnDocs.documents[i], 'step_18_name_doc_document_' + j);
						$('#step_18_name_doc_document_' + countIdendocs).attr('step_18_identity', 'true');
						$('#step_18_info_2_document_detail_clone_' + countIdendocs).attr('step_18_identity_ownerdoc', 'true');
						
						setCheckBoxVisible('#step_18_yourself_doc_document_' + countIdendocs, groupAdnDocs.documents[i].privateStorage, groupAdnDocs.documents[i].privateStorage);
						$('#step_18_yourself_doc_document_' + countIdendocs).val(groupAdnDocs.documents[i].privateStorage);
						setCheckBoxVisible('#step_18_in_SMEV_doc_document_' + countIdendocs, groupAdnDocs.documents[i].interagency, groupAdnDocs.documents[i].interagency);
						$('#step_18_in_SMEV_doc_document_' + countIdendocs).val(groupAdnDocs.documents[i].interagency);
						countIdendocs++;
						
						step_18_callWS_InfDocument(i);
					} else {
						var j = countDocs + countIdendocs - i - 1;
						addOption(document.getElementById('step_18_name_doc_document_' + j), groupAdnDocs.documents[i].name, groupAdnDocs.documents[i].key, true, true);
						$('#step_18_name_doc_document_' + j).attr('step_18_identity', 'false');
						$('#step_18_info_2_document_detail_clone_' + j).attr('step_18_identity_ownerdoc', 'false');
						setCheckBoxVisible('#step_18_yourself_doc_document_' + j, groupAdnDocs.documents[i].privateStorage, groupAdnDocs.documents[i].privateStorage);
						$('#step_18_yourself_doc_document_' + j).val(groupAdnDocs.documents[i].privateStorage);
						setCheckBoxVisible('#step_18_in_SMEV_doc_document_' + j, groupAdnDocs.documents[i].interagency, groupAdnDocs.documents[i].interagency);
						$('#step_18_in_SMEV_doc_document_' + j).val(groupAdnDocs.documents[i].interagency);
						
						step_18_callWS_InfDocument(j);
						
						writeDocument(groupAdnDocs.documents[i], 'step_18_name_doc_document_' + j);		//15_07_13 by KAVlex
					}
				}
				//new{04_07_13
				$('.step_18_info_2_document_clone [name=step_18_info_2_document]').each(function() {
					var ind = getIndex(this);
					if (ind != ''){
						var t = $('#step_18_info_2_document' + ind).closest('span');
						if ($('#step_18_yourself_doc_document'+ind).attr('checked')){
							prepEnd('step_18_yourself', t); //$('#step_18_yourself').prepend(t);
						}
						else
							prepEnd('step_18_SMEV', t); //$('#step_18_SMEV').prepend(t);
					}
				});
				//}new
				for (var i=0; i < groupAdnDocs.groups.length; i++){
					$('#step_18_yourself').show();
					addOption(document.getElementById('step_18_name_group_doc_' + i), groupAdnDocs.groups[i].name, groupAdnDocs.groups[i].key, true, true);
					writeDocument(groupAdnDocs.groups[i], 'step_18_name_group_doc_' + i);
				}
			}
		} else {

		}

		return groupOfDocuments;	
    }
    
    var step_18_NumDoc = 0;
    function step_18_callWS_InfDocument(num) {
    	var idOrg = getIdOrg();
    	var identityFL = getIdentityFLFromStep_4();
    	var step_18_idDoc;

    	step_18_idDoc = getIdDoc('step_18_name_doc_document_' + num);
    	step_18_NumDoc = num;
    	dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":step_18_idDoc,"idGroup":{"name":"Наименование","code":"Код организации"},"identityFL":identityFL}};
    	callWebS(VISurl, dataRequest, step_18_InfDocument_callback, false);
	}
    
    
    function step_18_InfDocument_callback(xmlHttpRequest, status, dataResponse) {
    	if (isResult([dataResponse, dataResponse.infDocument])) {
    		if (dataResponse.infDocument.document.length > 0) {
    			infDocument = dataResponse.infDocument;
    			step_18_infDocument_length = infDocument.document.length;
    			step_18_proccessInfDocument(infDocument.document);
    			
    			return infDocument;
    		}
    	} else  {
    		return null;
    	}
    	
    }
    
    function step_18_doc_true_1_document(el) {
    	var ind;
    	
    	ind = $(el).attr('class').split('_').pop();
    	var bringSelfFlag = $('#step_18_yourself_doc_document_'+ind).attr('value');
    	if ($(el).is(':checked')){
            $('.step_18_doc_true_1_document_'+ind).removeAttr("checked");
            $('#step_18_yourself_doc_document_'+ind).closest('tr').hide();
            $(el).attr('checked', 'checked');
            $('span.step_18_info_2_document_detail_clone_'+ind+' > fieldset').hide();
            $(el).closest('fieldset').show();
            $('#step_18_yourself_doc_document_'+ind).removeAttr('checked');
        } else {
        	$('span.step_18_info_2_document_detail_clone_'+ind+' > fieldset').show();
        	if (bringSelfFlag == 'true') {
        		$('#step_18_yourself_doc_document_'+ind).closest('tr').show();
        		$('#step_18_yourself_doc_document_'+ind).attr('checked', 'checked');
        	}
        }
    }
    
    
    function step_18_proccessInfDocument(document){
		var array = [
						'step_18_doc_series_doc_document_'+step_18_NumDoc,
						'step_18_doc_number_doc_document_'+step_18_NumDoc,
						'step_18_doc_issue_date_doc_document_'+step_18_NumDoc,
						'step_18_doc_org_doc_document_'+step_18_NumDoc,
						'step_18_doc_true_1_document_'+step_18_NumDoc,
						'step_18_info_2_document_detail'+step_18_NumDoc,
						'step_18_info_2_document_detail_clone_'+step_18_NumDoc,
						'step_18_name_doc_document_'+step_18_NumDoc
					];
		processDocumentDetails(document, array, 'step_18_yourself_doc_document_'+step_18_NumDoc);
		$('.step_18_doc_number_doc_document_'+step_18_NumDoc).each(function(i){
			if ($(this).val() == '') {
				$(this).closest('fieldset').remove();
			}
		});
    }
    
    var step_18_indexOfGroup;
	function step_18_getDocsByGroup(el){
		idSplitArr = el.id.split('step_18_add_name_group_doc_');
		step_18_indexOfGroup = idSplitArr[1];
		if (el.value == '+'){
			if ($('.step_18_info_2_group_document_clone_'+step_18_indexOfGroup).length > 1){
				$('.step_18_info_2_group_document_clone_'+step_18_indexOfGroup).show();
				el.value = '-';
			} else {
				step_18_callWS_Documents();
			}
		} else{
			$('.step_18_info_2_group_document_clone_'+step_18_indexOfGroup).hide();
			el.value = '+';
		}
		$('#step_18_info_2_group_document_clone_'+step_18_indexOfGroup).hide();		
	}
    
	function step_18_callWS_Documents() {
    	dataRequest = {"documents":{"doc":$('select#step_18_name_group_doc_'+step_18_indexOfGroup+ ' option:selected').val()}};
    	callWebS(ARTKMVurl, dataRequest, step_18_Documents_callback, true);
	}
	
	var step_18_codeSelectDocFromGroup;
	var step_18_documens_length;
    function step_18_Documents_callback(xmlHttpRequest, status, dataResponse) {
        documents = null;
        if (isResult([dataResponse])&&isResult([dataResponse.documents])){
        	if (dataResponse.documents.document.length > 0) {
        		documents = dataResponse.documents;
        		step_18_documens_length = documents.document.length;
    			newCloneSpan('step_18_info_2_group_document_clone_'+step_18_indexOfGroup, documents.document.length, null);
    			
    			for (var i = 0; i < documents.document.length; i++){
    				addOption(document.getElementById('step_18_name_doc_group_'+step_18_indexOfGroup+'_'+i), documents.document[i].name, documents.document[i].key, true, true);
    				$('.step_18_check_doc_group_'+step_18_indexOfGroup +'_'+ i).attr("class", 'step_18_check_doc_group_'+step_18_indexOfGroup);
    				$('.step_18_info_2_group_document_detail_clone_'+step_18_indexOfGroup +'_'+ i).hide();
    				
    				$('#step_18_name_doc_group_'+indexOfGroup+'_'+i).attr('group', $('select#step_18_name_group_doc_'+indexOfGroup).attr("id"));

				writeDocument(documents.document[i], 'step_18_name_doc_group_'+step_18_indexOfGroup+'_'+i);
    			}
    			
    			var ind='';	//12_07_13
    			$('.step_18_check_doc_group_'+step_18_indexOfGroup).change(function() {
  				ind = getTreeId(this.id);
				var indexOfGroup = ind.split("_").shift();
    				if (this.checked){
    					$('span.step_18_info_2_group_document_clone_'+indexOfGroup+' > *').hide();
    					$('fieldset#step_18_info_2_group_document_'+ind).show();
    					step_18_callWS_DocumentType();
    					 if (!$('#step_4_add').is(':checked')) {
    						 step_18_callWS_InfDocument_groupDocs(indexOfGroup, ind);	//step_18_indexOfGroup
    					 }
    				} else{
    					$('span.step_18_info_2_group_document_clone_'+indexOfGroup+' > *').show();	//step_18_indexOfGroup
    					$('span.step_18_info_2_group_document_detail_clone_'+ind).hide();
    					setCheckBoxVisible('#step_18_yourself_doc_group_'+step_18_codeSelectDocFromGroup, false, false);
    					setCheckBoxVisible('#step_18_in_SMEV_doc_group_'+step_18_codeSelectDocFromGroup, false, false);					
    				}
    				
    			});	
    			
    			$('#step_18_add_name_group_doc_'+step_18_indexOfGroup).val('-');
        	}
        	
        	step_18_callWS_DocumentType();
		} else {
    		$('#step_18_info_2_group_' + step_18_indexOfGroup).hide();
		}
		return documents;
    }
	
    
    function step_18_callWS_DocumentType(){
    	var cloneNum = getCheckedCloneIndex('step_18_check_doc_group_'+step_18_indexOfGroup);
    	
		dataRequest = {"documentType":{"doc":$('select#step_18_name_doc_group_'+step_18_indexOfGroup+'_'+cloneNum+ ' option:selected').val()}};
		callWebS(ARTKMVurl, dataRequest, step_18_DocumentType_callback, true);
	}
    
    function step_18_appEnd(id, insertElem){
    	var elem = $('#'+id);
    	var otherId = 'step_18_SMEV';
    	if (id.indexOf('SMEV') > 0){
    		otherId = 'step_18_yourself';
    	}
    	if (!elem.is(':visible')){
    		elem.show();
    	}
    	elem.append(insertElem);
    	var otherElem = $('#'+otherId);
    	if (otherElem.find('fieldset').length < 1){
    		otherElem.hide();
    	}
    }
	
	function step_18_DocumentType_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse, dataResponse.DocumentType])){
			var cloneNum = getCheckedCloneIndex('step_18_check_doc_group_'+step_18_indexOfGroup);
			documentType = dataResponse.DocumentType;
			setCheckBoxVisible('#step_18_yourself_doc_group_'+step_18_indexOfGroup+'_'+cloneNum, documentType.privateStorage, documentType.privateStorage);
			$('#step_18_yourself_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).val(documentType.privateStorage);
			setCheckBoxVisible('#step_18_in_SMEV_doc_group_'+step_18_indexOfGroup+'_'+cloneNum, documentType.interagency, documentType.interagency);
			$('#step_18_in_SMEV_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).val(documentType.interagency);
			var t = $('#step_18_in_SMEV_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).closest('span.step_18_info_2_group_clone');
			if (documentType.interagency){
				step_18_appEnd('step_18_SMEV', t);
				//$('#step_18_SMEV').append(t);	
			}
			else {
				if (t.closest('fieldset.step_18_yourself').length == 0)	//если еще не там?
					step_18_appEnd('step_18_yourself', t);
					//$('#step_18_yourself').append(t);
			}
			return documentType;
		}
		return null;
	}
	
	function step_18_callWS_InfDocument_groupDocs(groupNum, docNum) {
    	var idOrg = getIdOrg();
    	var idDoc = {"name": $('#step_18_name_doc_group_'+docNum).text(),"code": $('#step_18_name_doc_group_'+docNum+' option:selected').val()};
    	var idGroup = {"name": $('#step_18_name_group_doc_'+groupNum).text(),"code": $('#step_18_name_group_doc_'+groupNum+' option:selected').val()};
    	var identityFL = getIdentityFLFromStep_4();
		dataRequest = {"infDocument":{"idOrg":idOrg,"idDoc":idDoc,"idGroup":idGroup,"identityFL": identityFL}};
		callWebS(VISurl, dataRequest, step_18_callWS_InfDocument_groupDocs_callback, true);
    }
    
    function step_18_callWS_InfDocument_groupDocs_callback(xmlHttpRequest, status, dataResponse) {
    	
    	if (isResult([dataResponse, dataResponse.infDocument])) {
    		if (dataResponse.infDocument.document.length > 0) {
    			var cloneNum = getCheckedCloneIndex('step_18_check_doc_group_'+step_18_indexOfGroup);
        		infDocument = dataResponse.infDocument;
    			step_18_infDocument_groupDocs_length = infDocument.document.length;
    			var array = [
    				'step_18_doc_series_doc_group_'+step_18_indexOfGroup+'_'+cloneNum,
    				'step_18_doc_number_doc_group_'+step_18_indexOfGroup+'_'+cloneNum,
    				'step_18_doc_issue_date_doc_group_'+step_18_indexOfGroup+'_'+cloneNum,
    				'step_18_doc_org_doc_group_'+step_18_indexOfGroup+'_'+cloneNum,
    				'step_18_doc_true_1_group_'+step_18_indexOfGroup+'_'+cloneNum,
    				'step_18_info_2_group_document_detail_'+step_18_indexOfGroup+'_'+cloneNum,
    				'step_18_info_2_group_document_detail_clone_'+step_18_indexOfGroup+'_'+cloneNum
    			];
    			processDocumentDetails(infDocument.document, array, 'step_18_yourself_doc_group_'+step_18_indexOfGroup+'_'+cloneNum);
    	
    			$('.step_18_doc_number_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).each(function(i){
    				if ($(this).val() == '') {
    					$(this).closest('fieldset').remove();
    				}
    			});
    			
    			
    			$('.step_18_doc_true_1_group_'+step_18_indexOfGroup+'_'+cloneNum).change(function(){
    				var bringSelfFlag = $('#step_18_yourself_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).attr('value');
    				if (this.checked){
    					var ind = getCheckedCloneIndex('step_18_doc_true_1_group_'+step_18_indexOfGroup+'_'+cloneNum);
    					$('.'+$(this).attr("class")).removeAttr("checked");
    					$('span.step_18_info_2_group_document_detail_clone_'+step_18_indexOfGroup+'_'+cloneNum).hide();
    					$('span#step_18_info_2_group_document_detail_clone_'+step_18_indexOfGroup+'_'+cloneNum+'_'+ind).show();
    					$('#step_18_yourself_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).removeAttr('checked');
    					this.checked = true;
    				} else {
    					$('span.step_18_info_2_group_document_detail_clone_'+step_18_indexOfGroup+'_'+cloneNum).show();
    					$('span#step_18_info_2_group_document_detail_clone_'+step_18_indexOfGroup+'_'+cloneNum).hide();
    					if (bringSelfFlag == 'true') {
    		        		$('#step_18_yourself_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).closest('tr').show();
    		        		$('#step_18_yourself_doc_group_'+step_18_indexOfGroup+'_'+cloneNum).attr('checked', 'checked');
    		        	}
    				}
    			});
    			
        		return infDocument; 
    		}
    	} else {
    		return null;
    	}
    	
	}
	
   
    function openStep_19() {	
		clearValues('step_19_doc_need_clone');
		$('#step_19_doc_need_table').hide();
		removeCloneSpan('step_19_doc_need_clone');
		//alert('Данный шаг еще разрабатывается! Приносим свои глубочайшие извинения');
		$('#step_19_where').val(getSelectedObject('step_1_social_institution').name);	//$('#step_1_social_institution option:selected').text()
		$('#step_19_date').hide();
		$('#step_19_address').closest('tr').hide();
		$('#step_19_time_work').closest('tr').hide();
		$('#step_19_tel').closest('tr').hide();
		
		var arrayToClone = ['step_19_doc_need', 'step_19_name_declarant_k'];
		var needDocsSteps = [2,3,4,7,12,13,14,15,18];
		for (var i=0; i < needDocsSteps.length; i++){
		    if (isInArray(needDocsSteps[i], Steps)){
			    var docNeed = eval('getInfoByStep19FromStep' + needDocsSteps[i])();
			    if (isResult([docNeed])){
				    for (var j=0; j<docNeed.length; j++){
				    	if (!alreadyInStep19(docNeed[j])){
				    		cloneSpanWithoutDelete('step_19_doc_need_clone', 1, arrayToClone);
				    		var ind = $('.step_19_doc_need_clone').length - 2;// - docNeed.length + 1;
					        $('#step_19_doc_need_' + (ind)).val(docNeed[j].docName);
	   				        $('#step_19_doc_need_' + (ind)).attr('step_19_doc_code', docNeed[j].docCode);
					        $('#step_19_name_declarant_k_' + (ind)).val(docNeed[j].fio);
				    	}
				    }
			    }
		    }			
		}
		if ($('.step_19_doc_need_clone').length > 1){
			step_19_callWS_InfOrganization();
			var needDocsStepsFromFirstSteps = [2,3,4,5,6];
			for (var i=0; i < needDocsStepsFromFirstSteps.length; i++){
			    if (isInArray(needDocsStepsFromFirstSteps[i], Steps)){
				    var docNeed = eval('getIdenInfoFromStep' + needDocsStepsFromFirstSteps[i])();
				    if (isResult([docNeed])){
					    for (var j=0; j<docNeed.length; j++){
					        /*var alreadyInStep19 = false;
					        $('[step_19_doc_code='+docNeed[j].docCode+']').each(function(){
					            if($('#step_19_name_declarant_k'+getIndex(this)).val() == docNeed[j].fio)
					                alreadyInStep19 = true;
					                //return false;
					        });*/
					        if (!alreadyInStep19(docNeed[j])){
    					        cloneSpanWithoutDelete('step_19_doc_need_clone', 1, arrayToClone);
                                var ind = $('.step_19_doc_need_clone').length - 2;// - docNeed.length + 1;
    					        $('#step_19_doc_need_' + (ind)).val(docNeed[j].docName);	// + j
	    				        //$('#step_19_doc_need_' + (ind + j)).text(docNeed[j].docCode);
    					        $('#step_19_name_declarant_k_' + (ind)).val(docNeed[j].fio);	// + j
					        }
					    }
				    }
			    }			
			}
			$('#step_19_doc_need_table').html(getTableStep19()).show();
			$('.step_19_doc_need_clone').hide();		
		}
		else {
  			$('#doc_need_spanlabel').hide();
  			$('#doc_need_fieldset').hide();
  			$('#infOrganization_table').hide();
			$('#step_19_doc_need_table').hide();
			$('.step_19_doc_need_clone').hide();
		}
	}
    
    function alreadyInStep19(docNeed){
        var alreadyInStep19 = false;
        $('[step_19_doc_code='+docNeed.docCode+']').each(function(){
            if($('#step_19_name_declarant_k'+getIndex(this)).val() == docNeed.fio)
                alreadyInStep19 = true;
                return false;
        });
        return alreadyInStep19;
    }


	function getInfoByStep19FromStep15(){
	    var res = [];
	    $('[name=step_15_add_info_money]:checked').each(function(){
	        var ind = getIndex(this);
	        $('.step_15_name_declarant_k'+ind).each(function(i){
	            if (i > 0){
    	            var indMember = this.id.substr('step_15_name_declarant_k'.length, this.id.length);
	                var fio = this.value;
	                res = res.concat(getNeedsDocs('step_15_doc_bring_himself', 'step_15_name_doc_sdd', indMember, fio));
	                res = res.concat(getNeedsDocsByGroup('step_15_check_doc', 'step_15_doc_bring_himself_group', 'step_15_name_doc_sdd_group', indMember, fio));
	            }
	        });
	    });
        return res;
	}
	
	function getTableStep19(){
		var table = '<table id="step_19_doc_need_table" name="step_19_doc_need_table" class="step_19_doc_need_table" border="" cellspacing="1" width="100%"><tbody><tr style=" background-color: rgb(209, 209, 209); "><th width="60%" ALIGN="CENTER">Наименование документа</th><th>Фамилия Имя Отчество</th></tr>';
		$('.step_19_doc_need_clone').each(function(i) {
			if (i > 0){
				table += '<tr><td ALIGN="CENTER">'+getValue('step_19_doc_need_'+(i-1))+'</td><td ALIGN="CENTER">'+getValue('step_19_name_declarant_k_'+(i-1))+'</td></tr>'; 
			}
		});
		table += '</tbody></table>'; 
		return table; 
	}
	
	function getIdenInfoFromStep2(){
		var res = [];
		var i = 0;
		var tmp = new Object();
		tmp.docName = getSelectedObject('step_2_doc_legal_representative_type').text;
		tmp.docCode = getSelectedObject('step_2_doc_legal_representative_type').code;
		tmp.fio =  getFIOFromFields('step_2_last_name_legal_representative', 'step_2_first_name_legal_representative', 'step_2_middle_name_legal_representative');
		res[i++] = tmp;
		return res;
	}
	
	function getIdenInfoFromStep3(){
		var res = [];
		var i = 0;
		var tmp = new Object();
		tmp.docName = getSelectedObject('step_3_step_3_document_type_org').text;
		tmp.docCode = getSelectedObject('step_3_step_3_document_type_org').code;
		tmp.fio =  getFIOFromFields('step_3_lastname_org', 'step_3_name_org', 'step_3_middlename_org');
		res[i++] = tmp;
		return res;
	}
	
	function getIdenInfoFromStep4(){
		var res = [];
		if (!$('#step_4_doc_other').attr('checked')){
			var doc = getDocNameFromStep4();
			yourSelfInfoFromStep4 = new Object();
			var fio_tmp = getFIOFromStep4();
			yourSelfInfoFromStep4.fio = fio_tmp.surname + " " + fio_tmp.name + " " + fio_tmp.patronymic;
			yourSelfInfoFromStep4.docName = doc.docName;
			yourSelfInfoFromStep4.docCode = doc.docCode;
			res[0] = yourSelfInfoFromStep4;
		}
		return res;		
	}
	
	function getIdenInfoFromStep5(){
		infoFromStep5 = new Object();
		infoFromStep5.docName = getSelectedObject('step_5_doc_declarant_type').name;
		infoFromStep5.docCode = getSelectedObject('step_5_doc_declarant_type').code;
		infoFromStep5.fio = getFIOFromFields('step_5_last_name_declarant', 'step_5_first_name_declarant', 'step_5_birthday_declarant');
		var res = [];
		res[0] = infoFromStep5;
		return res;		
	}
	
	function getIdenInfoFromStep6(){
		infoFromStep6 = new Object();
		infoFromStep6.docName = getSelectedObject('step_6_step_6_document_type_org').name;
    	infoFromStep6.docCode = getSelectedObject('step_6_step_6_document_type_org').code;
		infoFromStep6.fio = getFIOFromFields('step_6_lastname_org', 'step_6_name_org', 'step_6_middlename_org');
		var res = [];
		res[0] = infoFromStep6;
		return res;
	}
	
	function getInfoByStep19FromStep2(){
		var res = [];
		var i = 0;
		if ($('#step_2_yourself_trustee_doc').attr('checked')){
			yourSelfInfoFromStep2 = new Object();
			//if (isResult([getSelectedObject('step_2_name_doc').code]))
			    var d = getSelectedObject('step_2_name_doc');
				yourSelfInfoFromStep2.docName =  d.name;
				yourSelfInfoFromStep2.docCode =  d.code;
			//else
			//	return null;
			yourSelfInfoFromStep2.fio = getFIOFromFields('step_2_last_name_legal_representative', 'step_2_first_name_legal_representative', 'step_2_middle_name_legal_representative');
			res[i++] = yourSelfInfoFromStep2;
			//return res;
		}
		return res;
	}
	
	function getInfoByStep19FromStep3(){
		if ($('#step_3_yourself_trustee_doc').attr('checked')){
			yourSelfInfoFromStep3 = new Object();
			//if (isResult([getSelectedObject('step_2_name_doc').code]))
			    var d = getSelectedObject('step_3_name_doc');
				yourSelfInfoFromStep3.docName =  d.name;
				yourSelfInfoFromStep3.docCode =  d.code;
			//else
			//	return null;
			yourSelfInfoFromStep3.fio = getValue('step_3_reduced_name_org');
			var res = [];
			res[0] = yourSelfInfoFromStep3;
			return res;
		}
		return null;
	}
	
	function getInfoByStep19FromStep4(){
		var res = [];
		if ($('#step_4_doc_other').attr('checked')){
			var doc = getDocNameFromStep4();
			yourSelfInfoFromStep4 = new Object();
			var fio_tmp = getFIOFromStep4();
			yourSelfInfoFromStep4.fio = fio_tmp.surname + " " + fio_tmp.name + " " + fio_tmp.patronymic;
			yourSelfInfoFromStep4.docName = doc.docName;
			yourSelfInfoFromStep4.docCode = doc.docCode;
			res[0] = yourSelfInfoFromStep4;
		}
		return res;
	}
	
	function getInfoByStep19FromStep5(){
		infoFromStep5 = new Object();
		infoFromStep5.docName = getSelectedObject('step_5_doc_declarant_type').name;
		infoFromStep5.docCode = getSelectedObject('step_5_doc_declarant_type').code;
		infoFromStep5.fio = getFIOFromFields('step_5_last_name_declarant', 'step_5_first_name_declarant', 'step_5_middle_name_declarant');
		var res = [];
		res[0] = infoFromStep5;
		return res;
	}
	
	function getInfoByStep19FromStep6(){
		infoFromStep6 = new Object();
		infoFromStep6.docName = getSelectedObject('step_6_step_6_document_type_org').name;
    	infoFromStep6.docCode = getSelectedObject('step_6_step_6_document_type_org').code;
		infoFromStep6.fio = getFIOFromFields('step_6_lastname_org', 'step_6_name_org', 'step_6_middlename_org');
		var res = [];
		res[0] = infoFromStep6;
		return res;
	}
	
	function getInfoByStep19FromStep7(){
	    var res = [];
	    var selPerson = getCheckedCloneIndex('step_7_is_set_people_true');
	    var fio = "";
	    if (selPerson >= 0){
    	    fio = getFIOFromFields('step_7_last_name_people_'+selPerson, 'step_7_first_name_people_'+selPerson, 'step_7_middle_name_people_'+selPerson);
    	}
    	else {
    	    fio = getFIOFromFields('step_7_last_name_people_two', 'step_7_first_name_people_two', 'step_7_middle_name_people_two');
    	}
    	res = getNeedsDocs('step_7_yourself_trustee_doc_document', 'step_7_doc_name_document', '_', fio);
   	    res = res.concat(getNeedsDocsByGroup('step_7_doc_true_group','step_7_yourself_trustee_doc_group', 'step_7_doc_name_group', '_', fio));
	    
	    return res;
	}
	
	function getNeedsDocs(name_, doc, startInd, fio){
		 var res = [];
		 $('[name='+name_+']').each(function(i){
		    if ((this.id.indexOf(name_ + startInd) >= 0) && (this.id != (name_ + startInd))){
	            if (i > 0){ //первый(дефолтовый) элемент не трогаем
	                if (this.checked){
	                    var ind = this.id.substr(name_.length, this.id.length);
	                    var docNeed = new Object();
	                    docNeed.docName = getSelectedObject(doc + ind).name;
	                    docNeed.docCode = getSelectedObject(doc + ind).code;
	                    docNeed.fio = fio;
	                    res[res.length] = docNeed;
	                }
	            }
	        }
	     });
	    return res;
	}
	
	function getNeedsDocsByGroup(changeDocName, yourSelfName, doc, startInd, fio){
	    var res = [];
  	    $('[name='+changeDocName+']').each(function(i){
  	      if ((this.id.indexOf(changeDocName + startInd) >= 0) && (this.id != (changeDocName + startInd))){
     	     if (i > 0){ //первый(дефолтовый) элемент не трогаем
       	        if (this.checked){  //если выбран документ
           	        var ind = this.id.substr(changeDocName.length, this.id.length);
       	            if ($('#'+yourSelfName + ind).attr('checked')){     //убрать !!!
                         var docNeed = new Object();
                        docNeed.docName = getSelectedObject(doc + ind).name;
                        docNeed.docCode = getSelectedObject(doc + ind).code;
                        docNeed.fio = fio;
                        res[res.length] = docNeed;
                    }
       	        }
       	     }
       	  }
   	    });
   	    return res;
	}
	
	function getNeedsDocsFromStep(nameArray, add){
		var memberName = nameArray[0];
		var lastName = nameArray[1];
		var firstName = nameArray[2];
		var middleName = nameArray[3];
		var bring_himself_document = nameArray[4];
		var doc_document = nameArray[5];
		var check_doc = nameArray[6]; 
		var bring_himself_group = nameArray[7];
		var doc_group = nameArray[8];

	   	 var res = [];
	   	 if (add){
	   		$('[name='+memberName+']').each(function(j){
	    		 if (j > 0){
			        var indMember = this.id.substr(memberName.length, this.id.length);
			        var fio = getFIOFromFields(lastName+indMember, firstName+indMember, middleName+indMember);
			        res = res.concat(getNeedsDocs(bring_himself_document, doc_document, indMember, fio));
			        res = res.concat(getNeedsDocsByGroup(check_doc, bring_himself_group, doc_group, indMember, fio));
	    		 }
	    	 });
	   	 }
	   	 else {
			 $('[name='+memberName+']').each(function(i){
			    if (this.checked){
			        var indMember = this.id.substr(memberName.length, this.id.length);
			        var fio = getFIOFromFields(lastName+indMember, firstName+indMember, middleName+indMember);
			        res = res.concat(getNeedsDocs(bring_himself_document, doc_document, indMember, fio));
			        res = res.concat(getNeedsDocsByGroup(check_doc, bring_himself_group, doc_group, indMember, fio));
			    }
			 });
	   	 }
		 return res;
	}	
	
	function getInfoByStep19FromStep12(){
    	 var res = [];
    	 $('[name=step_12_set_family_member_mf]').each(function(i){
    	    if (this.checked){
    	        var indMember = this.id.substr('step_12_set_family_member_mf'.length, this.id.length);
    	        var fio = getFIOFromFields('step_12_last_name_declarant_mf'+indMember, 'step_12_first_name_declarant_mf'+indMember, 'step_12_middle_name_declarant_mf'+indMember);
    	        res = res.concat(getNeedsDocs('step_12_doc_declarant_bring_himself_mf_document', 'step_12_name_doc_declarant_mf_document', indMember, fio));
    	        res = res.concat(getNeedsDocsByGroup('step_12_check_doc_declarant_mf_group', 'step_12_doc_declarant_bring_himself_mf_group', 'step_12_name_doc_declarant_mf_group', indMember, fio));
    	    }
    	 });
    	 if ($('#step_12_add_family_member_mf').attr('checked'))
	    	 $('[name=step_12_last_name_family_member_mf]').each(function(j){
	    		 if (j > 0){
	    			 var indMember = this.id.substr('step_12_last_name_family_member_mf'.length, this.id.length);
	    			 var fio = getFIOFromFields('step_12_last_name_family_member_mf'+indMember, 'step_12_first_name_family_member_mf'+indMember, 'step_12_middle_name_family_member_mf'+indMember);
	    			 res = res.concat(getNeedsDocs('step_12_doc_declarant_bring_himself_mf2_document', 'step_12_name_doc_declarant_mf2_document', indMember, fio));
	    			 res = res.concat(getNeedsDocsByGroup('step_12_check_doc_declarant_mf2_group', 'step_12_doc_declarant_bring_himself_mf2_group', 'step_12_name_doc_declarant_mf2_group', indMember, fio));
	    		 }
	    	 });
	    return res;
	}
	
	function getInfoByStep19FromStep13(){
	   	 var res = [];
	   	 $('[name=step_13_set_family_member_sdd_z]').each(function(i){
	   	    if (this.checked){
	   	        var indMember = this.id.substr('step_13_set_family_member_sdd_z'.length, this.id.length);
	   	        var fio = getFIOFromFields('step_13_last_name_declarant_sdd_z'+indMember, 'step_13_first_name_declarant_sdd_z'+indMember, 'step_13_middle_name_declarant_sdd_z'+indMember);
	   	        res = res.concat(getNeedsDocs('step_13_doc_declarant_bring_himself_sdd_z_document', 'step_13_name_doc_declarant_sdd_z_document', indMember, fio));
	   	        res = res.concat(getNeedsDocsByGroup('step_13_check_doc_declarant_sdd_z_group', 'step_13_doc_declarant_bring_himself_sdd_z_group', 'step_13_name_doc_declarant_sdd_z_group', indMember, fio));
	   	    }
	   	 });
	   	 if ($('#step_13_add_family_member_sdd_z').attr('checked')){
		   	 var nameArray = [
		   	                  	'step_13_last_name_family_member_sdd_z',
		   	                  	'step_13_last_name_family_member_sdd_z','step_13_first_name_family_member_sdd_z','step_13_middle_name_family_member_sdd_z',
		   	                  	'step_13_doc_bring_himself_sdd_z_document','step_13_name_doc_sdd_z_document',
		   	                  	'step_13_check_doc_sdd_z_group','step_13_doc_bring_himself_sdd_z_group','step_13_name_doc_sdd_z_group'
		   	                  ];
		   	 res = res.concat(getNeedsDocsFromStep(nameArray, true));
	   	 }
	     return res;
	}
	
	function getInfoByStep19FromStep14(){
		var res = [];
		$('[name=step_14_set_family_member_sdd_nz]').each(function(i){
	   	    if (this.checked){
	   	        var indMember = this.id.substr('step_14_set_family_member_sdd_nz'.length, this.id.length);
	   	        var fio = getFIOFromFields('step_14_last_name_declarant_sdd_nz'+indMember, 'step_14_first_name_declarant_sdd_nz'+indMember, 'step_14_middle_name_declarant_sdd_nz'+indMember);
	   	        res = res.concat(getNeedsDocs('step_14_doc_declarant_bring_himself_sdd_nz_document', 'step_14_name_doc_declarant_sdd_nz_document', indMember, fio));
	   	        res = res.concat(getNeedsDocsByGroup('step_14_check_doc_declarant_sdd_nz_group', 'step_14_doc_declarant_bring_himself_sdd_nz_group', 'step_14_name_doc_declarant_sdd_nz_group', indMember, fio));
	   	    }
   	 	});
		if ($('#step_14_add_family_member_sdd_nz').attr('checked')){
		   	var nameArray = [
		   	                  	'step_14_last_name_family_member_sdd_nz',
		   	                  	'step_14_last_name_family_member_sdd_nz','step_14_first_name_family_member_sdd_nz','step_14_middle_name_family_member_sdd_nz',
		   	                  	'step_14_doc_bring_himself_sdd_nz_document','step_14_name_doc_sdd_nz_document',
		   	                  	'step_14_check_doc_sdd_nz_group','step_14_doc_bring_himself_sdd_nz_group','step_14_name_doc_sdd_nz_group'
		   	                  ];
		   	res = res.concat(getNeedsDocsFromStep(nameArray, true));
		}
	    return res;
	}
	
	function getInfoByStep19FromStep18(){
	    var res = [];
	    //if (!$('#step_4_add').attr('checked')){
		    var fio = '';
		    if (isInArray('4', Steps)){
		         var fio_obj = getFIOFromStep4();
                 fio = fio_obj.surname + " " + fio_obj.name + " " + fio_obj.patronymic;   
		    }
		    else 
		        if(isInArray('5', Steps))
    		        fio = getInfoByStep19FromStep5()[0].fio;
       		    else 
    		        if(isInArray('6', Steps))
        		        fio = getInfoByStep19FromStep6()[0].fio;
		    res = res.concat(getNeedsDocs('step_18_yourself_doc_document', 'step_18_name_doc_document', '_', fio));
		    res = res.concat(getNeedsDocsByGroup('step_18_check_doc_group', 'step_18_yourself_doc_group', 'step_18_name_doc_group', '_', fio));
	    //}
	    return res;
	}
	
	function getFIOFromFields(surnameId, nameId, patronymicId){
		return getValueIfNotNull(getValue(surnameId)) + getValueIfNotNull(getValue(nameId)) + getValueIfNotNull(getValue(patronymicId));  
	}
		
	function step_19_callWS_InfOrganization(){
		dataRequest = {"infOrganization":{"subservice": getIdSubservice().code, "category": getIdCategory().code, "org": getIdOrg().code}};
		callWebS(ARTKMVurl, dataRequest, step_19_InfOrganization_callback, true);
	}
	
	function step_19_InfOrganization_callback(xmlHttpRequest, status, dataResponse){
		if (isResult([dataResponse, dataResponse.InfOrganization])){
			infOrganization = dataResponse.InfOrganization;
			if (isResult([infOrganization.dateDocuments])){
				$('#step_19_date').show();
				$('#step_19_date').val(infOrganization.dateDocuments);
			}
			if (isResult([infOrganization.phone])){
				$('#step_19_tel').closest('tr').show();
				$('#step_19_tel').val(infOrganization.phone);
			}
			if (isResult([infOrganization.address])){
				$('#step_19_address').closest('tr').show();
				$('#step_19_address').val(addressToStringOther(infOrganization.address));
				$('#step_19_address').attr("style","resize:none; height: 80px; width: 100%");
			}
			if (isResult([infOrganization.methodOperation])){
				$('#step_19_time_work').closest('tr').show();
				$('#step_19_time_work').val(getTextTimeWork(infOrganization.methodOperation));
				$('#step_19_time_work').attr("style","resize:none; height: 120px; width: 100%");
			}
			$('#step_19_address').css('background-color', 'red');
			$('#step_19_address').css('cssText', document.getElementById('step_19_address').style.cssText.replace('red', '#ebebe4 !important'));
			$('#step_19_time_work').css('background-color', 'red');
			$('#step_19_time_work').css('cssText', document.getElementById('step_19_time_work').style.cssText.replace('red', '#ebebe4 !important'));
			//$('#step_19_date').css({'background-color':'#efebde', 'border':'0', 'width':'3%', 'text-align':'center'});
			//$('#step_19_where').css({'background-color':'#efebde', 'border':'0'});
			//$('#step_19_address').css({'background-color':'#efebde', 'border':'0', 'width':'100%', 'heigth':'30px'});
			//$('#step_19_time_work').css({'background-color':'#efebde', 'border':'0', 'width':'100%'});
			return infOrganization; 
		}
		return null;
	}
	
	function getDayWork(day){
		dayWork = "";
		if (isResult([day])){
			if (day.dayOff)
				dayWork = "выходной";
			else {
				if (isNotUndefined(day.startTime)&&isNotUndefined(day.timeEnd))
					dayWork = day.startTime + ' - ' + day.timeEnd;
				if (isResult([day.lunch]))
					dayWork += ', обед: ' + day.lunch.startTime + ' - ' + day.lunch.timeEnd;
			}
		}
		return dayWork;
	}
	
	function getTextTimeWork(methodOperation){
		var text = "";
		text += "пн: " + getDayWork(methodOperation.monday) + '\n';
		text += "вт: " + getDayWork(methodOperation.tuesday) + '\n';
		text += "ср: " + getDayWork(methodOperation.wednesday) + '\n';
		text += "чт: " + getDayWork(methodOperation.thursday) + '\n';
		text += "пт: " + getDayWork(methodOperation.friday) + '\n';
		text += "сб: " + getDayWork(methodOperation.saturday) + '\n';
		text += "вс: " + getDayWork(methodOperation.sunday);
		return text;
	}
    
  //------------------------------
	//СПРАВОЧНИКИ - начало
	//------------------------------	
	var elementId;
	function setDictionary(dictionaryName, elementById){
		url = dicUrl + dictionaryName;
		elementId = elementById;
		callDicWS(url, parseDictionaryResponse);
		//$.getJSON(url, parseDictionaryResponse);
	}

	//функция parseDictionaryResponse
	function parseDictionaryResponse(json)
	{
	  if (json.length > 0)
	  {
	    var oCityList = document.getElementById(elementId); 
	    clearSelect(oCityList); // удаляем все элементы из списка
	    addOption(oCityList, '- Выберите -', '', false, false);
	    for (var loop = 0; loop < json.length; loop++)
	    {
	      var name = json[loop].value;
	      var id = json[loop].name;
	      addOption(oCityList, name, id, false, false);
	    }
	  }
	}


	// JSON запросы на прорисовку справочника
	// функция addOption
	function addOption (oListbox, text, value, isDefaultSelected, isSelected)
	{
	  var oOption = document.createElement("option");
	  oOption.style.width = '100%';
	  oOption.appendChild(document.createTextNode(text));	//.substring(0,60)
	  oOption.setAttribute("value", value);
	  oOption.setAttribute('title', text);
	  if (isDefaultSelected) oOption.defaultSelected = true;
	  else if (isSelected) oOption.selected = true;
	  oListbox.appendChild(oOption);
	}

	// функция clearSelect
	function clearSelect(oListbox)
	  {
	    for (var i=oListbox.options.length-1; i >= 0; i--)
	    {
	       oListbox.remove(i);
	    }
	  }
	//------------------------------
	//СПРАВОЧНИКИ - конец
	//------------------------------

	//------------------------------
	//КЛАДР - начало
	//------------------------------

	function loadKladr(kladrArrayId){
		for (var l=0; l<kladrArrayId.length; l++){
			clearSelect(document.getElementById(kladrArrayId[l]));
		}
		loadKladrRegions(kladrArrayId);
		$('#'+kladrArrayId[kladrArrayId.length-1]).unbind('change');
		$('#'+kladrArrayId[kladrArrayId.length-1]).unbind('click');
		for (var l=0; l<kladrArrayId.length-1; l++){
			$('#'+kladrArrayId[l]).unbind();
			$('#'+kladrArrayId[l]).bind('change',function(){
				change_kladr(this, kladrArrayId);
			});
		}
		$('#'+kladrArrayId[0]).val('58').change();
	}

	// Начальная загрузка регионов.
	function loadKladrRegions(array){
		var region = array[0];
		var district = array[1];
		var city = array[2];
		var village = array[3];
		var street = array[4];
		$.ajax({
			url: kladrURL,		///kladr.php
			type: 'POST',
			dataType: 'json',	
			async: false, // включаем синхронность запросов.
			data: '',
			success: function(data){ 	
				var html1 = '';
				var html2 = '<option value="" id=""></option>';
				var html3 = '<option value="" id=""></option>';
				var html4 = '<option value="" id=""></option>';
				var html5 = '<option value="" id=""></option>';

				for(var c=1;c<=data.length;c++){
					var record = data[c-1];
				
					var name 	= record.name;
					var code	= record.code;
					var socr 	= record.socr;			
					var level 	= record.level;				
					var index   = '';
					if (isNotUndefined(record.index))
    					index   = record.index;	
				
					if(level == 1) html1 += '<option value="'+code+'" title="'+name+'">'+name+' ('+socr+')</option>';
					if(level == 2) html2 += '<option value="'+code+'" title="'+name+'">'+name+' ('+socr+')</option>';
					if(level == 3) html3 += '<option value="'+code+'" title="'+name+'">'+name+' ('+socr+')</option>';
					if(level == 4) html4 += '<option value="'+code+'" postCode="'+index+'" title="'+name+'">'+name+' ('+socr+')</option>';
					if(level == 5) html5 += '<option value="'+code+'" postCode="'+index+'" title="'+name+'">'+name+' ('+socr+')</option>';				
				}
			
				if(html1.length>0) {
					$('#'+region).append('<option value="" id="">Выберите значение...</option>');
					$('#' + region).append(html1);
				}
				if(html2.length>0) $('#' + district).append(html2);
				if(html3.length>0) $('#' + city).append(html3);
				if(html4.length>0) $('#' + village).append(html4);
				if(html5.length>0) $('#' + street).append(html5);			
			}
		});		
	}
	
	function change_kladr(combobox, array){
		var region = array[0];
		var district = array[1];
		var city = array[2];
		var village = array[3];
		var street = array[4];
		var code = $(combobox).val();
	
		var combobox_id = combobox.id;
	
		if(code==0 && combobox_id=='district'){ 
			code = $('#region').val();
			combobox_id = $('#region').attr('id');
		}

		// Делаем очистку всех полей
		switch(combobox_id){
			case region:
				$('#' + district).html('<option value=""> </option>');
				$('#' + city).html('<option value=""> </option>');
				$('#' + village).html('<option value=""> </option>');		
				$('#' + street).html('<option value=""> </option>');
				$('.' + district).val('');
				$('.' + city).val('');
				$('.' + village).val('');
				$('.' + street).val('');	
			break;
			case district:
			    if ($('#'+district).val() == 0)
			        $('#' + district).html('<option value=""> </option>');    
				$('#' + city).html('<option value=""> </option>');
				$('#' + village).html('<option value=""> </option>');		
				$('#' + street).html('<option value=""> </option>');
				$('.' + city).val('');
				$('.' + village).val('');
				$('.' + street).val('');	
			break;
			case city:
			    if ($('#'+city).val() == 0)
			        $('#' + city).html('<option value=""> </option>');   
				$('#' + village).html('<option value=""> </option>');		
				$('#' + street).html('<option value=""> </option>');

				$('.' + village).val('');
				$('.' + street).val('');			
			break;
			case village:
			    if ($('#'+village).val() == 0)
			        $('#' + village).html('<option value=""> </option>');   
				$('#' + street).html('<option value=""> </option>');
				$('.' + street).val('');
			break;
		}
	
		$.ajax({
			url: kladrURL,		
			type: 'POST',
			dataType: 'json',	
			async: false, // включаем синхронность запросов.

			data: 'ID_DISTRICT='+$('#'+region).val()+'&ID_REGION='+$('#' + district).val()+'&ID_TOWN='+$('#' + city).val() +'&ID_LOCALITY='+$('#' + village).val()+'&ID_STREET='+$('#' + street).val(),
			//data: 'ID_DISTRICT='+$('#region').val()+'&ID_REGION=&ID_TOWN=&ID_LOCALITY=&ID_STREET=',
			dataType: 'text', 
			success: function(data){
				data = JSON.parse(data);
		
				var html2 = '';
				var html3 = '';
				var html4 = '';
				var html5 = '';

				for(var c=1;c<=data.length;c++){
					var record = data[c-1];
				
					var name 	= record.name;
					var code	= record.code;
					var socr 	= record.socr;			
					var level 	= record.level;	
					var index   = '';
					if (isNotUndefined(record.index))
    					index   = record.index;					
				
					if(level == 2) html2 += '<option value="'+code+'" title="'+name+'">'+name+' ('+socr+')</option>';
					if(level == 3) html3 += '<option value="'+code+'" title="'+name+'">'+name+' ('+socr+')</option>';
					if(level == 4) html4 += '<option value="'+code+'" postCode="'+index+'" title="'+name+'">'+name+' ('+socr+')</option>';
					if(level == 5) html5 += '<option value="'+code+'" postCode="'+index+'" title="'+name+'">'+name+' ('+socr+')</option>';						
				}
			
				if(html2.length>0) $('#' + district).append(html2);
				if(html3.length>0) $('#' + city).append(html3);
				if(html4.length>0) $('#' + village).append(html4);
				if(html5.length>0) $('#' + street).append(html5);			
			}
		});		
	}
	//------------------------------
	//Кладр - конец
	//------------------------------

	function addressToString(address){
		addressStr = "";
		if (isResult([address])){
			if ((address.country != null)&&(address.country != ''))
				addressStr += address.country + ", ";
			if ((address.region.reduction != null)&&(address.region.reduction != ''))		
				addressStr += address.region.reduction + " ";
			if ((address.region.name != null)&&(address.region.name != ''))
				 addressStr += address.region.name	+ ", ";
			if ((address.populatedLocality.reduction != null)&&(address.populatedLocality.reduction != ''))
				 addressStr += address.populatedLocality.reduction + " ";
			if ((address.populatedLocality.name != null)&&(address.populatedLocality.name != ''))
				 addressStr += address.populatedLocality.name + ", ";
			if ((address.district != null)&&(address.district != ''))
				addressStr += address.district + ", ";
			if ((address.downPopulatedLocality.reduction != null)&&(address.downPopulatedLocality.reduction != ''))
				addressStr += address.downPopulatedLocality.reduction + " ";
			if ((address.downPopulatedLocality.name != null)&&(address.downPopulatedLocality.name != '')) 
				addressStr += address.downPopulatedLocality.name + ", ";
			if ((address.street.reduction != null)&&(address.street.reduction != ''))
				addressStr += address.street.reduction + " ";
			if ((address.street.name != null)&&(address.street.name != ''))
				addressStr += address.street.name + ", ";
			if ((address.house != null)&&(address.house != ''))
				 addressStr += address.house + ", "; 
			if ((address.body != null)&&(address.body != ''))
				addressStr += address.body + ", ";
			if ((address.structure != null)&&(address.structure != ''))
				 addressStr += address.structure + ", ";
			if ((address.apartment != null)&&(address.apartment != ''))
				 addressStr += address.apartment + ", ";
			if ((address.room != null)&&(address.room != ''))
				 addressStr += address.room + ", ";
			addressStr = addressStr.substr(0, addressStr.length-2);
		}
		return addressStr;
	}
	
	function addressToStringOther(address){
		var addressStr = "";
		addressStr += getValueWithCommaIfNotNull(address.postCode);
		addressStr += getValueIfNotNull(address.region.abbreviation);
		addressStr += getValueWithCommaIfNotNull(address.region.name);
		addressStr += getValueIfNotNull(address.area.abbreviation);
		addressStr += getValueWithCommaIfNotNull(address.area.name);
		addressStr += getValueIfNotNull(address.city.abbreviation);
		addressStr += getValueWithCommaIfNotNull(address.city.name);
		addressStr += getValueIfNotNull(address.community.abbreviation);
		addressStr += getValueWithCommaIfNotNull(address.community.name);
		addressStr += getValueIfNotNull(address.street.abbreviation);
		addressStr += getValueWithCommaIfNotNull(address.street.name);
		addressStr += getValueWithCommaIfNotNull(address.house);
		addressStr += getValueWithCommaIfNotNull(address.housing);
		addressStr += getValueWithCommaIfNotNull(address.construction);
		addressStr += getValueWithCommaIfNotNull(address.apartment);
		addressStr += getValueWithCommaIfNotNull(address.room);
		return addressStr.substr(0, addressStr.length-2);
	}
	

	function clearValues(id){		//очистить значения клонируемых блоков
		$('.'+id + ' input[type="text"]').val('');
		$('.'+id + ' textarea').val('');
		$('.'+id + ' input[type="checkbox"]').each(function(){
			if ($(this).val() != 1)
				$(this).removeAttr("checked");
		});
	}

	

	function cloneSpan(clazz, length) {
    	$('span[class="' + clazz + '"]:first').hide();
    	
		for (var i=0; i< length; i++){
//			switchStateDateTimePicker(false);
			$('span[class="' + clazz + '"]:first').clone().insertAfter('span[class="' + clazz + '"]:last').show();
//			switchStateDateTimePicker(true);
		}
		$('fieldset.' + clazz.substr(0,clazz.length - 6)).show().filter(':first').hide();
	}
	
	function cloneSpanWithoutDelete(clazz, length, array) {	//очистка+удаление+клонирование
		cloneSpan(clazz, length);
		if (array != null){
			for(i in array){
				setIdToCloneElement(array[i]);
			}
		}
		else{
			setIdAndClassToCloneElement(clazz);
		}
	}
	
		
	function getValueWithCommaIfNotNull(val){
		if (isResult([val]))
			val += ", ";
		else
			val = "";
		return val;
	}
	
	function getValueIfNotNull(val){
		if (isResult([val]))
			val += " ";
		else
			val = "";
		return val;
	}
	
	function getAddressFromFields(fieldArray){
		var address = new Object();
		address.region = new Object();
		address.downPopulatedLocality = new Object(); 
		address.populatedLocality = new Object();
		address.street = new Object();
		address.region.name = valueOrNull($('#'+fieldArray[0]).val());	//регион
		address.district = 	valueOrNull($('#'+fieldArray[1]).val());	//район
		address.populatedLocality.name  =	valueOrNull($('#'+fieldArray[2]).val());//город
		address.downPopulatedLocality.name = 	valueOrNull($('#'+fieldArray[3]).val());//населенный пункт
		address.street.name = 	valueOrNull($('#'+fieldArray[4]).val());//улица
		address.house =  valueOrNull($('#'+fieldArray[5]).val());//дом
		address.body = 	valueOrNull($('#'+fieldArray[6]).val());//корпус
		address.structure =	valueOrNull($('#'+fieldArray[7]).val());//строение
		address.apartment = valueOrNull($('#'+fieldArray[8]).val());//квартира
		address.room = 	valueOrNull($('#'+fieldArray[9]).val());//комната
		if (fieldArray.length > 10)
    		address.postCode = valueOrNull($('#'+fieldArray[10]).val());//почтовый индекс
		return address;
	}
	
	function getAddressFromFields2(fieldArray){
		var address = new Object();
		address.region = new Object();
		address.downPopulatedLocality = new Object(); 
		address.populatedLocality = new Object();
		address.street = new Object();
		address.region.name = valueOrNull($('#'+fieldArray[0] + ' option:selected').text());	//регион
		address.district = 	valueOrNull($('#'+fieldArray[1] + ' option:selected').text());	//район
		address.populatedLocality.name  =	valueOrNull($('#'+fieldArray[2] + ' option:selected').text());//город
		address.downPopulatedLocality.name = 	valueOrNull($('#'+fieldArray[3] + ' option:selected').text());//населенный пункт
		address.street.name = 	valueOrNull($('#'+fieldArray[4] + ' option:selected').text());//улица
		address.street.kodKLADR = valueOrNull($('#'+fieldArray[4] + ' option:selected').val());//код кладра
		address.house =  valueOrNull($('#'+fieldArray[5]).val());//дом
		address.body = 	valueOrNull($('#'+fieldArray[6]).val());//корпус
		address.structure =	valueOrNull($('#'+fieldArray[7]).val());//строение
		address.apartment = valueOrNull($('#'+fieldArray[8]).val());//квартира
		address.room = 	valueOrNull($('#'+fieldArray[9]).val());//комната
		if (fieldArray.length > 10)
    		address.postCode = valueOrNull($('#'+fieldArray[10]).val());//почтовый индекс
		return address;
	}
	
	function getCodeDocByName(docName) {
	     if (!isNotUndefined(docName))
	        docName = '';
         var resCall = [];
         var resultDoc = new Object();
         if (docName == 'Паспорт гражданина РФ'){
             resultDoc.name = 'Паспорт гражданина России';            
             resultDoc.code = 'rusPassport';            
         }
         else {           
             resultDoc.name = docName;
             resultDoc.code = '';
             docName = replaceAll(' ', '', docName).toLowerCase();
	         jQuery.ajax({
	              url: dicUrl + 'document_name',
	              type: "GET",
	              async: false,
	              timeout: 80000,   
	              dataType: "application/json",

            	  xhrFields: {
	                withCredentials: false 
            	  },
	              processData: true, 
	              complete: function myCallback(xmlHttpRequest, status, dataResponse){
	            		resCall = JSON.parse(xmlHttpRequest.responseText);
	              }
	         });
	         if (resCall.length > 0){
                    for (var loop = 0; loop < resCall.length; loop++)
                    {
	                      var name = replaceAll(' ', '', resCall[loop].value).toLowerCase();
                          var code = resCall[loop].name;
	                      if (name == docName){
                                resultDoc.code = code;
                                resultDoc.name = resCall[loop].value;
                                break;
                          }
                    }
	          }
	      }
	     return resultDoc;
    }

      function getIndenDocFromDic(){
    	  if (!isResult([idenDocCodes])){
    			var idenDocCodes_tmp = []; 
    			$.ajax({
    				url: dicUrl+'document_name',
    				dataType : "json",
    				async: false,
    				success: function (json) {
    				    for (var loop = 0; loop < json.length; loop++){
    				    	idenDocCodes_tmp[loop] = json[loop].name;     	
    				    }
    				} 
    			});
    			return idenDocCodes_tmp;  
    	  }
	  return idenDocCodes;	  
	}
		
    function errorCallSteps() {
		text = 'Не удалось получить набор шагов для данной услуги. Обратитесь к администратору системы';
		if (typeof SCREEN != 'undefined'){
			SCREEN.errorMessage(text);
		}
		else{
			alert(text);
		}
	}
	
	function getFioBirthFromStep_4() {
		var step_8_last_name_recept = '', step_8_first_name_recept = '', step_8_middle_name_recept = '', step_8_birthday_recept = '';
		if ($('fieldset#step_4_info_2').css('display') != 'none') {
			step_8_last_name_recept = $('#step_4_last_name_declarant').val();
			step_8_first_name_recept = $('#step_4_first_name_declarant').val();
			step_8_middle_name_recept = $('#step_4_middle_name_declarant').val(); 
			step_8_birthday_recept = $('#step_4_birthday_declarant').val();
		}
		var step_4_info_5_visible_bool = false;
		$('span.step_4_info_5_clone').each(function(){
			if ($(this).css('display') != 'none') {
				step_4_info_5_visible_bool = true;
			}
		});
		if ($('#step_4_add').is(':checked')) {
			if ($('fieldset#step_4_info_8').css('display') != 'none') {
				step_8_last_name_recept = $('#step_4_last_name_new').val();
				step_8_first_name_recept = $('#step_4_name_new').val();
				step_8_middle_name_recept = $('#step_4_middle_name_new').val(); 
				step_8_birthday_recept = $('#step_4_birth_date_new').val();
			} else {
				if (step_4_info_5_visible_bool === true) {
					ind = 0;
					array = [];
					var chkData = '';
					$(".step_4_is_declarant_system_true").each(function() {
						if ($(this).attr('checked')) {
							chkData = $(this).attr('id');
						}
				       ind++;
					});  
					chkData = chkData.split('_');
					index = chkData.pop();
					step_8_last_name_recept = $('#step_4_last_name_system_' + index).val();
					step_8_first_name_recept = $('#step_4_name_system_' + index).val();
					step_8_middle_name_recept = $('#step_4_middle_name_system_' + index).val(); 
					step_8_birthday_recept = $('#step_4_birth_date_system_' + index).val();
				}
			}
		}  else {
			if (step_4_info_5_visible_bool === true) {
				ind = 0;
				array = [];
				var chkData = '';
				$(".step_4_is_declarant_system_true").each(function() {
					if ($(this).attr('checked')) {
						chkData = $(this).attr('id');
					}
			       ind++;
				});  
				chkData = chkData.split('_');
				index = chkData.pop();
				step_8_last_name_recept = $('#step_4_last_name_system_' + index).val();
				step_8_first_name_recept = $('#step_4_name_system_' + index).val();
				step_8_middle_name_recept = $('#step_4_middle_name_system_' + index).val(); 
				step_8_birthday_recept = $('#step_4_birth_date_system_' + index).val();
			}
		}
		var fioBirthData = [step_8_last_name_recept, step_8_first_name_recept, step_8_middle_name_recept, step_8_birthday_recept];
		return fioBirthData;
	}
		
	
	function getGroup_Document_Array(document){
		res = {};
		res.groups = []; 
		res.documents = [];
		n = 0; //for group
		m = 0; //for document
		for (var i=0; i < document.length; i++){
			if (document[i].group){
				res.groups[n++] = document[i];  
			}
			else {
				res.documents[m++] = document[i];
			}				
		}
		return res;
	}
	
    function getRelative(relArray, index){
    	var fio = {"surname": $('#'+relArray[0] +index).val(),"patronymic":$('#'+relArray[1]+index).val(),"name":$('#'+relArray[2]+index).val()};
    	var relative = {"fio": fio,"dateOfBirth":$('#'+relArray[3]+index).val()};
    	return relative;
    }
	
	function getIdDoc(docId){
    	var idDoc = {"name":$('select#' + docId + ' option:selected').text(),"code":$('select#' + docId + ' option:selected').val()};
    	return idDoc;
    }
	
	function getFIO(arrayFIOid){//fio, patronymic, name
        var fio = {"surname":$('#' + arrayFIOid[0]).val(),"patronymic":$('#' + arrayFIOid[1]).val(),"name": $('#' + arrayFIOid[2]).val()};
        return fio;
    }
    
    function getDocument(groupId, docNameId, changeClass, paramsArray){
       	var ind = getCheckedCloneIndex(changeClass);
       	for (var i=0; i<paramsArray.length; i++){
       		paramsArray[i] = paramsArray[i] + '_' + ind;
       	}

    	var params = {"param":[{"name":"Серия","code": DocumentSeries, "type":"Integer","value":$('#' + paramsArray[0]).val()},
					{"name":"Номер","code": DocumentsNumber, "type":"Integer","value":$('#' + paramsArray[1]).val()},
					{"name":"Кем выдан","code": GiveDocumentOrg, "type":"String","value":$('#' + paramsArray[2]).val()}]};
		var group = {"name":"Наименование группы","code":"Код группы"};
		if (groupId !=  null){
		    group.name = $('#' +groupId+ ' option:selected').text();
		    group.code = $('#' +groupId+ ' option:selected').val();
		}
        var document = {"group":group,"name":$('#'+docNameId+' option:selected').text(),"code":$('#'+docNameId+' option:selected').val(),"dateIssue":$('#' + paramsArray[3]).val(),"params":params};
        return document;
    }
    
    function getIdentityFL(fio, birthday, document){
        var identityFL = {"fio":fio,"dateOfBirth":$('#'+birthday).val(),"document": document};
        return identityFL;
    }

    function getCheckedRadioValue(radioGroupName) {		//получить выбранное значение из radioGroup
 	   var rads = document.getElementsByName(radioGroupName),
 	       i;
 	   for (i=0; i < rads.length; i++)
 	      if (rads[i].checked)
 	    	  return rads[i].value;
 	   return null; 
 	}
    
    function getTreeId(id){
		var treeIds = id.split('_');
		var res = '_' + treeIds.pop();
		res = treeIds.pop() + res;
		return res;
    }

	function getArrayValue(arr) {
		res = new Array();
		for(var key in arr) {
			res[key] = $(arr[key]).val();
		}
		return res;
	}
	
	function getService(){	//подуслуга - много где нужна в запросах
		var idSubservice = {"name":getSelectedObject('step_1_service').name,"code":getSelectedObject('step_1_service').code};
		return idSubservice;
	}

	function setService(code, text){
		$("#step_1_service option:selected").val(code);
		$("#step_1_service option:selected").text(text);
	}
	
	function getIdSubservice(){	//подуслуга - много где нужна в запросах
		var el = $('#step_1_subservices option:selected');
		var name = el.attr('title');
		if (!isNotUndefined(name)||(name==''))
			name = el.text();
		var idSubservice = {"name":name,"code": el.val()};
		return idSubservice;
	}
	
	function getIdCategory(){	//категория - много где нужна в запросах
		var el = $('#step_1_category option:selected');
		var name = el.attr('title');
		if (!isNotUndefined(name)||(name==''))
			name = el.text();
		var idCategory = {"name":name,"code": el.val()};
		return idCategory;
	}
	
	function getIdOrg(){	//организация - много где нужна в запросах
	    var el = $('#step_1_social_institution option:selected');
	    var name = el.attr('title');
		if (!isNotUndefined(name)||(name==''))
			name = el.text();
		var idOrg = {"name": name,"code":el.val()};
		return idOrg;
	}
	
	function getValIfNotNull(val){
		if (!isNotUndefined(val))
			val = "";
		return val;
	}
	
	function getCheckedCloneNumber(length, id) {	//получить номер клонируемого блока с возведенным чекбоксом
		for (var i=0; i < length; i++) 
		{
			if ($(id+i).attr("checked")) {
				return i;
			}
		}
		return -1;
	}
	
	function getCheckedCloneIndex(clazz) {	//получить номер клонируемого блока с возведенным чекбоксом по классу
		for (var i=0; i < $("." + clazz).length; i++) 
		{
			if ($('#' + clazz + '_' + i).attr("checked")) {
				return i;
			}
		}
		return -1;
	}
    
    function hideAllWithoutThis(clazz, thisIndex){
    	i = 0;
    	$('.'+clazz).each(function() {
			if (i > 0){
				if ((i-1) != thisIndex){
					$(this).hide();
				}
				else{
					$(this).show();
				}
			}
			i++;
		});
    }
    
    function isInArray(value, array){
		for(i in array){
			if (array[i] == value)
				return true;
		}
		return false;
	}
    
	function isIdentification(idWithSharp){     //если не подтверждает данные, то показываем hint и дисайблим форму
		$(idWithSharp).change(function(e){
			if (!this.checked){
				$(idWithSharp + '_hint').show();		//removeAttr("hidden", "hidden");
				$(idWithSharp).nextAll().not('input[type="button"]').each(function(){
					this.disabled='true';
				});				
			}
			else{
				$(idWithSharp + '_hint').hide();		//attr("hidden", "hidden");
				$(idWithSharp).nextAll().each(function(){this.disabled=null;});
			}
		});	
	}
	
    function isResult(listArray){
        for (var i=0; i<listArray.length; i++){
            if (($.isEmptyObject(listArray[i]))||(typeof listArray[i] == 'undefined')||(listArray[i] == null)||(listArray[i] == '{}')||(listArray[i] == '[]'))
                return false;
        }
        return true;
    }
	


 function validObjectMembers(listArray, arrTest)
 {
   //listArray - объект
   //arrTest - что из него хотим, напр: ["dataResponse.groupOfDocuments.document.length", ...]   
   //возвращает со всеми элементами (если не было - пустые)
   if ( typeof(listArray) == 'undefined' ) 
   {
     listArray = {};   
   }
   
   for (var i=0; i<arrTest.length; i++)
   {
     var arrOneTest = arrTest[i].split(".");  
    j=0;
    if (arrOneTest[j].indexOf("[]")>=0)
    {
      var elName = arrOneTest[j].replace("[]","");
   if (typeof(listArray[elName]) == 'undefined') 
   {     
     listArray[elName] = [];
   }
   else
   if (typeof(listArray[elName].length) == 'undefined')
   {
     listArray[elName] = [listArray[elName]];
   }
      if (j<arrOneTest.length-1)
            {         
     arrOneTest.splice(0,j+1);
        for (var k=0; k<listArray[elName].length; k++)
     {             
    if (listArray[elName][k] == "") { listArray[elName][k]={}; }
       listArray[elName][k] = validObjectMembers(listArray[elName][k], [arrOneTest.join(".")]);
        }  
   }         
    }
    else
    {
      var elName = arrOneTest[j];
         if (typeof(listArray[elName]) == 'undefined') 
      {   
     listArray[elName] = "";
      }
       if (j<arrOneTest.length-1)
            {         
     arrOneTest.splice(0,j+1);
     if (listArray[elName] == "") { listArray[elName]={}; }
        listArray[elName] = validObjectMembers(listArray[elName],[arrOneTest.join(".")]);
   }  
    }
   } 
   return listArray;
    }
	
	function processDocumentDetails(document, arrayToClone, yourself_trustee_docId){
		switchStateDateTimePicker(false);
		newCloneSpan(arrayToClone[6], document.length, arrayToClone);
		switchStateDateTimePicker(true);
		
		for (var i=0; i < document.length; i++) {
			$('#'+arrayToClone[2]+'_' + i).val(document[i].dateIssue);
			var isVisibleBlock = false;  
			for (var j=0; j<document[i].params.param.length; j++){
				var param = document[i].params.param[j];
				isNotVisibleBlock = false;	//должно быть true;
				if (param.code == DocumentsNumber){
					isVisibleBlock = isNotUndefined(document[i].dateIssue)&&(document[i].dateIssue != '');
					isVisibleBlock = isVisibleBlock && (param.value != null)&&(param.value != '')&&(isNotUndefined(param.value));
					$('#'+arrayToClone[1]+'_' + i).val(param.value);
				}
				else if (param.code == DocumentSeries){
					$('#'+arrayToClone[0]+'_' + i).val(param.value);		
				}
				else if (param.code == GiveDocumentOrg){
					$('#'+arrayToClone[3]+'_' + i).val(param.value);
				}
			}
			if (isVisibleBlock){
				$('#'+arrayToClone[5]+'_' + i).show();	//attr("hidden","hidden");
			}
			else {
				$('#'+arrayToClone[5]+'_' + i).attr('isVisible', 'false');
				$('#'+arrayToClone[5]+'_' + i).hide();	//removeAttr("hidden","hidden");
			}
			if (isResult([arrayToClone[7]])){
				$('#'+arrayToClone[4]+'_' + i).attr('document', arrayToClone[7]);
			}
		}
		$('.'+arrayToClone[4]).change(function(){
			if (this.checked){
				$('.'+arrayToClone[4]).removeAttr("checked", "checked");
				this.checked = true;
				ind =  this.id.split("_").pop();//substr((arrayToClone[4]+'_').length, this.id.length);
				if ($('#'+yourself_trustee_docId).attr("checked")){
					//$('#'+yourself_trustee_docId).removeAttr("checked");
					setCheckBoxVisible('#'+yourself_trustee_docId, false, false);
				}
				hideAllWithoutThis(arrayToClone[5], ind);
			}
			else {
				setCheckBoxVisible('#'+yourself_trustee_docId, $('#'+yourself_trustee_docId).val(), $('#'+yourself_trustee_docId).val());
				showAllWithoutDefault(arrayToClone[5]);
			}
		});
	}

	function removeCloneSpan(clazz){	//удалить клонируемые блоки
		var length = $('span[class="' + clazz + '"]').length;
		for (var i=length; i>1; i--){
			$('span[class="' + clazz + '"]:last').remove();
		}
	}
	
	function setCheckBox(id, value) {	//id='#id'	//установить значение чекбокса
			if ((value == 'true') || (value == true)) {
				$(id).attr("checked", "checked");
			}
			else	{
				$(id).removeAttr("checked", "checked");				
			}
	}

	function setCheckBoxVisible(id, value) {	//id='#id'	//установить видимость чекбокса
			if (value == false) {
				$(id).closest('tr').hide();
				$(id).hide();	//attr("hidden", "hidden");
				$(id + '_label').hide();	//attr("hidden", "hidden");
				if ($(id + '_hint') != null)
					$(id + '_hint').hide();
			}
			else	{
				$(id).closest('tr').show();
				$(id).show();	//removeAttr("hidden", "hidden");					
				$(id + '_label').show();	//removeAttr("hidden", "hidden");				
				if ($(id + '_hint') != null)
					$(id + '_hint').show();
			}
	}

	function setCheckBoxVisible(id, value, check) {	//id='#id'	//установить видимость чекбокса
			if ((value == false)||(value == 'false')) {
				$(id).closest('tr').hide();
				$(id).hide();	//attr("hidden", "hidden");
				$(id + '_label').hide();	//attr("hidden", "hidden");
				if ($(id + '_hint') != null)
					$(id + '_hint').hide();
				setCheckBox(id, false);
			}
			else	{
				$(id).closest('tr').show();
				$(id).show();	//removeAttr("hidden", "hidden");					
				$(id + '_label').show();	//removeAttr("hidden", "hidden");				
				if ($(id + '_hint') != null)
					$(id + '_hint').show();
				setCheckBox(id, check);
			}
	}

	function setIdToCloneElement(id) {	//проставить id к клонируемым элементам
		if (isResult([id])){
			var i = 0;
			$('.'+id).each(function () {            
			    if (i != 0){
		        	$(this).attr("id", id + "_" + (i-1));}
		        	i++;
			});
		}
	}
	
	function setClassToCloneElement(classs) {	//проставить id к клонируемым элементам
		if (isResult([classs])){
			var i = 0;
			$('.' + classs).each(function () {          
			    if (i != 0)
		        	$(this).attr("class",  this.id);	//.substr(0, this.id.lastIndexOf("_")))
		        	i++;
			});
		}
	}
	
	function setIdAndClassToCloneElement(clazz){
		alreadyArray = [];
		classArray = [];
		t = 0;
		$('.'+clazz).find('*').each(function(){
			if (isNotUndefined($(this).attr('class'))&&($(this).attr('class').indexOf('step_') == 0))
				classArray[t++] = $(this).attr('class');
		});
		for (key in classArray){
			if (!isInArray(classArray[key], alreadyArray)){
				setIdToCloneElement(classArray[key]);
				setClassToCloneElement(classArray[key]);
				alreadyArray[alreadyArray.length] = classArray[key];
			}
		}
	}
	
	function setOnlyOneChange(clazz){   //clazz без .
		$('.' + clazz).change(function(){
            if (this.checked){
                $('.' + clazz).removeAttr("checked", "checked");
                this.checked = true;
            }
        });
    }
	
	
    function showAllWithoutDefault(clazz){
    	var i=0;
    	$('.'+clazz).each(function() {
    		if (i != 0){
    			if ($(this).attr('isVisible') != 'false')
    				$(this).show();
    		}
    		i++;
		});
    }

	function switchStateDateTimePicker(state){
	     var datepicker = $('.datepicker');
	     if(datepicker==null || datepicker.datepicker==null){
		       return; 
     		}
	     if(state==true){
    		$.datepicker.regional['ru'] = {
     		          closeText: 'Закрыть',
      		         prevText: '&#x3c;Пред',
      		         nextText: 'След&#x3e;',
      		         currentText: 'Сегодня',
     		          monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        	           'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
     		          monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
        	           'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
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
        	   
        	   datepicker.datepicker({ dateFormat: 'dd.mm.yy', showOn: "both", buttonImage: "/scripts/proxy.php/http://194.85.124.1:38080/VISServiceServletOEP/js/calendar2.gif",
        	   buttonImageOnly: true, changeYear: true, changeMonth : true,  maxDate: "+0m +0w +0d", yearRange: '1910:3025' });
	     }else{
	       datepicker.each(function(){
			try{
				$(this).datepicker("destroy");
			}catch(e){
				if ($(this).hasClass("hasDatepicker")){
					$(this).removeClass("hasDatepicker");
					if ($(this).next('img').length > 0)
						$(this).next('img').remove();
				}
					
			}
	       });
	     }
	   }

	function checkAndCreateDatePicker(datepicker) {	
		if($(datepicker).hasClass('datepicker')){
				$(datepicker).removeAttr('id').removeClass('hasDatepicker');
				$(datepicker).next('img').remove();
				createDatePicker($(datepicker));
		}
	}
	
	function createDefaultDatePicker(id) {
		var datepicker = $('#'+id);
		if (isNotUndefined(datepicker.datepicker))
			datepicker.datepicker({ dateFormat: 'dd.mm.yy', showOn: "both", buttonImage: "/scripts/proxy.php/http://194.85.124.1:38080/VISServiceServletOEP/js/calendar2.gif",
									buttonImageOnly: true, changeYear: true, changeMonth : true,  maxDate: "+60m +0w +0d", yearRange: '1910:3025' });		
	}
	
	function createDatePicker(datepicker) {
		if (isNotUndefined(datepicker.datepicker))
			datepicker.datepicker({ dateFormat: 'dd.mm.yy', showOn: "both", buttonImage: "/scripts/proxy.php/http://194.85.124.1:38080/VISServiceServletOEP/js/calendar2.gif",
									buttonImageOnly: true, changeYear: true, changeMonth : true,  maxDate: "+0m +0w +0d", yearRange: '1910:3025' });		
	}
   
	function valueOrNull(val){
		if (isResult([val]))
			return val;
		else
			return null;
	}

	function newCloneSpan(clazz, length, array) {	//очистка+удаление+клонирование
		
		clearValues(clazz);
		removeCloneSpan(clazz);
		cloneSpan(clazz, length);
		if (array != null){
			for(i in array){
				setIdToCloneElement(array[i]);
			}
		}
		else{
			setIdAndClassToCloneElement(clazz);
		}
	}
	
	function getParameter(paramName) {
		  var searchString = window.location.search.substring(1),
		      i, val, params = searchString.split("&");

		  for (i=0;i<params.length;i++) {
		    val = params[i].split("=");
		    if (val[0] == paramName) {
		      return val[1];
		    }
		  }
		  return null;
	}
	
	function getElementType(element){
		var type = $(element).attr("type");
		if (type == 'text'){
			if ($(element).is('input')){
				if ($(element).hasClass('datepicker'))
					type = 'date';
				else
					type = 'input';
			}else
				if ($(element).is('textarea'))
					type = 'textarea';
		}
		return type;
	}
	
	function getElementHTMLByType(type, id, name){
		var elementHTML = '';
		switch (type) {
			case 'input':
				elementHTML = '<input required="required" type="text" class="attr" name="'+ name + '" id="' + id + '"/>';
				break;
			case 'radio':
				elementHTML = '<input required="required" type="radio" class="attr" name="'+ name + '" id="' + id + '"/>';
				break;
			case 'checkbox':
				elementHTML = '<input required="required" type="checkbox" class="attr" name="'+ name + '" id="' + id + '"/>';
				break;
			case 'textarea':
				elementHTML = '<textarea required="required" type="text" class="attr" name="'+ name + '" id="' + id + '"></textarea>';
				break;
			case 'date':
				elementHTML = '<input required="required" type="text" class="attr datepicker" style="width: 100px;" name="'+ name + '"/>';
				break;
			default:
				break;
		}
		return elementHTML;
	}
	
	function writeAttr(attrs, id, insertAfter, clazz){
    	if (isResult([attrs])){
    		var insertText = '<br><table class="'+clazz+'"><tbody>';
	    	for (var i in attrs) {
	    		var attr = attrs[i];
				if (isNotUndefined(attr.code) && isNotUndefined(attr.name)){
					var new_id = id + '_' + attr.code;
					//<span class="field-requiredMarker" style="color: rgb(255, 0, 0); font-style: italic; margin-left: 20px;">*&nbsp;</span>
					insertText += '<tr><td><span class="label" >' + attr.name + ':</span></td><td>';
					if (!isNotUndefined(attr.type))
						insertText += '<input required="required" type="text" class="attr" name="'+ attr.code + '"/>';	//" id="' + new_id + '
					else{
						insertText += getElementHTMLByType(attr.type, new_id, attr.code);		
					}
					insertText += '</td></tr>';
				}
			}
	    	insertText += '</tbody></table>';
	    	insertAfter.append(insertText);
	    	/*insertAfter.closest('fieldset').find(".datepicker").each(function(){
	    		createDatePicker($(this));
	    	});*/
    	}	
	}
	
	function writeAttrs(doc, id, insertAfter){
		switchStateDateTimePicker(false);
		if (isResult([doc.attrs]))
			writeAttr(doc.attrs.attr, id, insertAfter, "attrs");
		if (isResult([doc.attrsMV]))
			writeAttr(doc.attrsMV.attr, id, insertAfter, "attrsMV");
		switchStateDateTimePicker(true);
	}

	function writeDocument(doc, id, hideByCheckNames) {
	    var elem = $('#' + id); 
	    var stringLength = 110;
	    var parent = elem;
	    if (elem.parent().is('div')){
	    	stringLength = elem.parent().width()/7;
	    	parent = elem.parent(); 
	    }
	    else
	    	stringLength = elem.width()/7;
	    var stringHight = 8;
	    var l = doc.name.length;
	    var id_text = id + "_text";  
	    if (l > stringLength) 
	    {
	        l = Math.round((l/stringLength)*stringHight);
			elem.hide();
			parent.before('<textarea disabled="disabled" id="' + id_text + '" readonly style="max-width: 100% !important; width: 99%; resize: none; background-color: rgb(235, 235, 228)!important;">'+ $('#' + id +' option:selected').text() +'</textarea>');
			//document.getElementById(id_text).style.height = document.getElementById(id_text).scrollHeight+"px";
	    }
	    var insertAfter = elem.closest('fieldset');
	    writeAttrs(doc, id, insertAfter);
	    addHideAttrsRules(elem);
	}
	
	function addHideAttrsRules(docElem){
		var checkboxs = docElem.closest('fieldset').find('input[type=checkbox]:not(:disabled)');
		
		checkboxs.each(function(){
			$(document).on("change", "[name="+$(this).attr("name")+"]", function(){
				changeToShowOrHideAttrs(this);
			});
			changeToShowOrHideAttrs(checkboxs[0]);
		});
	}
	
	function changeToShowOrHideAttrs(elem){
		var attrs = $(elem).closest('fieldset').find('.attrs, .attrsMV');
		if (elem.checked){
			if (attrs.length > 0){
				attrs.show();
				attrs.addClass("used");
			}else{
				var atrs  = $(elem).closest('span').closest('fieldset').find('.attrs, .attrsMV').hide();
				atrs.removeClass("used");
			}
		}else{
			if (attrs.length > 0){
				attrs.hide();
				attrs.removeClass("used");
			}else{
				var atrs  = $(elem).closest('span').closest('fieldset').find('.attrs, .attrsMV').show();
				atrs.addClass("used");
			}
		}
	}
	
	
	//************************************//
	//      методы для построения XML 	  //
	//									  //
    function isNotUndefined(val){
    	return !(typeof val == 'undefined');
    }
    
    function getSelectedObject(id){
    	resObj = new Object();
    	var objSel = $('#'+id + ' option:selected');
    	if (isNotUndefined(objSel.attr('title'))&&(objSel.attr('title') != ''))
        	resObj.name =  objSel.attr('title');
        else
            resObj.name =  objSel.text();
    	resObj.text =  objSel.text();
    	resObj.code =  objSel.val();
    	return resObj; 
    }
    
    function getValue(id){
    	return $('#'+id).val();
    }
    
	function getIndex(element){
		var ind = element.id.substr($(element).attr('name').length, element.id.length);
		return ind;
	}
	
	function callWS_transportService(){
		sendXML = '';
				sendXML += getTransitInfoXML();
				sendXML += '<dec:Declaration>';	
				sendXML += getServiceInfo();
								for (var i = 0; i < Steps.length - 1; i++){
									if (Steps[i] != 19)
										sendXML += eval('getXML_step_'+Steps[i])();
								}
								sendXML += getListStepsXML();
							sendXML += '</dec:Declaration>';
		sendXML = replaceAll('undefined', '', sendXML);
		var IE = $.browser.msie;
		if(!IE) {
			if (isResult([console]))
				console.log(sendXML);
		}
		$("#sendData").val(sendXML);
		$("#sendData").click();
		//response = callTransport(Transporturl, sendXML);
		//редирект перенес в wsclient
		//window.location.href = 'https://gosuslugi.e-mordovia.ru/web/guest/statuses';
	}
	
	function replaceAll(find, replace, str) {
		  return str.replace(new RegExp(find, 'g'), replace);
	}
	
	function getListStepsXML(){
        var listStepsXML = '<dec:ListSteps>';
        for (var j = 0; j < Steps.length-1; j++){
			listStepsXML += '<dec:Step><dec:Number>'+Steps[j]+'</dec:Number><dec:Code>'+stepInfo[Steps[j]-1].code+'</dec:Code><dec:Name>'+stepInfo[Steps[j]-1].name+'</dec:Name></dec:Step>';
		}
		listStepsXML += '</dec:ListSteps>';
		return listStepsXML;
    }
	
	function getDate(){
		var d = new Date();
		var resDate = d.toISOString();//d.getUTCFullYear()+'-'+d.getUTCMonth()+'-'+d.getUTCDate();
		//resDate += 'T' + d.getHours()+':'+d.getMinutes()+':'+d.getSeconds()+'.'+d.getMilliseconds()+ '+4:00Z';//d.getMilliseconds()+d.getTimezoneOffset();
		return resDate;
	}
	
	var stepInfo = [
	                		{"number":1, "code":"InformationService", "name":"Предварительные сведения"},
	                		{"number":2, "code":"InformationApplicantPhysicalPerson", "name":"Сведения о законном представителе – физическом лице"},
	                		{"number":3, "code":"InformationApplicantIndividualEntrepreneur", "name":"Сведения о законном представителе – юридическом лице"},
	                		{"number":4, "code":"InformationApplicantLegalEntity", "name":"Сведения о правообладающем физическом лице"},
	                		{"number":5, "code":"InformationAgentPhysicalPerson", "name":"Сведения о правообладающем лице – индивидуальном предпринимателе"},
	                		{"number":6, "code":"InformationAgentLegalEntity", "name":"Сведения о правообладающем юридическом лице"},
	                		{"number":7, "code":"PersonBasisOfWhich", "name":"Сведения о лице, на основании данных которого оказывается услуга"},
	                		{"number":8, "code":"DetailsOfPaidFL", "name":"Сведения о выплатных реквизитах ФЛ"},
	                		{"number":9, "code":"DetailsOfPaidIP", "name":"Сведения о выплатных реквизитах ИП"},
	                		{"number":10, "code":"DetailsOfPaidUL", "name":"Сведения о выплатных реквизитах ЮЛ"},
	                		{"number":11, "code":"AddressesProviding", "name":"Сведения об адресе предоставления государственной услуги"},
	                		{"number":12, "code":"InformationMSP", "name":"Сведения о членах семьи для предоставления меры социальной поддержки"},
	                		{"number":13, "code":"InformationSDD", "name":"Сведения о членах семьи для расчета СДД, зарегистрированных по адресу регистрации заявителя"},
	                		{"number":14, "code":"InformationSDDNotRegistered", "name":"Сведения о членах семьи для расчета СДД,  не зарегистрированных по адресу регистрации заявителя"},
	                		{"number":15, "code":"InformationIncomeOfFamilyMembers", "name":"Сведения о доходах всех членов семьи"},
	                		{"number":16, "code":"InformationRequested", "name":"Запрашиваемые сведения"},
	                		{"number":17, "code":"MoreInformation", "name":"Дополнительные сведения"},
	                		{"number":18, "code":"NeededDocuments", "name":"Сведения о документах, необходимых для оказания услуги"},
	                		{"number":19, "code":"", "name":""},
	               ];
	
	function getTransitInfoXML() {
		transintInfo = "<tinf:TransitInfo>";
			transintInfo += "<tinf:Service>";
				transintInfo += "<tinf:Code>"+getService().code+"</tinf:Code>";
				transintInfo += "<tinf:Name>"+getService().name+"</tinf:Name>";
			transintInfo += "</tinf:Service>";
			transintInfo += "<tinf:SubService>";
				transintInfo += "<tinf:Code>"+getIdSubservice().code+"</tinf:Code>";
				transintInfo += "<tinf:Name>"+getIdSubservice().name+"</tinf:Name>";
			transintInfo += "</tinf:SubService>";
			transintInfo += "<tinf:Institution>";
				transintInfo += "<tinf:Code>"+getIdOrg().code+"</tinf:Code>";	//"+getIdOrg().code+"
				transintInfo += "<tinf:Name>"+getIdOrg().name+"</tinf:Name>";			
			transintInfo += "</tinf:Institution>";
		transintInfo += "</tinf:TransitInfo>";
		return transintInfo; 
	}
	
	function getServiceInfo() {
		var info = new Object();
		jQuery.ajax({
		      url: '/alfresco/wcservice/spu/workflow/user?flowType=FAVOUR_REQUEST',
		      type: "GET",
		      async: false,
		      timeout: 80000,   
		      dataType: "application/json",

		  xhrFields: {
		    withCredentials: false 
		  },
		      processData: true, 
			complete: function myCallback(xmlHttpRequest, status, dataResponse){
			try{
	    			info = JSON.parse(xmlHttpRequest.responseText);
			}catch(e){
				info.displayName = '104-796-005_52';
			}
	    	}
	 });
		if (!isNotUndefined(info.displayName)&&test)
			info.displayName = '104-796-005_52';
		serviceInfoXML = "<dec:ServiceInfo>";
			serviceInfoXML += "<dec:personalAccountRPGU>"+info.displayName+"</dec:personalAccountRPGU>";
			serviceInfoXML += "<dec:IdReqvestVIS>#idVIS#</dec:IdReqvestVIS>";
			serviceInfoXML += "<dec:idEpgu>#idRequestPGU#</dec:idEpgu>";
		serviceInfoXML += "</dec:ServiceInfo>";
		return serviceInfoXML; 
	}
    
    function getXML_step_1(){
    	var ServiceCode = getSelectedObject('step_1_service').code;
    	var ServiceName = getSelectedObject('step_1_service').name;
    	var SubServiceCode = getIdSubservice().code;
    	var SubServiceName = getIdSubservice().name;
    	var CategoryCode = getIdCategory().code;
    	var CategoryName = getIdCategory().name;
    	var InstitutionCode = getIdOrg().code;
    	var InstitutionName = getIdOrg().name;
    	var IsItself = getCheckedRadioValue('step_1_acting_person') == "self";
    	var isThirdCategoryCode = getSelectedObject('step_1_category_legal_representative').code;
    	var isThirdCategoryName = getSelectedObject('step_1_category_legal_representative').name;
    	var step_1_xml = "<dec:InformationService><dec:Service><dec:Code>" + ServiceCode + "</dec:Code><dec:Name>" + ServiceName + "</dec:Name></dec:Service>";
    	step_1_xml += "<dec:SubService><dec:Code>"+SubServiceCode+"</dec:Code><dec:Name>" +SubServiceName+ "</dec:Name></dec:SubService>";
    	step_1_xml += "<dec:Category><dec:Code>" + CategoryCode + "</dec:Code><dec:Name>" + CategoryName + "</dec:Name></dec:Category>";
    	step_1_xml += "<dec:Institution><dec:Code>"+ InstitutionCode +"</dec:Code><dec:Name>" + InstitutionName + "</dec:Name></dec:Institution><dec:IsItself>" + IsItself + "</dec:IsItself>";//1691
    	if (!IsItself)//" + InstitutionCode + "
    		step_1_xml += "<dec:IsThirdParty><dec:Category><dec:Code>" + isThirdCategoryCode + "</dec:Code><dec:Name>" + isThirdCategoryName + "</dec:Name></dec:Category></dec:IsThirdParty>";
    	step_1_xml += "</dec:InformationService>";
    	return step_1_xml; 
    }
    
    function getXML_step_2(){
    	var Surname = getValue('step_2_last_name_legal_representative');
    	var Name = getValue('step_2_first_name_legal_representative');
    	var Patronymic = getValue('step_2_middle_name_legal_representative');
    	var Birthday = getValue('step_2_birthday_legal_representative');
    	var IdentityCardType = getSelectedObject('step_2_doc_legal_representative_type').name;//getValue('step_2_doc_legal_representative_type');
    	var IdentityCardSeries = getValue('step_2_doc_legal_representative_series');
    	var IdentityCardNumber = getValue('step_2_doc_legal_representative_number');
    	var IdentityCardDateIssue = getValue('step_2_doc_legal_representative_date');
    	var IdentityCardOrganization = getValue('step_2_doc_legal_representative_org');
    	var isThirdCategoryCode = getSelectedObject('step_1_category_legal_representative').code;
    	var isThirdCategoryName = getSelectedObject('step_1_category_legal_representative').name;
    	var dec_PostCode = getValue('step_2_address_legal_representative_postals');
    	var dec_Region = getValue('step_2_address_legal_representative_region');
    	var dec_Area = getValue('step_2_address_legal_representative_f_district');
    	var dec_City = getValue('step_2_address_legal_representative_city');
    	var dec_Community = getValue('step_2_address_legal_representative_settlement');
    	var dec_Street = getValue('step_2_address_legal_representative_street');
    	var dec_CodeKladr = '';
    	var dec_House = getValue('step_2_address_legal_representative_house');
    	var dec_Housing = getValue('step_2_address_legal_representative_body');
    	var dec_Construction = getValue('step_2_address_legal_representative_build');
    	var dec_Apartment = getValue('step_2_address_legal_representative_flat');
    	var dec_Room = getValue('step_2_address_legal_representative_room');
    	var dec_Type = "ЮР Адрес организации";
    	var GroupName = '';
    	var GroupCode = '';
    	var dec_Name = getSelectedObject('step_2_name_doc').name;
    	var dec_Code = getSelectedObject('step_2_name_doc').code;
    	var checkInd = getCheckedCloneIndex('step_2_choice_trustee_rek');
    	var dec_Series='', dec_Number='', dec_DateIssue='', dec_Organization='';
    	var dec_PrivateStorage = $('#step_2_yourself_trustee_doc').val();//$('#step_2_yourself_trustee_doc').attr('checked');
    	var dec_ElectronicForm = (checkInd >= 0);//$('#step_2_in_SMEV_trustee_doc').attr('checked');
    	var AppealPersonal = $('#step_2_yourself_trustee_doc').val();//$('#step_2_yourself_trustee_doc').attr('checked');
    	var ReqDept = $('#step_2_in_SMEV_trustee_doc').attr('checked');
    	
    	step_2_xml = "<dec:InformationAgentPhysicalPerson><dec:Surname>" + Surname + "</dec:Surname><dec:Name>" + Name + "</dec:Name><dec:Patronymic>"+Patronymic+ "</dec:Patronymic>";
    	step_2_xml += "<dec:Birthday>" + Birthday + "</dec:Birthday>";
        //<!-- Категория доверенного лица -->
    	step_2_xml += "<dec:Category><dec:Code>" + isThirdCategoryCode + "</dec:Code><dec:Name>" + isThirdCategoryName + "</dec:Name></dec:Category>";	//"<dec:Category>" + Category + "</dec:Category>";
        //<!-- Информация о документе удостоверяющем личность -->
    	step_2_xml += "<dec:IdentityCard><dec:Type>" + IdentityCardType + "</dec:Type><dec:Series>" + IdentityCardSeries + "</dec:Series><dec:Number>" + IdentityCardNumber + "</dec:Number>";
    	step_2_xml += "<dec:DateIssue>" + IdentityCardDateIssue + "</dec:DateIssue><dec:Organization>" + IdentityCardOrganization + "</dec:Organization></dec:IdentityCard>";
		//<!--Адрес регистрации законного представителя-->
    	step_2_xml += "<dec:Address><dec:PostCode>"+dec_PostCode+"</dec:PostCode><dec:Region>"+dec_Region+"</dec:Region><dec:Area>"+dec_Area+"</dec:Area>";
    	step_2_xml += "<dec:City>"+dec_City+"</dec:City><dec:Community>"+dec_Community+"</dec:Community><dec:Street>"+dec_Street+"</dec:Street>";
		//	<!-- Код кладр улицы (остальные коды кладр он содержит) -->
    	step_2_xml += "<dec:CodeKladr>"+dec_CodeKladr+"</dec:CodeKladr><dec:House>"+dec_House+"</dec:House><dec:Housing>"+dec_Housing+"</dec:Housing>";
    	step_2_xml += "<dec:Construction>"+dec_Construction+"</dec:Construction><dec:Apartment>"+dec_Apartment+"</dec:Apartment><dec:Room>"+dec_Room+"</dec:Room>";
		//	<!-- Тип адреса (значение ЮР Адрес организации)-->
    	step_2_xml += "<dec:Type>"+dec_Type+"</dec:Type>";
    	step_2_xml += "</dec:Address>";
        //<!-- Данные документа, удостоверяющего полномочия доверенного лица -->
    	step_2_xml += "<dec:Document>";
    	step_2_xml += "<dec:Group><dec:Name>" + GroupName + "</dec:Name><dec:Code>" + GroupCode + "</dec:Code></dec:Group>";
    	step_2_xml += "<dec:Name>" + dec_Name + "</dec:Name><dec:Code>" + dec_Code + "</dec:Code>";
    	if (checkInd >= 0){
    		dec_Series = getValue('step_2_series_doc_' + checkInd);
    		dec_Number = getValue('step_2_number_doc_' + checkInd);
    		dec_DateIssue = getValue('step_2_date_doc_' + checkInd);
    		dec_Organization = getValue('step_2_org_doc_' + checkInd);
    		step_2_xml += "<dec:Series>" + dec_Series + "</dec:Series>";
    		step_2_xml += "<dec:Number>" + dec_Number +"</dec:Number><dec:DateIssue>" + dec_DateIssue + "</dec:DateIssue><dec:Organization>" + dec_Organization + "</dec:Organization>";
    	}
    	
        //    <!-- Признак документа личного хранения -->
    	step_2_xml += "<dec:PrivateStorage>" + dec_PrivateStorage + "</dec:PrivateStorage>";
        //    <!-- Возможность получения в ЭФ -->
    	step_2_xml += "<dec:ElectronicForm>"+dec_ElectronicForm+"</dec:ElectronicForm>";
        /*//    <!-- Атрибуты документа -->
    	step_2_xml += "<dec:Params>";
    	step_2_xml += "<dec:Param><dec:Name>" + ParamName + "</dec:Name><dec:Code>" + ParamCode + "</dec:Code><dec:Type>"+ParamType+"</dec:Type><dec:Value>" + ParamValue + "</dec:Value></dec:Param>";
    	step_2_xml += "</dec:Params>";
        //    <!-- Атрибуты для формирования запроса -->
    	step_2_xml +=  "<dec:ReqParams><dec:ReqParam><dec:Name>ReqParamName</dec:Name><dec:Code>ReqParamCode</dec:Code><dec:Type>ReqParamType</dec:Type><dec:Value>ReqParamValue</dec:Value></dec:ReqParam></dec:ReqParams>";*/
    	step_2_xml +=  "</dec:Document>";
    	step_2_xml += "<dec:AppealPersonal>" +AppealPersonal+ "</dec:AppealPersonal>";	//<!-- Принести лично-->
    	step_2_xml += "<dec:ReqDept>"+ReqDept+"</dec:ReqDept>";
    	step_2_xml += "</dec:InformationAgentPhysicalPerson>";
    	return step_2_xml; 
    }
    
    function getXML_step_3(){
    	var OrgNameFull = getValue('step_3_full_name_org');
    	var OrgName = getValue('step_3_reduced_name_org');
    	var INN = getValue('step_3_juridical_inn');
    	var KPP = getValue('step_3_juridical_kpp');
    	var OGRN = getValue('step_3_juridical_ogrn');
    	var Code = '';	//?????
    	var Surname = getValue('step_3_lastname_org');
    	var Name = getValue('step_3_name_org');
    	var Patronymic = getValue('step_3_middlename_org');
    	var Birthday = getValue('step_3_birth_date_org');
    	var Position = getValue('step_3_pozition_manager');
    	var Type = getSelectedObject('step_3_step_3_document_type_org').name;
    	var Series = getValue('step_3_document_series_org');
    	var Number = getValue('step_3_document_number_org');
    	var DateIssue = getValue('step_3_document_issue_date_org');
    	var Organization = getValue('step_3_document_org');
    	var checkInd = getCheckedCloneIndex('step_3_choice_trustee_rek');
    	var dec_PrivateStorage = (checkInd >= 0);//$('#step_3_yourself_trustee_doc').attr('checked');
    	var AppealPersonal = $('#step_3_yourself_trustee_doc').attr('checked');
    	var ReqDept = $('#step_3_in_SMEV_trustee_doc').attr('checked');    	
    	
    	var doc_Name = getSelectedObject('step_3_name_doc').name;
    	var doc_Code = getSelectedObject('step_3_name_doc').code;
    	var doc_Series='', doc_Number='', doc_DateIssue='', doc_Organization='';   	
    	
    	step_3_xml = "<dec:InformationAgentLegalEntity><dec:Name>" + OrgNameFull + "</dec:Name><dec:Abbreviation>" + OrgName + "</dec:Abbreviation>";
		/*<!-- ??? URAddress, FactAddress-->
        <dec:Address>
            <!-- Почтовый индекс -->
            <dec:PostCode>PostCode</dec:PostCode>
            <!-- регион -->
            <dec:Region>Region</dec:Region>
            <!-- Район -->
            <dec:Area>Area</dec:Area>
            <!-- Город -->
            <dec:City>City</dec:City>
            <!-- Насселенный пункт -->
            <dec:Community>Community</dec:Community>
            <!-- Улица -->
            <dec:Street>Street</dec:Street>
            <!-- Код кладр улицы (остальные коды кладр он содержит) -->
            <dec:CodeKladr>CodeKladr</dec:CodeKladr>
            <!-- Дом -->
            <dec:House>House</dec:House>
            <!-- Корпус -->
            <dec:Housing>Housing</dec:Housing>
            <!-- Строение -->
            <dec:Construction></dec:Construction>
            <!-- Квартира -->
            <dec:Apartment>Apartment</dec:Apartment>
            <!-- Комната -->
            <dec:Room>Room</dec:Room>
            <!-- Тип адреса (значение ЮР Адрес организации)-->
            <dec:Type>Type</dec:Type>
        </dec:Address>*/
    	step_3_xml += "<dec:INN>" + INN + "</dec:INN><dec:KPP>" + KPP + "</dec:KPP><dec:OGRN>" + OGRN + "</dec:OGRN>";
    	step_3_xml += "<dec:AuthorizedPerson><dec:Code>" + Code + "</dec:Code><dec:Surname>" + Surname + "</dec:Surname><dec:Name>" + Name + "</dec:Name><dec:Patronymic>" + Patronymic + "</dec:Patronymic>";
    	step_3_xml += "<dec:Birthday>" + Birthday + "</dec:Birthday><dec:Position>" + Position + "</dec:Position><dec:IdentityCard><dec:Type>" + Type + "</dec:Type>";
    	step_3_xml += "<dec:Series>" + Series + "</dec:Series><dec:Number>" + Number + "</dec:Number><dec:DateIssue>" + DateIssue + "</dec:DateIssue><dec:Organization>"+Organization+"</dec:Organization>";
    	step_3_xml += "</dec:IdentityCard>";
    	//<!-- Данные документа, удостоверяющего полномочия доверенного лица -->
    	step_3_xml += "<dec:Document>";
    	step_3_xml += "<dec:Group><dec:Name>GroupName</dec:Name><dec:Code>GroupCode</dec:Code></dec:Group>";
    	step_3_xml += "<dec:Name>" + doc_Name + "</dec:Name><dec:Code>" + doc_Code + "</dec:Code>";
    	if (checkInd >= 0){
    		doc_Series = getValue('step_3_series_doc_'+checkInd);
    		doc_Number = getValue('step_3_number_doc_'+checkInd);
    		doc_DateIssue = getValue('step_3_date_doc_'+checkInd);
    		doc_Organization = getValue('step_3_org_doc_'+checkInd);
    		step_3_xml += "<dec:Series>" + doc_Series + "</dec:Series><dec:Number>" + doc_Number + "</dec:Number>";
    		step_3_xml += "<dec:DateIssue>" + doc_DateIssue + "</dec:DateIssue><dec:Organization>" + doc_Organization + "</dec:Organization>";	
    	}
    	//<!-- Признак документа личного хранения -->
    	step_3_xml += "<dec:PrivateStorage>" +dec_PrivateStorage+ "</dec:PrivateStorage>";
    	step_3_xml += "<dec:ElectronicForm></dec:ElectronicForm>";
    	step_3_xml += "";/*        <!-- Атрибуты документа -->
                <dec:Params>
                    <!-- Атрибут -->
                    <dec:Param>
                        <!--Наименование атрибута-->
                        <dec:Name>ParamName</dec:Name>
                        <!-- Код атрибута -->
                        <dec:Code>ParamCode</dec:Code>
                        <!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
                        <dec:Type>ParamType</dec:Type>
                        <!-- Значение в соответствие с типом -->
                        <dec:Value>ParamValue</dec:Value>
                    </dec:Param>
                </dec:Params>
                <!-- Атрибуты для формирования запроса -->
                <dec:ReqParams>
                    <!-- Атрибут -->
                    <dec:ReqParam>
                        <!--Наименование атрибута-->
                        <dec:Name>ReqParamName</dec:Name>
                        <!-- Код атрибута -->
                        <dec:Code>ReqParamCode</dec:Code>
                        <!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
                        <dec:Type>ReqParamType</dec:Type>
                        <!-- Значение в соответствие с типом -->
                        <dec:Value>ReqParamValue</dec:Value>
                    </dec:ReqParam>
                </dec:ReqParams> */
    	step_3_xml += "</dec:Document></dec:AuthorizedPerson>";
		//<!-- Принести лично-->
    	step_3_xml += "<dec:AppealPersonal>"+AppealPersonal + "</dec:AppealPersonal>";
		//<!-- Запрашивается ведомством-->
		step_3_xml += "<dec:ReqDept>"+ReqDept+"</dec:ReqDept>";
		step_3_xml += "</dec:InformationAgentLegalEntity>";
    	return step_3_xml;
    }
 
    function getAddressXMLStep_4() {
    	var data = new Object();
    	if ($("#step_1_acting_person_self").attr('checked')) {
    			data = {"PostCode":$("#step_4_address_declarant_postal").val(),
    					"Region": $("#step_4_address_declarant_region").val(),
    					"Area": $("#step_4_address_declarant_district").val(),
    					"City": $("#step_4_address_declarant_city").val(),
    					"Community": $("#step_4_address_declarant_settlement").val(),
    					"Street": $("#step_4_address_declarant_street").val(),
    					"Area": $("#step_4_address_declarant_district").val(),
    					"CodeKladr": "",
    					"House": $("#step_4_address_declarant_house").val(),
    					"Housing": $("#step_4_address_declarant_body").val(),
    					"Construction": $("#step_4_address_declarant_build").val(),
    					"Apartment": $("#step_4_address_declarant_flat").val(),
    					"Room": $("#step_4_address_declarant_room").val()
    					};
    	}
    	
    	if ($('#step_4_add').attr('checked')) {
    			data = {"docType":$("#step_4_document_name_new option:selected").text(),
    					"PostCode":$("#step_4_postcode_person_new").val(),
    					"Region":$("#step_4_new_region option:selected").text(),
    					"Area":$("#step_4_new_district option:selected").text(),
    					"City":$("#step_4_new_town option:selected").text(),
    					"Community":$("#step_4_new_locality option:selected").text(),
    					"Street":$("#step_4_new_street option:selected").text(),
    					"CodeKladr":$("#step_4_new_street option:selected").val(),
    					"House":$("#step_4_house_person_new").val(),
    					"Housing":$("#step_4_housing_person_new").val(),
    					"Construction":$("#step_4_building_person_new").val(),
    					"Apartment":$("#step_4_flat_person_new").val(),
    					"Room":$("#step_4_room_person_new").val()
    					};
    	}
    	
    	
    	if ($('.step_4_is_declarant_system_true:checked').length > 0 && $('#step_4_set_registration_address_system:checked').length == 0)  {
    			data = {"PostCode":$("#step_4_address_person_street option:selected").attr("postcode"),
    					"Region":$("#step_4_address_person_region option:selected").text(),
    					"Area":$("#step_4_address_person_district option:selected").text(),
    					"City":$("#step_4_address_person_city option:selected").text(),
    					"Community":$("#step_4_address_person_settlement option:selected").text(),
    					"Street":$("#step_4_address_person_street option:selected").text(),
    					"CodeKladr":$("#step_4_address_person_street option:selected").val(),
    					"House":$("#step_4_house_person").val(),
    					"Housing":$("#step_4_housing_person").val(),
    					"Construction":$("#step_4_building_person").val(),
    					"Apartment":$("#step_4_flat_person").val(),
    					"Room":$("#step_4_room_person").val()
    					};
    	}
    	
    	
    	if ($('#step_4_set_registration_address_system').attr('checked')) {
	    	//var id = $(".step_4_is_doc_person_system_true:checked").attr("id").split("_").pop();
	    	if (isResult([idenDocRegAddrOwner])) {
	//    		if (isResult([idenDocRegAddrOwner.identDocRegAddress[id]])) {
	//    			if (isResult([idenDocRegAddrOwner.identDocRegAddress[id].addressRegistration])){
	//    			
	//    			var adr = idenDocRegAddrOwner.identDocRegAddress[id].addressRegistration;
	    		
	    		if (isResult([idenDocRegAddrOwner.identDocRegAddress])) {
	    			if (isResult([idenDocRegAddrOwner.identDocRegAddress.addressRegistration])){
	    			var adr = idenDocRegAddrOwner.identDocRegAddress.addressRegistration;
	    			data = {"PostCode":"",
	    					"Region": isResult([adr.region]) ? adr.region.reduction+" "+adr.region.name:"",
	    					"Area": isResult([adr.populatedLocality]) ? adr.populatedLocality.name+" "+adr.populatedLocality.reduction:"",
	    					"City":"",
	    					"Community": isResult([adr.downPopulatedLocality]) ? adr.downPopulatedLocality.reduction+" "+adr.downPopulatedLocality.name:"",
	    					"Street": isResult([adr.street]) ? adr.street.reduction+" "+adr.street.name:"",
	    					"CodeKladr": isResult([adr.street]) ? adr.street.kodKLADR:"",
	    					"House":adr.house,
	    					"Housing":adr.body,
	    					"Construction":adr.structure,
	    					"Apartment":adr.apartment,
	    					"Room":adr.room
	    					};
	    			}
	    		}
	    	}
    	}
    	return data;
    }
    	
    function getXML_step_4() {
    	var data = getAddressXMLStep_4();
    	var Birthday = '', docType = '', Series = '', Number = '', DateIssue = '', Organization = '';
    	if ($('#step_1_acting_person_self').attr('checked')) {
    		Birthday = $("#step_4_birthday_declarant").val();
    		docType = $("#step_4_doc_declarant_type option:selected").text();
    		Series = $("#step_4_doc_declarant_series").val();
    		Number = $("#step_4_doc_declarant_number").val();
    		DateIssue = $("#step_4_doc_declarant_date").val();
    		Organization = $("#step_4_doc_declarant_org").val();
    	}

    	if ($("#step_1_acting_person_law").attr('checked')) {
    		$(".step_4_is_doc_person_system_true:checked").closest("table").each(function ()
    		{
    			docType = $(this).find(".step_4_document_type_system option:selected").text();
    			Series = $(this).find(".step_4_document_series_system").val();
    			Number = $(this).find(".step_4_document_number_system").val();
    			DateIssue = $(this).find(".step_4_document_issue_date_system").val();
    			Organization = $(this).find(".step_4_documen_org_system").val();
    		});
    	}
    	
	$(".step_4_is_declarant_system_true:checked").closest("table").each(function ()
	{
    		Birthday = $(this).find(".step_4_birth_date_system").val();
	});
    	
    	if ($('#step_4_add').attr('checked')) {
    		Birthday = $("#step_4_birth_date_new").val();
			docType = $("#step_4_document_name_new option:selected").text();
    	}

    	if ($('#step_4_doc_other').attr('checked')) {
    		docType = $("#step_4_document_name_system option:selected").text();
    	}

    	//<!-- Шаг 4 – Сведения о правообладающем лице ФЛ  -->
        var step_4_xml = "<dec:InformationApplicantPhysicalPerson>" +
            //<!--Идентификатор гражданина-->
            "<dec:Code></dec:Code>" +
            //<!--Фамилия-->
            "<dec:Surname>"+getFIOFromStep4().surname+"</dec:Surname>" +
            //<!--Имя-->
            "<dec:Name>"+getFIOFromStep4().name+"</dec:Name>" +
            //<!--Отчество-->
            "<dec:Patronymic>"+getFIOFromStep4().patronymic+"</dec:Patronymic>" +
            //<!--Дата рождения в формате гггг-мм-дд -->
            "<dec:Birthday>"+Birthday+"</dec:Birthday>" +
            //<!--СНИЛС в формате 00000000000 -->
            "<dec:SNILS>" + $("#snils").val() +"</dec:SNILS>" +
            //<!-- Информация о документе удостоверяющем личность -->
            "<dec:IdentityCard>"+
                //<!-- Тип -->
                "<dec:Type>"+docType+"</dec:Type>";
        		//if (isNotUndefined(Number)){		//12_07_13
        			step_4_xml += 
        				//<!-- Серия -->
        				"<dec:Series>"+Series+"</dec:Series>"+
        				//<!-- Номер -->
        				"<dec:Number>"+Number+"</dec:Number>"+
        				//<!-- Дата выдачи в формате гггг-мм-дд -->
        				"<dec:DateIssue>"+DateIssue+"</dec:DateIssue>" +
        				//<!-- Организация выдавшая документ -->
        				"<dec:Organization>"+Organization+"</dec:Organization>";
        		//}
        		step_4_xml +=
            "</dec:IdentityCard>" +
            "<dec:Address>" +
                //<!-- Почтовый индекс -->
                "<dec:PostCode>"+data.PostCode+"</dec:PostCode>" +
                //<!-- регион -->
                "<dec:Region>"+data.Region+"</dec:Region>" +
                //<!-- Район -->
                "<dec:Area>"+data.Area+"</dec:Area>" +
                //<!-- Город -->
                "<dec:City>"+data.City+"</dec:City>" +
                //<!-- Насселенный пункт -->
                "<dec:Community>"+data.Community+"</dec:Community>" +
                //<!-- Улица -->
                "<dec:Street>"+data.Street+"</dec:Street>" +
                //<!-- Код кладр улицы (остальные коды кладр он содержит) -->
                "<dec:CodeKladr>"+data.CodeKladr+"</dec:CodeKladr>" +
                //<!-- Дом -->
                "<dec:House>"+data.House+"</dec:House>" +
                //<!-- Корпус -->
                "<dec:Housing>"+data.Housing+"</dec:Housing>" +
                //<!-- Строение -->
                "<dec:Construction>"+data.Construction+"</dec:Construction>" +
                //<!-- Квартира -->
                "<dec:Apartment>"+data.Apartment+"</dec:Apartment>" +
                //<!-- Комната -->
                "<dec:Room>"+data.Room+"</dec:Room>" +
                //<!-- Тип адреса значение адрес регистрации -->
                "<dec:Type></dec:Type>" +
            "</dec:Address>" +
        "</dec:InformationApplicantPhysicalPerson>";
    		step_4_xml = step_4_xml.replace(/undefined/g,"");
    		return step_4_xml;
        }
	
    
    function getXML_step_5(){
    	var Code = '';
    	var Surname = getValue('step_5_last_name_declarant');
    	var Name = getValue('step_5_first_name_declarant');
    	var Patronymic = getValue('step_5_middle_name_declarant');
    	var Birthday = getValue('step_5_birthday_declarant');
    	var inn = getValue('step_5_INN');
    	var ogrnip = getValue('step_5_OGRNIP');
    	var snils = getValue('snils');
    	var Series = getValue('step_5_doc_declarant_series');
    	var Number = getValue('step_5_doc_declarant_number');
    	var DateIssue = getValue('step_5_doc_declarant_date');
    	var Organization = getValue('step_5_document_org');
    	var PostCode = getValue('step_5_address_declarant_postal');
    	var Region = getValue('step_5_address_declarant_region');
    	var Area = getValue('step_5_address_declarant_district');
    	var City = getValue('step_5_address_declarant_city');
    	var Community = getValue('step_5_address_declarant_settlement');
    	var Street = getValue('step_5_address_declarant_street');
    	var CodeKladr = '';
    	var House = getValue('step_5_address_declarant_house');
    	var Housing = getValue('step_5_address_declarant_body');
    	var Construction = getValue('step_5_address_declarant_build');
    	var Apartment = getValue('step_5_address_declarant_flat');
    	var Room = getValue('step_5_address_declarant_room');
    	var Type = getSelectedObject('step_5_doc_declarant_type').name;
    	
    	step_5_xml = "<dec:InformationApplicantIndividualEntrepreneur>";
    	step_5_xml += "<dec:Code>" + Code + "</dec:Code>";
    	step_5_xml += "<dec:Surname>" + Surname + "</dec:Surname>";
    	step_5_xml += "<dec:Name>" + Name + "</dec:Name>";
    	step_5_xml += "<dec:Patronymic>" + Patronymic + "</dec:Patronymic>";
    	step_5_xml += "<dec:Birthday>" + Birthday + "</dec:Birthday>";
    	step_5_xml += "<dec:SNILS>" + snils + "</dec:SNILS>";
    	step_5_xml += "<dec:INN>" + inn +"</dec:INN>";
    	step_5_xml += "<dec:OGRNIP>" + ogrnip + "</dec:OGRNIP>";
    	step_5_xml += "<dec:IdentityCard>";
    	step_5_xml += "<dec:Type>" + Type + "</dec:Type>";
    	step_5_xml += "<dec:Series>" + Series + "</dec:Series>";
    	step_5_xml += "<dec:Number>" + Number + "</dec:Number>";
    	step_5_xml += "<dec:DateIssue>" + DateIssue + "</dec:DateIssue>";
    	step_5_xml += "<dec:Organization>" + Organization + "</dec:Organization></dec:IdentityCard><dec:Address>";
    	step_5_xml += "<dec:PostCode>" + PostCode + "</dec:PostCode>";
    	step_5_xml += "<dec:Region>" + Region + "</dec:Region>";
    	step_5_xml += "<dec:Area>" + Area + "</dec:Area>";
    	step_5_xml += "<dec:City>" + City + "</dec:City>";
    	step_5_xml += "<dec:Community>" + Community + "</dec:Community>";
    	step_5_xml += "<dec:Street>" + Street + "</dec:Street>";
    	step_5_xml += "<dec:CodeKladr>" + CodeKladr +"</dec:CodeKladr>";
    	step_5_xml += "<dec:House>" + House + "</dec:House>";
    	step_5_xml += "<dec:Housing>" + Housing + "</dec:Housing>";
    	step_5_xml += "<dec:Construction>" + Construction + "</dec:Construction>";
    	step_5_xml += "<dec:Apartment>" + Apartment + "</dec:Apartment>";
    	step_5_xml += "<dec:Room>" + Room + "</dec:Room>";
    	step_5_xml += "<dec:Type>Type</dec:Type></dec:Address></dec:InformationApplicantIndividualEntrepreneur>";
    	return step_5_xml; 
    }
    
    function getXML_step_6(){
    	var InstitutionCode = getIdOrg().code;
    	var InstitutionName = getIdOrg().name;
    	var fullorgName = getValue('step_6_full_name_org');
    	var Abbreviation = getValue('step_6_reduced_name_org');
    	var inn = getValue('step_6_juridical_inn');
    	var kpp = getValue('step_6_juridical_kpp');
    	var ogrn = getValue('step_6_juridical_ogrn');
    	var Surname = getValue('step_6_lastname_org');
    	var Name = getValue('step_6_lastname_org');
    	var Patronymic = getValue('step_6_middlename_org');
    	var Birthday = getValue('step_6_birth_date_org');
    	var Position = getValue('step_6_pozition_manager');
    	var cardType = getSelectedObject('step_6_step_6_document_type_org').name;
    	var Series = getValue('step_6_document_series_org');
    	var Number = getValue('step_6_document_number_org');
    	var DateIssue = getValue('step_6_document_issue_date_org');
    	var Organization = getValue('step_6_document_org');
    	var Address_ur = getValue('step_6_legal_address_org');
    	var Address = getValue('step_6_identity_org_reg');
    	var CodeKladr = '';
    	step_6_xml = "<dec:InformationApplicantLegalEntity><dec:Institution>";
    	step_6_xml += "<dec:Name>" + InstitutionName + "</dec:Name>";
    	step_6_xml += "<dec:Code>" + InstitutionCode + "</dec:Code></dec:Institution>";
    	step_6_xml += "<dec:Name>" + fullorgName + "</dec:Name>";
        step_6_xml += "<dec:Abbreviation>" + Abbreviation + "</dec:Abbreviation>";
        step_6_xml += "<dec:Address>";
	        step_6_xml += "<dec:PostCode></dec:PostCode>";
	        step_6_xml += "<dec:Region>"+Address_ur+"</dec:Region>";
	    	step_6_xml += "<dec:Area></dec:Area>";
	    	step_6_xml += "<dec:City></dec:City>";
	    	step_6_xml += "<dec:Community></dec:Community>";
	    	step_6_xml += "<dec:Street></dec:Street>";
	    	step_6_xml += "<dec:CodeKladr>" + CodeKladr + "</dec:CodeKladr>";
	    	step_6_xml += "<dec:House></dec:House>";
	    	step_6_xml += "<dec:Housing></dec:Housing>";
	    	step_6_xml += "<dec:Construction/>";
	    	step_6_xml += "<dec:Apartment></dec:Apartment>";
	    	step_6_xml += "<dec:Room></dec:Room>";
	    	step_6_xml += "<dec:Type>ЮР Адрес организации</dec:Type>";
	    step_6_xml += "</dec:Address>";
	        step_6_xml += "<dec:Address>";
	        step_6_xml += "<dec:PostCode></dec:PostCode>";
	        step_6_xml += "<dec:Region>"+Address+"</dec:Region>";
	    	step_6_xml += "<dec:Area></dec:Area>";
	    	step_6_xml += "<dec:City></dec:City>";
	    	step_6_xml += "<dec:Community></dec:Community>";
	    	step_6_xml += "<dec:Street></dec:Street>";
	    	step_6_xml += "<dec:CodeKladr>" + CodeKladr + "</dec:CodeKladr>";
	    	step_6_xml += "<dec:House></dec:House>";
	    	step_6_xml += "<dec:Housing></dec:Housing>";
	    	step_6_xml += "<dec:Construction/>";
	    	step_6_xml += "<dec:Apartment></dec:Apartment>";
	    	step_6_xml += "<dec:Room></dec:Room>";
	    	step_6_xml += "<dec:Type>Фактический Адрес организации</dec:Type>";
		step_6_xml += "</dec:Address>";
    	step_6_xml += "<dec:INN>" + inn +"</dec:INN>";
    	step_6_xml += "<dec:KPP>" + kpp + "</dec:KPP>";
    	step_6_xml += "<dec:OGRN>" + ogrn + "</dec:OGRN>";
    	step_6_xml += "<dec:AuthorizedPerson>";
    	step_6_xml += "<dec:Surname>" + Surname + "</dec:Surname>";
    	step_6_xml += "<dec:Name>" + Name + "</dec:Name>";
    	step_6_xml += "<dec:Patronymic>" + Patronymic + "</dec:Patronymic>";
    	step_6_xml += "<dec:Birthday>" + Birthday + "</dec:Birthday>";
    	step_6_xml += "<dec:Position>" + Position + "</dec:Position>";
    	step_6_xml += "<dec:IdentityCard>";
    	step_6_xml += "<dec:Type>" + cardType + "</dec:Type>";
    	step_6_xml += "<dec:Series>" + Series + "</dec:Series>";
    	step_6_xml += "<dec:Number>" + Number + "</dec:Number>";
    	step_6_xml += "<dec:DateIssue>" + DateIssue + "</dec:DateIssue>";
    	step_6_xml += "<dec:Organization>" + Organization + "</dec:Organization></dec:IdentityCard></dec:AuthorizedPerson></dec:InformationApplicantLegalEntity>";
    	return step_6_xml; 
    }
    
    function getXML_step_7(){
	var templateEmptyAddressReg = 
        "<dec:PostCode></dec:PostCode>" +
        "<dec:Region></dec:Region>" +
        "<dec:Area></dec:Area>" +
        "<dec:City></dec:City>" +
        "<dec:Community></dec:Community>" +
        "<dec:Street></dec:Street>" +
        "<dec:CodeKladr></dec:CodeKladr>" +
        "<dec:House></dec:House>" +
        "<dec:Housing></dec:Housing>" +
        "<dec:Construction></dec:Construction>" +
        "<dec:Apartment></dec:Apartment>" +
        "<dec:Room></dec:Room>" +
        "<dec:Type></dec:Type>";
			
	    var selPerson = getCheckedCloneIndex('step_7_is_set_people_true');
	    var familyMember = new Object();
	    familyMember.fio = new Object();
	    familyMember.degree = new Object();
	    familyMember.birthday = "";
	    if (selPerson >= 0){
	    	familyMember.fio = getFIO(['step_7_last_name_people_'+selPerson, 'step_7_middle_name_people_'+selPerson, 'step_7_first_name_people_'+selPerson]);
    	    familyMember.birthday = getValue('step_7_birthday_people_'+selPerson);
    	    familyMember.degree = getSelectedObject('step_7_relation_degree_'+selPerson);
    	    familyMember.is_dependency = ''; // $('#step_7_is_dependency_'+selPerson).attr('checked');
    	}
    	else if ($('#step_7_add_family').attr("checked")) {
    		familyMember.fio = getFIO(['step_7_last_name_people_two', 'step_7_middle_name_people_two', 'step_7_first_name_people_two']);
    	    familyMember.birthday = getValue('step_7_birthday_people_two');
    	    familyMember.degree = getSelectedObject('step_7_relation_degree_two');
    	    familyMember.is_dependency = ''; // $('#step_7_is_dependency_two').attr('checked');
    	}
    	
    	var Code =  '';
    	step_7_xml = "<dec:PersonBasisOfWhich><dec:Code>"+Code+"</dec:Code>";
    	step_7_xml +=  "<dec:Surname>"+familyMember.fio.surname+"</dec:Surname>";
    	step_7_xml +=	"<dec:Name>"+familyMember.fio.name+"</dec:Name>";
    	step_7_xml +=	"<dec:Patronymic>"+familyMember.fio.patronymic+"</dec:Patronymic>";
    	step_7_xml +=	"<dec:Birthday>"+familyMember.birthday+"</dec:Birthday>";
    	step_7_xml +=	"<dec:RelationDegree><dec:Name>"+familyMember.degree.name+"</dec:Name>";
    	step_7_xml +=	"<dec:Code>"+familyMember.degree.code+"</dec:Code>";
    	//step_7_xml +=	"<dec:Dependents>false</dec:Dependents>";	//"+familyMember.is_dependency+"
    	step_7_xml +=	"</dec:RelationDegree>";
    	step_7_xml +=	getDocumentsFromStep7();
    	if (isNotUndefined(window.docConfDegreeRelatRegAddress) && !$("#step_7_add_family").attr("checked")){
		    if($('#step_7_set_registration_address_people').attr('checked')){
			  if(isNotUndefined(docConfDegreeRelatRegAddress.addressRegistration)){
			    step_7_xml += 	getAddressXML(docConfDegreeRelatRegAddress.addressRegistration);
			  }else{
         	  	     step_7_xml += getAddressXMLFromString($('#step_7_registration_address_people_2').val());
			     //step_7_xml +="<dec:Address>"+ templateEmptyAddressReg +"</dec:Address>"; 
			  }
			}else{
	     		  step_7_xml += getAddressXMLFromString($('#step_7_registration_address_people_2').val());
			  //step_7_xml +="<dec:Address>"+ templateEmptyAddressReg +"</dec:Address>"; 
			}
		} else {
     		  step_7_xml += getAddressXMLFromString($('#step_7_registration_address_people_2').val());
		  //step_7_xml +="<dec:Address>"+ templateEmptyAddressReg +"</dec:Address>"; 
		}	
    	step_7_xml +=	"</dec:PersonBasisOfWhich>";
    		/*
   <!-- Шаг 7 - пропущено{ - непонятно куда это впихать
    <dec:PersonBasisOfWhich>
		<!-- Принести лично-->
		<dec:AppealPersonal></dec:AppealPersonal>
		<!-- Запрашивается ведомством-->
		<dec:ReqDept></dec:ReqDept>
    </dec:PersonBasisOfWhich>
    		 */
    	return step_7_xml;
    }
    
    function getGroupXml(name, code){
    	var groupXml = "";
    	if (name == null){
    		groupXml = "<dec:Group><dec:Name>GroupName</dec:Name><dec:Code>GroupCode</dec:Code></dec:Group>";
    	}
    	else {
    		groupXml = "<dec:Group><dec:Name>"+name+"</dec:Name><dec:Code>"+code+"</dec:Code></dec:Group>";
    	}
    	return groupXml;
    }

    function getAddressXMLFromString(addressStr){
    	var addressXML = '';	
	if (isNotUndefined(addressStr)){
			var addressS = addressStr.split(",");
			if (addressS.length == 9){
				for (var i = 0; i < addressS.length; i++){
					if (addressS[i].indexOf(" ") == 0)
						addressS[i] = addressS[i].substr(1);
				}
			    	addressXML = "<dec:Address>";
					addressXML +=	"<dec:PostCode>"+addressS[0]+"</dec:PostCode>";	//Индекс
			    		addressXML +=	"<dec:Region>"+addressS[1]+"</dec:Region>";	//область (край/республика)
			    		addressXML +=	"<dec:Area>"+addressS[2]+"</dec:Area>";		//район
			    		addressXML +=	"<dec:City>"+addressS[3]+"</dec:City>";		//населенный пункт
			    		addressXML +=	"<dec:Community></dec:Community>";
			    		addressXML +=	"<dec:Street>"+addressS[4]+"</dec:Street>";	//улица
		    			addressXML +=	"<dec:CodeKladr></dec:CodeKladr>";
			    		addressXML +=	"<dec:House>"+addressS[5]+"</dec:House>";	//дом (строение)
			    		addressXML +=	"<dec:Housing>"+addressS[6]+"</dec:Housing>";	//корпус
			    		addressXML +=	"<dec:Construction></dec:Construction>";
			    		addressXML +=	"<dec:Apartment>"+addressS[7]+"</dec:Apartment>";	//квартира (офис)
			    		addressXML +=	"<dec:Room>"+addressS[8]+"</dec:Room>";	//комната
					addressXML +=	"<dec:Type>Type20</dec:Type>";
			    	addressXML +=	"</dec:Address>";
			}else{
			    	addressXML = "<dec:Address>";
					addressXML +=	"<dec:PostCode></dec:PostCode>";	//Индекс
			    		addressXML +=	"<dec:Region>"+addressStr+"</dec:Region>";	//область (край/республика)
			    		addressXML +=	"<dec:Area></dec:Area>";		//район
			    		addressXML +=	"<dec:City></dec:City>";		//населенный пункт
			    		addressXML +=	"<dec:Community></dec:Community>";
			    		addressXML +=	"<dec:Street></dec:Street>";	//улица
		    			addressXML +=	"<dec:CodeKladr></dec:CodeKladr>";
			    		addressXML +=	"<dec:House></dec:House>";	//дом (строение)
			    		addressXML +=	"<dec:Housing></dec:Housing>";	//корпус
			    		addressXML +=	"<dec:Construction></dec:Construction>";
			    		addressXML +=	"<dec:Apartment></dec:Apartment>";	//квартира (офис)
			    		addressXML +=	"<dec:Room></dec:Room>";	//комната
					addressXML +=	"<dec:Type>Type20</dec:Type>";
			    	addressXML +=	"</dec:Address>";
			}
	}
    	return addressXML;
    }
    
    function getAddressXML(address){
    	var addressXML = '';
    	if (isNotUndefined(address)){
	    	/*addressXML = "<dec:Address>";
	    	if (isNotUndefined(address.postCode)&&(address.postCode != null))
	        	addressXML +=	"<dec:PostCode>"+address.postCode+"</dec:PostCode>";
	    	if (isResult([address.region]))
	    		addressXML +=	"<dec:Region>"+getValueIfNotNull(address.region.reduction)+getValIfNotNull(address.region.name)+"</dec:Region>";
	    	if (isNotUndefined(address.district)&&(address.district != null))
	    		addressXML +=	"<dec:Area>"+getValIfNotNull(address.district)+"</dec:Area>";
	    	if (isResult([address.populatedLocality]))
	    		addressXML +=	"<dec:City>"+getValueIfNotNull(address.populatedLocality.reduction) +getValIfNotNull(address.populatedLocality.name)+"</dec:City>";
	    	if (isResult([address.downPopulatedLocality]))
	    		addressXML +=	"<dec:Community>"+getValueIfNotNull(address.downPopulatedLocality.reduction)+getValIfNotNull(address.downPopulatedLocality.name)+"</dec:Community>";
	    	if (isResult([address.street])){
	    		addressXML +=	"<dec:Street>"+getValueIfNotNull(address.street.reduction)+getValIfNotNull(address.street.name)+"</dec:Street>";
	    		if (isNotUndefined(address.street.kodKLADR)&&(address.street.kodKLADR != null))
	    			addressXML +=	"<dec:CodeKladr>"+address.street.kodKLADR+"</dec:CodeKladr>";
	    	}
	    	if (isNotUndefined(address.house)&&(address.house != null))
	    		addressXML +=	"<dec:House>"+address.house+"</dec:House>";
	    	if (isNotUndefined(address.body)&&(address.body!=null))
	    		addressXML +=	"<dec:Housing>"+address.body+"</dec:Housing>";
	    	if (isNotUndefined(address.structure)&&(address.structure!=null))
	    		addressXML +=	"<dec:Construction>"+address.structure+"</dec:Construction>";
	    	if (isNotUndefined(address.apartment)&&(address.apartment!=null))
	    		addressXML +=	"<dec:Apartment>"+address.apartment+"</dec:Apartment>";
	    	if (isNotUndefined(address.room)&&(address.room!=null))
	    		addressXML +=	"<dec:Room>"+address.room+"</dec:Room>";
	    	if (isNotUndefined(address.type)&&(address.type!=null))
	        	addressXML +=	"<dec:Type>"+address.type+"</dec:Type>";
	    	addressXML +=	"</dec:Address>";*/
	    	
	    	if (!isResult([address.region]))
	    		address.region = new Object();
	    	if (!isResult([address.populatedLocality]))
	    		address.populatedLocality = new Object();
	    	if (!isResult([address.downPopulatedLocality]))
	    		address.downPopulatedLocality = new Object();
	    	if (!isResult([address.street]))
	    		address.street = new Object();
	
		    	addressXML = "<dec:Address>";
		        	addressXML +=	"<dec:PostCode>"+getValIfNotNull(address.postCode)+"</dec:PostCode>";
		    		addressXML +=	"<dec:Region>"+getValueIfNotNull(address.region.reduction)+getValIfNotNull(address.region.name)+"</dec:Region>";
		    		addressXML +=	"<dec:Area>"+getValIfNotNull(address.district)+"</dec:Area>";
		    		addressXML +=	"<dec:City>"+getValueIfNotNull(address.populatedLocality.reduction) +getValIfNotNull(address.populatedLocality.name)+"</dec:City>";
		    		addressXML +=	"<dec:Community>"+getValueIfNotNull(address.downPopulatedLocality.reduction)+getValIfNotNull(address.downPopulatedLocality.name)+"</dec:Community>";
		    		addressXML +=	"<dec:Street>"+getValueIfNotNull(address.street.reduction)+getValIfNotNull(address.street.name)+"</dec:Street>";
		    			addressXML +=	"<dec:CodeKladr>"+getValIfNotNull(address.street.kodKLADR)+"</dec:CodeKladr>";
		    		addressXML +=	"<dec:House>"+getValIfNotNull(address.house)+"</dec:House>";
		    		addressXML +=	"<dec:Housing>"+getValIfNotNull(address.body)+"</dec:Housing>";
		    		addressXML +=	"<dec:Construction>"+getValIfNotNull(address.structure)+"</dec:Construction>";
		    		addressXML +=	"<dec:Apartment>"+getValIfNotNull(address.apartment)+"</dec:Apartment>";
		    		addressXML +=	"<dec:Room>"+getValIfNotNull(address.room)+"</dec:Room>";
		        	addressXML +=	"<dec:Type>"+getValIfNotNull(address.type)+"</dec:Type>";
		    	addressXML +=	"</dec:Address>";
    	
    	} 
    	return addressXML;
    }
    
    function getDocumentParams(docElem){
    	var docParams = ""; 
    	var attrs = $(docElem).closest('fieldset').find('.attrs');
   		docParams += getParamsOrReqParams(attrs);
    	var attrsMV = $(docElem).closest('fieldset').find('.attrsMV');
    	docParams += getParamsOrReqParams(attrsMV);
    	return docParams;
    }
    
    function getParamsOrReqParams(attrs){
    	var params = "";
    	if (attrs.length > 0 && attrs.hasClass('used')){
        	var paramName = (attrs.hasClass('attrs')) ? 'Param' : 'ReqParam'; 
    		params = "<dec:"+paramName+"s>";
    			attrs.find('.attr').each(function(){
    					var param = "<dec:"+paramName+">";
    						param += "<dec:Name>" + $(this).closest('tr').find('span.label').text() + "</dec:Name>";
    						param += "<dec:Code>" + $(this).attr("name") + "</dec:Code>";
    						param += "<dec:Type>" + getElementType(this) +"</dec:Type>";	//$(this).attr("type")
    						param += "<dec:Value>" + $(this).val() + "</dec:Value>";
    					param += "</dec:"+paramName+">";
    					params += param; 
    			});
    		params += "</dec:"+paramName+"s>";	
    	}
		return params;
    }
    
    
    function getXMLFromDocFields(fieldArray){
    	var series = getValue(fieldArray[0]);
    	var number = getValue(fieldArray[1]);
    	var dateIssue = getValue(fieldArray[2]);
    	var organization = getValue(fieldArray[3]);
    	//var privateStorage = $("#"+fieldArray[4]).attr('checked');
    	//var electronicFrom = !privateStorage;
    	var xMLFromDocFields = "<dec:Series>"+series+"</dec:Series>";
    	xMLFromDocFields += "<dec:Number>"+number+"</dec:Number>";
    	xMLFromDocFields += "<dec:DateIssue>"+dateIssue+"</dec:DateIssue>";
    	xMLFromDocFields += "<dec:Organization>" + organization + "</dec:Organization>";
    	//xMLFromDocFields += "<dec:PrivateStorage>"+privateStorage+"</dec:PrivateStorage>";
    	//xMLFromDocFields += "<dec:ElectronicForm>"+electronicFrom+"</dec:ElectronicForm>";
    	return	xMLFromDocFields; 
    }
    
    var step_7_documents_xml = "";
    function getDocumentsFromStep7(){
    	step_7_documents_xml = "";
    	$('[name=step_7_doc_name_document]').each(function(i){
    		if (i>0){
	    		var step_7_doc_xml = "<dec:Document>";
	    		step_7_doc_xml += getGroupXml(null, null);
	    		//<!-- Наименование документа -->
	    		step_7_doc_xml += "<dec:Name>" + getSelectedObject($(this).attr('id')).name +"</dec:Name>";
	    		step_7_doc_xml += "<dec:Code>" + getSelectedObject($(this).attr('id')).code +"</dec:Code>";
	    		var ind = getIndex(this);
	    		var j = getCheckedCloneIndex('step_7_choice_trustee_rek_document'+ind);
	    		if (j >= 0){
	    			index = ind + "_" + j;
	    			step_7_doc_xml += getXMLFromDocFields(['step_7_series_doc_document'+index,'step_7_number_doc_document'+index,'step_7_date_doc_document'+index,'step_7_org_doc_document'+index,'step_7_yourself_trustee_doc_document'+ind]);
	    		}
	    		//else{
	    		step_7_doc_xml += "<dec:PrivateStorage>"+$('#step_7_yourself_trustee_doc_document'+ind).val()+"</dec:PrivateStorage>"; 
	    		step_7_doc_xml += "<dec:ElectronicForm>"+$('#step_7_in_SMEV_trustee_doc_document'+ind).val()+"</dec:ElectronicForm>";	// (j >= 0)
				//}
	    		step_7_doc_xml += getDocumentParams(this);
	    		step_7_doc_xml += "</dec:Document>";
	    		step_7_documents_xml += step_7_doc_xml;
    		}
    	});
    	$('[name=step_7_doc_name_group]').each(function(k){
    		if (k > 0){
		    		var ind = getIndex(this);
		    		if ($('#step_7_doc_true_group'+ind).attr("checked")){
			    		var step_7_doc_xml = "<dec:Document>";
			    		var group = getSelectedObject($(this).attr('group'));
			    		step_7_doc_xml += getGroupXml(group.name, group.code);
			    		var doc = getSelectedObject($(this).attr('id'));
			    		step_7_doc_xml += "<dec:Name>" + doc.name +"</dec:Name>";
			    		step_7_doc_xml += "<dec:Code>" + doc.code +"</dec:Code>";
			    		var j = getCheckedCloneIndex('step_7_choice_trustee_rek_group'+ind);
			    		if (j >= 0) {
			    			index = ind + "_" + j;
			    			step_7_doc_xml += getXMLFromDocFields(['step_7_series_doc_group'+index,'step_7_number_doc_group'+index,'step_7_date_doc_group'+index,'step_7_org_doc_group'+index,'step_7_yourself_trustee_doc_group'+ind]);
			    		}
			    		//else{
			    		step_7_doc_xml += "<dec:PrivateStorage>"+$('#step_7_yourself_trustee_doc_group'+ind).val()+"</dec:PrivateStorage>"; 
			    		step_7_doc_xml += "<dec:ElectronicForm>"+(j >= 0)+"</dec:ElectronicForm>";  //$('#step_7_in_SMEV_trustee_doc_group'+ind).attr('checked')
		    			//}
			    		step_7_doc_xml += getDocumentParams(this);
			    		step_7_doc_xml += "</dec:Document>";
			    		step_7_documents_xml += step_7_doc_xml;
		    		}
    		}
    	});
		return step_7_documents_xml;
    }
    
    function getDocumentsFromStep(arrayParams){
    	documents_xml = "";
    	var single_document_name = arrayParams[0];
    	var choice_document_detail = arrayParams[1];
    	var series_doc = arrayParams[2];
    	var number_doc = arrayParams[3];
    	var date_doc = arrayParams[4];
    	var org_doc = arrayParams[5];
    	var yourself = arrayParams[6];
    	var doc_name_group = arrayParams[7]; var doc_true_group = arrayParams[8];
    	var choice_trustee_rek_group = arrayParams[9];
    	var series_doc_group = arrayParams[10];  var number_doc_group = arrayParams[11];
    	var date_doc_group = arrayParams[12]; var org_doc_group = arrayParams[13];
    	var yourself_trustee_doc_group = arrayParams[14];
    	/*var sigleDoc_SMEV = '';			//еще будет нужно! НЕ УДАЛЯТЬ!
    	if (isNotUndefined(arrayParams[15])){
    		sigleDoc_SMEV = arrayParams[15]; 
    	}
    	else 
    		sigleDoc_SMEV = !yourself;
    	var doc_SMEV = '';
    	if (isNotUndefined(arrayParams[16])){
    		doc_SMEV = arrayParams[16]; 
    	}
    	else 
    		doc_SMEV = !yourself_trustee_doc_group;*/    	
    	$('[name='+single_document_name+']').each(function(i){
    		if (i>0){
	    		var step_doc_xml = "<dec:Document>";
	    		step_doc_xml += getGroupXml(null, null);
	    		//<!-- Наименование документа -->
	    		step_doc_xml += "<dec:Name>" + getSelectedObject($(this).attr('id')).name +"</dec:Name>";
	    		step_doc_xml += "<dec:Code>" + getSelectedObject($(this).attr('id')).code +"</dec:Code>";
	    		var ind = getIndex(this);
	    		var j = getCheckedCloneIndex(choice_document_detail+ind);
	    		if (j >= 0){
	    			index = ind + "_" + j;
	    			step_doc_xml += getXMLFromDocFields([series_doc+index, number_doc+index, date_doc+index, org_doc+index, yourself+ind]);
	    		}
	    		step_doc_xml += "<dec:PrivateStorage>"+$('#'+yourself+ind).val()+"</dec:PrivateStorage>";
	    		//else{
    			step_doc_xml += "<dec:ElectronicForm>"+(j >= 0)+"</dec:ElectronicForm>";  //$('#'+sigleDoc_SMEV+ind).attr('checked')
    			step_doc_xml += getDocumentParams(this);
	    		//}
	    		step_doc_xml += "</dec:Document>";
	    		documents_xml += step_doc_xml;
    		}
    	});
    	$('[name='+doc_name_group+']').each(function(k){
    		if (k > 0){
		    		var ind = getIndex(this);
		    		if ($('#'+doc_true_group+ind).attr("checked")){
			    		var doc_xml = "<dec:Document>";
			    		var group = getSelectedObject($(this).attr('group'));
			    		doc_xml += getGroupXml(group.name, group.code);
			    		var doc = getSelectedObject($(this).attr('id'));
			    		doc_xml += "<dec:Name>" + doc.name +"</dec:Name>";
			    		doc_xml += "<dec:Code>" + doc.code +"</dec:Code>";
			    		var j = getCheckedCloneIndex(choice_trustee_rek_group+ind);
			    		if (j >= 0) {
			    			index = ind + "_" + j;
			    			doc_xml += getXMLFromDocFields([series_doc_group+index, number_doc_group+index, date_doc_group+index, org_doc_group+index, yourself_trustee_doc_group+ind]);
			    		}
					//else{
						doc_xml += "<dec:PrivateStorage>"+$('#'+yourself_trustee_doc_group+ind).val()+"</dec:PrivateStorage>"; 
						doc_xml += "<dec:ElectronicForm>"+(j >= 0)+"</dec:ElectronicForm>";	 //$('#'+doc_SMEV+ind).attr('checked')
					//}
						doc_xml += getDocumentParams(this);
		    			doc_xml += "</dec:Document>";
			    		documents_xml += doc_xml;
		    		}
    		}
    	});
		return documents_xml;
    }
    
	  function getXML_step_8() {

	      var Surname='', Name='', Patronymic='', Birthday='',
	          Number='', PostCode='', Region='', Area='',
	          City='', Community='', Street='', CodeKladr='',
	          House='', Housing='', Construction='',
	          Apartment='', Room='', Type='',
	          InformationBankName='', InformationBankCode='', SubBankName='', SubBankCode='', AccountNumber='';

	      var data = getAddressXMLStep_4();

	      $(".step_8_is_recept_true:checked").closest("table").each(function () {
	          Surname = $(this).find(".step_8_last_name_recept").val();
	          Name = $(this).find(".step_8_first_name_recept").val();
	          Patronymic = $(this).find(".step_8_middle_name_recept").val();
	          Birthday = $(this).find(".step_8_birthday_recept").val();
	      });

	      var MethodOfPaymentCode = $("#step_8_payment_type option:selected").val();
	      var MethodOfPaymentName = $("#step_8_payment_type option:selected").text();

	      $(".step_8_is_post_true:checked").closest("table").each(function () {
	          var id = $(this).find(".step_8_is_post_true:checked").attr("id").split("_").pop();

	          if (isResult([details])) {
	              if (isResult([details.posts])) {
	                  if (isResult([details.posts.post[id]])) {
	                      if (isResult([details.posts.post[id].address])) {
	                          var adr = details.posts.post[id].address;
	                          PostCode = details.posts.post[id].postNumber;
	                          if (isResult([adr.region])) Region = adr.region.reduction + " " + adr.region.name;
	                          if (isResult([adr.populatedLocality])) Area = adr.populatedLocality.name + " " + adr.populatedLocality.reduction;
	                          City = "";
	                          if (isResult([adr.downPopulatedLocality])) Community = adr.downPopulatedLocality.reduction + " " + adr.downPopulatedLocality.name;
	                          if (isResult([adr.street])) Street = adr.street.reduction + " " + adr.street.name;
	                          if (isResult([adr.street])) CodeKladr = adr.street.kodKLADR;
	                          House = adr.house;
	                          Housing = adr.body;
	                          Construction = adr.structure;
	                          Apartment = adr.apartment;
	                          Room = adr.room;
	                          Type = "";
	                      }
	                  }
	              }
	          }
	      });

	      $(".step_8_is_bank_true:checked").closest("table").each(function () {
	          var id = $(this).find(".step_8_is_bank_true:checked").attr("id").split("_").pop();
	          if (isResult([details])) {
	              if (isResult([details.banks])) {
	                  if (isResult([details.banks.bank[id]])) {
	                      adr = details.banks.bank[id];
	                      InformationBankName = adr.name;
	                      InformationBankCode = adr.bankIdentificationCode;
	                      SubBankName = adr.subdivision;
	                      SubBankCode = adr.bankIdentificationCodeCH;
	                      AccountNumber = adr.personalAccount;
	                  }
	              }
	          }
	      });


	      if (($("#step_8_payment_type option:selected").val() === "post") && ($("#step_8_is_postal_bank_fill").attr("checked")) && ($("#step_8_type_address_v option:selected").text() != "Адрес регистрации")) {
	          PostCode = $("#step_8_postal_address_v").val();
	          Region = $("#step_8_post_region option:selected").text();
	          Area = $("#step_8_post_district option:selected").text();
	          City = $("#step_8_post_city option:selected").text();
	          Community = $("#step_8_post_settlement option:selected").text();
	          Street = $("#step_8_address_v option:selected").text();
	          CodeKladr = $("#step_8_address_v option:selected").val();
	          House = $("#step_8_house_v").val();
	          Housing = $("#step_8_housing_v").val();
	          Construction = $("#step_8_building_v").val();
	          Apartment = $("#step_8_flat_v").val();
	          Room = $("#step_8_room_v").val();
	          Type = "";
	      }

	      if (($("#step_8_payment_type option:selected").val() == "post") && ($("#step_1_acting_person_self").attr("checked")) && ($("#step_8_is_postal_bank_fill").attr("checked")) && ($("#step_8_type_address_v option:selected").text() == "Адрес регистрации")) {
	          PostCode = $("#step_4_address_declarant_postal").val();
	          Region = $("#step_4_address_declarant_region").val();
	          Area = $("#step_4_address_declarant_district").val();
	          City = $("#step_4_address_declarant_city").val();
	          Community = $("#step_4_address_declarant_settlement").val();
	          Street = $("#step_4_address_declarant_street").val();
	          CodeKladr = "";
	          House = $("#step_4_address_declarant_house").val();
	          Housing = $("#step_4_address_declarant_body").val();
	          Construction = $("#step_4_address_declarant_build").val();
	          Apartment = $("#step_4_address_declarant_flat").val();
	          Room = $("#step_4_address_declarant_room").val();
	          Type = "";
	      }

	      if (($("#step_8_payment_type option:selected").val() == "post") && ($("#step_1_acting_person_law").attr("checked")) && ($("#step_8_is_postal_bank_fill").attr("checked")) && ($("#step_8_type_address_v option:selected").text() == "Адрес регистрации") && ($("#step_8_is_recept_true_0").attr("checked"))) {
	          PostCode = $("#step_2_address_legal_representative_postal").val();
	          Region = $("#step_2_address_legal_representative_region").val();
	          Area = $("#step_2_address_legal_representative_f_district").val();
	          City = $("#step_2_address_legal_representative_city").val();
	          Community = $("#step_2_address_legal_representative_settlement").val();
	          Street = $("#step_2_address_legal_representative_street").val();
	          CodeKladr = "";
	          House = $("#step_2_address_legal_representative_house").val();
	          Housing = $("#step_2_address_legal_representative_body").val();
	          Construction = $("#step_2_address_legal_representative_build").val();
	          Apartment = $("#step_2_address_legal_representative_flat").val();
	          Room = $("#step_2_address_legal_representative_room").val();
	          Type = "";
	      }

	      if (($("#step_8_payment_type option:selected").val() == "post") && ($("#step_1_acting_person_law").attr("checked")) && ($("#step_8_is_postal_bank_fill").attr("checked")) && ($("#step_8_type_address_v option:selected").text() == "Адрес регистрации") && ($("#step_8_is_recept_true_1").attr("checked"))) {
	          PostCode = data.PostCode;
	          Region = data.Region;
	          Area = data.Area;
	          City = data.City;
	          Community = data.Community;
	          Street = data.Street;
	          CodeKladr = data.CodeKladr;
	          House = data.House;
	          Housing = data.Housing;
	          Construction = data.Construction;
	          Apartment = data.Apartment;
	          Room = data.Room;
	          Type = data.Type;
	      }

	      if (($("#step_8_payment_type option:selected").val() === "bank") && ($("#step_8_is_postal_bank_fill").attr("checked"))) {
	          InformationBankName = $("#step_8_bank_name option:selected").text();
	          InformationBankCode = $("#step_8_bank_name option:selected").attr("text");
	          SubBankName = $("#step_8_bank_subdivision option:selected").text();
	          SubBankCode = $("#step_8_bank_subdivision option:selected").val();
	          AccountNumber = $("#step_8_bank_account").val();
	      }

	      //<!-- Шаг 8 – Сведения о выплатных реквизитах -->
	      var step_8_xml = "<dec:DetailsOfPaidFL>" +
	      "<dec:Code>Code</dec:Code>" +
	      "<dec:Surname>" + Surname + "</dec:Surname>" +
	      "<dec:Name>" + Name + "</dec:Name>" +
	      "<dec:Patronymic>" + Patronymic + "</dec:Patronymic>" +
	      "<dec:Birthday>" + Birthday + "</dec:Birthday>" +
	      "<dec:MethodOfPayment>" +
	      "<dec:Code>" + MethodOfPaymentCode + "</dec:Code>" +
	      "<dec:Name>" + MethodOfPaymentName + "</dec:Name>" +
	          "</dec:MethodOfPayment>";

	      if (MethodOfPaymentCode === "post") {
	          step_8_xml +=
	          "<dec:PostOffice>" +
	          "<dec:Number>" + Number + "</dec:Number>" +
	          "<dec:PostCode>" + PostCode + "</dec:PostCode>" +
	          "<dec:Region>" + Region + "</dec:Region>" +
	          "<dec:Area>" + Area + "</dec:Area>" +
	          "<dec:City>" + City + "</dec:City>" +
	          "<dec:Community>" + Community + "</dec:Community>" +
	          "<dec:Street>" + Street + "</dec:Street>" +
	          "<dec:CodeKladr>" + CodeKladr + "</dec:CodeKladr>" +
	          "<dec:House>" + House + "</dec:House>" +
	          "<dec:Housing>" + Housing + "</dec:Housing>" +
	          "<dec:Construction>" + Construction + "</dec:Construction>" +
	          "<dec:Apartment>" + Apartment + "</dec:Apartment>" +
	          "<dec:Room>" + Room + "</dec:Room>" +
	          "<dec:Type>"+Type+"</dec:Type>" +
	              "</dec:PostOffice>";
	      }

	      if (MethodOfPaymentCode === "bank") {
	          step_8_xml +=
	          "<dec:InformationBank>" +
	              "<dec:Bank>" +
	          "<dec:Name>" + InformationBankName + "</dec:Name>" +
	          "<dec:Code>" + InformationBankCode + "</dec:Code>" +
	              "</dec:Bank>" +
	              "<dec:SubBank>" +
	          "<dec:Name>" + SubBankName + "</dec:Name>" +
	          "<dec:Code>" + SubBankCode + "</dec:Code>" +
	              "</dec:SubBank>" +
	          "<dec:AccountNumber>" + AccountNumber + "</dec:AccountNumber>" +
	              "</dec:InformationBank>";
	      }
	      step_8_xml += "</dec:DetailsOfPaidFL>";

	      step_8_xml = step_8_xml.replace(/undefined/g, "");
	      return step_8_xml;
	  }
	  
	  
	function getXML_step_9() {
	    var BankName='', BankCode='', SubBankName='', SubBankCode='', AccountNumber='';
	    $(".step_9_is_bank_true:checked").closest("table").each(function () {
			
			var id = $(".step_9_is_bank_true:checked").attr("id").split("_").pop();
			BankName = $(this).find(".step_9_bank_name_system").val();
			BankCode = details.banks.bank[id].bankIdentificationCode;
			SubBankName = $(this).find(".step_9_bank_subdivision_system").val();
			SubBankCode = details.banks.bank[id].bankIdentificationCodeCH;	//30_07_13 by KAVlex
			AccountNumber = $(this).find(".step_9_bank_account_system").val();
	    });

		if	($("#step_9_is_postal_bank_fill").attr("checked")) {
			BankName = $("#step_9_bank_name option:selected").text();
			BankCode = $("#step_9_bank_name option:selected").val();
			SubBankName = $("#step_9_bank_subdivision option:selected").text();
			SubBankCode = $("#step_9_bank_subdivision option:selected").val();
			AccountNumber = $("#step_9_bank_account").val();
	    }
		
			
	    //<!-- Шаг 9 – Сведения о выплатных реквизитах ИП -->
	    var step_9_xml = "<dec:DetailsOfPaidIP>" +
	    "<dec:Code>Code</dec:Code>" +
	    "<dec:Surname>" + $("#step_9_last_name_recept").val() + "</dec:Surname>" +
	    "<dec:Name>" + $("#step_9_first_name_recept").val() + "</dec:Name>" +
	    "<dec:Patronymic>" + $("#step_9_middle_name_recept").val() + "</dec:Patronymic>" +
	    "<dec:Birthday>" + $("#step_9_birthday_recept").val() + "</dec:Birthday>" +
	    "<dec:MethodOfPayment>" +
	    "<dec:Code>" + $("#step_9_payment_type option:selected").val() + "</dec:Code>" +
	    "<dec:Name>" + $("#step_9_payment_type option:selected").text() + "</dec:Name>" +
	        "</dec:MethodOfPayment>" +
	    "<dec:InformationBank>" +
	        "<dec:Bank>" +
	    "<dec:Name>" + BankName + "</dec:Name>" +
	    "<dec:Code>" + BankCode + "</dec:Code>" +
	        "</dec:Bank>" +
	        "<dec:SubBank>" +
	    "<dec:Name>" + SubBankName + "</dec:Name>" +
	    "<dec:Code>" + SubBankCode + "</dec:Code>" +
	        "</dec:SubBank>" +
	    //<!-- Персональный счет -->
	    "<dec:AccountNumber>" + AccountNumber + "</dec:AccountNumber>" +
	        "</dec:InformationBank>" +
	        "</dec:DetailsOfPaidIP>";

	    step_9_xml = step_9_xml.replace(/undefined/g,"");
	    return step_9_xml;
		
	}
	
	function getXML_step_10() {
		var BankName='', BankCode='', SubBankName='', SubBankCode='', AccountNumber='';
		    $(".step_10_is_bank_true:checked").closest("table").each(function () {
				//var id = $(".step_10_is_bank_true:checked").attr("id").split("_").pop();
				BankName = $(this).find(".step_10_bank_name_system").val();
				BankCode = $(this).find(".step_10_bik").val();
				SubBankName = $(this).find(".step_10_bank_subdivision_system").val();
				SubBankCode = $(this).find(".step_10_bank_subdivision_system").text();
				AccountNumber = $(this).find(".step_10_bank_account_system").val();
		    });

			if	($("#step_10_is_postal_bank_fill").attr("checked")) {
				BankName = $("#step_10_bank_name option:selected").text();
				BankCode = $("#step_10_bank_name option:selected").val();
				SubBankName = $("#step_10_bank_subdivision option:selected").text();
				SubBankCode = $("#step_10_bank_subdivision option:selected").val();
				AccountNumber = $("#step_10_bank_account").val();
		    }
	    //<!-- Шаг 10 – Сведения о выплатных реквизитах ЮЛ -->
	    var step_10_xml = "<dec:DetailsOfPaidUL>" +
		    "<dec:Institution>" +
	            //<!-- Наименование учереждения -->
	            "<dec:Name>" + $("#step_10_full_name_org_akcept").val() + "</dec:Name>" +
	            //<!-- Идентификатор учереждения -->
	            "<dec:Code>???</dec:Code>" +
	        "</dec:Institution>" +
	        "<dec:MethodOfPayment>" +
	            //<!-- Код метода выплаты -->
	            "<dec:Code>" + $("#step_10_payment_type option:selected").val() + "</dec:Code>" +
	            //<!-- Наименования -->
	            "<dec:Name>" + $("#step_10_payment_type option:selected").text() + "</dec:Name>" +
	        "</dec:MethodOfPayment>" +
	        "<dec:InformationBank>" +
	            "<dec:Bank>" +
	                "<dec:Name>" + BankName + "</dec:Name>" +
	                "<dec:Code>" + BankCode + "</dec:Code>" +
	            "</dec:Bank>" +
	            "<dec:SubBank>" +
	                "<dec:Name>" + SubBankName + "</dec:Name>" +
	                "<dec:Code>" + SubBankCode + "</dec:Code>" +
	            "</dec:SubBank>" +
	            //<!-- Персональный счет -->
	            "<dec:AccountNumber>" + AccountNumber + "</dec:AccountNumber>" +
	        "</dec:InformationBank>" +
	    "</dec:DetailsOfPaidUL>";
		    step_10_xml = step_10_xml.replace(/undefined/g,"");
		    return step_10_xml;
	}
	
	//<!-- Шаг 11  – Сведения об адресе предоставления государственной услуги -->
	function getXML_step_11() {
	    var address = new Object();
	    if ((getCheckedRadioValue('step_1_acting_person') == "self")&&(($('#step_11_render_address_type_system option:selected').text() == 'Адрес регистрации')||($('#step_11_render_address_type_system option:selected').text() == 'Адрес фактического проживания'))){
	        address = step_11_address;
	    }
	    else 
	        if ($('#step_11_add_address').attr('checked')){
                	var fieldArray  = 	[
					 	'step_11_address_pu_region',
					 	'step_11_address_pu_raion',
					 	'step_11_address_pu_city',
					 	'step_11_address_pu_village',
					 	'step_11_address_pu_street',
					 	'step_11_house_pu',
					 	'step_11_corps_pu',
					 	'step_11_building_pu',
					 	'step_11_flat_pu',
					 	'step_11_room_pu',
					 	'step_11_index_pu'
					];
				address = getAddressFromFields2(fieldArray);	
	        }
	        else {
	            var ind = getCheckedCloneIndex('step_11_is_render_address_true_1');
	            if (ind >= 0){
	                if (isResult([addressServiceProvision]))
	                    if (isResult([addressServiceProvision.address])){
    	                    address = addressServiceProvision.address[ind];
	                    }
	            }
	        }
	    address.type = 'ЮР Адрес организации';
	    var step_11_xml_address = getAddressXML(address);    
	    step_11_xml_address = replaceAll('dec:Address', 'dec:AddressProviding', step_11_xml_address);
	    var step_11_xml =  '<dec:AddressesProviding>';
	        step_11_xml += step_11_xml_address;
	    step_11_xml += '</dec:AddressesProviding>';
    	return step_11_xml;
	}
	
	
	
function getXML_step_12() {

    //var RelationDegreeName, RelationDegreeCode;

    var FamilyMember = "";


    $(".step_12_set_family_member_mf:checked").closest(".step_12_info_2_clone").each(function () {

       /* RelationDegreeName = $(this).find(".step_12_relation_degree_mf option:selected").text();
        RelationDegreeCode = $(this).find(".step_12_relation_degree_mf option:selected").val();*/

        //var id = $(this).find(".step_12_set_family_member_mf:checked").attr("id").split("_").pop();

        FamilyMember +=

        "<dec:FamilyMember>" +
        //<!--Идентификатор гражданина-->
        "<dec:Code>???</dec:Code>" +
        //<!--Фамилия-->
        "<dec:Surname>" + $(this).find(".step_12_last_name_declarant_mf").val() + "</dec:Surname>" +
        //<!--Имя-->
        "<dec:Name>" + $(this).find(".step_12_first_name_declarant_mf").val() + "</dec:Name>" +
        //<!--Отчество-->
        "<dec:Patronymic>" + $(this).find(".step_12_middle_name_declarant_mf").val() + "</dec:Patronymic>" +
        //<!--Дата рождения в формате гггг-мм-дд -->
        "<dec:Birthday>" + $(this).find(".step_12_birthday_declarant_mf").val() + "</dec:Birthday>" +
            "<dec:Position></dec:Position>";


	var IdentityCard = "";
        if ($(this).find('select[step_12_identity="true"]').length < 1 && $(this).find('select[step_12_identity_group="true"]').length < 1) {

            IdentityCard += "<dec:IdentityCard>" +
            //<!-- Информация о документе удостоверяющем личность -->
            //<!-- Тип -->
            "<dec:Type></dec:Type>" +
                "<dec:Series></dec:Series>" +
            //<!-- Номер -->
            "<dec:Number></dec:Number>" +
            //<!-- Дата выдачи в формате гггг-мм-дд -->
            "<dec:DateIssue></dec:DateIssue>" +
            //<!-- Организация выдавшая документ -->
            "<dec:Organization></dec:Organization>" +
                "</dec:IdentityCard>";

        }

        $(this).find('select[step_12_identity="true"]').closest(".step_12_info_3_document_clone").each(function () {

            IdentityCard += "<dec:IdentityCard>" +
            //<!-- Информация о документе удостоверяющем личность -->
            //<!-- Тип -->
            "<dec:Type>" + $(this).find("select[name='step_12_name_doc_declarant_mf_document'] option:selected").text() + "</dec:Type>";

            if ($(this).find('input[name="step_12_doc_declarant_set_identity_doc_mf_document"]').is(":checked")) {

                IdentityCard +=
                //<!-- Серия -->
                "<dec:Series>" + $(this).find('input[name="step_12_doc_declarant_series_mf_document"]').val() + "</dec:Series>" +
                //<!-- Номер -->
                "<dec:Number>" + $(this).find('input[name="step_12_doc_declarant_number_mf_document"]').val() + "</dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue>" + $(this).find('input[name="step_12_doc_declarant_date_mf_document"]').val() + "</dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization>" + $(this).find('textarea[name="step_12_doc_declarant_who_issued_mf_document"]').val() + "</dec:Organization>";

            } else {

                IdentityCard +=
                //<!-- Серия -->
                "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>";

            }

            IdentityCard += "</dec:IdentityCard>";

        });


        $(this).find('select[step_12_identity_group="true"]').closest("fieldset").each(function () {

            if ($(this).find('input[name="step_12_check_doc_declarant_mf_group"]').is(":checked")) {

                IdentityCard += "<dec:IdentityCard>" +
                //<!-- Информация о документе удостоверяющем личность -->
                //<!-- Тип -->
                "<dec:Type>" + $(this).find("select[name='step_12_name_doc_declarant_mf_group'] option:selected").text() + "</dec:Type>";

                if ($(this).find('input[name="step_12_doc_declarant_set_identity_doc_mf_group"]').is(":checked")) {

                    IdentityCard +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find('input[name="step_12_doc_declarant_series_mf_group"]:last').val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find('input[name="step_12_doc_declarant_number_mf_group"]:last').val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find('input[name="step_12_doc_declarant_date_mf_group"]:last').val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find('textarea[name="step_12_doc_declarant_who_issued_mf_group"]:last').val() + "</dec:Organization>";

                } else {

                    IdentityCard +=
                    //<!-- Серия -->
                    "<dec:Series></dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number></dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue></dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization></dec:Organization>";

                }

                IdentityCard += "</dec:IdentityCard>";

            }

        });

	if (IdentityCard == ""){
            IdentityCard += "<dec:IdentityCard>" +
			            "<dec:Type></dec:Type>" +
			            "<dec:Series></dec:Series>" +
			            "<dec:Number></dec:Number>" +
				    "<dec:DateIssue></dec:DateIssue>" +
			            "<dec:Organization></dec:Organization>" +
		            "</dec:IdentityCard>";
	}

        FamilyMember +=	IdentityCard;

        FamilyMember +=

        "<dec:Address>" +
        //<!-- Почтовый индекс -->
        "<dec:PostCode></dec:PostCode>" +
        //<!-- регион -->
        "<dec:Region></dec:Region>" +
        //<!-- Район -->
        "<dec:Area></dec:Area>" +
        //<!-- Город -->
        "<dec:City></dec:City>" +
        //<!-- Насселенный пункт -->
        "<dec:Community></dec:Community>" +
        //<!-- Улица -->
        "<dec:Street></dec:Street>" +
        //<!-- Код кладр улицы (остальные коды кладр он содержит) -->
        "<dec:CodeKladr></dec:CodeKladr>" +
        //<!-- Дом -->
        "<dec:House></dec:House>" +
        //<!-- Корпус -->
        "<dec:Housing></dec:Housing>" +
        //<!-- Строение -->
        "<dec:Construction></dec:Construction>" +
        //<!-- Квартира -->
        "<dec:Apartment></dec:Apartment>" +
        //<!-- Комната -->
        "<dec:Room></dec:Room>" +
        //<!-- Тип адреса (значение ЮР Адрес организации)-->
        "<dec:Type></dec:Type>" +
            "</dec:Address>";



        $(this).find(".step_12_info_3_document_clone:not(:first)").each(function () {

            if ($(this).find("select[step_12_identity='true']").length < 1) {

                FamilyMember +=
                //<!-- Данные документа удостоверяющего степень родства -->
                "<dec:Document>" +
                //<!-- Группа -->
                "<dec:Group>" +
                //<!-- Наименование группы -->
                "<dec:Name></dec:Name>" +
                //<!-- Код группы -->
                "<dec:Code></dec:Code>" +
                    "</dec:Group>" +
                //<!-- Наименование документа -->
                "<dec:Name>" + $(this).find("select[name='step_12_name_doc_declarant_mf_document'] option:selected").text() + "</dec:Name>" +
                //<!-- Код документа -->
                "<dec:Code>" + $(this).find("select[name='step_12_name_doc_declarant_mf_document'] option:selected").val() + "</dec:Code>";

                if ($(this).find('input[name="step_12_doc_declarant_set_identity_doc_mf_document"]').is(":checked")) {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find("input[name='step_12_doc_declarant_series_mf_document']:last").val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find("input[name='step_12_doc_declarant_number_mf_document']:last").val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find("input[name='step_12_doc_declarant_date_mf_document']:last").val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find("textarea[name='step_12_doc_declarant_who_issued_mf_document']:last").val() + "</dec:Organization>";

                }

                FamilyMember +=
                //<!-- Признак документа личного хранения true||false  -->
                "<dec:PrivateStorage>" + $(this).find('input[name="step_12_doc_declarant_bring_himself_mf_document"]').val() + "</dec:PrivateStorage>" +
                //<!-- Возможность получения в ЭФ -->
                "<dec:ElectronicForm>" + $(this).find('input[name="step_12_doc_declarant_set_identity_doc_mf_document"]').is(":checked") + "</dec:ElectronicForm>";


                FamilyMember += getDocumentParams($(this).find("select[name='step_12_name_doc_declarant_mf_document']"));
                /* НЕТ ДАННЫХ ДЛЯ ЗАПОЛНЕНИЯ
					//<!-- Атрибуты документа -->
					"<dec:Params>" +
						//<!-- Атрибут -->
						"<dec:Param>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ParamValue +"</dec:Value>" +
						"</dec:Param>" +
					"</dec:Params>" +
					//<!-- Атрибуты для формирования запроса -->
					"<dec:ReqParams>" +
						//<!-- Атрибут -->
						"<dec:ReqParam>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ReqParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ReqParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ReqParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ReqParamValue +"</dec:Value>" +
						"</dec:ReqParam>" +
					"</dec:ReqParams>" +
					*/

                FamilyMember += "</dec:Document>";

            }
        });


        $(this).find('input[name="step_12_check_doc_declarant_mf_group"]:checked').closest("fieldset").each(function () {

            if ($(this).find("select[step_12_identity_group='true']").length < 1) {

                FamilyMember +=
                //<!-- Данные документа удостоверяющего степень родства -->
                "<dec:Document>" +
                //<!-- Группа -->
                "<dec:Group>" +
                //<!-- Наименование группы -->
                "<dec:Name>" + $(this).closest(".step_12_info_3_group_clone").find("select[name='step_12_group_name_doc_declarant_mf'] option:selected").text() + "</dec:Name>" +
                //<!-- Код группы -->
                "<dec:Code>" + $(this).closest(".step_12_info_3_group_clone").find("select[name='step_12_group_name_doc_declarant_mf'] option:selected").val() + "</dec:Code>" +
                    "</dec:Group>" +
                //<!-- Наименование документа -->
                "<dec:Name>" + $(this).find("select[name='step_12_name_doc_declarant_mf_group'] option:selected").text() + "</dec:Name>" +
                //<!-- Код документа -->
                "<dec:Code>" + $(this).find("select[name='step_12_name_doc_declarant_mf_group'] option:selected").val() + "</dec:Code>";


                if ($(this).find('input[name="step_12_doc_declarant_set_identity_doc_mf_group"]').is(":checked")) {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find("input[name='step_12_doc_declarant_series_mf_group']:last").val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find("input[name='step_12_doc_declarant_number_mf_group']:last").val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find("input[name='step_12_doc_declarant_date_mf_group']:last").val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find("textarea[name='step_12_doc_declarant_who_issued_mf_group']:last").val() + "</dec:Organization>";

                }

                FamilyMember +=
                //<!-- Признак документа личного хранения true||false  -->
                "<dec:PrivateStorage>" + $(this).find('input[name="step_12_doc_declarant_bring_himself_mf_group"]').val() + "</dec:PrivateStorage>" +
                //<!-- Возможность получения в ЭФ -->
                "<dec:ElectronicForm>" + $(this).find('input[name="step_12_doc_declarant_set_identity_doc_mf_group"]').is(":checked") + "</dec:ElectronicForm>";


                FamilyMember += getDocumentParams($(this).find("select[name='step_12_name_doc_declarant_mf_group']"));
                /* НЕТ ДАННЫХ ДЛЯ ЗАПОЛНЕНИЯ
					//<!-- Атрибуты документа -->
					"<dec:Params>" +
						//<!-- Атрибут -->
						"<dec:Param>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ParamValue +"</dec:Value>" +
						"</dec:Param>" +
					"</dec:Params>" +
					//<!-- Атрибуты для формирования запроса -->
					"<dec:ReqParams>" +
						//<!-- Атрибут -->
						"<dec:ReqParam>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ReqParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ReqParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ReqParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ReqParamValue +"</dec:Value>" +
						"</dec:ReqParam>" +
					"</dec:ReqParams>" +
					*/


                	FamilyMember += "</dec:Document>";

            }

        });

        FamilyMember += "</dec:FamilyMember>";

    });

    //ДОБАЛВЕНИЕ ВРУЧНУЮ
    if ($("#step_12_add_family_member_mf").is(":checked")) {

        $(".step_12_info_5_clone:not(:first)").each(function () {

        	/* RelationDegreeName = $(this).find(".step_12_relation_degree_family_member_mf option:selected").text();
            RelationDegreeCode = $(this).find(".step_12_relation_degree_family_member_mf option:selected").val();

            if (RelationDegreeCode === "") {
                RelationDegreeName = "";
            }*/

            FamilyMember +=

            "<dec:FamilyMember>" +
            //<!--Идентификатор гражданина-->
            "<dec:Code>???</dec:Code>" +
            //<!--Фамилия-->
            "<dec:Surname>" + $(this).find(".step_12_last_name_family_member_mf").val() + "</dec:Surname>" +
            //<!--Имя-->
            "<dec:Name>" + $(this).find(".step_12_first_name_family_member_mf").val() + "</dec:Name>" +
            //<!--Отчество-->
            "<dec:Patronymic>" + $(this).find(".step_12_middle_name_family_member_mf").val() + "</dec:Patronymic>" +
            //<!--Дата рождения в формате гггг-мм-дд -->
            "<dec:Birthday>" + $(this).find(".step_12_birthday_family_member_mf").val() + "</dec:Birthday>" +
                "<dec:Position></dec:Position>";

	    var IdentityCard = "";
            if ($(this).find('select[step_12_identity="true"]').length < 1 && $(this).find('select[step_12_identity_group="true"]').length < 1) {

                IdentityCard += "<dec:IdentityCard>" +
                //<!-- Информация о документе удостоверяющем личность -->
                //<!-- Тип -->
                "<dec:Type></dec:Type>" +
                    "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>" +
                    "</dec:IdentityCard>";

            }

            $(this).find('select[step_12_identity="true"]').closest(".step_12_info_6_document_clone").each(function () {

                IdentityCard +=
                //<!-- Информация о документе удостоверяющем личность -->
                "<dec:IdentityCard>" +
                //<!-- Тип -->
                "<dec:Type>" + $(this).find("select[name='step_12_name_doc_declarant_mf2_document'] option:selected").text() + "</dec:Type>" +
                //<!-- Серия -->
                "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>" +
                    "</dec:IdentityCard>";

            });


            $(this).find('select[step_12_identity_group="true"]').closest("fieldset").each(function () {
	
                if ($(this).find('input[name="step_12_check_doc_declarant_mf2_group"]').is(":checked")) {

                    IdentityCard +=

                    //<!-- Информация о документе удостоверяющем личность -->
                    "<dec:IdentityCard>" +
                    //<!-- Тип -->
                    "<dec:Type>" + $(this).find("select[name='step_12_name_doc_declarant_mf2_group'] option:selected").text() + "</dec:Type>" +
                    //<!-- Серия -->
                    "<dec:Series></dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number></dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue></dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization></dec:Organization>" +
                        "</dec:IdentityCard>";
                }

            });

	    if (IdentityCard == ""){
		IdentityCard += "<dec:IdentityCard>" +
					"<dec:Type></dec:Type>" +
					"<dec:Series></dec:Series>" +
					"<dec:Number></dec:Number>" +
					"<dec:DateIssue></dec:DateIssue>" +
					"<dec:Organization></dec:Organization>" +
				"</dec:IdentityCard>";
	    }
	    FamilyMember += IdentityCard;


            $(this).find(".step_12_info_6_document_clone:not(:first)").each(function () {

                if ($(this).find("select[step_12_identity='true']").length < 1) {

                    FamilyMember +=
                    //<!-- Данные документа удостоверяющего степень родства -->
                    "<dec:Document>" +
                    //<!-- Группа -->
                    "<dec:Group>" +
                    //<!-- Наименование группы -->
                    "<dec:Name></dec:Name>" +
                    //<!-- Код группы -->
                    "<dec:Code></dec:Code>" +
                        "</dec:Group>" +
                    //<!-- Наименование документа -->
                    "<dec:Name>" + $(this).find("select[name='step_12_name_doc_declarant_mf2_document'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код документа -->
                    "<dec:Code>" + $(this).find("select[name='step_12_name_doc_declarant_mf2_document'] option:selected").val() + "</dec:Code>" +
                    //<!-- Признак документа личного хранения true||false  -->
                    "<dec:PrivateStorage>" + $(this).find('input[name="step_12_doc_declarant_bring_himself_mf2_document"]').val() + "</dec:PrivateStorage>" +
                    //<!-- Возможность получения в ЭФ -->
                    "<dec:ElectronicForm>false</dec:ElectronicForm>" +


                    /* НЕТ ДАННЫХ ДЛЯ ЗАПОЛНЕНИЯ
					//<!-- Атрибуты документа -->
					"<dec:Params>" +
						//<!-- Атрибут -->
						"<dec:Param>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ParamValue +"</dec:Value>" +
						"</dec:Param>" +
					"</dec:Params>" +
					//<!-- Атрибуты для формирования запроса -->
					"<dec:ReqParams>" +
						//<!-- Атрибут -->
						"<dec:ReqParam>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ReqParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ReqParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ReqParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ReqParamValue +"</dec:Value>" +
						"</dec:ReqParam>" +
					"</dec:ReqParams>" +
					*/

                    "</dec:Document>";
                }

            });


            $(this).find('input[name="step_12_check_doc_declarant_mf2_group"]:checked').closest("fieldset").each(function () {

                if ($(this).find("select[step_12_identity_group='true']").length < 1) {

                    FamilyMember +=
                    //<!-- Данные документа удостоверяющего степень родства -->
                    "<dec:Document>" +
                    //<!-- Группа -->
                    "<dec:Group>" +
                    //<!-- Наименование группы -->
                    "<dec:Name>" + $(this).closest(".step_12_info_6_group_clone").find("select[name='step_12_group_name_doc_declarant_mf2'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код группы -->
                    "<dec:Code>" + $(this).closest(".step_12_info_6_group_clone").find("select[name='step_12_group_name_doc_declarant_mf2'] option:selected").val() + "</dec:Code>" +
                        "</dec:Group>" +
                    //<!-- Наименование документа -->
                    "<dec:Name>" + $(this).find("select[name='step_12_name_doc_declarant_mf2_group'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код документа -->
                    "<dec:Code>" + $(this).find("select[name='step_12_name_doc_declarant_mf2_group'] option:selected").val() + "</dec:Code>" +
                    //<!-- Признак документа личного хранения true||false  -->
                    "<dec:PrivateStorage>" + $(this).find('input[name="step_12_doc_declarant_bring_himself_mf2_group"]').val() + "</dec:PrivateStorage>" +
                    //<!-- Возможность получения в ЭФ -->
                    "<dec:ElectronicForm>false</dec:ElectronicForm>" +


                    /* НЕТ ДАННЫХ ДЛЯ ЗАПОЛНЕНИЯ
					//<!-- Атрибуты документа -->
					"<dec:Params>" +
						//<!-- Атрибут -->
						"<dec:Param>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ParamValue +"</dec:Value>" +
						"</dec:Param>" +
					"</dec:Params>" +
					//<!-- Атрибуты для формирования запроса -->
					"<dec:ReqParams>" +
						//<!-- Атрибут -->
						"<dec:ReqParam>" +
							//<!--Наименование атрибута-->
							"<dec:Name>"+ ReqParamName +"</dec:Name>" +
							//<!-- Код атрибута -->
							"<dec:Code>"+ ReqParamCode +"</dec:Code>" +
							//<!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
							"<dec:Type>"+ ReqParamType +"</dec:Type>" +
							//<!-- Значение в соответствие с типом -->
							"<dec:Value>"+ ReqParamValue +"</dec:Value>" +
						"</dec:ReqParam>" +
					"</dec:ReqParams>" +
					*/


                    "</dec:Document>";
                }
            });

            FamilyMember += "</dec:FamilyMember>";

        });


    }

    //<!-- Шаг 12 – Сведения о членах семьи для предоставления меры социальной поддержки -->
    var step_12_xml =
        "<dec:InformationMSP>" +
    //<!-- Член семьи -->
    FamilyMember +
    /*"<dec:AppealPersonal>false</dec:AppealPersonal>" +
    "<dec:ReqDept>false</dec:ReqDept>" +*/
    "</dec:InformationMSP>";

    step_12_xml = step_12_xml.replace(/undefined/g, "");
    return step_12_xml;

}


function getXML_step_13() {

    var RelationDegreeName, RelationDegreeCode;

    var FamilyMember = "";


    $(".step_13_set_family_member_sdd_z:checked").closest(".step_13_info_2_clone").each(function () {

        RelationDegreeName = $(this).find(".step_13_relation_degree_sdd_z option:selected").text();
        RelationDegreeCode = $(this).find(".step_13_relation_degree_sdd_z option:selected").val();

        if (RelationDegreeCode === "") {
            RelationDegreeName = "";
        }


        //var id = $(this).find(".step_13_set_family_member_sdd_z:checked").attr("id").split("_").pop();

        FamilyMember +=

        "<dec:FamilyMember>" +
        //<!--Идентификатор гражданина-->
        "<dec:Code>???</dec:Code>" +
        //<!--Фамилия-->
        "<dec:Surname>" + $(this).find(".step_13_last_name_declarant_sdd_z").val() + "</dec:Surname>" +
        //<!--Имя-->
        "<dec:Name>" + $(this).find(".step_13_first_name_declarant_sdd_z").val() + "</dec:Name>" +
        //<!--Отчество-->
        "<dec:Patronymic>" + $(this).find(".step_13_middle_name_declarant_sdd_z").val() + "</dec:Patronymic>" +
        //<!--Дата рождения в формате гггг-мм-дд -->
        "<dec:Birthday>" + $(this).find(".step_13_birthday_declarant_sdd_z").val() + "</dec:Birthday>" +
        //<!--Степень родства-->
        "<dec:RelationDegree>" +
        //<!-- Наименование -->
        "<dec:Name>" + RelationDegreeName + "</dec:Name>" +
        //<!-- Код -->
        "<dec:Code>" + RelationDegreeCode + "</dec:Code>" +
        //<!-- Наличие иждивения-->
        "<dec:Dependents>false</dec:Dependents>" +
            "</dec:RelationDegree>";


        if ($(this).find('select[step_13_identity="true"]').length < 1 && $(this).find('select[step_13_identity_group="true"]').length < 1) {

            FamilyMember += "<dec:IdentityCard>" +
            //<!-- Информация о документе удостоверяющем личность -->
            //<!-- Тип -->
            "<dec:Type></dec:Type>" +
                "<dec:Series></dec:Series>" +
            //<!-- Номер -->
            "<dec:Number></dec:Number>" +
            //<!-- Дата выдачи в формате гггг-мм-дд -->
            "<dec:DateIssue></dec:DateIssue>" +
            //<!-- Организация выдавшая документ -->
            "<dec:Organization></dec:Organization>" +
                "</dec:IdentityCard>";

        }

        $(this).find('select[step_13_identity="true"]').closest(".step_13_info_3_document_clone").each(function () {

            FamilyMember += "<dec:IdentityCard>" +
            //<!-- Информация о документе удостоверяющем личность -->
            //<!-- Тип -->
            "<dec:Type>" + $(this).find("select[name='step_13_name_doc_declarant_sdd_z_document'] option:selected").text() + "</dec:Type>";

            if ($(this).find('input[name="step_13_doc_declarant_set_identity_doc_sdd_z_document"]').is(":checked")) {

                FamilyMember +=
                //<!-- Серия -->
                "<dec:Series>" + $(this).find('input[name="step_13_doc_declarant_series_sdd_z_document"]').val() + "</dec:Series>" +
                //<!-- Номер -->
                "<dec:Number>" + $(this).find('input[name="step_13_doc_declarant_number_sdd_z_document"]').val() + "</dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue>" + $(this).find('input[name="step_13_doc_declarant_date_sdd_z_document"]').val() + "</dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization>" + $(this).find('textarea[name="step_13_doc_declarant_who_issued_sdd_z_document"]').val() + "</dec:Organization>";

            } else {

                FamilyMember +=
                //<!-- Серия -->
                "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>";

            }



            FamilyMember += "</dec:IdentityCard>";

        });


        $(this).find('select[step_13_identity_group="true"]').closest("fieldset").each(function () {

            if ($(this).find('input[name="step_13_check_doc_declarant_sdd_z_group"]').is(":checked")) {

                FamilyMember += "<dec:IdentityCard>" +
                //<!-- Информация о документе удостоверяющем личность -->
                //<!-- Тип -->
                "<dec:Type>" + $(this).find("select[name='step_13_name_doc_declarant_sdd_z_group'] option:selected").text() + "</dec:Type>";

                if ($(this).find('input[name="step_13_doc_declarant_set_identity_doc_sdd_z_group"]').is(":checked")) {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find('input[name="step_13_doc_declarant_series_sdd_z_group"]:last').val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find('input[name="step_13_doc_declarant_number_sdd_z_group"]:last').val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find('input[name="step_13_doc_declarant_date_sdd_z_group"]:last').val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find('textarea[name="step_13_doc_declarant_who_issued_sdd_z_group"]:last').val() + "</dec:Organization>";

                } else {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series></dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number></dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue></dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization></dec:Organization>";

                }

                FamilyMember += "</dec:IdentityCard>";

            }

        });


        FamilyMember +=

        "<dec:Address>" +
        //<!-- Почтовый индекс -->
        "<dec:PostCode></dec:PostCode>" +
        //<!-- регион -->
        "<dec:Region></dec:Region>" +
        //<!-- Район -->
        "<dec:Area></dec:Area>" +
        //<!-- Город -->
        "<dec:City></dec:City>" +
        //<!-- Насселенный пункт -->
        "<dec:Community></dec:Community>" +
        //<!-- Улица -->
        "<dec:Street></dec:Street>" +
        //<!-- Код кладр улицы (остальные коды кладр он содержит) -->
        "<dec:CodeKladr></dec:CodeKladr>" +
        //<!-- Дом -->
        "<dec:House></dec:House>" +
        //<!-- Корпус -->
        "<dec:Housing></dec:Housing>" +
        //<!-- Строение -->
        "<dec:Construction></dec:Construction>" +
        //<!-- Квартира -->
        "<dec:Apartment></dec:Apartment>" +
        //<!-- Комната -->
        "<dec:Room></dec:Room>" +
        //<!-- Тип адреса (значение ЮР Адрес организации)-->
        "<dec:Type></dec:Type>" +
            "</dec:Address>";



        $(this).find(".step_13_info_3_document_clone:not(:first)").each(function () {

            if ($(this).find("select[step_13_identity='true']").length < 1) {

                FamilyMember +=
                //<!-- Данные документа удостоверяющего степень родства -->
                "<dec:Document>" +
                //<!-- Группа -->
                "<dec:Group>" +
                //<!-- Наименование группы -->
                "<dec:Name></dec:Name>" +
                //<!-- Код группы -->
                "<dec:Code></dec:Code>" +
                    "</dec:Group>" +
                //<!-- Наименование документа -->
                "<dec:Name>" + $(this).find("select[name='step_13_name_doc_declarant_sdd_z_document'] option:selected").text() + "</dec:Name>" +
                //<!-- Код документа -->
                "<dec:Code>" + $(this).find("select[name='step_13_name_doc_declarant_sdd_z_document'] option:selected").val() + "</dec:Code>";

                if ($(this).find('input[name="step_13_doc_declarant_set_identity_doc_sdd_z_document"]').is(":checked")) {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find("input[name='step_13_doc_declarant_series_sdd_z_document']:last").val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find("input[name='step_13_doc_declarant_number_sdd_z_document']:last").val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find("input[name='step_13_doc_declarant_date_sdd_z_document']:last").val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find("textarea[name='step_13_doc_declarant_who_issued_sdd_z_document']:last").val() + "</dec:Organization>";

                }

                FamilyMember +=
                //<!-- Признак документа личного хранения true||false  -->
                "<dec:PrivateStorage>" + $(this).find('input[name="step_13_doc_declarant_bring_himself_sdd_z_document"]').val() + "</dec:PrivateStorage>" +
                //<!-- Возможность получения в ЭФ -->
                "<dec:ElectronicForm>" + $(this).find('input[name="step_13_doc_declarant_set_identity_doc_sdd_z_document"]').is(":checked") + "</dec:ElectronicForm>";

              //<!-- Атрибуты документа -->
                FamilyMember += getDocumentParams($(this).find("select[name='step_13_name_doc_declarant_sdd_z_document']"));

                FamilyMember += "</dec:Document>";

            }
        });


        $(this).find('input[name="step_13_check_doc_declarant_sdd_z_group"]:checked').closest("fieldset").each(function () {

            if ($(this).find("select[step_13_identity_group='true']").length < 1) {

                FamilyMember +=
                //<!-- Данные документа удостоверяющего степень родства -->
                "<dec:Document>" +
                //<!-- Группа -->
                "<dec:Group>" +
                //<!-- Наименование группы -->
                "<dec:Name>" + $(this).closest(".step_13_info_3_group_clone").find("select[name='step_13_group_name_doc_declarant_sdd_z'] option:selected").text() + "</dec:Name>" +
                //<!-- Код группы -->
                "<dec:Code>" + $(this).closest(".step_13_info_3_group_clone").find("select[name='step_13_group_name_doc_declarant_sdd_z'] option:selected").val() + "</dec:Code>" +
                    "</dec:Group>" +
                //<!-- Наименование документа -->
                "<dec:Name>" + $(this).find("select[name='step_13_name_doc_declarant_sdd_z_group'] option:selected").text() + "</dec:Name>" +
                //<!-- Код документа -->
                "<dec:Code>" + $(this).find("select[name='step_13_name_doc_declarant_sdd_z_group'] option:selected").val() + "</dec:Code>";


                if ($(this).find('input[name="step_13_doc_declarant_set_identity_doc_sdd_z_group"]').is(":checked")) {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find("input[name='step_13_doc_declarant_series_sdd_z_group']:last").val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find("input[name='step_13_doc_declarant_number_sdd_z_group']:last").val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find("input[name='step_13_doc_declarant_date_sdd_z_group']:last").val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find("textarea[name='step_13_doc_declarant_who_issued_sdd_z_group']:last").val() + "</dec:Organization>";

                }

                FamilyMember +=
                //<!-- Признак документа личного хранения true||false  -->
                "<dec:PrivateStorage>" + $(this).find('input[name="step_13_doc_declarant_bring_himself_sdd_z_group"]').val() + "</dec:PrivateStorage>" +
                //<!-- Возможность получения в ЭФ -->
                "<dec:ElectronicForm>" + $(this).find('input[name="step_13_doc_declarant_set_identity_doc_sdd_z_group"]').is(":checked") + "</dec:ElectronicForm>";

              //<!-- Атрибуты документа -->
                FamilyMember += getDocumentParams($(this).find("select[name='step_13_name_doc_declarant_sdd_z_group']"));

                FamilyMember += "</dec:Document>";

            }

        });

        FamilyMember += "</dec:FamilyMember>";

    });

    //ДОБАЛВЕНИЕ ВРУЧНУЮ
    if ($("#step_13_add_family_member_sdd_z").is(":checked")) {

        $(".step_13_info_6_clone:not(:first)").each(function () {

            RelationDegreeName = $(this).find(".step_13_relation_degree_family_member_sdd_z option:selected").text();
            RelationDegreeCode = $(this).find(".step_13_relation_degree_family_member_sdd_z option:selected").val();

            if (RelationDegreeCode === "") {
                RelationDegreeName = "";
            }

            FamilyMember +=

            "<dec:FamilyMember>" +
            //<!--Идентификатор гражданина-->
            "<dec:Code>???</dec:Code>" +
            //<!--Фамилия-->
            "<dec:Surname>" + $(this).find(".step_13_last_name_family_member_sdd_z").val() + "</dec:Surname>" +
            //<!--Имя-->
            "<dec:Name>" + $(this).find(".step_13_first_name_family_member_sdd_z").val() + "</dec:Name>" +
            //<!--Отчество-->
            "<dec:Patronymic>" + $(this).find(".step_13_middle_name_family_member_sdd_z").val() + "</dec:Patronymic>" +
            //<!--Дата рождения в формате гггг-мм-дд -->
            "<dec:Birthday>" + $(this).find(".step_13_birthday_family_member_sdd_z").val() + "</dec:Birthday>" +
            //<!--Степень родства-->
            "<dec:RelationDegree>" +
            //<!-- Наименование -->
            "<dec:Name>" + RelationDegreeName + "</dec:Name>" +
            //<!-- Код -->
            "<dec:Code>" + RelationDegreeCode + "</dec:Code>" +
            //<!-- Наличие иждивения-->
            "<dec:Dependents>false</dec:Dependents>" +
                "</dec:RelationDegree>";


            if ($(this).find('select[step_13_identity="true"]').length < 1 && $(this).find('select[step_13_identity_group="true"]').length < 1) {

                FamilyMember += "<dec:IdentityCard>" +
                //<!-- Информация о документе удостоверяющем личность -->
                //<!-- Тип -->
                "<dec:Type></dec:Type>" +
                    "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>" +
                    "</dec:IdentityCard>";

            }

            $(this).find('select[step_13_identity="true"]').closest(".step_13_info_7_document_clone").each(function () {

                FamilyMember +=
                //<!-- Информация о документе удостоверяющем личность -->
                "<dec:IdentityCard>" +
                //<!-- Тип -->
                "<dec:Type>" + $(this).find("select[name='step_13_name_doc_sdd_z_document'] option:selected").text() + "</dec:Type>" +
                //<!-- Серия -->
                "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>" +
                    "</dec:IdentityCard>";

            });


            $(this).find('select[step_13_identity_group="true"]').closest("fieldset").each(function () {

                if ($(this).find('input[name="step_13_check_doc_sdd_z_group"]').is(":checked")) {

                    FamilyMember +=

                    //<!-- Информация о документе удостоверяющем личность -->
                    "<dec:IdentityCard>" +
                    //<!-- Тип -->
                    "<dec:Type>" + $(this).find("select[name='step_13_name_doc_sdd_z_group'] option:selected").text() + "</dec:Type>" +
                    //<!-- Серия -->
                    "<dec:Series></dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number></dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue></dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization></dec:Organization>" +
                        "</dec:IdentityCard>";
                }

            });


            $(this).find(".step_13_info_7_document_clone:not(:first)").each(function () {

                if ($(this).find("select[step_13_identity='true']").length < 1) {

                    FamilyMember +=
                    //<!-- Данные документа удостоверяющего степень родства -->
                    "<dec:Document>" +
                    //<!-- Группа -->
                    "<dec:Group>" +
                    //<!-- Наименование группы -->
                    "<dec:Name></dec:Name>" +
                    //<!-- Код группы -->
                    "<dec:Code></dec:Code>" +
                        "</dec:Group>" +
                    //<!-- Наименование документа -->
                    "<dec:Name>" + $(this).find("select[name='step_13_name_doc_sdd_z_document'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код документа -->
                    "<dec:Code>" + $(this).find("select[name='step_13_name_doc_sdd_z_document'] option:selected").val() + "</dec:Code>" +
                    //<!-- Признак документа личного хранения true||false  -->
                    "<dec:PrivateStorage>" + $(this).find('input[name="step_13_doc_bring_himself_sdd_z_document"]').val() + "</dec:PrivateStorage>" +
                    //<!-- Возможность получения в ЭФ -->
                    "<dec:ElectronicForm>false</dec:ElectronicForm>" +

                    //<!-- Атрибуты документа -->
                    getDocumentParams($(this).find("select[name='step_13_name_doc_sdd_z_document']")) +

                    "</dec:Document>";
                }

            });


            $(this).find('input[name="step_13_check_doc_sdd_z_group"]:checked').closest("fieldset").each(function () {

                if ($(this).find("select[step_13_identity_group='true']").length < 1) {

                    FamilyMember +=
                    //<!-- Данные документа удостоверяющего степень родства -->
                    "<dec:Document>" +
                    //<!-- Группа -->
                    "<dec:Group>" +
                    //<!-- Наименование группы -->
                    "<dec:Name>" + $(this).closest(".step_13_info_7_group_clone").find("select[name='step_13_group_name_doc_sdd_z'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код группы -->
                    "<dec:Code>" + $(this).closest(".step_13_info_7_group_clone").find("select[name='step_13_group_name_doc_sdd_z'] option:selected").val() + "</dec:Code>" +
                        "</dec:Group>" +
                    //<!-- Наименование документа -->
                    "<dec:Name>" + $(this).find("select[name='step_13_name_doc_sdd_z_group'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код документа -->
                    "<dec:Code>" + $(this).find("select[name='step_13_name_doc_sdd_z_group'] option:selected").val() + "</dec:Code>" +
                    //<!-- Признак документа личного хранения true||false  -->
                    "<dec:PrivateStorage>" + $(this).find('input[name="step_13_doc_bring_himself_sdd_z_group"]').val() + "</dec:PrivateStorage>" +
                    //<!-- Возможность получения в ЭФ -->
                    "<dec:ElectronicForm>false</dec:ElectronicForm>" +

                    //<!-- Атрибуты документа -->
                    getDocumentParams($(this).find("select[name='step_13_name_doc_sdd_z_document']")) +

                    "</dec:Document>";
                }
            });

            FamilyMember += "</dec:FamilyMember>";

        });


    }

    //<!-- Шаг 13 – Сведения о членах семьи для расчета СДД, зарегистрированных по адресу регистрации заявителя -->
    var step_13_xml =
        "<dec:InformationSDD>" +
    //<!-- Член семьи -->
    FamilyMember +
    /*"<dec:AppealPersonal>false</dec:AppealPersonal>" +
    "<dec:ReqDept>false</dec:ReqDept>" +*/
    "</dec:InformationSDD>";

    step_13_xml = step_13_xml.replace(/undefined/g, "");
    return step_13_xml;

}



function getXML_step_14() {
    var RelationDegreeName, RelationDegreeCode;
    var FamilyMember = "";

    $(".step_14_set_family_member_sdd_nz:checked").closest(".step_14_info_2_clone").each(function () {
        RelationDegreeName = $(this).find(".step_14_relation_degree_sdd_nz option:selected").text();
        RelationDegreeCode = $(this).find(".step_14_relation_degree_sdd_nz option:selected").val();

        if (RelationDegreeCode === "") {
            RelationDegreeName = "";
        }
        //var id = $(this).find(".step_14_set_family_member_sdd_nz:checked").attr("id").split("_").pop();
        FamilyMember +=
        "<dec:FamilyMember>" +
        //<!--Идентификатор гражданина-->
        "<dec:Code>???</dec:Code>" +
        //<!--Фамилия-->
        "<dec:Surname>" + $(this).find(".step_14_last_name_declarant_sdd_nz").val() + "</dec:Surname>" +
        //<!--Имя-->
        "<dec:Name>" + $(this).find(".step_14_first_name_declarant_sdd_nz").val() + "</dec:Name>" +
        //<!--Отчество-->
        "<dec:Patronymic>" + $(this).find(".step_14_middle_name_declarant_sdd_nz").val() + "</dec:Patronymic>" +
        //<!--Дата рождения в формате гггг-мм-дд -->
        "<dec:Birthday>" + $(this).find(".step_14_birthday_declarant_sdd_nz").val() + "</dec:Birthday>" +
        //<!--Степень родства-->
        "<dec:RelationDegree>" +
        //<!-- Наименование -->
        "<dec:Name>" + RelationDegreeName + "</dec:Name>" +
        //<!-- Код -->
        "<dec:Code>" + RelationDegreeCode + "</dec:Code>" +
        //<!-- Наличие иждивения-->
        "<dec:Dependents>false</dec:Dependents>" +
            "</dec:RelationDegree>";


        if ($(this).find('select[step_14_identity="true"]').length < 1 && $(this).find('select[step_14_identity_group="true"]').length < 1) {
            FamilyMember += "<dec:IdentityCard>" +
            //<!-- Информация о документе удостоверяющем личность -->
            //<!-- Тип -->
            "<dec:Type></dec:Type>" +
                "<dec:Series></dec:Series>" +
            //<!-- Номер -->
            "<dec:Number></dec:Number>" +
            //<!-- Дата выдачи в формате гггг-мм-дд -->
            "<dec:DateIssue></dec:DateIssue>" +
            //<!-- Организация выдавшая документ -->
            "<dec:Organization></dec:Organization>" +
                "</dec:IdentityCard>";
        }

        $(this).find('select[step_14_identity="true"]').closest(".step_14_info_3_document_clone").each(function () {
            FamilyMember += "<dec:IdentityCard>" +
            //<!-- Информация о документе удостоверяющем личность -->
            //<!-- Тип -->
            "<dec:Type>" + $(this).find("select[name='step_14_name_doc_declarant_sdd_nz_document'] option:selected").text() + "</dec:Type>";
            if ($(this).find('input[name="step_14_doc_declarant_set_identity_doc_sdd_nz_document"]').is(":checked")) {
                FamilyMember +=
                //<!-- Серия -->
                "<dec:Series>" + $(this).find('input[name="step_14_doc_declarant_series_sdd_nz_document"]').val() + "</dec:Series>" +
                //<!-- Номер -->
                "<dec:Number>" + $(this).find('input[name="step_14_doc_declarant_number_sdd_nz_document"]').val() + "</dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue>" + $(this).find('input[name="step_14_doc_declarant_date_sdd_nz_document"]').val() + "</dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization>" + $(this).find('textarea[name="step_14_doc_declarant_who_issued_sdd_nz_document"]').val() + "</dec:Organization>";
            } else {
                FamilyMember +=
                //<!-- Серия -->
                "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>";
            }
            FamilyMember += "</dec:IdentityCard>";
        });

        $(this).find('select[step_14_identity_group="true"]').closest("fieldset").each(function () {
            if ($(this).find('input[name="step_14_check_doc_declarant_sdd_nz_group"]').is(":checked")) {
                FamilyMember += "<dec:IdentityCard>" +
                //<!-- Информация о документе удостоверяющем личность -->
                //<!-- Тип -->
                "<dec:Type>" + $(this).find("select[name='step_14_name_doc_declarant_sdd_nz_group'] option:selected").text() + "</dec:Type>";
                if ($(this).find('input[name="step_14_doc_declarant_set_identity_doc_sdd_nz_group"]').is(":checked")) {
                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find('input[name="step_14_doc_declarant_series_sdd_nz_group"]:last').val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find('input[name="step_14_doc_declarant_number_sdd_nz_group"]:last').val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find('input[name="step_14_doc_declarant_date_sdd_nz_group"]:last').val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find('textarea[name="step_14_doc_declarant_who_issued_sdd_nz_group"]:last').val() + "</dec:Organization>";
                } else {
                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series></dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number></dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue></dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization></dec:Organization>";
                }
                FamilyMember += "</dec:IdentityCard>";
            }
        });

        FamilyMember +=
        "<dec:Address>" +
        //<!-- Почтовый индекс -->
        "<dec:PostCode></dec:PostCode>" +
        //<!-- регион -->
        "<dec:Region></dec:Region>" +
        //<!-- Район -->
        "<dec:Area></dec:Area>" +
        //<!-- Город -->
        "<dec:City></dec:City>" +
        //<!-- Насселенный пункт -->
        "<dec:Community></dec:Community>" +
        //<!-- Улица -->
        "<dec:Street></dec:Street>" +
        //<!-- Код кладр улицы (остальные коды кладр он содержит) -->
        "<dec:CodeKladr></dec:CodeKladr>" +
        //<!-- Дом -->
        "<dec:House></dec:House>" +
        //<!-- Корпус -->
        "<dec:Housing></dec:Housing>" +
        //<!-- Строение -->
        "<dec:Construction></dec:Construction>" +
        //<!-- Квартира -->
        "<dec:Apartment></dec:Apartment>" +
        //<!-- Комната -->
        "<dec:Room></dec:Room>" +
        //<!-- Тип адреса (значение ЮР Адрес организации)-->
        "<dec:Type></dec:Type>" +
            "</dec:Address>";

        $(this).find(".step_14_info_3_document_clone:not(:first)").each(function () {
            if ($(this).find("select[step_14_identity='true']").length < 1) {
                FamilyMember +=
                //<!-- Данные документа удостоверяющего степень родства -->
                "<dec:Document>" +
                //<!-- Группа -->
                "<dec:Group>" +
                //<!-- Наименование группы -->
                "<dec:Name></dec:Name>" +
                //<!-- Код группы -->
                "<dec:Code></dec:Code>" +
                    "</dec:Group>" +
                //<!-- Наименование документа -->
                "<dec:Name>" + $(this).find("select[name='step_14_name_doc_declarant_sdd_nz_document'] option:selected").text() + "</dec:Name>" +
                //<!-- Код документа -->
                "<dec:Code>" + $(this).find("select[name='step_14_name_doc_declarant_sdd_nz_document'] option:selected").val() + "</dec:Code>";

                if ($(this).find('input[name="step_14_doc_declarant_set_identity_doc_sdd_nz_document"]').is(":checked")) {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find("input[name='step_14_doc_declarant_series_sdd_nz_document']:last").val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find("input[name='step_14_doc_declarant_number_sdd_nz_document']:last").val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find("input[name='step_14_doc_declarant_date_sdd_nz_document']:last").val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find("textarea[name='step_14_doc_declarant_who_issued_sdd_nz_document']:last").val() + "</dec:Organization>";

                }
                FamilyMember +=
                //<!-- Признак документа личного хранения true||false  -->
                "<dec:PrivateStorage>" + $(this).find('input[name="step_14_doc_declarant_bring_himself_sdd_nz_document"]').val() + "</dec:PrivateStorage>" +
                //<!-- Возможность получения в ЭФ -->
                "<dec:ElectronicForm>" + $(this).find('input[name="step_14_doc_declarant_set_identity_doc_sdd_nz_document"]').is(":checked") + "</dec:ElectronicForm>";

                //<!-- Атрибуты документа -->
                FamilyMember += getDocumentParams($(this).find("select[name='step_14_name_doc_declarant_sdd_nz_document']"));

                FamilyMember += "</dec:Document>";

            }
        });

        $(this).find('input[name="step_14_check_doc_declarant_sdd_nz_group"]:checked').closest("fieldset").each(function () {
            if ($(this).find("select[step_14_identity_group='true']").length < 1) {
                FamilyMember +=
                //<!-- Данные документа удостоверяющего степень родства -->
                "<dec:Document>" +
                //<!-- Группа -->
                "<dec:Group>" +
                //<!-- Наименование группы -->
                "<dec:Name>" + $(this).closest(".step_14_info_3_group_clone").find("select[name='step_14_group_name_doc_declarant_sdd_nz'] option:selected").text() + "</dec:Name>" +
                //<!-- Код группы -->
                "<dec:Code>" + $(this).closest(".step_14_info_3_group_clone").find("select[name='step_14_group_name_doc_declarant_sdd_nz'] option:selected").val() + "</dec:Code>" +
                    "</dec:Group>" +
                //<!-- Наименование документа -->
                "<dec:Name>" + $(this).find("select[name='step_14_name_doc_declarant_sdd_nz_group'] option:selected").text() + "</dec:Name>" +
                //<!-- Код документа -->
                "<dec:Code>" + $(this).find("select[name='step_14_name_doc_declarant_sdd_nz_group'] option:selected").val() + "</dec:Code>";

                if ($(this).find('input[name="step_14_doc_declarant_set_identity_doc_sdd_nz_group"]').is(":checked")) {

                    FamilyMember +=
                    //<!-- Серия -->
                    "<dec:Series>" + $(this).find("input[name='step_14_doc_declarant_series_sdd_nz_group']:last").val() + "</dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number>" + $(this).find("input[name='step_14_doc_declarant_number_sdd_nz_group']:last").val() + "</dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue>" + $(this).find("input[name='step_14_doc_declarant_date_sdd_nz_group']:last").val() + "</dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization>" + $(this).find("textarea[name='step_14_doc_declarant_who_issued_sdd_nz_group']:last").val() + "</dec:Organization>";

                }
                FamilyMember +=
                //<!-- Признак документа личного хранения true||false  -->
                "<dec:PrivateStorage>" + $(this).find('input[name="step_14_doc_declarant_bring_himself_sdd_nz_group"]').val() + "</dec:PrivateStorage>" +
                //<!-- Возможность получения в ЭФ -->
                "<dec:ElectronicForm>" + $(this).find('input[name="step_14_doc_declarant_set_identity_doc_sdd_nz_group"]').is(":checked") + "</dec:ElectronicForm>";

                //<!-- Атрибуты документа -->
                FamilyMember += getDocumentParams($(this).find("select[name='step_14_name_doc_declarant_sdd_nz_document']"));
                
                FamilyMember += "</dec:Document>";
            }
        });
        FamilyMember += "</dec:FamilyMember>";
    });

    //ДОБАЛВЕНИЕ ВРУЧНУЮ
    if ($("#step_14_add_family_member_sdd_nz").is(":checked")) {
        $(".step_14_info_6_clone:not(:first)").each(function () {
            RelationDegreeName = $(this).find(".step_14_relation_degree_family_member_sdd_nz option:selected").text();
            RelationDegreeCode = $(this).find(".step_14_relation_degree_family_member_sdd_nz option:selected").val();

            if (RelationDegreeCode === "") {
                RelationDegreeName = "";
            }

            FamilyMember +=
            "<dec:FamilyMember>" +
            //<!--Идентификатор гражданина-->
            "<dec:Code>???</dec:Code>" +
            //<!--Фамилия-->
            "<dec:Surname>" + $(this).find(".step_14_last_name_family_member_sdd_nz").val() + "</dec:Surname>" +
            //<!--Имя-->
            "<dec:Name>" + $(this).find(".step_14_first_name_family_member_sdd_nz").val() + "</dec:Name>" +
            //<!--Отчество-->
            "<dec:Patronymic>" + $(this).find(".step_14_middle_name_family_member_sdd_nz").val() + "</dec:Patronymic>" +
            //<!--Дата рождения в формате гггг-мм-дд -->
            "<dec:Birthday>" + $(this).find(".step_14_birthday_family_member_sdd_nz").val() + "</dec:Birthday>" +
            //<!--Степень родства-->
            "<dec:RelationDegree>" +
            //<!-- Наименование -->
            "<dec:Name>" + RelationDegreeName + "</dec:Name>" +
            //<!-- Код -->
            "<dec:Code>" + RelationDegreeCode + "</dec:Code>" +
            //<!-- Наличие иждивения-->
            "<dec:Dependents>false</dec:Dependents>" +
                "</dec:RelationDegree>";

            if ($(this).find('select[step_14_identity="true"]').length < 1 && $(this).find('select[step_14_identity_group="true"]').length < 1) {
                FamilyMember += "<dec:IdentityCard>" +
                //<!-- Информация о документе удостоверяющем личность -->
                //<!-- Тип -->
                "<dec:Type></dec:Type>" +
                    "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>" +
                    "</dec:IdentityCard>";
            }
            $(this).find('select[step_14_identity="true"]').closest(".step_14_info_7_document_clone").each(function () {
                FamilyMember +=
                //<!-- Информация о документе удостоверяющем личность -->
                "<dec:IdentityCard>" +
                //<!-- Тип -->
                "<dec:Type>" + $(this).find("select[name='step_14_name_doc_sdd_nz_document'] option:selected").text() + "</dec:Type>" +
                //<!-- Серия -->
                "<dec:Series></dec:Series>" +
                //<!-- Номер -->
                "<dec:Number></dec:Number>" +
                //<!-- Дата выдачи в формате гггг-мм-дд -->
                "<dec:DateIssue></dec:DateIssue>" +
                //<!-- Организация выдавшая документ -->
                "<dec:Organization></dec:Organization>" +
                    "</dec:IdentityCard>";
            });
            $(this).find('select[step_14_identity_group="true"]').closest("fieldset").each(function () {
                if ($(this).find('input[name="step_14_check_doc_sdd_nz_group"]').is(":checked")) {
                    FamilyMember +=
                    //<!-- Информация о документе удостоверяющем личность -->
                    "<dec:IdentityCard>" +
                    //<!-- Тип -->
                    "<dec:Type>" + $(this).find("select[name='step_14_name_doc_sdd_nz_group'] option:selected").text() + "</dec:Type>" +
                    //<!-- Серия -->
                    "<dec:Series></dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number></dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue></dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization></dec:Organization>" +
                        "</dec:IdentityCard>";
                }
            });
            $(this).find(".step_14_info_7_document_clone:not(:first)").each(function () {
                if ($(this).find("select[step_14_identity='true']").length < 1) {
                    FamilyMember +=
                    //<!-- Данные документа удостоверяющего степень родства -->
                    "<dec:Document>" +
                    //<!-- Группа -->
                    "<dec:Group>" +
                    //<!-- Наименование группы -->
                    "<dec:Name></dec:Name>" +
                    //<!-- Код группы -->
                    "<dec:Code></dec:Code>" +
                        "</dec:Group>" +
                    //<!-- Наименование документа -->
                    "<dec:Name>" + $(this).find("select[name='step_14_name_doc_sdd_nz_document'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код документа -->
                    "<dec:Code>" + $(this).find("select[name='step_14_name_doc_sdd_nz_document'] option:selected").val() + "</dec:Code>" +
                    //<!-- Серия -->
                    "<dec:Series></dec:Series>" +
                    //<!-- Номер -->
                    "<dec:Number></dec:Number>" +
                    //<!-- Дата выдачи в формате гггг-мм-дд -->
                    "<dec:DateIssue></dec:DateIssue>" +
                    //<!-- Организация выдавшая документ -->
                    "<dec:Organization></dec:Organization>" +
                    //<!-- Признак документа личного хранения true||false  -->
                    "<dec:PrivateStorage>" + $(this).find('input[name="step_14_doc_bring_himself_sdd_nz_document"]').val() + "</dec:PrivateStorage>" +
                    //<!-- Возможность получения в ЭФ -->
                    "<dec:ElectronicForm>false</dec:ElectronicForm>" +
                    //<!-- Атрибуты документа -->
                    getDocumentParams($(this).find("select[name='step_14_name_doc_declarant_sdd_nz_document']")) +
                    
                    "</dec:Document>";
                }
            });
            $(this).find('input[name="step_14_check_doc_sdd_nz_group"]:checked').closest("fieldset").each(function () {
                if ($(this).find("select[step_14_identity_group='true']").length < 1) {
                    FamilyMember +=
                    //<!-- Данные документа удостоверяющего степень родства -->
                    "<dec:Document>" +
                    //<!-- Группа -->
                    "<dec:Group>" +
                    //<!-- Наименование группы -->
                    "<dec:Name>" + $(this).closest(".step_14_info_7_group_clone").find("select[name='step_14_group_name_doc_sdd_nz'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код группы -->
                    "<dec:Code>" + $(this).closest(".step_14_info_7_group_clone").find("select[name='step_14_group_name_doc_sdd_nz'] option:selected").val() + "</dec:Code>" +
                        "</dec:Group>" +
                    //<!-- Наименование документа -->
                    "<dec:Name>" + $(this).find("select[name='step_14_name_doc_sdd_nz_group'] option:selected").text() + "</dec:Name>" +
                    //<!-- Код документа -->
                    "<dec:Code>" + $(this).find("select[name='step_14_name_doc_sdd_nz_group'] option:selected").val() + "</dec:Code>" +
                    //<!-- Признак документа личного хранения true||false  -->
                    "<dec:PrivateStorage>" + $(this).find('input[name="step_14_doc_bring_himself_sdd_nz_group"]').val() + "</dec:PrivateStorage>" +
                    //<!-- Возможность получения в ЭФ -->
                    "<dec:ElectronicForm>false</dec:ElectronicForm>" +
                    //<!-- Атрибуты документа -->
                    getDocumentParams($(this).find("select[name='step_14_name_doc_declarant_sdd_nz_document']")) +
                    
                    "</dec:Document>";
                }
            });
            FamilyMember += "</dec:FamilyMember>";
        });
    }
    //<!-- Шаг 14 – Сведения о членах семьи для расчета СДД, не зарегистрированных по адресу регистрации заявителя -->
    var step_14_xml =
        "<dec:InformationSDDNotRegistered>" +
    //<!-- Член семьи -->
    FamilyMember +
    /*"<dec:AppealPersonal>false</dec:AppealPersonal>" +
    "<dec:ReqDept>false</dec:ReqDept>" +*/
    "</dec:InformationSDDNotRegistered>";
    step_14_xml = step_14_xml.replace(/undefined/g, "");
    return step_14_xml;

}


function getXML_step_15(){
    //<!-- Шаг 15 – Сведения о доходах всех членов семьи -->
   	step_15_xml = '<dec:InformationIncomeOfFamilyMembers>';
   	for (var i = 0; i < step_15_familyMembers.length; i++){
   	   var familyMember = step_15_familyMembers[i].familyMember;
   	   //        <!-- Член семьи -->
   	   var step_15_familyMember_xml = '<dec:FamilyMembers>'; 
           	   //<!--Идентификатор гражданина-->
           	   step_15_familyMember_xml += '<dec:Code></dec:Code>';       	   
           	   step_15_familyMember_xml += '<dec:Surname>'+familyMember.surname+'</dec:Surname>';
           	   step_15_familyMember_xml += '<dec:Name>'+familyMember.name+'</dec:Name>';
           	   step_15_familyMember_xml += '<dec:Patronymic>'+familyMember.patronymic+'</dec:Patronymic>';
           	   step_15_familyMember_xml += '<dec:Birthday>'+familyMember.birthday+'</dec:Birthday>';
           	   //<!-- Доходы -->
           	   step_15_familyMember_xml += '<dec:Profits>';
           	   $('.step_15_is_income_true_'+i+':checked').each(function(l){
           	        if (l > 0){ //пропускаем дефолтовый элемент, т.к. по умолчанию и он :checked
           	            step_15_familyMember_xml += '<dec:Profit>';
           	                var ind_profit = getIndex(this); //i+'_'+(l-1);
           	                var date = $('#step_15_mm_gg'+ind_profit).val().split('.');
           	                step_15_familyMember_xml += '<dec:Year>'+date[1]+'</dec:Year>';    //<!-- Год -->
           	                step_15_familyMember_xml += '<dec:Month>'+date[0]+'</dec:Month>';    //<!-- Месяц -->
           	                step_15_familyMember_xml += '<dec:Amount>'+$('#step_15_sum_profit'+ind_profit).val()+'</dec:Amount>';    //<!-- Сумма -->
           	                step_15_familyMember_xml += '<dec:Type>'+$('#step_15_type_profit'+ind_profit).val()+'</dec:Type>';    //<!-- Тип дохода -->
           	                step_15_familyMember_xml += '<dec:ReqParams><dec:ReqParam><dec:Name></dec:Name><dec:Code></dec:Code><dec:Type></dec:Type><dec:Value></dec:Value></dec:ReqParam></dec:ReqParams>';
           	            step_15_familyMember_xml += '</dec:Profit>';
           	        }
           	   });
           	   if ($('#step_15_add_info_money_'+i).attr('checked')){ //неизвестно какой блок формировать(15_06_13)
               	   $('.step_15_type_profit_w1_'+i).each(function(k){
               	       if (k > 0){  //пропускаем дефолтовый элемент
                      	   step_15_familyMember_xml += '<dec:Profit>';
    	                        step_15_familyMember_xml += '<dec:Year></dec:Year>';    //<!-- Год -->
                   	            step_15_familyMember_xml += '<dec:Month></dec:Month>';    //<!-- Месяц -->
                   	            step_15_familyMember_xml += '<dec:Amount></dec:Amount>';    //<!-- Сумма -->
                 	            step_15_familyMember_xml += '<dec:Type>'+$('#'+this.id+' option:selected').attr('title')+'</dec:Type>';    //<!-- Тип дохода -->
                 	            //нужны доки?
                 	            /*
                 	            $(this).closest('table').find('.step_15_name_doc_sdd_'+i).each(function(m){
                 	                if (m > 0){
                     	                step_15_familyMember_xml += '<dec:Document>';
                         	                //группа в данном случае пустая. Мб ее и не нужно отправлять?
                         	                step_15_familyMember_xml += '<dec:Group><dec:Name></dec:Name><dec:Code></dec:Code></dec:Group>';
                         	                var selObj = getSelectedObject(this.id);
                         	                step_15_familyMember_xml += '<dec:Name>'+selObj.name+'</dec:Name>';
                         	                step_15_familyMember_xml += '<dec:Code>'+selObj.code+'</dec:Code>';
                         	                //атрибутов нет, их совсем не передовать? или пустыми оставить?
                         	                step_15_familyMember_xml += '<dec:Series/><dec:Number/><dec:DateIssue/><dec:Organization/>';
                         	                var docInd = getIndex(this);
                         	                step_15_familyMember_xml += '<dec:PrivateStorage>'+$('#step_15_doc_bring_himself'+docInd).attr('checked')+'</dec:PrivateStorage>';
                         	                //ElectronicForm - по нашей идеологии = подтверждены или нет реквизиты. Здесь их нет, поэтому - false
                         	                step_15_familyMember_xml += '<dec:ElectronicForm>false</dec:ElectronicForm>';
                         	                ///      пока такие штуки ни в каких документах не нужны
                         	                            <!-- Атрибуты документа -->
                                                            <dec:Params>
                                                                <!-- Атрибут -->
                                                                <dec:Param>
                                                                    <!--Наименование атрибута-->
                                                                    <dec:Name>ParamName</dec:Name>
                                                                    <!-- Код атрибута -->
                                                                    <dec:Code>ParamCode</dec:Code>
                                                                    <!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
                                                                    <dec:Type>ParamType</dec:Type>
                                                                    <!-- Значение в соответствие с типом -->
                                                                    <dec:Value>ParamValue</dec:Value>
                                                                </dec:Param>
                                                            </dec:Params>
                                                            <!-- Атрибуты для формирования запроса -->
                                                            <dec:ReqParams>
                                                                <!-- Атрибут -->
                                                                <dec:ReqParam>
                                                                    <!--Наименование атрибута-->
                                                                    <dec:Name>ReqParamName</dec:Name>
                                                                    <!-- Код атрибута -->
                                                                    <dec:Code>ReqParamCode</dec:Code>
                                                                    <!-- Тип значения (Строка, целое число, Дробное число(разделитель"."),Дата(гггг-мм-дд)) -->
                                                                    <dec:Type>ReqParamType</dec:Type>
                                                                    <!-- Значение в соответствие с типом -->
                                                                    <dec:Value>ReqParamValue</dec:Value>
                                                                </dec:ReqParam>
                                                            </dec:ReqParams>
                         	                ///
                         	            step_15_familyMember_xml += '</dec:Document>';   
                 	                }     
                 	            });
                 	            $(this).closest('table').find('.step_15_group_name_doc_'+i).each(function(n){
                 	                if (n > 0){
                 	                    var group = getSelectedObject(this.id);
                         	            var checkDoc = $('[step_15_group_check='+this.id+']:checked');
                         	            if (checkDoc.length == 1){
                                            var chechDocInd = checkDoc.attr('id').split('step_15_check_doc').pop();
                     	                    step_15_familyMember_xml += '<dec:Document>';
                             	                step_15_familyMember_xml += '<dec:Group>';
                                 	                step_15_familyMember_xml += '<dec:Name>'+group.name+'</dec:Name>';
                                 	                step_15_familyMember_xml += '<dec:Code>'+group.code+'</dec:Code>';
                                 	            step_15_familyMember_xml += '</dec:Group>';
                                 	            var selObj = getSelectedObject('step_15_name_doc_sdd_group'+chechDocInd);
                             	                step_15_familyMember_xml += '<dec:Name>'+selObj.name+'</dec:Name>';
                             	                step_15_familyMember_xml += '<dec:Code>'+selObj.code+'</dec:Code>';
                             	                //атрибутов нет, их совсем не передовать? или пустыми оставить?
                             	                step_15_familyMember_xml += '<dec:Series/><dec:Number/><dec:DateIssue/><dec:Organization/>';
                             	                step_15_familyMember_xml += '<dec:PrivateStorage>'+$('#step_15_doc_bring_himself_group'+chechDocInd).attr('checked')+'</dec:PrivateStorage>';
                             	                //ElectronicForm - по нашей идеологии = подтверждены или нет реквизиты. Здесь их нет, поэтому - false
                             	                step_15_familyMember_xml += '<dec:ElectronicForm>false</dec:ElectronicForm>';
                             	            step_15_familyMember_xml += '</dec:Document>';                             	            
                         	            }
                 	                }
                 	            });*/
                 	            
                 	            // или 
            				    step_15_familyMember_xml += '<dec:ReqParams>';
                                 	            $(this).closest('table').find('.step_15_name_doc_sdd_'+i).each(function(m){
                                 	                if (m > 0){
                                     	                step_15_familyMember_xml += '<dec:ReqParam>';
                                         	                //группа в данном случае пустая. Мб ее и не нужно отправлять?
                                         	               // step_15_familyMember_xml += '<dec:Group><dec:Name></dec:Name><dec:Code></dec:Code></dec:Group>';
                                         	                var selObj = getSelectedObject(this.id);
                                         	                step_15_familyMember_xml += '<dec:Name>'+selObj.name+'</dec:Name>';
                                         	                step_15_familyMember_xml += '<dec:Code>'+selObj.code+'</dec:Code>';
                                         	                var docInd = getIndex(this);
                                         	                step_15_familyMember_xml += '<dec:Type>Document</dec:Type>';
                                         	                step_15_familyMember_xml += '<dec:Value>'+$('#step_15_doc_bring_himself'+docInd).attr('checked')+'</dec:Value>';
                                         	                //ElectronicForm - по нашей идеологии = подтверждены или нет реквизиты. Здесь их нет, поэтому - false
                                         	            step_15_familyMember_xml += '</dec:ReqParam>';   
                                 	                }     
                                 	            });
                                 	            $(this).closest('table').find('.step_15_group_name_doc_'+i).each(function(n){
                                 	                if (n > 0){
                                 	                    //var group = getSelectedObject(this.id);
                                         	            var checkDoc = $('[step_15_group_check='+this.id+']:checked');
                                         	            if (checkDoc.length == 1){
                                                            var chechDocInd = checkDoc.attr('id').split('step_15_check_doc').pop();
                                     	                    step_15_familyMember_xml += '<dec:ReqParam>';
                                             	                //step_15_familyMember_xml += '<dec:Group>';
                                                 	                //step_15_familyMember_xml += '<dec:Name>'+group.name+'</dec:Name>';
                                                 	               // step_15_familyMember_xml += '<dec:Code>'+group.code+'</dec:Code>';
                                                 	            //step_15_familyMember_xml += '</dec:Group>';
                                                 	            var selObj = getSelectedObject('step_15_name_doc_sdd_group'+chechDocInd);
                                             	                step_15_familyMember_xml += '<dec:Name>'+selObj.name+'</dec:Name>';
                                             	                step_15_familyMember_xml += '<dec:Code>'+selObj.code+'</dec:Code>';
                                             	                step_15_familyMember_xml += '<dec:Type>Document</dec:Type>';
                                             	                step_15_familyMember_xml += '<dec:Value>'+$('#step_15_doc_bring_himself_group'+chechDocInd).attr('checked')+'</dec:Value>';
                                             	            step_15_familyMember_xml += '</dec:ReqParam>';                             	            
                                         	            }
                                 	                }
                                 	            });
            				step_15_familyMember_xml += '</dec:ReqParams>';
            
                       	   step_15_familyMember_xml += '</dec:Profit>';
                   	   }
               	   });
           	   }
           	   step_15_familyMember_xml += '</dec:Profits>';
           	   
   	   step_15_familyMember_xml += '</dec:FamilyMembers>';
   	   step_15_xml += step_15_familyMember_xml;
   	}
   	//step_15_xml += 	'<dec:AppealPersonal>false</dec:AppealPersonal>';//	<!-- Принести лично-->
	//step_15_xml += 	'<dec:ReqDept>false</dec:ReqDept>'; //<!-- Запрашивается ведомством-->
  	step_15_xml += '</dec:InformationIncomeOfFamilyMembers>';
  	return step_15_xml;
}

    function getXML_step_16() {
    	step_16_xml = "<dec:InformationRequested>";
    	$('[name=step_16_name_group_info]').each(function(j){
    		if (j > 0)  //пропускаем дефолтовый элемент
    			step_16_xml += getInfRequest(getIndex(this));
    	});	
    	step_16_xml += "</dec:InformationRequested>";
    	return step_16_xml; 
    }
    
    function getInfRequest(ind) {
    	var infRequest = "";
        if ((getCheckedCloneIndex('step_16_choice_info'+ind) < 0)&&(getCheckedRadioValue('step_16_choice_info'+ind)==null))
        	infRequest = "";
        else {
    		infRequest = "<dec:InfRequest>";
    		infRequest += "<dec:Group><dec:Name>"+getValue('step_16_name_group_info'+ind)+"</dec:Name><dec:Code>"+$('#step_16_name_group_info'+ind).text()+"</dec:Code></dec:Group>";
    		infRequest += "<dec:Name>"+$('#step_16_name_info'+ind).text()+"</dec:Name><dec:Code>"+$('#step_16_name_info'+ind).val()+"</dec:Code>";
        	infRequest += "<dec:ReqParams>";
        		$('.step_16_choice_info'+ind).each(function(i){
        			if ($(this).attr("checked")&&($(this).attr('inForm'))){
        				infRequest += "<dec:ReqParam>";
        				infRequest += "<dec:Name>"+$('#step_16_choice_info_label'+ind+"_"+(i-1)).text()+"</dec:Name>";
        				infRequest += "<dec:Code>"+$('#step_16_choice_info_label'+ind+"_"+(i-1)).val()+"</dec:Code>";
        				infRequest += "<dec:Type>"+$('#step_16_choice_info'+ind+"_"+(i-1)).attr('type')+"</dec:Type>";
        				infRequest += "<dec:Value>"+$('#step_16_choice_info'+ind+"_"+(i-1)).attr('checked')+"</dec:Value>";
        				infRequest += "</dec:ReqParam>";
        			}
        		});
        		$('.step_16_choice_info_radio'+ind).each(function(k){
        			if ($(this).attr("checked")&&($(this).attr('inForm'))){
        				infRequest += "<dec:ReqParam>";
        				infRequest += "<dec:Name>"+$('#step_16_choice_info_label'+ind+"_"+(k-1)).text()+"</dec:Name>";
        				infRequest += "<dec:Code>"+$('#step_16_choice_info_label'+ind+"_"+(k-1)).val()+"</dec:Code>";
        				infRequest += "<dec:Type>"+$('#step_16_choice_info_radio'+ind+"_"+(k-1)).attr('type')+"</dec:Type>";
        				infRequest += "<dec:Value>"+$('#step_16_choice_info_radio'+ind+"_"+(k-1)).attr('checked')+"</dec:Value>";
        				infRequest += "</dec:ReqParam>";        				
        			}        			
        		});
        	infRequest += "</dec:ReqParams>";
        	infRequest += "</dec:InfRequest>";
        }
		return infRequest; 
	}
    
    function getXML_step_17() {
    	step_17_xml = "<dec:MoreInformation>";
    	$('[name=step_17_name_group_info]').each(function(j){
    		if (j > 0)  //пропускаем дефолтовый элемент
    			step_17_xml += getInformation(getIndex(this));
    	});	
    	step_17_xml += "</dec:MoreInformation>";
    	return step_17_xml;
    }
    
    function getInformation(ind) {
		var information = "<dec:Information>";
		information += getGroupXml($('#step_17_name_group_info'+ind).val(),$('#step_17_name_group_info'+ind).text());
		$('[step_17_group=step_17_name_group_info'+ind+']').each(function(j) {
			//if ($(this).is(':visible')){
				information += "<dec:Data>";
					information += "<dec:Name>"+$('#step_17_name_info'+ind+"_"+j).text()+"</dec:Name>";
					information += "<dec:Code>"+$('#step_17_name_info'+ind+"_"+j).val()+"</dec:Code>";
					information += "<dec:Params>";
						$('.step_17_rekvizit_info'+ind+"_0").each(function(i){
							if ($(this).attr('inForm')){
								information += getReqParamFromStep17(ind+"_"+j+"_"+(i-1), '', $('#step_17_rekvizit_info'+ind+"_"+j+"_"+(i-1)).val());
							}
						});
						$('.step_17_rekvizit_info_radio'+ind+"_0").each(function(j){
							if ($(this).attr('inForm')){
								information += getReqParamFromStep17(ind+"_"+j+"_"+(i-1), '_radio', $('#step_17_rekvizit_info_radio'+ind+"_"+j+"_"+(i-1)).attr("checked"));				
							}
						});
						$('.step_17_rekvizit_info_checkbox'+ind+"_0").each(function(l){
							if ($(this).attr('inForm')){

								information += getReqParamFromStep17(ind+"_"+j+"_"+(i-1), '_checkbox', $('#step_17_rekvizit_info_checkbox'+ind+"_"+j+"_"+(i-1)).attr("checked"));
							}
						});
						$('.step_17_rekvizit_info_textarea'+ind+"_0").each(function(k){
							if ($(this).attr('inForm')){
								information += getReqParamFromStep17(ind+"_"+j+"_"+(i-1), '_textarea', $('#step_17_rekvizit_info_textarea'+ind+"_"+j+"_"+(i-1)).val());
							}
						});
					information += "</dec:Params>"	;	
				information += "</dec:Data>";
			//}
		});
		information += "</dec:Information>";
		return information; 
	}
    
    function getReqParamFromStep17(ind, type, val) {
    	var reqParam = "<dec:Param>";
    	reqParam += "<dec:Name>"+$('#step_17_name_rekvizit_info'+ind).text()+"</dec:Name>";
    	reqParam += "<dec:Code>"+$('#step_17_name_rekvizit_info'+ind).val()+"</dec:Code>";
    	reqParam += "<dec:Type>"+$('#step_17_rekvizit_info'+type+ind).attr('type')+"</dec:Type>";
    	reqParam += "<dec:Value>"+val+"</dec:Value>";
    	reqParam += "</dec:Param>"; 
    	return reqParam;
	}
    
    
    function getXML_step_18() {
    	step_18_xml = "<dec:NeededDocuments>";
    	paramArray = [
    	              	'step_18_name_doc_document',
    	              	'step_18_doc_true_1_document',
    	              	'step_18_doc_series_doc_document',
    	              	'step_18_doc_number_doc_document',
    	              	'step_18_doc_issue_date_doc_document',
    	              	'step_18_doc_org_doc_document',
    	              	'step_18_yourself_doc_document',
    	              	'step_18_name_doc_group',
    	              	'step_18_check_doc_group',
    	              	'step_18_doc_true_1_group',
    	              	'step_18_doc_series_doc_group',
    	              	'step_18_doc_number_doc_group',
    	              	'step_18_doc_issue_date_doc_group',
    	              	'step_18_doc_org_doc_group',
    	              	'step_18_yourself_doc_group',
    	              	'step_18_in_SMEV_doc_document',
    	              	'step_18_in_SMEV_doc_group'
    	             ]; 
    	step_18_xml += getDocumentsFromStep(paramArray);
    	step_18_xml += "</dec:NeededDocuments>";
    	return step_18_xml; 
	}
    
    function scrollToElement(id) {
        var selectedPosX = 0;
        var selectedPosY = 0;
        var theElement = document.getElementById(id);
      
        theElement.focus();
        while (theElement != null) {
            selectedPosX += theElement.offsetLeft;
            selectedPosY += theElement.offsetTop;
            theElement = theElement.offsetParent;
        }   
        var tmp = screen.height/2;
        if ((selectedPosY - tmp) > 0)
        	selectedPosY = selectedPosY - tmp;
        window.scrollTo(selectedPosX,selectedPosY/* + 100*/);
    }
    
	function errorMsg(text) {
		if (typeof SCREEN != 'undefined'){
			SCREEN.errorMessage(text);
		}
		else{
			alert(text);
		}
	}
	
	function checkErrorFields(arrayFields){
		var res = true;
		var nullFields = [];
		for (var i = 0; i < arrayFields.length; i++){
			//{ бяка by KAVlex 25_07_13
			var el = $('#'+arrayFields[i]); 
			if (el.hasClass('postCode')){
				if ((el.val().length != 6)||(!isDigit(el.val()))){
					errorMsg('Почтовый индекс должен содержать 6 цифр!');
					return false;
				}  	
			}
			if (el.hasClass('datepicker')){
				if ((isNotUndefined(el.valid))&&!(el.valid())){
					scrollToElement(arrayFields[i]);
					errorMsg('Неверный формат даты!');
					el.val(''); el.focus();
					return false;
				}
			}
			//}
			if (getValue(arrayFields[i]) == ''){
				nullFields[nullFields.length] = arrayFields[i]; 
			}
		}
		if (nullFields.length > 0){
			var text = 'Необходимо заполнить обязательные поля:\n';
			for (var j = 0; j < nullFields.length; j++){
				var label = $('#'+nullFields[j]).closest('td').prev().find('.label').text();
				if ((label == '')||(!isNotUndefined(label)))
					label = $('#'+nullFields[j]).closest('tr').find('span').text();
				if (j != nullFields.length-1)
					label = label + ",\n";
				text += label;
			}
			res = false;
			scrollToElement(nullFields[0]);
			errorMsg(text);
			//$('#'+nullFields[0]).focus();
		}
		return res;
	}
      
    function checkErrorStep_1(){
    	var res = true;
    	var checkFields = ['step_1_subservices', 'step_1_category', 'step_1_social_institution'];
    	res = checkErrorFields(checkFields);
    	if (!res)
    		return res;
    	if (!isResult([getCheckedRadioValue('step_1_acting_person')])){
    		errorMsg('Необходимо выбрать Лицо, оформляющее электронную заявку!');
			return false;    			
    	}
    	if ($('#step_1_acting_person_law').attr('checked'))
    		if ($('#step_1_category_legal_representative').val() == ''){
    			scrollToElement('step_1_category_legal_representative');
    			errorMsg('Необходимо выбрать категорию законного представителя!');
    			return false;    			
    		}
    	if ($('#step_1_acting_person_self').attr('checked'))
    		if ($('#step_1_category_person_self').val() == ''){
    			scrollToElement('step_1_category_person_self');
    			errorMsg('Необходимо выбрать тип заявителя!');
    			return false;    			
    		}
    	return res;
    }
    
    function checkErrorStep_2(){
    	if ($('#step_2_birthday_legal_representative').val() == ''){
    		scrollToElement('step_2_birthday_legal_representative');
    		errorMsg('Необходимо заполнить дату рождения!');
			return false;
    	}
    	if ($('#step_2_name_doc').val() == ''){
    		scrollToElement('step_2_name_doc');
			errorMsg('Выберите документ, подтверждающий ваши полномочия');
			return false;
    	}
    	return true;
    }
    
    function checkErrorStep_3(){
    	var res = true;
    	var checkFields = [
    	                   		'step_3_full_name_org', 'step_3_legal_address_org', 'step_3_identity_org_reg',
    	                   		'step_3_juridical_inn', 'step_3_juridical_kpp', 'step_3_juridical_ogrn',
    	                   		'step_3_lastname_org', 'step_3_name_org', 'step_3_birth_date_org', 'step_3_pozition_manager',
    	                   		'step_3_step_3_document_type_org', 'step_3_document_number_org', 'step_3_document_issue_date_org'
    	                   ];
    	res = checkErrorFields(checkFields);
    	if (!res)
    		return res;
    	if ($('#step_3_name_doc').val() == ''){
    		scrollToElement('step_2_name_doc');
			errorMsg('Выберите документ, подтверждающий полномочия вашей организации');
			return false;
    	}
    	return true;
    }
    
    function toDate(source){
 	   var from = null;
 	   if(source.indexOf(" ")>0){
 	      source = source.replace(' ',"."); 
 		  source = source.replace(/:/g,"."); 
 	   }
 	   from = source.split(".");
 	   return new Date(from[2],from[1]-1,from[0]);
 	}
        
    function checkErrorStep_4(){
    	if ($('#step_4_birthday_declarant').is(':visible')&&$('#step_4_birthday_declarant').val() == ''){
    		scrollToElement('step_4_birthday_declarant');
    		errorMsg('Необходимо заполнить дату рождения!');	
			return false;
    	}
    	if (getCheckedRadioValue('step_1_acting_person') != "self"){
    		if (!$('#step_4_add').attr('checked')&&(getCheckedCloneIndex('step_4_is_declarant_system_true') < 0)){
    			errorMsg('Необходимо либо выбрать лицо, либо добавить его вручную');
    			//scrollToElement('step_4_add');
    			return false;
    		}
    		else if (getCheckedCloneIndex('step_4_is_declarant_system_true') >= 0){
    			if (!$('#step_4_doc_other').attr('checked')&&(getCheckedCloneIndex('step_4_is_doc_person_system_true') < 0)){
        			errorMsg('Необходимо выбрать документ удостоверяющий личность');	
        			return false;
    			}
    			else 
    				if (($('#step_4_doc_other').attr('checked'))&&($('#step_4_document_name_system').val() == '')){
    					scrollToElement('step_4_document_name_system');
    					errorMsg('Необходимо выбрать документ удостоверяющий личность');	
            			return false;    					
    				}
    		}
    	}else{
    	   	var checkFields = [
	    	                   	'step_4_last_name_declarant','step_4_first_name_declarant','step_4_birthday_declarant',
	    	                   	'step_4_doc_declarant_type','step_4_doc_declarant_number','step_4_doc_declarant_date',
	    	                   	'step_4_address_declarant_region'
	    	                   ];
    	   	if (!checkErrorFields(checkFields))
	    		return false;
    	}
    		if ($('#step_4_add').attr('checked')){
    	    	var checkFields = [
    	    	                   	'step_4_last_name_new','step_4_name_new','step_4_birth_date_new',
    	    	                   	'step_4_document_name_new','step_4_new_region'
    	    	                   ];
    	    	if (!checkErrorFields(checkFields))
    	    		return false;
    		}
    	return true;
    }
    
    function checkErrorStep_5(){
    	var checkFields = ['step_5_last_name_declarant','step_5_first_name_declarant','step_5_birthday_declarant',
    	                   'step_5_INN','step_5_OGRNIP', 'step_5_doc_declarant_type',
    	                   'step_5_doc_declarant_number','step_5_doc_declarant_date','step_5_address_declarant_region'];
    	return checkErrorFields(checkFields);
    }
    
    function checkErrorStep_6(){
    	var checkFields = ['step_6_full_name_org','step_6_legal_address_org','step_6_identity_org_reg',
    	                   'step_6_juridical_inn','step_6_juridical_kpp','step_6_juridical_ogrn',
    	                   'step_6_lastname_org','step_6_name_org','step_6_birth_date_org', 'step_6_pozition_manager',
    	                   'step_6_step_6_document_type_org','step_6_document_number_org','step_6_document_issue_date_org'];
    	if (!checkErrorFields(checkFields))
    		return false;
    	if ($('#step_6_juridical_inn').val().length != 10){
    		errorMsg('ИИН юридического лица должен содержать 10 цифр!');
    		$('#step_6_juridical_inn').focus();
    		return false;
    	}
    	if ($('#step_6_juridical_kpp').val().length != 9){
    		errorMsg('КПП юридического лица должен содержать 9 цифр!');
    		$('#step_6_juridical_kpp').focus();
    		return false;
    	}
    	if ($('#step_6_juridical_ogrn').val().length != 13){
    		errorMsg('ОГРН юридического лица должен содержать 13 цифр!');
    		$('#step_6_juridical_ogrn').focus();
    		return false;
    	}
    	return true;
    }
      
    function checkErrorStep_7(){
    	if (!$('#step_7_add_family').attr('checked')&&(getCheckedCloneIndex('step_7_is_set_people_true') < 0)){
    		errorMsg('Необходимо либо выбрать лицо, либо добавить его вручную');
    		return false;
    	}
        var noError = true;
    	$('[name=step_7_group_doc_name]').each(function(i){
    	    if ((i>0)&&($(this).is(':visible'))){
        	    if (getCheckedCloneIndex('step_7_doc_true_group'+getIndex(this)) < 0){
        	    	scrollToElement(this.id);
        	        errorMsg('Необходимо выбрать документ в группе:\n'+getSelectedObject(this.id).name);
            		noError = false;
            		return noError; 
        	    }
    	    }
    	});
    	if (noError){
    		noError = checkErrorDocs(['step_7_doc_name_document', 'step_7_doc_name_group']);
    	}
    	if (noError && $('#step_7_add_family').attr("checked")){
        	var checkFields = ['step_7_last_name_people_two','step_7_first_name_people_two','step_7_birthday_people_two',
        	                   'step_7_relation_degree_two'];
        	noError = checkErrorFields(checkFields);
    	}
    	return noError;
    }
    
    function checkErrorStep_8(){
    	if ( getCheckedCloneIndex('step_8_is_recept_true') < 0 ) {
    		errorMsg('Необходимо выбрать получателя услуги');
    		return false;
    	}
    	var opt = $('#step_8_payment_type option:selected');
    	if ( getCheckedCloneIndex('step_8_is_recept_true') >= 0 && opt.val() != 'post' && opt.val() != 'bank') {
    		scrollToElement('step_8_payment_type');
    		errorMsg('Необходимо выбрать способ выплаты');
    		return false;
    	}
    	if ( getCheckedCloneIndex('step_8_is_recept_true') >= 0 && (opt.val() == 'post' || opt.val() == 'bank')
    			&& !$('#step_8_is_postal_bank_fill').attr('checked') && getCheckedCloneIndex('step_8_is_bank_true') < 0 && getCheckedCloneIndex('step_8_is_post_true') < 0
    	) {
    		errorMsg('Необходимо либо выбрать реквизиты из предложенных, либо заполнить сведения о рекизитах вручную');
    		return false;
    	}
    	if ($('#step_8_is_postal_bank_fill').attr('checked')&& (opt.val() == 'post')){
    		var checkFields = [];
    		if ($('#step_8_type_address_v option:selected').text() == 'Адрес регистрации')
    			checkFields = ['step_8_type_address_v'];
    		else 
    			checkFields = ['step_8_type_address_v','step_8_postal_address_v','step_8_post_region'];
        	if (!checkErrorFields(checkFields))
        		return false;
    	}
      	if ($('#step_8_is_postal_bank_fill').attr('checked')&& (opt.val() == 'bank')){
        	var checkFields = ['step_8_bank_name','step_8_bank_account'];
        	if (!checkErrorFields(checkFields))
        		return false;
        	if (!(($('#step_8_bank_account').val().length == 18)||($('#step_8_bank_account').val().length == 20))){
        		errorMsg('Номер лицевого счета должен содержать либо 18, либо 20 цифр');
        		return false;
        	}
    	}
    	return true;
    }    
    
    function checkErrorStep_9(){
    	return true;
    }
    
    function checkErrorStep_10(){
    	return true;
    }
    
    function checkErrorStep_11(){
    	var res = true;
    	if ($('#step_11_render_address_type_system').val() == ''){
    		scrollToElement('step_11_render_address_type_system');
    		errorMsg('Необходимо выбрать тип адреса');
    		return false;
    	}
    	if (!((getCheckedRadioValue('step_1_acting_person') == "self")&&(($('#step_11_render_address_type_system option:selected').text() == 'Адрес регистрации')||($('#step_11_render_address_type_system option:selected').text() == 'Адрес фактического проживания')))){
    		if (!$('#step_11_add_address').attr('checked')&&(getCheckedCloneIndex('step_11_is_render_address_true_1') < 0)){
    			errorMsg('Необходимо подтвердить сведения об адресе, либо заполнить их вручную');
        		return false;	
    		}
    	}
    	return res;
    }
    
    function checkErrorStep_12(){
    	var res = checkErrorDocFromGroup('step_12_group_name_doc_declarant_mf', 'step_12_check_doc_declarant_mf_group'); 
    	if (res){
    		res = checkErrorDocFromGroup('step_12_group_name_doc_declarant_mf2', 'step_12_check_doc_declarant_mf2_group');
    	}
    	if (res){
    		var names = ['step_12_name_doc_declarant_mf_document', 'step_12_name_doc_declarant_mf_group', 'step_12_name_doc_declarant_mf2_document', 'step_12_check_doc_declarant_mf2_group'];
    		res = checkErrorDocs(names);
    	}
    	if (res && $('#step_12_add_family_member_mf').attr('checked')){
          	var checkNames = ['step_12_last_name_family_member_mf', 'step_12_first_name_family_member_mf', 'step_12_birthday_family_member_mf'];
          	var checkFields = getCheckCloneFields(checkNames); 
        	res = checkErrorFields(checkFields);
    	}
    	return res;
    }
    
    function getCheckCloneFields(checkNamesArr) {
		var resArr = [];
		for (var i = 0; i < checkNamesArr.length; i++){
			$('[name='+checkNamesArr[i]+']').each(function(i) {
				if (i > 0){
					resArr[resArr.length] = this.id;
				}
			});
		}
		return resArr;
	}
    
    function checkErrorStep_13(){
    	var res = checkErrorDocFromGroup('step_13_group_name_doc_declarant_sdd_z', 'step_13_check_doc_declarant_sdd_z_group'); 
    	if (res){
    		res = checkErrorDocFromGroup('step_13_group_name_doc_sdd_z', 'step_13_check_doc_sdd_z_group');
    	}
    	if (res){
    		var names = ['step_13_name_doc_declarant_sdd_z_document', 'step_13_name_doc_declarant_sdd_z_group', 'step_13_name_doc_sdd_z_document', 'step_13_check_doc_sdd_z_group'];
    		res = checkErrorDocs(names);
    	}
    	if (res && $('#step_13_add_family_member_sdd_z').attr('checked')){
          	var checkNames = ['step_13_last_name_family_member_sdd_z', 'step_13_first_name_family_member_sdd_z', 'step_13_birthday_family_member_sdd_z', 'step_13_relation_degree_family_member_sdd_z'];
          	var checkFields = getCheckCloneFields(checkNames); 
        	res = checkErrorFields(checkFields);
    	}
    	return res;
    }
    
    function checkErrorStep_14(){
    	var res = checkErrorDocFromGroup('step_14_group_name_doc_declarant_sdd_nz', 'step_14_check_doc_declarant_sdd_nz_group'); 
    	if (res){
    		res = checkErrorDocFromGroup('step_14_group_name_doc_sdd_nz', 'step_14_check_doc_sdd_nz_group');
    	}
    	if (res){
    		var names = ['step_14_name_doc_declarant_sdd_nz_document', 'step_14_name_doc_declarant_sdd_nz_group', 'step_14_name_doc_sdd_nz_document', 'step_14_name_doc_sdd_nz_group'];
    		res = checkErrorDocs(names);
    	}
    	if (res && $('#step_14_add_family_member_sdd_nz').attr('checked')){
          	var checkNames = ['step_14_last_name_family_member_sdd_nz', 'step_14_first_name_family_member_sdd_nz', 'step_14_birthday_family_member_sdd_nz', 'step_14_relation_degree_family_member_sdd_nz'];
          	var checkFields = getCheckCloneFields(checkNames); 
        	res = checkErrorFields(checkFields);
    	}
    	return res;
    }
    
    function checkErrorStep_15(){
    	var res = true;
      	for (var i = 0; i < step_15_familyMembers.length; i++){
      			if (($('.step_15_is_income_true_'+i+':checked').length <= 1)&&(!$('#step_15_add_info_money_'+i).attr('checked'))){
      				errorMsg('Необходимо либо выбрать сведения о доходах, либо заполнить вручную');
      	    		return false;
      			}	
      			if ($('#step_15_add_info_money_'+i).attr('checked')){
                   $('.step_15_type_profit_w1_'+i).each(function(k){
                       if (k > 0){  //пропускаем дефолтовый элемент
                    	   if ($('#'+this.id+' option:selected').val() == ''){
                    		   var fio = $('#step_15_name_declarant_k_'+i).val();
                    		   scrollToElement(this.id);
                    		   errorMsg('Необходимо выбрать Вид дохода для - ' + fio);
                    		   res = false;
                 	    	   return res;		   
                    	   }                      	           
                   	   }
                   });
                }
        	}
    	return res;
    }
    
    function checkErrorStep_16(){	//TODO сомнительно необходимо ли здесь делать проверки? Так можно реализовать самые простые. 
    	//Но данная функция будет некорректна, если будут присутствовать как чекбоксы так радиокнопки, либо когда будет, например, только один чекбокс
    	var res = true;
    	$('[name=step_16_info_group]').each(function(i) {
    		if (i > 0){
				var ind = getIndex(this);
				if ($('#step_16_choice_info_radio'+ind + '_0').is(':visible')){
					if (getCheckedCloneIndex('step_16_choice_info_radio'+ind) < 0){
						errorMsg('Необходимо выбрать запрашиваемые сведения в группе ' + $('#step_16_name_group_info'+ind).val());
						res = false;
						return res;
					}
				}else{
					if (getCheckedCloneIndex('step_16_choice_info'+ind) < 0){
						errorMsg('Необходимо выбрать запрашиваемые сведения в группе ' + $('#step_16_name_group_info'+ind).val());
						res = false;
						return res;
					}
				}
    		}
		});
    	return res;
    }
    
    function checkErrorStep_17(){
    	//TODO неясно нужна ли проверка. Все приходящие поля обязательны для заполнения?
    	var res = true;
    	$('[name=step_17_rekvizit_info]').each(function(i) {
    		if ($(this).attr('inForm'))
				if (this.value == ''){
					var label = $(this).closest('tr').find('span').text();
					scrollToElement(this.id);
					errorMsg('Необходимо заполнить:\n' + label);
					this.focus();
					res = false;
					return false;
				}
		});
    	$('[name=step_17_rekvizit_info_textarea]').each(function(j) {
    		if ($(this).attr('inForm'))
	    		if (this.value == ''){
					var label = $(this).closest('tr').find('span').text();
					scrollToElement(this.id);
					errorMsg('Необходимо заполнить:\n' + label);
					this.focus();
					res = false;
					return false;
				}
		});
    	return res;
    }
    
    function checkErrorStep_18(){
    	var res = checkErrorDocFromGroup('step_18_name_group_doc', 'step_18_check_doc_group'); 
    	if (res){
    		var names = ['step_18_name_doc_document', 'step_18_name_doc_group'];
    		res = checkErrorDocs(names);
    	}
        return res;
    }
    
    function checkErrorDocs(checkNames){
    	var res = true;
    	for ( var int = 0; int < checkNames.length; int++) {
    		var checkName = checkNames[int];
    		if (!checkErrorDoc(checkName)){
    			res = false;
    			break;
    		}
		}
    	return res;
    }
    
    function checkErrorDoc(checkName){
    	var noError = true;
    	$('[name='+checkName+']').each(function(i){
    		var textarea = ($(this).parent().is("div") ? $(this).parent().prev('textarea') : $(this).prev('textarea'));
    		if ((i>0)&&( textarea.is(':visible') || $(this).is(':visible'))){
        		var docName = getSelectedObject(this.id).name;
        		$(this).closest('fieldset').find('.attrs').each(function(){
        			if ($(this).hasClass("used")){
        				$(this).find(".attr").each(function(){
        					if ($(this).val() == ""){
        						var attrName = $(this).closest('tr').find('span:last').text();
        						if (attrName[attrName.length - 1] == ":")
        							attrName = attrName.substring(0, attrName.length-1);
                    	        errorMsg('Необходимо заполнить значение атрибута <'+attrName + '> для документа:\n' + docName);
                    	        noError = false;
                    	        return false;    						
        					}
        				});
        			}
        		});	
    		}
    	});
    	return noError;
    }
    
    function checkErrorDocFromGroup(groupName, checkName){
        var noError = true;
        $('[name='+groupName+']').each(function(i){
    	    if ((i>0)&&($(this).is(':visible'))){
    	        if ($(this).closest('fieldset').find('[name='+checkName+']:checked').length < 1){
    	        		scrollToElement(this.id);
            	        errorMsg('Необходимо выбрать документ в группе:\n'+getSelectedObject(this.id).name);
                		noError = false;
                		return noError;
            	}
    	    }
    	});
    	return noError;
    }

	
$(".datepicker").each(function () {
    if ($(this).attr("disabled")) {$(this).parent().find(".ui-datepicker-trigger").hide();}
    else $(this).parent().find(".ui-datepicker-trigger").show();   
});
