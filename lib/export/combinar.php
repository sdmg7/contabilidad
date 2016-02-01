<?php

	require("omnisoftRTF.php");

	$RTFObj = new omnisoftRTF('','plantilla.rtf');
	$metadata= array ('NOMBRE_ALUMNO'=>'Marco Hernan','APELLIDO_ALUMNO'=>'Jarrin Lopez') ;
        $RTFObj->addNewPage($metadata);
	$metadata= array ('NOMBRE_ALUMNO'=>'Julio Cesar','APELLIDO_ALUMNO'=>'Jarrin Sanchez') ;
        $RTFObj->addNewPage($metadata);

        $RTFObj->show();
?>
