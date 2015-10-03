<?php
class newsController extends AppController  {
	
	const NEWS_LIMIT = 20;
	
	function __construct() {
		parent::__construct();	
	}

	function index() {		
		$admin = self::$authHome->isAdminMode();
		
		/*
	 	if (SITE_THEME == 'default' && self::$template['type'] == 'index') {
			$output_params['last_news'] = self::$model->getList(0, 3, 0);
		}	
		*/
		if(!isset($paginatorObj)) $paginatorObj = new Paginator(self::$request, self::$db, "news", self::NEWS_LIMIT, $admin);
		$paginatorObj->setStyle(SITE_THEME);
		
		$count = $paginatorObj->getCountGlobal("WHERE is_published <> 0");
		$paginator = $paginatorObj->getPaginator(self::$request, "news", $count);

		$list = $paginatorObj->getListGlobal($paginator['index'], "date", "WHERE is_published <> 0");
		
		self::$view->setVars(array('list' => $list, 'paginator' => $paginator));
		self::$view->render('index');
	}
	
	function view() {		
		$id_new = self::$request->getValue('id_news');
		$new = self::$model->getNew($id_new);
		
		$latestNews = self::$model->getList(0, 7, 0);

		self::$view->setVars(array('new' => $new, 'latestNews' => $latestNews));
		self::$view->render('view');	
	}
	
	static function lastNews() {
		$fileName = self::$moduleHome->getTemp()."/lastNews.html";
		if(!is_file($fileName)){
			$last_news = self::$model->getList(0,3, 0);
		
			$file = serialize($last_news);
			file_put_contents($fileName, $file);
		} else {
			$file = file_get_contents($fileName);
			$last_news = unserialize($file);
		}
		
		self::$view->setVars('last_news', $last_news);
		$last_news = self::$view->render('last_news');
	}
	
	function edit() {
		if (!self::$authHome->isAdminMode()) {
			$new = self::$model->getNew(self::$request->getValue('id_news'));
		} else {
			echo 'У Вас недостаточно прав, для просмотра данной страницы!';
		}
		

		self::$view->setVars('new', $new);
		self::$view->render('edit');
	}
	
	function save() {
		if (self::$request->hasValue('is_published')) {
			$published = 1;
		} else {
			$published = 0;
		}
		$new = array('id'=>self::$request->getValue('id_news'),'title'=>self::$request->getValue('title'),'date'=> date('Y-m-d H:i:s',strtotime(self::$request->getValue('date'))),
				'annotation'=>self::$request->getValue('annotation'), 'image'=>'', 'text'=>self::$request->getValue('text'), 'is_published'=>$published,
				'id_template'=>1);
				
		self::$model->save($new);
		self::$request->headerLocation('news');
	}
	
