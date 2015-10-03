// Модуль обработки форм процесса исполнения универсального маршрута
//Используется во всех формах процесса:
//Для фильтрации используется поле "idCurrentForm":
//	0	-	Исходный запрос
//	1	-	Заявление
//	2	-	Регистрация
//	3	-	Ожидание
//	4	-	Рассмотрение
//	5	-	Решение
//	6	-	Отказ
//	7	-	Архив

//var arrObjectMembers = ["m1.m2[].m3"];			
//var arrObjectMembers = ["m1.m2[].m3"];			

//var result;

//result = validObjectMembers(result, arrObjectMembers);





if ($("#idCurrentForm").text()=="1") // Подача заявления
{
  $("#petition").html('').load("/services/visPersonalData/js/big_form.html").show();
}




jQuery("#template").bind('show', function(ev) {
//$(document).ready(function(){
		if (window.jq == true) return;
		window.jq = true;








if ($("#idCurrentForm").text()=="0" || $("#idCurrentForm").text()=="2") // 'Исходный запрос' или "Регистрация"
{
    
	f_steps = $("#listSteps");
    lst_steps = f_steps.val().split("\n");
    
	for (i=1; i<=18; i++)
	{	
		$("fieldset#tab_"+i).hide(); 
	}

	for (var i in lst_steps)
	{	
		$("fieldset#tab_"+lst_steps[i]).show(); 
	}	
	
	$("#print-tab").remove();    
	
    $("#switch_tab_30").show();
	//if ($("#idCurrentForm").text()=="0")
	//{
		$("#fieldset_tab_0").hide();
	//}		
    //$("#fieldset_tab_30").show();
	//$("#fieldset_tab_30").hide();
    $("#switch_tab_30").val("Экранная форма заявления");	
}

if ( $("#idCurrentForm").text()=="2" ) // "Регистрация"
{  
 
  $("#date_reference_number").val(getCurDate());   
}
else
{  
  $("#date_reference_number").parent().find(".ui-datepicker-trigger").hide();  
}

if ($("#idCurrentForm").text()=="5" || $("#idCurrentForm").text()=="6") // Решение и отказ
{
	switchStateDateTimePicker(false);
	f_steps = $("#listSteps");
    lst_steps = f_steps.val().split("\n");
	
	for (i=1; i<=18; i++)
	{	
		$("fieldset#tab_"+i).hide(); 
	}

	for (var i in lst_steps)
	{	
		$("fieldset#tab_"+lst_steps[i]).show(); 
	}
	
	$("fieldset#tab_19").show(); 		
	
	$("#print-tab").remove();	
    switchStateDateTimePicker(true);	
	
	$("#fieldset_tab_0").hide();		
    $("#fieldset_tab_30").hide();
    $("#fieldset_tab_20").hide();

	$("#switch_tab_20").val("+");	  
    $("#switch_tab_0").val("Печатная форма заявления");		
	
	$("#date_registration_solutions_p_1").val(getCurDate());
}


if ($("#idCurrentForm").text()=="4" || $("#idCurrentForm").text()=="7") // 'Рассмотрение' или "Архив"
{    
	f_steps = $("#listSteps");
    lst_steps = f_steps.val().split("\n");
	
	for (i=1; i<=18; i++)
	{	
		$("fieldset#tab_"+i).hide(); 
	}

	for (var i in lst_steps)
	{	
		$("fieldset#tab_"+lst_steps[i]).show(); 
	}
    switchStateDateTimePicker(false);
	
    $("fieldset#tab_19").show(); 		
	
	$("#print-tab").remove();
			
      $("#switch_tab_0").val("Печатная форма заявления");	
	  $("#switch_tab_20").val("+");
	
	  $("#fieldset_tab_0").hide();		
      $("#fieldset_tab_30").hide();
      $("#fieldset_tab_20").hide();	
}


if ($("#idCurrentForm").text()=="3") // Ожидание
{
    
    switchStateDateTimePicker(false);	
	
	f_steps = $("#listSteps");
    lst_steps = f_steps.val().split("\n");
	
	for (i=1; i<=18; i++)
	{	
		$("fieldset#tab_"+i).hide(); 
	}

	for (var i in lst_steps)
	{	
		$("fieldset#tab_"+lst_steps[i]).show(); 
	}
	
	$("fieldset#tab_19").show(); 
	
	
	$("#transitions").find('.ui-button').each(function(){
	  $(this).click(function(){
	    $('#save').click();
	  });
	});	

	$("#print-tab").remove();		
		

	$("input[name='mark_receipt_l_y']").live("click", function(){
	    testReguest($(this),false);
	});
	
	$("input[name='mark_request_mv_t']").live("click", function(){	    
	    testReguestMv($(this),false);		
	});
	
	
	
	
	
	$("#save").click(function save() {
	
	    var data = new Array();
		
		if (window.flagSave == true) return;
		window.flagSave = true;
		
		$(".clone_block_1w:visible").each(function () {
			var checkbox = $(this).find("textarea[name='name_document_2_y']").attr("id");
			var pos = checkbox.lastIndexOf('_');
			var i = checkbox.substr(pos + 1);			

			if(window.outputData.document[i]==null){
			  window.outputData.document[i] = {};
			}						
			//window.result.document[i].electronicForm = $("#choice_trustee_rek_"+ i).attr("checked");
		    window.outputData.document[i].name = $("#name_document_2_y_"+ i).val();			
			window.outputData.document[i].hasDocument = $("#mark_receipt_l_y_"+ i).attr("checked");			
			window.outputData.document[i].rekvDocument = $("#rekv_document_2_y_"+ i).val();
			window.outputData.document[i].fio = $("#fio_document_2_y_"+ i).val();
			window.outputData.document[i].dateOfRecipt = $("#date_receipt_l_y_"+ i).val();
			window.outputData.document[i].privateStorage = true;
			window.outputData.document[i].isAdded = $("#isAdded_"+ i).attr("checked");
			data.push(window.outputData.document[i]);
		});		
		
		$(".clone_block_2w:visible").each(function () {            
			var checkbox = $(this).find("textarea[name='name_data_mv_t']").attr("id");
			var pos = checkbox.lastIndexOf('_');
			var i = checkbox.substr(pos + 1);
            
			
			if(window.outputData.document[i]==null){
			  window.outputData.document[i] = {};
			}
			//window.result.document[i].electronicForm = $("#choice_trustee_rek_"+ i).attr("checked");
			window.outputData.document[i].privateStorage = false;
			window.outputData.document[i].hasRequest = $("#mark_request_mv_t_"+ i).attr("checked");
			window.outputData.document[i].name = $("#name_data_mv_t_"+ i).val();
			window.outputData.document[i].fio = $("#fio_document_3_y_"+ i).val();
			window.outputData.document[i].dateOfRecipt = $("#date_receipt_mv_t_"+ i).val();
			
			window.outputData.document[i].reqNumber = $("#number_reguest_mv_"+ i).val();
			
			window.outputData.document[i].sendDate = $("#date_request_mv_t_"+ i).val();
			window.outputData.document[i].isAdded = $("#isAdded_"+ i).attr("checked");
			data.push(window.outputData.document[i]);
			
		});
		
		window.outputData = null;
		window.outputData = data;	
        $("#step_wait_nd").val("");		
        $("#step_wait_nd").val(JSON.stringify(window.outputData));
		//$("#step_wait_nd").val(JSON.stringify(window.result));
		
		//alert("1");
		//execution_fromJson(false);
		//alert("2");
	});

	$("#add").unbind("click");
	$("#add").click(function () {
	    
        switchStateDateTimePicker(false);
		
		var i = getFreeIndex();		
		
		
		var el = $("#docsPrivate .clone_block_1w:first").clone();
		$("#docsPrivate").append(el);		
		
		

		el.find("input").each(function () {           
		    if ($(this).attr("name")!="") $(this).val("");
			$(this).attr("id", $(this).attr("name") + "_" + i);
			if ($(this).attr("name")=="choice_trustee_rek") 
			{
			  $(this).attr("disabled",true);	
			  $(this).attr("checked",true);
			  $(this).closest("tr").hide();
			}			
			if ($(this).attr("name")=="date_receipt_l_y")
			{
			  $(this).attr("disabled",true);	
			}			
		});			
		
		
		el.find("textarea").each(function () {            		    		
			$(this).attr("id", $(this).attr("name") + "_" + i);			
			$(this).attr("required",true);			
		});
		el.find("#rekv_clone").show();		
		switchStateDateTimePicker(true);		
		
		el.find(".btn_delete_step_18_reg_info:last").show();
		
		el.show();
		//$(".clone_block_1w:last ").show();
		
		el.find('input[name="isAdded"]').attr("checked",true);
		
		$(".datepicker").each(function () 
		{
		  if ($(this).attr("disabled")) $(this).parent().find(".ui-datepicker-trigger").hide();
		  else $(this).parent().find(".ui-datepicker-trigger").show();	  
		});
		
		
		return false;
	});
	
	
	$("#add_mv").unbind("click");
	$("#add_mv").click(function () {		
        switchStateDateTimePicker(false);		
		
		var i = getFreeIndex();
		
		
		var el = $(".clone_block_2w:first").clone();
		$("#docsMV").append(el);
		

		el.find("input").each(function () {           
		    if ($(this).attr("name")!="") $(this).val("");		
			$(this).attr("id", $(this).attr("name") + "_" + i);
			//if ($(this).attr("name") == "choice_trustee_rek")
			//{			  			
			 //$(this).attr("disabled",false);
			//}			
			if ($(this).attr("name") == "number_reguest_mv") {$(this).attr("disabled",true);}
			if ($(this).attr("name") == "date_request_mv_t") {$(this).attr("disabled",true);}
			if ($(this).attr("name") == "date_receipt_mv_t") {$(this).attr("disabled",true);}			
		});			
				
		el.find("textarea").each(function () {            
	        if ($(this).attr("name")!="") $(this).val("");			
			$(this).attr("id", $(this).attr("name") + "_" + i);						
			$(this).attr("disabled",false);
		});
		switchStateDateTimePicker(true);		
		
		el.find(".btn_delete_step_18_mv_info").show();
		el.find('input[name="isAdded"]').attr("checked",true);
		el.find('input[name="choice_trustee_rek"]').attr("disabled",true);		
		el.find('input[name="choice_trustee_rek"]').closest("tr").hide();
		el.show();
		
		
		$(".datepicker").each(function () 
		{
		  if ($(this).attr("disabled")) 
		  {$(this).parent().find(".ui-datepicker-trigger").hide();}
		  else 
		  {$(this).parent().find(".ui-datepicker-trigger").show();}	  
		});
		

	});
    
	$('input[name="add"]').val("Добавить"); 
	$('input[name="add_mv"]').val("Добавить"); 		
	$(".btn_delete_step_18_reg_info").val("Удалить");
	$(".btn_delete_step_18_mv_info").val("Удалить");
	
	$(".save").hide();	
	
	  $("#fieldset_tab_0").hide();
	  $("#fieldset_tab_30").hide();
      $("#fieldset_tab_20").hide();	  
	  $("#switch_tab_0").val("Печатная форма заявления");
}



f_steps = $("#listSteps");
lst_steps = f_steps.val().split("\n");

//Скрыли реквизиты 7 шага безусловно, так как они будут отображаться в блок 18
$(".step_7_clone_block").hide();

function showstyle()
{

    $('span.print_title').css({'text-align':'center','display':'block','font-weight':'bold'});	
	$('span.print_text').css({'text-align':'left','font-style':'italic','font-weight':'normal'});
	$('span.print_textr').css({'text-align':'right','font-style':'italic','font-weight':'normal'});
	$('span.print_subTitle').css({'text-align':'left','display':'block','font-weight':'bold'});	
	$('span.print_hint').css({'text-align':'center','display':'block','font-size':'12px','padding-bottom':'20px'});
	$('span.print_label').css({'text-align':'left','display':'block','font-weight':'bold'});
	$('span.print_tlabel').css({'text-align':'center','display':'block','font-weight':'bold'});
	
	// Переопределяем цвет элементов fieldset  и table tr с заданного на свой
	$('table tr').css('background-color', '#efebde');
	$('fieldset').css('background-color', '#efebde');
	
	//$('.tab_4').click(function(){
			//SIA_step4();
	//});
	
	//$('body').css('font-size','14px');
	$('.indent_clear').css({'margin':'0','padding':'0'});
	$('input[type=text]').css('width','100%');
	$('select').css('width','100%');
	$('textarea').css('width','100%');
	$('input.input_w1').css('width','60%');
	$('input.input_w2').css('width','25%');
	$('input.input_w3').css('width','15%');
	$('input.input_w4').css('width','35%');
	$('select.select_w5').css('width','45%');
	$('select.select_w1').css('width','65%');
	$('select.select_w2').css('width','25%');
	$('textarea').css('height','40px');
	$('textarea').attr("resizable",true);
	
	
	
	//$('div.tabs').css('padding', '1em');
	//$('div.container').css({'margin': '0', 'width': '90%'});		
	//$('div.tabs div h2').css({'margin':'0'});	

	$('table').css('width','100%');
	$('table.mid').css({'width':'94%','margin':'auto'});
	$('table.mid.right').css({'margin-left':'auto','margin-right':'5px'});
	$('table.mid.right table').css({'width':'98%','margin-right':'auto'});
	//$('table.mid.right table tr td:first-child').css('width', '9%');
	$('table.mid2').css({'width':'74%','margin':'auto'});
	$('table.small').css({'width':'50%','margin':'auto'});
	
	//$('table tr td:first-child').css('width', '17%');
	//$('table tr td:first-child.small').css('width', '10%');
	
	$('table tr td.td_ext').css('width', '31%');
	$('table tr td.td_ext2').css('width', '23%');
        $('table tr td.td_ext3').css('width', '50%');
        $('table tr td.td_ext4').css('width', '40%');
        $('table tr td.td_ext5').css('width', '15%');
		$('table tr td.td_ext6').css('width', '65%');

	$('fieldset').css({'border':'1px solid #d8d7c7', 'margin-bottom':'15px', 'margin-left':'30px', 'margin-right':'30px', '-webkit-padding-before': '0.35em','-webkit-padding-start': '0.75em',	'-webkit-padding-end': '0.75em','-webkit-padding-after':'0.625em'});
	$('fieldset.mid').css({ 'width':'80%','margin':'auto'});
	$('fieldset.manual').css({'border':'1px solid #d8d7c7', 'margin-bottom':'15px', 'margin-left':'30px', 'margin-right':'30px', '-webkit-padding-before': '0.35em','-webkit-padding-start': '0.75em',	'-webkit-padding-end': '0.75em','-webkit-padding-after':'0.625em'});
	
	$('span.form_label').css({'text-align':'center','display':'block','color':'#0000ff','font-weight':'bold','font-size':'14px'});

	$('span.title').css({'text-align':'center','display':'block', 'color':'#ff0000','font-weight':'bold'});
	$('legend').css('font-weight','normal');
    $('legend.group_label').css({'color':'#0000ff', 'font-style':'italic', 'text-align':'left',  'font-size':'13px'});
    $('legend.group_label.group_hint').css('color','#898989');
    $('span.label').css({'color':'#000000','font-weight':'bold', 'font-size':'12px'});
    $('span.label.label_hint').css('color','#898989');
    //$('span.step_label').css({'text-align':'left','display':'block','color':'#0000ff','font-weight':'bold'});
	$('span.step_label').css({'text-align':'left','display':'block','color':'#0000ff'});
    $('span.hint').css({'color':'#898989','font-style':'italic','font-size':'11px', 'margin-left':'25px', 'padding-bottom':'20px'});
    $('span.hint.no_indent').css({'margin':'0','padding':'0'});
    $('#tabbs').css({'position':'relative', 'padding':'20px', 'margin':'0 auto', 'background-color':'#fff', 'width':'98%', 'min-width':'1006px'});
	//$('div').css({'font-family':'verdana', 'font-size':'14px'});
    $('.content').css({'border-left':'1px solid #ddd','border-right':'1px solid #ddd', 'width':'100%', 'margin-left':'0px'});
    $('.content div').css({'padding':'7px 20px 20px 13px', 'color':'black'});
    $('.clone_text').css('width','355px');
    $('.field-requiredMarker').css({'color':'#f00', 'font-style':'italic'});
	
	
	
}

var text_html='<br/><br/><span class="print_label">исх N:&nbsp;<span class="print_text" id="print_num_query"></span></span><br/>'+
//'<fieldset>'+
'<span class="print_title" id="printNameStep1" name="printNameStep1">Учреждение</span>'+
'		<span class="print_hint" id="print_step_1_social_institution"></span>'+
'<br/>';

text_html+='<div id="requestParametersUni"></div>';
text_html+='<textarea id="isPortal" style="display:none;">false</textarea>';



if ($("#reference_number").val() != "")
{
text_html+=
(
  $("#reference_number").val() == "" ? "":'		<span class="print_title">ЗАЯВЛЕНИЕ N&nbsp;<span class="print_text" id ="print_reference_number"></span>&nbsp;от&nbsp;<span class="print_text" id="print_date_reference_number"></span></span>')+
  '		<span class="print_hint">о предоставлении государственной (муниципальной) услуги</span>';
}  
text_html+='		<span class="print_label">Наименование услуги&nbsp;<span class="print_text" id="print_name_serv"></span></span>'+		
( $("#step_1_subservices").val()=="" ? "":'		<span class="print_label">Подуслуга&nbsp;<span class="print_text" id="print_sub_serv"></span></span>');


text_html+=
'		<span class="print_label">Категория получателя&nbsp;<span class="print_text" id="print_cat_recipient"></span></span>';

if (lst_steps.indexOf("2")>=0 || lst_steps.indexOf("3")>=0)
{
  text_html+='<span class="print_label">Категория законного представителя&nbsp;'+'<span class="print_text" id="print_step_1_category_legal_representative"></span></span>';
}
text_html+='		<br/>';



if (lst_steps.indexOf("2")>=0)
{
text_html+=
'   <!-- 2 -->'+				
'		<span class="print_title" id="print_2_title">Сведения о законном представителе (ФЛ)&nbsp;</span>'+	
'		<br/>'+
'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_2_last_name_legal_representative"></span></span>'+
'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_2_birthday_legal_representative"></span></span>'+
'       <span class="print_label">Данные документа, удостоверяющего личность&nbsp;<span class="print_text" id="print_step_2_legal_representative"></span></span>'+
'       <span class="print_label">Адрес регистрации&nbsp;<span class="print_text" id="print_step_2_reg_adr"></span></span>'+		
'       <span class="print_label">Данные документа, удостоверяющего полномочия&nbsp;<span class="print_text" id="print_step_2_name_doc"></span></span>'+		
'		<br/>';
}


if (lst_steps.indexOf("3")>=0)
{
text_html+=
'	<!-- 3 -->'+				
'		<span class="print_title"  id="print_3_title">Сведения о законном представителе (ЮЛ)</span>'+		
'		<br/>'+
'	    <span class="print_label" >Полное наименование организации&nbsp;<span class="print_text" id="print_step_3_full_name_org"></span></span>'+
'		<span class="print_label" >Сокращенное наименование организации&nbsp;<span class="print_text" id="print_step_3_reduced_name_org"></span></span>'+
'		<span class="print_label" >Юридический адрес организации&nbsp;<span class="print_text" id="print_step_3_legal_address_org"></span></span>'+
'		<span class="print_label" >Фактический адрес организации&nbsp;<span class="print_text" id="print_step_3_identity_org_reg"></span></span>'+
'		<span class="print_label">ИНН&nbsp;<span class="print_text" id="print_step_3_juridical_inn"></span></span>'+
'		<span class="print_label">КПП&nbsp;<span class="print_text" id="print_step_3_juridical_kpp"></span></span>'+
'		<span class="print_label">ОГРН&nbsp;<span class="print_text" id="print_step_3_juridical_ogrn"></span></span>'+
'		<span class="print_label">Сведения об уполномоченном лице&nbsp;</span>'+
'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_3_fio_org"></span></span>'+
'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_3_birth_date_org"></span></span>'+
'		<span class="print_label">Должность&nbsp;<span class="print_text" id="print_step_3_pozition_manager"></span></span>'+
'		<span class="print_label">Данные документы, удостоверяющего личность&nbsp;<span class="print_text" id="print_step_3_document_type_org"></span></span>'+
'		<span class="print_label">Данные документы, удостоверяющего полномочия законного представителя&nbsp;<span class="print_text" id="print_step_3_name_doc"></span></span>'+		
'		<br/>';
}


if (lst_steps.indexOf("4")>=0)
{
text_html+=
'    <!-- 4 -->'+
'		<span class="print_title" id="print_4_title">Сведения о правообладателе (ФЛ)</span>'+
'		<br/>'+
'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_4_fio_declarant"></span></span>'+
'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_4_birthday_declarant"></span></span>'+
'		<span class="print_label">Данные документы, удостоверяющего личность&nbsp;<span class="print_text" id="print_step_4_doc_declarant_type"></span></span>'+
'		<span class="print_label">Адрес регистрации&nbsp;<span class="print_text" id="print_step_4_address_declarant_postal"></span></span>'+
'		<br/>';
}

if (lst_steps.indexOf("6")>=0)
{
text_html+=
'    <!-- 6 -->'+		
'		<span class="print_title"  id="print_6_title">Сведения о правообладателе (ЮЛ)</span>'+
'		<br/>'+
'	    <span class="print_label">Полное наименование организации&nbsp;<span class="print_text" id="print_step_6_full_name_org"></span></span>'+
'		<br/>'+
'		<span class="print_label">Сокращенное наименование организации&nbsp;<span class="print_text" id="print_step_6_reduced_name_org"></span></span>'+
'		<span class="print_label">Юридический адрес организации&nbsp;<span class="print_text" id="print_step_6_legal_address_org"></span></span>'+
'		<span class="print_label">Фактический адрес организации&nbsp;<span class="print_text" id="print_step_6_identity_org_reg"></span></span>'+
'		<span class="print_label">ИНН&nbsp;<span class="print_text" id="print_step_6_juridical_inn"></span></span>'+
'		<span class="print_label">КПП&nbsp;<span class="print_text" id="print_step_6_juridical_kpp"></span></span>'+
'		<span class="print_label">ОГРН&nbsp;<span class="print_text" id="print_step_6_juridical_ogrn"></span></span>'+
'		<span class="print_label">Сведения об уполномоченном лице:</span>'+
'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_6_fio_org"></span></span>'+
'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_6_birth_date_org"></span></span>'+
'		<span class="print_label">Должность&nbsp;<span class="print_text" id="print_step_6_pozition_manager"></span></span>'+
'		<span class="print_label">Данные документы, удостоверяющего личность&nbsp;<span class="print_text" id="print_step_6_document_type_org"></span></span>'+		
'		<br/>';
}

if (lst_steps.indexOf("5")>=0)
{
text_html+=
'    <!-- 5 -->'+	
'		<span class="print_title" id="print_5_title">Сведения о правообладателе (ИП)</span>'+
'		<br/>'+
'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_5_fio_declarant"></span></span>'+
'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_5_birthday_declarant"></span></span>'+
'		<span class="print_label">Данные документы, удостоверяющего личность&nbsp;<span class="print_text" id="print_step_5_doc_declarant"></span></span>'+
'		<span class="print_label">Адрес регистрации&nbsp;<span class="print_text" id="print_step_5_address_declarant_postal"></span></span>'+
'		<span class="print_label">ИНН&nbsp;<span class="print_text" id="print_step_5_INN"></span></span>'+
'		<span class="print_label">ОГРНИП&nbsp;<span class="print_text" id="print_step_5_OGRNIP"></span></span>'+
'		<br/>';
}



if (lst_steps.indexOf("7")>=0)
{
text_html+=
'	<!-- 7 -->'+
'		<span class="print_title"  id="print_7_title">Сведения о лице, на основании данных которого оказывается услуга</span>'+
'		<br/>'+
'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_7_fio_people"></span></span>'+
'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_7_birthday_people"></span></span>';
'		<span class="print_label">Степень родства&nbsp;<span class="print_text" id="print_step_7_relation_degree">></span></span>';
//'		<span class="print_label">Наличие иждивения&nbsp;<span class="print_text" id="print_step_7_is_dependency"></span></span>';

text_html+='<span class="step_7_print_block print_label">Данные документа, удостоверяющего личность&nbsp;</span>'+
'<span id="print7_doc_after"><span class="print7_doc_clone print_text"><span class="print_text" name="print7_doc"></span></span></span>';

text_html+='		<span class="print_label">Адрес регистрации&nbsp;<span class="print_text" id="print_step_7_people_address_v"></span></span>'+
'		<br/>';
}

if (lst_steps.indexOf("12")>=0)
{

var tmp = $("#step_12_msp").val();	
if (tmp != "" && tmp != null && tmp !="null")
{

text_html+=
'	<!-- 12 -->'+
'		<span class="print_title"  id="print_12_title">Сведения о членах семьи правообладателя для предоставления государственной услуги</span>'+
'		<br/>'+
'		<table border="1" id="printTable12">'+
'			<tbody>'+
'			<tr>'+
'				<td align="center">'+
'					<span class="print_tlabel">N п/п</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Фамилия, имя, отчество</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Дата рождения</span>'+
'				</td>'+				
'			</tr>'+
'			<tr class="print_step_12_clone_block">'+
'				<td align="center">'+
'					<span class="print_step_12_num_pp print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_12_fio print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_12_birthday print_text"></span>'+
'				</td>'+				
'			</tr>'+
'			</tbody>'+
'		</table>'+	
'		<br/>';
}

}

if (lst_steps.indexOf("13")>=0)
{
text_html+=
'	<!-- 13 -->'+
'		<span class="print_title" id="print_13_title"  id="titStep13">Сведения о членах семьи для расчета СДД (среднедушевой доход), зарегистрированных по адресу регистрации правообладающего лица</span>'+
'		<br/>'+
'		<table border="1" id="printTable13">'+
'			<tbody>'+
'			<tr>'+
'				<td align="center">'+
'					<span class="print_tlabel">N п/п</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Фамилия, имя, отчество</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Дата рождения</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Степень родства</span>'+
'				</td>'+				
//'				<td align="center">'+
//'					<span class="print_tlabel">Наличие иждивения</span>'+
//'				</td>'+
'			</tr>'+
'			<tr class="print_step_13_clone_block">'+
'				<td align="center">'+
'					<span class="print_step_13_num_pp print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_13_fio print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_13_birthday print_text"></span>'+
'				</td>'+				
'				<td align="center">'+
'					<span class="print_step_13_relationdegree print_text"></span>'+
'				</td>'+				
//'				<td align="center">'+
//'					<span class="print_step_13_dependents print_text"></span>'+
//'				</td>'+
'			</tr>'+
'			</tbody>'+
'		</table>'+	
'		<br/>';
}

if (lst_steps.indexOf("14")>=0)
{
text_html+=
'	<!-- 14 -->'+
'		<span class="print_title" id="print_14_title">Сведения о членах семьи для расчета СДД (среднедушевой доход), не зарегистрированных по адресу регистрации правообладающего лица</span>'+
'		<br/>'+
'		<table border="1" id="printTable14">'+
'			<tbody>'+
'			<tr>'+
'				<td align="center">'+
'					<span class="print_tlabel">N п/п</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Фамилия, имя, отчество</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Дата рождения</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Степень родства</span>'+
'				</td>'+				
//'				<td align="center">'+
//'					<span class="print_tlabel">Наличие иждивения</span>'+
//'				</td>'+
'			</tr>'+
'			<tr class="print_step_14_clone_block">'+
'				<td align="center">'+
'					<span class="print_step_14_num_pp print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_14_fio print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_14_birthday print_text"></span>'+
'				</td>'+				
'				<td align="center">'+
'					<span class="print_step_14_relationdegree print_text"></span>'+
'				</td>'+				
//'				<td align="center">'+
//'					<span class="print_step_14_dependents print_text"></span>'+
//'				</td>'+
'			</tr>'+
'			</tbody>'+
'		</table>'+	
'		<br/>';
}

if (lst_steps.indexOf("15")>=0)
{   

text_html+=
'		<!-- 15 -->'+
'		<span class="print_title" id="print_15_title">Сведения о доходах всех членов семьи правообладателя за XX месяца(ев), предшествующих месяцу подачи заявления</span>'+
'		<br/>'+
'		<table border="1" id="printTable15">'+
'			<tbody>'+
'			<tr>'+
'				<td align="center">'+
'					<span class="print_tlabel">N п/п</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Фамилия, имя, отчество</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Дата рождения</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Месяц</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Год</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Вид дохода</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Сумма дохода</span>'+
'				</td>'+
'			</tr>'+
'			<tr class="print_step_15_clone_block">'+
'				<td align="center">'+
'					<span class="print_step_15_num_pp print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_15_fio print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_15_birthday print_text"></span>'+
'				</td>'+				
'				<td align="center">'+
'					<span class="print_step_15_month print_text"></span>'+
'				</td>'+				
'				<td align="center">'+
'					<span class="print_step_15_year print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_15_type print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_15_amount print_text"></span>'+
'				</td>'+
'			</tr>'+
'			</tbody>'+
'		</table>'+
'		<br/>';

}

if (lst_steps.indexOf("11")>=0)
{
text_html+=
'		<!-- 11 -->'+
'		<span class="print_title" id="print_11_title">Сведения об адресе предоставления услуги</span>'+
'		<br/>'+
'		<span class="print_label" id="print_step_11_render_address_type_system"></span><span class="print_text" id="print_step_11_index_pu"></span>'+
'<br/>';
}


if (lst_steps.indexOf("8")>=0)
{
	text_html+=
	'<br/>'+
	'		<!-- 8 -->'+
	'		<span class="print_title" id="print_8_title">Сведения о почтовых (банковских) реквизитах (ФЛ)</span>'+
	'		<br/>'+
	'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_8_fio_recept"></span></span>'+
	'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_8_birthday_recept" ></span></span>'+
	'<br/>';	

	if ($("#step_8_payment_type").val()=="Почта") 
	{
		text_html+=		
		'		<span class="print_subTitle">Почтовые реквизиты</span>'+		
		'		<br/>'+				
		'		<span class="print_label">Номер почтового отделения&nbsp;<span class="print_text"  id="print_step_8_postal_number_system"></span></span>'+
		'		<span class="print_label">Адрес&nbsp;<span class="print_text"  id="print_step_8_postal_address_v"></span></span>';
	}	
	else
	{
	 text_html+='</span></span>'+	 
	 '		<span class="print_subTitle" id="svevBankRekv">Банковские реквизиты</span>'+ 	 
	 '		<br/>'+			 
	 '		<span class="print_label">Наименование банка&nbsp;<span class="print_text" id="print_step_8_bank_name_system"></span></span>'+
	 '		<span class="print_label">Наименование подразделения банка&nbsp;<span class="print_text" id="print_step_8_bank_subdivision_system"></span></span>'+
	 '		<span class="print_label">Номер лицевого счета&nbsp;<span class="print_text" id="print_step_8_bank_account_system"></span></span>';
	}

}

if (lst_steps.indexOf("10")>=0)
{
text_html+=
'		<!-- 10 -->'+
'		<span class="print_title" id="print_10_title">Сведения о выплатных реквизитах (ЮЛ)</span>'+
'		<br/>'+
'		<span class="print_label">Полное наименование организации&nbsp;<span class="print_text" id="print_step_10_full_name_org_akcept"></span></span>'+
'		<br/>'+
'		<span class="print_subTitle">Банковские реквизиты</span>'+
'		<br/>'+
'		<span class="print_label">Наименование банка&nbsp;<span class="print_text" id="print_step_10_bank_name_system"></span></span>'+
'		<span class="print_label">Наименование подразделения банка&nbsp;<span class="print_text" id="print_step_10_bank_subdivision_system"></span></span>'+
'		<span class="print_label">Номер лицевого счета&nbsp;<span class="print_text" id="print_step_10_bank_account_system"></span></span>'+
'		<span class="print_label">Номер К/С&nbsp;<span class="print_text" id="print_step_10_number_cor_account"></span></span>'+
'		<span class="print_label">Номер Бик&nbsp;<span class="print_text" id="print_step_10_bik"></span></span>'+
'		<br/>';
}

if (lst_steps.indexOf("9")>=0)
{
text_html+=
'		<!-- 9 -->'+
'		<span class="print_title" id="print_9_title">Сведения о выплатных реквизитах (ИП)</span>'+
'		<br/>'+
'		<span class="print_label">ФИО&nbsp;<span class="print_text" id="print_step_9_fio_recept"></span></span>'+
'		<span class="print_label">Дата рождения&nbsp;<span class="print_text" id="print_step_9_birthday_recept"></span></span>'+
'		<br/>'+
'		<span class="print_label">Банковские реквизиты&nbsp;</span>'+
'		<br/>'+
'		<span class="print_label">Наименование банка&nbsp;<span class="print_text" id="print_step_9_bank_name_system"></span></span>'+
'		<span class="print_label">Наименование подразделения банка&nbsp;<span class="print_text" id="print_step_9_bank_subdivision_system"></span></span>'+
'		<span class="print_label">Номер лицевого счета&nbsp;<span class="print_text" id="print_step_9_bank_account_system"></span></span>'+
'		<br/>';
}

if (lst_steps.indexOf("18")>=0)
{
text_html+=			
'		<!-- 18 -->'+
'		<span class="print_title" id="print_18_title">Перечень документов подтвержденных заявителем</span>'+
'		<br/>'+
'		<table border="1" id="print18_table">'+
'			<tbody>'+
'			<tr>'+
'				<td align="center">'+
'					<span class="print_tlabel">N п/п</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Наименование документа</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Реквизиты документа</span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_tlabel">Фамилия Имя Отчество</span>'+
'				</td>'+
'			</tr>'+
'			<tr class="print_step_18_clone_block">'+
'				<td align="center">'+
'					<span class="print_step_18_num_pp print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_18_name_doc print_text"></span>'+
'				</td>'+
'				<td align="center">'+
'					<span class="print_step_18_rekvizit print_text"></span>'+
'				</td>'+				
'				<td align="center">'+
'					<span class="print_step_18_fio print_text"></span>'+
'				</td>'+
'			</tr>'+
'			</tbody>'+
'		</table>'+	
'		<br/>';
}



if (lst_steps.indexOf("16")>=0)
{
  

  $("#step_16_name_info").val("");
  var tmp = $("#step_16_ir").val();
  
  tmp = jsonParse(16,tmp);
  
  if (tmp != "" && tmp!=null && tmp !="null")
  {
    var arrObjectMembers = [ "infRequest[].reqParams[].reqParam.name", "infRequest[].name", "infRequest[].group.name"];		
    var result = validObjectMembers(tmp, arrObjectMembers);	
	
	  var count0 = result.infRequest.length;	
	  
	  text_html+=
	  '		<!-- 16 -->'+
	  '		<span class="print_title" id="print_16_title">Дополнительные сведения</span>'+
	  '		<br/>'+
	  '		<table border="1">'+
	  '			<tbody>';
	  
	  for (var i=0; i<count0; i++)
	  {	
		
		text_html+=
		'			<tr>'+
		'				<td align="left">'+
		'					<span class="print_step_16_group print_title" id="print_group_16_info_'+i+'"></span>'+
		'				</td>'+			
		'			</tr>';			
		
		text_html+=
		'			<tr>'+
		'				<td align="left">'+
		'					<span class="print_step_16_group1 print_title" id="print_group1_16_info_'+i+'"></span>'+
		'				</td>'+			
		'			</tr>';
		
	    var count_1 = result.infRequest[i].reqParams.length;	
	    for (var j=0; j<count_1; j++)
	    {
	      if (result.infRequest[i].reqParams[j].reqParam!=null)
		  {
			var count_2=result.infRequest[i].reqParams[j].reqParam.length;
			for (var k=0; k<count_2; k++)
			{
			 
			text_html+=
			'			<tr class="print_step_16_clone_block">'+
			'				<td align="left">'+
			'					<span class="print_step_16_info print_text" id="print_step_16_info_'+(i*count_1+j)*count_2+k+'"></span>'+			
			'				</td>'+
			'			</tr>';
			}  
		  }  
	    }	
	  }
	text_html+=
	'			</tbody>'+
	'		</table>'+
	'		<br/>';	  
  }  
}


if (lst_steps.indexOf("17")>=0)
{
    var tmp = $("#step_17_ir").val();
	
	tmp = jsonParse(17,tmp);
	
if (tmp != "" && tmp!=null && tmp !="null")
{	
    var arrObjectMembers = 
	[ "information[].data[].params.param[].name"];
	
    result = validObjectMembers(tmp, arrObjectMembers);
   
	var count = result.information.length;
	for (var i=0; i < count; i++) 
	{
text_html+=
'    <!-- 17 -->'+
(i==0 ? '		<span class="print_title" name="printNameStep17" id="print_17_title">Запрашиваемые сведения</span>':"")+
//'		<span class="print_title" name="printNameStep17" id="print_17_title">Запрашиваемые сведения</span>'+
'		<br/>'+
'		<table border="1" class="print_step_17_clone_block_1" id="t_print17">'+
'			<tbody>';

		var count_2 = result.information[i].data.length;
		for (var j=0; j < count_2; j++) 
		{				
text_html+='			<tr>'+
'				<td align="left" colspan="3">' +
'				<span class="print_step_17_name_group_info print_title" id="print_step_17_name_group_info_'+((i*count_2)+j)+'"></span>' +
'				</td>'+
'			</tr>'+
'			<tr class="print_step_17_clone_block_2" id="print_step_17_clone_block2">'+
'				<td align="left" colspan="3">'+
'					<span class="print_step_17_name_info print_title" id="print_step_17_name_info_'+((i*count_2)+j)+'"></span>'+
'				</td>';

			count_3 = result.information[i].data[j].params.param.length;			
			for (var k=0; k<count_3; k++)
			{		
				
text_html+=		
'			<tr class="print_step_17_clone_block_2" id="print_step_17_clone_block2">'+
'				<td align="left" colspan="2">'+
'				<span class="print_step_17_name_rekvizit_info print_title" id="print_step_17_name_rekvizit_info_'+((i*count_2+j)*count_3+k)+'">'+result.information[i].data[j].params.param[k].name+'</span>'+    
'				</td>'+
'				<td align="left">'+
'					<span class="print_step_17_rekvizit_info print_text" id="print_step_17_rekvizit_info_'+((i*count_2+j)*count_3+k)+'">'+result.information[i].data[j].params.param[k].value+'</span>'+
'				</td>'+
'			</tr>';	



			}
text_html+=	
'			</tr>';		
	}	
text_html+='</tbody>'+
'		</table>'+
'		<br/>';
}

}

//text_html+='</fieldset>';
}




function to_print_step_18() {
    var tmp = $("#confirmedDocs").val();
	
	tmp = jsonParse(18,'{"document":'+tmp+'}');
	
	if (tmp == "" || tmp==null || tmp =="null") 
	{
	  $("#tab_18").hide();
	  return;
	}  
    //var result = JSON.parse(tmp);    	
	
    var arrObjectMembers = 
	[ "document[].number",
	"document[].rekvDocument",
	"document[].name",
	"document[].series",
	"document[].dateIssue",
	"document[].fio"	
	];		
    var result = validObjectMembers(tmp, arrObjectMembers);	
	
	
	//if (typeof(result.document)=="undefined") {result.document=result;}
    var count = result.document.length;
	var op = true;
	
	var countDoc=0;
	
    for (i=0; i < count; i++) 
    {	
	var isAccept = ( (result.document[i].number!=null && result.document[i].number!='') || (result.document[i].rekvDocument!=null && result.document[i].rekvDocument!='') ? true:false);
	
	if (isAccept)
	{	
        countDoc ++;	
		$(".print_step_18_clone_block:last").after($(".print_step_18_clone_block:first").clone());
		$(".print_step_18_num_pp:last").text(i+1);
		$(".print_step_18_name_doc:last").text(tu(result.document[i].name));
		$(".print_step_18_rekvizit:last").text(tu(result.document[i].series) +" "+ tu(result.document[i].number) +" выдан(о) "+ tu(result.document[i].dateIssue));
		$(".print_step_18_fio:last").text(result.document[i].fio);		
	}
	}
    $(".print_step_18_clone_block:first").remove(); 
	
	if (countDoc==0)
	{
	  //$("#print_18_title").text("");
	  //$("#print18_table").hide();
	  $("#print_18_title").remove("");
	  $("#print18_table").remove();
	}
}


$("#fieldset_tab_30").html(text_html);
getDataRequest();




newPrintStatic();

if (lst_steps.indexOf("7")>=0)  {newPrint7();}
if (lst_steps.indexOf("12")>=0) {newPrint12();}
if (lst_steps.indexOf("13")>=0) {newPrint13();}
if (lst_steps.indexOf("14")>=0) {newPrint14();}
if (lst_steps.indexOf("15")>=0) {newPrint15();}
if (lst_steps.indexOf("16")>=0) {newPrint16();}
if (lst_steps.indexOf("17")>=0) {newPrint17();}
if (lst_steps.indexOf("18")>=0) {to_print_step_18();}


$("#btnOutToPrint").val("Печать");
  
  	
  if ($("#step_8_payment_type").val()=="Почта") 
  {$("#step_8_info_4").hide();}
  else {$("#step_8_info_3").hide();}
  

  if (lst_steps.indexOf('2')>=0)
  {  
    $("#tab_2").find("#category_legal_representative").text('Законный представитель: '+$("#step_1_category_legal_representative").val() );
  }else
  {
    //if($("#step_1_category_legal_representative").val()!="правообладатель"){
	  $("#tab_3").find("#category_legal_representative").text('Законный представитель: '+ $("#step_1_category_legal_representative").val());	 
	//}
  }
	
	  var aFields=["step_4_doc_declarant_type", "step_4_doc_declarant_series","step_4_doc_declarant_number","step_4_doc_declarant_date","step_4_doc_declarant_org"];
	  hideEmptyFieldset(aFields,'fieldset');	
	  
	  aFields=["step_7_people_address_v", "step_7_people_region_v", "step_7_people_district_v", "step_7_people_city_v", "step_7_people_settement_v", "step_7_people_street_v", "step_7_people_house_v", "step_7_people_housing_v", 
	  "step_7_people_building_v", "step_7_people_flat_v", "step_7_people_room_v"];
	  hideEmptyFieldset(aFields,'fieldset');
	  
	  if ($("#step_1_subservices").val()=="") {$("#step_1_subservices").hide(); $("#step_1_subservices").parent().parent().hide(); }

	 //Если номер заявки заблокирован, значит заявка зарегистрирована - то есть этап ожидания и выше
	if ($("#reference_number").attr("disabled"))
	{	  
	  // Этап ожидания	  
	  if ($("#idCurrentForm").text()=="3") 
	  {
	    switchStateDateTimePicker(false);	
	    execution_fromJson(false);		
		switchStateDateTimePicker(true);
	  }
	  // После ожидания
	  else
	  {
	    switchStateDateTimePicker(false);	
	    execution_fromJson(true);
		switchStateDateTimePicker(true);
	    $("#comment_doc").attr("disabled",true);
		$("#add_mv").hide();
		$("#add").hide();
	  }	  
    }
	// Этап до регистрации (Портал - личный кабинет
	else
	{	  
	  if ( $("#isPortal").text()=="true")
	  {
	    //Находимся на портале в ЛК
	    show19();
	  }	
	}	
	
	if ( $("#isPortal").text()=="true")
	{
		//Находимся на портале в ЛК
		
		$("input").each(function () 
		{
		  if (!$(this).attr("disabled")) 
		  {
		    if ($(this).attr("type") == "button") 
			{
			  if ( $(this).attr("id") != "switch_tab_30" && $(this).attr("id")!="switch_tab_0" && $(this).attr("id")!="switch_tab_20"  ) // $(this).val()!="Свернуть" $(this).val()!="+" $(this).val()!="-" )
		      {
			    $(this).attr("disabled",true);
			  }	
			}  
			else
			{
			  $(this).attr("disabled",true);
			}
		  }  
		});
		
		$("textarea").each(function () 
		{
		  if (!$(this).attr("disabled")) 
		  {		    
		    {$(this).attr("disabled",true);}
		  }  
		});
		
		
	}
	
	
	
	showstyle();  
	
	step_18_fromJson();		
	
	
	$(".datepicker").each(function () 
	{
	  if ($(this).attr("disabled")) $(this).parent().find(".ui-datepicker-trigger").hide();
	  else $(this).parent().find(".ui-datepicker-trigger").show();	  
	});
	
	
	/*

	if ( $("#idCurrentForm").text()!="2" ) // "Регистрация"
	{  
	  $("#date_reference_number").parent().find(".ui-datepicker-trigger").hide();
	}

	if ($("#idCurrentForm").text()!="5" && $("#idCurrentForm").text()!="6")
	{
	  $("#date_registration_solutions_p_1").parent().find(".ui-datepicker-trigger").hide();  
	}
	
	if ($("#date_reference_number").attr("disabled"))
	{
	  $("#date_reference_number").parent().find(".ui-datepicker-trigger").hide();  
	}
	

    
	
	if ($("#date_receipt_l_y").attr("disabled"))
	{
	  $("#date_receipt_l_y").parent().find(".ui-datepicker-trigger").hide();  
	}
	
	if ($("#date_request_mv_t").attr("disabled"))
	{
	  $("#date_request_mv_t").parent().find(".ui-datepicker-trigger").hide();  
	}
	*/

// Плавающая высота textarea	
formatTextarea();

$("input").each(function () 
{
  $(this).removeAttr("error");
});


changeStepNames();

$("#reference_number").parent().parent().parent().parent().parent().parent().css({'width':'80%'});


function show19() {			
	var el1=$("#printNameStep1").clone();
	$("#registrationForm").append(el1);
	$("[name='printNameStep1']:last").text("Документы, которые необходимо принести лично");

	var el1=$("br:last").clone();
	$("#registrationForm").append(el1);	
	
		var json = $("#step_wait_nd").val();	
        json = jsonParse("регистрация",'{"document":'+json+'}');
		
		if(json==null || json=="")return;		
		
    var arrObjectMembers = 
	[ 	"document[].privateStorage",
		"document[].number",
		"document[].rekvDocument",
		"document[].name",
		"document[].fio",
		"document[].isAdded",
		"document[].rekvDocument"
	];		
    var result = validObjectMembers(json, arrObjectMembers);	
		
		
		//constraintArray(result, ["code","fio","series","number","dateIssue","privateStorage","hasDocument","dateOfRecipt","hasRequest","reqNumber","sendDate","isAdded","rekvDocument"]);
		//constraintArray(result.document, ["name","fio"],[""]);
		var fullListName = ["code","fio","series","number","dateIssue","privateStorage","hasDocument","dateOfRecipt","hasRequest","reqNumber","sendDate","isAdded","rekvDocument"];
		constraintArray(result.document, ["name","fio"], ["arrObj[i].isAdded==true", "(arrObj[i].number!=null && arrObj[i].number!='')  || (arrObj[i].rekvDocument!=null && arrObj[i].rekvDocument!='')==true"],fullListName);		
		
		var count = result.document.length;				
		
		var indDoc=0;
		for (var i=0; i < count; i++) 
		{		    
		    if (result.document[i]!=null) 
			{			    
				var isNotMV = result.document[i].privateStorage;
				var isAccept = ( (result.document[i].number!=null && result.document[i].number!='')  || (result.document[i].rekvDocument!=null && result.document[i].rekvDocument!='') ? true:false);				
				
				if (isNotMV)
				{						
					if (!isAccept)
					{						  
						indDoc++; // есть документы помимо подтвержденных лично которые надо принести
						break;
					}
				}
			}
		}	
		
		var nameDoc1="";
		var fio1="";

		
		if (indDoc>0)
		{
		  if ($("#step_4_doc_declarant_type").val().trim() != "")
		  {
		    nameDoc1 = $("#step_4_doc_declarant_type").val();
			fio1 = $("#step_4_last_name_declarant").val()+" "+$("#step_4_first_name_declarant").val().substring(0,1)+". "+$("#step_4_middle_name_declarant").val().substring(0,1)+".";
		  }
		  
		  if  (nameDoc1 != "")
		  {
			var el2=$(".print_text:first").clone();
			el2.css({'display':'block'});				  
			$("#registrationForm").append(el2);
			el2.text(nameDoc1+" ( "+fio1+" )" );		  
		  }
		  
		}
		
		
		for (var i=0; i < count; i++) 
		{		    
		    if (result.document[i]!=null) 
			{			    
				var isNotMV = result.document[i].privateStorage;				
				var isAccept = ( (result.document[i].number!=null && result.document[i].number!='')  || (result.document[i].rekvDocument!=null && result.document[i].rekvDocument!='') ? true:false);				
				var fio = tu(result.document[i].fio);
					if (isNotMV)
					{												
						if (isAccept)
						{	
                           						
						  if (indDoc>0)
						  {
						    
							
							//  var el2=$(".print_text:first").clone();
							//  el2.css({'display':'block'});				  
							//  $("#registrationForm").append(el2);
							//  el2.text(result.document[i].name+(fio!="" ? " ( "+tu(result.document[i].fio)+" )":"") );
							
						  }
						  
						}
						else
						{			
						  if ((result.document[i].name.trim()!="") && !((result.document[i].name.trim()==nameDoc1) && (result.document[i].fio==fio1)) )
						  {
						    var el2=$(".print_text:first").clone();	
						    el2.css({'display':'block'});						
						    $("#registrationForm").append(el2);
						    el2.text(result.document[i].name+(fio!="" ? " ( "+tu(result.document[i].fio)+" )":"") );						  
						  }	
						}						
					}					
			}		
		}
	} // show19 ... end

    
	  
});  // jQuery ... end



