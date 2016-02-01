<?php

header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

?>

<chart>

	<axis_category margin='false' size='12' color='ffffff' alpha='75' orientation='horizontal' shadow='low' steps='4'/>
	<axis_ticks value_ticks='true' category_ticks='true' major_thickness='2' minor_thickness='1' minor_count='1' major_color='000000' minor_color='222222' position='inside' />
	<axis_value size='10' color='ffffff' alpha='75' steps='5' prefix='' suffix='' decimals='0' separator='' show_min='true' min='0'/>

	<chart_border color='000000' top_thickness='0' bottom_thickness='5' left_thickness='0' right_thickness='0' />

	<chart_data> 

<?php

function leerValor($itemX,$itemY,$records) {
  $n=count($records)-1;
  for ($i=1;$i<$n;$i++) {
         $item=explode('~',$records[$i]);
         if ($item[0]==$itemX && $item[1]==$itemY)
            return $item[2];
  }
 return 0;
}

if(isset($_GET['data']))
$data=$_GET['data'];
if(isset($_GET['charttype']))
$charttype=$_COOKIE['charttype'];
//$data=$_COOKIE['cdata'];
if (!empty($data)) {

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

}
else {
echo " 	<row>
			<null/>
			<string>A</string>
			<string>B</string>
		</row>
		<row>
			<string>region 1</string>
			<number>10</number>
			<number>25</number>
		</row>
		<row>
			<string>region 2</string>
			<number>35</number>
			<number>65</number>
		</row>
		<row>
			<string>region 3</string>
			<number>55</number>
			<number>30</number>
		</row>";

}

?>

	</chart_data>
	<chart_grid_h alpha='5' color='000000' thickness='5' type='dashed' />
	<chart_label alpha='90' size='10' position='middle' color='ddffff' />
 	<chart_note type='arrow' size='13' color='000000' alpha='75' x='-10' y='-30' background_color_1='FF4400' background_alpha='75' shadow='low' />

	<chart_rect x='20' y='20' width='600' height='400' positive_color='ffffff' positive_alpha='50' />
	<chart_transition type='scale' delay='0.5' duration='1' order='series' />
	<chart_type><?php echo $charttype ?></chart_type>

	<draw>
		<rect bevel='bg' layer='background' x='0' y='0' width='600' height='450' fill_color='8EBBE9' line_thickness='0' />
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
		<color>00ff88</color>
		<color>ffaa00</color>
		<color>66ddff</color>
		<color>bb00ff</color>
		<color>0088dd</color>
		<color>88ffdd</color>
		<color>ff88aa</color>
		<color>ff00aa</color>
		<color>ff8800</color>
	</series_color>
    	<series set_gap='40' bar_gap='-25' />

<?php

//print "   <update url='omnisoftChart.php?uniqueID=0.26440600+1128349620&charttype=".$_GET['charttype']."&data=".$data."' delay='1' mode='data' span='5' /> ";
?>

</chart>





