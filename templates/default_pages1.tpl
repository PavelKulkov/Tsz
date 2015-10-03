<!DOCTYPE HTML>
<html>
<head>
  <!-- мета теги -->
   {#area2} 
    
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
			<!-- это левое меню. его не будет..но можно сделать как floatMenu	{#area53} -->
				<!-- 
				<li class="bg1"><a href="/blank.html">О проекте</a></li>
				<li class="bg1"><a href="/news.html">Новости</a></li>
				<li class="bg1"><a href="/blank.html">Контакты</a></li>
				<li class="bg2"><a href="/blank.html">Частые вопросы</a></li>
				<li><a href="">Партнёры</a></li>
				 -->
				
				
				<!-- menu & Login stuff -->
				{#area14}
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
				{#area51}
				{#area55}
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
		
		{#area668}
	</div>
	
	<div class="cl"></div>

	<div class="content" id="content_content">
		<div class="center" id="content_center">
			<div class="marg_center">
				<div class="navigation" id="content_navigation"><a href="/">Главная</a></div>
				<div class="blue_line " id="content_line"></div>
					{#content}	 
			</div>			
		</div>
	</div>
	
	
	<div class="footer">
		<div class="center">
			<div class="copyright">&copy; Региональный портал государственных и муниципальных услуг Пензенской области 2013. Все права защищены
				
				<br><br><a href="/offer.html" target="_blank" style="color: #767676;">Оферта на оказание платных услуг</a>
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
				{#area666}
			</div>
			<div class="cl"></div>
		</div>
	</div> 
</body>
</html>
