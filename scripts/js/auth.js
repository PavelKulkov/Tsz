		$(document).ready(function(){
		
						$("#esia").click();
   						$("#enter_form").hide();
   						$("#submitINN").hide();
 						$("div.error_msg").hide();						
   			

		   				$("#enter_option").click(function(){							
							$("#myModal").modal("show");

		   					return false;
						});
					});
   			
   			
   					$("#passExists").change(function(){
   						if($(this).is(":checked")) {
   							$("#submitPassBtn").hide();
   						} else {
   							$("#submitPassBtn").show();
   						}					
					});
   			
   					$("#enter_btn").click(function(){
 						if ($("#passExists").attr("checked") == "checked") {
   							$("div.error_msg").hide();
   							var phone = $("#phone").val();
	   						var password = $("#password").val();
   							enter(phone, password);
   						}					
					});
   			
   					$(".enter_radio").click(function(){
   						$("div.error_msg").hide();
   						var enter_val = $(this).val();
   								
   						if (enter_val == 0 || enter_val == 1) {
   							if (enter_val == 1) {
   								$("#submitINN").slideDown(600);
   							} else {
   								$("#submitINN").slideUp(600);
   								$("#submitPassBtn").click(function(){
   									$("#submitPassBtn").hide();
									$("#passExists").attr("checked", "checked");

   									$("div.error_msg").hide();
									var phone = $("#phone").val();
   									if (phone == "") {
   										alert("Введите номер телефона в формате 7XXXXXXXX")
   										return false;
   									} else {
   										$("div.error_msg").html("<span style=\"color: #228B22;\">Пароль выслан на указанный номер!</span>").show();
   										$.ajax({
										   	dataType: "json",
										  	contentType: "application/json; charset=utf-8",
										   	type: "GET",
										   	async: true,
										   	url: "scripts/ajax.php?module_name=webservice&name=authorize&phone=7" + phone,
										   	success: function (response) {
   												if(response.data.status_code == "01") {    													
   													$("#enter_btn").show();   																						
   													$("#enter_btn").click(function(){
   														$("div.error_msg").hide();
   														var password = $("#password").val();
   														if (password == "") {
					   										alert("Введите пароль, присланный по СМС!");
   															return false;
					   									}
   			
   														enter(phone, password);
													});
   												} else {
   													$("div.error_msg").text(response.data.status_title).show();
   												}
										   	}
										});
   									}
								});
   							}
   							$("#enter_form").slideDown(600);
   						} else if (enter_val == 2) {
   							$("#enter_btn").show();
   							$("#submitINN").hide(500);
   							$("#enter_form").slideUp(600);
   							$("#enter_btn").click(function(){
								window.location = "/esia/module.php/core/authenticate.php?as=default-sp";
							});
   						} else if (enter_val == 3) { 
							$("#enter_btn").click(function(){
								window.location = "/auth/UEC.html";
							});
   						} else {
   							alert("Выберите один из вариантов входа!");
   							return false;		
   						}   		
					});
   			
   					function enter(phone, password) {
						 $.ajax({
						     dataType: "json",
						     contentType: "application/json; charset=utf-8",
						     type: "GET",
						     async: true,
						     url: "scripts/ajax.php?module_name=webservice&name=authorize&phone=7" + phone + "&pass=" + password,
						     success: function (response) {
						     	if(response.data) {
   									window.location="/";	
   								} else {
   									$("div.error_msg").text("Неверный пароль! Повторите еще раз!").show();
   								}
						     }
						});   						
   					}
