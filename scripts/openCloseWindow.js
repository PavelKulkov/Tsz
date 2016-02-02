//Управление отображением окна на странице(стрыть/показать)
$(document).ready(function(){
	  var flag = true;
    
	//Функция для отображения скрытого окна
	function displayWindow(idWindow){
		//alert("gj");
		//$(idClick).click(function() {
		    if(flag){
			    flag = false;
		        //var id = $(this).attr('id');
		        $(idWindow).css("display", "block");
		    }
			
			var width = jQuery(idWindow).width();
           var height = jQuery(idWindow).height();
        
           var left = (screen.width - width)/2;
           var top = (screen.height - height)/2;
        
           $(idWindow).css({"left": left + "px", "top": top + "px" });
			
	    //});
	}
	
	//Функция для скрытия открытого окна
	function closeWindow(idWindow){
		    //Сброс формы при отмене
		    jQuery('form').get(0).reset();

		    flag = true;
			//Очищаем форму
			$(".file_name p").empty();
			$(".file_name p").append("Файл не выбран");	
			$(".image_uploaded").empty();
           		
		    $(idWindow).css("display", "none");	
	}
	
	/*Удаление документа или группы*/
	$("._adminDelObject_").click(function(){
		displayWindow(".windowDel")
	});
	$(".cancelButton").click(function(){
		closeWindow(".windowDel")
	});
	 
	//Редактирование ТСЖ
	$("._adminEditObjectRegistry_").click(function(){
		displayWindow("#_windowEditObject_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObject_")
	});
	 
	/*Редактирование документа*/
	$("._adminEditObject_").click(function(){
		displayWindow("#_windowEditObject_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObject_")
	});
	
	/*Редактирование группы*/
	$("._adminEditObjectGroup_").click(function(){
		displayWindow("#_windowEditObjectGroup_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObjectGroup_")
	});
	
	
	/*Добавление документа*/
	$("._adminAddObject_").click(function(){
		displayWindow("#_windowAddObject_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowAddObject_")
	});
	
	/*Добавление группы*/
	$("._adminAddObjectGroup_").click(function(){
		displayWindow("#_windowAddObjectGroup_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowAddObjectGroup_")
	});
    
    
    /*СТРАНИЦА ПАРТНЕРЫ И ПРОЕКТЫ*/
    
    /*Добавление партнера*/
	$("._adminAddObjectPartner_").click(function(){
		displayWindow("#_windowAddObjectPartner_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowAddObjectPartner_")
	});
    
     /*Редактирование информации о партнере*/
	$("._adminEditObjectPartner_").click(function(){
		displayWindow("#_windowEditObjectPartner_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObjectPartner_")
	});
    
     /*Добавление проекта*/
	$("._adminAddObjectProject_").click(function(){
		displayWindow("#_windowAddObjectProject_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowAddObjectProject_")
	});
    
     /*Редактирование информации о проекте*/
	$("._adminEditObjectProject_").click(function(){
		displayWindow("#_windowEditObjectProject_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObjectProject_")
	});
    
	 /*Редактирование информации о вопросе*/
	$("._adminEditObjectQuestions_").click(function(){
		displayWindow("#_windowEditObjectQuestions_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObjectQuestions_")
	});
 });