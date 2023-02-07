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

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos nuestras clases
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Empresas.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Pais.php");

$idmenumodulo = $_GET['idmenumodulo'];

//Se crean los objetos de clase
$db = new MySQL();
$emp = new Empresas();
$f = new Funciones();
$bt = new Botones_permisos();
$pais = new Paises();
$pais->db=$db;
$resul_paises=$pais->ObtenerPaices();
$result_paises_row=$db->fetch_assoc($resul_paises);
$result_paises_num=$db->num_rows($resul_paises);

$emp->db = $db;


//Validamos si cargar el formulario para nuevo registro o para modificacion
if(!isset($_GET['idempresas'])){
	//El formulario es de nuevo registro
	$idempresas = 0;

	//Se declaran todas las variables vacias
	$empresa = "";
	$direccion = "";
	$telefono = "";
	$email = "";
	$contactos = "";
	$estatus = 1;

	$f_rfc = "";
	$f_razonsocial = "";
	$f_calle = "";
	$f_no_ext = "";
	$f_no_int = "";
	$f_colonia = "";
	$f_estado = "";
	$f_ciudad = "";
	$f_cp = "";
	
	$col = "col-md-12";
	$ver = "display:none;";

	$titulo='NUEVA EMPRESA';

}else{
	//El formulario funcionara para modificacion de un registro

	//Enviamos el id de la empresa a modificar a nuestra clase empresas
	$idempresas = $_GET['idempresas'];
	$emp->idempresas = $idempresas;

	//Realizamos la consulta en tabla empresas
	$result_empresas = $emp->buscarEmpresa();
	$result_empresas_row = $db->fetch_assoc($result_empresas);

	//Cargamos en las variables los datos de las empresas

	//DATOS GENERALES
	$empresa = $f->imprimir_cadena_utf8($result_empresas_row['empresas']);
	$direccion = $f->imprimir_cadena_utf8($result_empresas_row['direccion']);
	$telefono = $result_empresas_row['telefono'];
	$email = $f->imprimir_cadena_utf8($result_empresas_row['email']);
	$contactos = $f->imprimir_cadena_utf8($result_empresas_row['contactos']);
	$estatus = $result_empresas_row['estatus'];

	//DATOS FISCALES
	$f_rfc = $f->imprimir_cadena_utf8($result_empresas_row['f_rfc']);
	$f_razonsocial = $f->imprimir_cadena_utf8($result_empresas_row['f_razonsocial']);
	$f_calle = $f->imprimir_cadena_utf8($result_empresas_row['f_calle']);
	$f_no_ext = $f->imprimir_cadena_utf8($result_empresas_row['f_no_ext']);
	$f_no_int = $f->imprimir_cadena_utf8($result_empresas_row['f_no_int']);
	$f_colonia = $f->imprimir_cadena_utf8($result_empresas_row['f_colonia']);
	$f_ciudad = $f->imprimir_cadena_utf8($result_empresas_row['f_ciudad']);
	$f_cp = $result_empresas_row['f_cp'];
	$f_pais=$f->imprimir_cadena_utf8($result_empresas_row['f_pais']);
	$f_municipio=$f->imprimir_cadena_utf8($result_empresas_row['f_municipio']);
	$f_estado = $f->imprimir_cadena_utf8($result_empresas_row['f_estado']);

	$col = "col-md-12";
	$ver = "";
	$titulo='EDITAR EMPRESA';

}

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

