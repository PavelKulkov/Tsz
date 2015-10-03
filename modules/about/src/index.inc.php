<?php
            require_once($modules_root."about/class/About.class.php");
          
            
            //TODO: Проверить админку
   			$about = new About($request, $db);
			$portal_info = $about->getInfo();
			$operation = $request->getValue('operation');
			switch ($operation) {
			case "edit":
			
				$text = "<script src=\"/elrte/js/jquery-1.6.1.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
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
							
							<form accept-charset=\"UTF-8\" action=\"/about?operation=save\" class=\"form-horizontal\" id=\"article\" method=\"POST\">
							<div class=\"control-group text optional\">
								<label class=\"text optional\" for=\"editor\">Содержание: </label>
									<div required id=\"text\">
											".$portal_info['content']."
									</div>
								    <div align=\"right\" class=\"form-actions\">
								           <button type=\"submit\" class=\"btn btn-success\"><i class=\"icon-ok icon-white\"></i>Сохранить</button>
											<a class=\"btn btn-danger\" href=\"/about\">Отмена<i class=\"icon-share-alt icon-white\"></i></a>
								    </div>
								</div>
							</form>";
			
				echo $text;
			case "save":
				$contact_info = array('id'=>$portal_info['id'],'content'=>$request->getValue('text'));
				$about->save($contact_info);
				
				echo "<div id=\"modal-from-dom\" class=\"modal hide fade\">
						    <div class=\"modal-header\">
						      <a onclick=\"btnok()\" class=\"close\">&times;</a>
						      <h3>Сохранение</h3>
						    </div>
						    <div class=\"modal-body\" align=\"center\">
						      <p>Данные успешно сохранены!</p>
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
									location.href = \"/about\";
								}
						</script>";
				 //echo '<meta http-equiv="refresh" content="0; url=/pages?action=about">';
				break;
			case "":

				include ($modules_root.'about/view/view_inc_'.SITE_THEME.'.php');

            	$admin = $authHome->isAdminMode();
			};
?>