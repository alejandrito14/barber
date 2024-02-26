<?php
session_start();

// Establecer el paso actual en 1 si no está definido
if (!isset($_SESSION['wizard_step'])) {
    $_SESSION['wizard_step'] = 1;
}

$idsucursal=$_POST['idsucursal'];
$idcategoriapaquete=$_POST['idcategoriapaquete'];
$fechaselecte="";
if (isset($_POST['fechaselecte'])) {

  $fechaselecte=$_POST['fechaselecte'];

}
//echo('aq'.$_POST['horainicialselect']);
$horaselecte=1;

if (isset($_POST['horainicialselect'])) {
    $hora= $_POST['horainicialselect'];
    # code...
    if ($hora!=0 && $hora!='' ) {

    $horaselecte=$_POST['horainicialselect'];
    $horaselecte=substr($horaselecte, 0, 5);
    }else{

      if ($hora==0 && $hora!='') {

         $horaselecte=$_POST['horainicialselect'];



      }else{
        $horaselecte=1;

      }


     
    }
  
}else{

  $horaselecte=1;
 
}


$idespecialistaselect="";
if (isset($_POST['idespecialistaselect'])) 

{
  $idespecialistaselect=$_POST['idespecialistaselect'];

}

// Obtener el paso actual
$wizardStep = $_SESSION['wizard_step'];
?>

<!-- Aquí comienza tu formulario HTML -->
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
  
  <link rel="stylesheet" href="dist/css/rescalendar.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
  <script src="js/rescalendar.js"></script>

<form name="form_usuario1" id="form_usuario1">
  <div id="divdetalles" style="text-align: center;width: 100%;display: none;"></div> 

  <div class="wizard-step" id="step1" style="">
    <div class="card" id="home" role="tabpanel">
    <!--  <div class="card-header headercategoria" style="margin-top: 1em; margin-bottom: 1em;">
      <h5>SELECCIONAR CATEGORIA </h5>
    </div> -->

    <div id="categorias" class="categorias row" data-espacio="1" style="display: flex;
    justify-content: center;">
        <!-- Aquí se cargarán dinámicamente las categorías -->
    </div>



     <div id="subcategorias" class="subcategorias" data-espacio="2">
        <!-- Aquí se cargarán dinámicamente las subcategorías -->
    </div>
   </div>


    <div id="elementos"></div>

     <div class="card" id="divheaderservicio" role="tabpanel" style="    margin-right: 1em;
    margin-left: 1em;">

     <div class="row" style="margin-left: 10px;">
     	
     	<div class="col-md-5">
     		
	     <div class="card-header " style="margin-top: 1em;    margin-bottom: 1em;">
	      <h5>SELECCIONAR SERVICIO/PRODUCTO </h5>
	    </div>
     	</div>
     	<div class="col-md-2"></div>

     	<div class="col-md-5"></div>


     </div>

    


    <div class="row" style="    margin-left: 10px;">
    	 <div class="col-md-5" >
    	<input type="text" class="form-control" name="buscadorpaq_" id="buscadorpaq_" placeholder="Buscar" onkeyup="BuscarEnLista('#buscadorpaq_','.pasuc_')">
    	</div>
    </div>
   

    

    </div>
   
    <div class="row" style="margin-right: 1em;
    margin-left: 1em;">
    	<div class="container mt-5 mb-5 " >

    <div class="">
    	
    	<div class="">
    		<div class="">
    			<div class="row" style="    margin-right: 10px;
    margin-left: 10px;">

    				 <div class="col-md-5 servicios" id="servicios" >
			        </div>
			        <div class="col-md-2"></div>
			        <div class="col-md-5 paquetesseleccionados" >
			        	
			        </div>
    			</div>

    		</div>

    	 </div>
       
    </div>
    		
    	</div>
        <!-- Aquí se cargarán los servicios -->
    </div>

   </div>

    <div class="row">
     <div class="col-md-12" style="justify-content: right;
    display: flex;">
      <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()" style="display: none;">Regresar</button>


       <!--   <button type="button" class="btn btn-primary btnstep1" style="display: none;" id="btstep1" onclick="">Continuar</button> -->

     </div>
    </div>

    
  </div>

       

</div>

<div class="wizard-step" id="step2" style="display:none;">
    <div id="subcategorias">
        <!-- Aquí se cargarán dinámicamente las subcategorías -->
    </div>

     <div class="card cardfechaspro" id="home" role="tabpanel" >
     <div class="card-header" style="margin-top: 1em;    margin-bottom: 1em;">
      <h5>SELECCIONAR FECHA/HORA/BARBERO </h5>
    </div>
     <div class="row" style="    margin-left: 2em;
    margin-right: 2em;">
	    <div class="col-md-12 listadopaquetes">

	   

	   </div>

    </div>
   <!--  <button type="button" id="recargar"></button> -->
   </div>


    <div class="card cardpro" id="home" role="tabpanel" style="display: none;" >
     <div class="card-header" style="margin-top: 1em;    margin-bottom: 1em;">
      <h5>SELECCIONAR CANTIDAD </h5>
    </div>
     <div class="row" style="margin-left: 2em;display: flex;
    justify-content: center;">
    <div class="col-md-4">

     <div class="detallepaquete"></div>

   </div>

   

    </div>
   <!--  <button type="button" id="recargar"></button> -->
   </div>

<div class="row" style="margin-top: 1em;margin-left: 1em;
    margin-right: 1em;">
     <div class="col-md-12" style="justify-content: space-between;
    display: flex;
    flex-wrap: nowrap;">
        <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()">Regresar</button>


         <button type="button" class="btn btn-primary btnstep2" style="display: none;" id="btstep2" onclick="">Continuar</button>
        </div>
       </div>
</div>

<div class="wizard-step" id="step3" style="display:none;">

   <div class="card" id="home" role="tabpanel">
     <div class="card-header" style="margin-top: 1em;    margin-bottom: 1em;">
      <h5>SELECCIONAR HORARIO </h5>
    </div>

    <div class="row">
    <div class="col-md-12">

     <div id="divhorarios">
      
      <div class=" btn-group-toggle liintervalos" data-toggle="buttons" ></div>
     </div>
   </div>
 </div>

</div>

    

    <div class="row" style="margin-top: 1em;">
     <div class="col-md-12" style="justify-content: space-between;
    display: flex;
    flex-wrap: nowrap;">

        <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()">Regresar</button>

         <button type="button" class="btn btn-primary btnstep3" style="display: none;" id="btstep3" onclick="">Continuar</button>
        </div>
       </div>
</div>



<div class="wizard-step" id="step4" style="display:none;">

  <div class="card" id="home" role="tabpanel">
     <div class="card-header" style="margin-top: 1em;    margin-bottom: 1em;">
      <h5>SELECCIONAR BARBERO </h5>
    </div>

     <div class="row">
    <div class="col-md-6">

     <div class="seleccionarbarbero" style="margin-left: 10px;"></div>


    </div>

   </div>
 </div>


<div class="row" style="margin-top: 1em;">
     <div class="col-md-12" style="margin-top: 1em;justify-content: space-between;
    display: flex;
    flex-wrap: nowrap;">
        <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()">Regresar</button>

         <button type="button" class="btn btn-primary btnstep4" style="display: none;" id="btstep4" onclick="">Continuar</button>

        </div>
       </div>
</div>


<!-- <div class="wizard-step" id="step5" style="display:none;">
     <div class="row">
    <div class="col-md-6">

     <div class="seleccioncortesia row" style="margin-left: 10px;"></div>


    </div>

   </div>

<div class="row" style="margin-top: 1em;">
     <div class="col-md-12" style="margin-top: 1em;justify-content: right;
    display: flex;">
        <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()">Atrás</button>

         <button type="button" class="btn btn-primary btnstep5" id="btstep5" onclick="">Siguiente</button>

        </div>
       </div>
</div> -->

<div class="wizard-step" id="step5" style="display:none;">

  <div class="card" id="home" role="tabpanel">
     <div class="card-header" style="margin-top: 1em;    margin-bottom: 1em;">
      <h5 style="text-align: center;">EL TIEMPO DEL SERVICIO <span id="colorcarserviciotiempo"></span>¿DESEA CAMBIARLO? </h5>
    </div>

     <div class="row">
      <div class="col-md-4">

      </div>
    <div class="col-md-4">

     <div class="divtiempo btn-group-toggle" id="divtiempo"></div>


    </div>

        <div class="col-md-4">
        </div>
      </div>

   </div>
 

<div class="row" style="margin-top: 1em;">
     <div class="col-md-12" style="margin-top: 1em;justify-content: space-between;
    display: flex;
    flex-wrap: nowrap;">
        <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()">Regresar</button>

         <button type="button" class="btn btn-primary btnstep5" id="btstep5" onclick="">Continuar</button>

        </div>
       </div>
</div>

<div class="wizard-step" id="step6" style="display:none;">

   <div class="card" id="home" role="tabpanel">
     <div class="card-header" style="margin-top: 1em;    margin-bottom: 1em;">
      <h5>SELECCIONAR CORTESÍA</h5>
    </div>



    
   <div class="divcortesia row" id="divcortesia" style="display: flex;
    justify-content: center;"></div>


    </div>

 

<div class="row" style="margin-top: 1em;">
     <div class="col-md-12" style="margin-top: 1em;justify-content: space-between;
    display: flex;
    flex-wrap: nowrap;">
        <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()">Regresar</button>

         <button type="button" class="btn btn-primary btnstep6" id="btnstep6" onclick="">Continuar</button>

        </div>
       </div>
</div>


<div class="wizard-step" id="step7" style="display:none;">
     <div class="row">
      <div class="col-md-3">

      </div>
    <div class="col-md-6">

   <div class="divresumen" id="divresumen"></div>


    </div>

        <div class="col-md-3">
        </div>

   </div>

<div class="row" style="margin-top: 1em;">
     <div class="col-md-12" style="margin-top: 1em;justify-content: space-between;
    display: flex;
    flex-wrap: nowrap;">
        <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()">Regresar</button>

         <button type="button" class="btn btn-primary btnstep7" id="btstep7" onclick="">Guardar</button>

        </div>
       </div>
</div>




</form>


<div class="modal" id="modalespera" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
       
      </div>
      <div class="modal-body" id="divespera">
      
       
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>



