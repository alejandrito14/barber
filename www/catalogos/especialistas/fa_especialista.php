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
require_once("../../clases/class.Usuarios.php");
require_once("../../clases/class.Pais.php");



$db = new MySQL();
$bt = new Botones_permisos(); 
$fu = new Funciones();
$cli = new Usuarios();
$pais = new Paises();



$su->db = $db;
$cli->db = $db;
$pais->db=$db;

$idmenumodulo = $_GET['idmenumodulo'];



$resul_paises=$pais->ObtenerPaices();
$result_paises_row=$db->fetch_assoc($resul_paises);
$result_paises_num=$db->num_rows($resul_paises);

$resul_paises1=$pais->ObtenerPaices();
$result_paises_row1=$db->fetch_assoc($resul_paises1);




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



if(!isset($_GET['idusuarios']))
{
	$idusuario = 0;
	$v_idempresa = "";
	$color="#ffffff";
	$v_sexo = "" ;
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
	$titulo='NUEVO BARBERO';
	$v_idtipo=3;
	$bloquearediciondedatos=0;
			$rutaperfil="images/sinfoto.png";
	//$validacion="onkeyup='ValidarCelular()'";
			$orden=0;
}else
{
	
	$idusuario = $_GET['idusuarios'];
	
	//buscamos la información del usuario..
	
	$cli->id_usuario = $idusuario;
	$usuario = $cli->ObtenerInformacionusuario();

	$usuario_row = $db->fetch_assoc($usuario);
	$usuario_num = $db->num_rows($usuario);
	
	//echo "Entro por que tiene un id de lciente.";
	$v_idtipo = $fu->imprimir_cadena_utf8($usuario_row['tipo']);
	$alias = $fu->imprimir_cadena_utf8($usuario_row['alias']);
	$v_idempresa = $fu->imprimir_cadena_utf8($usuario_row['idempresas']);
	$v_no_usuario = $fu->imprimir_cadena_utf8($usuario_row['no_usuario']);
	$v_sexo = $usuario_row['sexo'];

	$v_f_nacimiento = $fu->imprimir_cadena_utf8($usuario_row['f_nacimiento']);
	$v_no_tarjeta =$fu->imprimir_cadena_utf8($usuario_row['no_tarjeta']);
	$v_nombre = $fu->imprimir_cadena_utf8($usuario_row['nombre']);
	$v_paterno =$fu->imprimir_cadena_utf8($usuario_row['paterno']);
	$v_materno = $fu->imprimir_cadena_utf8($usuario_row['materno']);
	$v_direccion = $fu->imprimir_cadena_utf8($usuario_row['direccion']);
	$v_telefono =$fu->imprimir_cadena_utf8($usuario_row['telefono']);
	$color=$usuario_row['color'];
 $orden=$usuario_row['orden'];
	$v_celular=$fu->imprimir_cadena_utf8($usuario_row['celular']);
	$v_edad=$fu->imprimir_cadena_utf8($usuario_row['fechanacimiento']);
	$opcionespago='';
	if ($usuario_row['opcionespagobloqueadas']!='') {
		$opcionespago=$usuario_row['opcionespagobloqueadas'];

	}
 
	$validartelefono=$fu->imprimir_cadena_utf8($usuario_row['validartelefono']);
	$bloquearediciondedatos=$usuario_row['bloquearediciondatos'];
	$mostraranuncios=$usuario_row['anunciovisto'];

	$fotoine=$fu->imprimir_cadena_utf8($usuario_row['ine']);
	$fotoperfil=$fu->imprimir_cadena_utf8($usuario_row['foto']);
	$v_fax =$fu->imprimir_cadena_utf8($usuario_row['fax']);
	$v_fis_razonsocial =$fu->imprimir_cadena_utf8($usuario_row['fis_razonsocial']);
	$v_fis_rfc = $fu->imprimir_cadena_utf8($usuario_row['fis_rfc']);
	$v_fis_direccion = $fu->imprimir_cadena_utf8($usuario_row['fis_direccion']);
	$v_fis_no_int = $fu->imprimir_cadena_utf8($usuario_row['fis_no_int']);
	$v_fis_no_ext = $fu->imprimir_cadena_utf8($usuario_row['fis_no_ext']);
	$v_fis_col =$fu->imprimir_cadena_utf8($usuario_row['fis_col']);
	$v_fis_estado = $fu->imprimir_cadena_utf8($usuario_row['fis_estado']);
	$v_fis_cp = $fu->imprimir_cadena_utf8($usuario_row['fis_cp']);
	$v_usuario = $fu->imprimir_cadena_utf8($usuario_row['usuario']);
	$v_email = $fu->imprimir_cadena_utf8($usuario_row['email']);
	$v_clave = $fu->imprimir_cadena_utf8($usuario_row['clave']);
	$v_estatus = $fu->imprimir_cadena_utf8($usuario_row['estatus']);
	$v_direccion_envio = $fu->imprimir_cadena_utf8($usuario_row['direccion_envio']);
	$v_cp = $fu->imprimir_cadena_utf8($usuario_row['cp']);

	$colonia = $fu->imprimir_cadena_utf8($usuario_row['colonia']);
	$no_ext = $fu->imprimir_cadena_utf8($usuario_row['no_ext']);
	$no_int = $fu->imprimir_cadena_utf8($usuario_row['no_int']);
	$folioadmin = $fu->imprimir_cadena_utf8($usuario_row['folio_adminpack']);
	$v_referencia=$fu->imprimir_cadena_utf8($usuario_row['referencia']);
	$v_fis_correo=$fu->imprimir_cadena_utf8($usuario_row['correofiscal']);


	$v_fis_ciudad = $fu->imprimir_cadena_utf8($usuario_row['fis_ciudad']);
	$v_ciudad= $fu->imprimir_cadena_utf8($usuario_row['idlocalidad']);
	$v_municipio= $fu->imprimir_cadena_utf8($usuario_row['municipios']);
	$v_estado= $fu->imprimir_cadena_utf8($usuario_row['estados']);
	$idpais=$fu->imprimir_cadena_utf8($usuario_row['pais']);

	$habilitarobservacion=$fu->imprimir_cadena_utf8($usuario_row['activarobservacion']);


	$v_fis_municipio=$fu->imprimir_cadena_utf8($usuario_row['fis_municipio']);

	if ($v_fis_estado=="" || $v_fis_estado=='t' ) {
		$v_fis_estado=0;
	}
	if ($v_fis_ciudad=="" || $v_fis_estado=='t') {
		$v_fis_ciudad=0;
	}
	if ($v_fis_municipio=="" || $v_fis_estado=='t') {
		$v_fis_municipio=0;
	}

	if ($idpais=="" || $idpais=='t' ) {
		$idpais=1;
	}


	if ($v_estado=="" || $v_estado=='t' ) {
		$v_estado=0;
	}
	if ($v_ciudad=="" || $v_ciudad=='t') {
		$v_ciudad=0;
	}
	if ($v_municipio=="" || $v_municipio=='t') {
		$v_municipio=0;
	}

	if ($v_telefono=='0') {
		$v_telefono='';
	}
	$habilitar='';
	if ($v_no_usuario>0) {
		$habilitar='disabled';
	}

	$checkedhabilitar="";
	if ($habilitarobservacion==1) {
		$checkedhabilitar="checked";

	}
	$titulo='EDITAR BARBERO';


	

	if($fotoine==""){
		$rutaine="images/sinfoto.png";
	}
	else{
		//$rutaine="catalogos/paquetes/imagenespaquete/".$_SESSION['codservicio']."/$foto";

		$rutaine="app/".$_SESSION['carpetaapp']."/php/upload/ine/$fotoine";
	}


	if($fotoperfil=="" || $fotoperfil=='null'){
		$rutaperfil="images/sinfoto.png";
	}
	else{
		//$rutaine="catalogos/paquetes/imagenespaquete/".$_SESSION['codservicio']."/$foto";

		$rutaperfil="app/".$_SESSION['carpetaapp']."/php/upload/perfil/$fotoperfil";
	}

}



