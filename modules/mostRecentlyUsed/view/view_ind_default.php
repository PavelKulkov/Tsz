<?php
	$text = '<div class="news_title" style="margin-left: 20px; margin-bottom: -20px;">Популярные услуги</div>';
	$text .= '<div class="main">
				
				<!--<div class="prev"><img src="/templates/newdesign/images/leftArr.jpg" alt="" title=""></div> -->
				
				<div class="gallery" style="margin-left: 23px;">
					<ul>';
					for ($i = 0; $i <= MOST_RECENTLY_USED_SUBSERVICES_COUNT; $i++) {
					
						if (strlen($services[$i]['service_name']) > 150) {
							
							$service_name = substr($services[$i]['service_name'], 0, 150);
							$service_name = rtrim($service_name, "!,.-");
							$service_name = substr($service_name, 0, strrpos($service_name, ' '));
							$service_name = $service_name."...";
							$service_title = $services[$i]['service_name'];
							
							unset($services[$i]['service_name']);
						}
						
						
	$text .= '			<li class="parent" style="height: 72px;">
							<div class="for_align">
								<div class="child"><a href="/services?service_id='.$services[$i]['service_id'].'" title="'.$services[$i]['service_name'].$service_title.'" >'.$service_name.$services[$i]['service_name'].'</a></div>
							</div>
						</li>';
						
						unset($service_name);
						unset($service_title);
						
					}
	$text .= '		</ul>					
				</div>
				<div class="next"><img src="/templates/newdesign/images/rightArr.jpg" alt="" title=""></div>
				
			</div>
			<div class="cl"></div>
			
				<script>				
				jQuery(".gallery").jCarouselLite({
					btnNext: ".next",
					btnPrev: ".prev",
					liHeight: 72
					
				});
				</script>
				
				
			

				
			';
			
		