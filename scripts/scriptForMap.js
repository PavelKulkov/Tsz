//window.onload = function(){
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
	
/*
request = [];
setTimeout("request = getJson('json.php?action=request')", 1000);
setTimeout("alert(request[0].text)", 1000);*/

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
			

            balloonContentBody: "<div class='mapContent'><div class='mapImage'><img src='/templates/images/" + registeredHome[i].logo + ".png'></div><div class='mapText'><p><strong>Адрес:</strong>" + registeredHome[i].address + "</p>" +
			    "<p><strong>Телефон: </strong>" + registeredHome[i].phoneNumber + " ; " + registeredHome[i].fax + "</p>" +
				/*"TODO  выводит undefined ?????<p><strong>E-mail:</strong>" + registeredHome[i].e_mail + "</p>" +*/
				"<p><strong>Председатель:</strong>" + registeredHome[i].President +"</p>" +
				"<p><strong>Сайт:</strong> <a href="+ registeredHome[i].site + ">" + registeredHome[i].site + "</a></p></div></div>",
            hintContent: '<p class=mapHeader>ТСЖ \"' + registeredHome[i].title + '\"</p>',  //Хинт для метки
            /*balloonContentFooter: '<a href="#">' + registeredHome[i].site + '</a>'*/
          }
        });
      }
      var myClusterer = new ymaps.Clusterer({clusterDisableClickZoom: true});
      myClusterer.add(myGeoObjects);
      myMap.geoObjects.add(  myClusterer);
    }
//}