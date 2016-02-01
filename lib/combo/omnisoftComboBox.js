
//------------------------------------------------------------------------------------------------------------------------
//  OCL Omnnisoft Component Library
//  PROYECTO: Librerias para el mantenimiento de base de datos
//  DESARROLLADO POR:  Soluciones Integrales OMNISOFT Cia. Ltda.
//  AUTOR:  Marco Hernan Jarrin Lopez
//  EMAIL:  marco@omnisoft.cc
//  WEBSITE:  http://www.omnisoft.cc
//  VERSION:  2.1
//------------------------------------------------------------------------------------------------------------------------
//  T�TULO: omnisoftGrid.js
//  DESCRIPCI�N: Archivo que contiene la clase omnisoftGrid para la gestion de base de datos
//  FECHA DE CREACI�N: 18-Diciembre-2007
//  MODIFICACIONES:
//           FECHA       AUTOR               DESCRIPCI�N
//  1) ------------- -------------  -------------------------


omnisoftComboBox=function(aObjName,alistName,aSQLCommand,sWidth,aCheck,aValue,aAll,aOnChange) {
 this.ObjName=aObjName;
 this.SQLCommand=aSQLCommand;
 this.listName=alistName;
 this.width=sWidth;
 this.check=(aCheck==undefined)?true:aCheck;
 this.digitos=10; //cantidad de digitos buscados
 this.puntero=0;
 this.buffer=new Array(this.digitos); //declaraci�n del array Buffer
 this.cadena="";
 this.seleccion=(aAll==undefined)?'':aAll;
 this.onchange=(aOnChange==undefined)?'':aOnChange;
 this.value=(aValue==undefined)?'':aValue;
 this.objDBComando=new omnisoftDB(this.SQLCommand,"../lib/server/omnisoftSQLData.php",this.ObjName+'.comboBoxData');

 this.create=function() {
    with (document) {
      if (this.check)
   write('<select class="combobox" name="'+this.listName+'" STYLE="width: '+this.width+'" id="'+this.listName+'"  onKeypress='+this.ObjName+'.search(this) onblur='+this.ObjName+'.empty() >');
   else
   write('<select  name="'+this.listName+'" STYLE="width: '+this.width+'" id="'+this.listName+'"  onKeypress='+this.ObjName+'.search(this) onblur='+this.ObjName+'.empty()  >');
   write(' </select>');
   }
 }
 this.show=function() {
     this.create();
     eval(this.ObjName+'.objDBComando.executeQuery()');

 }

 this.comboBoxData=function(strOptions) {
  var lst = document.getElementById(this.listName);
   var aOptionPairs = strOptions.split('|');
   var j=1;
   var k1=0;
   var i=0;
     lst.options.length = 0;
      if (this.seleccion!='') {
      lst.options[0] = new Option(this.seleccion, this.seleccion);
      j++;
      }
  for(  i = j; i < aOptionPairs.length; i++ )  {
      k=(j>1)? i-1: i;

    if (aOptionPairs[k].indexOf('~') != -1) {
      var aOptions = aOptionPairs[k].split('~');
      lst.options[i-1] = new Option(aOptions[1], aOptions[0]);
      if ( aOptions[0].split('�')[0]==this.value)
         lst.options.selectedIndex=i-1;

    }
  }
    if (this.onchange!='') {
        lst.onchange=this.onchange;
      //  lst.onclick=this.onchange;

        setTimeout(lst.onchange,0);
    }

 }

 this.search=function(obj) {
//   var letra = String.fromCharCode(event.keyCode);
////////////////////
	var code;
	if (!e) var e = window.event;
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var letra = String.fromCharCode(code);
////////////////////

   if(this.puntero >= this.digitos){
       this.cadena="";
       this.puntero=0;
    }
   //si se presiona la tecla ENTER, borro el array de teclas presionadas y salto a otro objeto...
   if (event.keyCode == 13)
       this.empty();

   //sino busco la cadena tipeada dentro del combo...
   else{
       this.buffer[this.puntero]=letra;
  	//guardo en la posicion puntero la letra tipeada
       this.cadena=this.cadena+this.buffer[this.puntero]; //armo una cadena con los datos que van ingresando al array
       this.puntero++;

       //barro todas las opciones que contiene el combo y las comparo la cadena...
       for (var opcombo=0;opcombo < obj.length;opcombo++){
          if(obj[opcombo].text.substr(0,this.puntero).toLowerCase()==this.cadena.toLowerCase()){
          obj.selectedIndex=opcombo-1; // aumentado -1 -10/10/2011 - Mao
          }
       }
    }
//    event.returnValue = false; //invalida la acci�n de pulsado de tecla para evitar busqueda del primer caracter // puesto en comentario 10/10/2011 - Mao
 }

 this.empty=function() {
     this.cadena="";
     this.puntero=0;
 }


}
