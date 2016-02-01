<?php

//$MESES=Array("01"=>"ENERO","02"=>"FEBRERO","03"=>"MARZO","04"=>"ABRIL","05"=>"MAYO","06"=>"JUNIO","07"=>"JULIO","08"=>"AGOSTO","09"=>"SEPTIEMBRE","10"=>"OCTUBRE","11"=>"NOVIEMBRE","12"=>"DICIEMBRE");
$MESES=Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

function fechaCadena($fecha) {
  global $MESES;
  $sfecha=explode('-',$fecha);
 $anio=$sfecha[0];

 $meses=intVal($sfecha[1]);
 $mes=$MESES[$meses];
 $dia=numeros($sfecha[2]);
 $resultado=$dia .' de '.$mes.' del '.$anio;
 return $resultado;
}

function calcularEquivalencia($dblink,$nota,$serial_sec) {
   $sql="select nombre_equ from equivalencias where serial_sec=".$serial_sec." and rangoinicial_equ<=".$nota." and rangofinal_equ>=".$nota;
//   echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? 'NO ESPECIFICADA':$rs->fields[0];


}

function calcularDescripcionEquivalencia($dblink,$nota,$serial_sec) {
   $sql="select descripcion_equ from equivalencias where serial_sec=".$serial_sec." and rangoinicial_equ<=".$nota." and rangofinal_equ>=".$nota;
//   echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? 'NO ESPECIFICADA':$rs->fields[0];


}


function calcularAbreviaturaEquivalencia($dblink,$nota,$serial_sec) {
   $sql="select abreviatura_equ from equivalencias where serial_sec=".$serial_sec." and rangoinicial_equ<=".$nota." and rangofinal_equ>=".$nota." and tipo_equ='RENDIMIENTO'";
   //echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[0];

}

function calcularAbreviaturaEquivalenciaConducta($dblink,$nota,$serial_sec) {
   $sql="select abreviatura_equ from equivalencias where serial_sec=".$serial_sec." and rangoinicial_equ<=".$nota." and rangofinal_equ>=".$nota." and tipo_equ='COMPORTAMIENTO'";
   //echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[0];

}

function calcularEquivalenciaConducta($dblink,$nota,$serial_sec) {
   $sql="select nombre_equ from equivalencias where serial_sec=".$serial_sec." and rangoinicial_equ<=".$nota." and rangofinal_equ>=".$nota." and tipo_equ='COMPORTAMIENTO'";
   //echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[0];

}

function leerConsejoDirectivo($dblink,$serial_per,$serial_sec,$cargo) {
   $sql="select apellido_epl,nombre_epl from periodo,consejodirectivo,empleado where periodo.serial_per=consejodirectivo.serial_per and empleado.serial_epl=consejodirectivo.serial_epl and consejodirectivo.serial_sec=".$serial_sec. " and consejodirectivo.serial_per=".$serial_per. " and cargo_cdi='".$cargo."'";
//   echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[1].' '.$rs->fields[0];

}

function leerDirigente($dblink,$serial_per,$serial_par) {
   $sql="select apellido_epl,nombre_epl from periodo,paralelo,profesor,empleado where periodo.serial_per=paralelo.serial_per and empleado.serial_epl=profesor.serial_epl and profesor.serial_pro=paralelo.dirigente_par and paralelo.serial_par=".$serial_par. " and paralelo.serial_per=".$serial_per;
//   echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[1].' '.$rs->fields[0];

}

function leerObservacionParaleloAlumno($dblink,$serial_per,$serial_par,$serial_alu) {
   $sql="select observacion_paralu from paralelo_alumno where paralelo_alumno.serial_par=".$serial_par. " and paralelo_alumno.serial_per=".$serial_per. " and paralelo_alumno.serial_alu=".$serial_alu;
//   echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[1].' '.$rs->fields[0];

}

function leerObservacionAlumno($dblink,$serial_alu) {
   $sql="select observacion_alu from alumno where serial_alu=".$serial_alu;
//   echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[1].' '.$rs->fields[0];

}
function leerObservacionParalelo($dblink,$serial_par) {
   $sql="select observaciones_par from paralelo where serial_par=".$serial_par;
//   echo $sql;
    $rs=$dblink->Execute($sql);
    return (!$rs || $rs->RecordCount()<=0) ? '':$rs->fields[1].' '.$rs->fields[0];

}


function SI($condicion,$verdadero,$falso){
return($condicion?$verdadero:$falso);
}

function REDONDEAR($numero,$decimales=0){
return(round($numero,$decimales));
}
function PONDERACION_EXAMEN() {
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc,$gconsolidada;
     $sqlCmd="select materia_nivel.serial_matniv,ponderacion_matniv from materia_nivel,materia_profesor where materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_nivel.serial_mat=".$gserial_mat." and  materia_profesor.serial_matpro=".$gserial_matpro;
//     echo $sqlCmd."<br>";

     $rsPonderacion=$gdblink->Execute($sqlCmd);

     if (!$rsPonderacion || $rsPonderacion->RecordCount()<=0)
        return 0;

        return $rsPonderacion->fields['ponderacion_matniv'];



}


