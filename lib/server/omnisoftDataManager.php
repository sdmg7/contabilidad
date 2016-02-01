<?php

header ('Content-type: text/html; charset=utf-8');


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteUpdate() {

  global  $_POST;

   $query = $_POST['query'];
   $accion="MODIFICAR";
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);

   $query=str_replace("\x5C\x5C", "\x5C",$query);
//echo $query;
//   $query=str_replace("\x5C", "\x5C\x5C",$query); original

   $dblink=omnisoftConnectDB();
   $dblink->Execute("SET NAMES utf8");

   $aSQL=explode('|',$query);
   $serial_id=0;
   $i=1;

   if (stripos($aSQL[0],'ELETE') !=false)
       $accion='ELIMINAR';

     $dblink->Execute($aSQL[0]);
     $resultData=$dblink->ErrorMsg()."|";
     if (strlen($dblink->ErrorMsg())>0) {
        echo "!".$dblink->ErrorMsg();
        return;
     }
    if (stripos($aSQL[0],'INTO')!=false) {
        $serial_id=$dblink->Insert_ID();
        $accion="INSERTAR";
    }
    else if (count($aSQL)>1) {
          $serial_id=$aSQL[1];
          $i++;
    }
    //echo "arreglo[0]=".$aSQL[0]."<br>";

    for (; $i < count($aSQL);$i++)  {
         $aquery=str_replace( "MASTERKEY",$serial_id,$aSQL[$i]);
  //       echo "arreglo[$i]=".$aquery."<br>";
         $dblink->Execute($aquery);
    }

  $SQLAudit='insert into AUDITORIA (SERIAL_USR, FECHA_AUD, HORA_AUD, ACCION_AUD, INSTRUCCION_AUD, DIRECCIONIP_AUD, PROCESO_AUD) values ('.$_COOKIE['serial_usr'].',CURRENT_DATE,CURRENT_TIME,"'.$accion.'","'.$query.'","'.$_SERVER['REMOTE_ADDR'].'",1)';
  
  $dblink->Execute($SQLAudit);

    $resultData=$resultData.$serial_id."|".$dblink->Affected_Rows();


    echo $resultData;
}

omnisoftExecuteUpdate();
?>
