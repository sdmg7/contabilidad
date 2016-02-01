<?php


require_once 'excel/reader.php';

function leapYear($year) {
  if ($year%4!=0)
     return false;
   if ($year % 100 != 0) {

       return true;
	}
   if ($year % 400 != 0)
                return false;
    else
                return true;
}

/*
function procesarFecha($valor) {
  echo $valor."<br>";
$year= ($valor/365)+1900;
$month=floatVal(($valor%365)/31);
echo $month."<br>";
$day=floatVal(($valor%365)%31);
$v=$valor-($valor%365/31)*$month;
if ($v!=0)
   $day++;

if (leapYear($year))
    $day++;


$fecha=sprintf("%04d-%02d-%02d",$year,$month,$day);
echo $fecha."<br>";
return $fecha;


}

*/

function procesarFecha($nSerialDate) {

    if ($nSerialDate == 60)
    {
        $nDay    = 29;
        $nMonth    = 2;
        $nYear    = 1900;
        return "2009-02-28";
    }
    else if (nSerialDate < 60)
    {
 //       $nSerialDate++;
    }

    // Modified Julian to DMY calculation with an addition of 2415019
    $l = $nSerialDate + 68569 + 2415019;
    $n = intVal(( 4 * $l ) / 146097);
    $l = $l - intVal(( 146097 * $n + 3 ) / 4);
    $i = intVal(( 4000 * ( $l + 1 ) ) / 1461001);
    $l = $l - intVal(( 1461 * $i ) / 4) + 31;
    $j = intVal(( 80 * $l ) / 2447);
     $nDay = $l - intVal(( 2447 * $j ) / 80);
        $l = intVal($j / 11);
        $nMonth = $j + 2 - ( 12 * $l );
    $nYear = 100 * ( $n - 49 ) + $i + $l;
    $fecha=sprintf("%04d-%02d-%02d",$nYear,$nMonth,$nDay);
//    echo $fecha."<br>";
   return $fecha;
}
 class OmnisoftExcelReader {
               var $filename;        // CHAR, nombre del archivo a leer
               var $record;             // OBJECT, registro actual
               var $columnCount;                  // INT, numero de columnas
               var $rowCount;           //INT, numero de filas
               var $worksheet;           // OBJECT, contiene el objeto para el manejo de la hoja
               var $dataProcess;           // FUNCTION, permite procesar los datos de la hoja excel

                //  NOMBRE:  OmnisoftExcelReader
                //  DESCRIIPCIÓN:  Lee un archivo excel
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  5)       Afilename             char        100           nombre del archivo
                //  VALOR RETORNO:   objeto de la clase OmnisoftExcelReader

                function __construct($Afilename,$AdataProcess)
                {

                 $this->filename=$Afilename;
                 $this->columnCount=0;
                 $this->rowCount=0;
                 $this->worksheet = new Spreadsheet_Excel_Reader();
                 $this->worksheet->setOutputEncoding('CP1251');
                 $this->dataProcess=$AdataProcess;
                }


          function readSheet() {

              $this->worksheet->read($this->filename);

              $this->rowCount=$this->worksheet->sheets[0]['numRows'];
              $this->columnCount=$this->worksheet->sheets[0]['numCols'];
              for ($i = 1; $i <= $this->worksheet->sheets[0]['numRows']; $i++)  {
                  $this->record="";

	          for ($j = 1; $j <= $this->worksheet->sheets[0]['numCols']; $j++)   {

                     $this->record.=str_replace("'", "",$this->worksheet->sheets[0]['cells'][$i][$j]."~".$this->worksheet->sheets[0]['cellsInfo'][$i][$j]['type']."|");


                  }

                    $comando=$this->dataProcess."(".$i.",".$this->worksheet->sheets[0]['numCols'].",'".$this->record."');";

                    eval($comando);
              }

          }

}

?>
