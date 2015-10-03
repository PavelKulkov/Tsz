<!DOCTYPE html>
<html lang="en">
<head>
	<!-- мета теги -->
	<meta charset="utf-8"/>
   {#area2} 
	
   
    <title>{#area1}</title>
    <!--
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="{#area2}"/>
    <meta name="keywords" content="{#area3}"/>
    <meta name="author" content="root"/>
    <meta name='yandex-verification' content='4c61f2e5494b5db2' />
	-->
	
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/templates/assets/css/bootstrap.css"/>
    <link href="/templates/assets/css/bootstrap-responsive.css" rel="stylesheet"/>
    <link href="/templates/assets/css/custom.css" rel="stylesheet"/>
    
        <!-- Javascript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/templates/assets/js/jquery.js"></script>
    <script src="/templates/assets/js/bootstrap.js"></script>
	<script src="/templates/assets/js/jquery.maskedinput.min.js"></script>
    
    <link href="/templates/assets/jquery_ui/jquery-ui-1.10.1.custom.css" rel="stylesheet"/>
	<script src="/templates/assets/jquery_ui/jquery-ui-1.10.2.custom.min.js"></script>
	<script type="text/javascript" src="/templates/newdesign/js/openapi.js"></script>
	<script src="/templates/assets/js/forms.js"></script>
	
    <script src="/templates/assets/mapper/mapper.js"></script>
    <!-- 
    <script src="/templates/assets/fckeditor/fckeditor.js"></script>
     -->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	
	
    <script type="text/javascript">
		$(document).ready(function(){	
			$('select[name=theme_select]').change(function(){
				$('input[name=theme_value]').val($(this).val());
				
				$('input[name=url_path]').val(window.location);
				
				$('form#change_theme_form').submit();
			});
		});
	</script>
	
	
</head>
<body>
      <div class="onTop">		       			 
	    <table width="100%" class="well">
		  <tr>
		  	<td style="padding-bottom: 17px; width: 80%;">
		  		<div style="float: right; height: 10px;">
				  	<form action="/" method="POST" id="change_theme_form">
					Тема: <input type="hidden" name="theme_value" />
					<input type="hidden" name="url_path" />
						<select name="theme_select">
							<option value="default">Основная</option>
							<option value="light" selected="selected">Облегченная</option>
						</select>
					</form>
		  		</div>
		  	</td> 
		    <td style="padding-top:10px; padding-bottom:10px;">
		      {#area14}
			</td>
		  </tr>
		</table>
      </div>
	  
	  <div class="header">
	    <table  width="100%">
		  <tr>
		    <td>
                <div class="logo">
                    <a href="\"><img src="/templates/assets/img/logo.png" alt="логотип" /></a>
                    <!--place for logo-->
                </div>
                <div class="span9">
                    <div class="page-header">
                        <h1>Региональный портал <br/><small>государственных и муниципальных услуг Пензенской области</small></h1>
                    </div>
                    <!--place for title also for some additional links-->
                </div>			  
			</td>
		  </tr>
		</table>
	  </div>
	  <div class="dataField">
	    <table id="mainArea">
		  <tr>
		    <td class="leftSideBar">
		      <div class="well" style="padding:0px;">
                        {#area51}
            	      </div>
                      <div style="width:100%;height:auto;">
                        {#area55}
                      </div>
                      <div id="leftMenu" class="well">
		       			 {#area53}
		       			 
		        	</div>
				<div class="well" id="stats">
					{#area666}
				</div>
		    </td>
		    <td style="vertical-align:top;">
			<div class="well" style="min-height:485px">
		         <noscript>
		        	<div class="control-group error">
			        	<span class="help-inline"><h4>
		 						Для полной функциональности этого сайта вам необходимо включить JavaScript!</h4>
		 						Вот список инструкций, которые могут помочь вам в решении данной проблемы:
		 						<ul>
		 							<li><a href="http://www.enable-javascript.com/ru/" target="_blank">Как включить JavaScript в вашем веб-браузере</a></li>
		 							<li><a href="http://www.homeenglish.ru/javascript.htm">Как включить javascript в разных браузерах</a></li>
		 							<li><a href="http://estate-in-kharkov.com/index.php?how-to-enable-javascript">Как включить JavaScript</a></li>
		 							<li><a href="http://help.rambler.ru/common/1203/?p=avia">Как включить Javascript в Opera 9 и выше?</a></li>
		 							<li><a href="http://www.superjob.ru/info/javascript.html">Как включить поддержку JavaScript</a></li>
		 						</ul>
		 						<hr/>
		 					</span>
	 					</div>
				</noscript>				
				  {#content}
				</div>
			</td>		
		  </tr>
		</table>
	  </div>
      <div class="footer-text footer-img" >

	    <i>ОАО "Оператор электронного правительства" 2012-2013</i>
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
      </div>

</body>
</html>
