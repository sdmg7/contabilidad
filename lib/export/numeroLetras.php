<?php

function numeros($numero){

 $frase='';

 while ($numero>0){

         if($numero >= 1  and $numero <= 999){
                    $palabra='';
                    $operac=$numero;
                    $frase=letras($operac,$frase);
                    $numero=0;
         }

        if($numero >= 1000 and $numero <= 9999){
                    $palabra='MIL ';
                    $operac=(int)($numero/1000);
                    if($operac>1)
                     $frase=letras($operac,$frase);
                    $numero=$numero-$operac*1000;
               }

        if($numero >= 10000 and $numero <= 99999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;
               }
        if($numero >= 100000 and $numero <= 999999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;

               }
        if($numero >= 1000000 and $numero <= 9999999){

                     if ($numero>=1000000 and $numero<2000000){
                       $palabra='MILLON ';  }
                     else {
                     $palabra='MILLONES ';}
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 10000000 and $numero <= 99999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 100000000 and $numero <= 999999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }

  $frase=$frase.$palabra;
}
  return "$frase";
}

function numerosDecimal($numero){

 $frase='';
 $arr_num=split("[.]",$numero);
 $numero=$arr_num[0];
 while ($numero>0){

         if($numero >= 1  and $numero <= 999){
                    $palabra='';
                    $operac=$numero;
                    $frase=letras($operac,$frase);
                    $numero=0;
         }

        if($numero >= 1000 and $numero <= 9999){
                    $palabra='MIL ';
                    $operac=(int)($numero/1000);
                    if($operac>1)
                     $frase=letras($operac,$frase);
                    $numero=$numero-$operac*1000;
               }

        if($numero >= 10000 and $numero <= 99999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;
               }
        if($numero >= 100000 and $numero <= 999999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;

               }
        if($numero >= 1000000 and $numero <= 9999999){

                     if ($numero>=1000000 and $numero<2000000){
                       $palabra='MILLON ';  }
                     else {
                     $palabra='MILLONES ';}
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 10000000 and $numero <= 99999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 100000000 and $numero <= 999999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }

  $frase=$frase.$palabra;
}
  $operac=$arr_num[1];
  /*if($operac>0)
  	$decimales=" CON ".letras($operac,'')." CENT.";
  else
  	$decimales=" CON 0 CENT.";*/
	$decimales=" CON ".$arr_num[1]."/100";
  $frase.=$decimales;
  return "$frase";
}


