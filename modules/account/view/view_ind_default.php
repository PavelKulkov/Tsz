<?php

	include $modules_root.'/account/view/statusView.php'; 



	$text = '	<!--<h3 class="title_cabinet">Личный кабинет</h3>

				<div class="rule"></div>

				<br />-->';

	

	$text .= '<!--<ul class="nav nav-tabs" id="accountTabs">

	         	<li class="active"><a href="#tab-1" id="li_tab-1" data-toggle="tab">Мои заявки</a></li>

		        <li><a href="#tab-2" id="li_tab-2" data-toggle="tab">Платежи</a></li>

		  </ul>-->';

	$text .= '<div class="tab-content" align="center">

            		<div class="tab-pane active" id="tab-1">';



	$text .=  $paginator['text'];

	$text .= '	<table class="table table-bordered">

					<tr>

						<td width="40%">

							<b>Услуга</b>

						</td>

						<td>

							<b>Комментарий</b>

						</td>

						<td width="14%">

							<b>Дата подачи</b>

						</td>

						<td width="14%">

							<b>Статус заявки</b>

						</td>

						<td></td>

					</tr>';

	if ($requests) {

		foreach ($requests as $request) {	    

			if ($request['state'] >= 7 && $request['state'] <= 17) {

				$status = '<span class="'.State::getClass($request['state']).'">'.State::getStateName($request['state']).'</span>';

			}

			

		$text .= '		<tr>

							<td>';

					

	

		$text .= 				$request['s_name'];

	

	

		$text .= '			</td>

							<td>

							'.$request['comment'];

		$text .= '			</td>

							<td>

							'.$request['time'].'

							</td>

							<td>

								'.$status.'

							</td>

							<td align="center" width="90">';

		    		

				$checkStatusFile = $modules_root.$account->getRequestForm($request['id_subservice'], $request['registry_number']);

		    		if(file_exists($checkStatusFile)){

		    			if ($request['state'] == 11) {

		    				$url_tmp = '/forms?request_id='.$request['id_request'].'&subservice_id='.$request['id_subservice'].'&outId='.$request['id_out'];

		    				if (isset($request['user_action'])&&$request['user_action']!=""){

		    					$url_tmp .= '&user_action='.$request['user_action'];

		    				}

		    				$text .= '			<a href="'.$url_tmp.'" >Продолжить</a>';

	 	    			}//else {

						
								$text .= '<a href="/account?request_id='.$request['id_request'].'&id_subservice='.$request['id_subservice'].'&outId='.$request['id_out'].'" >Проверить</a>';
								
								if ($request['id_subservice'] != 5494) {
							
									$text .= '<br> <a style="font-size: 9px; color: rgb(240, 96, 96); text-align: center;" href="/forms?subservice_id=5494&outId='.$request['id_out'].'&abuse_subservice='.$request['id_subservice'].'">Подать жалобу</a>';  
								
								}

		    			//	$text .= '<br /><br /><a href="/account?showRequest=on&request_id='.$request['id_request'].'" >Просмотр заявки</a><br/>';

	// 	    			}

					}

						

					$cancelFile = $modules_root."forms/cancels/cancel_".$request['registry_number'].".php";

					if (State::isCanceled($request['state']) && file_exists($cancelFile)) {

						$url_tmp = '/forms?request_id='.$request['id_request'].'&subservice_id='.$request['id_subservice'].'&outId='.$request['id_out'].'&action='.$request['user_action'];

						if ($request['user_action'] == 'doctor') {

							if ($request['id_out'] == '0') {

								

							} else {

								$text .= '	<script src="/templates/assets/js/doctors.js"></script>';

								$text .= '			<a href="#" id="cancelBtn" idOut="'.$request['id_out'].'" reqSub="'.$request['id_request'].'&'.$request['id_subservice'].'" onclick="cancelDoctor(this);">Отменить</a>';

								

							}

						} else {

							$text .= '<a href="/account?request_id='.$request['id_request'].'&id_subservice='.$request['id_subservice'].'&outId='.$request['id_out'].'&user_action=cancel&state='.$request['state'].'" id="cancelBtn" >Отменить</a>';

						}					

					}

					

		$text.=	'			</td>

						</tr>';

		}

	}

	$text .= '</table>';

			

	$text .= '	<script type="text/javascript">

					$(document).ready(function(){

				    	$("div#content_content").removeClass().addClass("content");

						$("div#content_center").removeClass().addClass("center");

						$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Личный кабинет");

						$("div#content_line").removeClass().addClass("blue_linecab").html("<div class=\"sub_menucab\">	 <ul class=\"topsub_menucab\"> <li class=\"current\"><a href=\"#tab-1\" data-toggle=\"tab\">Заявления</a></li> <li><a href=\"#tab-2\" data-toggle=\"tab\">Платежи</a></li><!--<li><a href=\"#tab-3\">Персональные данные</a></li><li><a href=\"#\">Черновики</a></li>  <li><a href=\"#\">Обучение</a></li> <li><a href=\"#\">Заметки</a></li> <li><a href=\"#\">Избранное</a></li> <li class=\"current\">Настройки</li>--> </ul>  <div class=\"cl\"></div>");

						$(".topsub_menucab a").click(function(){

							$(".topsub_menucab li.current").removeClass("current");

							$(this).tab("show");

							$(this).closest("li").addClass("current");

						});

						$("head").append("<script src=\"/templates/assets/js/payments.js\"/>");	

					});

				</script>';

	$text .= '<script type="text/javascript">

				function cancelDoctor(el) {

					var reqSub = $(el).attr("reqSub").split("&");

					

					doctorRecordCancel($(el).attr("idOut"), reqSub[0], reqSub[1]);

				}

					 

			</script>';

	

	$text .= $paginator['text'];

	$text .= '</div><div class="tab-pane" id="tab-2">';

	include $modules_root.'/payments/view/paymentsView.php';

	$text .= '</div><div class="tab-pane" id="tab-3">Данный раздел находится в разработке. Вы сможите зайти сюда позже</div></div>';

	$module['text'] = $text;
