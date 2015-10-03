<?php
//require_once($modules_root . "Fileinfo/class/File_info.class.php");
//require_once($modules_root . "Fileinfo/class/File_infoHome.class.php");

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

if($catalog_file) {
	if($request->hasValue("query")) {
		$pars2 = explode('_',$request->getValue('query'),2);
		if($pars2[0]=='a' || $pars2[0]=='th') {
			if($pars2[0]=='a') $image_height = $image_height_small_a;
			$name = $pars2[1];
		} else {
			$name = $request->getValue('query');
		}

		if(is_file($catalog_real_img.$name)) {
			header('Content-Type: image/gif');
			if($pars2[0]=='th' || $pars2[0]=='a'){
				list($width, $height) = getimagesize($catalog_real_img.$name);
				$new_width = ($image_height/$height)*$width;

				if($new_width>$image_height && $pars2[0]!='a') {
					$new_width = $image_height;
					$new_height = ($image_height/$width)*$height;
				} else {
					$new_height = $image_height;
				}
				$image_p = imagecreatetruecolor($new_width, $new_height);
				$image = watermark($catalog_real_img.$name,true);
				//			$image = imagecreatefromjpeg($catalog_real_img.$name);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				imagegif($image_p, null, 100);
			} else {
				//			header('Content-type: '.mime_content_files_type($name));
				if(is_file($catalog_real_img.$name)) {
					watermark($catalog_real_img.$name);
					//readfile($catalog_real_img.$name);
				}
			}
		} else {
			$file = fopen ("http://old.promarm.ru/".$request->getValue('query'), "r");
			if ($file) {
				while (!feof ($file)) {
					$line = fgets ($file, 1024);
					echo $line;
				}
				exit;
			}
		}
	}
} else {
	if($request->hasValue("query")) {
		if(strstr($request->getValue('query'),'/th_')) {
			$file_name = str_ireplace('/th_','/',$request->getValue('query'));
			$th = true;
		}elseif(strstr($request->getValue('query'),'/a_')) {
			$file_name = str_ireplace('/a_','/',$request->getValue('query'));
			$image_height_small = $image_height_small_a;
			$th = true;
		} else {
			$file_name = $request->getValue('query');
			$th = false;
		}
		if($request->hasValue('page1') || $request->hasValue('page2') || $request->hasValue('page3')) {
			$is_watermark = true;
		} else {
			$is_watermark = false;
		}
		if($th) {
			list($width, $height) = getimagesize($files_dir.$file_name);
			$new_width = ($image_height_small/$height)*$width;
			$image_p = imagecreatetruecolor($new_width, $image_height_small);
		}

		$content_type = mime_content_files_type($file_name);
		header('Content-Type: '.$content_type);
		if($th || $is_watermark) {
			//if(!$cacheSite->search_in_base_img($request->getValue('query'))) {
				switch ($content_type) {
					case 'image/png':
						if(!$image) {
							$image = imagecreatefrompng($files_dir.$file_name);
							if($request->hasValue('page1'))	$image = watermark($files_dir.$file_name,true,$image,false);
							if($request->hasValue('page2'))	$image = watermark($files_dir.$file_name,true,$image,true,false);
							if($request->hasValue('page3'))	$image = watermark($files_dir.$file_name,true,$image);
							if($th) {
								imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $image_height_small, $width, $height);
								$image = $image_p;
							}
			//				if($image) $cacheSite->ins_to_base_img($request->getValue('query'),$image,$content_type);
						}
						imagepng($image, null);
						break;
					case 'image/jpeg':
						if(!$image) {
							$image = imagecreatefromjpeg($files_dir.$file_name);
							if($request->hasValue('page1'))	$image = watermark($files_dir.$file_name,true,$image,false);
							if($request->hasValue('page2'))	$image = watermark($files_dir.$file_name,true,$image,true,false);
							if($request->hasValue('page3'))	$image = watermark($files_dir.$file_name,true,$image);
							if($th) {
								imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $image_height_small, $width, $height);
								$image = $image_p;
							}
			//				if($image) $cacheSite->ins_to_base_img($request->getValue('query'),$image,$content_type);
						}
						imagejpeg($image, null, 100);
						break;
					case 'image/gif':
						if(!$image) {
							$image = imagecreatefromgif($files_dir.$file_name);
							if($request->hasValue('page1'))	$image = watermark($files_dir.$file_name,true,$image,false);
							if($request->hasValue('page2'))	$image = watermark($files_dir.$file_name,true,$image,true,false);
							if($request->hasValue('page3'))	$image = watermark($files_dir.$file_name,true,$image);
							if($th) {
								imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $image_height_small, $width, $height);
								$image = $image_p;
							}
				//			if($image) $cacheSite->ins_to_base_img($request->getValue('query'),$image,$content_type);
						}
						imagegif($image, null, 100);
						break;
					default:
						readfile($files_dir.$file_name);
						break;
				}
			//}//Cache
		} else {
			readfile($files_dir.$file_name);
		}
	}
}
?>