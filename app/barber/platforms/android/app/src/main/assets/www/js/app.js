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
	//browserHistory: true,
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
var intervalo=0;
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
var version='1.0.3';

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
var rutaserver="";
var puertosockect="";


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

      var sesion=localStorage.getItem('session');
      var iduser=localStorage.getItem('id_user'); 
         if(sesion==1)
          {
            if (iduser>0) {
               ValidarUsuarioSession();
             
             }else{
               myStopFunction(intervalo);

               MostrarAnuncios();    

             }

           

          }else{
            myStopFunction(intervalo);
            MostrarAnuncios();        
          }
    
    

   


      

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

//Cargar();
   
 
}); 
$$(document).on('page:init', '.page[data-name="home"]', function (e) {
     $(".btnsalir").attr('onclick','salir_app()');
     $(".btniracarrito").attr('onclick','IraCarrito()');

    var invitado=  localStorage.getItem('invitado');

    if (invitado==1) {

      $(".menuoculto").css('display','none');
      $(".menuusuario").css('visibility','hidden');
      $(".btnsalir").css('display','');
    }

  CargarDatos();
  var pregunta=localStorage.getItem('pregunta');
    if (pregunta==0) {
     app.dialog.confirm('','¿Desea mantener la sesión activa?', function () {
        localStorage.setItem('session',1);

        localStorage.setItem('pregunta',1);
        },
         function () {
            
                        localStorage.setItem('pregunta',1);
                  }
            );
           }

});


