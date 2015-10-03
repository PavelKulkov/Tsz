<?php
	$text = '';
	$text .= '<p>Результаты поиска</p>
			<form id="searchEngine" name="search_form" style="max-width: 500px;" class="form-search" action="/search" method="GET" onsubmit="return emptySearch();" >
				<input class="search-query" style="width: 200px;" type="text" placeholder="Поиск" name="search_string" id="search_replace" value="'.$search_string.'"/><br />
				<label class="checkbox"  id="is_news"><input type="checkbox" name="is_news" class="checkbox_chk" '.($output_params['is_news'] ? 'checked': '').'> Новости </label>
				<label class="checkbox"><input type="checkbox" name="is_service" class="checkbox_chk" id="is_service" '.($output_params['is_service'] ? 'checked' : '').'> Услуги </label>
				<label class="checkbox"><input type="checkbox" name="is_organisation" class="checkbox_chk" id="is_organisation" '.($output_params['is_organisation'] ? 'checked' : '').'> Организации </label><br /><br />
				<label class="checkbox" id="websql_label"><input type="checkbox" name="websql" id="websql" />Поиск по распределенной базе</label><br />
				<button type="submit" class="btn btn-info"><i class="icon-search icon-white"></i>Поиск</button>
			</form>
			
			<div id="loader" style="position:relative; display: block; margin:0 auto; text-align:center;">
				<img src="/templates/images/preloader.gif" width="20px" /> &nbsp Идет загрузка данных. Подождите!
			</div>';
	
	$text .= '<script type="text/javascript">
				$("input#websql").change(function(){
					if ($(this).attr("checked")) {			
						$("#is_news").hide();
						$("#news").css("vicibiliy", "hidden");
						$("ul li a#news_link").hide();
						$("form#searchEngine").attr("action", "#").attr("method", "").attr("onsubmit", "return processInfo();");
	        			return false;
	 				} else {
	        			$("#is_news").show();
	        			$("#news").css("vicibiliy", "visible").html("<p>Результаты поиска по новостям: </p><p>Нет новостей, удовлетворяющих запросу</p>");
	        			$("#news_badge").text("0").removeClass("badge-success");
	        			$("ul li a#news_link").show();
	        			$("form#searchEngine").attr("action", "search?is_news=true&is_service=true&is_organisation=true").attr("method", "POST").attr("onsubmit", "return emptySearch();");
					}   
	  			});
	  		
	  			function emptySearch(){ 
	  				if($("#search_replace").val() == "") {
	  					alert("Поле поиска не может быть пустым!");
	    				return false;
	  				}
	  				
				};
				
				$(document).ready(function(){
					$("#loader").hide();
				});
	  		
			  </script>';
	
	
	if ($search_string == ""){
		$text .= "<p>Не задано значение для поиска</p>";
		
	}
	
	if ($output_params['is_news'] || $output_params['is_organisation'] || $output_params['is_service']){
		$text .= '<ul class="nav nav-tabs search_tab">';
		$active_tab_created = false;
		if ($output_params['is_news']){
			$text .= '<li class="active"><a href="search#news" data-toggle="tab" id="news_link" >Новости';
			$text .= ($output_params['news_count'] == 0) ? '<span class="badge">'.$output_params['news_count'].'</span>' : '<span class="badge badge-success" id="news_badge">'.$output_params['news_count'].'</span>';
			$text .= '</a></li>';
			$active_tab_created = true;
		}
		if ($output_params['is_service']){
			if ($active_tab_created) {
				$text .= '<li><a href="/#services"  data-toggle="tab">Услуги';
			} else {
				$text .= '<li class="active"><a href="/search#services"  data-toggle="tab">Услуги';
				$active_tab_created = true;
			}
			$text .= ($output_params['service_count']) == 0 ? '<span class="badge" id="service_badge">'.$output_params['service_count'].'</span>' : '<span class="badge badge-success" id="service_badge">'.$output_params['service_count'].'</span>';
			$text .= '</a></li>';
		}
		if ($output_params['is_organisation']){
			if ($active_tab_created) {
				$text.= '<li><a href="/#organisations"  data-toggle="tab">Организации';
			} else {
				$text .= '<li class="active"><a href="/search#organisations"  data-toggle="tab">Организации';
				$active_tab_created = true;
			}
			$text .= ($output_params['organisation_count'] == 0) ? '<span class="badge" id="organisation_badge">'.$output_params['organisation_count'].'</span>' : '<span class="badge badge-success" id="organisation_badge">'.$output_params['organisation_count'].'</span>';
			$text .= '</a></li>';
			
		}
		
		$text .= '</ul>';
		$text .= '<div class="tab-content">';
		$active_pane_created = false;
		
		
		if ($output_params['is_news']) {
			$text .= '<div class="tab-pane active" id = "news">';
			$active_pane_created = true;
			$text .= '<p>Результаты поиска по новостям:</p>';
			if ($output_params['news_count'] != 0) {
				if ($output_params['news_list']) {
					$text .= $paginator['text'];
					foreach ($output_params['news_list'] as $entry) {
						$text .= '<article class="thumbnail" style="background: #f8f8f0">';
						$text .= '<table id="news" cellpadding="0" cellspacing="0" width="100%" style="padding: 15px 0; "><tbody><tr>
								<td valign="top" align="center" width="80">';
						$text .= '<span style="color: #6faa1e; padding: 5px 0;">'.date('d.m.Y H:i',strtotime($entry['date'])).'</span>';
						$text .= '</td>
								<td valign="top">
								<div style="padding: 0 0 5px 5px;">';
						$text .=  '<a href="/news?id_news='.$entry['id'].'">'.$entry['title'].'</a></div>';
						$text .= '<div style="padding: 0 0 15px 5px;">
								<a href="/news?id_news='.$entry['id'].'" style="font-size:12px; text-decoration: none; color: #777777;">'.$entry['annotation'].'</a>
										</div>';
						if ($admin) {
							$text .= "<div align=\"right\">
									<button type=\"submit\" onclick=\"location.href='/news".$url."id_news=".$entry['id']."&operation=edit'\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i>Редактировать</button>
											<a class=\"btn btn-danger confirm-delete\" data-id='".$entry['id']."'><i class=\"icon-trash icon-white\"></i> Удалить</a>
													</div>";
						} else {
							$text .= '<div align="right">
									<a class="btn btn-success" href="/news?id_news='.$entry['id'].'">Читать<i class="icon-chevron-right icon-white"></i></a>
											</div>';
						}
						$text .= '</td>
								</tr></tbody></table>';
						$text .= '</article><br>';
	
					}
					$text .= $paginator['text'];
				}
			} else {
				$text .= '<p>Нет новостей, удовлетворяющих запросу</p>';
			}
			
			$text .= '</div>';
		}
		
		
		if ($output_params['is_service']) {
			$text .= '<div class="tab-pane '.(!$active_pane_created? 'active': '').'" id = "services">';
			$active_pane_created = true;
			$text .= '<p>Результаты поиска по услугам:</p>';
			if ($output_params['service_count'] != 0) {
				if ($output_params['service_list']) {
					$text .= $paginator['text'];
					
					foreach ($output_params['service_list'] as $entry) {
						$text .= '<article class = "well">
									<span class="label label-info pull-right">'.$entry['type_item']['name'].'</span>
									<p><a href="/services?service_id='.$entry['id'].'">'.$entry['s_short_name'].'</a></p>
									<p><small>'.$entry['s_name'].'</small></p>
									<p>
										<small>
											Организация ответственная за оказание услуги: <a href="/organisations?id_organisation='.$entry['company_id'].'">'.$entry['company_item']['c_name'].'</a>
										</small>	
									</p>
									<p align="right">
										<a class="btn btn-success" href="/services?service_id='.$entry['id'].'">Подробнее<iclass="icon-chevron-right icon-white"></i></a>
									</p>
								</article>';
					}
					
					$text .= $paginator['text'];
				}
			} else {
				$text .= '<p>Нет услуг, удовлетворяющих запросу</p>';
			}
			$text .= '</div>';
		}
		
		
		if ($output_params['is_organisation']) {
			$text .= '<div class="tab-pane '.(!$active_pane_created? 'active': '').'" id = "organisations">';
			$active_pane_created = true;
			$text .= '<p>Результаты поиска по организациям:</p>';
			if ($output_params['organisation_count'] != 0) {
				if ($output_params['organisation_list']) {
					$text .= $paginator['text'];
					
					foreach ($output_params['organisation_list'] as $entry) {
						$text .= '<article class = "well">
									<span class="label label-info pull-right">'.$entry['type_item']['name'].'</span>
									<p><a href="/organisations?id_organisation='.$entry['id'].'">'.$entry['c_name'].'</a></p>
									<p><small>Руководитель: '.$entry['c_head'].'</small></p>
									<p><small><a href="'.$entry['c_web_site'].'">Официальный сайт</a></small></p>
									<p>Контактная информация:'.$entry['c_contacts'].'</p>
									<p align="right">
										<a class="btn btn-success" href="/organisations?id_organisation='.$entry['id'].'">Подробнее<i class="icon-chevron-right icon-white"></i></a>
									</p>
								</article>';
					}
					
					$text .= $paginator['text'];
				} 
			} else {
				$text .= '<p>Нет организаций, удовлетворяющих запросу</p>';
			}
			$text .= '</div>';
		}
		
		$text .= '</div>';
	} else {
		$text .= '<p>Не выбраны критерии для поиска</p>';
	}
	
	$text .= '<div id="details"></div>';
	
	
	
	
	
	