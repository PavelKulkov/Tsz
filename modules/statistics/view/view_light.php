<?php
$text.='<div>Статистика:</div>
		<p>Всего описаний услуг: <a href="/services">'.$output_params['service_count'].'</a>
		<ul>
				<li>Муниципальных: <a href="/services/type_service_id/1?id=34&p_id=27">'.$output_params['mun_count'].'</a></li>
				<li>Государственных: <a href="/services/type_service_id/2?id=33&p_id=27">'.$output_params['gos_count'].'</a></li>
		</ul></p>
		<p>Услуг в электронном виде: <a href="services/subservice_digital_form/2">'.$output_params['digital_count'].'</a></p>
		<p>Подуслуг в электронном виде: <a href="services/subservice_digital_form/2">'.$output_params['digital_s_count'].'</a></p>
		<p>Описаний организаций: <a href="/organisations">'.$output_params['company_count'].'</a></p>
		<p>Документов: '.$output_params['doc_count'].'</p>';
?>