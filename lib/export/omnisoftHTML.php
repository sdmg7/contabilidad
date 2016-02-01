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
  require('../../config/config.inc.php');



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

         class OmnisoftHTML  {
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

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$ASQLCommand,$Afont='Arial',$AtitleFontSize=17,$aFontColor=0xf,$AbackgroundColor=0x0,$ApageSize=45)
                {
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
                 $this->columnCount=0;
		 $this->nrows=0;
                 $this->connectDB();
                 echo '<link href="../styles/omnisoft.css" rel="stylesheet" type="text/css">';

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
                                               "backgroundColor"=>$AbackgroundColor);
                      $this->columnCount++;
                }


  function Header()
                {
                 global $title,$monthDay,$weekDay,$omnisoftCiudad;
                 header ('Content-type: text/html; charset=utf-8');

                 $this->rsEmpresa=$this->dblink->Execute('select logotipo_emp,direccion_emp,telefono_emp,web_emp,email_emp from empresa');

               //  echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" >';
               //  echo '<tr><td  align="center"><img src="../../fotos/'.$this->rsEmpresa->fields[0].'" width=300 height=65></td></tr>';
               //  echo '</table>';
                 echo '<table width="100%" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000" bgcolor="#9fc2ea">';
                 echo '<tr><td  align="center" class="tituloReporte">'.$this->stitle.'</td></tr>';
                 echo '</table>';



                }


                function Footer()
                {


                 echo '<table width="100%" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000" class="formtable" >';
                 echo '<tr><td class="pair">Direccion:</td><td class="odd">'.$this->rsEmpresa->fields[1].'</td>';
                 echo '<td class="pair">Telefono:</td><td class="odd">'.$this->rsEmpresa->fields[2].'</td>';
                 echo '<td class="pair">Website:</td><td class="odd">'.$this->rsEmpresa->fields[3].'</td>';
                 echo '<td class="pair">Email:</td><td class="odd">'.$this->rsEmpresa->fields[4].'</td>';
                 echo '</tr></table>';

                }

function  newTable() {
    echo  '<table width="100%" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000" bgcolor="#9fc2ea">';
}

function endTable() {
 echo '</table>';
}

function  newRow() {
    echo  '<tr>';
}

function  endRow() {
    echo  '</tr>';
}


function  newColumn($texto,$align='left',$shadow='odd',$height='15px',$width='100%') {
    echo  "<td class='$shadow' align='$align' width='$width' height='$height'>$texto</td>";
}


function printPage() {
                 global $title,$monthDay,$weekDay,$omnisoftCiudad;

      $this->Header();
    echo  '<table width="100%" height="50" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000" class="formtable">';
	   $titulo=explode('^',$this->stitle);

    echo  '<tr ><td ><center>'.$titulo[0].'</center></td></tr>';
        $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." de  ".date("Y")." a las ".date("H:i:s");

    echo  '<tr><td class="pair"><center>'.$d.'</center></td></tr>';
    echo '</table>';

    echo  '<table width="100%" height="32" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000" class="formtable">';
    echo  '<tr><td class="formprinttitle">No.</td>';

               foreach($this->activeColumnArray as $key => $arrayElement)
                  echo '<td class="formprinttitle"><center>'.$arrayElement["displayColumnName"].'</center></td>';
               echo '</tr>';

                $fill=0;
                $rowno=0;
                           $this->resultSet->MoveFirst();

              while ( !$this->resultSet->EOF)
                     {

	                  $this->nrow++;
	                  if ($fill)
	                  echo '<tr><td class="pair">'.$this->nrow.'</td>';
	                  else
	                  echo '<tr><td class="odd">'.$this->nrow.'</td>';

                           foreach($this->activeColumnArray as $key => $arrayElement) {


				   $rec=substr($this->resultSet->fields[$arrayElement["tableColumnName"]],0,$arrayElement["width"]);
				   $rec=utf8_decode($rec);
                                   if  ( $arrayElement["type"]!="number") {
                                     if ($fill)
                                         echo '<td class="pair">'.$rec.'</td>';
                                     else
                                         echo '<td class="odd">'.$rec.'</td>';

                                   }
				   else
                                       if ($fill)
                                         echo '<td class="pair">'.number_format($rec).'</td>';
                                     else
                                         echo '<td class="odd">'.number_format($rec).'</td>';

					}
                           echo '</tr>';
                           $fill=!$fill;
                            $rowno++;
                           $this->resultSet->MoveNext();

                      }

            echo "</table>";
            $this->footer();
}


             function ShowIt() {

              $this->resultSet=$this->dblink->Execute($this->SQLCommand);
                      $this->printPage();

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
                 $this->dblink->Execute("SET NAMES utf8");

                }


}
?>
