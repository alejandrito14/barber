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
require_once("../../clases/class.Tarjetaregalo.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Usuarios.php");

$idmenumodulo = $_GET['idmenumodulo'];

//Se crean los objetos de clase
$db = new MySQL();
$emp = new Tarjetaregalo();
$f = new Funciones();
$bt = new Botones_permisos();

$emp->db = $db;

$emp->tipo_usuario = $tipousaurio;
$emp->lista_empresas = $lista_empresas;


$cli = new Usuarios();
$cli->db = $db;
$r_clientes = $cli->lista_Usuarios(3);
$a_cliente = $db->fetch_assoc($r_clientes); 
$r_clientes_num = $db->num_rows($r_clientes);


//Validamos si cargar el formulario para nuevo registro o para modificacion
if(!isset($_GET['idtarjetaregalo'])){
	//El formulario es de nuevo registro
	$idtarjetaregalo = 0;

	//Se declaran todas las variables vacias
	$nombre = "";
	$depende = "0";
	$empresa="";
	$estatus =1;
	//$descripcion="";
		$ruta="images/sinfoto.png";

	$col = "col-md-12";
	$ver = "display:none;";
	$titulo='NUEVA TARJETA REGALO';
	$fechavigencia="";
	$obtenerorden=$emp->ObtenerUltimoOrdentarjetaregalo();
	$roworden=$db->fetch_assoc($obtenerorden);
	$num=$db->num_rows($obtenerorden);
	if ($num>0) {
		$orden=$roworden['ordenar']+1;
	}else{
		$orden=0;
	}


}else{
	//El formulario funcionara para modificacion de un registro

	//Enviamos el id de la empresa a modificar a nuestra clase empresas
	$idtarjetaregalo = $_GET['idtarjetaregalo'];
	$emp->idtarjetaregalo = $idtarjetaregalo;

	//Realizamos la consulta en tabla empresas
	$result_tarjetaregalo = $emp->buscartarjetaregalo();
	$result_tarjetaregalo_row = $db->fetch_assoc($result_tarjetaregalo);

	//Cargamos en las variables los datos de las empresas

	//DATOS GENERALES
	$titulotarjetaregalo = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['nombretarjeta']);
	//$descripcion = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['descripcion']);
	
	$mensaje = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['mensaje']);
	$tipodescuento = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['tipodescuento']);

	$montodescuento = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['montodescuento']);
	$linkgenerado = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['linkgenerado']);
	$orden = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['orden']);

	$estatus = $f->imprimir_cadena_utf8($result_tarjetaregalo_row['estatus']);

	$fechavigencia=$result_tarjetaregalo_row['fechavigencia'];

	$col = "col-md-12";
	$ver = "";
		$titulo='EDITAR TARJETA DE REGALO';

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

