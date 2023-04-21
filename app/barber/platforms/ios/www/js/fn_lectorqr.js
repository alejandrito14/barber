function scanqr() {
	
	cordova.plugins.barcodeScanner.scan(
      function (result) {

      	if (result.format=='QR_CODE') {

           var arreglo=[];
           arreglo.push(result.text);
           var idcita=localStorage.getItem('idcita');
            var id_user=localStorage.getItem('id_user');
            var datos="id_user="+id_user+"&idcita="+idcita+"&textqr="+JSON.stringify(arreglo);
            
            var pagina = "validarqr.php";
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: urlphp+pagina,
              data:datos,
              success: function(res){ 
                var respuesta=res;

                // alert(respuesta.validado+'id'+respuesta.idusuario);
                if (respuesta.validado==1) {

                  localStorage.setItem('idcita',respuesta.cita);
                  alerta('','Check-in validado');
                }

                else if (respuesta.validado==2) {
                  localStorage.setItem('cita',respuesta.cita);

      
                 
                }

                else{

                 alerta('','No válidado qr');
 
                }
                
                
                },error: function(XMLHttpRequest, textStatus, errorThrown){ 
                  var error;
                      if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
                      if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                          //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                    console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
                }
              });

      	}
         
      },
      function (error) {
          alert("Scanning failed: " + error);
      },
      {
          preferFrontCamera : false, // iOS and Android
          showFlipCameraButton : true, // iOS and Android
          showTorchButton : true, // iOS and Android
          torchOn: true, // Android, launch with the torch switched on (if available)
          saveHistory: true, // Android, save scan history (default false)
          prompt : "Coloque un código qr dentro del área de escaneo", // Android
          resultDisplayDuration: 500, // Android, display scanned text for X ms. 0 suppresses it entirely, default 1500
          formats : "QR_CODE,PDF_417", // default: all but PDF_417 and RSS_EXPANDED
          orientation : "portrait", // Android only (portrait|landscape), default unset so it rotates with the device
          disableAnimations : true, // iOS
          disableSuccessBeep: false // iOS and Android
      }
   );
}


function scanqr2() {
  
  cordova.plugins.barcodeScanner.scan(
      function (result) {

        if (result.format=='QR_CODE') {

           var arreglo=[];
           arreglo.push(result.text);
           var idcita=localStorage.getItem('idcita');
            var id_user=localStorage.getItem('id_user');
            var datos="id_user="+id_user+"&idcita="+idcita+"&textqr="+JSON.stringify(arreglo);
            
            var pagina = "validarqr2.php";
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: urlphp+pagina,
              data:datos,
              success: function(res){ 
                var respuesta=res;

                // alert(respuesta.validado+'id'+respuesta.idusuario);
                if (respuesta.validado==1) {

                  localStorage.setItem('idcita',respuesta.cita);
                  alerta('','Se ha validado el qr');
                }

                else if (respuesta.validado==2) {
                  localStorage.setItem('cita',respuesta.cita);

                 
                  GoToPage('validadoqrvisita');
                }

                else{

                 alerta('','No válidado qr');
 
                }
                
                
                },error: function(XMLHttpRequest, textStatus, errorThrown){ 
                  var error;
                      if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
                      if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                          //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                    console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
                }
              });

        }
         
      },
      function (error) {
          alert("Scanning failed: " + error);
      },
      {
          preferFrontCamera : false, // iOS and Android
          showFlipCameraButton : true, // iOS and Android
          showTorchButton : true, // iOS and Android
          torchOn: true, // Android, launch with the torch switched on (if available)
          saveHistory: true, // Android, save scan history (default false)
          prompt : "Coloque un código qr dentro del área de escaneo", // Android
          resultDisplayDuration: 500, // Android, display scanned text for X ms. 0 suppresses it entirely, default 1500
          formats : "QR_CODE,PDF_417", // default: all but PDF_417 and RSS_EXPANDED
          orientation : "portrait", // Android only (portrait|landscape), default unset so it rotates with the device
          disableAnimations : true, // iOS
          disableSuccessBeep: false // iOS and Android
      }
   );
}