<?php
	$text = '<form class="searchForm">
                  <input type="text" placeholder="Введите название вашего ТСЖ" class="nameTsz"  autocomplete="off">
               
				  <select class="listTsz">';
	foreach($listTsz as $Tsz){
			$text .='<option id="'.$Tsz['id'].'">'.$Tsz['title'].'</option>';
			};
    $text .= '         
                  </select>
              </form>';
	echo($text);
?>