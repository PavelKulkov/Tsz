<?php	
	$text	='
	<style>
	#select_6 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<div class="pageNavigation">
          <p><a href="\">Главная</a> -> Контакты</p>
      </div>
      <div class="pageTitle">
          <h1>Контактная информация</h1>
      </div>
	<div class="contacts">
	<div class="contantsContent">
              <span class="contactInfo"><strong>Адрес</strong></span>
              <span class="contactText">'.$list['address_organization'].'</span>
          </div>
           <div class="contantsContent">
              <span class="contactInfo"><strong>Телефон</strong></span>
              <span class="contactText">'.$list['city_code'].' <strong>'.$list['telephone_organization'].'</strong></span>
          </div>
           <div class="contantsContent">
              <span class="contactInfo"><strong>E-mail</strong></span>
              <span class="contactText">'.$list['e_mail_organization'].'</span>
          </div>
           <div class="contantsContent">
              <span class="contactInfo"><strong>График работы</strong></span>
              <span class="contactText">'.$list['schedule_organization'].'</span>
          </div>
           <div class="contantsContent">
              <span class="contactInfo">Контактное лицо</span>
          </div>
          <div class="contantsContent">
              <span class="contactInfo"><strong>ФИО</strong></span>
              <span class="contactText">'.$list['full_name_president'].'</span>
          </div>
          <div class="contantsContent">
              <span class="contactInfo"><strong>Телефон</strong></span>
              <span class="contactText">'.$list['citi_code'].'<strong>'.$list['telephone_president'].'</strong></span>
          </div>
          <div class="contantsContent">
              <span class="contactInfo"><strong>E-mail</strong></span>
              <span class="contactText">'.$list['e_mail_president'].'</span>
          </div>';
          if(!empty($lisServices)){
              $text .='  <h3>Телефоны аварийных служб и обслуживающих лиц</h3>';
		  
		      foreach ($lisServices as $entry) {
		          $text .=' <div class="contantsContent">
                              <span class="contactInfo"><strong>'.$entry['title'].'</strong></span>
                              <span class="contactText">'.$entry['citi_code'].'<strong>'.$entry['telephone'].'</strong></span>
                            </div>';
	          }
	      }
    $module['text'] = $text;
?>
							
			
							
	
				