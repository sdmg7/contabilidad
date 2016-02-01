<?php
header ('Content-type: text/html; charset=utf-8');

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$aResults = array();

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


 function omnisoftExecuteQuery() {
  global $aResults;
  global  $MAX_AUTOSUGGEST_ITEMS;

	$input = trim(strtolower( $_GET['input'] ));
//        $input=$utf8_decode($input);
	$len = strlen($input);
        $table = strtolower( $_GET['table'] );
        $fieldname = strtolower( $_GET['fieldname'] );
        $fieldid = strtolower( $_GET['fieldid'] );
        $fieldinfo = strtolower( $_GET['fieldinfo'] );
        $fieldinfos=explode(",",$fieldinfo);
        $filtro =  $_GET['filter'] ;
        $filtro=str_replace("\"", "'",$filtro);
        $filtro=str_replace("\'", "'",$filtro);
        $filtro=str_replace("\x5C", "\x5C\x5C",$filtro);

        $n=count($fieldinfos);

        if ($n<=1)
           $fieldinfoc=$fieldinfos[0];
        else {

           $fieldinfoc="concat(";
           for ($i=0;$i<$n-1;$i++)
           $fieldinfoc=$fieldinfoc.$fieldinfos[$i].",'==',";
           $fieldinfoc=$fieldinfoc.$fieldinfos[$i].") as info";

        }

           $dblink=omnisoftConnectDB();
   $dblink->Execute("SET NAMES utf8");

           $dblink->SetFetchMode(ADODB_FETCH_NUM);

           if ($len) {
           $query="select ".$fieldid.",".$fieldname.",".$fieldinfoc." from ".$table." where ((".$fieldname." like '%".$input."%') ";
           for ($i=0;$i<$n;$i++)
           $query=$query." or (".$fieldinfos[$i]." like '%".$input."%') " ;

           $query=$query.")";

           }
           else
           $query="select ".$fieldid.",".$fieldname.",".$fieldinfoc." from ".$table;
           if (strlen($filtro)>1)
            if ($len)
           $query=$query." and ".$filtro."   order by ". $fieldname;
           else
           $query=$query." where ".$filtro."   order by ". $fieldname;

           else
           $query=$query  ." order by ". $fieldname;
//           echo $query;
           $RecordSet=$dblink->Execute($query);
            $item=0;
            while (!$RecordSet->EOF && $item++< $MAX_AUTOSUGGEST_ITEMS) {

				$aResults[] = array( "id"=>($RecordSet->fields[0]) ,"value"=>htmlspecialchars($RecordSet->fields[1]), "info"=>htmlspecialchars($RecordSet->fields[2]) );
                                $RecordSet->MoveNext();

            }


 }



	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0

        omnisoftExecuteQuery();


	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");

		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}
	else
	{
		header("Content-Type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
		for ($i=0;$i<count($aResults);$i++)
		{
			echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
		}
		echo "</results>";
	}

?>