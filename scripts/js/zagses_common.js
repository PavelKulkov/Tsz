		var countWSNow = 0;
		
		function modalShow() {
		countWSNow++;
		$('#exampleModal').arcticmodal({
			closeOnEsc: false,
			closeOnOverlayClick: false
		});

		}

		function modalHide() {
		countWSNow--; if (countWSNow<=0) $('#exampleModal').arcticmodal('close');
			$('#exampleModal').arcticmodal('close');
		}
		
		
		function setZagses(id, addressId, us){
			callAjax("/scripts/ajax.php?module_name=webservice&name=getZagses", getZagses_callback);

			function getZagses_callback(dataResponse){
				zagses = dataResponse.data;	
				us = us || "ALL";
				if (isResult([dataResponse.data]))
					setZags(id, dataResponse.data, addressId, us);
				else{
					alert("К сожалению нет доступных ЗАГСов");
					
				}
				return zagses; 
			}
		} 
		
		function callAjax(urlReq, callback, asnc){
			modalShow();
			setTimeout(function() {
	
			asnc = asnc || false;
			$.ajax({
				dataType: "json",
				type: "GET",
				async: asnc,
				timeout:8000,
				url: urlReq,
				success: function (data) {
					response = data;
					if (isResult([data])){
						callback(data);
					}
				},
				complete: function () {modalHide();},
				error:  function () {
						modalHide();
						alert("К сожалению не удалось получить данные. Приносим свои извинения!");
				}
			});
			
			}, 500);
		}

		function setDictionary(dic, id, default_value, text){
			callAjax("/scripts/ajax.php?module_name=webservice&name=getDictionary&dictionaryName="+dic, getDictionary_callback);

			function getDictionary_callback(dataResponse){
				dic = dataResponse.data;
				if (isResult([dic])){
						var options = "<option value='' selected title=''>--- Выберите ---</option>";
						if (text == 'true'){
							for (var i=0; i < dic.length; i++){
								options += "<option value='"+dic[i].value+"'>"+dic[i].value+"</option>";					
							}
						}else{
							for (var i=0; i < dic.length; i++){
								options += "<option value='"+dic[i].name+"'>"+dic[i].value+"</option>";					
							}							
						}
						if($.isArray(id)){
							for (var i = 0; i < id.length; i++){
								$("#"+id[i]).html(options);
							}
						}else{
							$("#"+id).html(options);	
						}
						if (isDefined(default_value)){
							if($.isArray(id)){
								for (var i = 0; i < id.length; i++){
									$("#"+id[i]+" option[value='"+default_value+"']").attr("selected","selected");
								}	
							}else{
								$("#"+id+" option[value='"+default_value+"']").attr("selected","selected");	
							}
						}
				}   
				return dic;
			}
		}

		function isDefined(val){
		    	return !(typeof val == 'undefined');
		}

		var kladrUrl = "/scripts/ajax.php?module_name=webservice&name=getKladr&dictionaryCode=";

		function setCountries(countriesIdArr){
			callAjax(kladrUrl+"COUNTRIES", getCountries_callback);
			function getCountries_callback(dataResponse){
				countries = JSON.parse(dataResponse.data);			
				for (var i = 0; i < countriesIdArr.length; i++){
					setKladr(countries, countriesIdArr[i]);		
				}
				return countries;
			}
		}

		function setRegions(regionsIdArr){
			callAjax(kladrUrl+"KLADRRegion", getRegions_callback);
			function getRegions_callback(dataResponse){
				regions = JSON.parse(dataResponse.data);			
				for (var i = 0; i < regionsIdArr.length; i++){
					setKladr(regions, regionsIdArr[i]);		
				}
				return countries;
			}
		}

		function setKladrByIds(idArray, without){
			var countriesId = idArray[0];
			var regionId = idArray[1];
			var settlementParentId = idArray[2];
			var settlementId = idArray[3];
			var partOfCity = idArray[4];
			var city = idArray[5];
			var isHand = idArray[6];
			var regionIdHand = idArray[7];
			var rayon = idArray[8];
			var settlementIdHand = idArray[9];
			var settlementIdType = idArray[10];
			addRequired([countriesId, regionId, city, settlementIdType, settlementIdHand]);
			removeRequired([settlementParentId, settlementId, regionIdHand, rayon]);
			var isStreet = isDefined(idArray[11]);
			var streetId='', streetIdHand='', streetIdType='';
			if (isStreet){
				streetId = idArray[11];
				streetIdHand = idArray[12];
				streetIdType = idArray[13];
				addRequired([streetId, streetIdHand, streetIdType]);
			}
			
			if (isDefined(without)){
				$("#"+without).change(function(){
					if ($(this).attr("checked")){
						$("#"+without).closest("table").find('tr').hide();
						$("#"+without).closest("tr").show();
						/*for (var i=0; i < idArray.length; i++){
							$("#"+idArray[i]).attr("disabled","disabled");			
						}*/
					}else{
						$("#"+without).closest("table").find('tr').show();
						$("#"+isHand).change();
						$("#"+partOfCity).change();
						/*for (var i=0; i < idArray.length; i++){
							$("#"+idArray[i]).removeAttr("disabled","disabled");			
						}*/
					}
				});
			}

			$("#"+regionIdHand).attr("placeholder", "Например: Тульская область");
			$("#"+rayon).attr("placeholder", "Например: Алексинский район");

			$("#"+regionId).change(function(){
				if (this.value != ""){
					var code = $("#"+this.id + " option:selected").attr("code");
					callAjax(kladrUrl+"KLADRRegion&parentItemCode="+code, getSettlement_callback);
					if (isStreet){
						$("#"+streetId).html("");
						if ((this.value == "77000000000") || (this.value == "78000000000")||(code == "77000000000") || (code == "78000000000")){
							$("#"+settlementId).html("<option code='"+code+"' value='"+this.value+"'>"+this.value+"</option>");
							callAjax(kladrUrl+"KLADRStreet&parentDictionaryCode=KLADRRegion&parentItemCode="+code, getStreets_callback);
							$("#"+settlementParentId+" option[value='']").text("");
						}
					}
				}else{
					$("#"+settlementParentId).attr("disabled", "disabled");
					$("#"+settlementParentId).html('');
					if (isStreet)
						$("#"+streetId).html("");
				}
				$("#"+settlementId).hide();
			});

			function getSettlement_callback(dataResponse){
				settlement = null;
				if (isResult([dataResponse.data])){
					settlement = JSON.parse(dataResponse.data);
					if (settlement.total != 0) {
						$("#"+settlementParentId).show();
						$("#"+settlementParentId).removeAttr("disabled");
						setKladr(settlement, settlementParentId);
					}else{
						$("#"+settlementId).hide();
						$("#"+settlementParentId).attr("disabled", "disabled");
					}
				}
				return settlement;
			}


			$("#"+settlementParentId).change(function(){
				if (this.value != ""){
					var code = $("#"+this.id + " option:selected").attr("code");
					callAjax(kladrUrl+"KLADRRegion&parentItemCode="+code, getSettlementLitle_callback);
					if (isStreet)
						callAjax(kladrUrl+"KLADRStreet&parentDictionaryCode=KLADRRegion&parentItemCode="+code, getStreets_callback);
				}else{
					$("#"+settlementId).hide();
					//$("#"+settlementId + "[value='']").attr("seleced", "seleced");
					//$("#"+settlementId).change();
					$("#"+regionId).change();
				}
			});

			function getSettlementLitle_callback(dataResponse){
				settlementLitle = null;
				if (isResult([dataResponse.data])){
					settlementLitle = JSON.parse(dataResponse.data);
					if (settlementLitle.total == 0) {
						$("#"+settlementId).hide();
						var code = $("#"+settlementParentId + " option:selected").attr("code");
						$("#"+settlementId).html("<option code='"+code+"' value='"+$("#"+settlementParentId).val()+"'>"+$("#"+settlementParentId+" option:selected").val()+"</option>");
						$("#"+settlementId).change();
					}else{
						$("#"+settlementId).show();
						setKladr(settlementLitle, settlementId);
					}
				}			
				return settlementLitle;
			}

			$("#"+settlementId).change(function(){
    				if (isStreet)
					if (this.value != ""){
						var code = $("#"+this.id + " option:selected").attr("code");
						callAjax(kladrUrl+"KLADRStreet&parentDictionaryCode=KLADRRegion&parentItemCode="+code, getStreets_callback);
					}else{
						$("#"+streetId).attr("disabled", "disabled");
						$("#"+streetId).html("");
						$("#"+settlementParentId).change();
					}
			});

			function getStreets_callback(dataResponse){
				streets = null;
				if (isResult([dataResponse.data])){
					streets = JSON.parse(dataResponse.data);
					if (streets.total > 0) {
						setKladr(streets, streetId);
						$("#"+streetId).removeAttr("disabled");
						$("#"+settlementId+" option[value='']").text("");
					}else{
						$("#"+streetId).attr("disabled", "disabled");
						$("#"+streetId).html("");
					}			
				}
				return streets;
			}

			$("#"+countriesId).change(function(){
				var el = $("#"+isHand);
				var code = $("#"+this.id + " option:selected").attr("code");
				if ((this.value != "Россия")||(code != 183)){
					el.attr("checked", "checked");
					el.closest('tr').hide();
				}else{
					el.removeAttr("checked");
					el.closest('tr').show();
				}
				el.change();
			});

			$("#"+partOfCity).change(function(){
					if ($(this).is(":checked")){
						$("#"+city).closest("tr").show();
					}else{
						$("#"+city).closest("tr").hide();
					}
			});
			
			$("#"+settlementIdType).change(function(){
				if ((this.value == '7')||($("#"+this.id+" option:selected").text() == 'г.')){
					$("#"+partOfCity).removeAttr("checked");
					$("#"+partOfCity).change();
					$("#"+partOfCity).closest("tr").hide();
				}else{
					$("#"+partOfCity).closest("tr").show();
				}
			});
			
			if (isStreet){
				$("#"+streetIdType).change(function(){
					if ((this.value == '1')||($("#"+this.id+" option:selected").text() == 'нет улицы')){
						removeRequired([streetIdHand]);
						$("#"+streetIdHand).closest("tr").hide();
					}else{
						addRequired([streetIdHand]);
						$("#"+streetIdHand).closest("tr").show();
					}
				});
			}

			$(document).on("change", "#"+isHand, function () {
				if ($(this).is(":checked")) {
					$("#"+regionId).closest("tr").hide();
					$("#"+settlementParentId).closest("tr").hide();
					$("#"+settlementId).closest("tr").hide();

					$("#"+regionIdHand).closest("tr").show();
					$("#"+rayon).closest("tr").show();	
					$("#"+settlementIdHand).closest("tr").show();	
					$("#"+settlementIdType).closest("tr").show();

					if ($("#"+settlementIdType+" option").length == 0){
						callAjax(kladrUrl+"MR05_SETTELEMENT_TYPE", getSettlementType_callback);
						callAjax(kladrUrl+"MR05_STREET_TYPE", getStreetType_callback);
					}
					if (isStreet){
						$("#"+streetId).closest("tr").hide();
						$("#"+streetIdType).closest("tr").show();
						$("#"+streetIdHand).closest("tr").show();
					}
				} else {
					$("#"+regionId).closest("tr").show();
					$("#"+settlementParentId).closest("tr").show();
					$("#"+settlementId).closest("tr").show();

					$("#"+regionIdHand).closest("tr").hide();
					$("#"+rayon).closest("tr").hide();	
					$("#"+settlementIdHand).closest("tr").hide();	
					$("#"+settlementIdType).closest("tr").hide();

					if (isStreet){
						$("#"+streetId).closest("tr").show();
						$("#"+streetIdType).closest("tr").hide();
						$("#"+streetIdHand).closest("tr").hide();
					}
				}
			});

			function getSettlementType_callback(dataResponse){
				settlementType = null;
				if (isResult([dataResponse.data])){
					settlementType = JSON.parse(dataResponse.data);
					setKladr(settlementType, settlementIdType);
				}
				return settlementType;
			}

			function getStreetType_callback(dataResponse){
				streetType = null;
				if (isResult([dataResponse.data])){
					streetType = JSON.parse(dataResponse.data);
					setKladr(streetType, streetIdType);
				}
				return streetType;
			}
		}

		function setSettlementType(setlmArr){
			callAjax(kladrUrl+"MR05_SETTELEMENT_TYPE", getSettlementType_callback);
			function getSettlementType_callback(dataResponse){
				settlementType = null;
				if (isResult([dataResponse.data])){
					settlementType = JSON.parse(dataResponse.data);
					for (var i=0; i < setlmArr.length; i++){
						setKladr(settlementType, setlmArr[i]);
					}
				}
				return settlementType;
			}
		}

		function setStreetType(strtArr){
			callAjax(kladrUrl+"MR05_STREET_TYPE", getStreetType_callback);
			function getStreetType_callback(dataResponse){
				streetType = null;
				if (isResult([dataResponse.data])){
					streetType = JSON.parse(dataResponse.data);
					for (var i=0; i < strtArr.length; i++){
						setKladr(streetType, strtArr[i]);
					}
					
				}
				return streetType;
			}
		}

	function setKladr(countries, id){
		if (isResult([countries])){
			if (countries.error.code == 0){
				var options = "<option code='' value='' selected title=''>...</option>";
				for (var i=0; i < countries.items.length; i++){
					options += "<option value='"+countries.items[i].text+"' code='"+countries.items[i].code+"' title='"+countries.items[i].text+"'>"+countries.items[i].text+"</option>";					
				}
				$("#"+id).html(options);
				if (countries.title == "Страны")
					$("#"+id + " option[code=183]").attr("selected","selected");
			}
		}   
	}

	    function isResult(listArray){
		for (var i=0; i<listArray.length; i++){
		    if (($.isEmptyObject(listArray[i]))||(typeof listArray[i] == 'undefined')||(listArray[i] == null)||(listArray[i] == '{}')||(listArray[i] == '[]'))
			return false;
		}
		return true;
	    }

	function setZags(id, data, idInf, us){
		var options = "";
		options += "<option idZags='' value='' selected title=''>--- Выберите ---</option>";
		for (var i=0; i<data.length; i++){
			if (isResult([data[i].regAct])){
				if (($.inArray(us, data[i].regAct) >= 0) || (us == "ALL"))
						options += "<option idZags="+data[i].idZags+" value="+data[i].idZags+" title="+data[i].nameZagsPortal+">"+data[i].nameZagsPortal+"</option>";
			}else{
				options += "<option idZags="+data[i].idZags+" value="+data[i].idZags+" title="+data[i].nameZagsPortal+">"+data[i].nameZagsPortal+"</option>";
			}
		}		
		$("#"+id).html(options);
		$("#"+id).change(function(){
			if (this.value == ''){
				$("#"+idInf).val('').closest('tr').hide(); 	
			}else{
				var ind = $("#"+this.id + " option:selected").index()-1;
				var text = "";
				if (isResult([data[ind].telephMain])){
					text += "Контактный телефон: " + data[ind].telephMain + "\n";
				}
				if (isResult([data[ind].adresHttp])){
					text += "URL веб-сайта: " + data[ind].adresHttp + "\n";
				}
				if (isResult([data[ind].adresZags])){
					text += "Адрес: " + getAddress(data[ind].adresZags);
				}
				$("#"+idInf).val(text).closest('tr').show(); 
			}
		});
		if ($("#"+id + ' option').length <= 2){
			if ($("#"+id + ' option').length == 1){ //выберите?
				alert("Не нашлось органов ЗАГС, оказывающих данную услугу. Обратитесь к администратору системы");
				$("#"+id).closest("form").hide();
			}else{	
				$("#"+id + ' :last').attr("selected", "selected");
				$("#"+id).change();
			}
		}
	}

	function getValWithComma(val, socr){
		var res = "";
		if (typeof socr == 'undefined')
			socr = "";
		if (isResult([val])){
			res += socr +" "+ val + ", ";
		}
		return res;		
	}	
	

	function getAddress(adresZags){
		var text = "";
		//Если тэг пуст, то запятую за ним пропускать. За последним значением в строке должна стоять точка
		if (isResult([adresZags])){
			text += getValWithComma(adresZags.gos);
			text += getValWithComma(adresZags.subGos);
			text += getValWithComma(adresZags.rayon);
			text += getValWithComma(adresZags.nasPun, adresZags.typeNP);
			text += getValWithComma(adresZags.street, adresZags.typeStr);
			text += getValWithComma(adresZags.house, "д.");
			text += getValWithComma(adresZags.gos, "корп.");
		}	
		if (text != "")
			text = text.substr(0, text.length-2) + ".";
		return text;
	}
	
	function hideElements(arr){
		for (var i = 0; i < arr.length; i++){
			$("#"+arr[i]).hide();
		}
	}
	
	function showElements(arr){
		for (var i = 0; i < arr.length; i++){
			$("#"+arr[i]).show();
		}
	}
	
	function hideClosestElements(arr, st){
		for (var i = 0; i < arr.length; i++){
			$("#"+arr[i]).closest(st).hide();
		}
	}
	
	function showClosestElements(arr, st){
		for (var i = 0; i < arr.length; i++){
			$("#"+arr[i]).closest(st).show();
		}
	}
	
	function addRequired(arr){
		for (var i = 0; i < arr.length; i++){
			$("#"+arr[i]).addClass("required");
			var td = $("#"+arr[i]).closest('tr').find('td:first');
			if (td.find('span').length == 0)
				td.prepend('<span style="color: red;">*</span>');
		}
	}
	
	function removeRequired(arr){
		for (var i = 0; i < arr.length; i++){
			var el = $("#"+arr[i]);
			if (el.hasClass("required")){
				el.removeClass("required");
				el.closest('tr').find('td:first span').remove();
				if (el.hasClass("error")){
					el.removeClass("error");
				}
			}
		}
	}
	
	function setDocument(arr) {
		var docType = arr[0];
		var seria = arr[1];
		var number = arr[2];
		var date = arr[3];
		var org = arr[4];
		$("#"+docType).change(function() {
			if ((this.value == '1')||(this.value == 'Паспорт гражданина Российской Федерации')){
				$("#"+seria).attr("placeholder", "Введите в формате «XX XХ», где Х - цифры");
				$("#"+seria).mask("99 99");
				$("#"+number).attr("placeholder", "Введите в формате «XXXXXХ», где Х - цифры");
				$("#"+number).mask("999999");
				if ($("#"+seria).hasClass("required_tmp")){
					addRequired([seria]);
				}
				if ($("#"+number).hasClass("required_tmp")){
					addRequired([number]);
				}
				showClosestElements([seria, number, date, org], 'tr');
			}else{
				if ((this.value == 'Нет документа')){
					hideClosestElements([seria, number, date, org], 'tr');
				}else{
					showClosestElements([seria, number, date, org], 'tr');
					$("#"+seria).attr("placeholder", "");
					$("#"+number).attr("placeholder", "");
					$("#"+number).unmask();
					$("#"+seria).unmask();
					if ($("#"+seria).hasClass("required")){
						$("#"+seria).addClass("required_tmp");
						removeRequired([seria]);
					}
					if ($("#"+number).hasClass("required")){
						$("#"+number).addClass("required_tmp");
						removeRequired([number]);
					}
				}
			}
		});
		$("#"+docType).change();
	}

	function clearValues(el){
		$(el).closest(".tab-pane").find("input:hidden, textarea:hidden").val('');
		$(el).closest(".tab-pane").find("select:hidden").each(function(){
			$("#"+this.id+" option[value='']").attr("selected", "selected");
			$("#"+this.id+" option:selected").val('');
		});
	}
