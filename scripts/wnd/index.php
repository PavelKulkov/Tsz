<?php 
$size = getimagesize($catalog_real_img.$request->variables_level[$request->level-1]);
if($size[0] >=$size[1] && $size[0]>600) $pars1['width'] = 600;
elseif($size[0] < $size[1] && $size[1]>600) $pars1['height'] = 600;
$pars1['pic'] = $catalog_img.$request->variables_level[$request->level-1];
echo $templateHome->parse($modules_root."/catalog/templates/window.tpl",$pars1);
?>