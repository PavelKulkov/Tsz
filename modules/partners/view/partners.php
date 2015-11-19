<?php
	$text = '<div class="pageNavigation">
                 <p><a href="\">Главная</a> -> Партнеры и проекты</p>
             </div>
             <div class="pageTitle">
                 <h1>Партнеры и проекты</h1>
             </div>
      
             <div class="ourPartners">
                 <h2>Партнеры Ассоциации ТСЖ города Пензы</h3>';
    foreach ($list as $entry) {
	    $text .= '<div class="ourPartnersContent">
                      <div class="namePartners"> 
                          <a href="'.$entry['site'].'" target="_blank"><img src="/templates/images/partners/'.$entry['logo'].'.png"></a>
                      </div>
                      <p><a href="'.$entry['site'].'" target="_blank">'.$entry['title'].'</a></p>
                  </div>';
	}	
    $text .=' </div>
              <div class="ourPartners">
                 <h2>Совместные проекты</h3>';
    foreach ($list2 as $entry2) {
	    $text .= '<div class="ourPartnersContent">
                      <div class="namePartners"> 
                          <p><a href="'.$entry2['site'].'" target="_blank">'.$entry2['title'].'</a></p>
                      </div>
                      <p>'.$entry2['text'].'</p>
                 </div>';	
    }
    $text .=' </div>';
	
	$module['text'] = $text;
	//echo $listOfPartneryAndProject['content'];
?>