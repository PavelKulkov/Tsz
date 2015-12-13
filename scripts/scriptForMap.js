 function getJson(url){
        mas = [];
        i = 0;
        $(function() {
            $.ajax({
                dataType: 'json',
		        url: url,
                success: function(jsondata){	 	 
                    $.each(jsondata, function(key, val) {   
			            mas[i] = val,
						
			            i++
                    });  
                }
            });
        });
        return mas;
    }
    registeredHome = [];
    registeredHome = getJson('/modules/registry/view/json.php?action=registeredHome');

    ymaps.ready(init);
    var myMap,
        myPlacemark;
 
    function init(){
      myMap = new ymaps.Map("map", {
          center: [53.197167, 45.008982],
          zoom: 14
      });
      var myGeoObjects = [];

      var myCollection = new ymaps.GeoObjectCollection({}, {
          preset: 'islands#greenIcon', //все метки красные
          draggable: false // и их можно перемещать
      });

      for (var i = 0; i < registeredHome.length; i++) {
        myGeoObjects[i] = new ymaps.GeoObject({
          geometry: {
            type: "Point",
			coordinates: [registeredHome[i].breadth ,registeredHome[i].longitude]
          },
          properties: {
            balloonContentHeader: "<p class=mapHeader>ТСЖ \"" + registeredHome[i].title + "\"</p>", //Баллун для метки
            clusterCaption: '<p class=mapHeader>ТСЖ \"' + registeredHome[i].title + '\"</p>',
			

            balloonContentBody: "<div class='mapContent'><div class='mapImage'><img src='/templates/images/registry/logo/" + registeredHome[i].logo + ".png'></div><div class='mapText'><p><strong>Адрес:</strong> " + registeredHome[i].address + "</p>" +
			    "<p><strong>Телефон: </strong> " + registeredHome[i].phoneNumber + " ; " + registeredHome[i].fax + "</p>" +
				"<p><strong>E-mail:</strong> " + registeredHome[i].e_mail + "</p>"+
				"<p><strong>Председатель:</strong> " + registeredHome[i].President +"</p>" +
				"<p><strong>Сайт:</strong> <a href="+ registeredHome[i].site + "> " + registeredHome[i].site + "</a></p></div></div>",
            hintContent: '<p class=mapHeader>ТСЖ \"' + registeredHome[i].title + '\"</p>',  //Хинт для метки
           
          }
        });
      }
      var myClusterer = new ymaps.Clusterer({clusterDisableClickZoom: true});
      myClusterer.add(myGeoObjects);
      myMap.geoObjects.add(  myClusterer);
    }

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
	
 });
 