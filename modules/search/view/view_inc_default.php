<?php
	$text = '';
	$text .= "<form id=\"search-block-form\" class=\"form-search\" action=\"/search?is_news=true&is_service=true&is_organisation=true\" method = \"GET\" onsubmit=\"if(getElementById('search_string').value=='') {alert('Поле поиска не может быть пустым!'); return false; }\">";
	$text .= '	<div class="form-item">
					<input type="text" name="search_string" value="" placeholder="Поиск"  size="45" maxlength="100" class="search-query"  id="search_string" />
				</div>
				<div class="form-actions">';
	$text .= '		<div style="display: none;">
						<label class="checkbox"><input type="checkbox" name="is_news" checked> Новости </label>
						<label class="checkbox"><input type="checkbox" name="is_service" checked> Услуги </label>
						<label class="checkbox"><input type="checkbox" name="is_organisation" checked> Организации </label>
					</div>
				</div>
			</form>';