//echo "ID usuario ES: " . $idusuario;

$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion


$su->tipo_usuario= $tipousaurio;
$su->lista_empresas = $lista_empresas;

//obtenedremos todas las sucursales de las empresas a las que puedes visualizar.




?>

<script type="text/javascript">
	//$('#titulo-modal-forms').html("ALTA A usuario");
</script>


<form name="form_usuario" id="form_usuario">
	<input id="v_id" name="v_id" type="hidden" value="<?php echo $idusuario; ?>">

	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;position:fixed!important;z-index:10;right:0;margin-right:2em;width: 20%;" >
					
			
					<div style="clear: both;"></div>

				


				<?php
			
					//SCRIPT PARA CONSTRUIR UN BOTON
					$bt->titulo = "GUARDAR";
					$bt->icon = "mdi mdi-content-save";
					
					 $bt->funcion="
					   GuardarusuarioEspecialista('form_usuario','catalogos/especialistas/vi_especialista.php','main','catalogos/especialistas/ga_especialistas.php',$idmenumodulo);
					 ";

					$bt->estilos = "float: right;";
					$bt->permiso = $permisos;
					$bt->tipo = 1;
					$bt->class='btn btn-success';
					//validamos que permiso aplicar si el de alta o el de modificacion
					/*if($idusuario == 0)
					{
						
					}else{
						$bt->tipo = 2;
					}*/
			
					$bt->armar_boton();
				?>
				<button type="button" onClick="aparecermodulos('catalogos/especialistas/vi_especialista.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" title="LISTADO DE JUGADORES" style="margin-right: 10px;float: right;"><i class="mdi mdi-arrow-left-box"></i>VER LISTADO</button>
				
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

			<div class="tab-content tabcontent-border" style=" padding-top: 15px;">
			
				<div class="card" id="home" role="tabpanel">
					<div class="card-header" style="margin-top: 1em;">
					<h5>DATOS DE CONFIGURACIÓN </h5>
				</div>

					<div class="card-body">
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">*TIPO DE USUARIO:</label>
						<select name="tipo" id="v_tipo" class="v_tipo form-control" onchange="CambioTipoUsuario()">
							
						</select>
					</div>
					</div>
				</div>
			</div>
		</div>
			
 
		<div class="card" >
					<div class="card-header" style="margin-top: 1em;">
					<h5>DATOS GENERALES </h5>
				</div>
				
			<div class="card-body">
				<div class="row">
				<div class="col-md-6">

					<div class="form-group ">
						<label>*USUARIO/CEL:</label>
						<input name="celular" id="v_celular" title="CELULAR" type="text" class="form-control" onkeyup="ValidarCelularInput()" placeholder="CELULAR" value="<?php echo $v_celular; ?>" tabindex="99" <?php echo $validacion ?>>

					<div id="validacioncelular" style="color: red"></div>
					</div>


					<div class="form-group m-t-20">
					<label>ALIAS:</label>
					<input type="text" name="alias" id="v_alias" class="form-control" title="Alias" value="<?php echo $fu->imprimir_cadena_utf8($alias); ?>" placeholder="ALIAS" tabindex="100" />


				</div>

					<div class="form-group ">
						<label>*NOMBRE:</label>
						<input name="nombre" id="nombre" title="NOMBRE" type="text" class="form-control" placeholder="NOMBRE"  required value="<?php echo $v_nombre; ?>" tabindex="101">

						<div id="validacionnombre" style="color: red"></div>
					</div>

					
					<div class="form-group ">
						<label>*APELLIDO PATERNO:</label>
						<input name="paterno" id="v_paterno" title="APELLIDO PATERNO" type="text" class="form-control" placeholder="APELLIDO PATERNO"  required value="<?php echo $v_paterno; ?>" tabindex="102">
							<div id="validacionpaterno" style="color: red"></div>
					</div>
					
					<div class="form-group ">
						<label>APELLIDO MATERNO:</label>
						<input name="materno" id="v_materno" title="APELLIDO MATERNO" type="text" class="form-control" placeholder="APELLIDO MATERNO"  required value="<?php echo $v_materno; ?>" tabindex="103">
					</div>	

						<div class=" form-group  ">
							
								<label>*SEXO:</label>
								

									<div  class=" btn-group-toggle lisexo" data-toggle="buttons" >
									<label class="btn btn_dorado txtsexoh  btns <?php if("H" == $v_sexo ){ echo "active"; } ?>" onclick="SeleccionarhM('H')" style="margin: 10px;">
								    <input type="checkbox" id="catecheck1" class="catecheck1"  value="H" >Hombre
								  </label>

								  <label class="btn btn_dorado btns txtsexom <?php if("M" == $v_sexo ){ echo "active"; } ?>"  style="margin: 10px;" onclick="SeleccionarhM('M')">
								    <input type="checkbox" id="catecheck2" class="catecheck1"  value="M" >Mujer
								  </label>


								</div>

								<div id="validacionsexo" style="color: red"></div>

							</div>	

					<div class="">
						<label>*FECHA DE NACIMIENTO:</label>
					  <input name="v_fechanacimiento" id="v_fechanacimiento" title="FECHA DE NACIMIENTO" type="date" class="form-control" placeholder="FECHA DE NACIMIENTO" required="" value="<?php echo $v_edad;?>" tabindex="105">

					   <div id="validacionnacimiento" style="color: red"></div>
					</div>

					<div class="form-group m-t-20" style="margin-top: 10px;">
								<label>*COLOR:</label>
								<input type="color" class="form-control" id="v_color" name="v_color" value="<?php echo $color; ?>" title="COLOR" placeholder="COLOR">

								<div id="validacioncolor" style="color: red"></div>
							</div>
					

								<div class="form-group m-t-20" style="margin-top: 10px;">
								<label>ORDEN:</label>
								<input type="number" class="form-control" id="v_orden" name="v_orden" value="<?php echo $orden; ?>" title="ORDEN" placeholder="ORDEN">

								<div id="validacionorden" style="color: red"></div>
							</div>
					

			
				
					
					<div class="form-group " style="display: none;">
						<label>TEL&Eacute;FONO:</label>
						<input name="v_telefono" id="v_telefono" title="TELÉFONO" type="text" class="form-control" placeholder="TELÉFONO"  required value="<?php echo $v_telefono; ?>">
					</div>

					<div class="form-group m-t-20" style="display: none;">
					<label>*EMAIL:</label>
					<input type="text" name="email" id="email" class="form-control" title="Email" value="<?php echo $v_email; ?>" placeholder="EMAIL" tabindex="106" />
					</div>
				</div>


					<div class="col-md-6">
						<div class="form-group ">
						<label>FOTO DE PERFIL:</label>
					 	<div>
					 	</div>

					 	<!-- 	<form method="post" action="#" enctype="multipart/form-data"> -->
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top" src="">
								        <div id="d_foto" style="text-align:center; ">
											<img src="<?php echo $rutaperfil; ?>" class="card-img-top " alt="" style="border: 1px #777 solid;    border-radius: 20px; "> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								                <input type="file" class="form-control-file" name="image" id="image" onchange="SubirImagen()">
								            </div>
								         
								        </div>
								    </div>
						<!-- 		</form> -->
					 		
					 	</div>
					</div>

				
							
					

				</div>

			</div>
		</div>
	</div>
