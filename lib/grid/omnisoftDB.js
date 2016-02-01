
omnisoftDB=function(aSQLCommand,aPath,aFunction,uppercase) {

   if (uppercase== undefined || uppercase==true)
   this.sqlCommand=aSQLCommand.toUpperCase();
   else
   this.sqlCommand=aSQLCommand;
   this.dataTable='';
   this.rpath=(aPath==undefined)?"lib/server/omnisoftSQLData.php":aPath;


   this.rfunction =(aFunction==undefined)?'omnisoftProcesarDatos':aFunction;

this.executeQuery=function () {

         var funcion=this.rfunction;
         this.dataTable = new AW.HTTP.Request();
         this.dataTable.setRequestMethod("POST");
         this.dataTable.setURL(this.rpath);
         this.dataTable.setParameter("query",this.sqlCommand);
         this.dataTable.response = function(datos) {
           var data=(datos+'').replace(/([\\"'])/g, "\\$1").replace(/\0/g, "\\0");
          // alert(data);
         var comando=funcion+"('"+data+"')";
        // alert(comando);
           eval(comando);
        };
         this.dataTable.request();
  }
};


