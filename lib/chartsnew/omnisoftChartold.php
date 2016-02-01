<?php

header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

?>

<chart>

	<axis_category margin='false' size='16' color='ffffff' alpha='75' orientation='horizontal' />
	<axis_ticks value_ticks='false' category_ticks='true' major_thickness='2' minor_thickness='1' minor_count='1' major_color='000000' minor_color='222222' position='inside' />
	<axis_value size='10' color='ffffff' alpha='0' steps='6' prefix='' suffix='' decimals='0' separator='' show_min='false' />

	<chart_border color='000000' top_thickness='0' bottom_thickness='2' left_thickness='0' right_thickness='0' />

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

$data=$_COOKIE['cdata'];
$chartype=$_COOKIE['charttype'];

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
echo " 		<row>
			<null/>
			<string>A</string>
			<string>B</string>
			<string>C</string>
			<string>D</string>
			<string>E</string>
			<string>F</string>
			<string>G</string>
			<string>H</string>
			<string>I</string>
			<string>J</string>
			<string>K</string>
			<string>L</string>
			<string>M</string>
			<string>N</string>
			<string>O</string>
			<string>P</string>
			<string>Q</string>
			<string>R</string>
			<string>S</string>
			<string>T</string>
			<string>U</string>
			<string>V</string>

		</row>
		<row>
			<string>region 1</string>
			<number>10</number>
			<number>25</number>
			<number>110</number>
			<number>110</number>
			<number>110</number>
			<number>10</number>
			<number>25</number>
			<number>110</number>
			<number>110</number>
			<number>25</number>
			<number>25</number>
			<number>10</number>
			<number>25</number>
			<number>110</number>
			<number>110</number>
			<number>110</number>
			<number>10</number>
			<number>25</number>
			<number>110</number>
			<number>110</number>
			<number>25</number>
			<number>110</number>

		</row>
		<row>
			<string>region 2</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>80</number>


		</row>
		<row>
			<string>region 3</string>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>30</number>
			<number>30</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>30</number>

		</row>
                		<row>
			<string>region 4</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>

		</row>


		<row>
			<string>region 5</string>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>

		</row>

                		<row>
			<string>region 6</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>
		                		<row>
			<string>region 7</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 8</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>

		</row>

                                		<row>
			<string>region 9</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 10</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                		<row>
			<string>region 11</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
		<string>region 12</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 13</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 14</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 15</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 16</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                		<row>
			<string>region 17</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 18</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>

                                		<row>
			<string>region 19</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>65</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>80</number>
			<number>35</number>
			<number>65</number>
			<number>80</number>
			<number>80</number>
			<number>65</number>
			<number>80</number>

		</row>


                		<row>
			<string>region 20</string>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>
			<number>55</number>
			<number>30</number>
			<number>10</number>
			<number>10</number>
			<number>10</number>

		</row>";

}

?>

	</chart_data>
	<chart_grid_h alpha='5' color='000000' thickness='5' />
	<chart_label alpha='90' size='10' position='over' />
	<chart_pref min_x='0' max_x='90' min_y='0' max_y='70' />
	<chart_rect x='20' y='20' width='700' height='430' positive_color='ffffff' positive_alpha='50' />
	<chart_transition type='dissolve' delay='0' duration='.5' order='all' />
	<chart_type><?php echo $charttype ?></chart_type>

	<draw>
		<rect bevel='bg' layer='background' x='0' y='0' width='720' height='500' fill_color='8EBBE9' line_thickness='0' />
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
	</series_color>

<?php

print "   <update url='omnisoftChart.php?uniqueID=0.26440600+1128349620&charttype=".$charttype."&data=".$data."' delay='1' mode='data' span='5' /> ";
?>

</chart>