</div>

					<!---AGREGUE PAIS,ESTADO,MUNICIPIO,LOCALIDAD--->

					

				
						
					
					

					
					<div class="row">
					
				</div>

					<div class="col-md-4" style="display: none;">
						<label>INE:</label>
					 	<div>

					 	<!-- 	<form method="post" action="#" enctype="multipart/form-data">
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top" src="">
								        <div id="d_foto" style="text-align:center; ">
											<img src="<?php echo $rutaine; ?>" class="card-img-top"  alt="" style="border: 1px #777 solid;    border-radius: 20px; "/> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								                 <input type="file" class="form-control-file" name="image" id="image" onchange="SubirImagen()"> 
								            </div>
								           <input type="button" class="btn btn-primary upload" value="Subir"> 
								        </div>
								    </div>
							
					 		
					 	</div>
					</div>
				</form> -->

			

					
						
				
				</div>


					<div class="form-group m-t-20" style="display: none;">
						<label>NO. DE TARJETA:</label>
						<input name="v_no_tarjeta" id="v_no_tarjeta" title="Tu Nombre" type="text" class="form-control" placeholder="No. de tarjeta"  required value="<?php echo $v_no_tarjeta; ?>">
					</div>	
					
					
					</div>
				


				<div class="tab-pane  p-20" id="profile" role="tabpanel">
						<div class="row" style="display: none;">
					<div class="form-group col-md-4">
						<label>RAZÓN SOCIAL:</label>
						<input name="v_fis_razonsocial" id="v_fis_razonsocial" title="RAZÓN SOCIAL" type="text" class="form-control" placeholder="RAZÓN SOCIAL"  required value="<?php echo $v_fis_razonsocial; ?>" >
					</div>

					<div class="form-group col-md-4">
						<label>RFC:</label>
						<input name="v_fis_rfc" id="v_fis_rfc" title="RFC" type="text" class="form-control" placeholder="RFC"  required value="<?php echo $v_fis_rfc; ?>" >
					</div>

					<div class="form-group col-md-4">
						<label>CORREO FISCAL:</label>
						<input name="v_fis_correo" id="v_fis_correo" title="CORREO FISCAL" type="text" class="form-control" placeholder="CORREO FISCAL"  required value="<?php echo $v_fis_correo; ?>" >
					</div>

				</div>

				<div class="card">
					

					<div class="card-body">
							<div class="card" style="    width: 100%;" >
					<div class="card-header" style="margin-top: 1em;">
						<h5>DATOS DE ACCESO</h5>
					</div>
				
			<div class="card-body">
				<div class="row">

					<div class="col-md-6">
					<div class="form-group m-t-20"  style="display: none;">
						<label>*USUARIO:</label>
						<input name="usuario" onBlur="validarUsuariousuario();" id="v_usuario" title="Usuario" type="text" class="form-control" placeholder="USUARIO"  required value="<?php echo $v_usuario; ?>" tabindex="107">
					</div>
					
					
				

					<div class="form-group m-t-20">
					<label>*CONTRASEÑA:</label>
					<div class="input-group mb-3">

						<input type="password" name="clave" id="clave" class="form-control" title="CONTRASEÑA" value="<?php echo $v_clave; ?>"placeholder="CONTRASEÑA" tabindex="108" onkeyup="CoincidirContra2('clave','clave2')">

						<div class="input-group-append">
							<button class="btn " type="button">
								<span class="icon1 fa fa-eye-slash" onclick="mostrarPassword('clave','icon1')" style="text-align: center;"></span>
							</button>
						</div>
					</div>
					</div>

					<div class="form-group m-t-20">
						<label>*CONFIRMAR CONTRASEÑA:</label>
						<div class="input-group mb-3">

							<input type="password" name="clave2" id="clave2" class="form-control" title="CONFIRMAR CONTRASEÑA" value="<?php echo $v_clave; ?>" placeholder="CONFIRMAR CONTRASEÑA" onkeyup="CoincidirContra2('clave','clave2')" tabindex="109">

							<div class="input-group-append">
								<button class="btn " type="button">
									<span class="icon2 fa fa-eye-slash" onclick="mostrarPassword('clave2','icon2')" style="text-align: center;"></span>
								</button>
							</div>
						</div>

						<div id="spanrespuesta" style="color: red;"></div>

					</div>
					
					<div class="form-group m-t-20">
						<label>ESTATUS:</label>
						<select name="estatus" tabindex="110" id="v_estatus" title="Estatus" class="form-control"  >
							<option value="0" <?php if($v_estatus == 0) { echo "selected"; } ?> >DESACTIVO</option>
							<option value="1" <?php if($v_estatus == 1) { echo "selected"; } ?> >ACTIVADO</option>
						</select>
						</div>
					 </div>
					</div>
				</div>
			</div>
		</div>

					</div>
				</div>

					<div class="tab-pane">
					
						<div class="">
				

				<!-- Datos de acceso --->

				<div class="card" style="width: 100%;">
					<div class="card-body">
						
						<div class="">
								<div class="card" style="width: 100%;" >
									<div class="card-header" style="margin-top: 1em;">
									<h5>HORARIOS</h5>
									</div>
				
							<div class="card-body">
								<div class="row">
								<button type="button" onclick="AbrirModalHorario()" class="btn btn-primary" title="NUEVO HORARIO" style="margin-right: 10px;float: right;"><i class="mdi mdi-arrow-left-box"></i>NUEVO HORARIO</button>


								</div>

								<div class="row horariosespecialistas" >

												
								</div>
							</div>
							</div>


						</div>
					</div>
				</div>





				<div class="card" style="width: 100%;">
					<div class="card-body">
						
						<div class="">
								<div class="card" style="width: 100%;" >
									<div class="card-header" style="margin-top: 1em;">
									<h5>SUSTITUCIÓN DE HORARIOS</h5>
									</div>
				
							<div class="card-body">
								<div class="row">
								<button type="button" onclick="AbrirModalFechaHorario()" class="btn btn-primary" title="NUEVO HORARIO" style="margin-right: 10px;float: right;"><i class="mdi mdi-arrow-left-box"></i>NUEVA FECHA</button>


								</div>

								<div class="row fechahorariosespecialistas" style="   " >

												
								</div>
							</div>
							</div>


						</div>
					</div>
				</div>
			


				<div class="card" style="width: 100%;">
					<div class="card-body">
						
						<div class="">
								<div class="card" style="width: 100%;" >
									<div class="card-header" style="margin-top: 1em;">
									<h5>FECHAS AUSENTES</h5>
									</div>
				
							<div class="card-body">
								<div class="row">
								<button type="button" onclick="AbrirModalFechaHorarioAusente()" class="btn btn-primary" title="NUEVO HORARIO" style="margin-right: 10px;float: right;"><i class="mdi mdi-arrow-left-box"></i>NUEVA FECHA</button>


								</div>

								<div class="fechahorariosespecialistasausente row" >

												
								</div>
							</div>
							</div>


						</div>
					</div>
				</div>


			</div>

		</div>


		
	</form>
			<!-- <div class="card" id="divasociados">
			<div class="card-header" style="margin-top: 1em;">
						<h5>SUCURSAL</h5>
					</div>
				<div class="card-body">
					<div class="row">
					<div class="col-md-12" style="text-align: right;">
						<button type="button" class="btn btn-primary" onclick="AgregarSucursal()">NUEVA SUCURSAL</button>
					</div>
					</div>

					<div class="row" style="margin-top: 1em;">
						<div class="col-md-12">
							
								
						</div>
					</div>
					
				</div>
			</div> -->
				<div class="tab-pane p-20" id="envio" role="tabpanel" style="display: none;">
					
					
					
					
				</div>

				

					</div>

			</div>


			<div style="width: 100%;">
				
				
				
				
				
