<?php
   header('Content-Type: text/html; charset=utf-8');
   if(!isset($_POST['auth'])){
     die('Не найден параметр auth'); 
   }
   
   require_once("../config.inc.php");
   require_once("../config_system.inc.php");
   if(strlen($_POST['auth'])>$maxCertificateSize){
     die("Превышенна максимальная длинна сертификата");
   }
   
   $request = new HttpRequest();
   $response = new HttpResponse();
   $authHome = new AuthHome(NULL);
   $authHome->initGuestConnection($guestUser);
   
   $db = $authHome->getCurrentDBConnection();
   $log = new Logger($db);
   $dumper = new Dumper($db);
   if($dumper->checkClientOnCaptcha()){
   	header('Refresh: 3; URL=/captcha.php');
   	exit();
   }
   
   $fileName = tempnam(ModuleHome::getTemp(), "cert");
   $auth = str_replace("\r\n",'',$_POST['auth']);
   $auth = str_replace("\n",'',$auth);
   $handle = fopen($fileName,"w");
   $auth = base64_decode($auth);
   fwrite($handle,$auth);
   fclose($handle);
   
   $meta = "AuthRequest,".$_SERVER['REMOTE_ADDR'];
   $log->warning($meta, "FileName=".$fileName);
   $check = "java -cp ../smev/oep-auth-0.0.1-SNAPSHOT.jar com.oep.auth.AuthTool ".$fileName;
   $log->info($meta, "exec=".$check);
   exec($check,$output,$code);
   
   $log->info($meta, "code=".$code);
   $log->info($meta, "result=".$output[0]);
   $log->info($meta, "output=".$output[1]);
   if($code==0){
   	 $log->info($meta, "serial=".$output[2]);
   	 $authHome->startSession("serial=".$output[2],"1");
   	 $return_to = '/index.php';
   	 if (isset($_POST['return_to'])){
   	 	$return_to = $_POST['return_to'];
   	 }
   	 header('Location: '.$return_to);
   }else{
     die($output[1]);	
   }
   $saveAuthCertificate = $dumper->getProperty("saveAuthCertificate");
   if($saveAuthCertificate==false){
     unlink($fileName);	
   }
   
?>