function CONDUCTA_INSPECTOR() {
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc,$gconsolidada;
     $sqlCmd="select serial_pfac,nota_pfac from trimestre,parcial,materia,alumno,paralelo_alumno,materia_nivel,materia_alumno,materia_profesor,nota_trimestre,nota_parcial,parcial_fac where trimestre.serial_tri=nota_trimestre.serial_tri and paralelo_alumno.serial_per=".$gserial_per." and paralelo_alumno.serial_alu=alumno.serial_alu and  materia.serial_mat=materia_nivel.serial_mat and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_fac.serial_nprc=nota_parcial.serial_nprc   and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu   and materia_alumno.serial_alu=".$gserial_alu." and (codigo_mat LIKE 'COND%') and  nota_parcial.serial_prc=parcial.serial_prc and  nota_pfac>0 and parcial.serial_prc=".$gserial_prc;
//     echo $sqlCmd."<br>";

     $rsNotaConducta=$gdblink->Execute($sqlCmd);

     if (!$rsNotaConducta || $rsNotaConducta->RecordCount()<=0)
        return 0;

        return $rsNotaConducta->fields['nota_pfac'];



}

function CONDUCTA_PROFESORES() {
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc,$gconsolidada;
     $sqlCmd="select serial_pfac,sum(nota_pfac) as nota_pfac,count(materia.serial_mat) as nmateria from trimestre,parcial,materia,alumno,paralelo_alumno,materia_nivel,materia_alumno,materia_profesor,nota_trimestre,nota_parcial,parcial_fac where promediaconducta_mat='SI' and trimestre.serial_tri=nota_trimestre.serial_tri and paralelo_alumno.serial_per=".$gserial_per." and paralelo_alumno.serial_alu=alumno.serial_alu and  materia.serial_mat=materia_nivel.serial_mat and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_fac.serial_nprc=nota_parcial.serial_nprc   and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu   and materia_alumno.serial_alu=".$gserial_alu." and (codigo_mat NOT LIKE 'COND%') and  nota_parcial.serial_prc=parcial.serial_prc and  parcial.tipo_prc='DIGITADO' and  nota_pfac>0 and parcial.serial_prc=".$gserial_prc." group by paralelo_alumno.serial_paralu";
//     echo $sqlCmd."<br>";
     $rsNotaConducta=$gdblink->Execute($sqlCmd);

     if (!$rsNotaConducta || $rsNotaConducta->RecordCount()<=0)
        return 0;

     if ($rsNotaConducta->fields['nmateria']>0) {
       $resultado=$rsNotaConducta->fields['nota_pfac']/$rsNotaConducta->fields['nmateria'];
//       echo $resultado;
        return  $resultado;
     }

    return 0;


}


function DISCIPLINA_INSPECTOR() {
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc;
     $sqlCmd="select serial_pfac,disciplina_pfac from trimestre,parcial,materia,alumno,paralelo_alumno,materia_nivel,materia_alumno,materia_profesor,nota_trimestre,nota_parcial,parcial_fac where trimestre.serial_tri=nota_trimestre.serial_tri and paralelo_alumno.serial_per=".$gserial_per." and paralelo_alumno.serial_alu=alumno.serial_alu and  materia.serial_mat=materia_nivel.serial_mat and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_fac.serial_nprc=nota_parcial.serial_nprc   and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu   and materia_alumno.serial_alu=".$gserial_alu." and (codigo_mat LIKE 'COND%') and  nota_parcial.serial_prc=parcial.serial_prc and  disciplina_pfac>0 and parcial.serial_prc=".$gserial_prc;
  //   echo $sqlCmd."<br>";
     $rsNotaConducta=$gdblink->Execute($sqlCmd);

     if (!$rsNotaConducta || $rsNotaConducta->RecordCount()<=0)
        return 0;

        return $rsNotaConducta->fields['disciplina_pfac'];



}

function DISCIPLINA_PROFESORES() {
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc;
     $sqlCmd="select serial_pfac,sum(disciplina_pfac) as disciplina_pfac,count(materia.serial_mat) as nmateria from trimestre,parcial,materia,alumno,paralelo_alumno,materia_nivel,materia_alumno,materia_profesor,nota_trimestre,nota_parcial,parcial_fac where trimestre.serial_tri=nota_trimestre.serial_tri and paralelo_alumno.serial_per=".$gserial_per." and paralelo_alumno.serial_alu=alumno.serial_alu and  materia.serial_mat=materia_nivel.serial_mat and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_fac.serial_nprc=nota_parcial.serial_nprc   and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu   and materia_alumno.serial_alu=".$gserial_alu." and (codigo_mat NOT LIKE 'COND%') and  nota_parcial.serial_prc=parcial.serial_prc and  parcial.tipo_prc='DIGITADO' and  disciplina_pfac>0 and parcial.serial_prc=".$gserial_prc." group by paralelo_alumno.serial_paralu";
    // echo $sqlCmd."<br>";
     $rsNotaConducta=$gdblink->Execute($sqlCmd);


     if (!$rsNotaConducta || $rsNotaConducta->RecordCount()<=0)
        return 0;
     if ($rsNotaConducta->fields['nmateria']>0) {
        $resultado=$rsNotaConducta->fields['disciplina_pfac']/$rsNotaConducta->fields['nmateria'];
     //   echo $resultado."<br>";;
        return $resultado;
     }
    return 0;


}

