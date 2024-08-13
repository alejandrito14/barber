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
$lista_fechasinhabilesresas = $_SESSION['se_lifechasinhabilesresas']; //variables de sesion

//validaciones para todo el sistema


/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importación de clase conexión
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Fechasinhabiles.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Funciones.php");

//Declaración de objeto de clase conexión
$db = new MySQL();
$fechasinhabiles = new Fechasinhabiles();
$bt = new Botones_permisos(); 
$fu = new Funciones();

$fechasinhabiles->db = $db;
$idsucursal=$se->obtenerSesion('idsucursalsesion');
$fechasinhabiles->idsucursal=$idsucursal;
//obtenemos todas las fechasinhabilesreas que puede visualizar el usuario.

$fechasinhabiles->tipo_usuario = $tipousaurio;
$fechasinhabiles->lista_fechasinhabilesresas = $lista_fechasinhabilesresas;

$l_fechasinhabiles = $fechasinhabiles->ObtTodosfechainhabil();
$l_fechasinhabiles_row = $db->fetch_assoc($l_fechasinhabiles);
$l_fechasinhabiles_num = $db->num_rows($l_fechasinhabiles);


$arrayopcion=array('NO','SI');
$estatus = array('DESACTIVADO','ACTIVADO');

/*======================= INICIA VALIDACIÓN DE RESPUESTA (alertas) =========================*/

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

/*======================= TERMINA VALIDACIÓN DE RESPUESTA (alertas) =========================*/

//*================== INICIA RECIBIMOS PARAMETRO DE PERMISOS =======================*/

if(isset($_SESSION['permisos_acciones_erp'])){
						//Nombre de sesion | pag-idmodulos_menu
	$permisos = $_SESSION['permisos_acciones_erp']['pag-'.$idmenumodulo];	
}else{
	$permisos = '';
}
//*================== TERMINA RECIBIMOS PARAMETRO DE PERMISOS =======================*/





?>

<script type="text/javascript">
	
	 $('#zero_config1').DataTable( {		
		 	"pageLength": 100,
			"oLanguage": {
						"sLengthMenu": "Mostrar _MENU_ ",
						"sZeroRecords": "NO EXISTEN PROVEEDORES EN LA BASE DE DATOS.",
						"sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
						"sInfoEmpty": "desde 0 a 0 de 0 records",
						"sInfoFiltered": "(filtered desde _MAX_ total Registros)",
						"sSearch": "Buscar",
						"oPaginate": {
									 "sFirst":    "Inicio",
									 "sPrevious": "Anterior",
									 "sNext":     "Siguiente",
									 "sLast":     "Ultimo"
									 }
						},
		   "sPaginationType": "full_numbers", 
		 	"paging":   true,
		 	"ordering": true,
        	"info":     false,
        	"order": [],


		} );
</script>

<div class="card">
	<div class="card-body">
		<h5 class="card-title" style="float: left;">LISTADO DE FECHAS INHABILES</h5>
		
		<div style="float:right;">
			<button type="button" onClick="abrir_filtro('modal-filtros');" class="btn btn_accion" style="float: right;display: none;"><i class="mdi mdi-account-search"></i>  FILTRAR</button>			
			
			<?php
			
				//SCRIPT PARA CONSTRUIR UN BOTON
			$bt->titulo = "NUEVA FECHA INHÁBIL";
			$bt->icon = "mdi-plus-circle";
			$bt->funcion = "aparecermodulos('catalogos/fechainhabil/fa_fechainhabil.php?idmenumodulo=$idmenumodulo','main');";
			$bt->estilos = "float: right; margin-right:10px;";
			$bt->permiso = $permisos;
			$bt->tipo = 5;
			$bt->title="NUEVO FECHA INHÁBIL";
			$bt->armar_boton();
			
			?>
			
			<div style="clear: both;"></div>
		</div>
		
		<div style="clear: both;"></div>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive" id="contenedor_fechasinhabilesresas">
			<table id="zero_config1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th style="text-align: center;">FECHA</th> 
						<th style="text-align: center;">ESTATUS</th> 
						<th style="text-align: center;">ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>


					<?php if ($l_fechasinhabiles_num>0){

						do { ?>

							<tr> 
								
								<td style="text-align: center;"><?php echo date('d-m-Y',strtotime($l_fechasinhabiles_row['fecha']));?></td>
								
								<td style="text-align: center;"><?php echo $estatus[$l_fechasinhabiles_row['estatus']];?></td>
								<td style="text-align: center;">

									


									<?php
													//SCRIPT PARA CONSTRUIR UN BOTON
									$bt->titulo = "";
									$bt->icon = "mdi-table-edit";
									$bt->funcion = "aparecermodulos('catalogos/fechainhabil/fa_fechainhabil.php?idmenumodulo=$idmenumodulo&idfechainhabil=".$l_fechasinhabiles_row['idfechainhabil']."','main')";
									$bt->estilos = "";
									$bt->permiso = $permisos;
									$bt->tipo = 2;
									$bt->title="EDITAR";
									$bt->class='btn btn_colorgray';
									$bt->armar_boton();



								 
				                  //SCRIPT PARA CONSTRUIR UN BOTON
				                  $bt->titulo = "";
				                  $bt->icon = "mdi-delete-empty";
				                  $bt->funcion ="BorrarDatosFechainhabil('".$l_fechasinhabiles_row['idfechainhabil']."','catalogos/fechainhabil/vi_fechainhabil.php','main','$idmenumodulo')";
				                  $bt->estilos = "";
				                  $bt->permiso = $permisos;
				                  $bt->tipo = 3;
				                  $bt->title="BORRAR";

				                  $bt->armar_boton();
               
									?>


								</td>
							</tr>
							

						<?php	} while ($l_fechasinhabiles_row=$db->fetch_assoc($l_fechasinhabiles));


					}else{ ?>
						
							<tr> 
							<td colspan="6" style="text-align: center">
								<h5 class="alert_warning">NO EXISTEN REGISTROS EN LA BASE DE DATOS.</h5>
							</td>
						</tr>


					<?php } ?> 
				</tbody>
			</table>
		</div>
	</div>
