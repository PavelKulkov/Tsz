<?php

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


$text = '<div class="lastNewsIndex">';
if(!empty($entry)){
	$text .= '<h1>Последние новости</h1>
	<div class="lastNewsContent">';
	
}
 
foreach ($mas as $entry) {
	count_files('files'.$entry['image']);
   // $masImage = explode(",", $entry['image']);
   
	$text .= '<div class="lastNewsBox">
	              <div class="lastNewsImage">
				      <a href="news?id_news='.$entry['id'].'">
					      <img src="files'.$entry['image'].$masFileName[0].'">
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
$text .='</div>
</div>' ;
$module['text'] = $text;