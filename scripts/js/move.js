function submitform(href) {
  document.addComment.action = href;
  document.addComment.submit();
  return false;
}

function show_loginform() {
	var body = document.body;
    var docElem = document.documentElement;
     
    // (3)
    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;
     
    // (4)
    var clientTop = docElem.clientTop || body.clientTop || 0;
    var clientLeft = docElem.clientLeft || body.clientLeft || 0;
     
    // (5)
    var top  = scrollTop - clientTop;
    var left = scrollLeft - clientLeft;


cover = window.parent.document.createElement( 'div' ) ;
var opacity = " opacity: 0.6;";
if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0) {
	opacity = "filter: progid:DXImageTransform.Microsoft.Alpha(opacity=60)";
}
//cover.style.cssText ="position: absolute; top: "+top+"px;left: 0px; background-color: #dddddd; width: 100%; height: 100%;"+opacity;
//cover.id = 'cover';
//document.body.appendChild(cover) ;
//cover1 = window.parent.document.createElement( 'div' ) ;
//cover1.id = 'cover1';
//cover1.style.cssText ="position: absolute; top: "+top+"px;left: 0px; width: 100%;  cursor:pointer; height: 100%; text-align: center; vertical-align: middle;";
//cover1.innerHTML = '<table align="center" width="'+(width+20)+'" height="100%"><tr><td><div style="background-color: #FFFFFF; padding: 10px; border: 1px solid #aaa; width: '+(width+20)+'px;"><img src="'+url+'" width="'+width+'" title="Р—Р°РєСЂС‹С‚СЊ" onClick="hideFoto(\'cover\',\'cover1\')"><br><b>'+title+'</b></td></tr><table>';
//window.parent.document.body.appendChild(cover1) ;
//return false;

page_size = getPageSize();
cover.style.cssText ="position: absolute; top: 0px;left: 0px; background-color: #dddddd; width: 100%; height: "+document.getElementById('main_tbl').offsetHeight+"px;"+opacity;
    cover.id = 'cover';
	document.body.appendChild(cover) ;
	    cover1 = window.parent.document.createElement( 'div' ) ;
		cover1.id = 'cover1';
		    cover1.style.cssText ="position: absolute; left: 0px; width: 100%;  cursor:pointer; height: 100%; text-align: center; vertical-align: middle;";
			cover1.innerHTML = '<div style="left: 0; background-color: #74a829; margin-top: 20px; z-index: 100; padding: 5px;" id="form_login">{if error}<font color="#FF0000"><b>{#error}</b></font><form action="/users" method="post" name="form1"><b>{#message}</b><table><tr><td>Р›РѕРіРёРЅ:</td><td><input type="text" name="name" size="15" style="height: 20px;"></td></tr><tr><td>РџР°СЂРѕР»СЊ:</td><td><input type="password" id="password" style="height: 20px;" name="password" size="15"></td></tr></table><input type="submit" name="login" value="Р’РѕР№С‚Рё" onclick="submitButton(\'login/\',\'auth\'); return false;"></form></div>';
			    window.parent.document.body.appendChild(cover1) ;
				return false;
				 
}


