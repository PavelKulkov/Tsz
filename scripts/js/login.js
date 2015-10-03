/*jQuery(document).ready(function() {
    jQuery('#ver_carousel').jcarousel({
		wrap: 'circular',
        scroll: 2,
        visible: 4
    });
});

jQuery(document).ready(function() {
    jQuery('#hor_carousel').jcarousel({
		wrap: 'circular',
        scroll: 1,
        visible: 1
    });
});*/

//0 - РѕРєРЅРѕ Р·Р°РєСЂС‹С‚Рѕ; 1  - РѕРєРЅРѕ РѕС‚РєСЂС‹С‚Рѕ;
var popupStatus = 0;
// 0 - РІС‹Р·РѕРІ С„РѕСЂРјС‹ РІРїРµСЂРІС‹Рµ; 1 - С„РѕСЂРјР° СѓР¶Рµ РІС‹Р·С‹РІР°Р»Р°СЃСЊ;
var start = 0;
 
// РћРїСЂРµРґРµР»СЏРµС‚ РїРѕР·РёС†РёСЋ СЌР»РµРјРµРЅС‚Р°, РЅРµРѕР±С…РѕРґРёРјР° РґР»СЏ РїРѕР»СѓС‡РµРЅРёСЏ РєРѕРѕСЂРґРёРЅР°С‚ СЃСЃС‹Р»РєРё "Р’С…РѕРґ", РѕС‚РЅРѕСЃРёС‚РµР»СЊРЅРѕ РєРѕС‚РѕСЂРѕР№ Р±СѓРґРµС‚ РїРѕР·РёС†РёРѕРЅРёСЂРѕРІР°С‚СЊСЃСЏ РІСЃРїР»С‹РІР°СЋС‰РµРµ РѕРєРЅРѕ
function absPosition(obj) {
	var x = y = 0;
	while(obj) {
		x += obj.offsetLeft;
		y += obj.offsetTop;
		obj = obj.offsetParent;
	}
	return {x:x, y:y};
}
 
// РџРѕРєР°Р·С‹РІР°РµРј РѕРєРЅРѕ
function loadPopup(){ 
	if(popupStatus==0){ // РћС‚РєСЂС‹РІР°РµРј РѕРєРЅРѕ С‚РѕР»СЊРєРѕ РµСЃР»Рё РѕРЅРѕ Р·Р°РєСЂС‹С‚Рѕ
		$('body').append('<div id="userLoginModalPopup"></div>'); // Р”РѕР±Р°РІР»СЏРµРј Рє СЃС‚СЂР°РЅРёС†Рµ РґРёРІ, СЏРІР»СЏСЋС‰РёР№СЃСЏ РѕСЃРЅРѕРІРѕР№ РґР»СЏ РЅР°С€РµРіРѕ РѕРєРѕС€РєР°
		if(start==0){ // РµСЃР»Рё РѕРєРЅРѕ РµС‰С‘ РЅРё СЂР°Р·Сѓ РЅРµ РїРѕРєР°Р·С‹РІР°Р»Р°СЃСЊ,  
			//document.getElementById('userLoginModalOpen').setAttribute('href', ''); // РјРµРЅСЏРµРј Р°РґСЂРµСЃ СЃСЃС‹Р»РєРё "Р’С…РѕРґ",
			$('#user-login-form').clone().appendTo('#userLoginModalPopup'); // Рё РєРѕРїРёСЂСѓРµРј РІ РЅРµРіРѕ СЃРѕРґРµСЂР¶РёРјРѕРµ user-login-form 
			start = 1; // РІС‹СЃС‚Р°РІР»СЏРµРј С„Р»Р°Рі С‡С‚Рѕ РѕРєРЅРѕ СЃС„РѕСЂРјРёСЂРѕРІР°РЅРѕ
		}
		// РІС‹СЃРѕС‚Р° РѕРєРЅР° Р±СЂР°СѓР·РµСЂР° 
		var windowHeight = document.documentElement.clientHeight; 
		// РћРїСЂРµРґРµР»СЏРµРј РїРѕР»РѕР¶РµРЅРёРµ СЃСЃС‹Р»РєРё "Р’С…РѕРґ" РЅР° СЃС‚СЂР°РЅРёС†Рµ
		var ourRef = document.getElementById("userLoginModalOpen"); // РЎСЃС‹Р»РєРµ "Р’С…РѕРґ" РґРѕР»Р¶РµРЅ Р±С‹С‚СЊ РїСЂРёСЃРІРѕРµРЅ id="userLoginModalOpen"
		var ourRefX = absPosition(ourRef).x;
		var ourRefY = absPosition(ourRef).y;
 
		// СЂР°Р·РјРµС‰Р°РµРј РѕРєРЅРѕ РїРѕРґ СЃСЃС‹Р»РєРѕР№ "Р’С…РѕРґ"
		$("#userLoginModalPopup").css({ 
			"position": "absolute", 
			"top": ourRefY + 20, 
			"left": ourRefX 
		}); 
 
		// С‚РѕР»СЊРєРѕ РґР»СЏ MS IE 6  
		$("#backgroundPopup").css({ 
			"height": windowHeight 
		}); 
 
		// РјРѕР¶РµРј СѓСЃС‚Р°РЅРѕРІРёС‚СЊ РїСЂРѕР·РЅР°С‡РЅРѕСЃС‚СЊ С„РѕРЅР° 
		$("#backgroundPopup").css({ 
			"opacity": "0.0" // РІ РјРѕРµРј СЃР»СѓС‡Р°Рµ Р±РµР· РїСЂРѕР·СЂР°С‡РЅРѕСЃС‚Рё. РњРѕР¶РµС‚Рµ СЌРєСЃРїРµСЂРµРјРµРЅС‚РёСЂРѕРІР°С‚СЊ СЃРѕ Р·РЅР°С‡РµРЅРёСЏРјРё РѕС‚ 0.0 РґРѕ 1.0
		}); 
 
		// РџРѕРєР°Р·С‹РІР°РµРј С„РѕСЂРјСѓ СЃ СЌС„С„РµРєС‚РѕРј Р’С‹РµР·Р¶Р°Р»РєРћ
		$("#backgroundPopup").fadeIn("fast"); // РїРѕРєР°Р·Р°Р»Рё С„РѕРЅ РїРѕРґ С„РѕСЂРјРѕР№
		$("#userLoginModalPopup").fadeIn("fast"); // РїРѕРєР°Р·Р°Р»Рё СЃР°РјСѓ С„РѕСЂРјСѓ
		popupStatus = 1; // РІС‹СЃС‚Р°РІР»СЏРµРј С„Р»Р°Рі, С‡С‚Рѕ РѕРєРЅРѕ РѕС‚РєСЂС‹С‚Рѕ
	} 
}
 
