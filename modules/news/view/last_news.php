<?php
	
	$text = '	<div class="news">';
				for($i = 0; $i < (count($output_params['last_news'])); $i++){
					if ($i == 0) {
	$text .= ' 		<div class="news_block">
						<div class="news_title">Новости</div>
						<div class="news_data">'.$output_params['last_news'][$i]['date'].'</div>
						<div class="news_txt"><a href="/news?id_news='.$output_params['last_news'][$i]['id'].'">'.$output_params['last_news'][$i]['title'].'</a></div>
						
					</div>';					
					} else if ($i != count($output_params['last_news']) - 1) {							
	$text .= '		<div class="news_block">
						<div class="news_data pad">'.$output_params['last_news'][$i]['date'].'</div>
						<div class="news_txt pad_txt"><a href="/news?id_news='.$output_params['last_news'][$i]['id'].'">'.$output_params['last_news'][$i]['title'].'</a></div>
					</div>';
					} else {
	$text .= '		<div class="news_block bord">
						<div class="news_data pad">'.$output_params['last_news'][$i]['date'].'</div>
						<div class="news_txt pad_txt"><a href="/news?id_news='.$output_params['last_news'][$i]['id'].'">'.$output_params['last_news'][$i]['title'].'</a></div>
						<div align="right"><a href="/news">Все новости</a></div>
					</div>';						
					}
				}
			
	$text .= '		<div class="cl"></div>
				</div>';