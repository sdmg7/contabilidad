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

  require('../adodb/adodb.inc.php');
  require('fpdf/fpdf_js.php');
  require_once('../adodb/adodb.inc.php');
  require('../../config/config.inc.php');



//------------------------------------------------------------------------------------------------------------------------
//  CONSTANTES
//  CONSTANTES PARA EL MANEJO DE EVENTOS
//------------------------------------------------------------------------------------------------------------------------

define("OMNISOFT_VERTICAL",'P');
define("OMNISOFT_HORIZONTAL",'L');

define("OMNISOFT_VERTICAL_WIDTH",210);
define("OMNISOFT_HORIZONTAL_WIDTH",297);


$monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftPDF
//  DESCRIPCIÓN: Clase General para crear un report PDF
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftPDF extends PDF_Javascript {
               var $slogo;              // CHAR nombre del logo
               var $stitle;               // CHAR titulo
               var $stitleFontSize;        // INTtamaño de la fuente del titulo
               var $sHeader;         // CHAR cabecera
               var $sFooter;           // CHAR pie de pagina
               var $sfont;              // CHAR tipo de letra
               var $sbackgroundColor;   // INT,color del fondo
               var $sfontColor;   //  INT,color de la letra
               var $SQLCommand;        // CHAR, comando sql a ejecutar var $
               var $resultSet;           // OBJECT, resultados de la consulta var $
               var $dblink;             // OBJECT, enlace base datos var $record;
               var $rsEmpresa;          // OBJECT, informacion de la empresa
               // OBJECT, registro actual
                var $spageSize;                // INT,
               //tamaño de la pagina
               var $spageOrientation;                // INT,
               //tamaño de la pagina
               var $columnCount;                  // INT,
               //numero de columnas
               var $activeColumnArray; // OBJECT, arreglo de
               //todas las columnas

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

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$ASQLCommand,$ApageOrientation='',$Afont='Arial',$AtitleFontSize=17,$AfontColor=0xf,$AbackgroundColor=0x0,$ApageSize=45)
                {
                 parent::__construct($ApageOrientation);
                 $this->slogo=$Alogo;
                 $this->stitle=$Atitle;
                 $this->stitleFontSize=$AtitleFontSize;
                 $this->sHeader=$AsHeader;
                 $this->sFooter=$AsFooter;
                 $this->SQLCommand=$ASQLCommand;
                 $this->sfont=$Afont;
                 $this->sfontColor=$AfontColor;
                 $this->sbackgroundColor=$AbackgroundColor;
                 $this->spageSize=$ApageSize;
                 $this->sfontColor=$AfontColor;
                 $this->spageOrientation=$ApageOrientation;
                 $this->columnCount=0;
		 $this->nrows=0;
		 $this->displayTotal=false;

                  if ($this->spageOrientation==OMNISOFT_VERTICAL)  {
                     $this->spageWidth=OMNISOFT_VERTICAL_WIDTH;
                     $this->spageSize=52;

                  }
                  else {
                     $this->spageWidth=OMNISOFT_HORIZONTAL_WIDTH;
                     $this->spageSize=30;

                  }
                      $this->AliasNbPages();
                      $this->connectDB();
                      }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function addColumn($AdisplayColumnName,$AtableColumnName, $Awidth=20,$Atype="string",$Aalign="left",$Acalc="",$AbackgroundColor="")
                {
                 $this->activeColumnArray[]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "tableColumnName"=>$AtableColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "calc"=>$Acalc,
                                               "subtotal"=>0,
                                                "total"=>0,
                                               "backgroundColor"=>$AbackgroundColor);
                   if($Acalc!="")
                     $this->displayTotal=true;

                      $this->columnCount++;
                }


  function Header()
                {
                 global $title,$monthDay,$weekDay,$omnisoftCiudad,$OMNISOFT_MULTIPLE_LOGO,$OMNISOFT_LOGOS;
                 $this->rsEmpresa=$this->dblink->Execute('select logotipo_emp,direccion_emp,telefono_emp,web_emp,email_emp from empresa');
                 //$serial_sec=$_COOKIE['serial_sec'];
    //             if (isset($OMNISOFT_MULTIPLE_LOGO) && $OMNISOFT_MULTIPLE_LOGO)
//                 $this->Image('../../fotos/'.$OMNISOFT_LOGOS[$serial_sec],$x,0,109,26);
   //              else

 //                $this->Image('../../fotos/'.$this->rsEmpresa->fields[0],50,6,109,26);

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize);

                 $w=$this->GetStringWidth($this->stitle)+80;
                 $this->SetX(($this->spageWidth-$w)/2);
                 $this->SetTextColor(0x0,0x0,0x33);

               //  $this->MultiCell(0,10,$this->stitle);

                  $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." de  ".date("Y")." a las ".date("H:i:s");
                  $w=$this->GetStringWidth($d);
                  $this->SetX(($this->spageWidth-$w)/2+10);

                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                 //$this->Cell(0,10,$d);
                 $this->Ln();
                 $this->SetDrawColor(0x0,0x0,0x33);
                 //$this->SetLineWidth(0.4); Descomentar para utilizar la imagen logo.jpg

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize-10);
                 $w=$this->GetStringWidth($this->sHeader)+60;
                 $this->SetX(($this->spageWidth-$w)/2);
               //  $this->MultiCell(0,3,$this->sHeader);


                 $this->Line(10,33,200,33);

                }


                function Footer()
                {

                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 $this->Line(10,270,200,270);



                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                  $this->SetY(270);

     //            $this->Cell(0,10,"Página ".$this->PageNo()." de ".'{nb}',0,0,'C');
                  $this->Ln();

                 $this->Cell(0,10,'Direccion:'."".'  Telefono:'."".' website:'."".' email:'."",0,0,'C');

                }




