$(function() {
	$('input.inputCell').each(function() {
		$(this).validator(
				{
					format : 'decimal',
					invalidEmpty : false,
					error : function() {
						$(this).select();
						var inputId = $(this).attr('id');
						var inputId_num = inputId.substr(4);
						$("#prices_form #vres_cost" + inputId_num).text('(С‚РѕР»СЊРєРѕ С†РёС„СЂС‹)');
					},
					correct : function() {
						var inputId = $(this).attr('id');
						var inputId_num = inputId.substr(4);
						$("#prices_form #vres_cost" + inputId_num).text('');
					}
		});
	});
	$('input.inputCell_monthly').each(function() {
		$(this).validator(
				{
					format : 'decimal',
					invalidEmpty : false,
					error : function() {
						$(this).select();
						var inputId = $(this).attr('id');
						var inputId_num = inputId.substr(4);
						$("#prices_form #vres_cost" + inputId_num).text('(С‚РѕР»СЊРєРѕ С†РёС„СЂС‹)');
					},
					correct : function() {
						var inputId = $(this).attr('id');
						var inputId_num = inputId.substr(4);
						$("#prices_form #vres_cost" + inputId_num).text('');
					}
		});
	});
});