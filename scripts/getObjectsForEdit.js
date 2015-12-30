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
				$('#image_uploaded_edit_object').append("<img id='image"+doc.id+"' src='../files"+doc.image+"'>");
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
				$('#titleProject').val(project.title);
				$('#idProject').val(project.id);
				$('#textProject').val(project.text);
			}
		})
     
    });

});