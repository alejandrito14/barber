// Dom7
var $$ = Dom7;
var device1 = Framework7.getDevice();

// Theme
var theme = 'md';
if (document.location.search.indexOf('theme=') >= 0) {
  theme = document.location.search.split('theme=')[1].split('&')[0];
}

// Preloader
setTimeout(function () {
    $('.loader-screen').hide();
}, 2000);

// Init App
var app = new Framework7({
  id: 'io.framework7.testapp',
  el: '#app',
  theme,
  view : {
	//pushState: true,
	browserHistory: true,
  },
  // store.js,
  store: store,
  
  // routes.js,
  routes: routes,
   
  popup:{
    closeOnEscape: true,
  },
  sheet: {
    closeOnEscape: true,
  },
  popover: {
    closeOnEscape: true,
  },
  actions: {
    closeOnEscape: true,
  },
  vi: {
    placementId: 'pltd4o7ibb9rc653x14',
  },
});

var pictureSource;   // picture source
 var destinationType; 
var produccion = 1;
var codigoservicio="0";
$(document).ready(function() {

    if (produccion == 0) {
      codigoservicio='125';

    }else{
      codigoservicio='127';
    }


   

    window.isphone = false;
    if(document.URL.indexOf("http://") === -1 
        && document.URL.indexOf("https://") === -1) {
        window.isphone = true;


    }

    if( window.isphone ) {
       
    document.addEventListener("deviceready", Cargar, false);

     pictureSource=navigator.camera.PictureSourceType;
     destinationType=navigator.camera.DestinationType;
      mediaType = navigator.camera.MediaType;
      
    } else {

      
        Cargar();
    }
  
    


 });


var lhost = "localhost:8888";
var rhost = "issoftware1.com.mx";
var version='1.0.1';

localStorage.setItem('versionapp',version);
var abrir=0;
var intervalo;
var pictureSource;   // picture source
var destinationType; // sets the format of returned value
var intervalo2=0;
var intervalo3=0;
var intervalo4=0;
var intervalo5=0;
var intervalo6=0;
var identificadorDeTemporizador=0;
var rutaserver=localStorage.getItem('servidor');
var puertosockect=localStorage.getItem('puertosocket');


    var codigoserv="";
    var urlphp = ""; 
    var urlimagenes = ""; 
    var urlimagendefault="";
    var urlimagenlogo="";
    var globalsockect="";
    var imagenesbancos="";
    var urlimagendefaultservicio=""