<!--				<button type="button" onClick=""var resp=MM_validateForm('v_nombre','','R','v_paterno','','R','v_materno','','R','v_cp','','isNum','v_fis_cp','','isNum'); if(resp==1){ Guardarusuario('form_usuario','catalogos/usuarios/vi_usuarios.php','main',$idmenumodulo)}}" class="btn btn-success alt_btn3" style="float: right; margin-top: 10px;" <?php echo $disabled; ?> >GUARDAR</button>				
-->			</div>

		</div>
	</div>
		</div>
</form>

<div id="myModalAsociados" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">

				<div class="card" style="" id="divcoachs">
				

				</div>
				<div class="card-body">
					<div class="row">
				<div class="col-md-12">
			<div class="card-body"  >
				<div class="form-group ">
				<select id="buscadoralumnos" class="form-control" style=""> 
				</select>
				<button class="btn btn-success" id="btnfuncion" style="float: right;" onclick="SeleccionarUsuario()">SELECCIONAR</button>
				</div>
				<input type="hidden" id="posicion" value="-1">
	 		   <input type="hidden" id="idalumnoasociado" value="0">
  
					<div class="form-group ">
						<label>*CELULAR:</label>
						<input name="celular" id="v_celularaso" title="CELULAR" type="text" class="form-control" placeholder="CELULAR" value="" tabindex="112">
						<span id="spancelular" style="color:red;"></span>
					</div>


					<div class="form-group ">
						<label>*NOMBRE:</label>
						<input name="nombre" id="nombreaso" title="NOMBRE" type="text" class="form-control" placeholder="NOMBRE"  required value="" tabindex="114">
						<span id="spannombre" style="color:red;"></span>

					</div>

					
					<div class="form-group ">
						<label>*APELLIDO PATERNO:</label>
						<input name="paterno" id="v_paternoaso" title="APELLIDO PATERNO" type="text" class="form-control" placeholder="APELLIDO PATERNO"  required value="" tabindex="115">
						<span id="spanpaterno" style="color:red;"></span>

					</div>
					
					<div class="form-group ">
						<label>*APELLIDO MATERNO:</label>
						<input name="materno" id="v_maternoaso" title="APELLIDO MATERNO" type="text" class="form-control" placeholder="APELLIDO MATERNO"  required value="" tabindex="116">
					<span id="spanmaterno" style="color:red;"></span>

					</div>	

						<div class=" form-group  ">
							
								<label>*GÉNERO:</label>
								<select tabindex="117" name="v_sexo" id="v_sexoaso" title="sexo" class="form-control">
									<option value="H">HOMBRE</option>
									<option value="M">MUJER</option>
								</select>
						<span id="spansexo" style="color:red;"></span>

							</div>	

					<div class="">
						<label>*FECHA DE NACIMIENTO:</label>
					  <input name="v_fechanacimiento" id="v_fechanacimientoaso" title="FECHA DE NACIMIENTO" type="date" class="form-control" placeholder="FECHA DE NACIMIENTO" required="" value="" tabindex="118">

					<span id="spanfechanacimiento" style="color:red;"></span>

					</div>
					


			
				
					
					<div class="form-group " style="display: none;">
						<label>TEL&Eacute;FONO:</label>
						<input name="v_telefono" id="v_telefonoaso" title="TELÉFONO" type="text" class="form-control" placeholder="TELÉFONO"  required value="">
						<span id="spantelefono"></span>

					</div>

					<div class="form-group m-t-20">
					<label>*EMAIL:</label>
					<input type="text" name="email" id="emailaso" class="form-control" title="Email" value="" placeholder="EMAIL" tabindex="119" />

					<span id="spanemail" style="color:red;"></span>

					</div>

					<div class="form-group m-t-20">
					<label>*PARENTESCO:</label>
					<select name="v_parentesco" id="v_parentesco" class="form-control"></select>

					<span id="spanparentesco" style="color:red;"></span>

					</div>


					<div class="form-group m-t-20">
						<label for="">Soy su tutor</label>

						<span style="width: 20px;margin-left: 0.5em;"></span>
						<input tabindex="120" type="checkbox" id="v_soytutor" >

					</div>
				</div>
	     
	     
	     </div>

	    </div>
   </div>


       
      </div>
      <div class="modal-footer">

      	 <button type="button" class="btn btn-success" onclick="GuardarAlumnoAsociado()">GUARDAR</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
      </div>
    </div>

  </div>
