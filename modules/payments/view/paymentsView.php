<?php
$text .= '	<ul class="nav nav-tabs" id="paymentsTab">
				<li class="active"><a href="#paymentTab-1" id="payment_li_tab-1" data-toggle="tab">Мои начисления</a></li>
			        <li><a href="#paymentTab-2" id="payment_li_tab-2" data-toggle="tab">История платежей</a></li>
			</ul>
			<div class="tab-content" align="center">
				<div class="tab-pane active" id="paymentTab-1">
					<!--Мои начисления-->
					<div>
						<button style="float: right;" class="btn btn-success" id="addPayment" type="button">Создать</button>
						<button style="float: right; display:none;" class="btn btn-primary" id="cancelPayment" type="button">Отмена</button>
						<table id="paymentDetails" style="display:none;">
							<tbody>
								<tr>
									<td>
										<label for="total_amount">Сумма платежа, рублей:</label>
									</td>
									<td>
										<input type="text" name="rub" maxlength="5" required="required"/>
										<input type="text" name="total_amount" required="required" style="display: none;"/>
										<span class="rubl"></span>
									</td>
								</tr>
								<tr>
									<td>
										копеек:
									</td>
									<td>
										<input type="text" name="kop" value="00" style="width: 30px;" maxlength="2"/>
									</td>
								</tr>
								<tr>
									<td>
										<label for="narrative">Назначение платежа:</label>
									</td>
									<td>
										<textarea name="narrative" required="required"></textarea>
									</td>
								</tr>
								<tr>
								   <td valign="top" align="right" width="300">
									  <div class="payment_statictext">Данные поставщика услуг</div>
								   </td>
								   <td valign="top" align="left" width="530"></td>
								</tr>
								<tr>
									<td>
										<label for="supplier_name">Поставщик:</label>
									</td>
									<td>
										<select type="text" name="supplier_name" required="required"/>
									</td>
								</tr>
								<tr>
									<td>
									</td>
									<td>
										<a id="orgInfoA" href="#orgInfoA">Информация о поставщике</a>
									</td>
								</tr>
								<tr>
									<td>
										<label for="serviceCode">Услуга:</label>
									</td>
									<td>
										<input type="text" name="serviceCode" required="required"/>
									</td>
								</tr>
								<tr style="display:none;">
									<td>
										<label for="srvCode">Код услуги:</label>
									</td>
									<td>
										<input type="text" name="srvCode" disabled="disabled"/>
									</td>
								</tr>
								<tr style="display:none;">
									<td>
										<label for="kbk">Код бюджетной классификации:</label>
									</td>
									<td>
										<input type="text" name="kbk" required="required" disabled="disabled"/>
									</td>
								</tr>
								<tr style="display:none;">
									<td><label>Счет:</label></td>
									<td>
										<input type="text" name="selectAccount"/>
										<table id="account" style="display: none;">
											<tbody>
												<tr>
													<td>
														<table>
															<tbody>
																<tr>
																	<td style="width:20%;">Тип счета:</td>
																	<td>
																		<select type="text" name="account_kind" disabled="disabled">
																			<option value="1">расчетный</option>
																			<option value="2">текущий</option>
																			<option value="3">корреспондентский</option>
																		</select>
																	</td>
																</tr>
																<tr>
																		<td style="width:20%;">Номер счета:</td><td><input type="text" name="account_account" disabled="disabled"/></td>
																</tr>
																<tr>
																		<td style="width:20%;">Номер субсчета:</td><td><input type="text" name="account_sub_account" disabled="disabled"/></td>
																</tr>															
																<tr>
																		<td style="width:20%;">Банк:</td>
																		<td>
																			<input type="text" name="bank_name" disabled="disabled"/>
																			<input type="text" style="display:none;" name="bank_id" disabled="disabled"/>
																			<input type="text" style="display:none;" name="bank_bik" disabled="disabled"/>
																			<input type="text" style="display:none;" name="bank_swift" disabled="disabled"/>
																			<input type="text" style="display:none;" name="bank_correspondent_bank_account" disabled="disabled"/>
																		</td>
																</tr>															
															</tbody>
														</table>
													</td>
													<!--<td><input type="checkbox" name="checkAccount" /><td>		-->
												<tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<label for="supplier_oktmo">ОКТМО:</label>
									</td>
									<td>
										<input type="text" name="supplier_oktmo" maxlength="11"/>
									</td>
								</tr>									
								<tr>
								   <td valign="top" align="right" width="300">
									  <div class="payment_statictext">Дополнительные реквизиты платежа</div>
								   </td>
								   <td valign="top" align="left" width="530"></td>
								</tr>
								<tr>
									<td>
										<label for="budget_index_status">Статус плательщика (физического лица):</label>
									</td>
									<td>
										<select type="text" name="budget_index_status" required="required">
											<option value="">--- Выберите ---</option>
											<option value="0">начисление и платеж не в пользу ФНС</option>
											<option value="02">налоговый агент</option>
											<option value="08">плательщик иных обязательных платежей</option>
											<option value="09">налогоплательщик (плательщик сборов) – индивидуальный предприниматель</option>
											<option value="10">налогоплательщик (плательщик сборов) – частный нотариус</option>
											<option value="11">налогоплательщик (плательщик сборов) – адвокат, учредивший адвокатский кабинет</option>
											<option value="12">налогоплательщик (плательщик сборов) – глава крестьянского (фермерского) хозяйства</option>
											<option value="13">налогоплательщик (плательщик сборов) –  иное физическое лицо – клиент банка (владелец счета)</option>
											<option value="14">налогоплательщик, производящий выплаты физическим лицам (п.п. 1 п.1 ст. 235 Налогового кодекса Российской Федерации)</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label for="budget_index_payment_type">Тип платежа:</label>
									</td>
									<td>
										<select type="text" name="budget_index_payment_type" required="required">
											<option value="">--- Выберите ---</option>
											<option value="0">уплата налога, сбора, платежа, пошлины, взноса, аванса (предоплаты), налоговых санкций, административных штрафов, иных штрафов</option>
											<option value="ПЕ">уплата пени</option>
											<option value="ПЦ">уплата процентов</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label for="budget_index_purpose">Основание платежа:</label>
									</td>
									<td>
										<select type="text" name="budget_index_purpose" required="required">
											<option value="">--- Выберите ---</option>
											<option value="0">начисление и платеж не в пользу ФНС</option>
											<option value="ТП">платежи текущего года</option>
											<option value="ЗД">добровольное погашение задолженности по истекшим налоговым периодам при отсутствии требования об уплате налогов (сборов) от налогового органа</option>
											<option value="ТР">погашение задолженности по требованию об уплате налогов (сборов) от налогового органа</option>
											<option value="PC">погашение рассроченной задолженности</option>
											<option value="ОТ">погашение отсроченной задолженности</option>
											<option value="АП">погашение задолженности по акту проверки</option>
											<option value="АР">погашение задолженности по исполнительному документу</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label for="budget_index_tax_period">Налоговый период:</label>
									</td>
									<td>
										<input type="text" name="budget_index_tax_period" required="required" value="0"/>
									</td>
								</tr>
								<tr>
									<td>
										<label for="budget_index_tax_doc_number">Показатель номера документа:</label>
									</td>
									<td>
										<input type="text" name="budget_index_tax_doc_number" required="required" value="0"/>
									</td>
								</tr>	
								<tr>
									<td>
										<label for="budget_index_tax_doc_date">Показатель даты документа:</label>
									</td>
									<td>
										<input type="text" name="budget_index_tax_doc_date" required="required" value="0"/>
									</td>
								</tr>
								<tr>
									<td>
										<label for="snils">СНИЛС:</label>
									</td>
									<td>
										<input type="text" name="snils" maxlength="11" required="required"/>
									</td>
								</tr>								
								<tr>
									<td>
										<label for="additional_data">Дополнительные данные:</label>
										<input type="text" style="display:none;" name="additionalDataCount"/>
									</td>
									<td>
										<div>
											<table name="additional_data" style="display:none;"><tbody>
												<tr>
													<td>
														<label for="additional_data_name">Наименование:</label>
													</td>
													<td>
														<input style="width: 300px;" id="additional_data_name" name="additional_data_name" type="text">
													</td>			
												</tr>
												<tr>
													<td>
														<label for="additional_data_label">Описание:</label>
													</td>
													<td>
														<input style="width: 300px;" id="additional_data_label" name="additional_data_label" type="text">
													</td>			
												</tr>
												<tr>
													<td>
														<label for="additional_data_value">Значение:</label>
													</td>
													<td>
														<input style="width: 300px;" id="additional_data_value" name="additional_data_value" type="text"><hr/>
													</td>			
												</tr>												
											</tbody></table>
											<button class="btn btn-danger deleteCloneField" type="button" id="delAdditData" style="display:none;">Удалить</button>
											<button class="btn btn-success addCloneField" type="button" id="addAdditData" style="">Добавить</button>
										</div>
									</td>
								</tr>
								<!--
										PayerIdentifier	0..1	String	Идентификатор плательщика
										SupplierBillID	0..1	String	Уникальный идентификатор начисления
										BillDate	0..1	Date	Дата выставления начисления
										ApplicationID	0..1	String	Уникальный идентификатор заявки
								-->
							</tbody>
						</table>
						<button style="float: right; display:none;" class="btn btn-success" id="toPay" type="button">Перейти к оплате</button>
					</div>
				</div>
				<div class="tab-pane" id="paymentTab-2">';
	

	$_GET["operation"] = "getPayments";
	if ($authHome->checkSession()!=1){
		$order_ID = explode("__", $_GET["Order_ID"]);
		if (strlen($order_ID[0]) == 36)
			$_GET["data_id"] = $order_ID[0];
		$text .= '<form action="/account"><input name="Order_ID" placeholder="Идентификатор платежа" type="text"/><input type="submit" value="Найти платеж" style=" margin-left: 10px; height: 30px; "/></form>';
	}else
		$_GET["data_id"] = $_SESSION['login'];
	if (isset($_GET["data_id"]) && $_GET["data_id"] != ""){
		$requestForm = $modules_root.'payments/src/requests/getData.php';
		include $modules_root."payments/src/requests/getDataParse.php";
		$payments = json_decode( json_encode($list) , 1);
		if (!is_object($xml))
			$text .= 'Не удалось получить историю платежей, веб-сервис не доступен. Попробуйте позже<br/>';
	}
	$enum_status = array(
			"NEW"  => "<span class='in_line_msg'>Новый</span>",
			"REGS" => "<span class='in_smev_msg'>Платежные реквизиты получены и зарегистрированы в ИС ЕПШ</span>",
			"POST" => "<span class='in_smev_msg'>Распоряжение на оплату успешно передано в ППС</span>",
			"PROC" => "<span class='in_waitUser_msg'>Распоряжение на оплату в обработке на стороне ППС</span>",
			"APRP" => "<span class='success_msg'>Платеж успешно завершен</span>",
			"APRI" => "<span class='success_msg'>Зачисление успешно завершено</span>",
			"DECL" => "<span class='error_msg'>Платеж отклонен</span>",
	);
	$text .= '	<table class="table table-bordered">
					<tr>
						<td width="40%">
							<b>Назначение платежа</b>
						</td>
						<td width="14%">
							<b>Дата формирования платежа</b>
						</td>
						<td>
							<b>Сумма</b>
						</td>
						<td width="14%">
							<b>Статус</b>
						</td>
						<td>
						</td>
					</tr>';			
	if (isset($payments) && count($payments) > 0) {
		foreach ($payments as $payment) {
			if (isset($payment['s_code']))
				$payment_status = (isset($enum_status[$payment['s_code']])) ? $enum_status[$payment['s_code']] : $payment['s_code'];
			else
				$payment_status = $enum_status["NEW"];
			$datetimes = explode("T", $payment['create_time']);
			$date =  $datetimes[0];
			$times = explode("+", $datetimes[1]);
			$time = $times[0];
			$text .= '		<tr>
								<td>';
			$text .= 				$payment['narrative'];
			$text .= '			</td>
								<td>
									'.$date.' '.$time.'
								</td>
								<td>
									'.(intval($payment['total_amount'])/100).' руб.';
			$text .= '			</td>
								<td>
									'.$payment_status.'
								</td>
								<td>';
			if (isset($payment['form_url']) && !isset($payment['s_code']))					
				$text.=				'<a href="'.$payment['form_url'].'">Перейти к оплате</a>';
			if (isset($payment['s_code']) && $payment['s_code'] == "APRP")	
				$text.=				'<a class="linktip paymentConfirm" id="payment'.$payment['id'].'" title=""><em>!</em></a>';
			$text.=				'</td>';
			$text.=	'		</tr>';
		}
	}
	$text .= '</table>';
		
