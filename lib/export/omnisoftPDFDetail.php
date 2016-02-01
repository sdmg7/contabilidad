<?php
//------------------------------------------------------------------------------------------------------------------------
//  PROYECTO: Librerias para manejo de Reportes en PDF
//  DESARROLLADO POR:  Soluciones Integrales OMNISOFT Cia. Ltda.
//  AUTOR:  Marco Hernan Jarrin Lopez
//  EMAIL:  marco@omnisoft.cc
//  WEBSITE:  http://www.omnisoft.cc
//------------------------------------------------------------------------------------------------------------------------
//  TÍTULO: OmnisoftGrid.php
//  DESCRIPCIÓN: Archivo que contiene la clase de creación de PDFs
//  FECHA DE CREACIÓN: 07-Agosto-2005
//  MODIFICACIONES:
//           FECHA       AUTOR               DESCRIPCIÓN
//  1) ------------- -------------  -------------------------

//define('FPDF_FONTPATH','C:\\Archivos de programa\\Apache Group\\Apache\\htdocs\\OmnisoftGrid\\lib\\fpdf\\font');

  require('fpdf/fpdf.php');
  require('../../config/config.inc.php');




//------------------------------------------------------------------------------------------------------------------------
//  CONSTANTES
//  CONSTANTES PARA EL MANEJO DE EVENTOS
//------------------------------------------------------------------------------------------------------------------------

define(OMNISOFT_VERTICAL,'P');
define(OMNISOFT_HORIZONTAL,'L');

define(OMNISOFT_VERTICAL_WIDTH,210);
define(OMNISOFT_HORIZONTAL_WIDTH,297);


