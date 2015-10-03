<?php

  		$answer = $smevClient->getAnswerFile();		
		$content="";
		$content_responce="";
		$content_all_responce="";


		$data = file_get_contents($answer); //$answer
		$pos = strpos($data, 'java.lang.Exception');	
		if($pos === false) {
			$xml = simplexml_load_file($answer); //$answer
			$xml->registerXPathNamespace('smev', 'http://smev.gosuslugi.ru/rev120315');	
			$xml->registerXPathNamespace('ns1', 'http://roskazna.ru/xsd/Charge');	
		}	else {	
			die("<br>Во время опроса сервиса ГИС ГМП возникла ошибка. Попробуйте повторить попытку позже");
		}
		
			

		$chargeInfos = $xml->xpath("//RequestProcessResult");
				
		$err_request = $chargeInfos[0]->ErrorDescription;
		$debt = "";
		$no_debt = "";

		$name_mas[1] = array("1"=>"doc_passport_type", "2"=>"Паспорт гражданина Российской Федерации");
		$name_mas[2] = array("1"=>"doc_birthDayChildren_type", "2"=>"Свидетельство о  рождении гражданина");
		$name_mas[3] = array("1"=>"doc_passportSeaman_type", "2"=>"Паспорт моряка");
		$name_mas[4] = array("1"=>"doc_military_type", "2"=>"Удостоверение личности военнослужащего РФ");
		$name_mas[5] = array("1"=>"doc_militaryID_type", "2"=>"Военный билет");
		$name_mas[6] = array("1"=>"doc_temporaryCertificate_type", "2"=>"Временное удостоверение личности гражданина РФ");
		$name_mas[7] = array("1"=>"doc_referenceDeprivation_type", "2"=>"Справка об освобождении из мест лишения свободы");
		$name_mas[8] = array("1"=>"doc_passportForeignCitizen_type", "2"=>"Паспорт иностранного гражданина или удостоверение личности лица без гражданства");
		$name_mas[9] = array("1"=>"doc_residencePermit_type", "2"=>"Вид на жительство в РФ");
		$name_mas[10] = array("1"=>"doc_temporaryStay_type", "2"=>"Разрешение на временное проживание");
		$name_mas[11] = array("1"=>"doc_refugee_type", "2"=>"Удостоверение беженца");
		$name_mas[12] = array("1"=>"doc_migrationCard_type", "2"=>"Миграционная карта");
		$name_mas[13] = array("1"=>"doc_passportUSSR_type", "2"=>"Паспорт гражданина СССР образца 1974 г. для некоторых категорий иностранных граждан и лиц без гражданства");
		$name_mas[20] = array("1"=>"SNILS", "2"=>"СНИЛС");
		$name_mas[21] = array("1"=>"INNFL", "2"=>"ИНН");
		$name_mas[22] = array("1"=>"doc_driverLicense_type", "2"=>"Номер водительского удостоверения");
		$name_mas[23] = array("1"=>"doc_registrationCodeFMS_type", "2"=>"Учетный код ФМС");
		$name_mas[24] = array("1"=>"doc_register_type", "2"=>"Свидетельство о регистрации транспортного средства");

		if(empty($err_request))  {
			$chargeInfos = $xml->xpath("//ChargeInfo");
			$ind_mas = $_POST["typeDocuments"];
			if ($ind_mas[0] == 0) {
				$ind_mas = $ind_mas[1];
			} 	
			$name_doc = $name_mas[$ind_mas]["1"];
			$name_rus_doc = $name_mas[$ind_mas]["2"];
			if (!empty($chargeInfos))   {
				$sch_debt = 1;			
				foreach($chargeInfos as $chargeInfo)  {
					$chargeData = $chargeInfo->xpath("//ChargeData");
					$quittanceWithPaymentStatus = $chargeInfo->xpath("//QuittanceWithPaymentStatus");
					$isRevoked = $chargeInfo->xpath("//IsRevoked");
					$chargeData = $chargeData[$sch_debt-1];
					$quittanceWithPaymentStatus = $quittanceWithPaymentStatus[$sch_debt-1];					
					$isRevoked = $isRevoked[$sch_debt-1];
					if (!empty($isRevoked) && ($isRevoked == 'true'))
						continue;
					$chargeData_decode = base64_decode($chargeData);
					$charge_xml = simplexml_load_string($chargeData_decode);
					$content_responce = "<table cellpadding='0' cellspacing='0' border='1' width='450' align='center' id='table_".$sch_debt."'>";
					$content_responce.="<tr height='20'><td colspan='2'><center><b><a class='charge' href='#'><i>Задолженность №".$sch_debt."</i></a>".((!empty($quittanceWithPaymentStatus) && $quittanceWithPaymentStatus == "1") ? "<span style='color: red;'> - ОПЛАЧЕНА</span>" : "")."</b></center></td></tr>";

					$charge = $charge_xml->xpath("//BillFor");
					if(!empty($charge)) {
						$content_responce.="<tr class='narrative'><td>Наименование задолженности (Назначение платежа)".((!empty($quittanceWithPaymentStatus) && $quittanceWithPaymentStatus == "1") ? "" : "<i class='editNarrative newEdit'></i>")."</td><td>".$charge[0]."</td></tr>";							 							//$debt.="<tr height='20'><td colspan='2'><center><b><i>Задолженность №".$sch_debt."</i></b></center></td></tr>";
						$debt.= $sch_debt.")	".$charge[0];
						//"<tr><td width='200'>Наименование задолженности</td><td width='250'>".$charge[0]."</td></tr>";;
					}

					$charge = $charge_xml->xpath("//TotalAmount");
					if(!empty($charge)) {
						$content_responce.="<tr><td>Сумма задолженности (в руб.) </td><td>".(($charge[0])/100)."</td></tr>";
						$content_responce.="<tr class='total_amount' style='display:none;' id='hidden'><td>Сумма задолженности (в коп) </td><td>".$charge[0]."</td></tr>";
						$debt.=	" - ".(($charge[0])/100)."руб.".((!empty($quittanceWithPaymentStatus) && $quittanceWithPaymentStatus == "1") ? " - ОПЛАЧЕН;" : ";")."<br/><br/>";
							//"<tr><td>Сумма задолженности (в руб.)</td><td>".(($charge[0])/100)."</td></tr>";
					}

					$charge = $charge_xml->xpath("//Name");
					if(!empty($charge)) {
						$content_responce.="<tr class='supplier_name' width='200'><td>Наименование организации, которая произвела начисления</td><td width='250'>".$charge[0]."</td></tr>";
					}

					$charge = $charge_xml->xpath("//INN");
					$inn = $charge[0];
					if(!empty($charge)) {
						$content_responce.="<tr class='supplier_inn'><td>ИНН организации</td><td>".$charge[0]."</td></tr>";
					}

					$charge = $charge_xml->xpath("//KPP");
					$kpp = $charge[0];
					if(!empty($charge)) {
						$content_responce.="<tr class='supplier_kpp'><td>КПП организации</td><td>".$charge[0]."</td></tr>";
					}

					$charge = $charge_xml->xpath("//Account");
										

					if(!empty($charge)) {
						
						$content_responce.="<tr class='account_kind' style='display:none;' id='hidden'><td>Тип счёта</td><td>".$charge[0]->attributes()->kind."</td></tr>";

						$content_responce.="<tr class='account_account'><td>Счет</td><td>".$charge[0]->Account."</td></tr>";
					}

					if(!empty($charge[0]->SubAccount)) {
						$content_responce.="<tr class='account_sub_account'><td>Субсчет</td><td>".$charge[0]->SubAccount."</td></tr>";
					}

					
					if(!empty($charge[0]->Bank->Name)) {
						$content_responce.="<tr class='bank_name'><td>Банк получателя</td><td>".$charge[0]->Bank->Name."</td></tr>";
					}

					if(!empty($charge[0]->Bank->BIK)) {
						$content_responce.="<tr class='bank_bik'><td>БИК</td><td>".$charge[0]->Bank->BIK."</td></tr>";
					}
					
					if(!empty($charge[0]->Bank->SWIFT)) {
						$content_responce.="<tr class='bank_swift'><td>СВИФТ</td><td>".$charge[0]->Bank->SWIFT."</td></tr>";
					} 

					if(!empty($charge[0]->Bank->CorrespondentBankAccount)) {
						$content_responce.="<tr class='bank_correspondent_bank_account'><td>Корресподентский счет</td><td>".$charge[0]->Bank->CorrespondentBankAccount."</td></tr>";
					}

					$charge = $charge_xml->xpath("//TreasureBranch");
					if(!empty($charge)) {
						$content_responce.="<tr><td>Организация - получатель</td><td>".$charge[0]."</td></tr>";	
					}									

					$charge = $charge_xml->xpath("//KBK");
					$kbk = $charge[0];
					if(!empty($charge)) {
						$content_responce.="<tr class='kbk'><td>КБК</td><td>".$charge[0]."</td></tr>";	
					}										

					$charge = $charge_xml->xpath("//OKATO");
					if(!empty($charge)) {
						$content_responce.="<tr class='supplier_oktmo'><td>ОКАТО</td><td>".$charge[0]."</td></tr>";
					}

					$charge = $charge_xml->xpath("//BudgetIndex");
					$pr = $charge[0]->xpath("//Status");
					if(!empty($pr)) {
						$content_responce.="<tr class='budget_index_status' style='display:none;' id='hidden'><td>Статус плательщика</td><td>".$pr[0]."</td></tr>";
					}
					
					$pr = $charge[0]->xpath("//PaymentType");
					if(!empty($pr)) {
						$content_responce.="<tr class='budget_index_payment_type' style='display:none;' id='hidden'><td>Тип платежа</td><td>".$pr[0]."</td></tr>";
					}		

					$pr = $charge[0]->xpath("//Purpose");
					if(!empty($pr)) {
						$content_responce.="<tr class='budget_index_purpose' style='display:none;' id='hidden'><td>Основание платежа</td><td>".$pr[0]."</td></tr>";
					}	
		
					$pr = $charge[0]->xpath("//TaxPeriod");
					if(!empty($pr)) {
						$content_responce.="<tr class='budget_index_tax_period' style='display:none;' id='hidden'><td>Налоговый период</td><td>".$pr[0]."</td></tr>";
					}			

					$pr = $charge[0]->xpath("//TaxDocNumber");
					if(!empty($pr)) {
						$content_responce.="<tr class='budget_index_tax_doc_number' style='display:none;' id='hidden'><td>Показатель номера документа</td><td>".$pr[0]."</td></tr>";
					}			

					$pr = $charge[0]->xpath("//TaxDocDate");
					if(!empty($pr)) {
						$content_responce.="<tr class='budget_index_tax_doc_date' style='display:none;' id='hidden'><td>Показатель даты документа</td><td>".$pr[0]."</td></tr>";
					}			
						
					$charge = $charge_xml->xpath("//AltPayerIdentifier");
					if(!empty($charge)) {
						$content_responce.="<tr class='payer_identifier' style='display:none;' id='hidden'><td>Альтернативный идентификатор плательщика</td><td>".$charge[0]."</td></tr>";
					} else {
						$charge = $charge_xml->xpath("//UnifiedPayerIdentifier");
						if(!empty($charge)) {
							$content_responce.="<tr class='payer_identifier' style='display:none;' id='hidden'><td>Единый идентификатор плательщика</td><td>".$charge[0]."</td></tr>";
						}
					}

					$supplierBillID = '';
					$charge = $charge_xml->xpath("//Charge");
					if(empty($charge))
						$charge = $charge_xml->xpath("//ns1:Charge");
					if(!empty($charge)) {
						$supplierBillID = $charge[0]->attributes()->SupplierBillID;
						$content_responce.="<tr class='supplier_bill_id'><td>Уникальный идентификатор начисления</td><td>".$supplierBillID."</td></tr>";
					}

					$charge = $charge_xml->xpath("//BillDate");
					if(!empty($charge)) {
						$content_responce.="<tr class='bill_date'><td>Дата выставления начисления (счета)</td><td>".$charge[0]."</td></tr>";
					}

					$charge = $charge_xml->xpath("//ApplicationID");
					if(!empty($charge)) {
						$content_responce.="<tr class='application_id' style='display:none;' id='hidden'><td>Уникальный идентификатор заявки</td><td>".$charge[0]."</td></tr>";
					}	

					$isLocal = true; //$isLocal = preg_match('/^(192.168){1}\.{1}\d{1,3}\.{1}\d{1,3}$/', $_SERVER['REMOTE_ADDR']);
				if (!empty($supplierBillID))
					if (!empty($quittanceWithPaymentStatus) && $quittanceWithPaymentStatus == "1"){
						$content_responce.="<tr><td colspan='2'><center><button disabled class='btn'><i class='icon-check icon-white'></i></i>Сквитировано</button><br><br></center></td></tr>";
					}else{
						$_GET["operation"] = "getOrgServiceKBK";
						$_GET["data_id"] = $inn."|".$kpp."|".$kbk;
						$requestForm = $modules_root.'payments/src/requests/getData.php';
						include $modules_root."payments/src/requests/getDataParse.php";
						$services = json_decode( json_encode($list) , 1);
						if (isset($services) && count($services) > 0) {
							if (count($services) == 1){
								$service = $services[0];
								if (empty($service["code"]))
									$srvCode = '';
								else
									$srvCode = $service["code"];								
								$content_responce.="<tr style='display:none;' id='hidden'><td>Код услуги</td><td><select class='srvCode'><option selected value='".$srvCode."'>".$service["name"]."</option></select></td></tr>";					
						}else{
							$options = "<option value=''>---Выберите---</option>";
							foreach ($services as $service) {
								if (empty($service["code"]))
									$srvCode = '';
								else
									$srvCode = $service["code"];
								$options .= "<option value='".$srvCode."'>".$service["name"]."</option>";
							}
							$content_responce.="<tr><td>Для оплаты необходимо уточнить услугу</td><td><select style='width: 100%;' class='srvCode'>".$options."</select></td></tr>";		
						}	//success	
							$content_responce.="<tr><td style='color: red;'>Ваше ФИО</td><td><input class='user_fio' style='width: 90%;' type='text'/></td></tr>";
							$content_responce.="<tr><td colspan='2'><center><input type='button' value='Оплатить' class='btn btn-primary pay_debt' /><br><br></center></td></tr>";
						}	
					}			
					$content_responce.="</table>";
					$sch_debt++;
					if (!empty($quittanceWithPaymentStatus) && $quittanceWithPaymentStatus == "1")
						$content_all_responce .= $content_responce;
					else
						$content_all_responce = $content_responce.$content_all_responce;
				}
				$content.="<table cellpadding='0' cellspacing='0' border='1' width='450' align='center'>";
				$content.="<tr height='20'><td colspan='2'><center><b><i>Информация о гражданине</i></b></center></td></tr>";
				$content.="<tr><td width='200'>Тип документа</td><td width='250'>".$name_rus_doc."</td></tr>";
				if ($ind_mas!=20) {
					$content.="<tr><td>Гражданство</td><td>".$_POST["citizenship"]." (код страны)</td></tr>";
				}		
				$content.="<tr><td>".$name_rus_doc."</td><td>".$_POST[$name_doc]."</td></tr>";
				$content.="<tr><td>Начало запрашиваемого периода</td><td>".$_POST["startDate"]."</td></tr>";		
				$content.="<tr><td>Конец запрашиваемого периода</td><td>".$_POST["endDate"]."</td></tr>";
				$content.="</table>";
				$content.=$content_all_responce;		
				ob_end_clean();
				echo $smevResult."<br>".$content;
?>
			<style>
				.editNarrative{
					left: 5px;
					cursor: pointer;
					position: relative;
					background-image: url("templates/assets/img/glyphicons-halflings.png");
					width: 14px;
					height: 14px;
					display: inline-block;
				}
				.newEdit{
					background-position: 0 -72px;
				}
				.commitEdit{
					background-position: -288px 0px;
				}
			</style>
			<script type="text/javascript">

				function updateVal(currentEle, value) {
				    $(currentEle).html('<textarea  maxlength="184" class="thVal" type="text">' + value + '</textarea>');
				    currentEle.find(".thVal").focus();
				    currentEle.find(".thVal").keyup(function (event) {
					if (event.keyCode == 13) {
					    $(currentEle).html(currentEle.find(".thVal").val().trim());
					}
				    });
				}

				$(document).ready( function() {

					$(".charge").click(function(){
						if ($(this).closest('table').find('.supplier_inn').is(":visible"))
							$(this).closest('tr').nextAll('tr').not("#hidden").not(":eq(0)").not(":eq(0)").not(":last").hide();
						else
							$(this).closest('tr').nextAll('tr').not("#hidden").not(":eq(0)").not(":eq(0)").not(":last").show();
						return false;
					});

					$(".charge").click();

				    $(".editNarrative").click(function (e) {
					var currentEle = $(this).closest('tr').find("td:last");
					if ($(this).hasClass('commitEdit')){	//if (currentEle.find(".thVal").length >= 1)
						$(this).removeClass('commitEdit').addClass('newEdit');					
						//$(this).css("background-position", "0 -72px");				
						$(currentEle).html(currentEle.find(".thVal").val().trim());
					}else{
						var value = currentEle.html();
						updateVal(currentEle, value);
						$(this).removeClass('newEdit').addClass('commitEdit');
						//$(this).css("background-position", "-288px 0px");
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


					$(document).on('click', '.pay_debt', function() {
						var table = $(this).parent().parent().parent().parent().get(0).parentElement.id;
						var editNarrative = $("#"+table).find(".editNarrative");
						if (editNarrative.hasClass('commitEdit'))
							editNarrative.click();
						var postData = new Object();			
						$("#"+table+"> tbody > tr").each(function() {
							if($(this).children().length == 2 && typeof $(this).attr('class') != 'undefined') {
								postData[$(this).attr('class')] = $(this).get(0).children[1].textContent;
							}
						});
						if (typeof postData["supplier_bill_id"] == 'undefined' || postData["supplier_bill_id"] == '' || postData["supplier_bill_id"].length != 20){
							alert('Из ГИС ГМП не был получен уникальный идентификатор начисления. Нельзя произвести оплату.');
							return false;
						}
						var srvCode = $("#"+table).find(".srvCode").val();
						if (typeof srvCode == 'undefined' || srvCode == ''){
							alert('Для оплаты необходимо уточнить услугу');
							return false;
						}else
							postData["srvCode"] = srvCode;
						var user_fio = $("#"+table).find(".user_fio").val();
						if((user_fio != '' && typeof user_fio != 'undefined') 
								&& (postData['narrative'].length + user_fio.length < 184)){
							postData['narrative'] = postData['narrative'] + " " + user_fio;
						}
						postData["soapAction"] = 'clarifyCommissionRequest';

						$.post( "/modules/payments/src/registerPayment.php", postData).done(function( data ) {
						 try{
							var clarifyCommissionResult = JSON.parse(data);
							if (!isTrueResponse(clarifyCommissionResult))
								return false;
							var commission = clarifyCommissionResult.data.amount;
							var total_amount = parseInt(postData["total_amount"]);
							total_amount = (total_amount + commission*100);
							if (total_amount > 1500000){
								alert("Коммиссия - " + commission + " руб.;\nИтого к оплате - " + (total_amount/100) + " руб.\nСумма платежа превышает максимально допустимую(15000 руб.). Платеж отклонен.");
								return false;
							}							
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
											location.href = url;
										}else
											alert("Не удалось получить ссылку на форму оплаты. Обратитесь к администратору");
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
				});
			</script> 
<?php
			} else {
				ob_end_clean();
				$errorCount++;
				sleep(2);
				if ($errorCount < 3){
					sleep(3);
					$result = include($modules_root."forms/test/callExt.php");
					$answer = $modules_root.'forms/response/answer'.$regNumber.'.php';
					if(file_exists($answer))
					  	include($answer);
					$smevClient->deleteTempFiles();
				}else{
					echo $smevResult;
					if(!empty($_POST["uinCheck"]) && $_POST["uinCheck"] == "on")
						$no_debt = "По документу \"".$_POST["uin"]."\" у вас не имеется задолженностей";
					else
						$no_debt = "По документу \"".$name_rus_doc."\" (".$_POST[$name_doc].") у вас не имеется задолженностей";
					echo "<br>".$no_debt;
				}
			}
		} else {
			ob_end_clean();
			$errorCount++;
			if ($errorCount < 3){
				sleep(3);
				$result = include($modules_root."forms/test/callExt.php");
				$answer = $modules_root.'forms/response/answer'.$regNumber.'.php';
				if(file_exists($answer))
				  	include($answer);
				$smevClient->deleteTempFiles();
			}else
				echo $smevResult."<br>Неверный ответ от сервиса. Обратитесь в службу поддержки!<br/>".$err_request;		
		}
		//	echo "<br/><table cellpadding='0' cellspacing='0' border='1' width='450' align='center'>".$debt."</table>";
		$smevClient->exchangeCode = "10";
		if ($no_debt == "") {		
			$smevClient->comment = $debt;
			//"<table cellpadding='0' cellspacing='0' border='1' width='450' align='center'>".$debt."</table>" ;
		} else if ($no_debt != "") {	
			$smevClient->comment = $no_debt;
		}
?>