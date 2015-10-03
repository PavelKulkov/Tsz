<!DOCTYPE HTML>
<html>
<head>
  <!-- мета теги -->
   <meta charset="utf-8"><meta name="description" content=""/> 
    <title>Популярные услуги</title>
    <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="/templates/newdesign/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/templates/newdesign/css/site.css">
	<link rel="stylesheet" type="text/css" href="/templates/newdesign/css/custom.css">
	<!-- Javascript
        ================================================== -->
        <!-- 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		 -->
	<script src="/templates/assets/js/jquery.js"></script>
	<script type="text/javascript" src="/templates/newdesign/js/bootstrap.js"></script>
	
	<script src="/templates/assets/js/jquery.maskedinput.min.js"></script>
    
    <link href="/templates/assets/jquery_ui/jquery-ui-1.10.1.custom.css" rel="stylesheet"/>
	<script src="/templates/assets/jquery_ui/jquery-ui-1.10.2.custom.min.js"></script>
	
	<script type="text/javascript" src="/templates/newdesign/js/user.js"></script>
	<script type="text/javascript" src="/templates/newdesign/js/jcarousellite.js"></script>

	<script src="/templates/assets/js/forms.js"></script>
	<script type="text/javascript" src="/templates/newdesign/js/openapi.js"></script>
	<script type="text/javascript">
	
	
	
	
		$(document).ready(function(){	
			$('select[name=theme_select]').change(function(){
				$('input[name=theme_value]').val($(this).val());
				 
				$('input[name=url_path]').val(window.location);
				
				$('form#change_theme_form').submit();
			});

			$.ajax({
				type: "POST",
			  	url: '/scripts/ajax.php?module_name=pages&operation=serviceCategories',
			  	dataType: "json",
			  	success: function(data) {
				  	var phys_data = '';
				  	var juri_data = '';
					var phys_count = data.categories.phys.length;
					var juri_count = data.categories.juri.length;
					var count = 0;
					for (var i = 0; i < phys_count; i++){

						if(count % 3 == 0) {
							phys_data +='<tr>';
					    }
						phys_data +='<td>' +
										'<div class="fiz"><a href="/services?service_categories=' + data.categories.phys[i].id + '"><img src="' + data.categories.phys[i].image + '" alt="" title=""></a></div>' +
										'<div class="fiz_txt"><a href="/services?service_categories=' + data.categories.phys[i].id + '">' + data.categories.phys[i].category + '</a></div>' +
									'</td>';
					    if (count % 3 == 2) {
					    	phys_data +='</tr>';
					    }
					    count++;
					}
					
					$('table.tiz_fiz').html(phys_data);

					count = 0;
					for (i = 0; i < juri_count; i++){

						if(count % 2 == 0) {
							juri_data +='<tr>';
					    }
						juri_data +='<td>' +
										'<div class="fiz"><a href="/services?service_categories=' + data.categories.juri[i].id + '"><img src="' + data.categories.juri[i].image + '" alt="" title=""></a></div>' +
										'<div class="fiz_txt"><a href="/services?service_categories=' + data.categories.juri[i].id + '">' + data.categories.juri[i].category + '</a></div>' +
									'</td>';
					    if (count % 3 == 1) {
					    	juri_data +='</tr>';
					    }
					    count++;
					}
					
					$('table.tiz_jur').html(juri_data);
			  	}
			});
			
			
		});

	</script>
