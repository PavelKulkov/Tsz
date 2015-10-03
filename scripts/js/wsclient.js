/**
 * 
 */
//var soapServiceURL = '/VISServiceServlet/VisService'; //	/services/visPersonalData/VisService		

  var countWSNow = 0;

  function callWebS(ServiceURL, dataRequest, func, asyn) {
	//alert("Check send message: " + JSON.stringify(dataRequest) + "");
	countWSNow++;
   	 var dataReq = "data=" + JSON.stringify(dataRequest);
   	 if (ServiceURL == VISurl) {
    		dataReq +=  "&"+
  			"transitInfo={'service':"+JSON.stringify(getService())+",'subService':"+JSON.stringify(getIdSubservice())+",'institution':"+JSON.stringify(getIdOrg())+"}";
   	 }
  	 /*var text = 'undefined';
   	 if (ServiceURL == VISurl) {
   		dataReq +=  "&"+
 			"transitInfo={'service':"+JSON.stringify(getService())+",'subService':"+JSON.stringify(getIdSubservice())+",'institution':"+JSON.stringify(getIdOrg())+"}";
		text = 'Подождите, идет вызов сервиса ВИС...';
	}
	else
		text = 'Подождите, идет вызов сервиса АРиТКМВ...';
	if (typeof jQuery.blockUI != 'undefined'){
		showWait(text);
	}
	else{
		$('#exampleModal').arcticmodal({closeOnEsc: false,
		    closeOnOverlayClick: false});
	}*/

	 jQuery.ajax({
	      url: ServiceURL,
	      type: "POST",
	      async: asyn,
	      timeout: 80000,   
	      dataType: "application/json",
	      data: encodeURI(dataReq),

	      xhrFields: {
	    	  withCredentials: false 
	      },
	      
	      beforeSend: function(){
	    	  showTextMessage(ServiceURL);
	      },
	      
	      processData: true, 
	      
	      complete: function (xmlHttpRequest, status, dataResponse) {
	    	  response = JSON.parse(xmlHttpRequest.responseText);
	   // 	    alert('ok : [' + JSON.stringify(response) + ']');
	    	  countWSNow--;
	          func(xmlHttpRequest, status, response);
             		 hideTextMessage();
	        }
	 });   	 
   }

function callWS(ServiceURL, dataRequest) {
	 var response = {};
	 //countWSNow++;
	 jQuery.ajax({
	      url: ServiceURL,
	      type: "POST",
	      async: false,
	      timeout: 80000,   
	      dataType: "application/json",
	      data: "data=" + JSON.stringify(dataRequest),

	      beforeSend: function(){
	    	  showTextMessage(ServiceURL);
	      },
	      processData: true, 
	      complete: function myCallback(xmlHttpRequest, status, dataResponse){
	    		response = JSON.parse(xmlHttpRequest.responseText);
                //countWSNow--;
                hideTextMessage();
	    	}
	 });
	 return response;
}

