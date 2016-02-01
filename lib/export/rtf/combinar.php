<?php

	require("rtf/omnisoftRTF.php");

	$RTF = new omnisoftRTF('plantilla.rtf');
	$RTF->decodeRTF();
	$page=$RTF->getPage();
        $page1=$RTF->replace($page,'NOMBRE_ALUMNO','Marco Jarrin Lopez');
        $page2=$RTF->replace($page,'NOMBRE_ALUMNO','Elisabeth Waltregny');

        $RTF->addPage($page1);
        $RTF->addPage($page2);

	/*$RTF->new_page();
			$RTF->add_text('pagina 2');
		$RTF->new_line();


	$RTF->new_page();

		$RTF->add_text('pagina 3');
		$RTF->new_line();

	$RTF->display();
        */
        $RTF->show();
?>
