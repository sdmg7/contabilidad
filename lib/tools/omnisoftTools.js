var formularioGrabado=true;
var omnisoftAPROBACION='';
var omnisoftACCIONPROCESO={"INSERTAR_ACP":3, "EDITAR_ACP":4, "BUSCAR_ACP":5 ,"ELIMINAR_ACP":6 ,"ENVIOCORREO_ACP":7, "GRAFICAR_ACP":8 ,"IMPRIMIR_ACP":9, "AYUDA_ACP":10, "ACERCADE_ACP":11, "SALIR_ACP":12, "INICIO_ACP":13, "PRINCIPIO_ACP":14, "ANTERIOR_ACP":15, "SIGUIENTE_ACP":16 ,"ULTIMO_ACP":17, "ENVIOEXCEL_ACP":18, "ENVIOXML_ACP":19, "FILTRAR_ACP":20, "GUARDAR_ACP":21, "CANCELAR_ACP":22, "NAVEGAR_ACP":23, "APROBARDOCUMENTO_ACP":24, "APROBARCUPOPLAZO_ACP":25, "ANULAR_ACP":26, "REVERSARCOMPROBANTES_ACP":27, "CONSOLIDARCIERREPERIODO_ACP":28, "MAYORIZARPRESUPUESTO_ACP":29, "ABRIRPRESUPUESTO_ACP":30, "PRESUPUESTOANUAL_ACP":31, "PRESUPUESTOPERIODO_ACP":32, "CERRARPRESUPUESTO_ACP":33, "BAJAREXCEL_ACP":34, "SUBIREXCEL_ACP":35, "FICHAPERSONAL_ACP":36, "DEPOSITAR_ACP":37, "EFECTIVIZAR_ACP":38, "PROTESTAR_ACP":39, "DEPOSITOEFECTIVO_ACP":40, "ANULARDOCUMENTO_ACP":41, "CLIENTEMOROSO_ACP":42, "IMPRIMIRCOMPROBANTE_ACP":43, "IMPRIMIRCHEQUE_ACP":44, "ANULARCHEQUE_ACP":45};
var omnisoftFECHASERVIDOR='0000-00-00';
 function DetectBrowser()
  {
var browserClient='';

       var val = navigator.userAgent.toLowerCase();
       if(val.indexOf("firefox") > -1)    browserClient='FF';
       else if(val.indexOf("opera") > -1) browserClient='OP';
             else if(val.indexOf("msie") > -1)  browserClient='IE';
                   else if(val.indexOf("safari") > -1)  browserClient='SF';

   return browserClient;
 }


function dateAddDays(fecha,dias) {
var afecha=fecha.split('-');
var sfecha='';
var ofecha = new Date(afecha[0],afecha[1]-1,afecha[2]);
var rfecha = new Date(ofecha.getTime() + dias*24*60*60*1000);
//ofecha.setUTCDate(ofecha.getDate()+dias);

sfecha=rfecha.getYear()+"-"+(rfecha.getMonth()+1)+"-"+rfecha.getDate();
//alert(sfecha);
return sfecha;
}

function procesarNumeroFactura(){
  var numerofactura=document.PaginaDatos.numeroDocumento_facc.value
   var prefijo=numerofactura.substring(0,6);
   var postfijo=numerofactura.substring(6,15);
   var nceros=9-postfijo.length;
   for (var i=0; i<nceros;i++)
      postfijo='0'+postfijo;
   document.PaginaDatos.numeroDocumento_facc.value=prefijo+postfijo;
 }

function procesarNumeroNotaCredito(){

  var numerofactura=document.PaginaDatos.numerodocumento_ncp.value
   var prefijo=numerofactura.substring(0,6);
   var postfijo=numerofactura.substring(6,15);
   var nceros=9-postfijo.length;
   for (var i=0; i<nceros;i++)
      postfijo='0'+postfijo;
   document.PaginaDatos.numerodocumento_ncp.value=prefijo+postfijo;

}


 function validarNumeroFactura() {
   var spostfijo=document.PaginaDatos.numeroDocumento_facc.value.substring(6,15);
   var sprefijo1=document.PaginaDatos.numeroDocumento_facc.value.substring(0,3);
   var sprefijo2=document.PaginaDatos.numeroDocumento_facc.value.substring(3,6);

       postfijo=spostfijo.replace(/^0+/, '');
       sprefijo1=sprefijo1.replace(/^0+/, '');
       sprefijo2=sprefijo2.replace(/^0+/, '');

    if (document.PaginaDatos.numeroDocumento_facc.value.length==15 && parseInt(sprefijo1) >0 && parseInt(sprefijo2) >0  && parseInt(postfijo) >0)
	return true;

 	alert('Advertencia: El numero de factura debe contener el numero de serie (3 digitos) el codigo de actividad (3 digitos) y el numero de factura (9 digitos) por ejemplo 0010010003458');
	return false;
}



