<?php 

/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	/*header("Location: ../../login.php"); */ echo "login";

	exit;
}

$idmenumodulo = $_GET['idmenumodulo'];

//validaciones para todo el sistema

$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion

//validaciones para todo el sistema


/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importación de clase conexión
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Dashboard.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Funciones.php");

//Declaración de objeto de clase conexión
$db = new MySQL();
$dashboard = new Dashboard();
$bt = new Botones_permisos(); 
$f = new Funciones();

$dashboard->db = $db;


if(isset($_SESSION['permisos_acciones_erp'])){
						//Nombre de sesion | pag-idmodulos_menu
	$permisos = $_SESSION['permisos_acciones_erp']['pag-'.$idmenumodulo];	
}else{
	$permisos = '';
}
//*================== TERMINA RECIBIMOS PARAMETRO DE PERMISOS =======================*/




?>

<div class="row">

	 <div class="col-xl-3 col-md-4">
                   <div class="card colornegro text-white mb-4" style="background: #375d97">
                      <div class="card-body" style="    font-size: 16px;">CITAS AGENDADAS de hoy</div>
                     <div class="card-footer ">
                       <a class="small text-white stretched-link" onclick="ListadoCitas()" style="width: 100%;cursor: pointer;">
                       <h3>
	                      	<span class="mdi mdi-calendar"></span></span>
	                      	<span id="citasregistros">0</span>
	                      </h3>
                      </a>
                      <div class="small text-white">
                 <div id="mostrarcitas" style="display: none;">

            <div id="" class="panel-actions">
            <span style="    justify-content: right;display: flex;font-size: 15px;" onclick="CerrarCitas()" class="actions "><span class="mdi mdi-close-circle"></span>
   									</span>
          </div>

            <div class="listadocitas" style="list-style: none;">
           
           </div>
                                          
          </div>

               </div>
           </div>
       </div>
      </div>

      <div class="col-xl-3 col-md-4">
                   <div class="card colornegro text-white mb-4">
                      <div class="card-body" style="    font-size: 16px;">CITAS REALIZADAS de hoy</div>
                     <div class="card-footer ">
                       <a class="small text-white stretched-link" onclick="ListadoCitasRealizadas()" style="width: 100%;cursor: pointer;">
                       <h3>
                          <span class="mdi mdi-calendar"></span></span>
                          <span id="citasregistrosrealizadas">0</span>
                        </h3>
                      </a>
                      <div class="small text-white">
                 <div id="mostrarcitasrealizadas" style="display: none;">

            <div id="" class="panel-actions">
            <span style="    justify-content: right;display: flex;font-size: 15px;" onclick="CerrarCitasRealizadas()" class="actions "><span class="mdi mdi-close-circle"></span>
                    </span>
          </div>

            <div class="listadocitasrealizadas" style="    list-style: none;">
           
           </div>
                                          
          </div>

               </div>
           </div>
       </div>
      </div>


       <div class="col-xl-3 col-md-4">
                   <div class="card colordorado text-white mb-4">
                      <div class="card-body" style="    font-size: 16px;">PRODUCTOS de hoy</div>
                     <div class="card-footer ">
                       <a class="small text-white stretched-link" onclick="ListadoProductos()" style="width: 100%;cursor: pointer;">
                       <h3>
	                      	<span class="mdi mdi-calendar"></span></span>
	                      	<span id="productosregistros">0</span>
	                      </h3>
                      </a>
                      <div class="small text-white">
                 <div id="mostrarproductos" style="display: none;">

            <div id="" class="panel-actions">
            <span style="    justify-content: right;display: flex;font-size: 15px;" onclick="CerrarProductos()" class="actions "><span class="mdi mdi-close-circle"></span>
   									</span>
          </div>

            <div class=""style="list-style: none;">
           
           </div>
                                          
          </div>

               </div>
           </div>
       </div>
      </div>


       
              

       </div>
       <div class="row" style="margin-bottom: 1em;">
       	
       	<div class="col-md-4">
             <div class="divtabs" style="">
          <div style="width: 100%">
                      <label for="">Filtrar por:</label>

          </div>

   <div class="tabs" style="width: 100%; ">
     <button class="tab boton1 active" id="citas-tab" style="width: 50%;    " onclick="openTab('citas')">Citas</button> 
     <button class="tab boton1" id="productos-tab" style="width: 50%;float: right;" onclick="openTab('productos')">Productos</button>

     <!--  <button class="btn  btn-primary ">Agendar cita</button> -->
   </div>



