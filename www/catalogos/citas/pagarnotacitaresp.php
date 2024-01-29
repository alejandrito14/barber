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
$idnotapago=$_GET['idnotapago'];
$accion=$_GET['accion'];

$funcionboton="RealizarpagoCompletado(".$idnotapago.",".$accion.")";
$tituloboton="PAGAR";
$titulovista="COMPLETAR EL PAGO";
if ($accion==1) {
  $tituloboton="PAGAR";

}


if ($accion==3) {

  $tituloboton="ENTREGAR";
  $funcionboton="EntregarProducto(".$idnotapago.",".$accion.")";
}
$estilo="";
if ($accion==4) {
  $estilo="display:none";
  $titulovista="DETALLE DE PAGO";

}
 ?>
<form id="f_nivel" name="f_nivel" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulovista; ?></h4>

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
	<div class="row">
	
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


	<div class="col-md-6">
								
	<div class="row" style="    margin-top: 2em;">
			<div class="col-md-12" style="" id="titulometodopago">
			<!-- <select name="" id="tipopago" class="form-control" onchange="CargarOpcionesTipopago()" style="padding-left: 30px;">
				<option value="0">SELECCIONAR MÉTODO DE PAGO</option>
			</select> -->
			<p>SELECCIONAR MÉTODO DE PAGO</p>
			<div class="divtipopago  btn-group-toggle litipodepago"></div>
		</div>
		</div>
		
	


	<div class="row" style="padding-right: 30px;margin-top: 1em">
		
		<div class="col-md-12 divbancos" style="display: none;" >
			<div class="form-group">
			<!-- <select name="" id="tipopago" class="form-control" onchange="CargarOpcionesTipopago()" style="padding-left: 30px;">
				<option value="0">SELECCIONAR MÉTODO DE PAGO</option>
			</select> -->
			<p>SELECCIONAR BANCO</p>
			<div class="divbancos  btn-group-toggle libancos"></div>
		</div>
		</div>


		<div class="col-md-12 divdigitos" style="display: none;" >

			<div class="form-group">
				<label for="">DÍGITOS DE LA TARJETA</label>

				<input type="text" class="form-control" id="txtdigitostarjeta" onkeyup="VerficarFormulariocompleto()">
		</div>
		</div>


			<div class="col-md-12 divopcionestarjeta"  style="display: none;">
			<div class="form-group">
				<label for="">OPCIONES DE TARJETA</label>

					<div class="btn-group-toggle ">
								<label class="btn btn_colorgray2 btntipo" id="catetipo_1">
			<input type="checkbox" id="catetipo_1" class="catechecktipo1" onchange="SeleccionarOpciontarjeta(1)" value="0"> 
				DÉBITO</label>

					<label class="btn btn_colorgray2 btntipo" id="catetipo_2">
			<input type="checkbox" id="catetipo_2" class="catechecktipo1" onchange="SeleccionarOpciontarjeta(2)" value="0"> 
				CRÉDITO</label>

					</div>


			
				
		</div>
		</div>
		
	</div>


	<div class="">
			
		 <div class="divtransferencia" style="display: none;">
      <div  >
        <div class="list media-list" style="list-style: none;">
           <div class="informacioncuenta" style="padding-right: 30px;"></div>
        </div>
        

       </div>
     </div>
       <div id="campomonto" style="display: none;">
    <div class="subdivisiones" style="margin-top: 1.5em;width: 12em!important;" >
      <span style="margin-top: .5em;margin-left: .5em;">¿Con cuanto pagas?</span>
    </div>

    <div class="row" style="">
     <div  style="" class="col-md-12">
      

          <div style="padding-right:30px;">
            
            <div class="label-radio item-content">
              
              <div class="item-inner">
             
                <div class="">

                  <input type="number" name="montovisual" class="form-control" id="montovisual" style="font-size: 18px;float: left;padding-right: 30px;" placeholder="$0.00"  />
                  <input type="number" name="montocliente" id="montocliente"  style="font-size: 18px;float: left;width: 60%;    margin-left: 1.2em;display: none;" placeholder="$0.00"   />

                 
                </div>

                </div>


                <div class="item-after" style="">
                 


                   <span class="botoneditar" style="margin-right:.10em;" >
                  
                  <i class="bi bi-pencil "></i>
                  <span class="if-not-md"></span>

                  </span>


                     <span class="botoneditar" onclick="" style="visibility: collapse;">
                  
                      <i class="bi bi-pencil"></i>

                  </span>
                 
                </div>

              
            </div>


            </div>
        </div>

      </div>

      <div class="row" style="margin-top: 5px;">
					<div class="col-md-12">
						<label class="">Cambio $<span id="cambio">0.00</span>
						</label>
					</div>
	