function PRESENTACION_INSPECTOR() {
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc;
     $sqlCmd="select serial_pfac,presentacionpersonal_pfac from trimestre,parcial,materia,alumno,paralelo_alumno,materia_nivel,materia_alumno,materia_profesor,nota_trimestre,nota_parcial,parcial_fac where trimestre.serial_tri=nota_trimestre.serial_tri and paralelo_alumno.serial_per=".$gserial_per." and paralelo_alumno.serial_alu=alumno.serial_alu and  materia.serial_mat=materia_nivel.serial_mat and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_fac.serial_nprc=nota_parcial.serial_nprc   and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu   and materia_alumno.serial_alu=".$gserial_alu." and (codigo_mat LIKE 'COND%') and  nota_parcial.serial_prc=parcial.serial_prc and  nota_pfac>0 and parcial.serial_prc=".$gserial_prc;
     $rsNotaConducta=$gdblink->Execute($sqlCmd);

     if (!$rsNotaConducta || $rsNotaConducta->RecordCount()<=0)
        return 0;

        return $rsNotaConducta->fields['presentacionpersonal_pfac'];



}

function PRESENTACION_PROFESORES() {
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc;
     $sqlCmd="select serial_pfac,sum(presentacionpersonal_pfac) as disciplina_pfac,count(materia.serial_mat) as nmateria from trimestre,parcial,materia,alumno,paralelo_alumno,materia_nivel,materia_alumno,materia_profesor,nota_trimestre,nota_parcial,parcial_fac where trimestre.serial_tri=nota_trimestre.serial_tri and paralelo_alumno.serial_per=".$gserial_per." and paralelo_alumno.serial_alu=alumno.serial_alu and  materia.serial_mat=materia_nivel.serial_mat and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_fac.serial_nprc=nota_parcial.serial_nprc   and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu   and materia_alumno.serial_alu=".$gserial_alu." and (codigo_mat NOT LIKE 'COND%') and  nota_parcial.serial_prc=parcial.serial_prc and  parcial.tipo_prc='DIGITADO' and  presentacionpersonal_pfac>0 and parcial.serial_prc=".$gserial_prc." group by paralelo_alumno.serial_paralu";
     $rsNotaConducta=$gdblink->Execute($sqlCmd);

     if (!$rsNotaConducta || $rsNotaConducta->RecordCount()<=0)
        return 0;

     if ($rsNotaConducta->fields['nmateria']>0)
        return $rsNotaConducta->fields['presentacionpersonal_pfac']/$rsNotaConducta->fields['nmateria'];

    return 0;


}



function construirFormula($pformula,$serial_per,$dblink,$serial_sec) {
    $formula=strtoupper($pformula);

    $sql="select codigo_prc from seccion,trimestre,parcial where seccion.serial_sec=trimestre.serial_sec and parcial.serial_tri=trimestre.serial_tri and tipo_prc<>'DIGITADO' and serial_per=".$serial_per.' and trimestre.serial_sec='.$serial_sec.' order by orden_prc';
    //echo "Formula general=".$formula."=>".$sql."<br>";
    $rsParcial=$dblink->Execute($sql);

    while (!$rsParcial->EOF ) {
           $codigo_prc=$rsParcial->fields[0];
   //        echo "codigo_prc=".$codigo_prc."<br>";
    	   if (stristr($formula,$codigo_prc)!=FALSE) {
               $sql="select formula_prc from seccion,trimestre,parcial where seccion.serial_sec=trimestre.serial_sec and parcial.serial_tri=trimestre.serial_tri and activo_prc='SI' and codigo_prc='".$codigo_prc."' and serial_per=".$serial_per;

               $rsParcialFormula=$dblink->Execute($sql);
               $formula_prc="(".$rsParcialFormula->fields[0].")";
//                echo "sql=".$sql." codigo_prc=".$codigo_prc."formula_prc=".$formula_prc."<br>";

//               echo "formula=".$formula."<br>";
               $formula=str_replace($codigo_prc,$formula_prc,$formula);
//               echo "formula=".$formula."<br>";
          }
    $rsParcial->MoveNext();
    }

  return $formula;

}