function addslashes( str ) {
    return (str+'').replace(/([\\"'])/g, "\\$1").replace(/\0/g, "\\0");
}

 function isArray(obj) {
    return obj.constructor == Array;
}

function omnisoftCloseWindow() {

   window.close();
}
function omnisoftHandleOnBlur() {
 //  alert('entro');
}

function omnisoftConfirmClose(e) {
  if (!e)   {
      e=window.event;

//   alert('clientY='+window.event.clientY+ 'clientX='+window.event.clientX+' clientWidth='+document.documentElement.clientWidth);
    if (e.clientY < 0 && (e.clientX > (document.documentElement.clientWidth - 25) || e.clientX < 25) && formularioGrabado==false)
event.returnValue = 'Si cierra la ventana, perdera las modificaciones realizadas, desea cerrarla realmente?';
  }
  else {

//    if (e.clientY < 0 && (e.clientX > (document.body.clientWidth - 25) || e.clientX < 25) && formularioGrabado==false)
if (e.x==undefined && formularioGrabado==false)
e.returnValue = 'Si cierra la ventana, perdera las modificaciones realizadas, desea cerrarla realmente?';


  }

//if (window && !window.closed && formularioGrabado==false && omnisoftPopUp==false ){
//event.returnValue = 'Si cierra la ventana, perdera las modificaciones realizadas, desea cerrarla realmente?';
//}

}


function omnisoftHandleOnClose() {
 if (formularioGrabado==true && window.opener && window.opener.omniObj)
     window.opener.omniObj.grid.refresh();
}



function cambiarURL(url) {
 window.frames['iframeDatos'].location.href=url;
}

function omnisoftTab(id,iframe) {

 var url=window.frames['iframeDatos'].location.href.split('/');
 var cambiar=true;

   if (iframe!=undefined && (url[url.length-1]==iframe ||url[url.length-1]==iframe+'#'))
      cambiar=checkForm(window.frames['iframeDatos'].document.PaginaDatos,true,'',false);
  // alert(window.frames['iframeDatos'].document.PaginaDatos.elements[1].value);
  if (getURLParamGET('action')=='insert')
     document.PaginaDatos.elements[1].value=window.frames['iframeDatos'].document.PaginaDatos.elements[1].value;
//    alert('omnisofttab='+document.PaginaDatos.elements[1].value);
  if (cambiar)  {
//     setTimeout('cambiarURL('+id+')',500);
  window.frames['iframeDatos'].location.href=id;
  }
}

function omnisoftTabProveedor(id) {
   var url=window.frames['iframeDatos'].location.href.split('/');
   if (url[url.length-1]=='iframeProveedorDatosGenerales.html' ||url[url.length-1]=='iframeProveedorDatosGenerales.html#')
      checkForm(window.frames['iframeDatos'].document.PaginaDatos,true,'',false);
  window.frames['iframeDatos'].location.href=id;
}





function omnisoftGrabar() {
   return checkForm(document.PaginaDatos);
}

function omnisoftGrabarComo() {
  	var gridName=(getURLParamGET('gridName')==undefined)|| getURLParamGET('gridName')==''?'top.opener.omniObj':'top.opener.'+getURLParamGET('gridName');
	var omniObjRes=eval(gridName);


omniObjRes.grid.action='insert';
checkForm(document.PaginaDatos,true,'',false,false);
}

function omnisoftGrabarEspecial() {

checkForm(document.PaginaDatos,true,'',true,false);
}

function omnisoftValidarFormulario() {
 return checkForm(document.PaginaDatos,false,'',false,false);
}


function omnisoftGrabarElaboracion() {
  var sqlCommand='';
  var serial_prc=getURLParamGET('serial_prc');
      serial_prc=serial_prc.split('#')[0];
       sqlCommand='insert into detalleaprobaciones (SERIAL_DAP, SERIAL_APR, SERIAL_USR, FECHA_DAP, HORA_DAP, CUPO_DAP, ESTADO_DAP, OBSERVACIONES_DAP, recibe_dap, documento_dap) select 0,serial_apr,'+getCookie('serial_usr')+",CURRENT_DATE,CURRENT_TIME,0,nombre_apr,'',0,masterkey from procesos,aprobacion where secuencia_apr=0 and procesos.serial_prc=aprobacion.serial_prc and aprobacion.serial_prc="+serial_prc;
//       prompt('test',sqlCommand);
   return checkForm(document.PaginaDatos,true,sqlCommand);
}

function omnisoftGrabarAprobacion(secuencia_apr,estado) {
  var sqlCommand='';
  var asecuencia=0;
  var serial_prc=getURLParamGET('serial_prc');
      serial_prc=serial_prc.split('#')[0];

     sqlCommand='insert into detalleaprobaciones (SERIAL_DAP, SERIAL_APR, SERIAL_USR, FECHA_DAP, HORA_DAP, CUPO_DAP, ESTADO_DAP, OBSERVACIONES_DAP, recibe_dap, documento_dap) select 0,serial_apr,'+getCookie('serial_usr')+",CURRENT_DATE,CURRENT_TIME,0,nombre_apr,'',0,masterkey from aprobacion where secuencia_apr="+secuencia_apr+" and nombre_apr='"+estado+"' and aprobar_prc="+serial_prc ;
//  prompt('test',sqlCommand);
   return checkForm(document.PaginaDatos,true,sqlCommand);
}

function omnisoftGrabarAprobacionEspecial(secuencia_apr,estado,aprobar_prc,documento_dap) {
  var sqlCommand='';
  var asecuencia=0;
     sqlCommand='insert into detalleaprobaciones (SERIAL_DAP, SERIAL_APR, SERIAL_USR, FECHA_DAP, HORA_DAP, CUPO_DAP, ESTADO_DAP, OBSERVACIONES_DAP, recibe_dap, documento_dap) select 0,serial_apr,'+getCookie('serial_usr')+",CURRENT_DATE,CURRENT_TIME,0,nombre_apr,'',0,"+documento_dap+" from aprobacion where secuencia_apr="+secuencia_apr+" and nombre_apr='"+estado+"' and aprobar_prc="+aprobar_prc ;
//checkForm(document.PaginaDatos,true,'',true,false);

   return checkForm(document.PaginaDatos,true,sqlCommand);
}


function omnisoftGrabarDocumento(tipo) {
  var sqlCommand='';
  var asecuencia=0;
      sqlCommand="update parametros,tipocomprobante,secuenciadocumentos set numero_sdo=numero_sdo+1 where serial_suc="+getCookie('serial_suc')+" and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_pag and parametros.codigo_pag='"+tipo+"'";
//  alert(sqlCommand);
   return checkForm(document.PaginaDatos,true,sqlCommand);
}


function omnisoftProcesarAprobacion(data){
  //alert(data);
  omnisoftAPROBACION=data.split('|');
  var reg=omnisoftAPROBACION[1].split('~');
  var n=1;
  document.getElementById('fotousuario1').src='../fotos/'+reg[2];
  document.getElementById('usuario1').innerHTML=reg[0]+' '+reg[1];
  document.getElementById('accion1').innerHTML=reg[5]+' '+reg[3]+' '+reg[4];

  document.getElementById('spanEstado').innerHTML=reg[6]+'-'+reg[5];
  n++;
  if (omnisoftAPROBACION[n]!=undefined && omnisoftAPROBACION[n].length>0) {
    reg=omnisoftAPROBACION[n].split('~');

  document.getElementById('fotousuario2').src='../fotos/'+reg[2];
  document.getElementById('usuario2').innerHTML=reg[0]+' '+reg[1];
  document.getElementById('accion2').innerHTML=reg[5]+' '+reg[3]+' '+reg[4];

  }
  n++;
//  alert(omnisoftAPROBACION[n].length);
  if (omnisoftAPROBACION[n]!=undefined && omnisoftAPROBACION[n].length>0) {
    reg=omnisoftAPROBACION[n].split('~');

  document.getElementById('fotousuario3').src='../fotos/'+reg[2];
  document.getElementById('usuario3').innerHTML=reg[0]+' '+reg[1];
  document.getElementById('accion3').innerHTML=reg[5]+' '+reg[3]+' '+reg[4];

  }


//  alert(omnisoftAPROBACION);

}


function omnisoftCargarAprobacion(numero,aprobar) {

 var sqlCommand='';
  if (getURLParam('action')=='insert' || numero==undefined)
     sqlCommand='select apellido_usr,nombre_usr,foto_usr,CURRENT_DATE,CURRENT_TIME,"PENDIENTE",0 from usuario where serial_usr='+getCookie('serial_usr');
  else if (aprobar==undefined)
     sqlCommand='select apellido_usr,nombre_usr,foto_usr,fecha_dap,hora_dap,estado_dap,secuencia_apr,observaciones_dap,recibe_dap from usuario,aprobacion,detalleaprobaciones where aprobacion.serial_apr=detalleaprobaciones.serial_apr and usuario.serial_usr=detalleaprobaciones.serial_usr and aprobacion.serial_prc='+getURLParamGET('serial_prc')+' and detalleaprobaciones.documento_dap= '+numero+'  order by secuencia_apr desc,fecha_dap desc,hora_dap desc';
     else
     sqlCommand='select apellido_usr,nombre_usr,foto_usr,fecha_dap,hora_dap,estado_dap,secuencia_apr,observaciones_dap,recibe_dap from usuario,aprobacion,detalleaprobaciones where aprobacion.serial_apr=detalleaprobaciones.serial_apr and usuario.serial_usr=detalleaprobaciones.serial_usr and aprobacion.aprobar_prc='+getURLParamGET('serial_prc')+' and detalleaprobaciones.documento_dap= '+numero+'  order by secuencia_apr desc,fecha_dap desc,hora_dap desc';
 // prompt('test',sqlCommand);
  var objDBComando=new omnisoftDB(sqlCommand,"../lib/server/omnisoftSQLData.php",'omnisoftProcesarAprobacion');
      objDBComando.executeQuery();

}



function omnisoftGrabarMultiple(sqlCommand) {
   return checkForm(document.PaginaDatos,true,sqlCommand);
}


function omnisoftPrintIndividual(sURL,mode) {
            var attributes='';
            var sWidth=1000;
            var sHeight=750;
                      sURL=sURL+'&mode='+mode;

		if (mode=='print' || mode=='quickprint')
      	           frames['iframePDF'].location.href=sURL;
                else {
                       if (window.screen) {
                          sWidth=window.screen.availWidth;
                          sHeight=window.screen.availHeight;
                      }
                      attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no');
			   omnisoftNewWindow=window.open(sURL,'PDF',attributes);

                     if (window.focus) {omnisoftNewWindow.focus()}
                }

}

function omnisoftPrintForm(objForm) {
  if (objForm.frames==undefined)
      objForm.print();
  else
      for (var i=0;i <objForm.frames.length;i++)
          omnisoftImprimir(objForm.frames[i]);

}

function omnisoftImprimir(formName) {
  window.print();
//  var objform=document.getElementById(formName);
//  objform.print();
//  omnisoftPrintForm(objform);

}

function omnisoftCancelar() {
  	var gridName=(getURLParamGET('gridName')==undefined)|| getURLParamGET('gridName')==''?'top.opener.omniObj':'top.opener.'+getURLParamGET('gridName');
	var omniObjRes=eval(gridName);

 if (formularioGrabado==true || ((formularioGrabado==false) && (confirm('Desea perder las modificaciones que realizó?')==true))) {
     omniObjRes.grid.refresh();
     window.close();
 }

}

function omnisoftProcesarCambios() {
   formularioGrabado=false;


}
function omnisoftImportarArchivo(archivo) {
  var result=0;
  var req = new AW.HTTP.Request;
      req.setURL("../lib/server/omnisoftImportFile.php");
      req.setRequestMethod("POST");
//      alert(archivo.value);
      req.setParameter("file",archivo.value);
      req.request();
      req.response=function(data) {
        var datos=data.split('|');
       if (datos[0]!='')
           alert(datos[0]);
       else       result=datos[1];
      }
    return result;
}


function omnisoftActualizarDatos(data) {
  alert('actualizar='+data);

}


function omnisoftExecuteUpdate(sqlCommand,objForm,closeF) {
//  prompt('test',sqlCommand);
  var result='0|';
  var req = new AW.HTTP.Request;
  var closeForm=(closeF==undefined)?true:closeF;
  	var gridName=(getURLParamGET('gridName')==undefined)|| getURLParamGET('gridName')==''?'top.opener.omniObj':'top.opener.'+getURLParamGET('gridName');
  	gridName=gridName.replace('#','');
	var omniObjRes=eval(gridName);


      req.setURL("../lib/server/omnisoftDataManager.php");
      req.setRequestMethod("POST");
      req.setParameter("query",sqlCommand);
      req.request();



      req.response=function(data) {
        var datos=data.split('|');
       if (datos[0]!='') {
           alert(datos[0]);
      result=datos[0]+'|'+datos[1];
       }
       else {
          if (parent){
              parent.document.PaginaDatos.elements[1].value=datos[1];
          }

      result=datos[0]+'|'+datos[1];
//      alert('test3='+objForm.elements[1].value);

      if (omniObjRes.grid.action=='insert') {
      //  alert('entro');
 //         if (closeForm)
      if (parent)
          objForm.elements[1].value=datos[1];
    //      if (!parent)
          omniObjRes.firstPage();



//          if (omniObj!=undefined )
  //            omniObj.grid.masterKeyValue= datos[1];
   //           alert(omniObj.grid.masterKeyValue);
      }
      else {  //          if (closeForm)

                   // alert(sqlCommand);
                    omniObjRes.processPage();
      //        var row=top.opener.omniObj.grid.selectedRow;
      //         opener.omniObj.grid.updateData(objForm,row);



      }
      formularioGrabado=true;
          if (closeForm)
             window.close();
       }

      }
  //    sleep(100);
    return result;
}


function validateComboBox(strValue)
{
  return (typeof strValue == 'string' && strValue != '' );

//  return (typeof strValue == 'string' && strValue != '' && isNaN(strValue));
}


function isDate(fld) {
 var fecha=fld.split('-');
 if (fecha.length!=3)
     return false;
     if (fld='0000-00-00')
         return true;
 var anio=(fecha[0]>=1900);
 var mes= (fecha[1]>=1 && fecha[1] <=12) ;
 var dia=(fecha[2]>=1 && fecha[2]<=31);
     if (mes && dia  && fecha[1]==2 && fecha[2]>29)
     dia=false;

     if (mes && dia  && (fecha[1]==4 ||fecha[1]==6 ||fecha[1]==9 ||fecha[1]==11) && fecha[2]>30)
     dia=false;


 return anio && mes && dia;
}


function isString(strValue)
{
  return (typeof strValue == 'string' && strValue != '' && isNaN(strValue));
}

function isText(strValue)
{
  return (  strValue != '' );
}

function isNumber(strValue)
{
  return (!isNaN(strValue) && strValue != '');
}

function isEmail(strValue)
{
  var objRE = /^[\w-\.\']{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]{2,}$/;

  return (strValue != '' && objRE.test(strValue));
}

function isHour(strValue)
{

  var objRE = /\d{1,2}:\d{1,2}:\d{1,2}/;
  return (strValue != '' && objRE.test(strValue));
}

function isIpAddress(strValue)
{

  var objRE = /\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/;
  return (strValue != '' && objRE.test(strValue));
}


function validarCedulaRUC() {

    if (!isCedulaRUC(this.value))
        this.focus();
}

function isCedulaRUC( numero ) {

var suma = 0;
var residuo = 0;
var pri = false;
var pub = false;
var nat = false;
var numeroProvincias = 24;
var modulo = 11;

/* Verifico que el campo no contenga letras */
var ok=1;
if (isNaN(numero)){
alert('El código de la provincia (dos primeros dígitos) es inválido'); return false;
}

/* Aqui almacenamos los digitos de la cedula en variables. */
d1 = numero.substr(0,1);
d2 = numero.substr(1,1);
d3 = numero.substr(2,1);
d4 = numero.substr(3,1);
d5 = numero.substr(4,1);
d6 = numero.substr(5,1);
d7 = numero.substr(6,1);
d8 = numero.substr(7,1);
d9 = numero.substr(8,1);
d10 = numero.substr(9,1);

/* El tercer digito es: */
/* 9 para sociedades privadas y extranjeros */
/* 6 para sociedades publicas */
/* menor que 6 (0,1,2,3,4,5) para personas naturales */

if (d3==7 || d3==8){
alert('El tercer dígito ingresado es inválido');
return false;
}

/* Solo para personas naturales (modulo 10) */
if (d3 < 6){
nat = true;
p1 = d1 * 2; if (p1 >= 10) p1 -= 9;
p2 = d2 * 1; if (p2 >= 10) p2 -= 9;
p3 = d3 * 2; if (p3 >= 10) p3 -= 9;
p4 = d4 * 1; if (p4 >= 10) p4 -= 9;
p5 = d5 * 2; if (p5 >= 10) p5 -= 9;
p6 = d6 * 1; if (p6 >= 10) p6 -= 9;
p7 = d7 * 2; if (p7 >= 10) p7 -= 9;
p8 = d8 * 1; if (p8 >= 10) p8 -= 9;
p9 = d9 * 2; if (p9 >= 10) p9 -= 9;
modulo = 10;
}

/* Solo para sociedades publicas (modulo 11) */
/* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
else if(d3 == 6){
pub = true;
p1 = d1 * 3;
p2 = d2 * 2;
p3 = d3 * 7;
p4 = d4 * 6;
p5 = d5 * 5;
p6 = d6 * 4;
p7 = d7 * 3;
p8 = d8 * 2;
p9 = 0;
}

/* Solo para entidades privadas (modulo 11) */
else if(d3 == 9) {
pri = true;
p1 = d1 * 4;
p2 = d2 * 3;
p3 = d3 * 2;
p4 = d4 * 7;
p5 = d5 * 6;
p6 = d6 * 5;
p7 = d7 * 4;
p8 = d8 * 3;
p9 = d9 * 2;
}

suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
residuo = suma % modulo;

/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
digitoVerificador = residuo==0 ? 0: modulo - residuo;

/* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
if (pub==true){
if (digitoVerificador != d9){
alert('El ruc de la empresa del sector público es incorrecto.');
return false;
}
/* El ruc de las empresas del sector publico terminan con 0001*/
if ( numero.substr(9,4) != '0001' ){
alert('El ruc de la empresa del sector público debe terminar con 0001');
return false;
}
}
else if(pri == true){
if (digitoVerificador != d10){
alert('El ruc de la empresa del sector privado es incorrecto.');
return false;
}
if ( numero.substr(10,3) != '001' ){
alert('El ruc de la empresa del sector privado debe terminar con 001');
return false;
}
}

else if(nat == true){
if (digitoVerificador != d10){
alert('El n\u00famero de c\u00e9dula de la persona natural es incorrecto.');
return false;
}
if (numero.length >10 && numero.substr(10,3) != '001' ){
alert('El ruc de la persona natural debe terminar con 001');
return false;
}
}
return true;
}





function fechaSistema(){

var hoy= new Date();

var mes=hoy.getMonth()+1;
var year= (hoy.getYear()<=1900) ? hoy.getYear()+1900:hoy.getYear();
var sfecha = year + '-' + ((mes<10)?'0'+mes:mes) + '-' + ((hoy.getDate()<10)?'0'+hoy.getDate():hoy.getDate());

return sfecha;

}

function formatCode(codigo,len) {
  for (var i=codigo.length; i < len; i++ ){
      codigo='0'+codigo;
  }
 return codigo;
}

function formatDouble(amount)
{
	var delimiter = ","; // replace comma if desired
	var a = amount.split('.',2);
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
}


function unformat(amount) {
  var mount=amount.split(',');
  var result='';
  for (i=0;i<mount.length;i++)
  result=result.concat(mount[i]);
  return result;
 }


function getURLParamGET(strParamName,iframe){
  var strReturn = "";
  var strHref =(iframe==undefined)? unescape(String(window.location.href)):unescape(String(parent.location.href));
  if ( strHref.indexOf("&") > -1 ){
    var strQueryString = strHref.substr(strHref.indexOf("&"));

    var aQueryString = strQueryString.split("&");
  //  alert(aQueryString);
    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
      if (aQueryString[iParam].indexOf(strParamName + "=") > -1 ){
        var aParam = aQueryString[iParam].split("=");
//        alert(strParamName+'='+aParam[1]);
        strReturn = aParam[1];

        break;
      }
    }
  }
  //alert(strReturn);
   return strReturn;
}



function getURLParam(strParamName,iframe){
if (strParamName=='action')
   return top.opener.omniObj.grid.action;
if (top.opener.omniObj!=undefined) {
var   indice= top.opener.omniObj.grid.getFieldByColumnName(strParamName);
                  if (indice!=-1 && top.opener.omniObj.grid.action!='insert')
                      return top.opener.omniObj.grid.getCellText(indice,top.opener.omniObj.grid.selectedRow);
}
else return getURLParamGET(strParamName,iframe);

}


function omnisoftProcesarAutoIncrement(data){
//alert(data);
var datos=data.split('|');
var fieldid='';
var code='';
if (datos[0]!='')
   alert('Error: No se puede asignar valor autogenerado al codigo!');
else {
      fieldid=datos[1].split('~')[0].toLowerCase();
      code=datos[1].split('~')[1];
          if (isNaN(parseInt(code)))
	  document.getElementById(fieldid).value=1;
	 else document.getElementById(fieldid).value=parseInt(code)+1;
      document.getElementById(fieldid).value=formatCode(document.getElementById(fieldid).value,document.getElementById(fieldid).maxLength);

//alert(datos);
}
}

function omnisoftProcesarSecuencia(data){
var datos=data.split('|');
var fieldid='';
var code='';
//alert(data);
if (datos[0]!='')
   alert('Error: No se puede asignar numero de la factura!');
else {
      fieldid=datos[1].split('~')[0].toLowerCase();
//      alert(fieldid);
      code=datos[1].split('~')[1];
          if (isNaN(parseInt(code)))
	  document.getElementById(fieldid).value=1;
	 else document.getElementById(fieldid).value=parseInt(code)+1;
      document.getElementById(fieldid).value=formatCode(document.getElementById(fieldid).value,document.getElementById(fieldid).maxLength);

//alert(datos);
}
}

function omnisoftProcesarSecuenciaDocumentos(data){
var datos=data.split('|');
var fieldid='';
var code='';
//alert(data);
if (datos[0]!='')
   alert('Error: No se puede asignar numero de documento!');
else {
      fieldid=datos[1].split('~')[0].toLowerCase();
//      alert(fieldid);
      code=datos[1].split('~')[1];
          if (isNaN(parseInt(code)))
	  document.getElementById(fieldid).value=1;
	 else document.getElementById(fieldid).value=code;

//alert(datos);
}
}



function omnisoftActualizarSerial(data) {
//alert(data);

}
function omnisoftProcesarSerial(data){
//alert(data);
var datos=data.split('|');
var fieldid='';
var code='';
//alert(data);
if (datos[0]!='')
   alert('Error: No se puede asignar numero de identificacion del alumno!');
else {
      fieldid=datos[1].split('~')[0].toLowerCase();
      code=datos[1].split('~')[1];
          if (isNaN(parseInt(code)))
	  document.getElementById(fieldid).value=1;
	 else document.getElementById(fieldid).value=code;

      document.getElementById(fieldid).value=formatCode(document.getElementById(fieldid).value,document.getElementById(fieldid).maxLength);

      var SQLCommand="update parametros set valor_par=valor_par+1 where codigo_par='"+document.getElementById(fieldid).getAttribute('prefix')+"'";
//     prompt('test',SQLCommand);
      var objDBComando=new omnisoftDB(SQLCommand,"../lib/server/omnisoftDataManager.php",'omnisoftActualizarSerial');
           objDBComando.executeQuery();

}
}



function omnisoftProcesarMatricula(data){
var datos=data.split('|');
var fieldid='';
var code='';

if (datos[0]!='')
   alert('Error: No se puede asignar el numero de matricula!');
else {
      fieldid=datos[1].split('~')[0];
      code=datos[1].split('~')[1];


      document.getElementById(fieldid).value=code;
}
}


function omnisoftLoadData(objForm,iframe) {
  	var gridName=(getURLParamGET('gridName')==undefined)|| getURLParamGET('gridName')==''?'top.opener.omniObj':'top.opener.'+getURLParamGET('gridName');
	var omniObjRes=eval(gridName);

   var action=omniObjRes.grid.action;
   var indice=0;
   var i=0;
        for ( i=0; i < objForm.length; i++) {
          if ((objForm.elements[i].className!='' && objForm.elements[i].type!='button') ||objForm.elements[i].readOnly ) {
            if (objForm.elements[i].onchange==null)
                objForm.elements[i].onchange=omnisoftProcesarCambios;


            if (action=='edit') {
                  indice= omniObjRes.grid.getFieldByColumnName(objForm.elements[i].name);
                  if (indice!=-1)
                      objForm.elements[i].value=omniObjRes.grid.getCellText(indice,omniObjRes.grid.selectedRow);
            }
//             alert(objForm.elements[i].name+'='+objForm.elements[i].value);
             switch(objForm.elements[i].className) {
              case 'string':
              case 'emptystring':
                            // objForm.elements[i].setAttribute('title','Por favor ingrese letras mayusculas (A..Z), letras minusculas (a..z) o numeros (0..9) luego de una letra');
                             MaskInput(objForm.elements[i], "E^");
                             break;
              case 'text':
              case 'emptytext':
                          //   objForm.elements[i].setAttribute('title','Por favor ingrese letras mayusculas (A..Z), letras minusculas (a..z) o numeros (0..9)');

                            break;
              case 'email':
              case 'emptyemail':
                             objForm.elements[i].setAttribute('title','Por favor ingrese un nombre seguido del caracter @ y un dominio registrado, por ejemplo: juan.perez@miinstitucion.com.ec');

                            break;
              case 'ipaddress':
              case 'emptyipaddress':
                             objForm.elements[i].setAttribute('title','Por favor ingrese una direccion ip con este formato: 192.168.1.1');

                            break;
              case 'password':
              case 'emptypassword':
                             objForm.elements[i].setAttribute('title','Por favor ingrese por lo menos 8 caracteres');

                            break;

              case 'cuenta':
              case 'cuenta':
                             objForm.elements[i].setAttribute('title','Por favor ingrese una cuenta contable separando cada nivel  por un "." ');

                            break;
              case 'combox':
                             objForm.elements[i].setAttribute('title','Por favor seleccione un item de la lista');

                            break;

              case 'integer':
              case 'emptyinteger':
                          //   objForm.elements[i].setAttribute('title','Por favor ingrese  unicamente numeros  (0..9)');
                            // MaskInput(objForm.elements[i], "9^");

                             break;
              case 'double':
              case 'emptydouble':
                           //  objForm.elements[i].setAttribute('title','Por favor ingrese unicamente numeros (0..9) enteros o decimales ej: 123.45');
                            // MaskInput(objForm.elements[i], "9^.-");
                             break;
              case 'ruc':
              case 'cedula':
              case 'emptycedula':
                              objForm.elements[i].setAttribute('title','Por favor ingrese una cedula o pasaporte validos');
                              objForm.elements[i].onblur=validarCedulaRUC;
                              break;

              case 'autoincrement':
                             objForm.elements[i].setAttribute('title','Por favor ingrese unicamente numeros (0..9)');
                          if (omniObjRes.grid.action=='insert' || objForm.elements[i].value=='') {

			  var SQLCommand='select "'+objForm.elements[i].id+'",max('+objForm.elements[i].getAttribute('fieldid')+') from '+objForm.elements[i].getAttribute('table');
			  if (objForm.elements[i].getAttribute('filter')!=null && objForm.elements[i].getAttribute('filter')!='')
			  SQLCommand+=' where '+objForm.elements[i].getAttribute('filter');
//			  prompt('test',SQLCommand);
			  var objDBComando=new omnisoftDB(SQLCommand,"../lib/server/omnisoftSQLData.php",'omnisoftProcesarAutoIncrement');
                              objDBComando.executeQuery();
                          }
                              break;

              case 'secuencia':
                             objForm.elements[i].setAttribute('title','Por favor ingrese unicamente numeros (0..9)');
                          if (omniObjRes.grid.action=='insert' || objForm.elements[i].value=='') {
                            var SQLCommand="select '"+objForm[i].id+"',numero_sdo from tipocomprobante,parametros,secuenciadocumentos where serial_suc="+getCookie('serial_suc')+" and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_par and parametros.codigo_par='"+objForm.elements[i].getAttribute('tipo')+"' and secuenciadocumentos.estado_sdo='ACTIVO'";
			 // prompt('test',SQLCommand);
                          var objDBComando=new omnisoftDB(SQLCommand,"../lib/server/omnisoftSQLData.php",'omnisoftProcesarSecuencia');
                              objDBComando.executeQuery();
                          }
                              break;

              case 'secuenciadocumento':
                             objForm.elements[i].setAttribute('title','Por favor ingrese unicamente numeros (0..9)');
                          if (omniObjRes.grid.action=='insert' || objForm.elements[i].value=='') {
                            var SQLCommand="select '"+objForm[i].id+"',concat(lpad(secuencialSucursal_sdo,3,'0'),lpad(secuencialActividad_sdo,3,'0'),lpad(numero_sdo+1,9,'0')) as numero from tipocomprobante,parametros,secuenciadocumentos where serial_suc="+getCookie('serial_suc')+" and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_par and parametros.codigo_par='"+objForm.elements[i].getAttribute('tipo')+"' and secuenciadocumentos.estado_sdo='ACTIVO'";
//			  prompt('test',SQLCommand);
                          var objDBComando=new omnisoftDB(SQLCommand,"../lib/server/omnisoftSQLData.php",'omnisoftProcesarSecuenciaDocumentos');
                              objDBComando.executeQuery();
                          }
                              break;


              case 'serial':
                             objForm.elements[i].setAttribute('title','Por favor ingrese unicamente numeros (0..9)');
                          if (omniObjRes.grid.action=='insert' || objForm.elements[i].value=='') {
                           var SQLCommand="select '"+objForm[i].id+"',(select valor_par from parametros where codigo_par='"+objForm.elements[i].getAttribute('prefix')+"') from "+objForm.elements[i].getAttribute('table') + ' limit 1,1';
			 // prompt('test',SQLCommand);
			  var objDBComando=new omnisoftDB(SQLCommand,"../lib/server/omnisoftSQLData.php",'omnisoftProcesarSerial');
                              objDBComando.executeQuery();
                          }
                              break;


              case 'date':
              case 'emptydate':
                            // objForm.elements[i].setAttribute('title','Por favor ingrese una fecha en el formato AAAA-MM-DD');
                            // MaskInput(objForm.elements[i], "9999-99-99");
                             Calendar.setup({
		inputField     :    objForm.elements[i].name,
		ifFormat       :    "%Y/%m/%d",
		showsTime      :    false,
		button         :    "f_trigger_b",
		singleClick    :    false,
		step           :    1    });

                             break;
              case 'hour':
              case 'emptyhour':

                             objForm.elements[i].setAttribute('title','Por favor ingrese una hora en el formato HH:MM:SS');
                            // MaskInput(objForm.elements[i], "99:99:99");
                             break;
              case 'dyncombo':
                             objForm.elements[i].setAttribute('title','Por favor ingrese letras mayusculas (A..Z), letras minusculas (a..z) o numeros (0..9) luego de una letra');
                             if (typeof(event)=='undefined')
                               objForm.elements[i].onkeyup = function(event){ajax_showOptions(this,'getCountriesByLetters',event);};
                             else
                               objForm.elements[i].onkeyup = function(){ajax_showOptions(this,'getCountriesByLetters',event);};



                               break;

              case 'autosuggest':
              case 'emptyautosuggest':
                             objForm.elements[i].setAttribute('title','Por favor ingrese letras mayusculas (A..Z), letras minusculas (a..z) o numeros (0..9) luego de una letra');
                                var fieldname=(objForm.elements[i].getAttribute('fieldname')!=null)?objForm.elements[i].getAttribute('fieldname'):objForm.elements[i].name;
                                var fieldid=(objForm.elements[i].getAttribute('fieldid')!=null)?objForm.elements[i].getAttribute('fieldid'):objForm.elements[i].getAttribute('serial');
                                var filter=(objForm.elements[i].getAttribute('filter')!=null)?objForm.elements[i].getAttribute('filter'):'';
                                var table=objForm.elements[i].getAttribute('table');
                                var fieldinfo=objForm.elements[i].getAttribute('info');
                                var fieldext=objForm.elements[i].getAttribute('fieldext');


                            	var autosuggestoptions = {

		                             script:"../lib/server/omnisoftAutosuggest.php?json=true&table="+table+"&fieldname="+fieldname+"&fieldid="+fieldid+"&fieldinfo="+fieldinfo+"&filter="+filter+"&",
		                             varname:'input',
		                             json:true,
		                             shownoresults:true,
		                             timeout:360000,
		                             serial:objForm.elements[i].getAttribute('serial'),
		                             fieldinfo:objForm.elements[i].getAttribute('info'),
									 fieldext:objForm.elements[i].getAttribute('fieldext'),

                                             funcion:(objForm.elements[i].getAttribute('funcion')!=null)?objForm.elements[i].getAttribute('funcion'):'',

		                             callback: function (obj) {

                                                                        document.getElementById(this.serial).value = obj.id;
                                                                        if (document.getElementById(this.fieldinfo)!=undefined && document.getElementById(this.fieldext)==undefined)
                                                                           document.getElementById(this.fieldinfo).value=obj.info;
                                                                        else
                                                                        if (document.getElementById(this.fieldext)!=undefined )
                                                                           document.getElementById(this.fieldext).value=obj.info;


                                                                           if (this.funcion!='')  {

                                                                               var comando=this.funcion+"("+obj.id+")";
                                                                                   eval(comando);
                                                                           }

                                                                      }
	                        };
	                        var as_json = new bsn.OmnisoftAutoSuggest(objForm.elements[i].name, autosuggestoptions);

                             break;
                             }
             }
          }

enterAsTab();
autoTab();
}









function omnisoftDataProcess(objForm,sqlCommandMultiple,closeForm,uppercase) {
	var SQLCommand='';
	var SQLAction='';
  	var gridName=(getURLParamGET('gridName')==undefined)|| getURLParamGET('gridName')==''?'top.opener.omniObj':'top.opener.'+getURLParamGET('gridName');
	gridName=gridName.replace('#','');

	var omniObjRes=eval(gridName);
	var table=omniObjRes.grid.table;
	var row=omniObjRes.grid.selectedRow;
	var resultData='';
	table=table.replace('#',' ');
	var i=0;
	var nitems=objForm.length-1;
	var valor='';


	if (omniObjRes.grid.action=="insert") {
        SQLAction='insert into ';
 		SQLAction=SQLAction.concat(table,' (');

                if (document.getElementById('searchFilter'))
                   nitems-=2;

                if (document.getElementById('query'))
                   nitems-=5;

                for (i=2; i < nitems ; i++) {
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].className!='dyncombo' && objForm.elements[i].className!='emptyautosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].name,',');
               }
		if (objForm.elements[i].type=='password' && objForm.elements[i].className!='' )
			SQLAction=SQLAction.concat(objForm.elements[i].name,") values (");
		else if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].className!='dyncombo'  &&  objForm.elements[i].className!='emptyautosuggest' && objForm.elements[i].name!='')
			SQLAction=SQLAction.concat(objForm.elements[i].name,") values ('");
		else SQLAction=SQLAction.concat(") values ('");

		for (i=2; i < nitems; i++) {
                           valor=addslashes(objForm.elements[i].value);
			if (objForm.elements[i].type=='password' && objForm.elements[i].className!='')
				SQLAction=SQLAction.concat("md5('",valor,"'),'");
			else if ((objForm.elements[i].className!='' ) &&  objForm.elements[i+1].type!='password' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].className!='dyncombo'  && objForm.elements[i].className!='emptyautosuggest' && objForm.elements[i].name!='') {
				SQLAction=SQLAction.concat(valor,"','");

                      }
			else if (objForm.elements[i+1].type=='password' && objForm.elements[i].className!='')
				SQLAction=SQLAction.concat(valor,"',");
		}
                           valor=addslashes(objForm.elements[i].value);

		if (objForm.elements[i].type=='password' && objForm.elements[i].className!='')
			SQLAction=SQLAction.concat('substring(md5(',valor,"'),1,10),'");
		else
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].className!='dyncombo' && objForm.elements[i].className!='emptyautosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(valor,"')");

                 if (sqlCommandMultiple!=undefined && sqlCommandMultiple!='')
                    SQLAction=SQLAction+'|'+sqlCommandMultiple;
                if (uppercase==undefined || uppercase==true)
                SQLAction=SQLAction.toUpperCase();
                //alert(SQLAction);

                resultData=omnisoftExecuteUpdate(SQLAction,objForm,closeForm);
