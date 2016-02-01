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

//  require('fpdf/fpdf.php');
  require('../../config/config.inc.php');
  require('fpdf/rotation.php');





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

         class OmnisoftPDFIndividual extends PDF_Rotate {

               var $slogo;              // CHAR nombre del logo
               var $stitle;               // CHAR titulo
               var $stitleFontSize;        // INTtamaño de la fuente del titulo
               var $sHeader;         // CHAR cabecera
               var $sFooter;           // CHAR pie de pagina
               var $sfont;              // CHAR tipo de letra
               var $sbackgroundColor;   // INT,color del fondo
               var $sfontColor;   //  INT,color de la letra
               var $spageSize;                // INT, tamaño de la pagina
               var $spageOrientation;                // INT, tamaño de la pagina
               var $columnCount;                  // INT, numero de columnas
               var $activeColumnArray; // OBJECT, arreglo de todas las columnas
               var $columnDetailCount;                  // INT, numero de columnas
               var $activeColumnDetailArray; // OBJECT, arreglo de todas las columnas
               var $rsEmpresa;
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

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$Afont='Arial',$AtitleFontSize=18,$aFontColor=0xf,$AbackgroundColor=0x0,$ApageSize=35,$ApageOrientation='P',$Aancho=0,$Aalto=0)
                {
                  if ($Aancho==0)
                 parent::__construct($ApageOrientation); //,mm,Array(215,140));
                 else
                 parent::__construct($ApageOrientation,mm,array($Aancho,$Aalto));
                 $this->slogo=$Alogo;
                 $this->stitle=$Atitle;
                 $this->stitleFontSize=$AtitleFontSize;
                 $this->sHeader=$AsHeader;
                 $this->sFooter=$AsFooter;
                 $this->sfont=$Afont;
                 $this->sfontColor=$AfontColor;
                 $this->sbackgroundColor=$AbackgroundColor;
                 $this->spageSize=$ApageSize;
                 $this->sfontColor=$AfontColor;
                 $this->spageOrientation=$ApageOrientation;
                 $this->columnCount=0;
                 $this->columnDetailCount=0;
                 $this->rsEmpresa="";
                 $this->ancho=($Aancho==0)?210:$Aancho;
                 $this->alto=($Aalto==0)?297:$Aalto;

                  if ($this->spageOrientation==OMNISOFT_VERTICAL)
                     $this->spageWidth=OMNISOFT_VERTICAL_WIDTH;
                  else
                     $this->spageWidth=OMNISOFT_HORIZONTAL_WIDTH;
                      $this->AliasNbPages();
                      }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function addColumn($AdisplayColumnName, $Awidth=20,$value=0,$posX=0,$posY=0,$Atype="string",$Aalign="left",$Afont='Arial',$Asize='15',$Abold=false,$Apagebreak=false,$fill=0,$AfontcolorR=0,$AfontcolorG=0,$AfontcolorB=0,$Aangle=0)
                {
                 $this->activeColumnArray[$this->columnCount++]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "value"=>$value,
                                               "posX"=>$posX,
                                               "posY"=>$posY,
						"font"=>$Afont,
						"size"=>$Asize,
						"bold"=>$Abold,
						"pagebreak"=>$Apagebreak,
                                                "fontcolorR"=>$AfontcolorR,
                                                "fontcolorG"=>$AfontcolorG,
                                                "fontcolorB"=>$AfontcolorB,
                                                "angle"=>$Aangle,
						"fill"=>$fill

                                                );
                     // $this->columnCount++;
                }


                function Header()
                {
               global $title,$monthDay,$weekDay,$omnisoftCiudad,$dblink,$OMNISOFT_MULTIPLE_LOGO,$OMNISOFT_LOGOS;
                 if ($this->slogo!="NONE") {

                 $this->rsEmpresa=$dblink->Execute('select logotipo_emp,direccion_emp,telefono_emp,web_emp,email_emp from empresa');

                 if ($this->spageOrientation==OMNISOFT_HORIZONTAL)

                 $x=($this->alto-109)/2;
                 else
                 $x=($this->ancho-109)/2;

                 $serial_sec=$_COOKIE['serial_sec'];
                 $this->Image('../../fotos/LOGOHONTANAR2.JPG',48,0,40,29);

                  $this->SetFont($this->sfont,'B',$this->stitleFontSize);

                 $w=$this->GetStringWidth($this->stitle)+80;
                 $this->SetX(($this->spageWidth-$w)/2);
                 $this->SetTextColor(0x0,0x0,0x33);

                 //$this->MultiCell(0,10,$this->stitle);

                  $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." de  ".date("Y")." a las ".date("H:i:s");
                  $w=$this->GetStringWidth($d);
                  $this->SetX(($this->spageWidth-$w)/2+10);

                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                 //$this->Cell(0,10,$d);
                 $this->Ln();
                 $this->SetDrawColor(0x0,0x0,0x33);
                 //$this->SetLineWidth(0.4); Descomentar para utilizar la imagen logo.jpg

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize-4);
                 $w=$this->GetStringWidth($this->sHeader)+60;
                 $this->SetY(33);
                 $this->SetX(($this->spageWidth-$w)/2-10);
                // $this->MultiCell(0,10,$this->sHeader);

               //  if ($this->spageOrientation==OMNISOFT_HORIZONTAL)
               //  $this->Line(5,29,$this->alto,29);
               //  else
               //  $this->Line(5,29,$this->ancho,29);

                 }

                }


                function Footer()
                {
/*                 global $title,$monthDay,$weekDay,$omnisoftCiudad,$OMNISOFT_MULTIPLE_LOGO,$OMNISOFT_LOGOS;

                 if ($this->slogo!="NONE") {
                 global $title,$monthDay,$weekDay,$omnisoftCiudad,$OMNISOFT_MULTIPLE_LOGO,$OMNISOFT_LOGOS;

                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 if ($this->spageOrientation==OMNISOFT_HORIZONTAL) {
                  $alto=$this->ancho-27;
                  $ancho=$this->alto;
                 }
                 else {
                  $alto=$this->alto-27;
                  $ancho=$this->ancho;
                 }


                 $this->Line(10,$alto,$ancho,$alto);



                 $this->SetFont($this->sfont,'',8);
                  $this->SetY($alto);

                 $this->Cell(0,10,"Página ".$this->PageNo()." de ".'{nb}',0,0,'C');

                   $direccion= utf8_decode($this->rsEmpresa->fields['direccion_emp']);
                   $telefono=utf8_decode($this->rsEmpresa->fields['telefono_emp']);
                   $website=utf8_decode($this->rsEmpresa->fields['web_emp']);
                   $email=utf8_decode($this->rsEmpresa->fields['email_emp']);
                   $fax=utf8_decode($this->rsEmpresa->fields['fax_emp']);

                  $this->SetY($alto+3);
                   $this->Cell(0,10,$direccion,0,0,'R');

                  $this->SetY($alto+6);
                   $this->Cell(0,10,$telefono,0,0,'R');

                  $this->SetY($alto+9);
                   $this->Cell(0,10,$fax."      ".$email,0,0,'R');

                  $this->SetY($alto+12);
                   $this->Cell(0,10,$website,0,0,'R');

                  $this->SetY($alto+15);
                   $this->Cell(0,10,$omnisoftCiudad." - ECUADOR",0,0,'R');
                  $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." de  ".date("Y")." a las ".date("H:i:s");
                  $w=$this->GetStringWidth($d);
                  $this->SetX(($this->spageWidth-$w)/2+10);


                                  $this->SetY($alto+3);
                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                 $this->Cell(0,10,$d,0,0,'L');
                 $nombre_usr=$_COOKIE['nombre_usr']." ".$_COOKIE['apellido_usr'];
                  $this->SetY($alto+6);
                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                 $this->Cell(0,10,$nombre_usr,0,0,'L');





                 }  */

                }


