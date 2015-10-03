$(document).ready(function () {
	$("head").append("<script src=\"/templates/assets/js/hoverIntent.min.js\"/>");
	$("head").append("<script src=\"/templates/assets/js/clickTip.js\"/>");
	$("head").append("<link rel=\"stylesheet\" href=\"/templates/assets/css/simpleTip.css\" type=\"text/css\" />");
	$("head").append("<script src=\"/templates/assets/js/rubles.min.js\"/>");
	

	if (getParameterByName("Order_ID")) {
		$("a[href='#tab-2']").click();
		$("a[href='#paymentTab-2']").click();
	}

	$("head").append('<link href="/templates/assets/select2-3.5.1/select2.css" rel="stylesheet"/>');	//скрипт для проставления масок
	$("head").append('<script src="/templates/assets/select2-3.5.1/select2.js"></script>');	//скрипт для проставления масок
	setSelect2($('#paymentDetails select'));
	$("#cancelPayment").hide();
	
	$("[name=supplier_name]").change();
	setRequired();
	
	$("[name=total_amount]").css("width", "100px");
	$("[name=rub]").css("width", "50px");
	$("[name=supplier_oktmo]").css("width", "100px");
	$("[name=snils]").css("width", "100px");
	$(".rubl").css("margin-left", "25px");
	$("#addPayment").click();
});

	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	function showNext(selector, count){
		$(selector).closest('tr').show().nextAll('tr').slice(0, count).show();
	}
	
	function hideNext(selector, count){
		$(selector).closest('tr').hide().nextAll('tr').slice(0, count).hide();
	}
	
	$(".paymentConfirm").click(function(){
		if (!$(this).attr("title")){
			var payment_id = this.id.split("payment").pop();
			var elem = this;
			$.ajax({
				dataType: "json",
				contentType: 'application/json; charset=utf-8',
				type: "GET",
				async: false,
				url: "/scripts/ajax.php?module_name=webservice&name=payments&operation=getConfirm&data_id="+payment_id,
				complete: function (data) {
					if (data.responseText){
						var response = JSON.parse(data.responseText);
						if (response){
							var confirm = response.data;
							if (confirm){
								confirm = confirm[0];
								var text = "№ " + confirm.system_identifier;
								text += "<br/>Банк: " +((confirm.bank.bik) ? "БИК="+confirm.bank.bik : "SWIFT="+confirm.bank.swift) + ((confirm.bank.name) ? ", "+confirm.bank.name : "");
								text += "<br/>Дата произведения платежа: " + confirm.payment_date.split("T").shift();
								text += "<br/>Сумма: " + confirm.amount/100 + " руб.";
								text += "<br/>ИНН получателя: " + confirm.payee_inn;
								text += "<br/>КПП получателя: " + confirm.payee_kpp;
								text += "<br/>Код услуги поставщика(КБК): " + confirm.kbk;
								if ((typeof confirm.okato != 'object') && confirm.okato)
									text += "<br/>Код ОКТМО(ОКАТО): " + confirm.okato;
								text += "<br/>Статус: " + confirm.status.code + " - " + confirm.status.text;
								text += "<br/>Статус получен: " + confirm.status.time;
								$(elem).next('span').prepend(text);
								$(elem).attr("title", text);
							}
						}
					}
				}
			});
		}
	});
	
	var suppliers;
	
	function setSuppliers(){
		$.ajax({
					dataType: "json",
					contentType: 'application/json; charset=utf-8',
					type: "GET",
					async: false,
					url: "/scripts/ajax.php?module_name=webservice&name=payments&operation=getSuppliers",
					complete: function (data) {
                        if (data.responseText){
							var response = JSON.parse(data.responseText);
							if (response){
								suppliers = response.data;
								var options = "<option value='' selected='selected' title=''>--- Выберите ---</option>";
								for (var i = 0; i < suppliers.length; i++)	{
									var supplier = suppliers[i];
									options += "<option value='"+supplier.name+"'>"+supplier.name+"</option>";	
								}	
								$("[name=supplier_name]").html(options);
								setSelect2($("[name=supplier_name]"));
							}
						}
					}
		});
	}
	
	function setOrgService(supplier_id){
		$.ajax({
			dataType: "json",
			contentType: 'application/json; charset=utf-8',
			type: "GET",
			async: false,
			url: "/scripts/ajax.php?module_name=webservice&name=payments&operation=getOrgService&data_id="+supplier_id,
			complete: function (data) {
				if (data.responseText){
					var response = JSON.parse(data.responseText);
					if (response){
						var servicies = response.data;
						function format(item) { return item.name; }
						 
						$("[name=serviceCode]").select2({
							data:{ results: servicies, text: 'name' },
							formatSelection: format,
							placeholder: "--- Выберите ---",
							formatResult: format
						});
						if (servicies.length == 1){
							$("[name=serviceCode]").select2("data", servicies[0]);
						}
						changeServiceCode($("[name=serviceCode]").get());
					}
				}
			}
		});
	}
	
	function changeServiceCode(elem){
		var kbk = $("[name=kbk]");
		var srvCode = $("[name=srvCode]");
		if ($(elem).select2('data') != null){
			var service = $(elem).select2('data');							
			kbk.val((service.kbk) ? service.kbk : '');
			kbk.closest("tr").show();
			if ($.isEmptyObject(service.code)){
				srvCode.val('');			
				srvCode.closest("tr").hide();
			}else{
				srvCode.val(service.code);			
				srvCode.closest("tr").show();
			}
		}else{
			kbk.closest("tr").hide();
			srvCode.closest("tr").hide();
		}
	}
	
	function setOrgAccounts(supplier_id){
		$.ajax({
			dataType: "json",
			contentType: 'application/json; charset=utf-8',
			type: "GET",
			async: false,
			url: "/scripts/ajax.php?module_name=webservice&name=payments&operation=getOrgAccounts&data_id="+supplier_id,
			complete: function (data) {
				if (data.responseText){
					var response = JSON.parse(data.responseText);
					if (response){
						var accounts = response.data;
						$("table#account").not(":first").remove();
						
						function format(item) { return item.account; }
						 
						$("[name=selectAccount]").select2({
							data:{ results: accounts, text: 'account' },
							formatSelection: format,
							placeholder: "--- Выберите ---",
							formatResult: format
						});
						if (accounts.length == 1){
							$("[name=selectAccount]").select2("data", accounts[0]);
						}
						changeSelectAccount($("[name=selectAccount]").get());
					}
				}
			}
		});
	}
	
	function setOrgAddress(supplier_id){
		$.ajax({
			dataType: "json",
			contentType: 'application/json; charset=utf-8',
			type: "GET",
			async: false,
			url: "/scripts/ajax.php?module_name=webservice&name=payments&operation=getOrgAddress&data_id="+supplier_id,
			complete: function (data) {
				if (data.responseText){
					var response = JSON.parse(data.responseText);
					if (response){
						var addresses = response.data;
						var text = "";
						for (var i = 0; i < addresses.length; i++)	{
							var address = addresses[i];
							if (address.address_kind){
								if (address.address_kind == '1')
									text += 'юридический; ';
								else if (address.address_kind == '2')
										text += 'фактический; ';
									else if (address.address_kind == '3')
										text += 'почтовый; ';
							}
							text += address.view + "; ";
							if (address.comment)
								text += address.comment + "; ";									
							if (i != addresses.length -1)
								text += "\n";
						}	
						$("[name=supplier_address]").val(text);
					}
				}
			}
		});
	}
	
	function setOrgContacts(supplier_id){
		$.ajax({
			dataType: "json",
			contentType: 'application/json; charset=utf-8',
			type: "GET",
			async: false,
			url: "/scripts/ajax.php?module_name=webservice&name=payments&operation=getOrgContacts&data_id="+supplier_id,
			complete: function (data) {
				if (data.responseText){
					var response = JSON.parse(data.responseText);
					if (response){
						var contacts = response.data;
						var text = "";
						for (var i = 0; i < contacts.length; i++)	{
							var contact = contacts[i];
							text += contact.kind + ": ";
							text += contact.value + "; ";
							if (contact.comment)
								text += contact.comment + ";";		
							if (i != contacts.length -1)								
								text += "\n";	
						}	
						$("[name=supplier_contacts]").val(text);
					}
				}
			}
		});
	}
	
	function setSelect2(selector){
		selector.each(function(){
			var value = $(this).attr('value');
			$(this).val(value);
			var option = $(this).find("option[value='"+value+"']");
			if (option.length > 0)
				option.attr("selected", "selected");
			if ($(this).attr("disabled")){
				$(this).hide();
				var text = $(this).find("option:selected").text();
				$(this).before('<span>'+text+'</span>');
			}else{
				if ($.fn.select2 != undefined)
						$(this).select2();
			}
		});
	}
	
	function setRequired(parent){
		var selector = (typeof parent == "undefined") ? $(":required") : $(parent).find(":required");
		selector.each(function(){
			if ($(this).closest('tr').find('td:first').find('label').find('.required_span').length == 0)
				$(this).closest('tr').find('td:first').find('label').prepend("<span class='required_span' style='color: red;'>*<span>");
		});
	}
	
	function isNeedNalogPeriod(inn, kpp){
		return !(inn == "5835077845" && kpp == "583601001" || inn == "5834011778" && kpp == "583401001")
	}
	
	$(document).on("change", "[name=supplier_name]", function () {
		if (this.value != ''){
			$(this).closest('tr').nextAll('tr').slice(0, 6).show();
			var supplier = suppliers[this.selectedIndex - 1];
			if (supplier){
				$("[name=supplier_inn]").val(supplier.inn);
				$("[name=supplier_kpp]").val(supplier.kpp);
				(supplier.ogrn) ?	$("[name=supplier_ogrn]").val(supplier.ogrn)	:	$("[name=supplier_ogrn]").val('');
				(supplier.okato) ? $("[name=supplier_okato]").val(supplier.okato)	:	$("[name=supplier_okato]").val('');
				var tax_period  = $("[name=budget_index_tax_period]");
				if (isNeedNalogPeriod(supplier.inn, supplier.kpp)){
					tax_period.closest("tr").show();	//tax_period.attr("required", "required");
				}else{
					tax_period.val(0);	//tax_period.removeAttr("required");
					tax_period.closest("tr").hide();
				}
				setOrgService(supplier.id);
				setOrgAccounts(supplier.id);
				setOrgAddress(supplier.id);
				setOrgContacts(supplier.id);
			}
		}else
			$(this).closest('tr').nextAll('tr').slice(0, 6).hide();
    });
	
	$(document).on("click", "#addAdditData", function () {
		$('table[name=additional_data]:last').show();
    });
	
	$(document).on("click", "#delAdditData", function () {
		var additData = $("table[name=additional_data]");
		if (additData.length == 1)
			additData.hide();
    });
	
	$(document).on("click", "#addPayment", function () {
		if (!suppliers){
			try{
				setSuppliers();
			}catch(e){
				alert("Не удалось получить список поставщиков! Попробуйте позже");
				return false;
			}
		}
		$("#paymentDetails").show();
		$("#toPay").show();
		$("#cancelPayment").show();
		$(this).hide();
    });
	
	$(document).on("click", "#cancelPayment", function () {
		$("#paymentDetails").hide();
		$("#toPay").hide();
		$("#addPayment").show();
		$(this).hide();
    });
	
	$(document).on("change", "[name=checkAccount]", function () {
		if ($(this).is(":checked")){
			$("[name=checkAccount]").removeAttr("checked");
			$(this).attr("checked","checked");
		}
    });	
	
	function changeSelectAccount(elem){
		var table = $(elem).next('table#account');
		if ($(elem).select2('data') != null){
			var account = $(elem).select2('data');							
			table.find("[name=account_account]").val((account.account) ? account.account : '');									
			table.find("[name=account_kind]").val((account.kind) ? account.kind : '');									
			//table.find("[name=account_sub_account]").val((account.sub_account) ? account.sub_account : '');	
			if (account.sub_account){
				$("[name=account_sub_account]").closest('tr').show();				
				table.find("[name=account_sub_account]").val(account.sub_account);
			}else{
				$("[name=account_sub_account]").closest('tr').hide();
				table.find("[name=account_sub_account]").val('');
			}
			table.find("[name=bank_name]").val((account.bank_name) ? account.bank_name : '');									
			table.find("[name=bank_bik]").val((account.bank_bik) ? account.bank_bik : '');
			table.find("[name=bank_swift]").val((account.bank_swift) ? account.bank_swift : '');
			table.find("[name=bank_correspondent_bank_account]").val((account.bank_correspondent_bank_account) ? account.bank_correspondent_bank_account : '');		
			table.show();
		}else{
			table.hide();
		}
	}
	
	$(document).on("change", "[name=selectAccount]", function () {
		changeSelectAccount(this);
    });
	
	$(document).on("change", "[name=serviceCode]", function () {
		changeServiceCode(this);
    });
	
	$(document).on("click", "#orgInfoA", function () {
		$("#orgInfo").show();
		$("#orgInfo").next(".modal-backdrop").show();
    });
	function hideOrgInfo(elem){
		$("#orgInfo").hide();
		$("#orgInfo").next(".modal-backdrop").hide();
	}
	
	function closeModal(elem){
		$(elem).closest(".modal").hide(); $(elem).closest(".modal").next(".modal-backdrop").hide();
	}
	
    $(document).on("change keyup input click", "input[name=snils], input[name=supplier_oktmo]", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });
	
	$(document).on("change keyup input click", "input[name=total_amount]", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
		var rubl = parseInt(this.value)/100;
		if (rubl && (rubl != 0)){
			var text = rubles(rubl) + " (" + rubl + " руб.)";
			$(this).next('span.rubl').html(text);
		}else{
			$(this).next('span.rubl').html("");
		}
    });
	
	$(document).on("change input", "input[name=rub], input[name=kop]", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
		var kop = $("[name=kop]").val();
		var rub = $("[name=rub]").val();
		kop = (kop.length == 1) ? ("0"+kop) : kop;
		$("[name=total_amount]").val(rub + kop);
		$("[name=total_amount]").change();
    });
	
	
    $(document).on("change", "input[name=snils]", function () {
        if ($(this).val().length != 11) {
            var field = $(this).closest("tr").text().replace(/\*/g, "").replace(/:/g, "").trim();
            $(this).addClass("error");
            alert('Поле "' + field + '" должно содержать 11 символов!');
            return false;
        }
    });
	
	function isTrueResponse(response){
		if (response){
			if (response.error){
				if (typeof response.error == 'string')
					alert(response.error);
				else{
					var fault = response.error;
					var text = fault.faultstring + " - " + fault.faultcode + "\n";
					if (fault.detail){
						fault = fault.detail.fault;
						text += fault.errorMessage;
					}
					alert(text);
				}
				return false;
			}
			return true;
		}
		return false;
	}
	
	$(document).on("click", "#toPay", function () {
		var allRequiredNotNull = true;
		$("#paymentTab-1").find(":required").each(function(){
			if ($(this).val() == ''){
				var text = $(this).closest('tr').find('td:first').find('label').text();
				alert("Необходимо заполнить поле - " + text);
				allRequiredNotNull = false;
				return false;
			}
		});
		if (!allRequiredNotNull)
			return false;
		
		$("[name=additionalDataCount]").val($("[name=additional_data]").length - 1);
		$("[name=additional_data]").not(":first").each(function(i){
			$(this).find('input').each(function(){
				$(this).attr("name", $(this).attr("id") + "_"+ (i + 1))
			});
		});
		
		var postData = new Object();
		$("#tab-2").find('input, select, textarea').filter("[name]").each(function(){
			postData[$(this).attr('name')] = $(this).val();
		});
		postData["payer_identifier"] = "1" + $("[name=snils]").val();
		postData["soapAction"] = 'clarifyCommissionRequest';
		$.post( "/modules/payments/src/registerPayment.php", postData).done(function( data ) {
			 try{
				var clarifyCommissionResult = JSON.parse(data);
				if (!isTrueResponse(clarifyCommissionResult))
					return false;
				var commission = clarifyCommissionResult.data.amount;
				var total_amount = parseInt($("input[name=total_amount]").val());
				total_amount = (total_amount + commission*100);
				postData["amountWithCommission"] = total_amount;
				if (confirm("Коммиссия - " + commission + " руб.;\nИтого к оплате - " + (total_amount/100) + " руб.")) {
					postData["soapAction"] = 'registerPaymentRequest';
					$.post( "/modules/payments/src/registerPayment.php", postData).done(function( data ) {
						 try{
							var urlData = JSON.parse(data);
							if (!isTrueResponse(urlData))
								return false;
							var url = urlData.data[0];
							if (typeof url != 'undefined' && url != ''){
								var paymentUUID = urlData.paymentUUID;
								if (typeof paymentUUID != 'undefined' && paymentUUID != ''){
									alert("Ваш идентификатор платежа - " + paymentUUID + ".\nСохраните его.");
									location.href = url;
								}else
									alert("Идентификатор платежа не сформирован.\nОбратитесь в службу технической поддержки");								
							}else
								alert("Не удалось получить ссылку на форму оплаты.\nОбратитесь к администратору");
						  } catch(e) {
							alert("Не удалось получить ссылку на форму оплаты - " + e.name);
						  }
					});
					return true;
				} else {
					return false;
				}
			  } catch(e) {
				alert("Не удалось получить коммиссию - " + e.name + "; Обратитесь к администратору");
			  }
		});
    });