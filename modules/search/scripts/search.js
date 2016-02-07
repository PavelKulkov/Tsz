$(function(){
		$('.nameTsz').bind("change keyup input click", function() {
			 
			if(this.value.length >= 2){
				var valueLow =this.value.toLowerCase();
				tmp = valueLow.slice(1);
				result = valueLow.charAt(0).toUpperCase()+tmp;
				$(".listTsz :contains('"+result+"')").attr("selected", "selected");

	        }
	    });
})