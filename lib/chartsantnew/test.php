<?php

            header("Content-Type: application/force-download");
            header("Content-Transfer-Encoding: text");
            header('Content-Disposition: attachment; filename=test.xml');
    $data=$_GET['data'];
if (!empty($data)) {

function leerValor($itemX,$itemY,$records) {
  $n=count($records)-1;
  for ($i=1;$i<$n;$i++) {
         $item=explode('~',$records[$i]);
         if ($item[0]==$itemX && $item[1]==$itemY)
            return $item[2];
  }
 return 0;
}

echo "
<chart>

	<axis_category margin='false' size='16' color='ffffff' alpha='75' orientation='horizontal' />
	<axis_ticks value_ticks='false' category_ticks='true' major_thickness='2' minor_thickness='1' minor_count='1' major_color='000000' minor_color='222222' position='inside' />
	<axis_value size='10' color='ffffff' alpha='0' steps='6' prefix='' suffix='' decimals='0' separator='' show_min='false' />

	<chart_border color='000000' top_thickness='0' bottom_thickness='2' left_thickness='0' right_thickness='0' />
	<chart_data>";



    $charttype=$_GET['charttype'];
    $records=explode('|',$data);
    $n=count($records)-1;
    $matriz=array();
    $item=explode('~',$records[1]);

    $matriz[$item[0]][$item[1]]=$item[2];
    $itemyactual=$item[1];
     $itemxactual=$item[0];

     for ($i=2;$i<$n;$i++)   {

         $item=explode('~',$records[$i]);

         if ($item[0]!=$itemxactual) {

            $matriz[$item[0]][$itemyactual]=0;
            $itemxactual=$item[0];

         }

     }

     for ($i=1;$i<$n;$i++) {
       $itemyactual='';
        $item=explode('~',$records[$i]);
        $itemxactual=$item[0];


       for ($j=1;$j<$n;$j++)   {

         $item=explode('~',$records[$j]);
         if ($item[1]!=$itemyactual) {
            $matriz[$itemxactual][$item[1]]=leerValor($itemxactual,$item[1],$records);
            $itemyactual=$item[1];
         }
        }
     }

         echo "<row>\n";
    echo "<null/>\n";
     foreach($matriz as $row => $col)
       echo "<string>".$row."</string>\n";
	echo "</row>\n";

        reset($matriz);
     $arreglo=each($matriz);
         foreach($arreglo['value'] as $nombre => $valor){
     echo "<row>\n";

       echo "<string>".$nombre."</string>\n";
          foreach($matriz as $row =>$col) {
           echo "<number>".$matriz[$row][$nombre]."</number>\n";

         }
	echo "</row>\n";
         }






/*

echo "<row>
 <null/>
 <string>MANO DE OBRA DIRECTA</string>
<string>MANO DE OBRA INDIRECTA</string>
</row>";


echo " <row>
<string>PRODUCCION-UHT</string>
<number>1</number>
<number>0</number>
</row>
<row>
<string>CALIDAD</string>
<number>0</number>
<number>1</number>
</row>
<row>
<string>GESTION DE CALIDAD</string>
<number>0</number>
<number>1</number>
</row>
<row>
<string>LABORATORIO</string>
<number>0</number>
<number>1</number>
</row>
<row>
<string>LOGISTICA</string>
<number>0</number>
<number>1</number>
</row>
<row>
<string>MANTENIMIENTO</string>
<number>0</number>
<number>1</number>
</row>
<row>
<string>PLANTA</string>
<number>0</number>
<number>1</number>
</row>
<row>
<string>VENTAS</string>
<number>0</number>
<number>1</number>
</row>";

*/
echo "	</chart_data>
	<chart_grid_h alpha='5' color='000000' thickness='5' />
	<chart_label alpha='90' size='10' position='above' />
	<chart_pref min_x='0' max_x='90' min_y='0' max_y='70' />
	<chart_rect x='50' y='50' width='320' height='200' positive_color='ffffff' positive_alpha='50' />
	<chart_transition type='dissolve' delay='0' duration='.5' order='all' />
	<chart_type>3d area</chart_type>

	<draw>
		<rect bevel='bg' layer='background' x='0' y='0' width='400' height='300' fill_color='8ebbe9' line_thickness='0' />
	</draw>
	<filter>
		<bevel id='bg' angle='-90' blurX='0' blurY='200' distance='50' highlightAlpha='15' shadowAlpha='15' type='inner' />
		<shadow id='high' distance='5' angle='45' alpha='35' blurX='15' blurY='15' />
		<shadow id='low' distance='2' angle='45' alpha='50' blurX='5' blurY='5' />
		<shadow id='title'  distance='3' angle='45' alpha='100' blurX='5' blurY='5' inner='true' knockout='true' />
	</filter>

	<legend shadow='high' x='10' y='10' width='380' height='35' margin='10' fill_alpha='10' fill_color='000000' line_alpha='0' line_thickness='0' bullet='circle' size='14' color='ffffff' alpha='85' />

	<series_color>
		<color>0088ff</color>
		<color>88ff00</color>
		<color>ff8800</color>
	</series_color>

</chart>";
}
?>

