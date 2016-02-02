﻿ //Заполнение, вывод и скрытие всплывающего окна
 $(document).ready(function() {
	 var flag = true;
	 function createWindow(id , obj){
		for(i=0; i<Object.keys(obj).length; i++){
			
			if(id == obj[i].id){
				$(".headerModalWindow").append('<h1>ТСЖ "'+ obj[i].title +'"</h1>');
		        $(".logoModalWindow").append('<img src="/files/Registry/'+ obj[i].logo + '">');
                $(".textModalWindow").append('<p><strong>Адрес:</strong> '+obj[i].address+'</p>'+
			                        '<p><strong>Телефон:</strong> '+ obj[i].phoneNumber +'; '+ obj[i].fax +' </p>'+
                                    '<p><strong>E-mail:</strong><a href=#> '+ obj[i].e_mail +'</a></p>'+
                                    '<p><strong>Председатель:</strong> '+ obj[i].President +'</p>'+
                                    '<p><strong>Сайт: </strong><a href="#"> '+ obj[i].site +'</a></p>');
			}
		}
		
		//alert(Object.keys(obj).length);
		
		/*$(".headerModalWindow").append('<h1>ТСЖ "'+ obj[id].title +'"</h1>');
		
		$(".logoModalWindow").append('<img src="/files/Registry/'+ obj[id].logo + '">');
        $(".textModalWindow").append('<p><strong>Адрес:</strong> '+obj[id].address+'</p>'+
			                        '<p><strong>Телефон:</strong> '+ obj[id].phoneNumber +'; '+ obj[id].fax +' </p>'+
                                    '<p><strong>E-mail:</strong><a href=#> '+ obj[id].e_mail +'</a></p>'+
                                    '<p><strong>Председатель:</strong> '+ obj[id].President +'</p>'+
                                    '<p><strong>Сайт: </strong><a href="#"> '+ obj[id].site +'</a></p>');*/
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