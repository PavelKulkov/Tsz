<?php 

	$text = '
							<div class="rule"></div>
							<br />
							
							<script type="text/javascript">
								function closeApplet() { 
									p = $(".popup__overlay");
									p.css("display", "none");
								}
								function setCertificate(word) {
									document.getElementById("auth").value = word;
									document.forms["authForm"].submit();
								}
							</script>
						
						<style type="text/css">
							html {
						    min-height: 100%
						    }
						
						.popup__overlay {
						    display: none;
						    position: fixed;
						    left: 0;
						    top: 0;
						    width: 100%;
						    height: 100%;
						    background: rgba(0,0,0,.7);
						    text-align: center
						    }
						    .popup__overlay:after {
						        display: inline-block;
						        height: 100%;
						        width: 0;
						        vertical-align: middle;
						        content: ""
						    }
						.popup {
						    display: inline-block;
						    position: relative;
						    max-width: 80%;
						    padding: 20px;
						    border: 5px solid #fff;
						    border-radius: 15px;
						    box-shadow: inset 0 2px 2px 2px rgba(0,0,0,.4);
						    background: #F0FCFF;
						    vertical-align: middle
						    
						    }
						.popup-form__row {
						    margin: 1em 0
						    }
						label {
						    display: inline-block;
						    width: 120px;
						    text-align: left
						    }
						input[type="text"], input[type="password"] {
						    margin: 0;
						    padding: 2px;
						    border: 1px solid;
						    border-color: #999 #ccc #ccc;
						    border-radius: 2px
						    }
						.popup__close {
						    display: block;
						    position: absolute;
						    top: -20px;
						    right: 10px;
						    width: 12px;
						    height: 12px;
						    padding: 8px;
						    border: 5px solid #fff;
						    border-radius: 50%;
						    -webkit-box-shadow: inset 0 2px 2px 2px rgba(0,0,0,.4),
						                              0 3px 3px     rgba(0,0,0,.4);
						    box-shadow:         inset 0 2px 2px 2px rgba(0,0,0,.4),
						                              0 3px 3px     rgba(0,0,0,.4);
						    cursor: pointer;
						    background: #fff;
						    text-align: center;
						    font-size: 12px;
						    line-height: 12px;
						    color: #444;
						    text-decoration: none;
						    font-weight: bold
						    }
						    .popup__close:hover {
						        background: #ddd
						        }
							</style>
						    <script src="/templates/assets/js/jquery.js"></script>
							<script>
								$(document).ready(function()
								{
									p = $(".popup__overlay")
									$("#popup__toggle").click(function() {
										p.css("display", "block");
									})
									p.click(function(event) {
										e = event || window.event
										if (e.target == this) {
											$(p).css("display", "block")
										}
									})
									$(".popup__close").click(function() {
										p.css("display", "none")
									})
								});
							</script>
							<table width="80%">
							<tr>
							  <td width="400px" style="text-align:right;"><img src="/auth/key.jpg"/></td>
							  <td style="text-align:left;">Извините, данный функционал доступен только авторизированным пользователям. 
							                              Пожалуйста, осуществите вход на портал 
								<a class="btn btn-primary" href="#" type="button" data-toggle="modal" data-target="#myModal" id="enter_option">Вход</a>
							    
							    <p style="text-align:left">Также вы можите войти при помощи электронного сертификата <a class="btn btn-primary" id="popup__toggle" title="Войти в систему используя сертификат ЭЦП">Войти <i class="icon-certificate icon-white"></i></a></p>
							  </td>
							</tr>
							</table>
							<form name="authForm" hidden id="authForm" method="post" action="/auth/validateCertificate.php">
								<p><textarea type="text" name="auth" id="auth" style="visible:false"></textarea></p>
								<p><input type="hidden" name="return_to" id="return_to" value="'.$_SERVER['REQUEST_URI'].'"></p>
							</form>
							<div class="popup__overlay">
								<div class="popup" style="margin-top: 70px;">
									<a href="#" class="popup__close">X</a>
									<h2 style="color: #129FE0">Авторизация!</h2>
									<applet CODEBASE="/auth" code="com.oep.sign.SignerJApplet.class" WIDTH=320 HEIGHT=320 archive=auth.jar>
									<param name="MAYSCRIPT" value="TRUE">
									<param name="codebase_lookup" value="false">
									<H1>WARNING!</H1>
										The browser you are using is unable to load Java Applets!
									</applet>
								</div>
							</div>
	
		
				
				<script type="text/javascript">
				$(document).ready(function(){
			    	$("div#content_content").removeClass().addClass("content");
					$("div#content_center").removeClass().addClass("center");
					$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Авторизация");
					$("div#content_line").removeClass().addClass("blue_line");
				});
			</script>
				
				';

?>

