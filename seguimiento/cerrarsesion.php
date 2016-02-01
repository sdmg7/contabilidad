<script language="javascript" src= "../lib/tools/cookies.js" ></script>
<script>
// setCookie('serial_usr',usuario[0]);
               deleteCookie('nombre_usr','/selmhos/','www.informed.cc');
               deleteCookie('apellido_usr','/selmhos/','www.informed.cc');

               deleteCookie('nombre_pfl','/selmhos/','www.informed.cc');
               deleteCookie('serial_pfl','/selmhos/','www.informed.cc');
</script>



<?php 

session_start();
session_unset();
/*
setcookie('PHPSESSID', '', 1, '/');
setcookie ("apellido_usr", '', 1, '/');
setcookie ("nombre_pfl", '', 1, '/');
setcookie ("nombre_usr", '', 1, '/');
setcookie ("serial_pfl", '', 1, '/');
setcookie ("serial_usr", '', 1, '/');
setcookie ("usuario", '', 1, '/');
*/


/*setcookie ("apellido_usr", "",1);
setcookie ("nombre_pfl", "",1);
setcookie ("nombre_usr", "",1);
setcookie ("serial_pfl", "",1);
setcookie ("serial_usr", "",1);
setcookie ("usuario", "",1);*/

echo "<script>alert('MUCHAS GRACIAS, SESION CERRADA!!');</script>"; 
?>	  
<script>
window.location.href="../index.html";       
</script>		 