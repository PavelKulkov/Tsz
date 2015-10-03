<?php
if(isset($error_message)) {
	echo '<span class="error_msg">'.$error_message.'</span>';
}
if(isset($success_message)) {
	echo '<span class="success_msg">'.$success_message.'</span>';
}
		


require_once("core/lib/captcha/recaptchalib.php");


// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6LcywNoSAAAAAHELcbDntqcfQc7VB6RFrO_2PiJM";
$privatekey = "6LcywNoSAAAAAFEVTLel7jOGRqftxrWkgAqOCHvj";
	
$text = '	<style>
				form#feedback-form input#fio, form#feedback-form input#contacts {
					width: 23em;
				}
				
				form#feedback-form textarea {
					resize: none;
					width: 22.4em;
					height: 25em;
				}
				
				.mark {
					color: #ff0000;
				}
			</style>


			<form id="feedback-form" method="POST" action="/feedback?operation=save">
				<input type="hidden" name="privatekey" value="'.$privatekey.'" />
				<span class="mark">*</span> Ф.И.О. отправителя<br />
				<input name="fio" id="fio" value="'.(isset($_POST['fio']) ? $_POST['fio'] : '').'" required /><br /><br />
				<span class="mark">*</span> Контакные данные (телефон, email, skype и т.д.)<br />
				<input name="contacts" id="contacts" value="'.(isset($_POST['contacts']) ? $_POST['contacts'] : '').'" required /><br /><br />
				<span class="mark">*</span> Текст обращения<br />
				<textarea name="text" required style="width: 99%;">'.(isset($_POST['text']) ? $_POST['text'] : '').'</textarea><br /><br />';
$text .= recaptcha_get_html($publickey, $error,$use_ssl=true);
$text .= '		<input type="submit" value="Отправить" id="feedback_submit" />';
			


$text .=  '	</form>';
			

			
$text .= '	<script type="text/javascript">
				$("input#feedback_submit").click(function(){
					if ($("#fio").val() == "" || $("#contacts").val() == "" || $("#text").val() == "") {
						alert("Необходимо заполнить все обязательные поля (со звездочкой)");
						
						return false;
					}
				
					
				});
			</script>';