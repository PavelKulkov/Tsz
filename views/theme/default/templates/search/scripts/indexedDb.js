<script type="text/javascript"> 
		var indexedDB = window.indexedDB || window.webkitIndexedDB || window.mozIndexedDB || window.msIndexedDB;
        var IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange
        var IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction;
        var db;
        var now = new Date();
		var new_version = now.getDate();


$(document).ready(function() {       
	for (var i = 1; i < new_version; i++) {
		window.indexedDB.deleteDatabase("SearchDB_"+i);	
	}
	
	
     var request = indexedDB.open("SearchDB_"+new_version, 1);  
        request.onsuccess = function (evt) {
            db = request.result;                                                              
        };

        request.onerror = function (evt) {
            console.log("IndexedDB error: " + evt.target.errorCode);
        };

        request.onupgradeneeded = function (evt) { 
        	                  
            var objectStore = evt.currentTarget.result.createObjectStore(
                     "data", { keyPath: "id", autoIncrement: true });

            objectStore.createIndex("meta", "meta", { unique: true });
          	objectStore.createIndex("type", "type", { unique: false });
        };    
	
});



function getLocalData() {
	var transaction = db.transaction(["data"]);
	var objectStore = transaction.objectStore("data");
	
	var request = objectStore.count();
	
	request.onsuccess = function(evt) {
		if (evt.target.result == 0) {
			$(".tab-pane").hide();
			$(".search_tab").css("visibility", "hidden");
			$("#loader").show();
			console.log("Загрузка распределенной базы данных!");
			$.ajax({
				url: '/scripts/ajax.php?module_name=search&operation=getLocalData',
		    	dataType : "json",
		    	success: function (result) {
		    		try{   					
		    			var writeTrans = db.transaction(["data"], IDBTransaction.READ_WRITE);
		    		}catch(e){
						alert('Невозможно соединится с распреденной базой данных' + e);
				  		return;	
					}
		    		var store = writeTrans.objectStore("data");  
			    	for (i in result) {    						
			 			store.add({ "key_words": result[i]["key_words"], "type": result[i]["type"], "meta": result[i]["meta"], description: result[i]["description"], url: result[i]["url"]});
			        }
					console.log("База успешно загружена!");

					searchData();
				} 
			});	
		} else {
		searchData();
		}
    };

}	



function processInfo() {
	if($('#websql').attr("checked") == 'checked') { 
		if($("#search_replace").val() == "") {
			alert("Поле поиска не может быть пустым!");
			return false;
		}
		
		
		getLocalData();

		
			
			return false;	
		} else {
				return false;
			}
}  


function searchData() {
	$("#loader").hide();
	var search_str = document.getElementById("search_replace").value;
   	var search_terms = search_str.split(" ");
 	var thelength = search_terms.length - 1;

    var transaction = db.transaction(["data"], IDBTransaction.READ_WRITE);
	    
	var objectStore = transaction.objectStore("data");

	function strpos( haystack, needle, offset){// Find position of first occurrence of a string
		var i = haystack.indexOf( needle, offset ); // returns -1
		return i >= 0 ? i : false;
	}

	$('#details').html('<table class="table table-bordered"><tr><td><b>Тип</b></td><td><b>Описание</b></td><td><b>Осн. данные</b></td><td><b>Ссылка</b></td></tr>');
	var organisation_count = 0;
	var services_count = 0;
	var request = objectStore.openCursor();

	request.onsuccess = function(evt) {  
		
		var cursor = evt.target.result;  
		
		
		if (cursor) {
			
				
			
			
			
			var str = cursor.value.key_words;
			for (var k=0; k<=thelength; k++){
				
				if (cursor.value.type == 'organisation') {
					cursor.value.type = 'Организация';
		 		}
		 		if (cursor.value.type == 'service') {
		 			cursor.value.type = 'Услуга';
		 		
		 		}
		  		
				
				if (strpos(" " + str.toLowerCase(), search_terms[k].trim(), 0) != false) {
					var links = '';
					var meta_data = '';
					var meta_datas = cursor.value.meta;
					var urls = cursor.value.url;
					var url_list;
//					alert((" " + urls).indexOf(','));
					
					meta_list = (" " + meta_datas).split('<split>');
					url_list = (" " + urls).split(',');
					meta_data += '<div><div style="margin-right: 220px;">'+meta_list[0]+ '</div><div style="float: right; margin-top: -19px;"><a class="btn btn-success" href="'+ urls[0]+'" target="_blank">Подробнее<i class="icon-chevron-right icon-white"></i></a></div></div><br /><br />';
					if (meta_list.length > 1 ) {
						meta_data += '<br /><br /><b>Подуслуги:</b><br />';
						for (var k=0; k<meta_list.length; k++) {
							meta_data += '<div><div style="margin-right: 220px;">'+meta_list[k]+'</div><div style="float: right; margin-top: -29px; margin-bottom: 2px;"><a class="btn btn-success" href="'+urls[k]+'" target="_blank">Подробнее<i class="icon-chevron-right icon-white"></i></a></div></div><br /><br />';
						}
					}
					
					/*
					url_list = (" " + urls).split(',');
					for (var m=0; m<url_list.length; m++) {
						links += '<a class="btn btn-success" href="'+url_list[m]+'">Подробнее<i class="icon-chevron-right icon-white"></i></a><br /><br />';
					}
*/
					
					$('table.table-bordered').append('<tr><td>'+cursor.value.type+'</td><td style="width: 300px;"><span class="label label-info pull-right" style="width: 300px; float:none; white-space: normal;">'+cursor.value.description+'</span></td><td colspan="2">'+meta_data+'</td></tr>');
					links = '';
					meta_data = '';
					
				}	
			}	                            
    		cursor.continue();
    		
		} 
	};

	$(".tab-pane").hide();
	$(".search_tab").css("visibility", "hidden");
	
	$('#details').append('</table>');	
	$("#loader").hide();
	return false;
}
</script>