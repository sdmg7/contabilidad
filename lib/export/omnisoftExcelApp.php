<?php
require('omnisoftExcel.php');

	$sql=str_replace("\"", "'",$_POST['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);



header("Content-Type: application/x-msexcel");
  $omnisoftNombreEmpresa='';
  $fields=$_POST['fields'];
  $title=$_POST['title'];
  if ($title!='')
    $title=utf8_decode($title);
   
  $imagePath="selmhos/images/themes/paulovi";
  $excelOBJ=new OmnisoftExcel($imagePath.'/logo.jpg',$omnisoftNombreEmpresa,$title,$omnisoftNombreEmpresa,$sql);
  $sFields = explode('|',$fields);


   for ($i=0; $i < count($sFields)-1 ; $i++) {
    $field=explode('~',$sFields[$i]);
    $fieldname=strtoupper($field[1]);
    $excelOBJ->addColumn($field[0],$field[1]);
   }
  $excelOBJ->showIt();

 $fname = tempnam("c:\\tmp", "omnisoftExcelApp.xls");
 $fh=fopen($fname, "rb");
 fpassthru($fh);
 unlink($fname);
?>