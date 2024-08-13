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

$idmenumodulo = $_POST['idmenumodulo'];

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
$idnotapago=$_POST['idnotapago'];
 ?>
<form id="f_nivel" name="f_nivel" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;">
				
				<?php
			
					//SCRIPT PARA CONSTRUIR UN BOTON
					$bt->titulo = "GUARDAR";
					$bt->icon = "mdi mdi-content-save";
					$bt->funcion = "var resp=MM_validateForm('v_nombre','','R'); if(resp==1){ GuardarNivel('f_nivel','catalogos/niveles/vi_nivel.php','main','$idmenumodulo');}";
					$bt->estilos = "float: right;";
					$bt->permiso = $permisos;
					$bt->class='btn btn-success';
				
					//validamos que permiso aplicar si el de alta o el de modificacion
				if($idPagos == 0)
					{
						$bt->tipo = 1;
					}else{
						$bt->tipo = 2;
					}
			
					//$bt->armar_boton();
				?>
				
				<!--<button type="button" onClick="var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main');}" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>-->
				
				<button type="button" onClick="aparecermodulos('catalogos/notaspago/vi_notaspago.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i>VER LISTADO</button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idpagos; ?>" />
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
	
	
 <div class="col-md-6 divdetalle" style="">
<!-- 					<label for="">DETALLE DE NOTA</label>
 -->					<div class="row">
						<div class="col-md-12">
							<span id="folionota" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;"></span>

    <span id="fechapago" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;margin-top: 1em;"></span>
						</div>
						
					</div>
			
				<div class="divdetallenota" id="divdetallenota"></div>

							<!-- <div class="row">
								<div class="col-md-12">
									<button class="btn btn-success btncambiarestatus" onclick="">ACEPTAR PAGO</button>
								</div>
							</div> -->

							</div>
				</div>
			</div>

</form>

<div class="modal" id="modalimagen" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

		 <div class="modal-body">
		      	<div class="row">
		       <img id="imagenModal" src="" alt="Imagen" onclick="zoomImagen(event)">
		   </div>
		</div>
  </div>
</div>
</div>




<style>
	.modal img {
  display: block;
  margin: 0 auto;
  max-width: 90%;
  max-height: 90%;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.modal img.zoom {
  transform: scale(1.5);
  max-width: 100%;
  max-height: 100%;
}

</style>
			<script>
				var idnotapago="<?php echo $idnotapago; ?>";
				Detallepago(idnotapago);
			</script>