function printPage() {

               $this->AddPage();
               $this->SetY(35);
               $this->SetFont($this->sfont,'B',$this->stitleFontSize-2);
               //$this->SetFillColor(255,255,255);
			   // Título
               $this->SetTextColor(0);
			   $titulo=explode('^',$this->stitle);
				if(isset($titulo[5]))
               $this->Cell(200,6,$titulo[5],0,0,'C',0);

			   // Período Lectivo
			   $this->SetY(40);
               $this->SetX(10);
               $this->SetFont($this->sfont,'B',$this->stitleFontSize-6);

               $this->Cell(200,6,$titulo[0],0,0,'C',0);

               // Sección
               $this->SetY(44);
               $this->SetX(28);
               $this->SetFont($this->sfont,'B',$this->stitleFontSize-10);
               if(isset($titulo[1]))
               $this->Cell(200,6,$titulo[1],0,0,'L',0);

               // Ciclo
               $this->SetY(48);
               $this->SetX(28);
               $this->SetFont($this->sfont,'B',$this->stitleFontSize-10);
			   if(isset($titulo[2]))
               $this->Cell(200,6,$titulo[2],0,0,'L',0);

               // Curso y paralelo
               $this->SetY(52);
               $this->SetX(28);
				if(isset($titulo[4]))
               $this->Cell(200,6,$titulo[4],0,0,'L',0);


               $this->SetFont($this->sfont,'',$this->stitleFontSize-10);


               $this->SetFillColor(0x0,0x33,0x99);
               $this->SetTextColor(255);
               $this->SetDrawColor(255);
               $this->SetLineWidth(.3);



               $this->SetY(57);



               $this->SetX(20);

                  $this->Cell(10,4,'No',1,0,'C',1);

               $this->SetX(30);

               foreach($this->activeColumnArray as $key => $arrayElement) {
                  $this->Cell($arrayElement["width"]*2,4,$arrayElement["displayColumnName"],1,0,'C',1);
                                         $this->activeColumnArray[$key]['subtotal']=0;

               }
                   $this->Ln();


                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);

                $fill=0;
                $rowno=0;

//               $this->resultSet->MoveFirst();


              while ($rowno <$this->spageSize && !$this->resultSet->EOF)
                     {

						  $this->SetX(20);
                          $this->nrow++;
                          $this->Cell(10,4,$this->nrow,'LR',0,'R',$fill);
                          $this->SetX(30);

                           foreach($this->activeColumnArray as $key => $arrayElement) {

                                   $rec=substr($this->resultSet->fields($arrayElement["tableColumnName"]),0,$arrayElement["width"]);
				   $rec=utf8_decode($rec);

                                   if($arrayElement["calc"]=="SUM") {
                                         $this->activeColumnArray[$key]['total']+=$rec;
                                         $this->activeColumnArray[$key]['subtotal']+=$rec;

                                   }
                                  if  ( $arrayElement["type"]!="number")
                                         $this->Cell($arrayElement["width"]*2,4,$rec,1,0,'L',$fill);
 					 else {

                                         $this->Cell($arrayElement["width"]*2,4,($rec),'LR',0,'R',$fill);
                                         }
					}
                           $this->Ln();
                           $fill=!$fill;
                            $rowno++;
                           $this->resultSet->MoveNext();

                      }

     if($this->displayTotal) {
               $this->SetFillColor(0x0,0x33,0x99);
               $this->SetTextColor(255);

			  $this->SetX(20);
                          $this->Cell(10,4,' ','LR',0,'R',$fill);
                          $this->SetX(30);
     foreach($this->activeColumnArray as $key => $arrayElement)
                  if ( $arrayElement["calc"]=='SUM')
                  $this->Cell($arrayElement["width"]*2,4,($arrayElement["subtotal"]),1,0,'R',1);
                  else
                  $this->Cell($arrayElement["width"]*2,4,' ',1,0,'R',1);
     }

}


             function AutoPrint($dialog=false)
                       {
                       //Embed some JavaScript to show the print dialog or start printing immediately
                        $param=($dialog ? 'true' : 'false');
                       $script="print($param);";
                       $this->IncludeJS($script);
                     }


             function ShowIt() {


              $this->resultSet=$this->dblink->Execute($this->SQLCommand);
              while (!$this->resultSet->EOF)
                      $this->printPage();
         if($this->displayTotal) {
                   $this->Ln();

               $this->SetFillColor(0x0,0x33,0x99);
               $this->SetTextColor(255);

			  $this->SetX(20);
                          $this->Cell(10,4,' ','LR',0,'R',$fill);
                          $this->SetX(30);
     foreach($this->activeColumnArray as $key => $arrayElement)
                  if ( $arrayElement["calc"]=='SUM')
                  $this->Cell($arrayElement["width"]*2,4,($arrayElement["total"]),1,0,'R',1);
                  else
                  $this->Cell($arrayElement["width"]*2,4,' ',1,0,'R',1);
     }


              if (!empty($_POST['mode']) && $_POST['mode']=='quickprint' )
              $this->AutoPrint(false);
              else if ($_POST['mode']=='print')
              $this->AutoPrint(true);


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
