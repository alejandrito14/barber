<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

 
if(!isset($_SESSION['se_SAS']))
{
	//header("Location: ../login.php");
	echo "login";
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Pais.php");
require_once("../../clases/class.Fechas.php");

require_once("../../clases/class.Usuarios.php");
require_once "../../clases/class.Sucursal.php";



$db = new MySQL();
$bt = new Botones_permisos(); 
$fu = new Funciones();
$cli = new Cita();
$pais = new Paises();
$fechas=new Fechas();


$su->db = $db;
$cli->db = $db;
$pais->db=$db;

$idmenumodulo = $_GET['idmenumodulo'];







if(isset($_GET['ac']))
{
	if($_GET['ac']==1)
	{
		echo '<script type="text/javascript">AbrirNotificacion("'.$_GET['msj'].'","mdi-checkbox-marked-circle");</script>'; 
	}
	else
	{
		echo '<script type="text/javascript">AbrirNotificacion("'.$_GET['msj'].'","mdi-close-circle");</script>';
	}
	
	echo '<script type="text/javascript">OcultarNotificacion()</script>';
}
//*================== INICIA RECIBIMOS PARAMETRO DE PERMISOS =======================*/

if(isset($_SESSION['permisos_acciones_erp'])){
						//Nombre de sesion | pag-idmodulos_menu
	$permisos = $_SESSION['permisos_acciones_erp']['pag-'.$idmenumodulo];	
}else{
	$permisos = '';
}
//*================== TERMINA RECIBIMOS PARAMETRO DE PERMISOS =======================*/

$cli = new Usuarios();
$cli->db = $db;
$r_clientes = $cli->lista_Usuarios(3);
$a_cliente = $db->fetch_assoc($r_clientes);
$r_clientes_num = $db->num_rows($r_clientes);

$su = new Sucursal();
$su->db = $db;
$r_sucursales = $su->ObtenerTodos();
$r_sucursales_num = $db->num_rows($r_sucursales);
$a_sucursal = $db->fetch_assoc($r_sucursales);

if(!isset($_GET['idcita']))
{
	$idusuario = 0;
	$$v_idempresa = "";
	
	$v_sexo = "H" ;
	$v_no_usuario = "";
	$v_f_nacimiento = "";
	$v_no_tarjeta ="" ;
	$v_nombre = "";
	$v_paterno = "";
	$v_materno = "";
	$v_direccion = "";
	$v_telefono ="" ;
	$v_fax = "" ;
	$v_fis_razonsocial ="" ;
	$v_fis_rfc = "";
	$v_fis_direccion = "";
	$v_fis_no_int = "";
	$v_fis_no_ext = "";
	$v_fis_col = "";
	$v_fis_ciudad = "";
	$v_fis_estado = "";
	$v_fis_cp = "";
	$v_usuario = "";
	$v_email = "";
	$v_clave = "";
	$v_estatus = "1";
	$v_direccion_envio = "";
	$v_cp = "" ;
	$disabled="disabled";
	$idpais=0;
	$idmunicipio=0;
	$v_referencia='';
	$v_fis_correo="";
	$v_celular="";
	$titulo='NUEVO USUARIO';
	$v_idtipo=3;
	$bloquearediciondedatos=0;
			$rutaperfil="images/sinfoto.png";
	//$validacion="onkeyup='ValidarCelular()'";

}else
{
	
	/*$idcita = $_GET['idcita'];
	$cli->idcita=$idcita;
	$obtenercita=$cli->ObtenerCita();
	//var_dump($obtenercita);

	$idsucursal=$obtenercita[0]->idsucursal;
	$idpaquete=$obtenercita[0]->idpaquete;

	$titulo=$obtenercita[0]->titulo;
	$descripcion=$obtenercita[0]->descripcion;

	$fechacita=$fechas->fecha_texto5($obtenercita[0]->fechacita);
	$cliente=$obtenercita[0]->nombreusuario;
	$nombrepaquete=$obtenercita[0]->concepto;
	
	$cortesia=$obtenercita[0]->nombrepaquetecortesia;
	$horacita=$obtenercita[0]->horainicial.'-'.$obtenercita[0]->horafinal;
$nombreespecialista=$obtenercita[0]->nombreespecialista;*/

}




?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script type="text/javascript">
	//$('#titulo-modal-forms').html("ALTA A usuario");
</script>


<form name="form_usuario1" id="form_usuario1">
	<input id="v_id" name="v_id" type="hidden" value="<?php echo $idusuario; ?>">

	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;">AGENDAR CITA</h4>

			<div style="float: right;position:fixed!important;z-index:10;right:0;margin-right:2em;width: 20%;" >
					
			
					<div style="clear: both;"></div>

				


				<button type="button" class="btn btn-success btnguardarcita" style="float: right;display: none;" title="" onclick="GuardarCita()">
				<i class="mdi mdi mdi-content-save"></i>GUARDAR	</button>

				<!-- <button type="button" onClick="aparecermodulos('catalogos/dashboard/vi_dashboard.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" title="" style="margin-right: 10px;float: right;"><i class="mdi mdi-arrow-left-box"></i>DASHBOARD</button> -->
				
				<input type="hidden" id="v_idusuario" name="v_idusuario" value="<?php echo $idusuario; ?>" />
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>



	<div class="card">
		<div class="card-body" style="padding: 15px">
			<!-- Nav tabs -->
			<!-- <ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">DATOS GENERALES</span></a> </li>
				
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">DATOS DE ACCESO</span></a> </li>
				<li style="display: none;" class="nav-item"> <a class="nav-link" data-toggle="tab" href="#envio" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Direcci&oacute;n de env&iacute;o</span></a> </li>

				<li style="display: none;" class="nav-item" id="opcionesavanzadas"> <a class="nav-link" data-toggle="tab" href="#avanzado" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">OPCIONES AVANZADAS</span></a> </li>

			</ul> -->
			<!-- Tab panes -->


<!-- 			<div class="tab-content tabcontent-border" style=" ">


					<div class="card" id="home" role="tabpanel">
					<div class="card-header" style="margin-top: 1em;"><div style="float: left;">
							<h5>SELECCIONAR CLIENTE </h5> 
					</div>
					

						<div style="float: right;">
							<button class="btn btn-primary" type="button" onclick="AbrirModalCliente()" style="">NUEVO CLIENTE</button>
						</div>
				</div>

					<div class="card-body">
				<div class="row">
				<div class="col-md-6">
						<div class="row">
                   <div class="form-group m-t-20" style="width: 100%;">	 
				<input type="text" class="form-control" name="buscadoralumnos_1" id="buscadoralumnos_" placeholder="Buscar" onkeyup="BuscarEnLista('#buscadoralumnos_','.alumnos_')">
					    </div>
     <div class="divusuarios" style="    height: 200px;
    overflow: scroll;width: 100%;" id="divusuarios">
   			

      </div>

      </div>

          <div class="col-50">
          
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div> -->

			<!-- <div class="tab-content tabcontent-border" style=" ">


			<div class="card" id="home" role="tabpanel">
			<div class="card-header" style="margin-top: 1em;">
				<h5>SELECCIONAR SUCURSAL </h5>
			</div>

	<div class="card-body">
		<div class="row">
		<div class="col-md-6">
		<div class="row">
                            
     	<div class="" style=" width: 100%;">
   			
     		  <div class="form-group m-t-20">	 
						<input type="text" class="form-control" name="buscadorsuc_" id="buscadorsuc_" placeholder="Buscar" onkeyup="BuscarEnLista('#buscadorsuc_','.suc_')">
				    </div>
       <div class="sucursales"  style="overflow:scroll;height:100px;overflow-x: hidden" id="sucursales_<?php echo $a_sucursal['idsucursal'];?>">
					    <?php     	
							if ($r_sucursales_num>0) {	
						    	do {
						?>
						    	<div class="form-check suc_"  id="suc_<?php echo $a_sucursal['idsucursal'];?>">
						    	    <?php 	
						    			$valor="";
						    		?>
									  <input  type="checkbox" value="" class="form-check-input chksucursal_<?php echo $idsucursal;?>" onchange="SeleccionarSucursalAgenda('<?php echo $a_sucursal['idsucursal']?>')" id="inputsuc_<?php echo $a_sucursal['idsucursal']?>" <?php echo $valor; ?>>
									  <label class="form-check-label" for="flexCheckDefault"><?php echo $a_sucursal['titulo']; ?></label>
								</div>						    		
						    	<?php
						    		} while ($a_sucursal = $db->fetch_assoc($r_sucursales));
     					    	 ?>
						    	<?php } ?>    
				    </div>
      </div>
			</div>

      </div>

      </div>

          <div class="col-50">
          
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
			 -->

			
				<div class="card" id="home" role="tabpanel">
					<div class="card-header" style="margin-top: 1em;">
						<h5>SELECCIONAR SERVICIO </h5>
				</div>

					<div class="card-body">
				<div class="row">
				<div class="col-md-12">
						<div class="row">
                            
     <div class="" style="    margin-left: 20px;">
   			


      <div id="slidercategorias">
      	 
      </div>
       <div id="slidersubcategorias">
      	 
      </div>

       <div id="slidersubcategoriasproductos">
      	 
      </div>

      </div>

          <div class="col-50">
          
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
			

		<div class="card" >
				<div class="card-header" style="margin-top: 1em;">
						<h5>SELECCIONAR FECHA </h5>
				</div>


				
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div style="    margin-left: 10px;">Fecha anterior: <span><?php echo $fechacita; ?></span>
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">

				 <div id="picker4"></div>

				</div>
			<!-- 	<button type="button" id="recargar"></button> -->
			</div>
		</div>
	</div>

	<div class="card" >
						<div class="card-header" style="margin-top: 1em;">
						<h5>SELECCIONAR HORA </h5>
				</div>
				
			<div class="card-body">

					<div class="row">
					<div class="col-md-12">
						<div style="margin-left: 10px;">Hora anterior: <span><?php echo $horacita; ?></span>
					</div>
				</div>
				</div>

				<div class="row">
				<div class="col-md-12">

				 <div id="divhorarios">
				 	
				 	<div class=" btn-group-toggle liintervalos" data-toggle="buttons" ></div>
				 </div>


				</div>

			</div>
		</div>
	</div>

	<div class="card" >
						<div class="card-header" style="margin-top: 1em;">
						<h5>SELECCIONAR BARBERO </h5>
				</div>
				
			<div class="card-body">
					<div class="row">
					<div class="col-md-12">
						<div style="margin-left: 10px;">Barbero anterior: <span><?php echo $nombreespecialista; ?></span>
					</div>
				</div>
				</div>

				<div class="row">
				<div class="col-md-6">

				 <div class="seleccionarbarbero" style="margin-left: 10px;"></div>


				</div>

			</div>
		</div>
	</div>



		<div class="card" >
						<div class="card-header" style="margin-top: 1em;">
						<h5>SELECCIONAR MÉTODO DE PAGO </h5>
				</div>
				
			<div class="card-body">
					<div class="row">
					<div class="col-md-12">
						<div style="margin-left: 10px;">

							<div class="divtipopago  btn-group-toggle litipodepago"></div>

					</div>
				</div>
				</div>

				
		</div>
	</div>
</div>

					<!---AGREGUE PAIS,ESTADO,MUNICIPIO,LOCALIDAD--->

					

				
						
					
					

					
	

			


					
					
					</div>
				


					
					
				</div>

				

					</div>

			</div>


			<div style="width: 100%;">
				
				
				
				
						</div>

		</div>
	</div>
</form>


</div>


<link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- <script  type="text/javascript" src="./js/mayusculas.js"></script> -->

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
	

	#picker3 table {
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

</style>



	<script type="text/javascript">
		idsucursal='<?php echo $idsucursal; ?>';
		idpaquete='<?php echo $idpaquete; ?>';
		idmenumodulo='<?php echo $idmenumodulo; ?>';
		ObtenerCategoriasPaquete();
		//ObtenerClientesFiltro();
		//PintarCalendario3();
	 ObtenerTipodepagosCitas();

	</script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


	<script type="text/javascript">

</script>