function setCookie (name, value, expires, path, domain, secure) {
      document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function Mover(ptr) {
	//ptr.style.background = 'url("/images/main.gif")';
	ptr.style.bgColor = '#DDDDDD';
}
function Mout(ptr) {
	ptr.style.background = 'none';
	ptr.style.bgColor = '#FFFFFF';
}
function show_menu(my_id) {
	alert('1'+document.getElementById(my_id).style.visibility);
	if(document.getElementById(my_id)) {
		if(interval_hide_menu_id && hide_menu_id==my_id) clearTimeout(interval_hide_menu_id);
		
		document.getElementById(my_id).style.visibility = "visible";
		document.getElementById(my_id).style.top = "";
	}
}
function hide_menu(my_id){
	if(document.getElementById(my_id)) {
		interval_hide_menu_id = setTimeout ("interval_hide_menu('"+my_id+"')",300);
		hide_menu_id = my_id;
	}
}
function interval_hide_menu(my_id){
	if(document.getElementById(my_id)) {
		document.getElementById(my_id).style.visibility = "hidden";
		document.getElementById(my_id).style.top = "0px";
	}
}
function change_menu(id){
	if(document.getElementById(id)) {
		if(document.getElementById(id).style.visibility=="hidden") {
			document.getElementById(id).style.visibility = "";
//			document.getElementById(id).style.position = "";
			if(document.getElementById('img'+id)) {
				document.getElementById('img'+id).src = "/images/sort1.png";
			}
		} else {
//			document.getElementById(id).style.top = '0px';
			document.getElementById(id).style.visibility = "hidden";
//			document.getElementById(id).style.position = "absolute";
			if(document.getElementById('img'+id)) {
				document.getElementById('img'+id).src = "/images/sort2.png";
			}
		}
	}
}

function change_item(id){
	if(document.getElementById('sub'+id)) {
		if(document.getElementById('sub'+id).style.visibility=="hidden") {
			document.getElementById('sub'+id).style.visibility = "";
			document.getElementById('sub'+id).style.position = "";
			document.getElementById('img'+id).src = "/images/tree/fld_open.gif";
			if(document.getElementById('pm'+id)) {
				document.getElementById('pm'+id).src = "/images/tree/mnode.gif";
			} else {
				if(document.getElementById('lpm'+id)) {
					document.getElementById('lpm'+id).src = "/images/tree/mlastnode.gif";
				}
			}
		} else {
			document.getElementById('sub'+id).style.visibility = "hidden";
			document.getElementById('sub'+id).style.position = "absolute";
			document.getElementById('img'+id).src = "/images/tree/fld_close.gif";
			if(document.getElementById('pm'+id)) {
				document.getElementById('pm'+id).src = "/images/tree/pnode.gif";
			} else {
				if(document.getElementById('lpm'+id)) {
					document.getElementById('lpm'+id).src = "/images/tree/plastnode.gif";
				}
			}
		}
	}
}

//ajax
	if(window.XMLHttpRequest){
		try{
			request_type=new XMLHttpRequest();
		} catch(e){
		}
	} else {
		if(window.ActiveXObject){
			try{
				request_type=new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e){
			}
			if(!request_type){
				try{
					request_type=new ActiveXObject("Msxml2.XMLHTTP");
				} catch(e){
				}
			}
		}
	}


var currentElement;
var life_interval1;
var is_working=null;

function OpenWnd(pic_name) {
  myWin= open("/wnd"+pic_name, "myWnd", "width=650,height=650,titlebar=no,channelmode=no,dependent=yes,status=no,location=no,top=200,left=300,toolbar=no,menubar=no");
}

function searchReplyPopup() {
	if(div_reload_name) {
		if(request_type.readyState == 4){
			var response = request_type.responseText;
			var str = new String(response);
			var Text = str.split("#####");
			if(Text[1]) {
				document.getElementById(div_reload_name).innerHTML = Text[0];
				document.getElementById('menu2').innerHTML = Text[1];
				if(document.getElementById('needReload')) {
					window.location.reload();
				}
			} else {
				document.getElementById(div_reload_name).innerHTML = response;
			}
		}
		if(document.getElementById('tmp_value')) {
			document.getElementById(hidd_name).value = document.getElementById('tmp_value').value;
		}
	}
}

function getElementPosition(elemId) {
    var elem = elemId;
  //  alert(elemId+' '+elem);
    var w 	 = elem.offsetWidth;
    var h	 = elem.offsetHeight;
    var l	 = 0;
    var t	 = 0;
    while (elem) {
        l += elem.offsetLeft;
        t += elem.offsetTop;
        elem = elem.offsetParent;
    }
	return {"left":l, "top":t, "width": w, "height":h};
}

var abs_top, abs_left, flag_close, hidd_el;

function overflow(link, url, event, action, id) {
	//alert(action+' '+id);
	if(navigator.appName=='Microsoft Internet Explorer'){
		h_scr = document.documentElement.clientHeight;
	} else {
		h_scr = window.innerHeight;
	}
		flag_close=1;
		var done = getElementPosition(link);
		var left = done.left;
		var top = done.top;
		var html = document.documentElement;
		//hidDiv = getElementPosition(link);
		if((done.top - html.scrollTop)<=(h_scr/5)){
			abs_top = 0;
			abs_left = 0;
		}
		if((done.top - html.scrollTop)>=(h_scr/5)){
			abs_top = done.height + 160;
		}

	if(action=='modify'){
		request_type.open('get', '/ajax/'+escape(url)+'/'+id, true);
	}
	else if(action=='save_sitemap') {
		request_type.open('get', '/ajax/'+escape(url), true);
	} else request_type.open('get', '/ajax/element/'+escape(url), true);
	if(id){
		wdth = 150;
		hgt = 105;
	} else {
		wdth = 250;
		hgt = 140;
	}
	if(action=='save_sitemap'){
		document.getElementById(id).innerHTML = '<img src="/images/snake.gif">';
		div_reload_name = id;
	} else {
		document.getElementById('inviz').innerHTML = '<img src="/images/ajax/progress.gif">';
		document.getElementById('inviz').style.cssText = "margin-top: 0px; padding: 6px;  visibility: hidden; position:absolute; font-size: 12px; border:1px solid #ddd; background-color: #FFFFFF; left:"+(done.left+20)+"px; top: "+(done.top+done.height-abs_top-3)+"px; height: "+hgt+"px; width: "+wdth+"px;";
		document.getElementById('inviz').style.visibility = "visible";
		div_reload_name = 'inviz';
	}

	request_type.onreadystatechange = searchReplyPopup;
	if(action=='save_sitemap') document.getElementById('inviz').style.visibility = "hidden";
	request_type.send(null);
}

function close(){
	if(!flag_close){
		hidd_el = 0;
		document.getElementById('inviz').style.visibility = "hidden";
	}
}
function onFlag1(){
	flag_close=1;
}
function onFlag2(){
	flag_close=0;
	time = setTimeout("close();",1000);
}

function htmlspecialchars(html) {
    html = html.replace(/"/g, "&quot;");
    // Р’РѕР·РІСЂР°С‰Р°РµРј РїРѕР»СѓС‡РµРЅРЅРѕРµ Р·РЅР°С‡РµРЅРёРµ
    return html;
}

function showFoto(url,title,width,text,photos_arr,pos,arr_length,height) {
	if(!height) height=40;
	if(photos_arr) {
		if(parseInt(pos)==0) {
			var pos_prev = parseInt(arr_length)-1;
			var pos_next = parseInt(pos)+1;
		} else if(parseInt(pos)==parseInt(arr_length)-1) {
			var pos_prev = parseInt(pos)-1;
			var pos_next = 0;
		} else {
			var pos_prev = parseInt(pos)-1;
			var pos_next = parseInt(pos)+1;
		}

		var jsonArr = JSON.stringify(photos_arr);
		var jsonArr1 = htmlspecialchars(jsonArr);
	}
	var body = document.body;
		    var docElem = document.documentElement;
		     
		    // (3)
		    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
		    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;
		     
		    // (4)
		    var clientTop = docElem.clientTop || body.clientTop || 0;
		    var clientLeft = docElem.clientLeft || body.clientLeft || 0;
		     
		    // (5)
		    var top  = scrollTop - clientTop;
		    var left = scrollLeft - clientLeft;


		cover = window.parent.document.createElement( 'div' ) ;
		var opacity = " opacity: 0.9;";
		if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0) {
			opacity = "filter: progid:DXImageTransform.Microsoft.Alpha(opacity=90)";
		}
//		cover.style.cssText ="position: absolute; top: "+top+"px;left: 0px; background-color: #dddddd; width: 100%; height: 100%;"+opacity;
//		cover.id = 'cover';
//		document.body.appendChild(cover) ;
//		cover1 = window.parent.document.createElement( 'div' ) ;
//		cover1.id = 'cover1';
//		cover1.style.cssText ="position: absolute; top: "+top+"px;left: 0px; width: 100%;  cursor:pointer; height: 100%; text-align: center; vertical-align: middle;";
//		cover1.innerHTML = '<table align="center" width="'+(width+20)+'" height="100%"><tr><td><div style="background-color: #FFFFFF; padding: 10px; border: 1px solid #aaa; width: '+(width+20)+'px;"><img src="'+url+'" width="'+width+'" title="Р—Р°РєСЂС‹С‚СЊ" onClick="hideFoto(\'cover\',\'cover1\')"><br><b>'+title+'</b></td></tr><table>';
//		window.parent.document.body.appendChild(cover1) ;
//		return false;
		
		
	    page_size = getPageSize();
	    
		cover.style.cssText ="position: absolute; top: 0px; left: 0px; background-color: #333333; width: 100%; height: "+$(document).height()+"px;"+opacity;
		    cover.id = 'cover';
			document.body.appendChild(cover) ;
			    cover1 = window.parent.document.createElement( 'div' ) ;
				cover1.id = 'cover1';
				    cover1.style.cssText ="z-index: 20; position: absolute; top: "+top+"px;left: 0px; width: 100%; cursor:pointer; height: 100%; text-align: center !important;";
				    
				    if(photos_arr) {
				    	if(title && text) {
					    	cover1.innerHTML = '<table width="'+(width+20)+'" height="100%" align="center"><tr><td valign="middle" style="width: 50px;"><div id="prev_photo" onclick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_prev][0]+'\',\''+photos_arr[pos_prev][1]+'\','+photos_arr[pos_prev][2]+',\''+photos_arr[pos_prev][3]+'\','+jsonArr1+',\''+pos_prev+'\',\''+arr_length+'\','+photos_arr[pos_prev][4]+'); return false;" style="z-index: 1000; width: 50px; height: 50px; background: url(/images/back48.png) scroll center no-repeat;" onmouseover="javascript:document.getElementById(\'prev_photo\').style.background = \'url(/images/back48_light.png) scroll center no-repeat\'" onmouseout="javascript:document.getElementById(\'prev_photo\').style.background = \'url(/images/back48.png) scroll center no-repeat\'"></div></td><td valign="middle"><div id="photo_close" onClick="hideFoto(\'cover\',\'cover1\');"></div><div id="photo_item"><div style="margin: 0 0 10px 0; color: black; font-weight: bold;">'+title+'</div><div id="preloader" style="background-color: #FFFFFF; padding: 20px 0; width: '+(width+40)+'px; height: '+(height)+'px;"></div><img onload="onImgLoaded(this)" id="photo_item_img" src="'+url+'" width="'+width+'" title="'+title+'" onClick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;"><div style="margin: 10px 0 0 0; padding: 0 10px; color: black;">'+text+'</div></div></td><td width="50"></td><td valign="middle" style="width: 50px;"><div id="next_photo" onclick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;" style="z-index: 1000; width: 50px; height: 50px; background: url(/images/forward48.png) scroll center no-repeat;" onmouseover="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48_light.png) scroll center no-repeat\'" onmouseout="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48.png) scroll center no-repeat\'"></div></td></tr><table>';
					    } else if(title) {
					    	cover1.innerHTML = '<table width="'+(width+20)+'" height="100%" align="center"><tr><td valign="middle" style="width: 50px;"><div id="prev_photo" onclick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_prev][0]+'\',\''+photos_arr[pos_prev][1]+'\','+photos_arr[pos_prev][2]+',\''+photos_arr[pos_prev][3]+'\','+jsonArr1+',\''+pos_prev+'\',\''+arr_length+'\','+photos_arr[pos_prev][4]+'); return false;" style="z-index: 1000; width: 50px; height: 50px; background: url(/images/back48.png) scroll center no-repeat;" onmouseover="javascript:document.getElementById(\'prev_photo\').style.background = \'url(/images/back48_light.png) scroll center no-repeat\'" onmouseout="javascript:document.getElementById(\'prev_photo\').style.background = \'url(/images/back48.png) scroll center no-repeat\'"></div></td><td width="50"></td><td valign="middle"><div id="photo_close" onClick="hideFoto(\'cover\',\'cover1\');"></div><div id="photo_item"><div style="margin: 0 0 10px 0; color: black; font-weight: bold;">'+title+'</div><div id="preloader" style="background-color: #FFFFFF; padding: 20px 0; width: '+(width+40)+'px; height: '+(height)+'px;"></div><img onload="onImgLoaded(this)" id="photo_item_img" src="'+url+'" width="'+width+'" title="'+title+'" onClick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;"></div></td><td width="50"></td><td valign="middle" style="width: 50px;"><div id="next_photo" onclick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;" style="z-index: 1000; width: 50px; height: 50px; background: url(/images/forward48.png) scroll center no-repeat;" onmouseover="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48_light.png) scroll center no-repeat\'" onmouseout="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48.png) scroll center no-repeat\'"></div></td></tr><table>';
					    } else {
					    	cover1.innerHTML = '<table width="'+(width+100)+'" height="100%" align="center"><tr><td valign="middle" style="width: 50px;"><div id="prev_photo" onclick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_prev][0]+'\',\''+photos_arr[pos_prev][1]+'\','+photos_arr[pos_prev][2]+',\''+photos_arr[pos_prev][3]+'\','+jsonArr1+',\''+pos_prev+'\',\''+arr_length+'\','+photos_arr[pos_prev][4]+'); return false;" style="z-index: 1000; width: 50px; height: 50px; background: url(/images/back48.png) scroll center no-repeat;" onmouseover="javascript:document.getElementById(\'prev_photo\').style.background = \'url(/images/back48_light.png) scroll center no-repeat\'" onmouseout="javascript:document.getElementById(\'prev_photo\').style.background = \'url(/images/back48.png) scroll center no-repeat\'"></div></td><td valign="middle"><div id="photo_close" onClick="hideFoto(\'cover\',\'cover1\');"></div><div id="preloader" style="background-color: #FFFFFF; padding: 20px 0; width: '+(width+40)+'px; height: '+(height)+'px;"></div><div id="photo_item"><img onload="onImgLoaded(this)" id="photo_item_img" src="'+url+'" width="'+width+'" onClick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;"></div></td><td valign="middle" style="width: 50px;"><div id="next_photo" onclick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;" style="z-index: 1000; width: 50px; height: 50px; background: url(/images/forward48.png) scroll center no-repeat;" onmouseover="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48_light.png) scroll center no-repeat\'" onmouseout="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48.png) scroll center no-repeat\'"></div></td></tr><table>';
					    }
				    } else {
				    	if(title && text) {
					    	cover1.innerHTML = '<table width="'+(width+20)+'" height="100%" align="center"><tr><td valign="middle" style="width: 50px;"></td><td valign="middle"><div id="photo_close" onClick="hideFoto(\'cover\',\'cover1\');"></div><div id="photo_item"><div style="margin: 0 0 10px 0; color: black; font-weight: bold;">'+title+'</div><div id="preloader" style="background-color: #FFFFFF; padding: 20px 0; width: '+(width+40)+'px; height: '+(height)+'px;"></div><img onload="onImgLoaded(this)" id="photo_item_img" src="'+url+'" width="'+width+'" title="'+title+'" onClick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;"><div style="margin: 10px 0 0 0; padding: 0 10px; color: black;">'+text+'</div></div></td><td width="50"></td><td valign="middle" style="width: 50px;"><div id="next_photo" onclick="hideFoto(\'cover\',\'cover1\'); showFoto(\''+photos_arr[pos_next][0]+'\',\''+photos_arr[pos_next][1]+'\','+photos_arr[pos_next][2]+',\''+photos_arr[pos_next][3]+'\','+jsonArr1+',\''+pos_next+'\',\''+arr_length+'\','+photos_arr[pos_next][4]+'); return false;" style="z-index: 1000; width: 50px; height: 50px; background: url(/images/forward48.png) scroll center no-repeat;" onmouseover="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48_light.png) scroll center no-repeat\'" onmouseout="javascript:document.getElementById(\'next_photo\').style.background = \'url(/images/forward48.png) scroll center no-repeat\'"></div></td></tr><table>';
					    } else if(title) {
					    	cover1.innerHTML = '<table width="'+(width+20)+'" height="100%" align="center"><tr><td valign="middle" style="width: 50px;"></td><td width="50"></td><td valign="middle"><div id="photo_close" onClick="hideFoto(\'cover\',\'cover1\');"></div><div id="preloader" style="background-color: #FFFFFF; padding: 20px 0; width: '+(width+40)+'px; height: '+(height)+'px;"></div><div id="photo_item"><div style="min-width: 300px;" align="center"><img onload="onImgLoaded(this)" id="photo_item_img" src="'+url+'" width="'+width+'" title="'+title+'" onClick="hideFoto(\'cover\',\'cover1\'); return false;"></div><div style="margin: 10px 0 0 0; color: black; font-weight: bold;">'+title+'</div></div></td><td width="50"></td><td valign="middle" style="width: 50px;"></td></tr><table>';
					    } else {
					    	cover1.innerHTML = '<table width="'+(width+100)+'" height="100%" align="center"><tr><td valign="middle" style="width: 50px;"></td><td valign="middle"><div id="photo_close" onClick="hideFoto(\'cover\',\'cover1\');"></div><div id="preloader" style="background-color: #FFFFFF; padding: 20px 0; width: '+(width+40)+'px; height: '+(height)+'px;"></div><div id="photo_item"><img onload="onImgLoaded(this)" id="photo_item_img" src="'+url+'" width="'+width+'" onClick="hideFoto(\'cover\',\'cover1\'); return false;"></div></td><td valign="middle" style="width: 50px;"></td></tr><table>';
					    }
				    }
				    			    
				    window.parent.document.body.appendChild(cover1);
				    return false;
	}

function onImgLoaded(elem) {
	document.getElementById('photo_item').style.display = "block";
	elem.style.display = "block";
	document.getElementById('preloader').style.display = "none";
}

	function hideFoto(element1,element2){
		el2 = document.getElementById(element2);
		window.parent.document.body.removeChild(el2);
		el1 = document.getElementById(element1);
		window.parent.document.body.removeChild(el1);
	}


function  getPageSize(){
    var xScroll, yScroll;
    
	if (window.innerHeight && window.scrollMaxY) {
		xScroll = document.body.scrollWidth;
			yScroll = window.innerHeight + window.scrollMaxY;
			    } else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
				    xScroll = document.body.scrollWidth;
					    yScroll = document.body.scrollHeight;
						} else if (document.documentElement && document.documentElement.scrollHeight > document.documentElement.offsetHeight){ // Explorer 6 strict mode
							xScroll = document.documentElement.scrollWidth;
								yScroll = document.documentElement.scrollHeight;
								    } else { // Explorer Mac...would also work in Mozilla and Safari
									    xScroll = document.body.offsetWidth;
										    yScroll = document.body.offsetHeight;
											}
											
											    var windowWidth, windowHeight;
												if (self.innerHeight) { // all except Explorer
													windowWidth = self.innerWidth;
														windowHeight = self.innerHeight;
														    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
															    windowWidth = document.documentElement.clientWidth;
																    windowHeight = document.documentElement.clientHeight;
																	} else if (document.body) { // other Explorers
																		windowWidth = document.body.clientWidth;
																			windowHeight = document.body.clientHeight;
																			    }
																			    
																				// for small pages with total height less then height of the viewport
																				    if(yScroll < windowHeight){
																					    pageHeight = windowHeight;
																						} else {
																							pageHeight = yScroll;
																							    }
																							    
																								// for small pages with total width less then width of the viewport
																								    if(xScroll < windowWidth){
																									    pageWidth = windowWidth;
																										} else {
																											pageWidth = xScroll;
																											    }
																											    
																												return [pageWidth,pageHeight,windowWidth,windowHeight];
																												}
																												


