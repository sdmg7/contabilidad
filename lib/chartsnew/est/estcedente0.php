
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
      <row>
         <string>BPAC</string>
         
 <?php
 $sqlsum=" select ngestiones_esc from ESTADISTICACEDENTE  where cedente_esc='BPAC' and Month(fregistro_esc)=7 order by fregistro_esc";
 $rs=$con->Execute($sqlsum);
$rs->MoveFirst();
while (!$rs->EOF) {
  if($rs->fields[0]!=null)
  echo "<number>".$rs->fields[0]."</number>\n";
  else
  		echo "<number>"."0"."</number>\n";
		  $rs->MoveNext();
}

 ?>        
      </row>
      <row>
         <string>CREDIMETRICA</string>
         
 <?php
 $sqlsum=" select ngestiones_esc from ESTADISTICACEDENTE  where cedente_esc='CREDIMETRICA' and Month(fregistro_esc)=7 order by fregistro_esc";
 $rs=$con->Execute($sqlsum);
$rs->MoveFirst();
while (!$rs->EOF) {
  if($rs->fields[0]!=null)
  echo "<number>".$rs->fields[0]."</number>\n";
  else
  		echo "<number>"."0"."</number>\n";
		  $rs->MoveNext();
}

 ?>        
      </row>
      <row>
         <string>ORIGINARSA</string>
         
 <?php
 $sqlsum=" select ngestiones_esc from ESTADISTICACEDENTE  where cedente_esc='ORIGINARSA' and Month(fregistro_esc)=7 order by fregistro_esc";
 $rs=$con->Execute($sqlsum);
$rs->MoveFirst();
while (!$rs->EOF) {
  if($rs->fields[0]!=null)
  echo "<number>".$rs->fields[0]."</number>\n";
  else
  		echo "<number>"."0"."</number>\n";
		  $rs->MoveNext();
}

 ?>        
      </row>
      

	</chart_data>
	<chart_pref line_thickness='1' point_shape='none' point_size='7' fill_shape='false' />
	<chart_transition type='slide_left' delay='.5' duration='1' order='series' />
	<chart_type>Line</chart_type>
</chart>
