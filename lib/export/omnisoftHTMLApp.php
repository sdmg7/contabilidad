<?php

        require('omnisoftHTML.php');

	$sql=str_replace("\"", "'",$_POST['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

    $printOBJ=new OmnisoftHTML($imagePath.'',$_POST['title'],$omnisoftNombreEmpresa,'ACADEMIUM',$sql,$_POST['orientation']);
    $fields=$_POST['fields'];

    $sFields = explode('|',$fields);


   for ($i=0; $i < count($sFields) ; $i++) {
    $field=explode('~',$sFields[$i]);
   // $fieldname=strtoupper($field[1]);
    $printOBJ->addColumn($field[0],$field[1],$field[2]);
 //   echo $field[0]."-".$field[1]."<br>";
   }

  $printOBJ->showIt();

?>