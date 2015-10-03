<?php
$text = '		<div class="select_district">Выбрать район:</div>
							<form id="organisationsType" name="form-search" class="form-search" action="/organisations" method="POST">
								<select class="district" name=municipal_district id="districts">
									<option value="" selected>Все районы</option>';
									foreach ($output_params['municipal_districts'] as $entry) {
	$text .= '						<option value='.$entry['id'];
	$text .= 						$output_params['municipal_district'] == $entry['id'] ? ' selected>' : '>';
	$text .= 						$entry['name'].'</option>';
									}
	$text .= '					</select>
							</form>
						<div class="cl"></div>
						<div class="rule"></div>
				
						<form id="letters" name="letters" action="/organisations" method="POST">
							<input name="letter" type="hidden" />';
				
	$text .= '				<ul class="abc">';
							foreach ($letters_rus as $letter) {
	$text .= '					<li class="letter" id="letter_'.$letter.'"><a href="#'.$letter.'" onclick="org_letter_search(this);">'.$letter.'</a></li>';
							}
	$text .= '				</ul>
						</form>
	
						<div class="cl"></div>';
	
	if ($output_params['list']) {
		//$text .= $paginator['text'];		
		foreach ($output_params['list'] as $entry) {		
			$text .= '	<div class="list_services">
							<div class="symbol"></div>
							<div class="service"><a href="/organisations?id_organisation='.$entry['id'].'">'.$entry['c_name'].'</a></div>
							<div class="cl"></div>';
							if (count($entry['service'])  > 0) {
			$text .= '			<div class="show_list">';
								for ($i = 0; $i < count($entry['service']); $i++) {
			$text .= '				<div class="show_list_txt"><a href="services?service_id='.$entry['service'][$i]['id'].'">'.$entry['service'][$i]['s_name'].'</a></div>';			
								}
			$text .= '			</div>';
							}
			$text .='	</div>';
		}
		
		$text .= $paginator['text'];
	} else {
		$text .= '<br />По вашему запросу ничего не найдено.';
	}
	$text .= '	<script type="text/javascript">
					$(document).ready(function(){';
					if(isset($_POST['letter'])) {
	$text .= '			
						var tab = $("form#letters ul.abc li#letter_'.$_POST['letter'].'");
						var tab_text =  $(tab).children("a").text();
						$(tab).html(tab_text).addClass("current");';
					} else {
	$text .= '';					
					}
	$text .= '		
					$("div#content_content").removeClass().addClass("content_org");
					$("div#content_center").removeClass().addClass("center_org");
					$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Ведомства и организации");
					$("div#content_line").removeClass().addClass("pink_line");
					
					});
		
					$("select#districts").change(function(){
						
						if ( this.value == "" ) {						
							window.location.href = "/organisations";
						} else {
							$("form#organisationsType").submit();
						}
					});
					
					function org_letter_search(el) {
						$("input[name=letter]").val($(el).text());
						
						// Определяем текст в кликнутой ссылке и текст в текущей вкладке, чтобы поменять местами. 
						var link_text = $(el).text();
						var current_link = $("form#letters ul.abc li.current");   
						var prev_link_text = current_link.text();
						
						current_link.removeClass("current").html("<a href=\"#\"" + prev_link_text + " onclick=\"org_letter_search(this);\" > " + prev_link_text + "</a>");
						$(el).parent("li").text(link_text).addClass("current");
						$("form[name=letters]").attr("action", "organisations?letter=" + link_text);
						$("form[name=letters]").submit();
					};
				</script>';