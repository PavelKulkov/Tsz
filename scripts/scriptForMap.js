/*
* Добавление карты на страницу
*/

function addMap(data){
	
	ymaps.ready(init);
    var myMap,
        myPlacemark;
 
    function init(){
        myMap = new ymaps.Map("map", {
            center: [53.197167, 45.008982],
            zoom: 11
        });
        var myGeoObjects = [];
	  
        for (var i = 0; i < data.length; i++) {
		    if(data[i].breadth != -1 && data[i].longitude != -1){
		
                myGeoObjects[i] = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
			            coordinates: [data[i].breadth ,data[i].longitude]
                    },
                    properties: {
                        balloonContentHeader: "<p class=mapHeader>ТСЖ \"" + data[i].title + "\"</p>", //Баллун для метки
                        clusterCaption: '<p class=mapHeader>ТСЖ \"' + data[i].title + '\"</p>',
                        balloonContentBody: "<div class='mapContent'><div class='mapImage'><img src='/files/Registry/" + data[i].logo + "'></div><div class='mapText'><p><strong>Адрес:</strong> " + data[i].address + "</p>" +
			                "<p><strong>Телефон: </strong> " + data[i].phoneNumber + "</p>" +
				            "<p><strong>Факс: </strong> " + data[i].fax + "</p>" +
				            "<p><strong>E-mail:</strong> " + data[i].e_mail + "</p>"+
				            "<p><strong>Председатель:</strong> " + data[i].President +"</p>" +
				            "<p><strong>Сайт:</strong> <a href="+ data[i].site + "> " + data[i].site + "</a></p></div></div>",
                        hintContent: '<p class=mapHeader>ТСЖ \"' + data[i].title + '\"</p>',  //Хинт для метки
                    }
                },{
			        //Цвет маркера
			        preset:'islands#greenIcon'
		        });
		    }
        }
		
        var myClusterer = new ymaps.Clusterer({
		    preset: 'islands#invertedGreenClusterIcons',
		    clusterDisableClickZoom: true
		});
        myClusterer.add(myGeoObjects);
        myMap.geoObjects.add(  myClusterer);
	
    }
}	
		
$.getJSON('../modules/registry/src/getAllReg.php', function(data){
	addMap(data);	
});