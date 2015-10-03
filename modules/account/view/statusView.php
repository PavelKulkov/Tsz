<?php
	if (isset($fileUrl) && $fileUrl != "")	
			echo '<script>function closeModal(elem){$(elem).closest(".modal").hide(); $(elem).closest(".modal").next(".modal-backdrop").hide();}</script><div class="modal" id="modalCloneBlocks" style="width: 550px; left: 50%; top: 30%;" tabindex="-1" role="dialog" aria-labelledby="createCloneBlock" data-backdrop="static" aria-hidden="true">
	    <div class="modal-header">
		<button type="button" class="close" style="width: 25px; height: 25px;" data-dismiss="modal" onclick="closeModal(this);" aria-hidden="true">×</button>
		<h3>Статус заявки</h3>
	    </div>
	    <div class="modal-body" style="text-valign: top; max-height: 100%;">
		<table>
			<tr>
				<td>
					<spna>Статус:</span>
				</td>
				<td>
					<input disabled="disabled" type="text" value="'.State::getStateName($status).'" class="blockName" style="width: 350px; text-align: center;">
				</td>
			</tr>
			<tr>
				<td>
					<spna>Комментарий:</span>
				</td>
				<td>
					<textarea disabled="disabled" value="'.$comment.'" type="text" class="cloneBlockMin" style="width: 350px; height: 100px; resize:none; text-align: center;">'.$comment.'</textarea>
				</td>
			</tr>
			<tr>
				<td>
					<spna>Файл:</span>
				</td>
				<td>
					<a href="'.$fileUrl.'">Результат исполнения заявки - '.$fileName.'</a>
				</td>
			</tr>
		</table>
	    </div>
	    <div class="modal-footer">
		<button class="btn" data-dismiss="modal" onclick="closeModal(this);" aria-hidden="true">Закрыть</button>
	    </div>
	</div><div class="modal-backdrop  in"></div>';
?>