var needRedirect = true;
function callTransport(ServiceURL, dataRequest) {
	if (typeof jQuery.blockUI != 'undefined'){
		showWait();
	}
	else{
		$('#exampleModal').arcticmodal({closeOnEsc: false,
		    closeOnOverlayClick: false});
	}
	var messager = {
			error : "К сожалению не удалось отправить заявление.\nОбратитесь к администратору системы!\n",
			success : "Ваше заявление успешно отправлено!\n"
	};
	 jQuery.ajax({
	      url: ServiceURL,
	      type: "POST",
	      async: true,
	      timeout: 80000,   
	      dataType: "application/json",
	      data: "data=" + encodeURI(dataRequest),

	  xhrFields: {
	    withCredentials: false 
	  },
	      processData: true, 
	      complete: function myCallback(xmlHttpRequest, status, dataResponse){
			if (typeof jQuery.blockUI != 'undefined'){
				hideWait();
			}
			else{
				$.arcticmodal('close');
			}
	    	response = xmlHttpRequest.responseText;
	    	var success = false;
			var xmlDomElem = StringtoXML(response);
			var text = 'Null';
			if (isResult([xmlDomElem])){
				var resInfo = xmlDomElem.getElementsByTagNameNS('Respounse.xsd', 'RespounseInfo');			
				if (resInfo.length < 1){
					text = messager.error; //'К сожадению не удалось отправить заявление.\nОбратитесь к администратору системы!\n';
				}else{
					var resCode = resInfo[0].getElementsByTagNameNS('Respounse.xsd','Code');
					if (resCode.length < 1){
						text = messager.error; //'К сожадению не удалось отправить заявление.\nОбратитесь к администратору системы!\n';
					}else{
						var code = resCode[0].textContent;
						if ((code == '1')||(code == '2')||(code == '3')||(code == '040')){
						    text = messager.success; //'Ваше заявление успешно отправлено!\n';
						    var comment = resInfo[0].getElementsByTagNameNS('Respounse.xsd', 'Comment');
						    if (comment.length >= 1){
							text += comment[0].textContent;	
						    }
						    success = true;
						}else{
							text = messager.error; //'К сожадению не удалось отправить заявление.\nОбратитесь к администратору системы!\n';		
							var comment = resInfo[0].getElementsByTagNameNS('Respounse.xsd', 'Comment');
						    	if (comment.length >= 1){
						    		text += "Комментарий: " + comment[0].textContent + "\n";	
		 				    	}
							var error = resInfo[0].getElementsByTagNameNS('Respounse.xsd', 'Error');
							if (error.length >= 1){
								var codeErr = error[0].getElementsByTagNameNS('Respounse.xsd', 'Code');
								if (codeErr.length >= 1){
									text += "Код Ошибки: " + codeErr[0].textContent + "\n";	
								}
								var codeComment = error[0].getElementsByTagNameNS('Respounse.xsd', 'Comment');
								if (codeComment.length >= 1){
									text += /*"Ошибка:" + */codeComment[0].textContent + "\n";	
								}	
		 				    	}
						}
					}
				}	
			}else{
				text = messager.error; 
			}
			alert(text);
			if (needRedirect&&success)
    		    		window.location.href = '/web/guest/statuses';
	    		/*if (response.indexOf('ACCEPT') > 0){
	    		    alert('Ваше заявление успешно отправлено!');
	    		    window.location.href = 'https://gosuslugi.e-mordovia.ru/web/guest/statuses';
	    		}
	    		else {
	    		    var text = 'К сожадению не удалось отправить заявление.\nОбратитесь к администратору системы!\n';
	    		    if (response.indexOf('<faultstring>') > 0){
                        text += 'Ошибка: \n' + response.substr(response.indexOf('<faultstring>')+'<faultstring>'.length, response.indexOf('</faultstring>')-response.indexOf('<faultstring>')-'<faultstring>'.length);
                    }
	    		    alert(text);
	    		}*/
	    	}
	 });
	 return response;
}

var t = {};
function callDicWS(ServiceURL, callback) {
	 var response = {};
	 //countWSNow++;
	 jQuery.ajax({
	      url: ServiceURL,
	      type: "GET",
	      async: false,
	      timeout: 80000,   
	      dataType: "application/json",

	      beforeSend: function(){
	    	//  showTextMessage(ServiceURL);
	      },
	      processData: true, 
	      complete: function myCallback(xmlHttpRequest, status, dataResponse){	    		
			response = JSON.parse(xmlHttpRequest.responseText);
	    		//countWSNow--;
	    		//hideTextMessage();
	    		callback(response);
	    	}
	 });
	 return response;
}

function showTextMessage(ServiceURL){
 	//countWSNow++;
 	var text = 'undefined';
 	if (ServiceURL.indexOf(dicUrl) == 0){
     	text = 'Подождите, идет загрузка портальных справочников...';
 	}
 	else
       	if (ServiceURL == VISurl) {
		    text = 'Подождите, идет вызов сервиса ВИС...';
	    }
	    else
		    text = 'Подождите, идет вызов сервиса АРиТКМВ...';
	if (typeof jQuery.blockUI != 'undefined'){
		showWait(text);
	}
	else{
		$('#exampleModal').arcticmodal({closeOnEsc: false,
		    closeOnOverlayClick: false});
	}
}