//                setTimeout('opener.omniObj.lastPage()',500);

        }
  	else {
		var  key=omniObjRes.grid.key;
		var valor='';
                if (document.getElementById('searchFilter'))
                   nitems-=2;
                if (document.getElementById('query'))
                   nitems-=5;
		SQLAction='update ';
		SQLAction=SQLAction.concat(table,' set ');
		for (i=2; i < nitems; i++) {
                   valor=addslashes(objForm.elements[i].value);

			if (objForm.elements[i].type=='password' && objForm.elements[i].className!='')
				SQLAction=SQLAction.concat(objForm.elements[i].name,"=md5('",valor,"'),");
			else

				if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].className!='dyncombo' && objForm.elements[i].className!='emptyautosuggest' && objForm.elements[i].name!='')
					SQLAction=SQLAction.concat(objForm.elements[i].name,"= '",valor,"',");

		}
                valor=addslashes(objForm.elements[i].value);

		if (objForm.elements[i].type=='password' && objForm.elements[i].className!='')
			SQLAction=SQLAction.concat(objForm.elements[i].name,"=md5('",valor,"') where ",key,"=",objForm.elements[1].value);
		else
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].className!='dyncombo'  && objForm.elements[i].className!='emptyautosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].name,"= '",valor,"' where ",key,"=",objForm.elements[1].value);
			else
				SQLAction=SQLAction.concat(objForm.elements[i].name,"= '",valor,"' where ",key,"=",objForm.elements[1].value);


                if (sqlCommandMultiple!=undefined && sqlCommandMultiple!='')
                    SQLAction=SQLAction+'|'+objForm.elements[1].value+'|'+sqlCommandMultiple;

                if (uppercase==undefined || uppercase==true)
                SQLAction=SQLAction.toUpperCase();
                //alert(SQLAction);


                resultData=omnisoftExecuteUpdate(SQLAction,objForm,closeForm);


      //            if (resultData.split('|')[0]=='0') {

