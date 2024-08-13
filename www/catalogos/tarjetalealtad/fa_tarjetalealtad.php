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
require_once("../../clases/class.Tarjetalealtad.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Usuarios.php");
require_once "../../clases/class.Paquetes.php";



$idmenumodulo = $_GET['idmenumodulo'];

//Se crean los objetos de clase
$db = new MySQL();
$emp = new Tarjetalealtad();
$f = new Funciones();
$bt = new Botones_permisos();
//////PAQUETES//////
$paquetes=new Paquetes();
$paquetes->db=$db;
$emp->db = $db;

$emp->tipo_usuario = $tipousaurio;
$emp->lista_empresas = $lista_empresas;


$cli = new Usuarios();
$cli->db = $db;
$r_clientes = $cli->lista_Usuarios(3);
$a_cliente = $db->fetch_assoc($r_clientes); 
$r_clientes_num = $db->num_rows($r_clientes);


//Validamos si cargar el formulario para nuevo registro o para modificacion
if(!isset($_GET['idtarjetalealtad'])){
	//El formulario es de nuevo registro
	$idtarjetalealtad = 0;

	//Se declaran todas las variables vacias
	$nombre = "";
	$depende = "0";
	$empresa="";
	$estatus =1;
	//$descripcion="";
		$ruta="images/sinfoto.png";

	$col = "col-md-12";
	$ver = "display:none;";
	$titulo='NUEVA TARJETA DE LEALTAD';
	$fechavigencia="";
	$repeticiones="";
	$obtenerorden=$emp->ObtenerUltimoOrdentarjetalealtad();
	$roworden=$db->fetch_assoc($obtenerorden);
	$num=$db->num_rows($obtenerorden);
	if ($num>0) {
		$orden=$roworden['ordenar']+1;
	}else{
		$orden=0;
	}


}else{
	
	$idtarjetalealtad = $_GET['idtarjetalealtad'];
	$emp->idtarjetalealtad = $idtarjetalealtad;

	//tarjeta regalo usuario
	$result_tarjetalealtad = $emp->buscartarjetalealtad();
	$result_tarjetalealtad_row = $db->fetch_assoc($result_tarjetalealtad);
	
	$nombre=$result_tarjetalealtad_row['nombre'];
	$descripcion=$result_tarjetalealtad_row['descripcion'];
	$cantidadrequerida=$result_tarjetalealtad_row['cantidadrequerida'];
	$cantidadbeneficio=$result_tarjetalealtad_row['cantidadbeneficio'];
	$orden=$result_tarjetalealtad_row['result_tarjetalealtad_row'];
	$fechainicial=$result_tarjetalealtad_row['fechainicial'];;
	$fechafinal=$result_tarjetalealtad_row['fechafinal'];

	$todosproducto=$result_tarjetalealtad_row['todosproducto'];
	$idsucursal=$result_tarjetalealtad_row['idsucursal'];
	$todosbeneficio=$result_tarjetalealtad_row['todosbeneficio'];
	$todoscliente=$result_tarjetalealtad_row['todoscliente'];

	$regla=$result_tarjetalealtad_row['regla'];
	$orden = $result_tarjetalealtad_row['orden'];
	$repeticiones=$result_tarjetalealtad_row['repeticiones'];
	$estatus = $result_tarjetalealtad_row['estatus'];

	$porvisita=$result_tarjetalealtad_row['porvisita'];


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

<form id="f_tarjetalealtad" name="f_tarjetalealtad" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;position:fixed!important;z-index:10;right:0;margin-right:2em;width: 20%;">
				
				<?php
			
					//SCRIPT PARA CONSTRUIR UN BOTON
					$bt->titulo = "GUARDAR";
					$bt->icon = "mdi mdi-content-save";
					$bt->funcion = " Guardartarjetalealtad('f_tarjetalealtad','catalogos/tarjetalealtad/vi_tarjetaslealtad.php','main','$idmenumodulo');";
					$bt->estilos = "float: right;";
					$bt->permiso = $permisos;
					$bt->class='btn btn-success';
				
					//validamos que permiso aplicar si el de alta o el de modificacion
				if($idtarjetalealtad == 0)
					{
						$bt->tipo = 1;
					}else{
						$bt->tipo = 2;
					}
			
					$bt->armar_boton();
				?>
				
				<!--<button type="button" onClick="var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main');}" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>-->
				
				<button type="button" onClick="aparecermodulos('catalogos/tarjetalealtad/vi_tarjetaslealtad.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i>VER LISTADO </button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idtarjetalealtad; ?>" />
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

								            	
								               
								                <input type="file" class="form-control-file" name="image" id="image" onchange="SubirImagentarjetalealtad()">
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
							<input type="text" class="form-control" id="v_titulo" name="v_titulo" value="<?php echo $nombre; ?>" title="NOMBRE" placeholder='NOMBRE'>
							<label id="lblnombre" style="display: none;">Campo requerido</label>
							</div>

								<div class="form-group m-t-20">
								<label>*DESCRIPCIÓN:</label>
								<textarea name="v_descripcion" id="v_descripcion" cols="20" rows="4" class="form-control" title="DESCRIPCIÓN" placeholder='DESCRIPCIÓN'><?php echo $descripcion ?></textarea>
									<label id="lbldescripcion" style="display: none;">Campo requerido</label>
							</div>
 
								<div class="form-group m-t-20"> 
								POR VISITA	<input type="checkbox" id="v_porvisita" name="v_porvisita"  value="" title="POR VISITA" placeholder="POR VISITA">

								</div>


								<div class="form-group m-t-20"> 
								AUTOMÁTICO	<input type="checkbox" id="v_automatico" name="v_automatico"  value="" title="AUTOMÁTICO" placeholder="AUTOMÁTICO">

								</div>

							<!-- 	<div class="form-group">

										<label>*TIPO DE DESCUENTO:</label>
										<div class="form-group mb-2" style="">
			<select id="v_tipodescuento" class="form-control">
												<option disabled selected="" >SELECCIONAR TIPO DE DESCUENTO</option>
												<option value="0" <?php if($tipo == 0) { echo "selected"; } ?>>PORCENTAJE</option>

													<option value="1"  <?php if($tipo == 1) { echo "selected"; } ?>>MONTO</option>
											</select>
										</div>
									</div> -->
							



									



									<div class="form-group">

										<label>*FECHA DE INICIO:</label>
										<div class="form-group mb-2" style="">
											<input type="date" class="form-control" name="" id="v_fechainicial" value="<?php echo $fechainicial; ?>" style="">
													<label id="lblfechainicial" style="display: none;">Campo requerido</label>
										</div>
									</div>

									<div class="form-group">

										<label>*FECHA DE FIN:</label>
										<div class="form-group mb-2" style="">
											<input type="date" class="form-control" name="" id="v_fechafinal" value="<?php echo $fechafinal; ?>" style="">
												<label id="lblfechafinal" style="display: none;">Campo requerido</label>
										</div>
									</div>


							<div class="form-group m-t-20">
								<label>NÚMERO DE REPETICIONES:</label>
								<input type="text" class="form-control" id="v_repeticiones" name="v_repeticiones" value="<?php echo $repeticiones; ?>" title="NÚMERO DE REPETICIONES" placeholder='NÚMERO DE REPETICIONES'>
								
							</div>


							<div class="form-group m-t-20">
								<label>ORDEN:</label>
							<input type="number" class="form-control" id="v_orden" name="v_orden" value="<?php echo $orden; ?>" title="orden" placeholder='ORDEN'>
								<label id="lblorden" style="display: none;">Campo requerido</label>
							</div>



						<div class="form-group m-t-20">
							<label>ESTATUS:</label>
							<select name="v_estatus" id="v_estatus" title="Estatus" class="form-control"  >
								<option value="0" <?php if($estatus == 0) { echo "selected"; } ?> >DESACTIVO</option>
								<option value="1" <?php if($estatus == 1) { echo "selected"; } ?> >ACTIVADO</option>
							</select>
							<label id="lblestatus" style="display: none;">Campo requerido</label>
						</div>


							</div>

		<div class="col-md-12">

		<div class="card">
		<div class="card-header">
				<label style="font-size: 16px;">*SERVICIO(S):</label>
			</div>
		<div class="card-body col-md-12">
			<div class="col-md-6" style="float: left;">
				<div class="card-header" style="padding-left: 0.45rem;"> TODOS LOS SERVICIOS
				 <input type="checkbox" id="v_tproductos"  name="v_tproductos" onchange="CheckSeleccionar('#v_tproductos','chkpaquete')" value="<?php ?>" title="PROMOCIÓN" placeholder='PROMOCIÓN' <?php  ?> >
				</div>
                

          <div class="card-body" id="lproductos" style="display: block;padding-left: 0;">
                    <div class="form-group m-t-20">	 
						<input type="text" class="form-control" name="buscadorpaq_" id="buscadorpaq_" placeholder="Buscar" onkeyup="BuscarEnLista('#buscadorpaq_','.pasuc_')">
				    </div>
                    <div class="paquetessucursales"  style="overflow:scroll;height:100px;" id="paquetessucursales_<?php echo $a_sucursal['idsucursales'];?>">
						<?php      
						        $r_paquetes=$paquetes->obtenerFiltroServicios();
				    	        $a_paquete=$db->fetch_assoc($r_paquetes);
				    	        $contar=$db->num_rows($r_paquetes);
						    	if ($contar>0) {
							    	 do {
						    		    ?>
						    		    <div class="form-check pasuc_"  id="pasuc_x_<?php echo $a_paquete['idpaquete'];?>">
						    			<?php 
						    			//$idsucursal=$a_sucursal['idsucursales'];
						    			//$idpaquete=$a_paquete['idpaquete'];
						    			//$estacheckeado=$paquetes->ObtenerPaqueteSucursal($idsucursal,$idpaquete);
						    			$valor="";
						    			if ($a_paquete['estatus']==1) {
						    
						    			?>
									    <input  type="checkbox" value="" class="form-check-input chkpaquete" id="inputpaq_<?php echo $a_paquete['idpaquete']?>" <?php echo $valor; ?>>
									    <label class="form-check-label" for="flexCheckDefault">
									    <?php echo $a_paquete['nombrepaquete']; 
                                        }?>
									  </label>
									</div>						    		
						    	<?php
						    		} while ($a_paquete = $db->fetch_assoc($r_paquetes));
     					    	 ?>
						    	<?php
                                 } 
                                ?>    
				    </div>
                    
     </div> <!--lpaquetesdiv-->
			</div>
		</div>
    </div><!--card-CLI-->


    <div class="form-group col-md-6" style="    margin-left: 2em;
    width: 280px;">

										<label>*CANTIDAD REQUERIDA:</label>
										<div class="form-group mb-2" style="">
											<input type="number" class="form-control" name="" id="v_cantidad" value="<?php echo $cantidadrequerida; ?>" style="">
											<label id="lblcantidarequerida" style="display: none;">Campo requerido</label>
										</div>
									</div>

								

							</div>



									<div class="col-md-12">

								  <div class="card">
		<div class="card-header">
				<label style="font-size: 16px;">*BENEFICIO(S):</label>
			</div>
		<div class="card-body col-md-12">
			<div class="col-md-6" style="float: left;">
				<div class="card-header" style="padding-left: 0.45rem;"> TODOS LOS SERVICIOS
				 <input type="checkbox" id="v_tproductosbene"  name="v_tproductosbene" onchange="CheckSeleccionar('#v_tproductosbene','paquetebeneficio')" value="<?php ?>" title="PROMOCIÓN" placeholder='PROMOCIÓN' <?php  ?> >
				</div>
                

          <div class="card-body" id="lproductosbene" style="display: block;padding-left: 0;">
                    <div class="form-group m-t-20">	 
						<input type="text" class="form-control" name="buscadorpaq2_" id="buscadorpaq2_" placeholder="Buscar" onkeyup="BuscarEnLista('#buscadorpaq2_','.paquebene_')">
				    </div>
     <div class="paquetessucursales2"  style="overflow:scroll;height:100px;" id="paquetessucursales2_<?php echo $a_sucursal['idsucursales'];?>">
						<?php      
						        $r_paquetes=$paquetes->obtenerFiltroServicios();
				    	        $a_paquete=$db->fetch_assoc($r_paquetes);
				    	        $contar=$db->num_rows($r_paquetes);
						    	if ($contar>0) {
							    	 do {
						    		    ?>
						    		    <div class="form-check paquebene_"  id="pasubene_<?php echo $a_paquete['idpaquete'];?>">
						    			<?php 
						    			//$idsucursal=$a_sucursal['idsucursales'];
						    			//$idpaquete=$a_paquete['idpaquete'];
						    			//$estacheckeado=$paquetes->ObtenerPaqueteSucursal($idsucursal,$idpaquete);
						    			$valor="";
						    			if ($a_paquete['estatus']==1) {
						    
						    			?>
									    <input  type="checkbox" onchange="ValidarSeleccionBeneficios()" value="" class="form-check-input paquetebeneficio" id="paquetebeneficio_<?php echo $a_paquete['idpaquete']?>" <?php echo $valor; ?>>
									    <label class="form-check-label" for="flexCheckDefault">
									    <?php echo $a_paquete['nombrepaquete']; 
                                        }?>
									  </label>
									</div>						    		
						    	<?php
						    		} while ($a_paquete = $db->fetch_assoc($r_paquetes));
     					    	 ?>
						    	<?php
                                 } 
                                ?>    
				    </div>
                    
     </div> <!--lpaquetesdiv-->
			</div>
							


		</div>

		<div class="form-group col-md-6" style="    margin-left: 2em;
    width: 280px;">

				<label>*CANTIDAD:</label>
				<div class="form-group mb-2" style="">
					<input type="number" class="form-control" name="" id="v_cantidadporbeneficio" value="<?php echo $cantidadbeneficio; ?>" style="">
							<label id="lblcantidadporbeneficio" style="display: none;">Campo requerido</label>
				</div>
			</div>		


		<div class="col-md-6 "  >

		<div class="form-group masdeuno" style="display: none;margin-left: 2em;
    width: 280px;">
	      <label for="regla">APLICAR REGLA:</label>
	      <select class="form-control" id="regla" name="regla" style="width: 260px;">
	       
	        <option value="1">O (Solo se podrá elegir uno de los beneficios)</option>
	        <option value="2">Y (Podrá escoger todos los beneficios seleccionados)</option>
	      </select>
	    </div>
   </div>
   </div><!--card-CLI-->

								

	</div>

		<div class="col-md-12">

			    <div class="card">
		<div class="card-header">
				<label style="font-size: 16px;">*CLIENTE(S):</label>
			</div>
		<div class="card-body col-md-12">
			<div class="col-md-6" style="float: left;">
				<div class="card-header" style="padding-left: 0.45rem;">TODOS LOS CLIENTES
				 <input type="checkbox" id="v_tclientes"  name="v_tclientes" onchange="CheckSeleccionar('#v_tclientes','chkcliente_')" value="<?php ?>" title="PROMOCIÓN" placeholder='PROMOCIÓN' <?php  ?> >
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
									  <input  type="checkbox" value="" class="form-check-input chkcliente_" id="inputcli_<?php echo $a_cliente['idusuarios']?>" <?php echo $valor; ?>>
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
<!--card-CLI-->

								

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
		
	function CheckSeleccionar(divid,clasedivs) {	
		if($(divid).is(':checked')){

		//$(divid).css('display','block');
		$("."+clasedivs).attr('checked',true);
	
		}else{
	
			$("."+clasedivs).attr('checked',false);

		}
}

var idtarjetalealtad='<?php echo $idtarjetalealtad; ?>';

if (idtarjetalealtad>0) {

	var todosproducto='<?php echo $todosproducto; ?>';
	var todosbeneficio='<?php echo $todosbeneficio; ?>';
	var todoscliente='<?php echo $todoscliente; ?>';
var regla='<?php echo $regla; ?>';
	ObtenerProductosTarjeta(idtarjetalealtad);
 ObtenerBeneficios(idtarjetalealtad);
 ObtenerClienterTarjeta(idtarjetalealtad);


 var v_tproductos= '<?php echo $todosproducto; ?>';
 var v_tproductosbene='<?php echo $todosbeneficio; ?>';
 var v_tclientes='<?php echo $todoscliente; ?>';
 if (v_tproductos==1) {
 	//$("#v_tproductos").attr('checked',true);
 }
 /*	CheckSeleccionar('#lproductos')
*/

 	if (regla>0) {
 		$("#regla").val(regla);
 	}

 	var porvisita='<?php echo $porvisita; ?>';
 	if (porvisita==1) {
 		$("#v_porvisita").attr('checked',true);
 	}


 //}

 if (v_tproductosbene==1) {
 	 //	$("#v_tproductosbene").attr('checked',true);

 	//CheckSeleccionar('#lproductosbene')

 }

	if (v_tclientes==1) {
	 	//$("#v_tclientes").attr('checked',true);

		//CheckSeleccionar('#lclientesdiv')

	}

}

	
	    function SubirImagentarjetalealtad() {
	 	// body...
	 
        var formData = new FormData();
        var files = $('#image')[0].files[0];
        formData.append('file',files);
        $.ajax({
            url: 'catalogos/tarjetalealtad/upload.php',
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