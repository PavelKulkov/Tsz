<?php 
  require_once($modules_root."map/class/Map.class.php");
  if(!isset($map)) $map = new Map($request, $db);
  
  $YandexMap = $map->getMap();
  
  include ($modules_root.'map/view/map.php');
  
?>