//                   opener.omniObj.grid.updateData(objForm,row);

//                }




	}
        return (resultData!='0|') ? false:true;
       // return resultData;

}


function omnisoftGeneraPassword()
{
var num;
var contador;
var conNumero;
var password;
var passCod;

password='';
passCod='';
contador=0;
conNumero=0;
while (contador<1)
{
	num=Math.round(Math.random()*1000);
	if (((num>=65) && (num<=90)) || ((num>=97) && (num<=122)))
	{
		if (num!=108 && num!=73)
		{
			contador++;
			password=password+String.fromCharCode(num);
			passCod=passCod+num+'-';
		}
		if (num<100)
		{
			contador++;
			//password=password+String.fromCharCode(num);
			password=password+num
			//passCod=passCod+num+'-';
		}
	}

}
while (contador<7)
{
	if ((contador==7) && (conNumero<1))
	{
		num=Math.round(Math.random()*1000);
		if (((num>=48) && (num<=57)))
		{
			contador++;
			conNumero++;
			password=password+String.fromCharCode(num);
			passCod=passCod+num+'-';
		}
	}
	else if ((contador<7) && (conNumero<1))
	{
		num=Math.round(Math.random()*1000);
		if (((num>=48) && (num<=57)))
		{
			contador++;
			conNumero++;
			//password=password+String.fromCharCode(num);
			password=password+num
			passCod=passCod+num+'-';

		}
		if (((num>=65) && (num<=90)) || ((num>=97) && (num<=122)))
		{
			if (num!=108 && num!=73)
			{
				contador++;
				password=password+String.fromCharCode(num);
				passCod=passCod+num+'-';
			}
		}
	}
	else if ((contador<7) && (conNumero==1))
	{
		num=Math.round(Math.random()*1000);
		if (((num>=65) && (num<=90)) || ((num>=97) && (num<=122)))
		{
			if (num!=108 && num!=73)
			{
				contador++;
				password=password+String.fromCharCode(num);
				passCod=passCod+num+'-';
			}
		}
	}

}
return password;
}

