<?php
  require_once('rtf/rtf_class.php');
  require_once('../adodb/adodb.inc.php');
  require('../../config/config.inc.php');

  $monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftExcel
//  DESCRIPCIÓN: Clase General para crear una hoja Excel
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftRTF extends RTF{
               var $SQLCommand;        // CHAR, comando sql a ejecutar
               var $resultSet;           // OBJECT, resultados de la consulta
               var $dblink;             // OBJECT, enlace base datos
               var $record;             // OBJECT, registro actual
               var $activeColumnArray; // OBJECT, arreglo de todas las columnas
               var $rtf;
               var $page;
               var $fields;
               var $vars;
               var $modulo;


                //  NOMBRE:  OmnisoftRTF
                //  DESCRIIPCIÓN:  Crea un reporte RTF
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Alogo              char        25            nombre del grid
                //  2)       Atitle              char        25            nombre de la pagina que invoca al grid
                //  3)       Aform              char        25            nombre del formulario de ingreso y edicion de datos
                //  5)       Atable             char        100           tabla a afectar
                //  6)       ASQLCommand        char        100           comando sql para la seleccion de datos
                //  7)       Aheight            int        25             alto del grid
                //  8)       Awidth             int        25             ancho del grid
                //  9)       Afont              char        25            fuente de las letras
                //  10)       AbackgroundColor   char        25            color del fondo del grid
                //  VALOR RETORNO:   objeto de la clase OmnisoftGrid

                function __construct($aModulo,$aSQLCommand,$aFileName)
                {
                 parent::__construct($aFileName);

                 $this->SQLCommand=$aSQLCommand;
                 $this->modulo=$aModulo;
                 $this->vars=Array();
                 $this->fields=Array();
                 $this->connectDB();

                 $this->dblink->SetFetchMode(ADODB_FETCH_NUM);

                 $this->decodeRTF();
                 $this->decodeSQL();

                 $this->page=$this->getPage();

                 $this->addNewPage();

                }

                function decodeSQL() {
                  $slist=explode('select',$this->SQLCommand);
                  $slist=explode('from',$slist[1]);
                  $slist=explode(',',$slist[0]);
                  $this->vars=Array();
                  foreach($slist as $key=>$value) {
                   $col=explode(".",$value);

                   $table=trim($col[0]);
                   $column=trim($col[1]);
                   $tablas=explode('as',$table);
                   if (count($tablas)>1) {
                      $table=trim(str_replace("'", " ",$tablas[1]));
                     $column=trim(str_replace("'", " ",$col[1]));
                   }
                   $sqlCmd="select nombrelogico_vam from variablesmodulo where serial_mod=".$this->modulo." and  tabla_vam='".$table."' and nombrefisico_vam='".$column."'";
//                   echo $sqlCmd."<br>";
                   $resultSet=$this->dblink->Execute($sqlCmd);


                   if (count($col)<=1 || !$resultSet || $resultSet->RecordCount()<=0) {
//                   echo $col[0];

                       $nomcol=explode("as",$col[0]) ;
                       $nomcol=$nomcol[1];
//                       echo $nomcol;

                   }

                   $this->vars[]=(count($col)<=1 || !$resultSet || $resultSet->RecordCount()<=0)?$nomcol:$resultSet->fields[0];

                  }

                }

                function addNewPage() {
                  $this->resultSet=$this->dblink->Execute($this->SQLCommand);
                  while (!$this->resultSet->EOF) {
                        $pageaux=$this->page;
                  $i=0;

                  foreach($this->resultSet->fields as $value) {
                    //$meta=utf8_decode($this->vars[$i++]);
                    //$valor=utf8_decode($value);

                    $meta=utf8_decode($this->vars[$i++]);
                    $valor=utf8_decode($value);

  //                  echo $meta ."->".$value."<br>";
                    $pageaux=$this->replace($pageaux,$meta,$valor);
                  }
                  //echo $pageaux."<br>";
                 $this->addPage($pageaux);
                 $this->resultSet->MoveNext();
                  }


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