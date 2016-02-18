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
        <form method="post" id="formAddTsz" enctype="multipart/form-data" action="modules/registry/src/saveTsz.php">
            <div class="windowEditObjectTitle">
                
				<div class="windowEditObjectTitleBoxOne">
				    <p>Название организации</p>
			    </div>
				
                <div class="windowEditObjectTitleBoxTwo">
				    <input type="text" id="tTsz" name="titleTsz">
				    <span class="error" id="errormsg_titleTsz"></span>
			    </div>
            </div>
			 <!-- <input type="hidden" id="idTsz" name="idTsz">-->
			 
			    <input type="hidden" id="addCoordsTsz" name="addCoordsTsz">
            <div class="windowEditObjectTitle">
			    
				<div class="windowEditObjectTitleBoxOne">
                    <p>Адрес</p>
				</div>
				
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text"  name="addressTsz" id="addressTszAddCoord" >
					<span class="error" id="errormsg_addressTsz"></span>
				</div>
            </div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Телефон</p>
			    </div>
				
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" name="phoneNumberTsz" >
					<span class="error" id="errormsg_phoneNumberTsz"></span>
				</div>
            </div>
			
			<div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Факс</p>
				</div>
				
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" name="faxTsz">
					<span class="error" id="errormsg_faxTsz"></span>
				</div>
            </div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>E-mail</p>
				</div>
				
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" name="e_mailTsz">
					<span class="error" id="errormsg_e_mailTsz"></span>
				</div>
            </div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Фамилия председателя</p>
				</div>
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" name="surnamePresident">
					<span class="error" id="errormsg_surnamePresident"></span>
				</div>
            </div>
			
			<div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Имя председателя</p>
				</div>
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" name="namePresident">
					<span class="error" id="errormsg_namePresident"></span>
				</div>
            </div>
			
			<div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Отчество председателя</p>
				</div>
				
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" name="patronymicPresident">
					<span class="error" id="errormsg_patronymicPresident"></span>
				</div>
            </div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Сайт</p>
				</div>
				
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" name="siteTsz">
					<span class="error" id="errormsg_siteTsz"></span>
				</div>
            </div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Район</p>
		        </div>
                <div class="windowEditObjectTitleBoxTwo">
    			    <select name="area" >
					<option value="0" disabled selected>Выберите из списка</option>';
	                foreach($groups as $Tsz){
			            $text .='<option  value="'.$Tsz['id'].'">'.$Tsz['groupsArea'].'</option>';
			        };
    $text .= '         
                    </select>
					<span class="error" id="errormsg_area"></span>
                </div>
            </div>
            
            <div class="windowEditObjectImg">
                <div class="windowEditObjectTitleBoxOne">
                    <p>Логотип</p>
				</div>
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
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Ответственное лицо</p>
			    </div>	
                 <div class="windowEditObjectTitleBox">
                      <input type="text" placeholder="Логин">
                      <input type="password" placeholder="Пароль">
					  <input type="password" placeholder="Пароль еще раз">
                 </div>
            </div>
        
            <div class="windowButton">
                <input id="saveForm" class="delButton" type="submit"  value="Сохранить"/>
                <a href="#" class="cancelButton">Отмена</a>
            </div>
		</form>
        
    </div>  
      
      
      <!--Редактирование информации об организации-->
      
    <div class="windowEditRegistry" id="_windowEditObject_">
        <h3>Редактирование информации об организации</h3>
		<form method="post" id="formEditTsz" enctype="multipart/form-data" action="../modules/registry/src/saveTsz.php">
             <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Название организации</p>
                </div>
                <div class="windowEditObjectTitleBoxTwo">				
				    <input type="text" id="titleTsz" name="titleTsz">
					<span class="error" id="errormsg_titleTsz"></span>
                </div>
			</div>
			<input type="hidden" id="idTsz" name="idTsz">
			<input type="hidden" id="editCoordsTsz" name="editCoordsTsz">
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Адрес</p>
				</div>
                <div class="windowEditObjectTitleBoxTwo">				
                    <input type="text" id="addressTszEditCoord" name="addressTsz">
					<span class="error" id="errormsg_addressTsz"></span>
                </div>
			</div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
				    <p>Телефон</p>
                </div>
				<div class="windowEditObjectTitleBoxTwo">
				    <input type="text" id="phoneNumberTsz" name="phoneNumberTsz">
					<span class="error" id="errormsg_phoneNumberTsz"></span>
                </div>
			</div>
			
			<div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Факс</p>
                </div>
                <div class="windowEditObjectTitleBoxTwo">				
				    <input type="text" id="faxTsz" name="faxTsz">
                </div>        
			</div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>E-mail</p>
                </div>
                <div class="windowEditObjectTitleBoxTwo">				
				    <input type="text" id="e_mailTsz" name="e_mailTsz">
					<span class="error" id="errormsg_e_mailTsz"></span>
                </div>           
		    </div>
            
			<div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Фамилия председателя</p>
			    </div>
                <div class="windowEditObjectTitleBoxTwo">				
                    <input type="text" id="surnamePresident" name="surnamePresident">
					<span class="error" id="errormsg_surnamePresident"></span>
                </div>
			</div>
			 
			<div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Имя председателя</p>
                </div>
                <div class="windowEditObjectTitleBoxTwo">				
				    <input type="text" id="namePresident" name="namePresident">
					<span class="error" id="errormsg_namePresident"></span>
                </div>          
		    </div>
		  
			<div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Отчество председателя</p>
			    </div>
				<div class="windowEditObjectTitleBoxTwo">
                    <input type="text" id="patronymicPresident" name="patronymicPresident">
					<span class="error" id="errormsg_patronymicPresident"></span>
                </div>
			</div>
			
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Сайт</p>
			    </div>
                <div class="windowEditObjectTitleBoxTwo">				
                    <input type="text" id="siteTsz" name="siteTsz">
			    </div>
            </div>
            <div class="windowEditObjectTitle">
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Район</p>
				</div>
                <div class="windowEditObjectTitleBoxTwo">				
                    <select name="area">';
	                foreach($groups as $Tsz){
			            $text .='<option id="area-'.$Tsz['id'].'"  value="'.$Tsz['id'].'">'.$Tsz['groupsArea'].'</option>';
			        };
    $text .= '         
                    </select>
					<span class="error" id="errormsg_area"></span>
                </div>
            </div>
            
            <div class="windowEditObjectImg">
                <div class="windowEditObjectTitleBoxOne">
                    <p>Логотип</p>
				</div>
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
			    <div class="windowEditObjectTitleBoxOne">
                    <p>Ответственное лицо</p>
			    </div>	
                <div class="windowEditObjectTitleBox">      
                      <input type="text" placeholder="Логин">
                      <input type="password" placeholder="Пароль">
					  <input type="password" placeholder="Пароль еще раз">
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