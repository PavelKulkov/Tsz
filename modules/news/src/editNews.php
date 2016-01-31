<?php
	require_once($modules_root."news/class/News.class.php");
	
	
if($_SESSION['admin']){
	$id_new = $request->getValue('id');
	if(!isset($news)) $news = new News($request, $db);
	
	$new = $news->getNew($id_new);

	$text ='
      <div class="_adminHeader">
          <span class="_adminHeaderL"><p><a href="/news">Новости</a></p></span>
          <span class="_adminHeaderR">
              <a href="news?admin=addNews">Добавить новость</a>
          </span>
          <h3>Редактирование новости</h3>
      </div>
      <div class="_adminEditNews">
         <form method="post" enctype="multipart/form-data" action="../modules/news/src/saveNews.php">
		  <div class="_adminEditNewsContent">
              <p>Заголовок</p>
              <input type="text" name="titleNew" value="'.$new['title'].'">
          </div>
           <div class="_adminEditNewsContent">
              <p>Текст новости</p>
			  <input type="text" name="textNew" value="'.$new['text'].'">
          </div>
		  <input type="hidden" name="idNew" value="'.$new['id'].'">
		  <input type="hidden" name="nameDir" value="'.$new['image'].'">
          <div class="_adminEditNewsContent">
              <p>Изображение №1</p>
              <div class="_adminEditNewsContentImg">
                 <div class="file_upload">
                      <button type="button">Загрузить...</button>
                      <div class="file_name" id="file_name_news_one"><p>Файл не выбран</p></div>
                      <input type="file" name="uploaded_file_news_one" id="uploaded_file_news_one" multiple accept="image/*,image/jpeg">
                 </div> 
                 <div class="image_uploaded" id="image_uploaded_news_one">
					<img src="../files'.$new['image'].'image1.jpg">
				 </div>
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
                 <div class="image_uploaded" id="image_uploaded_news_two">
					<img src="../files'.$new['image'].'image2.jpg">
				 </div>
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
                 <div class="image_uploaded" id="image_uploaded_news_three">
					<img src="../files'.$new['image'].'image3.jpg">
				</div>
              </div>
          </div>
		
      </div>
      <div class="_adminContentButton">
          <div class="windowButton">
              <input class="delButton" type="submit" value="Сохранить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
      </div>
	  </form>';
	  
	  echo($text);
}else{
	header("Location:/");
}
?>