<?php
   $text = '
   <style>
	#select_4 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
   <div class="pageNavigation">
          <p><a href="\">Главная</a> -> Вопрос-ответ</p>
      </div>
      <div class="pageTitle">
          <h1>Часто задаваемые вопросы</h1>
      </div>
   <div class="questions" id="accordion">';
    
	foreach ($list as $entry) {
	    $text .= '
		<h3>'.$entry['title'].'</h3>
              <div class="answer">
                  <p>'.$entry['text'].'</p>
              </div>';
	}
    $text .='</div>';

	$module['text'] = $text;
?>