<?php
//------------------------------------------------------------------------------------------------------------------------
//  PROYECTO: Librerias para manejo de Reportes en RTF
//  DESARROLLADO POR:  Soluciones Integrales OMNISOFT Cia. Ltda.
//  AUTOR:  Marco Hernan Jarrin Lopez
//  EMAIL:  marco@omnisoft.cc
//  WEBSITE:  http://www.omnisoft.cc
//------------------------------------------------------------------------------------------------------------------------
//  TÍTULO: omnisoftRFTW.php
//  DESCRIPCIÓN: Archivo que contiene la clase de creación de PDFs
//  FECHA DE CREACIÓN: 07-Agosto-2005
//  MODIFICACIONES:
//           FECHA       AUTOR               DESCRIPCIÓN
//  1) ------------- -------------  -------------------------

  require('../adodb/adodb.inc.php');
  require('../../config/config.inc.php');
  require("rtf/rtf_class.php");

define("OMNISOFT_VERTICAL",'P');
define("OMNISOFT_HORIZONTAL",'L');

define("OMNISOFT_VERTICAL_WIDTH",210);
define("OMNISOFT_HORIZONTAL_WIDTH",297);


//------------------------------------------------------------------------------------------------------------------------
//  CONSTANTES
//  CONSTANTES PARA EL MANEJO DE EVENTOS
//------------------------------------------------------------------------------------------------------------------------

$monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftPDF
//  DESCRIPCIÓN: Clase General para crear un report PDF
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftRTFW extends RTF {
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
                 parent::__construct();

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
                 $this->pageno=0;
                 $this->totalpages=0;


                  if ($this->spageOrientation==OMNISOFT_VERTICAL)  {
                     $this->spageWidth=OMNISOFT_VERTICAL_WIDTH;
                     $this->spageSize=40;

                  }
                  else {
                     $this->spageWidth=OMNISOFT_HORIZONTAL_WIDTH;
                     $this->spageSize=24;

                  }
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
                 global $title,$monthDay,$weekDay,$omnisoftCiudad;
                 $this->rsEmpresa=$this->dblink->Execute('select logotipo_emp,direccion_emp,telefono_emp,web_emp,email_emp from empresa');

                 $this->add_image('../../fotos/'.$this->rsEmpresa->fields[0], 100, "center");
   	         $this->new_line();

                  $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." de  ".date("Y")." a las ".date("H:i:s");
                 $this->set_default_font($this->sfont, $this->stitleFontSize-10);

                }


                function Footer()
                {

                 $this->set_default_font($this->sfont, $this->stitleFontSize-10);

                 $this->add_text('Direccion:'.$this->rsEmpresa->fields[1].'  Telefono:'.$this->rsEmpresa->fields[2].' website:'.$this->rsEmpresa->fields[3].' email:'.$this->rsEmpresa->fields[4]);
   	         $this->new_line();

		 $this->add_text('Page: '.$this->pageno.' of: '.$this->totalpages, "center");

               }




function printPage() {

               $this->ln(1);
               $this->set_default_font($this->sfont, $this->stitleFontSize-2);

	       $titulo=explode('^',$this->stitle);
               if(isset($titulo[5]))
               $this->add_text($this->color(9) .$titulo[5], "center");
			   

               $this->ln(1);
               $this->set_default_font($this->sfont, $this->stitleFontSize-6);
               $this->add_text($titulo[0], "center");
               $this->ln(1);

               if(isset($titulo[1])){
			   $this->set_default_font($this->sfont, $this->stitleFontSize-10);
               $this->add_text($titulo[1], "left");
               $this->ln(1);}

               if(isset($titulo[2])){
               $this->add_text($titulo[2], "left");
               $this->ln(1);
			   }
               if(isset($titulo[3])){
			   $this->add_text($titulo[3], "left");
               $this->ln(2);}
		$this->set_table_font("Arial", 9);

    	       $this->new_line();
               $this->open_line();

               $this->cell($this->bold(1).$this->color(8).'No', "10","center","9");


               foreach($this->activeColumnArray as $key => $arrayElement) {

               $this->cell($this->bold(1).$this->color(8).$arrayElement["displayColumnName"], $arrayElement["width"],"center","9");
               $this->activeColumnArray[$key]['subtotal']=0;

               }
               $this->close_line();
                $fill=0;
                $rowno=0;


              while ($rowno <$this->spageSize && !$this->resultSet->EOF)
                     {

			  $this->nrow++;
//			$this->ln(1);
					if(isset($colorfondo))
                    $colorfondo=  ($colorfondo == "8") ? ($colorfondo = "16") : ($colorfondo = "8");
					else $colorfondo="8";

        		  $this->open_line();

                          $this->cell($this->color(0).$this->nrow, "10", "right",$colorfondo);

                           foreach($this->activeColumnArray as $key => $arrayElement) {

                                   $rec=substr($this->resultSet->fields($arrayElement["tableColumnName"]),0,$arrayElement["width"]);
				  // $rec=utf8_decode($rec);

                                   if($arrayElement["calc"]=="SUM") {
                                         $this->activeColumnArray[$key]['total']+=$rec;
                                         $this->activeColumnArray[$key]['subtotal']+=$rec;

                                   }
                                  if  ( $arrayElement["type"]!="number")
                                        $this->cell($rec,$arrayElement["width"], "left",$colorfondo);
 					 else
                                        $this->cell(number_format($rec), $arrayElement["width"], "right",$colorfondo);

					}
                           $fill=!$fill;
               		  $this->close_line();

                            $rowno++;
                           $this->resultSet->MoveNext();

                      }


     if($this->displayTotal) {
        		  $this->open_line();
                          $this->cell('Subtotal', "10", "right",2);

     foreach($this->activeColumnArray as $key => $arrayElement)
                  if ( $arrayElement["calc"]=='SUM')
                  $this->cell(number_format($arrayElement["subtotal"]),$arrayElement["width"],'right',2);
                  else
                 $this->cell(' ', $arrayElement["width"], "right",2);
       		  $this->close_line();

     }

}


             function ShowIt() {


              $this->resultSet=$this->dblink->Execute($this->SQLCommand);
              while (!$this->resultSet->EOF) {
                      $this->printPage();
                      if (!$this->resultSet->EOF)
                        $this->new_page();

              }
               if($this->displayTotal) {
        		  $this->open_line();
                          $this->cell('Total', "10", "right",6);

     foreach($this->activeColumnArray as $key => $arrayElement)
                  if ( $arrayElement["calc"]=='SUM')
                  $this->cell(number_format($arrayElement["total"]),$arrayElement["width"],'right',6);
                  else
                 $this->cell(' ', $arrayElement["width"], "right",6);
                $this->close_line();

     }


	$this->display();
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
