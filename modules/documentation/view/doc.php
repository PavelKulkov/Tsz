<?php
	session_start();
	
	if($_SESSION['admin']){
		$text = '
        <style>
	        #select_2 a{
		        border-bottom: 7px solid #fd8505;
	        }
	    </style>
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
     
	    <div class="_adminAccordion" id="accordion">';
            for($i=0;$i<count($groups);$i++){
				$text .='
			<h3 class="_adminAccordionTitle">
			    <p>'.$groups[$i]['groupOfDoc'].' <span><img src="/templates/images/select.png"></span></p>
			    <span class="_adminAccordionSelectAction">
				    <span id="'.$groups[$i]['id'].'" class="_adminAddObject_"><img src="/templates/images/addDoc.png"></span>
				    <span id="'.$groups[$i]['id'].'" class="_adminEditObjectGroup_" ><img src="/templates/images/editDocGroup.png"></span>
				    <span  id="groups of documents-'.$groups[$i]['id'].'" class="_adminDelObject_"><img src="/templates/images/delDocGroup.png"></span>
			    </span>
			</h3>
			<div class="_adminAccordionContents">';
				for($j=0;$j<count($docs);$j++){
					if(strcasecmp($groups[$i]['groupOfDoc'],$docs[$j]['groupOfDoc'])==0){
					    $text.=' 
				<div class="_adminAccordionContent">	
					<p>'.$docs[$j]['title'].'</p>
					<span class="_adminAccordionSelectAction">
						<span id="'.$docs[$j]['idDoc'].'" class="_adminEditObject_" ><img src="/templates/images/editDoc.png"></span>
						<span id="documentation-'.$docs[$j]['idDoc'].'" class="_adminDelObject_" ><img src="/templates/images/delDoc.png"></span>
					</span>
				</div>';
					}
				}
			    $text.= '</div>';
			}	 	
            $text.='
		</div>
         
        <!-- УДАЛЕНИЕ ДОКУМЕНТА/ГРУППЫ-->
        <div class="windowDel" id="_windowDel_">
            <form method="post" enctype="multipart/form-data" action="scripts/phpScripts/delete.php">
		        <input type="hidden" name="IdForDel" id="IdForDel" >		  
		        <div class="windowDelText">
                    <p>Вы уверены, что хотите удалить<br> выбранный документ (группу) ?</p>
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
            <form method="post" id="formEditDoc" enctype="multipart/form-data" action="../modules/documentation/src/saveDoc.php">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Название документа</p>
				    </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <textarea type="text" id="titleDoc" name="titleDoc" ></textarea>
                       <span class="error" id="errormsg_titleDoc"></span>
			        </div>
			    </div>
			    <input type="hidden" id="idDoc" name="idDoc">
                <div class="windowEditObjectImg">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Файл с документом</p>
				    </div>
                    <div class="windowFileUpload">
                        <div class="file_upload">
                            <button type="button">Обзор...</button>
                            <div class="file_name" id="file_name_edit_object">
							    <p>Файл не выбран</p>
							</div>
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
            <form method="post" id="formEditGroupDoc" enctype="multipart/form-data" action="modules/documentation/src/saveGroup.php">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                       <p>Название группы</p>
			        </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <textarea type="text" id="titleGroup" name="titleGroup"></textarea>
                        <span class="error" id="errormsg_titleGroup"></span>
				    </div> 
			    </div>
				<input type="hidden" name="idGroup" id="idGroup">
                <div class="windowEditObjectImg">
			        <div class="windowEditObjectTitleBoxOne">
                        <p >Изображение</p>
			        </div>
                    <div class="windowFileUpload">
                        <div class="file_upload">
                            <button type="button">Обзор...</button>
                            <div class="file_name" id="file_name_edit_object_group">
							    <p>Файл не выбран</p>
						    </div>
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
            <form method="post" id="formAddDoc" enctype="multipart/form-data" action="modules/documentation/src/saveDoc.php">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">  
                        <p>Название документа</p>
				    </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <textarea type="text" name="titleAddDoc"/></textarea>
                        <span class="error" id="errormsg_titleAddDoc"></span>
				    </div>
			    </div>
			    <input type="hidden" name="idGroup" id="idGroupForAdd" value="">
                <div class="windowEditObjectImg">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Файл с документом</p>
			        </div>
                    <div class="windowFileUpload">
                        <div class="file_upload">
                            <button type="button">Обзор...</button>
                            <div class="file_name" id="file_name_add_object">
							    <p>Файл не выбран</p>
							</div>
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
            <form method="post" id="formAddGroupDoc" enctype="multipart/form-data" action="modules/documentation/src/saveGroup.php">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Название группы</p>
				    </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <textarea type="text" name="titleAddGroup"></textarea>
					    <span class="error" id="errormsg_titleAddGroup"></span>
			        </div>
                </div>
                <div class="windowEditObjectImg">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Изображение</p>
				    </div>
                    <div class="windowFileUpload">
                        <div class="file_upload">
                            <button type="button">Обзор...</button>
                            <div class="file_name" id="file_name_add_object_group">
							    <p>Файл не выбран</p>
							</div>
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
        </div>';
		$text.= '
		<script>
		    $(".feedbackContent").append("<a href=modules/auth/admin.php?do=logout class=adminExit>Выход</a>");	
		</script>';		
		echo $text;
	}
	else{
	    $text	='
		<style>
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
        <div class="ContentDoc">';
		
		for($i=0;$i<count($groups);$i++){
			$flag = false;
		    for($j=0;$j<count($docs);$j++){
				//Проверяем если группа содержит хотя бы одну запись
				if(strcasecmp($groups[$i]['groupOfDoc'],$docs[$j]['groupOfDoc'])==0){
				    $flag = true;
					break;
				}
			}
			//Если записи с данным районом есть
			if($flag){
			    if($i == 0 || $i%2 == 0){
			        $text .= '
				    <div class="mainContentDocS">'; 
			    }  
		        $text .= '
			    <div class="mainContentDoc">
			        <div class="logoDoc">
				        <img src="/files/'.$groups[$i]['image'].'">
				    </div>
				    <div class="headerDoc">
					    <h1>'.$groups[$i]['groupOfDoc'].'</h1>
				    </div>';
			        for($j=0;$j<count($docs);$j++){
					    if(strcasecmp($groups[$i]['groupOfDoc'],$docs[$j]['groupOfDoc'])==0){
						    $text .= '
						    <div class="textDoc">
							    <p><a href="files'.$docs[$j]['path'].'"download >'.$docs[$j]['title'].'</a></p>
						    </div>';
					    }
				    }
				    $text .= '
			    </div>';
				    if($i%2 != 0 && $i != 0){
				        $text .= '
		                </div>'; 
				    }
			}
		}
        $text .='
		</div>';
		echo($text);
	}
?>