</div>

 <div class="modal" id="modalhorario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">NUEVO HORARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       		<form>
											<div class="form-group">
											    <label for="">SUCURSAL</label>
											  		<select name="" class="form-control v_sucursal" id="v_sucursal"></select>
											</div>
										
										<div class="form-group">
									<label>DIA</label>	

									<select class="form-control diasemanasele" id="diasemana">
										<option value="t">SELECCIONAR DIA</option>
										<option value="0">DOMINGO</option>
										<option value="1">LUNES</option>
										<option value="2">MARTES</option>
										<option value="3">MIÉRCOLES</option>
										<option value="4">JUEVES</option>
										<option value="5">VIERNES</option>
										<option value="6">SÁBADO</option>

									</select>
									</div>
									<div class="form-group">
									<label>HORA INICIO:</label>
										<div class="form-group mb-2" style="">
											<input type="time" id="horai_1" class="form-control horainiciodiaselec" >
										</div>

									</div>

								
									<div class="form-group">

										<label>HORA FIN:</label>
										<div class="form-group mb-2" style="">
											<input type="time" id="horaf_1" class="form-control horafindiaselec" >
										</div>
									</div>



									<div class="form-group" style="display: none;">

										<label>TIPO DE COMISIÓN:</label>
										<div class="form-group mb-2" style="">
			<select id="v_tipocomision" class="form-control">
												<option disabled selected="" >SELECCIONAR TIPO DE COMISIÓN</option>
												<option value="0">PORCENTAJE</option>

													<option value="1">MONTO</option>
											</select>
										</div>
									</div>

									<div class="form-group" style="display: none;">

										<label>CANTIDAD DE LA COMISÓN:</label>
										<div class="form-group mb-2" style="">
											<input type="number" class="form-control" name="" id="v_cantidadcomision">
										</div>
									</div>

							</form>
						</div>
     
      <div class="modal-footer">

      	<button type="button" class="btn btn-primary " onclick="AgregarNuevoHorario()">AGREGAR</button>

						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


     
       
      </div>
    </div>
  </div>
