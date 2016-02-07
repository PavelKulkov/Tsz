//Формирование карты
  ymaps.ready(init);
    var myMap,
        myPlacemark;
 
    function init(){
      myMap = new ymaps.Map("map", {
          center: [53.197167, 45.008982],
          zoom: 11
      });
      var myGeoObjects = [];

      var myCollection = new ymaps.GeoObjectCollection({}, {
          preset: 'islands#greenIcon', //все метки красные
          draggable: false // и их можно перемещать
      });

      for (var i = 0; i < registeredHome.length; i++) {
		if(registeredHome[i].breadth != -1 && registeredHome[i].longitude != -1){
			
		
        myGeoObjects[i] = new ymaps.GeoObject({
          geometry: {
            type: "Point",
			coordinates: [registeredHome[i].breadth ,registeredHome[i].longitude]
          },
          properties: {
            balloonContentHeader: "<p class=mapHeader>ТСЖ \"" + registeredHome[i].title + "\"</p>", //Баллун для метки
            clusterCaption: '<p class=mapHeader>ТСЖ \"' + registeredHome[i].title + '\"</p>',
			

            balloonContentBody: "<div class='mapContent'><div class='mapImage'><img src='/files/Registry/" + registeredHome[i].logo + "'></div><div class='mapText'><p><strong>Адрес:</strong> " + registeredHome[i].address + "</p>" +
			    "<p><strong>Телефон: </strong> " + registeredHome[i].phoneNumber + "</p>" +
				"<p><strong>Факс: </strong> " + registeredHome[i].fax + "</p>" +
				"<p><strong>E-mail:</strong> " + registeredHome[i].e_mail + "</p>"+
				"<p><strong>Председатель:</strong> " + registeredHome[i].President +"</p>" +
				"<p><strong>Сайт:</strong> <a href="+ registeredHome[i].site + "> " + registeredHome[i].site + "</a></p></div></div>",
            hintContent: '<p class=mapHeader>ТСЖ \"' + registeredHome[i].title + '\"</p>',  //Хинт для метки
           
          }
        });
		}
      }
      var myClusterer = new ymaps.Clusterer({clusterDisableClickZoom: true});
      myClusterer.add(myGeoObjects);
      myMap.geoObjects.add(  myClusterer);
	
    }