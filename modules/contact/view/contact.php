<?php
	if($_SESSION['admin']){
		$text = '<div class="_adminHeader">
          <span class="_adminHeaderL"><p>Контакты</p></span>
      </div>
      
      <div class="_adminList">
          <p class="_adminListL">Название</p>
          <p class="_adminListR">Действие</p>
      </div>
      
      
      <!--################ НАЧАЛО  accordion  ###########################-->
      <div class="_adminAccordion" id="accordion">
          
          <h3 class="_adminAccordionTitle">
              <p>Контактная информация <span><img src="templates/images/select.png"></span></p>
          </h3>
          <div class="_adminAccordionContents">
              <div class="_adminAccordionContent">
                  <p>Адрес</p>
                 <span class="_adminAccordionSelectAction">
                  <a id="address_organization" href="#" class="_adminEditObjectContact_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div> 
              
              <div class="_adminAccordionContent">
                  <p>Телефон</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" class="_adminEditObjectContact_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div> 
              
              <div class="_adminAccordionContent">
                  <p>E-mail</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" class="_adminEditObjectContact_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div> 
              
              <div class="_adminAccordionContent">
                  <p>График работ</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" class="_adminEditObjectContact_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div>
			  <div class="_adminAccordionContent">
                  <p>ФИО главы</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" class="_adminEditObjectContact_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div>
			  <div class="_adminAccordionContent">
                  <p>Телефон главы</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" class="_adminEditObjectContact_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div>
			  <div class="_adminAccordionContent">
                  <p>E-mail главы</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" class="_adminEditObjectContact_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div> 
          </div>
          
          <h3 class="_adminAccordionTitle">
              <p>Телефоны аварийных служб и обслуживающих лиц <span><img src="templates/images/select.png"></span></p>
              <span class="_adminAccordionSelectAction">
                  <a  href="#" class="_adminAddObjectContact_"><span><img src="templates/images/addDoc.png"></span></a>
              </span>
          </h3>
          <div class="_adminAccordionContents">';
             foreach($lisServices as $service){ 
			  $text.='
			  <div class="_adminAccordionContent">
                  <p>'.$service['title'].'</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" class="_adminEditObject_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div>';
			 }
			 $text.='
			 </div>
      </div>
      
      
      
      
      <!-- УДАЛЕНИЕ поля-->
      
      <div class="windowDel" id="_windowDel_">
          <div class="windowDelText">
              <p>Вы уверены, что хотите удалить<br>
              выбранное поле?</p>
          </div>
          <div class="windowButton">
              <a href="#" class="delButton">Удалить</a>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
      </div>
      
      <!-- ДОБАВЛЕНИЕ службу -->
      <div class="windowContact windowEditObject" id="_windowAddObjectContact_">
          <h3>Добавление службы</h3>
          <form method="post" enctype="multipart/form-data">
		 
              <div class="windowEditObjectTitle">
                 <p>Название</p>
                  <input type="text">
              </div>
          
             <div class="windowEditObjectTitle">
                 <p>Телефон</p>
                  <input type="text">
              </div> 
           </form>
          <div class="windowButton">
              <a href="#" class="delButton">Сохранить</a>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
      </div>
      
       <!-- РЕДАКТИРОВАНИЕ СЛУЖБЫ-->
      
      <div class="windowContact windowEditObject" id="_windowEditObjectContact1_">
          <h3>Редактирование службы</h3>
          <form method="post" enctype="multipart/form-data">
		 
              <div class="windowEditObjectTitle">
                 <p>Название</p>
                  <input type="text">
              </div>
              <div class="windowEditObjectTitle">
                 <p>Телефон</p>
                  <input type="text">
              </div> 
           </form>
         
          <div class="windowButton">
              <a href="#" class="delButton">Сохранить</a>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
      </div>
      
      <!-- РЕДАКТИРОВАНИЕ поля-->
      
      <div class="windowContact windowEditObject" id="_windowEditObjectContact_">
          <h3>Редактирование поля</h3>
          <form method="post" enctype="multipart/form-data">
		 
              <div class="windowEditObjectTitle">
                 <p>Название</p>
                  <input type="text">
              </div>
              <div class="windowEditObjectTitle">
                 <p>Содержание</p>
                  <input type="text">
              </div>
           </form>
         
          <div class="windowButton">
              <a href="#" class="delButton">Сохранить</a>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
      </div>';
	}else{
		$text	='
		<style>
		#select_6 a{
			border-bottom: 7px solid #fd8505;
		}
		</style>
		<div class="pageNavigation">
			  <p><a href="/">Главная</a> -> Контакты</p>
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
	}
    $module['text'] = $text;
?>
							
			
							
	
				