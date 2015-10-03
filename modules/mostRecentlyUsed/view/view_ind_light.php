<?php
	
if (!empty($services)) {
	$text = 'Часто используемые услуги: <br><br>';
	$text .= '	<div class="accordion" id="accordion3">';

	foreach ($services as $service) {
	$text .= ' 		<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="services?subservice_digital_form#collapse'.$service['service_id'].'">
								'.$service['service_name'].'
							</a>
	    				</div>
						<div id="collapse'.$service['service_id'].'" class="accordion-body collapse">';
						if (isset($service['subservice'])&& is_array($service['subservice'])) {
	$text .= '				<div class="accordion-inner">
								<div>Короткое наименование:'.$service['s_short_name'].'</div>';			
								if ($service['reglament']){
	$text .= '					<div>Административный регламент: 
									<!-- <a href="/scripts/import/files.php?reglament_id='.$service['reglament']['id'].'">'.$service['reglament'].'</a> -->
									<a href="#">'.$service['reglament']['reglament_name'].'</a>
								</div>';
								}
	$text .= '					<ul>';
								foreach ($service['subservice'] as  $sub) {
	$text .= '						<li>'.$sub['s_short_name'].'</li>';
	$text .= '							<a class="btn btn-success"	href="/services?subservice_id='.$sub['id'].'">Подробнее<i class="icon-chevron-right icon-white"></i></a>';
										if ($sub['s_digital_form']==1 || $sub['s_digital_form']==2){
	$text .= '							<a class="btn btn-success"	href="/forms?subservice_id='.$sub['id'].'">Подать заявление<i class="icon-chevron-right icon-white"></i></a>';
										}
								}
	$text .= '					</ul>
							</div>';
						}
		$text .= '		</div>
					</div>';
	}
	$text .= '	</div>';
}
	
	
	$text .= '
		<script type="text/javascript">
		$(document).ready(function(){
		$("#accordion2").collapse({
		toggle: true});
});
		</script>';