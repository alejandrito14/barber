<?php


/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	//header("Location: ../../../login.php");
			/* header("Location: ../login.php"); */ echo "login";

	exit;
}

$idmenumodulo = $_GET['idmenumodulo'];


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

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/


//Importamos nuestras clases
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sucursal.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Categorias.php");

//Se crean los objetos de clase
$db = new MySQL();
$su = new Sucursal();
$f = new Funciones();
$bt = new Botones_permisos();
$su->db = $db;
$categoriassucursal=new Categorias();
$categoriassucursal->db=$db;

$idempresas = $_GET['idempresas'];

//Validamos si cargar el formulario para nuevo registro o para modificacion
if(!isset($_GET['idsucursales'])){
	//El formulario es de nuevo registro
	$idsucursales = 0;

	//Se declaran todas las variables vacias
	$sucursal = "";
	$direccion = "";
	$telefono = "";
	$telefono2="";
	$telefono3="";
	$telefono4="";
	$email = "";
	$estatus = 1;
	$iva="";
	$ruta="images/sinfoto.png";
	$ruta2="images/sinfoto.png";

		$rutaticket="images/sinfoto.png";

	$titulo="AGREGAR SUCURSAL";
	$solicitarfactura=1;
	$ubicacion="";

	$obtenerorden=$su->ObtenerUltimoOrdensucursal();
	$roworden=$db->fetch_assoc($obtenerorden);
	$num=$db->num_rows($obtenerorden);
	if ($num>0) {
		$orden=$roworden['ordenar']+1;
	}else{
		$orden=0;
	}

		$iddatofiscal=0;
	
	$ticketventa=0;
	$ticketproduccion=0;
	$tproduccionch="";
	$tventach="";
	$leyenda="";
	$recordatorio=0;
	$minutosrecordatorio="";
	$mensajeempresa="";
	$mensajecliente="";
	$notaventach="";
	$notaventa=0;
	$campomontofactura=0;
	$mensajesecciontipopago="";
	$celular="";
	$ubicacion="";
	$idcategoriasucursal=="";
	$horascancelacion=0;
}else{
	//El formulario funcionara para modificacion de un registro

	//Enviamos el id de la empresa a modificar a nuestra clase camiones areas
	$idsucursales = $_GET['idsucursales'];
	$su->idsucursales = $idsucursales;

	//Realizamos la consulta en tabla camiones areas
	$result_sucursal = $su->buscar_sucursal();
	$result_sucursal_row = $db->fetch_assoc($result_sucursal);

	//Cargamos en las variables los datos de las areas de camiones

	//DATOS GENERALES
	$sucursal = $f->imprimir_cadena_utf8($result_sucursal_row['titulo']);
	$descripcion=$result_sucursal_row['descripcion'];
	$direccion = $f->imprimir_cadena_utf8($result_sucursal_row['direccion']);
	$telefono = $f->imprimir_cadena_utf8($result_sucursal_row['telefono']);
	$email = $f->imprimir_cadena_utf8($result_sucursal_row['email']);
	$estatus = $result_sucursal_row['estatus'];
	$foto = $f->imprimir_cadena_utf8($result_sucursal_row['imagen']);
	$foto2=$result_sucursal_row['imagensecundaria'];
	$imagenticket=$result_sucursal_row['imagenticket'];
	$orden = $f->imprimir_cadena_utf8($result_sucursal_row['orden']);
$ubicacion=$result_sucursal_row['ubicacion'];
	$pais=$result_sucursal_row['pais'];
	$estado=$result_sucursal_row['estado'];
	$municipio=$result_sucursal_row['municipio'];

	$iddatofiscal=$result_sucursal_row['iddatofiscal'];
	$colonia=$result_sucursal_row['colonia'];
$idcategoriasucursal=$result_sucursal_row['idcategorias'];
	if ($iddatofiscal=='') {
		$iddatofiscal=0;
	}
	$telefono2 = $f->imprimir_cadena_utf8($result_sucursal_row['telefono2']);
	$telefono3 = $f->imprimir_cadena_utf8($result_sucursal_row['telefono3']);
	$telefono4 = $f->imprimir_cadena_utf8($result_sucursal_row['telefono4']);
$celular=$result_sucursal_row['celular'];
$ubicacion=$result_sucursal_row['ubicacion'];
$horascancelacion=$result_sucursal_row['horascancelacion'];
		/*$horainicio=$result_sucursal_row['horaentrada'];
	$horafin=$result_sucursal_row['horasalida'];*/
	$minutosconsiderados=$result_sucursal_row['minutosconsiderados'];
	$solicitarfactura=$result_sucursal_row['solicitarfactura'];
	$campomontofactura=$result_sucursal_row['campomontofactura'];

	$codigopostal=$result_sucursal_row['codigopostal'];

	$recordatorio=$result_sucursal_row['trecordatorio'];

	$minutosrecordatorio=$result_sucursal_row['minutosrecordatorio'];
	$mensajeempresa=$result_sucursal_row['mensajesucursal'];
	$mensajecliente=$result_sucursal_row['mensajecliente'];

	$notaventa=$result_sucursal_row['habilitarnotaventa'];
	$mensajesecciontipopago=$result_sucursal_row['mensajesecciontipopago'];


$campoporfecha=$result_sucursal_row['porfecha'];
$campoporespecialista=$result_sucursal_row['porbarbero'];
$checkporfecha="";
if ($campoporfecha==1) {
	$checkporfecha="checked";
}
$checkporespecialista="";
if ($campoporespecialista==1) {
	$checkporespecialista="checked";

}

	$check='';

	if ($solicitarfactura==1) {
		$check='checked';
	}

	$check2="";

	if ($recordatorio==1) {
		$check2='checked';
	}

	$check3="";
	if ($campomontofactura==1) {
		$check3='checked';
	}

	$iva = $result_sucursal_row['iva'];
	$titulo='EDITAR SUCURSAL';
	if($foto==""){
		$ruta="images/sinfoto.png";
	}
	else{
		$ruta="catalogos/sucursal/imagenes/".$_SESSION['codservicio']."/$foto";
	}

	if($foto2=="" || $foto2==null){
		$ruta2="images/sinfoto.png";
	}
	else{
		$ruta2="catalogos/sucursal/imagenes/".$_SESSION['codservicio']."/$foto2";
	}

	$foto3=$result_sucursal_row['imagenporfecha'];

	if($foto3=="" || $foto3==null){
		$ruta3="images/sinfoto.png";
	}
	else{
		$ruta3="catalogos/sucursal/imagenes/".$_SESSION['codservicio']."/$foto3";
	}

		$foto4=$result_sucursal_row['imagenporbarbero'];

	if($foto4=="" || $foto4==null){
		$ruta4="images/sinfoto.png";
	}
	else{
		$ruta4="catalogos/sucursal/imagenes/".$_SESSION['codservicio']."/$foto4";
	}

	if($imagenticket==""){
		$rutaticket="images/sinfoto.png";
	}
	else{
		$rutaticket="catalogos/sucursal/imagenesticket/".$_SESSION['codservicio']."/$imagenticket";
	}

	$tproduccion = $f->imprimir_cadena_utf8($result_sucursal_row['tproduccion']);

	$tventa = $f->imprimir_cadena_utf8($result_sucursal_row['tventa']);
	$tproduccionch="";
	$tventach="";

	if ($tproduccion==1) {
		$tproduccionch="checked";
	}

	if ($tventa==1) {
		$tventach="checked";
	}

	$notaventach="";
	if ($notaventa==1) {
		$notaventach="checked";
		}

	$leyenda=$f->imprimir_cadena_utf8($result_sucursal_row['leyendaticket']);
}
?>