function omnisoftPerfilUsuarioFormulario()  {
  if (opener==undefined || opener.omniObj==undefined)
      return;

    if (document.getElementById('divFormSave')!=undefined)
      document.getElementById('divFormSave').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.GUARDAR_ACP]=='SI')?'visible':'hidden';

    if (document.getElementById('divFormSaveAs')!=undefined)
      document.getElementById('divFormSaveAs').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.GUARDAR_ACP]=='SI')?'visible':'hidden';

      if (document.getElementById('divFormTotal')!=undefined)
      document.getElementById('divFormTotal').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.GUARDAR_ACP]=='SI')?'visible':'hidden';

    if (document.getElementById('divFormPrint')!=undefined)
      document.getElementById('divFormPrint').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.IMPRIMIRCOMPROBANTE_ACP]=='SI')?'visible':'hidden';

      if (document.getElementById('divFormPrintPreview')!=undefined)
      document.getElementById('divFormPrintPreview').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.IMPRIMIRCOMPROBANTE_ACP]=='SI')?'visible':'hidden';

          if (document.getElementById('divFormPrintDirect')!=undefined)
      document.getElementById('divFormPrintDirect').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.IMPRIMIRCOMPROBANTE_ACP]=='SI')?'visible':'hidden';

          if (document.getElementById('divFormQuickPrint')!=undefined)
      document.getElementById('divFormQuickPrint').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.IMPRIMIRCOMPROBANTE_ACP]=='SI')?'visible':'hidden';

    if (document.getElementById('divFormHelp')!=undefined)
      document.getElementById('divFormHelp').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.AYUDA_ACP]=='SI')?'visible':'hidden';

    if (document.getElementById('divFormCancel')!=undefined)
      document.getElementById('divFormCancel').style.visibility=(opener.omniObj.actions[omnisoftACCIONPROCESO.CANCELAR_ACP]=='SI')?'visible':'hidden';

}
function omnisoftRecuperarFechaServidor(data) {
 var datos=data.split('|');
 if (datos[0]=='')
    omnisoftFECHASERVIDOR=datos[1];
 else
 document.getElementById(datos[0].toLowerCase()).value=datos[1];
}


function fechaServidor(campo) {
 var objDBComando;
 if (campo != undefined)
  objDBComando=new omnisoftDB(campo,"../lib/server/omnisoftFechaServidor.php",'omnisoftRecuperarFechaServidor');
 else
  objDBComando=new omnisoftDB('',"../lib/server/omnisoftFechaServidor.php",'omnisoftRecuperarFechaServidor');

     objDBComando.executeQuery();

}

function omnisoftProcesarSoloLectura(objForm) {
  var objFieldInput  = objForm.getElementsByTagName('input');
  var objFieldSelect = objForm.getElementsByTagName('select');

     for (var i=0; i<objFieldInput.length; i++)
       objFieldInput[i].disabled=true;

     for (var i=0; i<objFieldSelect.length; i++)
        objFieldSelect[i].disabled=true;


}


window.onbeforeunload=omnisoftConfirmClose;

window.onunload=omnisoftHandleOnClose;




//window.onblur=omnisoftHandleOnBlur;