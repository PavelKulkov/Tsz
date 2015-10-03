<?php

function mime_content_files_type($filename) {

	$mime_types = array(

	'txt' => 'text/plain',
	'htm' => 'text/html',
	'html' => 'text/html',
	'php' => 'text/html',
	'css' => 'text/css',
	'js' => 'application/javascript',
	'json' => 'application/json',
	'xml' => 'application/xml',
	'swf' => 'application/x-shockwave-flash',
	'flv' => 'video/x-flv',

	// images
	'png' => 'image/png',
	'jpe' => 'image/jpeg',
	'jpeg' => 'image/jpeg',
	'jpg' => 'image/jpeg',
	'gif' => 'image/gif',
	'bmp' => 'image/bmp',
	'ico' => 'image/vnd.microsoft.icon',
	'tiff' => 'image/tiff',
	'tif' => 'image/tiff',
	'svg' => 'image/svg+xml',
	'svgz' => 'image/svg+xml',

	// archives
	'zip' => 'application/zip',
	'rar' => 'application/x-rar-compressed',
	'exe' => 'application/x-msdownload',
	'msi' => 'application/x-msdownload',
	'cab' => 'application/vnd.ms-cab-compressed',

	// audio/video
	'mp3' => 'audio/mpeg',
	'qt' => 'video/quicktime',
	'mov' => 'video/quicktime',

	// adobe
	'pdf' => 'application/pdf',
	'psd' => 'image/vnd.adobe.photoshop',
	'ai' => 'application/postscript',
	'eps' => 'application/postscript',
	'ps' => 'application/postscript',

	// ms office
	'doc' => 'application/msword',
	'rtf' => 'application/rtf',
	'xls' => 'application/vnd.ms-excel',
	'ppt' => 'application/vnd.ms-powerpoint',

	// open office
	'odt' => 'application/vnd.oasis.opendocument.text',
	'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
	);

	$ext = strtolower(array_pop(explode('.',$filename)));
	if (array_key_exists($ext, $mime_types)) {
		return $mime_types[$ext];
	} else {
		return 'application/octet-stream';
	}
}

function create_watermark( $img, $watermark, $file, $alpha_level = 100, $is_offset=true) {
    list($w, $h) = getimagesize($file);
    list($w_w, $h_w) = getimagesize('scripts/files/'.$GLOBALS['image_water_pic']);
    if($h < $w){
        if($is_offset) $new_h_w = $h - 0.05*$h;
        else $new_h_w = $h;
        $new_w_w = $h;
        if($is_offset) $offset_h = 0.05*$h;
        else $offset_h = 0;
        $offset_w = ($w - $new_w_w)/2;
    } else {
        $new_w_w = $w;
        $new_h_w = $w;
        $offset_w = 0;
        if($is_offset) $offset_h = ($h - 0.05*$h - $new_h_w)/2 + 0.05*$h;
        else $offset_h = ($h - $new_h_w)/2;
    }
    $image_p = imagecreate($w, $h);
    imagecopyresampled($image_p, $watermark, $offset_w, $offset_h, 0, 0, $new_w_w, $new_h_w, $w_w, $h_w);
    $color = imagecolorallocate($image_p, 255, 255, 255);
    $im_p = imagecolortransparent($image_p, $color);
    if($is_offset) imagecopymerge($img, $image_p, 0, 0.05*$h, 0, 0, $w, $h, $alpha_level);
    else imagecopymerge($img, $image_p, 0, 0, 0, 0, $w, $h, $alpha_level);
  return $img;
}

