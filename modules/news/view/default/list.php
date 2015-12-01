<?php
    $text = '
	<style>
	#select_5 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<div class="pageNavigation">
                <p><a href="\">Главная</a> -> Новости</p>
            </div>
            <div class="pageTitle">
                <h1>Новости в сфере ТСЖ</h1>
            </div>
			<div class="news">';
			foreach ($list as $entry) {	
			    $mas = explode(",", $entry['image']);
			    
				$text .= '
				<div class="newsContent">
              <p class="newsContentData">'.date('d.m.Y H:i',strtotime($entry['date'])).'</p>
              <a class="newsContentTitle" href="news?id_news='.$entry['id'].'">'.$entry['title'].'</a>
              <div class="newsText">
                  <img src="/templates/images/news/'.$mas[0].'.png">
                  <p>'.$entry['preview'].'</p>
                  <a href="news?id_news='.$entry['id'].'">Читать дальше</a>
              </div>
          </div>';
			}			
			$text .='</div>';
/*
	$text .= '	<div class="rule"></div>
				<h3 class="title_blank">Новости</h3>';
	
							
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
				</script>';*/
?>