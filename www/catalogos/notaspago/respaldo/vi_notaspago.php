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
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Funciones.php");

//Declaración de objeto de clase conexión
$db = new MySQL();
$notapago = new Notapago();
$bt = new Botones_permisos(); 
$f = new Funciones();

$notapago->db = $db;


//obtenemos todas las empreas que puede visualizar el usuario.

$notapago->tipo_usuario = $tipousaurio;
$notapago->lista_empresas = $lista_empresas;

$l_pagos = $notapago->ObtTodosNotaPagos();
$l_pagos_row = $db->fetch_assoc($l_pagos);


$l_pagos_num = $db->num_rows($l_pagos);

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



$estatus=array('PENDIENTE','ACEPTADO','CANCELADO');
$estatuspago = array('NO PAGADO','PAGADO');
?>

<div class="card">
	<div class="card-body">
		<h5 class="card-title" style="float: left;">LISTADO DE NOTA DE PAGOS</h5>
		
		<div style="float:right;">
			<button type="button" onClick="abrir_filtro('modal-filtros');" class="btn btn-primary" style="float: right;display: none;"><i class="mdi mdi-account-search"></i>  BUSCAR</button>			
			
			<?php
		
				//SCRIPT PARA CONSTRUIR UN BOTON
				$bt->titulo = "NUEVO COBRO";
				$bt->icon = "mdi-plus-circle";
				$bt->funcion = "aparecermodulos('catalogos/notaspago/fa_notaspago.php?idmenumodulo=$idmenumodulo','main');";
				$bt->estilos = "float: right; margin-right:10px;";
				$bt->permiso = $permisos;
				$bt->tipo = 5;
				$bt->title="NUEVO PAGO";
				

				//$bt->armar_boton();
			
			?>
			
			<div style="clear: both;"></div>
		</div>
		
		<div style="clear: both;"></div>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive" id="contenedor_Pagos">
				<div class="row" style="margin-bottom:1em;">
				<div class="col-md-9"></div>
					<div class="col-md-3">
							<button id="exportarBtn" class="btn btn-success" style="margin-left: 70px;display: none;">Exportar a Excel</button>
					</div>
			</div>
		

			<table id="tbl_pagos" cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
				<thead>
					<tr>
						 
						<th style="text-align: center;">FOLIO </th> 
						<th style="text-align: center;">ALUMNO</th>
						<th style="text-align: center;">FECHA</th>
						<th style="text-align: center;">MÉTODO DE PAGO</th>
						<th style="text-align: center;">MONTO</th>
						<th style="text-align: center;">ESTATUS</th>

						<th style="text-align: center;">ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					if($l_pagos_num== 0){
						?>
						<tr> 
							<td colspan="6" style="text-align: center">
								<h5 class="alert_warning">NO EXISTEN REGISTROS EN LA BASE DE DATOS.</h5>
							</td>
						</tr>
						<?php
					}else{
						do
						{
							?>
							<tr>
							
						
							
							<td style="text-align: center;"><?php echo $l_pagos_row['folio'];?></td>

							<td style="text-align: center;"><?php echo $l_pagos_row['nombre'].' '.$l_pagos_row['paterno'].' '.$l_pagos_row['materno'];?></td>

							<td style="text-align: center;"><?php echo date('d-m-Y H:i:s',strtotime($l_pagos_row['fecha']));?></td>
							<td style="text-align: center;"><?php echo $l_pagos_row['tipopago'];?></td>

							<td style="text-align: center;">$<?php echo $l_pagos_row['total'];?></td>
							<?php 
								$clase="";

								if ($l_pagos_row['estatus']==0) {
									$clase='notapendiente';
								}

									if ($l_pagos_row['estatus']==1) {
									$clase='notaaceptado';
								}

								if ($l_pagos_row['estatus']==2) {
									$clase='notacancelado';
								}

							 ?>
						
							<td style="text-align: center;"><span class="<?php echo $clase; ?>"><?php echo $estatus[$l_pagos_row['estatus']];?></span></td>

							<td style="text-align: center; font-size: 15px;">

									<?php
													//SCRIPT PARA CONSTRUIR UN BOTON
									$bt->titulo = "";
									$bt->icon = "mdi-eye";
									$bt->funcion = "VerdatelleNotapago('".$l_pagos_row['idnotapago']."','".$l_pagos_row['idusuario']."','".$idmenumodulo."')";
									$bt->estilos = "";
									$bt->permiso = $permisos;
									$bt->tipo = 2;
									$bt->title="VER DETALLE";
									$bt->class='btn btn_accion';
									$bt->armar_boton();


									?>

								</td>


							</tr>
							<?php
						}while($l_pagos_row = $db->fetch_assoc($l_pagos));
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal" id="modaldetallenota" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">DETALLE DE NOTA DE PAGO </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="card" style="">
	 	 <div class="card-body">
	    	<h5 class="card-title" style="font-weight: bold;">FOLIO </h5>
	    	<h4 id="folio" style="font-weight: normal;"></h4>

	    	<div class="row">
	    		
	    		<div class="col-md-6">
	    			

	    	<h5 class="card-title" style="font-weight: bold;">TIPO DE PAGO </h5>
	    	<h4 id="tipopago" style="font-weight: normal;"></h4>
	    		</div>
	    		<div class="col-md-6">
	    			

	    	<h5 class="card-title" style="font-weight: bold;">FECHA DE PAGO </h5>
	    	<h4 id="fechapago" style="font-weight: normal;"></h4>

	    		</div>

	    	</div>




	    	<h5 class="card-title" style="font-weight: bold;">ALUMNO </h5>
	    	<h4 id="alumno" style="font-weight: normal;"></h4>


	    	
	 	 </div>
		</div>

      	<table class="table table-striped table-bordered ">
      		<thead>
      			<tr >
      				<th style="text-align: center;">CONCEPTO</th>
      				<th style="text-align: center;">MONTO</th>

      			</tr>
      		</thead>
      		<tbody class="listadopagos"></tbody>
      	</table>
       
       	<table class="table table-striped table-bordered ">
      		<tbody class="listadodescuentos"></tbody>
      	</table>

      		<table class="table table-striped table-bordered ">
      		<tbody class="listadodescuentosmembresia"></tbody>
      	</table>

      	      	<div class="modaldetalle"></div>

      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modalfiltro" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">EXPORTAR A EXCEL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="">
      		  <div class="form-group">
			    <label for="formGroupExampleInput">Fecha inicio</label>
			    <input type="date" class="form-control" id="txtfechainicio" placeholder="">
			  </div>

			  <div class="form-group">
			    <label for="formGroupExampleInput">Fecha final</label>
			    <input type="date" class="form-control" id="txtfechafinal" placeholder="">
			  </div>
      	</form>
     	

      		
      </div>
      <div class="modal-footer">

      	<button type="button" class="btn btn-success" onclick="ExportarExcel()">EXPORTAR</button>
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">





	  $('#exportarBtn').click(function() {

	  	$("#modalfiltro").modal();
	  	
		});

		function ExportarExcel() {
	var idservicio='';
	var fechainicio=$("#txtfechainicio").val();
	var fechafin=$("#txtfechafinal").val();

	var horainicio='';
	var horafin='';

	var fechainicio1=fechainicio.split(' ')[0];
	var fechafin1=fechafin.split(' ')[0];

	var datos="idservicio="+idservicio+"&fechainicio="+fechainicio1+"&fechafin="+fechafin1+"&horainicio="+horainicio+"&horafin="+horafin+"&pantalla=0";

	var url='catalogos/notaspago/reporte/reportenotas.php?'+datos; 

			window.open(url, '_blank');
		}
</script>

