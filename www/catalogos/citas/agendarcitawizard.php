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

<form name="form_usuario1" id="form_usuario1">
  <div id="divdetalles" style="text-align: center;width: 100%;"></div> 

  <div class="wizard-step" id="step1" style="">
    <div class="card" id="home" role="tabpanel">
     <div class="card-header headercategoria" style="margin-top: 1em; margin-bottom: 1em;">
      <h5>SELECCIONAR CATEGORIA </h5>
    </div>

    <div id="categorias" class="categorias row" data-espacio="1" style="display: flex;
    justify-content: center;">
        <!-- Aquí se cargarán dinámicamente las categorías -->
    </div>



     <div id="subcategorias" class="subcategorias" data-espacio="2">
        <!-- Aquí se cargarán dinámicamente las subcategorías -->
    </div>
   </div>


    <div id="elementos"></div>

     <div class="card" id="divheaderservicio" role="tabpanel" style="display: none;">
     <div class="card-header" style="margin-top: 1em;    margin-bottom: 1em;">
      <h5>SELECCIONAR SERVICIO </h5>
    </div>
    <div id="servicios" class="servicios" style="display: flex;
    justify-content: center;">
        <!-- Aquí se cargarán los servicios -->
    </div>

   </div>

    <div class="row">
     <div class="col-md-12" style="justify-content: right;
    display: flex;">
      <button type="button" class="btn btn-primary prev-step" onclick="goToPreviousStep()" style="display: none;">Regresar</button>


         <button type="button" class="btn btn-primary btnstep1" style="display: none;" id="btstep1" onclick="">Continuar</button>

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
      <h5>SELECCIONAR FECHA </h5>
    </div>
     <div class="row">
    <div class="col-md-12">

     <div id="picker4" class="picker4"></div>

   </div>

   

    </div>
   <!--  <button type="button" id="recargar"></button> -->
   </div>


    <div class="card cardpro" id="home" role="tabpanel" >
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

