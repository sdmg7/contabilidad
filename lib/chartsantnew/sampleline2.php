<chart>

	<axis_category size='16' alpha='85' shadow='medium' />
	<axis_ticks value_ticks='false' category_ticks='true' major_thickness='2' minor_thickness='1' minor_count='1' minor_color='222222' position='inside' />
	<axis_value shadow='medium' min='-40' size='10' color='ffffff' alpha='65' steps='6' show_min='false' />
	
	<chart_data>
		<row>
			<null/>
			<string>2005</string>
			<string>2006</string>
			<string>2007</string>
			<string>2008</string>
		</row>
		<row>
			<string>region 1</string>
			<number shadow='medium' tooltip='$48 Million'>48</number>
			<number tooltip='$55 Million' note='Ad Campaign'>55</number>
			<number tooltip='$80 Million'>80</number>
			<number tooltip='$100 Million'>100</number>
		</row>
		<row>
			<string>region 2</string>
			<number shadow='low' tooltip='$-12 Million'>-12</number>
			<number tooltip='$10 Million'>10</number>
			<number tooltip='$55 Million'>55</number>
			<number tooltip='$65 Million'>65</number>
		</row>
		<row>
			<string>region 3</string>
			<number shadow='low' tooltip='$27 Million'>27</number>
			<number tooltip='$-20 Million'>-20</number>
			<number tooltip='$15 Million'>15</number>
			<number tooltip='$80 Million'>80</number>
		</row>
	</chart_data>
	<chart_grid_h alpha='10' thickness='1' />
	<chart_guide horizontal='true' vertical='true' thickness='1' alpha='25' type='dashed' text_h_alpha='0' text_v_alpha='0' />
	<chart_note type='flag' size='11' color='000000' alpha='70' x='-10' y='-36' background_color='aaff00' background_alpha='75' shadow='medium' bevel='note' />
	<chart_pref line_thickness='2' point_shape='circle' point_size='7' fill_shape='false' />
	<chart_rect x='50' y='100' width='320' height='150' positive_color='ffffee' positive_alpha='65' negative_color='ff8888' negative_alpha='65' bevel='bg' shadow='high' />
	<chart_transition type='slide_left' delay='.5' duration='0.5' order='series' />
	<chart_type>Line</chart_type>
	
	<draw>
		<text shadow='high' transition='dissolve' delay='0' duration='0.5' alpha='10' size='48' x='8' y='8' width='400' height='75' h_align='center' v_align='bottom'>annual report</text>
		<image transition='dissolve' delay='1' url='images/full_screen.swf' x='340' y='225' width='20' height='15' alpha='90' />
	</draw>
	<filter>
		<shadow id='low' distance='2' angle='45' alpha='20' blurX='5' blurY='5' />
		<shadow id='medium' distance='2' angle='45' alpha='40' blurX='7' blurY='7' />
		<shadow id='high' distance='5' angle='45' alpha='25' blurX='10' blurY='10' />
		<bevel id='bg' angle='45' blurX='15' blurY='15' distance='5' highlightAlpha='25' shadowAlpha='50' type='outer' />
		<bevel id='note' angle='45' blurX='10' blurY='10' distance='3' highlightAlpha='60' shadowAlpha='15' />
	</filter>
   
	<legend shadow='low' transition='dissolve' delay='0' duration='0.5' x='50' y='75' width='320' height='5' layout='horizontal' margin='5' bullet='line' size='13' color='ffffff' alpha='75' fill_color='000000' fill_alpha='10' line_color='000000' line_alpha='0' line_thickness='0' />
	
	<link>
		<area x='340' y='225' width='20' height='15' target='toggle_fullscreen' tooltip='Full Screen Mode' />
	</link>
	<tooltip color='FFFFFF' alpha='90' background_color='8888FF' background_alpha='90' shadow='medium' />
            
	<series_color>
		<color>ff4422</color>
		<color>ffee00</color>
		<color>8844ff</color>
	</series_color>
	<series_explode>
		<number>400</number>
	</series_explode>

</chart>

