<?php
	if($_SESSION['admin']){
		$text = '
		<style>
	#select_3 a{
		border-bottom: 7px solid #fd8505;
	}
	</style><div class="_adminHeader">
          <span class="_adminHeaderL"><p>Партнеры и проекты</p></span>
      </div>
      
      <div class="_adminList">
          <p class="_adminListL">Название</p>
          <p class="_adminListR">Действие</p>
      </div>
    
      <div class="_adminAccordion" id="accordion">
          
          <h3 class="_adminAccordionTitle">
              <p>Партнеры <span><img src="/templates/images/select.png"</span></p>
              <span class="_adminAccordionSelectAction">
                <span class="_adminAddObjectPartner_"><img src="/templates/images/addDoc.png"></span>
              </span>
          </h3>
		  <div class="_adminAccordionContents">';
          foreach($partners AS $partner){
		  $text .='
              <div class="_adminAccordionContent">
                  <p>'.$partner['title'].'</p>
                 <span class="_adminAccordionSelectAction">
                     <span id="'.$partner['id'].'"  class="_adminEditObjectPartner_"><img src="/templates/images/editDoc.png"></span>
                     <span id="partners-'.$partner['id'].'" class="_adminDelObject_"><img src="/templates/images/delDoc.png"></span>
                 </span>
              </div>
          ';
          }
		  $text.='</div>';
         $text.='<h3 class="_adminAccordionTitle">
              <p>Проекты <span><img src="/templates/images/select.png"></span></p>
              <span class="_adminAccordionSelectAction">
                 <span class="_adminAddObjectProject_"><img src="/templates/images/addDoc.png"></span>
              </span>
          </h3>
		   <div class="_adminAccordionContents">';
          foreach($projects AS $project){
		  $text .='
              <div class="_adminAccordionContent">
                  <p>'.$project['title'].'</p>
                  <span class="_adminAccordionSelectAction">
                      <span id="'.$project['id'].'" class="_adminEditObjectProject_"><img src="/templates/images/editDoc.png"></span>
                      <span id="projects-'.$project['id'].'" class="_adminDelObject_"><img src="/templates/images/delDoc.png"></span>
              </span>
              </div>';
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
          <form method="post" id="formAddPartner" enctype="multipart/form-data" action="modules/partners/src/savePartner.php">
		 
              <div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Название</p>
				  </div>
				  <div class="windowEditObjectTitleBoxTwo">
                      <input type="text" name="titlePartner">
					  <span class="error" id="errormsg_titlePartner"></span>
                  </div>
              </div>
              
              <div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Ссылка на сайт</p>
				  </div>
				   <div class="windowEditObjectTitleBoxTwo">
                      <input type="text" name="sitePartner">
					  <span class="error" id="errormsg_sitePartner"></span>

				</div>
              </div>
          
              <div class="windowEditObjectImg">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Логотип</p>
				 </div>
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
          <form method="post" id="formEditPartner" enctype="multipart/form-data" action="../modules/partners/src/savePartner.php">
		 
              <div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Название</p>
				  </div>
				  <div class="windowEditObjectTitleBoxTwo">
                      <input type="text" id="titlePartner" name="titleEditPartner">
                      <span class="error" id="errormsg_titleEditPartner"></span>
                  </div>
			  </div>
              
              <div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Ссылка на сайт</p>
				  </div>
				  <div class="windowEditObjectTitleBoxTwo">
                      <input type="text" id="sitePartner" name="sitePartner">
                      <span class="error" id="errormsg_sitePartner"></span>
                  </div>
			  </div>
			  <input type="hidden" id="idPartner" name="idPartner">
              <div class="windowEditObjectImg">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Логотип</p>
				  </div>
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
          <form method="post" id="formAddProject" enctype="multipart/form-data" action="../modules/partners/src/saveProject.php">
		 
              <div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Название</p>
				  </div>
				  <div class="windowEditObjectTitleBoxTwo">
                      <input type="text"  name="titleProject">
				      <span class="error" id="errormsg_titleProject"></span>
                  </div>
              </div>
				
              <!--<div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Описание</p>
				  </div>
				  <div class="windowEditObjectTitleBoxTwo">
                     <textarea  name="textProject"> </textarea>   
					 <span class="error" id="errormsg_textProject"></span>
                  </div>
              </div>-->

              <div class="windowEditObjectImg">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Изображение</p>
				 </div>
                  <div class="windowFileUpload">
                      <div class="file_upload">
                          <button type="button">Обзор...</button>
                          <div class="file_name" id="file_name_add_object_group"><p>Файл не выбран</p></div>
                
                           <input type="file" name="uploaded_file_add_object_group" id="uploaded_file_add_object_group" multiple accept="image/*,image/jpeg">
                  
                      </div>
                      <div class="image_uploaded" id="image_uploaded_add_object_group"></div>
                   </div>
              </div>    		  
         
          <div class="windowButton">
              <input class="delButton" type="submit" value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
              
           </form>
      </div>
      
       <!-- РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ О ПРОЕКТЕ -->
      
      <div class="windowEditObject" id="_windowEditObjectProject_">
          <h3>Редактирование информации о проекте</h3>
          <form method="post" id="formEditProject" enctype="multipart/form-data" action="../modules/partners/src/saveProject.php">
		 
              <div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                     <p>Название</p>
				  </div>
				  <div class="windowEditObjectTitleBoxTwo">
                      <input type="text" id="titleEditProject" name="titleEditProject">
                      <span class="error" id="errormsg_titleEditProject"></span>
                  </div>
			 </div>
				<input type="hidden" id="idProject" name="idProject">
             <!-- <div class="windowEditObjectTitle">
			      <div class="windowEditObjectTitleBoxOne">
                      <p class="windowEditObjectP">Описание</p>
                  </div>
				  <div class="windowEditObjectTitleBoxTwo">
				       <textarea id="textProject" name="textProject"> </textarea>            
                       <span class="error" id="errormsg_textProject"></span>
                  </div>
			  </div> -->
             <div class="windowEditObjectImg">
			      <div class="windowEditObjectTitleBoxOne">
                      <p>Изображение</p>
				 </div>
                  <div class="windowFileUpload">
                      <div class="file_upload">
                          <button type="button">Обзор...</button>
                          <div class="file_name" id="file_name_edit_object_group"><p>Файл не выбран</p></div>
                
                           <input type="file" name="uploaded_file_edit_object_group" id="uploaded_file_edit_object_group" multiple accept="image/*,image/jpeg">
                  
                      </div>
                      <div class="image_uploaded" id="image_uploaded_edit_object_group"></div>
                   </div>
              </div>              


		   
          <div class="windowButton">
              <input class="delButton" type="submit" value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
              
           </form>
         </div>
      ';
	  $text.= '
		<script>
		    $(".feedbackContent").append("<a href=modules/auth/admin.php?do=logout class=adminExit>Выход</a>");	
		    </script>';		
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
				 
		        foreach ($partners as $partner) {
			        $text .= '<div class="ourPartnersContent">
					  
                      <div class="namePartners"> 
                          <a href="'.$partner['site'].'" target="_blank"><img src="/files'.$partner['image'].'"></a>
                      </div>
					  <div class="contentPartners">
					      <p><a href="'.$partner['site'].'" target="_blank">'.$partner['title'].'</a></p>
					  </div>
   
                  </div>';
		        }	
		        $text .=' </div>
		
              <div class="ourPartners">
                 <h2>Совместные проекты</h3>';
				 
		        foreach ($projects as $project) {
			        $text .= '
					<div class="ourPartnersContent">
					
					<div class="namePartners"> 
					    <img src="/files'.$project['image'].'">
					</div>
					<div class="contentPartners">
					    <p><a href="'.$project['site'].'" target="_blank">'.$project['title'].'</a></p>
					</div>   
                 </div>';	
		        }
		        $text .=' </div>';
	
	}
		$module['text'] = $text;
	
?>