function formatTextarea()
{  
  var stringLength;
  var stringHight;
  
  if ( $("#isPortal").val()=="true") 
  {stringLength = 105;
   stringHight=18;
  }
  else
  {stringLength = 113;
   stringHight=13;
  }
  $('textarea').each(function () 
  {    
	//var stringLength = Math.round($(this).width()/6.2);  
	//var stringLength = Math.round(703/6.2);  
	
    var l = $(this).val().length;
    if (l > stringLength) 
    {
      l = Math.round(((l/stringLength)+3)*stringHight);	
	  $(this).css({'height':l+'px'});		
    }  
    $(this).removeAttr("error");  		
});

}


	
	





	function step_18_fromJson () {

		var json = $("#confirmedDocs").val();		
		
		json = jsonParse("18",json);

		if (json=="" || json==null  || json =="null")
		{ 		  
		  $(".clone_block_1:first").remove();
		  $("#tab_18").remove();
		  return;
		}
			var result = json;			
			window.result = result;
			
			if (typeof(result.document)=="undefined") {result.document=result;}			
			var count = result.document.length;
			
			if (count ==0)
			{			
		  $(".clone_block_1:first").remove();
		  $("#tab_18").remove();
		  return;
			}
			

			for (i=0; i < count; i++) {	
			        if (typeof(result.document[i].number) == 'undefined') result.document[i].number='';
					if (typeof(result.document[i].rekvDocument) == 'undefined') result.document[i].rekvDocument='';
					if (typeof(result.document[i].name) == 'undefined') result.document[i].name='';					
					if (typeof(result.document[i].series) == 'undefined') result.document[i].series='';					
					if (typeof(result.document[i].dateIssue) == 'undefined') result.document[i].dateIssue='';					
					if (typeof(result.document[i].organization) == 'undefined') result.document[i].organization='';
			
					var isAccept = ( (result.document[i].number!=null && result.document[i].number!="") || (result.document[i].rekvDocument!=null && result.document[i].rekvDocument!="") ? true:false);	
					if (isAccept)
					{
						var el = $(".clone_block_1:first").clone();
						$("#tab_18").append(el);					
						
						el.find("input").each(function () 
						{
							$(this).attr("id", $(this).attr("name") + "_" + i);
						});
						
						el.find("textarea").each(function () {										
							$(this).attr("id", $(this).attr("name") + "_" + i);
						});
						
						el.find("#step_18_name_doc_"+ i).val(result.document[i].name);					
						el.find("#step_18_doc_series_doc_"+ i).val(result.document[i].series);
						el.find("#step_18_doc_number_doc_"+ i).val(result.document[i].number);
						el.find("#step_18_doc_issue_date_doc_"+ i).val(result.document[i].dateIssue);
						el.find("#step_18_doc_org_doc_"+ i).val(result.document[i].organization);					
					}
					//aFields=["step_18_doc_series_doc_"+i,"step_18_doc_number_doc_"+i,"step_18_doc_issue_date_doc_"+i,"step_18_doc_org_doc_"+i];
					//hideEmptyFieldset(aFields,'step_18_info_3[]');
					
					
			}			
		
		$(".clone_block_1:first").remove();
		if ($(".clone_block_1:first").length == 0) {$("#tab_18").remove();}
	}

