<?php
	require_once($modules_root."news/class/News.class.php");
	
	$masFileName;
	function count_files($dir){
		$c = 0;
		$d = dir($dir);
		while($str = $d->read()){
			
			if($str{0} != '.'){
				if(is_dir($dir.'/'.$str)){
					$c += count_files($dir.'/'.$str);
				}
				else{
					$masName[] = $str;
					$c++;
				}
			}
		}
		$d->close();
		$GLOBALS["masFileName"] = $masName;
		
	}
	
	function getStrImage($id, $path, $masName){
		
		if(isset($masName[$id])){
			//Картинка
			$mas[0] = '<img src="../files'.$path.$masName[$id].'">';
			//Имя файла
			$mas[1] = $masName[$id];	 
	   }
	   else{
			$mas[0] =' <img src="../files/News/noImage/noImage.png">';
			$mas[1] = 'Файл не выбран';
	   }
	   return $mas;
	}
	
	
if($_SESSION['admin']){
	$id_new = $request->getValue('id');
	if(!isset($news)) $news = new News($request, $db);
	
	$new = $news->getNew($id_new);
    count_files('files'.$new['image']);
	
	$image1 =  getStrImage(0,$new['image'], $masFileName);
	$image2 =  getStrImage(1,$new['image'], $masFileName);
	$image3 =  getStrImage(2, $new['image'],$masFileName);
	
	$text ='
	<style>
	#select_5 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<script>
		    $(".feedbackContent").append("<a href=modules/auth/admin.php?do=logout class=adminExit>Выход</a>");	
		    </script>
      <div class="_adminHeader">
          <span class="_adminHeaderL"><p><a href="/news">Новости</a></p></span>
          <span class="_adminHeaderR">
              <a href="news?admin=addNews">Добавить новость</a>
          </span>
          <h3>Редактирование новости</h3>
      </div>
      <div class="_adminEditNews">
         <form method="post" id="formEditNews" enctype="multipart/form-data" action="../modules/news/src/saveNews.php">
		  <div class="_adminEditNewsContent">
              <p>Заголовок</p>
              <input type="text" name="titleNews" value="'.$new['title'].'">
			  <span class="error" id="errormsg_titleNews"></span>
          </div>
           <div class="_adminEditNewsContent">
              <p>Текст новости</p>
			  <textarea  name="textNews" >'.$new['text'].'</textarea>
			  <span class="error" id="errormsg_textNews"></span>
          </div>
		  <input type="hidden" name="idNew" value="'.$new['id'].'">
		  <input type="hidden" name="nameDir" value="'.$new['image'].'">
          <div class="_adminEditNewsContent">
              <p>Изображение №1</p>
              <div class="_adminEditNewsContentImg">
                 <div class="file_upload">
                      <button type="button">Загрузить...</button>
                      <div class="file_name" id="file_name_news_one"><p>'.$image1[1].'</p></div>
                      <input type="file" name="uploaded_file_news_one" id="uploaded_file_news_one" multiple accept="image/*,image/jpeg">
                 </div> 
                 <div class="image_uploaded" id="image_uploaded_news_one">';
		
				 $text .='	
					'.$image1[0].'
				 </div>
              </div>
          </div>
          <div class="_adminEditNewsContent">
              <p>Изображение №2</p>
              <div class="_adminEditNewsContentImg">
                 <div class="file_upload">
                      <button type="button">Загрузить...</button>
                      <div class="file_name" id="file_name_news_two"><p>'.$image2[1].'</p></div>
                      <input type="file" name="uploaded_file_news_two" id="uploaded_file_news_two" multiple accept="image/*,image/jpeg">
                 </div> 
                 <div class="image_uploaded" id="image_uploaded_news_two">';
				 
				 $text .='
					'.$image2[0].'
				 </div>
              </div>
          </div>
          <div class="_adminEditNewsContent">
              <p>Изображение №3</p>
              <div class="_adminEditNewsContentImg">
                 <div class="file_upload">
                      <button type="button">Загрузить...</button>
                      <div class="file_name" id="file_name_news_three"><p>'.$image3[1].'</p></div>
                      <input type="file" name="uploaded_file_news_three" id="uploaded_file_news_three" multiple accept="image/*,image/jpeg">
                 </div> 
                 <div class="image_uploaded" id="image_uploaded_news_three">';

				 $text .= '
					'.$image3[0].'
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
	header("Location:/news");
}
?>