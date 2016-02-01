<chart>

	<axis_category margin='false' size='16' color='ffffff' alpha='75' orientation='horizontal' />
	<axis_ticks value_ticks='false' category_ticks='true' major_thickness='2' minor_thickness='1' minor_count='1' major_color='000000' minor_color='222222' position='inside' />
	<axis_value size='10' color='ffffff' alpha='0' steps='6' prefix='' suffix='' decimals='0' separator='' show_min='false' />

	<chart_border color='000000' top_thickness='0' bottom_thickness='2' left_thickness='0' right_thickness='0' />
	<chart_data>
		<row>
			<null/>
			<string>2006</string>
			<string>2007</string>
			<string>2008</string>
		</row>
		<row>
			<string>region A</string>
			<number>10</number>
			<number>25</number>
			<number>110</number>
		</row>
		<row>
			<string>region B</string>
			<number>35</number>
			<number>65</number>
			<number>80</number>
		</row>
		<row>
			<string>region C</string>
			<number>55</number>
			<number>30</number>
			<number>10</number>
		</row>
	</chart_data>
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

</chart>