<script>
  var idsucursal='<?php echo $idsucursal; ?>';
  var idcategoriapaquete='<?php echo $idcategoriapaquete; ?>';
   var detalle=[];
   var currentStep = 1;
   var idpaqueteseleccionado=0;
   var fechaseleccionada="";
   var idcortesiaseleccionado=0;
   var fechaconsulta="";
   var horainicialsele="";
   var horafinalsele="";
   var horarioseleccionado="";
   var valorseleccionado="";
   var horaselecte='<?php echo $horaselecte; ?>';
    var fechaselecte2='<?php echo $fechaselecte; ?>';

   var idespecialista='<?php echo $idespecialistaselect; ?>';

   var horainicials="";
   var horafinals="";
   var categoriassub=[];
           
    $(document).ready(function() {
        // Datos de ejemplo
        var categorias = [
            //{ id: 1, nombre: "Cabello", subcategorias: [1, 2] },
           // { id: 2, nombre: "Uñas", servicios: [5, 6, 7] },
            // ... otras categorías ...
        ];

        var subcategorias = [
           // { id: 1, nombre: "Corte de pelo", subcategorias: [3, 4] },
            //{ id: 2, nombre: "Tinte", servicios: [8, 9] },
            // ... otras subcategorías ...
        ];

     

  
        var serviciospaquete = [];
        var todascategorias=[];
        const myPromise = new Promise((resolve, reject) => {
            resolve(ObtenerServicios1());
          
        });

        myPromise.then((successMessage) => {
            

        SeleccionarSucursalAgenda(idsucursal);


        $("#step1").show();
       
       // ObtenerTodasCategorias();
        //viewPaquetes(0);

        });


         myPromise.then((successMessage) => {

           

            VerificarSiCategoriaTieneSub().then((successMessage) => {
            	console.log('entrando');
              console.log(successMessage);
                if (successMessage.respuesta>0) {
                  ObtenerCategorias1();

                }else{
                  $("#divheaderservicio").css('display','');
                  $(".headercategoria").css('display','none');
                    $(".servicios").append(`<div id="servi_`+idcategoriapaquete+`" class="row" style="display:none;    display: flex;
    justify-content: center;"></div>`);
                  
                    viewPaquetes(idcategoriapaquete);
                }


            });
         
         });


      });
 var currentStep = 1; // Inicialmente en el paso 1

 var producto=0;
      function showStep(step) {
        $(".wizard-step").hide(); // Oculta todos los pasos
        $("#step" + step).show(); // Muestra el paso deseado
        currentStep=step;

       

        if (step==2) {
        	 $(".listadopaquetes").html('');
        	PintarProductosSeleccionadosStep2();


          if (producto==0) {
          /*var fecha=new Date();
          var f=fecha.toISOString().split('T')[0];*/
         /*
          var anio=f.split('-')[0];
          var mes=f.split('-')[1];*/
         
         /* ObtenerFechasCalendarioAgendaA(anio,mes);
           $("#btstep2").css('display','none');
           $(".cardpro").css('display','none');

           var fechaselecte='<?php echo $fechaselecte; ?>';
*/

          /* if (fechaselecte!=undefined && fechaselecte!='') {

              
               fechaconsulta=fechaselecte;
                PintarHoraSeleccionadaA(fechaselecte);
                PintarFechaSeleccionadaA(fechaselecte);

                fechaformato(fechaconsulta, function(respuesta) {
                     detalle[2] = respuesta; // Hacer algo con la respuesta obtenida
                 });


                $("#btstep2").css('display','block');
                $("#btstep2").attr('onclick','showStep(3)');
           }*/
         }else{

          /*$(".cardfechaspro").css('display','none');
          ObtenerDetalleProducto();

          $("#btstep2").css('display','none');
*/
         }

        }

        if (step==3) {

          
           

          // Agregaradetalle(fechaconsulta);

           $("#btstep3").css('display','none');
          console.log(horaselecte);
          
          if (horaselecte!=undefined && horaselecte!='' && horaselecte!=0) {
           

             PintarFechaSeleccionadaA(fechaconsulta);
            PintarHoraSeleccionadaA(fechaconsulta);
              var index=0;
              setTimeout(() => {
            $(".btncategointervalo1").each(function() {

             var valordata=$(this).attr('data-hora');
           
             if (horaselecte==valordata) {
                var id=$(this).attr('id');
                var valordata2=$(this).attr('data-horafinal');


                   SeleccionarHorario1(valordata,valordata2,index);
                   $("#"+id).addClass('active');
                 
                 
                  return 0;
               }
             index++;
                        
            });

               }, "100"); 
          }else{


           
            if (horaselecte == 0) {
              $("#divhorarios").html();
               ColocarHora();
            }

          }
       

        }
        if (step==4) {

        
         $("#btstep4").css('display','none');


         
           ObtenerListadoEspecialista2();
          
           if (horaselecte!=undefined && horaselecte!='' && horaselecte!=0) {

            
          if (idespecialista!=undefined && idespecialista!='') {
            
           
             ObtenerEspecialista(idespecialista)
             .then(function(respuesta) {
                 SeleccionarEspecialista(idespecialista,respuesta);
             })
             .catch(function(error) {
                 console.log("Error en la solicitud AJAX:", error);
             });
             

            }

          }else{

            if (horaselecte==0) {
             
              ObtenerListadoEspecialista3();
                 if (idespecialista!=undefined && idespecialista!='') {
              
               ObtenerEspecialista(idespecialista)
               .then(function(respuesta) {
                   SeleccionarEspecialista(idespecialista,respuesta);
               })
               .catch(function(error) {
                   console.log("Error en la solicitud AJAX:", error);
               });
               

              }
            }


          }
        }


        if (step==5) {
          var diferencia=detalle[5];
          ObtenerTiempo(diferencia); 

          valorseleccionado=diferencia;
          SeleccionarTiempo(valorseleccionado,'min');

          $("#btstep5").attr('onclick','VerificarCortesia()');
        }

        if (step==6) {

          ObtenerCortesias();
        }


        Pintardetalle();
    }

   function Pintardetalle() {
    var html="";
    if (detalle.length>0) {
     //$("#divdetalles").css('display','block');

     for (var i = 0; i < detalle.length; i++) { 
     console.log('impri '+detalle[i]);


       if (detalle[i]!=undefined && detalle[i]!='') {

if (typeof detalle[i] === 'string' && detalle[i].includes('|')) {

         separar=detalle[i].split('|');
       html+=separar[0]+'<span class="divintervalotiempo2">Tiempo'+separar[1]+'min.</span>'+' |';


         }else{
            if (i!=5) {
              html+=detalle[i]+'|';
            }

         
        }
        
       }
       
     }
    }

    $("#divdetalles").html(html);
   }

function goToPreviousStep() {
    if (currentStep >= 1) {
        currentStep--;
        showStep(currentStep);
        detalle.pop();
    }
}

function VerificarSiCategoriaTieneSub() {
  return new Promise((resolve, reject) => {

  var datos="idcategoriapaquete="+idcategoriapaquete;

  $.ajax({
          url:'catalogos/citas/VerificarSiCategoriaTieneSub.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
          data:datos,
          error:function(XMLHttpRequest, textStatus, errorThrown){
              var error;
              console.log(XMLHttpRequest);
              if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
              if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
              $('#abc').html('<div class="alert_error">'+error+'</div>'); 
              //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
            },
          success:function(msj){
                resolve(msj);
              }
          });

  });

}

function ColocarHora(argument) {
  
  var html=`
  <div class="row">
  <div class="col-md-4">
  </div>
    <div class="col-md-4">

  <div class="form-group">
                  <label>HORA INICIO:</label>
                    <div class="form-group mb-2" style="">
                      <input type="time" id="horai_s" class="form-control horainiciodiaselec" onkeyup="ValidarSiLlevavalor()">
                    </div>

                  </div>
          <div class="form-group">

             <label>HORA FIN:</label>
             <div class="form-group mb-2" style="">
              <input type="time" id="horaf_f" class="form-control horafindiaselec" onkeyup="ValidarSiLlevavalor()">
            </div>
          </div>
          </div>
           <div class="col-md-2">
        </div>
  `;

  $("#divhorarios").html(html);
}
      

function ValidarSiLlevavalor() {
   
    $("#btnstep3").css('display','none');
    $("#btnstep3").attr('onclick','');

   var horai_s=$("#horai_s").val();
   var horaf_f=$("#horaf_f").val();
 
   if (horai_s!='' && horaf_f!='') {
      $("#btstep3").css('display','block');
      $("#btstep3").attr('onclick','showStep(4);GuardarEnVariablesHoras()');

   }
 } 


 function GuardarEnVariablesHoras() {
   var horai_s=$("#horai_s").val();
   var horaf_f=$("#horaf_f").val();
   horainicials=horai_s;
   horafinals=horaf_f;
   var datos="horainicials="+horainicials+"&horafinals="+horafinals;


    $.ajax({
          url:'catalogos/citas/DiferenciaHora.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
          data:datos,
          error:function(XMLHttpRequest, textStatus, errorThrown){
              var error;
              console.log(XMLHttpRequest);
              if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
              if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
              $('#abc').html('<div class="alert_error">'+error+'</div>'); 
              //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
            },
          success:function(msj){
            var respuesta=msj.minutos;

            detalle[5]=respuesta;
            var separar=detalle[1].split('|');
            var uno=separar[0];
            var dos=respuesta;
            detalle[1]=uno+'|'+dos;

            detalle[3]=horainicials+'Hrs.';
            console.log(detalle);
            Pintardetalle();


              }
          });

 }
</script>
<!--  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> 

