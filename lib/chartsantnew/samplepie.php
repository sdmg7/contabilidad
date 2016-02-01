<chart>

   <chart_data>
      <row>
         <null/>
         <string>2000</string>
         <string>2001</string>
         <string>2002</string>
         <string>2003</string>
         <string>2004</string>
         <string>2005</string>
         <string>2006</string>
         <string>2007</string>
         <string>2008</string>
         <string>2009</string>

      </row>
      <row>
         <string>Region A</string>
         <number>5</number>
         <number>10</number>
         <number>30</number>
         <number>63</number>
         <number>5</number>
         <number>10</number>
         <number>30</number>
         <number>63</number>
         <number>30</number>
         <number>63</number>

      </row>
      <row>
         <string>Region B</string>
         <number>100</number>
         <number>20</number>
         <number>65</number>
         <number>55</number>
         <number>100</number>
         <number>20</number>
         <number>65</number>
         <number>55</number>
         <number>65</number>
         <number>55</number>

      </row>
      <row>
         <string>Region C</string>
         <number>56</number>
         <number>21</number>
         <number>5</number>
         <number>90</number>
         <number>100</number>
         <number>20</number>
         <number>65</number>
         <number>55</number>
         <number>65</number>
         <number>55</number>

      </row>
   </chart_data>


<chart_type>3d pie</chart_type>
<chart_grid_h thickness='0' />
	<chart_label shadow='high' color='000000' alpha='65' size='10' position='inside' as_percentage='false' />
	<chart_pref select='false' drag='true' rotation_x='60' min_x='20' max_x='90' />
	<chart_rect x='80' y='80' width='420' height='300' positive_alpha='0' />
	<chart_transition type='spin' delay='.5' duration='0.75' order='category' />
	<chart_type>3d pie</chart_type>


      <draw>
		<rect bevel='bg' layer='background' x='0' y='0' width='600' height='450' fill_color='8EBBE9' line_thickness='0' />
		<text shadow='low' color='0' alpha='10' size='40' x='0' y='260' width='400' height='50' h_align='center' v_align='middle'>567890123456789012</text>
		<rect shadow='low' layer='background' x='-60' y='20' width='500' height='250' rotation='-5' fill_alpha='0' line_thickness='80' line_alpha='5' line_color='0' />	
                </draw>
                
     	<legend shadow='high' x='10' y='10' width='380' height='35' margin='10' fill_alpha='10' fill_color='000000' line_alpha='0' line_thickness='0' bullet='circle' size='14' color='ffffff' alpha='85' />
           
	<filter>
		<shadow id='low' distance='2' angle='45' color='0' alpha='50' blurX='4' blurY='4' />
		<bevel id='bg' angle='180' blurX='100' blurY='100' distance='50' highlightAlpha='0' shadowAlpha='15' type='inner' />
		<bevel id='bevel1' angle='45' blurX='5' blurY='5' distance='1' highlightAlpha='25' highlightColor='ffffff' shadowAlpha='50' type='inner' />
	</filter>

	<legend bevel='bevel1' transition='dissolve' delay='0' duration='1' x='0' y='45' width='50' height='210' margin='10' fill_color='0' fill_alpha='20' line_color='000000' line_alpha='0' line_thickness='0' layout='horizontal' bullet='circle' size='12' color='ffffff' alpha='85' />

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
	<series_explode>
		<number>25</number>
		<number>75</number>
	</series_explode>

</chart>