function RotatedText($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->Text($x,$y,$txt);
	$this->Rotate(0);
}


function printPage() {
               $this->SetAutoPageBreak(false);
               $this->AddPage();

               $this->SetFont($this->sfont,'',$this->stitleFontSize-12);

               $posX=25;
               $posY=25;

               $this->Ln($posY);
               $this->SetFillColor(0xe5,0xe5,0xe5);
               $this->SetTextColor(255);
               $this->SetDrawColor(255);
               $this->SetLineWidth(.3);

               $this->SetFillColor(0xe5,0xe5,0xe5);

               // $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);


                $fill=0;
                $rowno=0;


                       $rx=$posX; $ry=$posY;
                           foreach($this->activeColumnArray as $key => $arrayElement) {
								if ($arrayElement["pagebreak"])
							        $this->AddPage();
                             if ($arrayElement["fill"])
                $this->SetFillColor(238,238,238);

                             $this->SetY($posY+$arrayElement["posY"]);
                             $this->SetX($posX+$arrayElement["posX"]);

                             if($arrayElement["bold"])
				 $this->SetFont($arrayElement["font"],'B',$arrayElement["size"]);
			else
				$this->SetFont($arrayElement["font"],'',$arrayElement["size"]);
                               $this->SetTextColor($arrayElement["fontcolorR"],$arrayElement["fontcolorG"],$arrayElement["fontcolorB"]);

                             $width=strlen($arrayElement["displayColumnName"])*3;
                             if ($width>$arrayElement["width"]) {
                               $width=$arrayElement["width"];
                             }
                             if ($arrayElement["displayColumnName"]!=' ' )

                             if ($arrayElement["angle"]==0)
                             $this->Cell($width,3,$arrayElement["displayColumnName"],1,1,'L',0);
                             else
                               $this->RotatedText($posX+$arrayElement["posX"],$posY+$arrayElement["posY"],$arrayElement["displayColumnName"],$arrayElement["angle"]) ;

                             $width=$arrayElement["width"];
                             if ($arrayElement["type"]!='image')
			     $rec=substr($arrayElement["value"],0,$width);
			     else
                               $rec=$arrayElement["value"];
                                  $rec=utf8_decode($rec);

     	//			$this->setFont($arrayElement["font"]," ",$arrayElement["size"]);
                                  $w=$this->GetStringWidth($arrayElement["displayColumnName"]);

                                   $this->SetY($posY+$arrayElement["posY"]);
                                   $this->SetX($posX+$arrayElement["posX"]+$w);

                                   $fill=$arrayElement["fill"];
                                   $slen=strlen($rec);
                                    if ($slen>0) {
	                              if  ( $arrayElement["type"]=="string")
                                            if ($arrayElment["angle"]==0)
	                                      if ($arrayElement["fill"]==1)
                                               $this->Cell($arrayElement["width"],3,$rec,'L',1,'L',$fill);
                                              else
                                             $this->Cell($arrayElement["width"],3,$rec,'L',1,'L',$fill);
                                            else
                                              $this->RotatedText($posX+$arrayElement["posX"],$posY+$arrayElement["posY"],$rec,$arrayElement["angle"]) ;


                                  else  if  ( $arrayElement["type"]=="number")
                                            if ($arrayElement["angle"]==0)
                                               if ($arrayElement["fill"]==1)
                                                $this->Cell($arrayElement["width"],3,$rec,'R',1,'R',$fill);
                                               else
                                               $this->Cell($arrayElement["width"],3,$rec,'R',1,'R',$fill);
                                             else
                                           $this->RotatedText($posX+$arrayElement["posX"],$posY+$arrayElement["posY"],$rec,$arrayElement["angle"]) ;


                                   else  if  ( $arrayElement["type"]=="line") {
                                               if ($arrayElement["bold"])
                                                   $this->SetDrawColor(0,0,0);
                                               else
                                                     $this->SetDrawColor(0xC0,0xC0,0xC0);
                                                     $this->SetLineWidth($arrayElement["value"]);

                                              $this->Line($posX+$arrayElement["posX"],$posY+$arrayElement["posY"],$posX+$arrayElement["posX"]+$arrayElement["width"],$posY+$arrayElement["posY"]);
                                                             $this->SetDrawColor(255);
                                                             $this->SetLineWidth(.3);

                                  }
                                              else  if  ( $arrayElement["type"]=="linev") {
                                               if ($arrayElement["bold"])
                                                   $this->SetDrawColor(0,0,0);
                                               else
                                                     $this->SetDrawColor(0xC0,0xC0,0xC0);
                                                     $this->SetLineWidth($arrayElement["value"]);

                                              $this->Line($posX+$arrayElement["posX"],$posY+$arrayElement["posY"],$posX+$arrayElement["posX"],$posY+$arrayElement["posY"]+$arrayElement["width"]);
                                                             $this->SetDrawColor(255);
                                                             $this->SetLineWidth(.3);

                                  }

                                  else
                                  $this->Image($rec,$posX+$arrayElement["posX"],$posY+$arrayElement["posY"],$arrayElement["displayColumnName"],$arrayElement["width"]);

                                    }
                            }





}




            function ShowIt() {


              $this->printPage();

              $this->Output();
            }

                function Rectangle($x,$y,$w,$h) {
                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 $this->Line($x,$y,$w,$h);

                }



}
?>