<script>
    $(document).ready(function () {
   

    });

    function ObtenerServicios1() {

         $.ajax({
          url:'catalogos/citas/ObtenerServicios.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
          error:function(XMLHttpRequest, textStatus, errorThrown){
              var error;
              console.log(XMLHttpRequest);
              if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
              if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
              $('#abc').html('<div class="alert_error">'+error+'</div>'); 
              //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
            },
          success:function(msj){
              var respuesta=msj.paquetes;
                serviciospaquete=respuesta;

              }
          });
    }

    function ObtenerCategorias1() {
      var datos="idcategoriapaquete="+idcategoriapaquete;
      $.ajax({
          url:'catalogos/citas/ObtenerCategorias.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
          data:datos,
          error:function(XMLHttpRequest, textStatus, errorThrown){
              var error;
              console.log(XMLHttpRequest);
              if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
              if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
              $('#abc').html('<div class="alert_error">'+error+'</div>'); 
              //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
            },
          success:function(msj){
              var respuesta=msj.categoriaspaquete;
              
              for (var i =0; i < respuesta.length; i++) {

              	categoriassub.push(respuesta[i].idcategoriapaquete);
              	
              	viewPaquetes(respuesta[i].idcategoriapaquete);
              	}
               // PintarCategoriasV(respuesta);
              }
          });
    }

   
    function PintarCategoriasV(respuesta) {
      
      var html="";
      if (respuesta.length>0) {

          for (var j = 0;j<respuesta.length ;j++) {
           
            var idcategoriapaquet=respuesta[j].idcategoriapaquete;
            var nombrecategoria=respuesta[j].nombre;
             funcion="AparecerSub("+idcategoriapaquet+",'"+nombrecategoria+"');AparecerServicios("+idcategoriapaquet+",'"+nombrecategoria+"');";
             $(".subcategorias").append(`<div  id="sub_`+idcategoriapaquet+`" class="row sub" style="display:none"></div>`);

            $(".servicios").append(`<div  id="servi_`+idcategoriapaquet+`" class="row servi" style="display:none;display: flex;
    justify-content: center;"></div>`);
            var foto = respuesta[j].ruta;

             html += `
                     <div class="tarjeta cambiarfuente faustina mx-2" id="tarjeta_${idcategoriapaquet}" onclick="`+funcion+`" style="width: 30%;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;">
                        </div>
                          <div class="card-body divcategoriaitem" id="divcategoriaitem_`+respuesta[j].idcategoriapaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                          <p style="margin: 0; text-align: center; color: white;">${respuesta[j].nombre}</p>
                                </div>
                            </div>
                        </div>`;

                      
                        if(respuesta[j].subcategorias.length>0){
                         viewsubcat(respuesta[j].subcategorias,respuesta[j].idcategoriapaquete);
                      }else{


                       viewPaquetes(respuesta[j].idcategoriapaquete);

                  }

           }

           $(".categorias").html(html);
        }
    }

    function viewsubcat(subcategorias,idcategoriapaque) {
     
      

        for (var i = 0; i <subcategorias.length; i++) {
          var idcategoriapaquete=subcategorias[i].idcategoriapaquete;

          var foto = subcategorias[i].ruta;

          $(".subcategorias").append(`<div id="sub_`+idcategoriapaquete+`" class="sub" style="display:none"></div>`);

           $(".servicios").append(`<div id="servi_`+idcategoriapaquete+`" class="row" style="display:none;    display: flex;
    justify-content: center;"></div>`);

          funcion="AparecerSub2("+idcategoriapaquete+");AparecerServicios("+idcategoriapaquete+");";
          html=`
              <div class="tarjeta cambiarfuente faustina mx-2" id="tarjeta_${idcategoriapaquete}" onclick="`+funcion+`" style="width: 30%;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;"></div>
                                <div class="card-body divcategoriaitem" id="divcategoriaitem_`+subcategorias[i].idcategoriapaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${subcategorias[i].nombre}</p>
                                </div>
                            </div>
                        </div>

          `;


                 if(subcategorias[i].subcategorias!=''){
                         viewsubcat(subcategorias[i].subcategorias,subcategorias[i].idcategoriapaquete);
                      }else{


                       viewPaquetes(subcategorias[i].idcategoriapaquete);

                  }


           $("#sub_"+idcategoriapaque).append(html);
         
        }

    }


    function viewPaquetes(idcategoriapaquete) {
      var html="";
     
     const elementosFiltrados = serviciospaquete.filter((elemento) => elemento.idcategoriapaquete == idcategoriapaquete);
      console.log(elementosFiltrados);
        if (elementosFiltrados.length>0) {

          for (var i = 0; i <elementosFiltrados.length; i++) {
          var tiempo = elementosFiltrados[i].intervaloservicio;

          if (elementosFiltrados[i].servicio==1) {
           funcion="SeleccionarServicio("+elementosFiltrados[i].idpaquete+","+elementosFiltrados[i].precioventa+",'"+elementosFiltrados[i].nombrepaquete+"','"+tiempo+"')";
         }else{

          funcion="SeleccionarProductoA("+elementosFiltrados[i].idpaquete+","+elementosFiltrados[i].precioventa+",'"+elementosFiltrados[i].nombrepaquete+"')";

         }

         var foto = elementosFiltrados[i].ruta;
         intervalotiempo="";
                        if (tiempo!=null && tiempo!='' && tiempo!=0) {
                intervalotiempo+=` <span class="divintervalotiempo">Tiempo ${tiempo}min.</span>`;

                        }else{

               		intervalotiempo+=`<span style="padding: 2px;border-radius: 5px;"></span>`;
    		
               }
         
           /* html=`
               <div class="tarjeta cambiarfuente faustina mx-2" id="tarjeta_${i}" onclick="`+funcion+`" style="width: 30%;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;">`

                        ;*/
                       /* intervalotiempo="";
                        if (tiempo!=null && tiempo!='') {
                           intervalotiempo+=` <span class="divintervalotiempo">Tiempo ${tiempo}min.</span>`;

                        }*/
                     
/*
                       html+=` </div>
                                <div class="card-body divcpaqueitem" id="divcpaqueitem_`+elementosFiltrados[i].idpaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${elementosFiltrados[i].nombrepaquete}
                                   <span class="preciopaqueteestilo2">$${elementosFiltrados[i].precioventa}</span>
                                    </p>

                                </div>
                            </div>
                        </div>

            `;*/

            html+=`
            <div class="pasuc_" id="elemento_`+elementosFiltrados[i].idpaquete+`">
            	<div class="row p-2 bg-white border  rounded" id="divcpaqueitem_`+elementosFiltrados[i].idpaquete+`" >
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}"></div>
                <div class="col-md-5 mt-1">
                    <h5>`+elementosFiltrados[i].nombrepaquete+`</h5>
                   <h4 class="mr-1">$${elementosFiltrados[i].precioventa}</h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+elementosFiltrados[i].nombrecat+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>
                    
                </div>
                <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        
                    </div>
                    <h6 class="text-success"></h6>
                    <div class="d-flex flex-column mt-4 align-items-center">
                   			
                   			<div class="row">
            <div class="input-group-prepend">
                    <button class="btn btn-primary" type="button" style=" " onclick="decrementpaquetemodal(`+elementosFiltrados[i].idpaquete+`)">-</button>
                  </div>
                  <input type="text" id="quantity_`+elementosFiltrados[i].idpaquete+`" class="form-control quantity_`+elementosFiltrados[i].idpaquete+`" style="border: none;width:40px;text-align:center;background: none;" value="0" readonly/>
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button" style=""onclick="incrementpaquetemodal(`+elementosFiltrados[i].idpaquete+`)">+</button>
                  </div>
        </div>

        <div class="row">
        	<button class="btn btn-primary " style="width: 100px;" type="button" onclick='AgregarVariable(`+JSON.stringify(elementosFiltrados[i])+`)'>Agregar
        	</button>
        </div>

                    </div>
                </div>
            </div>
</div>
            `;


          }
        }

       $(".servicios").append(html);

     
    }
    var nombrepaquete="";
    function SeleccionarServicio(idpaquete,costo,nombrepaquete,tiempo) {
      $(".divcpaqueitem").removeClass('activo');
      $("#divcpaqueitem_"+idpaquete).addClass('activo');
      idpaqueteseleccionado=idpaquete;
      costopaquete=costo;

       $(".btnstep1").css('display','block');
       $(".btnstep1").attr('onclick','showStep(2)');

       producto=0;
       var deta=detalle[1];

     if (deta!=undefined) {
      detalle[1]=nombrepaquete+'|'+tiempo;
      detalle[5]=tiempo;
     }else{

         detalle[1]=nombrepaquete+'|'+tiempo;
         detalle[5]=tiempo;
     }

     Pintardetalle();
     // nombrepaquete= $("#divcpaqueitem_"+idpaquete).text();

      //Agregaradetalle(nombrepaquete);
    }

    function ObtenerTodasCategorias() {
     
     $.ajax({
          url:'catalogos/citas/ObtenerTodasCategorias.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
          error:function(XMLHttpRequest, textStatus, errorThrown){
              var error;
              console.log(XMLHttpRequest);
              if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
              if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
              $('#abc').html('<div class="alert_error">'+error+'</div>'); 
              //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
            },
          success:function(msj){
              var respuesta=msj.categoriaspaquete;
              todascategorias=respuesta;
              console.log(todascategorias);
              }
          });
    }




function selectCategoryAndAncestors(categorias, categoriaId) {

  // Encontrar la categoría actual
  const categoria = todascategorias.find(cat => cat.idcategoriapaquete === categoriaId);
  console.log('entro');
  // Si la categoría se encuentra
  if (categoria) {

     console.log(categoria);
    // Seleccionar la categoría actual
    categoria.selected = true;
    $("#divcategoriaitem_"+categoria.idcategoriapaquete).addClass('activo');
    // Encontrar la categoría padre (abuelo)
    const categoriaPadre = categorias.find(cat => cat.idcategoriapaquete === categoria.iddepende);

    // Si hay una categoría padre
    if (categoriaPadre) {
      // Seleccionar la categoría padre
      categoriaPadre.selected = true;

      // Encontrar la categoría abuelo
      const categoriaAbuelo = categorias.find(cat => cat.idcategoriapaquete === categoriaPadre.iddepende);

      // Si hay una categoría abuelo
      if (categoriaAbuelo) {
        $("#divcategoriaitem_"+categoriaAbuelo.idcategoriapaquete).addClass('activo');
        // Seleccionar la categoría abuelo
        categoriaAbuelo.selected = true;
      }
    }
  }
}


 function AparecerSub2(idcategoriapaquete) {

      selectCategoryAndAncestors(todascategorias,idcategoriapaquete)

       todascategorias.forEach(item => {
        if (item.idcategoriapaquete ==idcategoriapaquete) {
            if (item.iddepende === '0') {
                categoryFound = item;
            
            } else {

              $("#sub_"+item.iddepende).css('display','');

                //categoryFound = findParentCategory(data, item.iddepende);
            }
        }
    });
    }
   
   function AparecerSub(idcategoriapaquete,nombresub) {

      //Agregaradetalle(nombresub);
       var nom=detalle[0];
       if (nom!=undefined) {
               detalle[0]=nom+nombresub;

              }else{
      detalle[0]=nombresub;         
              }


      $(".sub").css('display','none');
      $("#sub_"+idcategoriapaquete).css('display','');
      $(".divcategoriaitem").removeClass('activo');

      $("#divcategoriaitem_"+idcategoriapaquete).addClass('activo');
      //  selectCategoryAndAncestors(todascategorias,idcategoriapaquete);


     
    } 
  function AparecerServicios(idcategoriapaquete,nombreca){

   
   //Agregaradetalle(nombreca);

    $("#divheaderservicio").css('display','block');
   $(".servi").css('display','none');
   $("#servi_"+idcategoriapaquete).css('display','');


  }


function Agregaradetalle(valor) {
  
 console.log(valor);
  if (detalle.length>0) {
   var encontrado=0;
   for (var i = 0; i <detalle.length; i++) {
    if (detalle[i]==valor) {
     encontrado=1;
    }
   
    if (encontrado==0) {

      detalle.push(valor);

    }

   }
  }else{

   detalle.push(valor);
  }
}





var costopaquete=0;
function SeleccionarProductoA(idpaquete,costo,nombrepaquete) {

 idseleccionpaquete=idpaquete;
 costopaquete=costo;
 $(".divpaquete").removeClass('activo');
 $("#divpaquetes_"+idpaquete).addClass('activo');
 
    $(".divcpaqueitem").removeClass('activo');
      $("#divcpaqueitem_"+idpaquete).addClass('activo');
      idpaqueteseleccionado=idpaquete;
      costopaquete=costo;
       producto=1;

       $(".btnstep1").css('display','block');
       $(".btnstep1").attr('onclick','showStep(2)');

      nombrepaquete= $("#divcpaqueitem_"+idpaquete).text();
      var deta=detalle[1];

     if (deta!=undefined) {
      detalle[1]=nombrepaquete;
     
     }else{

     
         detalle[1]=nombrepaquete;
    
     }
      //detalle[1]=nombrepaquete;
 //Agregaradetalle(nombrepaquete);
}
var arraypaqueteseleccionado=[];
function AgregarVariable(variable) {

	var objeto=JSON.stringify(variable);

	console.log(JSON.parse(objeto));
	variable=JSON.parse(objeto);

	variable.formatofecha='';
    variable.hora='';
    variable.barbero='';
    variable.idespecialista=0;
    variable.fecha="";
    variable.tiempo="";
    variable.key="";

	var idpaquete=variable.idpaquete;
	var cantidad=$(".quantity_"+idpaquete).val();

	var variablecantidad=parseFloat(variable.cantidad)+parseFloat(cantidad);

	variable.cantidad=variablecantidad;
	
	if (cantidad>0) {
	if (arraypaqueteseleccionado.length>0) {
		encontrado=0;
		for (var i = 0; i <arraypaqueteseleccionado.length; i++) {
			
			if (arraypaqueteseleccionado[i].idpaquete==variable.idpaquete) {

				var c= parseFloat(arraypaqueteseleccionado[i].cantidad)+parseFloat(cantidad);

				arraypaqueteseleccionado[i].cantidad=c;


				encontrado=1;
				break;
			}

		}


		if (encontrado==0) {

			arraypaqueteseleccionado.push(variable);

		}
	}else{


			arraypaqueteseleccionado.push(variable);

		}

		

	}else{
		encontrado=0;
		for (var i = 0; i <arraypaqueteseleccionado.length; i++) {

			if (arraypaqueteseleccionado[i].idpaquete==variable.idpaquete) {
				arraypaqueteseleccionado.splice(i, 1); // 1 es la cantidad de elemento a eliminar


			}
			
		}


				//alert('Se eliminó el paquete');

	}


	PintarProductosSeleccionados(arraypaqueteseleccionado);
}


function PintarProductosSeleccionados(arraypaqueteseleccionado) {
	var html="";

	if (arraypaqueteseleccionado.length>0) {
		for (var i = 0; i < arraypaqueteseleccionado.length; i++) {
			 var tiempo = arraypaqueteseleccionado[i].intervaloservicio;
			 var foto = arraypaqueteseleccionado[i].ruta;
        	 intervalotiempo="";
               if (tiempo!=null && tiempo!='' && tiempo!=0) {
                	intervalotiempo+=` <span class="divintervalotiempo">Tiempo ${tiempo}min.</span>`;

               }else{

               	intervalotiempo+=`<span style="padding: 2px;border-radius: 5px;">
    		</span>`;

               }
         
          

            html+=`
            	<div class="row p-2 bg-white border rounded" id="divcpaqueitem_`+arraypaqueteseleccionado[i].idpaquete+`" >
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}"></div>
                <div class="col-md-5 mt-1">
                    <h5>`+arraypaqueteseleccionado[i].nombrepaquete+`</h5>
                   <h4 class="mr-1">$${arraypaqueteseleccionado[i].precioventa}</h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+arraypaqueteseleccionado[i].nombrecat+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>
                    
                </div>
                <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        
                    </div>
                    <h6 class="text-success"></h6>
                    <div class="d-flex flex-column mt-4 align-items-center">
                   			
                   			<div class="row">
            
                `+arraypaqueteseleccionado[i].cantidad+`
                 	
        </div>

        <div class="row">
        	<button class="btn btn_rojo " style="width: 100px;" type="button" onclick='EliminarVariable(`+JSON.stringify(arraypaqueteseleccionado[i])+`)'>Eliminar
        	</button>

        	

        </div>

                    </div>
                </div>
            </div>

            `;


		}


		html+=`
		<div class="row " style="    padding: 0px!important;" >
		<div class="col-md-12" style="padding:0;margin:0;">
			<button type="button" class="btn  btn-success btn-lg btn-block" style="width:100%;margin-top:10px;" id="btstep1" onclick="showStep(2)" >CONTINUAR</button>
			<div>
		</div>

		`;
	}

	$(".paquetesseleccionados").html(html);
}



function EliminarVariable(variable) {
	
	encontrado=0;
		for (var i = 0; i <arraypaqueteseleccionado.length; i++) {

			if (arraypaqueteseleccionado[i].idpaquete==variable.idpaquete) {
				arraypaqueteseleccionado.splice(i, 1); // 1 es la cantidad de elemento a eliminar


			}
			
		}
PintarProductosSeleccionados(arraypaqueteseleccionado);
PintarProductosSeleccionadosStep2();
}
var objetosproductos=[];
function PintarProductosSeleccionadosStepAnte() {
	

	var html="";

	if (arraypaqueteseleccionado.length>0) {
		for (var i = 0; i < arraypaqueteseleccionado.length; i++) {
			 var tiempo = arraypaqueteseleccionado[i].intervaloservicio;
			 var foto = arraypaqueteseleccionado[i].ruta;
        	 intervalotiempo="";
               if (tiempo!=null && tiempo!='') {
                	intervalotiempo+=` <span class="divintervalotiempo">Tiempo ${tiempo}min.</span>`;

               }else{

               	intervalotiempo+=`<span style="padding: 2px;border-radius: 5px;">
    		</span>`;

               }
         
          	if (arraypaqueteseleccionado[i].servicio==1) {
          	for (var j = 0; j <arraypaqueteseleccionado[i].cantidad; j++) {
          		console.log('entro'+j);
          	

            html=`
            	<div class="row p-2 bg-white border rounded" id="divcpaqueitem_`+arraypaqueteseleccionado[i].idpaquete+`" >
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}"></div>
                <div class="col-md-5 mt-1">
                    <h5>`+arraypaqueteseleccionado[i].nombrepaquete+`</h5>
                   <h4 class="mr-1">$${arraypaqueteseleccionado[i].precioventa}</h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+arraypaqueteseleccionado[i].nombrecat+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>
                    
                </div>
                <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        
                    </div>
                    <h6 class="text-success"></h6>
                    <div class="d-flex flex-column mt-4 align-items-center">
                   			
                   			<div class="row">
            
               
                 	
        </div>

        <div class="row">
        	<button class="btn btn_rojo " style="width: 100px;" type="button" onclick='EliminarVariable(`+JSON.stringify(arraypaqueteseleccionado[i])+`)'>Eliminar
        	</button>


        	
        </div>

                    </div>
                </div>
            </div>

            `;

            	}

		}else{


			 html=`
            	<div class="row p-2 bg-white border rounded" id="divcpaqueitem_`+arraypaqueteseleccionado[i].idpaquete+`" >
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}"></div>
                <div class="col-md-5 mt-1">
                    <h5>`+arraypaqueteseleccionado[i].nombrepaquete+`</h5>
                   <h4 class="mr-1">$${arraypaqueteseleccionado[i].precioventa}</h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+arraypaqueteseleccionado[i].nombrecat+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>

                    <p>
                    	
                    </p>
                    
                </div>
                <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        
                    </div>
                    <h6 class="text-success"></h6>
                    <div class="d-flex flex-column mt-4 align-items-center">
                   			
                   			<div class="row">
            
               
                 	
        </div>

        <div class="row">
        	<button class="btn btn-primary " style="width: 100px;" type="button" onclick='EliminarVariable(`+JSON.stringify(arraypaqueteseleccionado[i])+`)'>Eliminar
        	</button>
        </div>

                    </div>
                </div>
            </div>

            `;
		}


	}
}

	$(".listadopaquetes").html(html);


}


var arraypaqueteseleccionadocreado=[];
function PintarProductosSeleccionadosStep2() {
    var html = "";
    var i,j;
    var cargodatos=0;
    arraypaqueteseleccionadocreado=[];
       $(".listadopaquetes").html('');
       console.log(arraypaqueteseleccionado);
    if (arraypaqueteseleccionado.length > 0) {
        for (var i = 0; i < arraypaqueteseleccionado.length; i++) {

        	intervalotiempo += `<span style="padding: 2px;border-radius: 5px;"></span>`;
        	

        	var html = "";
            var tiempo = arraypaqueteseleccionado[i].intervaloservicio;
            var foto = arraypaqueteseleccionado[i].ruta;
            var intervalotiempo = "";
            var dates=[];
           

            if (arraypaqueteseleccionado[i].servicio == 1) {
            	contador=0;
                for (var j = 0; j < arraypaqueteseleccionado[i].cantidad; j++) {

               console.log('entro'+j);

                	 if (tiempo != null && tiempo !== '') {
                intervalotiempo = `<span class="divintervalotiempo"><span style="margin-right: 2px">Tiempo</span><span id="divintervalotiempo_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`"> ${tiempo}</span>min.
                </span>`;
            } else {
                intervalotiempo = `<span style="padding: 2px;border-radius: 5px;"></span>`;
            }
                	
                	var key='';
             if (j==0) {
             	  key=arraypaqueteseleccionado[i].idpaquete+`_`+i+`_0`;
             	    arraypaqueteseleccionado[i].key=key;

             	    // arraypaqueteseleccionadocreado.push(arraypaqueteseleccionado[i]);
             	     
             	}else{

             	  key=arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j;
             	    arraypaqueteseleccionado[i].key=key;

             	     
             	}
           
             	 arraypaqueteseleccionadocreado.push({ ...arraypaqueteseleccionado[i] });
         	console.log('aq');
           console.log(arraypaqueteseleccionadocreado);
                	

				//for (var k = 0; k < 5; k++) {
				  // currentDate.setDate(currentDate.getDate());
   					// var dates = generateDateRange(currentDate, 5);
    					
				//}


                html=`
            	<div class="row p-2 bg-white border rounded" id="divcpaqueitem_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`" >
                <div class="col-md-3 mt-1">
                <div class="row">
                <div class="col-md-12">
                <img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}">
                </div>
                <div class="col-md-12">

                  <div style="justify-content: center; display: flex;">

                  <span class="mdi mdi-check-circle" id="divsucces_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`" style="display:none;font-size: 40px;color: #5ab75d;">
                  </span>

                    <span class="mdi mdi-close-circle" id="diverror_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`" style="display:none;font-size: 40px;color: red;">
                    </span>

                     </div>

                  </div>
                </div>

                </div>
                <div class="col-md-6 mt-1">
                    <h5>`+arraypaqueteseleccionado[i].nombrepaquete+`</h5>
                   <h4 class="mr-1">`;

                 html+=`<span> $${arraypaqueteseleccionado[i].precioventa}</span>`;


                  html+=` </h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+arraypaqueteseleccionado[i].nombrecat+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>

                     <p class="text-justify text-truncate  mb-0" style="display:none;" id="parrafofecha_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`">
                   	Fecha: <span id="fecha_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`"></span>
                    </p>

                    <p class="text-justify text-truncate  mb-0" style="display:none;" id="parrafohora_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`">
                   	Hora: <span id="hora_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`"></span>
                    </p>

                    <p class="text-justify text-truncate  mb-0" style="display:none;" id="parrafobarbero_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`">
                   	Barbero: <span id="barbero_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`"></span>
                    </p>


                    <p class="text-justify text-truncate  mb-0" style="" id="">
                   
                    </p>

                    <div id="info_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`">
                    <div style="margin-top:10px;" id="date-carousel_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`"></div>
                    <div class="row">
                     <div class="col-md-12">

	                    <div class=" btn-group-toggle " data-toggle="buttons" id="carrusel_horarios_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`" style="">
	                    

	                     </div>
	                     </div>
                     </div>

                     <div class="row">
                     	<div class="col-md-12">

                     		<div class=" btn-group-toggle " data-toggle="buttons" id="seleccionarduracion_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`">
                     		 </div>

                     	</div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">

                     <div class="seleccionarbarbero_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`" style=""></div>
                     	</div>

                     </div>

                     <div class="row" >
                     <div class="col-md-12">
                     <button type="button" id="btnconfirmar`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`" style="display:none;    float: right;margin-right: 25px;" onclick="ConfirmarStep2(`+arraypaqueteseleccionado[i].idpaquete+`,`+i+`,`+j+`)" class="btn btn-primary ">Guardar</button>
                     </div>
                    </div>
                </div>

                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        
                    </div>
                    <h6 class="text-success"></h6>
                    <div class="d-flex flex-column mt-4 align-items-center">
                   			
                   			<div class="row">
            
               
                 	
        </div>

        <div class="row">
        	<button class="btn btn_rojo " style="width: 100px;" id="btneliminar`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`"" type="button" onclick='EliminarPaquete(`+arraypaqueteseleccionado[i].idpaquete+`,`+i+`,`+j+`)'>Eliminar
        	</button>

        	<button class="btn btn_colorgray " style="width: 100px;display:none;" id="btneditar`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_`+j+`" type="button" onclick='EditarPaquete(`+arraypaqueteseleccionado[i].idpaquete+`,`+i+`,`+j+`)'>Editar
        	</button>
        </div>

                    </div>
                </div>
            </div>

            `;
       
         		 $(".listadopaquetes").append(html);
         	 f_paquete="";
         

           if (arraypaqueteseleccionado[i].servicio == 1) {
           
          
            configureAndActivateCarousel(`date-carousel_${arraypaqueteseleccionado[i].idpaquete}_${i}_${j}`, dates);
                  
           
              if(contador==0 && cargodatos==0){
                 
               if(horaselecte!='' && fechaselecte2!='' ){

                 

                  var llave=arraypaqueteseleccionado[i].idpaquete+'_'+i+'_'+j;

                  cargodatos=1;
                    Cargardatos(fechaselecte2,horaselecte,idespecialista,llave);
                  }
               }

                contador++;

        	     	}


               }

            } else {
                // Código para el caso en que el servicio no sea igual a 1
                // (sin el bucle interno)
                  html=`
            	<div class="row p-2 bg-white border rounded" id="divcpaqueitem_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_0" >
                <div class="col-md-3 mt-1">
                  <div class="row">
                  <div class="col-md-12">
                  <img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}">
                </div>
                <div class="col-md-12">
                  <div style="justify-content: center; display: flex;">
                  <span class="mdi mdi-check-circle" id="divsucces_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_0" style="font-size: 40px;color: #5ab75d;display:none;">
                  </span>

                  <span class="mdi mdi-close-circle" id="diverror_`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_0" style="display:none;font-size: 40px;color: red;">
                  </span>

                 
                </div>

                </div>
                  </div>

                </div>
                <div class="col-md-5 mt-1">
                    <h5>`+arraypaqueteseleccionado[i].nombrepaquete+`</h5>
                   <h4 class="mr-1">`;
                
                   if (arraypaqueteseleccionado[i].servicio==0) {

                   	html+=`<span>${arraypaqueteseleccionado[i].cantidad}</span>x`;
                   }
                 html+=`<span>$${arraypaqueteseleccionado[i].precioventa}</span>`;


                  html+=` </h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+arraypaqueteseleccionado[i].nombrecat+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>
                    
                </div>
                <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        
                    </div>
                    <h6 class="text-success"></h6>
                    <div class="d-flex flex-column mt-4 align-items-center">
                   			
                   	<div class="row">
            
               
                 	
        			</div>

        <div class="row">
        	<button class="btn btn_rojo " style="width: 100px;" id="btneliminar`+arraypaqueteseleccionado[i].idpaquete+`_`+i+`_0"" type="button" onclick='EliminarPaquete(`+arraypaqueteseleccionado[i].idpaquete+`,`+i+`,0)'>Eliminar
        	</button>
        </div>

                    </div>
                </div>
            </div>

            `;

             arraypaqueteseleccionado[i].key=arraypaqueteseleccionado[i].idpaquete+'_'+i+'_0';

             arraypaqueteseleccionadocreado.push(arraypaqueteseleccionado[i]);

             $(".listadopaquetes").append(html);
            }

          
        }


        
    }
    console.log('creando nuevo');
    console.log(arraypaqueteseleccionadocreado);


    

    

}

function Cargardatos(fechaselecte2,horaselecte,idespecialista,llave) {
  console.log('cargando datos..'+llave);
 
 // Obtener la referencia a la tabla
var contenedor = document.querySelector('.date-carousel_' + llave + '_wrapper');
// Obtener la tabla dentro del div contenedor
var tabla = contenedor.querySelector('.rescalendar_controls');
// Obtener todas las celdas de datos en la tabla
var input = tabla.querySelector('.refDate');
// Cambiar el valor del input
input.value = convertirFormatoFechadiamesanio(fechaselecte2);
cellDate=convertirFormatoFechadiamesanio(fechaselecte2);




const promiseA = new Promise((resolutionFunc, rejectionFunc) => {

  resolutionFunc(ObtenerHorariosStep2(cellDate,llave));
});
// En este punto, "promiseA" ya está resuelto.
promiseA.then((val) => {
  console.log($(".horariossele_"+llave));
  var dividir=horaselecte.split('_');
  setTimeout(() => {
 
      var i=0;
      $(".horariossele_"+llave).each(function( index) {
      

      if ($(this).data('hora')==dividir[0]) {

         var id=$(this).attr('id');
         var valordata2=$(this).attr('data-horafinal');
         

        SeleccionarHorario1(dividir[0],valordata2,0,llave);

        $(this).addClass('active');

        return 0;
      }
      i++;

  });

}, "1000");


  setTimeout(() => {

      $(".especialistalista_"+llave).each(function( index) {

        var id=$(this).attr('id');
        var dividir=id.split('_')[1];

        if (dividir==idespecialista) {
            var elementoPadre = document.getElementById(id);

        // Obtener el elemento dos hijos abajo
           var elementoDeseado = elementoPadre.querySelector('div > div').innerText;
           SeleccionarEspecialista(idespecialista,elementoDeseado,llave);

            $(this).addClass('active');

        }



      })
    
        


    }, "1000");


  setTimeout(() => {

    var dividir=llave.split('_');

  ConfirmarStep2(dividir[0],dividir[1],dividir[2]);
 

 }, "1000");

  

});







}

function fechaactual() {
	// Obtén la fecha actual
var fechaActual = new Date();

// Obtiene el día, mes y año
var dia = fechaActual.getDate();
var mes = fechaActual.getMonth() + 1; // Los meses comienzan desde 0, así que sumamos 1
var año = fechaActual.getFullYear();

// Formatea la fecha como 'dd/mm/yyyy'
var fechaFormateada = (dia < 10 ? '0' : '') + dia + '/' + (mes < 10 ? '0' : '') + mes + '/' + año;
	return fechaFormateada;
}

function configureAndActivateCarousel(idelemento) {


	fecha=fechaactual();

	 $('#'+idelemento).rescalendar({
                    id: idelemento,
                    format: 'DD/MM/YYYY',
                    jumpSize: 1,
                    locale: 'es',
                    refDate: fecha,
                    lang: {
                        'today': 'Hoy',
                        'init_error': 'Error al inicializar',
                        'no_data_error' : 'No se encontraron datos para mostrar'
                    },

                    data: [
                        
                    ],

                    dataKeyField: 'name',
                    dataKeyValues: ['', '', '']

                });



}


function ObtenerHorariosStep2(celldate,cellpaquete) {
	

	var idpaquete=cellpaquete.split('_')[0];
		
	var fechaFormateada = convertirFormatoFecha(celldate);

	for (var i = 0; i <arraypaqueteseleccionadocreado.length; i++) {

		if (arraypaqueteseleccionadocreado[i].key==cellpaquete) {
				arraypaqueteseleccionadocreado[i].fecha=fechaFormateada;
		}
	

	}

	fechaseleccionada=fechaFormateada;
	var datos="fecha="+fechaFormateada+"&idsucursal="+0+"&idpaquete="+idpaquete;
 
	var pagina="ObtenerDisponibilidadPaqueteEspecialista.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
		data:datos,
		success: function(msj){
			horarioseleccionado=0;
			
				var intervalos=msj.intervalos;
				PintarIntervalos3(intervalos,cellpaquete);
					

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}


function PintarIntervalos3(respuesta,cellpaquete) {

	$(`#carrusel_horarios_${cellpaquete}`).html('');

	
	

