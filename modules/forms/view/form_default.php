<?php
		$text = '	<div class="rule" style="margin-top:20px;"></div>';
//  		include 'c:\WebServers\home\dev-1.oep-penza\www\test_tpl.html';
		$text .= '	<button type="button" class="btn btn-primary" id="printDocument" onclick="printDocument();">Печать документа</button>
					<div id="output" style="display: none;"></div>
					<iframe id="printOutput" style="width:0;height:0;border:0"></iframe>';
 		$text .=					(!(isset($form) && isset($form['content_'.SITE_THEME])) ? 'Не найдено формы для данной услуги! Обратитесь в службу поддержки!' : $form['content_'.SITE_THEME] );
		$text .=			'
						
					
					
					
					<script type="text/javascript">
						$(document).ready(function(){
					    	$("div#content_content").removeClass().addClass("'.( ($recipient == 'phys') ? 'content_disp' : 'content_jur' ).'");
							$("div#content_center").removeClass().addClass("'.( ($recipient == 'phys') ? 'center_disp' : 'center_jur' ).'");
							$("div#content_center").attr("style", "margin-top: -5px;");
							
							var navigation_menu = "<div class=\"nav_menu\">" + 
													"<ul class=\"topnav_menu\">" +'; 
													$first_menu = true;
													if($menu_categories) {
														foreach ($menu_categories as $item) {	
															if ($item['category_id'] == $item['id']) {
		$text .= '											"<li class=\"current\">'.$item['short_name'].'</li>" +';											
															$first_menu = false;
															} else {
		$text .= '											"<li><a href=\"/services?service_categories='.$item['id'].'\">'.$item['short_name'].'</a></li>" +';											
															}		
														}	
													}		
																
													
		$text .= '									"</ul>" + 
													"<div class=\"cl\"></div>" + 
													"</div>";
				
							$("div.marg_center").prepend(navigation_menu);													
							$("div#content_navigation").removeClass().addClass("navigation_disposal");
							$("div#content_navigation").html("<a href=\"/\">Главная</a>  / ';
							foreach ($menu_categories as $item) {	
										if ($item['category_id'] == $item['id']) {				
		$text .=								$item['short_name'];
										}
								}
							
		$text .= '			");
							
							$("div#content_line").removeClass().addClass("'.( ($recipient == 'phys') ? 'green_line' : 'orange_line' ).'");
						});
									
						';
						if (preg_match('/^(192.168){1}\.{1}\d{1,3}\.{1}\d{1,3}$/', $_SERVER['REMOTE_ADDR']) && !in_array($_SERVER['REMOTE_ADDR'], $ip_list) ) {
							include 'templates/virtualKeyboard.html';
		
						}
		$text .= 	'			
					</script>';
