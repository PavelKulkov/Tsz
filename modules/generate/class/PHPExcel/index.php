<?php

include_once 'Classes/PHPExcel/IOFactory.php';


//Файлы у меня валятся в папку upload в корне сайта, замените на свою.
$uploaddir = $modules_root."/generate/class/PHPExcel/upload/";

$uploadfile = $uploaddir . basename($_FILES['fileTz']['name']);

move_uploaded_file($_FILES['fileTz']['tmp_name'], $uploadfile);

// Открываем файл
$xls = PHPExcel_IOFactory::load($uploaddir.$_FILES['fileTz']['name']);

$pagination = "<div class='pagination_bootstrap pagination_bootstrap-large'><ul>";
$list = "";


/*
for ($i=1; $i <= $xls->getSheetCount(); $i++) {

	$pagination .= "<li><span><a href='#'>".$i."</a></span></li>";

}

$pagination .= "</ul></div>";
echo $pagination ;

*/

for ($i=0; $i < $xls->getSheetCount(); $i++) {

// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex($i);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
 
$list .=  "<table id='listTz_".$i."' class='table table-striped table-bordered table-hover table-condensed'>";
 
// Получили строки и обойдем их в цикле
$rowIterator = $sheet->getRowIterator();
foreach ($rowIterator as $row) {
    // Получили ячейки текущей строки и обойдем их в цикле
    $cellIterator = $row->getCellIterator();
 
    $list .= "<tr>";
         
    foreach ($cellIterator as $cell) {
        $list .= "<td><strong>" . $cell->getCalculatedValue() . "</strong></td>";
    }
     
    $list .= "</tr>";
}
$list .= "</table>";
	
}

echo $list;

unlink($uploaddir.$_FILES['fileTz']['name']);