$$(document).on('page:init', '.page[data-name="homeespecialista"]', function (e) {
        $(".btnsalir").attr('onclick','salir_app()');
        $(".btnscan2").attr('onclick','scanqr2()');
      
      CargarDatosEspecialista();
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

$$(document).on('page:init', '.page[data-name="celular2"]', function (e) {
      
   phoneFormatter('telefono');
  $$('#btnvalidarcelular').attr('onclick','ValidarCelular()')

    
});

$$(document).on('page:init', '.page[data-name="colocartoken"]', function (e) {
      
 $$("#t5").focus();
/* $$('#t1').attr('onkeyup',"Siguiente('t1','t2')");
 $$('#t2').attr('onkeyup',"Siguiente('t2','t3')");
 $$('#t3').attr('onkeyup',"Siguiente('t3','t4')");*/
 $$('#t5').attr('onkeyup',"ValidarToken();");
 $$("#reenviotoken").attr('onclick',"ReenvioTokenCel()");
 $("#btncancelar1").attr("onclick","EliminarVariables()");


    
});


$$(document).on('page:init', '.page[data-name="registro"]', function (e) {
  $$('#btncontinuar').attr('onclick','Registrar()')

$$('#v_nombre').attr('onfocus',"Cambiar(this)");
$$('#v_nombre').attr('onblur',"Cambiar2(this);QuitarEspacios(this);");

$$('#v_paterno').attr('onfocus',"Cambiar(this)");
$$('#v_paterno').attr('onblur',"Cambiar2(this);QuitarEspacios(this);");

$$('#v_materno').attr('onfocus',"Cambiar(this)");
$$('#v_materno').attr('onblur',"Cambiar2(this);QuitarEspacios(this);");

$$('#v_fecha').attr('onfocus',"Cambiar(this)");
$$('#v_fecha').attr('onblur',"Cambiar2(this);QuitarEspacios(this);");

$$('#v_email').attr('onfocus',"Cambiar(this)");
$$('#v_email').attr('onblur',"Cambiar2(this);QuitarEspacios(this);");


$('.show-pass').on('click',function(){
      $(this).toggleClass('active');
      var passInput = $(this).parent().find('input');
      var inputType = passInput.attr('type');
      if( inputType == 'password'){
        passInput.attr('type','text');
      }else if(inputType == 'text'){
        passInput.attr('type','password');
      }
    });

});

$$(document).on('page:init', '.page[data-name="intereses"]', function (e) {
  ObtenerIntereses();

  $("#btnguardarinteres").attr('onclick','GuardarIntereses()');
    
});

$$(document).on('page:init', '.page[data-name="login"]', function (e) {
 
  localStorage.setItem('id_user',0);
  $$('#btnlogin').attr('onclick','validar_login()');
  $$('#btnregresar').attr('onclick','RegresarLanding()'); 

  $$(".btninvitado").attr('onclick','entrarinvitado()');

});

$$(document).on('page:init', '.page[data-name="detallesucursal"]', function (e) {
 

ObtenerDatosSucursal();
    
});

$$(document).on('page:init', '.page[data-name="detalleproductoservicios"]', function (e) {
 
ObtenerCategoriasProducto();
//ObtenerProductos();
    
});

$$(document).on('page:init', '.page[data-name="subcategorias"]', function (e) {
 
ObtenerSubCategorias();
    
});

$$(document).on('page:init', '.page[data-name="productoscategoria"]', function (e) {
 var div="divproductosservicios";
ObtenerProductosCategorias(div);
    
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
   
     $("#v_especialista2").attr('onchange','ObtenerEspecialistaCosto2()');

     $("#v_horarios").attr('onchange','ObtenerEspecialistaHora()');
     $(".btnagendarcita").attr('onclick','AgendarCita()');
     CargarCalendario();
});

$$(document).on('page:init','.page[data-name="disponibilidadespecialista"]',function(e)
{
        var paqueteid=localStorage.getItem('idpaquete');

    detalleservicio(paqueteid);
   // CargarCalendario(); 
    CargarEspecialista();

    $("#v_especialista").attr('onchange','ObtenerEspecialistaCosto();');
    $("#demo-calendar-default").attr('onclick','AbrirCalendario()');

    $("#v_horarios2").attr('onchange','HabilitarBotonAgendar()');
    $(".btnagendarcita").attr('onclick','AgendarCita2()');


});

$$(document).on('page:init', '.page[data-name="resumenpago"]', function (e) {
  
 //$$(".regreso").attr('onclick','GoToPage("listadopagos")');
 
  localStorage.setItem('descuentocupon',0);
 localStorage.setItem('comisionmonto',0);
 localStorage.setItem('comisionporcentaje',0);
 localStorage.setItem('comision',0);
 localStorage.setItem('impuestotal',0);
 localStorage.setItem('subtotalsincomision',0);
 localStorage.setItem('comisionnota',0);
 localStorage.setItem('comisionpornota',0);
 localStorage.setItem('tipocomisionpornota',0);
 localStorage.setItem('campomonto',0);
 localStorage.setItem('constripe',0);
 localStorage.setItem('comisiontotal',0);
 localStorage.setItem('monedero',0);
  $("#btnpagarresumen").attr('disabled',true);
  $$("#btnatras").attr('onclick','Atras()');
  $$("#btnatras").css('display','none');
  CalcularTotales(); 
  Cargartipopago(0); 
 
 $$(".btnmonedero").attr('onclick','AbrirModalmonedero()');
 $$(".btncupon").attr('onclick','AbrirModalcupon()');
 

 $$("#requierefactura").attr('onchange','RequiereFactura()');
  

  //ObtenerDescuentosRelacionados();//manda a llamar calcular totales al finalizar los descuentos
  
//PintarlistaImagen();
  $$("#tipopago").attr('onchange','CargarOpcionesTipopago()');
  $(".divtransferencia").css('display','none');
  $("#divagregartarjeta").css('display','none');
  $("#divlistadotarjetas").css('display','none');

  $$("#btnpagarresumen").attr('onclick','RealizarCargo()')
});

$$(document).on('page:init','.page[data-name="homeindex"]',function(e)
{
  MostrarAnuncios();
 
  /*setTimeout(function () {

      var id_user=localStorage.getItem('id_user');
      var session=localStorage.getItem('session');
      var idtipousuario=localStorage.getItem('idtipousuario');
   
if (session==1) {
     
  

        getVistoAnuncio().then(r => {
       
          
         if(r.visto == 0 && r.configuracion.mostraranuncios==1)
          {  
            app.views.main.router.navigate('/home/');

            }else{
           Cargarperfilfoto();
             //resolve({ url: './pages/inicio2.html', })
                if (id_user>0 && session==1) {

                      var idcliente=localStorage.getItem('id_user');
                       GuardarTokenBase(idcliente);

                    if (idtipousuario==0) {
                        app.views.main.router.navigate('/homeadmin/');

                    }
                    if (idtipousuario==3) {
                        app.views.main.router.navigate('/home/');

                    }
                    if (idtipousuario==5) {
                        app.views.main.router.navigate('/homecoach/');

                    }
                  }

             
            }
        });

    

  }else{
   
      app.views.main.router.navigate('/');

  }

  }, 1000);*/

});


$$(document).on('page:init','.page[data-name="carrito"]',function(e)
{

  CargarCarrito();

  $(".btnpagar").attr('onclick','IrAPago()');
  $(".btnagregarmas").attr('onclick','Agregarmasproducto()');

  
});

$$(document).on('page:init','.page[data-name="listadocompras"]',function(e)
{

  ObtenerPagosPagados();
 

  
});

$$(document).on('page:init','.page[data-name="detallepago"]',function(e)
{

  Pintardetallepago();
 

  
});



$$(document).on('page:init','.page[data-name="forgotpassword"]',function(e)
{
  $$('#recuperarcontrase').attr('onclick','recuperar()');

    phoneFormatter('v_email');
 $("#v_email").attr('onblur','Cambiar2(this);');
 $$('#v_email').attr('onfocus',"Cambiar(this)");
 
});

$$(document).on('page:init', '.page[data-name="verificacion"]', function (e) {

 $$("#t1").focus();
 $$('#t1').attr('onkeyup',"Siguiente('t1','t2')");
 $$('#t2').attr('onkeyup',"Siguiente('t2','t3')");
 $$('#t3').attr('onkeyup',"Siguiente('t3','t4')");
 $$('#t4').attr('onkeyup',"Validarcaja('t4');VerificarToken1();CargarBoton();");
 $$("#reenviotoken").attr('onclick',"ReenvioToken()");
 $("#btncancelar1").attr("onclick","EliminarVariables()");

});


$$(document).on('page:init', '.page[data-name="cambiocontra"]', function (e) {

 $$('#v_contra1').attr('onkeyup',"CoincidirContra('v_contra1','v_contra2');Aparecercruz('v_contra1','spanvisible','ojitoicono');AparecerBoton();");
 $$('#span1').attr('onclick',"CambiarAtributoinputpass('v_contra1')"); 
 $$('#v_contra2').attr('onkeyup',"CoincidirContra('v_contra1','v_contra2');Aparecercruz('v_contra2','spanvisible2','ojitoicono2');AparecerBoton();");
 $$('#span2').attr('onclick',"CambiarAtributoinputpass2('v_contra2')");
 $$('#btncambiocontrase').attr('onclick','Reestablecercontra()');
 $(".spanvisible").attr('onclick',"LimpiarElemento('v_contra1')");
 $(".spanvisible2").attr('onclick',"LimpiarElemento4('v_contra2')");
 $("#btncancelar").attr("onclick","EliminarVariables()");
 $$("#btncambiocontrase").css('display','none');

 $("#v_contra1").attr('onblur','Cambiar2(this);QuitarEspacios(this);');
 $$('#v_contra1').attr('onfocus',"Cambiar(this);");

 $("#v_contra2").attr('onblur','Cambiar2(this);QuitarEspacios(this);');
 $$('#v_contra2').attr('onfocus',"Cambiar(this)");

 AbrirInfo();

    $('.show-pass').on('click',function(){
      $(this).toggleClass('active');
      var passInput = $(this).parent().find('input');
      var inputType = passInput.attr('type');
      if( inputType == 'password'){
        passInput.attr('type','text');
      }else if(inputType == 'text'){
        passInput.attr('type','password');
      }
    });


});

$$(document).on('page:init', '.page[data-name="homeadmin"]', function (e) {
        $(".btnsalir").attr('onclick','salir_app()');

      
      CargarDatosAdmin();
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

});


$$(document).on('page:init', '.page[data-name="servicios"]', function (e) {

 CargarCalendario2();

});

$$(document).on('page:init', '.page[data-name="productos"]', function (e) {

 CargarCalendario3();

});

$$(document).on('page:init', '.page[data-name="bloqueos"]', function (e) {

$('input[name="demo-radio-start"]').prop('checked', false);
$('input[name="demo-radio-start"]').change(function () {
    if ($(this).is(':checked')) {

       var valor=$(this).val();

      PintarOpcionBloqueo(valor);
    }
    //Here do the stuff you want to do when 'unchecked'
});

});

$$(document).on('page:init', '.page[data-name="datospersonales"]', function (e) {

Cargardatospersonales();

});
$$(document).on('page:init', '.page[data-name="profile"]', function (e) {


  Cargarperfilfoto();
   CargarFoto();
  $$('#btncerrarsesion').attr('onclick','salir_app()')

  $$("#datosacceso").attr('onclick','Datosacceso()');
  $$(".badgefoto").attr('onclick','AbrirModalFoto()');

  $$(".badgefoto").attr('onclick','AbrirModalFoto()');

  $$("#btneliminarcuenta").attr('onclick','EliminarCuenta()');
 $(".versionapp").text(version);

 

});

$$(document).on('page:init', '.page[data-name="politicas"]', function (e) {
  
 ObtenerPolitica();

  

});

$$(document).on('page:init', '.page[data-name="datosacceso"]', function (e) {

  ObtenerTiposUsuarios();
  CargardatosIngresados();
  TipoUsuario();
  ObtenerdatosAcceso2();
 $$('#v_contra1').attr('onkeyup',"Contarletrasinput('v_contra1','ojitoicono')");
 $$('#span1').attr('onclick',"CambiarAtributoinput('v_contra1')"); 
 $$('#v_contra2').attr('onkeyup',"CoincidirContra('v_contra1','v_contra2');Contarletrasinput('v_contra2','ojitoicono2');");
 
 $$('#span2').attr('onclick',"CambiarAtributoinput2('v_contra2')");
 $$("#btnguardar").attr('onclick','GuardarDatosacceso()');

 $('.show-pass').on('click',function(){
      $(this).toggleClass('active');
      var passInput = $(this).parent().find('input');
      var inputType = passInput.attr('type');
      if( inputType == 'password'){
        passInput.attr('type','text');
      }else if(inputType == 'text'){
        passInput.attr('type','password');
      }
    });

});

$$(document).on('page:init', '.page[data-name="detalleespecialista"]', function (e) {

  ObtenerdetalleEspecialista();
});


$$(document).on('page:init', '.page[data-name="disponibilidadespecialistaelegido"]', function (e) {
  ObtenerdetalleEspecialista();
  CargarCalendario4();
  $(".divhorarios").css('display','none');
  $(".divservicios").css('display','none');
  $(".btnagendarcita").attr('onclick','AgendarCita3()');


});

$$(document).on('page:init', '.page[data-name="disponibilidadfechasucursal"]', function (e) {
    CargarCalendario5();
  $(".btnagendarcita").attr('onclick','AgendarCita4()');

});


/*$$(document).on('page:init', '.page[data-name="disponibilidadfechaadmin"]', function (e) {
  $("#txtfechaadmin").attr('onclick','AbrirModalServicios()');
 CargarCalendario2();
 CargarPaquetes();
 $("#v_paqueteservicio").attr('onchange','SeleccionarServicio()');
 localStorage.setItem('idpaquete',0);
});

 $$(document).on('page:init', '.page[data-name="disponibilidadespecialistaadmin"]', function (e) {

    CargarEspecialistaAdmin();
    $("#v_especialista").attr('onchange','ObtenerEspecialistaCosto();');

    $("#demo-calendar-default").attr('onclick','AbrirCalendario()');

});
 */