</head>
<body id="blank" style="zoom: 1;">
	<div class="header">
		<div class="center">
			 <!-- top menu -->
			<!--  <ul class="top_menu"> -->
			<!-- это левое меню. его не будет..но можно сделать как floatMenu	 -->
				<!-- 
				<li class="bg1"><a href="/blank.html">О проекте</a></li>
				<li class="bg1"><a href="/news.html">Новости</a></li>
				<li class="bg1"><a href="/blank.html">Контакты</a></li>
				<li class="bg2"><a href="/blank.html">Частые вопросы</a></li>
				<li><a href="">Партнёры</a></li>
				 -->
				
				
				<!-- menu & Login stuff -->
				<ul class="top_menu"><li class="bg1"><a href="/">Главная</a></li><li class="bg1"><a href="/news">Новости</a></li><li class="bg1"><a href="about">Контакты</a></li><li class="bg2"><a href="http://faq.oep-penza.ru/">Частые вопросы</a></li><li class="bg3"><a href="/banners">Партнёры</a></li><li class=""><a href="/feedback">Обращение граждан</a></li></ul><div class="enter" >   	<a href="#" type="button" data-toggle="modal" data-target="#myModal" class="" id="enter_option">Вход</a> 
   
	
	<link href="styles/style.css" rel="stylesheet">    
   		
	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
	    	<h3 id="myModalLabel">Авторизация</h3>
	  	</div>
   		<div class="error_msg"></div>
	 	<div class="modal-body">
			<table>
				<tr style="display:none;">
   					<td>
   						<input type="radio" value="0" name="enter_radio" class="enter_radio" />
   					</td>
   					<td>
   						<label>По номеру телефона (При sms-регистрации портал доступен с ограниченным функционалом)</label><br />
   						(Ваш номер телефона будет идентифицировать Вас при получении государственных услуг) <br /><br />
   					</td>
   				</tr>
   				<tr>
   					<td>
   						<input type="radio" value="2" name="enter_radio" class="enter_radio" />
   					</td>
   					<td>
   						<label>Через ЕСИА (Единая система идентификации и аутентификации)</label><br /><br />
   					</td>
   				</tr> 	
				<tr>
	   					<td>
	   						<input type="radio" value="3" name="enter_radio" class="enter_radio" />
	   					</td>
	   					<td>
	   						<label>Через УЭК</label><br /><br />
	   					</td>
	   				</tr>

				</table>
   		
   			<div id="enter_form" >
   				<div style="width: 114px; float: left;">Введите телефон (<b>БЕЗ ведущей 8 </b>): </div><div><input type="text" name="phone" id="phone" placeholder="9273217788" maxlength="10" required="required" /></div>
   				<div style="clear: both;"></div>
   				<div id="submitINN" >Введите ИНН: &nbsp &nbsp &nbsp&nbsp<input type="text" name="INN" required="required" /></div>
   				<div id="passExitsDiv" >Уже есть пароль: &nbsp <input type="checkbox" id="passExists"  /></div>
   				<div id="submitPass" >Введите пароль: &nbsp <input type="password" name="password" id="password" required="required" /></div>   				
   				<div id="submitPassBtn"><input type="button" value="Выслать пароль" id="sendPassBtn" /></div>
   			</div>
		</div>
		<div class="modal-footer">
   			<button class="btn btn-primary" data-target="#myModal" id="enter_btn">Войти</button>
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
	  	</div>
	</div> 
		
	<script type="text/javascript" src="/modules/auth/scripts/auth.js"></script>
   		
