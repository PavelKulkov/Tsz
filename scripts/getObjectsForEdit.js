$(document).ready(function(){
    $('._adminEditObjectGroup_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/documentation/src/getGroup.php",
			type:"post",
			data:{"idGroup":id},
			success:function(data){
				var group = jQuery.parseJSON(data);
				$('#titleGroup').val(group.groupOfDoc);
				$('#idGroup').val(group.id);
				$('#image_uploaded_edit_object_group').append("<img id='image"+group.id+"' src='../files"+group.image+"'>");
				
			}
		})
     
    });
	$('._adminEditObject_').click(function() {
		var idDoc =($(this).attr('id'));
		$.ajax({
			url:"../modules/documentation/src/getDoc.php",
			type:"post",
			data:{"idDoc":idDoc},
			success:function(data){
				var doc = jQuery.parseJSON(data);
				$('#titleDoc').val(doc.title);
				$('#idDoc').val(doc.id);
				$('#image_uploaded_edit_object').append("<img id='image"+doc.id+"' src='../files"+doc.path+"'>");
			}
		})
     
    });
	$('._adminEditObjectPartner_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/partners/src/getPartner.php",
			type:"post",
			data:{"idPartner":id},
			success:function(data){
				var partner = jQuery.parseJSON(data);
				$('#titlePartner').val(partner.title);
				$('#idPartner').val(partner.id);
				$('#sitePartner').val(partner.site);
				$('#image_uploaded_edit_object').append("<img id='image"+partner.id+"' src='../files"+partner.image+"'>");
				$('#file_name_edit_object p').empty();
				var mas = partner.image.split('/');
				$('#file_name_edit_object p').append(mas[2]);
			}
		})
     
    });
	$('._adminEditObjectProject_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/partners/src/getProject.php",
			type:"post",
			data:{"idProject":id},
			success:function(data){
				var project = jQuery.parseJSON(data);
				$('#titleEditProject').val(project.title);
				$('#idProject').val(project.id);
				//$('#textProject').val(project.text);
				$('#image_uploaded_edit_object_group').append("<img src='../files"+project.image+"'>");
				$('#file_name_edit_object_group p').empty();
				var mas = project.image.split('/');
				$('#file_name_edit_object_group p').append(mas[2]);
			}
		})
     
    });
	$('._adminEditObjectQuestions_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/questions/src/getQuestion.php",
			type:"post",
			data:{"idQuestion":id},
			success:function(data){
				var question = jQuery.parseJSON(data);
				$('#titleQuestion').val(question.title);
				$('#idQuestion').val(question.id);
				$('#idGroupForEdit').val(question.groupsQuestion);
				$('#answer').val(question.answer);
			}
		})
     
    });
	$('._adminEditObjectContact_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/contact/src/getContacts.php",
			type:"post",
			data:{"nameField":id},
			success:function(data){
			
			}
		})
     
    });
	
	//Редактирование ТСЖ
	$('._adminEditObjectRegistry_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/registry/src/getReg.php",
			type:"post",
			data:{"idTsz":id},
			success:function(data){
				var reg = jQuery.parseJSON(data);
				$("#titleTsz").val(reg.title);
				$('#idTsz').val(reg.id);
				$('#editCoordsTsz').val(reg.breadth + "," + reg.longitude);
				$('#addressTszEditCoord').val(reg.address);
				$('#phoneNumberTsz').val(reg.phoneNumber);
				$('#e_mailTsz').val(reg.e_mail);
				$('#faxTsz').val(reg.fax);
				$('#surnamePresident').val(reg.surnamePresident);
				$('#namePresident').val(reg.namePresident);
				$('#patronymicPresident').val(reg.patronymicPresident);
				$('#siteTsz').val(reg.site);
			    $('#area-'+reg.groupsArea).attr("selected","selected");
				$('#file_name_edit_object_group p').empty();
				$('#file_name_edit_object_group p').append(reg.logo);
				$('#image_uploaded_edit_object_group').append("<img id='image"+reg.id+"' src='../files/Registry/"+reg.logo+"'>");
			}
		})
    });
	
	
	
	//Добавление вопроса
	$('._adminAddObject_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/questions/src/getGroup.php",
			type:"post",
			data:{"idGroupForAdd":id},
			success:function(data){
				var group = jQuery.parseJSON(data);
				$('#idGroupForAdd').val(group.id);
			}
		})
     
    });
	/*Редактирование группы вопроса*/
	
	$('._adminEditGroup_').click(function() {
		var id =($(this).attr('id'));
		$.ajax({
			url:"../modules/questions/src/getGroup.php",
			type:"post",
			data:{"idGroupForAdd":id},
			success:function(data){
				var group = jQuery.parseJSON(data);
				$('#idGroup').val(group.id);
				$('#titleGroupQuestions').val(group.groupsQuestion);
			}
		})
     
    });
	
	
	//Добавление координат по адресу ТСЖ для метки на карте
	function getCoors(idFieldAddress, idHiddenField){
		var address = $(idFieldAddress).val();
		
		ymaps.ready(init);
		function init(){
			var myGeocoder = ymaps.geocode(address);
            myGeocoder.then(
                function (res) {
					var coords = res.geoObjects.get(0).geometry.getCoordinates();
				
					if($(idHiddenField).val() != ""){
						$(idHiddenField).val("");
					}
					
					$(idHiddenField).val(coords);
                },
                function (err) {
                // обработка ошибки
                }
            );
		}
	}
	
	//Добавление ТСЖ
	$('#addressTszAddCoord').change(function() {
		getCoors("#addressTszAddCoord", "#addCoordsTsz");
	});
	//Редактирование ТСЖ
	$('#addressTszEditCoord').change(function() {
		getCoors("#addressTszEditCoord", "#editCoordsTsz");
	});
	
	$('#addressTszAddCoord').blur(function() {
		if($('#addressTszAddCoord').val() === ""){
			$('#addCoordsTsz').val('');
		}
	});
	
	$('#addressTszEditCoord').blur(function() {
		if($('#addressTszEditCoord').val() === ""){
			$('#editCoordsTsz').val("");
		}
	});
	
});