<?php
	$text = '<h2>Документы</h2>';		
	
				foreach ($list as $entry) {							
	$text .= '	<div class="documents">
				<div class="documentStructure">
					<p class="documentData">'.$entry['date'].'</p>
					<p class="documentText"><a href="" download>'.$entry['title'].'</a>
				 </div>
				</div>'
				;}
				$module['text'] = $text;
?>
							
			
							
	
				