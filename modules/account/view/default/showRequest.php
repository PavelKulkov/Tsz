<?php

$text = '

	<span id="test"></span>
		<script type="text/javascript">
			$("#test").load("/modules/account/socialParse/showRequest.html");			
			$("#registrationForm .label").css({"background":"#efebde","text-shadow":"0 0 0 #000", "margin-top": "5px"});
		</script>';
echo $text;