/*define(OMNISOFT_DELETE_EVENT,3);
define(OMNISOFT_SAVE_EVENT,4);
define(OMNISOFT_SEARCH_EVENT,5);
define(OMNISOFT_LOAD_EVENT,6);
*/
$monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftPDF
//  DESCRIPCIÓN: Clase General para crear un report PDF
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftPDFDetail extends FPDF {
               var $slogo;              // CHAR nombre del logo
               var $stitle;               // CHAR titulo
               var $stitleFontSize;        // INTtamaño de la fuente del titulo
               var $sHeader;         // CHAR cabecera
               var $sFooter;           // CHAR pie de pagina
               var $sfont;              // CHAR tipo de letra
               var $sbackgroundColor;   // INT,color del fondo
               var $sfontColor;   //  INT,color de la letra
               var $dsn;              // CHAR, database source name
               var $SQLCommand;        // CHAR, comando sql a ejecutar
               var $resultSet;           // OBJECT, resultados de la consulta
               var $dblink;             // OBJECT, enlace base datos
               var $record;             // OBJECT, registro actual
               var $spageSize;                // INT, tamaño de la pagina
               var $spageOrientation;                // INT, tamaño de la pagina
               var $columnCount;                  // INT, numero de columnas
               var $activeColumnArray; // OBJECT, arreglo de todas las columnas
               var $columnDetailCount;                  // INT, numero de columnas
               var $activeColumnDetailArray; // OBJECT, arreglo de todas las columnas

                //  NOMBRE:  OmnisoftPDF
                //  DESCRIIPCIÓN:  Crea un reporte PDF
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Alogo              char        25            nombre del grid
                //  2)       Atitle              char        25            nombre de la pagina que invoca al grid
                //  3)       Aform              char        25            nombre del formulario de ingreso y edicion de datos
                //  4)       Adsn               char        100           cadena de conexion a la base de datos
                //  5)       Atable             char        100           tabla a afectar
                //  6)       ASQLCommand        char        100           comando sql para la seleccion de datos
                //  7)       Aheight            int        25             alto del grid
                //  8)       Awidth             int        25             ancho del grid
                //  9)       Afont              char        25            fuente de las letras
                //  10)       AbackgroundColor   char        25            color del fondo del grid
                //  VALOR RETORNO:   objeto de la clase OmnisoftGrid

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$Adsn,$ASQLCommand,$ASQLDetail,$Afont='Arial',$AtitleFontSize=20,$aFontColor=0xf,$AbackgroundColor=0x0,$ApageSize=35,$ApageOrientation=OMNISOFT_VERTICAL)
                {
                 parent::__construct();
                 $this->slogo=$Alogo;
                 $this->stitle=$Atitle;
                 $this->stitleFontSize=$AtitleFontSize;
                 $this->sHeader=$AsHeader;
                 $this->sFooter=$AsFooter;
                 $this->dsn=$Adsn;
                 $this->SQLCommand=$ASQLCommand;
                 $this->SQLDetail=$ASQLDetail;
                 $this->sfont=$Afont;
                 $this->sfontColor=$AfontColor;
                 $this->sbackgroundColor=$AbackgroundColor;
                 $this->spageSize=$ApageSize;
                 $this->sfontColor=$AfontColor;
                 $this->spageOrientation=$ApageOrientation;
                 $this->columnCount=0;
                 $this->columnDetailCount=0;

                  if ($this->spageOrientation==OMNISOFT_VERTICAL)
                     $this->spageWidth=OMNISOFT_VERTICAL_WIDTH;
                  else
                     $this->spageWidth=OMNISOFT_HORIZONTAL_WIDTH;
                      $this->AliasNbPages();
                      $this->connectDB();
                     $this->rsEmpresa=$this->dblink->Execute('select logotipo_emp,nombre_emp,direccion_emp,telefono_emp,web_emp,email_emp from empresa');

                      }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function addColumn($AdisplayColumnName,$AtableColumnName, $Awidth=20,$Atype="string",$posX=0,$posY=0,$Aalign="left",$Acalc="",$AbackgroundColor="")
                {
                 $this->activeColumnArray[]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "tableColumnName"=>$AtableColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "posX"=>$posX,
                                               "posY"=>$posY,
                                               "calc"=>$Acalc,
                                               "backgroundColor"=>$AbackgroundColor);
                      $this->columnCount++;
                }



                function addColumnDetail($AdisplayColumnName,$AtableColumnName, $Awidth=20,$Atype="string",$posX=0,$posY=0,$Aalign="left",$Acalc="",$AbackgroundColor="")
                {
                 $this->activeColumnDetailArray[]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "tableColumnName"=>$AtableColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "posX"=>$posX,
                                               "posY"=>$posY,
                                               "calc"=>$Acalc,
                                               "value"=>0,
                                               "backgroundColor"=>$AbackgroundColor);
                      $this->columnDetailCount++;
                }





                function Header()
                {
                 global $title,$monthDay,$weekDay,$omnisoftCiudad;

                 $this->Image('../../fotos/'.$this->rsEmpresa->fields[0],10,3,23,25);
                 $this->stitle=$this->rsEmpresa->fields[1];

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize);

                 $w=$this->GetStringWidth($this->stitle)+10;
                 $this->SetY(3);
                 $this->SetX(($this->spageWidth-$w)/2);
                 $this->SetTextColor(0x0,0x0,0x33);

                 $this->MultiCell(0,10,$this->stitle);


                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize-5);
                 $w=$this->GetStringWidth($this->sHeader)+20;
             //    $this->SetY(20);
                 $this->SetX(($this->spageWidth-$w)/2);
                 $this->MultiCell(0,10,$this->sHeader);

                  $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." de  ".date("Y")." a las ".date("H:i:s");
                  $w=$this->GetStringWidth($d);
                  $this->SetX(($this->spageWidth-$w)/2+30);

                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                 $this->Cell(0,10,$d);


                 $this->Line(10,30,200,30);

                }

                function Footer()
                {

                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 if ($this->spageOrientation==OMNISOFT_VERTICAL) {
                 $this->Line(10,270,$this->spageWidth,270);
                 $this->SetY(270);
                 $posY=270;
                 }
                 else {
                 $this->Line(10,190,$this->spageWidth,190);
                 $this->SetY(190);
                 $posY=190;
                 }



                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);

                 $this->Cell(0,10,"Página ".$this->PageNo()." de ".'{nb}',0,0,'C');
                  $this->Ln();

                 //$this->Cell(0,10,$this->sFooter,0,0,'C');
                 $this->SetX(10);
                 $this->Cell(0,10,'DIRECCION: '.$this->rsEmpresa->fields['direccion_emp'],0,0,'L');
                 $this->Cell(0,10,'TELEFONO: '.$this->rsEmpresa->fields['telefono_emp'],0,0,'R');
                 $this->SetY($posY+3);

                 $this->SetX(10);
                 $this->Cell(0,10,'EMAIL: '.$this->rsEmpresa->fields['email_emp'],0,0,'L');
                 $this->Cell(0,10,'WEBSITE:'.$this->rsEmpresa->fields['web_emp'],0,0,'R');




                }




