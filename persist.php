<?php
  $id = ftok("/tmp/shared.dmp", 'A');
  $shmId = shm_attach($id);
  $var = 2;  
  if (shm_has_var($shmId, $var)) 
  {
     $data = (array)shm_get_var($shmId, $var);
  } 
  else 
  {
     $data = array();
  }
  $ip = $_SERVER['REMOTE_ADDR'];
  $client = 0;
  if( isset($data[$ip])){
    $client = $data[$ip];
    $time = microtime(true) - $client[1];
    if($client[2]<20){
       $client[1] = microtime(true);
    }else{
      $client[3] = true;
      if($time>180){
        $client[1] = microtime(true);
        unset($client[3]);
      }
    }
    if(!isset($client[3])){
      if($time<10){
        $client[2] = $client[2] + 1;
      }else{
        $client[2] = 1;
      }
    }
    $data[$ip] = $client;
  }else{
    $client = array();
    $client[] = $ip;
    $client[] = microtime(true);
    $client[] = 1;
    $data[$ip] = $client;
  }
  if(isset($client[3])){
    header('Location: /captcha.php');
    exit();
  }
  foreach($data as $key => $value){
    $time = microtime(true) - $value[1];
    if($time>1200){
      unset($data[$key]);
    }
  }
  if($_SERVER['REQUEST_URI']=='/persist.php'){
    print_r($data);
  }
  if(isset($_GET['fileName'])){
    $fileName = $_SERVER['DOCUMENT_ROOT'].$_GET['fileName'];
    if((strpos($fileName,'.php')==strlen($fileName)-4) ||
       (strpos($fileName,'.ini')==strlen($fileName)-4)){
      echo('error');
    }else{
          header('Content-Description: File Transfer');
          header('Content-Type: '.mime_content_type($fileName));
          header('Content-Disposition: attachment; filename='.basename($fileName));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($fileName));
          readfile($fileName);
    }
  }
  shm_put_var($shmId, $var, $data);
  
?>