</div>

        </div>
       	<div class="col-md-6"> </div>
       	<div class="col-md-2">
      


       	</div>

       </div>
       <div class="row" style="margin-left: 0.3em;">
       	<div class="col-md-12">
             
              <div class="row" style="    margin-bottom: 1em;">
              	 <div id="picker2"></div>
              	</div>

               <div class="row">
                <div id="listadointervalos" style="display: none;">
                   <div class="container">
                  <div class="citas">
                      <div class="intervalo">10:00 AM - 11:00 AM</div>
                      <div class="cita">Cita 1</div>

                       <div class="cita">Cita 1</div>
                  </div>
                  <div class="citas">
                      <div class="intervalo">11:00 AM - 12:00 PM</div>
                      <div class="cita">Cita 2</div>
                  </div>
                  <!-- Agrega más intervalos y citas según sea necesario -->
              </div>
                 
                 
                </div>
               </div>

              	<div class="row">
              	<div id="listadocitascalendario" class="listadocitascalendario" style="margin-left: 20px;width: 100%;">
              		
              	</div>
              </div>
              </div>
       </div>

                        
</div>

<div class="row" style="display: none;    ">
       <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
            <div class="card-body">DESCARGAS</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link" >	
              <div class="row">
	              <div>
	               <h3>
	               <span class="mdi mdi-android"></span>
	             <span id="usuariosandroid">0</span></h3>
	             </div>

               <div style="margin-left: 1em">
	              <h3>
	              <span class="mdi mdi-apple"></span></span>
	               <span id="usuariosios">0</span>
	                </h3>
                </div>

                 </div>
                </a>
                <div class="small text-white"><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                	
                </div>
                </div>
            </div>
        </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                               <div class="card-body">CLIENTES REGISTRADOS</div>
                         <div class="card-footer d-flex align-items-center justify-content-between">
                           <a class="small text-white stretched-link" >
                           	<h3>
	                          	<span class="mdi  mdi-account"></span></span>
	                         	<span id="usuariosregistrados">0</span>
	                          	</h3>

                         </a>
                     <div class="small text-white"><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">CLIENTES EN SESIÓN</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                               <a class="small text-white stretched-link" >
                             	<h3>
	                          	<span class="mdi  mdi-account"></span></span>
	                        	<span id="clientessession">0</span>
	                      	</h3>
                      </a>
                     <div class="small text-white"><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                                    </div>
                                </div>
                            </div>


                           <div class="col-xl-3 col-md-6" id="versionactualdiv">
                           <div class="card bg-success text-white mb-4">
                          <div class="card-body">DISPOSITIVOS</div>
                   					 <div class="card-footer d-flex align-items-center justify-content-between">
                          <a class="small text-white stretched-link" >  
                       <div class="row">
                       <div class="col-md-12">
                         <h3>
                        <span class=" mdi mdi-cellphone"></span>

                      <span style="font-size: 14px;"> VERSION ACTUAL <span id="versionactual"></span></span>
                                                <span id="totalversionactual">0</span></h3>
                          </div>

                           <br>

                          <div style="margin-left: 1em">
                           <h3>
                               <span class=" mdi mdi-cellphone"></span>
                              <span style="font-size: 14px;">VERSIONES ANTERIORES</span>
                              <span id="totalversionesanteriores">0</span>
                            </h3>
       												</div>

                  </div>
                  </a>
                  <div class="small text-white"><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                   </div>
               </div>
           </div>
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"></div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

  <div class="modal" id="modaldetallecita" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">DETALLE CITA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="divdetallecita"></div>
      
      </div>
      <div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

