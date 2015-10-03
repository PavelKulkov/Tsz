<?php
	$text = '			<h3 class="title_blank">Результаты поиска</h3>
						<div class="search_block">
							
					
							<form id="searchEngine" name="search_form" class="form-search" action="/search" method="GET" >
							    <table>
								  <tr>
								    <td style="vertical-align:middle">Ваш запрос:</td>
									<td><input class="search-query wh" type="text" placeholder="Поиск" name="search_string" id="search_replace" value="'.$search_string.'"/></td>
								  </tr>';
	$text .= '                    <tr>
	                                <td style="vertical-align:middle">район:</td>
									<td>
									  <select id="municipal_district" name="districts" name="district">';
	$text .= '                  	    <option value="" selected>Все районы</option>';
								      foreach ($output_params['municipal_districts'] as $entry) {
	$text .= '						    <option value='.$entry['id'];
	$text .= 						     $output_params['municipal_district'] == $entry['id'] ? ' selected>' : '>';
	$text .= 						    $entry['name'].'</option>';
								      }
									
	$text .= '                        </select></td><tr></table>';
	$text .= '							
								<button class="search_btn" onclick="emptySearch();">Найти</button>
							</form>';
						
	$text .='				<div class="cl"></div>
							<div class="request">Показать в результатах поиска:</div>
					
							<div class="search_menu search_tabs">
								<ul class="list_search search_tabNavigation">';
									$url = $_SERVER[REQUEST_URI];
	$text .='						<li class="'.( ( strpos($url,'is_news') !== false && strpos($url,'is_organisation') !== false && strpos($url,'is_service') !== false ) ? 'current' : '' ).'" id="search_block_all"><a class="srch" onclick="search_block_change(this);">Все</a></li>
									<li class="'.( ( strpos($url,'is_news') === false && strpos($url,'is_organisation') === false && strpos($url,'is_service') !== false ) ? 'current' : '' ).'" id="search_block_services"><a class="srch" onclick="search_block_change(this);">Услуги</a></li>
									<li class="'.( ( strpos($url,'is_news') === false && strpos($url,'is_organisation') !== false && strpos($url,'is_service') === false ) ? 'current' : '' ).'" id="search_block_organisations"><a class="srch" onclick="search_block_change(this);">Организации</a></li>
									<li class="'.( ( strpos($url,'is_news') !== false && strpos($url,'is_organisation') === false && strpos($url,'is_service') === false ) ? 'current' : '' ).'" id="search_block_news"><a class="srch" onclick="search_block_change(this);">Новости</a></li>
								</ul>
							</div>
							<div class="cl"></div>
						</div>
				
				
						<div class="search_result search_result_block">';
						//print_r($output_params);				
						if ( $output_params['is_news'] && $output_params['is_organisation'] && $output_params['is_service'] ) {
						//$text .= $paginator['text'];
	$text .= '			<div id="search_block_all">';
						if ( $output_params['search_list'] ) {
	$text .= '				<ol class="result">';
	
							if ($output_params['news_count'] > 0) {
	$text .= '						<h3>Новости</h3><br />';
								$i = 0;
								foreach ($output_params['search_list'] as $item) {
									if ($item['table'] == 'news') {
	$text .= '						<li><a href="news?id_news='.$item['id'].'">'.$item['title'].'</a></li>';	
										$i++;
										if ($i == All_SEARCH_RESULT_COUNT) {
	$text .= '								<a class="more_info" id="more_news" onclick="moreSearchResults(this);">Подробнее...</a><br />';
											break;
										}
									}									
								}
							} else {
	$text .= '					<h3>Новости</h3><br /><p>По данному запросу новостей не найдено!</p>';
							}
							
							if ($output_params['organisation_count'] > 0) {
	$text .= '					<br /><h3>Организации</h3><br />';
								$i = 0;
								foreach ($output_params['search_list'] as $item) {
									if ($item['table'] == 'organisations') {
	$text .= '							<li><a href="organisations?id_organisation='.$item['id'].'">'.$item['title'].'</a></li>';
										$i++;
										if ($i == All_SEARCH_RESULT_COUNT) {
	$text .= '								<a class="more_info" id="more_organisations" onclick="moreSearchResults(this);">Подробнее...</a><br />';
											break;
										}
									}
								}
							} else {
	$text .= '					<br /><h3>Организации</h3><br /><p>По данному запросу организаций не найдено!</p>';
							}
							
							if ($output_params['service_count'] > 0) {
	$text .= '					<br /><h3>Услуги</h3><br />';
								$i = 0;
								foreach ($output_params['search_list'] as $item) {
									if ($item['table'] == 'services') {
	$text .= '							<li><a href="services?service_id='.$item['id'].'">'.$item['title'].'</a></li>';
										$i++;
										if ($i == All_SEARCH_RESULT_COUNT) {
	$text .= '								<a class="more_info" id="more_services" onclick="moreSearchResults(this);">Подробнее...</a><br />';
											break;
										}
									}
								}
							} else {
	$text .= '					<br /><h3>Услуги</h3><br /><p>По данному запросу услуг не найдено!</p>';
							}
							
	$text .= '				</ol>';
						} else {
	$text .= '				По Вашему запросу ничего не найдено.';							
						}
						
	$text .= '			</div>';
					} else if ($output_params['is_news'] || $output_params['is_organisation'] || $output_params['is_service']){
						
						if ($output_params['is_news']){
	$text .= '				<div id="search_block_news">';
							if ($output_params['news_count'] != 0) {
								if ($output_params['news_list']) {
									//$text .= $paginator['text'];
	$text .= '						<ol class="result">';			
									$i = 0;
									foreach ($output_params['news_list'] as $entry) {
	$text .= '							<li><a href="/news?id_news='.$entry['id'].'" >'.$entry['annotation'].'</a></li>';
									}

	$text .= '						</ol>';
	$text .= 						$paginator['text'];
								}  
							} else {
	$text .= '					<p>Нет новостей, удовлетворяющих запросу</p>';
							}
	$text .= '				</div>';
						}
						
						if ($output_params['is_service']) {
	$text .= '				<div id="search_block_services">';
							if ($output_params['service_count'] != 0){
								if ($output_params['service_list']) {		
									//$text .= $paginator['text'];
	$text .= '						<ol class="result">';			
									foreach ($output_params['service_list'] as $entry) {
	$text .= '							<li><a href="/services?service_id='.$entry['id'].'">'.$entry['s_short_name'].'</a></li>';
									}
	$text .= '						</ol>';
	$text .= 						$paginator['text'];
								} 
							} else {
	$text .= '					<p>Нет услуг, удовлетворяющих запросу</p>';
							}
	$text .= '				</div>';
						}
						
						if ($output_params['is_organisation']) {
	$text .= '				<div id="search_block_organisations">';
							if ($output_params['organisation_count'] != 0) {
								if ($output_params['organisation_list']) {	
									//$text .= $paginator['text'];
	$text .= '						<ol class="result">';	
									foreach ($output_params['organisation_list'] as $entry) {
	$text .= '							<li><a href="/organisations?id_organisation='.$entry['id'].'">'.$entry['c_name'].'</a></li>';
									}
	$text .= '						</ol>';
	$text .= 						$paginator['text'];
								}  
							}  else {
	$text .= '					<p>Нет организаций, удовлетворяющих запросу</p>';
							} 
	$text .= '				</div>';
						}						
					}					
	$text .= '			</div>';
	
	$text .= '	<script type="text/javascript">
					$(document).ready(function(){
				        var url = window.location.href;
						var text_link;   
						if ( url.indexOf("is_service") != -1 && url.indexOf("is_organisation") != -1 && url.indexOf("is_news") != -1 ) {
							text_link = $("div.search_tabs ul.search_tabNavigation li#search_block_all a").text();
							$("div.search_tabs ul.search_tabNavigation li#search_block_all").text(text_link);
						} else if ( url.indexOf("is_service") != -1 && url.indexOf("is_organisation") == -1 && url.indexOf("is_news") == -1 ) {
							text_link = $("div.search_tabs ul.search_tabNavigation li#search_block_services a").text();
							$("div.search_tabs ul.search_tabNavigation li#search_block_services").text(text_link);
						} else if( url.indexOf("is_service") == -1 && url.indexOf("is_organisation") != -1 && url.indexOf("is_news") == -1 ) {
							text_link = $("div.search_tabs ul.search_tabNavigation li#search_block_organisations a").text();
							text_link = $("div.search_tabs ul.search_tabNavigation li#search_block_organisations").text(text_link);
						} else if ( url.indexOf("is_service") == -1 && url.indexOf("is_organisation") == -1 && url.indexOf("is_news") != -1 ) {
							text_link = $("div.search_tabs ul.search_tabNavigation li#search_block_news a").text();
							text_link = $("div.search_tabs ul.search_tabNavigation li#search_block_news").text(text_link);
						}
						
						$("div#content_content").removeClass().addClass("content");
						$("div#content_center").removeClass().addClass("center");
						$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Результаты поиска");
						$("div#content_line").removeClass().addClass("blue_line");
					});
	
	
					function emptySearch(){
						if($("#search_replace").val() == "") {
							alert("Поле поиска не может быть пустым!");
						return false;
						}
				
						var search_name = $("div.search_tabs ul.search_tabNavigation li.current").attr("id").split("_").pop();
						if ( search_name == "all") {
								$("form#searchEngine").attr("action", "search?search_string='.$search_string.'&is_news=on&is_service=on&is_organisation=on").attr("method", "POST");
							} else if (search_name == "services"){
								$("form#searchEngine").attr("action", "search?search_string='.$search_string.'&is_service=on").attr("method", "POST");
							} else if (search_name == "organisations"){
								$("form#searchEngine").attr("action", "search?search_string='.$search_string.'&is_organisation=on").attr("method", "POST");
							} else if (search_name == "news"){
								$("form#searchEngine").attr("action", "search?search_string='.$search_string.'&is_news=on").attr("method", "POST");
							}	
							
							$("form[name=\"search_form\"]").submit();
					};
				</script>';