$(window).load(function() {
			formOftype = $("#config_site");
			preloader = $("#preloader");
			preloader.css("display","none");
			formOftype.css("display","block");
				
			/* РћР±РЅСѓР»СЏРµРј РѕР±С‰СѓСЋ Рё СЃСѓРјРј СЃ РќР”РЎ РІ РїРѕР»Рµ РІС‹РІРѕРґР° */
			//$('#summ span').text('0');
			//$('#summ_monthly span').text('0');
			
			formOftype.change(function() {
				
				var totalSum = 0; /* РџРѕР»РЅСѓСЋ СЃСѓРјРјСѓ (РµРґРёРЅРѕСЂР°Р·РѕРІС‹Рµ СѓСЃР»СѓРіРё) СЃРЅР°С‡Р°Р»Р° РїСЂРёСЂР°РІРЅРёРІР°РµРј Рє РЅСѓР»СЋ */
				var totalSum_monthly = 0; /* РџРѕР»РЅСѓСЋ СЃСѓРјРјСѓ (РµР¶РµРјРµСЃСЏС‡РЅС‹Рµ СѓСЃР»СѓРіРё) СЃРЅР°С‡Р°Р»Р° РїСЂРёСЂР°РІРЅРёРІР°РµРј Рє РЅСѓР»СЋ */
				
				/* РџРµСЂРµСЃС‡РёС‚С‹РІР°РµРј РІСЃРµ СЃРµР»РµРєС‚С‹ РєРѕС‚РѕСЂС‹Рµ РІС‹Р±СЂР°РЅС‹*/
				$('select.selectCell option:selected').each(function() {
					totalSum += parseInt($(this).val());
				});
				
				$('select.selectCell_monthly option:selected').each(function() {
					totalSum_monthly += parseInt($(this).val());
				});
				
				/* РљР°Р¶РґРѕРµ РїРѕР»Рµ РІРІРѕРґР° (РµРґРёРЅРѕСЂР°Р·РѕРІС‹Рµ СѓСЃР»СѓРіРё) РїСЂРѕРІРµСЂСЏРµРј РЅР° РІРІРµРґРµРЅРѕРµ Р·РЅР°С‡РµРЅРёРµ, РµСЃР»Рё Р±РѕР»СЊС€Рµ РЅСѓР»СЏ С‚Рѕ СЃС‡РёС‚Р°РµРј РµРіРѕ */
				$('input.inputCell').each(function() {
					var inputCell = parseInt($(this).val()) * parseInt($(this).attr('name'));
					if(!isNaN(inputCell)) totalSum += inputCell;
				});
				
				/* РљР°Р¶РґРѕРµ РїРѕР»Рµ РІРІРѕРґР° (РµР¶РµРјРµСЃСЏС‡РЅС‹Рµ СѓСЃР»СѓРіРё) РїСЂРѕРІРµСЂСЏРµРј РЅР° РІРІРµРґРµРЅРѕРµ Р·РЅР°С‡РµРЅРёРµ, РµСЃР»Рё Р±РѕР»СЊС€Рµ РЅСѓР»СЏ С‚Рѕ СЃС‡РёС‚Р°РµРј РµРіРѕ */
				$('input.inputCell_monthly').each(function() {
					var inputCell = parseInt($(this).val()) * parseInt($(this).attr('name'));
					if(!isNaN(inputCell)) totalSum_monthly += inputCell;
				});
				
				/* РџРµСЂРµСЃС‡РёС‚С‹РІР°РµРј РІСЃРµ С‡РµРєР±РѕРєСЃС‹ (РµРґРёРЅРѕСЂР°Р·РѕРІС‹Рµ СѓСЃР»СѓРіРё) РєРѕС‚РѕСЂС‹Рµ РѕС‚РјРµС‡РµРЅС‹ РіР°Р»РѕС‡РєРѕР№*/
				$(this).find("input.checkCell:checked").each(function() {
					totalSum += parseInt($(this).val()); 
				});
				
				/* РџРµСЂРµСЃС‡РёС‚С‹РІР°РµРј РІСЃРµ С‡РµРєР±РѕРєСЃС‹ (РµР¶РµРјРµСЃСЏС‡РЅС‹Рµ СѓСЃР»СѓРіРё) РєРѕС‚РѕСЂС‹Рµ РѕС‚РјРµС‡РµРЅС‹ РіР°Р»РѕС‡РєРѕР№*/
				$(this).find("input.checkCell_monthly:checked").each(function() {
					totalSum_monthly += parseInt($(this).val()); 
				});
				
				/* РџРѕРґСЃС‡РµС‚ Рё РІС‹РІРѕРґ СЃСѓРјРјС‹ РёС‚РѕРіРѕРІРѕР№ */
				$("#summ span").text(totalSum);
				$("#summ_monthly span").text(totalSum_monthly);
			});
	
});