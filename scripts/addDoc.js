//Добавление превью изображения и названия документа
$(document).ready(function(){
	//Функция для добавления превью изображения и названия файла
	function addFile(input, idBoxImage, idImage, idFileaName){
		
                      if ( input.files && input.files[0] ) {
						  //Если загруженный документ это изображение
                          if ( input.files[0].type.match('image.*') ) {
							  //Удаляем изображение файла загруженного перед
							  $(idBoxImage).empty(); 
                              var reader = new FileReader();
                              $(idBoxImage).append("<img id='"+idImage+"' src=''>");
							  
                              reader.onload = function(e) {
                                  $("#"+idImage).attr('src', e.target.result); 
                              }
							  
                              reader.readAsDataURL(input.files[0]);
                          }
						  
                          else{
                              $(idBoxImage).empty(); 
                          }
                          //Добавляем название файла
                          $(idFileaName).empty();
                          $(idFileaName).append(input.files[0].name);
                         
                      } 
				      else console.log('not isset files data or files API not supordet');
	}
	
	
	//Редактирования документов
	$("#uploaded_file_edit_object").change(function() { 
	         var input = $(this)[0];
        	addFile( input,"#image_uploaded_edit_object", "image_preview_edit_object", "#file_name_edit_object p");
	});
      
    //Редактирование группы
    $("#uploaded_file_edit_object_group").change(function() { 
	         var input2 = $(this)[0];
        	addFile(input2,"#image_uploaded_edit_object_group", "image_preview_edit_object_group", "#file_name_edit_object_group p");
	});
	
	//Добавление документа
	$("#uploaded_file_add_object").change(function() { 
	         var input2 = $(this)[0];
        	addFile(input2,"#image_uploaded_add_object", "image_preview_add_object", "#file_name_add_object p");
	});
	
	//Добавление группы
	$("#uploaded_file_add_object_group").change(function() { 
	         var input2 = $(this)[0];
        	addFile(input2,"#image_uploaded_add_object_group", "image_preview_add_object_group", "#file_name_add_object_group p");
	});
	
	
	//Добавление новостей
	$("#uploaded_file_news_one").change(function() { 
	
	         var input2 = $(this)[0];
        	addFile(input2,"#image_uploaded_news_one", "image_preview_news_one", "#file_name_news_one p");
	});
    
    $("#uploaded_file_news_two").change(function() { 
	         var input2 = $(this)[0];
        	addFile(input2,"#image_uploaded_news_two", "image_preview_news_two", "#file_name_news_two p");
	});
    
    $("#uploaded_file_news_three").change(function() { 
	         var input2 = $(this)[0];
        	addFile(input2,"#image_uploaded_news_three", "image_preview_news_three", "#file_name_news_three p");
	});
	
	

});