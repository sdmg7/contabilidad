<?php
	/*
     * File: example.php
     *
     * 2008/12/10	20:00:00
     */

	require("rtf_class.php");

	$RTF = new RTF();
	$RTF->set_default_font("Tahoma", 10);

	function draw_title($title, $align = 'left'){

        global $RTF;

	   	$RTF->set_font("Arial Black", 15);
		$TITLE = $RTF->bold(1) . $RTF->underline(1) . $title . $RTF->underline(0) . $RTF->bold(0);
		$RTF->new_line();
		$RTF->add_text($TITLE, $align);
		$RTF->new_line();
		$RTF->new_line();
	}

    ### Graphical Effects
	draw_title("Graphical Effects");

	$text[] = $RTF->emboss(1). "emboss()". $RTF->emboss(0);
	$text[] = $RTF->sub(1). "sub()". $RTF->sub(0);
	$text[] = $RTF->super(1). "super()". $RTF->super(0);
	$text[] = $RTF->engrave(1) . "engrave()". $RTF->engrave(0);
	$text[] = $RTF->caps(1). "caps()". $RTF->caps(0);
	$text[] = $RTF->outline(1). "outline()" . $RTF->outline(0);
	$text[] = $RTF->shadow(1). "shadow()". $RTF->shadow(0);
	$text[] = $RTF->bold(1). "bold()". $RTF->bold(0);
	$text[] = $RTF->underline(1) . "underline()" . $RTF->underline(0);
	$text[] = $RTF->italic(1). "italic()" . $RTF->italic(0);

	foreach ($text as $key => $value)
	{
		$RTF->add_text($value);
		$RTF->new_line();
	}

    ### Color Examples
    draw_title("Color Examples");

	for ($i=0; $i<17; $i++)
	{
		$RTF->add_text( $RTF->color($i) . "THIS IS A COLORED TEXT (COLOR ID: $i)");
		$RTF->new_line();
	}

    ### Fonts Examples
	draw_title("Fonts Examples");

	$fonts = Array("Arial", "Arial Black", "Tahoma", "Verdana", "Times New Roman", "Courier New");

	foreach ($fonts as $key => $value)
	{
		$dim = 20;
		$RTF->set_font($value, $dim);
		$RTF->add_text("Written using font ". $RTF->bold(1) . "$value" . $RTF->bold(0) . " with dimension $dim");
		$RTF->new_line();
	}

	$RTF->new_page();

	$RTF->add_text($RTF->bold(1) . "NOTE: " . $RTF->bold(0) );
	$RTF->add_text("The page has been changed!");
	$RTF->new_line(2);

    ### Images Examples
	draw_title("Images Examples");

	$img_dim = 100;
	$RTF->add_text("Image aligned to the left");
	$RTF->paragraph();
	$RTF->add_image("images.jpg", $img_dim, "left");
	$RTF->new_line();

	$RTF->add_text("Image aligned to center", "center");
    $RTF->paragraph();
    $RTF->add_image("images.jpg", $img_dim, "center");
    $RTF->new_line();

	$RTF->add_text("Image aligned to the right", "right");
    $RTF->paragraph();
    $RTF->add_image("images.jpg", $img_dim, "right");
    $RTF->new_line();

	$RTF->new_page();

    ### Lists Examples
    draw_title("Lists");

	$elenco = array("one", "two", "three", "four", "five");
	$RTF->add_list($elenco, "left");

    ### Table Exemple
    draw_title("Table Exemple");

    $clientes=array(
        '0' => array
	        (
             'Cliente' => array
                 (
                   'id' => '01',
                   'name' => 'Client01',
                   'mail' => 'client@test.com',
                   'blocked' => 'N',
                   'asset' => 'Y'
                 )

	        ),
        '1' => array
	        (
             'Cliente' => array
                 (
                   'id' => '02',
                   'name' => 'Client02',
                   'mail' => 'client@test.com',
                   'blocked' => 'N',
                   'asset' => 'Y'
                 )

	        ),
        '2' => array
	        (
             'Cliente' => array
                 (
                   'id' => '03',
                   'name' => 'Client03',
                   'mail' => 'client@test.com',
                   'blocked' => 'N',
                   'asset' => 'Y'
                 )

	        ),
  	);

    ### Parameters of counting
	$i = 0;
	$quantpag = 46;
	$n_page = ceil(count($clientes)/$quantpag);

	foreach ($clientes as $cliente){

		if($i == 0 OR $i == $quantpag){

			######################### Assemble the Header #########################

			### Arrow to the source texts outside the table (font, size)
			$RTF->set_default_font("Arial", 11);

			### Adds text of the header
			$RTF->tab(6);
			$RTF->add_text("CUSTOMERS", "center");
			$RTF->tab(4);
			$RTF->set_default_font("Arial", 9);
			$RTF->add_text(date('d/m/Y')." to ". date('h:i:s'), "center");

			### Adds a new row
			$RTF->new_line();

			### Pula line "ln (number of lines)"
			$RTF->ln(1);

			### Arrow of the source table (font, size)
			$RTF->set_table_font("Arial", 9);

			### Opens line for a table
    		$RTF->open_line();

			### cell: text, size of cell in% (the sum of all cells must be equal to 100%), alignment of the text, background color of the cell (0 to 16)
		    $RTF->cell($RTF->bold(1).$RTF->color(8)."Code", "10", "center", "15");
		    $RTF->cell("Name", "50", "center", "15");
		    $RTF->cell("Mail", "30", "center", "15");
		    $RTF->cell("Blocked", "5", "center", "15");
		    $RTF->cell("Asset".$RTF->bold(0).$RTF->color(0), "5", "center", "15");

		    ### Close the line to table
    		$RTF->close_line();

    		$page++;
		}

		### Makes zebra
		($corFundo == "8") ? ($corFundo = "16") : ($corFundo = "8");

		### Arrow of the source table (fonte_id, size)
		$RTF->set_table_font("Arial", 9);

		### Opens line for a table
	    $RTF->open_line();

	    ### cell: text, size of cell in% (the sum of all cells must be equal to 100%), alignment of the text, background color of the cell (0 to 16)
	    $RTF->cell($cliente['Cliente']['id'], "10", "left", $corFundo);
	    $RTF->cell($cliente['Cliente']['name'], "50", "left", $corFundo);
	    $RTF->cell($cliente['Cliente']['mail'], "30", "left", $corFundo);
	    $RTF->cell($cliente['Cliente']['blocked'], "5", "center", $corFundo);
	    $RTF->cell($cliente['Cliente']['asset'], "5", "center", $corFundo);

	    ### Close the line to table
	    $RTF->close_line();

	    ### Parameters of counting
		$i++;

		if($i == $quantpag){

			$RTF->ln(2);
			$RTF->tab(13);
			$RTF->set_default_font("Arial", 9);
			$RTF->add_text('Page: '.$page.' of: '.$n_page, "center");

		    $i=0;

		    ### Adds a new page
		    $RTF->new_page();
		}
	}

	$RTF->ln(2);
	$RTF->tab(13);
	$RTF->add_text('Page: '.$page.' of: '.$n_page, "right");


	$RTF->display();
?>
