﻿<?php
	if($_SESSION['admin']){
		$text = '<div class="_adminHeader">
          <span class="_adminHeaderL"><p>Партнеры и проекты</p></span>
      </div>
      
      <div class="_adminList">
          <p class="_adminListL">Название</p>
          <p class="_adminListR">Действие</p>
      </div>
      
      
      <!--################ НАЧАЛО  accordion  ###########################-->
      <div class="_adminAccordion" id="accordion">
          
          <h3 class="_adminAccordionTitle">
              <p>Партнеры <span><img src="/templates/images/select.png"</span></p>
              <span class="_adminAccordionSelectAction">
                  <a  href="#" class="_adminAddObjectPartner_"><span ><img src="/templates/images/addDoc.png"></span></a>
              </span>
          </h3>
		  <div class="_adminAccordionContents">';
          foreach($partners AS $partner){
		  $text .='
              <div class="_adminAccordionContent">
                  <p>'.$partner['title'].'</p>
                 <span class="_adminAccordionSelectAction">
                  <a id="'.$partner['id'].'" href="#" class="_adminEditObjectPartner_"><span ><img src="/templates/images/editDoc.png"></span></a>
                  <a id="partners-'.$partner['id'].'"href="#" class="_adminDelObject_"><span ><img src="/templates/images/delDoc.png"></span></a>
              </span>
              </div>
          ';
          }
		  $text.='</div>';
         $text.='<h3 class="_adminAccordionTitle">
              <p>Проекты <span><img src="/templates/images/select.png"></span></p>
              <span class="_adminAccordionSelectAction">
                  <a  href="#" class="_adminAddObjectProject_"><span ><img src="/templates/images/addDoc.png"></span></a>
              </span>
          </h3>
		   <div class="_adminAccordionContents">';
          foreach($projects AS $project){
		  $text .='
              <div class="_adminAccordionContent">
                  <p>'.$project['title'].'</p>
                 <span class="_adminAccordionSelectAction">
                  <a id="'.$project['id'].'" href="#" class="_adminEditObjectProject_"><span ><img src="/templates/images/editDoc.png"></span></a>
                  <a id="projects-'.$project['id'].'"href="#" class="_adminDelObject_"><span ><img src="/templates/images/delDoc.png"></span></a>
              </span>
              </div>
		  ';
		  }
		  $text.='</div>';
	 $text.='
	 </div>
      
	  <!-- УДАЛЕНИЕ ПАРТНЕРА/ПРОЕКТА-->
	     
      <div class="windowDel" id="_windowDel_">
	 <form method="post" enctype="multipart/form-data" action="scripts/phpScripts/delete.php">
	  <input type="hidden" name="IdForDel" id="IdForDel" >
          <div class="windowDelText">
              <p>Вы уверены, что хотите удалить<br>
             выбранный объект ?</p>
          </div>
          <div class="windowButton">
             <input class="delButton" type="submit" value="Удалить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
		  </form>
      </div>
      
      
      
      
      
      <!-- ДОБАВЛЕНИЕ ПАРТНЕРА  -->
      
      <div class="windowEditObject" id="_windowAddObjectPartner_">
          <h3>Добавление партнера</h3>
          <form method="post" enctype="multipart/form-data" action="modules/partners/src/savePartner.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Название</p>
                 <input type="text" name="titlePartner">
              </div>
              
              <div class="windowEditObjectTitle">
                 <p>Ссылка на сайт</p>
                 <input type="text" name="sitePartner">
              </div>
          
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Логотип</p>
                  <div class="windowFileUpload">
                      <div class="file_upload">
                          <button type="button">Обзор...</button>
                          <div class="file_name" id="file_name_add_object"><p>Файл не выбран</p></div>
                
                           <input type="file" name="uploaded_file_add_object" id="uploaded_file_add_object" multiple accept="image/*,image/jpeg">
                  
                      </div>
                      <div class="image_uploaded" id="image_uploaded_add_object"></div>
                   </div>
             
              </div>    
              
          <div class="windowButton">
			<input class="delButton" type="submit" value="Сохранить"/>
			<a href="#" class="cancelButton">Отмена</a>
          </div>
           </form>
         
      </div>
      
      
       <!-- Редактирование информации о партнере -->
      
      <div class="windowEditObject" id="_windowEditObjectPartner_">
          <h3>Редактирование информации о партнере</h3>
          <form method="post" enctype="multipart/form-data" action="../modules/partners/src/savePartner.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Название</p>
                 <input type="text" id="titlePartner" name="titlePartner">
              </div>
              
              <div class="windowEditObjectTitle">
                 <p>Ссылка на сайт</p>
                 <input type="text" id="sitePartner" name="sitePartner">
              </div>
			  <input type="hidden" id="idPartner" name="idPartner">
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Логотип</p>
                  <div class="windowFileUpload">
                      <div class="file_upload">
                          <button type="button">Обзор...</button>
                          <div class="file_name" id="file_name_edit_object"><p>Файл не выбран</p></div>
                
                           <input type="file" name="uploaded_file_edit_object" id="uploaded_file_edit_object" multiple accept="image/*,image/jpeg">
                  
                      </div>
                      <div class="image_uploaded" id="image_uploaded_edit_object"></div>
                   </div>
             
              </div>    
              
          <div class="windowButton">
               <input class="delButton" type="submit" value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
           </form>
         
      </div>
      
      
      
      <!-- ДОБАВЛЕНИЕ ПРОЕКТА -->
      
      <div class="windowEditObject" id="_windowAddObjectProject_">
          <h3>Добавление проекта</h3>
          <form method="post" enctype="multipart/form-data" action="../modules/partners/src/saveProject.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Название</p>
                  <input type="text"  name="titleProject">
              </div>
				
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Описание</p>
                  <input type="text" name="textProject">            
              </div>    
         
          <div class="windowButton">
              <input class="delButton" type="submit" value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
              
           </form>
      </div>
      
       <!-- РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ О ПАРТНЕРЕ -->
      
      <div class="windowEditObject" id="_windowEditObjectProject_">
          <h3>Редактирование информации о проекте</h3>
          <form method="post" enctype="multipart/form-data" action="../modules/partners/src/saveProject.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Название</p>
                  <input type="text" id="titleProject" name="titleProject">
              </div>
				<input type="hidden" id="idProject" name="idProject">
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Описание</p>
                  <input type="text" id="textProject" name="textProject">             
              </div>    
          <div class="windowButton">
              <input class="delButton" type="submit" value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
              
           </form>
         </div>
      ';
	}else{
		$text = '
			<style>
			#select_3 a{
			border-bottom: 7px solid #fd8505;
			}
			</style>
			<div class="pageNavigation">
                 <p><a href="/">Главная</a> -> Партнеры и проекты</p>
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
	
	}
		$module['text'] = $text;
	
?>