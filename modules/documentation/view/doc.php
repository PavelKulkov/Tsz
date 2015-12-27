<?php
    function get_mas($list, $index){
		$i =0;
		foreach ($list as $entry) {
			if($entry['document_type'] == $index){
				//$mas[$i] = '<p class="documentText"><a href="#" download>'.$entry['title'].'</a>'; 
				$mas[$i] = "<p><a href=files/Docs/".$entry['name']." download>".$entry['title']."</a></p>";
				$i++;
			}
		}
		return $mas;
    }
	function outputMas($mas){
		$text = "";
		for($j = 0; $j < count($mas); $j++){
		$text .= $mas[$j];
	}
		return $text;
	}
	$mas_1 = get_mas($docs, 1);  
	$mas_2 = get_mas($docs, 2);
	$mas_3 = get_mas($docs, 3); 
    $mas_4 = get_mas($docs, 4);  
	
	session_start();
	
	if($_SESSION['admin']){
		$text = '
  <div class="content">
      <div class="_adminHeader">
          <span class="_adminHeaderL"><p>Документы</p></span>
          <span class="_adminHeaderR">
              <a href="#" class="_adminAddObjectGroup_">Добавить группу</a>
          </span>
      </div>
      
      <div class="_adminList">
          <p class="_adminListL">Название</p>
          <p class="_adminListR">Действие</p>
      </div>
      
      
      <!--################ НАЧАЛО  accordion  ###########################-->
	  <div class="_adminAccordion" id="accordion">';
              for($i=0;$i<count($groups);$i++){
          
          
				$text .='
					<h3 class="_adminAccordionTitle">
						<p>'.$groups[$i]['groupOfDoc'].'<span><img src="/templates/images/select.png"></span></p>
						<span class="_adminAccordionSelectAction">
							<a id="'.$groups[$i]['id'].'" href="#" class="_adminAddObject_"><span><img src="/templates/images/addDoc.png"></span></a>
							<a id="'.$groups[$i]['id'].'" href="#" class="_adminEditObjectGroup_"><span ><img src="/templates/images/editDocGroup.png"></span></a>
							<a id="Group'.$groups[$i]['id'].'" href="#" class="_adminDelObject_"><span ><img src="/templates/images/delDocGroup.png"></span></a>
						</span>
					</h3>
					<div class="_adminAccordionContents">';
				for($j=0;$j<count($docs);$j++){
					if(strcasecmp($groups[$i]['groupOfDoc'],$docs[$j]['groupOfDoc'])==0){
					$text.=' 
							<div class="_adminAccordionContent">	
								<p>'.$docs[$j]['title'].'</p>
								<span class="_adminAccordionSelectAction">
									<a id="'.$docs[$j]['idDoc'].'" href="#" class="_adminEditObject_"><span ><img src="/templates/images/editDoc.png"></span></a>
									<a id="Doc'.$docs[$j]['idDoc'].'" href="#" class="_adminDelObject_"><span ><img src="/templates/images/delDoc.png"></span></a>
								</span>
							</div> 
					 ';}
				}
					$text.= '</div>';
			  }	 	
              
          $text.='</div>
         
          
      
      
       <!-- УДАЛЕНИЕ ДОКУМЕНТА/ГРУППЫ-->
      
      <div class="windowDel" id="_windowDel_">
          <form method="post" enctype="multipart/form-data" action="modules/documentation/src/delGroupOrDoc.php">
		  <input type="hidden" name="IdGroupForDel" id="IdGroupForDel" >
		  <input type="hidden" name="IdDocForDel" id="IdDocForDel" >
		  <div class="windowDelText">
              <p>Вы уверены, что хотите удалить<br>
             выбранный документ (группу) ?</p>
          </div>
          <div class="windowButton">
			  <input class="delButton" type="submit" value="Удалить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
		  </form>
      </div>
      
    
       <!-- РЕДАКТИРОВАНИЕ ДОКУМЕНТА-->
      
    <div class="windowEditObject" id="_windowEditObject_">
          <h3>Редактирование документа</h3>
          <form method="post" enctype="multipart/form-data" action="../modules/documentation/src/saveDoc.php">
		 
              <div class="windowEditObjectTitle">
                  <p>Название документа</p>
                  <input type="text" id="titleDoc" name="titleDoc" >
              </div>
			  <input type="hidden" id="idDoc" name="idDoc">
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Файл с документом</p>
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
      
      
      <!-- РЕДАКТИРОВАНИЕ ГРУППЫ  -->
     <div class="windowEditObject" id="_windowEditObjectGroup_">
          <h3>Редактирование группы</h3>
          <form method="post" enctype="multipart/form-data" action="modules/documentation/src/saveGroup.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Название группы</p>
                  <input type="text" id="titleGroup" name="titleGroup">
              </div>
				  <input type="hidden" name="idGroup" id="idGroup">
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Изображение</p>
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


    
      
      <!-- ДОБАВЛЕНИЕ ДОКУМЕНТА  -->
      
      <div class="windowEditObject" id="_windowAddObject_">
          <h3>Добавление документа</h3>
          <form method="post" enctype="multipart/form-data" action="modules/documentation/src/saveDoc.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Название документа</p>
                  <input type="text" name="title"/>
              </div>
			  <input type="hidden" name="idGroup" id="idGroupForAdd" value="">
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Файл с документом</p>
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
      
      <!-- ДОБАВЛЕНИЕ ГРУППЫ  -->
      
    <div class="windowEditObject" id="_windowAddObjectGroup_">
          <h3>Добавление группы</h3>
          <form method="post" enctype="multipart/form-data" action="modules/documentation/src/saveGroup.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Название группы</p>
                   <input type="text" name="title"/>
              </div>
          
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Изображение</p>
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
				<input class="delButton" type="submit" value="Добавить"/>
				<a href="/documentation" class="cancelButton">Отмена</a>
			  </div>
              
           </form>
         
      </div>


      
   
  </div>
  <footer>
    <div class="footer">
      <p>
        (c) 2015 "Ассоциация ТСЖ" Все права защищены.<br>
        Россия, г.Пенза, ул.Центральная 1В<br>
        т.: 8 (8412) 23 11 25; e-mail: tczh@yandex.ru
      </p>
    </div>

  </footer>
    
    ';
		$text.= '<a href="modules/auth/admin.php?do=logout">Выход</a>';		
		echo $text;
		exit;
	}
	$text	='<style>
	#select_2 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<div class="pageNavigation">
              <p><a href="/">Главная</a> -> Документы</p>
          </div>
          <div class="pageTitle">
              <h1>Документы Ассоциации ТСЖ г.Пензы</h1>  
          </div>
          <div class="ContentDoc">
              <div class="leftContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_1.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Законы Российской федерации</h1>
                  </div>
                  <div class="textDoc">';
                $text .= outputMas($mas_1);                  
                $text .= ' </div>
              </div>
              
               <div class="rightContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_2.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Законодательные документы Пензенской области</h1>
                  </div>
                  <div class="textDoc">';
                      $text .= outputMas($mas_2);                     
                $text .=  '</div>
              </div>
          </div>
          <div class="ContentDoc">
              <div class="leftContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_3.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Местные нормативные документы г.Пензы</h1>
                  </div>
                  <div class="textDoc">';
                  $text .= outputMas($mas_3);              
         	
                 $text .=' </div>
              </div>
              
               <div class="rightContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_4.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Прочие документы</h1>
                  </div>
                  <div class="textDoc">';
                        $text .= outputMas($mas_4);  
                 $text .= ' </div>
              </div>
          </div>';
	
		echo($text);
?>
							
			
							
	
				