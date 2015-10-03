<?php
	$text = '<div class="left">
				<ul class="left_menu">
					<li id="link_block_services"><a class="menu_link" onclick="info_block_change(this);" >Услуги</a></li>
					
				<li id="link_block_contacts"><a class="menu_link" onclick="info_block_change(this);">Адреса и контакты</a></li>
				<!-- 
				<li id="link_block_places"><a class="menu_link" onclick="info_block_change(this);">Места обращения</a></li>

				-->
				<li class="current" id="link_block_organisations">Подведомственные организации</li>
			</ul>
			</div>
			<div class="right">';
			if (isset($output_params['parent_entry'])) {
	$text .= '<div style="margin-bottom: 5px; font-size: 12px;"><a href="/organisations?id_organisation='.$output_params['parent_entry']['id'].'" target="_blank" >'.$output_params['parent_entry']['c_name'].'</a></div>';			
			}	
	$text .= '<h3>'.$output_params['organisation']['c_name'].'</h3>
				<table class="info">
					<tr>
						<td class="first">Руководитель организации</td>
						<td>'.$output_params['organisation']['c_head'].'</td>
					</tr>						
					<tr>
						<td class="first">Вэб-сайт</td>
						<td>
							'.( ($output_params['organisation']['c_web_site'] == 'нет') ? 'нет' : '<a href="'.$output_params['organisation']['c_web_site'].'" target="_blank">'.$output_params['organisation']['c_web_site'].'</a>' ).'
						</td>
					</tr>						
					<tr>
						<td class="first">Электронная почта</td>
						<td>'.$output_params['organisation']['c_email'].'</td>
					</tr>						
					<tr>
						<td class="first">Справочный телефон</td>
						<td>'.$output_params['organisation']['c_contacts'].'</td>
					</tr>						
					<tr>
						<td class="first">Режим работы</td>
						<td>'.( !empty($output_params['organisation']['c_shedule']) ? $output_params['organisation']['c_shedule']: 'Не указано' ).'</td>
					</tr>
					<tr>
						<td class="first">Автоинформатор</td>
						<td>'.( !empty($output_params['organisation']['autoinformer']) ? $output_params['organisation']['autoinformer']: 'Не указано' ).'</td>
					</tr>
				</table>';
				
	$text .= '	<div class="info_block" id="info_block_organisations">';
				if ($output_params['child_organisations_count'] != 0){
	$text .= '		<div class="info_title">Подведомственные организации</div>';
					foreach ($output_params['organisation_list'] as $child_entry) {	
	$text .= '			<div class="info_txt service"><a href="/organisations?id_organisation='.$child_entry['id'].'">'.$child_entry['c_name'].'</a></div>';
					}
	$text .= '	</div>';
				} else {
					$text .= '<div class="info_title">Подведомственные организации</div><br />Отсутствуют.
				</div>';
				}
				
				
	$text .= '	<div class="info_block" id="info_block_contacts">';
				
	$text .= '		<div class="info_title">Адреса и контакты</div>';
						
	$text .= '		<div class="info_txt contacts">
						Адрес: '.( !empty($output_params['organisation']['c_adress']) ? $output_params['organisation']['c_adress'] : 'Нет' ).'<br />
						Телефоны: '.( !empty($output_params['organisation']['c_contacts']) ? $output_params['organisation']['c_contacts'] : 'Нет' ).'
					</div>';
					
	$text .= '	</div>';
				
	

	//print_r($output_params);
	$text .= '<div class="info_block" id="info_block_services">';
				if ($output_params['service_count'] != 0){
	$text .= '		<div class="info_title ">Услуги</div>';
					foreach ($output_params['service_list'] as $service_entry) {
	$text .= '			<div class="list_services">
							<div class="symbol "></div>';						
	$text .= '				<div class="info_txt service"><a href="/services?service_id='.$service_entry['id'].'">'.$service_entry['s_name'].'</a></div>
							<div class="cl"></div>';
							if (isset($service_entry['subservices']) && !empty($service_entry['subservices'])) {
	$text .= '				<div class="show_list">';
							foreach ($service_entry['subservices'] as $subservice_entry){
	$text .= '					<div class="show_list_txt2"><a href="/services?subservice_id='.$subservice_entry['id'].'">'.$subservice_entry['s_name'].'</a></div>';
							}
	$text .= '				</div>';
							}
	$text .= '			</div>';
					}
	$text .= '		</div>';
				}
	$text .= '	';
	$text .= '  <div class="cl"></div>
	
				</div>';

	
	
	$text .= '	<script type="text/javascript">
					$(document).ready(function(){
						$("div.info_block").hide();
						$("div#info_block_organisations").show();
						$("div.info_block_contacts").hide();
						
						
						$("div#content_content").removeClass().addClass("content_org");
						$("div#content_center").removeClass().addClass("center_org");
						$("div#content_navigation").html("<a href=\"/\">Главная</a>  / <a href=\"/organisations\">Ведомства и организации</a> / '.$output_params['organisation']['c_name'].'");
						$("div#content_line").removeClass().addClass("pink_line");
						
					});
				</script>';
	
	include $modules_root.'../templates/newdesign/includes/info_block_change.phtml';
	
	