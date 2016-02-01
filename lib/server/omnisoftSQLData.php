<?php

header ('Content-type: text/html; charset=utf-8');


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');



function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteQuery() {

   $query = $_POST['query'];
   $query=str_replace('\"', '"',$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $dblink->SetFetchMode(ADODB_FETCH_NUM);
 $dblink->Execute("SET NAMES utf8");

  $RecordSet=$dblink->Execute($query);

   $resultData="|";

  $RecordSet->MoveFirst();

  while ( !$RecordSet->EOF) {

      $resultData .= join( $RecordSet->fields, '~') . "|";
      $RecordSet->MoveNext();
  }
  echo $resultData;

}


  omnisoftExecuteQuery();

 ?>