function letras($operac,$frase){

 $aux_operac=$operac;

 while ($aux_operac>0) {

        if ($aux_operac==1){
          $pal='Un ';
          $aux_operac=$aux_operac-1;
          }

        if($aux_operac==2){
          $pal='Dos ';
          $aux_operac=$aux_operac-2 ;
          }

        if($aux_operac==3){
          $pal='Tres ';
          $aux_operac=$aux_operac-3;
          }

        if($aux_operac==4){
          $pal='Cuatro ';
          $aux_operac=$aux_operac-4;
          }

        if($aux_operac==5){
          $pal='Cinco ';
          $aux_operac=$aux_operac-5;
          }

       if($aux_operac==6){
          $pal='Seis ';
          $aux_operac=$aux_operac-6;
          }

       if($aux_operac==7){
          $pal='Siete ';
          $aux_operac=$aux_operac-7;
          }

        if($aux_operac==8){
          $pal='Ocho ' ;
          $aux_operac=$aux_operac-8;
          }

        if($aux_operac==9){
          $pal='Nueve ';
          $aux_operac=$aux_operac-9;
          }

        if($aux_operac==10){
          $pal='Diez ';
          $aux_operac=$aux_operac-10;
          }

        if($aux_operac==11){
          $pal='Once ';
          $aux_operac=$aux_operac-11 ;
          }

        if($aux_operac==12){
          $pal='Doce ';
          $aux_operac=$aux_operac-12;
          }

        if($aux_operac==13){
          $pal='Trece ';
          $aux_operac=$aux_operac-13;
          }

        if($aux_operac==14){
          $pal='Catorce ';
          $aux_operac=$aux_operac-14;
          }

        if($aux_operac==15){
          $pal='Quince ';
          $aux_operac=$aux_operac-15;
          }

        if($aux_operac==16){
          $pal='Dieciseis ';
          $aux_operac=$aux_operac-16 ;
          }
        if($aux_operac==17){
          $pal='Diecisiete ';
          $aux_operac=$aux_operac-17;
          }

        if($aux_operac==18){
          $pal='Dieciocho ';
          $aux_operac=$aux_operac-18 ;
          }

        if($aux_operac==19){
          $pal='Diecinueve ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac==20){
          $pal='Veinte ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac==30){
          $pal='Treinta ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac==40){
          $pal='Cuarenta ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac==50){
          $pal='Cincuenta ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac==60){
          $pal='Sesenta ';
          $aux_operac=$aux_operac-$aux_operac;
          }
        if($aux_operac==70){
          $pal='Setenta ';
          $aux_operac=$aux_operac-$aux_operac;
          }
        if($aux_operac==80){
          $pal='Ochenta ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac==90){
          $pal='Noventa ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac > 20 and $aux_operac <= 29){
          $pal='Veinte y ';
          $aux_operac=$aux_operac-20;
          }

        if($aux_operac> 30 and $aux_operac<= 39){
          $pal='Treinta y ';
          $aux_operac=$aux_operac-30;
         }

        if($aux_operac> 40 and $aux_operac<= 49){
          $pal='Cuarenta y ';
          $aux_operac=$aux_operac-40 ;
          }

        if($aux_operac> 50 and $aux_operac <= 59){
          $pal='Cincuenta y ';
          $aux_operac=$aux_operac-50;

          }

        if($aux_operac> 60 and $aux_operac<= 69){
          $pal='Sesenta y ' ;
          $aux_operac=$aux_operac-60;
          }

        if($aux_operac> 70 and $aux_operac<= 79){
          $pal='Setenta y ' ;
          $aux_operac=$aux_operac-70 ;
          }

        if($aux_operac> 80 and $aux_operac<= 89){
          $pal='Ochenta y ' ;
          $aux_operac=$aux_operac-80 ;
          }

        if($aux_operac> 90 and $aux_operac<= 99){
          $pal='Noventa y ' ;
          $aux_operac=$aux_operac-90 ;
          }

        if($aux_operac>= 100 and $aux_operac<= 199){
          if ($aux_operac==100){
              $pal='Cien '; }
          else {  $pal='Ciento '; }
          $aux_operac=$aux_operac-100;
          }

        if($aux_operac>= 200 and $aux_operac<= 299){
          $pal='Doscientos ';
          $aux_operac=$aux_operac-200;
          }

        if($aux_operac>= 300 and $aux_operac<= 399){
          $pal='Trescientos ';
          $aux_operac=$aux_operac-300 ;
          }

        if($aux_operac>= 400 and $aux_operac<= 499){
          $pal='Cuatrocientos ';
          $aux_operac=$aux_operac-400 ;
          }

        if($aux_operac>= 500 and $aux_operac<= 599){
          $pal='Quinientos ';
          $aux_operac=$aux_operac-500;
          }

        if($aux_operac>= 600 and $aux_operac<= 699){
          $pal='Seiscientos ';
          $aux_operac=$aux_operac-600;
          }

        if($aux_operac>= 700 and $aux_operac<= 799){
          $pal='Setecientos ';
          $aux_operac=$aux_operac-700 ;
          }

        if($aux_operac>= 800 and $aux_operac <= 899){
          $pal='Ochocientos ';
          $aux_operac=$aux_operac-800 ;
          }

        if($aux_operac>= 900 and $aux_operac <= 999){
          $pal='Novecientos ';
          $aux_operac=$aux_operac-900 ;
          }

   $frase=$frase.$pal;

    }

 $longitud=strlen($frase);
 $v=substr($frase,-2);

 if($v == 'Y '){
  $frase=substr($frase,0,$longitud-2);
 }

  return "$frase";

 }

 ?>