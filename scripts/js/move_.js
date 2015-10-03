function Mover(ptr) {
	ptr.style.background = 'url("/images/main.gif") repeat-x top';
	ptr.style.bgColor = '#DDDDDD';
}
function Mout(ptr) {
	ptr.style.background = 'none';
	ptr.style.bgColor = '#FFFFFF';
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

function searchReply() {
	if(div_reload_name) {
		if(request_type.readyState == 4){
			var response = request_type.responseText;
			var str = new String(response);
			var Text = str.split("#####");
			if(Text[1]) {
				document.getElementById(div_reload_name).innerHTML = Text[0];
				document.getElementById('menu2').innerHTML = Text[1];
			} else {
				document.getElementById(div_reload_name).innerHTML = response;
			}
			if(div_reload_name=='auth_form' && document.getElementById('needReload')) {
				if(document.getElementById('referer')) {
					if(document.getElementById('referer').value) {
						window.location.href = document.getElementById('referer').value;
					}
				} else {
					window.location.reload();
				}
			}
		}
		if(document.getElementById('tmp_value')) {
			document.getElementById(hidd_name).value = document.getElementById('tmp_value').value;
		}
	}
}

function shopButton(url, div){
	div_reload_name = div;
	if(element_id) {
		request_type.open('POST', '/ajax/'+url, true);
		request_type.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var param = 'element_id='+element_id;
		if(document.getElementById('col')) {
			param = param +'&col='+document.getElementById('col').value;
		} else {
			param = param +'&col=1';
		}
		param = param +'&price='+price;
		request_type.setRequestHeader("Content-length", param.length);
		request_type.setRequestHeader("Connection", "close");
	} else {
		request_type.open('GET', '/ajax/'+url, true);
	}
	request_type.onreadystatechange = searchReply;
	request_type.send(param);
	return false;
}

function delShopPos(){
	document.form_recnt.recnt.disabled = 0;
	document.form_recnt.bill.disabled = 1;
	if(element_id) {
		document.getElementById('row_shop_'+element_id).innerHTML = '<td></td>';
		return false;
	}
}

function getElementPosition(elemId) {
    var elem = elemId;
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

function showFoto(url,title,width) {
	var body = document.body;
	    var docElem = document.documentElement;

	    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
	    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;

	    var clientTop = docElem.clientTop || body.clientTop || 0;
	    var clientLeft = docElem.clientLeft || body.clientLeft || 0;

	    var top  = scrollTop - clientTop;
	    var left = scrollLeft - clientLeft;


	cover = window.parent.document.createElement( 'div' ) ;
	var opacity = " opacity: 0.4;";
	if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0) {
		opacity = "filter: progid:DXImageTransform.Microsoft.Alpha(opacity=40)";
	}
	page_size = getPageSize();
	cover.style.cssText ="position: absolute; top: 0px;left: 0px; background-color: #dddddd; width: 100%; height: "+document.getElementById('main_tbl').offsetHeight+"px;"+opacity;
	cover.id = 'cover';
	document.body.appendChild(cover) ;
	cover1 = window.parent.document.createElement( 'div' ) ;
	cover1.id = 'cover1';
	cover1.style.cssText ="position: absolute; top: "+top+"px;left: 0px; width: 100%;  cursor:pointer; height: 100%; text-align: center; vertical-align: middle;";
	cover1.innerHTML = '<table align="center" width="'+(width+20)+'" height="100%"><tr><td><div style="background-color: #FFFFFF; padding: 10px; border: 1px solid #aaa; width: '+(width+20)+'px;"><img src="'+url+'" width="'+width+'" title="'+title+'" onClick="hideFoto(\'cover\',\'cover1\')"><br><b style="color: #000000;">'+title+'</b></td></tr><table>';
	window.parent.document.body.appendChild(cover1) ;
	return false;

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


function hideFoto(element1,element2){
	el2 = document.getElementById(element2);
	window.parent.document.body.removeChild(el2);
	el1 = document.getElementById(element1);
	window.parent.document.body.removeChild(el1);
}

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

function clearSearch(){
	document.getElementsByName('search_text').search_text.value = '';
	}