function evaluarFormula($serial_alu,$serial_mat,$serial_matpro,$paformula,$serial_per,$serial_sec,$dblink,$pformulaconducta="",$codigo_mat="",$consolidada=""){
    global $gdblink,$gserial_alu,$gserial_mat,$gserial_matpro,$gserial_per,$gserial_sec,$gserial_prc;


  $gserial_alu=$serial_alu;
  $gserial_mat=$serial_mat;
  $gserial_matpro=$serial_matpro;
  $gserial_per=$serial_per;
  $gserial_sec=$serial_sec;
  $gdblink=$dblink;
  $gconsolidada=$consolidada;
$sql1='select codigo_prc from seccion,trimestre,parcial where seccion.serial_sec=trimestre.serial_sec and  parcial.serial_tri=trimestre.serial_tri and serial_per='.$serial_per.' and trimestre.serial_sec='.$serial_sec.' order by orden_prc';
$rsParcialAux=$dblink->Execute($sql1);
//echo "sql=".$sql1 .' <br>';

 $pformula=(substr($codigo_mat,0,4)=='COND' && $pformulaconducta!='')?$pformulaconducta:$paformula;

           if ($pformula=='')
             return 0;

         if (is_numeric($pformula))
               return $pformula;


        $formula=construirFormula($pformula,$serial_per,$dblink,$serial_sec);
       // echo "formula=".$formula."<br>";

    	while (!$rsParcialAux->EOF ) {

            $codigo_prc=$rsParcialAux->fields[0];

//		echo "Codigo=".$rsParcialAux->fields[0]."formula=$formula<br>";
			if (stristr($formula,$codigo_prc)!=FALSE) {

			$sql='select serial_prccri,nota_prccri,criterio.serial_cri from seccion,nivel,trimestre,parcial,criterio,alumno,materia_alumno,materia_nivel,materia_profesor,nota_trimestre,nota_parcial,parcial_criterio where seccion.serial_sec=trimestre.serial_sec and trimestre.serial_sec=nivel.serial_sec and nivel.serial_niv=materia_nivel.serial_niv and criterio.serial_matniv=materia_profesor.serial_matniv and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_criterio.serial_nprc=nota_parcial.serial_nprc and  nota_parcial.serial_prc=parcial.serial_prc and parcial_criterio.serial_cri=criterio.serial_cri and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu and materia_alumno.serial_matpro='.$serial_matpro.' and nota_trimestre.serial_tri=trimestre.serial_tri and trimestre.serial_tri= parcial.serial_tri and alumno.serial_alu='.$serial_alu.' and nota_parcial.serial_prc=parcial.serial_prc  and materia_nivel.serial_mat='.$serial_mat. " and parcial.codigo_prc='".$codigo_prc."' order by nota_prccri desc";
	//		echo $sql."<br>";
		     $rsNotaParcial=$dblink->Execute($sql);

			 if ($rsNotaParcial && $rsNotaParcial->RecordCount()>0) {
                $formula=str_replace($codigo_prc,$rsNotaParcial->fields[1],$formula);
				//echo $formula ."<br>";
			 }
			 else  {
                $formula=str_replace($codigo_prc,"0",$formula);
			//	return 0;

			 }
			 }
             $rsParcialAux->MoveNext();

    }
	 //echo $formula.'<br>';
	 $resultado=eval("return $formula;");
//	 $resultado=round($resultado,0);
//	 echo $resultado."<br>";
	return $resultado;
}


function evaluarNotasTerminales($serial_alu,$global_mat,$serial_prc,$dblink){



//			$sql='select sum(nota_prccri*ponderacion_mat) as nota,sum(ponderacion_mat) as ponderacion from seccion,nivel,trimestre,parcial,criterio,materia,alumno,materia_alumno,materia_nivel,materia_profesor,nota_trimestre,nota_parcial,parcial_criterio where seccion.serial_sec=trimestre.serial_sec and trimestre.serial_sec=nivel.serial_sec and nivel.serial_niv=materia_nivel.serial_niv and criterio.serial_matniv=materia_profesor.serial_matniv and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_alumno.serial_matpro=materia_profesor.serial_matpro and parcial_criterio.serial_nprc=nota_parcial.serial_nprc and  nota_parcial.serial_prc=parcial.serial_prc and parcial_criterio.serial_cri=criterio.serial_cri and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu and materia_profesor.serial_matniv=materia_nivel.serial_matniv and nota_trimestre.serial_tri=trimestre.serial_tri and trimestre.serial_tri= parcial.serial_tri and alumno.serial_alu='.$serial_alu.' and nota_parcial.serial_prc=parcial.serial_prc  and materia_nivel.serial_mat=materia.serial_mat and tipo_mat="TERMINAL"  and materia.global_mat='.$global_mat. " and parcial.serial_prc='".$serial_prc."' and nota_prccri>0";
			$sql='select sum(round(nota_prccri+0.0000001,2)*ponderacion_mat) as nota,sum(ponderacion_mat) as ponderacion from seccion,nivel,trimestre,parcial,criterio,materia,alumno,materia_alumno,materia_nivel,materia_profesor,nota_trimestre,nota_parcial,parcial_criterio where seccion.serial_sec=trimestre.serial_sec and trimestre.serial_sec=nivel.serial_sec and nivel.serial_niv=materia_nivel.serial_niv and criterio.serial_matniv=materia_profesor.serial_matniv and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_alumno.serial_matpro=materia_profesor.serial_matpro and parcial_criterio.serial_nprc=nota_parcial.serial_nprc and  nota_parcial.serial_prc=parcial.serial_prc and parcial_criterio.serial_cri=criterio.serial_cri and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu and materia_profesor.serial_matniv=materia_nivel.serial_matniv and nota_trimestre.serial_tri=trimestre.serial_tri and trimestre.serial_tri= parcial.serial_tri and alumno.serial_alu='.$serial_alu.' and nota_parcial.serial_prc=parcial.serial_prc  and materia_nivel.serial_mat=materia.serial_mat and tipo_mat="TERMINAL"  and materia.global_mat='.$global_mat. " and parcial.serial_prc='".$serial_prc."' and nota_prccri>0"; //san felipe
	//		echo $sql."<br>";
  		        $rsNotaParcial=$dblink->Execute($sql);

	 $resultado=($rsNotaParcial->fields[1]<1)?0:round($rsNotaParcial->fields[0]+0.0000001,2);  //san felipe
//	 $resultado=($rsNotaParcial->fields[1]<1)?0:($rsNotaParcial->fields[0]);

	// echo $resultado."<br>";
	return $resultado;
}

