 //Заполнение, вывод и скрытие всплывающего окна
 $(document).ready(function() {
	 var flag = true;
	 function createWindow(id , obj){
		id--;
		$(".headerModalWindow").append('<h1>ТСЖ "'+ obj[id].title +'"</h1>');
		$(".logoModalWindow").append('<img src="/templates/images/registry/logo/'+ obj[id].logo +'.png">');
        $(".textModalWindow").append('<p><strong>Адрес:</strong> '+obj[id].address+'</p>'+
			                        '<p><strong>Телефон:</strong> '+ obj[id].phoneNumber +'; '+ obj[id].fax +' </p>'+
                                    '<p><strong>E-mail:</strong><a href=#> '+ obj[id].e_mail +'</a></p>'+
                                    '<p><strong>Председатель:</strong> '+ obj[id].President +'</p>'+
                                    '<p><strong>Сайт: </strong><a href="#"> '+ obj[id].site +'</a></p>');
	}
	//Функция отображения всплывающего окна
	
	//При работе с районами	
	$(".listAreasContent p").click(function() {
		if(flag){
			flag = false;
		    var id = $(this).attr('id');
		    createWindow(id, registeredHome);
		    $(".modalWindow").css("display", "block");
		}
	});
	
	//Функция скрытия всплывающего окна
	$(".closeModalWindowImg").click(function(){
		flag = true;
		$(".modalWindow").css("display", "none");
		$(".textModalWindow").empty();
		$(".headerModalWindow").empty();
		$(".logoModalWindow").empty();
	});
	
	//При работе со списком
	$(".listTsz").change(function() {
		if(flag){
			flag = false;
		    var id = $( "select option:selected").attr('id');
		    createWindow(id, registeredHome);
		    $(".modalWindow").css("display", "block");
		}

	});
 });