var flag=0;
function Show(x, y) {
	if(flag!=1){
		flag = 1;
		//if(document.getElementById(x).style.visibility=="hidden") {
		document.getElementById(x).style.visibility = "visible";
		//document.all[x].style.visibility = "visible";
		//alert(document.getElementById(x));
		//document.getElementById(x).style.zIndex = "100";
		if(y=='ask') {
			document.getElementById(x).style.cssText = "left: 100px; top: 50px; border: 1px solid #999; background-color: #fff;padding: 15px;";
			document.getElementById(x).style.position = "absolute";
		} else {
			document.getElementById(x).style.position = "";
		}

		document.getElementById(y).style.fontWeight = "bold";
		document.getElementById(y).style.color = "#000";

		//}
	} else {
	//alert('qqq');
		//if(document.getElementById(x).style.visibility=="visible") {
		document.getElementById(x).style.visibility = "hidden";
		document.getElementById(x).style.position = "absolute";
		document.getElementById(y).style.fontWeight = "normal";
		if(y!='ask') document.getElementById(y).style.color = "#aa0000";
		flag = 0;
		//}
	}
}




//***



var interval_menu_open  = null;
var interval_menu_close1 = null;
var interval_menu_close2 = null;
var menu_id_open		= null;
var menu_id_close1		= null;
var menu_id_close2		= null;
var menu_id_active		= null;
var opacity_count = 1;
var opacity_mod  = 0.1;

