<?php

	session_start();
	
	if($_SESSION['admin']){
		$text = '
		
		<style>
	#select_1 a{
		border-bottom: 7px solid #fd8505;
	}
	
	
	</style>
		 <div class="_adminHeader">
          <span class="_adminHeaderL"><p>Список членов Ассоциации</p></span>
          <span class="_adminHeaderR">
              <a href="#">Карта</a>
              <a href="#" class="_adminAddObjectGroup_">Добавить организацию</a>
          </span>
      </div>
      
      <div class="_adminList">
          <p class="_adminListL">Название</p>
          <p class="_adminListC">Адрес</p>
          <p class="_adminListR">Действие</p>
      </div>
      
      <div class="_adminAccordion" id="accordion">';
	  
	      for($i=0;$i<count($groups);$i++){
			  $text .= '
			  <h3 class="_adminAccordionTitle">
                  <p>'.$groups[$i]['groupsArea'].'<span><img src="templates/images/select.png"></span></p>
              </h3>
			  <div class="_adminAccordionContents">';
			  
			  for($j=0;$j<count($registry);$j++){
				  if(strcasecmp($groups[$i]['groupsArea'],$registry[$j]['groupsArea'])==0){
				      $text .= '
					     <div class="_adminAccordionContent">
                             <p class="_adminAccordionName"> ТСЖ '.$registry[$j]['title'].'</p>
                             <p class="_adminAccordionAddress">'.$registry[$j]['address'].'</p>
                             <span class="_adminAccordionSelectAction">
                                 <a id="'.$registry[$j]['id'].'" href="#" class="_adminEditObjectRegistry_"><span ><img src="templates/images/EditDoc.png"></span></a>
                                 <a href="#" class="_adminBlockObject_"><span ><img src="templates/images/block.png"></span></a>
                                 <a id="registry-'.$registry[$j]['id'].'" href="#" class="_adminDelObject_"><span ><img src="templates/images/delDoc.png"></span></a>
                             </span>
                         </div>';
				  }
			  }
			  $text.= '</div>';
		  }
		  $text.='</div>';
          
      
          $text .='
      
       <!-- УДАЛЕНИЕ ОРГАНИЗАЦИИ-->
     
      <div class="windowDel" id="_windowDel_">
	   <form method="post" enctype="multipart/form-data" action="modules/registry/src/delete.php">
          <input type="hidden" name="IdForDel" id="IdForDel" >	
		  <div class="windowDelText">
              <p>Вы уверены, что хотите удалить<br>
             выбранную организацию?</p>
          </div>
          <div class="windowButton">
		      <input class="delButton" type="submit" value="Удалить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
		  </form>
      </div>
      
       <!-- БЛОКИРОВКА ОРГАНИЗАЦИИ-->
      
   <!--  <div class="windowDelr" id="_windowBlock_">
          <div class="windowDelText">
              <p>Заблокировать выбранную организацию?</p>
          </div>
          <div class="windowButton">
              <a href="#" class="delButton">Заблокировать</a>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
      </div>-->
      
    
       <!-- Добавление организации-->
      
    <div class="windowEditRegistry" id="_windowAddObjectGroup_">
        <h3>Добавление органицации</h3>
        <form method="post" enctype="multipart/form-data" action="modules/registry/src/saveTsz.php">
             <div class="windowEditObjectTitle">
                 <p>Название организации</p>
                  <input type="text"  name="titleTsz">
             </div>
			 <!-- <input type="hidden" id="idTsz" name="idTsz">-->
			 <input type="hidden" id="addCoordsTsz" name="addCoordsTsz">
            <div class="windowEditObjectTitle">
                 <p>Адрес</p>
                  <input type="text"  name="addressTsz" id="addressTszAddCoord" >
            </div>
            <div class="windowEditObjectTitle">
                 <p>Телефон</p>
                  <input type="text" name="phoneNumberTsz">
            </div>
			<div class="windowEditObjectTitle">
                 <p>Факс</p>
                  <input type="text" name="faxTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>E-mail</p>
                  <input type="text" name="e_mailTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>Председатель</p>
                  <input type="text" name="presidentTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>Сайт</p>
                  <input type="text" name="siteTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>Район</p>
                <div class="windowEditObjectTitleBox">
                    
                     <input type="radio" name="area" value="1">
                     <label>Первомайский</label>
                
                     <input type="radio" name="area" value="2">
                    <label>Ленинский</label>
                
                     <input type="radio" name="area" value="3">
                    <label>Октябрьский</label>
                
                     <input type="radio" name="area" value="4">
                    <label>Железнодорожный</label>
                </div>
            </div>
            
            <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Логотип</p>
                  <div class="windowFileUpload">
                      <div class="file_upload">
                          <button type="button">Загрузить...</button>
                          <div class="file_name" id="file_name_edit_object"><p>Файл не выбран</p></div>
                
                           <input type="file" name="uploaded_file_edit_object" id="uploaded_file_edit_object" multiple accept="image/*,image/jpeg">
                  
                      </div>
                      <div class="image_uploaded" id="image_uploaded_edit_object"></div>
                   </div>
             
              </div>  
            
             <div class="windowEditObjectTitle">
                 <p>Ответственное лицо</p>
                 <div class="windowEditObjectTitleBox">
                      <label>Логотип</label>
                      <input type="text">
                     
                     <label>Пароль</label>
                      <input type="text">
                 </div>
                 
            </div>
        
        <div class="windowButton">
		
              <input class="delButton" type="submit"  value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
        </div>
		</form>
        
    </div>  
      
      
      <!--Редактирование информации об организации-->
      
    <div class="windowEditRegistry" id="_windowEditObject_">
        <h3>Редактирование информации об организации</h3>
		<form method="post" enctype="multipart/form-data" action="../modules/registry/src/saveTsz.php">
             <div class="windowEditObjectTitle">
                 <p>Название организации</p>
                  <input type="text" id="titleTsz" name="titleTsz">
             </div>
			 
			 <input type="hidden" id="idTsz" name="idTsz">
			 <input type="hidden" id="editCoordsTsz" name="editCoordsTsz">
            <div class="windowEditObjectTitle">
                 <p>Адрес</p>
                  <input type="text" id="addressTszEditCoord" name="addressTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>Телефон</p>
                  <input type="text" id="phoneNumberTsz" name="phoneNumberTsz">
            </div>
			<div class="windowEditObjectTitle">
                 <p>Факс</p>
                  <input type="text" id="faxTsz" name="faxTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>E-mail</p>
                  <input type="text" id="e_mailTsz" name="e_mailTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>Председатель</p>
                  <input type="text" id="presidentTsz" name="presidentTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>Сайт</p>
                  <input type="text" id="siteTsz" name="siteTsz">
            </div>
            <div class="windowEditObjectTitle">
                 <p>Район</p>
                <div class="windowEditObjectTitleBox">
                    
                     <input type="radio" name="area" id="area-1" value="1">
                     <label>Первомайский</label>
                
                     <input type="radio" name="area" id="area-2" value="2">
                    <label>Ленинский</label>
                
                     <input type="radio" name="area" id="area-3" value="3">
                    <label>Октябрьский</label>
                
                     <input type="radio" name="area" id="area-4" value="4">
                    <label>Железнодорожный</label>
                </div>
            </div>
            
            <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Логотип</p>
                  <div class="windowFileUpload">
                      <div class="file_upload">
                          <button type="button">Загрузить...</button>
                          <div class="file_name" id="file_name_edit_object_group"><p>Файл не выбран</p></div>
                
                           <input type="file" name="uploaded_file_edit_object_group" id="uploaded_file_edit_object_group" multiple accept="image/*,image/jpeg">
                  
                      </div>
                      <div class="image_uploaded" id="image_uploaded_edit_object_group"></div>
                   </div>
             
              </div>  
            
             <div class="windowEditObjectTitle">
                 <p>Ответственное лицо</p>
                 <div class="windowEditObjectTitleBox">
                      <label>Логотип</label>
                      <input type="text">
                     
                     <label>Пароль</label>
                      <input type="text">
                 </div>
                 
            </div>
        
        <div class="windowButton">
              <input class="delButton" type="submit" value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
		  </form>
        
    </div>';
		$text.= '
		<script>
		    $(".feedbackContent").append("<a href=modules/auth/admin.php?do=logout class=adminExit>Выход</a>");	
		    </script>';		
	}
	
	
	else{
	$text = '
	
	<style>
	#select_1 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<div class="pageNavigation">
               <p><a href="/">Главная</a> -> Список членов ассоциации</p>
             </div>
			 <div class="pageTitle">
                 <h1>Список членов Ассоциации</h1>
             </div>
			 
			 <div class="listAssociation">
               <form class="searchForm">
					<input type="text" placeholder="Введите название вашего ТСЖ" class="nameTsz"  autocomplete="off">
					<select class="listTsz">';
					
	                foreach($registry as $Tsz){
		                $text .='<option  id="'.$Tsz['id'].'">'.$Tsz['title'].'</option>';
	                };
						
    $text .= '      </select>
				</form> 
			</div>
			 <div id="map" class="map" >
             </div>';	  
		  	
    $text .= ' <div class="listAreasContent">';

				 for($i=0;$i<count($groups);$i++){
					 
					 if($i == 0 || $i%2 == 0){
						 $text .= '<div class="listAreasMain">'; 
					 }
					 
					 
					 $text .= '<div class="listAreas">
                                  <div class="AreasName">
                                     <h3>'.$groups[$i]['groupsArea'].'</h3>
                                  </div>
			                    <div class="listAreasMainContent">';
					for($j=0;$j<count($registry);$j++){
				        if(strcasecmp($groups[$i]['groupsArea'],$registry[$j]['groupsArea'])==0){
							//$text .='<p id='.$registry[$j]['id'].'>ddddd</p>';
							$text .= "<p id = ".$registry[$j]['id'].">ТСЖ ".$registry[$j]['title']." , ".$registry[$j]['address']."</p>";  
				        }
					}
					$text .= '</div>
					</div>';
					if($i%2 != 0 && $i != 0){
						$text .= '</div>'; 
					 }
				 }
				 $text .= '</div>';

	$text .= ' 
			   <div class="modalWindow">
                   <div class="closeModalWindow">
                       <div class="closeModalWindowImg"></div>
                   </div>
                   <div class="headerModalWindow">
                   </div>
                   <div class="contentModalWindow">
                       <div class="logoModalWindow">
                       </div>
                       <div class="textModalWindow">
           
                       </div>
                   </div>
                </div>';
				}
?>			