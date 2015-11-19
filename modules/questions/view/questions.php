<?php
   $text = '<div class="pageNavigation">
          <p><a href="\">Главная</a> -> Вопрос-ответ</p>
      </div>
      <div class="pageTitle">
          <h1>Часто задаваемые вопросы</h1>
      </div>
   <div class="questions">';
    
	foreach ($list as $entry) {
	    $text .= '<div class="question">
                      <span>'.$entry['title'].'</span>
					  <p>'.$entry['text'].'</p>
                  </div>';
	}	
   
   
   
   
    $text .='</div>';
	
	$module['text'] = $text;
?>