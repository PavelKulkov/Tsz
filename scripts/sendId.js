$(document).ready(function(){
    $('._adminAddObject_').click(function() {
        var idGroupForAdd = ($(this).attr('id'));
		$('#idGroupForAdd').val(idGroupForAdd);
		
    });
	
	$('._adminDelObject_').click(function() {
        var id = ($(this).attr('id'));
		$('#IdForDel').val(id);
    });
	
	
});