function is_menu_close(id,type) {
	if(menu_id_close1==id && interval_menu_close1) {
		if(type=='off') {
			menu_id_close1=null;
			clearInterval(interval_menu_close1);
			interval_menu_close1 = null;
			menu_id_open=id;
			intervalMenuShow();
		}
	}
	if(menu_id_close2==id && interval_menu_close2) {
		if(type=='off') {
			menu_id_close2=null;
			clearInterval(interval_menu_close2);
			interval_menu_close2 = null;
			menu_id_open=id;
			intervalMenuShow();
		}
	}
}

var hide_menu_id = null;
var interval_hide_menu_id = null;

function show_menu(my_id) {
	if(document.getElementById(my_id)) {
		if(interval_hide_menu_id && hide_menu_id==my_id) clearTimeout(interval_hide_menu_id);
		document.getElementById(my_id).style.visibility = "visible";
		document.getElementById(my_id).style.top = "";
	}
}
function hide_menu(my_id){
	if(document.getElementById(my_id)) {
		interval_hide_menu_id = setTimeout ("interval_hide_menu('"+my_id+"')",300);
		hide_menu_id = my_id;
	}
}
function interval_hide_menu(my_id){
	if(document.getElementById(my_id)) {
		document.getElementById(my_id).style.visibility = "hidden";
		document.getElementById(my_id).style.top = "0px";
	}
}

