<?php 


include('../lib/adodb/adodb.inc.php');
include('../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
return $dblink;
}

$con=omnisoftConnectDB();

//echo "USUARIO: ".$_COOKIE['serial_usr'];

if (isset($_COOKIE['usuario']) and isset($_POST["passwordNew1"]))
{   $auxusuario=strtoupper($_COOKIE['usuario']); 
    	$auxcontrasena1 = $_POST["passwordNew1"];
	     $auxcontrasena1 = strtoupper(trim($auxcontrasena1)) ;
         $auxcontrasenaAc = $_POST["passwordActual"];  
	   $auxcontrasenaAc = strtoupper(trim($auxcontrasenaAc));
		if (validarUsuario($auxusuario,$auxcontrasenaAc,$con)==true )
	 		    grabarContrasena($auxusuario,$auxcontrasena1,$con);  
		else
			echo "<script>alert('Contraseña Actual incorrecta!!');</script>";	
}
	
?>	  

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" >
<title>CAMBIO CONTRASE&Ntilde;A</title>
<link rel="stylesheet" href="css/jqautocomplete.css" type="text/css" media="screen" charset="utf-8" />
<link href="menu_assets/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #6677AA;
}
.style1 {font-size: xx-large}
.style2 {
	font-size: xx-large;
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<script type="text/javascript">
function validate_password()
{	
	//Cogemos los valores actuales del formulario
	pasActual=document.formName.passwordActual;
	pasNew1=document.formName.passwordNew1;
	pasNew2=document.formName.passwordNew2;
	//Cogemos los id's para mostrar los posibles errores
	id_epassActual=document.getElementById("epasswordActual");
	id_epassNew=document.getElementById("epasswordNew1");

	//Patron para los numeros
	var patron1=new RegExp("[0-9]+");
	//Patron para las letras
	var patron2=new RegExp("[a-zA-Z]+");

	if(pasNew1.value==pasNew2.value && pasNew1.value.length>=6 && pasActual.value!="" && pasNew1.value.search(patron1)>=0 && pasNew1.value.search(patron2)>=0){
  	    document.forms[0].submit(); 
		return true;
	}else{
		if(pasNew1.value.length<6)
			id_epassNew.innerHTML="La longitud mínima tiene que ser de 6 caracteres";
		else if(pasNew1.value!=pasNew2.value)
			id_epassNew.innerHTML="La repetición de la nueva contraseña NO coincide";
		else if(pasNew1.value.search(patron1)<0 || pasNew1.value.search(patron2)<0)
			id_epassNew.innerHTML="La contraseña tiene que tener números y letras";
		else
			id_epassNew.innerHTML="";
		if(pasActual.value=="")
			id_epassActual.innerHTML="Indicar su contraseña actual";
		else
			id_epassActual.innerHTML="";
		return false;
	}
}
</script>

<body>

<table align="center" bgcolor="#BBBBEE" width="72%" border="1">
<tr> 
	  <p align="center" class="style2">Cambio de contrase&ntilde;a </p>
</tr>
<tr>
 <td align="center" bgcolor="#DDDDDD">
<form name="formName" action="cambiacontrasena.php" method="POST" onsubmit='return validate_password()'>
	<div id="epasswordActual" style="color:#000000;">
	  <p>&nbsp;</p>
	  <p>POR FAVOR INGRESE LOS SIGUIENTES DATOS: </p>
	  <p>&nbsp;</p>
	</div>
	<div>
	  <p>Contrase&ntilde;a Actual:
	    <input type="password" name="passwordActual"/>
</p>
	  <p>&nbsp;</p>
	</div>
	<div id="epasswordNew1" style="color:#f00;"></div>
	<div>
	  <p>Nueva Contrase&ntilde;a:
	    <input type="password" name="passwordNew1"/>
	  </p>
	  </div>
	<div>
	  <p>Repita Contrase&ntilde;a:
	    <input type="password" name="passwordNew2"/>
	  </p>
	  <p>&nbsp; </p>
	</div>
	<div>
	  <p>
	    <input name="submit" type="submit" value="CAMBIAR CONTRASE&Ntilde;A"/>
	  </p>
	  <p>&nbsp;</p>
	  </div>
</form> </td>
 </tr>
<tr></tr>
</table>


</body>
</html>


<?php

function validarUsuario($usuario,$password,$con)	{
$password=strtoupper(md5($password));
$query="select password_usr,perfil_usr from USUARIO where codigo_usr ='$usuario' and estado_usr ="."'ACTIVO'" ;
//echo $query;
$result = $con->Execute($query);
if ($result === false) die("failed");
if (!$result->EOF) {
    $auxrpass = $result->fields[0];
	$auxperfilusu = $result->fields[1];
	$auxrpass=strtoupper($auxrpass);

	  if( strcmp($auxrpass,$password) == 0 )   {
         return true;  }
      else
         return false;
   }  else
       return false;
}


function grabarContrasena($usuario,$password,$con)	{

$password=strtoupper(md5($password));
$query="update USUARIO set password_usr='$password' where codigo_usr ='$usuario'" ;
$result = $con->Execute($query);
if ($result === false) die("failed");
echo "<script>alert('El cambio de contraseña ha sido realizado con éxito!!');</script>";
return true;  
}

?>