function Cargar() {

//  ObtenerServidor(codigoservicio);


    if (produccion == 0) {
      codigoservicio='125';

    }else{
      codigoservicio='127';
    }
 
    var datos="clave=issoftware"+"&codservicio="+codigoservicio;
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'https://is-software.net/isadmin/obtenerservidorapp.php',
    crossDomain: true,
    cache: false,
    data:datos,
    async:false,
    success: function(resp){
var rutaserver="";
var puertosockect="";
var carpetaapp="";
      if (resp.vigente==1) {
        var servidor=resp.datosservidor.urlapp;
        var puertosocket=resp.datosservidor.puertosocket;

        localStorage.setItem('servidor',servidor);
        localStorage.setItem('puertosocket',puertosocket);

         rutaserver=resp.datosservidor.urlapp;
         puertosockect=resp.datosservidor.puertosocket;
         carpetaapp=resp.datosservidor.carpetaapp;
      }else{
        localStorage.setItem('servidor','http://localhost:8888/');
        localStorage.setItem('puertosocket','3000');
        rutaserver="http://localhost:8888";
        puertosockect="3000";

      }


  if (produccion == 0) {
    codigoserv="125/";
    urlphp = rutaserver+"/is-barber/app/php/"; 
    urlimagenes = rutaserver+"/is-barber/www/catalogos/"; 
    urlimagendefault=rutaserver+"/is-barber/www/images/sinfoto.png";
    urlimagenlogo=rutaserver+"/is-barer/www/images/sinimagenlogo.png";
    globalsockect=rutaserver+":"+puertosockect+"/";
    imagenesbancos=rutaserver+"/is-barber/www/assets/images/";
    urlimagendefaultservicio=rutaserver+"/is-barber/images/sin-servicio.jpg"

}else{
    codigoserv=codigoservicio+"/";
    urlphp = rutaserver+"/IS-BARBER/app/"+carpetaapp+"/php/";
    urlimagenes = rutaserver+"/IS-BARBER/catalogos/"; 
    urlimagendefault=rutaserver+"/IS-BARBER/images/sinfoto.png"
    urlimagenlogo=rutaserver+"/IS-BARBER/images/sinimagenlogo.png";
    urlimagendefaultservicio=rutaserver+"/IS-BARBER/images/sin-servicio.jpg"

    imagenesbancos=rutaserver+"/IS-BARBER/assets/images/";
    globalsockect=rutaserver+":"+puertosockect+"/";
   // var urlimagenvacia="https://issoftware1.com.mx/IS-ACADEMIA/images/sinimagenlogo.png";

}
 


      getConfiguracion();
   localStorage.setItem("SO", "web");

  localStorage.setItem('rutaine',0);
    localStorage.setItem('validacion',0);

  localStorage.setItem('confecha',0);
    localStorage.setItem('condirecionentrega',0);
    localStorage.setItem('idtipodepago',0);
    localStorage.setItem('llevafoto',0);
    localStorage.setItem('rutacomprobante','');
    localStorage.setItem('idopcionespedido',0);
  localStorage.setItem('iddireccion',0);
    localStorage.setItem('factura',0);
  localStorage.setItem('montocliente','');
  localStorage.setItem('asenta','');
  localStorage.setItem('datosbuscar6','');
  localStorage.setItem('datosbuscar3','');
  localStorage.setItem('nuevadireccion',1);
    localStorage.setItem('comentarioimagenes','');
    localStorage.setItem('habilitarsumaenvio',0);
    localStorage.setItem('idfacturacion','');
    localStorage.setItem('codigocupon','');
    localStorage.setItem('idcupon',0);
    localStorage.setItem('costoenvio',0);
    localStorage.setItem('idclientes_envios','');
    localStorage.setItem('observacionpedido','');
         localStorage.setItem('idusuarios_envios','');

    localStorage.setItem('montodescontado','');
  localStorage.setItem('datostarjeta','');
  localStorage.setItem('adelante',1);
  localStorage.setItem('idtutorado','');
  localStorage.setItem('cont',-1);
localStorage.setItem('valor','');
localStorage.setItem('avatar','');
        if(localStorage.getItem('iduserrespaldo')!=undefined && localStorage.getItem('iduserrespaldo')!=null)
          {
            var iduserrespaldo=localStorage.getItem('iduserrespaldo');
            localStorage.setItem('id_user',iduserrespaldo);
            localStorage.removeItem('iduserrespaldo');

          }
  /* pictureSource=navigator.camera.PictureSourceType;
   destinationType=navigator.camera.DestinationType;
*/
   var uid='000';
    localStorage.setItem("UUID",uid);
    if (device1.ios) {
      localStorage.setItem("SO", "ios");
     // var uid= device.uuid;

  
    localStorage.setItem("UUID",uid);
    }

    if (device1.android) {
      localStorage.setItem("SO", "android");

       // var uid= device.uuid;
      localStorage.setItem("UUID",uid);
    }

    if (device1.desktop) { 

      localStorage.setItem("SO", "desktop");
    }
   


      if( window.isphone ) {
 

    var p1 = new Promise(function(resolve, reject) {
      resolve(getToken());
     
    });

    p1.then(function(value) {
     var tokenfirebase=localStorage.getItem('tokenfirebase');
       
     ObtenerConfiVersion();     
     GuardarTokenBase(0); 
    
    },function(reason) {
     console.log(reason); // Error!
  });
    
    }

    MostrarAnuncios();


      

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }

    });
  
   /*  ObtenerConfiEmpresa();

    */

}


