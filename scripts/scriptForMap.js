window.onload = function(){
	
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
		            //$('#text').html(mas[0].street_name);
                }
            });
        });
        return mas;
    }

    registeredHome = [];
    registeredHome = getJson('/modules/map/view/json.php?action=registeredHome');
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
            balloonContentHeader: 'Текст заявки ...', //Баллун для метки
            clusterCaption: 'Текст заявки ...',
            balloonContentBody: registeredHome[i].street_name,
            hintContent: registeredHome[i].street_name,  //Хинт для метки
            balloonContentFooter: "Сайт ..."
          }
        });
      }

      var myClusterer = new ymaps.Clusterer({clusterDisableClickZoom: true});
      myClusterer.add(myGeoObjects);
      myMap.geoObjects.add(  myClusterer);
    }
}