function esMateriaConsolidada($serial_mat) {
global $dblink;

 $sqlCommand="select serial_mat from materia where tipo_mat='TERMINAL' and  global_mat=".$serial_mat;
// echo $sqlCommand."<br>";
 $rsMat=$dblink->Execute($sqlCommand);

 $resultado=(!$rsMat || $rsMat->RecordCount() <=0)? false:true;
 return $resultado;


}

function actualizarNotas($serial_prccri,$nota) {
  global $dblink;
 $sqlCommand="update parcial_criterio set nota_prccri=".$nota." where serial_prccri=".$serial_prccri ;
 //echo $sqlCommand."<br>";
 $dblink->Execute($sqlCommand);

}


function omnisoftVerificarNotasParciales($serial_per,$serial_pro,$serial_matpro,$serial_tri,$serial_prc,$serial_alu) {

  global $dblink;

   $actualizacion=false;


   $SQLCmd="select serial_matniv,serial_par from materia_profesor where serial_matpro=".$serial_matpro;
   //echo $SQLCmd. "<br>";;
   $rsMateriaProfesor=$dblink->Execute($SQLCmd);

   if (!$rsMateriaProfesor || $rsMateriaProfesor->RecordCount()<=0) {
    echo "Error No existe la materia para el profesor seleccionado!|0";
    return false;
   }

   $serial_matniv=$rsMateriaProfesor->fields[0];
   $serial_par=$rsMateriaProfesor->fields[1];

         $SQLVerifica="select serial_matalu from materia_alumno where serial_alu=".$serial_alu." and serial_matpro=".$serial_matpro;
        //echo $SQLVerifica. "<br>";

         $rsVerMateriaAlumno=$dblink->Execute($SQLVerifica);
         if (!$rsVerMateriaAlumno || $rsVerMateriaAlumno->RecordCount()<=0) {
             $SQLInsert="insert into materia_alumno (serial_matalu, serial_alu, serial_matpro, total_matalu, nmin_matalu, aproba_matalu, disc_matalu, supletorio_matalu, nfinal_matalu, examenGrado_matalu, finjust_matalu, fjust_matalu, atraso_matalu) values (0,".$rsParaleloAlumno->fields[0].",".$serial_matpro.",0,0,'NO',0,0,0,0,0,0,0)";
              //echo $SQLCmdInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
     $SQLCmd="select serial_matalu from materia_alumno where serial_matpro=".$serial_matpro. " and serial_alu=".$serial_alu;
     //echo $SQLCmd. "<br>";;

     $rsMateriaAlumno=$dblink->Execute($SQLCmd);
    // while (!$rsMateriaAlumno->EOF) {
         $SQLVerifica="select serial_ntri from materia_alumno,nota_trimestre where nota_trimestre.serial_matalu=materia_alumno.serial_matalu and materia_alumno.serial_matalu=".$rsMateriaAlumno->fields[0]." and serial_tri=".$serial_tri;
        //echo $SQLVerifica. "<br>";

         $rsVerNotaTrimestre=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaTrimestre || $rsVerNotaTrimestre->RecordCount()<=0) {
             $SQLInsert="insert into nota_trimestre (serial_ntri, serial_matalu, serial_tri, nota_ntri, base_ntri, porcentaje_ntri, observacion_ntri, disc_ntri, ptrabajado_ntri, pasistido_ntri, finjust_ntri, fjust_ntri, atraso_ntri) values (0,".$rsMateriaAlumno->fields[0].",".$serial_tri.",0,0,0,'',0,0,0,0,0,0)";
              //echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
    //  $rsMateriaAlumno->MoveNext();
    // }


     $SQLCmd="select serial_ntri,serial_prc from parcial,materia_alumno,nota_trimestre where nota_trimestre.serial_matalu=materia_alumno.serial_matalu and serial_matpro=".$serial_matpro." and nota_trimestre.serial_tri=parcial.serial_tri and parcial.serial_prc=".$serial_prc." and materia_alumno.serial_alu=".$serial_alu;
      //echo $SQLCmd. "<br>";;

     $rsNotaTrimestre=$dblink->Execute($SQLCmd);
     while (!$rsNotaTrimestre->EOF) {
         $SQLVerifica="select serial_nprc from nota_parcial where serial_prc=".$serial_prc." and serial_ntri=".$rsNotaTrimestre->fields[0];
       // echo $SQLVerifica. "<br>";

         $rsVerNotaTrimestre=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaTrimestre || $rsVerNotaTrimestre->RecordCount()<=0) {
             $SQLInsert="insert into nota_parcial (serial_nprc, serial_ntri, serial_prc, nota_nprc, base_nprc, porcentaje_nprc, observacion_nprc, disc_nprc, aclase_nprc, disciplinaInspector_nprc, disciplinaFinal_nprc, finjust_nprc, fjust_nprc, atraso_nprc) values (0,".$rsNotaTrimestre->fields[0].",".$serial_prc.",0,0,0,'',0,0,0,0,0,0,0)";
              //echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsNotaTrimestre->MoveNext();
     }


     $SQLCmd="select serial_nprc,serial_cri from criterio,materia_alumno,materia_profesor,nota_trimestre,nota_parcial where criterio.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and materia_alumno.serial_matpro=".$serial_matpro." and nota_trimestre.serial_tri=".$serial_tri." and materia_alumno.serial_alu=".$serial_alu;
      //echo $SQLCmd. "<br>";;

     $rsNotaParcial=$dblink->Execute($SQLCmd);
     while (!$rsNotaParcial->EOF) {
         $SQLVerifica="select serial_prccri from parcial_criterio where serial_nprc=".$rsNotaParcial->fields[0]." and serial_cri=".$rsNotaParcial->fields[1];
        //echo $SQLVerifica. "<br>";

         $rsVerNotaParcial=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaParcial || $rsVerNotaParcial->RecordCount()<=0) {
             $SQLInsert="insert into parcial_criterio (serial_prccri, serial_nprc, serial_cri, numero_prccri, nota_prccri, base_prccri, nprueba_prccri) values (0,".$rsNotaParcial->fields[0].",".$rsNotaParcial->fields[1].",0,0,0,0)";
//              echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsNotaParcial->MoveNext();
     }


   // echo $serial_per."|";
}

function omnisoftLeerParametro($dblink,$parametro){

 $sqlCommand="select valor_par from parametros where codigo_par='".$parametro."'";
// echo $sqlCommand."<br>";
 $rs=$dblink->Execute($sqlCommand);
 if ($rs->EOF || $rs->RecordCount()<=0)
     $valor="";
 else $valor=$rs->fields[0];

 return $valor;
}


function omnisoftCalcularCosto($dblink,$serial_ieb) {

$SQL="select serial_ieb,fecha_ieb,serial_odc from ingresoegresodebodega where serial_ieb=".$serial_ieb;
//echo $SQL."<br>";

$rsIngresoBodega=$dblink->Execute($SQL);

if (!$rsIngresoBodega->EOF) {

 $SQL="select serial_prd,serial_dodc from detalleordendecompra where cantidadrecibidaunidades_dodc>0 and serial_odc=".$rsIngresoBodega->fields['serial_odc'];
//echo $SQL."<br>";

 $rsDetalleOrdenCompra=$dblink->Execute($SQL);

while (!$rsDetalleOrdenCompra->EOF) {

// $SQL="select sum(costo_dodc*cantidadrecibidaunidades_dodc) as costo,if(cantidadrecibidaunidades_dodc is NULL,0,sum(cantidadrecibidaunidades_dodc )) from tipoingresoegresodebodega,ingresoegresodebodega,detalleordendecompra where detalleordendecompra.serial_odc=ingresoegresodebodega.serial_odc and year(ingresoegresodebodega.fecha_ieb)=year('".$rsIngresoBodega->fields['fecha_ieb']."') and ingresoegresodebodega.fecha_ieb<='".$rsIngresoBodega->fields['fecha_ieb']."' and detalleordendecompra.serial_prd=". $rsDetalleOrdenCompra->fields['serial_prd']." and cantidadrecibidaunidades_dodc>0 order by ingresoegresodebodega.fecha_ieb";
 $SQL="select sum(cantidadrecibidaunidades_dodc * unidadesembalaje_prd * costo_dodc ) AS costo,if(cantidadrecibidaunidades_dodc is NULL,0,sum(cantidadrecibidaunidades_dodc )) from bodega,tipoingresoegresobodega,producto, ingresoegresodebodega,detalleordendecompra where tipoingresoegresobodega.serial_tib<>16 and tipoingresoegresobodega.serial_tib<>17 and tipoingresoegresobodega.serial_tib<>15 and   bodega.serial_bod=ingresoegresodebodega.bodegadestino_ieb and tipoingresoegresobodega.serial_tib=ingresoegresodebodega.serial_tib and ingresoegresodebodega.serial_odc = detalleordendecompra.serial_odc and producto.serial_prd = detalleordendecompra.serial_prd  and cantidadrecibidaunidades_dodc>0 and tipoingresoegresobodega.tipo_tib='INGRESO' and producto.serial_prd=".$rsDetalleOrdenCompra->fields['serial_prd']." and year(ingresoegresodebodega.fecha_ieb)=year('".$rsIngresoBodega->fields['fecha_ieb']."') and ingresoegresodebodega.fecha_ieb<='".$rsIngresoBodega->fields['fecha_ieb']."'";

// echo $SQL."<br>";

 $rsCosto=$dblink->Execute($SQL);

 $SQL="select sum(precio_dieb*cantidadrecibidaentregada_dieb) as costo, sum(cantidadrecibidaentregada_dieb) from ingresoegresodebodega,detalleingresoegresodebodega where  detalleingresoegresodebodega.serial_ieb=ingresoegresodebodega.serial_ieb  and ingresoegresodebodega.serial_tib=15 and detalleingresoegresodebodega.serial_prd=". $rsDetalleOrdenCompra->fields['serial_prd']." and year('".$rsIngresoBodega->fields['fecha_ieb']."')=year('fecha_ieb')";
// echo $SQL."<br>";

 $rsCostoInicial=$dblink->Execute($SQL);
 if (!$rsCostoInicial  || $rsCostoInicial->RecordCount()<=0) {
 $cantidadtotal=0;
 $costototal=0;
}
else {
  $cantidadtotal=$rsCostoInicial->fields[1];
 $costototal=$rsCostoInicial->fields[0];
}

 $SQLCommand="select sum(precio_dieb*cantidadrecibidaentregada_dieb) as costo,sum(cantidadrecibidaentregada_dieb) as cantidad   from bodega,tipoingresoegresobodega,producto,ingresoegresodebodega,detalleingresoegresodebodega where   bodega.serial_bod=ingresoegresodebodega.bodegaorigen_ieb and tipoingresoegresobodega.serial_tib=ingresoegresodebodega.serial_tib and ingresoegresodebodega.serial_ieb=detalleingresoegresodebodega.serial_ieb and  producto.serial_prd=detalleingresoegresodebodega.serial_prd and tipoingresoegresobodega.serial_tib='16' and producto.serial_prd=".$rsDetalleOrdenCompra->fields['serial_prd']."  and year(fecha_ieb) =year('".$rsIngresoBodega->fields['fecha_ieb']."') and  fecha_ieb<='".$rsIngresoBodega->fields['fecha_ieb']."'";
  //    echo $SQLCommand."<br>";
      $rsAjustesIngreso=$printOBJ->dblink->Execute($SQLCommand );

  if (!((!$rsAjustesIngreso || $rsAjustesIngreso->RecordCount()<=0) || $rsAjustesIngreso->fields[1]==0))   {

      $costototal+=$rsAjustesIngreso->fields[0];
      $cantidadtotal+=$rsAjustesIngreso->fields[1] ;

 }


 if (!((!$rsCosto || $rsCosto->RecordCount()<=0) || $rsCosto->fields[1]==0))   {

      $costototal+=$rsCosto->fields[0];
      $cantidadtotal+=$rsCosto->fields[1] ;

 }

 if ($cantidadtotal>0)
 $costopromedio=round($costototal/$cantidadtotal,4);
 else
 $costopromedio=0;

// echo "cantidadtotal=".$cantidadtotal." costototal=".$costototal."<br>";
 $SQLCmd="update producto set costopromedio_prd=".$costopromedio.",fechacosteo_prd='".$rsIngresoBodega->fields['fecha_ieb']."' where serial_prd=".$rsDetalleOrdenCompra->fields['serial_prd'];
// echo $SQLCmd."<br>";
  $dblink->Execute($SQLCmd);

 $rsDetalleOrdenCompra->MoveNext();
}
}
}

function omnisoftCalcularStock($dblink,$serial_prd,$fecha) {
//   $SQL="select if(cantidadrecibidaunidades_dodc is NULL,0,sum(cantidadrecibidaunidades_dodc )) from ingresoegresodebodega,detalleordendecompra where detalleordendecompra.serial_odc=ingresoegresodebodega.serial_odc and year(ingresoegresodebodega.fecha_ieb)=year('".$rsIngresoBodega->fields['fecha_ieb']."') and ingresoegresodebodega.fecha_ieb<='".$fecha."' and detalleordendecompra.serial_prd=". $serial_prd." and cantidadrecibidaunidades_dodc>0 order by ingresoegresodebodega.fecha_ieb";
   $SQL="select if(cantidadrecibidaunidades_dodc is NULL,0,sum(cantidadrecibidaunidades_dodc )) as cantidad from bodega,tipoingresoegresobodega,producto, ingresoegresodebodega,detalleordendecompra where tipoingresoegresobodega.serial_tib<>16 and tipoingresoegresobodega.serial_tib<>17 and tipoingresoegresobodega.serial_tib<>15 and   bodega.serial_bod=ingresoegresodebodega.bodegadestino_ieb and tipoingresoegresobodega.serial_tib=ingresoegresodebodega.serial_tib and ingresoegresodebodega.serial_odc = detalleordendecompra.serial_odc and producto.serial_prd = detalleordendecompra.serial_prd  and cantidadrecibidaunidades_dodc>0 and tipoingresoegresobodega.tipo_tib='INGRESO' and producto.serial_prd=".$serial_prd." and year(ingresoegresodebodega.fecha_ieb)=year('".$fecha."') and ingresoegresodebodega.fecha_ieb<='".$fecha."'";
  // echo $SQL."<br>";
 $rsCompras=$dblink->Execute($SQL);

 $SQL="select sum(cantidadrecibidaentregada_dieb) as cantidad from ingresoegresodebodega,detalleingresoegresodebodega where  detalleingresoegresodebodega.serial_ieb=ingresoegresodebodega.serial_ieb  and ingresoegresodebodega.serial_tib=15 and detalleingresoegresodebodega.serial_prd=". $serial_prd." and year(fecha_ieb)=year('".$fecha."')";
 //echo $SQL."<br>";
 $rsStockInicial=$dblink->Execute($SQL);

 if (isset($ACADEMIUM) && $ACADEMIUM==true) {

      $SQLCommand="select  sum(cantidad_dfa) as cantidad from producto, cabecerafactura,detallefactura where producto.serial_prd = detallefactura.serial_prd and detallefactura.serial_caf=cabecerafactura.serial_caf and estado_caf<>'ANULADA' and  producto.serial_prd=".$serial_prd." and cantidad_dfa>0  and (cabecerafactura.serial_paralu<>0 or cabecerafactura.serial_epl is NOT NULL) and tipo_caf<>'PENSIONES' and year(fecha_caf) >=year('".$fecha."') and  fecha_caf<='".$fecha."' ";

  //   echo $SQLCommand."<br>";

      $rsVentas=$printOBJ->dblink->Execute($SQLCommand );
       }

      $SQLCommand="select sum(cantidadrecibidaentregada_dieb) as cantidad  from bodega,tipoingresoegresobodega,producto,ingresoegresodebodega,detalleingresoegresodebodega where  bodega.serial_bod=ingresoegresodebodega.bodegaorigen_ieb and tipoingresoegresobodega.serial_tib=ingresoegresodebodega.serial_tib and ingresoegresodebodega.serial_ieb=detalleingresoegresodebodega.serial_ieb and  producto.serial_prd=detalleingresoegresodebodega.serial_prd and tipoingresoegresobodega.serial_tib='17' and producto.serial_prd=".$serial_prd."  and year(fecha_ieb) =year('".$fecha."') and  fecha_ieb<='".$fecha."'";
      //echo $SQLCommand."<br>";
      $rsAjustesEgreso=$printOBJ->dblink->Execute($SQLCommand );


      $SQLCommand="select sum(cantidadrecibidaentregada_dieb) as cantidad  from bodega,tipoingresoegresobodega,producto,ingresoegresodebodega,detalleingresoegresodebodega where   bodega.serial_bod=ingresoegresodebodega.bodegaorigen_ieb and tipoingresoegresobodega.serial_tib=ingresoegresodebodega.serial_tib and ingresoegresodebodega.serial_ieb=detalleingresoegresodebodega.serial_ieb and  producto.serial_prd=detalleingresoegresodebodega.serial_prd and tipoingresoegresobodega.serial_tib='16' and producto.serial_prd=".$serial_prd."  and year(fecha_ieb) =year('".$fecha."') and  fecha_ieb<='".$fecha."'";
  //    echo $SQLCommand."<br>";
      $rsAjustesIngreso=$printOBJ->dblink->Execute($SQLCommand );


      $SQLCommand="select  sum(cantidadentregada_dsd) as cantidad from bodega,tipoingresoegresobodega,producto, ingresoegresodebodega,solicituddotacion,detallesolicituddotacion where  bodega.serial_bod=ingresoegresodebodega.bodegadestino_ieb and tipoingresoegresobodega.serial_tib=ingresoegresodebodega.serial_tib and ingresoegresodebodega.serial_sdo=solicituddotacion.serial_sdo and solicituddotacion.serial_sdo=detallesolicituddotacion.serial_sdo and producto.serial_prd=detallesolicituddotacion.serial_prd and cantidadentregada_dsd>0 and producto.serial_prd=".$serial_prd." and year(fecha_sdo) ='".$fecha."' and  fecha_sdo<='".$fecha."'" ;

     // echo $SQLCommand."<br>";
      $rsProveeduria=$printOBJ->dblink->Execute($SQLCommand );


        $stockinicial+=(!$rsStockInicial || $rsStockInicial->RecordCount()<=0)?0: $rsStockInicial->fields[0];

        $cantidadComprada=(!$rsCompras || $rsCompras->RecordCount()<=0)?0: $rsCompras->fields['cantidad'];

        $cantidadVendida=(!$rsVentas || $rsVentas->RecordCount()<=0)?0: $rsVentas->fields['cantidad'];

        $cantidadProveeduria=(!$rsProveeduria || $rsProveeduria->RecordCount()<=0)?0: $rsProveeduria->fields['cantidad'];

        $cantidadComprada+=(!$rsAjustesIngreso || $rsAjustesIngreso->RecordCount()<=0)?0: $rsAjustesIngreso->fields['cantidad'];

        $cantidadVendida+=(!$rsAjustesEgreso || $rsAjustesEgreso->RecordCount()<=0)?0: $rsAjustesEgreso->fields['cantidad'];

        $stockactual= $stockinicial+$cantidadComprada-$cantidadProveeduria-$cantidadVendida;

 return $stockactual;
}


?>