</div>





	<script type="text/javascript">
	//Buscar_Paquetes(<?php echo $idmenumodulo; ?>);
</script>
<div id="modales"></div>

<div class="modal" id="modalimagen" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Subir imágenes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<input type="hidden" id="idproductos" value="">
				<input type="hidden" id="idfechasinhabilesresas" value="">


				<form method="post" action="" enctype="multipart/form-data" id="uploadForm" >


					<input type="file" class=" inputfile inputfile-1 form-control"   name="file" id="demoimg" />

					<label  id="seleccionar">
						<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						<span class="iborrainputfile">Seleccionar archivos</span>
					</label> 




					<div id="vfileNames" class="row"></div>

					<p></p>


			<!-- 
                    <div class='progress' ><div id='progress_id' class='progress-bar progress-bar-striped active'role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'></div>

                  </div>
                      <div style="margin-left: 86%;padding-top: 0px;" class='percent' id='percent'>0%</div>
                  -->

                  <div id="contador"></div>
                  <div id="cargado"></div>
                  <div id='salidaImagen'></div>

              </form>


              <div class="tbl"></div>
          </div>
          <div class="modal-footer">

          </div>
      </div>
  </div>
</div>


<script>



	$(function(){

    //file input field trigger when the drop box is clicked
    $("#seleccionar").click(function(){
    	$("#demoimg").click();
    });
    
    //prevent browsers from opening the file when its dragged and dropped
    $(document).on('drop dragover', function (e) {
    	e.preventDefault();
    });

    //call a function to handle file upload on select file
    $('#demoimg').on('change', fileUpload);
});
</script>



<style>
	.input_container input {

		padding: 3px;
		border: 1px solid #cccccc;
		border-radius: 0;
	}
	.input_container div{
		width: 95%;
		border: 1px solid #fefefe;
		position: absolute;
		z-index: 9;
		background: #f3f3f3;
		list-style: none;
		margin-left: 1px;
	}
	.input_container div p {
		padding: 2px;
		cursor: pointer;
	}
	.input_container div p:hover {
		background: #eaeaea;

	}
	#country_list_id {
		display: none;
	}


	.box.box-alert{border-top-color:red}
	.box.box-ama{border-top-color:#f8e517}

	.inputfile {
		width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}

	.inputfile + label {
		max-width: 80%;
		font-size: 1.25rem;
		font-weight: 700;
		text-overflow: ellipsis;
		white-space: nowrap;
		cursor: pointer;
		display: inline-block;
		overflow: hidden;
		padding: 0.625rem 1.25rem;
	}

	.inputfile + label svg {
		width: 1em;
		height: 1em;
		vertical-align: middle;
		fill: currentColor;
		margin-top: -0.25em;
		margin-right: 0.25em;
	}

	.iborrainputfile {
		font-size:16px; 
		font-weight:normal;
		font-family: 'Lato';
	}
</style>