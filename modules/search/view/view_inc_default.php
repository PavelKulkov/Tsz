<?php
	$text = '
    <div class="searchForm">
        <div>
         <input id="str" name="str" type="text" class="nameTsz" autocomplete="off" placeholder="Введите адрес">
         <div class="submitLogo" id="scan"><img src="/templates/images/submit_logo.png"></div>
        </div>
       
        <h2>или выберите по названию</h2>
	    <select class="listTsz">';
    foreach($listTsz as $Tsz){
		$text .='<option id="'.$Tsz['id'].'">'.$Tsz['title'].'</option>';
	};
    $text .= '         
        </select>
    </div>';
	echo($text);
?>