$text	.=		'</div>
			</div>';
			
$text	.= '<div class="modal" id="orgInfo" style="width: 550px; left: 50%; top: 30%; display:none;" tabindex="-1" role="dialog" aria-labelledby="createCloneBlock" data-backdrop="static" aria-hidden="true">
	    <div class="modal-header">
		<button type="button" class="close" style="width: 25px; height: 25px;" data-dismiss="modal" onclick="closeModal(this);" aria-hidden="true">×</button>
		<h3>Информация об организации</h3>
	    </div>
	    <div class="modal-body" style="text-valign: top; max-height: 100%;">
		<table>
			<tr>
				<td>
					<label for="supplier_inn">ИНН:</label>
				</td>
				<td>
					<input type="text" disabled="disabled" name="supplier_inn" required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="supplier_kpp">КПП:</label>
				</td>
				<td>
					<input type="text" disabled="disabled" name="supplier_kpp" required="required"/>
				</td>
			</tr>								
			<tr>
				<td>
					<label for="supplier_ogrn">ОГРН:</label>
				</td>
				<td>
					<input type="text" disabled="disabled" name="supplier_ogrn"/>
				</td>
			</tr>
			<tr style="display:none;">
				<td>
					<label for="supplier_okato">ОКATO:</label>
				</td>
				<td>
					<input type="text" disabled="disabled" name="supplier_okato"/>
				</td>
			</tr>					
			<tr style="display:none;">
				<td>
					<label for="supplier_address">Адрес:</label>
				</td>
				<td>
					<textarea type="text" disabled="disabled" name="supplier_address"></textarea>
				</td>
			</tr>
			<tr style="display:none;">
				<td>
					<label for="supplier_contacts">Контакты:</label>
				</td>
				<td>
					<textarea type="text" disabled="disabled" name="supplier_contacts"></textarea>
				</td>
			</tr>			
		</table>
	    </div>
	    <div class="modal-footer">
		<button class="btn" data-dismiss="modal" onclick="closeModal(this);" aria-hidden="true">Закрыть</button>
	    </div>
	</div><div class="modal-backdrop  in" style="display:none;"></div>';			