function watermark($file, $is_obj=false,$res=null,$is_pic=true,$is_text=true) {
	$image_info = getimagesize($file);
	if(!$res) {
		$res = imagecreatefromgif($file);
	}
	if($is_text) {
		$im = imagecreatetruecolor($image_info[0], $image_info[1]+0.05*$image_info[1]);
		$color = imagecolorallocate($im, 255, 255, 255);
		imagefilledrectangle($im, 0, 0, $image_info[0]-1, 0.05*$image_info[1], $color);
		imagecopy ( $im, $res, 0, 0.05*$image_info[1], 0, 0, $image_info[0], $image_info[1]);
		$color2 = imagecolorallocate($im, 0, 0, 0);
		imagettftext($im, $image_info[1]/40, 0, $image_info[0]-$image_info[1]/3, $image_info[1]/31, $color2, 'scripts/files/'.$GLOBALS['image_water_font'], 'WWW.PROMARM.RU');
	} else {
		$im = $res;
	}
	if($is_pic) {
		$watermark = imagecreatefromgif('scripts/files/'.$GLOBALS['image_water_pic']);
		$image_watermark = create_watermark($im, $watermark, $file, 30, $is_text);
	} else {
		$image_watermark = $im;
	}
	if($is_obj) {
		return $image_watermark;
	} else {
		imagegif($image_watermark);
	}
}

