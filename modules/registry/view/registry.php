<?php
	$text = '<h2>Реестр членов Ассоциации</h2>';
	
							
	
	
				foreach ($list as $entry) {							
	$text .= '	<div class="listTsz">
				<div class="listTszText">
				  <img src="/files/logos/'.$entry['logo'].'">
				  <a href="registry?id_tsz='.$entry['id'].'"><h3>'.$entry['title'].'</h3></a>
				  <p>'.$entry['address'].'</p>
				</div>
				</div>'
				;}
?>			
			
							
	
				