if ($(`#carrusel_horarios_${cellpaquete}`).hasClass('slick-initialized')) {
    // Si existe, destruye la instancia
    $(`#carrusel_horarios_${cellpaquete}`).slick('unslick');
}

	 $(`#carrusel_horarios_${cellpaquete}`).slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
            prevArrow: '<button type="button" class="btn " style="    float: left;margin-top: 10px;    margin-right: 15px;"><</button>',
        nextArrow: '<button type="button" class="btn" style="    float: left;margin-top: 10px;margin-left: 10px;">></button>',
        // Agrega otras configuraciones según tus necesidades
    });

		var html="";
	
		if (respuesta.length>0) {
			for (var i = 0; i < respuesta.length; i++) {
					
				html=`
				<label class="btn btn_dorado btncategointervalo1_`+cellpaquete+` horariossele_`+cellpaquete+`"  data-hora="`+respuesta[i].horainicial+`" data-horafinal="`+respuesta[i].horafinal+`" id="catebtn_`+i+cellpaquete+`" style="margin: 1px;width: 90px;margin-top: 10px;">
				 <input type="checkbox" id="cate_`+i+`" class="catecheck" style="display:none;" onchange="SeleccionarHorario1('`+respuesta[i].horainicial+`','`+respuesta[i].horafinal+`','`+i+`','`+cellpaquete+`')" value="0" >`+respuesta[i].horainicial+`
				</label>
				
				`;
		
		
		 $(`#carrusel_horarios_${cellpaquete}`).slick('slickAdd', `<div>`+html+`</div>`);
	 	}

	 	$(`#carrusel_horarios_${cellpaquete}`).find('.slick-list.draggable').css({
		    width: '300px', // Establece el ancho deseado
		    height: '60px', // Establece la altura deseada
		    float:'left',
		});

	


		

	 	// html += `</div>`;

	//$("#horarios_"+cellpaquete).html(html);

	

	//  $(`#horarios_${cellpaquete}`).html(html);

   

 	 //$(`#horarios_${cellpaquete}`).html(html);

    
	}

}

