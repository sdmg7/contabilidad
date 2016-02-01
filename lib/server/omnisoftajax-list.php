<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$aResults = array();

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


 function omnisoftExecuteQuery() {

   if(isset($_GET['letters'])){

     $letters=$_GET['letters'];
//     $letters = preg_replace("/[^a-z0-9 ]/si","",$letters);

        $table = strtolower( $_GET['table'] );
        $fieldname = strtolower( $_GET['fieldname'] );
        $fieldid = strtolower( $_GET['fieldid'] );
        $fieldinfo = strtolower( $_GET['fieldinfo'] );

        $filtro =  $_GET['filter'] ;
        $filtro=str_replace("\"", "'",$filtro);
        $filtro=str_replace("\'", "'",$filtro);
        $filtro=str_replace("\x5C", "\x5C\x5C",$filtro);



           $dblink=omnisoftConnectDB();
           $dblink->SetFetchMode(ADODB_FETCH_NUM);

           $query="select ".$fieldid.",concat(".$fieldname.",'==>',".$fieldinfo.") as nombre from ".$table." where ((".$fieldname." like '".$letters."%') or (".$fieldinfo." like '%".$letters."%'))" ;

           if (strlen($filtro)>1 && $filtro!='null' )
           $query=$query." and ".$filtro."   order by ". $fieldname;
           else
           $query=$query  ." order by ". $fieldname;
//           echo $query;

           $RecordSet=$dblink->Execute($query);
            $item=0;
            while (!$RecordSet->EOF ) {

                echo $RecordSet->fields[0]."###".htmlspecialchars($RecordSet->fields[1])."|";
                                $RecordSet->MoveNext();

            }
   }
 }


        omnisoftExecuteQuery();

?>