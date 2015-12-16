$(function(){
		$('.nameTsz').bind("change keyup input click", function() {
			 
			if(this.value.length >= 2){
				var valueUp = this.value;
				tmp = valueUp.slice(1);
				result = valueUp.charAt(0).toUpperCase()+tmp;
				
				$(".listTsz :contains('"+result+"')").attr("selected", "selected");

	        }
	    });
})