<?php
   $text = "";
   if(isset($_SESSION)&&isset($_SESSION['login'])){
     if($authHome->isAdminMode()){  ?>
       <a href='/modules/auth/logout'>Выход
     <? }else{ ?>
       <a href='/auth/logout.php'>Выход
     <? } ?>
     </a>
<?   }else{ ?>
   	<a href="#" type="button" data-toggle="modal" data-target="#myModal" class="" id="enter_option">Вход</a> 
   <? } ?>

	
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
   						<input id="esia" type="radio" value="2" name="enter_radio" class="enter_radio" />
   					</td>
   					<td>
   						<label>Через ЕСИА (Единая система идентификации и аутентификации)</label><br /><br />
   					</td>
   				</tr> 	
<?    				if (preg_match('/^(192.168){1}\.{1}\d{1,3}\.{1}\d{1,3}$/', $_SERVER['REMOTE_ADDR'])) { ?>
				<tr>
	   					<td>
	   						<input type="radio" value="3" name="enter_radio" class="enter_radio" />
	   					</td>
	   					<td>
	   						<label>Через УЭК</label><br /><br />
	   					</td>
	   				</tr>

				<? } ?>
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
		
	<script type="text/javascript" src="/scripts/js/auth.js"></script>
   		
