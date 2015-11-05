<?php
	//$text = '<h2>Реестр членов Ассоциации</h2>';
	$text = '<div class="pageNavigation">
               <p><a href="\">Главная</a> -> Список членов ассоциации</p>
             </div>
			 
			 <div class="listAssociation">
               <h1>Список членов Ассоциации</h1>
               <div class="listAssociationSelect">
                 <p>Выберите название ТСЖ из списка или укажите адрес на карте:</p>
                 <input name="search" type="text" id="search" placeholder="Название...">
                </div>
             </div>
			 <div id="map" class="map" >
			 
			  
             </div>';
    function get_mas($list, $index){
		$i =0;
		foreach ($list as $entry) {
			if($entry['area'] == $index){
				$mas[$i] = "ТСЖ ".$entry['title']." , ".$entry['address'];  
				$i++;
			}
		}
		return $mas;
    }
		  
    $mas_1 = get_mas($list, 1);  
	$mas_2 = get_mas($list, 2);
	$mas_3 = get_mas($list, 3); 
    $mas_4 = get_mas($list, 4);  		  
		  	
    $text .= ' <div class="listAreasContent">
                 <div class="listAreasLeft">
                   <div class="AreasLeftName">
                    <h3>Первомайский район</h3>
                   </div>
			     <div class="AreasLeftContent">';

    for($j = 0; $j < count($mas_1); $j++){
		$text .= '<p>'.$mas_1[$j].'</p>';
	}

	$text .= '</div>
              </div>
		      <div class="listAreasRight">
                <div class="AreasRightName">
                  <h3>Ленинский район</h3>
                </div>
                <div class="AreasRightContent">';
    for($j = 0; $j < count($mas_2); $j++){
		$text .= '<p>'.$mas_2[$j].'</p>';
	}
	$text .= ' </div>
               </div>
               </div>
               <div class="listAreasContent">
		         <div class="listAreasLeft">
                   <div class="AreasLeftName">
                    <h3>Октябрьский район</h3>
                   </div>
                   <div class="AreasLeftContent">';
    for($j = 0; $j < count($mas_3); $j++){
		$text .= '<p>'.$mas_3[$j].'</p>';
	}
	$text .= '</div>
              </div>
              <div class="listAreasRight">
                <div class="AreasRightName">
                  <h3>Железнодорожный район</h3>
                </div>
                <div class="AreasRightContent">';
    for($j = 0; $j < count($mas_4); $j++){
	  $text .= '<p>'.$mas_4[$j].'</p>';
    }
	$text .= ' </div>
               </div>
               </div>';
							
	/*
	
				foreach ($list as $entry) {							
	$text .= '	<div class="listTsz">
				<div class="listTszText">
				  <img src="/files/logos/'.$entry['logo'].'">
				  <a href="registry?id_tsz='.$entry['id'].'"><h3>'.$entry['title'].'</h3></a>
				  <p>'.$entry['address'].'</p>
				</div>
				</div>'
				;}*/
?>			