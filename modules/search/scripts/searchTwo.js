/** ===========================
 *  Поиск ТСЖ по адресу и отображение результата на карте
 *  ===========================
 */
$(function() {
	//Массив адресов (город, улица, дом)
	var masAddress = [];

	//Массив данных из бд registry
	var dataReg = new Array();

	$.getJSON('../modules/registry/src/getAllReg.php', function(data){
		for (var i = 0; i < data.length; i++) {
			var address = "г." + data[i].town + ", ул. " + data[i].street + ", д. " + data[i].house; //Строка с адресом ТСЖ
            masAddress[i] = address;
			dataReg[i] = new Array(2);
			dataReg[i][0] = address; //Строка с адресом ТСЖ
			dataReg[i][1] = data[i]; //Объект с данными о конкректном ТСЖ
		}
	});
	//Посключение автозапосления
	$( "#str" ).autocomplete({
		source: masAddress,
		maxHeight: 400, // Максимальная высота списка подсказок, в пикселях
		zIndex: 9999, // z-index списка
		//При выборе из списка срабатывает функция
		select: function(event, ui){
			for(var i = 0; i<masAddress.length; i++){
				if(ui.item.value == dataReg[i][0]){
					var mapObject = dataReg[i][1];
					mapTsz(mapObject);
					break;
				}
			}
            //Убираем полосы прокрутки
			$("body").css({"overflow": "hidden" });
			//Добавляем полупрозрачный фон
			$('body').append('<div class="pageWindows"></div>');
			$(".pageWindows").css("display", "block");

			var left = ($(window).width()/2-$(".modalWindowMap").width()/2);
			var top = ($(window).height()/2-$(".modalWindowMap").height()/2);
            //Отображаем окно на странице
			$(".modalWindowMap").css({"left": left + "px", "top": top + "px" });
			$(".modalWindowMap").css("display", "block");
		}
	});
    //При нажатии на кнопку поиска
	$("#scan").click(function(){
		var address = $("#str").val();

        if(address != ""){
			directGeocode(address);
			//Убираем полосы прокрутки
			$("body").css({"overflow": "hidden" });
			//Добавляем полупрозрачный фон
			$('body').append('<div class="pageWindows"></div>');
			$(".pageWindows").css("display", "block");

			var left = ($(window).width()/2-$(".modalWindowMap").width()/2);
			var top = ($(window).height()/2-$(".modalWindowMap").height()/2);
			//Отображаем окно на странице
			$(".modalWindowMap").css({"left": left + "px", "top": top + "px" });
			$(".modalWindowMap").css("display", "block");
		}
});

    //Прямое геокодирование
	function directGeocode(address) {
		var flagSearchBD = false;

		ymaps.ready(init);
		function init() {
			// Поиск координат address
			ymaps.geocode(address, {
				results: 1
			}).then(function (res) {
				// Выбираем первый результат геокодирования.
				var firstGeoObject = res.geoObjects.get(0);
				// firstGeoObject.geometry.getCoordinates() - Координаты геообъекта.
				//firstGeoObject.properties.get('boundedBy') -  Область видимости геообъекта

				//Поиск совпадений в базе по координатам
				for(var i = 0; i<dataReg.length; i++){
					if(firstGeoObject.geometry.getCoordinates() == dataReg[i][1].breadth + "," + dataReg[i][1].longitude){
						flagSearchBD = true;
						var mapObject = dataReg[i][1];
						break;
					}
				}

                if(flagSearchBD){
					mapTsz(mapObject)
				}
				else{
					mapGeacode(firstGeoObject);
				}
			});
		}
	}

	//Карта с результатом поиска ТСЖ
	function mapTsz(mapObject){
		ymaps.ready(init);
		var myMap;

		function init(){
			myMap = new ymaps.Map("mapSearch", {
				center: [mapObject.breadth, mapObject.longitude],
				zoom: 16
			});
			if(mapObject.breadth != -1 && mapObject.longitude != -1){
				var myGeoObjects = new ymaps.GeoObject({
					geometry: {
						type: "Point",
						coordinates: [mapObject.breadth ,mapObject.longitude]
					},
					properties: {
						balloonContentHeader: "<p class=mapHeader>ТСЖ \"" + mapObject.title + "\"</p>", //Баллун для метки
						clusterCaption: '<p class=mapHeader>ТСЖ \"' + mapObject.title + '\"</p>',
						balloonContentBody: "<div class='mapContent'><div class='mapImage'><img src='/files/Registry/" + mapObject.logo + "'></div><div class='mapText'><p><strong>Адрес:</strong> "  + "г." + mapObject.town + ", ул. " + mapObject.street + ", "+  mapObject.house +"</p>" +
						"<p><strong>Телефон: </strong> " + mapObject.phoneNumber + "</p>" +
						"<p><strong>Факс: </strong> " + mapObject.fax + "</p>" +
						"<p><strong>E-mail:</strong> " + mapObject.e_mail + "</p>"+
						"<p><strong>Председатель:</strong> " + mapObject.surnamePresident + " " + mapObject.namePresident + " " + mapObject.patronymicPresident + "</p>" +
						"<p><strong>Сайт:</strong> <a href="+ mapObject.site + "> " + mapObject.site + "</a></p></div></div>",
						hintContent: '<p class=mapHeader>ТСЖ \"' + mapObject.title + '\"</p>',  //Хинт для метки
					},
				},{
					//Цвет маркера
					preset:'islands#greenIcon'
				});
			}
			var myClusterer = new ymaps.Clusterer({
				preset: 'islands#invertedGreenClusterIcons',
				clusterDisableClickZoom: true
			});
			myClusterer.add(myGeoObjects);
			myMap.geoObjects.add(  myClusterer);
		}
	}

	//Карта с результатом геокодирования по введенному названию
	function mapGeacode(firstGeoObject) {
		myMap = new ymaps.Map("mapSearch", {
			center: [53.197167, 45.008982],
			zoom: 16
		});

		// Добавляем первый найденный геообъект на карту.
		myMap.geoObjects.add(firstGeoObject);

		// Масштабируем карту на область видимости геообъекта.
		myMap.setBounds(firstGeoObject.properties.get('boundedBy'), {
			// Проверяем наличие тайлов на данном масштабе.
			checkZoomRange: true
		});

		var myPlacemark = new ymaps.Placemark(firstGeoObject.geometry.getCoordinates(), {
			balloonContentHeader: "<p class=mapHeader>" + firstGeoObject.properties.get('name') + "</p>",
			hintContent: '<p class=mapHeader>'+ firstGeoObject.properties.get('name') +'</p>'
		}, {
			preset:'islands#greenIcon'
		});

		myMap.geoObjects.add(myPlacemark);
	}
});