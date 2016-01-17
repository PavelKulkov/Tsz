<?php
   if($_SESSION['admin']){
	   $text = '<div class="_adminHeader">
          <span class="_adminHeaderL"><p>Вопрос-ответ</p></span>
      </div>
      
      <div class="_adminList">
          <p class="_adminListL">Название</p>
          <p class="_adminListR">Действие</p>
      </div>
      
      
      <!--################ НАЧАЛО  accordion  ###########################-->
      <div class="_adminAccordion" id="accordion">
          
          <h3 class="_adminAccordionTitle">
              <p>Вопросы <span><img src="templates/images/select.png"></span></p>
              <span class="_adminAccordionSelectAction">
                  <a  href="#" class="_adminAddObject_"><span><img src="templates/images/addDoc.png"></span></a>
              </span>
          </h3>
          <div class="_adminAccordionContents">';
              foreach($list as $question){
			  $text .='
			  <div class="_adminAccordionContent">
                  <p>'.$question['title'].'</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="#" id="'.$question['id'].'" class="_adminEditObjectQuestions_"><span><img src="templates/images/editDoc.png"></span></a>
                  <a href="#" id="questions-'.$question['id'].'" class="_adminDelObject_"><span><img src="templates/images/delDoc.png"></span></a>
              </span>
              </div>';
			  }
$text .='			  
          </div>
      </div>
      
      
      
      
      <!-- УДАЛЕНИЕ ВОПРОСА-->
      
      <div class="windowDel" id="_windowDel_">
         <form method="post" enctype="multipart/form-data" action="scripts/phpScripts/delete.php">
		  <input type="hidden" name="IdForDel" id="IdForDel" >
		  <div class="windowDelText">
              <p>Вы уверены, что хотите удалить<br>
             выбранный вопрос ?</p>
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
          <form method="post" enctype="multipart/form-data" action="modules/questions/src/saveQuestion.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Вопрос</p>
                  <input type="text" name="titleQuestion">
              </div>
          
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Ответ</p>
                  <input type="text" name="answer">             
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
          <form method="post" enctype="multipart/form-data" action="modules/questions/src/saveQuestion.php">
		 
              <div class="windowEditObjectTitle">
                 <p>Вопрос</p>
                  <input type="text" id="titleQuestion" name="titleQuestion">
              </div>
				<input type="hidden" id="idQuestion" name="idQuestion">
              <div class="windowEditObjectContent">
                  <p class="windowEditObjectP">Ответ</p>
                  <input type="text" id="answer" name="answer">           
              </div>    
			  <div class="windowButton">
				  <input class="delButton" type="submit" value="Сохранить"/>
				  <a href="#" class="cancelButton">Отмена</a>
			  </div>
           </form>
         
      </div>';
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
    
	foreach ($list as $entry) {
	    $text .= '
		<h3>'.$entry['title'].'</h3>
              <div class="answer">
                  <p>'.$entry['answer'].'</p>
              </div>';
	}
    $text .='</div>';
   }
	$module['text'] = $text;
?>