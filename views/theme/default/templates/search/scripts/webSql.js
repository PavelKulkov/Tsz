<script type="text/javascript"> 

	var now = new Date();
	var new_version = now.getDate();

	
	db = openDatabase("services", "1.0", "services_db", 2*1024*1024); //Open Database

	

		function processInfo(){
			if($('#websql').attr("checked") == 'checked') { 
				if($("#search_replace").val() == "") {
  					alert("Поле поиска не может быть пустым!");
    				return false;
  				}
				
				if (db){ //If database exists
		
					db.transaction(function(tx) {
						tx.executeSql("SELECT COUNT(*) FROM `search_"+new_version+"`", [], null, function (tx, error) {
							tx.executeSql("CREATE TABLE search_"+new_version+" (`type` varchar(30),`meta` text DEFAULT NULL, `description` varchar(255) DEFAULT NULL, `url` varchar(255))", [],null, null);
							
							$(".tab-pane").hide();
							$(".search_tab").css("visibility", "hidden");
							$("#loader").show();
							console.log("Загрузка распределенной базы данных!");
							$.ajax({
				    			url: '/scripts/ajax.php?module_name=search&operation=getLocalData',
		    					dataType : "json",
		    					success: function (result) {
	    							var a = new Array()
	    							db.transaction(
										function(t){
	    									for(var i = 0; i < result.length; i++) {
												t.executeSql("INSERT INTO `search_"+new_version+"` VALUES (?, ?, ?, ?)", [result[i]['type'], result[i]['meta'], result[i]['description'], result[i]['url']]	);
		    								}
										}
									);
								console.log("База успешно загружена!");
								search_list();
	    						} 
							});
			
							for (var i=1; i<new_version; i++) {
								tx.executeSql("DROP TABLE IF EXISTS `search_"+i+"`");
							}
						})
					});
				} else	{
					alert("no db open");
				}
				
				search_list();
				return false;	
			} else {
				return false;
			}
		}
	
		function search_list(){	
			$("#loader").hide();
			var search_query = $('#search_replace').val();
					
			var search_terms = search_query.split(" "); //split keywords into an array
			var sqlstring =  "Select `type`, `meta`, `description`, `url` from `search_"+new_version+"` where ";
	
			var thelength = search_terms.length - 1;
			var searchquery_value = $('#search_replace').val();

			var service_chk = $("#is_service").attr("checked");
			var organisation_chk = $("#is_organisation").attr("checked");

			if (service_chk && organisation_chk) { 
				for (var k=0; k<=thelength; k++){
					if (k != thelength){
						sqlstring +=  " `meta` like '\%"+search_terms[k].trim()+"\%' OR";
					} else if ( k == thelength) {
						sqlstring +=  " `meta` like '\%"+search_terms[k].trim()+"\%'";
					}
				}
			} else
			if (organisation_chk) {
				for (var k=0; k<=thelength; k++){
					if (k != thelength){
						sqlstring +=  " type=\"organisation\" AND `meta` like '\%"+search_terms[k].trim()+"\%' OR";
					} else if ( k == thelength) {
						sqlstring +=  " type=\"organisation\" AND `meta` like '\%"+search_terms[k].trim()+"\%'";
					}
				}
			} else
			
			if (service_chk) {
				for (var k=0; k<=thelength; k++){
					if (k != thelength){
						sqlstring +=  " type=\"service\" AND `meta` like '\%"+search_terms[k].trim()+"\%' OR";
					} else if ( k == thelength) {
						sqlstring +=  " type=\"service\" AND `meta` like '\%"+search_terms[k].trim()+"\%'";
					}
				}
			} 
			
			else { 
				for (var k=0; k<=thelength; k++){
					if (k != thelength){
						sqlstring +=  " `meta` like '\%"+search_terms[k].trim()+"\%' OR";
					} else if ( k == thelength) {
						sqlstring +=  " `meta` like '\%"+search_terms[k].trim()+"\%'";
					}
				}
			}

	
			var meta;
			var description;
			var url;
			var type;
	
			var resultsdiv  = document.getElementById('details');
			var organisation_div  = document.getElementById('organisations');
			var services_div  = document.getElementById('services');
			
			organisation_div.innerHTML ="";
			services_div.innerHTML ="";
	

				db.transaction(
					function(t){
						t.executeSql(sqlstring, [], function(t,r){
							if (r.rows.length == 0) {
								var resultsdiv  = document.getElementById('details');
								resultsdiv.innerHTML = "По вашему запросу ничего не найдено! Попробуйте еще раз!";
							} 
							var organisation_count = 0;
							var services_count = 0;
							$('#details').html('<table class="table table-bordered"><tr><td><b>Тип</b></td><td ><b>Описание</b></td><td><b>Осн. данные</b></td><td style="width: 170px;"><b>Ссылка</b></td></tr>');
							
							var links = '';
							var meta_data = '';
							
						 	for (j=0;j<r.rows.length; j++){				 		
						 		type = r.rows.item(j).type;
						 		if (type == 'organisation') {
						 			type = 'Организация';
						 		}
						 		if (type == 'service') {
						 			type = 'Услуга';
						 		}
						 		
						 		description = r.rows.item(j).description;
						 		
								meta_list = r.rows.item(j).meta.split('<split>');
								urls = r.rows.item(j).url.split(',');
								meta_data += '<div><div style="margin-right: 220px;">'+meta_list[0]+ '</div><div style="float: right; margin-top: -19px;"><a class="btn btn-success" href="'+ urls[0]+'" target="_blank">Подробнее<i class="icon-chevron-right icon-white"></i></a></div></div><br /><br />';
								if (meta_list.length > 1 ) {
									meta_data += '<br /><br /><b>Подуслуги:</b><br />';
									for (var k=0; k<urls.length; k++) {
										meta_data += '<div><div style="margin-right: 220px;">'+meta_list[k]+'</div><div style="float: right; margin-top: -29px; margin-bottom: 2px;"><a class="btn btn-success" href="'+urls[k]+'" target="_blank">Подробнее<i class="icon-chevron-right icon-white"></i></a></div></div><br /><br />';
									}
								}
//								urls = r.rows.item(j).url.split(',');
	//							for (var m=0; m<urls.length; m++) {
		//							links += '<a class="btn btn-success" href="'+urls[m]+'" target="_blank">Подробнее<i class="icon-chevron-right icon-white"></i></a><br /><br />';
			//					}
								
								
								$('table.table-bordered').append('<tr><td>'+type+'</td><td style="width: 300px;"><span class="label label-info pull-right" style="width: 300px; float:none; white-space: normal;">'+description+'</span></td><td colspan="2">'+meta_data+'</td></tr>');
								links = '';
								meta_data = '';
								/*								
								if (r.rows.item(j).type == "organisation") {
						 			organisation_count++;
						 			organisation_div.innerHTML += "<article class=\"well\"><span class=\"label label-info pull-right\">"+description+"</span>"+meta+"<a class=\"btn btn-success\" href=\""+url+"\">Подробнее<i class=\"icon-chevron-right icon-white\"></i></a></p></article>";
						 		} else if (r.rows.item(j).type == "service") {
						 			services_count++;
						 			services_div.innerHTML += "<article class=\"well\"><span class=\"label label-info pull-right\">"+description+"</span>"+meta+"<a class=\"btn btn-success\" href=\""+url+"\">Подробнее<i class=\"icon-chevron-right icon-white\"></i></a></p></article>";
						 		}
						 		*/
							}
							$(".tab-pane").hide();
							$(".search_tab").css("visibility", "hidden");
							$('#details').append('</table>');	
							/*
							$("#news").text("");
							$('#service_badge').removeClass("badge-success");
							$('#organisation_badge').removeClass("badge-success");					
							
							$('#service_badge').text(services_count);
							if (services_count > 0) {
								$('#service_badge').addClass("badge-success");
							} else {
								services_div.innerHTML += "<p>Результаты поиска по услугам: </p><p>Нет услуг, удовлетворяющих запросу</p>";
							}
							
							$('#organisation_badge').text(organisation_count);
							if (organisation_count > 0) {
								$('#organisation_badge').addClass("badge-success");
							} else {
								organisation_div.innerHTML += "<p>Результаты поиска по организациям: </p><p>Нет организаций, удовлетворяющих запросу</p>";
							}
							*/
							
//							$(".tab-pane").hide();
//							$(".search_tab").css("visibility", "hidden");
						}, function(t,e){});
					}
				);	
		};

//} else {
//	$.ajax({
//  		type: "POST",
//  		url: "/modules/search/scripts/indexedDb.js",
//  		dataType: "script"
//	});
	
	
//	alert("It seems that your browser does not support WebSQL databases. Please use a browser which does.");

</script>