</div>
			<!-- </ul> -->
			<!-- 
			<div class="enter"><a href="#" class="hider" >Вход</a></div>
			
			 -->
		</div>
		
		<div id="theme_block">
			<form action="/" method="POST" id="change_theme_form">
				Тема: <input type="hidden" name="theme_value" />
					<input type="hidden" name="url_path" />
				<select name="theme_select">
					<option value="default" selected="selected">Основная</option>
					<option value="light">Облегченная</option>
				</select>
			</form>	 
		</div>
	</div>
	
	<div class="cl"></div>
	<!-- category -->
	<div class="category">
		<div class="top_block">
			<div class="logo"><a href="/"><img src="/templates/newdesign/images/logo.png" alt="" title="" ></a></div>
			<div class="logo_txt"><a href="/">Региональный портал <br/> государственных и муниципальных услуг <br/>Пензенской области</a></div>
			<div class="search">
			<!-- поиск -->
				<form id="search-block-form" class="form-search" action="/search?is_news=true&is_service=true&is_organisation=true" method = "GET" onsubmit="if(getElementById('search_string').value=='') {alert('Поле поиска не может быть пустым!'); return false; }">	<div class="form-item">
					<input type="text" name="search_string" value="" placeholder="Поиск"  size="45" maxlength="100" class="search-query"  id="search_string" />
				</div>
				<div class="form-actions">		<div style="display: none;">
						<label class="checkbox"><input type="checkbox" name="is_news" checked> Новости </label>
						<label class="checkbox"><input type="checkbox" name="is_service" checked> Услуги </label>
						<label class="checkbox"><input type="checkbox" name="is_organisation" checked> Организации </label>
					</div>
				</div>
			</form>
				
			</div>
			<div class="cl"></div>
		</div>
		<div style="margin-left:9px;">
			<div class="menu_fiz"><a href="" class="hider_fiz">Физическим лицам</a>
				<div class="submenu_fiz_blank" id="hidden_fiz">
					<div class="menu_block">
						<table class="tiz_fiz"></table>
					</div>
				</div>
			</div>
		</div>
		<div class="menu_jur"><a href="" class="hider_tov">Юридическим лицам</a>
			<div class="submenu_jur_blank" id="hidden_jur">
				<div class="menu_block">
					<table class="tiz_jur"></table>
				</div>
			</div>
		</div>
		<div class="menu_org"><a href="/organisations">Ведомства и организации</a></div>
		 <div class="cl"></div>
		
		
	</div>
	
	<div class="cl"></div>

	<div class="content" id="content_content">
		<div class="center" id="content_center">
			<div class="marg_center">
				<div class="navigation" id="content_navigation"><a href="/">Главная</a></div>
				<div class="blue_line " id="content_line"></div>
					

	
					<style>
						div#news_div ul li {
						margin-left: 20px;
						}
					</style>
					<div class="rule"></div>
					<h3 class="title_blank">Популярные услуги</h3>
					<div id="news_div">
					

					
					<link href="/templates/assets/select2-3.5.1/select2.css" rel="stylesheet"/>
					<script src="/templates/assets/select2-3.5.1/select2.js"></script>

					
					<script type="text/javascript">


						function setSelect2(selector) {
							selector.each(function() {
								var value = $(this).attr('value');
								$(this).val(value);
								var option = $(this).find("option[value='" + value + "']");
								if (option.length > 0)
									option.attr("selected", "selected");
								if ($(this).attr("disabled")) {
									$(this).hide();
									var text = $(this).find("option:selected").text();
									$(this).before('<span>' + text + '</span>');
								} else {
									if ($.fn.select2 != undefined)
										$(this).select2();
								}
							});
						}
						
						
						$(document).ready(function(){
							
						
							$.ajax({

								type: "GET",
								async: false,
								url: "/scripts/ajax.php?module_name=webservice&name=getActiveServices",
								success: function(data) {
									$(".listOfServices").html(data);
									
									$(".listOfServicesSelected").each(function() {
										$(this).closest("table").find(".listOfServices option[value="+ $(this).val() +"]:first").attr("selected", true);
									});
									
								}

							});
		

							$(document).on("keyup change", ".title", function() {
								$(this).closest("table").find(".icon_title").text($(this).val());
							});

							$(document).on("keyup change", ".shortNameService", function() {
								$(this).closest("table").find(".icon_short_name_service").text($(this).val());
							});
							
							
							$(document).on("click", ".selectIcon", function() {
								$(".activePosition").val($(this).closest("table").attr("id"));
								$("#modalIcons").modal("show");
							});

							
							$(document).on("click", ".preview", function() {
								$("#"+ $(".activePosition").val() +"").find(".urlImageService").val($(this).attr("id"));
								$("#"+ $(".activePosition").val() +"").find(".icon").attr("src", "icons/" + $(this).attr("id"));
								$("#modalIcons").modal("hide");
								$(".activePosition").val("");
							});
							
						});						
						
						
						

					</script>
	

					
					<div class="modal" id="modalIcons" style="display: none; width: 77%; top: 5%; left: 30%; margin-top: 0px;" tabindex="-1" role="dialog" aria-labelledby="modalIcons" aria-hidden="true">
					   <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						  <h3>Выбор иконки</h3>
					   </div>
					   <div class="modal-body" style="text-valign: top; max-height: 800px">

 
						<?php
						
							if ($handle = opendir('icons')) {

								while (false !== ($entry = readdir($handle))) {
									if ($entry != "." && $entry != "..") {
										echo "<img class='preview' id='".$entry."' style='padding: 10px; cursor: pointer;' src='icons/".$entry."'>";
									}
								}

								closedir($handle);
							} 
						
						?> 
						
					   </div>
					   <div class="modal-footer">
					   </div>
					</div>

	
					<form method="POST" action="index.php">

					<?php

					header('Content-Type: text/html; charset=utf-8');
										
					if (isset($_POST['submit'])) {
						
						do { 
							
							$i++;
							
							$data_serialize = array("service_id" => "".$_POST['listOfServices_'.$i.'']."", "title" => "".$_POST['title_'.$i.'']."", "short_name_service" => "".$_POST['shortNameService_'.$i.'']."", "url_image_service" => "".$_POST['urlImageService_'.$i.'']."");
							
							file_put_contents("files/serialize_".$i.".txt", serialize($data_serialize));
							

						} while ($i < 12);
						

						echo "
						
						<h3 style='color: green;' align='center'>Изменения успешно сохранены!</h3>
						
						<script type='text/javascript'>

							$(document).ready(function(){
								window.setTimeout(\"location=('/modules/editServices/index.php');\",3000);
							});
							
						</script>

						";
						
					 
					} else { 
					
						do {
							
							$i++;
							
							//$data_serialize = array("service_id" => "1254", "title" => "ЗАГЗ", "short_name_service" => "Оплатить госпошлину", "url_image_service" => "img_1.jpg");
							
							$data_unserialize = unserialize(file_get_contents("files/serialize_".$i.".txt"));
													
							echo '

							
						<script type="text/javascript">

							$(document).ready(function(){
								setSelect2($("#listOfServices_'.$i.'"));
								$(".btn-info").show();
							});
							
						</script>
							
							<table cellspacing="0" cellpadding="10" border="0" align="center" style="margin-top: 20px; background-color: lavender; border-radius: 5px; border-collapse: none;" id="position_'.$i.'">
								<tbody>
									<tr>
									   <td width="300" valign="top" align="right"><h3>Позиция '.$i.'</h3></td>
									   <td width="530" valign="top" align="left"></td>
									</tr>
									<tr>
									   <td width="300" valign="top" align="right">Услуга</td>
									   <td width="530" valign="top" align="left">
									   <input class="listOfServicesSelected" value="'.$data_unserialize['service_id'].'" type="hidden">
										<select id="listOfServices_'.$i.'" class="listOfServices" name="listOfServices_'.$i.'"></select>
									  </td>
									</tr>
									<tr>
									   <td width="300" valign="top" align="right">Заголовок</td>
									   <td width="530" valign="top" align="left"><input style="width: 495px;" maxlength="17" class="title" name="title_'.$i.'" value="'.$data_unserialize['title'].'"></td>
									</tr>
									<tr>
									   <td width="300" valign="top" align="right">Краткое наименование</td>
									   <td width="530" valign="top" align="left"><input style="width: 495px;" maxlength="70" class="shortNameService" name="shortNameService_'.$i.'" value="'.$data_unserialize['short_name_service'].'"></td>
									</tr>
									<tr>
									   <td width="300" valign="top" align="right">
											<div class="icons_block">
												<a href="../services?service_id='.$data_unserialize['service_id'].'"><img class="icon" src="icons/'.$data_unserialize['url_image_service'].'"></a>
												<div class="icon_title"><a href="../services?service_id='.$data_unserialize['service_id'].'">'.$data_unserialize['title'].'</a></div>
												<div class="icon_short_name_service"><a href="../services?service_id='.$data_unserialize['service_id'].'">'.$data_unserialize['short_name_service'].'</a></div>
											</div>

											
									   </td>
									   <td width="530" valign="top" align="left">
											<input name="urlImageService_'.$i.'" class="urlImageService" value="'.$data_unserialize['url_image_service'].'" type="hidden">
											<input type="button" class="selectIcon" value="Выбрать иконку">
									   </td>
									</tr>
								</tbody>
							</table>
													
							';
						
						
							
						} while ($i < 12);

					}


					?>
					
					<div align="center" style="padding-top: 60px;">
						<input type="hidden" class="activePosition" value="">
						<input type="submit"  style="display: none;" class="btn btn-info" name="submit" value="Сохранить изменения">
					</div>
					
					</form>

					</div></div>
												
					<script type="text/javascript">
						$(document).ready(function(){
					    	$("div#content_content").removeClass().addClass("content");
							$("div#content_center").removeClass().addClass("center");
							$("div#content_navigation").html("Популярные услуги");
							$("div#content_line").removeClass().addClass("blue_line");
						});
					</script>

			</div>			
		</div>
	</div>
	
	
	<div class="footer">
		<div class="center">
			<div class="copyright">&copy; Региональный портал государственных и муниципальных услуг Пензенской области 2013. Все права защищены
				<div class="studio"><a href="http://www.hosting-online.ru/" target="_blank"><img src="/templates/newdesign/images/studio.gif" alt="Веб-студия Пенза-онлайн" title="Веб-студия Пенза-онлайн"></a>
					<span style="margin-left: 30px;">
					<!-- Yandex.Metrika informer -->
					<a href="http://metrika.yandex.ru/stat/?id=21070690&amp;from=informer"
					target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/21070690/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
					style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:21070690,lang:'ru'});return false}catch(e){}"/></a>
					<!-- /Yandex.Metrika informer -->
					
					<!-- Yandex.Metrika counter -->
					<script type="text/javascript">
					(function (d, w, c) {
					    (w[c] = w[c] || []).push(function() {
					        try {
					            w.yaCounter21070690 = new Ya.Metrika({id:21070690,
					                    webvisor:true,
					                    clickmap:true,
					                    trackLinks:true,
					                    accurateTrackBounce:true});
					        } catch(e) { }
					    });
					
					    var n = d.getElementsByTagName("script")[0],
					        s = d.createElement("script"),
					        f = function () { n.parentNode.insertBefore(s, n); };
					    s.type = "text/javascript";
					    s.async = true;
					    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
					
					    if (w.opera == "[object Opera]") {
					        d.addEventListener("DOMContentLoaded", f, false);
					    } else { f(); }
					})(document, window, "yandex_metrika_callbacks");
					</script>
					<noscript><div><img src="//mc.yandex.ru/watch/21070690" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
					<!-- /Yandex.Metrika counter -->
					</span>
				</div>
			</div>
			<div class="statistic_block">
					<div class="in_site">Сейчас на сайте</div>
			<div class="sum">
				<div class="all"> всего 1116</div>
				<div class="disposal">
					<div class="disposal_num">1116</div>
					<div class="disposal_txt">услуги</div>
				</div>
				<div class="in_detail" align="center">
					<table class="detail_num">
					<!--
						<tr>
							<td class="violet">0</td>
							<td>федеральных</td>
							
						</tr>
					-->							
						<tr>
							<td class="violet">245</td>
							<td>региональных</td>
							
						</tr>							
						<tr>
							<td class="violet">871</td>
							<td>муниципальных</td>
							
						</tr>
					</table>
				</div>
				<div class="function">
					<div class="function_num">221</div>
					<div class="function_txt">в эл.виде</div>
				</div>
				<div class="cl"></div>
			</div>
			<div class="also">, также:</div>
			<div class="orgdoc_block">
				<div class="block_bg">
					<div class="bg_organization">799</div>
					<div class="block_txt">организаций</div>
				</div>
				<div class="block_bg">
					<div class="bg_doc">941</div>
					<div class="block_txt">документов</div>
				</div>
			</div>
			</div>
			<div class="cl"></div>
		</div>
	</div> 
</body>
</html>