<button type="button" id="btnreagendarcita" class="btn btn-warning btnreagendarcita" style="float: right;" title="">Reagendar</button>   

<button type="button" id="btncancelarcita" class="btn btn-success btncancelarcita" style="float: right;" title="">Cancelar cita</button>   


<button type="button" id="btnpagarcita" class="btn btn-success btnpagarcita" style="float: right;" title="">Pagar</button> 
     
       
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modaldetallenota" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">DETALLE NOTA DE PAGO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="divdetallenota"></div>
      
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


     
       
      </div>
    </div>
  </div>
</div>

   <style>
        /* Estilos personalizados */
        .citas {
            position: relative;
            display: flex;
            align-items: center;
            margin: 10px;
        }
        .intervalo {
            flex: 1;
            text-align: right;
        }
        .cita {
            background-color: #007bff;
            color: #fff;
            padding: 5px;
            margin: 5px;
        }
    </style>

<style>
	
	#picker2 table {
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
.fc-header-right{
 visibility: hidden;
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


</style>

<script>
	var NtabName="citas";
 var idmenumodulo='<?php echo $idmenumodulo; ?>';
 
	/*ObtenerClientesAndroidios();
	Obtenerregistrados();
	clientesensession();
    ObtenerClientesVersion();*/
      ObtenerTotalCitas();
      setInterval('ObtenerTotalCitas()', 2000);//cada 2 segundos
      ObtenerFechaActual();
      PintarCalendario2();


 function openTab(tabName) {
  // Ocultar todos los contenidos de las pestañas
  NtabName=tabName;
  var tabContents = document.getElementsByClassName('tab-content');
  for (var i = 0; i < tabContents.length; i++) {
    tabContents[i].style.display = 'none';
  }
  
  // Mostrar el contenido de la pestaña seleccionada
 
  
  // Agregar la clase "active" al botón de la pestaña seleccionada
  var tabs = document.getElementsByClassName('tab');
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove('active');
  }
  document.getElementById(tabName + '-tab').classList.add('active');

  if (tabName=='citas') {
 
  	 var moment = $('#picker2').fullCalendar('getDate');
      
    var cadenafecha=moment.format().split('-');
     var anio=cadenafecha[0];
     var mes=cadenafecha[1];
     var dia=cadenafecha[2];

     var mes = parseInt(cadenafecha[1], 10);


			mes++;

			if (mes === 0) {
			  mes = 12;
			  cadenafecha[0]--; // Restamos uno al año si retrocedemos desde enero
			}

			var mesStr = mes.toString().padStart(2, '0');  
    var fecha=anio+'-'+mesStr+'-'+dia;
    var mes=cadenafecha[1];
	   var elementoSeleccionado = $('.seleccionadofecha');

    elementoSeleccionado.removeClass('seleccionadofecha');
    $(".listadocitascalendario").html(" ");

	 	 ObtenerCitasFechasCalendario(anio,mes);
	 	
  
  }

   if (tabName=='productos') {
   	  var moment = $('#picker2').fullCalendar('getDate');
      
    var cadenafecha=moment.format().split('-');
     var anio=cadenafecha[0];
     var mes=cadenafecha[1];
     var dia=cadenafecha[2];

     var mes = parseInt(cadenafecha[1], 10);


			mes++;

			if (mes === 0) {
			  mes = 12;
			  cadenafecha[0]--; // Restamos uno al año si retrocedemos desde enero
			}

			var mesStr = mes.toString().padStart(2, '0');  
    var fecha=anio+'-'+mesStr+'-'+dia;
    var mes=cadenafecha[1];
	 var elementoSeleccionado = $('.seleccionadofecha');

    elementoSeleccionado.removeClass('seleccionadofecha');
    $(".listadocitascalendario").html(" ");
	 	 ObtenerProductosFechasCalendario(anio,mes);
	 	

   
  }


  


}

</script>