	function delete() {
		self::$model->delete(self::$request->getValue('id_news'));
		self::$request->headerLocation('news');
	}
	
}
	
	 /*
	$admin = self::$authHome->isAdminMode();
	
	if ($admin && self::$request->hasValue('operation')) {		//выполняем операции
		//include ($modules_root.'news/src/admin/index.inc.php');
		
		$items_news = array('title'=>'','date'=>date("d-m-Y H:i:s"),'annotation'=>'', 'image'=>'', 'text'=>'', 'keywords'=>'', 'id_template'=>'');
		$operation = self::$request->getValue('operation');
		switch ($operation) {
			case "create":
				$new = $items_news;
			case "edit":
				if ($new) 
				{
					$uploadText = "
							<script type=\"text/javascript\">	
									function hideBtn(){
										$('#upload').hide();
										$('#res').html(\"Идет загрузка файла\");
									}
									
									function handleResponse(mes) {
										$('#upload').show();
									    if (mes.errors != null) {
									    	$('#res').html(\"Возникли ошибки во время загрузки файла: \" + mes.errors);
									    }	
									    else {
											var html = $('#res').html();
									    	$('#res').html(\"Файл \" + mes.name + \" загружен, его возможно включить в контент страницы используя url = /files/\" + mes.name + \".\");	
									    }	
									}
								</script>
								<form action=\"/files/upload.php\" method=\"post\" target=\"hiddenframe\" enctype=\"multipart/form-data\" onsubmit=\"hideBtn();\">
									  	<input type=\"file\" id=\"userfile\" name=\"userfile\"/>
										<button type=\"submit\" name=\"upload\" class=\"btn btn-success\"><i class=\"icon-download-alt icon-white\"></i>Загрузить</button>
								</form>
								<div id=\"res\"></div>
								<iframe id=\"hiddenframe\" name=\"hiddenframe\" style=\"width:0px; height:0px; border:0px\"></iframe>";
					
					echo $uploadText;
					
					$editNewText = "<!-- jQuery and jQuery UI -->
						<script src=\"/elrte/js/jquery-1.6.1.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
						<script src=\"/elrte/js/jquery-ui-1.8.13.custom.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
						<link rel=\"stylesheet\" href=\"/elrte/css/smoothness/jquery-ui-1.8.13.custom.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
						<!-- elRTE -->
							<script src=\"/elrte/js/elrte.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
							<link rel=\"stylesheet\" href=\"/elrte/css/elrte.min.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
				
							<!-- elRTE translation messages -->
							<script src=\"/elrte/js/i18n/elrte.ru.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
				
							<script type=\"text/javascript\" charset=\"utf-8\">
								$().ready(function() {
									var opts = {
										cssClass : 'el-rte',
										lang     : 'ru',
										height   : 450,
										toolbar  : 'complete',
										cssfiles : ['css/elrte-inner.css']
									}
									$('#text').elrte(opts);
								})
							</script>
				
							<style type=\"text/css\" media=\"screen\">
								body { padding:20px;}
							</style>
		
		
					<form accept-charset=\"UTF-8\" action=\"news?operation=save\" class=\"form-horizontal\" id=\"article\" method=\"POST\">";
					if (isset($new['id']))
						$checked = "";
						if ($new['is_published'] == 1) {
							$checked = " checked ";
						}
						$editNewText .=
								"<div hidden=\"hidden\">
									<input value=\"".$new['id']."\" class=\"input-xlarge\" name=\"id_news\" id=\"id_news\" readonly=\"true\">
								</div>";
						$editNewText .="
								<div class=\"control-group text optional\">
									<label for=\"date\">Дата создания:</label>
								        <div>
								             <input type=\"text\" value=\"".date('d-m-Y H:i:s',strtotime($new['date']))."\" class=\"input-xlarge\" name=\"date\" id=\"date\" readonly=\"true\">
								        </div>
								</div>
								<div class=\"control-group\">
									  	<label class=\"checkbox\" for=\"is_publish\"></label>
									<div>
	    									<input type=\"checkbox\" ".$checked."  name=\"is_published[]\" id=\"is_published\">  Опубликована
									</div>
								</div>
								<div class=\"control-group text optional\">
								<label class=\"text optional\" for=\"article_title\">Заголовок:</label>
								<div>
									<textarea required style=\"resize: none;\" class=\"text optional span6\" value='' id=\"title\" name=\"title\" rows=\"2\">".$new['title']."</textarea>
								</div>
								</div>
								<div class=\"control-group text optional\">
								<label class=\"text optional\" for=\"article_description\">Краткое описание:</label>
								<div>
									<textarea required style=\"resize: none;\" class=\"text optional span6\" value='' id=\"annotation\" name=\"annotation\" rows=\"3\">".$new['annotation']."</textarea>
								</div>
								</div>
								<div class=\"control-group text optional\">
								<label class=\"text optional\" for=\"editor\">Содержание: </label>
									<div required id=\"text\">
											".$new['text']."
									</div>
								    <div align=\"right\" class=\"form-actions\">
								           <button type=\"submit\" class=\"btn btn-success\"><i class=\"icon-ok icon-white\"></i>Сохранить</button>
											<a class=\"btn btn-danger\" href=\"news\">Отмена<i class=\"icon-share-alt icon-white\"></i></a>
								    </div>
								</div>
		
							</form>";
					//<button type=\"submit\" class=\"btn btn-success\"><i class=\"icon-check icon-white\"></i>Опубликовать</button>
					echo $editNewText;
				}
				break;
			case "save":
				if (self::$request->hasValue('is_published'))
					$published = 1;
				else
					$published = 0;
				$new = array('id'=>self::$request->getValue('id_news'),'title'=>self::$request->getValue('title'),'date'=> date('Y-m-d H:i:s',strtotime(self::$request->getValue('date'))),
						'annotation'=>self::$request->getValue('annotation'), 'image'=>'', 'text'=>self::$request->getValue('text'), 'is_published'=>$published,
						'id_template'=>1);
						
				self::$model->save($new);
				echo "<div id=\"modal-from-dom\" class=\"modal hide fade\">
						    <div class=\"modal-header\">
						      <a onclick=\"btnok()\" class=\"close\">&times;</a>
						      <h3>Сохранение</h3>
						    </div>
						    <div class=\"modal-body\" align=\"center\">
						      <p>Новость успешно сохранена!</p>
						    </div>
						    <div class=\"modal-footer\">
						      <a align=\"center\" onclick=\"btnok()\" class=\"btn btn-success\"><i class=\"icon-info-sign icon-white\"></i> Ну и отлично</a>
						    </div>
						</div>
							<script type=\"text/javascript\">
		    				    $('#modal-from-dom').modal({
							        backdrop: true
							    }).modal('show');
								function btnok() {
									$('#modal-from-dom').modal('hide');
									location.href = \"news\";
								}
						</script>";
				 //echo '<meta http-equiv="refresh" content="0; url=/news">';
				break;
			case "del":
				if ($new) {
					self::$model->delete($new['id']);
					echo "<div id=\"modal-from-dom\" class=\"modal hide fade\">
						    <div class=\"modal-header\">
						      <a onclick=\"btnok()\" class=\"close\">&times;</a>
						      <h3>Удаление</h3>
						    </div>
						    <div class=\"modal-body\" align=\"center\">
						      <p>Новость успешно удалена!</p>
						    </div>
						    <div class=\"modal-footer\">
						      <a align=\"center\" onclick=\"btnok()\" class=\"btn btn-success\"><i class=\"icon-info-sign icon-white\"></i> Ну и отлично</a>
						    </div>
						</div>
						<script type=\"text/javascript\">
		    				    $('#modal-from-dom').modal({
							        backdrop: true
							    }).modal('show');
								function btnok() {
									$('#modal-from-dom').modal('hide');
									location.href = \"news\";
								}
						</script>";
				}
				break;			
		}
		
	} else { //вывод списка или конкретной новости
		if ($new) { //вывод новости
			    $latestNews = self::$model->getList(0, 7, 2);
		} else { //вывод списка новостей
			$url = "?";
			if (self::$request->hasValue('id'))
				$url .=  "id=".self::$request->getValue('id')."&";
			
			$limit = 5;

			require_once(MODULES_ROOT."general/class/Paginator.class.php");
			if(!isset($paginatorObj)) $paginatorObj = new Paginator(self::$request, self::$db, "news", $limit, $admin);
			$paginatorObj->setStyle(SITE_THEME);
			
			$count = $paginatorObj->getCountGlobal("WHERE is_published<>0");
			$paginator = $paginatorObj->getPaginator(self::$request, "news", $count);
			
	
			$list = $paginatorObj->getListGlobal($paginator['index'], "date", "WHERE is_published<>0");


		}
		
		include (MODULES_ROOT.'news/view/view_ind_'.SITE_THEME.'.php');
	}
	*/
	