function hideTextMessage(){
	//countWSNow--;
	if (countWSNow == 0){
		if (typeof jQuery.blockUI != 'undefined'){
			hideWait();
		}
		else{
		    try{
    		    $.arcticmodal('close');
		    }
		    catch(e){}
		}
    }
}

function showWait(text){
	var mesText = text ? text : 'Обработка данных. Пожалуйста, подождите...';
	jQuery.blockUI({
            message:mesText,
            css:{
                border:'solid 2px #3C578C',
                padding:'5px 10px',
                backgroundColor:'white',
                opacity:1,
                color:'#fffff'
            }
        });
}

function hideWait(){
	jQuery.unblockUI();
}

function StringtoXML(text){
	/*if (window.ActiveXObject){
                  var doc=new ActiveXObject('Microsoft.XMLDOM');
                  doc.async='false';
                  doc.loadXML(text);
                } else {
                  var parser=new DOMParser();
                  var doc=parser.parseFromString(text,'text/xml');
	}
	return doc;*/
    try {
        var xml = null;
        if ( window.DOMParser ) {
          var parser = new DOMParser();
          xml = parser.parseFromString( text, "text/xml" );
          var found = xml.getElementsByTagName( "parsererror" );
          if ( !found || !found.length || !found[ 0 ].childNodes.length ) {
            return xml;
          }
          return null;
        } else {
          xml = new ActiveXObject( "Microsoft.XMLDOM" );
          xml.async = false;
          xml.loadXML( text );
          return xml;
        }
      } catch ( e ) {
        // suppress
      }
}

