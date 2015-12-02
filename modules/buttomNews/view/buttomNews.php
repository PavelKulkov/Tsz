<?php
$text = '';

foreach ($mas as $entry) {
    $masImage = explode(",", $entry['image']);		
	$text .= '<div class="lastNewsBox">
              <div class="lastNewsContent">
                  <div class="lastNewsImage">
                      <a href="news?id_news='.$entry['id'].'"><img src="/templates/images/news/'.$masImage[0].'.png"></a>
                  </div>
                  <div class="lastNewsText">
                      <p>'.$entry['preview'].'</p>
                      <a href="news?id_news='.$entry['id'].'">Подробнее...</a>
                  </div>
              </div>
          </div>';
}	 
$module['text'] = $text;