</div>



<div class="modal" id="modalfechahorario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">NUEVO FECHA/HORARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       		<form>
											<div class="form-group">
											    <label for="">SUCURSAL</label>
											  		<select name="" class="form-control v_sucursalf v_sucursal" id="v_sucursal"></select>
											</div>
										
										

									<div class="form-group" style="">
									<label>FECHA</label>	

									<input type="date" name="fecha_i" id="fecha_i" class="form-control">
									</div>

									<div class="form-group">
									<label>HORA INICIO:</label>
										<div class="form-group mb-2" style="">
											<input type="time" id="horai_2" class="form-control horainiciodiaselec2" >
										</div>

									</div>

								
									<div class="form-group">

										<label>HORA FIN:</label>
										<div class="form-group mb-2" style="">
											<input type="time" id="horaf_2" class="form-control horafindiaselec2" >
										</div>
									</div>



									


							</form>
						</div>
     
      <div class="modal-footer">

      	<button type="button" class="btn btn-primary " onclick="AgregarNuevoFechaHorario()">AGREGAR</button>

						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


     
       
      </div>
    </div>
  </div>
</div>



<div class="modal" id="modalfechahorarioausente" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">NUEVO FECHA/HORARIO AUSENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       		<form>
											<div class="form-group">
											  <label for="">SUCURSAL</label>
											 	<select name="" class="form-control v_sucursalausente v_sucursal" id="v_sucursal"></select>
											</div>
										
										

									<div class="form-group" style="">
									<label>FECHA</label>	

									<input type="date" name="fecha_i_ausente" id="fecha_i_ausente" class="form-control">
									</div>
									

									<div class="form-group">
									<label>HORA INICIO:</label>
										<div class="form-group mb-2" style="">
											<input type="time" id="horai_2_ausente" class="form-control horainiciodiaselec2" >
										</div>

									</div>

								
									<div class="form-group">

										<label>HORA FIN:</label>
										<div class="form-group mb-2" style="">
											<input type="time" id="horaf_2_ausente" class="form-control horafindiaselec2" >
										</div>
									</div>



									


							</form>
						</div>
     
      <div class="modal-footer">

      	<button type="button" class="btn btn-primary " onclick="AgregarNuevoFechaHorarioAusente()">AGREGAR</button>

						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


     
       
      </div>
    </div>
  </div>
