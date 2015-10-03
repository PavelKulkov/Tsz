<?php
$text = '	<div class="in_site">Сейчас на сайте</div>
			<div class="sum">
				<div class="all"> всего '.$output_params['service_count'].'</div>
				<div class="disposal">
					<div class="disposal_num">'.$output_params['service_count'].'</div>
					<div class="disposal_txt">услуги</div>
				</div>
				<div class="in_detail" align="center">
					<table class="detail_num">
					<!--
						<tr>
							<td class="violet">'.$output_params['fed_count'].'</td>
							<td>федеральных</td>
							
						</tr>
					-->							
						<tr>
							<td class="violet">'.$output_params['gos_count'].'</td>
							<td>региональных</td>
							
						</tr>							
						<tr>
							<td class="violet">'.$output_params['mun_count'].'</td>
							<td>муниципальных</td>
							
						</tr>
					</table>
				</div>
				<div class="function">
					<div class="function_num">'.$output_params['digital_s_count'].'</div>
					<div class="function_txt">в эл.виде</div>
				</div>
				<div class="cl"></div>
			</div>
			<div class="also">, также:</div>
			<div class="orgdoc_block">
				<div class="block_bg">
					<div class="bg_organization">'.$output_params['company_count'].'</div>
					<div class="block_txt">организаций</div>
				</div>
				<div class="block_bg">
					<div class="bg_doc">'.$output_params['doc_count'].'</div>
					<div class="block_txt">документов</div>
				</div>
			</div>';
?>