function convertirFormatoFecha(fechaOriginal) {
    // Dividir la fecha en día, mes y año
    var partesFecha = fechaOriginal.split('/');
    var dia = partesFecha[0];
    var mes = partesFecha[1];
    var año = partesFecha[2];

    // Crear un objeto Date con el nuevo formato
    var fechaFormateada = new Date(`${año}-${mes}-${dia}`);

    // Obtener la fecha en formato "yyyy-mm-dd"
    var fechaString = fechaFormateada.toISOString().split('T')[0];

    return fechaString;
}
function convertirFormatoFechadiamesanio(fechaOriginal) {
    // Dividir la fecha en día, mes y año
    var partesFecha = fechaOriginal.split('/');
    var dia = partesFecha[0];
    var mes = partesFecha[1];
    var año = partesFecha[2];

    // Crear un objeto Date con el nuevo formato
    var fechaFormateada = new Date(`${año}-${mes}-${dia}`);

    // Obtener la fecha en formato "día/mes/año"
    var diaFormateado = fechaFormateada.getDate();
    var mesFormateado = fechaFormateada.getMonth() + 1; // Se suma 1 porque los meses en JavaScript van de 0 a 11
    var añoFormateado = fechaFormateada.getFullYear();

    // Agregar ceros a la izquierda si es necesario
    diaFormateado = diaFormateado < 10 ? '0' + diaFormateado : diaFormateado;
    mesFormateado = mesFormateado < 10 ? '0' + mesFormateado : mesFormateado;

    // Obtener la fecha en formato "día/mes/año"
    var fechaString = `${diaFormateado}/${mesFormateado}/${añoFormateado}`;

    return fechaString;
}