</div>

</div>


<link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- <script  type="text/javascript" src="./js/mayusculas.js"></script> -->

<script>
	
 phoneFormatter2('v_telefono');
 phoneFormatter2('v_celular');
  function SeleccionarhM2(sexo) {
		
		setTimeout(() => {
  
  				$(".btns").removeClass('active');
				
			if(sexo=='M'){
			$(".txtsexom").addClass('active');
			}
			if (sexo=='H') {

			$(".txtsexoh").addClass('active');
			
			}
	sexoseleccionado=sexo;



}, "100");


}

/* var bloquearediciondedatos='<?php echo $bloquearediciondedatos?>';

 validarbloquearediciondatos(bloquearediciondedatos);
 var mostraranuncios='<?php echo $mostraranuncios;?>';
 anunciovisto(mostraranuncios);
*/
</script>





	<script type="text/javascript">

	var idusuario='<?php echo $idusuario; ?>';
	var asociados=[];
	var asociadoseliminados=[];
	ObtenerHorariosSucursal(idusuario);
	var sexoseleccionado="";
		var sexo='<?php echo $v_sexo; ?>';
	sexoseleccionado=sexo;
	if (idusuario>0){
		
		var opcionestipopago='<?php echo $opcionespago; ?>';
		var opcionespago="";
		if (opcionestipopago!='') {
		 opcionespago=JSON.stringify(<?php echo $opcionespago; ?>);
		 
		}

		var validartelefono='<?php echo $validartelefono; ?>';

		/*ObtenerEstados(<?php echo $v_estado; ?>);
		ObtenerMunicipiosP(<?php echo $v_estado; ?>,<?php echo $v_municipio; ?>);
	//	ObtenerLocalidades2(<?php echo $v_municipio; ?>,<?php echo $v_ciudad; ?>);

	ObtenerEstadosCatalogo(<?php echo $v_fis_estado;?>,<?php echo $idpais;?>,'v_fis_estado');

 	ObtenerMunicipiosCatalogo(<?php echo $v_fis_municipio;?>,<?php echo $v_fis_estado;?>,'v_fis_municipio');*/
 //	ObtenerLocalidadesCatalogo(<?php echo $v_fis_ciudad;?>,<?php echo $v_fis_municipio;?>,'v_fis_ciudad');
 	
 	if (opcionespago=='') {
 		opcionespago=0;
 	}
 	var idtipo="<?php echo $v_idtipo;?>";
 	//OpcionesPago(opcionespago);

 	//validartelefonocheck(validartelefono);
	ObtenerTipos(idtipo);
	
	SeleccionarhM2(sexo);
	//ObtenerAsociados(idusuario);
	//ObtenerDependencia(idusuario);
	}else{

		 ObtenerTipos(5);
	// ObtenerEstados(0);
	 $("#avanzado").css('display','none');
	 $("#opcionesavanzadas").css('display','none');

	}
	</script>



	<script type="text/javascript">
	
