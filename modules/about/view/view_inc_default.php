<?php
$text = '	<div class="rule"></div><br />';

$text .= <<<TEXT
<table width="98%" border="0"  style="padding: 10px 15px;">
    <tbody>
        <tr>
            <td align="left" width="60%" valign="top">
            	{$portal_info['content']}
            </td>
            <td align="right" width="40%" valign="top">
           		<h2>Схема проезда</h2>
           			
					<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=CpnEpqxDaEXp5VY6zTYCZNeZq-W5wyWY&width=450&height=350"></script>
					
            </td>
        </tr>
    </tbody>
</table>		
TEXT;

if ($admin) {
$text .= "<div align=\"left\">
			<a class=\"btn btn-success\" href=\"/about&operation=edit\">Редактировать данные<i class=\"icon-chevron-right icon-white\"></i></a>
		</div>";
};

$text .= '	<script type="text/javascript">
				$(document).ready(function(){
			    	$("div#content_content").removeClass().addClass("content");
					$("div#content_center").removeClass().addClass("center");
					$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Контакты");
					$("div#content_line").removeClass().addClass("blue_line");
				});
			</script>';

echo $text;