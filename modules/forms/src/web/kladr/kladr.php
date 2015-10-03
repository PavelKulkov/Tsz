<?php

	$dictionaryCode = $request->getValue('dictionaryCode');
	$parentDictionaryCode = "";
	$parentItemCode = "";
	if ($request->hasValue('parentDictionaryCode'))
		$parentDictionaryCode = "&parentDictionaryCode=".$request->getValue('parentDictionaryCode');
	if ($request->hasValue('parentItemCode'))
		$parentItemCode = "&parentItemCode=".$request->getValue('parentItemCode');
	
	  
	$urlReq = "http://58.gosuslugi.ru/mr05/widgets/lookup/dictionary?serial=4&dictionaryCode=".$dictionaryCode.$parentDictionaryCode.$parentItemCode."&getBreadCrumbs=&itemsPerPage=5000&pageIndex=1&searchText=&param_excludeCodes=&optionsMap=%7B%7D";
	$list = $urlReq;
	try {
		$list = file_get_contents($urlReq);
	} catch (HttpException $ex) {
		$list = "{error : {code : 404}}";
		echo $ex;
	}
?>