<?php
    function getMasImages($obj){
		$mas = explode(",", $obj);
		$text = '';
		
		for($i = 0; $i < count($mas); $i++){
			$text .= '<img src="/templates/images/news/'.$mas[$i].'.png">';
		}
		
		
		return $text;
	}
	
    $text = '<style>
	#select_5 a{
		border-bottom: 7px solid #fd8505;
	}
	</style>
	<div class="pageNavigation">
                 <p><a href="\">Главная</a> -> <a href="news">Новости</a> -> '.$new['title'].'</p>
            </div>
	';
	

    $text .= '<div class="news">
          <div class="openNews">
              <p class="newsContentData">'.date('d.m.Y H:i',strtotime($new['date'])).'</p>
              <p class="newsContentTitle">'.$new['title'].'</p>
              <p class="openNewsText">'.$new['text'].'
              </p>
         
              <div class="openNewsImages">';
			 $text .= getMasImages($new['image']);
                  /*<img src="/templates/images/news/openNews/'.$new['image'].'.png">
                  <img src="images/openNews_2.png">*/
              $text .='</div>
              <a href="news">Ко всем новостям</a>
          </div>
      </div>';



/*
		$text .= '	
					<style>
						div#news_div ul li {
						margin-left: 20px;
						}
					</style>
					<div class="rule"></div>
					<h3 class="title_blank">'.$new['title'].'</h3>
					<img src="/files/imageForNews/'.$new['image'].'">
					<div id="news_div">'.$new['text'].'</div>
												
					<script type="text/javascript">
						$(document).ready(function(){
					    	$("div#content_content").removeClass().addClass("content");
							$("div#content_center").removeClass().addClass("center");
							$("div#content_navigation").html("<a href=\"/\">Главная</a>  / <a href=\"/news\">Новости</a> / '.$new['title'].'");
							$("div#content_line").removeClass().addClass("blue_line");
						});
					</script>
					
					
					
					<!-- Лайки -->
					<!-- facebook -->
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, "script", "facebook-jssdk"));</script>
					
					<div style="float: left; margin-right: 10px;" class="fb-like" data-href="https://uslugi.pnzreg.ru/news?id_news='.$new['id'].'" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="light" data-layout="box_count" data-action="like" data-show-faces="false" data-send="false"></div>
					

					
					<!-- odnoklassniki 
					<div id="ok_shareWidget" style="float: left; margin-right: 10px;"></div>
					<script>
					!function (d, id, did, st) {
					  var js = d.createElement("script");
					  js.src = "http://connect.ok.ru/connect.js";
					  js.onload = js.onreadystatechange = function () {
					  if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
					    if (!this.executed) {
					      this.executed = true;
					      setTimeout(function () {
					        OK.CONNECT.insertShareWidget(id,did,st);
					      }, 0);
					    }
					  }};
					  d.documentElement.appendChild(js);
					}(document,"ok_shareWidget","https://uslugi.pnzreg.ru/news?id_news='.$new['id'].'","{width:95,height:65,st:\"rounded\",sz:20,ck:3,vt: \"1\"}");
					</script>
					-->					
					
					<!-- Мой мир (mail.ru) 
					<div id="my_world" style="float: left; width: 92px;">
					<a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share" data-mrc-config="{\'cm\' : \'1\', \'sz\' : \'20\', \'st\' : \'1\', \'tp\' : \'mm\', \'vt\' : \'1\'}">Нравится</a>

					<script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
					</div>
					-->
					
					
				
					
					<!-- google+ -->

					<div style="float: left; margin-right: 10px; margin-top: 1px;"><div class="g-plusone" data-size="tall"></div></div>
					<script type="text/javascript">
					  window.___gcfg = {lang: "ru"};
					
					  (function() {
					    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
					    po.src = "https://apis.google.com/js/plusone.js";
					    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script>
					
					
					<!-- vkontakte -->
					<script type="text/javascript">
					  VK.init({apiId: 3927437, onlyWidgets: true});
					</script>
					
					<!-- Для теста апи 3927444 -->
					<!-- Для реалки апи 3927437 -->
					
					<!-- Put this div tag to the place, where the Like block will be -->
					<div style="float: left; width: 141px; padding-top: 40px;"><div id="vk_like"></div></div>
					<script type="text/javascript">
					VK.Widgets.Like("vk_like", {type: "button", height: 20});
					</script>
					
					
					
					<!-- twitter -->
					';
					
$twitter = <<<TEXT
<div style="padding-top: 40px;">
<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://uslugi.pnzreg.ru/news?id_news={$new['id']}" data-text="Мне нравится" data-lang="ru" data-hashtags="uslugi">Твитнуть</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>
TEXT;
*/
		$text .= $twitter;	
