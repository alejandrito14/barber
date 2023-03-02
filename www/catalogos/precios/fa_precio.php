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


$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion
/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos nuestras clases
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Precios.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");

$idmenumodulo = $_GET['idmenumodulo'];

//Se crean los objetos de clase
$db = new MySQL();
$emp = new Precios();
$f = new Funciones();
$bt = new Botones_permisos();

$emp->db = $db;

$emp->tipo_usuario = $tipousaurio;
$emp->lista_empresas = $lista_empresas;

//Validamos si cargar el formulario para nuevo registro o para modificacion
if(!isset($_GET['idprecio'])){
	//El formulario es de nuevo registro
	$idprecio = 0;

	//Se declaran todas las variables vacias
	 $dia='';
	 $mes='';
	 $anio='';
	 $hora='';
	 $estatus=1;
	$disable="";

	$col = "col-md-12";
	$ver = "display:none;";
	$titulo='NUEVO PRECIO';
	$cheprincipal="";
	$principal=0;

}else{
	//El formulario funcionara para modificacion de un registro

	//Enviamos el id del pagos a modificar a nuestra clase Pagos
	$idprecio = $_GET['idprecio'];
	$emp->idprecio = $idprecio;

	//Realizamos la consulta en tabla Pagos
	$result_precio = $emp->Obtenerprecio();
	$result_precio_row = $db->fetch_assoc($result_precio);


	//Cargamos en las variables los datos 

	//DATOS GENERALES
	$precio=$f->imprimir_cadena_utf8($result_precio_row['precio']);
	
	$estatus = $f->imprimir_cadena_utf8($result_precio_row['estatus']);
	$principal = $result_precio_row['principal'];
	$cheprincipal="";
$disable="";
	if ($principal==1){

		$cheprincipal="checked";
		$disable="disabled";

	}

	$col = "col-md-12";
	$ver = "";
		$titulo='EDITAR PRECIO';

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

<form id="f_precio" name="f_precio" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;">
				
				<?php
			
					//SCRIPT PARA CONSTRUIR UN BOTON
					$bt->titulo = "GUARDAR";
					$bt->icon = "mdi mdi-content-save";
					$bt->funcion = "var resp=MM_validateForm('v_nombre','','R'); if(resp==1){ Guardarprecio('f_precio','catalogos/precios/vi_precio.php','main','$idmenumodulo');}";
					$bt->estilos = "float: right;";
					$bt->permiso = $permisos;
					$bt->class='btn btn-success';
				
					//validamos que permiso aplicar si el de alta o el de modificacion
				if($idprecio == 0)
					{
						$bt->tipo = 1;
					}else{
						$bt->tipo = 2;
					}
			
					$bt->armar_boton();
				?>
				
				<!--<button type="button" onClick="var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main');}" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>-->
				
				<button type="button" onClick="aparecermodulos('catalogos/precios/vi_precio.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i> LISTADO DE PRECIOS</button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idprecio; ?>" />
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="<?php echo $col; ?>">
			<div class="card">
				<div class="card-header" style="padding-bottom: 0; padding-right: 0; padding-left: 0; padding-top: 0;">
					<!--<h5>DATOS</h5>-->

				</div>
		<div class="col-md-6">

				<div class="card-body">
					
					
					<div class="tab-content tabcontent-border">
						<div class="tab-pane active show" id="generales" role="tabpanel">

					
							
							<div class="form-group m-t-20">
								<label>*PRECIO:</label>
								<input type="text" class="form-control" id="v_precio" name="v_precio" value="<?php echo $precio; ?>" title="PRECIO" placeholder='PRECIO'>
							</div>

					<div class="form-group m-t-20">

						<div class="row">

							<div class="col-md-2">	
								PRINCIPAL:
							</div>
							<div class="col-md-1">
								
								<input type="checkbox" onchange="Cambiarprincipal()" class="form-control" id="v_principal" name="v_principal" value="<?php echo $principal; ?>"  style="    margin-top: .3em;" title="PRINCIPAL" placeholder='PRINCIPAL' <?php echo $cheprincipal; ?>  <?php echo $disable; ?>>
							</div>
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>

						</div>
						
				
					</div>


							
						<div class="form-group m-t-20">
							<label>ESTATUS:</label>
							<select name="v_estatus" id="v_estatus" title="Estatus" class="form-control"  >
								<option value="0" <?php if($estatus == 0) { echo "selected"; } ?> >DESACTIVO</option>
								<option value="1" <?php if($estatus == 1) { echo "selected"; } ?> >ACTIVADO</option>
							</select>
						</div>

						
							
						</div>
						
						
					
					</div>
				</div>

			</div>


			</div>
		</div>


	</div>
</form>



<?php

?>