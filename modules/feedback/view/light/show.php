<?php
	$text = '';

	$text .= '	<table class="table table-bordered">
					<tr>
						<td>
							<b>Ф.И.О. заявителя</b>
						</td>
						<td>
							<b>Контакты</b>
						</td>
						<td>
							<b>Текст</b>
						</td>
						<td>
							<b>Дата обращения</b>
						</td>
						<td>
							<b>Статус</b>
						</td>
						<td></td>
					</tr>';
	if (!empty($feedbacks)) {
		foreach ($feedbacks as $feedback) {	    
			
			if ($feedback['status'] == 0) {
				$status = '<span class="error_msg">Не обработано</span>';
			} else {
				$status = '<span class="success_msg">Обработано</span>';
			}
			
		$text .= '		<tr>
							<td>
							'.$feedback['fio'].'
							</td>
							<td>
							'.$feedback['contacts'].'
							</td>
							<td>
							'.$feedback['text'].'
							</td>
							<td>
							'.$feedback['date'].'
							</td>
							<td>
								'.$status.'
							</td>
							<td>
								<a href="/modules/auth/feedback?operation=close&feedback_id='.$feedback['id'].'" >Закрыть заявку</a>
							</td>
						</tr>';
		}
	}
	$text .= '</table>';