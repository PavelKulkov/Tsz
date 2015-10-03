<?php
	$text = '	<div class="rule"></div>
				<h3 class="title_blank">Новости</h3>';
				if ($admin) {
	$text .= 	"<div align=\"left\">
					<a class=\"btn btn-success\" href=\"news?operation=create\">Добавить новость<i class=\"icon-chevron-right icon-white\"></i></a>
				</div>";
				}
							
	//$text .= 	$paginator['text'];
	
				foreach ($list as $entry) {							
	$text .= '	<div class="news_list">
					<div class="news_info">
						<div class="news_data1">'.date('d.m.Y H:i',strtotime($entry['date'])).'</div>
						<div class="news_txt1"><a href="news?id_news='.$entry['id'].'">'.$entry['title'].'</a></div>
					</div>
					<div class="cl"></div>
				</div>';
				}
							
	//$text .= 	$paginator['text'];				
							
	$text .= '	<script type="text/javascript">
					$(document).ready(function(){
				    	$("div#content_content").removeClass().addClass("content");
						$("div#content_center").removeClass().addClass("center");
						$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Новости");
						$("div#content_line").removeClass().addClass("blue_line");
					});
				</script>';