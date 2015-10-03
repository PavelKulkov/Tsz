<?php 
ob_start();
if(!function_exists('mime_content_type')) {

	function mime_content_type($filename) {

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

		$file_name_array = explode('.', $filename);
		$ext = $file_name_array[count($file_name_array)-1];
		if (array_key_exists($ext, $mime_types)) {
			return $mime_types[$ext];
		}
		elseif (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $filename);
			finfo_close($finfo);
			return $mimetype;
		}
		else {
			return 'application/octet-stream';
		}
	}
}
require_once("../../config.inc.php");
require_once("../../config_system.inc.php");
$data = ob_end_clean();
$authHome = new AuthHome(NULL);
$authHome->initGuestConnection($guestUser);
$db = $authHome->getCurrentDBConnection();
$db->changeDB("regportal_services");
$row = $db->selectRow("select * from reglaments where id = ?", $_GET['reglament_id']);
$file_name_array = explode('.', $row['reglament_name']);
$ext = $file_name_array[count($file_name_array)-1];
$file = ModuleHome::getDocumentRoot()."/files/reglaments/".$_GET['reglament_id'];

header('Content-Description: File Transfer');
$ct = mime_content_type($row['reglament_name']);
header('Content-Type: '.$ct);
header('Content-Disposition: attachment; filename=' . $row['reglament_name']);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
// читаем файл и отправляем его пользователю
readfile($file);
exit;
?>