function left_menu(id, type) {
	if(type=='off') {
		make_left_menu(id, type);
	}
	if(type=='on' && id!=menu_id_active) {
		make_left_menu(id, type);
	}
}
function make_left_menu(id, type) {
	if(type=='on') {
		//РћС‚РјРµРЅР° Р·Р°РєСЂС‹С‚РёСЏ РјРµРЅСЋ id
		is_menu_close(id,'off');
		//Р—Р°РєСЂС‹С‚РёРµ Р°РєС‚РёРІРЅРѕРіРѕ РјРµРЅСЋ Рё РѕС‚РєСЂС‹С‚РёРµ id
		if(id!=menu_id_active) {
			//РћС‚РјРµРЅР° РґСЂСѓРіРѕРіРѕ РѕС‚РєСЂС‹С‚РёСЏ
			if(interval_menu_open && menu_id_open) {
				clearTimeout(interval_menu_open);
				interval_menu_open = null;
			}
			if(menu_id_active) close_left_menu(menu_id_active);
			open_left_menu(id);
		}
	} else {
		if(type=='off') {
			//РћС‚РјРµРЅР° РѕС‚РєСЂС‹С‚РёСЏ РјРµРЅСЋ
			if(id==menu_id_open) {
				clearTimeout(interval_menu_open);
				interval_menu_open = null;
			} else {
				close_left_menu(id);
				if(id==menu_id_active) menu_id_active = null;
			}
		}
	}
}
function open_left_menu(id){
	if(!interval_menu_open) {
		menu_id_open		= id;
		interval_menu_open=setTimeout ("intervalMenuShow()",500);
	}
}
function intervalMenuShow(){
	//РџРѕРєР°Р·Р°С‚СЊ РІС‹Р±СЂР°РЅРЅРѕРµ РјРµРЅСЋ
	if(document.getElementById(menu_id_open)) {
		if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0) {
//			document.getElementById(menu_id_open).style.filter ='progid:DXImageTransform.Microsoft.Alpha(opacity=100)';
		} else {
			document.getElementById(menu_id_open).style.opacity    = "1";
		}
		document.getElementById(menu_id_open).style.visibility = "visible";
		document.getElementById(menu_id_open).style.top = "";
	}
	//РћС‡РёСЃС‚РёС‚СЊ РїРµСЂРµРјРµРЅРЅС‹Рµ
	menu_id_active = menu_id_open;
	interval_menu_open 	 = null;
	menu_id_open		 = null;
}
function close_left_menu(id) {
	//Р—Р°РїСѓСЃС‚РёС‚СЊ РїСЂРѕС†РµРґСѓСЂСѓ Р·Р°РєСЂС‹С‚РёСЏ С‚РµРєСѓС‰РµРіРѕ РјРµРЅСЋ
	if(!interval_menu_close1 && menu_id_close1!=id) {
		opacity_count=1;
		menu_id_close1 = id;
		interval_menu_close1=setInterval("intervalMenuClose('"+id+"',1)",50);
	} else {
		if(interval_menu_close2 && menu_id_close2!=id) {
			intervalMenuClose(menu_id_close2,2);
		}
		if(menu_id_close2 != id) {
			menu_id_close2 = id;
			interval_menu_close2=setInterval("intervalMenuClose('"+id+"',2)",50);
		}
	}
}
function intervalMenuClose(id,interval){
	//РІ Р·Р°РІРёСЃРёРјСЃРѕС‚Рё РѕС‚ Р±СЂР°СѓР·РµСЂР° СѓСЃС‚Р°РЅРѕРІРёС‚СЊ С€Р°Рі Р·Р°С‚РµРјРЅРµРЅРёСЏ
	if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0) {
		var ie=true;
		opacity_count=opacity_count-(opacity_mod*3);
	} else {
		opacity_count=opacity_count-opacity_mod;
	}
	//Р—Р°С‚РµРјРЅРёС‚СЊ РјРµРЅСЋ
	if(id && document.getElementById(id)) {
		//Р•СЃР»Рё РјРµРЅСЋ РїРѕР»РЅРѕСЃС‚СЊСЋ РїРѕРіР°СЃР»Рѕ СЃРєСЂС‹С‚СЊ РµРіРѕ
		if(opacity_count<=0.3) {
			document.getElementById(id).style.visibility = "hidden";
			document.getElementById(id).style.top = "0px";
			document.getElementById(id).style.opacity    = "1";
		} else {
		//РЎРґРµР»Р°С‚СЊ С€Р°Рі Р·Р°С‚РµРјРЅРµРЅРёСЏ
			if(ie) {
//				document.getElementById(id).style.filter ='progid:DXImageTransform.Microsoft.Alpha(opacity='+(opacity_count*100)+')';
			} else {
				document.getElementById(id).style.opacity = opacity_count;
			}
		}
	}
	//Р•СЃР»Рё РјРµРЅСЋ СЃРєСЂС‹С‚Рѕ РѕР±РЅСѓР»РёС‚СЊ РїРµСЂРµРјРµРЅРЅС‹Рµ
	if(opacity_count<=0.1) {
			if(interval_menu_close1) clearInterval(interval_menu_close1);
			menu_id_close1  = null;
			interval_menu_close1 = null;
			if(interval_menu_close2) clearInterval(interval_menu_close2);
			menu_id_close2	= null;
			interval_menu_close2 = null;
	}
}
function show_menu_admin(id) {
	if(document.getElementById(id)) {
		document.getElementById(id).style.visibility = "visible";
	}
}
function hide_menu_admin(id){
	if(document.getElementById(id)) {
		document.getElementById(id).style.visibility = "hidden";
	}
}
var marked_row = new Array;

