 //Проверка полей формы
 $(document).ready(function() {
	//Имена полей ввода
    var masName = {
        titleTsz : 'Название организации',
        addressTsz: 'Адрес',
		phoneNumberTsz: 'Телефон',
		e_mailTsz: 'E-mail',
		surnamePresident: 'Фамилия председателя',
		namePresident: 'Имя председателя',
		patronymicPresident: 'Отчество председателя',
		area: 'Район',
		titleDoc: 'Название документа',
		titleGroup: 'Название группы',
		titleAddDoc: 'Название документа',
		titleAddGroup: 'Название группы',
		titlePartner: 'Название',
		titleEditPartner: 'Название',
		titleProject: 'Название',
		titleEditProject: 'Название',
		titleQuestion: 'Вопрос',
		answer: 'Вопрос',
		titleNews: 'Заголовок',
		textNews: 'Текст новости'
    };
	var requiredField = [
	    'titleTsz',
		'addressTsz',
		'phoneNumberTsz',
		'e_mailTsz',
		'surnamePresident',
		'namePresident',
		'patronymicPresident',
		'area',
		'titleDoc',
		'titleGroup',
		'titleAddDoc',
		'titleAddGroup',
		'titlePartner',
		'titleEditPartner',
		'titleProject',
		'titleEditProject',
		'titleQuestion',
		'answer',
		'titleNews',
		'textNews'];

	//Если поле потеряло фокус проверяем его содержание
	$("form input, select, textarea").focusout(function(){
		var formId = $($(this)).closest('form').attr('id');
		//alert(formId);
		var name = $(this).attr("name");
		//alert(name);
		for(var i=0;i<requiredField.length;i++){ // если поле присутствует в списке обязательных
            if(name==requiredField[i]){ //проверяем поле формы на пустоту
		        //TODO Добавить адыкватную проверка select
		        if(!$(this).val() || $(this).val() == 0){
			    //если поле ошибки не содержит сообщения
			        if(!$('form[id="'+ formId +'"] #errormsg_' + name).html()){
				        if(name == 'e_mailTsz'){
			                $('form[id="'+ formId +'"] #errormsg_' + name).append("Поле " + masName[name] + "должно содержать @");
		                }
				        else{
			                $('form[id="'+ formId +'"] #errormsg_' + name).append("Поле " + masName[name] + " обязательно для заполнения");
				        }
			        }
		        }
		        else{
			        $("#" + formId + " #errormsg_" + name).empty();
		        }
			}
		}
	});
	
    //Если обязательные поля в форме не заполнены, запретить отправку формы
    jQuery('form').on('submit',function(e){
	    var formName = $(this).attr("id");
        var error=false; // индекс ошибки
			
		$("#" + formName).find(':input[type="text"], select, textarea').each(function() {
		    var nameFild = $(this).attr("name");
		    // проверяем каждое поле в форме
            for(var i=0;i<requiredField.length;i++){ // если поле присутствует в списке обязательных
                if(nameFild==requiredField[i]){ //проверяем поле формы на пустоту
					//else{
				    if(!$(this).val() || $(this).val() == 0){
						//TODO оптимизировать проверку на e-mail (модульный код)
						/*if(nameFild == 'e_mailTsz'){
		                    error = validate_output(/^[a-zA-Zа-яА-Я0-9-_\.]+@[a-zA-Zа-яА-Я0-9-_\.]+\.[A-z]{2,4}$/, $(this).val());
			               
		                } */
					    error=true;
						
			            //если поле ошибки не содержит сообщения
			            if(!$("#errormsg_" + nameFild).html()){
							/*if(nameFild == 'e_mailTsz'){
		       
			                    $('form[id="'+ formId +'"] #errormsg_' + nameFild).append("Поле " + masName[nameFild] + "должно содержать @");
		                    }*/
							//else{
			                $("#errormsg_" + nameFild).append("Поле " + masName[nameFild] + " обязательно для заполнения");
							//}
			            }
		            }
					//}
                }               
            }
        });
        if(error){ // если ошибок нет то отправляем данные
            e.preventDefault(); //Отменили нативное действие
           (e.cancelBubble) ? e.cancelBubble : e.stopPropagation; //Погасили всплытие 
        }
            
    });
	
	/*
	
	 //Функция проверки
    function validate_output(reg, str){
        if(!reg.test(str)){
			//document.getElementById(id).innerHTML = message;
            return true;
        }
		else{
			//document.getElementById(id).innerHTML = "";
            return false;
		}
    }*/
	
  
 });