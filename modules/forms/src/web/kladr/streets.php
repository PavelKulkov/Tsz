<?php 

$db->changeDB("kladr");


$query = "SELECT `CODE` FROM `locations` WHERE MATCH(NAME) AGAINST(?) AND (SOCR='г' OR SOCR='р-н')";
$code=$db->selectCell($query,$_GET['district']);

	$query = "

	SELECT s.*,l.name, l.SOCR location_socr
	FROM `streets` s, locations l
	WHERE MATCH(s.NAME) AGAINST(? IN BOOLEAN MODE) and l.code=CONCAT(SUBSTRING(s.code,1,11),'00')";
	$streets=$db->select($query,$_GET['street'] = $_GET['street']."*");

    $list = array();
	
	foreach ($streets as $key) {
	
	$list[$key['id']]=array($key['NAME'],
				            $key['SOCR'],
							$key['CODE'],
							$key['name'],
							$key['location_socr']);
	
	}

	$db->revertDB();

	
?>





<?php 

/*

$db->changeDB("kladr");


$query = "SELECT `CODE` FROM `locations` WHERE MATCH(NAME) AGAINST(?) AND (SOCR='г' OR SOCR='р-н')";
$code=$db->selectCell($query,$_GET['district']);

$query = "SELECT * FROM `streets`, WHERE MATCH(NAME) AGAINST(?) AND CODE LIKE (?)";
$streets=$db->select($query,$_GET['street'], $code = preg_replace("/0+$/i","",$code)."%");



SELECT s.*,l.name
FROM `streets` s, locations l
WHERE MATCH(s.NAME) AGAINST("Чехова") and l.code=CONCAT(SUBSTRING(s.code,1,8),"00000")


    $list = array();
	
	foreach ($streets as $key) {

	$query = "SELECT NAME, SOCR FROM locations WHERE CODE LIKE (?)";
	$location=$db->selectCell($query, $code = substr($key['CODE'],0,-5)."%");
	
	$list[$key['id']]=array($key['NAME'],
				            $key['SOCR'],
							$key['CODE'],
							$location);
	
	}

$db->revertDB();



*/

?>