function markAllRows( container_id ) {
    var rows = document.getElementById(container_id).getElementsByTagName('tr');
    var unique_id;
    var checkbox;

    for ( var i = 0; i < rows.length; i++ ) {

        checkbox = rows[i].getElementsByTagName( 'input' )[0];

        if ( checkbox && checkbox.type == 'checkbox' ) {
            unique_id = checkbox.name + checkbox.value;
            if ( checkbox.disabled == false ) {
                checkbox.checked = true;
                if ( typeof(marked_row[unique_id]) == 'undefined' || !marked_row[unique_id] ) {
                    marked_row[unique_id] = true;
                }
            }
        }
    }

    return true;
}

function unMarkAllRows( container_id ) {
    var rows = document.getElementById(container_id).getElementsByTagName('tr');
    var unique_id;
    var checkbox;

    for ( var i = 0; i < rows.length; i++ ) {

        checkbox = rows[i].getElementsByTagName( 'input' )[0];

        if ( checkbox && checkbox.type == 'checkbox' ) {
            unique_id = checkbox.name + checkbox.value;
            checkbox.checked = false;
            marked_row[unique_id] = false;
        }
    }

    return true;
}

function change_menu(id){
	if(document.getElementById(id)) {
		if(document.getElementById(id).style.visibility=="hidden") {
			document.getElementById(id).style.visibility = "";
//			document.getElementById(id).style.position = "";
			if(document.getElementById('img'+id)) {
				document.getElementById('img'+id).src = "/images/sort1.png";
			}
		} else {
//			document.getElementById(id).style.top = '0px';
			document.getElementById(id).style.visibility = "hidden";
//			document.getElementById(id).style.position = "absolute";
			if(document.getElementById('img'+id)) {
				document.getElementById('img'+id).src = "/images/sort2.png";
			}
		}
	}
}

