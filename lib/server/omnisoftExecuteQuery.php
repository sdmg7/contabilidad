<?php
//header ('Cache-Control: must-revalidate, post-check=0, pre-check=0');

header ('Content-type: text/html; charset=utf-8');


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteUpdate() {


   $query = $_POST['query'];
  $query=str_replace('\"', '"',$query);
   $query=str_replace("\'", "'",$query);

   $query=str_replace("\x5C\x5C", "\x5C",$query);

   $dblink=omnisoftConnectDB();
   $dblink->Execute("SET NAMES utf8");

     $dblink->Execute($query);

     $resultData=$dblink->ErrorMsg()."|";
     if (strlen($dblink->ErrorMsg())>0) {
        echo "!".$dblink->ErrorMsg();
        return;
     }
    if (stripos($query,'INTO')!=false) {
        $serial_id=$dblink->Insert_ID();
    }

    $resultData=$resultData.$serial_id."|".$dblink->Affected_Rows();


    echo $resultData;
}

omnisoftExecuteUpdate();
?>