function ConfirmarStep2(idpaquete,i,j) {
	
	$("#info_"+idpaquete+"_"+i+"_"+j).css('display','none');
			cellpaquete=idpaquete+'_'+i+'_'+j;
	$("#btneditar"+idpaquete+`_`+i+`_`+j).css('display','block');

	console.log(arraypaqueteseleccionadocreado);
	//alert('confirm'+cellpaquete);
	for (var i = 0; i < arraypaqueteseleccionadocreado.length; i++) {
		console.log(arraypaqueteseleccionadocreado[i].key +'=='+ cellpaquete);

		if (arraypaqueteseleccionadocreado[i].key == cellpaquete) {

			//alert('confirm2'+cellpaquete);

		

			$("#parrafofecha_"+cellpaquete).css('display','block');
			$("#parrafohora_"+cellpaquete).css('display','block');
			$("#parrafobarbero_"+cellpaquete).css('display','block');

			fecha=arraypaqueteseleccionadocreado[i].fecha;
			hora=arraypaqueteseleccionadocreado[i].hora.split('_')[0];
			barbero=arraypaqueteseleccionadocreado[i].barbero;

			// Ejemplo de uso:

			fechaformato(fecha, function(fechaFormateada) {
			    $("#fecha_"+cellpaquete).text(fechaFormateada);
			    // Puedes hacer algo con la fecha formateada aquí
			});

			
			$("#hora_"+cellpaquete).text(hora);
			$("#barbero_"+cellpaquete).text(barbero);
			break;
		}
	}

  Validacionpaquetes();
}

function EditarPaquete(idpaquete,i,j) {

		cellpaquete=idpaquete+'_'+i+'_'+j;

		$("#parrafofecha_"+cellpaquete).css('display','none');
		$("#parrafohora_"+cellpaquete).css('display','none');
		$("#parrafobarbero_"+cellpaquete).css('display','none');


    $("#divsucces_"+idpaquete+"_"+i+"_"+j).css('display','none');
    $("#diverror_"+idpaquete+"_"+i+"_"+j).css('display','none');
	
  $("#info_"+idpaquete+"_"+i+"_"+j).css('display','block');

$("#btneditar"+idpaquete+`_`+i+`_`+j).css('display','none');
}
function  EliminarPaquete(idpaquete,i,j) {
	cellpaquete=idpaquete+'_'+i+'_'+j;

		$("#divcpaqueitem_"+cellpaquete).remove();
	
		for (var i = 0; i <arraypaqueteseleccionadocreado.length; i++) {

			if (arraypaqueteseleccionadocreado[i].key==cellpaquete) {
				arraypaqueteseleccionado.splice(i, 1); // 1 es la cantidad de elemento a eliminar
				break;

			}
			
		}
}

// Función para generar un rango de fechas con un paso específico y una cantidad específica
/*function generateDateRange(startDate, quantity, ) {
    const dateRange = [];

    for (let i = 0; i < quantity; i++) {
        const currentDate = new Date(startDate);
        currentDate.setDate(startDate.getDate() + i );

        dateRange.push(currentDate.toISOString()); // Convertir a cadena ISO para evitar problemas de formato
    }

    return dateRange;
}*/

// Función para configurar y activar el carrusel
/*function configureAndActivateCarousel(carouselSelector, dates) {
	
    $(document).ready(function(){
        $(carouselSelector).slick({
            slidesToShow: 3, // Número de fechas visibles en un momento dado
            slidesToScroll: 1,
            infinite: false,

            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        console.log(dates);
        // Agregar las fechas al carrusel
        dates.forEach(date => {
            const formattedDate = date;
            $(carouselSelector).slick('slickAdd', `<div>${formattedDate}</div>`);
        });
    });
}*/
// Seleccionar la categoría con idcategoriapaquete 20
//selectCategoryAndAncestors(categorias, "20");

  // Función para dar formato a la fecha
  /*function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('es', options);
  }*/