function clearSearch(par){
	if(par == 1 && document.getElementById('search_string').value == 'РџРѕРёСЃРє') document.getElementById('search_string').value = '';
	else if(par == 0 && document.getElementById('search_string').value == '') document.getElementById('search_string').value = 'РџРѕРёСЃРє';
	}


function toggle_visibility(id, id2, id3) {
	var e = document.getElementById(id);
       var k = document.getElementsByClassName(id2);
       if(e.style.display == 'block'){
          e.style.display = 'none';
          document.getElementById(id3).src = '/images/triangle.png';
       }
       else {
    	   for(var j=0; j<k.length; j++){
    		   k[j].style.display = 'none';
    		   var l = document.getElementsByTagName('span')[j].getElementsByTagName('img')
    	       for(var n=0; n<l.length; n++){
    			   l[n].src = '/images/triangle_dwn.png';
    			   //document.getElementById(id2+'_div_img'+j).src = '/images/triangle.png';
    		   }
    		   //document.getElementById(id2+'_div_img'+j).src = '/images/triangle.png';
    	   }
    	   e.style.display = 'block';
       }
       
      // var e = document.getElementById(id3).src='';
       
   		var m = document.getElementById(id);
       if(m.style.display == 'block'){
       	document.getElementById(id3).src = '/images/triangle.png';
       }
       else {
       	document.getElementById(id3).src = '/images/triangle_dwn.png';
       }
       if(m.style.display == 'none') document.getElementById(id3).src = '/images/triangle_dwn.png';
    }

