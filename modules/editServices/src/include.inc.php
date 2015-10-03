<?php 

do {
							
	$count_parse++;

	if (file_exists("modules/editServices/files/serialize_".$count_parse.".txt")) {
		
		$data_unserialize = unserialize(file_get_contents("modules/editServices/files/serialize_".$count_parse.".txt"));
	
	}

	if ($count_parse >= 5) {
		$margin_icon = "9px";
	}
	
	echo '
				
	<div class="icons_block" style="margin-top: '.$margin_icon.'">
		<a href="/services?service_id='.$data_unserialize['service_id'].'"><img class="icon" src="modules/editServices/icons/'.$data_unserialize['url_image_service'].'"></a>
		<div class="icon_title"><a href="/services?service_id='.$data_unserialize['service_id'].'">'.$data_unserialize['title'].'</a></div>
		<div class="icon_short_name_service"><a href="services?service_id='.$data_unserialize['service_id'].'">'.$data_unserialize['short_name_service'].'</a></div>
	</div>
					 
	';
						
						
} while ($count_parse < 12);
						
?>
						