<form id="f_sucursales" name="f_sucursales" method="post" action="">

	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;">
				
				<?php

			
					//SCRIPT PARA CONSTRUIR UN BOTON
					$bt->titulo = "GUARDAR";
					$bt->icon = "mdi mdi-content-save";
					$bt->funcion = "var resp=MM_validateForm('v_sucursal','','R'); if(resp==1){ Guardar_sucursal('f_sucursales','catalogos/sucursal/vi_sucursal.php','main','$idmenumodulo');}";
					$bt->estilos = "float: right;";
					$bt->permiso = $permisos;
					$bt->class='btn btn-success';
		
					if($idsucursales == 0)
					{
						$bt->tipo = 1;

					}else{
						$bt->tipo = 2;
					}

					$bt->armar_boton();
				?>
				
				<!--<button type="button" onClick="var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main');}" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>-->
				
				<button type="button" onClick="aparecermodulos('catalogos/sucursal/vi_sucursal.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i>LISTADO DE SUCURSALES</button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idsucursales; ?>" />
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">	

					<div class="col-md-6" >
									<label>IMAGEN PRINCIPAL:</label>

									<form method="post" action="#" enctype="multipart/form-data">
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top imagensucursal" src="">
								        <div id="d_foto" style="text-align:center; ">
											<img src="<?php echo $ruta; ?>" class="card-img-top" alt="" style="border: 1px #777 solid"/> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								            	
								               
								                <input type="file" class="form-control-file" name="image" id="image"  onchange="SubirImagenSucursal()">
								            </div>
								          <!--   <input type="button" class="btn btn-primary upload" value="Subir"> -->
								        </div>
								    </div>
								</form>
								<p style="text-align: center;">Dimensiones de la imagen Ancho:1280px Alto:852px</p>

								</div>



								<div class="col-md-6" >
									<label>IMAGEN SECUNDARIA:</label>

									<form method="post" action="#" enctype="multipart/form-data">
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top imagensucursal2" src="">
								        <div id="d_foto2" style="text-align:center; ">
											<img src="<?php echo $ruta2; ?>" class="card-img-top" alt="" style="border: 1px #777 solid"/> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								            	
								               
								                <input type="file" class="form-control-file" name="image2" id="image2"  onchange="SubirImagenSucursal2()">
								            </div>
								          <!--   <input type="button" class="btn btn-primary upload" value="Subir"> -->
								        </div>
								    </div>
								</form>
								<p style="text-align: center;">Dimensiones de la imagen Ancho:1280px Alto:852px</p>

								</div>

					<div class="col-md-6">
					<div class="form-group m-t-20">
						<label>*NOMBRE DE LA SUCURSAL:</label>
						<input type="text" class="form-control" id="v_sucursal" name="v_sucursal" value="<?php echo $sucursal; ?>" title="SUCURSAL" tabindex="109" autofocus>
					</div>

					<div class="form-group m-t-20">
						<label for="">*DESCRIPCIÓN</label>
						<textarea name="v_descripcion" id="v_descripcion" cols="20" rows="3" class="form-control"><?php echo $descripcion; ?></textarea>
					</div>

					<div class="form-group m-t-20" style="display: none;">
						<label>MINUTOS A CONSIDERAR AL REALIZAR EL PEDIDO:</label>
						<input type="number"  class="form-control" id="minutosconsiderados" name="minutosconsiderados" value="<?php echo $minutosconsiderados; ?>" tabindex="110">
					</div>




					


					<div class="form-group m-t-20">
						<label>CELULAR:</label>
						<input type="text" class="form-control" id="v_celular" name="v_celular" value="<?php echo $celular; ?>" tabindex="111" maxlength="10" placeholder='(___) ___ -____'>
					</div>

										<div class="form-group m-t-20">
											<label for="">CATEGORÍA DE SUCURSAL</label>
								<?php 
									$categorias= $categoriassucursal->obtenerTodas();
									
									$categorias_num=$db->num_rows($categorias);
									$categorias_row=$db->fetch_assoc($categorias);
								
								?>
								<select  class="form-control" id="v_categoriasucursal" name="v_categoriasucursal" >
									<option value="0">SELECCIONAR CATEGORÍA</option>
									<?php
									do{
									?>
									<option value="<?php echo ($categorias_row['idcategorias']);?>" <?php if($categorias_row['idcategorias']==$idcategoriasucursal){ echo ("selected");}?>><?php echo ($categorias_row['titulo']);?></option>
									
									<?php 
										} while($categorias_row=$db->fetch_assoc($categorias));
									?>
											</select>
									</div>

					<div class="form-group m-t-20" style="display:none;">
						<label>TEL&Eacute;FONO 2:</label>
						<input type="text" class="form-control" id="v_telefono2" name="v_telefono2" value="<?php echo $telefono2; ?>" tabindex="111" maxlength="10" placeholder='(___) ___ -____'>
					</div>
					<div class="form-group m-t-20" style="display:none;">
						<label>TEL&Eacute;FONO 3:</label>
						<input type="text" class="form-control" id="v_telefono3" name="v_telefono3" value="<?php echo $telefono3; ?>" tabindex="111" maxlength="10" placeholder='(___) ___ -____'>
					</div>
					<div class="form-group m-t-20" style="display:none;">
						<label>TEL&Eacute;FONO 4:</label>
						<input type="text" class="form-control" id="v_telefono4" name="v_telefono4" value="<?php echo $telefono4; ?>" tabindex="111" maxlength="10" placeholder='(___) ___ -____'>
					</div>

					<div style="margin-top: 3em">

							<div class="row">
								<div class="col-md-6">
									<label style="float: left;">HORARIO DE ATENCIÓN</label>
									<button class="btn btn-primary" type="button" style="    margin-top: -1em;" onclick="AgregarHorario()">+</button>
								</div>
								<div class="col-md-3">
										
									</div>
							</div>

								
								<div id="horarios"></div>




					</div>

					<div class="form-group m-t-20">
						<label>CODIGO POSTAL:</label>
						<input type="text" class="form-control" id="v_codigopostal" name="v_codigopostal" value="<?php echo $codigopostal; ?>" title="CÓDIGO POSTAL" tabindex="112" >
					</div>

					<div class="form-group m-t-20">
						<label>PAIS:</label>
						<select style="text-transform: uppercase;"  id="v_pais" class="form-control" onchange="ObtenerEstado(0,$(this).val())" tabindex="113"></select>
					</div>


					<div class="form-group m-t-20">
						<label>ESTADO:</label>
						<select  style="text-transform: uppercase;" id="v_estado" class="form-control" onchange="ObtenerMunicipios(0,$(this).val())" tabindex="114">
							<option value="0">SELECCIONAR ESTADO</option>
						</select>
					</div>


					<div class="form-group m-t-20">
						<label>MUNICIPIO:</label>
						<select style="text-transform: uppercase;"  id="v_municipio" class="form-control" tabindex="115">
							<option value="0">SELECCIONAR MUNICIPIO</option>
						</select>
					</div>

					<div class="form-group m-t-20">
						<label>COLONIA:</label>
						<input type="text" class="form-control" id="v_colonia" name="v_colonia" value="<?php echo $colonia; ?>" title="SUCURSAL" tabindex="116" >
					</div>

					

					<div class="form-group m-t-20">
						<label>*DIRECCI&Oacute;N:</label>
						<textarea id="v_direccion_sucursal" class="form-control" name="v_direccion_sucursal" title="DIRECCI&Oacute;N" tabindex="117"><?php echo $direccion; ?></textarea>
					</div>
					
					
					
					<div class="form-group m-t-20">
						<label>EMAIL:</label>
						<input type="email" class="form-control" id="v_email" name="v_email" value="<?php echo $email; ?>" title="EMAIL" tabindex="118">
					</div>



					<div class="form-group m-t-20" >
						<label>I.V.A %:</label>
						<input type="text" class="form-control" id="v_iva" name="v_iva" value="<?php echo $iva; ?>" placeholder='0.0' title="I.V.A" tabindex="119">
					</div>	

					<div class="form-group m-t-20" style="">
						<label>Horas cancelaciones</label>
							<input type="number" class="form-control" id="v_horascancelaciones" name="v_horascancelaciones" value="<?php echo $horascancelacion; ?>" title="EMAIL" tabindex="120">
						
					</div>

					

					<div class="form-group m-t-20" style="display: none;">
							HABILITAR LA RECEPCION DE DATOS PARA LA FACTURACIÓN EN LA APLICACIÓN
								<input type="checkbox" name="solicitarfactura" id="solicitarfactura" onchange="Habilitarfacturacion()" value="<?php echo $solicitarfactura?>" <?php echo $check;?>>
						
						
					</div>
					<div class="form-group m-t-20" style="display: none;">
						HABILITAR CAMPO DE MONTO FACTURA
						<input type="checkbox" name="habilitarcampomontofactura" id="habilitarcampomontofactura" onchange="habilitarcampomontofactura1()" value="<?php echo $campomontofactura?>" <?php echo $check3; ?>>
					</div>



					<div style="display: none;">
					<label for="">OPCIONES DE AGENDA</label>

						<div class="form-group m-t-20" style="">
						POR FECHA
						<input type="checkbox" name="habilitarcampoporfecha" id="habilitarcampoporfecha" 
						onchange="habilitarcampoporfecha1()" value="<?php echo $campoporfecha?>" <?php echo $checkporfecha; ?>>
					</div>


					<div class="col-md-6" >
									<label>IMAGEN POR FECHA:</label>

									<form method="post" action="#" enctype="multipart/form-data">
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top imagensucursal3" src="">
								        <div id="d_foto3" style="text-align:center; ">
											<img src="<?php echo $ruta3; ?>" class="card-img-top" alt="" style="border: 1px #777 solid"/> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								            	
								               
								                <input type="file" class="form-control-file" name="image3" id="image3"  onchange="SubirImagenSucursal3()">
								            </div>
								          <!--   <input type="button" class="btn btn-primary upload" value="Subir"> -->
								        </div>
								    </div>
								</form>
								<p style="text-align: center;">Dimensiones de la imagen Ancho:1280px Alto:852px</p>

								</div>




					<div class="form-group m-t-20" style="">
						POR ESPECIALISTA
						<input type="checkbox" name="habilitarcampoporespecialista" id="habilitarcampoporespecialista" 
						onchange="habilitarcampoporespecialista1()" value="<?php echo $campoporespecialista?>" <?php echo $checkporespecialista; ?>>
					</div>


					<div class="col-md-6" >
									<label>IMAGEN POR ESPECIALISTA:</label>

									<form method="post" action="#" enctype="multipart/form-data">
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top imagensucursal4" src="">
								        <div id="d_foto4" style="text-align:center; ">
											<img src="<?php echo $ruta4; ?>" class="card-img-top" alt="" style="border: 1px #777 solid"/> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								            	
								               
								                <input type="file" class="form-control-file" name="image4" id="image4"  onchange="SubirImagenSucursal4()">
								            </div>
								         
								        </div>
								    </div>
								</form>
								<p style="text-align: center;">Dimensiones de la imagen Ancho:1280px Alto:852px</p>

								</div>