/*
	function switchStateDateTimePicker(state){	  
	
	  var datepicker = $('.datepicker');
	  if(datepicker==null || datepicker.datepicker==null){
	    return; 
	  }
	  if(state==true){
	    datepicker.datepicker({ dateFormat: 'dd.mm.yy' });
	  }else{
	    datepicker.datepicker("destroy");
	  }
	}	
*/	
	
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
        	   datepicker.datepicker({ dateFormat: 'dd.mm.yy', showOn: "button", buttonImage: "https://gosuslugi.e-mordovia.ru/services/visPersonalData/js/calendar2.gif",
        	   buttonImageOnly: true, changeYear: true, changeMonth : true, yearRange: 'c-100:c+10' });
           	   $('.datepicker').unbind('change');
               $('.datepicker').change(function() {
                var selVal = new Date(toDate($('#step_2_birthday_legal_representative').val()))
                now = new Date();
                if (now < selVal){
                  errorMsg('Дата не может быть больше текущей!');
                  $(this).val('');
                  return false;
                }
            });
	     }else{
	       datepicker.datepicker("destroy");
	     }
	   }
	
	
	
	
	
	
	
	
	

	function tu(val)
	{	
    
	  if (val == 'undefined' || typeof(val)=='undefined')
	  {	    
	    return "";
	  }
	  else
	  {
	    return val.trim();
	  }	  
	}
	
	
	
    function hideEmptyFieldset(aFields,condParent)
	{
      var needHide = true;
      for (i=0; i<aFields.length; i++)
      {
         if (!($("#"+aFields[i]).val() =="" ||  typeof($("#"+aFields[i])) =="undefined" )) { needHide = false; }		 
      }	  
	  if ( needHide ) 
	  {		
		$("#"+aFields[0]).closest(condParent).remove();
	  }	
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
	 

	function switch_tab(step_ind,source)
	{     
	 switch_tab1(step_ind,source);
	} 

	
	function switch_tab1(step_ind,source)
	{	  
	  if (step_ind == 30 )
	  {
		  if (source.id == "switch_tab_0" && $("#idCurrentForm").text()!="0" && $("#idCurrentForm").text()!="2")
		  {			  
		  source.value = "Экранная форма заявления";
		  source.id="switch_tab_30";
		  $("#fieldset_tab_30").show();		  
		  $("#fieldset_tab_0").hide();
		  }
		  else
		  {
			  if (source.id == "switch_tab_30")
			  { 			  
				if ($("#idCurrentForm").text()=="0" || $("#idCurrentForm").text()=="2") // 'Исходный запрос' или "Регистрация"
				{
					source.value = "Печатная форма заявления";					
				}
				else
				{		      
					source.value = "Свернуть форму";			  					
				}			  
			    source.id="switch_tab_1";
				$("#fieldset_tab_30").hide();				  
				$("#fieldset_tab_0").show();						  
			  }
			  else
			  {			      
			      if ($("#idCurrentForm").text()=="0" || $("#idCurrentForm").text()=="2")
				  {
					source.id="switch_tab_30";
					$("#fieldset_tab_30").show();		  
					$("#fieldset_tab_0").hide();
					source.value = "Экранная форма заявления";							  
				  }
				  else
				  {
					  source.value = "Печатная форма заявления";
					  if (source.id == "switch_tab_1")
					  {	
					  source.id="switch_tab_0";
					  $("#fieldset_tab_30").hide();		  
					  $("#fieldset_tab_0").hide();
					  }
				  }
			  }		  
		  }		  
	  }
	  if (source.value == "-")
	  { 		    
		source.value = "+";			
		$("#fieldset_tab_"+step_ind).hide();		
		return;
	  }
	  if (source.value == "+")
	  {	
		source.value = "-"; 	  
		$("#fieldset_tab_"+step_ind).show();		
	  }	  
	}
	
	
	function getFreeIndex()
	{
		var i = -1;
		if ($(".clone_block_1w:visible").length > 0)
		{		
		  var tmpStr = $(".clone_block_1w:visible:last").find('input').attr('id');		
		  var pos = tmpStr.lastIndexOf('_');
		  i = tmpStr.substr(pos + 1);
		}  
		
		if ($(".clone_block_2w:visible").length > 0)
		{
		  tmpStr = $(".clone_block_2w:visible:last").find('input').attr('id');
		  pos = tmpStr.lastIndexOf('_');
		  if (parseInt(i) < parseInt(tmpStr.substr(pos + 1))) 
          {i=tmpStr.substr(pos + 1);}		
		}
		i++;		
		return i;	
	}

	
function execution_fromJson (viewOnly) {
        
		var json = $("#step_wait_nd").val();		
		json = jsonParse("Ожидание",json);
		
		if(json==null || json=="") return;
		var result = json;
		
		window.outputData = result;		
		if ( typeof(result.document)=="undefined") {result.document=result;}
		
		
		for (var i=0; i<result.document.length; i++)
		{
		  if (typeof(result.document[i].isAdded) == 'undefined') result.document[i].isAdded = false;		  
        }
		
		
		//Удаляем двойников:
		//constraintArray(result, ["code","fio","series","number","dateIssue","privateStorage","hasDocument","dateOfRecipt","hasRequest","reqNumber","sendDate","isAdded","rekvDocument"]);				
		//constraintArray(result, ["name","fio","series","number","dateIssue","privateStorage","hasDocument"]);		
		//constraintArray(result, ["name","fio"],[""]);								
		var fullListName = ["code","fio","series","number","dateIssue","privateStorage","hasDocument","dateOfRecipt","hasRequest","reqNumber","sendDate","isAdded","rekvDocument"];
		constraintArray(result, ["name","fio"], ["arrObj[i].isAdded==true", "(arrObj[i].number!=null && arrObj[i].number!='')  || (arrObj[i].rekvDocument!=null && arrObj[i].rekvDocument!='')==true"],fullListName);		
		
		var count = result.document.length;		
		
		for (i=0; i < count; i++) {			
		    
		    if (result.document[i]!=null) 
			{			
				var isNotMV = result.document[i].privateStorage;
				var isAccept = ( (result.document[i].number!=null && result.document[i].number!='')  || (result.document[i].rekvDocument!=null && result.document[i].rekvDocument!='') ? true:false);
				
			
				if (isNotMV) {
					
					if (result.document[i].name!="")
					{
				
					var el = $(".clone_block_1w:first").clone();
					$("#docsPrivate").append(el);
					el.find("input").each(function () {
						
						if ($(this).attr("type") == "button") {return;} 
						$(this).attr("id", $(this).attr("name") + "_" + i);
						if ($(this).attr("name")=="choice_trustee_rek") { $(this).attr("disabled", true);}
						$(this).attr("disabled", true);
					});			
					
					el.find("textarea").each(function () {            
						$(this).attr("id", $(this).attr("name") + "_" + i);
						$(this).attr("disabled", true);
						
						if ($(this).attr("name")!="rekv_document_2_y") 
						{  $(this).attr("disabled", true); //$(this).attr("required", true); 
						}
						else 
						{
						  if ( result.document[i].rekvDocument == null)
						  {						  
						   $("#rekv_document_2_y_"+ i).val(
						   (typeof(result.document[i].series)=='undefined' || result.document[i].series=='' ? "":"Серия: "+result.document[i].series)   +   
						   (typeof(result.document[i].number)=='undefined' || result.document[i].number=='' ? "":" Номер: "+result.document[i].number) +
						   (typeof(result.document[i].dateIssue)=='undefined' || result.document[i].dateIssue=='' ? "":" Дата выдачи: "+result.document[i].dateIssue)
						   );
						  }
						  else
						  {$("#rekv_document_2_y_"+ i).val(result.document[i].rekvDocument);}
						}					
					});

					$("#name_document_2_y_"+ i).val(result.document[i].name);
					
					if (result.document[i].hasDocument || viewOnly)  {					  					 
					  $("#date_receipt_l_y_"+ i).val(result.document[i].dateOfRecipt).attr("disabled",true);;
					}
					else
					{
					  $("#date_receipt_l_y_"+ i).val(result.document[i].dateOfRecipt);
					}
					
					if (result.document[i].hasDocument)  {					  
					  $("#mark_receipt_l_y_"+ i).attr("checked",true);					  
					}
					
					if (viewOnly) 
					{ 
					  $("#mark_receipt_l_y_"+ i).attr("disabled",true);					  
				    }
					else
					{ 
					  $("#mark_receipt_l_y_"+ i).attr("disabled",false);
					  //$("#date_receipt_l_y_"+ i).attr("disabled",false);
				    }					
					
					if(isAccept){				
					  
					  $("#choice_trustee_rek_"+ i).attr("checked",true);
					}
					$("#fio_document_2_y_"+ i).val(result.document[i].fio);
					
					if (viewOnly)
					{
					    $("#name_document_2_y_"+ i).attr("disabled", true);
						$("#rekv_document_2_y_"+ i).attr("disabled", true);
						$("#fio_document_2_y_"+ i).attr("disabled", true);						
						//$("textarea[name='name_document_2_y']:last").attr("disabled", true);
					    //$("textarea[name='rekv_document_2_y']:last").attr("disabled", true);
						//$("input[name='fio_document_2_y']:last").attr("disabled", true);						
					}					 
					
					if (!result.document[i].isAdded) 
					{
					    $("#name_document_2_y_"+ i).attr("disabled", true);
						$("#rekv_document_2_y_"+ i).attr("disabled", true);
						$("#fio_document_2_y_"+ i).attr("disabled", true);
						//$("textarea[name='name_document_2_y']:last").attr("disabled", true);
					    //$("textarea[name='rekv_document_2_y']:last").attr("disabled", true);
						//$("input[name='fio_document_2_y']:last").attr("disabled", true);						
					}
					else 
					{					 
					 $("#isAdded_"+ i).attr("checked",true);
					 
					 if (!viewOnly)
					 {
					     el.find(".btn_delete_step_18_reg_info").show();
						 $("#name_document_2_y_"+ i).attr("disabled", false);
						 $("#rekv_document_2_y_"+ i).attr("disabled", false);
						 $("#fio_document_2_y_"+ i).attr("disabled", false);
						 $("#mark_receipt_l_y_"+ i).attr("disabled", false);						 
						 if ( $("#mark_receipt_l_y_"+ i).attr("checked") )
						 { $("#date_receipt_l_y_"+ i).attr("disabled",false); }
					 }
					}
					

					if (result.document[i].hasDocument === false) {
					    if (!viewOnly)
						{
						  if ($("#mark_receipt_l_y_"+ i).attr("checked"))
						  //if ($("input[name='mark_receipt_l_y']:last").attr("checked"))
						  {
						   //$("input[name='date_receipt_l_y']:last").attr("disabled", false);
						   $("#date_receipt_l_y_"+i).attr("disabled", false);
						  }
						   //$("input[name='mark_receipt_l_y']:last").attr("disabled", false);
						   $("#mark_receipt_l_y_"+i).attr("disabled", false);
						}						
					}
					
					//if (!viewOnly)
					//{
					  testReguest($("#mark_receipt_l_y_"+i),viewOnly);
					//}  
	
					
					//$("#rekv_document_2_y_"+i).attr("required",true);					
					//$("#rekv_document_2_y_"+i).removeAttr("error");					
					/*
					if ( ($("#rekv_document_2_y_"+i).val() == "") && !viewOnly ) 
					{  
					  $("#rekv_document_2_y_"+i).attr("disabled",false);
					}					
					
					if ( $("#name_document_2_y_"+i).val() == "" && !viewOnly) 
					{
					  $("#name_document_2_y_"+i).attr("disabled",false);
					}
					
					if ( $("#fio_document_2_y_"+i).val() == "" && !viewOnly) 
					{
					  $("#fio_document_2_y_"+i).attr("disabled",false);
					}
					*/
					}
				} 
				else 
				{		
					if (result.document[i].name != "")
					{
				        var el = $(".clone_block_2w:first").clone();
						$("#docsMV").append(el);
						
						el.find("input").each(function () {            
							if ($(this).attr("type") == "button") {return;} 
							$(this).attr("id", $(this).attr("name") + "_" + i);
				            if(!result.document[i].isAdded) $(this).attr("disabled",true); 
						});									
						
						el.find("textarea").each(function () {            
							if ($(this).attr("type") == "button") {return;} 
							$(this).attr("id", $(this).attr("name") + "_" + i);
				            if(!result.document[i].isAdded) $(this).attr("disabled",true); 
						});
						

						$("#name_data_mv_t_"+ i).val(result.document[i].name);
						
						if(isAccept){
						  $("#choice_trustee_rek_"+ i).attr("checked",true);						  
						}			

						if (result.document[i].hasDocument) {
						  $("#mark_request_mv_t_"+ i).attr("checked",true);
						  $("#mark_request_mv_t_"+ i).attr("disabled",true);
						}
						
						$("#fio_document_3_y_"+ i).val(result.document[i].fio);
						
						if (result.document[i].hasRequest) 
						{
						  $("#mark_request_mv_t_"+ i).attr("checked",true).attr("disabled",true);
						  $("#date_receipt_mv_t_"+ i).val(result.document[i].dateOfRecipt);				  
						}
						
						
						if (!result.document[i].isAdded) {							  
						  $("#date_receipt_mv_t_"+ i).attr("disabled",true);				  
						  $("#number_reguest_mv_"+ i).attr("disabled",true);				  
						  $("#date_request_mv_t_"+ i).attr("disabled",true);				  
						}						
						else
						{						
						  $("#isAdded_"+ i).attr("checked",true);
						  if (!viewOnly)	
						  {$("#mark_request_mv_t_"+ i).attr("disabled",false);}
						  
						  
						  if (!$("#mark_request_mv_t_"+ i).attr("checked"))
						  {						  
						    $("#date_receipt_mv_t_"+ i).attr("disabled",true);
						    $("#number_reguest_mv_"+ i).attr("disabled",true);
						    $("#date_request_mv_t_"+ i).attr("disabled",true);							
						  }						  
						}
						
						if (typeof(result.document[i].reqNumber)!='undefined')
						{$("#number_reguest_mv_"+ i).val(result.document[i].reqNumber);}
						else
						{$("#number_reguest_mv_"+ i).val("");}
						
						
						$("#date_request_mv_t_"+ i).val(result.document[i].sendDate);
						if (result.document[i].isAdded && !viewOnly) {	
							el.find(".btn_delete_step_18_mv_info").show();
						}
						
						$(".clone_block_2w:last input[name='choice_trustee_rek']").attr("disabled", true);
						
						
						el.find("[name='mark_request_mv_t']").attr("disabled",false);						
						el.find("[name='choice_trustee_rek']").attr("disabled",true);
					
						//if (!viewOnly)
						//{
						testReguestMv(el.find("[name='mark_request_mv_t']"),viewOnly);
						//}
						
						/*
						if ( $("#name_data_mv_t_"+i).val() == "" && !viewOnly) 
						{
						  $("#name_data_mv_t_"+i).attr("disabled",false);
						}
						*/
						/*
						if ( $("#fio_document_3_y_"+i).val() == "" && !viewOnly) 
						{
						  $("#fio_document_3_y_"+i).attr("disabled",false);
						}
						*/
						
						if (viewOnly)
						{
						  $("#name_data_mv_t_"+i).attr("disabled",true);
						  $("#fio_document_3_y_"+i).attr("disabled",true);
						  $("#number_reguest_mv_"+i).attr("disabled",true);
						  $("#date_request_mv_t_"+i).attr("disabled",true);
						  $("#date_receipt_mv_t_"+i).attr("disabled",true);
						  $("#mark_request_mv_t_"+i).attr("disabled",true);
						}
						
						/*
						if (!viewOnly)
						{
						  if (  !$("#choice_trustee_rek_"+i).attr("checked") )
						  {							
							$("#name_data_mv_t_"+i).attr("disabled",flase));
						  }
						}
						*/
					}	
						
				}
				
				  
			}
		
		}
	    $(".clone_block_1w:first").hide();
	    $(".clone_block_2w:first").hide();

        formatTextarea();
	} // execution_fromJson ... end
	
	function hideRequest(block){
	    var request = $("#" + block + " #mark_request_mv_t");	
		if(!request.is('checked')){
		  $("#" + block + " #request").hide();
		}
	}
	
	
function needAddClone(aFields)
{
  var needAdd=false;
  for (var i=0; i<aFields.length; i++)
  {    
    if (aFields[i][1]!="")
	{
	  needAdd=true;
	  break
	}
  }
  return needAdd;
}

function addClone(etalonKeyType,etalonKey,parentId,ind,aFields)
{   
  if (etalonKeyType == "id")
  {
	etalonJqueryName = "#"+etalonKey;
  }
  else
  {
	etalonJqueryName = "."+etalonKey;
  }  
	
  var el_id=etalonKey+"_"+ind;

  var el = $(etalonJqueryName+":first").clone().attr("id",el_id).show();
  $("#"+parentId).append(el);
  
		  
  for (var i_f=0; i_f<aFields.length; i_f++)
  {  
	if (aFields[i_f][3]=='name')
	{	  	
	  
		if (aFields[i_f][2] == 'span')
		{	   
			el.find('[name="'+aFields[i_f][0]+'"]').text(aFields[i_f][1]);				
		}
		else
		{	   
		   el.find('[name="'+aFields[i_f][0]+'"]').val(aFields[i_f][1]);
		}	  
		el.find('[name="'+aFields[i_f][0]+'"]').attr('id',aFields[i_f][0]+"_"+ind);
		//el.find('[name="'+aFields[i_f][0]+'"]').attr('id',aFields[i_f][0]+"_"+ind+"_"+i_f);	  	  
	}
	else
	{
		if (aFields[i_f][2] == 'span')
		{	   
			//$("#"+el_id).find('.'+aFields[i_f][0]).text(aFields[i_f][1]);	
			el.find('.'+aFields[i_f][0]).text(aFields[i_f][1]);	
		}
		else
		{	   
		   //$("#"+el_id).find('.'+aFields[i_f][0]).val(aFields[i_f][1]);
		   el.find('.'+aFields[i_f][0]).val(aFields[i_f][1]);
		}	  
		$("#"+el_id).find('.'+aFields[i_f][0]).attr('id',aFields[i_f][0]+"_"+ind);		
		//$("#"+el_id).find('.'+aFields[i_f][0]).attr('id',aFields[i_f][0]+"_"+ind+"_"+i_f);		
	}

	/*
	if (aFields[i_f][2] == 'span')
	{	   
		$("#"+aFields[i_f][0]+"_"+ind+"_"+i_f).text(aFields[i_f][1]);	
	}
	else
	{	   
	   $("#"+aFields[i_f][0]+"_"+ind+"_"+i_f).val(aFields[i_f][1]);
	   
	   
	   
	   
      //if (parentId == "tab_12" && ind==0 && i_f==0 && aFields[i_f][0] =="step_12_last_name_declarant_mf")
	  //{      
	  //  alert($("#"+aFields[i_f][0]+"_"+ind+"_"+i_f).val());
	  //}
	   
	   
	}
	*/

  }	  

  return el;
} // addClone  ... end

function getDataRequest()
{
  
  var isPortal = $(".task-table tr:eq(1) td:eq(1)").text() != "Номер заявления:";  
  
  var aName = [["number",1,2], ["favourName",5,1], ["procedureName",6,1], ["organizationName",7,1], ["creationDate",4,1,0,10]];
  for (var i=0; i<aName.length; i++)
  {    
	if (!isPortal)
	{   
		
		if (typeof(aName[i][1]) != 'undefined') 
		{
		  if (typeof(aName[i][3]) != 'undefined') 
		  {
		    var el2 = $("span:first").clone();	
	        el2.attr("id",aName[i][0]);				  
		    el2.text($(".task-table tr:eq("+aName[i][1]+") td:eq("+aName[i][2]+")").text().substring(aName[i][3],aName[i][4]));
	        $("#requestParametersUni").append(el2);
		    el2.hide();	    			
		  }
		  else
		  {
		    var el2 = $("span:first").clone();	
	        el2.attr("id",aName[i][0]);				  		  
		    el2.text($(".task-table tr:eq("+aName[i][1]+") td:eq("+aName[i][2]+")").text());
	        $("#requestParametersUni").append(el2);
		    el2.hide();
		  }	
		}  		
	}
  } 
  
	if (isPortal)
	{
	    $("#isPortal").text("true"); 
        $("#isPortal").val("true"); 
	}
  
  
}


function newPrintStatic()
{ 

//var dataRequest = getDataRequest();
var cat_recipient = $("#step_1_category").val();

//$("#print_num_query").text(dataRequest.num_query);
$("#print_num_query").text($("#number").text());
$("#print_step_1_social_institution").text($("#step_1_social_institution").val());

if ($("#reference_number").val() != "") 
{
  $("#print_reference_number").text($("#reference_number").val());
  $("#print_date_reference_number").text($("#date_reference_number").val());
}  
  
//$("#print_name_serv").text(dataRequest.name_serv);
$("#print_name_serv").text($("#favourName").text());

  

//$("#print_sub_serv").text(dataRequest.sub_serv);
$("#print_sub_serv").text($("#procedureName").text());

$("#print_cat_recipient").text(cat_recipient);

// 2 or 3
if (lst_steps.indexOf("2")>=0 || lst_steps.indexOf("3")>=0) 
{
  $("#print_step_1_category_legal_representative").text($("#step_1_category_legal_representative").val());

	// 2
	if (lst_steps.indexOf("2")>=0)
	{  
	  
	  
	  $("#print_step_2_last_name_legal_representative").text($("#step_2_last_name_legal_representative").val()+' '+$("#step_2_first_name_legal_representative").val()+' '+$("#step_2_middle_name_legal_representative").val());	  
	  $("#print_step_2_birthday_legal_representative").text($("#step_2_birthday_legal_representative").val());	  
	  
	  //Уд.личность
	  var doc = formDoc(["step_2_doc_legal_representative_type","step_2_doc_legal_representative_series","step_2_doc_legal_representative_number","step_2_doc_legal_representative_date","step_2_doc_legal_representative_org"]);	  
	  
	  //Полномочия
	  var doc1 = formDoc(["step_2_name_doc","step_2_series_doc","step_2_number_doc","step_2_date_doc","step_2_org_doc"]);
	  
	  $("#print_step_2_legal_representative").text(doc);	  
	  $("#print_step_2_name_doc").text(doc1);	  
	  //Добавить адрес регистрации	  
	  var adr = formAddress(	["step_2_address_legal_representative_postal","step_2_address_legal_representative_region","step_2_address_legal_representative_f_district","step_2_address_legal_representative_city",
																"step_2_address_legal_representative_settlement","step_2_address_legal_representative_street","step_2_address_legal_representative_house","step_2_address_legal_representative_body",
  																"step_2_address_legal_representative_build","step_2_address_legal_representative_flat","step_2_address_legal_representative_room"])  
	  
	  
	  
	  $("#print_step_2_reg_adr").text(adr);
	  
	  
	  conditionShow([[ $("#step_2_birthday_legal_representative").val(), 											"#print_step_2_birthday_legal_representative", 	"#step_2_birthday_legal_representative", 			"tr" 		]]);	  
	  conditionShow([[ doc, 																						"#print_step_2_legal_representative",			"#step_2_doc_legal_representative_type", 			"fieldset" 	]]);	  
	  conditionShow([[ doc1, 																						"#print_step_2_name_doc", 						"#step_2_name_doc", 								"fieldset" 	]]);	  
	  conditionShow([[$("#step_2_series_doc").val() + $("#step_2_number_doc").val() +$("#step_2_date_doc").val(), 	"", 											"#step_2_series_doc",					 			"tr"		]]);
	  conditionShow([[$("#step_2_org_doc").val(), 																	"", 											"#step_2_org_doc",					 	 			"tr"		]]);
	  
      
	  
	  /*
	  conditionShowTr(	["step_2_address_legal_representative_postal",				"step_2_address_legal_representative_house"	]);	  
	  conditionShowTr(	["step_2_address_legal_representative_region",				"step_2_address_legal_representative_body"	]);
	  conditionShowTr(	["step_2_address_legal_representative_f_district",			"step_2_address_legal_representative_build"	]);
	  conditionShowTr(	["step_2_address_legal_representative_city",				"step_2_address_legal_representative_flat"	]);
	  conditionShowTr(	["step_2_address_legal_representative_settlement",			"step_2_address_legal_representative_room"	]);
	  conditionShow([[$("#step_2_address_legal_representative_street").val(),		"", 	"#step_2_address_legal_representative_street",		"td"		]]);	  	  
	  */
	  
	  /*
	  conditionShow([[$("#step_2_address_legal_representative_postal").val(),		"", 	"#step_2_address_legal_representative_postal",		"td", "o"	]]);	  
	  conditionShow([[$("#step_2_address_legal_representative_region").val(),		"", 	"#step_2_address_legal_representative_region",		"td", "o"	]]);
	  conditionShow([[$("#step_2_address_legal_representative_f_district").val(),	"", 	"#step_2_address_legal_representative_f_district",	"td", "o"	]]);
	  conditionShow([[$("#step_2_address_legal_representative_city").val(),			"", 	"#step_2_address_legal_representative_city",		"td", "o"	]]);
	  conditionShow([[$("#step_2_address_legal_representative_settlement").val(),	"", 	"#step_2_address_legal_representative_settlement",	"td", "o"	]]);
	  
	  conditionShow([[$("#step_2_address_legal_representative_house").val(),		"", 	"#step_2_address_legal_representative_house",		"td", 'p'	]]);	  
	  conditionShow([[$("#step_2_address_legal_representative_body").val(),			"", 	"#step_2_address_legal_representative_body",		"td", 'p'	]]);
	  conditionShow([[$("#step_2_address_legal_representative_build").val(),		"", 	"#step_2_address_legal_representative_build",		"td", 'p'	]]);
	  conditionShow([[$("#step_2_address_legal_representative_flat").val(),			"", 	"#step_2_address_legal_representative_flat",		"td", 'p'	]]);
	  conditionShow([[$("#step_2_address_legal_representative_room").val(),			"", 	"#step_2_address_legal_representative_room",		"td", 'p'	]]);
	  	  
	  conditionShow([[$("#step_2_address_legal_representative_street").val(),		"", 	"#step_2_address_legal_representative_street",		"td"		]]);	  
	  */
	  
	}    

	//3
	if (lst_steps.indexOf("3")>=0)
	{
	  $("#print_step_3_full_name_org").text($("#step_3_full_name_org").val());
	  $("#print_step_3_reduced_name_org").text($("#step_3_reduced_name_org").val());
	  $("#print_step_3_legal_address_org").text($("#step_3_legal_address_org").val());
	  $("#print_step_3_identity_org_reg").text($("#step_3_identity_org_reg").val());
	  $("#print_step_3_juridical_inn").text($("#step_3_juridical_inn").val());
	  $("#print_step_3_juridical_kpp").text($("#step_3_juridical_kpp").val());
	  $("#print_step_3_juridical_ogrn").text($("#step_3_juridical_ogrn").val());
	  
	  var fio = $("#step_3_lastname_org").val()+' '+$("#step_3_name_org").val()+' '+$("#step_3_middlename_org").val();
	  $("#print_step_3_fio_org").text(fio);
	  $("#print_step_3_birth_date_org").text($("#step_3_birth_date_org").val());
	  $("#print_step_3_pozition_manager").text($("#step_3_pozition_manager").val());
	  var doc1 = formDoc(["step_3_step_3_document_type_org","step_3_document_series_org","step_3_document_number_org","step_3_document_issue_date_org","step_3_document_org"]);
	  $("#print_step_3_document_type_org").text(doc1);
	  var doc2 = formDoc(["step_3_name_doc","step_3_series_doc","step_3_number_doc","step_3_date_doc","step_3_org_doc"]);
	  $("#print_step_3_name_doc").text(doc2);	  
	  
	  
	  conditionShow([[$("#step_3_full_name_org").val(), 		"#print_step_3_full_name_org", 		"#step_3_full_name_org", 			"tr"		]]);
	  conditionShow([[$("#step_3_reduced_name_org").val(), 		"#print_step_3_reduced_name_org", 	"#step_3_reduced_name_org", 		"tr" 		]]);
	  conditionShow([[$("#step_3_legal_address_org").val(), 	"#print_step_3_legal_address_org", 	"#step_3_legal_address_org", 		"tr" 		]]);
	  conditionShow([[$("#step_3_identity_org_reg").val(), 		"#print_step_3_identity_org_reg", 	"#step_3_identity_org_reg", 		"tr" 		]]);	
	  
	  conditionShow([[$("#step_3_juridical_inn").val(), 		"#print_step_3_juridical_inn", 		"#step_3_juridical_inn", 			"td" 		]]);
	  conditionShow([[$("#step_3_juridical_kpp").val(), 		"#print_step_3_juridical_kpp", 		"#step_3_juridical_kpp", 			"td" 		]]);
	  conditionShow([[$("#step_3_juridical_ogrn").val(), 		"#print_step_3_juridical_ogrn",		"#step_3_juridical_ogrn", 			"td" 		]]);
	  
	  conditionShow([[fio, 										"#print_step_3_fio_org",			"#step_3_lastname_org", 			"tr" 		]]);
	  conditionShow([[$("#step_3_birth_date_org").val(), 		"#print_step_3_birth_date_org",		"#step_3_birth_date_org", 			"tr" 		]]);
	  conditionShow([[$("#step_3_pozition_manager").val(), 		"#print_step_3_pozition_manager",	"#step_3_pozition_manager", 		"tr"		]]);  
	  conditionShow([[doc1, 									"#print_step_3_document_type_org",	"#step_3_step_3_document_type_org", "fieldset"	]]);  
	  conditionShow([[doc2, 									"#print_step_3_name_doc",			"#step_3_name_doc", 				"fieldset"	]]);	  
	}
}  


if (lst_steps.indexOf("4")>=0)
{
  $("#print_step_4_fio_declarant").text($("#step_4_last_name_declarant").val()+' '+$("#step_4_first_name_declarant").val()+' '+$("#step_4_middle_name_declarant").val());
  $("#print_step_4_birthday_declarant").text($("#step_4_birthday_declarant").val());
  var doc = formDoc(["step_4_doc_declarant_type","step_4_doc_declarant_series","step_4_doc_declarant_number","step_4_doc_declarant_date","step_4_doc_declarant_org"]);
  $("#print_step_4_doc_declarant_type").text(doc);  
  var adr = formAddress(	["step_4_address_declarant_postal","step_4_address_declarant_region","step_4_address_declarant_district","step_4_address_declarant_city",
																"step_4_address_declarant_settlement","step_4_address_declarant_street","step_4_address_declarant_house","step_4_address_declarant_body",
  																"step_4_address_declarant_build","step_4_address_declarant_flat","step_4_address_declarant_room"])  
  $("#print_step_4_address_declarant_postal").text(adr);  
  
  conditionShow([[$("#step_4_birthday_declarant").val(), 	"#print_step_4_birthday_declarant", 		"#step_4_birthday_declarant", 			"tr"		]]);
  conditionShow([[doc, 										"#print_step_4_doc_declarant_type", 		"#step_4_doc_declarant_type", 			"fieldset"	]]);  
  conditionShow([[adr, 										"#print_step_4_address_declarant_postal", 	"#step_4_address_declarant_postal", 	"fieldset"	]]);
}

if (lst_steps.indexOf("5")>=0)
{
  $("#print_step_5_fio_declarant").text($("#step_5_last_name_declarant").val()+' '+$("#step_5_first_name_declarant").val()+' '+$("#step_5_patronymic_declarant").val());  
  $("#print_step_5_birthday_declarant").text($("#step_5_birthday_declarant").val());    
  
  var doc = formDoc(["step_5_doc_declarant_type","step_5_doc_declarant_series","step_5_doc_declarant_number","step_5_doc_declarant_date"]);
  $("#print_step_5_doc_declarant").text(doc);  
  var adr = formAddress(["step_5_address_declarant_postal","step_5_address_declarant_region","step_5_address_declarant_district","step_5_address_declarant_city","step_5_address_declarant_settlement",
										"step_5_address_declarant_street","step_5_address_declarant_house","step_5_address_declarant_body","step_5_address_declarant_build","step_5_address_declarant_flat","step_5_address_declarant_room"]);
  $("#print_step_5_address_declarant_postal").text(adr);  
  $("#print_step_5_INN").text($("#step_5_INN").val());  
  $("#print_step_5_OGRNIP").text($("#step_5_OGRNIP").val());    
  
  conditionShow([[$("#step_5_birthday_declarant").val(), 	"#print_step_5_birthday_declarant", 		"#step_5_birthday_declarant", 			"td"		]]);  
  conditionShow([[doc, 										"#print_step_5_doc_declarant", 				"#step_5_doc_declarant_type", 			"fieldset"	]]);
  conditionShow([[adr, 										"#print_step_5_address_declarant_postal", 	"#step_5_address_declarant_postal", 	"fieldset"	]]);
  conditionShow([[$("#step_5_INN").val(), 					"#print_step_5_INN", 						"#step_5_INN", 							"td"		]]);
  conditionShow([[$("#step_5_OGRNIP").val(), 				"#print_step_5_OGRNIP",						"#step_5_OGRNIP", 						"td"		]]);  
}

if (lst_steps.indexOf("6")>=0)
{
	$("#print_step_6_full_name_org").text($("#step_6_full_name_org").val());  
	$("#print_step_6_reduced_name_org").text($("#step_6_reduced_name_org").val());  	
	$("#print_step_6_legal_address_org").text($("#step_6_legal_address_org").val());	
	$("#print_step_6_identity_org_reg").text($("#step_6_identity_org_reg").val());  	
	$("#print_step_6_juridical_inn").text($("#step_6_juridical_inn").val());  	
	$("#print_step_6_juridical_kpp").text($("#step_6_juridical_kpp").val());  	
	$("#print_step_6_juridical_ogrn").text($("#step_6_juridical_ogrn").val());  	
	var fio = $("#step_6_lastname_org").val()+' '+$("#step_6_name_org").val()+' '+$("#step_6_middlename_org").val();	
	$("#print_step_6_fio_org").text(fio);  	
	$("#print_step_6_birth_date_org").text($("#step_6_birth_date_org").val());  	
	$("#print_step_6_pozition_manager").text($("#step_6_pozition_manager").val());  
	var doc = formDoc(["step_6_step_6_document_type_org","step_6_document_series_org","step_6_document_number_org","step_6_document_issue_date_org","step_6_document_org"]);
	$("#print_step_6_document_type_org").text(doc);	
	
	conditionShow([[$("#step_6_full_name_org").val(), 		"#print_step_6_full_name_org", 		"#step_6_full_name_org", 			"tr"		]]);
	conditionShow([[$("#step_6_reduced_name_org").val(), 	"#print_step_6_reduced_name_org", 	"#step_6_reduced_name_org", 		"tr"		]]);
	conditionShow([[$("#step_6_legal_address_org").val(), 	"#print_step_6_legal_address_org", 	"#step_6_legal_address_org", 		"tr"		]]);
	conditionShow([[$("#step_6_identity_org_reg").val(), 	"#print_step_6_identity_org_reg", 	"#step_6_identity_org_reg", 		"tr"		]]);	
	conditionShow([[$("#step_6_juridical_inn").val(), 		"#print_step_6_juridical_inn", 		"#step_6_juridical_inn", 			"td"		]]);
	conditionShow([[$("#step_6_juridical_kpp").val(), 		"#print_step_6_juridical_kpp", 		"#step_6_juridical_kpp", 			"td"		]]);
	conditionShow([[$("#step_6_juridical_ogrn").val(), 		"#print_step_6_juridical_ogrn", 	"#step_6_juridical_ogrn", 			"td"		]]);	
	conditionShow([[fio, 									"#print_step_6_fio_org", 			"#step_6_lastname_org", 			"tr"		]]);	
	conditionShow([[$("#step_6_birth_date_org").val(), 		"#print_step_6_birth_date_org", 	"#step_6_birth_date_org", 			"td"		]]);	
	conditionShow([[$("#step_6_pozition_manager").val(), 	"#print_step_6_pozition_manager", 	"#step_6_pozition_manager", 		"td"		]]);
	conditionShow([[doc, 									"#print_step_6_document_type_org", 	"#step_6_pozition_manager", 		"fieldset"	]]);	
}



if (lst_steps.indexOf("8")>=0)
{  
  var fio = $("#step_8_last_name_recept").val()+' '+$("#step_8_first_name_recept").val()+' '+$("#step_8_middle_name_recept").val();
  $("#print_step_8_fio_recept").text(fio);  
  $("#print_step_8_birthday_recept").text($("#step_8_birthday_recept").val());   
  
    conditionShow([[fio, 									"#print_step_8_fio_recept", 		"#step_8_last_name_recept",	"fieldset"	]]);
    conditionShow([[$("#step_8_birthday_recept").val(), 	"#print_step_8_birthday_recept", 	"#step_8_birthday_recept",	"tr"		]]);  	  	
  
	if ($("#step_8_payment_type").val()=="Почта") 
	{	  
	  $("#print_step_8_postal_number_system").text($("#step_8_postal_number_system").val());
	  var adr = formAddress(["step_8_postal_address_v","step_8_region_v","step_8_district_v","step_8_city_v","step_8_settment_v","step_8_street_v","step_8_house_v","step_8_housing_v","step_8_building_v","step_8_flat_v","step_8_room_v"]);
	  if (adr.trim() == "") 
	  { 	    
	    
	    //$("#step_8_postal_address_v").parent().closest("fieldset").closest("fieldset").hide(); 
		$("#step_8_info_3").hide(); 
		
		//$("#svevPostBankRekv").text("");
		$("#svevPostRekv").text("");
		//$("#svevBankRekv").hide();
		
	  }
	  //else
	  //{
	    $("#print_step_8_postal_address_v").text(adr);	  	  
	    conditionShow([[$("#step_8_postal_number_system").val(), 		"#print_step_8_postal_number_system", 		"#step_8_postal_number_system", 			"tr"			]]);  
	    conditionShow([[adr, 											"#print_step_8_postal_address_v", 			"#step_8_postal_address_v", 				"table"			]]);
		
		
		/*
		conditionShow([[ $("#step_8_postal_address_v").val(), 	"", 		"#step_8_postal_address_v", 	"td"	]]);
		conditionShow([[ $("#step_8_region_v").val(), 			"", 		"#step_8_region_v", 			"td"	]]);
		conditionShow([[ $("#step_8_district_v").val(), 		"", 		"#step_8_district_v", 			"td"	]]);
		conditionShow([[ $("#step_8_city_v").val(), 			"", 		"#step_8_city_v", 				"td"	]]);
		conditionShow([[ $("#step_8_settment_v").val(), 		"", 		"#step_8_settment_v", 			"td"	]]);
		
		conditionShow([[ $("#step_8_house_v").val(), 			"", 		"#step_8_house_v", 				"td"	]]);
		conditionShow([[ $("#step_8_housing_v").val(), 			"", 		"#step_8_housing_v", 			"td"	]]);
		conditionShow([[ $("#step_8_building_v").val(), 		"", 		"#step_8_building_v", 			"td"	]]);
		conditionShow([[ $("#step_8_flat_v").val(), 			"", 		"#step_8_flat_v", 				"td"	]]);
		conditionShow([[ $("#step_8_room_v").val(), 			"", 		"#step_8_room_v", 				"td"	]]);		
		*/
		/*
		conditionShowTr(	["step_8_postal_address_v",		"step_8_house_v"	]);	  
		conditionShowTr(	["step_8_region_v",				"step_8_housing_v"	]);	  
		conditionShowTr(	["step_8_district_v",			"step_8_building_v"	]);	  
		conditionShowTr(	["step_8_city_v",				"step_8_flat_v"		]);	  
		conditionShowTr(	["step_8_settment_v",			"step_8_room_v"		]);	  
		*/
		
		//conditionShow([[ $("#step_8_street_v").val()										, 		"", 		"#step_8_street_v", 			"td"	]]);
      //}
	}
	else	
	{
	  $("#print_step_8_bank_name_system").text($("#step_8_bank_name_system").val());
	  $("#print_step_8_bank_subdivision_system").text($("#step_8_bank_subdivision_system").val());
	  $("#print_step_8_bank_account_system").text($("#step_8_bank_account_system").val());  
	  
	  if ($("#step_8_bank_name_system").val().trim() == "") 
	  {		 
		 $("#step_8_info_4").hide(); 		 		 
		 //$("#svevPostBankRekv").text("");
		 //$("#svevPostRekv").text("");
		 $("#svevBankRekv").text("");		 
	  }
	  //else
	  //{	  
	    conditionShow([[$("#step_8_bank_name_system").val(), 			"#print_step_8_bank_name_system", 			"#step_8_bank_name_system", 				"table"			]]);
	    conditionShow([[$("#step_8_bank_subdivision_system").val(), 	"#print_step_8_bank_subdivision_system", 	"#step_8_bank_subdivision_system", 			"tr"			]]);
	    conditionShow([[$("#step_8_bank_account_system").val(), 		"#print_step_8_bank_account_system", 		"#step_8_bank_account_system", 				"tr"			]]);
	  //}
	}
	
}


if (lst_steps.indexOf("9")>=0)
{  
  $("#print_step_9_fio_recept").text($("#step_9_last_name_recept").val()+' '+$("#step_9_first_name_recept").val()+' '+$("#step_9_middle_name_recept").val());  
  $("#print_step_9_birthday_recept").text($("#step_9_birthday_recept").val());  
  $("#print_step_9_bank_name_system").text($("#step_9_bank_name_system").val());  
  $("#print_step_9_bank_subdivision_system").text($("#step_9_bank_subdivision_system").val());  
  $("#print_step_9_bank_account_system").text($("#step_9_bank_account_system").val());
  
  conditionShow([[$("#step_9_birthday_recept").val(), 			"#print_step_9_birthday_recept", 			"#step_9_birthday_recept", 		"tr"			]]);  
  conditionShow([[$("#step_9_bank_name_system").val(), 			"#print_step_9_bank_name_system", 			"#step_9_bank_name_system", 	"tr"			]]);
  conditionShow([[$("#step_9_bank_subdivision_system").val(), 	"#print_step_9_bank_subdivision_system", 	"#step_9_bank_name_system", 	"tr"			]]);
  conditionShow([[$("#step_9_bank_account_system").val(), 		"#print_step_9_bank_account_system", 		"#step_9_bank_account_system", 	"tr"			]]);  
}


if (lst_steps.indexOf("10")>=0)
{
  $("#print_step_10_full_name_org_akcept").text($("#step_10_full_name_org_akcept").val());  
  $("#print_step_10_bank_name_system").text($("#step_10_bank_name_system").val());    
  $("#print_step_10_bank_subdivision_system").text($("#step_10_bank_subdivision_system").val());  
  $("#print_step_10_bank_account_system").text($("#step_10_bank_account_system").val());    
  $("#print_step_10_number_cor_account").text($("#step_10_number_cor_account").val());    
  $("#print_step_10_bik").text($("#step_10_bik").val());  
  
  conditionShow([[$("#step_10_full_name_org_akcept").val(), 	"#print_step_10_bank_name_system", 			"#step_10_full_name_org_akcept", 	"tr"			]]);  
  conditionShow([[$("#step_10_bank_name_system").val(), 		"#print_step_10_bank_name_system", 			"#step_10_bank_name_system", 		"tr"			]]);  
  conditionShow([[$("#step_10_bank_subdivision_system").val(), 	"#print_step_10_bank_subdivision_system", 	"#step_10_bank_subdivision_system", "tr"			]]);  
  conditionShow([[$("#step_10_bank_account_system").val(), 		"#print_step_10_bank_account_system", 		"#step_10_bank_account_system", 	"tr"			]]);  
  conditionShow([[$("#step_10_number_cor_account").val(), 		"#print_step_10_number_cor_account", 		"#step_10_number_cor_account", 		"tr"			]]);  
  conditionShow([[$("#step_10_bik").val(), 						"#print_step_10_bik", 						"#step_10_bik", 					"tr"			]]);    
}


if (lst_steps.indexOf("11")>=0)
{   
  $("#print_step_11_render_address_type_system").text("Адрес "+$("#step_11_render_address_type_system").val()+":");  
  var adr = formAddress(["step_11_index_pu","step_11_region_pu","step_11_district_pu","step_11_city_pu","step_11_settment_pu","step_11_street_pu","step_11_house_pu","step_11_corps_pu","step_11_building_pu","step_11_flat_pu","step_11_room_pu"]);  
  $("#print_step_11_index_pu").text(adr);
  
  conditionShow([[$("#step_11_render_address_type_system").val(), 	"#print_step_11_render_address_type_system", 	"#step_11_render_address_type_system",  "tr"			]]);    
  conditionShow([[adr, 												"#print_step_11_index_pu", 						"#step_11_index_pu",  					"fieldset"		]]);      
}

} // newPrintStatic ... end

function formAddress(aAddress)
{
  var resultAddr="";  
  for (var i=0; i<aAddress.length; i++)
  {    
    if ($("#"+aAddress[i]).val()!='') 
	{
	  resultAddr+=$("#"+aAddress[i]).val(); 
	  if (i<(aAddress.length-1)) resultAddr+=', ';	
	}  
  }	
  return resultAddr;
} // formAddress ... end

function formDoc(aDoc)
{ 
  var result="";
  if ($("#"+aDoc[0]).val()!="") 
  {
    result = tu($("#"+aDoc[0]).val())+' '+tu($("#"+aDoc[1]).val())+' '+tu($("#"+aDoc[2]).val())+' выдан(о) '+tu($("#"+aDoc[3]).val())+' '+tu($("#"+aDoc[4]).val());
  }
  return result;
} // formDoc ... end

function newPrint7()
{ 

  // Статическая часть
  $("#print_step_7_fio_people").text(" "+$("#step_7_last_name_people").val()+' '+$("#step_7_first_name_people").val()+' '+$("#step_7_middle_name_people").val());  
  $("#print_step_7_birthday_people").text($("#step_7_birthday_people").val());
  $("#print_step_7_relation_degree").text($("#step_7_relation_degree").val());  
  var adr = formAddress(["step_7_people_address_v", "step_7_people_region_v", "step_7_people_district_v", "step_7_people_city_v", "step_7_people_settement_v", "step_7_people_street_v", "step_7_people_house_v",
	"step_7_people_housing_v", "step_7_people_building_v", "step_7_people_flat_v", "step_7_people_room_v"]);
  $("#print_step_7_people_address_v").text(adr);
  	
  conditionShow([[$("#step_7_birthday_people").val(), 	"#print_step_7_birthday_people", 	"#step_7_birthday_people",  "tr"		]]);
  conditionShow([[$("#step_7_relation_degree").val(), 	"#print_step_7_relation_degree", 	"#step_7_relation_degree",  "tr"		]]);  
  conditionShow([[adr, 									"#print_step_7_people_address_v", 	"#step_7_people_address_v", "fieldset"	]]);  
	
  //Спрятать наличие иждивения	
  //$("#print_step_7_is_dependency").text(" "+($("#step_7_is_dependency").attr("checked") ? "Да":"Нет"));
  $("#tab_7").find("table:eq(0) tr:eq(1) td:eq(2)").hide();
  $("#tab_7").find("table:eq(0) tr:eq(1) td:eq(3)").hide();  
  
  $("#step_7_is_dependency").closest("td").hide();

  var nameJsonClone="step_7_pbDocs";
  var namePrintClone='print7_doc_clone';
  var typePrintClone='class';
  var parentPrintClone='print7_doc_after';  
  var nameScreenClone='step_7_clone_block';
  var typeScreenClone='class';
  var parentScreenClone = "tab_7";  
  
  if ($(namePrintClone).length > 1) return;

  $("."+namePrintClone).hide();
  $("."+nameScreenClone).hide();
  
  var i = -1;

/*  

  var tmp = $("#"+nameJsonClone).val();	
  if (tmp == "" || tmp ==null || tmp =="null") return;
  
  var result = JSON.parse(tmp);  
  
  var count = result.length; 
  for (i=0; i < count; i++) 
  {  
  
  var isAccept = ( result[i].number!=null ? true:false);	
  if (isAccept)
  {
    $(".step_7_print_block").show();
	var aScreen=
	[ 
	  ['step_7_doc_name',		result[i].name, 		'textarea',	'name'],
	  ['step_7_series_doc',		result[i].series,		'input',	'name'],
	  ['step_7_number_doc',		result[i].number,		'input',	'name'],
	  ['step_7_date_doc',		result[i].dateIssue,	'input',	'name'],
	  ['step_7_org_doc',		result[i].organization,	'textarea', 'name']

	];   
   addClone(typeScreenClone,nameScreenClone,parentScreenClone,i,aScreen);
	 
 	var aPrint=
	[
	 ['print7_doc',formDoc(["step_7_doc_name_"+i+"_0","step_7_series_doc_"+i+"_1","step_7_number_doc_"+i+"_2","step_7_date_doc_"+i+"_3","step_7_org_doc_"+i+"_4"]), 'span',	'name']
	];

    addClone(typePrintClone,namePrintClone,parentPrintClone,i,aPrint);
   }	 
   
  }
*/

if (i<1) $(".step_7_print_block").remove();


 
}  // newPrint7  ... end



function newPrint12()
{   
  var nameJsonClone="step_12_msp";

  var namePrintClone='print_step_12_clone_block';
  var typePrintClone='class';
  var parentPrintClone='printTable12';

  var nameScreenClone='step_12_clone_block';
  var typeScreenClone='class';
  var parentScreenClone = "tab_12";  
  
  if ($(namePrintClone).length > 1) {return;}
  
  $(".print_step_12_clone_block").hide();
  $(".step_12_clone_block").hide(); 

  var tmp = $("#"+nameJsonClone).val();	
  
  tmp = jsonParse(12,tmp);
  
  if (tmp == "" || tmp ==null || tmp =="null") 
  {
      $("#tab_12").hide();
      return;
  }
  //var result = JSON.parse(tmp);     
  
  var arrObjectMembers = 
  [   
  "familyMember[].surname", 
  "familyMember[].name", 
  "familyMember[].patronymic", 
  "familyMember[].birthday", 
  "familyMember[].identityCard.type", 
  "familyMember[].identityCard.series", 
  "familyMember[].identityCard.number", 
  "familyMember[].identityCard.dateIssue", 
  "familyMember[].identityCard.organization"
  ];		
  var result = validObjectMembers(tmp, arrObjectMembers);	

  
  //if (typeof(result.familyMember) == 'undefined')  return;
  
  //if (typeof(result.familyMember.length) == 'undefined')  
  //{    
  //  result.familyMember = [result.familyMember];
  //}
  
  var count = result.familyMember.length; 
  
  var cur_ind = 0;
  
  var el;
  
  for (var i=0; i < count; i++) 
  {
    cur_ind++;
	var aFields=
	[ 
	  ['step_12_last_name_declarant_mf',		result.familyMember[i].surname, 					'input',	'name'],
	  ['step_12_first_name_declarant_mf',		result.familyMember[i].name,						'input',	'name'],
	  ['step_12_middle_name_declarant_mf',		result.familyMember[i].patronymic,					'input',	'name'],
	  ['step_12_birthday_declarant_mf',			result.familyMember[i].birthday,					'input',	'name'],
	  ['step_12_name_doc_declarant_mf',			result.familyMember[i].identityCard.type,			'textarea', 'name'],
	  ['step_12_doc_declarant_series_mf',		result.familyMember[i].identityCard.series,			'input',	'name'],
	  ['step_12_doc_declarant_number_mf',		result.familyMember[i].identityCard.number,			'input',	'name'],
	  ['step_12_doc_declarant_date_mf',			result.familyMember[i].identityCard.dateIssue,		'input',	'name'],
	  ['step_12_doc_declarant_who_issued_mf',	result.familyMember[i].identityCard.organization,	'textarea', 'name']
	];
	
	if (needAddClone(aFields))
	{	   
	   el = addClone(typeScreenClone,nameScreenClone,parentScreenClone,cur_ind,aFields);	   
		aFields=
		[ 
		 ['print_step_12_num_pp',		cur_ind, 																							 'span',	'class'],
		 ['print_step_12_fio',		result.familyMember[i].surname +" "+ result.familyMember[i].name +" "+result.familyMember[i].patronymic, 'span',	'class'],
		 ['print_step_12_birthday',	result.familyMember[i].birthday, 																		 'span',	'class']
		];
	  addClone(typePrintClone,namePrintClone,parentPrintClone,cur_ind,aFields);	  	  
	  
	  
	  
	  if (result.familyMember[i].identityCard.number.trim()=="")
	  {
	    $("#step_12_name_doc_declarant_mf_"+cur_ind).closest("fieldset").closest("fieldset").hide();		
		$("#step_12_name_doc_declarant_mf_"+cur_ind).closest("fieldset").parent().closest("fieldset").find("legend:first").hide();	  
	  }
	  
	   if ( result.familyMember[i].identityCard.type.trim() == "" || result.familyMember[i].identityCard.number == "") 
	   {
		 el.find("[name='step_12_name_doc_declarant_mf']").closest("fieldset").hide();		 
		 el.find("[name='step_12_name_doc_declarant_mf']").closest("fieldset").parent().closest("fieldset").find(".group_label").hide();
	   }	 
	  
   }   
  }
}  // newPrint12 ... end


function newPrint13()
{ 
  
  if ($("#step_13_clone_block_0").length > 0) return; //Повторный вход

var arrObjectMembers = [
"familyMember[].name",  
"familyMember[].surname",
"familyMember[].patronymic",
"familyMember[].birthday",						  
"familyMember[].relationDegree.name",
"familyMember[].relationDegree.dependents.dependent",
"familyMember[].identityCard.type",
"familyMember[].identityCard.series",
"familyMember[].identityCard.number",
"familyMember[].identityCard.dateIssue",
"familyMember[].identityCard.organization",
"familyMember[].document.name",
"familyMember[].document.series",
"familyMember[].document.number",
"familyMember[].document.dateIssue",
"familyMember[].document.organization"];		  

  var nameJsonClone="step_13_sdd";
  
  var namePrintClone='print_step_13_clone_block';
  var nameScreenClone='step_13_clone_block';  
  var nameScreenClone1='clone_step_13_info_3';  
  
  var typePrintClone='class';
  var typeScreenClone='id';
  var typeScreenClone1='class';  
  
  var parentPrintClone='printTable13';
  var parentScreenClone = "tab_13";
  var parentScreenClone1 = "tab_13";

  $(".print_step_13_clone_block").hide();  
  $("#step_13_clone_block").hide();
  $(".clone_step_13_info_3").hide();	  	  

  var tmp = $("#"+nameJsonClone).val();	
  
  tmp = jsonParse(13,tmp);
  
  if (tmp == "" || tmp ==null || tmp =="null") 
  {
    $("#tab_13").hide();
	$("#print_13_title").text("");
	$("#printTable13").hide();
    return;	
  }	  
  //var result = JSON.parse(tmp);  
  var result = validObjectMembers(tmp, arrObjectMembers);    
  
  //if ( typeof(result.familyMember.length) == 'undefined')
  //{
  //  result.familyMember = [result.familyMember];
  //}
  
  var count = result.familyMember.length;
  
  var cur_ind = 0;
  var n_pp=1;

  if (count==0)
  {
    $("#tab_13").hide();
	$("#print_13_title").text("");
	$("#printTable13").hide();
    return;	
  }
  
  $("[name='step_13_last_name_declarant_sdd_z']").closest("fieldset").parent().closest("fieldset").find("legend:first").remove();			
  
  for (var i=0; i < count; i++) 
  {
   
   var ballast="";   
   
   //if (typeof(result.familyMember[i].relationDegree) != 'undefined')
   //{
     var relDegree = (typeof(result.familyMember[i].relationDegree) == 'undefined' ? '':result.familyMember[i].relationDegree.name);  
     if (result.familyMember[i].relationDegree!=null)
	 {	  
	   //if (typeof(result.familyMember[i].relationDegree.dependents.dependent)  != 'undefined')
	   //{
	     if (result.familyMember[i].relationDegree.dependents.dependent === true)
		 {		    
		   ballast='Да';		   
		 }
	   //}	  
	 }
   //}
   
	var aFileds=
	[ 
	  ['step_13_last_name_declarant_sdd_z',		result.familyMember[i].surname, 					'input',	'name'],
	  ['step_13_first_name_declarant_sdd_z',	result.familyMember[i].name,						'input',	'name'],
	  ['step_13_middle_name_declarant_sdd_z',	result.familyMember[i].patronymic,					'input',	'name'],
	  ['step_13_birthday_declarant_sdd_z',		result.familyMember[i].birthday,					'input',	'name'],  
	  ['step_13_relation_degree_sdd_z',			relDegree,											'input', 	'name'],
	  ['step_13_presence_dependency_sdd_z',		(ballast=="Да" ? "checked":""),						'input',	'name']
	];	
    
    
	if (result.familyMember[i].surname.trim()!="" && needAddClone(aFileds))
	{
	   cur_ind++;
  	   addClone(typeScreenClone,nameScreenClone,parentScreenClone,cur_ind,aFileds);
	   $(".clone_step_13_info_3:last").hide();	   
	   $("#step_13_presence_dependency_sdd_z_"+cur_ind).closest("td").hide();	   
	   
		aFileds=
		[ 
		 ['print_step_13_num_pp',			n_pp++, 																								 	'span',	'class'],
		 ['print_step_13_fio',				result.familyMember[i].surname +" "+ result.familyMember[i].name +" "+result.familyMember[i].patronymic, 	'span',	'class'],
		 ['print_step_13_birthday',			result.familyMember[i].birthday, 																		 	'span',	'class'],
		 ['print_step_13_relationdegree',	relDegree, 																									'span',	'class'],
		 ['print_step_13_dependents',		ballast, 																		 							'span',	'class']
		];
		
		addClone(typePrintClone,namePrintClone,parentPrintClone,cur_ind,aFileds);		
		
		aFileds=
		[
		  ['step_13_name_doc_declarant_sdd_z',			result.familyMember[i].identityCard.type,			'textarea',	'name'],
		  ['step_13_doc_declarant_series_sdd_z',		result.familyMember[i].identityCard.series,			'input',	'name'],
		  ['step_13_doc_declarant_number_sdd_z',		result.familyMember[i].identityCard.number,			'input',	'name'],
		  ['step_13_doc_declarant_date_sdd_z',			result.familyMember[i].identityCard.dateIssue,		'input',	'name'],
		  ['step_13_doc_declarant_who_issued_sdd_z',	result.familyMember[i].identityCard.organization,	'textarea', 'name']   
		];		
		
		if (needAddClone(aFileds))
        {		 
		  cur_ind++;		
		  addClone(typeScreenClone1,nameScreenClone1,parentScreenClone1,cur_ind,aFileds);
		  
			conditionShow([
				[ result.familyMember[i].identityCard.type, 		"", 	"#step_13_name_doc_declarant_sdd_z_"+cur_ind,	 	"fieldset" ],
				[ result.familyMember[i].identityCard.series, 		"", 	"#step_13_doc_declarant_series_sdd_z_"+cur_ind, 	"td" ],
				[ result.familyMember[i].identityCard.number,   	"",     "#step_13_doc_declarant_number_sdd_z_"+cur_ind, 	"td" ],
				[ result.familyMember[i].identityCard.dateIssue,	"",		"#step_13_doc_declarant_date_sdd_z_"+cur_ind,   	"td" ],
				[ result.familyMember[i].identityCard.organization, "", 	"#step_13_doc_declarant_who_issued_sdd_z_"+cur_ind,	"td" ]
			]);				  
			
		  if (result.familyMember[i].identityCard.number.trim()=="")
		  {
			$("#step_13_name_doc_declarant_sdd_z_"+cur_ind).closest("fieldset").hide();            
		  }
		  		  
		}  
		
		aFileds=
		[
		  ['step_13_name_doc_declarant_sdd_z',			result.familyMember[i].document.name,				'textarea',	'name'],
		  ['step_13_doc_declarant_series_sdd_z',		result.familyMember[i].document.series,				'input',	'name'],
		  ['step_13_doc_declarant_number_sdd_z',		result.familyMember[i].document.number,				'input',	'name'],
		  ['step_13_doc_declarant_date_sdd_z',			result.familyMember[i].document.dateIssue,			'input',	'name'],
		  ['step_13_doc_declarant_who_issued_sdd_z',	result.familyMember[i].document.organization,		'textarea', 'name']   
		];

		if (needAddClone(aFileds))
        {
          cur_ind++;		
		  addClone(typeScreenClone1,nameScreenClone1,parentScreenClone1,cur_ind,aFileds);
		  
			conditionShow([
				[ result.familyMember[i].document.name, 		"", 	"#step_13_name_doc_declarant_sdd_z_"+cur_ind,	 	"fieldset" ],
				[ result.familyMember[i].document.series, 		"", 	"#step_13_doc_declarant_series_sdd_z_"+cur_ind, 	"td" ],
				[ result.familyMember[i].document.number,   	"",     "#step_13_doc_declarant_number_sdd_z_"+cur_ind, 	"td" ],
				[ result.familyMember[i].document.dateIssue,	"",		"#step_13_doc_declarant_date_sdd_z_"+cur_ind,   	"td" ],
				[ result.familyMember[i].document.organization, "", 	"#step_13_doc_declarant_who_issued_sdd_z_"+cur_ind,	"td" ]
			]);			

	  if (result.familyMember[i].document.number.trim()=="")
	  {
	    $("#step_13_name_doc_declarant_sdd_z_"+cur_ind).closest("fieldset").hide();				
	  }
			
		  
		}
		
		//cur_ind++;
	}	
  }  
}  // newPrint13 ... end


function newPrint14()
{
 
  if ($("#step_14_clone_block_1").length > 0) return; //Повторный вход

 var arrObjectMembers = [
"familyMember[].name",  
"familyMember[].surname",
"familyMember[].patronymic",
"familyMember[].birthday",						  
"familyMember[].relationDegree.name",
"familyMember[].relationDegree.dependents.dependent",
"familyMember[].identityCard.type",
"familyMember[].identityCard.series",
"familyMember[].identityCard.number",
"familyMember[].identityCard.dateIssue",
"familyMember[].identityCard.organization",						  
"familyMember[].document.name",
"familyMember[].document.series",
"familyMember[].document.number",
"familyMember[].document.dateIssue",
"familyMember[].document.organization"];		  



  var nameJsonClone="step_14_sddnr";
  
  var namePrintClone='print_step_14_clone_block';  
  var typePrintClone='class';
  var parentPrintClone='printTable14';
  
  var nameScreenClone='step_14_clone_block';  
  var typeScreenClone='id';  
  var parentScreenClone = "tab_14";
  
  var nameScreenClone1='clone_step_14_info_4';  
  var typeScreenClone1='class';  
  var parentScreenClone1 = "tab_14";
  
  if ($("."+namePrintClone).length > 1) return;  

  $("."+namePrintClone).hide();
  $("#"+nameScreenClone).hide();
  $("."+nameScreenClone1).hide();	  	  

  var tmp = $("#"+nameJsonClone).val();	
  
  tmp = jsonParse(14,tmp);
  
  if (tmp == "" || tmp ==null || tmp =="null") 
  {
    $("#tab_14").hide();
	$("#print_14_title").text("");
	$("#printTable14").hide();
    return;  
  }	
  
  //var result = JSON.parse(tmp);    
  var result = validObjectMembers(tmp, arrObjectMembers);
  
  var count = result.familyMember.length;     
  
  if (count == 0)
  {
	  $("#tab_14").hide();
	  $("#print_14_title").text("");
	  $("#printTable14").hide();
	  return;  
  }
  
  
  //$("[name='step_14_doc_declarant_number_sdd_nz']").closest("fieldset").parent().closest("fieldset").find("legend:first").remove();			
  
  var cur_ind = 0;
  var n_pp = 1;
  
  for (var i=0; i < count; i++) 
  {
   var ballast="";   
   
   //if (typeof(result.familyMember[i].relationDegree) != 'undefined')
   //{
     var relDegree = (typeof(result.familyMember[i].relationDegree) == 'undefined' ? '':result.familyMember[i].relationDegree.name);  
     if (result.familyMember[i].relationDegree!=null)
	 {
	   //if (typeof(result.familyMember[i].relationDegree.dependents.dependent)  != 'undefined')
	   //{
	     if (result.familyMember[i].relationDegree.dependents.dependent === true)
		 {		    
		   ballast='Да';		   
		 }
	   //}
	 }   
   //}
   
	aFileds=
	[ 
	  ['step_14_last_name_declarant_sdd_nz',		result.familyMember[i].surname, 					'input',	'name'],
	  ['step_14_first_name_declarant_sdd_nz',		result.familyMember[i].name,						'input',	'name'],
	  ['step_14_middle_name_declarant_sdd_nz',		result.familyMember[i].patronymic,					'input',	'name'],
	  ['step_14_birthday_declarant_sdd_nz',			result.familyMember[i].birthday,					'input',	'name'],  
	  ['step_14_relation_degree_sdd_nz',			relDegree,											'input', 	'name'],
	  ['step_14_presence_dependency_sdd_nz',		(ballast=="Да" ? "checked":""),						'input',	'name']
	];   

   if (needAddClone(aFileds))
	{
	   cur_ind++;
	   addClone(typeScreenClone,nameScreenClone,parentScreenClone,cur_ind,aFileds);
	   $(".clone_step_14_info_4:last").hide();
	   $("#step_14_presence_dependency_sdd_nz_"+cur_ind).closest("td").hide();
   
		var aFileds=
		[ 
		 ['print_step_14_num_pp',			(n_pp++).toString(),																				 		'span',	'class'],
		 ['print_step_14_fio',				result.familyMember[i].surname +" "+ result.familyMember[i].name +" "+result.familyMember[i].patronymic, 	'span',	'class'],
		 ['print_step_14_birthday',			result.familyMember[i].birthday, 																		 	'span',	'class'],
		 ['print_step_14_relationdegree',	relDegree, 																									'span',	'class'],
		 ['print_step_14_dependents',		ballast, 																		 							'span',	'class']
		];

		if (needAddClone(aFileds))
		{
		    cur_ind++;
		    addClone(typePrintClone,namePrintClone,parentPrintClone,cur_ind,aFileds);		

			aFileds=
			[
			  ['step_14_name_doc_declarant_sdd_nz',			result.familyMember[i].identityCard.type,			'textarea',	'name'],
			  ['step_14_doc_declarant_series_sdd_nz',		result.familyMember[i].identityCard.series,			'input',	'name'],
			  ['step_14_doc_declarant_number_sdd_nz',		result.familyMember[i].identityCard.number,			'input',	'name'],
			  ['step_14_doc_declarant_date_sdd_nz',			result.familyMember[i].identityCard.dateIssue,		'input',	'name'],
			  ['step_14_doc_declarant_who_issued_sdd_nz',	result.familyMember[i].identityCard.organization,	'textarea', 'name']   
			];
			
		}
		
		    if (needAddClone(aFileds))
		    {
			cur_ind++;			
			addClone(typeScreenClone1,nameScreenClone1,parentScreenClone1,cur_ind,aFileds);
			
			conditionShow([
				[ result.familyMember[i].identityCard.type, 		"", 	"#step_14_name_doc_declarant_sdd_nz_"+cur_ind,	 	"fieldset" ],
				[ result.familyMember[i].identityCard.series, 		"", 	"#step_14_doc_declarant_series_sdd_nz_"+cur_ind, 	"td" ],
				[ result.familyMember[i].identityCard.number,   	"",     "#step_14_doc_declarant_number_sdd_nz_"+cur_ind, 	"td" ],
				[ result.familyMember[i].identityCard.dateIssue,	"",		"#step_14_doc_declarant_date_sdd_nz_"+cur_ind,   	"td" ],
				[ result.familyMember[i].identityCard.organization, "", 	"#step_14_doc_declarant_who_issued_sdd_nz_"+cur_ind,"td" ]
			]);			
			
			if (result.familyMember[i].identityCard.number.trim()=="")
			{
				$("#step_14_doc_declarant_number_sdd_nz_"+cur_ind).closest("fieldset").hide();				
			}
			
			
			}
		
		
		   
			aFileds=
			[
			  ['step_14_name_doc_declarant_sdd_nz',			result.familyMember[i].document.name,				'textarea',	'name'],
			  ['step_14_doc_declarant_series_sdd_nz',		result.familyMember[i].document.series,				'input',	'name'],
			  ['step_14_doc_declarant_number_sdd_nz',		result.familyMember[i].document.number,				'input',	'name'],
			  ['step_14_doc_declarant_date_sdd_nz',			result.familyMember[i].document.dateIssue,			'input',	'name'],
			  ['step_14_doc_declarant_who_issued_sdd_nz',	result.familyMember[i].document.organization,		'textarea', 'name']   
			];
		    
		   if (needAddClone(aFileds))
		   {			
			cur_ind++;
			addClone(typeScreenClone1,nameScreenClone1,parentScreenClone1,cur_ind,aFileds);
			
			conditionShow([
				[ result.familyMember[i].document.name, 			"", 	"#step_14_name_doc_declarant_sdd_nz_"+cur_ind,	 	"fieldset" ],
				[ result.familyMember[i].document.series, 			"", 	"#step_14_doc_declarant_series_sdd_nz_"+cur_ind, 	"td" ],
				[ result.familyMember[i].document.number,   		"",     "#step_14_doc_declarant_number_sdd_nz_"+cur_ind, 	"td" ],
				[ result.familyMember[i].document.dateIssue,		"",		"#step_14_doc_declarant_date_sdd_nz_"+cur_ind,   	"td" ],
				[ result.familyMember[i].document.organization, 	"", 	"#step_14_doc_declarant_who_issued_sdd_nz_"+cur_ind,"td" ]
			]);			
			
		   }
	}	
  }
}  // newPrint14 ... end

function newPrint15()
{
  var nameJsonClone="step_15_infmi";
  
  var namePrintClone='print_step_15_clone_block';  
  var typePrintClone='class';
  var parentPrintClone='printTable15';

  var nameScreenClone='step_15_clone_block';  
  var typeScreenClone='class';  
  var parentScreenClone = "tab_15";
  
  //if ($("."+namePrintClone).length > 1) return;  

  $("."+namePrintClone).hide();
  $("."+nameScreenClone).hide();  

  var tmp = $("#"+nameJsonClone).val();	
  
  tmp = jsonParse(15,tmp);
  
  if (tmp == "" || tmp ==null || tmp =="null") 
  {
	$("#print_15_title").text("");
	$("#print_15_title").hide();
	$("#printTable15").hide();  
    $("#tab_15").hide();
    return;   
  }	
  
  var arrObjectMembers = [
  "familyMembers[].profits.profit[]",
  "familyMembers[].surname",
  "familyMembers[].name",
  "familyMembers[].patronymic",
  "familyMembers[].birthday",
  "familyMembers[].profits.profit[].reqParams.reqParam.name",
  "familyMembers[].profits.profit[].amount",
  "familyMembers[].profits.profit[].month)",
  "familyMembers[i].profits.profit[].year",
  "familyMembers[].profits.profit[].type"
];
  
  //var result = JSON.parse(tmp);      
  //result = validObjectMembers(listArray, arrTest)
  var result = validObjectMembers(tmp, arrObjectMembers);    
  
  var count = result.familyMembers.length;
  
  count_tr=0;
  
  var cur_ind = 0;  
  
  for (var i=0; i < count; i++) 
  {
	var count2 = result.familyMembers[i].profits.profit.length;	

	var aFileds= 
	[
	 ['step_15_step_15_name_declarant_m',	result.familyMembers[i].surname +' ' +result.familyMembers[i].name +' ' + result.familyMembers[i].patronymic, 	'input',	'name'],
	 ['step_15_birthday_declarant_m',		result.familyMembers[i].birthday, 																				'input',	'name']	 
	];		
	
   if (needAddClone(aFileds))
	{
	    //Добавить ФИО, birthday
	    cur_ind++;	   
		var el_screen = addClone(typeScreenClone,nameScreenClone,parentScreenClone,cur_ind,aFileds);					
		
		if ( $("#step_15_step_15_name_declarant_m_"+cur_ind).val().length>45) { convertToTextarea("#step_15_step_15_name_declarant_m_"+cur_ind); }
		
		
		
		var aFileds=
		[ 
		 ['print_step_15_num_pp',	i*count2+1,																							 			'span',	'class'],
		 ['print_step_15_fio',		result.familyMembers[i].surname +' ' +result.familyMembers[i].name +' ' + result.familyMembers[i].patronymic, 	'span',	'class'],
		 ['print_step_15_birthday',	result.familyMembers[i].birthday, 																		 		'span',	'class']
		]; 

		var el = addClone(typePrintClone,namePrintClone,parentPrintClone,cur_ind,aFileds);
		
		var sumCount = 0;
	
		for (var j=0; j<count2; j++)
		{		    
		    if (result.familyMembers[i].profits.profit[j].amount.trim()=="" || result.familyMembers[i].profits.profit[j].amount.trim()=="0")
			{
				//el.hide();
				//el_screen.hide();
			}
			else
			{			
			sumCount+=result.familyMembers[i].profits.profit[j].amount;
			
			var svd = el_screen.find('[name="step_15_name_doc_sdd"]:last');
			svd.attr("id","step_15_name_doc_sdd"+"_"+count2*i+"_"+j);			
			svd.closest("table").hide();
			
			count_tr++;
			var aFileds=
			[ 
			 ['print_step_15_num_pp',	i*count2+j+1,												'span',	'class'],			 
			 ['print_step_15_month',	monthName(result.familyMembers[i].profits.profit[j].month),	'span',	'class'],
			 ['print_step_15_year',		result.familyMembers[i].profits.profit[j].year, 			'span',	'class'],
			 ['print_step_15_type',		result.familyMembers[i].profits.profit[j].type, 			'span',	'class'], 
			 ['print_step_15_amount',	result.familyMembers[i].profits.profit[j].amount, 			'span',	'class']             
			];	
			
			for (k=0; k<aFileds.length; k++) 
			{
			  el.find("."+aFileds[k][0]).text(aFileds[k][1]);		
			}
			
			if (j<(count2-1)) 			
			{
			  if (result.familyMembers[i].profits.profit[j+1].amount.trim()!="" && result.familyMembers[i].profits.profit[j+1].amount.trim()!="0")  
			  {			
			    el = addClone(typePrintClone,namePrintClone,parentPrintClone,count2*i+j,aFileds);
			  }
			} 
			
			var aFileds= 
			[		 			 
			 ['step_15_mm',				monthName(result.familyMembers[i].profits.profit[j].month), 	'input',	'name'],
			 ['step_15_gg',				result.familyMembers[i].profits.profit[j].year, 				'input',	'name'],
			 ['step_15_type_profit',	result.familyMembers[i].profits.profit[j].type, 				'input',	'name'], 
			 ['step_15_sum_profit',		result.familyMembers[i].profits.profit[j].amount, 				'input',	'name']             
			];	
		
			for (k=0; k<aFileds.length; k++) 
			{
			  var cur_e = el_screen.find('[name="'+aFileds[k][0]+'"]:last');			  
			  cur_e.val(aFileds[k][1]);
			  cur_e.attr("id",aFileds[k][0]+"_"+count2*i+"_"+j);			  
			  if (aFileds[k][1].length>30) 
			  { 
			    convertToTextarea(cur_e.attr("id"));
			  }
			}		
			
			if (j<(count2-1))
			{
			  //Добавить суммы
			  if (result.familyMembers[i].profits.profit[j+1].amount.trim()!="" && result.familyMembers[i].profits.profit[j+1].amount.trim()!="0")  
			  {
			    var el_screenId = el_screen.attr("id");
			    var el_screen1 = el_screen.find("table:eq(1) tr:last").clone(); 		  		  				
			    $("#"+aFileds[1][0]+"_"+count2*i+"_"+j).parent().parent().parent().append(el_screen1);
			  }
			  //Добавить вид документа			  
			}
			//el_screen=el_screen1;
			}
		}
		if (sumCount==0)
		{
			el.hide();
			el_screen.hide();		
		}
		
  }
  
  if (count_tr == 0)
  {
	$("#print_15_title").text("");
	$("#print_15_title").hide();
	$("#printTable15").hide();
	$("#tab_15").hide();
  }
  
}
}  // newPrint15 ... end

function monthName(monthNumber)
{
  var name ="";
  if (monthNumber == "01" || monthNumber == "1") name = "Январь";  
  if (monthNumber == "02" || monthNumber == "2") name = "Февраль";  
  if (monthNumber == "03" || monthNumber == "3") name = "Март";  
  if (monthNumber == "04" || monthNumber == "4") name = "Апрель";  
  if (monthNumber == "05" || monthNumber == "5") name = "Май";  
  if (monthNumber == "06" || monthNumber == "6") name = "Июнь";  
  if (monthNumber == "07" || monthNumber == "7") name = "Июль";  
  if (monthNumber == "08" || monthNumber == "8") name = "Август";  
  if (monthNumber == "09" || monthNumber == "9") name = "Сентябрь";  
  if (monthNumber == "10" || monthNumber == "10") name = "Октябрь";  
  if (monthNumber == "11" || monthNumber == "11") name = "Ноябрь";  
  if (monthNumber == "12" || monthNumber == "12") name = "Декабрь";  
  return name;
}


function newPrint16()
{
if (lst_steps.indexOf("16")>=0)
{
  $("#step_16_name_info").val("");
  var tmp = $("#step_16_ir").val();
  
  $("#tab_16").find("table").attr("id","tab_step_16");
  
  tmp = jsonParse(16,tmp);
  
  if (tmp != "" && tmp!=null && tmp !="null")
  { 
	
  var arrObjectMembers = [ "infRequest[].reqParams[].reqParam.name", "infRequest[].name", "infRequest[].group.name"];	
	
  var result = validObjectMembers(tmp, arrObjectMembers);
	
	  var count0 = result.infRequest.length;	  
	  
	  el=$("#tab_16").find("tr:eq(0)");
	  
	  for (var i=0; i<count0; i++)
	  {	  	            	  
	  
	    el.find("#step_16_name_info").parent().prev().hide();		
		
		if (result.infRequest[i].name.trim()!="")
		{
		  $("#print_group_16_info_"+i).text(result.infRequest[i].name);
		  el.find("#step_16_name_info").parent().parent().before('<span class="print_subTitle" style="text-align:left;">'+ result.infRequest[i].name +':</span>');		  
		  el.find("#step_16_name_info").css({'text-align':'left'});
		}
        else
		{
		  $("#print_group_16_info_"+i).closest("tr").hide();		
		}		
		
		if (result.infRequest[i].group.name.trim()!="")
		{$("#print_group1_16_info_"+i).text(result.infRequest[i].group.name);}
		else
		{
		  $("#print_group1_16_info_"+i).closest("tr").hide();
		}
		
	    var count_1 = result.infRequest[i].reqParams.length;	
	    for (var j=0; j<count_1; j++)
	    {
	      if (result.infRequest[i].reqParams[j].reqParam!=null)
		  {
			var count_2=result.infRequest[i].reqParams[j].reqParam.length;
			for (var k=0; k<count_2; k++)
			{			   
			  //el.find("#step_16_name_info").val($("#step_16_name_info").val()+result.infRequest[i].reqParams[j].reqParam[k].name+"\n");
			  el.find("#step_16_name_info").val(result.infRequest[i].reqParams[j].reqParam[k].name);
			  $("#print_step_16_info_"+(i*count_1+j)*count_2+k).text(result.infRequest[i].reqParams[j].reqParam[k].name);			  
			}  
		  }  
	    }	

		if (i<(count0-1))
		{
          el=$("#tab_16").find("tr:eq(0)").clone();		  
	      $("#tab_step_16").append(el);
		}

	  }
  }
  else
  {
    $("#tab_16").hide();
  }  
}
}  // newPrint16 /// end


	function delete_step(el,className) 
	{   
	  var str_id = el.id;  
	  var pos = str_id.lastIndexOf('_');
	  var i = str_id.substr(pos + 1);  
	  $(el).closest(className).hide();  
	  
	  
	  el.find("input").each(function () 
		{
			$(this).attr("required",false);
			$(this).removeAttr("error");
		});
		
	  el.find("textarea").each(function () 
		{
			$(this).attr("required",false);
			$(this).removeAttr("error");
		});
		
	  
	  
	  //delete window.outputData.document[i];  
	}
	
function newPrint17()
{
  //Косметика:
  //alert($("#tab_17").find("span")[0].text());
  //$("#tab_17").find("span:first").text("НАИМЕНОВАНЕ ШАГА 17");
  
  
  //Не переписан по новому
  var nameJsonClone="step_17_ir";
  
  var namePrintClone='print_step_17_clone_block_1';  
  var typePrintClone='class';
  var parentPrintClone='t_print17';

  var nameScreenClone='step_17_clone_block_1';  
  var typeScreenClone='class';  
  var parentScreenClone = "tab_17";
  
  //if ($("."+namePrintClone).length > 1) return;  


  var tmp = $("#"+nameJsonClone).val();	
  
  tmp = jsonParse(17,tmp);
  
  if (tmp == "" || tmp ==null || tmp =="null") 
  {
    $("#tab_17").hide();
    return;   
  }	
  
  //var result = tmp;  
  
  var arrObjectMembers = 
	[ "information[].data[].params.param[].name"];				
	
  var  result = validObjectMembers(tmp, arrObjectMembers);	  
  
  var count = result.information.length;  
  
  for (var i=0; i < count; i++) 
  {	
    var el = $(".step_17_clone_block_1:first").clone();
    $("#tab_17").append(el);	
	
	el.find("tbody").attr("id","step_17_body_"+i);
	
	el.find("input").each(function () 
		{
			$(this).attr("id", $(this).attr("name") + "_" + i);
		});

	el.find("textarea").each(function () 
	{
		$(this).attr("id", $(this).attr("name") + "_" + i);
	});
	
  
	var count2 = result.information[i].data.length;
	for (j=0; j < count2; j++) 
	{	        
	
		if  (j==0)
		{
		  if (tu(result.information[i].group.name) == "") 
		  {
		  $("#print_step_17_name_group_info_"+((i*count2)+j)).closest("tr").hide();
		  el.find("#step_17_name_group_info_"+i).closest("tr").hide();
		  }
		  else
		  {
		   $("#print_step_17_name_group_info_"+((i*count2)+j)).text(tu(result.information[i].group.name));
		    el.find("#step_17_name_group_info_"+i).val(result.information[i].group.name);	
		  }
		}  		
		
		if (tu(result.information[i].data[j].Name) == "")
		{
		  $("#print_step_17_name_info_"+((i*count2)+j)).closest("tr").hide();
		}
		else
		{
		  $("#print_step_17_name_info_"+((i*count2)+j)).text(tu(result.information[i].data[j].Name));	
		}
		
		if (result.information[i].data[j].Name.trim()=="")
		{
		  el.find("#step_17_name_info_"+i).closest("tr").hide();
		}
		else
		{
          el.find("#step_17_name_info_"+i).val(result.information[i].data[j].Name);		
		}
	

	  count_3 = result.information[i].data[j].params.param.length;
	  for (var k=0; k<count_3; k++)
	  {  
        //Для печатной формы	  
		//$("#print_step_17_name_rekvizit_info_"+((i*count2+j)*count_3+k)).text(result.information[i].data[j].params.param[k].name);
		//$("#print_step_17_rekvizit_info_"+((i*count2+j)*count_3+k)).text(result.information[i].data[j].params.param[k].value);
		
		  
		  el.find(".step_17_name_rekvizit_info").hide();		  
		  el.find("[name='step_17_rekvizit_info']").hide();		  
		  $("#step_17_body_"+i).append("<tr><td  align='right' valign='top'  class='ext5'><span class='label'>"+result.information[i].data[j].params.param[k].name+"</span></td><td><textarea cols='58' rows='6' style='resize:none' disabled='disabled'>"+result.information[i].data[j].params.param[k].value+"</textarea></td></tr>");
      }
		
		if (k>0)
		{
          $("#step_17_body_"+i).append("<tr><td>"+result.information[i].data[j].params.param[k-1].name+"</td><td>"+result.information[i].data[j].params.param[k-1].value+"</td></tr>");				  
		}
		$("#step_17_body_"+i+" tr:last").hide();	
	}

    }
	
	$(".step_17_clone_block_1:first").remove();
	$("#tab_17").find("fieldset:first").hide();
}
	
	
	
//---------------------------------------	
function testDateEnter(source,nameTest,ind)
{   
   //var dataRequest = getDataRequest();
   
   var tmp_cur = new Date();    
   var tmp_d2  = toDate(source.value);

      
   if ( tmp_d2.getTime() > tmp_cur.getTime() )
   {	    
     alert("Дата не может быть больше текущей");	 
	 source.value = null;
	 return;
   }
   
   if (nameTest=="creationDate")
   {     	
	var valTest = $("#creationDate").text();	
   }
   else
   {
     valTest=$("#"+nameTest).text();
	 if (valTest == "" || valTest == null)
	 {
	   valTest=$("#"+nameTest).val();
	 }
   }

   if (typeof(ind)=='undefined')
   {	  
	  var mes = "Неверная дата";	
	  if ($("#idCurrentForm").text()=="2") 
	  {
	    mes = "Дата меньше даты создания заявления";
	  }

	  if ($("#idCurrentForm").text()=="5" || $("#idCurrentForm").text()=="6")  // 'Решение' или 'Отказ'
	  {	  
		mes = "Дата меньше даты регистрации";
	  }	
	  
	  if ($("#idCurrentForm").text()=="4" || $("#idCurrentForm").text()=="7") // 'Рассмотрение' или "Архив"
	  {
	    "Дата меньше даты регистрации заявления"
 	  }	  
	  
	  var tmp_d1  = toDate(valTest);
	  
      if (tmp_d1.getTime() > tmp_d2.getTime())
	  {	    
        alert(mes);
		source.value = null;
	  }
	}  
	else
    {
      if (ind=="i")
      {	  
	    var checkbox = source.id;	  
	    var pos = checkbox.lastIndexOf('_');	    
		var i = checkbox.substr(pos + 1);	        		
	    if (($("#"+nameTest+"_"+i).val() == null) || ( source.value == null)) {return;}	  
	    var tmp_d1  = toDate($("#"+nameTest+"_"+i).val());
	  }
      else
      {
	    if ( (valTest == null) || ( source.value == null)	 ) {return;}	  
	    var tmp_d1  = toDate(valTest);
      }	
	  
	  
      if (tmp_d1.getTime() > tmp_d2.getTime())
	  {	    
        if (nameTest == 'date_reference_number') {alert("Дата меньше даты регистрации заявления");}
		if (nameTest == 'date_request_mv_t') {alert("Дата меньше даты отправки запроса");}
		source.value = null;
	  }   
    } 
	

	
}

function getCurDate()
{ 
  var d = new Date();
  var off = 0; //(d.getDay()==6 ? 2:d.getDay()==7 ? 1:0)
  d.setDate(d.getDate()+off);
  return (d.getDate()<10 ? "0":"") + d.getDate() + "." + ( d.getMonth()<9 ? "0":"")+(d.getMonth()+1)+"."+(d.getYear()+1900);
}


function conditionShow(aCond)
{  
  for (var i=0; i<aCond.length; i++)
  {
	// aCond[i][0] - value
	// aCond[i][1] - printName
	// aCond[i][2] - screenName
	// aCond[i][3] - closeTag
	
    var testValue;
	
	if (typeof(aCond[i][0]) == 'undefined') testValue = "";
	else testValue = aCond[i][0].toString();	
	
	if (testValue == "") 
	  {
		if (aCond[i][1] != "") $(aCond[i][1]).parent().text("");		
		if (aCond[i][3] == "") 
		{		  
		  $(aCond[i][2]).hide(); 
		}
		else
		{		  		
		  $(aCond[i][2]).closest(aCond[i][3]).hide();
		  if (aCond[i][3] == "td") 
		  {
			 $(aCond[i][2]).parent().prev().hide();
		  }
		}  
	  }  
  }
}

function conditionShowTr(aCond)
{
  // aCond - id значений столбцов
  // если все пустые, то скрыть строку
  // если пустой один, то в его заглоовк поставить точку
  var allEmpty=true;  

  for (var i=0; i<aCond.length; i++)
  {
    if ( $("#"+aCond[i]).val().trim() != "")
	{
	  allEmpty=false;
	}
  }
  
  if (allEmpty) 
  {  
    $("#"+aCond[0]).closest("tr").hide();
  } 
  else
  {
    for (var i=0; i<aCond.length; i++)
    {
      if ( $("#"+aCond[i]).val().trim() == "")	  
	  {	  
	    $("#"+aCond[i]).parent().prev().text("");
	    $("#"+aCond[i]).parent().text("");
		//$("#"+aCond[i]).parent().prev().remove();
		//$("#"+aCond[i]).parent().remove();		
	  }	
	  else
	  {
	    $("#"+aCond[i]).parent().prev().css({'align':'center'});
		$("#"+aCond[i]).parent().css({'align':'center'});
	  }
    }  
  }	
}


	function testReguestMv(source,viewOnly)
	{	    
		if (source.attr("checked") && !viewOnly)
		{		    
			source.parent().find("input[name='number_reguest_mv']").attr("disabled",false);
			source.parent().find("input[name='date_request_mv_t']").attr("disabled",false);
			source.parent().find("input[name='date_receipt_mv_t']").attr("disabled",false);
			
			source.parent().find(".dateMarker").show();
			source.parent().find("input[name='number_reguest_mv']").attr("required",true);
			source.parent().find("input[name='date_request_mv_t']").attr("required",true);
			
			source.parent().find("input[name='date_request_mv_t']").val(getCurDate());
			source.parent().find("input[name='date_receipt_mv_t']").val(getCurDate());			
			
			source.parent().find("input[name='date_receipt_mv_t']").attr("required",true);
			
			source.parent().find("input[name='number_reguest_mv']").removeAttr("error");
			source.parent().find("input[name='date_request_mv_t']").removeAttr("error");
			source.parent().find("input[name='date_receipt_mv_t']").removeAttr("error");
		} else 
		{		    
		    source.parent().find(".dateMarker").hide();
			source.parent().find("input[name='number_reguest_mv']").attr("disabled",true);
			source.parent().find("input[name='date_request_mv_t']").attr("disabled",true);
			source.parent().find("input[name='date_receipt_mv_t']").attr("disabled",true);
			if (!source.attr("checked"))
			{
			  source.parent().find("input[name='date_request_mv_t']").val(null);
			  source.parent().find("input[name='date_receipt_mv_t']").val(null);
			}			
			source.parent().find("input[name='number_reguest_mv']").attr("required",false);
			source.parent().find("input[name='date_request_mv_t']").attr("required",false);
			source.parent().find("input[name='date_receipt_mv_t']").attr("required",false);
			
			source.parent().find("input[name='number_reguest_mv']").removeAttr("error");
			source.parent().find("input[name='date_request_mv_t']").removeAttr("error");
			source.parent().find("input[name='date_receipt_mv_t']").removeAttr("error");
		}	
		
				
		$(".datepicker").each(function () 
		{
		  if ($(this).attr("disabled")) $(this).parent().find(".ui-datepicker-trigger").hide();
		  else $(this).parent().find(".ui-datepicker-trigger").show();	  
		});	
		
		
	}

	
	function testReguest(source,viewOnly)
	{	
	    
	    if (source.attr("checked") && !viewOnly)
		{
			source.parent().find(".dateMarker").show();
			source.parent().find("input[name='date_receipt_l_y']").attr("required","required");	
			source.parent().find("input[name='date_receipt_l_y']").attr("disabled",false);
			source.parent().find("input[name='date_receipt_l_y']").removeAttr("error");			
			source.parent().find("input[name='date_receipt_l_y']").val(getCurDate());			  			
			
		    if (!source.parent().parent().prev().parent().find("[name='choice_trustee_rek']").attr("checked"))
		    {			
		      source.parent().parent().prev().parent().find("[name='rekv_document_2_y']").attr("disabled",false);			
		    }
			
			
			
		} else 
		{
			source.parent().find(".dateMarker").hide();
			source.parent().find("input[name='date_receipt_l_y']").removeAttr("required");
			source.parent().find("input[name='date_receipt_l_y']").attr("disabled",true);
			source.parent().find("input[name='date_receipt_l_y']").removeAttr("error");						
			if (!source.attr("checked"))
			{
			  source.parent().find("input[name='date_receipt_l_y']").val(null);
			}
			
			source.parent().parent().prev().parent().find("[name='rekv_document_2_y']").attr("disabled",true);			
		}	
		
		$(".datepicker").each(function () 
		{
		  if ($(this).attr("disabled")) {$(this).parent().find(".ui-datepicker-trigger").hide();}
		  else $(this).parent().find(".ui-datepicker-trigger").show();	  
		});		

	}
	
	
	function hideButtonPicker(id)
	{
	  var nameId="#"+id;	  
	  if ($(nameId).attr("disabled"))
	  {
	    $(nameId).parent().find(".ui-datepicker-trigger").hide();
	  }
	  else
	  {
	    $(nameId).parent().find(".ui-datepicker-trigger").show();
	  }
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
	
	function changeStepNames()
	{
	  f_steps = $("#listSteps");
      lst_steps = f_steps.val().split("\n");
	  
	  var names=[
	  "", // 0
	  "", 																		// 1
	  "Законный представитель",  												// 2
	  "Законный представитель", 												// 3
	  "Правообладатель", 														// 4
	  "Правообладатель", 														// 5
	  "Правообладатель", 														// 6
	  "Сведения о лице, на основании данных которого оказывается услуга", 		// 7
	  "Сведения о почтовых (банковских) реквизитах для получения выплат", 		// 8
	  "Сведения о выплатных реквизитах индивидуального предпринимателя", 		// 9
	  "Сведения о выплатных реквизитах юридического лица", 						// 10
	  "Сведения об адресе предоставления услуги", 								// 11
	  "Сведения о членах семьи для предоставления услуги", 						// 12
	  "Сведения о членах семьи для расчета СДД (среднедушевой доход), зарегистрированных по адресу регистрации правообладающего лица", 		// 13
	  "Сведения о членах семьи для расчета СДД (среднедушевой доход), не зарегистрированных по адресу регистрации правообладающего лица", 	// 14
	  "Сведения о доходах всех членов семьи", 									// 15
	  "Запрашиваемые сведения", 												// 16
	  "Дополнительные сведения", 												// 17
	  "Сведения о документах заявителя, необходимых для оказания услуги", 		// 18
	  "Документы, которые необходимо принести лично" 							// 19	  
	  ];
	  
	  var tmp = $("#appData_cond").val();	  
	  
	  if (typeof(tmp) != 'undefined') 	  
	  {	  
	  
	    tmp = jsonParse("1 (listSteps-названия шагов)",tmp);
		if (tmp!='' && tmp!=null)
	    {		  
		  var result = tmp;		
		  for (var i=0; i<result.length; i++)
		  {		  
		  //var pos = lst_steps.indexOf(i.toString());
		  //if (pos>=0)
		  //{		  	
			if (typeof(result[i].number) != 'undefined')
			{
			    if (typeof(result[i].name) != 'undefined') 
			    {
				  names[result[i].number] = result[i].name;
			    }	
			}
		  //}	
		  }
		}		
	  }	
	  
	  /*
	  if (names[i].substring(0,4) == "Шаг " || names[i].substring(0,4) == "шаг ")
	  {
	    var k=names[i].substring(4).indexOf("–");
		if (k>=0)
		{
		  names[i] = names[i].substring(k+1);
		}
	  }	  	  
	  */
	  //Замена заголовка на первом шаге в экранной форме
	  //var el = $("#tab_2").find("span:first").clone().show();
	  //el.text(names[1]);
	  //$("#registrationForm").append(el);
	  //$("#step_1_info_1").closest("fieldset").find("legend").text(names[1]);	  
	  
	  for (var j=4; j<19; j++)
	  {	    
	    $("#tab_"+j).find("span:first").text(names[j]);
		if ($("#print_"+j+"_title").text()!="") $("#print_"+j+"_title").text(names[j]);
	  }
	  
	}

	function compareConstraintRKS(elA, elB) 
    {  
	  var cmp=0;
	  if (elA.keyConstraintRKS > elB.keyConstraintRKS) cmp=1;
	  if (elA.keyConstraintRKS < elB.keyConstraintRKS) cmp=-1;
      return cmp;
    }


	function constraintArray(arrObj, aKey, aLife,fullListName)
	{
	  // Функция получает в качестве параметров массив объектов - arrObj
	  // Строит массив ключей aTest, полученных сцеплением членов, имена которых перечислены в aKey	  
	  // Удаляет все повторяющиеся элементы у которых впереди меньше заполненных аргументов, за исключением условий описанных в aLife
	  //var aTest=[];
	  for (var i=0; i<arrObj.length; i++)
	  {
	    var key = "";
	    for (var j=0; j<aKey.length; j++)
	    { 
		  if (typeof(arrObj[i][aKey[j]]) != 'undefined') 
		  {
		    key +=  arrObj[i][aKey[j]];
		  }	
	    }	
        arrObj[i].keyConstraintRKS = key;
	  }	  
	  // Сортирует arrObj, последовательно перебирает
	  arrObj.sort(compareConstraintRKS);
	  // Удаляем повторяющиеся элементы у которых первые реквизиты менее заполнены
      for (var i = arrObj.length - 1; i > 0; i--) 
	  {
       if (arrObj[i].keyConstraintRKS == arrObj[i - 1].keyConstraintRKS) 
	   { 	     
	     var needDelete=true;
		 for (var i_life=0; i_life<aLife.length; i_life++)
		 {
		   if (eval(aLife[i_life]))		   
		   {
		     for (var i_full=0; i_full<fullListName; i_full++)
			 {
			   if (arrObj[i-1][fullListName[i_full]] != arrObj[i][fullListName[i_full]])
			   {
					needDelete = false;
					break;			   
			   }
			 }
		     if (needDelete == false)
			 {
		 	   break;
			 }  
		   }
		 }
         if (needDelete)
		 {
	       arrObj.splice( i-1, 1);
		 }  
	   }	 
      }
	}
	
	function convertToTextarea(jqueryKey)
	{  
	$(jqueryKey).each(function(i)
	{
	  $(this).hide(); 
	  $(this).parent().before('<textarea>'+ $(this).val() +'</textarea>');
	});	
	}
	
	function jsonParse(stepNumber, json)
	{
	  var result = null;
	  if (json == null || json=="")
	  {
	    return result;
	  }
	  try 
	  { 
	    result = JSON.parse(json);
	  }
	  catch(err)
	  {
        alert("Ошибка формата json. Данные шага: "+stepNumber+"\n"+err+"\n"+json);
	  } 	  	  
	  return result;
	}  