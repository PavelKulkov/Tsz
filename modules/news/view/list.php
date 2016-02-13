<?php
    if($_SESSION['admin']){
		$text = '
		<style>
	#select_5 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>

		<div class="_adminHeader">
          <span class="_adminHeaderL"><p>Новости</p></span>
          <span class="_adminHeaderR">
              <a href="news?admin=addNews">Добавить новость</a>
          </span>
      </div>
      
      <div class="_adminList">
          <p class="_adminListL">Название</p>
          <p class="_adminListR">Действие</p>
      </div>
      
      
      <!--################ НАЧАЛО  accordion  ###########################-->
      <div class="_adminAccordion" id="accordion">';
          
		for($i=0;$i<count($years);$i++){
          $text .='<h3 class="_adminAccordionTitle">
              <p>'.$years[$i].'<span><img src="templates/images/select.png"></span></p>
              
          </h3>
		   <div class="_adminAccordionContents">';
		  for($j=0;$j<count($list);$j++){
			  $tmp = substr($list[$j]['date'],0,4);
			  if(strcmp($years[$i],$tmp)==0){
			  $text .='
              <div class="_adminAccordionContent">
                  <p>'.$list[$j]['title'].'</p>
                 <span class="_adminAccordionSelectAction">
                  <a href="news?admin=editNews&id='.$list[$j]['id'].'" ><span ><img src="templates/images/editDoc.png"></span></a>
                  <a id="news-'.$list[$j]['id'].'" class="_adminDelObject_"><span ><img src="templates/images/delDoc.png"></span></a>
                  
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
          <div class="windowDelText">
              <p>Вы уверены, что хотите удалить<br>
             выбранную новость?</p>
          </div>
          <input type="hidden" name="IdForDel" id="IdForDel" >
		  <div class="windowButton">
              <input class="delButton" type="submit" value="Удалить"/>
              <a href="#" class="cancelButton">Отмена</a>
          </div>
		  </form>
      </div>';
	  $text.= '
		<script>
		    $(".feedbackContent").append("<a href=modules/auth/admin.php?do=logout class=adminExit>Выход</a>");	
		    </script>';		
			
			
	}else{
		$text = '
		<style>
		#select_5 a{
			border-bottom: 7px solid #fd8505;
		}
		</style>
		<div class="pageNavigation">
					<p><a href="/">Главная</a> -> Новости</p>
				</div>
				<div class="pageTitle">
					<h1>Новости в сфере ТСЖ</h1>
				</div>
				<div class="news">';
				foreach ($list as $entry) {	
					//$mas = explode(",", $entry['image']);
					
					$text .= '
					<div class="newsContent">
				        <p class="newsContentData">'.date('d.m.Y H:i',strtotime($entry['date'])).'</p>
						
					    <div class="newsImage">
						    <a href="news?id_news='.$entry['id'].'"> 
						        <img src="/files'.$entry['image'].'image1.jpg">
					        </a>
						</div>
						<div class="newsText">
						     <a class="newsContentTitle" href="news?id_news='.$entry['id'].'">'.$entry['title'].'</a>
							 <div class="readNews">
							     <a href="news?id_news='.$entry['id'].'">Читать дальше ></a>
							 </div>
						</div>
			  </div>';
				}
				
				$text .='</div>';
				$text .= 	$paginator['text'];
	}
/*
	$text .= '	<div class="rule"></div>
				<h3 class="title_blank">Новости</h3>';
	
							
	//$text .= 	$paginator['text'];
	
				foreach ($list as $entry) {							
	$text .= '	<div class="news_list">
					<div class="news_info">
						<div class="news_data1">'.date('d.m.Y H:i',strtotime($entry['date'])).'</div>
						<div class="news_txt1"><a href="news?id_news='.$entry['id'].'">'.$entry['title'].'</a></div>
					</div>
					<div class="cl"></div>
				</div>';
				}
							
	//$text .= 	$paginator['text'];				
							
	$text .= '	<script type="text/javascript">
					$(document).ready(function(){
				    	$("div#content_content").removeClass().addClass("content");
						$("div#content_center").removeClass().addClass("center");
						$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Новости");
						$("div#content_line").removeClass().addClass("blue_line");
					});
				</script>';*/
?>