if($progress) {
	$gif = ImageCreate(300,12);
	$img = $request->getValue('img');
	$img = explode('/',$img);
	$x = ($img[1]/$img[0])*300;
	$white = ImageColorAllocate($gif,255,255,255);
	$red   = ImageColorAllocate($gif,97,131,192);
	ImageFilledRectangle($gif,0,0,$x,12,$red);
	header("content-type: image/gif");
	ImageGif($gif);
} elseif($request->hasValue("query")) {
	//echo 'test';
	if(strstr('/'.$request->getValue('query'),'/th_')) {
		$file_name = str_ireplace('/th_','/','/'.$request->getValue('query'));
		$th = true;
	} elseif(strstr('/'.$request->getValue('query'),'/a_')) {
		$file_name = str_ireplace('/a_','/','/'.$request->getValue('query'));
		$image_small = $image_small_a;
		$th = true;
	} elseif(strstr('/'.$request->getValue('query'),'/m_')) {
		$file_name = str_ireplace('/m_','/','/'.$request->getValue('query'));
		$image_small = $image_m;
		$th = true;
	} elseif(strstr('/'.$request->getValue('query'),'/f_')) {
		$file_name = str_ireplace('/f_','/','/'.$request->getValue('query'));
		$image_small = $image_f;
		$th = true;
	} elseif(strstr('/'.$request->getValue('query'),'/b_')) {
		$file_name = str_ireplace('/b_','/','/'.$request->getValue('query'));
		$image_small = $image_banner;
		$th = true;
	} elseif(strstr('/'.$request->getValue('query'),'/pr_')) {
		$file_name = str_ireplace('/pr_','/','/'.$request->getValue('query'));
		$image_small = $image_pr;
		$th = true;
	} elseif(strstr('/'.$request->getValue('query'),'/c_')) {
		$file_name = str_ireplace('/c_','/','/'.$request->getValue('query'));
		$image_small = $image_car;
		$th = true;
	} else {
		$file_name = $request->getValue('query');
		$th = false;
	}
	$is_watermark = false;
	if($th) {
		list($width, $height) = getimagesize($files_dir.$file_name);
//echo 'test';
		if(strstr('/'.$request->getValue('query'),'/m_') && $width<$image_m) { 
			$new_width = $width;
			$new_height = $height;
		} elseif(strstr('/'.$request->getValue('query'),'/m_') && $height>$image_mh) { 
			$new_width = ($image_mh/$height)*$width;
			$new_height = $image_mh;
		} else{
	//	echo 'test';
			if(strstr('/'.$request->getValue('query'),'/b_')) {
				if($width>$height) {
				if($width>$image_small) {
					$new_width = $image_banner;
					$new_prom = $image_banner*$height;
					$new_height = $new_prom/$width;
//					$new_height = '19';
					//$new_height = $image_small;
					//$new_prom = $image_small*$width;
					//$new_width = $new_prom/$height;
					//echo $new_height;
				}
				} else {
				if($height>$image_small){
					$new_width = ($image_small/$height)*$width;
					$new_height = $image_small;
				} 
				if($height<=$image_small && !$new_width && !$new_height) {
					$new_height = $height;
					$new_width = $width;
				}
				}
			} else {
//				echo '-';
				if(strstr('/'.$request->getValue('query'),'/th_')){
					if(strstr('/'.$request->getValue('query'),'/th_') && $width<$image_small) { 
						$new_width = $width;
						$new_height = $height;
//						echo $new_width.' - '.$new_height;
					}
					if(strstr('/'.$request->getValue('query'),'/th_') && $height>$image_small && !$new_width) { 
						$new_width = ($image_small/$height)*$width;
						$new_height = $image_small;
//						echo $new_width.' --- '.$new_height;
					} else {
						if(!$new_width){
							$new_width = $image_small;
							$new_height = ($image_small/$width)*$height;
						}
					}
				} elseif(strstr('/'.$request->getValue('query'),'/pr_')){
					if(strstr('/'.$request->getValue('query'),'/pr_') && $width<$image_small) { 
						$new_width = $width;
						$new_height = $height;
//						echo $new_width.' - '.$new_height;
					}
					if(strstr('/'.$request->getValue('query'),'/pr_') && $height>$image_small && !$new_width) { 
						$new_width = ($image_small/$height)*$width;
						$new_height = $image_small;
//						echo $new_width.' --- '.$new_height;
					} else {
						if(!$new_width){
							$new_width = $image_small;
							$new_height = ($image_small/$width)*$height;
						}
					}
				} elseif(strstr('/'.$request->getValue('query'),'/a_')){
					if(strstr('/'.$request->getValue('query'),'/a_') && $width<$image_small) { 
						$new_width = $width;
						$new_height = $height;
//						echo $new_width.' - '.$new_height;
					}
					if(strstr('/'.$request->getValue('query'),'/a_') && $height>$image_small && !$new_width) { 
						$new_width = ($image_small/$height)*$width;
						$new_height = $image_small;
//						echo $new_width.' --- '.$new_height;
					} else {
						if(!$new_width){
							$new_width = $image_small;
							$new_height = ($image_small/$width)*$height;
						}
					}
				} elseif(strstr('/'.$request->getValue('query'),'/c_')){
					if(strstr('/'.$request->getValue('query'),'/c_') && $width<$image_small) { 
						$new_width = $width;
						$new_height = $height;
//						echo $new_width.' - '.$new_height;
					}
					if(strstr('/'.$request->getValue('query'),'/c_') && $height>$image_small && !$new_width) { 
						$new_width = ($image_small/$height)*$width;
						$new_height = $image_small;
//						echo $new_width.' --- '.$new_height;
					} else {
						if(!$new_width){
							$new_width = $image_small;
							$new_height = ($image_small/$width)*$height;
						}
					}
				} else { //if($width>$image_small)  
					$new_width = $image_small;
					$new_height = ($image_small/$width)*$height;
				}
			}
		}
		
		$image_p = imagecreatetruecolor($new_width, $new_height);
	}

	$content_type = mime_content_files_type($file_name);
	header('Content-Type: '.$content_type);
	if($th || $is_watermark) {
		if(!$cacheSite->search_in_base_img($request->getValue('query'))) {
			switch ($content_type) {
				case 'image/png':
					$image = imagecreatefrompng($files_dir.$file_name);
					break;
				case 'image/jpeg':
					$image = imagecreatefromjpeg($files_dir.$file_name);
					break;
				case 'image/gif':
					$image = imagecreatefromgif($files_dir.$file_name);
					break;
			}
			if($th) {
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$image = $image_p;
			}
			if($image) $cacheSite->ins_to_base_img($request->getValue('query'),$image,$content_type);
			switch ($content_type) {
				case 'image/png':
					imagepng($image, null);
					break;
				case 'image/jpeg':
					imagejpeg($image, null, 100);
					break;
				case 'image/gif':
					imagegif($image, null, 100);
					break;
				default:
					readfile($files_dir.$file_name);
					break;
			}
		}//Cache
	} else {
		readfile($files_dir.$file_name);
	}
}
?>
