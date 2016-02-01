<chart>

	<axis_category shadow='light' size='11' color='000000' alpha='70' />
	<axis_value shadow='light' size='10' color='ffffff' alpha='70' steps='4' prefix='' suffix='' decimals='0' separator='' show_min='true' />

	<chart_border color='000000' top_thickness='0' bottom_thickness='2' left_thickness='0' right_thickness='0' />
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
			<number bevel='bevel1' shadow='high'>20</number>
			<number bevel='bevel1' shadow='high'>30</number>
			<number bevel='bevel1' shadow='high'>90</number>
			<number bevel='bevel1' shadow='high'>50</number>
		</row>
		<row>
			<string>region 2</string>
			<number bevel='bevel1' shadow='high'>40</number>
			<number bevel='bevel1' shadow='high'>50</number>
			<number bevel='bevel1' shadow='high'>120</number>
			<number bevel='bevel1' shadow='high'>140</number>
		</row>
		<row>
			<string>region 3</string>
			<number bevel='bevel1' shadow='high'>30</number>
			<number bevel='bevel1' shadow='high'>60</number>
			<number bevel='bevel1' shadow='high'>30</number>
			<number bevel='bevel1' shadow='high'>90</number>
		</row>
		<row>
			<string>average</string>
			<number bevel='bevel1'>30</number>
			<number>46</number>
			<number>80</number>
			<number>93</number>
		</row>
	</chart_data>
	<chart_grid_h alpha='20' color='ffffff' thickness='1' type='dashed' />
	<chart_label color='0000ff' alpha='60' size='11' position='below' />
	<chart_pref line_thickness='2' point_shape='circle' fill_shape='true' />
	<chart_rect x='75' y='50' width='300' height='200' positive_alpha='0' />
	<chart_type>
		<string>column</string>
		<string>column</string>
		<string>column</string>
		<string>line</string>
	</chart_type>

	<draw>
		<rect shadow='bg' layer='background' x='0' y='0' width='400' height='300' fill_color='0' />
		<text shadow='low' layer='background' color='0' alpha='7' rotation='-5' size='100' x='70' y='85' width='300' height='200'>up</text>
		<text shadow='low' color='000000' alpha='10' rotation='-90' size='35' x='-10' y='300' width='400' height='200' >||||||||||||||||||||||||||||||</text>
		<text shadow='high' color='eeffee' alpha='90' size='65' x='15' y='-14' width='400' height='200' h_align='center'>net growth</text>
	</draw>
	<filter>
		<shadow id='low' distance='2' angle='45' color='0' alpha='50' blurX='5' blurY='5' />
		<shadow id='high' distance='7' angle='45' color='0' alpha='40' blurX='15' blurY='15' />
		<shadow id='bg' inner='true' quality='1' distance='50' angle='135' color='000000' alpha='10' blurX='300' blurY='200' knockout='true' />
		<bevel id='bevel1' angle='0' blurX='10' blurY='0' distance='5' highlightAlpha='15' highlightColor='ffffff' shadowAlpha='15' type='inner' />
	</filter>

	<legend shadow='low' x='90' y='58' width='170' height='40' margin='5' fill_color='000000' fill_alpha='0' line_color='000000' line_alpha='0' line_thickness='0' bullet='circle' size='11' color='000000' alpha='60' />

	<series_color>
		<color>ffee88</color>
		<color>aaeedd</color>
		<color>8888ee</color>
		<color>ff6600</color>
	</series_color>

</chart>