<form id="f_tarjetaregalo" name="f_tarjetaregalo" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;position:fixed!important;z-index:10;right:0;margin-right:2em;width: 20%;">
				
				<?php
			
					//SCRIPT PARA CONSTRUIR UN BOTON
					$bt->titulo = "GUARDAR";
					$bt->icon = "mdi mdi-content-save";
					$bt->funcion = "var resp=MM_validateForm('v_titulo','','R'); if(resp==1){ GuardarTarjetaregalo('f_tarjetaregalo','catalogos/tarjetasregalo/vi_tarjetasregalo.php','main','$idmenumodulo');}";
					$bt->estilos = "float: right;";
					$bt->permiso = $permisos;
					$bt->class='btn btn-success';
				
					//validamos que permiso aplicar si el de alta o el de modificacion
				if($idtarjetaregalo == 0)
					{
						$bt->tipo = 1;
					}else{
						$bt->tipo = 2;
					}
			
					$bt->armar_boton();
				?>
				
				<!--<button type="button" onClick="var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main');}" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>-->
				
				<button type="button" onClick="aparecermodulos('catalogos/tarjetaregalo/vi_tarjetaregalo.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i>VER LISTADO </button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idtarjetaregalo; ?>" />
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

				<div class="card-body">
					
					
					<div class="tab-content tabcontent-border">
						<div class="tab-pane active show" id="generales" role="tabpanel">


							<div class="col-md-6" style="display: none;" >

									<form method="post" action="#" enctype="multipart/form-data">
								    <div class="card" style="width: 18rem;margin: auto;margin-top: 3em;">
								        <img class="card-img-top" src="">
								        <div id="d_foto" style="text-align:center; ">
											<img src="<?php echo $ruta; ?>" class="card-img-top" alt="" style="border: 1px #777 solid"/> 
										</div>
								        <div class="card-body">
								            <h5 class="card-title"></h5>
								           
								            <div class="form-group">

								            	
								               
								                <input type="file" class="form-control-file" name="image" id="image" onchange="SubirImagentarjetaregalo()">
								            </div>
								          <!--   <input type="button" class="btn btn-primary upload" value="Subir"> -->
								        </div>
								    </div>
								</form>

									<p style="text-align: center;">Dimensiones de la imagen Ancho:640px Alto:640px</p>
								</div>



							
							<div class="col-md-6" >

							<div class="form-group m-t-20">
								<label>*NOMBRE DE LA TARJETA:</label>
							<input type="text" class="form-control" id="v_titulo" name="v_titulo" value="<?php echo $titulotarjetaregalo; ?>" title="TITULO" placeholder='TITULO'>
							</div>

								<div class="form-group m-t-20">
								<label>*DESCRIPCIÓN:</label>
								<textarea name="v_descripcion" id="v_descripcion" cols="20" rows="4" class="form-control" title="DESCRIPCIÓN" placeholder='DESCRIPCIÓN'><?php echo $mensaje ?></textarea>
							</div>

								<div class="form-group">

										<label>*TIPO DE DESCUENTO:</label>
										<div class="form-group mb-2" style="">
			<select id="v_tipodescuento" class="form-control">
												<option disabled selected="" >SELECCIONAR TIPO DE DESCUENTO</option>
												<option value="0" <?php if($tipo == 0) { echo "selected"; } ?>>PORCENTAJE</option>

													<option value="1"  <?php if($tipo == 1) { echo "selected"; } ?>>MONTO</option>
											</select>
										</div>
									</div>
							



									<div class="form-group">

										<label>*CANTIDAD:</label>
										<div class="form-group mb-2" style="">
											<input type="number" class="form-control" name="" id="v_cantidadcomision" value="<?php echo $monto; ?>" style="">
										</div>
									</div>



									<div class="form-group">

										<label>*FECHA DE VIGENCIA:</label>
										<div class="form-group mb-2" style="">
											<input type="date" class="form-control" name="" id="v_fechavigencia" value="<?php echo $fechavigencia; ?>" style="">
										</div>
									</div>


							<div class="form-group m-t-20">
								<label>*ORDEN:</label>
							<input type="number" class="form-control" id="v_orden" name="v_orden" value="<?php echo $orden; ?>" title="orden" placeholder='ORDEN'>
							</div>



						<div class="form-group m-t-20">
							<label>ESTATUS:</label>
							<select name="v_estatus" id="v_estatus" title="Estatus" class="form-control"  >
								<option value="0" <?php if($estatus == 0) { echo "selected"; } ?> >DESACTIVO</option>
								<option value="1" <?php if($estatus == 1) { echo "selected"; } ?> >ACTIVADO</option>
							</select>
						</div>


							</div>

							<div class="col-md-12">

								  <div class="card">
		<div class="card-header">
				<label style="font-size: 16px;">*CLIENTE(S):</label>
			</div>
		<div class="card-body col-md-12">
			<div class="col-md-6" style="float: left;">
				<div class="card-header" style="padding-left: 0.45rem;">CUPÓN VÁLIDO PARA TODOS LOS CLIENTES
				 <input type="checkbox" id="v_tclientes"  name="v_tclientes" onchange="HabilitarDeshabilitarCheck('#lclientesdiv')" value="<?php ?>" title="PROMOCIÓN" placeholder='PROMOCIÓN' <?php  ?> >
				</div>
                <div class="card-body" id="lclientesdiv" style="display: block; padding: 0;">
                
                    <div class="form-group m-t-20">	 
						<input type="text" class="form-control" name="buscadorcli_?>" id="buscadorcli_" placeholder="Buscar" onkeyup="BuscarEnLista('#buscadorcli_','.cli_')">
				    </div>
                    <div class="clientes"  style="overflow:scroll;height:100px;overflow-x: hidden" id="clientes_<?php echo $a_cliente['idcliente'];?>">
					    <?php     	
							if ($r_clientes_num>0) {	
						    	do {
						?>
						    	<div class="form-check cli_"  id="cli_<?php echo $a_cliente['idcliente'];?>_<?php echo $a_cliente['idcliente'];?>">
						    	    <?php 	
						    			$valor="";
            $nombre=mb_strtoupper($f->imprimir_cadena_utf8($a_cliente['nombre']." ".$a_cliente['paterno']." ".$a_cliente['materno']));
						    		?>
									  <input  type="checkbox" value="" class="form-check-input chkcliente_<?php echo $idcupon;?>" id="inputcli_<?php echo $a_cliente['idusuarios']?>_<?php echo $idcupon;?>" <?php echo $valor; ?>>
									  <label class="form-check-label" for="flexCheckDefault"><?php echo $nombre; ?></label>
								</div>						    		
						    	<?php
						    		} while ($a_cliente = $db->fetch_assoc($r_clientes));
     					    	 ?>
						    	<?php } ?>    
				    </div>
                </div> <!-- lclientesdiv -->
			</div>
		</div>
    </div><!--card-CLI-->

								

							</div>

							</div>
						
							
						</div>
						
						
					
					</div>
				</div>
			</div>
		</div>


	</div>
</form>
<!-- <script  type="text/javascript" src="./js/mayusculas.js"></script>
 -->
<script>
	var ruta='<?php echo $ruta;?>';
			 

	
	    function SubirImagentarjetaregalo() {
	 	// body...
	 
        var formData = new FormData();
        var files = $('#image')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: 'catalogos/tarjetaregalo/upload.php',
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
                    $(".card-img-top").attr("src", response);
                    $("#d_foto").css('display','none');
                } else {

                	 $("#d_foto").html('<img src="'+ruta+'" class="card-img-top" alt="" style="border: 1px #777 solid"/> ');
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    }

</script>

<?php

?>