<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>РћС€РёР±РєР°</title>
<meta http-equiv="Content-Type"	content="text/html; charset=utf-8" />
<meta name="author" content="Promarm.ru">
<link rel="stylesheet" type="text/css" href="/styles/main2.css" />
</head>
<body>
<center>
<h1 style="margin-top: 100px; margin-bottom: 30px;">РџСЂРµРІС‹С€РµРЅРѕ РјР°РєСЃРёРјР°Р»СЊРЅРѕ РґРѕРїСѓСЃС‚РёРјРѕРµ РєРѕР»РёС‡РµСЃС‚РІРѕ Р·Р°РїСЂРѕСЃРѕРІ<br> РІ РµРґРёРЅРёС†Сѓ РІСЂРµРјРµРЅРё
СЃ IP-Р°РґСЂРµСЃР°: <?php echo $_SERVER['REMOTE_ADDR']; ?></h1>
<b>Р’РІРµРґРёС‚Рµ Р·Р°С‰РёС‚РЅС‹Р№ РєРѕРґ СЃ РєР°СЂС‚РёРЅРєРё:</b><br>
<form action="/<? echo $request->getValue('query');?>" method="post">
<input name="captcha_text" type="text" id="captcha_text" size="5" maxlength="4" style="width: 100px; height: 44px; margin: 0px; font-size: 22px; text-align: center;" autocomplete="off"><br>
<img align="top" src="/captcha/<?echo session_name(); ?>/<?echo session_id();?>" style="margin: 0px;"><br>
<input type="submit" value="РѕС‚РїСЂР°РІРёС‚СЊ" name="save">
</form>
</center>
</body>
</html>
