
<?php
include('../../../lib/adodb/adodb.inc.php');
include('../../../config/config.inc.php');

/*conexion BD*/
function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
return $dblink;
}

?>
<chart>
   <chart_data>     
     
<?php 
echo "<row>\n";
   echo "<null/>\n";

$con=omnisoftConnectDB();
$auxsql="SELECT CONVERT(VARCHAR, DATEPART(day,fregistro_esc)) monthYear FROM ESTADISTICACEDENTE  where cedente_esc='BPAC' and Month(fregistro_esc)=7 order by fregistro_esc asc";
$rs=$con->Execute($auxsql);
$rs->MoveFirst();
while (!$rs->EOF) {
  echo "<string>".$rs->fields[0]."</string>\n";
  $rs->MoveNext();
 
}
?>      
      </row>
<?php
$sqlced="select top(5) nombre_ced from cedente where estadistica_ced='S'";
$rs=$con->Execute($sqlced);
$rs->MoveFirst();
while (!$rs->EOF) {
	$varced=$rs->fields[0];
  echo "<row>\n";
    echo "<string>".$varced."</string>\n";
 $sqlsum="select ngestiones_esc from ESTADISTICACEDENTE  where cedente_esc="."'".$varced."'" ." and Month(fregistro_esc)=7 order by fregistro_esc";

 $rsum=$con->Execute($sqlsum);
 $rsum->MoveFirst();
while (!$rsum->EOF) {
  if($rsum->fields[0]!=null)
  echo "<number>".$rsum->fields[0]."</number>\n";
  else
  		echo "<number>"."0"."</number>\n";
		  $rsum->MoveNext();
}


  echo "</row>\n";

$rs->MoveNext();
}
	
?> 
      
          

	</chart_data>
	<chart_pref line_thickness='1' point_shape='none' point_size='7' fill_shape='false' />
	<chart_transition type='slide_left' delay='.5' duration='1' order='series' />
	<chart_type>Line</chart_type>
</chart>
