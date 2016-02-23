<?php
    require_once($modules_root."news/class/News.class.php");
    if(!isset($news)) $news = new News($request, $db);

    $text = '
	<div class="lastNewsIndex">';
    if(!empty($entry)){
	    $text .= '
		<h1>Последние новости</h1>
	    <div class="lastNewsContent">';
    }
 
    foreach ($mas as $entry) {
        if($entry['image'] == "/News/default/default.png"){
		    $image = $entry['image'];
	    }
        else{
		    $fileName = $news->count_files('files'.$entry['image']);
		    $image = $entry['image'].$fileName[0];
	    }
   
	    $text .= '
		<div class="lastNewsBox">
	        <div class="lastNewsImage">
				<a href="news?id_news='.$entry['id'].'">
			        <img src="files'.$image.'">
			    </a>
		    </div>	
            <div class="lastNewsText">
                <p>'.$entry['title'].'</p>
            </div>
		    <div class="lastNewRead">
				<a href="news?id_news='.$entry['id'].'">Подробнее...</a>
		    </div>
        </div>';
    }	
    $text .='
	</div>
    </div>' ;
    $module['text'] = $text;
?>