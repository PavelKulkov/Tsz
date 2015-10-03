<?php
	if ($list) {
		$text =  $paginator['text'];
		if ($admin) {
				echo "<div align=\"left\">
						<a class=\"btn btn-success\" href=\"news?operation=create\">Добавить новость<i class=\"icon-chevron-right icon-white\"></i></a>
					</div>";
		}
			
		foreach ($list as $entry) {
		$text .= '	<article class="thumbnail" style="background: #f8f8f0">';
		$text .= '	<table id="news" cellpadding="0" cellspacing="0" width="100%" style="padding: 15px 0;">
						<tbody>
							<tr>
								<td valign="top" align="center" width="80">';
		$text .= '					<span style="color: #6faa1e; padding: 5px 0;">'.date('d.m.Y H:i',strtotime($entry['date'])).'</span>';
		$text .= '				</td>
								<td valign="top">
									<div style="padding: 0 0 5px 5px;">';
		$text .=  '						<a href="news?id_news='.$entry['id'].'">'.$entry['title'].'</a>
									</div>';
		$text .= '					<div style="padding: 0 0 15px 5px;">
										<a href="news?id_news='.$entry['id'].'" style="font-size:12px; text-decoration: none; color: #777777;">'.$entry['annotation'].'</a>
									</div>';
			if ($admin) {
		$text .= "				<div align=\"right\">
									<button type=\"submit\" onclick=\"location.href='news".$url."id_news=".$entry['id']."&operation=edit'\" class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i>Редактировать</button>
									<a class=\"btn btn-danger confirm-delete\" data-id='".$entry['id']."'><i class=\"icon-trash icon-white\"></i> Удалить</a>
								</div>";
			} else {
		$text .= '					<div align="right">
										<a class="btn btn-success" href="news?id_news='.$entry['id'].'">Читать<i class="icon-chevron-right icon-white"></i></a>
					  				</div>';
			}
		$text .= '				</td>
							</tr>
						</tbody>
					</table>';
		$text .= '</article><br />';

		}
		
		
		$confirm = "<script type=\"text/javascript\">
				$('.confirm-delete').click(function(e) {
				    e.preventDefault();
				    var id = $(this).data('id');
				    $('#modal-from-dom').data('id', id).modal('show');
					    removeBtn = $('#modal-from-dom').find('.btn-danger')
				    href = removeBtn.attr('href');
				    removeBtn.attr('href', href.replace(/(\d*)id_news=\d*/, 'id_news=' + id));
				})
				</script>
				<style>
					button {border: 1px #AAA solid; padding: 4px 10px;}
					.hide {display: none;}​
				</style>
				<div id='modal-from-dom' align=\"center\" class='modal hide fade'>
				    <div class='modal-header'>
				      <a href='' class='close'>&times;</a>
				      <h3>Удаление!</h3>
				    </div>
				    <div class='modal-body'>
				      <p>Элемент удаляется без возможности восстановления!</p>
				      <p>Вы уверены что хотите продолжить?</p>
				    </div>
				    <div align=\"center\" class='modal-footer'>
				      <a href='news".$url."id_news=0&operation=del' class='btn btn-danger'><i class=\"icon-remove-circle icon-white\"></i>Да</a>
				      <a href=\"javascript:$('#modal-from-dom').modal('hide')\" class=\"btn btn-primary secondary\"><i class=\"icon-share-alt icon-white\"></i>Отмена</a>
				    </div>
				</div>
				";
		
		$text .= $confirm; 
		
		$text .= $paginator['text'];
	}
	
	