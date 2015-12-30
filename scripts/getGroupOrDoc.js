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
				$('#image_uploaded_edit_object_group').append("<img id='image"+group.id+"' src='"+group.image+"'>");
				
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
				$('#image_uploaded_edit_object').append("<img id='image"+doc.id+"' src='"+doc.Name+"'>");
			}
		})
     
    });

});