// Option 1. Using one 'page:init' handler for all pages
$$(document).on('page:init', function (e) {
  app.panel.close();
  Cargar();
   

   
 
}); 
$$(document).on('page:init', '.page[data-name="home"]', function (e) {
      
     
     getValidacionUsuario().then(r => {

        var existe=r.existe;
      

  if (existe==0) {

      //Cargarperfilfoto();
      
      CargarDatos();
  
    
  var pregunta=localStorage.getItem('pregunta');


 
    if (pregunta==0) {

     app.dialog.confirm('','¿Desea mantener la sesión activa?', function () {

        localStorage.setItem('session',1);

        localStorage.setItem('pregunta',1);

         // app.dialog.alert('','Se guardó la sesión'); 

        },

         function () {
                 
                        localStorage.setItem('pregunta',1);

                  }
            );


      

           }

      var $ptrContent = $$('.ptr-content');
        // Add 'refresh' listener on it
          $ptrContent.on('ptr:refresh', function (e) {
          // Emulate 2s loading
          setTimeout(function () {
             CargarDatos();
            // When loading done, we need to reset it
            app.ptr.done(); // or e.detail();
          }, 2000);
        });



         }else{

          GoToPage('signin');

         }


       });
    

});

$$(document).on('page:init', '.page[data-name="welcome"]', function (e) {
   
      ObtenerCategorias(1);
      ObtenerDetalleEmpresa();
      $("#btnvermas").attr('onclick',"AbrirModalDescripcion()");
    
});

$$(document).on('page:init', '.page[data-name="celular"]', function (e) {
      
   phoneFormatter('telefono');
  $$('#btnvalidarcelular').attr('onclick','ValidarCelular()')

    
});

$$(document).on('page:init', '.page[data-name="colocartoken"]', function (e) {
      
 $$("#t1").focus();
 $$('#t1').attr('onkeyup',"Siguiente('t1','t2')");
 $$('#t2').attr('onkeyup',"Siguiente('t2','t3')");
 $$('#t3').attr('onkeyup',"Siguiente('t3','t4')");
 $$('#t4').attr('onkeyup',"Validarcaja('t4');ValidarToken();");
 $$("#reenviotoken").attr('onclick',"ReenvioTokenCel()");
 $("#btncancelar1").attr("onclick","EliminarVariables()");


    
});


$$(document).on('page:init', '.page[data-name="registro"]', function (e) {
  $$('#btncontinuar').attr('onclick','Registrar()')

    
});

$$(document).on('page:init', '.page[data-name="intereses"]', function (e) {
  ObtenerIntereses();

  $("#btnguardarinteres").attr('onclick','GuardarIntereses()');
    
});

$$(document).on('page:init', '.page[data-name="login"]', function (e) {
 

  $$('#btnlogin').attr('onclick','validar_login()');

    
});

$$(document).on('page:init', '.page[data-name="detallesucursal"]', function (e) {
 

ObtenerDatosSucursal();
    
});

$$(document).on('page:init', '.page[data-name="detalleproductoservicios"]', function (e) {
 

ObtenerProductos();
    
});

$$(document).on('page:init','.page[data-name="detallepaquete"]',function(e)
{

   var sistema=localStorage.getItem('SO');

  
        var paqueteid=localStorage.getItem('idpaquete');
        detallepaquete(paqueteid);

     
    $(".ptr-content").css('overflow','scroll');

});

$$(document).on('page:init','.page[data-name="detalleservicio"]',function(e)
{

        var paqueteid=localStorage.getItem('idpaquete');
        detalleservicio(paqueteid);
        $(".ptr-content").css('overflow','scroll');

        $(".disponibilidadfecha").attr('onclick','Disponilidadfecha()');
        $(".disponibilidadespecialista").attr('onclick','Disponibilidadespecialista()');


});

$$(document).on('page:init','.page[data-name="disponibilidadfecha"]',function(e)
{
        var paqueteid=localStorage.getItem('idpaquete');

    detalleservicio(paqueteid);
     CargarCalendario();

});

$$(document).on('page:init','.page[data-name="disponibilidadespecialista"]',function(e)
{
        var paqueteid=localStorage.getItem('idpaquete');

    detalleservicio(paqueteid);
     CargarCalendario();

});



