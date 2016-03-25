<?php
    if($_SESSION['admin']){
	    $text = '
	    <style>
	        #select_4 a{
		        border-bottom: 7px solid #fd8505;
	        }
	    </style>
	    <div class="_adminHeader">
            <span class="_adminHeaderL"><p>Вопрос-ответ</p></span>
		    <span class="_adminHeaderR">
                <a href="#" class="_adminAddGroupQuestions_">Добавить группу</a>
            </span>
        </div>
      
        <div class="_adminList">
            <p class="_adminListL">Группа</p>
            <p class="_adminListR">Действие</p>
        </div>

        <div class="_adminAccordion" id="accordion">
            ';
		    for($i=0;$i<count($groups);$i++){
				$text .='
				<h3 class="_adminAccordionTitle">
                    <p>'.$groups[$i]['groupsQuestion'].' <span><img src="templates/images/select.png"></span></p>
                    <span class="_adminAccordionSelectAction">
					   <span id="'.$groups[$i]['id'].'"  class="_adminAddObject_"><img src="templates/images/addDoc.png"></span>
				       <span id="'.$groups[$i]['id'].'" class="_adminEditGroup_"><img src="/templates/images/editDocGroup.png"></span>
				       <span id="groups_questions-'.$groups[$i]['id'].'" class="_adminDelObject_"><img src="/templates/images/delDocGroup.png"></span>
			        </span>
                </h3>
                <div class="_adminAccordionContents">';

			    for($j=0;$j<count($questions);$j++){
				    if(strcasecmp($groups[$i]['groupsQuestion'],$questions[$j]['groupsQuestion'])==0){
				        $text .='
			            <div class="_adminAccordionContent">
                            <p>'.$questions[$j]['title'].'</p>
                            <span class="_adminAccordionSelectAction">
                                <span id="'.$questions[$j]['id'].'" class="_adminEditObjectQuestions_"><img src="templates/images/editDoc.png"></span>
                                <span id="questions-'.$questions[$j]['id'].'" class="_adminDelObject_"><img src="templates/images/delDoc.png"></span>
                            </span>
                        </div>';
				    }
			    }
				$text .='			  
                </div>';
		    }
			$text .='			  
        </div>';
              /*foreach($list as $question){
			  $text .='
			  <div class="_adminAccordionContent">
                  <p>'.$question['title'].'</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" id="'.$question['id'].'" class="_adminEditObjectQuestions_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" id="questions-'.$question['id'].'" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div>';
			  }*/
        $text .='			  
        <!-- УДАЛЕНИЕ ВОПРОСА-->
        <div class="windowDel" id="_windowDel_">
            <form method="post" enctype="multipart/form-data" action="scripts/phpScripts/delete.php">
		        <input type="hidden" name="IdForDel" id="IdForDel" >
		        <div class="windowDelText">
                    <p>Вы уверены, что хотите удалить<br> выбранный вопрос ?</p>
                </div>
                <div class="windowButton">
                    <input class="delButton" type="submit" value="Удалить"/>
                    <a href="#" class="cancelButton">Отмена</a>
                </div>
		    </form> 
        </div>
      
        <!-- ДОБАВЛЕНИЕ ВОПРОСА -->
        <div class="windowEditObject" id="_windowAddObject_">
            <h3>Добавление вопроса</h3>
            <form method="post" id="formAddQuestion" enctype="multipart/form-data" action="modules/questions/src/saveQuestion.php">		 
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Вопрос</p>
				    </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <input type="text" name="titleQuestion">
					    <span class="error" id="errormsg_titleQuestion"></span>
                    </div>
                </div>
				<input type="hidden" name="idGroup" id="idGroupForAdd" value="">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Ответ</p>
				    </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <textarea name="answer"></textarea>
					    <span class="error" id="errormsg_answer"></span>
                    </div>
                </div>    
			    <div class="windowButton">
				    <input class="delButton" type="submit" value="Сохранить"/>
                    <a href="#" class="cancelButton">Отмена</a>
			    </div>
           </form>
        </div>
    
        <!-- РЕДАКТИРОВАНИЕ ВОПРОСА-->
        <div class="windowEditObject" id="_windowEditObjectQuestions_">
            <h3>Редактирование вопроса</h3>
            <form method="post" id="formEditQuestion" enctype="multipart/form-data" action="modules/questions/src/saveQuestion.php">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Вопрос</p>
                    </div>
				    <div class="windowEditObjectTitleBoxTwo">
				        <input type="text" id="titleQuestion" name="titleQuestion">
                        <span class="error" id="errormsg_titleQuestion"></span>
                    </div>
			    </div>
				<input type="hidden" id="idQuestion" name="idQuestion">
				<input type="hidden" name="idGroup" id="idGroupForEdit" value="">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                        <p class="windowEditObjectP">Ответ</p>
                    </div>
				    <div class="windowEditObjectTitleBoxTwo">
				        <textarea  id="answer" name="answer"></textarea>           
                        <span class="error" id="errormsg_answer"></span>
                    </div>
			    </div>    
			    <div class="windowButton">
				    <input class="delButton" type="submit" value="Сохранить"/>
				    <a href="#" class="cancelButton">Отмена</a>
			    </div>
            </form>
        </div>
		
	    <!-- ДОБАВЛЕНИЕ ГРУППЫ  -->
        <div class="windowEditObject" id="_windowAddGroupQuestions_">
            <h3>Добавление группы</h3>
            <form method="post" id="formAddGroupQuest" enctype="multipart/form-data" action="modules/questions/src/saveGroup.php">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                        <p>Название группы</p>
				    </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <textarea type="text" name="titleGroupQuestions"></textarea>
					    <span class="error" id="errormsg_titleGroupQuestions"></span>
			        </div>
                </div>
				<!--<input type="hidden" id="idQuestionGroup" name="idQuestionGroup">-->
			    <div class="windowButton">
				    <input class="delButton" type="submit" value="Добавить"/>
				    <a href="#" class="cancelButton">Отмена</a>
			    </div>
            </form>
        </div>
		
		<!-- РЕДАКТИРОВАНИЕ ГРУППЫ  -->
        <div class="windowEditObject" id="_windowEditObjectGroup_">
            <h3>Редактирование группы</h3>
            <form method="post" id="formEditGroupQuest" enctype="multipart/form-data" action="modules/questions/src/saveGroup.php">
                <div class="windowEditObjectTitle">
			        <div class="windowEditObjectTitleBoxOne">
                       <p>Название группы</p>
			        </div>
				    <div class="windowEditObjectTitleBoxTwo">
                        <textarea type="text" id="titleGroupQuestions" name="titleGroupQuestions"></textarea>
					    <span class="error" id="errormsg_titleGroupQuestions"></span>
			        </div>
			    </div>
				<input type="hidden" name="idGroup" id="idGroup">    
              
                <div class="windowButton">
                    <input class="delButton" type="submit" value="Сохранить"/>
                    <a href="#" class="cancelButton">Отмена</a>
                </div>
            </form>
        </div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		'
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		;
	    $text.= '
		<script>
		    $(".feedbackContent").append("<a href=modules/auth/admin.php?do=logout class=adminExit>Выход</a>");	
		</script>';		
    }else{
	    $text = '
	    <style>
	        #select_4 a{
		        border-bottom: 7px solid #fd8505;
	        }
	    </style>
        <div class="pageNavigation">
            <p><a href="/">Главная</a> -> Вопрос-ответ</p>
        </div>
        <div class="pageTitle">
            <h1>Часто задаваемые вопросы</h1>
        </div>
        <div class="questions" id="accordion">';
            for($i=0;$i<count($groups);$i++){
		        $text .= '
		    <h3>'.$groups[$i]['groupsQuestion'].'</h3>
		    <div class="answer">';
		        for($j=0;$j<count($questions);$j++){
			        if(strcasecmp($groups[$i]['groupsQuestion'],$questions[$j]['groupsQuestion'])==0){
				        $text .= '
                <h3>'.$questions[$j]['title'].'</h3>
				<div class="answer">
				    <p>Ответ: '.$questions[$j]['answer'].'
				</div>';
                    }
		        }
		        $text .=' </div>';
	        }
	/*foreach ($questions as $entry) {
	    $text .= '
		<h3>'.$entry['title'].'</h3>
              <div class="answer">
                  <p>'.$entry['answer'].'</p>
              </div>';
	}*/
        $text .='
		</div>';
    }
    $module['text'] = $text;
?>