</script>
 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <style>
        .tarjeta {
            width: 100%;
            cursor: pointer;
        }

        .tarjeta:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .tar {
            border-radius: 10px;
        }

        

        .tar-body {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 50px;
            background: #C7AA6A;
            font-size: 18px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>

<style>
 

 .picker4 table {
  /*  border-collapse: collapse;*/
    table-layout: fixed;
    width:100%;
/*    box-shadow: 0px 0px 1px rgba(0,0,0,0.2);
*/    background-color: #fff;
    position: relative;
    top: 0;
    left: 0;
    transform: translateX(0);
    transition: all 0.3s ease;

}

.fc-day-top .fc-mon .fc-past{
justify-content: center; 
display: flex;
}


.fc-toolbar {
    text-align: center;
}
.fc-toolbar .fc-left {
    float: left;
}

.fc .fc-toolbar > * > :first-child {
    margin-left: 0;
}

.fc-state-default.fc-corner-left {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.fc-icon {
    display: inline-block;
    height: 1em;
    line-height: 1em;
    font-size: 1em;
    text-align: center;
    overflow: hidden;
    font-family: "Courier New", Courier, monospace;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.fc .fc-button-group > * {
    float: left;
    margin: 0 0 0 -1px;
}

.fc-toolbar .fc-right {
    float: right;
}

.fc-toolbar .fc-center {
    display: inline-block;
}

.fc button {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0;
    height: 2.1em;
    padding: 0 0.6em;
    font-size: 1em;
    white-space: nowrap;
    cursor: pointer;
}

.fc-state-default.fc-corner-right {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

.fc-state-default.fc-corner-left {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.fc-rigid{
 height: 30px!important;
}
.fc-day-grid-container {
 height:auto!important;
}
.fc-day-top .fc-day-number{
margin: 5em!important!;
}

.fc-day-header{
text-align: center;

 }
 .fc-day-top{
text-align: center!important;

 }
 
.fc-state-default {
    background-color: #f5f5f5;
    background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
    background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
    background-repeat: repeat-x;
    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    color: #333;
    text-shadow: 0 1px 1px rgb(255 255 255 / 75%);
    box-shadow: inset 0 1px 0 rgb(255 255 255 / 20%), 0 1px 2px rgb(0 0 0 / 5%);
}

.fc button .fc-icon {
    position: relative;
    top: -0.05em;
    margin: 0 0.2em;
    vertical-align: middle;
}

.fc-icon-left-single-arrow:after {
    content: "\2039";
    font-weight: bold;
    font-size: 100%;
    top: -7%;
}

.fc-icon-right-single-arrow:after {
    content: "\203A";
    font-weight: bold;
    font-size: 100%;
    top: -7%;
}

/*.fc-button-group{
 display: none;
}*/
.fc-today-button{
 display: none;
}
.fc-day-header{
    background: black;
    color: white;
    height: 40px;
}

.fc .fc-row .fc-content-skeleton table, .fc .fc-row .fc-content-skeleton td, .fc .fc-row .fc-helper-skeleton td {
    background: none;
    border-color: transparent;
}

.fc-day-top.fc-other-month {
    opacity: 0.3;
}

.fc-row .fc-content-skeleton td, .fc-row .fc-helper-skeleton td {
    border-bottom: 0;
}

.fc-header-toolbar{

 background:#007aff;
    color: white;
}
.fc-left{
 margin-top: 1em;
    margin-left: 1em;
}
.fc-right{
 margin-top: 1em;
    margin-right: 1em;
}
.fc-center h2{

 margin-top: .3em;
}

.fc-corner-left{
     justify-content: center;
    /* display: block; */
    width: 20%;
    float: left;
    font-size: 30px;
    text-align: center;
    height: 35px;

}

.fc-corner-right{
 justify-content: right;
    display: flow-root;
    width: 20%;
    /* float: right; */
    font-size: 30px;
    text-align: center;
    height: 35px;
}


.fc-button-prev{
cursor: pointer;
width: 50px;
    height: 30px;
}
.fc-button-next{
cursor: pointer;
width: 50px;
    height: 30px;

}
.fc-border-separate tbody tr.fc-first td, .fc-border-separate tbody tr.fc-first th {
    border-top-width: 0;
}

.fc-border-separate td, .fc-border-separate th {
    border-width: 1px 0 0 1px;
}

.fc-grid .fc-other-month .fc-day-number {
    opacity: .3;
    filter: alpha(opacity=30);
}

.fc-grid .fc-day-number {
    /*float: right;*/
    /*padding: 0 2px;*/
    text-align: center;
}
.fc-header-title{
  text-align: center;
}

.fc-day .fc-sun .fc-widget-content .fc-other-month .fc-past .fc-first
{
    display: flex;
    justify-content: center;
}

.fc-day .fc-mon .fc-widget-content {
display: flex;
    justify-content: center;

}

.fc-week .fc-first > div{

 min-height: 20px!important;
}
.fc-header-right{
      display: flex;
    justify-content: end;
}

.fc-grid .fc-other-month .fc-day-number {
   
   /* margin: 25px;*/
}

.fc-week .fc-first > div {
    min-height: 35px!important;
}

.fc-grid .fc-day-number {
    /* float: right; */
    padding: 10px 2px;
    text-align: center;
}

.fc-border-separate td, .fc-border-separate th {
    border-width: 1px 0 0 1px;
    border: 1px solid #eaebf1;
}

.divintervalotiempo{
  
    top: 80px;
    right: 0;
    background: #9c9c9c;
    color: white;
    padding: 2px;
    border-radius: 5px;
}


.divintervalotiempo2{
    top: 80px;
    right: 0;
    background: red;
    color: white;
    padding: 2px;
    border-radius: 5px;
}
</style>

<script>
 

  function PintarHoraSeleccionadaA(fecha) {
 
 fechaseleccionada=fecha;
 var datos="fecha="+fecha+"&idsucursal="+idsucursal+"&idpaquete="+idpaqueteseleccionado;
 
 var pagina="ObtenerDisponibilidadPaqueteEspecialista.php";
  $.ajax({
  type: 'POST',
  dataType: 'json',
  url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
  data:datos,
  async:false,
  success: function(msj){
   horarioseleccionado=0;
   
    var intervalos=msj.intervalos;
    PintarIntervalos2(intervalos);
    VerificarSiLlevavalor();   

   },error: function(XMLHttpRequest, textStatus, errorThrown){ 
    var error;
       if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
       if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
        //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
     console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
   }
  });

}


function SeleccionarHorario1(horainicial,horafinal,i,cellpaquete) {
 
  $(".horariossele_"+cellpaquete+"").removeClass('active');

  $("#catebtn_"+i+cellpaquete).add('active');
  horainicialsele=horainicial;
  horafinalsele=horafinal;
  horarioseleccionado=horainicialsele+'_'+horafinalsele;
  detalle[3]=horainicialsele+'Hrs.';
             Pintardetalle();

   var tiempo=0;
   for (var i = 0; i <arraypaqueteseleccionadocreado.length; i++) {

   	if (arraypaqueteseleccionadocreado[i].key==cellpaquete) {
		arraypaqueteseleccionadocreado[i].hora=horarioseleccionado;
		tiempo=arraypaqueteseleccionadocreado[i].intervaloservicio;


		arraypaqueteseleccionadocreado[i].barbero='';

		arraypaqueteseleccionadocreado[i].idespecialista='';
		$(".especialistalista_"+cellpaquete).removeClass('active');
		}
		
	}

  //Agregaradetalle(horainicialsele);
//horaseleccionada=arrayhorarios[posicion];

   //HabilitarBoton2();
//aqui

	ObtenerTiempo(cellpaquete,tiempo);
  idespecialistaseleccionado="";
  ObtenerListadoEspecialista2(cellpaquete);
   $("#btstep3").css('display','block');

   $("#btstep3").attr('onclick','showStep(4)');

}




function ObtenerListadoEspecialista2(cellpaquete) {
 
	idpaqueteseleccionado=cellpaquete.split('_')[0];

    var horario=horainicialsele+'_'+horafinalsele;
    var datos='idsucursal='+idsucursal+"&idpaquete="+idpaqueteseleccionado+"&horaseleccionada="+horario+"&fecha="+fechaseleccionada;
    var pagina = "ObtenerEspecialistaPaqueteSucursal.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(datos){
      var especialistas=datos.especialista;
      
      PintarDetalleEspecialistas(especialistas,cellpaquete);
     // PintarDetalleEspecialistas2(especialistas);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

}

function ObtenerListadoEspecialista3() {
 

    var horario=horainicialsele+'_'+horafinalsele;
    var datos='idsucursal='+idsucursal+"&idpaquete="+idpaqueteseleccionado+"&horaseleccionada="+horario+"&fecha="+fechaseleccionada;
    var pagina = "ObtenerEspecialistaPaqueteSucursal2.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(datos){
      var especialistas=datos.especialista;
      PintarDetalleEspecialistas(especialistas);
     // PintarDetalleEspecialistas2(especialistas);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

}

function PintarDetalleEspecialistas(especialistas,cellpaquete) {
	 $(".seleccionarbarbero_"+cellpaquete).html(' ');
	if ($(".seleccionarbarbero_"+cellpaquete).hasClass('slick-initialized')) {
    // Si existe, destruye la instancia
    $(".seleccionarbarbero_"+cellpaquete).slick('unslick');
}


	 $(".seleccionarbarbero_"+cellpaquete).slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
         prevArrow: '<button type="button" class="btn " style="    float: left;margin-top: 10px;    margin-right: 15px;"><</button>',
        nextArrow: '<button type="button" class="btn" style="    float: left;margin-top: 10px;margin-left: 10px;">></button>',
        // Agrega otras configuraciones según tus necesidades
    });


 var html="";
      if (especialistas.length>0) {
       for (var i = 0; i <especialistas.length; i++) {

        var nombrecom=especialistas[i].nombre+` `+especialistas[i].paterno;

     var ocupado= BuscarSiyaEstaOcupado(especialistas[i].idespecialista);

        html = `
            <a class="list-group-item list-group-item-action especialistalista_${cellpaquete}" id="especialista_${especialistas[i].idespecialista}_${cellpaquete}" onclick="SeleccionarEspecialista(${especialistas[i].idespecialista},'${nombrecom}','${cellpaquete}')" style="background: #c7aa6a; color: white; margin-bottom: 1em;margin-top: 1em;width: 90px;height: 120px;float: left;    margin-left: 2px;">
                <div class="text-center">
                    <img src="${especialistas[i].foto}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" class="mb-2">
                    <div style="justify-content: center;
    display: flex;">${especialistas[i].nombre} ${especialistas[i].paterno}</div>
                </div>
            </a>
        `;


         $(`.seleccionarbarbero_${cellpaquete}`).slick('slickAdd', `<div>`+html+`</div>`);

       }


	 	$(`.seleccionarbarbero_${cellpaquete}`).find('.slick-list.draggable').css({
		    width: '300px', // Establece el ancho deseado
		    height: '200px', // Establece la altura deseada
		    float:'left',
		});
      }


}

function BuscarSiyaEstaOcupado(idespecialista) {
    var bandero=0;
    for (var i = 0; i < arraypaqueteseleccionadocreado.length; i++) {
      
      if (arraypaqueteseleccionadocreado[i].idespecialista==idespecialista) {
        bandero=1;
        return bandero;
      }
    }

}

function SeleccionarEspecialista(idespecialista,nombrecom,cellpaquete) {
 $(".especialistalista_"+cellpaquete).removeClass('active');

 $("#especialista_"+idespecialista+"_"+cellpaquete).addClass('active');
 idespecialistaseleccionado=idespecialista;
 VerificarSiLlevavalor();
 $("#btstep4").css('display','block');
 detalle[4]=nombrecom;

 for (var i = 0; i <arraypaqueteseleccionadocreado.length; i++) {

 	if (arraypaqueteseleccionadocreado[i].key==cellpaquete) {
		arraypaqueteseleccionadocreado[i].barbero=nombrecom;
		arraypaqueteseleccionadocreado[i].idespecialista=idespecialista;
		
		}
	}
 //Agregaradetalle(nombrecom);
 //$("#btstep4").attr('onclick','IrAresumen()');
 $("#btnconfirmar"+cellpaquete).css('display','block');

 //$("#btstep4").attr('onclick','AbrirTiempo()');
 //Pintardetalle();
}

function AbrirTiempo() {

  var nombrepa=detalle[1].split('|');
  var producto =nombrepa[0];
  var tiempo =nombrepa[1];

  var html='<span style="text-transform: uppercase;color:#c7aa6a;">'+producto+'</span> ES DE '+'<span style="color:#c7aa6a;">'+tiempo+'MIN.</span>';
  $("#colorcarserviciotiempo").html(html);

  
   $("#btstep5").css('display','block');
   showStep(5);

}


function VerificarCortesia() {
  
   var datos="idpaquete="+idpaqueteseleccionado;
    var pagina = "VerificarCortesia.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(resp){
      var cortesias=resp.cortesias;
      if (cortesias.length>0) {

         
          showStep(6);

       }else{


        IrAresumen();

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

function ObtenerCortesias() {
   var datos="idpaquete="+idpaqueteseleccionado;
    var pagina = "VerificarCortesia.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(resp){
      var cortesias=resp.cortesias;
      if (cortesias.length>0) {

         PintarCortesias(cortesias)
         

       }


       },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });
}

function PintarCortesias(respuesta) {
  var html="";
  if (respuesta.length>0) {
   var foto="";
  

    for (var i = 0; i <respuesta.length; i++) {
      
       var foto = respuesta[i].ruta;

      html+=`
        <div class="tarjeta cambiarfuente faustina mx-2" id="tarjetac_`+respuesta[i].idpaquete+`" onclick="SeleccionarCortesia(`+respuesta[i].idpaquete+`,'`+respuesta[i].nombrepaquete+`')" style="width: 30%;">
          <div class="card demo-card-header-pic" style="border-radius: 10px;">
           <div class="card-header align-items-flex-end" style="background-image: url(`+foto+`); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;">
            </div>
            <div class="card-body divcortesias" id="divcortesias_`+respuesta[i].idpaquete+`" style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
              <p style="margin: 0; text-align: center; color: white;">`+respuesta[i].nombrepaquete+`</p>
                                </div>
                 </div>
              </div>

      `;
    }
  }

  $(".divcortesia").html(html);
}

function SeleccionarCortesia(idcortesia,nombrecortesia) {

  $(".divcortesias").removeClass('activo');
  $("#divcortesias_"+idcortesia).addClass('activo');
  detalle[6]=nombrecortesia;
             Pintardetalle();

  idcortesiaseleccionado=idcortesia;
      // Agregaradetalle(nombrecortesia);
  $(".btnstep6").css('display','block');
  $(".btnstep6").attr('onclick','IrAresumen()');
}

function ObtenerTiempo(cellpaquete,diferencia) {
  
    var pagina = "ObtenerTiempo.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    success: function(resp){
      var resultado=resp.resultado;
      if (resultado.length>0) {

         PintarTiempo(resultado,diferencia,cellpaquete);
         

       }


       },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });


}
function PintarTiempo(resultado,diferencia,cellpaquete) {
  console.log('diferencia'+diferencia);
  var html="";
  if (resultado.length>0) {

	  if ($("#seleccionarduracion_"+cellpaquete).hasClass('slick-initialized')) {
	    // Si existe, destruye la instancia
	    $("#seleccionarduracion_"+cellpaquete).slick('unslick');
	}


	 $("#seleccionarduracion_"+cellpaquete).slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,

         prevArrow: '<button type="button" class="btn " style="    float: left;margin-top: 10px;    margin-right: 15px;"><</button>',
        nextArrow: '<button type="button" class="btn" style="    float: left;margin-top: 10px;margin-left: 10px;">></button>',
        // Agrega otras configuraciones según tus necesidades
    });


	 	
      

    for (var i = 0; i < resultado.length; i++) {
       activado="";
      if (resultado[i].valor==diferencia) {
        activado="active";
      }

      html=`
        <label class="btn btn_dorado `+activado+` divtiempoc_`+cellpaquete+`" id="tiempobtn_`+cellpaquete+`_`+resultado[i].valor+`_`+i+`" style="margin-right: 10px;    width:100%;height: 36px;
    text-transform: lowercase!important;
     width: 90px;    margin-top: 10px;
    float: left;    margin-left: 2px;
    ">`+resultado[i].valor+`min.
        <input type="checkbox" id="cates_`+i+`" class="catecheck" onchange="SeleccionarTiempo(`+resultado[i].valor+`,'min','`+cellpaquete+`',`+i+`)" value="0" style="display:none;">
       </label>

      `;

      $(`#seleccionarduracion_${cellpaquete}`).slick('slickAdd', `<div>`+html+`</div>`);

    }


    $(`#seleccionarduracion_${cellpaquete}`).find('.slick-list.draggable').css({
		    width: '300px', // Establece el ancho deseado
		    height: '50px', // Establece la altura deseada
		    float:'left',
		});

  }

  //$(".seleccionarduracion_"+cellpaquete).html(html);
}