function printPageDetail() {

               $this->AddPage();
               $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
               $posX=5;
               $posY=35;

               $this->Ln($posY);
               $this->SetFillColor(0x0,0x33,0x99);
               $this->SetTextColor(255);
               $this->SetDrawColor(255);
               $this->SetLineWidth(.3);

                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);

                $fill=0;
                $rowno=0;

                $pageSize=150;

              while ( !$this->resultSet->EOF)
                     {

                       if ($posY>$pageSize) {

                            $this->AddPage();

                            $posX=5;
                            $posY=35;

                            $this->Ln($posY);

                       }

                       $rx=$posX; $ry=$posY;

                           foreach($this->activeColumnArray as $key => $arrayElement) {

                             $this->SetY($posY+$arrayElement["posY"]);
                             $this->SetX($posX+$arrayElement["posX"]);
                             $width=strlen($arrayElement["displayColumnName"])*3;
                             if ($width>$arrayElement["width"]) {
                               $width=$arrayElement["width"];
                               $arrayElement["displayColumnName"]=substr($arrayElement["displayColumnName"],0,$arrayElement["width"]);

                             }

                             $this->Cell($width,7,$arrayElement["displayColumnName"],1,0,'L',1);

                             $width=$arrayElement["width"]/3;
			     $rec=substr($this->resultSet->fields[$arrayElement["tableColumnName"]],0,$width);

                                  if  ( $arrayElement["type"]!="number")
                                         $this->Cell($arrayElement["width"],6,$rec,'LR',0,'L',$fill);
                                  else
                                         $this->Cell($arrayElement["width"],6,number_format($rec),'LR',0,'R',$fill);
                            }

                              $sqlDetail=  str_replace( '_serial_',$this->resultSet->fields[0],$this->SQLDetail);

                              $rSet=$this->dblink->Execute($sqlDetail);

                               foreach($this->activeColumnDetailArray as $key => $arrayElement) {

                                $this->SetY($posY+$arrayElement["posY"]);
                                $this->SetX($posX+$arrayElement["posX"]);
                                $this->Cell($arrayElement["width"],7,$arrayElement["displayColumnName"],1,0,'L',1);

                                }
                             $wx=210;
                             $hy=$posY;

                             $posY+=8;

                              while ($rowno <$this->spageSize && !$rSet->EOF) {

                               foreach($this->activeColumnDetailArray as $key => $arrayElement) {

                                $this->SetY($posY+$arrayElement["posY"]);
                                $this->SetX($posX+$arrayElement["posX"]);
                               $width=$arrayElement["width"]/3;

       			     $rec=substr($rSet->fields[$arrayElement["tableColumnName"]],0,$width);
       			     if ($arrayElement["calc"]!="")
       			         $this->activeColumnDetailArray[$key]["value"]=$this->activeColumnDetailArray[$key]["value"]+$rSet->fields[$arrayElement["tableColumnName"]];

                                  if  ( $arrayElement["type"]!="number")
                                         $this->Cell($arrayElement["width"],6,$rec,'LR',0,'L',0);
                                  else
                                         $this->Cell($arrayElement["width"],6,number_format($rec),'LR',0,'R',0);

                                }

                                 $posY+=5;

                              $rowno++;
                              $rSet->MoveNext();
                             }

                               foreach($this->activeColumnDetailArray as $key => $arrayElement) {

                                $this->SetY($posY+$arrayElement["posY"]);
                                $this->SetX($posX+$arrayElement["posX"]);
                                if ($arrayElement["calc"]!="")
                                  $this->Cell($arrayElement["width"],6,number_format($arrayElement["value"]),'LR',0,'R',1);
       			         $this->activeColumnDetailArray[$key]["value"]=0;


                               }

                           $rowno++;
                          $posY+=16;

                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);


                           $this->Line(10,$posY,200,$posY);

                           //  $this->Rect($x,$y,$wx,$hy);
                             $this->SetDrawColor(255);
                          $posY+=16;

                           $this->resultSet->MoveNext();
                      }




}






            function Show() {

              $this->resultSet=$this->dblink->Execute($this->SQLCommand);

              while (!$this->resultSet->EOF)
                      $this->printPageDetail();

              $this->Output();
            }



                //  NOMBRE:  connectDB
                //  DESCRIIPCIÓN:  despliega el Grid
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function connectDB()
                {

                                global $DBConnection;

                 $this->dblink = NewADOConnection($DBConnection);



                 if (!$this->dblink)
                     die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");

                }



}
?>
