<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php
$status ="";
if($_POST["action"]=="upload"){
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];

if($archivo !=""){
	
	
	$destino="files/".$archivo;
	if (copy($_FILES['archivo']['tmp_name'],$destino)) {
		$status = "Archivo subido: <b>".$archivo."</b>";
	}
	}


}

$databasehost = "localhost";
$databasename = "auditoria";
$databasetable = "BALANCE";
$databaseusername ="fmartine";
$databasepassword = "fmarti";

$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
@mysql_select_db($databasename) or die(mysql_error());


// Clases Php
/*$path = $_GET['file'];*/
require_once("Classes/PHPExcel.php");
require_once("Classes/PHPExcel/Reader/Excel2007.php");
require_once 'Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("files/".$archivo);

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
 
	
for ($row = 1; $row <= $highestRow; ++ $row) {
    $val=array();
    for ($col = 0; $col < $highestColumnIndex; ++ $col) {
    $cell = $worksheet->getCellByColumnAndRow($col, $row);
    $val[] = $cell->getValue();
  
}

$sql="insert into BALANCE (serial_emp,cuenta_bal, concepto_bal, saldo_bal,periodo_bal ) values($serial_emp,$val[0], '".$val[1]."', $val[2],$periodo_bal)";

mysql_query($sql);

}
}
@mysql_close($con);
?>


</body>
</html>