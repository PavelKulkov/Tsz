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
            balloonContentHeader: 'ТСЖ \"' + registeredHome[i].title + '\"', //Баллун для метки
            clusterCaption: 'ТСЖ \"' + registeredHome[i].title + '\"',

            balloonContentBody: "<p><strong>Адрес:</strong>" + registeredHome[i].address + "</p>" +
			    "<p><strong>Телефон: </strong>" + registeredHome[i].phoneNumber + " ; " + registeredHome[i].fax + "</p>" +
				/*"TODO  выводит undefined ?????<p><strong>E-mail:</strong>" + registeredHome[i].e_mail + "</p>" +*/
				"<p><strong>Председатель:</strong>" + registeredHome[i].President +"</p>" +
				"<p><strong>Сайт:</strong> <a href="+ registeredHome[i].site + ">" + registeredHome[i].site + "</a></p>",
            hintContent: 'ТСЖ \"' + registeredHome[i].title + '\"',  //Хинт для метки
            /*balloonContentFooter: '<a href="#">' + registeredHome[i].site + '</a>'*/
          }
        });
      }
      var myClusterer = new ymaps.Clusterer({clusterDisableClickZoom: true});
      myClusterer.add(myGeoObjects);
      myMap.geoObjects.add(  myClusterer);
    }
//}