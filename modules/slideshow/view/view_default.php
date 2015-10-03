<?php
$text.= '<div id="slider-wrap">
		<div id="slider">';
foreach ($output_params['slides'] as $entry)
{
	$text.='<div class="slide"><img src="'.$entry['image_path'].'" alt="" ><div class="name">'.$entry['description'].'</div></div>';
}
$text.= '	</div>
		</div>';
?>