<form method="post">
	<table align="center" cellpadding="5">
		<tr align="center"><td>РџСЂРёРѕСЂРёС‚РµС‚</td><td><input id="priority" type="text" name="priority" value="{#priority}" style="width: 50px;"></td></tr>
		<tr align="center"><td>РњРѕРґРёС„РёРєР°С‚РѕСЂ</td><td><input id="modify" type="text" name="modify" value="{#modify}" style="width: 50px;"></td></tr>
		<tr align="right"><td colspan="2"><input type="submit" value="OK" onclick="overflow('', '/priority/'+document.getElementById('priority').value+'/modify/'+document.getElementById('modify').value+'/id/'+{#id}+'/save_sitemap', '', 'save_sitemap', {#id}); return false; "></td></tr>
	</table>
</form> 