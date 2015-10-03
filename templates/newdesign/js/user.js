$(document).ready(function(){ // единственная  точка входа
// $(".show_list:last-child").css({"border-left":"none","background-image":"url(../images/bg_service1.gif.gif)","background-repeat":"no-repeat"}); 
	$(".show_list").each(function(){
		var count = $(".show_list_txt",this).length; //  было $(".show_list_txt",this).length - 1;
		
		$(".show_list_txt",this).eq(count).css({"border-left":"none","background-image":"url(../images/bg_service1.gif)","background-repeat":"no-repeat","background-position":"0px 0px"});
	});
 
 
 
 
 
 // всплывающее окно регистрации
var flag = false;
	 $('.hider').click(function() {
        $(this).next().slideToggle();
		 if(!flag){
			 $(".enter").css({"background-image":"url(../images/enter1.gif)","background-repeat":"no-repeat"});
			 $(".enter a").css("color","#444444");
			  flag = true;
		 }
		  else{
			 $(".enter").css({"background-image":"url(../images/enter.jpg)","background-repeat":"no-repeat"});
			 flag = false;
			}
      });
  // всплывающее окно регистрации
 
 
 /* Слайдер на главной*/
(function ($) {
var hwSlideSpeed = 700;
var hwTimeOut = 3000;
var hwNeedLinks = false;

$(document).ready(function(e) {
	$('.slide').css(
		{"position" : "absolute",
		 "top":'0', "left": '0'}).hide().eq(0).show();
	var slideNum = 0;
	var slideTime;
	slideCount = $("#slider .slide").size();
	var animSlide = function(arrow){
		clearTimeout(slideTime);
		$('.slide').eq(slideNum).fadeOut(hwSlideSpeed);
		if(arrow == "next"){
			if(slideNum == (slideCount-1)){slideNum=0;}
			else{slideNum++}
			}
		else if(arrow == "prew")
		{
			if(slideNum == 0){slideNum=slideCount-1;}
			else{slideNum-=1}
		}
		else{
			slideNum = arrow;
			}
		$('.slide').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
		$(".control-slide.active").removeClass("active");
		$('.control-slide').eq(slideNum).addClass('active');
		}
if(hwNeedLinks){
var $linkArrow = $('<a id="prewbutton" href="#">&lt;</a><a id="nextbutton" href="#">&gt;</a>')
	.prependTo('#slider');		
	$('#nextbutton').click(function(){
		animSlide("next");
		return false;
		})
	$('#prewbutton').click(function(){
		animSlide("prew");
		return false;
		})
}
	var $adderSpan = '';
	$('.slide').each(function(index) {
			$adderSpan += '<span class = "control-slide">' + index + '</span>';
		});
	$('<div class ="sli-links">' + $adderSpan +'</div>').appendTo('#slider-wrap');
	$(".control-slide:first").addClass("active");
	$('.control-slide').click(function(){
	var goToNum = parseFloat($(this).text());
	animSlide(goToNum);
	});
	var pause = false;
	var rotator = function(){
			if(!pause){slideTime = setTimeout(function(){animSlide('next')}, hwTimeOut);}
			}
	$('#slider-wrap').hover(	
		function(){clearTimeout(slideTime); pause = true;},
		function(){pause = false; rotator();
		});
	rotator();
});
})(jQuery);
  /* Слайдер на главной*/
 
 
 /* блок физ,юр лица*/
// <![CDATA[
$(document).ready(function(){
	
	var flag = false;
    $(".hider_fiz").click(function(){
		$("#hidden_jur").css("display","none");
		$("#hidden_usl").css("display","none");
		$("#hidden_fiz").show(600);
	    return false;
    });
});

$(document).ready(function(){
	var flag = false;
    $(".hider_tov").click(function(){
		$("#hidden_fiz").css("display","none");
		$("#hidden_usl").css("display","none");
		$("#hidden_jur").show(600);
	    return false;
    });
});


$(document).ready(function(){
	var flag = false;
    $(".hider_usl").click(function(){
		$("#hidden_jur").css("display","none");
		$("#hidden_fiz").css("display","none");
		$("#hidden_usl").show(600);
	    return false;
    });
});

// ]]>
 /* блок физ,юр лица*/
 
 
 
 

 
 



	//Обработка события клика по элементу с классом 
	$(".menu_fiz ").click(function()
	{
		//Получаем значение атрибута data-active текущего элемента
		//(data-active - флаг, отвечающий за отображение выпадающего списка)
		var active = $(this).attr('data-active');

		//Если меню было активно, сворачиваем
		if(active == 1)
		{
			$(".submenu_fiz_blank").hide();
			$(this).attr('data-active', '0'); 
		}
		//Если было свернуто, разварачиваем
		else
		{
			$(".submenu_fiz_blank").show();
			$(this).attr('data-active', '1');
		}
	});

	//Возвращение кнопки мыши в ненажатое состояние:

	//для выпадающего списка
	$(".submenu_fiz_blank").mouseup(function()
	{
		return false
	});

	//для кнопки
	$(".menu_fiz ").mouseup(function()
	{
		return false
	});

	//для всей страницы
	$(document).mouseup(function()
	{
		$(".submenu_fiz_blank").hide();
		$(".menu_fiz ").attr('data-active', '');
	});

 
 
 
 
 
 
 
 //Обработка события клика по элементу с классом 
	$(".menu_jur ").click(function()
	{
		//Получаем значение атрибута data-active текущего элемента
		//(data-active - флаг, отвечающий за отображение выпадающего списка)
		var active = $(this).attr('data-active');

		//Если меню было активно, сворачиваем
		if(active == 1)
		{
			$(".submenu_jur_blank").hide();
			$(this).attr('data-active', '0'); 
		}
		//Если было свернуто, разварачиваем
		else
		{
			$(".submenu_jur_blank").show();
			$(this).attr('data-active', '1');
		}
	});

	//Возвращение кнопки мыши в ненажатое состояние:

	//для выпадающего списка
	$(".submenu_jur_blank").mouseup(function()
	{
		return false
	});

	//для кнопки
	$(".menu_jur ").mouseup(function()
	{
		return false
	});

	//для всей страницы
	$(document).mouseup(function()
	{
		$(".submenu_jur_blank").hide();
		$(".menu_jur ").attr('data-active', '');
	});

 
 
 
 //Обработка события клика по элементу с классом 
	$(".menu_usl ").click(function()
	{
		//Получаем значение атрибута data-active текущего элемента
		//(data-active - флаг, отвечающий за отображение выпадающего списка)
		var active = $(this).attr('data-active');

		//Если меню было активно, сворачиваем
		if(active == 1)
		{
			$(".submenu_usl_blank").hide();
			$(this).attr('data-active', '0'); 
		}
		//Если было свернуто, разварачиваем
		else
		{
			$(".submenu_usl_blank").show();
			$(this).attr('data-active', '1');
		}
	});

	//Возвращение кнопки мыши в ненажатое состояние:

	//для выпадающего списка
	$(".submenu_usl_blank").mouseup(function()
	{
		return false
	});

	//для кнопки
	$(".menu_usl ").mouseup(function()
	{
		return false
	});

	//для всей страницы
	$(document).mouseup(function()
	{
		$(".submenu_usl_blank").hide();
		$(".menu_usl ").attr('data-active', '');
	});
 
 
 
 
 
 
  var otvet=true;
 $(function(){

 $(".symbol").click(function(){
 var f = $(this).parent().children('.show_list');
 if (otvet){
  f.show();   
  // $(this).css({"color":"#000","border-bottom":"0px"});
 //alert($(this).parent().children('.show_list').html());
	$(this).css({"background-image":"url(/templates/newdesign/images/minus.gif)","background-repeat":"no-repeat"}); // было  $(this).css({"background-image":"url(../images/minus.gif)","background-repeat":"no-repeat"});
  otvet=false;
 
  } 
	else {
		f.hide();   
		$(this).css({"background-image":"url(/templates/newdesign/images/plus.gif)","background-repeat":"no-repeat"}); // было $(this).css({"background-image":"url(../images/plus.gif)","background-repeat":"no-repeat"});
		 otvet=true;
	}
	
 });

 });
 
 
 
 	$(function(){
 		$(".next_btn").on("click", function(){
 			$("#parent_popup").show();
 		})
 		$(".close").on("click", function(){
 			$("#parent_popup").hide();
 		})
 	});

 /*
	//установка цвета обрамления контента (синий, желтый, розовый)
	 $("div.menu_org a").click(function(){
		 window.location.href = "/organisations";
		 $("div#all_content_things div#content").removeClass("content").addClass("content_org");
		 $("div#all_content_things div#center").removeClass("center").addClass("center_org");
		 $("div#all_content_things div#breadcrumbs_bottom_line").removeClass("blue_line").addClass("pink_line");
		 return false;
	 });
 
 */
 
 	
 	
 	
}); // end ready     

 











