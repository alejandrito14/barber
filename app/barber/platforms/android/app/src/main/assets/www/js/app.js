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
      codigoservicio='106';

    }else{
      codigoservicio='109';
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

      alert('a');
        Cargar();
    }
  
    


 });


var lhost = "localhost:8888";
var rhost = "issoftware1.com.mx";
var version='1.0.14';

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
      codigoservicio='106';

    }else{
      codigoservicio='109';
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
    codigoserv="106/";
    urlphp = rutaserver+"/is-academia/app/php/"; 
    urlimagenes = rutaserver+"/is-academia/www/catalogos/"; 
    urlimagendefault=rutaserver+"/is-academia/www/images/sinfoto.png";
    urlimagenlogo=rutaserver+"/is-academia/www/images/sinimagenlogo.png";
    globalsockect=rutaserver+":"+puertosockect+"/";
    imagenesbancos=rutaserver+"/is-academia/www/assets/images/";
    urlimagendefaultservicio=rutaserver+"/is-academia/images/sin-servicio.jpg"

}else{
    codigoserv=codigoservicio+"/";
    urlphp = rutaserver+"/IS-ACADEMIA/app/"+carpetaapp+"/php/";
    urlimagenes = rutaserver+"/IS-ACADEMIA/catalogos/"; 
  
    urlimagendefault=rutaserver+"/IS-ACADEMIA/images/sinfoto.png"
    urlimagenlogo=rutaserver+"/IS-ACADEMIA/images/sinimagenlogo.png";
    urlimagendefaultservicio=rutaserver+"/IS-ACADEMIA/images/sin-servicio.jpg"

    imagenesbancos=rutaserver+"/IS-ACADEMIA/assets/images/";
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
      
      ObtenerTableroAnuncios(1);

});
