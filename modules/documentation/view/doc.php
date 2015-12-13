<?php
    function get_mas($list, $index){
		$i =0;
		foreach ($list as $entry) {
			if($entry['document_type'] == $index){
				//$mas[$i] = '<p class="documentText"><a href="#" download>'.$entry['title'].'</a>'; 
				$mas[$i] = "<p><a href=files/Docs/".$entry['name']." download>".$entry['title']."</a></p>";
				$i++;
			}
		}
		return $mas;
    }
	function outputMas($mas){
		$text = "";
		for($j = 0; $j < count($mas); $j++){
		$text .= $mas[$j];
	}
		return $text;
	}
	$mas_1 = get_mas($list, 1);  
	$mas_2 = get_mas($list, 2);
	$mas_3 = get_mas($list, 3); 
    $mas_4 = get_mas($list, 4);  
	
				
	$text	='<style>
	#select_2 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<div class="pageNavigation">
              <p><a href="/">Главная</a> -> Документы</p>
          </div>
          <div class="pageTitle">
              <h1>Документы Ассоциации ТСЖ г.Пензы</h1>  
          </div>
          <div class="ContentDoc">
              <div class="leftContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_1.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Законы Российской федерации</h1>
                  </div>
                  <div class="textDoc">';
                $text .= outputMas($mas_1);                  
                $text .= ' </div>
              </div>
              
               <div class="rightContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_2.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Законодательные документы Пензенской области</h1>
                  </div>
                  <div class="textDoc">';
                      $text .= outputMas($mas_2);                     
                $text .=  '</div>
              </div>
          </div>
          <div class="ContentDoc">
              <div class="leftContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_3.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Местные нормативные документы г.Пензы</h1>
                  </div>
                  <div class="textDoc">';
                  $text .= outputMas($mas_3);              
         	
                 $text .=' </div>
              </div>
              
               <div class="rightContentDoc">
                  <div class="logoDoc">
                      <img src="/templates/images/documents/logoDoc_4.png">
                  </div>
                  <div class="headerDoc">
                      <h1>Прочие документы</h1>
                  </div>
                  <div class="textDoc">';
                        $text .= outputMas($mas_4);  
                 $text .= ' </div>
              </div>
          </div>';
	
					/*<p class="documentData">'.$entry['date'].'</p>
					<p class="documentText"><a href="files/Docs/'.$entry['name'].'" download>'.$entry['title'].'</a>'
				;}*/
				$module['text'] = $text;
?>
							
			
							
	
				