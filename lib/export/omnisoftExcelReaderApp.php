<html>
<head>
<?php 
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

?>
</head>
<body background="../../images/bg_blue_v.jpg">

<?php if ($_POST['ingresofoto']!=1) { ?>
<form method="POST" enctype="multipart/form-data"    id="PaginaDatos"  name="PaginaDatos" action="omnisoftExcelReaderApp.php">
<input name="foto" type="file" id="foto" size="30" maxlength="255"  >
<input name="ingresofoto" type="hidden" id="ingresofoto"  value="1" >
<input name="campoarchivo" type="hidden" id="campoarchivo"  value="<?php echo $_GET['campoarchivo'];?>" >


<input type="submit" value="Cargar Archivo">
</form>
<?php
} else {
function cargarValorFactura($fecha,$codigo_alu,$valor)
{
 global $DBConnection;

 $dblink = NewADOConnection($DBConnection);


$sqlcommand = "select serial_caf, total_caf from alumno, paralelo_alumno, cabecerafactura where paralelo_alumno.serial_alu=alumno.serial_alu and cabecerafactura.serial_paralu=paralelo_alumno.serial_paralu and alumno.id_alumno='".trim($codigo_alu)."' and year(fecha_caf)=year('".$fecha."') and month(fecha_caf)=month('".$fecha."')";


//echo $sqlcommand.'<br>';

$rsfactura=$dblink->Execute($sqlcommand);

//if($rsfactura->fields[1]>$valor)
	$sqlupdate = "update cabecerafactura set abono_caf=abono_caf+".$valor." where serial_caf=".$rsfactura->fields[0];

//echo $sqlupdate.'<br>';

$rsfactura=$dblink->Execute($sqlupdate);
}

 function procesar($fila,$ncols,$obj) {
//  echo "fila=$fila col=$ncols $obj<br>";
  $datos=explode('|',$obj);

//  for ($i=0; $i <$ncols; $i++) {
   if ($fila>2){
   $registro=explode("~",$datos[0]);
	   $codigo=($registro[1]=='unknown')?procesarFecha($registro[0]):$registro[0];
   $registro=explode("~",$datos[5]);
	   $fecha=($registro[1]=='unknown')?procesarFecha($registro[0]):$registro[0];
   $registro=explode("~",$datos[4]);
	   $valor=($registro[1]=='unknown')?procesarFecha($registro[0]):$registro[0];

	cargarValorFactura($fecha,$codigo,$valor);
//	 echo $fila."  ".$i."  ".$valor."<br>";
  }


 }



$archivo='';
function omnisoftImportFile() {
  global  $_FILES,$_GET,$archivo;

  $archivo=$_SERVER['DOCUMENT_ROOT'].'/academium/archivos/'.$_FILES['foto']['name'];
if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
    copy($_FILES['foto']['tmp_name'], $archivo);
    require_once 'omnisoftExcelReader.php';
    require('../adodb/adodb.inc.php');
    require('../../config/config.inc.php');
  $excelOBJ=new OmnisoftExcelReader($archivo,"procesar");

  $excelOBJ->readSheet();


} else
    return  0;

   return 1;
}
  if (!empty($_FILES['foto']))
  if (omnisoftImportFile()==1)   {
//    echo '<center><image name="imgfoto" width="180" height="180" src="../../fotos/'.$_FILES['foto']['name'] .'"></center>';
    echo '<script> top.opener.document.PaginaDatos.'.$_POST['campoarchivo'].'.value="'.$_FILES['foto']['name'].'";</script>';
    echo "Archivo cargado exitosamente!";
    //top.opener.document.PaginaDatos.imgfoto.src="../fotos/'.$_FILES['foto']['name'].'";</script>';
   echo "1|";

  }
  else {
   echo "<script> alert('Error: No se puede cargar el archivo' ); </script>";
     echo "0|";

  }

}
?>


</body>
</html>
