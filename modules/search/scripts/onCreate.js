<script type="text/javascript">
function browserDetectNav(chrAfterPoint)
{
var
    UA=window.navigator.userAgent,       // содержит переданный браузером юзерагент
    //--------------------------------------------------------------------------------
	OperaB = /Opera[ \/]+\w+\.\w+/i,     //
	OperaV = /Version[ \/]+\w+\.\w+/i,   //	
	FirefoxB = /Firefox\/\w+\.\w+/i,     // шаблоны для распарсивания юзерагента
	ChromeB = /Chrome\/\w+\.\w+/i,       //
	SafariB = /Version\/\w+\.\w+/i,      //
	IEB = /MSIE *\d+\.\w+/i,             //
	SafariV = /Safari\/\w+\.\w+/i,       //
        //--------------------------------------------------------------------------------
	browser = new Array(),               //массив с данными о браузере
	browserSplit = /[ \/\.]/i,           //шаблон для разбивки данных о браузере из строки
	OperaV = UA.match(OperaV),
	Firefox = UA.match(FirefoxB),
	Chrome = UA.match(ChromeB),
	Safari = UA.match(SafariB),
	SafariV = UA.match(SafariV),
	IE = UA.match(IEB),
	Opera = UA.match(OperaB);
		
		//----- Opera ----
		if ((!Opera=="")&(!OperaV=="")) browser[0]=OperaV[0].replace(/Version/, "Opera")
				else 
					if (!Opera=="")	browser[0]=Opera[0]
						else
							//----- IE -----
							if (!IE=="") browser[0] = IE[0]
								else 
									//----- Firefox ----
									if (!Firefox=="") browser[0]=Firefox[0]
										else
											//----- Chrom ----
											if (!Chrome=="") browser[0] = Chrome[0]
												else
													//----- Safari ----
													if ((!Safari=="")&&(!SafariV=="")) browser[0] = Safari[0].replace("Version", "Safari");
//------------ Разбивка версии -----------

	var
            outputData;                                      // возвращаемый функцией массив значений
                                                             // [0] - имя браузера, [1] - целая часть версии
                                                             // [2] - дробная часть версии
	if (browser[0] != null) outputData = browser[0].split(browserSplit);
	if ((chrAfterPoint==null)&&(outputData != null)) 
		{
			chrAfterPoint=outputData[2].length;
			outputData[2] = outputData[2].substring(0, chrAfterPoint); // берем нужное ко-во знаков
			return(outputData);
		}
			else return(false);
}


$(document).ready(function(){
		data = browserDetectNav();      //вызываем функцию, параметр НЕ передаем,
			                             //поэтому в результате получим все знаки версии после запятой
        if ( (data[0] == "Chrome" && data[1] < 4) 
        	|| (data[0] == "Firefox" && data[1] < 16) 
        	|| (data[0] == "Opera" && data[1]+'.'+data[2] < 66.5) 
        	|| (data[0] == "MSIE" && data[1] < 666) 
        	|| (data[0] == "Safari" && data[1]+'.'+data[2] < 4)) {
        		
        	$('#websql').hide();
        	$('#websql_label').hide();
        	return false;
        } else {
        	$('#websql').show();
        	$('#websql_label').show();
        	return false;
        }
//		alert(data[0] + data[1]+'.'+data[2]); //выводим результат

     
});


		$("input#websql").change(function(){
			if ($(this).attr("checked")) {			
				$("#is_news").hide();
				$("#news").css("vicibiliy", "hidden");
				$("ul li a#news_link").hide();
				$("form#searchEngine").attr("action", "#").attr("method", "").attr("onsubmit", "return processInfo();");
				return false;
				} else {
				$("#is_news").show();
				$("#news").css("vicibiliy", "visible").html("<p>Результаты поиска по новостям: </p><p>Нет новостей, удовлетворяющих запросу</p>");
				$("#news_badge").text("0").removeClass("badge-success");
				$("ul li a#news_link").show();
				$("form#searchEngine").attr("action", "search?is_news=true&is_service=true&is_organisation=true").attr("method", "POST").attr("onsubmit", "return emptySearch();");
			}   
			});
		
			
			function moreSearchResults(el) {
				var redirect_name = $(el).attr("id").split("_").pop();
				var current_search_link = $("div.search_tabs ul.search_tabNavigation li.current");
				current_search_link.removeClass("current"); 
				$("div.search_tabs ul.search_tabNavigation li#search_block_" + redirect_name).addClass("current");
				emptySearch();
			}
			
		
		
		function search_block_change(el){
			$("div.search_result_block > div").hide();
		
			var block_name = $(el).parent("li").attr("id").split("_").pop(); // Определение наименования показываемого блока (services, organizations  и т.д.)
		
			// Определяем текст в кликнутой ссылке и текст в текущей вкладке, чтобы поменять местами. 
			var link_text = $(el).text();
			var current_link = $("div.search_tabs ul.search_tabNavigation li.current");   
			var prev_link_text = current_link.text();
			
			current_link.removeClass("current").html("<a class=\"srch\"  onclick=\"search_block_change(this);\" >" + prev_link_text + "</a>");
			$(el).parent("li").text(link_text).addClass("current");
			
			$("div#search_block_" + block_name).show();
			
			emptySearch();
		};
</script>