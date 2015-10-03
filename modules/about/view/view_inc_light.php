<?php
$text = <<<TEXT
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

echo $text;

if ($admin) {
	echo 1;
	echo "<div align=\"left\">
			<a class=\"btn btn-success\" href=\"/about&operation=edit\">Редактировать данные<i class=\"icon-chevron-right icon-white\"></i></a>
		</div>";
};