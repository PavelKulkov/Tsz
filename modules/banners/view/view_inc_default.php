<?php

	$text = '	<div class="rule"></div>
				<h3 class="title_blank">Партнёры</h3>';

	$text .= "	<table width='100%'>
					<tr>
					  <td>
						<center><a href='http://www.gosuslugi.ru'>Федеральный портал государственных и муниципальных услуг
						  <p><img alt='' border='0' height='83' hspace='0' src='/templates/images/epgu.jpg' vspace='0' width='186' /></p>
						</a></center>
					  </td>
					  <td> 
						<center><a href='http://www.mfcinfo.ru/'>Портал многофункциональных центров Пензенской области
						  <p><img alt='' border='0' height='83' hspace='0' src='/templates/images/mfc.jpg' vspace='0' width='186' /></p>
						</a></center>
					  </td>    
					  <td> 
						<center><a href='/forms?subservice_id=71'>ГИБДД УМВД России по Пензенской области
						  <p>Просмотр штрафов</p>
						  <p><img alt='' border='0' height='80' hspace='0' src='/templates/images/gibdd.jpg' vspace='0' width='100' /></p>
						</a></center>
					  </td>    
					</tr>
			
					<!--
					<tr>
					  <td>
						<center><a href='/forms?subservice_id=72'>Министерство здравоохранения Пензенской области
						  <p>Запись на прием к врачу</p>
						  <p><img alt='' border='0' height='80' hspace='0' src='/templates/images/aid.png' vspace='0' width='100' /></p>
						</a></center>    
					  </td>
					  <td>
						<center><a href='/forms?subservice_id=69'>
						  <p>Зачисление детей в детские сады Пензенской области</p>
						  <p><img alt='' border='0' hspace='0' src='/templates/images/bars.png' vspace='0' style=\"height:84px;width:433\"/></p>
						</a></center>    
					  </td>  
					</tr>
					-->
					<tr>
					  <td>
						<center><a href='http://58-gov.ru/' target='_blank'>Исполнительные органы государственной власти Пензенской области
						  <p><img alt='' border='0'  hspace='0' src='/templates/images/gosIExecute.png' vspace='0' width='300' height='80' /></p>
						</a></center>    
					  </td>  
					</tr>
					</table>";

	$text .= '	<script type="text/javascript">
					$(document).ready(function(){
				    	$("div#content_content").removeClass().addClass("content");
						$("div#content_center").removeClass().addClass("center");
						$("div#content_navigation").html("<a href=\"/\">Главная</a>  / Партнёры");
						$("div#content_line").removeClass().addClass("blue_line");
					});
				</script>';