<form id="f_empresa" name="f_empresa" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;">
				
				
				<!--<button type="button" onClick="var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main');}" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>-->

				<?php
				

					//SCRIPT PARA CONSTRUIR UN BOTON
				$bt->titulo = "GUARDAR";
				$bt->icon = "mdi mdi-content-save";
				$bt->funcion = "var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main','$idmenumodulo');}";
				$bt->estilos = "float: right;";
				$bt->permiso = $permisos;
				$bt->class='btn btn-success';
				
					//validamos que permiso aplicar si el de alta o el de modificacion
				if($idempresas == 0)
				{
					$bt->tipo = 1;
				}else{
					$bt->tipo = 2;
				}

				$bt->armar_boton();
				
				?>
				
				<button type="button" onClick="aparecermodulos('catalogos/empresas/vi_empresas.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i> LISTADO DE EMPRESAS</button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idempresas; ?>" />
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="<?php echo $col; ?>">
			<div class="card">
				<div class="card-header" style="padding-bottom: 0; padding-right: 0; padding-left: 0; padding-top: 0;">
					<!--<h5>DATOS</h5>-->

					<ul class="nav nav-tabs" id="empresas_tabs" role="tablist">
						<li class="nav-item"> 
							<a class="nav-link active show" data-toggle="tab" href="#generales" role="tab" aria-selected="true">
								<span class="hidden-sm-up"></span> 
								<span class="hidden-xs-down" style="font-weight: bold; font-size: 12px;">GENERALES</span>
							</a>
						</li>
						<li class="nav-item"> 
							<a class="nav-link" data-toggle="tab" href="#fiscales" role="tab" aria-selected="false">
								<span class="hidden-sm-up"></span> 
								<span class="hidden-xs-down" style="font-weight: bold; font-size: 12px;">FISCALES</span>
							</a> 
						</li>
					</ul>
				</div>

				<div class="card-body">
					
					
					<div class="tab-content tabcontent-border">
						<div class="tab-pane active show" id="generales" role="tabpanel">
							<div class="form-group m-t-20">
								<label>*EMPRESA:</label>
								<input type="text" class="form-control" id="v_empresa" name="v_empresa" value="<?php echo $empresa; ?>" placeholder='EMPRESA' title="EMPRESA" tabindex="109" autofocus>
							</div>

							<div class="form-group m-t-20">
								<label>*DIRECCI&Oacute;N:</label>
								<textarea id="v_direccion" class="form-control" name="v_direccion" title="DIRECCION" style="height: 85px;" tabindex="110"><?php echo $direccion; ?></textarea>
							</div>

							<div class="form-group m-t-20">
								<label>TEL&Eacute;FONO:</label>
								<input type="text" class="form-control" id="v_telefono" name="v_telefono" value="<?php echo $telefono; ?>" title="TELEFONO"   tabindex="111" placeholder='TELEFONO'>
							</div>

							<div class="form-group m-t-20">
								<label>EMAIL:</label>
								<input type="email" class="form-control" id="v_email" name="v_email" value="<?php echo $email; ?>" title="Email" placeholder='EMAIL' tabindex="112">
							</div>

							<div class="form-group m-t-20">
								<label>CONTACTOS:</label>
								<textarea id="v_contactos" name="v_contactos" class="form-control" style="height: 85px;" tabindex="113"><?php echo $contactos; ?></textarea>
							</div>

							<div class="form-group m-t-20">
								<label>ESTATUS:</label>
								<select id="v_estatus" name="v_estatus" class="form-control" tabindex="114">
									<option value="0" <?php if(0 == $estatus){ echo "selected"; }?>>DESACTIVADO</option>
									<option value="1" <?php if(1 == $estatus){ echo "selected"; }?>>ACTIVADO</option>
								</select>
							</div>	
						</div>
						
						
						<div class="tab-pane" id="fiscales" role="tabpanel">

								<div class="row">
								<div class="col-md-4">

									<div class="form-group m-t-20">
										<label>PAIS:</label>
										<select name="v_pais" id="v_pais" class="form-control" onchange="ObtenerEstadosCatalogo(0,$(this).val(),'v_f_estado')">
											<option value="0">SELECCIONAR PAIS</option>
											<?php
											do
											{
												?>
												<option  value="<?php echo $result_paises_row['idpais'] ?>"  <?php if($result_paises_row['idpais'] == $f_pais){ echo "selected"; }?>><?php echo strtoupper($f->imprimir_cadena_utf8($result_paises_row['pais']));?></option>
												<?php
											}while($result_paises_row = $db->fetch_assoc($resul_paises));
											?>
										</select>

									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group m-t-20">
										<label>ESTADO:</label>
										<!-- <input type="text" onchange="ObtenerMunicipios(0);" class="form-control" name="v_f_estado" id="v_f_estado" value="<?php echo $f_estado; ?>" placeholder='ESTADO'> -->

										<select onchange="ObtenerMunicipiosCatalogo(0,$(this).val(),'v_municipio');" name="v_f_estado" id="v_f_estado" class="form-control" >
											<option value="0">SELECCIONAR ESTADO</option>
										</select>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label>MUNICIPIO:</label>


									<select  name="v_municipio" id="v_municipio" class="form-control" >
										<option value="0">SELECCIONAR MUNICIPIO</option>

									</select>
								</div>

							</div>

						<div class="row">

									<div class="col-md-4">
									<div class="form-group">
										<label>LOCALIDAD:</label>
										<input type="text" class="form-control" name="v_f_ciudad" id="v_f_ciudad" value="<?php echo $f_ciudad; ?>" placeholder='LOCALIDAD'>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>CP:</label>
										<input type="text" class="form-control" id="v_f_cp" name="v_f_cp" value="<?php echo $f_cp; ?>" placeholder='CP'>
									</div>
								</div>
							
								<div class="form-group col-md-4">
									<label>COLONIA:</label>
									<input type="text" class="form-control" id="v_f_colonia" name="v_f_colonia" value="<?php echo $f_colonia; ?>" placeholder='COLONIA'>
								</div>

						

						

						</div>

							<div class="row">
							

							<div class="col-md-8">
								<label>AVENIDA/BLVD/CALLE:</label>
								<textarea id="v_f_calle" name="v_f_calle" class="form-control" style="height: 85px;"><?php echo $f_calle; ?></textarea>
							</div>
							<div class="col-md-4"></div>

								<div class="col-md-4">
									<div class="form-group m-t-20">
										<label>NO. INT.</label>
										<input type="text" class="form-control" id="v_no_int" name="v_f_no_int" placeholder='NO.INT' value="<?php echo $f_no_int; ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group m-t-20">
										<label>NO. EXT.</label>
										<input type="text" class="form-control" id="v_no_ext" name="v_f_no_ext" value="<?php echo $f_no_ext; ?>" placeholder='NO.EXT'>
									</div>
								</div>








							</div>
							<div class="row">
							<div class="form-group col-md-4">
								<label>RFC:</label>
								<input type="text" class="form-control" id="v_f_rfc" name="v_f_rfc" value="<?php echo $f_rfc; ?>" placeholder='RFC' />
							</div>

									<div class="col-md-4">
								<label>RAZ&Oacute;N SOCIAL:</label>
								<input type="text" class="form-control" id="v_f_razonsocial" name="v_f_razonsocial" value="<?php echo $f_razonsocial; ?>" placeholder='RAZÓN SOCIAL'/>
							</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-9"></div>
					<div class="col-md-2">

					</div>
				</div>
				<br>
				
			</div>
		</div>

		<div class="<?php echo $col; ?>" style="<?php echo $ver; ?>">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title" style="float: left;">SUCURSALES</h5>
					
					<!--<button type="button" onClick="abrir_modal_formulario('catalogos/empresas/sucursales/fa_sucursales.php?idempresas=<?php echo $idempresas; ?>','AGREGAR SUCURSAL A <?php echo $empresa; ?>');" class="btn btn-info" style="float: right; margin-right: 10px; <?php echo $ver; ?> "><i class="mdi mdi-plus-circle"></i>  AGREGAR SUCURSAL</button>-->
					<div>
						<?php
						//SCRIPT PARA CONSTRUIR UN BOTON
						$bt->titulo = "AGREGAR SUCURSAL";
						$bt->icon = "mdi mdi-plus-circle";
						$bt->funcion = "abrir_modal_formulario('catalogos/empresas/sucursales/fa_sucursales.php?idempresas=".$idempresas."','AGREGAR SUCURSAL A ".$empresa."');";
						$bt->estilos = "float:right;";
						$bt->class='btn btn-info';
						$bt->permiso = $permisos;
						$bt->tipo = 1;

						$bt->armar_boton();
						?>
					</div>
					
					<div style="clear: both;"></div>
				</div>

				<div class="card-body" id="content_sucursales" style="overflow: scroll;">				
				</div>
			</div>
		</div>
	</div>
</form>

<script  type="text/javascript" src="./js/mayusculas.js"></script>
<script>
	phoneFormatter('v_telefono');
	RFCFormatter('v_f_rfc');
   $('#v_pais').chosen({width:"100%"});
   $("#v_f_estado").chosen({width:"100%"});
   $("#v_municipio").chosen({width:"100%"});

</script>

<?php if (isset($_GET['idempresas'])){ ?>
	
		<script>
			ObtenerEstadosCatalogo(<?php echo $f_estado;?>,<?php echo $f_pais;?>,'v_f_estado')


			ObtenerMunicipiosCatalogo(<?php echo $f_municipio; ?>,<?php echo $f_estado; ?>,'v_municipio');


		</script>

<?php } ?>

<?php
if($idempresas > 0){
	?>
	<script>
		aparecermodulos('catalogos/empresas/sucursales/li_sucursales.php?idempresas=<?php echo $idempresas; ?>','content_sucursales');
	</script>
	<?php
}
?>