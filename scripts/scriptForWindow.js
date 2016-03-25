 //Заполнение, вывод и скрытие всплывающего окна c информацией о ТСЖ
 $(document).ready(function() {
	var flag = true;
	//Функция отображения всплывающего окна
	//При работе с районами	
	$(".listAreasContent p").click(function() {
		if(flag){
			flag = false;
			var id =($(this).attr('id'));
		    $.ajax({
			    url:"../modules/registry/src/getReg.php",
			    type:"post",
			    data:{"idTsz":id},
			    success:function(data){
				    var reg = jQuery.parseJSON(data);
				    $(".headerModalWindow").append('<h1>ТСЖ "'+ reg.title +'"</h1>');
		            $(".logoModalWindow").append('<img src="/files/Registry/'+ reg.logo + '">');
                    $(".textModalWindow").append('<p><strong>Адрес:</strong> г.'+reg.town+', ул.'+reg.street+', '+reg.house+'</p>'+
			            '<p><strong>Телефон:</strong> '+ reg.phoneNumber +'</p>'+
					    '<p><strong>Факс:</strong> '+ reg.fax +' </p>'+
                        '<p><strong>E-mail:</strong><a href=#> '+ reg.e_mail +'</a></p>'+
                        '<p><strong>Председатель:</strong> '+ reg.surnamePresident + " " + reg.namePresident + " " + reg.patronymicPresident +'</p>'+
                        '<p><strong>Сайт: </strong><a href="#"> '+ reg.site +'</a></p>');
			    }
		    })
			$('body').append('<div class="pageWindows"></div>');
			$(".pageWindows").css("display", "block"); 
			
			var left = ($(window).width()/2-$(".modalWindow").width()/2);
            var top = ($(window).height()/2-$(".modalWindow").height()/2);
			
            $(".modalWindow").css({"left": left + "px", "top": top + "px" });
		    $(".modalWindow").css("display", "block");
		}
	});
	
    $(window).resize(function() {
		//Если всплывающее окно отображено
		if(!flag){
		    var left = ($(window).width()/2-$(".modalWindow").width()/2);
            var top = ($(window).height()/2-$(".modalWindow").height()/2);	 
	        $(".modalWindow").css({"left": left + "px", "top": top + "px" });
		}
	});

	//При работе со списком
	$(".listTsz").change(function() {
		if(flag){
			flag = false;
		    var id = $( "select option:selected").attr('id');
	
			$.ajax({
			    url:"../modules/registry/src/getReg.php",
			    type:"post",
			    data:{"idTsz":id},
			    success:function(data){
				    var reg = jQuery.parseJSON(data);
				    $(".headerModalWindow").append('<h1>ТСЖ "'+ reg.title +'"</h1>');
		            $(".logoModalWindow").append('<img src="/files/Registry/'+ reg.logo + '">');
                    $(".textModalWindow").append('<p><strong>Адрес:</strong>  г.'+reg.town+', ул.'+reg.street+', '+reg.house+'</p>'+
			            '<p><strong>Телефон:</strong> '+ reg.phoneNumber +' </p>'+
						'<p><strong>Факс:</strong> '+ reg.fax +' </p>'+
                        '<p><strong>E-mail:</strong><a href=#> '+ reg.e_mail +'</a></p>'+
                        '<p><strong>Председатель:</strong> '+ reg.surnamePresident + " " + reg.namePresident + " " + reg.patronymicPresident +'</p>'+
                        '<p><strong>Сайт: </strong><a href="#"> '+ reg.site +'</a></p>');
			    }
		    })
	        $('body').append('<div class="pageWindows"></div>');
		    $(".pageWindows").css("display", "block");
			
		    var left = ($(window).width()/2-$(".modalWindow").width()/2);
            var top = ($(window).height()/2-$(".modalWindow").height()/2);
        
            $(".modalWindow").css({"left": left + "px", "top": top + "px" });
		    $(".modalWindow").css("display", "block");
		}
	});

	//Функция скрытия всплывающих окон ТСЖ
	$("#closeModalWindow").click(function(){
		flag = true;
		$(".modalWindow").css("display", "none");
		$(".pageWindows").css("display", "none");
		$('.pageWindows').remove();
		$(".textModalWindow").empty();
		$(".headerModalWindow").empty();

		$(".logoModalWindow").empty();
	});

	 //Функция скрытия всплывающего окна карты
	 $("#closeModalWindowMap").click(function(){
		 //alert("tt");
		 //flag = true;
		 $("body").css({"overflow": "auto" });
		 $(".modalWindowMap").css("display", "none");
		 $(".pageWindows").css("display", "none");

		 $('.pageWindows').remove()
		 $("#mapSearch").empty();
	 });
 });