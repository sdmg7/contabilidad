<?php
include('../../../lib/adodb/adodb.inc.php');
include('../../../config/config.inc.php');

/*conexion BD*/
function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
return $dblink;
}

session_start();
if(isset($_SESSION['cedente']))
	$auxcedente=$_SESSION['cedente'];
/*else
	$auxcedente='CREDIMETRICA';*/
if(isset($_SESSION['anio']))
	$auxanio=$_SESSION['anio'];
if(isset($_SESSION['mes']))
	$auxmes=$_SESSION['mes'];
/*else
	$auxmes=7;*/

?>
<chart>
   <chart_data>     
     
<?php 
echo "<row>\n";
   echo "<null/>\n";

$con=omnisoftConnectDB();
$auxsql="SELECT CONVERT(VARCHAR, DATEPART(day,fregistro_esc)) monthYear FROM ESTADISTICACEDENTE  where cedente_esc='$auxcedente' and Month(fregistro_esc)=$auxmes  and Year(fregistro_esc)=$auxanio order by fregistro_esc asc";
$rs=$con->Execute($auxsql);
$rs->MoveFirst();
while (!$rs->EOF) {
  echo "<string>".$rs->fields[0]."</string>\n";
  $rs->MoveNext();
 
}
?>      
      </row>
      <row>
         <string>GESTIONES</string>
         
 <?php
 $sqlsum=" select ngestiones_esc from ESTADISTICACEDENTE  where cedente_esc='$auxcedente' and Month(fregistro_esc)=	$auxmes and Year(fregistro_esc)=$auxanio order by fregistro_esc";
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
         <string>PAGO ABONO</string>
         
 <?php
 $sqlsum=" select nabonopago_esc from ESTADISTICACEDENTE  where cedente_esc='$auxcedente' and Month(fregistro_esc)=	$auxmes and Year(fregistro_esc)=$auxanio order by fregistro_esc";
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
         <string>CONTACTADO</string>
         
 <?php
 $sqlsum=" select ncontacto_esc from ESTADISTICACEDENTE  where cedente_esc='$auxcedente' and Month(fregistro_esc)=$auxmes and Year(fregistro_esc)=$auxanio order by fregistro_esc";
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
         <string>NO CONTACTADO</string>
         
 <?php
 $sqlsum=" select  nnocontacto_esc from ESTADISTICACEDENTE  where cedente_esc='$auxcedente' and Month(fregistro_esc)=$auxmes and Year(fregistro_esc)=$auxanio order by fregistro_esc";
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
         <string>INUBICABLE</string>
         
 <?php
 $sqlsum=" select ninubicable_esc from ESTADISTICACEDENTE  where cedente_esc='$auxcedente' and Month(fregistro_esc)=$auxmes and Year(fregistro_esc)=$auxanio order by fregistro_esc";
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
   	<chart_pref line_thickness='1' point_shape='square' point_size='7' fill_shape='true' />
      <chart_guide horizontal='true'
                vertical='false'
                thickness='1' 
                color='ff4400' 
                alpha='75' 
                type='dashed' 
                
                 
                radius='8'
                fill_alpha='0'
                line_color='ff4400'
                line_alpha='75'
                line_thickness='4'
             
                size='10'
                text_color='ffffff'
                background_color='ff4400'
                text_h_alpha='90'
                text_v_alpha='90' 
                />
	<chart_type>Line</chart_type>
     <chart_rect x='200' y='90' width='1000' height='375'   positive_color='f0f0f0' negative_color='b9b9b9'/>
	<draw>
		<rect layer='background' x='0' y='0' width='1600' height='650' fill_color='ffffff'/>
        
	</draw>
	<legend shadow='low' transition='dissolve' delay='0' duration='0' x='25' y='25' width='1220' height='5' layout='horizontal' margin='5' bullet='line' size='20' color='000000' alpha='75' fill_color='000000' fill_alpha='10' line_color='000000' line_alpha='0' line_thickness='0' />
    <context_menu save_as_bmp='true' save_as_jpeg='true' save_as_png='true' /> 
   
    <series_explode>
		<number>300</number>
       	<number>300</number>
    	<number>300</number>
   		<number>300</number>   
   		<number>300</number>       
	</series_explode>
	<series_color>
		<color>000000</color>
   		<color>0000ff</color>
        <color>00ff00</color>
   		<color>ff6600</color>
        <color>ff0000</color>
		<color>ff0000</color>

		
	</series_color>

</chart>