<div class="row" style="margin-top: 1em;">
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
    var horainicials="";
    var horafinals="";

           
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
       
        ObtenerTodasCategorias();

        });


         myPromise.then((successMessage) => {

           

            VerificarSiCategoriaTieneSub().then((successMessage) => {
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


          if (producto==0) {
          var fecha=new Date();
          var f=fecha.toISOString().split('T')[0];
         
          var anio=f.split('-')[0];
          var mes=f.split('-')[1];
         
          ObtenerFechasCalendarioAgendaA(anio,mes);
           $("#btstep2").css('display','none');
           $(".cardpro").css('display','none');

           var fechaselecte='<?php echo $fechaselecte; ?>';


           if (fechaselecte!=undefined && fechaselecte!='') {

              
               fechaconsulta=fechaselecte;
                PintarHoraSeleccionadaA(fechaselecte);
                PintarFechaSeleccionadaA(fechaselecte);

                fechaformato(fechaconsulta, function(respuesta) {
                     detalle[2] = respuesta; // Hacer algo con la respuesta obtenida
                 });


                $("#btstep2").css('display','block');
                $("#btstep2").attr('onclick','showStep(3)');
           }
         }else{

          $(".cardfechaspro").css('display','none');
          ObtenerDetalleProducto();

          $("#btstep2").css('display','none');

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


          var idespecialista='<?php echo $idespecialistaselect; ?>';
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
     $("#divdetalles").css('display','block');

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
                PintarCategoriasV(respuesta);
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
         
            html=`
               <div class="tarjeta cambiarfuente faustina mx-2" id="tarjeta_${i}" onclick="`+funcion+`" style="width: 30%;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;">`

                        ;
                        if (tiempo!=null && tiempo!='') {
                           html+=` <span class="divintervalotiempo">Tiempo ${tiempo}min.</span>`;

                        }
                     

                       html+=` </div>
                                <div class="card-body divcpaqueitem" id="divcpaqueitem_`+elementosFiltrados[i].idpaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${elementosFiltrados[i].nombrepaquete}
                                   <span class="preciopaqueteestilo2">$${elementosFiltrados[i].precioventa}</span>
                                    </p>

                                </div>
                            </div>
                        </div>

            `;

            $("#servi_"+idcategoriapaquete).append(html);

          }
        }

     
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







// Seleccionar la categoría con idcategoriapaquete 20
//selectCategoryAndAncestors(categorias, "20");



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
    position: absolute;
    top: 80px;
    right: 0;
    background: red;
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
  var calendar= $('.picker4').fullCalendar({
          header: {
           left:'prev',
              center: 'title',
              right: 'next',
          },
              locale:'es',
     monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
     monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agost","Sept", "Oct", "Nov", "Dic"],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ["Dom", "Lun", "Mar", "Mier", "Jue", "Vier", "Sab", "Dom"],
          firstDay:0,
          defaultDate: yyyy+'-'+mm+'-'+dd,
         eventLimit: true, // allow "more" link when too many events 
          events: [
             
          ],
          dayClick: function (date, jsEvent, view) {
             console.log('Has hecho click en: '+  date.format());
            detalle[2]="";

              var fecha=date.format();
              idespecialistaseleccionado='';
              horarioseleccionado='';
            
              fechaconsulta=fecha;

           PintarHoraSeleccionadaA(fecha);
           PintarFechaSeleccionadaA(fecha);
            fechaformato(fechaconsulta, function(respuesta) {
                     detalle[2] = respuesta; // Hacer algo con la respuesta obtenida
                 });
           Pintardetalle();
     //ObtenerHorariosDia(3);
       $(".divintervaloshorarios").css('display','block');
   // $(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
    //VerificarSiLlevavalor();
       $("#btstep2").css('display','block');
      
       $("#btstep2").attr('onclick','showStep(3)');



          }, 
          eventClick: function (calEvent, jsEvent, view) {
              $('#event-title').text(calEvent.title);
              $('#event-description').html(calEvent.description);
             

          }, 

         
   });


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


function SeleccionarHorario1(horainicial,horafinal,i) {
 
  $(".horariossele").removeClass('active');

  $("#catebtn_"+i).add('active');
  horainicialsele=horainicial;
  horafinalsele=horafinal;
  horarioseleccionado=horainicialsele+'_'+horafinalsele;
  detalle[3]=horainicialsele+'Hrs.';
             Pintardetalle();

  //Agregaradetalle(horainicialsele);
//horaseleccionada=arrayhorarios[posicion];

   //HabilitarBoton2();
//aqui
  idespecialistaseleccionado="";
  ObtenerListadoEspecialista2();
   $("#btstep3").css('display','block');

   $("#btstep3").attr('onclick','showStep(4)');

}




function ObtenerListadoEspecialista2() {
 

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

function PintarDetalleEspecialistas(especialistas) {
 var html="";
 html+=`<div class="list-group">`;
      if (especialistas.length>0) {
       for (var i = 0; i <especialistas.length; i++) {

        var nombrecom=especialistas[i].nombre+` `+especialistas[i].paterno;
        html+=`

         <a  class="list-group-item list-group-item-action especialistalista" id="especialista_`+especialistas[i].idespecialista+`" onclick="SeleccionarEspecialista(`+especialistas[i].idespecialista+`,'`+nombrecom+`')" style="background:#c7aa6a;color:white;margin-bottom: 1em;margin-top: 1em;">
           <div class="row">

            <div class="col-md-4 justify-content-between">
             <img src="`+especialistas[i].foto+`" style="width:100px;">
            </div>

           <div class="col-md-4 justify-content-between">
             `+especialistas[i].nombre+` `+especialistas[i].paterno+`
            
           </div>
          </div>
         </a>
        `;

       }
      }

 html+=`</div>`;

 $(".seleccionarbarbero").html(html);
}

function SeleccionarEspecialista(idespecialista,nombrecom) {
 $(".especialistalista").removeClass('active');

 $("#especialista_"+idespecialista).addClass('active');
 idespecialistaseleccionado=idespecialista;
 VerificarSiLlevavalor();
 $("#btstep4").css('display','block');
 detalle[4]=nombrecom;
 //Agregaradetalle(nombrecom);
 //$("#btstep4").attr('onclick','IrAresumen()');
           

 $("#btstep4").attr('onclick','AbrirTiempo()');
 Pintardetalle();
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

function ObtenerTiempo(diferencia) {
  
    var pagina = "ObtenerTiempo.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    success: function(resp){
      var resultado=resp.resultado;
      if (resultado.length>0) {

         PintarTiempo(resultado,diferencia);
         

       }


       },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });


}
function PintarTiempo(resultado,diferencia) {
  console.log(resultado);
  var html="";
  if (resultado.length>0) {
    for (var i = 0; i < resultado.length; i++) {

        activado="";
      if (resultado[i].valor==diferencia) {
        activado="active";
      }

      html+=`
        <label class="btn btn_dorado divtiempoc `+activado+` " id="tiempobtn_`+resultado[i].valor+`" style="margin-right: 10px;    width:100%;height: 36px;
    text-transform: lowercase!important;">`+resultado[i].valor+`min.
        <input type="checkbox" id="cates_1" class="catecheck" onchange="SeleccionarTiempo(`+resultado[i].valor+`,'min')" value="0">
       </label>

      `;

    }
  }

  $(".divtiempo").html(html);
}


function SeleccionarTiempo(valor,min) {
  $(".divtiempoc").removeClass('active');
  valorseleccionado=valor;
  $("#tiempobtn_"+valor).addClass('active');
  concatenar=valor+''+min;
  //Agregaradetalle(concatenar);
  detalle[5]=concatenar;


 var separar=detalle[1].split('|');

 var uno=separar[0];
 var dos=valor;

 detalle[1]=uno+'|'+dos;
             Pintardetalle();

  $("#btstep5").attr('onclick','VerificarCortesia()')
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
        fechaselecte=0;
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
 
    var cantidad=$(".quantity_").val();
 
          var total=parseFloat(cantidad)-1;

      if (total>=1) {
             
          $(".quantity_").val(total);
       // $("#btstep2").text('Agregar');

          $("#btstep2").css('display','block');
          
       }else{
          $("#btstep2").css('display','none');

       }
}

function incrementpaquetemodal(idpaquete) {
   $("#btstep2").attr('onclick','AgregarCarrito()');
    var encontrado=0;
    var cantidad=$(".quantity_").val();
 
    var total=parseFloat(cantidad)+1;
    if (total>=1) {
    $(".quantity_").val(total);

   

      $("#btstep2").css('display','block');
      // $("#btstep2").text('Agregar');

    }else{

      $("#btstep2").css('display','none');
    }

}



function AgregarCarrito() {
  var paquetescarrito=[];
  var cantidad=$(".quantity_").val();
  
                
          var id=idpaqueteseleccionado;
          var objeto={
            idpaquete:id,
            cantidad:cantidad
          };
          paquetescarrito.push(objeto);
     
    var datos="paquetes="+JSON.stringify(paquetescarrito);
   $.ajax({
    type: 'POST',
    dataType: 'json',
     url:'catalogos/pagos/Obtenerdatospaquetes.php', //Url a donde la enviaremos
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