</script>




<script>
//$("#v_estatus").chosen({width:"100%"});
	$("#v_tipo").attr('disabled',true);
	$("#v_pais").chosen({width:"100%"});
	$("#v_pais1").chosen({width:"100%"});


	jQuery('#v_f_nacimiento').datepicker({
			format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });


</script>


	<script type="text/javascript">
	 var confirmacion = "Las contraseñas si coinciden";
  var longitud = "La contraseña debe estar formada entre 6-10 carácteres";
  var negacion = "No coinciden las contraseñas";
  var vacio = "La contraseña no puede estar vacía";


function CoincidirContra2(contra1,contra2) {

  var pass1 = $('#'+contra1);
  var pass2 = $('#'+contra2);
 	console.log('entro1');
    if (pass2.length>0 && pass1.length>0) {
 	console.log('entro2');

       coincidePassword(contra1,contra2);
    }
 

}



function coincidePassword(contra1,contra2){


  var respuesta=$("#respuesta").html('<span id="spanrespuesta"></span>');

  var span = $('#spanrespuesta');

  coincide=0;
  var valor1 = $('#'+contra1).val();
  var valor2 = $('#'+contra2).val();
  console.log(valor1+''+valor2);

  if (valor1.length>0) {
  //muestro el span
    span.show().removeClass();
    //condiciones dentro de la función
    if(valor1 != valor2){
    span.text(negacion).addClass('negacion'); 
    }
    if(valor1.length==0 || valor1==""){
    span.text(vacio).addClass('negacion');  
    }
    if(valor1.length<6 || valor1.length>10){
    span.text(longitud).addClass('negacion');
    }
    if(valor1.length!=0 && valor1==valor2 && valor1.length>=6){
    $("#respuesta").html('<div class="check-list" style=""><span></span></div>');
    }

    if (valor1==valor2) {
    	console.log('entro');
    	coincide=1;
    	 $("#spanrespuesta").html('<div class="check-list" style=""><span></span></div>');
    }


   }else{
    

    span.hide();
   }
  }



 function coincidePassword2(contra1,contra2){


  var respuesta=$("#respuesta").html('<span id="spanrespuesta"></span>');

  var span = $('#spanrespuesta');


  var valor1 = $('#'+contra1).val();
  var valor2 = $('#'+contra2).val();

  console.log(valor1)
  if (valor1.length>0) {
  //muestro el span
    span.show().removeClass();
    //condiciones dentro de la función
    if(valor1 != valor2){
    span.text(negacion).addClass('negacion'); 
    } else
    if(valor1.length==0 || valor1==""){
    span.text(vacio).addClass('negacion');  
    } else
    if(valor1.length<6 || valor1.length>10){
    span.text(longitud).addClass('negacion');
    } else
    if(valor1.length!=0 && valor1==valor2 && valor1.length>=6){
    $("#respuesta").html('<div class="check-list" style=""><span></span></div>');
    }
    else{

 span.hide();

    }

   }else{
    

    span.hide();
   }
  }





 function SubirImagen() {
	 	// body...
	 						
        var formData = new FormData();
        var files = $('#image')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: 'catalogos/especialistas/upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
             beforeSend: function() {
      $("#d_foto").css('display','block');
      $("#d_foto").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	

		    },
            success: function(response) {
                if (response != 0) {
                    $(".card-img-top").attr("src", response);
                    $("#d_foto").css('display','none');
                } else {
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    }

 
function ValidarCelularInput() {


	 ValidarCelular2().then(r => {
		  		$("#validacioncelular").text('');

		  	if (r.existe==0) {
		  		$("#validacioncelular").text('');

		  
		  	    var celu=$("#v_celular").val().replace(/[()-\s]/g,'');		  	  
		
		  	   
		  	
		  	}else{
		  		$("#clave").val("");
		  		$("#clave2").val("");
		  		$("#validacioncelular").text('El celular ya se encuentra registrado');

		  	}

		  });
}



function ValidarCelular2() {
	return new Promise(function(resolve, reject) {

		var celular=$("#v_celular").val();
		var id=$("#v_id").val();
		var datos="celular="+celular+"&idusuario="+id;

		if (celular.length>5) {
		$.ajax({
	 url:'catalogos/clientes/ValidarCelularIdUsuario.php', //Url a donde la enviaremos
	 type:'POST', //Metodo que usaremos
	 dataType:'json',
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
	}

		});
	}

</script>


