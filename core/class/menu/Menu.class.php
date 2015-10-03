<?php
class Menu {

	private $db_instance;
	private $request;
	private $lng_prefix;
	private $is_selected;
	private $is_selected_real;
	public $count;
	public $id_menu;
	private $list;
	public $items = array('id','name','description','id_page','id_parent','style','weight','url','id_user','id_group','rights','position','id_domen','is_new','color','lng');

	function __construct($request=NULL,$db) 	{
		$this->db_instance = $db;
		$this->db_instance->changeDB('regportal_cms');
		$this->lng_prefix = $GLOBALS["lng_prefix"];
		$this->request 	= $request;
		$this->list		= null;
		$this->id_menu 	= null;
	}
	
	public function getMenu($id_parent,$id_location) {
		$sql = "SELECT * FROM `menu` ".
			   " WHERE `id_parent`= ? AND `id_location`= ? ";
		
		$main_menu = $this->db_instance->select($sql, $id_parent, $id_location);
		
		
		
		$sql = "SELECT * FROM `menu` ".
			   " WHERE `id_parent` <> 0";
		$submenu = $this->db_instance->select($sql);
		
		
		for ($i=0; $i < count($main_menu); $i++) {
			foreach ($submenu as $sub) {
				if ($main_menu[$i]['id'] == $sub['id_parent']) {
					$main_menu[$i]['submenu'][] = $sub;
				} 
			}
			
		}

		return $main_menu;
		
	}
	
	
	public function getAllMenus() {
		$sql = <<<SQL
SELECT m.*, mn.name AS sub_menu, module_location.id_template 
FROM `menu` m 
LEFT JOIN menu mn ON m.`id_parent` = mn.`id`
LEFT JOIN `module_location` ON m.id_location=module_location.id
SQL;
			
		$main_menu = $this->db_instance->select($sql);

		return $main_menu;	
	}
	
	
	public function findTemplateDescription($list,$id){
	  foreach($list as $entry){
	    if($entry["id"]==$id){
	      return $entry['description'];	
	    }	
	  }
	  return false;	
	}
	
	
	public function asModuleList($id_template){
		$sql = "SELECT m.id_location 
		        FROM `menu` m,`module_location` ml 
		        WHERE ml.id_template=? AND ml.id=m.id_location AND ml.id_locationType=?
		        GROUP BY m.id_location";
		$list = $this->db_instance->select($sql, $id_template, 1);
		$result = array('menu'=>$list);
		echo json_encode($result);
		exit();
		
	}
	
	
	public function getMenuItemsByLocation($id_location){
	  $sql = "SELECT m.*
	          FROM `menu` m
	          WHERE m.id_location = ?";
	  
	  $items = $this->db_instance->select($sql, $id_location);
	  $result = array('items'=>$items);
	  echo json_encode($result);
	  exit();	  
	}
		
	public function getMenuByTpl ($id_template, $list) {
				
		$sql = <<<SQL
SELECT m.*, mn.name AS sub_menu, module_location.id_template
FROM `menu` m
LEFT JOIN menu mn ON m.`id_parent` = mn.`id`
LEFT JOIN `module_location` ON m.id_location=module_location.id
WHERE id_template = ? AND id_locationType = ?
ORDER BY weight ASC	
SQL;

		if ($id_template == 0 || $id_template == '') {
			$menu = $this->getAllMenus();
		} else {
			$menu = $this->db_instance->select($sql, $id_template, 1);
		}
		
		for ($i=0; $i<count($menu); $i++) {
			if ($menu[$i]['descr'] == '' || $menu[$i]['descr'] == NULL) {
				$menu[$i]['descr'] = 'Описание отсутствует';
			}
			if(isset($menu[$i]['id_template'])){
				$template_id = $menu[$i]['id_template'];
				$descr = $this->findTemplateDescription($list,$template_id);
				if(isset($descr)){
					$menu[$i]['template']=  $descr;
				}
			}			
		}
		
		
		if ($menu) {
    		$result = array('menu'=>$menu); 
		} else {
    		$result = array('type'=>'error');
		}
		
 		echo json_encode($result);
 		exit();
	}
	
	
	public function save() {
		$name_menu = $_POST['name_menu'];
		$descr = $_POST['descr'];
		$url = $_POST['module_url'];
		$weight = $_POST['weight'];		
		$sub_menu = ($_POST['sub_menu'] != '') ? $_POST['sub_menu'] : 0;

		if (isset($_POST['id_menu']) && $_POST['id_menu'] != '') {
			$id_menu = $_POST['id_menu'];
			$sql = "UPDATE `menu` SET `name`= ?,`descr`= ?, `id_parent`= ?, `weight`= ?, `url`= ? WHERE `id`= ?";
			
			$info = $this->db_instance->update($sql, $name_menu, $descr, $sub_menu, $weight, $url, $id_menu);
		} else {
			$id_template = $_POST['id_template'];
			$id_location = $_POST['id_module'];
		
			$sql = "INSERT INTO `menu` (`name`,`descr`, `id_parent`, `weight`, `url`, `id_location`) VALUES ( ?, ?, ?, ?, ? , ?)";

			$info = $this->db_instance->insert($sql, $name_menu, $descr, $sub_menu, $weight, $url, $id_location);
		}
		
		return $info['insert_id'];	
	}

	
	public function edit(){	
		$sql = "SELECT menu.*,module_location.id_template FROM `menu` LEFT JOIN `module_location` ON menu.id_location=module_location.id WHERE menu.id = ?";
		$menu = $this->db_instance->selectRow($sql, $_POST['check_value'][0]);

		$sub_menu = $this->db_instance->select('SELECT * FROM `menu` WHERE id_parent = 0 AND id_location = ?', $menu['id_location'] );
		$menu['sub_menu'] = $sub_menu;

		return $menu;
	}

	
	public function delete() {
		$chk_values = '';
		foreach ($_POST['check_value'] as $value) {
			$chk_values .= $value.',';
		}		
		$chk_values = substr($chk_values, 0, strlen($chk_values)-1) ;	
		
		$sql = "DELETE FROM `menu` WHERE id IN (%s)";

		$this->db_instance->delete($sql, $_POST['check_value']);	
	}
}