/*
function callSOAPWS(dataRequest)
{		
  var response = {}; 

  alert("Check send message: [" + JSON.stringify(dataRequest) + "]");
  
  $.arcticmodal({
	    type: 'ajax',
	    url: soapServiceURL,
	    ajax: {
	        url: soapServiceURL,
	        type: "POST",
	        timeout: 80000,   
	        dataType: "application/json",
	        data: "data=" + JSON.stringify(dataRequest),

	    xhrFields: {
	      withCredentials: false 
	    },
	        processData: true, 
	        complete: myCallback,

	        success: function( response ){
	            document.getElementById('debug').innerHTML = document.getElementById('debug').innerHTML + '\n' + 'success!' + '\n';
	            alert("success!!!");
	        },

	        error: function(XMLHttpRequest,textStatus, errorThrown){
	            document.getElementById('debug').innerHTML = document.getElementById('debug').innerHTML + '\n' + 'error : ' + textStatus + '\n';
	            //alert("error : " + textStatus);
	        }
	    }
	});
  
 /* success: function(data, el, responce) {
      var h = $('<div class="box-modal">' +
              '<div class="box-modal_close arcticmodal-close">X</div>' +
              '<p><b /></p><p />' +
              '</div>');
      $('B', h).html(responce.title);
      $('P:last', h).html(responce.text);
      data.body.html(h);
  }
  
  jQuery.ajax({
      url: soapServiceURL,
      type: "POST",
      timeout: 80000,   
      dataType: "application/json",
      data: "data=" + JSON.stringify(dataRequest),

  xhrFields: {
    withCredentials: false 
  },
      processData: true, 
      complete: myCallback,

      success: function( response ){
          document.getElementById('debug').innerHTML = document.getElementById('debug').innerHTML + '\n' + 'success!' + '\n';
          alert("success!!!");
      },

      error: function(XMLHttpRequest,textStatus, errorThrown){
          document.getElementById('debug').innerHTML = document.getElementById('debug').innerHTML + '\n' + 'error : ' + textStatus + '\n';
          //alert("error : " + textStatus);
      }

}); //

  
  return response;
}

function myCallback(xmlHttpRequest, status, dataResponse)
{
	response = JSON.parse(xmlHttpRequest.responseText)
	document.getElementById('debug').innerHTML = document.getElementById('debug').innerHTML + '\n' + 'result : [' + JSON.stringify(response) + ']' + '\n';
    alert('ok : [' + JSON.stringify(response) + ']');
    stopLoadingAnimation();
    return response;
}

function OnLoadXML () {
    FillTable ();
}

function OnStateChange () {
    if (xmlDoc.readyState == 0 || xmlDoc.readyState == 4) {
        FillTable ();
    }
}

function FillTable () {
    var errorMsg = null;
    if (xmlDoc.parseError && xmlDoc.parseError.errorCode != 0) {
        errorMsg = "XML Parsing Error: " + xmlDoc.parseError.reason
                  + " at line " + xmlDoc.parseError.line
                  + " at position " + xmlDoc.parseError.linepos;
    }
    else {
        if (xmlDoc.documentElement) {
            if (xmlDoc.documentElement.nodeName == "parsererror") {
                errorMsg = xmlDoc.documentElement.childNodes[0].nodeValue;
            }
        }
    }
    if (errorMsg) {
        alert (errorMsg);
        return null;
    }

    var resTable = document.getElementById ("resTable");
    var xmlNodes = ["title", "description", "pubDate", "link"];

    var itemTags = xmlDoc.getElementsByTagName ("item");
    for (i = 0; i < itemTags.length; i++) {
        resTable.insertRow (i);
        for (j = 0; j < xmlNodes.length; j++) {
            var recordNode = itemTags[i].getElementsByTagName (xmlNodes[j])[0];
            resTable.rows[i].insertCell (j);
            if ('textContent' in recordNode)
                resTable.rows[i].cells[j].innerHTML = recordNode.textContent;
            else
                resTable.rows[i].cells[j].innerHTML = recordNode.text;
        }
    }
}

function CreateMSXMLDocumentObject () {
    if (typeof (ActiveXObject) != "undefined") {
        var progIDs = [
                        "Msxml2.DOMDocument.6.0", 
                        "Msxml2.DOMDocument.5.0", 
                        "Msxml2.DOMDocument.4.0", 
                        "Msxml2.DOMDocument.3.0", 
                        "MSXML2.DOMDocument", 
                        "MSXML.DOMDocument"
                      ];
        for (var i = 0; i < progIDs.length; i++) {
            try { 
                return new ActiveXObject(progIDs[i]); 
            } catch(e) {};
        }
    }
    return null;
}

function CreateXMLDocumentObject (rootName) {
    if (!rootName) {
        rootName = "";
    }
    var xmlDoc = CreateMSXMLDocumentObject ();
    if (xmlDoc) {
        if (rootName) {
            var rootNode = xmlDoc.createElement (rootName);
            xmlDoc.appendChild (rootNode);
        }
    }
    else {
        if (document.implementation.createDocument) {
            xmlDoc = document.implementation.createDocument ("", rootName, null);
        }
    }
    
    return xmlDoc;
}


function LoadXML () {
    xmlDoc = CreateXMLDocumentObject ();    // defined in ajax.js
    if (!xmlDoc) {
        return;
    }

    var url = "req.xml";
    xmlDoc.async = true;
    if (xmlDoc.addEventListener) {
        xmlDoc.addEventListener("load", OnLoadXML, false);
    }
    else {
        xmlDoc.onreadystatechange = OnStateChange;
    }
    xmlDoc.load (url);
}

//Changes XML to JSON
function xmlToJson(xml) {
	
	// Create the return object
	var obj = {};

	if (xml.nodeType == 1) { // element
		// do attributes
		if (xml.attributes.length > 0) {
		obj["@attributes"] = {};
			for (var j = 0; j < xml.attributes.length; j++) {
				var attribute = xml.attributes.item(j);
				obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
			}
		}
	} else if (xml.nodeType == 3) { // text
		obj = xml.nodeValue;
	}

	// do children
	if (xml.hasChildNodes()) {
		for(var i = 0; i < xml.childNodes.length; i++) {
			var item = xml.childNodes.item(i);
			var nodeName = item.nodeName;
			if (typeof(obj[nodeName]) == "undefined") {
				obj[nodeName] = xmlToJson(item);
			} else {
				if (typeof(obj[nodeName].push) == "undefined") {
					var old = obj[nodeName];
					obj[nodeName] = [];
					obj[nodeName].push(old);
				}
				obj[nodeName].push(xmlToJson(item));
			}
		}
	}
	return obj;
};   */
