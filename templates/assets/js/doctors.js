	var countWSNow = 0;
	var specialtiesDirectionArr = [];	
	var hospitalId;
	var commonInfo = new Object();
	var weekMonday, weekSunday, weekNumber;

	
	function modalShow() {
		countWSNow++;
		/*
		$('#exampleModal').arcticmodal({
			closeOnEsc: false,
			closeOnOverlayClick: false
		});
		*/
		$('#selfModal').show();
		$('#textModal').show();

	}

	function modalHide() {
		countWSNow--;
		/*
		if (countWSNow<=0) $('#exampleModal').arcticmodal('close');
		$('#exampleModal').arcticmodal('close');
		*/
		if (countWSNow <= 0) {
			$('#selfModal').hide();
			$('#textModal').hide();
		}
	}

	function isResult(listArray){
		for (var i=0; i<listArray.length; i++){
		    if (($.isEmptyObject(listArray[i]))||(typeof listArray[i] == 'undefined')||(listArray[i] == null)||(listArray[i] == '{}')||(listArray[i] == '[]'))
			return false;
		}
		
		return true;
    }
	
	function callAjax(urlReq, callback, asnc){
		modalShow();
		setTimeout(function() {

		asnc = asnc || false;
		$.ajax({
			dataType: "json",
			type: "GET",
			async: asnc,
			url: urlReq,
			success: function (data) {
				response = data;
				if (isResult([data])){
					callback(data);
				}
			},
			complete: function () {
				modalHide();
			}
		});
		
		}, 500);
	}
	
	function array_chunk( input, size ) {
		for(var x, i = 0, c = -1, l = input.length, n = []; i < l; i++){
			(x = i % size) ? n[c][x] = input[i] : n[++c] = [input[i]];
		}

		return n;
	}

	function parseGetParams() { 
		   var $_GET = {}; 
		   var __GET = window.location.search.substring(1).split("&"); 
		   for(var i=0; i<__GET.length; i++) { 
		      var getVar = __GET[i].split("="); 
		      $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1]; 
		   } 
		   return $_GET; 
		} 
	
	function getListRegions() {		
		callAjax("/scripts/ajax.php?module_name=webservice&name=getListRegions", getListRegions_callback);
	
		function getListRegions_callback(dataResponse) {
			if (isResult([dataResponse.data, dataResponse.data[0], dataResponse.data[0].regions])) {
				listRegionsPenza = dataResponse.data[0].regions;
				var count = Math.ceil(listRegionsPenza.length/3);
				listRegionsPenzaChunk = array_chunk(listRegionsPenza, count);
				list = '<tr>';
				
				for (var i = 0; i < listRegionsPenzaChunk.length; i++) {
					list += '<td><ul class="listRegions">';
					$(listRegionsPenzaChunk[i]).each(function(j){
						list += '<li id="'+ listRegionsPenzaChunk[i][j].code + '"><a href="#'+ listRegionsPenzaChunk[i][j].code + '">' + listRegionsPenzaChunk[i][j].name + '</a></li>';
					});
					list += '</ul></td>';
				}
				list += '</tr>';
				
				$('table#listRegionsTable').html(list);
				
				
				$('table#listRegionsTable ul.listRegions li a').click(function(){
					getListHospitals($(this).parent('li').attr('id'));
					commonInfo['region'] = $(this).parent('li').attr('id');
					return false;
				});
				
				
				return listRegionsPenza;
			}	
		}	
	}
	
	
	function getListHospitals(ocatoCode) {		
		$('#commonInfoTableWrap').hide();
		callAjax("/scripts/ajax.php?module_name=webservice&name=getListHospitals&ocatoCode="+ocatoCode, getListHospitals_callback);		
		function getListHospitals_callback(dataResponse) {
			if (isResult([dataResponse.data, dataResponse.data[0], dataResponse.data[0].hospitals])){
				listLpu = dataResponse.data[0].hospitals;
				var count = Math.ceil(listLpu.length/3);
				listLpuChunk = array_chunk(listLpu, count);
				
				list = '<tr>';		
				if (typeof listLpu.length == 'undefined') {
					list += '<td><ul class="listHospitals">';
					
					list += '<li id="'+ listLpu.uid + '"><a href="#'+ listLpu.uid + '">' + listLpu.name + '</a></li>';
				
					list += '</ul></td>';
				} else {
					for (var i = 0; i < listLpuChunk.length; i++) {
						list += '<td><ul class="listHospitals">';						
						$(listLpuChunk[i]).each(function(j){
							list += '<li id="'+ listLpuChunk[i][j].uid + '"><a href="#'+ listLpuChunk[i][j].uid + '" >' + listLpuChunk[i][j].name + '</a></li>';
						});
						list += '</ul></td>';
					}
				}
				
				
				list += '</tr>';
				$('table#listLpuTable').html(list);
				
				$('#myTab a[href="#tabname_2"]').tab('show');
				
				$('table#listLpuTable ul.listHospitals li a').click(function(){
					getHospitalInfo($(this).parent('li').attr('id'));
					return false;
				});
				
				return listLpu;
			}						
		}	
	}
	
	
	function getHospitalInfo(hospital_id) {
		$('div#specialtiesDirection').hide();
		$('div#specialists').hide();
		callAjax("/scripts/ajax.php?module_name=webservice&name=getHospitalInfo&hospital_id="+hospital_id, getHospitalInfo_callback);
				
		function getHospitalInfo_callback(dataResponse) {
			if (isResult([dataResponse.data, dataResponse.data[0], dataResponse.data])){
				hospitalInfo = dataResponse.data[0].info;
				
				commonInfo['lpuName'] = hospitalInfo.name;
				commonInfo['lpuEmail'] = isResult([hospitalInfo.email]) ? hospitalInfo.email : 'Не указан';
				commonInfo['lpuPhone'] = isResult([hospitalInfo.phone]) ? hospitalInfo.phone : 'Не указан';
				$('#commonInfoTableWrap').show();
				$('table#commonInfoTable').html('');
				$('table#commonInfoTable').append('<tr><td><b>Лечебное учреждение: </b></td><td>' + commonInfo['lpuName'] + '</td></tr>');
				$('table#commonInfoTable').append('<tr><td><b>Телефон: </b></td><td>' + commonInfo['lpuPhone'] + '</td></tr>');
				$('table#commonInfoTable').append('<tr><td><b>Электронная почта: </b></td><td>' + commonInfo['lpuEmail'] + '</td></tr>');
				
				list = '';
				if (!isResult([hospitalInfo.buildings])){
					list += '<td>Подразделений не найдено!</td>';
				} else {
					list += '<ul class="listSubdivision">';
					if (typeof hospitalInfo.buildings.length == 'undefined') {												
//						list += '<li id="'+ hospitalInfo.buildings.uid + '"><a href="#'+ hospitalInfo.buildings.id + '" address="'+ hospitalInfo.buildings.address + '">' + hospitalInfo.buildings.name + ' (' + hospitalInfo.buildings.address + ')'+ '</a></li>';
						list += '<li id="'+ hospitalInfo.buildings.uid + '"><a href="#'+ hospitalInfo.buildings.id + '" address="'+ hospitalInfo.buildings.address + '">' + hospitalInfo.buildings.name + '</a></li>';
					} else {
						for (var i = 0; i < hospitalInfo.buildings.length; i++) {
							//list += '<li id="'+ hospitalInfo.buildings[i].uid + '"><a href="#'+ hospitalInfo.buildings[i].id + '" address="'+ hospitalInfo.buildings[i].address + '">' + hospitalInfo.buildings[i].name  + ' (' + hospitalInfo.buildings[i].address + ')'+  '</a></li>';
							list += '<li id="'+ hospitalInfo.buildings[i].uid + '"><a href="#'+ hospitalInfo.buildings[i].id + '" address="'+ hospitalInfo.buildings[i].address + '">' + hospitalInfo.buildings[i].name + '</a></li>';
						}
					}
					list += '</ul>';
				}
				
				$('div#hospitalInfoTable').html(list);
				
				
				$('div#tabname_3').find('div#specialtiesDirection li').removeClass('activeRecord');
				$('div#tabname_3').find('div#specialists li').removeClass('activeRecord');
				
				
				$('#myTab a[href="#tabname_3"]').tab('show');
				
				$('div#hospitalInfoTable ul.listSubdivision li a').click(function(){
					commonInfo['lpuIdSub'] = $(this).parent('li').attr('id');
					commonInfo['lpuSubName'] = $(this).text();
					commonInfo['lpuSubAddress'] = $(this).attr('address');
					
					$('div#tabname_3').find('li').removeClass('activeRecord');
					$(this).parent('li').addClass('activeRecord');
					hospitalId = $(this).parent('li').attr('id');
					getSpecialtiesDirection(hospitalId);
					return false;
				});
				
				return hospitalInfo;
			}						
		}		
	}
	
	
	
	function getSpecialtiesDirection(subdivision_id) {
		callAjax("/scripts/ajax.php?module_name=webservice&name=getSpecialtiesDirection&subdivision_id="+subdivision_id, getSpecialtiesDirection_callback);
		
		function getSpecialtiesDirection_callback(dataResponse) {
			if (isResult([dataResponse.data, dataResponse.data[0].speciality])){
				$('div#specialtiesDirection').show();
				specialtiesDirection = dataResponse.data[0].speciality;
				
				list = '';
				
				if (typeof specialtiesDirection.speciality != 'undefined') {
					specialtiesDirectionArr[0] = new Object({'name': 'N_0', 'value': specialtiesDirection.speciality});
				} else {
					for (var i = 0; i < specialtiesDirection.length; i++) {
						specialtiesDirectionArr[i] = new Object({'name': 'N_'+i, 'value': specialtiesDirection[i].speciality});
					}
				}
				
				
				
				list += '<ul class="listSpecialtiesDirection">';
				if (typeof specialtiesDirection.speciality != 'undefined') {
					list += '<li id="'+ specialtiesDirectionArr[0].name + '"><a href="#'+ specialtiesDirectionArr[0].name + '">' +specialtiesDirection.speciality + '</a></li>';
				} else {
					for (var i = 0; i < specialtiesDirection.length; i++) {
												
						list += '<li id="'+ specialtiesDirectionArr[i].name + '"><a href="#'+ specialtiesDirectionArr[i].name + '">' +specialtiesDirection[i].speciality + '</a></li>';
	
					}
				}
				
				list += '</ul>';
				
				$('div#specialists').hide();
				$('div#specialtiesDirection').html(list);
				
				$('div#specialtiesDirection ul.listSpecialtiesDirection li a').click(function(){
					commonInfo['specialty'] = $(this).text();
					
					$('div#tabname_3').find('div#specialtiesDirection li').removeClass('activeRecord');
					$('div#tabname_3').find('div#specialists li').removeClass('activeRecord');
					$(this).parent('li').addClass('activeRecord');
					
					IdNum = $(this).parent('li').attr('id').split('_').pop();
					
					specialty = specialtiesDirectionArr[IdNum].value;
					getSpecialists(hospitalId, specialty);
					return false;
				});
				
				return specialtiesDirection;
			}
		}
	}
	
	
	function getSpecialists(hospitalId, specialty) {
		callAjax("/scripts/ajax.php?module_name=webservice&name=getSpecialists&hospitalId=" + hospitalId + "&specialty="+specialty, getSpecialists_callback);
		function getSpecialists_callback(dataResponse) {
			
			if (isResult([dataResponse.data])){
				$('div#specialists').show();
				specialists = dataResponse.data[0].doctors;
				
				list = '';				
				list += '<ul class="specialistList">';	
				if (typeof specialists.speciality != 'undefined') {
					list += '<li id="'+ specialists.uid + '"><a href="#'+ specialists.uid + '">' +specialists.name.lastName  + ' '  +specialists.name.firstName  + ' '  +specialists.name.patronymic  +   '</a></li>';
				} else {
					for (var i = 0; i < specialists.length; i++) {
						list += '<li id="'+ specialists[i].uid + '"><a href="#'+ specialists[i].uid + '">' +specialists[i].name.lastName  + ' '  +specialists[i].name.firstName  + ' '  +specialists[i].name.patronymic  +   '</a></li>';

					}
				}
								
				list += '</ul>';				
				$('div#specialists').html(list).show();
				
				$('div#specialists ul.specialistList li a').click(function(){
					weekNumber = '';
					commonInfo['doctorId'] = $(this).parent('li').attr('id');
					commonInfo['doctorFio'] = $(this).text();
					
					$('div#tabname_3').find('li div#specialists').removeClass('activeRecord');
					$(this).parent('li').addClass('activeRecord');
					
					getTime($(this).parent('li').attr('id'));
					return false;
				});
				
				return specialists;
			}
	
		}
	}
	
	
	function getTime(doctorId) {
	timeRecordTable = new Object();
		t = new Date();
		
		weekDates = getWeekDates(t.getFullYear(), (typeof weekNumber == 'undefined' || weekNumber == '') ? getWeekNum() : weekNumber);
		
		callAjax("/scripts/ajax.php?module_name=webservice&name=getTime&hospitalId=" + hospitalId + "&doctorId="+doctorId + '&startDate='+weekDates[0] + '&endDate='+weekDates[6], getTime_callback);
		function getTime_callback(dataResponse) {
			
			if (isResult([dataResponse.data, dataResponse.data[0], dataResponse.data[0].timeslots])){
				timetable = dataResponse.data[0].timeslots;

				for (var i = 0; i < timetable.length; i++) {
					if (typeof timeRecordTable[timetable[i].start.split('T').shift()] == 'undefined') {
						weekSundayReverse = weekSunday.split('-');
						weekSundayReverse = weekSundayReverse[2] + '-' + weekSundayReverse[1] + '-' + weekSundayReverse[0];
						if (timetable[i].start.split('T').shift() >= weekSundayReverse) {
							break;
						} else {
							timeRecordTable[timetable[i].start.split('T').shift()] = [];
						}
					}
										
					timeRecordTable[timetable[i].start.split('T').shift()].push(timetable[i]);
				}
				
				
				
				list = '';
				list += '<table border="0"><tr>';
				
				for (var num in weekDates) {
					dateVal = weekDates[num];
					var dateName = new Date(dateVal);
						dateName = getDayName(dateName.getDay());
					var d = dateToYMD(new Date(dateVal), 1);
					
					list += '<td><span><b>' + d + ', ' + dateName + '</b></span><ul class="timeList">';
					if (typeof timeRecordTable[dateVal] != 'undefined') {
						for (var i = 0; i < timeRecordTable[dateVal].length; i++) {
							if (new Date() > new Date(timeRecordTable[dateVal][i].start)) {
								list += '<li id="'+ timeRecordTable[dateVal][i].start + '"><button officeNumber="' + timeRecordTable[dateVal][i].office + '"  class="disabled btn btn-block time_btn btn-inverse">' + timeRecordTable[dateVal][i].start.split('T').pop()  +   '</button></li><div class="rule_line_div"></div>';
							} else if (timeRecordTable[dateVal][i].status == 'locked' || timeRecordTable[dateVal][i].status == 'disabled') {
								list += '<li id="'+ timeRecordTable[dateVal][i].start + '"><button officeNumber="' + timeRecordTable[dateVal][i].office + '" class="disabled btn btn-block time_btn btn-danger">' + timeRecordTable[dateVal][i].start.split('T').pop()  +   '</button></li><div class="rule_line_div"></div>';
							} else {
								list += '<li id="'+ timeRecordTable[dateVal][i].start + '"><button officeNumber="' + timeRecordTable[dateVal][i].office + '" class="btn btn-block time_btn btn-success">' + timeRecordTable[dateVal][i].start.split('T').pop() +   '</button></li><div class="rule_line_div"></div>';
							}
						}
					}
					list += '</ul></td>';
				}				
				list += '</tr></table>';

				$('div#timeTable').html(list);
				
				var infoHtml = '';
				infoHtml = '<tr><td><b>Лечебное учреждение: </b></td><td>' + commonInfo['lpuName'] + '</td></tr>';
				infoHtml += '<tr><td></td><td>' + commonInfo['lpuSubName'] + '</td></tr>';
				infoHtml += '<tr><td><b>Телефон: </b></td><td>' + commonInfo['lpuPhone'] + '</td></tr>';
				
				infoHtml += '<tr><td><b>Специализация: </b></td><td>' + commonInfo['specialty'] + '</td></tr>';
				infoHtml += '<tr><td><b>Врач: </b></td><td>' + commonInfo['doctorFio'] + '</td></tr>';
				
			
				$('#commonInfoTable').html(infoHtml);
				$('#myTab a[href="#tabname_4"]').tab('show');
				
				$('div#timeTable ul.timeList li button').click(function(){
					if ($(this).hasClass('disabled')) {
						$('#myTab a[href="#tabname_4"]').tab('show');
						return;
					} else {
						var timeRecord = $(this).parent('li').attr('id').split('T');
						var timeRecordDate = timeRecord[0].split('-');
						var timeRecordTime = timeRecord[1];
						timeRecordDate = timeRecordDate[2] + '-' + timeRecordDate[1] + '-' + timeRecordDate[0];
						commonInfo['timeslot'] = $(this).parent('li').attr('id');
						commonInfo['timeslotSplit'] = timeRecordDate + ' ' + timeRecordTime;
						commonInfo['officeNumber'] = $(this).attr('officeNumber');
						
						$('#commonInfoTable').append('<tr><td><b>Кабинет: </b></td><td>' + commonInfo['officeNumber'] + '</td></tr>');
						$('#commonInfoTable').append('<tr><td><b>Дата и время приёма: </b></td><td>' + commonInfo['timeslotSplit'] + '</td></tr>');
						
						
						$('#myTab a[href="#tabname_5"]').tab('show');
						return false;
					}					
				});
				
				return timetable;
			} else {
				list = '';
				list += '<table border="0">';
				list += '<tr><td colspan="7">На данную неделю (' + weekMonday + ' - ' + weekSunday +') расписание отсутствует!</td></tr></table>';
				$('div#timeTable').html(list);
				$('#myTab a[href="#tabname_4"]').tab('show');
			}
		}
	}
	
	
	function getEnqueue(lastName, firstName, patronymic, document, type, sex, birthday, series, number) {
		if (document == '') {
			documentType = '';
		} else {
			documentType = '&document='+document;
		}
		
		if (type == 'client_id') {
			type_val = '';
		} else {
			type_val =  '&type='+type;
			if (series == '') {
				serialNum = '';
			} else {
				serialNum = '&series='+series;
			}
		}
		
		var getStr = 'doctorId='+commonInfo['doctorId']+'&sex='+sex+'&timeslot='+commonInfo['timeslot'];
			getStr += '&firstName='+firstName+'&lastName='+lastName+'&patronymic='+patronymic+'&birthday='+birthday;
			getStr += documentType+type_val+serialNum +'&number='+number+'&hospitalIdSub='+commonInfo['lpuIdSub'];
		
		callAjax("/scripts/ajax.php?module_name=webservice&name=getEnqueue&"+getStr, getEnqueue_callback);
		function getEnqueue_callback(dataResponse) {
			
			if (isResult([dataResponse.data])){
				record = dataResponse.data[0];
				
				commonInfo['ticketId'] = record.ticketUid
				
				$('#ticketId').text(commonInfo['ticketId']);
				$('#pacientFio').text(commonInfo['pacientFio']);
				$('#pacientBirth').text(commonInfo['pacientBirth']);
				
				
				$('#policeNumber').text(commonInfo['policeNumber']);
				$('#hospitalName').text(commonInfo['lpuName']);
				$('#hospitalSub').text(commonInfo['lpuSubName']);
				$('#hospitalPhone').text(commonInfo['lpuPhone']);
				$('#doctorFio').text(commonInfo['doctorFio']);
				$('#doctorSpecialty').text(commonInfo['specialty']);
				$('#doctorCab').text(commonInfo['officeNumber'] + ' каб.');
				
				$('#dateRecord').text(commonInfo['timeslotSplit']);
				
				if(record.result == 'true') {
					$('#myTab a[href="#tabname_6"]').tab('show');
					$('#selfModal').hide();
					$('#textModal').hide();
					var GETArr = parseGetParams();
					callAjax("/scripts/ajax.php?module_name=webservice&name=pacientRecorded&subservice_id="+GETArr['subservice_id']+"&ticketId="+commonInfo['ticketId']+"&lpu="+commonInfo['lpuIdSub'], pacientRecorded_callback);
					function pacientRecorded_callback() {
						
						return false;
					}
				} else {
					$('div.error_message').html('<span>Вы не зарегистрированы в этом ЛПУ. В случае, если это не так, пожалуйста, позвоните в регистратуру для обновления информации</span>');
					$('div.error_message').show();
					$('#myTab a[href="#tabname_5"]').tab('show');
				}
				
				return record;
			}
		}
	}
	
	
	function doctorRecordCancel(idOut, idRequest, idSubservice) {
		idOut = idOut.split('&');
		var ticketId = idOut[0];
		var lpuId = idOut[1].split('=');
		lpuId = lpuId[1];
		
		callAjax("/scripts/ajax.php?module_name=webservice&name=doctorRecordCancel&ticketId="+ticketId+"&lpuId="+lpuId, doctorRecordCancel_callback);
		function doctorRecordCancel_callback(dataResponse) {
			if (isResult([dataResponse.data])){
				cancelResult = dataResponse.data[0];
				callAjax("/scripts/ajax.php?module_name=webservice&name=recordCanceled&idRequest="+idRequest+"&subservice_id="+idSubservice, recordCanceled_callback);
				function recordCanceled_callback(dataResponse) {
					window.location = "/account";
				}
				return cancelResult;
			}			
		}
	}
	
	

	//Форматирование даты 
	function dateToYMD(date, direction) { 
		var d = date.getDate(); 
		var m = date.getMonth() + 1; 
		var y = date.getFullYear(); 
		if (direction == 1) {
			// форматирование вида дд-мм-гггг
			return '' + (d <= 9 ? '0' + d : d) + '-' + (m<=9 ? '0' + m : m) + '-' + y;
		} else {
			// форматирование вида гггг-мм-дд
			return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
		}		 
	}
	
	//определение недели
	var getWeekNum = function(dt) {
	    var ts, newYear, newYearDay, wNum;	       

	    ts = (dt) ? new Date(dt) : new Date();
	    newYear = new Date(ts.getFullYear(), 0, 1);
	    newYearDay = newYear.getDay();
	    wNum = Math.ceil(((ts.getTime() - newYear.getTime())/1000/60/60/24 + newYearDay)/7);

	    weekNumber = wNum;
	    
	    return wNum;
	}

	// определение дат текущей недели	
	function getWeekDates(year, week) {
		var c = 8-(new Date(year,0,week*7)).getDay();
		var weekDates, monday, tuesday, wednesday, thursday, friday, saturday, sunday;
		weekMonday = dateToYMD(new Date(year,0,(week-2)*7+c), 1);
		weekSunday = dateToYMD(new Date(year,0,(week-2)*7+c+6), 1);
		
		monday = dateToYMD(new Date(year,0,(week-2)*7+c), 0);
		tuesday = dateToYMD(new Date(year,0,(week-2)*7+c+1), 0);
		wednesday = dateToYMD(new Date(year,0,(week-2)*7+c+2), 0);
		thursday = dateToYMD(new Date(year,0,(week-2)*7+c+3), 0);
		friday = dateToYMD(new Date(year,0,(week-2)*7+c+4), 0);
		saturday = dateToYMD(new Date(year,0,(week-2)*7+c+5), 0);
		sunday = dateToYMD(new Date(year,0,(week-2)*7+c+6), 0);
		weekDates = [monday, tuesday, wednesday, thursday, friday, saturday, sunday];
		return weekDates;
	}
	
	
	function getDayName(dt) {
		var name;
		switch(dt) {
		  case 0: name = "Вc."; break;
		  case 1:name = "Пн."; break;
		  case 2:name = "Вт."; break;
		  case 3:name = "Ср."; break;
		  case 4:name = "Чт."; break;
		  case 5:name = "Пт."; break;
		  case 6:name = "Сб."; break;
		}

		
		return name;
	}
	
	
	function setNonActiveTabs() {
		$('#myTab').find('.active').nextAll('li').find('a').removeAttr('data-toggle');
	}
	
	
	$(document).ready(function(){
		$('.step1').click(function(){
			$('#myTab a[href="#tabname_1"]').tab('show');
			setNonActiveTabs();
		});
		
		$('.step2').click(function(){
			$('#myTab a[href="#tabname_2"]').tab('show');
			setNonActiveTabs();
		});
		
		$('.step3').click(function(){
			$('#myTab a[href="#tabname_3"]').tab('show');
			$('div#tabname_3').find('div#specialists li').removeClass('activeRecord')
			setNonActiveTabs();
		});
		
		$('ul#myTab li a').click(function(){
			setNonActiveTabs();
		});
		
		$('body').find('.rule').css('border', '1px solid #ffffff');
		$('#ambulanceCard').hide();
		$('#card_number').removeAttr('required');
		$('#seriesTr').hide();
		$('#series').removeAttr('required');
		$('div.error_message').hide();
		
	//  Проверка чекбокса "Согласие..."   
	    $('#confirm').click(function() {
	        if($(this).is(':checked')){
	            $('#button-submit').removeClass('disabled').attr('disabled', false);
	        } else {
	            $('#button-submit').addClass('disabled').attr('disabled', true);
	        }
	    });
	    
	    
	    $('button#button-submit').click(function(){
	    	var lastName, firstName, patronymic, document, type, sex, birthday;
	    	lastName = $('#lastName').val();
	    	firstName = $('#firstName').val();
	    	patronymic = $('#patronymic').val();
	    	series = $('#series').val();
	    	number = $('#number').val();
	    	document = '';
	    	
	    	type = $('select#doc_type_selector option:selected').val();
	    	
	    	if (type == '' ) {
	    		alert('Выберите тип документа!');
	    		return false;
	    	} 
	    		
	    	if (type.indexOf('policy_type') != -1) {
	    		type = type.substr( type.length - 1, 1 );
	    		document = 'policy';
	    	}
	    	
	    	if (type.indexOf('doc_type') != -1) {
	    		type = type.substr( type.length - 1, 1 );
	    		document = 'document';
	    	}
	    	
	    	sex = $('input:radio[name=radio]:checked').val();
	    	
	    	birthday = $('#birthDay').val();
	    	
	    	commonInfo['pacientFio'] = lastName + ' ' + firstName + ' '  + patronymic;
	    	commonInfo['pacientBirth'] = birthday;
	    	commonInfo['policeNumber'] = number;
	    	
	    	getEnqueue(lastName, firstName, patronymic, document, type, sex, birthday, series, number);
			return false;
		});
	    
	    
	    $('#button-close-form').click(function(){
	    	window.location = "/";
	    });
	    
	    
	    $('select#doc_type_selector').change(function(){
	    	var policyType = $(this).val();	    	
	        if (policyType.indexOf('doc_type') != -1){
	        	$('#seriesTr').show();
	        	$('#seriesTr span.marker').show();
	        	$('#series').attr('required', 'required');	        	
	        } else if (policyType.indexOf('policy_type') != -1) {
        		$('#series').removeAttr('required');
        		$('#seriesTr span.marker').hide();
        		policyType = policyType.substr( policyType.length - 1, 1 );
	    		if (policyType == 2 || policyType == 3) {
	    			$('#seriesTr').show();		    			
	    		} else {
	    			$('#seriesTr').hide();			        	
	    		}		    		
		    } else {
		    	$('#seriesTr').hide();
		    	$('#seriesTr span.marker').hide();
		    	$('#series').removeAttr('required');        		
		    }	        
	    });
	    
	    
	    $('button#timePrevWeek').click(function(){
	    	weekNumber--;
	    	getTime(commonInfo['doctorId']);
	    });
	    
	    $('button#timeNextWeek').click(function(){
	    	weekNumber++;
	    	getTime(commonInfo['doctorId']);
	    });
	});