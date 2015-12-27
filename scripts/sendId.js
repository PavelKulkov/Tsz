$(document).ready(function(){
    $('._adminAddObject_').click(function() {
        var idGroupForAdd = ($(this).attr('id'));
		$('#idGroupForAdd').val(idGroupForAdd);
    });
	
	$('._adminDelObject_').click(function() {
        var id = ($(this).attr('id'));
		if(id[0].localeCompare('G') === 0){
			$('#IdGroupForDel').val(id.slice(5));
			$('#IdDocForDel').val();
			
		}
		else{
			$('#IdDocForDel').val(id.slice(3));
			$('#IdGroupForDel').val();
		}
    });
	
	
});