document.getElementsByClassName = function(cl) {
	var retnode = [];
	var myclass = new RegExp('\\b'+cl+'\\b');
	var elem = this.getElementsByTagName('*');
	for (var i = 0; i < elem.length; i++) {
		var classes = elem[i].className;
		if (myclass.test(classes)) retnode.push(elem[i]);
	}
	return retnode; // РІРѕР·РІСЂР°С‰Р°РµС‚ РјР°СЃСЃРёРІ РѕР±СЉРµРєС‚РѕРІ
}

function Mouse(event)
{
  if(document.attachEvent != null) {  
	x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
        y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
 }
      if (!document.attachEvent && document.addEventListener) {
            x = event.clientX + window.scrollX;
            y = event.clientY + window.scrollY;
      }

	document.getElementById('hid_vid').style.cssText='display: block; position: absolute; left: '+x+'px; top: '+y+'px; width: 360px; height: 240px;';
//document.getElementById('em').innerHTML = "<embed id='embed_vid' type='application/x-shockwave-flash' id='single2' autostart='true' controlbar='none' name='single2' src='/files/player.swf' width='360' height='240' bgcolor='#FFFFFF' allowscriptaccess='always' allowfullscreen='true' wmode='transparent' flashvars='file=http://video.pnz.ru:8012/stream.flv'/>";
jwplayer("em").setup({
	flashplayer: "/files/player.swf",
	file:   "http://video.pnz.ru:8012/stream.flv",
	image:  "preview.jpg",
	controlbar: 'none',	
	autostart: 'true',	
	width:  360,
	height: 240
    });
document.getElementById('ar_img').style.cssText='color: #FFFFFF; background: #FFFFFF; background-color: #FFFFFF; border: 2px solid #FFFFFF';
}
