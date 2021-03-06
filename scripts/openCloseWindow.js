//Управление отображением окна на странице(стрыть/показать)
$(document).ready(function(){
	var flag = true;
    var nameWindow;
	//Функция для отображения скрытого окна
	function displayWindow(idWindow){ 
		if(flag){
			flag = false;
		    $('.content').append('<div class="pageWindows"></div>');
		    $(".pageWindows").css("display", "block");
	        $(idWindow).css("display", "block");		
		}
	    nameWindow = idWindow;
		
		var left = ($(window).width()/2-$(idWindow).width()/2);
        var top = ($(window).height()/2-$(idWindow).height()/2);
		
        $("body").css({"overflow-y": "hidden" });
        $(idWindow).css({"left": left + "px", "top": top + "px" });		
	}
	
	$(window).resize(function() {
		//Если всплывающее окно отображено
		if(!flag){
			var left = ($(window).width()/2-$(nameWindow).width()/2);
            var top = ($(window).height()/2-$(nameWindow).height()/2);	 
	        $(nameWindow).css({"left": left + "px", "top": top + "px" });
		}
	});
	//var i=0;
	//Функция для скрытия открытого окна
	function closeWindow(idWindow){
		//Сброс формы при отмене
	    //jQuery('form').get(0).reset();
		$(':input','form').not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');

		flag = true;
		//Очищаем форму
		$(".file_name p").empty();
		$(".file_name p").append("Файл не выбран");	
		$(".image_uploaded").empty();

	    $(idWindow).css("display", "none");	
		$(".pageWindows").css("display", "none");
		$(".pageWindows").remove();
		$("body").css({"overflow-y": "scroll" });
	}
	
	/*Удаление документа или группы*/
	$("._adminDelObject_").click(function(){
		displayWindow(".windowDel")
	});
	$(".cancelButton").click(function(){
		closeWindow(".windowDel")
	});
	/*Редактирование ТСЖ*/
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
	/*СТРАНИЦА ВОПРОС-ОТВЕТ*/
	/*Редактирование информации о вопросе*/
	$("._adminEditObjectQuestions_").click(function(){
		displayWindow("#_windowEditObjectQuestions_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObjectQuestions_")
	});
	
	/*Добавление группы вопроса*/
	$("._adminAddGroupQuestions_").click(function(){
		displayWindow("#_windowAddGroupQuestions_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowAddGroupQuestions_")
	});
	
	/*Редактирование группы вопроса*/
	$("._adminEditGroup_").click(function(){
		displayWindow("#_windowEditObjectGroup_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObjectGroup_")
	});
	
	
	/*Редактирование контактов*/
	$("._adminEditObjectContact_").click(function(){
		displayWindow("#_windowEditObjectContact_")
	});
	$(".cancelButton").click(function(){
		closeWindow("#_windowEditObjectContact_")
	});
	
	
 });