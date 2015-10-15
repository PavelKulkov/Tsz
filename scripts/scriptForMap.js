var mas = [];
$(function() {
        $.ajax({
          dataType: 'json',
          //url: 'json.php?action=sample1',
		  url: '/modules/map/view/json.php',
		  //url: '/modules/map/class/Map.class.php',
          success: function(jsondata){	 
		  s  = "";
		  t = "";
          $.each(jsondata, function(key, val) {   
            //s = s + key+' => ' + val + '<br/>',
			$.each(val, function(key, val) {
		      s = s + key+' => ' + val + '<br/>', 
			  t = t + val + "-"
		    });
          });  
		  //$('#text').html(s);
		  //$('#text').html(t);
		  mas = t.split('-');
		 // alert(mas[5]);
		  
		
          }
        });
});


          
          

    ymaps.ready(init);
    var myMap,
        myPlacemark,
        coords= [
          [53.197486, 45.00565],
		  [53.198451, 45.009153],
		  [53.199471, 45.009512],
		  [53.199471, 45.009512],
		  [53.196903, 45.015271]
        ];
		/*
		messege = [
          'Неисправность освещения в подъезде',
          'Пропал свет',
          'Нет воды',
          'Сломано окно',
          'Сломана входная дверь'
        ]*/

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

      var j = 1;
      for (var i = 0; i < coords.length; i++) {
        myGeoObjects[i] = new ymaps.GeoObject({
          geometry: {
            type: "Point",
            coordinates: coords[i]
          },
          properties: {
            balloonContentHeader: mas[j], //Баллун для метки
            clusterCaption: mas[j],
            balloonContentBody: 'ул. ... д. ...',
            hintContent: mas[j],  //Хинт для метки
            balloonContentFooter: "Сайт ..."
          }
        });
		j+=2;
      }

      var myClusterer = new ymaps.Clusterer({clusterDisableClickZoom: true});
      myClusterer.add(myGeoObjects);
      myMap.geoObjects.add(  myClusterer);
    }