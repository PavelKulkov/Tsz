<script type="text/javascript">


   //$('#printDocument').click(function(){
	function printDocument() {
	 try {
		$('div#output').html('');
		/*
		$('form[enctype="multipart/form-data"]').find('input').each(function(){	
			if (this.type == 'file') {
				var textEl = $(this).val().replace(/.*(\/|\\)/, '');
				var cell = $(this).parent('td');
				$('<input type="text" name="' + this.name + '" value="' + textEl + '" style="margin-left: -9999px" />').appendTo($(cell).closest('td'));
			}
		});
		*/
		
		$('div#output').html($('form[enctype="multipart/form-data"]').clone());
		
		$('form[enctype="multipart/form-data"]').find('input, textarea').each(function(){	
			var nameEl = this.name;
			if (this.type == 'textarea') {
				var textEl = $(this).val();
				$('div#output textarea[name=' + this.name + ']').text(textEl);
			} 
		});
		

		//$('div#output').find('input[type="file"]').remove();


		$('div#output .tab-pane').show();

		$('div#output .tab-pane:last').remove();
	   
		$('div#output .tab-pane').find('input, textarea, select, button').each(function(){	
			
		
				if (this.type == 'button' || this.type == 'submit') {
					$(this).remove();	
				} 
			
				
				if ($(this).val() != '' || $(this).text() != '' || $(this).attr('src') != '') {	
				var value;
					if (this.nodeName == 'SELECT') {
						$('select[name="' + this.name + '"] option:selected').each(function() {
							if ($(this).val() != '') {
								value = $( this ).text() + " ";
							}
						});
					} else if (this.type == 'file') {
						$(this).closest('tr').remove();
					} else if (this.type == 'checkbox') {
							if ($(this).attr('checked') != 'checked') {
								$(this).closest('tr').remove();
							} else {
								value = '<b>V</b>';	
							}
					} else {						
						value = $(this).val();	
					}
				}

				if (typeof value == 'undefined') {
					value = 'Не указано.';
				}
				
				if (value == '') {
					$(this).closest('tr').remove();
				}
				
				
		
				
				$(this).after('<span class="printInfoTags">' + value + '</span>').remove();
				
				$('span.printInfoTags').closest('td').css({'width': '50%'});
				$('span.printInfoTags').closest('tr').children('td').css({'vertical-align':'bottom', 'padding':'5px'});
				
				
				
				$('div#output ul').remove();
				$('div#output legend').css({'font-size':'22px'});
				$('div#output div.tab-pane table').css({'width': '100%', 'background': '#e5f1f4'});
				$('div#output div.tab-pane table tr').css({'vertical-align':'bottom'});

				//$('div.tab-pane table tr:nth-child(even)').css({'background': '#f8f8f8'});
				//$('div.tab-pane table tr:nth-child(odd)').css({'background': '#e5f1f4'});
		});

		var printOutput = $('div#output').html();
		var frame = document.getElementById('printOutput');		
		var doc = frame.contentWindow.document;
		
		
			doc.open();
			doc.write(printOutput);
			doc.close();
			frame.contentWindow.focus();
			//frame.contentWindow.document.execCommand('print', false, null);
			frame.contentWindow.print();
		} catch ( e ) {
			  alert("Error: " + e.description );
		   }
	}	   
	//});

</script>