<?php
	//$text = '<h2>Реестр членов Ассоциации</h2>';
	$text = '<style>
	#select_1 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<div class="pageNavigation">
               <p><a href="\">Главная</a> -> Список членов ассоциации</p>
             </div>
			 <div class="pageTitle">
                 <h1>Список членов Ассоциации</h1>
             </div>
			 
			 <div class="listAssociation">
               <div class="listAssociationSelect">
                 <p>Выберите название ТСЖ из списка или укажите адрес на карте:</p>
                 <input name="search" type="text" id="search" placeholder="Название...">
                <select>
                      <option>ТСЖ "Ромашка"</option>
                      <option>ТСЖ "Виктория"</option>
              </select>
				</div>
             </div>
			 <div id="map" class="map" >
			 
			  
             </div>';
    function get_mas($list, $index){
		$i =0;
		foreach ($list as $entry) {
			if($entry['area'] == $index){
				$mas[$i] = "<p id = ".$entry['id'].">ТСЖ ".$entry['title']." , ".$entry['address']."</p>";  
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
		$text .= $mas_1[$j];
	}

	$text .= '</div>
              </div>
		      <div class="listAreasRight">
                <div class="AreasRightName">
                  <h3>Ленинский район</h3>
                </div>
                <div class="AreasRightContent">';
    for($j = 0; $j < count($mas_2); $j++){
		$text .= $mas_2[$j];
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
		$text .= $mas_3[$j];
	}
	$text .= '</div>
              </div>
              <div class="listAreasRight">
                <div class="AreasRightName">
                  <h3>Железнодорожный район</h3>
                </div>
                <div class="AreasRightContent">';
    for($j = 0; $j < count($mas_4); $j++){
	  $text .= $mas_4[$j];
    }
	$text .= ' </div>
               </div>
               </div>
			   
			   
			   <div class="modalWindow">
    <div class="closeModalWindow">
       <div class="closeModalWindowImg"></div>
    </div>
    <div class="headerModalWindow">
        
    </div>
    <div class="contentModalWindow">
        <div class="logoModalWindow">
            
        </div>
        <div class="textModalWindow">
           
        </div>
    </div>
</div>      
			   
			   ';
							
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