</div>
</div> 



    <div class=" row">
              <div style="background-color:#dfdfdf;border-radius:10px;padding-top: .5px;padding-bottom: .5px;display: none;" id="aparecerimagen">
              <div class="">
                  <div class="row no-gap" style="text-align: center;"> 
                   <img src="" id="imagencomprobante" width="60" />
                  </div>
                </div>

                 <div class="block "> 
                     <div class="list media-list sortable" id="" style="">           

                    <ul id="lista-imagenescomprobante" class="list-group" style="margin-bottom: 1em;">
                        
                    </ul>
                </div> 
              </div>


        </div>

      </div>
       
       

        <div class=" divtarjetas" >
          <div class="" id="divlistadotarjetas">

      <div class="divisiones2" style="display: none;"><span style="margin-top: .5em;margin-left: .5em;">Seleccionar tarjeta</span></div>
      <div class="">
        <div class="">
          
          <div style="text-align: center;" id="categorianombre" class="categorianombre"></div>
          <div class="swiper-container  demo-swiper">
            <div class="swiper-wrapper" id="slidecategoria">

            </div>
          </div>

          <div  style="padding-right: 30px;">
            <ul id="listadotarjetas">
              
            </ul>
            <div class="divisiones2 divnueva" style="display: none;">
              <a class="btn btn-warning botonesredondeado botones btnnuevatarjeta"  style="color: black!important;background: #FFC830!important;margin-right: 1em; margin-top: 1em;margin-bottom: 10px;width: 100%;">Nueva Tarjeta</a>
            </div>    
          </div>
              
        </div>
      </div>
    </div>
    <div class="" id="divagregartarjeta" style="display: none;">

      <div class="divisiones2" style="    margin-bottom: 1em;
    margin-top: 1em;font-weight: bold;display: none;"><span style="">Introduce la información de la tarjeta</span></div>

      <div class="divisiones2" style="">

         <div class="">
         <div class="list form-list no-margin margin-bottom" id="my-form">
           <div>
            
              <div>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label" >*Nombre en la tarjeta</div> 

                <div class="item-input-wrap" style="font-size: 15px;padding-right: 30px;">
                  <input type="text" name="cardholder-name" placeholder="TITULAR DE LA TARJETA" class="mayusculas place form-control" id="v_cardholder-name" style="" />
                  <span class="input-clear-button"></span>
                </div>
                  <label for="" id="lblnombre" class="lbl" style="color:red;"></label>
                </div>
                </div>
              </div>
              <div>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label">*Número de tarjeta</div>
                <div class="item-input-wrap" style="font-size: 15px;">
                  <div class="sr-input sr-element sr-card-element" id="v_card-number" style="margin-top: .5em;" >
                    <!-- A Stripe card Element will be inserted here. -->
                  </div>
                  <span class="input-clear-button"></span>
                </div>
                <label for="" id="lblntarjeta" class="lbl" style="color:red;"></label>
                </div>
                </div>
              </div> 
              <div>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label">*Fecha de vencimiento</div>
                <div class="item-input-wrap" style="font-size: 15px;">
                  <div class="sr-input sr-element sr-card-element" id="v_card-expiry" style="margin-top: .5em;">
                    <!-- A Stripe card Element will be inserted here. -->
                  </div>
                  <span class="input-clear-button"></span>
                </div>
                <label for="" id="lblntarjeta" class="lbl" style="color:red;"></label>
                </div>
                </div>

              </div> 

              <div>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label">*CVC</div>
                <div class="item-input-wrap" style="font-size: 15px;">
                  <div class="sr-input sr-element sr-card-element" id="v_card-cvc" style="margin-top: .5em;">
                    <!-- A Stripe card Element will be inserted here. -->
                  </div>
                  <span class="input-clear-button"></span>
                </div>
                <label for="" id="lblcvc" class="lbl" style="color:red;"></label>
                </div>
                </div>
              </div>
          </div>
          <div class="sr-field-error " id="card-errors" role="alert" style="color:#E25950;"></div>
          <div class=" " style="padding-right: 30px;">
            <a class="btn btn-warning" onclick="" id="submit-card" style="margin-bottom: 1em; color: white!important; background: #FFC830!important;width: 100%;">Guardar Tarjeta</a>



     <a class="btn btn-danger botonesredondeado botones"  id="btnatras" style="
    color: white!important;
    background: red!important;
    margin-top: 1em;margin-bottom: 1em;">Cancelar</a>
          </div>  
        </div>
         </div> 
      </div>
    </div>  	


	</div>
</div>

<div class="row" style="padding-right: 30px;margin-bottom: 1em;">
					
						<div class="col-md-12">
							<button type="button" class="btn  btn-success btn-lg btn-block" id="btnpagarresumen" style="background: #007aff;border-color: #007aff;<?php echo $estilo; ?>" disabled onclick="<?php echo $funcionboton; ?>" style=""><?php echo $tituloboton; ?></button>
						</div>
				</div>

        <div class="row">
          
          <div id="detallesdeentrega" style="display: none;">
            <p><span style="font-weight: bold;">FECHA ENTREGA:</span> <span id="fechaentrega"></span> </p>
            <p ><span style="font-weight: bold;"> OBSERVACIONES:</span> <span id="observaciones"></span></p>

           <p><span style="font-weight: bold;">USUARIO DE ENTREGA:</span> <span id="usuarioentrega"></span></p>
          </div>
        </div>

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

<div class="modal" id="modalespera" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
       
      </div>
      <div class="modal-body" id="divespera">
      
       
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


<!-- El modal -->
<div class="modal fade" id="modalentrega">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Encabezado del modal -->
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Contenido del modal -->
      <div class="modal-body">
       
          <div class="form-group m-t-20">
                        <label>OBSERVACIONES:</label>
                        <textarea id="v_observaciones" name="v_observaciones" title="OBSERVACIONES" class="form-control" style="height: 85px;"></textarea>
                      </div>
      </div>
      
      <!-- Pie del modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success btnpagarentregar">Guardar</button>
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
        var accion='<?php echo $accion; ?>';
				var comision=0;
				var comisionmonto=0;
				var comisiontotal=0;
				var impuestotal=0;
				var subtotalsincomision=0;
				var impuesto=0;
				var comisionpornota=0;
				var comisionnota=0;
				var tipocomisionpornota=0;
				
				var idnotapago="<?php echo $idnotapago; ?>";
				Detallepago(idnotapago);


        if (accion==3 || accion==4) {

          $(".litipodepago").css('display','none');
          $("#titulometodopago").css('display','none');
          $("#btnpagarresumen").attr('disabled',false);

        }


			</script>