// РЎРєСЂС‹РІР°РµРј РѕРєРЅРѕ
function disablePopup(){ 
	// Р—Р°РєСЂС‹РІР°РµРј РѕРєРЅРѕ С‚РѕР»СЊРєРѕ РµСЃР»Рё РѕРЅРѕ РѕС‚РєСЂС‹С‚Рѕ
	if(popupStatus==1){ 
		$("#backgroundPopup").fadeOut("fast");  // СЃРїСЂСЏС‚Р°Р»Рё С„РѕРЅ РїРѕРґ С„РѕСЂРјРѕР№
		$("#userLoginModalPopup").fadeOut("fast"); // СЃРїСЂСЏС‚Р°Р»Рё СЃР°РјСѓ С„РѕСЂРјСѓ 
		if(jQuery("body").find("#TB_overlay").is("div")) /* РµСЃР»Рё С„РѕРЅ СѓР¶Рµ РґРѕР±Р°РІР»РµРЅ РЅРµ РґРѕР±Р°РІР»СЏРµРј РїРѕРІС‚РѕСЂРЅРѕ */
		{
			$('#TB_overlay').remove();   
		}
		popupStatus = 0; // РІС‹СЃС‚Р°РІР»СЏРµРј С„Р»Р°Рі, С‡С‚Рѕ РѕРєРЅРѕ Р·Р°РєСЂС‹С‚Рѕ 
	} 
}
 
//РћР±СЂР°Р±РѕС‚С‡РёРєРё СЃРѕР±С‹С‚РёР№
$(document).ready(function(){
	// РћРўРљР Р«РўРР• РћРљРќРђ
	// РЎРѕР±С‹С‚РёРµ - С‰РµР»С‡РµРє РїРѕ СЃСЃС‹Р»РєРµ "Р’С…РѕРґ"
	$("#userLoginModalOpen").click(function(){
		if(!jQuery("body").find("#TB_overlay").is("div")) /* РµСЃР»Рё С„РѕРЅ СѓР¶Рµ РґРѕР±Р°РІР»РµРЅ РЅРµ РґРѕР±Р°РІР»СЏРµРј РїРѕРІС‚РѕСЂРЅРѕ */
		{
		   if(!jQuery.browser.msie) /* РµСЃР»Рё Р±СЂР°СѓР·РµСЂ РЅРµ РР• С„РѕРЅРѕРј Р±СѓРґРµС‚ div */
		   jQuery("body").append("<div id='TB_overlay'></div>");
		   else /* РёРЅР°С‡Рµ РґРѕР±Р°РІР»СЏРµРј iframe */
		   jQuery("body").append("<div id='TB_overlay'><iframe scrolling='no' frameborder='0' style='position: absolute; top: 0; left: 0; width: 100%; height: 100%; filter:alpha(opacity=0)'></iframe></div>");
		}
		// РІС‹Р·С‹РІР°РµРј С„СѓРЅРєС†РёСЋ РѕС‚РєСЂС‹С‚РёСЏ РѕРєРЅР°
		loadPopup();
	});
 
	// Р—РђРљР Р«РўРР• РћРљРќРђ
	// РЎРѕР±С‹С‚РёРµ - С‰РµР»С‡РѕРє РїРѕ В«xВ»
	$("#userLoginModalClose").click(function(){ // !!! Сѓ РјРµРЅСЏ РЅРµ СЂР°Р±РѕС‚Р°РµС‚
		alert("");
		// РІС‹Р·С‹РІР°РµРј С„СѓРЅРєС†РёСЋ Р·Р°РєСЂС‹С‚РёСЏ РѕРєРЅР°
		disablePopup();
	});
 
	// РЎРѕР±С‹С‚РёРµ - С‰РµР»С‡РѕРє Р·Р° РїСЂРµРґРµР»Р°РјРё РѕРєРЅР°
	$("#backgroundPopup").click(function(){
		// РІС‹Р·С‹РІР°РµРј С„СѓРЅРєС†РёСЋ Р·Р°РєСЂС‹С‚РёСЏ РѕРєРЅР°
		disablePopup();
	});
 
	// РЎРѕР±С‹С‚РёРµ - РЅР°Р¶Р°С‚Р° РєР»Р°РІРёС€Р° Escape
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1) {
			// РІС‹Р·С‹РІР°РµРј С„СѓРЅРєС†РёСЋ Р·Р°РєСЂС‹С‚РёСЏ РѕРєРЅР°
			disablePopup();
		}
	});
});
