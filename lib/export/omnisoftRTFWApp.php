<?php

        require('omnisoftRTFW.php');

	$sql=str_replace("\"", "'",$_POST['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);
            $fields=$_POST['fields'];
    if ($fields=="")  {
      echo  "Advertencia: NO existen datos, por favor seleccione las columnas para generar el reporte!";
       return;
    }
	$imagePath="prueba/images/themes/paulovi";
	$omnisoftNombreEmpresa="SICCEC";

    $printOBJ=new OmnisoftRTFW($imagePath.'/logo.jpg',$_POST['title'],$omnisoftNombreEmpresa,'ACADEMIUM',$sql,$_POST['orientation']);
    $sFields = explode('|',$fields);


   for ($i=0; $i < count($sFields)-1 ; $i++) {

   $field=explode('~',$sFields[$i]);
   $type=($field[3]=='INTEGER' || $field[3]=='DOUBLE' || $field[4]=="SUM")?'number':'string';
   $align=($type=='number')?'right':'left';
   $printOBJ->addColumn($field[0],$field[1],$field[2],$type,$align,$field[4]);

   }

  $printOBJ->showIt();

?>