function SeleccionarTiempo(valor,min,cellpaquete,i) {
	
  $(".divtiempoc_"+cellpaquete).removeClass('active');

  valorseleccionado=valor;
  $("#tiempobtn_"+cellpaquete+"_"+valor+"_"+i).add('active');
  concatenar=valor+''+min;

   for (var i = 0; i <arraypaqueteseleccionadocreado.length; i++) {

   	if (arraypaqueteseleccionadocreado[i].key==cellpaquete) {
		arraypaqueteseleccionadocreado[i].intervaloservicio=valorseleccionado;
		break;
		}
		
	}

	console.log(arraypaqueteseleccionadocreado);
	$("#divintervalotiempo_"+cellpaquete).text(valorseleccionado);
  //Agregaradetalle(concatenar);
  

 // $("#btstep5").attr('onclick','VerificarCortesia()')
}
function IrAresumen() {
 $(".wizard-step").css('display','none');
 $("#step7").css('display','block');
 currentStep=7;
 $("#divdetalles").css('display','none');
/*var 
idsucursal
idpaqueteseleccionado
horario
fechaseleccionada
idespecialistaseleccionado*/


/*var idpaquete=localStorage.getItem('idpaquete');
   var idsucursal=localStorage.getItem('idsucursal');
   var horario=horaseleccionada.horainicial+'_'+horaseleccionada.horafinal;
   var fecha=localStorage.getItem('fecha');
   var idusuario=localStorage.getItem('id_user');
   var idespecialista=localStorage.getItem('idespecialista');
   var costo=localStorage.getItem('precio');
*/
   
    var datos='idsucursal='+idsucursal+"&idpaquete="+idpaqueteseleccionado+"&horario="+horarioseleccionado+"&fecha="+fechaseleccionada+"&idusuario="+idusuarioagenda+"&idespecialista="+idespecialistaseleccionado+"&costo="+costopaquete+"&idcortesia="+idcortesiaseleccionado;
    var pagina = "ObtenerDetalleAntesdeAgendar.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos

    async:false,
    data:datos,
    success: function(resp){

        var dia=resp.fecha;
        var hora=horainicialsele+' hrs.';
        var paquete=resp.paquete[0].nombrepaquete;
        var nombresucursal=resp.sucursal.titulo;
        var especialista=resp.especialista[0].nombre+' '+resp.especialista[0].paterno;

        var cortesia=resp.cortesia;
       var html="";
         
        html+=`

        <p style="text-align: justify;margin-top: 60px;font-size:20px;" class="">
      La cita quedará agendada en la sucursal
      <span style="color:#c7aa6a;">`+nombresucursal+`</span> el dia <span style="color:#c7aa6a;">`+dia+`</span>`;

   if (horainicialsele!='' && horainicialsele!=0) {
      html+=` a las <span style="color:#c7aa6a;">`+hora+`</span>`;
    }

     html+=` con el servicio <span style="color:#c7aa6a;">`+paquete+` (`+valorseleccionado+`min.)</span>  `;
     if (cortesia.length>0) {

       html+=` y con la cortesía <span style="color:#c7aa6a;">`+cortesia[0].nombrepaquete+`</span>`;
      }

      if (idcortesiaseleccionado==0) {
        html+=` y con la cortesía <span style="color:#c7aa6a;">NINGUNA</span>,`;
      }
      html+=` atendido por el barbero <span style="color:#c7aa6a;">`+especialista+`</span>`;

      html+=`</p>`;



      html+=`<p style="font-size:25px;font-weight:bold;text-align: center;" class="">¿Es correcto?</p>
     
      `;

      $("#divresumen").html(html);
      $("#btstep7").attr('onclick','GuardarCitaP()');
       
       },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });


}

function GuardarCitaP() {

 var datos="idusuario="+idusuarioagenda+"&idsucursal="+idsucursal+"&idpaquete="+idpaqueteseleccionado+"&fecha="+fechaseleccionada;
  datos+="&horario="+horarioseleccionado+"&idespecialista="+idespecialistaseleccionado+"&costo="+costopaquete+"&cantidad=1"+"&valorseleccionado="+valorseleccionado+"&idcortesiaseleccionado="+idcortesiaseleccionado+"&horainicials="+horainicials+"&horafinals="+horafinals;

  $.ajax({
     url:'catalogos/citas/Guardarcita.php', //Url a donde la enviaremos
     type:'POST', //Metodo que usaremos
     dataType:'json',
     data:datos,
     async:false,
     error:function(XMLHttpRequest, textStatus, errorThrown){
        var error;
        console.log(XMLHttpRequest);
        if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
        $('#abc').html('<div class="alert_error">'+error+'</div>'); 
        //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
       },
     success:function(msj){
         $("#modal-forms2").modal('hide');

       var html=`
       <p>Cita agregada exitosamente.</p>
       <p>Realizar el pago para que la cita quede agendada</p>

       `;

       AbrirModalExitoso(html);

      

       //AbrirNotificacion(html,'mdi-checkbox-marked-circle');

        
        console.log($('.detallepago').offset().top);
        clienteseleccionado=0;
        horainicialselect=0;
        fechaselecte2=0;
        idespecialistaselect=0;
        valorseleccionado=0;
        idcortesiaseleccionado=0;

         
        }
      });
}

function AbrirModalExitoso(htmlcita) {
    $("#modalespera").modal();
  var html=`
  
           <div class="" style="text-align: center;">
              <div class="toolbar" style="display:none;">
                  <div class="toolbar-inner" >
                      <div class="left">

                      <span style="color:black;margin-left:1em;font-size: 14px;
          font-weight: bold;"></span></div>

                        <div class="right">
                         
                        </div>
                    </div>
              </div>

                <div class="" style="">
                <div style="padding-top:1em;"></div>

                  <div id="" class="mensajeproceso" style="font-size:20px;font-weight:bold;" >`+htmlcita+`

                  </div>
                  <div id="" class="mensajeerror" style="font-size:20px;font-weight:bold;display:none;" >Error en la conexción,vuelva a intentar.</div>
                  <div id="" class="mensajeexito" style="font-size:20px;font-weight:bold;display:none;" >Se realizó correctamente</div>
                  <div style="display: flex; justify-content: center; align-items: center;">
                 <span class="btn btn-success butonok" onclick="MoverAbajo()" style="display:none;width: 200px;">OK</span>

                    <span class="btn btn_rojo butoerror" onclick="CerrarEspera()" style="display:none;width: 200px;">OK</span>
                 </div>
                  <div style="color:red;font-size:20px;"></div>

                     
                      
                </div>



                  </div>
               </div>

        
              `;
      

  $("#modalespera").modal({backdrop: 'static', keyboard: false});
  $("#divespera").html(html);

  $(".butonok").css('display','block');

}

function MoverAbajo() {
  CerrarEspera();
   $('html, body').animate({
    scrollTop: $('.detallepago').offset().top
     }, 1000);
}

function ObtenerDetalleProducto() {
  var datos="idpaquete="+idpaqueteseleccionado;

    var pagina = "ObtenerDetalleProducto.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(respuesta){
      
      var paquete=respuesta.respuesta[0];
      var html=`<div class="col-md-12">

       <div class="row">
       <img src="`+paquete.ruta+`" alt="" style="width:100%;">
       </div>

         <div class="row">`+paquete.nombrepaquete+`</div>
        <div class="row">
        `+paquete.descripcion+`
        </div>

        <div class="row">
        $`+costopaquete+`
        </div>

        <div class="row">
            <div class="input-group-prepend">
                    <button class="btn btn-primary" type="button" style=" " onclick="decrementpaquetemodal(`+paquete.idpaquete+`)">-</button>
                  </div>
                  <input type="text" id="quantity_`+paquete.idpaquete+`" class="form-control quantity_" style="border: none;width:40px;text-align:center;background: none;" value="0" readonly/>
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button" style=""onclick="incrementpaquetemodal(`+paquete.idpaquete+`)">+</button>
                  </div>
        </div>

      </div>`;


      $(".detallepaquete").html(html);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });
}


function decrementpaquetemodal(idpaquete) {
  var encontrado=0;
 
    var cantidad= $(".quantity_"+idpaquete).val();
 
          var total=parseFloat(cantidad)-1;

      if (total>=1) {
             
          $(".quantity_"+idpaquete).val(total);
       // $("#btstep2").text('Agregar');

          $("#btstep2").css('display','block');
          
       }else{
          $("#btstep2").css('display','none');

       }
}

function incrementpaquetemodal(idpaquete) {

   $("#btstep2").attr('onclick','AgregarCarrito()');
    var encontrado=0;
    var cantidad=$(".quantity_"+idpaquete).val();
 
    var total=parseFloat(cantidad)+1;
    if (total>=1) {
    $(".quantity_"+idpaquete).val(total);

   

      $("#btstep2").css('display','block');
      // $("#btstep2").text('Agregar');

    }else{

      $("#btstep2").css('display','none');
    }

}

function Validacionpaquetes() {
  
   faltadato=0;
  
  for (var i = 0; i < arraypaqueteseleccionadocreado.length; i++) {
       bandera=1;
      if (arraypaqueteseleccionadocreado[i].hora=='') {

        faltadato++;
        bandera=0;
      }

       if (arraypaqueteseleccionadocreado[i].barbero=='') {

        faltadato++;
          bandera=0;

      }

       if (arraypaqueteseleccionadocreado[i].idespecialista=='') {
        faltadato++;
         bandera=0;
      }

       if (arraypaqueteseleccionadocreado[i].fecha=='') {
         faltadato++;
         bandera=0;
      }

      $("#diverror_"+arraypaqueteseleccionadocreado[i].key).css('display','none');
      $("#divsucces_"+arraypaqueteseleccionadocreado[i].key).css('display','none');

      if (bandera==0) {

        $("#diverror_"+arraypaqueteseleccionadocreado[i].key).css('display','block');

      }else{
        
        $("#divsucces_"+arraypaqueteseleccionadocreado[i].key).css('display','block');
        
      }

  }

}


function AgregarCarrito() {

   faltadato=0;
  
  for (var i = 0; i < arraypaqueteseleccionadocreado.length; i++) {

    if(arraypaqueteseleccionadocreado[i].servicio==1){


       bandera=1;
      if (arraypaqueteseleccionadocreado[i].hora=='') {

        faltadato++;
        bandera=0;
      }

       if (arraypaqueteseleccionadocreado[i].barbero=='') {

        faltadato++;
          bandera=0;

      }

       if (arraypaqueteseleccionadocreado[i].idespecialista=='') {
        faltadato++;
         bandera=0;
      }

       if (arraypaqueteseleccionadocreado[i].fecha=='') {
         faltadato++;
         bandera=0;
      }

      if (bandera==0) {

        $("#diverror_"+arraypaqueteseleccionadocreado[i].key).css('display','block');

      }else{
        
        $("#divsucces_"+arraypaqueteseleccionadocreado[i].key).css('display','block');
        
      }
    }

  }

  if (faltadato==0) {
  var paquetescarrito=[];
 
    var datos="paquetes="+JSON.stringify(arraypaqueteseleccionadocreado);
   $.ajax({
    type: 'POST',
    dataType: 'json',
    url:'catalogos/pagos/AgregaraCarrito.php', //Url a donde la enviaremos
    data: datos, 
    success: function(datos){
       $("#modal-forms2").modal('hide');

       var html=`
       <p>El producto ha sido agregado.</p>
       <p>Realizar el pago</p>

       `;
      AbrirModalExitoso(html);
       //AbrirNotificacion(html,'mdi-checkbox-marked-circle');

       
     
    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

 }else{


  Validacionpaquetes();
 }


}


function fechaformato(fecha,callback) {

    var pagina = "fechaformato.php";
    var datos="fechadatos="+fecha;
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    data:datos,
    async:false,
    success: function(resp){
      var respuesta=resp.fecha;
       callback(respuesta); // Llam

       },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });
}


function ObtenerEspecialista(idespecialista) {

     return new Promise(function(resolve, reject) {

    var pagina = "ObtenerEspecialista.php";
    var datos="idespecialista="+idespecialista;
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    data:datos,
    async:false,
    success: function(resp){
      var respuesta = resp.especialista;
      resolve(respuesta); // Resolver la Promesa con la respuesta


       },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

    });
}

</script>

