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
require_once("../../clases/class.Notificaciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Funciones.php");

//Declaración de objeto de clase conexión
$db = new MySQL();
$notificaciones = new Notificaciones();
$bt = new Botones_permisos(); 
$f = new Funciones();

$notificaciones->db = $db;


//obtenemos todas las empreas que puede visualizar el usuario.

$notificaciones->tipo_usuario = $tipousaurio;
$notificaciones->lista_empresas = $lista_empresas;

$l_notificaciones = $notificaciones->ObtenerTodosNotificaciones();
$l_notificaciones_row = $db->fetch_assoc($l_notificaciones);


$l_notificaciones_num = $db->num_rows($l_notificaciones);

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



$estatus=array('DESACTIVADO','ACTIVADO');

?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title" style="float: left;">LISTADO DE NOTIFICACIONES</h5>
		
		<div style="float:right;">
			<button type="button" onClick="abrir_filtro('modal-filtros');" class="btn btn-primary" style="float: right;display: none;"><i class="mdi mdi-account-search"></i>  BUSCAR</button>			
			
			<?php
		
				//SCRIPT PARA CONSTRUIR UN BOTON
				$bt->titulo = "NUEVO";
				$bt->icon = "mdi-plus-circle";
				$bt->funcion = "aparecermodulos('catalogos/notificaciones/fa_notificaciones.php?idmenumodulo=$idmenumodulo','main');";
				$bt->estilos = "float: right; margin-right:10px;";
				$bt->permiso = $permisos;
				$bt->tipo = 5;
				$bt->title="NUEVO";
				

				$bt->armar_boton();
			
			?>
			
			<div style="clear: both;"></div>
		</div>
		
		<div style="clear: both;"></div>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive" id="contenedor_notificaciones">
			<table id="tbl_notificaciones" cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
				<thead>
					<tr>
						 
						<th style="text-align: center;">TITULO </th> 
						<th style="text-align: center;">MENSAJE </th> 
						<th style="text-align: center;">PROGRAMADO</th>

						<th style="text-align: center;">ENVIADO</th>
						<th style="text-align: center;">FECHA DE CREACIÓN</th>

						<th style="text-align: center;">ESTATUS</th>

						<th style="text-align: center;">ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					if($l_notificaciones_num== 0){
						?>
						<tr> 
							<td colspan="7" style="text-align: center">
								<h5 class="alert_warning">NO EXISTEN REGISTROS EN LA BASE DE DATOS.</h5>
							</td>
						</tr>
						<?php
					}else{
						do
						{
							?>
							<tr>
							
						
							
							<td style="text-align: center;"><?php echo $f->imprimir_cadena_utf8($l_notificaciones_row['titulo']);?></td>
								<td style="text-align: center;"><?php echo $f->imprimir_cadena_utf8($l_notificaciones_row['mensaje']);?></td>
								<td  style="text-align: center;">

									<?php 

									if ($l_notificaciones_row['programado']==1) {
										echo "AHORA";
									}else{


										echo "PROGRAMADO"."<br>";
										echo "FECHA ".date('d-m-Y H:i',strtotime($l_notificaciones_row['fechahora']));

									}
									 ?>
									
									
								</td>

								<td  style="text-align: center;">

									<?php 

									if ($l_notificaciones_row['enviado']==1) {
										echo "Enviado";
									}else{


										echo "No enviado";

									}
									 ?>
									
									
								</td>


								<td style="text-align: center;"><?php echo date('d-m-Y H:i:s',strtotime($l_notificaciones_row['fechacreacion']))?></td>
						
							<td style="text-align: center;"><?php echo $estatus[$l_notificaciones_row['estatus']];?></td>

							<td style="text-align: center; font-size: 15px;">

									<?php
													//SCRIPT PARA CONSTRUIR UN BOTON

									if ($l_notificaciones_row['enviado']==0) {
										# code...
									
									$bt->titulo = "";
									$bt->icon = "mdi-table-edit";
									$bt->funcion = "aparecermodulos('catalogos/notificaciones/fa_notificaciones.php?idmenumodulo=$idmenumodulo&idnotificacion=".$l_notificaciones_row['idnotificacion']."','main')";
									$bt->estilos = "";
									$bt->permiso = $permisos;
									$bt->tipo = 2;
									$bt->title="EDITAR";
									$bt->class='btn btn_colorgray';
									$bt->armar_boton();
									}






									?>

									<button type="button" onclick="aparecermodulos('catalogos/notificaciones/fa_notificaciones.php?idmenumodulo=<?php echo $idmenumodulo;?>&idnotificacion=<?php echo $l_notificaciones_row['idnotificacion'];?>&copia=1','main')" class="btn btn_accion" style="" title="REPLICAR">
								<i class="mdi mdi mdi-vector-combine"></i>
						
								</button>

								</td>


							</tr>
							<?php
						}while($l_notificaciones_row = $db->fetch_assoc($l_notificaciones));
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>



<script type="text/javascript">
	 $('#tbl_notificaciones').DataTable( {		
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
		 	"ordering": false,
        	"info":     false


		} );
</script>
