<?php
	$text = '	<span class="label label-info pull-right">'.$output_params['organisation']['type_item']['name'].'</span>
				<p><a href="/organisations?id_organisation='.$output_params['organisation']['id'].'">'.$output_params['organisation']['c_name'].'</a></p>
				<p><small>Руководитель: '.$output_params['organisation']['c_head'].'</small></p>
				<p><small><a href="'.$output_params['organisation']['c_web_site'].'">Официальный сайт</a></small></p>
				<p>Контактная информация: '.$output_params['organisation']['c_contacts'].'</p>
				<p>Автоинформатор: '.( !empty($output_params['organisation']['autoinformer']) ? $output_params['organisation']['autoinformer']: 'Не указано' ).'</p>
				<p align="right">
					<a class="btn btn-success"	href="/organisations">К списку органиаций<i class="icon-chevron-right icon-white"></i></a>
				</p>';
	
	if (isset($output_params['parent_entry_id'])){
		$text .= '<p>Головная организация:</p>';
		$text .= '<a href=/organisations?id_organisation='.$output_params['parent_entry']['id'].'>'.$output_params['parent_entry']['c_name'].'</a>';
	}
	
	$active_tab_created = false;
	//Tabs
	
	$text .= '<ul class="nav nav-tabs">';
	if ($output_params['service_count'] !=0){
		$text .= '<li class="active">
					<a href="#services" data-toggle="tab">
						Оказывает услуги <span class="badge badge-success">'.$output_params['service_count'].'</span>
					</a>
				</li>';
		$active_tab_created = true;
	}
	
	if ($output_params['child_organisations_count'] != 0){
		if ($active_tab_created){
			$text .= '<li><a href="#child_org" data-toggle="tab">Подведомственные организации';
		}else{
			$text .= '<li class="active"><a href="#child_org" data-toggle="tab">Подведомственные организации';
		}
		$text .= '<span class="badge badge-success">'.$output_params['child_organisations_count'].'</span>';
		$text .= '</a></li>';
		$active_tab_created = true;
	}
	
	$text .= '</ul>';
	
	//tabs content
	$active_pane_created = false;
	$text .= '<div class="tab-content">';
	
	if ($output_params['service_count'] != 0){
		$text .= '<div class="tab-pane active" id="services">';
		if(isset($output_params['service_paginator'])){
			$text .= $paginator['text'];
			
			foreach ($output_params['service_list'] as $service_entry) {
				$text .= '	<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$service_entry['id'].'">'.$service_entry['s_name'].'</a>
								</div>
								<div id="collapse'.$service_entry['id'].'" class="accordion-body collapse">
										<div class="accordion-inner">
											<div>Короткое наименование:'.$service_entry['s_short_name'].'</div>
											<div>Административный регламент: '.$service_entry['s_reglament_name'].'</div>';
				if (isset($service_entry['subservices']) && !empty($service_entry['subservices'])) {
					$text .= '<ul>';
					foreach ($service_entry['subservices'] as $subservice_entry){
						$text .= '<li>'.$subservice_entry['s_short_name'].'</li>';
						$text .= '<a class="btn btn-success" href="/services?subservice_id='.$subservice_entry['id'].'">Подробнее<i	class="icon-chevron-right icon-white"></i></a>';
						if ($subservice_entry['s_digital_form'] == 1 or $subservice_entry['s_digital_form'] == 2){
							$text.='<a class="btn btn-success" href="/forms?subservice_id='.$subservice_entry['id'].'">Подать заявление<i class="icon-chevron-right icon-white"></i></a>';
						}
					}
					$text.='</ul>';
				}
				$text.='				</div>
								</div>
							</div>';
			}
			
			
			$text .= $paginator['text'];
			$active_pane_created = true;
		}
		$text .= '</div>';
	}
	
	if ($output_params['child_organisations_count'] != 0){
		if (!$active_pane_created){
			$text .= '<div class="tab-pane active" id="child_org">';
		}else{
			$text .= '<div class="tab-pane" id="child_org">';
		}
		
		$text .= $paginator['text'];
		
		foreach ($output_params['organisation_list'] as $child_entry) {		
			$text.='<article class = "well">
						<span class="label label-info pull-right">'.$child_entry['type_item']['name'].'</span>
						<p><a href="/organisations?id_organisation='.$child_entry['id'].'">'.$child_entry['c_name'].'</a></p>
						<p><small>Руководитель: '.$child_entry['c_head'].'</small></p>
						<p><small><a href="http://'.$child_entry['c_web_site'].'">Официальный сайт</a></small></p>
						<p>Контактная информация:'.$child_entry['c_contacts'].'</p>
						<p align="right">
							<a class="btn btn-success" href="/organisations?id_organisation='.$child_entry['id'].'">Подробнее<i class="icon-chevron-right icon-white"></i></a>
						</p>
					</article>';
		}
		
		$text .= $paginator['text'];
		$text .= '</div>';
	}	