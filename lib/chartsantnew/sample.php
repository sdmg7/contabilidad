<chart>
	<axis_category margin='false' size='16' color='ffffff' alpha='75' orientation='horizontal' />
	<axis_ticks value_ticks='false' category_ticks='true' major_thickness='2' minor_thickness='1' minor_count='1' major_color='000000' minor_color='222222' position='inside' />
	<axis_value size='10' color='ffffff' alpha='0' steps='6' prefix='' suffix='' decimals='0' separator='' show_min='false' />

	<chart_border color='000000' top_thickness='0' bottom_thickness='2' left_thickness='0' right_thickness='0' />

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
         <number tooltip='Region A' note='Ad Campaign'>5</number>
         <number tooltip='Region A' note='Ad Campaign'>10</number>
         <number tooltip='Region A' note='Ad Campaign'>30</number>
         <number tooltip='Region A' note='Ad Campaign'>63</number>
         <number>5</number>
         <number>10</number>
         <number>30</number>
         <number>63</number>
         <number>30</number>
         <number>63</number>

      </row>
      <row>
         <string>Region B</string>
         <number tooltip='Region B' note='Ad Campaign'>100</number>
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
                </draw>


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

