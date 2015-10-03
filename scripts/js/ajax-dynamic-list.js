/************************************************************************************************************
	(C) www.dhtmlgoodies.com, April 2006

	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.

	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.

	Thank you!

	www.dhtmlgoodies.com
	Alf Magne Kalleland

	************************************************************************************************************/

	var ajaxBox_offsetX = 1;
	var ajaxBox_offsetY = 2;
	var ajax_list_externalPath= '/ajax/';	// Path to external file
	var ajax_list_externalFile = '';	// Path to external file
	var minimumLettersBeforeLookup = 0;	// Number of letters entered before a lookup is performed.

	var ajax_list_objects = new Array();
	var ajax_list_cachedLists = new Array();
	var ajax_list_activeInput = false;
	var ajax_list_activeItem;
	var ajax_list_optionDivFirstItem = false;
	var ajax_list_currentLetters = new Array();
	var ajax_optionDiv = false;
	var ajax_optionDiv_iframe = false;

	var ajax_list_MSIE = false;
	var go_URL = '';
	var old_value = '';
	var is_old_value = false;

	var new_value = '';
	var show_new_value = false;

	var show_on_focus = false;

	var no_old
	var save_inputObj;

	var tip_div = null;

	if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0)ajax_list_MSIE=true;

	var currentListIndex = 0;

	var life_interval;
	var life_interval_id;
	var is_check=0;
	
	function setMyInterval(id){
		if(life_interval && life_interval_id != id) {
			clearInterval(life_interval);
			life_interval = null;
		} 
		if(!life_interval) {
			life_interval_id = id;
			life_interval=setInterval("lifeInterval()",1500);
		}
	}
	
	function unsetMyInterval(id){
		if(life_interval && life_interval_id == id) {
			clearInterval(life_interval);
			life_interval = null;
		} 
	}	
	
	function lifeInterval(){
		document.getElementById(life_interval_id).focus();
		clearInterval(life_interval);
		life_interval = null;
	}

	function ajax_getTopPos(inputObj)
	{

	  var returnValue = inputObj.offsetTop;
	  while((inputObj = inputObj.offsetParent) != null){
	  	returnValue += inputObj.offsetTop;
	  }
	  return returnValue;
	}
	function ajax_list_cancelEvent()
	{
		return false;
	}

	function ajax_getLeftPos(inputObj)
	{
	  var returnValue = inputObj.offsetLeft;
	  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetLeft;

	  return returnValue;
	}

	function ajax_option_setValue(e,inputObj)
	{
		if(!inputObj)inputObj=this;
		var tmpValue = inputObj.innerHTML;
		if(ajax_list_MSIE)tmpValue = inputObj.innerText;else tmpValue = inputObj.textContent;
		if(!tmpValue)tmpValue = inputObj.innerHTML;
		ajax_list_activeInput.value = tmpValue;
		if(document.getElementById(ajax_list_activeInput.name + '_hidden'))document.getElementById(ajax_list_activeInput.name + '_hidden').value = inputObj.id;
		old_value = tmpValue;
		ajax_options_hide();
		if(is_check) {
			rightFilter(go_URL,ajax_list_activeInput.name+'/'+inputObj.id,3,'div_'+is_check) 
		} else {
			location.href = go_URL+'/'+inputObj.id;
		}
	}

	function ajax_options_hide()
	{
		if(save_inputObj) save_inputObj.value = old_value;
		is_old_value = false;
		save_inputObj = false;
		if(tip_div) tip_div.style.visibility='hidden';
		if(ajax_optionDiv)ajax_optionDiv.style.display='none';
		if(ajax_optionDiv_iframe)ajax_optionDiv_iframe.style.display='none';
	}

	function ajax_options_rollOverActiveItem(item,fromKeyBoard)
	{

		if(ajax_list_activeItem)ajax_list_activeItem.className='optionDiv';
		item.className='optionDivSelected';
		ajax_list_activeItem = item;

		if(fromKeyBoard){
			if(ajax_list_activeItem.offsetTop>ajax_optionDiv.offsetHeight){
				ajax_optionDiv.scrollTop = ajax_list_activeItem.offsetTop - ajax_optionDiv.offsetHeight + ajax_list_activeItem.offsetHeight + 2 ;
			}
			if(ajax_list_activeItem.offsetTop<ajax_optionDiv.scrollTop)
			{
				ajax_optionDiv.scrollTop = 0;
			}
		}
	}

	function ajax_option_list_buildList(letters,paramToExternalFile)
	{
		if(!ajax_list_cachedLists[paramToExternalFile][letters.toLowerCase()]) return;
		ajax_optionDiv.innerHTML = '';
		ajax_list_activeItem = false;
		if(ajax_list_cachedLists[paramToExternalFile][letters.toLowerCase()].length<=1){
			letters = new_value;
			if(save_inputObj) save_inputObj.value = new_value;
		}

		if(save_inputObj) new_value = save_inputObj.value;

		ajax_list_optionDivFirstItem = false;
		var optionsAdded = false;
		for(var no=0;no<ajax_list_cachedLists[paramToExternalFile][letters.toLowerCase()].length;no++){
			if(ajax_list_cachedLists[paramToExternalFile][letters.toLowerCase()][no].length==0)continue;
			optionsAdded = true;
			var div = document.createElement('DIV');
			var items = ajax_list_cachedLists[paramToExternalFile][letters.toLowerCase()][no].split(/###/gi);

			if(ajax_list_cachedLists[paramToExternalFile][letters.toLowerCase()].length==1 && ajax_list_activeInput.value == items[0]){
				ajax_options_hide();
				return;
			}


			div.innerHTML = items[items.length-1];
			div.id = items[0];
			div.className='optionDiv';
			div.onmouseover = function(){ ajax_options_rollOverActiveItem(this,false) }
			div.onclick = ajax_option_setValue;
			if(!ajax_list_optionDivFirstItem)ajax_list_optionDivFirstItem = div;
			ajax_optionDiv.appendChild(div);
		}
		if(optionsAdded){
			ajax_optionDiv.style.display='block';
			if(ajax_optionDiv_iframe)ajax_optionDiv_iframe.style.display='';
			if(ajax_list_optionDivFirstItem.nextSibling)
				ajax_options_rollOverActiveItem(ajax_list_optionDivFirstItem.nextSibling,true);
		}

	}

	function ajax_option_list_showContent(ajaxIndex,inputObj,paramToExternalFile,whichIndex)
	{
		if(whichIndex!=currentListIndex) return;
		var letters = inputObj.value;
		var content = ajax_list_objects[ajaxIndex].response;
		if(content) var elements = content.split('|');
		ajax_list_cachedLists[paramToExternalFile][letters.toLowerCase()] = elements;
		ajax_option_list_buildList(letters,paramToExternalFile);

	}

	function ajax_option_resize(inputObj)
	{
		ajax_optionDiv.style.top = (ajax_getTopPos(inputObj) + inputObj.offsetHeight + ajaxBox_offsetY) + 'px';
		ajax_optionDiv.style.left = (ajax_getLeftPos(inputObj) + ajaxBox_offsetX) + 'px';
		if(ajax_optionDiv_iframe){
			ajax_optionDiv_iframe.style.left = ajax_optionDiv.style.left;
			ajax_optionDiv_iframe.style.top = ajax_optionDiv.style.top;
		}

	}

	function ajax_showOptions(inputObj,paramToExternalFile,e,script,url,check)
	{
		is_check = check;
		
		if(e.keyCode==40 || e.keyCode==38) return;

		ajax_list_externalFile = ajax_list_externalPath+script;
		if(e.keyCode==13 || e.keyCode==9) return;

		if(!check) go_URL = url+'/'+paramToExternalFile;
		else go_URL = url;

		if(save_inputObj && is_old_value) {
			if(save_inputObj.id!=inputObj.id) {
				save_inputObj.value = old_value;
				if(tip_div) tip_div.style.visibility='hidden';
				is_old_value = false;
			}
		}

		tip_div = document.getElementById('tip_hidden');
		if(tip_div) {
			tip_div.style.visibility='';
			tip_div.style.left = ajax_getLeftPos(inputObj)+'px';
			tip_div.style.top  = ajax_getTopPos(inputObj)+'px';
		}

		paramToExternalFile = 'sel_item='+paramToExternalFile;

		if(!is_old_value) {
			old_value = inputObj.value;
			is_old_value = true;
			inputObj.value = '';
			save_inputObj = inputObj;
		}

		//if(ajax_list_currentLetters[inputObj.name]==inputObj.value)return;
		if(check || !ajax_list_cachedLists[paramToExternalFile]) //кеширование
		ajax_list_cachedLists[paramToExternalFile] = new Array();
		ajax_list_currentLetters[inputObj.name] = inputObj.value;
		if(!ajax_optionDiv){
			ajax_optionDiv = document.createElement('DIV');
			ajax_optionDiv.id = 'ajax_listOfOptions';
			document.body.appendChild(ajax_optionDiv);
			if(inputObj.name=='dn_int' || inputObj.name=='pn_int' 
				|| inputObj.name=='dn_int0'|| inputObj.name=='pn_int0'
				|| inputObj.name=='dn_int1'|| inputObj.name=='pn_int1') ajax_optionDiv.style.width='70px'
			else ajax_optionDiv.style.width='250px'
		
			if(ajax_list_MSIE){
				ajax_optionDiv_iframe = document.createElement('IFRAME');
				ajax_optionDiv_iframe.border='0';
//				ajax_optionDiv_iframe.style.width = ajax_optionDiv.clientWidth + 'px';
				ajax_optionDiv_iframe.style.height = ajax_optionDiv.clientHeight + 'px';
				ajax_optionDiv_iframe.style.width = ajax_optionDiv.style.width;
				ajax_optionDiv_iframe.id = 'ajax_listOfOptions_iframe';

				document.body.appendChild(ajax_optionDiv_iframe);
			}
			var allInputs = document.getElementsByTagName('INPUT');
			for(var no=0;no<allInputs.length;no++){
				if(!allInputs[no].onkeyup)allInputs[no].onfocus = ajax_options_hide;
			}
			var allSelects = document.getElementsByTagName('SELECT');
			for(var no=0;no<allSelects.length;no++){
				allSelects[no].onfocus = ajax_options_hide;
			}

			var oldonkeydown=document.body.onkeydown;
			if(typeof oldonkeydown!='function'){
				document.body.onkeydown=ajax_option_keyNavigation;
			}else{
				document.body.onkeydown=function(){
					oldonkeydown();
				ajax_option_keyNavigation() ;}
			}
			var oldonresize=document.body.onresize;
			if(typeof oldonresize!='function'){
				document.body.onresize=function() {ajax_option_resize(inputObj); };
			}else{
				document.body.onresize=function(){oldonresize();
				ajax_option_resize(inputObj) ;}
			}

		}
		if(inputObj.name=='dn_int' || inputObj.name=='pn_int' 
		|| inputObj.name=='dn_int0'|| inputObj.name=='pn_int0'
		|| inputObj.name=='dn_int1'|| inputObj.name=='pn_int1') {
			ajax_optionDiv.style.width='70px';
			if(ajax_list_MSIE) ajax_optionDiv_iframe.style.width='70px';
		} else {
			ajax_optionDiv.style.width='250px';
			if(ajax_list_MSIE) ajax_optionDiv_iframe.style.width='250px';
		}
		if(inputObj.value.length<minimumLettersBeforeLookup){
			ajax_options_hide();
			return;
		}


		ajax_optionDiv.style.top = (ajax_getTopPos(inputObj) + inputObj.offsetHeight + ajaxBox_offsetY) + 'px';
		ajax_optionDiv.style.left = (ajax_getLeftPos(inputObj) + ajaxBox_offsetX) + 'px';
		if(ajax_optionDiv_iframe){
			ajax_optionDiv_iframe.style.left = ajax_optionDiv.style.left;
			ajax_optionDiv_iframe.style.top = ajax_optionDiv.style.top;
		}

		ajax_list_activeInput = inputObj;
		ajax_optionDiv.onselectstart =  ajax_list_cancelEvent;
		currentListIndex++;
		if(ajax_list_cachedLists[paramToExternalFile][inputObj.value.toLowerCase()]){
			ajax_option_list_buildList(inputObj.value,paramToExternalFile,currentListIndex);
		}else{
			var tmpIndex=currentListIndex/1;
			ajax_optionDiv.innerHTML = '<img src="/images/progress.gif">';
			var ajaxIndex = ajax_list_objects.length;
			ajax_list_objects[ajaxIndex] = new sack();
			var url = ajax_list_externalFile + '?' + paramToExternalFile + '&letters=' + inputObj.value.replace(" ","+");
			ajax_list_objects[ajaxIndex].requestFile = url;	// Specifying which file to get
			ajax_list_objects[ajaxIndex].onCompletion = function(){ ajax_option_list_showContent(ajaxIndex,inputObj,paramToExternalFile,tmpIndex); };	// Specify function that will be executed after file has been found
			ajax_list_objects[ajaxIndex].runAJAX();		// Execute AJAX function
		}

	}

	function ajax_option_keyNavigation(e)
	{
		if(document.all)e = event;

		if(!ajax_optionDiv)return;
		if(ajax_optionDiv.style.display=='none')return;

		if(e.keyCode==38){	// Up arrow
			if(!ajax_list_activeItem)return;
			if(ajax_list_activeItem && !ajax_list_activeItem.previousSibling)return;
			ajax_options_rollOverActiveItem(ajax_list_activeItem.previousSibling,true);
		}

		if(e.keyCode==40){	// Down arrow
			if(!ajax_list_activeItem){
				ajax_options_rollOverActiveItem(ajax_list_optionDivFirstItem,true);
			}else{
				if(!ajax_list_activeItem.nextSibling)return;
				ajax_options_rollOverActiveItem(ajax_list_activeItem.nextSibling,true);
			}
		}

		if(e.keyCode==13 ){	// Enter key or tab key || e.keyCode==9
			if(ajax_list_activeItem && ajax_list_activeItem.className=='optionDivSelected')ajax_option_setValue(false,ajax_list_activeItem);
			if(e.keyCode==13)return false; else return true;
		}
		if(e.keyCode==27){	// Escape key
			ajax_options_hide();
		}
	}

	document.documentElement.onclick = autoHideList;

	function autoHideList(e)
	{
		if(document.all)e = event;

		if (e.target) source = e.target;
			else if (e.srcElement) source = e.srcElement;
			if (source.nodeType == 3) // defeat Safari bug
				source = source.parentNode;
		if(source.tagName.toLowerCase()!='input' && source.tagName.toLowerCase()!='textarea' && source.id!='sel_element')ajax_options_hide();

	}