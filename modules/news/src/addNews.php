<?php
	session_start();
	if($_SESSION['admin']){
	 $text = '
	 <style>
	#select_5 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	 <div class="_adminHeader">
          <span class="_adminHeaderL"><p><a href="/news">Новости</a></p></span>
          <span class="_adminHeaderR">
              <p>Добавить новость</p>
          </span>
          <h3>Добавление новости</h3>
      </div>
	  <form method="post" id="formAddNews" enctype="multipart/form-data" action="modules/news/src/saveNews.php">
		  <div class="_adminEditNews">
			  <div class="_adminEditNewsContent">
				  <p>Заголовок</p>
				  <input type="text" name="titleNews">
				  <span class="error" id="errormsg_titleNews"></span>
			  </div>
			   <div class="_adminEditNewsContent">
				  <p>Текст новости</p>
				  <textarea type="text" name="textNews"></textarea>
				  <span class="error" id="errormsg_textNews"></span>
			  </div>
			  <div class="_adminEditNewsContent">
				  <p>Изображение №1</p>
				  <div class="_adminEditNewsContentImg">
					 <div class="file_upload">
						  <button type="button">Загрузить...</button>
						  <div class="file_name" id="file_name_news_one"><p>Файл не выбран</p></div>
						  <input type="file" name="uploaded_file_news_one" id="uploaded_file_news_one" multiple accept="image/*,image/jpeg">
					 </div> 
					 <div class="image_uploaded" id="image_uploaded_news_one"></div>
				  </div>
			  </div>
			  <div class="_adminEditNewsContent">
				  <p>Изображение №2</p>
				  <div class="_adminEditNewsContentImg">
					 <div class="file_upload">
						  <button type="button">Загрузить...</button>
						  <div class="file_name" id="file_name_news_two"><p>Файл не выбран</p></div>
						  <input type="file" name="uploaded_file_news_two" id="uploaded_file_news_two" multiple accept="image/*,image/jpeg">
					 </div> 
					 <div class="image_uploaded" id="image_uploaded_news_two"></div>
				  </div>
			  </div>
			  <div class="_adminEditNewsContent">
				  <p>Изображение №3</p>
				  <div class="_adminEditNewsContentImg">
					 <div class="file_upload">
						  <button type="button">Загрузить...</button>
						  <div class="file_name" id="file_name_news_three"><p>Файл не выбран</p></div>
						  <input type="file" name="uploaded_file_news_three" id="uploaded_file_news_three" multiple accept="image/*,image/jpeg">
					 </div> 
					 <div class="image_uploaded" id="image_uploaded_news_three"></div>
				  </div>
			  </div>
		  </div>
		  <div class="_adminContentButton">
			  <div class="windowButton">
				  <input class="delButton" type="submit" value="Сохранить"/>
				  <a href="#" class="cancelButton">Отмена</a>
			  </div>
		  </div>
		  </form>
		  <script>
		    $(".feedbackContent").append("<a href=modules/auth/admin.php?do=logout class=adminExit>Выход</a>");	
		    </script>';
	  echo $text;
	}
	else{
		header("location:/news");
	}
?>