</div>
					<div class="form-group m-t-20">
						<label>ORDEN:</label>
						<input type="number" name="v_orden" id="v_orden" class="form-control" value="<?php echo $orden ?>"tabindex="120">
					</div>

					<div class="form-group m-t-20">
						<label>ESTATUS:</label>
						<select id="v_estatus" name="v_estatus" tabindex="121" class="form-control">
							<option value="0" <?php if(0 == $estatus){ echo "selected"; }?>>DESACTIVADO</option>
							<option value="1" <?php if(1 == $estatus){ echo "selected"; }?>>ACTIVADO</option>
						</select>
					</div>

				
							<div id="map-container">
						  <div id="map"></div>
						</div>
						<input type="hidden" id="v_ubicacion" value="<?php echo $ubicacion; ?>">

					<div class="form-group m-t-20" style="display: none;">
						<label>OPCIONES DE PEDIDO:</label>
						<div class="card-body">

						    <div class="opcionespedidolista" style="overflow:scroll;height:50px;" id="opcionespedidolista">
				
						  </div>
					</div>


						<div class="form-group m-t-20">
						<label>TIPOS DE PAGO:</label>
						<div class="card-body">

						    <div class="tipodepagoslista" style="overflow:scroll;height:50px;" id="tipodepagoslista">
				
						  </div>
					</div>

				</div>

				<div class="form-group m-t-20">
					<div>MENSAJE EN LA SECCIÓN MÉTODOS DE PAGO</div>
					<textarea  id="mensajesecciontipopago" class="form-control" rows="2" ><?php echo $mensajesecciontipopago;?></textarea>
				</div>


					<div class="form-group m-t-20">
						<label>DATO FISCAL:</label>
						<div class="card-body">

						    <div class="listadatosfiscales" style="" id="listadatosfiscales">
				
						  </div>
					</div>
				</div>
									
					
					
					

				</div>
				</div>
				<div class="row">
				<div class="col-md-9">
					
				</div>
				<!-- <div class="col-md-3">
					<button type="button" onClick="var resp=MM_validateForm('v_sucursal','','R','v_direccion_sucursal','','R','v_email','','isEmail'); if(resp==1){ Guardar_sucursal('f_sucursales');}" class="btn btn-info" style="float: right;margin-right: 2em;"><i class="mdi mdi-content-save"></i> ACEPTAR</button>
				</div> -->
				</div>

				<div style="clear: both;"></div>
				<input type="hidden" id="idsucursales" name="idsucursales" value="<?php echo $idsucursales; ?>" />
				<input type="hidden" id="idempresas" name="idempresas" value="<?php echo $idempresas; ?>" />
				
			</div>


			<div class="card" style="display: none;">
				<div class="card-body">	

					<div class="col-md-6" >

						<label>IMAGEN PARA TIKECT:</label>

					<div style="width: 18rem;margin: auto;margin-top: 3em;">

				<div class="col-md-12" style="" >

									<form method="post" action="#" enctype="multipart/form-data">
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top ticketimagen" src="">
								        <div id="d_foto1" style="text-align:center; ">
											<img src="<?php echo $rutaticket; ?>" class="card-img-top" alt="" style="border: 1px #777 solid"/> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								                <input type="file" class="form-control-file" name="imagelogo" id="imagelogo"  onchange="SubirImagenTicket()">
								            </div>
								  
								        </div>
								    </div>
								</form>
								<p style="text-align: center;">Dimensiones de la imagen Ancho:320px Alto:340px</p>

								</div>
								</div>

					<div class="form-group m-t-20" style="display: none;">

						<label>ENCABEZADO DE TICKET:</label>
						<textarea id="encabezado" class="form-control"></textarea>
						
					</div>

					<div class="form-group m-t-20">

						<label>LEYENDA AL FINAL DEL TICKET:</label>
						<textarea id="leyendaticket" class="form-control"><?php echo $leyenda ?></textarea>
						
					</div>


					<div class="form-group m-t-20">

						HABILITAR TICKET DE VENTA:
						<input type="checkbox" onchange="Cambioticketventa()" name="tventa" id="tventa" value="<?php echo $ticketventa;?>" <?php echo $tventach;?>>
						
					</div>

					



					<div class="form-group m-t-20">

					HABILITAR TICKET DE PRODUCCIÓN:
						<input type="checkbox" onchange="Cambioticketproduccion()" name="tproduccion" id="tproduccion" value="<?php echo $ticketproduccion;?>" <?php echo $tproduccionch;?>>
						
					</div>

					<div class="form-group m-t-20">

						HABILITAR NOTA DE VENTA:
						<input type="checkbox" onchange="CambioNotaventa()" name="notaventa" id="notaventa" value="<?php echo $notaventa;?>" <?php echo $notaventach;?>>
						
					</div>

				
						
					</div>
				</div>
			</div>


			<div class="card" style="display: none;">
				<div class="card-body">	

					<div class="col-md-6" >

						<label>CONFIGURAR RECORDATORIO</label>

					<div >

				<div class="col-md-12" style="" >

						<div class="form-group m-t-20">
						ACTIVAR RECORDATORIO:
						<input type="checkbox" name="trecordatorio" id="trecordatorio"  onchange="Habilitarrecordatorio()" value="<?php echo $recordatorio?>" <?php echo $check2;?>>
					</div>

					<div id="mostrarminutos" class="form-group m-t-20" style="display: none;">
						<label>TIEMPO DE RECORDATORIO:</label>
						<input type="number"  class="form-control" id="minutosrecordatorio" name="minutosrecordatorio" value="<?php echo $minutosrecordatorio; ?>" tabindex="120">
					</div>

					<div class="form-group m-t-20">
						<label for="">MENSAJE PARA SUCURSAL:</label>
						<input type="text" id="mensajeempresa" class="form-control" value="<?php echo $mensajeempresa; ?>" tabindex="121">
					</div>

					<div class="form-group m-t-20">
						<label for="">MENSAJE PARA CLIENTES:</label>
						<input type="text" id="mensajecliente" class="form-control" value="<?php echo $mensajecliente; ?>" tabindex="122">
					</div>


				</div>
			</div>
			</div>
		</div>
	</div>

		</div>
	</div>
</form>

<style>
	#map-container {
  position: relative;
  width: 100%;
  height: 400px; /* Ajusta la altura según tus necesidades */
}

#map {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
<!-- <script  type="text/javascript" src="./js/mayusculas.js"></script>
 --><script type="text/javascript">
 	var idsucursales='<?php echo $idsucursales; ?>'
 			ObtenerOpcionespedido();
 			ObtenerDatosfiscales();
 			ObtenerTipospago();

 	if (idsucursales>0) {

 		var pais='<?php echo $pais; ?>';
		var estado='<?php echo $estado; ?>';
		var municipio='<?php echo $municipio ?>';

		ObtenerPais(pais);
		ObtenerEstado(estado,pais);
		ObtenerMunicipios(municipio,estado);

 	}else{

 	 	ObtenerPais(0);

 	}
phoneFormatter('v_celular');
phoneFormatter('v_telefono2');
phoneFormatter('v_telefono3');
phoneFormatter('v_telefono4');

$("#v_sucursal").focus();

 function SubirImagenSucursal() {
	 	// body...
	 
        var formData = new FormData();
        var files = $('#image')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: 'catalogos/sucursal/upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
              beforeSend: function() {
	      $("#d_foto").css('display','block');
	      $("#d_foto").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	

		    },
        	success: function(response) {
               	var ruta='<?php echo $ruta; ?>';
	
                if (response != 0) {
                    $(".imagensucursal").attr("src", response);
                    $("#d_foto").css('display','none');
                } else {

                	 $("#d_foto").html('<img src="'+ruta+'" class="card-img-top" alt="" style="border: 1px #777 solid"/> ');
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    }

    function SubirImagenSucursal2() {
	 	// body...
	 
        var formData = new FormData();
        var files = $('#image2')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: 'catalogos/sucursal/upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
              beforeSend: function() {
	      $("#d_foto2").css('display','block');
	      $("#d_foto2").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	

		    },
        	success: function(response) {
               	var ruta='<?php echo $ruta2; ?>';
	
                if (response != 0) {
                    $(".imagensucursal2").attr("src", response);
                    $("#d_foto2").css('display','none');
                } else {

                	 $("#d_foto2").html('<img src="'+ruta+'" class="card-img-top" alt="" style="border: 1px #777 solid"/> ');
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    }


 function SubirImagenSucursal3() {
	 	// body...
	 
        var formData = new FormData();
        var files = $('#image3')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: 'catalogos/sucursal/upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
              beforeSend: function() {
	      $("#d_foto3").css('display','block');
	      $("#d_foto3").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	

		    },
        	success: function(response) {
               	var ruta='<?php echo $ruta3; ?>';
	
                if (response != 0) {
                    $(".imagensucursal3").attr("src", response);
                    $("#d_foto3").css('display','none');
                } else {

                	 $("#d_foto3").html('<img src="'+ruta+'" class="card-img-top" alt="" style="border: 1px #777 solid"/> ');
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    }

 function SubirImagenSucursal4() {
	 	// body...
	 
        var formData = new FormData();
        var files = $('#image4')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: 'catalogos/sucursal/upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
              beforeSend: function() {
	      $("#d_foto4").css('display','block');
	      $("#d_foto4").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	

		    },
        	success: function(response) {
               	var ruta='<?php echo $ruta4; ?>';
	
                if (response != 0) {
                    $(".imagensucursal4").attr("src", response);
                    $("#d_foto4").css('display','none');
                } else {

                	 $("#d_foto4").html('<img src="'+ruta+'" class="card-img-top" alt="" style="border: 1px #777 solid"/> ');
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    }



 function SubirImagenTicket() {
	 	// body...
	 
        var formData = new FormData();
        var files = $('#imagelogo')[0].files[0];
        formData.append('file',files);
        $.ajax({
        	url: 'catalogos/sucursales/uploadticket.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
              beforeSend: function() {
	      $("#d_foto1").css('display','block');
	      $("#d_foto1").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	

		    },
        	success: function(response) {
               	var ruta='<?php echo $ruta; ?>';
	
                if (response != 0) {
                    $(".ticketimagen").attr("src", response);
                    $("#d_foto1").css('display','none');
                } else {

                	 $("#d_foto1").html('<img src="'+ruta+'" class="ticketimagen" alt="" style="border: 1px #777 solid"/> ');
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    }

    var idsucursales=<?php echo $idsucursales;?>;
    var iddatofiscal=<?php echo $iddatofiscal; ?>;

	if(idsucursales>0) {
		ObtenerHorariosSemana(idsucursales);
		ObtenerOpcionespedidoSucursal(idsucursales);
		ObtenerTipospagosSucursal(idsucursales);

		if (iddatofiscal>0) {

			$("#datofiscal_"+iddatofiscal).prop('checked',true);
		}

	}

	Habilitarrecordatorio();

</script>

<script>
  $(document).ready(function() {

  	var ubicacion='<?php echo $ubicacion; ?>';
  		var lat1="";
					var lng1="";
  	if (ubicacion!='') {
  	
  	
						var cadena = ubicacion.split(',');
						 lat1=parseFloat(cadena[0]);
						 lng1=parseFloat(cadena[1]);

			
  	}else{

  				lat1=19.4326;
						lng1=-99.1332;
  	}
  
 
    // Carga el mapa
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10, // Nivel de zoom inicial
      center: {lat:lat1, lng: lng1} // Ubicación inicial
    });


    var marker = new google.maps.Marker({
			  position: {lat: lat1, lng: lng1},
			  map: map,
			  title: 'Ubicación'
			});

    // Agrega un evento de clic al mapa
    google.maps.event.addListener(map, 'click', function(event) {
      // Obtiene las coordenadas al hacer clic en el mapa
      var latLng = event.latLng;
      var latitude = latLng.lat();
      var longitude = latLng.lng();

      // Muestra las coordenadas en la consola del navegador
      
      var latlng=latitude+','+longitude;
      $("#v_ubicacion").val(latlng);


       marker.setPosition(event.latLng);
    });


 


  });
</script>







