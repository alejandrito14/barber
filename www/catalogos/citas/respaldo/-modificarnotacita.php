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

$notapago->idnotapago=$idnotapago;
$obtenernota=$notapago->Obtenernota();

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
  $titulovista="MODIFICAR NOTA DE PAGO";

$funcionboton="RealizarpagoCompletado(".$idnotapago.",".$accion.")";
}
 ?>
  
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
  
 <link rel="stylesheet" href="dist/css/rescalendar.css">


 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <script src="js/rescalendar.js"></script>


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
			
				//	$bt->armar_boton();
				?>
				
				<button type="button" onClick="GuardarNotaCita(<?php echo $idnotapago; ?>)" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>
				
				<button type="button" onClick="aparecermodulos('catalogos/dashboard/vi_dashboard.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i>REGRESAR</button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idpagos; ?>" />
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
	<div class="row">
    <div class="col-md-12">
      
      <div class="col-md-4"></div>
        <div class="col-md-4"></div>
          <div class="col-md-4">
            
            <button type="button" id="btnagregar" class="btn  btn_azul" onclick="AgregarNuevo()">AGREGAR</button>
          </div>
    </div>
	
 <div class="col-md-12 divdetalle" style="">
<!-- 					<label for="">DETALLE DE NOTA</label>
 -->					<div class="row">
						<div class="col-md-12">
							<span id="folionota" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;">Pago #<?php echo $obtenernota[0]->folio; ?></span>

    <span id="fechapago" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;margin-top: 1em;">Fecha: 
    <?php echo date('d/m/Y H:i:s',strtotime($obtenernota[0]->fecha)); ?></span>
						</div>
						
					</div>

      <div class="listadopaquetes2"></div>

			 <div class="listadopaquetes"></div>

				<div class="divdetallenota" id="divdetallenota"></div>



        

							<!-- <div class="row">
								<div class="col-md-12">
									<button class="btn btn-success btncambiarestatus" onclick="">ACEPTAR PAGO</button>
								</div>
							</div> -->

							</div>

              <div class="col-md-12" style="
    background: white;
    /* margin-left: 0.5em; */
    /* margin-top: 2em; */
    /* margin-right: 0.5em; */
    /* margin-bottom: 2em; */
    ">

  

    

    
    <div class="col-md-3" style="
    float: right;
">

      <div class="row" style="margin-top: 10px;display: none;">
        <div class="col-md-12">
            <div class="form-group requierefacturadiv" style="margin-left: 10px;display: none;">
              REQUIERE FACTURA
              <input type="checkbox" id="requierefactura" onchange="ObtenerListadoDatosFiscales()">

            </div>
        </div>

        <div class="col-md-12">
            <div class="divfiscal" style="">
              

            </div>
        </div>

      </div>

  <div class="row" style="margin-top: 10px;
    padding-right: 30px;">
  
 
</div>
  <div class="row detallepago" style="">
  
  <div class="row detallepago" style="">
  <div class="col-md-6" style="
    margin: 0;
    padding: 0;
">
    <div class="">
      <div class="col-md-12">
        <div class="card">
        <div class="card-body" style="padding: 1.25rem 0rem 1rem 1rem;">
      <div class="row" style="
             
          ">
            <div class="col-md-12" style="font-size: 16px;">SUBTOTAL: </div>
            <div class="col-md-12" style="font-size: 16px;display: none;">MONEDERO: </div>
      
        <div class="col-md-12" style="font-size: 16px;display: none;">DESCUENTO: </div>
        <div class="col-md-12" style="font-size: 16px;display: none;">DESCUENTO MEMB.: </div>
          <div class="col-md-12 divcomision" style="font-size: 16px;display: none;">COMISIÓN: </div>

        <div class="col-md-12" style="font-size: 20px;">TOTAL:</div>

      </div>
    </div>
  </div>
  </div>
  </div>
</div>
  <div class="col-md-6" style="font-size: 16px;">
 
    <div class="row" style="/* width: 94%; */">
      <div class="col-md-12" style="
    padding: 0;
    margin: 0;
">
        <div class="card">
        <div class="card-body" style="/* padding: 1.25rem 1rem 1rem 1rem; */">
      <div class="row">
        <div class="col-md-12" style="text-align: right;">$<span id="subtotal" class="lbltotal" style="
    font-size: 16px;
">0.00</span></div>
            <div class="col-md-12" style="text-align: right;display: none;">$<span id="monedero" style="
    font-size: 16px;
">0.00</span></div>
        
        <div class="col-md-12" style="text-align: right;display: none;">$<span id="descuento" style="
    font-size: 16px;
">0.00</span>
        </div>
        <div class="col-md-12" style="text-align: right;display: none;">$<span id="descuentomembresia" style="
    font-size: 16px;
">0.00</span><br>
        </div><br>

  <div class="col-md-12 divcomision" style="text-align: right;display: none;">$<span id="comision" class="lblcomision" style="font-size: 16px;">0.00</span>
  </div>


        <div class="col-md-12" style="text-align: right;font-size: 20px;">$<span id="total">0.00</span></div></div>

      </div>
    </div>
  </div>
  </div>
    </div>
  </div>

  
  </div>
  

  <div class="row" style="padding-right: 30px;">
    
    


    


     
    
  </div>


 

        <div class="row" style="padding-right: 30px;margin-bottom: 1em;">
          
           
        </div>

    </div>

        

</div>

              <div class="row" style="    background: white;
    margin-left: 0.5em;
    margin-top: 2em;
    margin-right: 0.5em;
    margin-bottom: 2em;">

  

    <div class="col-md-6"></div>

    
    <div class="col-md-6">

      <div class="row" style="margin-top: 10px;display: none;">
        <div class="col-md-12">
            <div class="form-group requierefacturadiv" style="margin-left: 10px;display: none;">
              REQUIERE FACTURA
              <input type="checkbox" id="requierefactura" onchange="ObtenerListadoDatosFiscales()">

            </div>
        </div>

        <div class="col-md-12">
            <div class="divfiscal" style="">
              

            </div>
        </div>

      </div>

  <div class="row" style="margin-top: 10px;
    padding-right: 30px;">
  
 
</div>
  
  

  <div class="row" style="padding-right: 30px;">
    
    


    


     
    
  </div>


 

        <div class="row" style="padding-right: 30px;margin-bottom: 1em;">
          
           
        </div>

    </div>

        <div class="col-md-2"></div>

</div>


	<div class="col-md-6">

    <div class="row" style="    margin-top: 2em;">
      <div class="col-md-12" style="" id="divtotalnota" style="display: none;">
      <span id="" style="font-size: 24px;">$</span>
      <span id="totalnotas" style="font-size: 24px;">0.00</span>
    </div>
    </div>
								
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



<div class="modal" id="modaldetallenota2" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">DETALLE NOTA DE PAGO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="divdetallenota2"></div>
      
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


     
       
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

.divintervalotiempo{
  
    top: 80px;
    right: 0;
    background: #9c9c9c;
    color: white;
    padding: 2px;
    border-radius: 5px;
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
				var arraypaqueteseleccionadocreado2=[];

        var idmenumodulo='<?php echo $idmenumodulo; ?>';

				var idnotapago="<?php echo $idnotapago; ?>";
				//Detallepago(idnotapago);


        if (accion==3 || accion==4) {
          DetallepagoModificar(idnotapago);
          $(".litipodepago").css('display','none');
          $("#titulometodopago").css('display','none');
          $("#btnpagarresumen").attr('disabled',false);
          $("#divtotalnota").css('display','none');

        }else{

          $("#divtotalnota").css('display','block');
          ObtenerNotasPendientes(idnotapago);


        }



        /*function ObtenerNotasPendientes(idnotapago) {
           
          var datos="idnotapago="+idnotapago;
          $.ajax({
          url: 'catalogos/citas/ObtenerNotasPendientes.php', //Url a donde la enviaremos
          type: 'POST', //Metodo que usaremos
          dataType:'json',
          data:datos,
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            var error;
            console.log(XMLHttpRequest);
            if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
            $("#divcomplementos").html(error);
          },  
          success: function (msj) {
            var notaelegida=msj.notaelegida;
            var notaspendientes=msj.notaspago;
            var fechasnotas=msj.fechasnotas;
            PintarNotasPendientes(notaspendientes,fechasnotas);

            console.log(msj);

            var idtipopago=notaelegida[0].idtipopago;
            ObtenerTipodepagosCompletar(idtipopago);

          }
        });



        }*/

       /* function PintarNotasPendientes(respuesta,fechasnotas) {
          //.
          var html="";
          if (fechasnotas.length>0) {

            html+=` <ul class="list-group">`;

           for (var k = 0; k <fechasnotas.length; k++) {
            html+=`<li style="    list-style: none;background: lightsteelblue;">
             <div class="row" style="    padding: 10px;    margin-left: 10px;
    font-weight: bold;">
              <label>`+fechasnotas[k][0].fechaformato+`</label>
             <div>
            </li>`;
           
            for (var i = 0; i <respuesta.length; i++) {
              if (fechasnotas[k][0].fecha==respuesta[i].fechaagrupar) {
              html+=`

                  <li class="list-group-item">
                  <div class="row" style="    padding: 10px;">
                    <div class="form-check" style="    height: 40px;width:100%;">
                      <input class="form-check-input inputpagos" type="checkbox" value="`+respuesta[i].subtotal+`" style="    position: absolute;
    top: -2px;" onchange="SeleccionarPago(`+respuesta[i].idnotapago+`)" id="checkbox_`+respuesta[i].idnotapago+`">

                      <label class="form-check-label" for="checkbox1">
                        Pago #`+respuesta[i].folio+` | Total: $`+respuesta[i].subtotal+`
                      </label>

                      <span class="btn btn-primary" style="float: right;" onclick="VerdatellaNota(`+respuesta[i].idnotapago+`)">Ver detalle</span>
                    </div>
                      </div>

                    `;

      var detalle=respuesta[i].detalle;


      if (detalle.length>0) {
     for (var j = 0; j < detalle.length; j++) {
                        
                       
    var color='';
         
    imagen='catalogos/paquetes/imagenespaquete/'+detalle[j].foto;

      html+=`
        
      <div class="row" style="border: 1px solid #cacaca;padding: 10px; margin: 1px 1px 0px 1px; justify-content: space-between;display: flex;">
              <div class="col-md-4" style="width: 40%;">
               <img src="`+imagen+`" alt="" style="width: 150px;">
              </div>
              <div class="col-md-8" style="width: 60%;">
                <div class="row" style="margin-left: 1em;">
                  <div class="col-md-6">
                        <p style="margin:0;"> `+detalle[j].concepto+` </p>
           
                      <p style="margin:0;">Cantidad: `+detalle[j].cantidad+`</p>`;

                      if (detalle[j].usuarioespecialista!='' && detalle[j].usuarioespecialista!=null) {
                        html+=`<p style="margin:0;">Especialista: `+detalle[j].usuarioespecialista+`</p>`;
                        html+=`<p style="margin:0;">Fecha: `+detalle[j].fechaformato+`</p>`;

                        if (detalle[j].horains!='' && detalle[j].horains!=null) {
                          html+=`<p style="margin:0;">`+detalle[j].horains+`-`+detalle[j].horafs+`Hrs.</p>`;
                        }

                         if (detalle[j].horainicial!='') {
                          html+=`<p style="margin:0;">`+detalle[j].horainicial+`-`+detalle[j].horafinal+` Hrs.</p>`;
                        }

                        
                        }

                           if (detalle[j].concortesia==1  ) {


                          if (detalle[j].idcortesia>0 ) {

                          html+=`


                         <div class="icon-text-container" style="">

                           <p style="margin:0;">Cortesía: <span class="texto">`+detalle[j].nombrepaquetecortesia+`</span></p>

                           </div>`;

                      }


                      if (detalle[j].idcortesia==0 && detalle[j].colococortesia==1) {

                          html+=`


                         <div class="icon-text-container" >

                           <p style="margin:0;">Cortesía: <span class="texto">Ninguna</span></p>

                           </div>`;
                      }
                  }
                   html+= `</div>
                 
                      <div class="col-md-6">
                     <p class="text-muted " style="font-size:20px;margin:0px;">$`+formato_numero(detalle[j].monto,2,'.',',')+`</p>
                       
                      </div>

                    </div>  
                  </div> 
                 </div>

              
            </div>

      `;

                      }
                    }


                    html+=`
                  </li>

              `;
            }
          }
         }

         }


          $(".divdetallenota").html(html);
        }
*/

       /* function SeleccionarPago(idnotapago) {
         
         SumarPagos();

        }*/

       /* function SumarPagos() {
          var suma=0;
              $(".inputpagos").each(function( index ) {

                if($(this).is(':checked'))
                {
                  var valor=$(this).val();
                  suma=parseFloat(suma)+parseFloat(valor);
                  total=suma;
                }

             });

              $("#totalnotas").html(formato_numero(suma,2,'.',','));
        }
*/
  /*function VerdatellaNota(idnotapago) {
    $("#modaldetallenota2").modal();
    PintarDetalleHtml2();
    var detalleimagen=[];

    var idusuario="";
    var datos="idnotapago="+idnotapago+"&id_user="+idusuario;
    var pagina = "ObtenerDetallePago.php";
  
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/dashboard/'+pagina, //Url a donde la enviaremos
    data:datos,
    async:false,
    success: function(resp){
      var resultado=resp.respuesta[0];
         var subtotalnota=resp.subtotalnota;
         var idtipopago=resultado.idtipopago;
         var subtotalcupon=resp.subtotalcupon;

      $(".lblsubtotal").text(formato_numero(subtotalnota,2,'.',','));
      $(".lblcupon").text(formato_numero(subtotalcupon,2,'.',','));

      $("#lblnumeronota").text(resultado.folio);
      $(".lblresumen").text(formato_numero(resultado.subtotal,2,'.',','));
      $(".lblcomision").text(formato_numero(resultado.comisiontotal,2,'.',','));
      $(".lbltotal").text(formato_numero(resultado.total,2,'.',','));
      $(".lblmonedero").text(formato_numero(resultado.montomonedero,2,'.',','));
      $("#tipopago").text(resultado.tipopago);
      if (resultado.datostarjeta!='') {
      $(".datostarjeta").html(resultado.datostarjeta);
      $(".infodatostarjeta").append(resultado.datostarjeta2);

      }

        if (resultado.descripcioncupon!=null && resultado.descripcioncupon!='' && resultado.idcupon>0) {

            var cupon=`
              <p style="color: #C7AA6A;text-align:center;font-size:15px;margin:0;" class="cambiarfuente">`+resultado.codigocupon+`</p>
                  <p style="color: #C7AA6A;text-align:center;" class="cambiarfuente">Descuento aplicado `+resultado.descripcioncupon+`</p>
            `;

            $(".cuponaplicado").html(cupon);
          }

      if (resultado.requierefactura==1) {


        var html="";
        html+=`<p>
          Razon social: `+resultado.razonsocial+`
          
        </p>`;
        html+=`<p>
          RFC.: `+resultado.rfc+`</p>`;
      html+=`<p>
          Correo.: `+resultado.correo+`</p>`;
      html+=`<p>
          Cod. Postal: `+resultado.codigopostal+`</p>`;
          var imagenes=resultado.imagenconstancia;
          if (imagenes!='') {

          var imagen=imagenes.split(',');
          detalleimagen=imagen;
          var htmlimagenes="";
          for (var i = 0; i < imagen.length; i++) {
                    urlimagen=urlphp+`upload/datosfactura/`+imagen[i];

            html+=`
              <div class="row">
                            <div class="col-20" style="margin:0;padding:0;">
                              <figure class="avatar   rounded-10">
                              <img src="`+urlimagen+`" alt="" style="width:60px;height:60px;" onclick="DetalleImagen(`+i+`)">
                              </figure>
                            </div>

                           </div>

            `;
          }
        }

          $(".datosfiscales").html(html);
        

      }

      $("#usuariopedido").text(resultado.usuariopedido);

      if (resultado.entregado==1) {

        $("#detallesdeentrega").css('display','block');
        $("#fechaentrega").text(resultado.fechaentrega);
        $("#observaciones").text(resultado.observacionesentrega);
        $("#usuarioentrega").text(resultado.usuarioentrega);


        

      }
      var pagos=resp.pagos;


      ObtenerTipodepagosCompletar(idtipopago);


      Pintarpagosdetalle2(pagos);
       $("#visualizardescuentos").css('display','none');

       $("#modaldetallenota").modal();
      
    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
    }

  });

        }*/

var horaselecte=""
var fechaselecte2="";
function PintarProductosSeleccionadosStep3() {

 var subtotal=0;
 var total=0;
    var html = "";
    var i,j;
    var cargodatos=0;
    arraypaqueteseleccionadocreado2=[];
       $(".listadopaquetes2").html('');
       console.log(arraypaqueteseleccionado2);
    if (arraypaqueteseleccionado2.length > 0) {

        for (var i = 0; i < arraypaqueteseleccionado2.length; i++) {
 subtotal=parseFloat(subtotal)+parseFloat(arraypaqueteseleccionado2[i].costototal);
          intervalotiempo += `<span style="padding: 2px;border-radius: 5px;"></span>`;
          

            var html = "";
            var tiempo = arraypaqueteseleccionado2[i].intervaloservicio;
            var foto = arraypaqueteseleccionado2[i].ruta;
            var intervalotiempo = "";
            var dates=[];
           

            if (arraypaqueteseleccionado2[i].servicio == 1) {


              contador=0;
              for (var j = 0; j < arraypaqueteseleccionado2[i].cantidad; j++) {

              // console.log('entro'+j);

                if (tiempo != null && tiempo !== '') {
                intervalotiempo = `<span class="divintervalotiempo"><span style="margin-right: 2px">Tiempo</span><span id="divintervalotiempo_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`"> ${tiempo}</span>min.
                </span>`;
            } else {
                intervalotiempo = `<span style="padding: 2px;border-radius: 5px;"></span>`;
            }
                  
                  var key='';
             if (j==0) {
                key=arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_0`;
                  arraypaqueteseleccionado2[i].key=key;

                  // arraypaqueteseleccionadocreado.push(arraypaqueteseleccionado[i]);
                   
              }else{

                key=arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j;
                  arraypaqueteseleccionado2[i].key=key;

                   
              }
           
               arraypaqueteseleccionadocreado2.push({ ...arraypaqueteseleccionado2[i]
               });
         
              console.log(arraypaqueteseleccionadocreado2);
        //for (var k = 0; k < 5; k++) {
          // currentDate.setDate(currentDate.getDate());
            // var dates = generateDateRange(currentDate, 5);
              
        //}


                html=`
              <div class="row p-2 bg-white border rounded" id="divcpaqueitem_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" >
                <div class="col-md-3 mt-1">
                <div class="row">
                <div class="col-md-12">
                <img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}">
                </div>
                <div class="col-md-12">

                  <div style="justify-content: center; display: flex;">

                  <span class="mdi mdi-check-circle" id="divsucces_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" style="display:none;font-size: 40px;color: #5ab75d;">
                  </span>

                    <span class="mdi mdi-close-circle" id="diverror_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" style="display:none;font-size: 40px;color: red;">
                    </span>

                     </div>

                  </div>
                </div>

                </div>
                <div class="col-md-6 mt-1">
                    <h5>`+arraypaqueteseleccionado2[i].nombrepaquete+`<button type="button" id="" class="btn btn-primary" onclick="CambiarProducto('`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`')" >Cambiar</button></h5>
                   <h4 class="mr-1">`;

                 html+=`<span> $${arraypaqueteseleccionado2[i].costounitario}</span>`;


                  html+=` </h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+arraypaqueteseleccionado2[i].titulo+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>`;

                    // alert(arraypaqueteseleccionado2[i].fechaformato);

                    if (arraypaqueteseleccionado2[i].fecha!=null) {

                   html+=`  <p class="text-justify text-truncate  mb-0" style="" id="parrafofecha_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`">
                    Fecha: <span id="fecha_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`">`+arraypaqueteseleccionado2[i].fechaformato+`</span>
                    </p>`;

                  }

                  if (arraypaqueteseleccionado2[i].horainicial!='') {
                   html+=`
                    <p class="text-justify text-truncate  mb-0" style="" id="parrafohora_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`">
                    Hora: <span id="hora_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`">`+arraypaqueteseleccionado2[i].horainicial+`</span>
                    </p>`;

                  }
          if (arraypaqueteseleccionado2[i].usuarioespecialista!=null) {

                    html+=`
                    <p class="text-justify text-truncate  mb-0" style="" id="parrafobarbero_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`">
                    Barbero: <span id="barbero_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`">`+arraypaqueteseleccionado2[i].usuarioespecialista+`</span>
                    </p>`;
                  }

                  html+=`  <p class="text-justify text-truncate  mb-0" style="" id="">
                   
                    </p>

                    <div id="info_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" style="display:none;">
                    <div style="margin-top:10px;" id="date-carousel_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`"></div>
                    <div class="row">
                     <div class="col-md-12">

                      <div class=" btn-group-toggle " data-toggle="buttons" id="carrusel_horarios_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" style="">
                      

                       </div>
                       </div>
                     </div>

                     <div class="row">
                      <div class="col-md-12">

                        <div class=" btn-group-toggle " data-toggle="buttons" id="seleccionarduracion_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`">
                         </div>

                      </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">

                     <div class="seleccionarbarbero_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" style=""></div>
                      </div>

                     </div>

                     <div class="row" >
                     <div class="col-md-12">
                     <button type="button" id="btnconfirmar`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" style="display:none;    float: right;margin-right: 25px;" onclick="ConfirmarStep3(`+arraypaqueteseleccionado2[i].idtemporalcarrito+`,`+i+`,`+j+`)" class="btn btn-primary ">Guardar</button>
                     </div>
                    </div>
                </div>

            </div>
        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
          <div class="d-flex flex-row align-items-center">
                        
         </div>
        <h6 class="text-success"></h6>
        <div class="d-flex flex-column mt-4 align-items-center">
                        
        <div class="row">
            
        </div>

        <div class="row" style="margin:1em;">
          <button class="btn btn_rojo " style="width: 100px;" id="btneliminar`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`"" type="button" onclick='EliminarPaquete2(`+arraypaqueteseleccionado2[i].idtemporalcarrito+`,`+i+`,`+j+`)'>Eliminar
          </button>

          <button class="btn btn_colorgray " style="width: 100px;" id="btneditar`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_`+j+`" type="button" onclick='EditarPaquete2(`+arraypaqueteseleccionado2[i].idtemporalcarrito+`,`+i+`,`+j+`)'>Editar
          </button>
        </div>

                    </div>
                </div>
            </div>

            `;
       
             $(".listadopaquetes2").append(html);
           f_paquete="";
         

           if (arraypaqueteseleccionado2[i].servicio == 1) {
           
          
            configureAndActivateCarousel(`date-carousel_${arraypaqueteseleccionado2[i].idtemporalcarrito}_${i}_${j}`, dates);
                  
           
              if(contador==0 && cargodatos==0){
                 
               if(horaselecte!='' && fechaselecte2!='' ){

                 

                  var llave=arraypaqueteseleccionado2[i].idtemporalcarrito+'_'+i+'_'+j;

                  cargodatos=1;
                   // Cargardatos(fechaselecte2,horaselecte,idespecialista,llave);
                  }
               }

                contador++;

                }


               }

            } else {
                // Código para el caso en que el servicio no sea igual a 1
                // (sin el bucle interno)
                  html=`
              <div class="row p-2 bg-white border rounded" id="divcpaqueitem_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_0" >
                <div class="col-md-3 mt-1">
                  <div class="row">
                  <div class="col-md-12">
                  <img class="img-fluid img-responsive  rounded product-image" style="border-radius:10px;" src="${foto}">
                </div>
                <div class="col-md-12">
                  <div style="justify-content: center; display: flex;">
                  <span class="mdi mdi-check-circle" id="divsucces_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_0" style="font-size: 40px;color: #5ab75d;display:none;">
                  </span>

                  <span class="mdi mdi-close-circle" id="diverror_`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_0" style="display:none;font-size: 40px;color: red;">
                  </span>

                 
                </div>

                </div>
                  </div>

                </div>
                <div class="col-md-5 mt-1">
                    <h5>`+arraypaqueteseleccionado2[i].nombrepaquete+`</h5>
                   <h4 class="mr-1">`;
                
                   if (arraypaqueteseleccionado2[i].servicio==0) {

                    html+=`<span>${arraypaqueteseleccionado2[i].cantidad}</span>x`;
                   }
                 html+=`<span>$${arraypaqueteseleccionado2[i].costototal}</span>`;


                  html+=` </h4>
                    <div class="d-flex flex-row">
                        <div class="ratings mr-2" style="display:none;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>

                    </div>
                    <div class="mt-1 mb-1 spec-1">
                     <span class="dot"></span>
                    <span>`+arraypaqueteseleccionado2[i].titulo+`</span>
                   
                    </div>
                    
                    <p class="text-justify text-truncate para mb-0">
                    `+intervalotiempo+`
                    </p>
                    
                </div>
                <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        
                    </div>
                    <h6 class="text-success"></h6>
                    <div class="d-flex flex-column mt-4 align-items-center">
                        
                    <div class="row">
            
               
                  
              </div>

        <div class="row">
          <button class="btn btn_rojo " style="width: 100px;" id="btneliminar`+arraypaqueteseleccionado2[i].idtemporalcarrito+`_`+i+`_0"" type="button" onclick='EliminarPaquete2(`+arraypaqueteseleccionado2[i].idtemporalcarrito+`,`+i+`,0)'>Eliminar
          </button>
        </div>

                    </div>
                </div>
            </div>

            `;

             arraypaqueteseleccionado2[i].key=arraypaqueteseleccionado2[i].idtemporalcarrito+'_'+i+'_0';

             arraypaqueteseleccionadocreado2.push(arraypaqueteseleccionado2[i]);

             $(".listadopaquetes2").append(html);
            }

          
        }

        $("#subtotal").text(formato_numero(subtotal,2,'.',','));
        $("#total").text(formato_numero(subtotal,2,'.',','));
    }
    console.log('creando nuevo arraypaqueteseleccionadocreado2');
    console.log(arraypaqueteseleccionadocreado2);


    
      Validacionpaquetes2();

    

}



  function PintarDetalleHtml2() {
  

  var html=`
   <div class="col-md-12 divdetalle" style="display: block;">

  <div class="row">
  <div class="col-md-12">
   <p style="text-align: center;font-size: 18px;" id="">
      <span style="font-weight: bold;">Pago</span> #<span id="lblnumeronota"></span></p>

    <span id="fechapago" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;margin-top: 1em;"></span>
            </div>
            
          </div>
          <div class="listadopagoselegidos" id="listadopagos"> 
          <li class="list-group-item  align-items-center" style="">
             
          </div>

          <div>
            <ul class="list-group subtotal" style="display: block;">
                  <li class="list-group-item  align-items-center" style="color:">
                   <div class="row">
                   <div class="col-md-12">
                      <p id="" style="text-align:center;">Subtotal</p>
                              <p class="" style="
                         text-align:center;
                      ">$<span id="lblsubtotal" class="lblsubtotal">0.00</span></p>
                             </div>
                             <div class="col-md-2">

                        <span class="badge ">
                        </span>
                       </div>
                    
                    </div>

                  </li>
                </ul>
              </div>


              <div>
            <ul class="list-group comision" style="display: block;">
                  <li class="list-group-item  align-items-center" style="color:">
                   <div class="row">
                   <div class="col-md-12">
                      <p id="" style="text-align:center;">Comisión</p>
                              <p class="" style="
                         text-align:center;
                      ">$<span id="lblcomision" class="lblcomision">0.00</span></p>
                             </div>
                             <div class="col-md-2">

                        <span class="badge ">
                        </span>
                       </div>
                    
                    </div>

                  </li>
                </ul>
              </div>


                <div>
              <ul class="list-group divcupon" style="display: block;">
                  <li class="list-group-item  align-items-center" style="color:">
                   <div class="row">
                   <div class="col-md-12">
                      <p id="" style="text-align:center;">Cupón</p>
                      </div>
                      <div class="col-md-12">
                         <div class="cuponaplicado"></div>
                      </div>
                      <div class="col-md-12">

                              <p class="" style="
                         text-align:center;
                      ">$<span id="lblcupon" class="lblcupon">0.00</span></p>
                             </div>
                             <div class="col-md-2">

                        <span class="badge ">
                        </span>
                       </div>
                    
                    </div>

                  </li>
                </ul>
              </div>

            <div>
              <ul class="list-group divmonedero" style="display: block;">
                  <li class="list-group-item  align-items-center" style="color:">
                   <div class="row">
                   <div class="col-md-12">
                      <p id="" style="text-align:center;">Monedero</p>
                              <p class="" style="
                         text-align:center;
                      ">$<span id="lblmonedero" class="lblmonedero">0.00</span></p>
                             </div>
                             <div class="col-md-2">

                        <span class="badge ">
                        </span>
                       </div>
                    
                    </div>

                  </li>
                </ul>
              </div>

              




              



                <div>
                <ul class="list-group divtotal" style="display: block;">
                  <li class="list-group-item  align-items-center" style="background: #aeb3b7;">
                   <div class="row">
                   <div class="col-md-12">
                      <p id="" style="text-align:center;">Total</p>
                              <p class="" style="text-align:center;">$<span id="" class="lbltotal">980.00</span></p>
                             </div>
                             <div class="col-md-2">

                        <span class="badge ">
                        </span>
                       </div>
                    
                    </div>

                  </li>
                </ul>
              </div>
              <div class="row">
                <div class="col-md-12 imagenescomprobante">
        

                  </div>
              </div>

              <div class="row" style="margin-top:10px;">
                <div class="col-md-12">
                  <label for="">MÉTODO DE PAGO:</label>
                  <span id="tipopago"></span>
                </div>
                <div class="col-md-12">

                  <div class="datostarjeta" style="float: left;"></div>
                          <div class="infodatostarjeta"></div>
                          </div>
                
                
              </div>

                
              <div class="requierefactura" style="display:none;">
                <div class="row">
                  <div class="col-md-12">
                    <label for="">REQUIERE FACTURA:</label>
                  <span id="requierefactura"></span>
                </div>
                </div>
              </div>


                <div class="foliofacturacion" style="display: none;">
                <div class="row">
                  <div class="col-md-12">
                    <label for="">FOLIO DE FACTURA:</label>
                  <span id="foliofactura"></span>
                </div>
                </div>
              </div>

                <div class="fechafac" style="display: none;">
                <div class="row">
                  <div class="col-md-12">
                    <label for="">FECHA DE FACTURA:</label>
                  <span id="fechafactura"></span>
                </div>
                </div>
              </div>

              <!-- <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-success btncambiarestatus" onclick="">ACEPTAR PAGO</button>
                </div>
              </div> -->

                  <div class="row">
                    <div class="col-md-12">
                    <label>
                    PEDIDO DE:
                      
                       </span>
                     <span id="usuariopedido">
                    </label>

                   </div>
                </div>

              </div>

          
  

    </div>
  `;

  $("#divdetallenota2").html(html);
}


function DetallepagoModificar(idnotapago) {
  //PintarDetalleHtml();
  var detalleimagen=[];


  var idusuario="";
  var datos="idnotapago="+idnotapago+"&id_user="+idusuario;
  var pagina = "ObtenerDetallePagoModifica.php";
   
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/dashboard/'+pagina, //Url a donde la enviaremos
    data:datos,
    async:false,
    success: function(resp){
      var resultado=resp.respuesta[0];
      var pagos=resp.pagos;
      var idsucursal=resultado.idsucursal;

    
      CrearSesionSucursal(idsucursal);
         /*var subtotalnota=resp.subtotalnota;
         var idtipopago=resultado.idtipopago;
         var subtotalcupon=resp.subtotalcupon;

      $(".lblsubtotal").text(formato_numero(subtotalnota,2,'.',','));
      $(".lblcupon").text(formato_numero(subtotalcupon,2,'.',','));

      $("#lblnumeronota").text(resultado.folio);
      $(".lblresumen").text(formato_numero(resultado.subtotal,2,'.',','));
      $(".lblcomision").text(formato_numero(resultado.comisiontotal,2,'.',','));
      $(".lbltotal").text(formato_numero(resultado.total,2,'.',','));
      $(".lblmonedero").text(formato_numero(resultado.montomonedero,2,'.',','));
      $("#tipopago").text(resultado.tipopago);
      if (resultado.datostarjeta!='') {
      $(".datostarjeta").html(resultado.datostarjeta);
      $(".infodatostarjeta").append(resultado.datostarjeta2);

      }

        if (resultado.descripcioncupon!=null && resultado.descripcioncupon!='' && resultado.idcupon>0) {

            var cupon=`
              <p style="color: #C7AA6A;text-align:center;font-size:15px;margin:0;" class="cambiarfuente">`+resultado.codigocupon+`</p>
                  <p style="color: #C7AA6A;text-align:center;" class="cambiarfuente">Descuento aplicado `+resultado.descripcioncupon+`</p>
            `;

            $(".cuponaplicado").html(cupon);
          }

      if (resultado.requierefactura==1) {


        var html="";
        html+=`<p>
          Razon social: `+resultado.razonsocial+`
          
        </p>`;
        html+=`<p>
          RFC.: `+resultado.rfc+`</p>`;
      html+=`<p>
          Correo.: `+resultado.correo+`</p>`;
      html+=`<p>
          Cod. Postal: `+resultado.codigopostal+`</p>`;
          var imagenes=resultado.imagenconstancia;
          if (imagenes!='') {

          var imagen=imagenes.split(',');
          detalleimagen=imagen;
          var htmlimagenes="";
          for (var i = 0; i < imagen.length; i++) {
                    urlimagen=urlphp+`upload/datosfactura/`+imagen[i];

            html+=`
              <div class="row">
                            <div class="col-20" style="margin:0;padding:0;">
                              <figure class="avatar   rounded-10">
                              <img src="`+urlimagen+`" alt="" style="width:60px;height:60px;" onclick="DetalleImagen(`+i+`)">
                              </figure>
                            </div>

                           </div>

            `;
          }
        }

          $(".datosfiscales").html(html);
        

      }

      $("#usuariopedido").text(resultado.usuariopedido);

      if (resultado.entregado==1) {

        $("#detallesdeentrega").css('display','block');
        $("#fechaentrega").text(resultado.fechaentrega);
        $("#observaciones").text(resultado.observacionesentrega);
        $("#usuarioentrega").text(resultado.usuarioentrega);


        

      }
     


      ObtenerTipodepagosCompletar(idtipopago);

*/ arraypaqueteseleccionado2=pagos;
  
  console.log(arraypaqueteseleccionado2);
      PintarProductosSeleccionadosStep3();
       $("#visualizardescuentos").css('display','none');
       $("#modaldetallenota").modal();
      

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
    }

  });

}


function EditarPaquete2(idpaquete,i,j) {

    cellpaquete=idpaquete+'_'+i+'_'+j;

    $("#parrafofecha_"+cellpaquete).css('display','none');
    $("#parrafohora_"+cellpaquete).css('display','none');
    $("#parrafobarbero_"+cellpaquete).css('display','none');


    $("#divsucces_"+idpaquete+"_"+i+"_"+j).css('display','none');
    $("#diverror_"+idpaquete+"_"+i+"_"+j).css('display','none');
  
 

//$("#btneditar"+idpaquete+`_`+i+`_`+j).css('display','none');

  //$("#btneditar"+idpaquete+`_`+i+`_`+j).text('DESHACER');

  //$("#btneditar"+idpaquete+`_`+i+`_`+j).attr('onclick','DeshacerCambios('+idpaquete+','+i+','+j+')');


var fechaselecte2=arraypaqueteseleccionado2[i].fechacita;
var horaselecte=arraypaqueteseleccionado2[i].horainicial;
var idespecialista=arraypaqueteseleccionado2[i].idespecialista;

var intervalotiempo=arraypaqueteseleccionado2[i].intervaloservicio;

  console.log('entra'+arraypaqueteseleccionado2[i]);

  if (fechaselecte2==null || fechaselecte2=='') {
    fechaselecte2=fechaactual();
  }

  //alert(fechaselecte2);
  //alert(horaselecte);
  Cargardatos2(fechaselecte2,horaselecte,idespecialista,cellpaquete,intervalotiempo,i);

  $("#btnconfirmar"+idpaquete+"_"+i+"_"+j).css('display','block');

   $("#info_"+idpaquete+"_"+i+"_"+j).css('display','block');
}

function DeshacerCambios(idpaquete,i,j) {
  
   $("#info_"+idpaquete+"_"+i+"_"+j).css('display','none');
   $("#btneditar"+idpaquete+`_`+i+`_`+j).text('EDITAR');

   $("#btneditar"+idpaquete+`_`+i+`_`+j).attr('onclick',' EditarPaquete2('+arraypaqueteseleccionado2[i].idpaquete+','+i+','+j+')');

    cellpaquete=idpaquete+'_'+i+'_'+j;

    $("#parrafofecha_"+cellpaquete).css('display','block');
    $("#parrafohora_"+cellpaquete).css('display','block');
    $("#parrafobarbero_"+cellpaquete).css('display','block');
}


function fechaactual() {
  // Obtén la fecha actual
var fechaActual = new Date();

// Obtiene el día, mes y año
var dia = fechaActual.getDate();
var mes = fechaActual.getMonth() + 1; // Los meses comienzan desde 0, así que sumamos 1
var año = fechaActual.getFullYear();

// Formatea la fecha como 'dd/mm/yyyy'
var fechaFormateada = (dia < 10 ? '0' : '') + dia + '/' + (mes < 10 ? '0' : '') + mes + '/' + año;
  return fechaFormateada;
}



function configureAndActivateCarousel(idelemento) {


  fecha=fechaactual();


   $('#'+idelemento).rescalendar({
                    id: idelemento,
                    format: 'DD/MM/YYYY',
                    jumpSize: 1,
                    locale: 'es',
                    refDate: fecha,
                    lang: {
                        'today': 'Hoy',
                        'init_error': 'Error al inicializar',
                        'no_data_error' : 'No se encontraron datos para mostrar'
                    },

                    data: [
                        
                    ],

                    dataKeyField: 'name',
                    dataKeyValues: ['', '', '']

                });



}




function ObtenerHorariosStep3(celldate,cellpaquete) {

  var idpaquete=0;

  var fechaFormateada = convertirFormatoFecha(celldate);
  //alert('horarios');
  console.log('obtenerhorarios..');
  for (var i = 0; i <arraypaqueteseleccionadocreado2.length; i++) {

    if (arraypaqueteseleccionadocreado2[i].key==cellpaquete) {
        arraypaqueteseleccionadocreado2[i].fecha=fechaFormateada;
        idpaquete= arraypaqueteseleccionadocreado2[i].idpaquete;

        console.log(idpaquete);
        break;
    }
  

  }

  fechaseleccionada=fechaFormateada;
  var datos="fecha="+fechaFormateada+"&idsucursal="+0+"&idpaquete="+idpaquete;
 
  var pagina="ObtenerDisponibilidadPaqueteEspecialista.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    data:datos,
    success: function(msj){
      horarioseleccionado=0;
      
        var intervalos=msj.intervalos;
        PintarIntervalos3(intervalos,cellpaquete);
          

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}


function PintarIntervalos3(respuesta,cellpaquete) {

  $(`#carrusel_horarios_${cellpaquete}`).html('');

  
  

if ($(`#carrusel_horarios_${cellpaquete}`).hasClass('slick-initialized')) {
    // Si existe, destruye la instancia
    $(`#carrusel_horarios_${cellpaquete}`).slick('unslick');
}

   $(`#carrusel_horarios_${cellpaquete}`).slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
            prevArrow: '<button type="button" class="btn " style="    float: left;margin-top: 10px;    margin-right: 15px;"><</button>',
        nextArrow: '<button type="button" class="btn" style="    float: left;margin-top: 10px;margin-left: 10px;">></button>',
        // Agrega otras configuraciones según tus necesidades
    });

    var html="";
  
    if (respuesta.length>0) {
      for (var i = 0; i < respuesta.length; i++) {
          
        html=`
        <label class="btn btn_dorado btncategointervalo1_`+cellpaquete+` horariossele_`+cellpaquete+`"  data-hora="`+respuesta[i].horainicial+`" data-horafinal="`+respuesta[i].horafinal+`" id="catebtn_`+i+cellpaquete+`" style="margin: 1px;width: 90px;margin-top: 10px;">
         <input type="checkbox" id="cate_`+i+`" class="catecheck" style="display:none;" onchange="SeleccionarHorario1('`+respuesta[i].horainicial+`','`+respuesta[i].horafinal+`','`+i+`','`+cellpaquete+`')" value="0" >`+respuesta[i].horainicial+`
        </label>
        
        `;
    
    
     $(`#carrusel_horarios_${cellpaquete}`).slick('slickAdd', `<div>`+html+`</div>`);
    }

    $(`#carrusel_horarios_${cellpaquete}`).find('.slick-list.draggable').css({
        width: '300px', // Establece el ancho deseado
        height: '60px', // Establece la altura deseada
        float:'left',
    });

  


    

    // html += `</div>`;

  //$("#horarios_"+cellpaquete).html(html);

  

  //  $(`#horarios_${cellpaquete}`).html(html);

   

   //$(`#horarios_${cellpaquete}`).html(html);

    
  }

}

function convertirFormatoFecha(fechaOriginal) {
    // Dividir la fecha en día, mes y año
    var partesFecha = fechaOriginal.split('/');
    var dia = partesFecha[0];
    var mes = partesFecha[1];
    var año = partesFecha[2];

    // Crear un objeto Date con el nuevo formato
    var fechaFormateada = new Date(`${año}-${mes}-${dia}`);

    // Obtener la fecha en formato "yyyy-mm-dd"
    var fechaString = fechaFormateada.toISOString().split('T')[0];

    return fechaString;
}


function convertirFormatoFechadiamesanio(fechaOriginal) {
    // Dividir la fecha en día, mes y año
    var partesFecha = fechaOriginal.split('/');
    var dia = partesFecha[0];
    var mes = partesFecha[1];
    var año = partesFecha[2];

    // Crear un objeto Date con el nuevo formato
    var fechaFormateada = new Date(`${año}-${mes}-${dia}`);

    // Obtener la fecha en formato "día/mes/año"
    var diaFormateado = fechaFormateada.getDate();
    var mesFormateado = fechaFormateada.getMonth() + 1; // Se suma 1 porque los meses en JavaScript van de 0 a 11
    var añoFormateado = fechaFormateada.getFullYear();

    // Agregar ceros a la izquierda si es necesario
    diaFormateado = diaFormateado < 10 ? '0' + diaFormateado : diaFormateado;
    mesFormateado = mesFormateado < 10 ? '0' + mesFormateado : mesFormateado;

    // Obtener la fecha en formato "día/mes/año"
    var fechaString = `${diaFormateado}/${mesFormateado}/${añoFormateado}`;

    return fechaString;
}


var detalle=[];

function SeleccionarHorario1(horainicial,horafinal,i,cellpaquete) {
 
  $(".horariossele_"+cellpaquete+"").removeClass('active');

  $("#catebtn_"+i+cellpaquete).add('active');
  horainicialsele=horainicial;
  horafinalsele=horafinal;
  horarioseleccionado=horainicialsele+'_'+horafinalsele;
  detalle[3]=horainicialsele+'Hrs.';
            // Pintardetalle();
        console.log('seleccionar horario');
   var tiempo=0;
   for (var i = 0; i <arraypaqueteseleccionadocreado2.length; i++) {

    if (arraypaqueteseleccionadocreado2[i].key == cellpaquete) {
    arraypaqueteseleccionadocreado2[i].hora=horarioseleccionado;
    arraypaqueteseleccionadocreado2[i].horainicial= horainicialsele;
    tiempo=arraypaqueteseleccionadocreado2[i].intervaloservicio;

   // alert(horarioseleccionado);
    //arraypaqueteseleccionadocreado2[i].barbero='';

    //arraypaqueteseleccionadocreado2[i].idespecialista='';
    $(".especialistalista_"+cellpaquete).removeClass('active');
    }
    
  }

  //Agregaradetalle(horainicialsele);
//horaseleccionada=arrayhorarios[posicion];

   //HabilitarBoton2();
//aqui
  ObtenerTiempo2(cellpaquete,tiempo);
  idespecialistaseleccionado="";
  ObtenerListadoEspecialista2(cellpaquete);
   $("#btstep3").css('display','block');

   $("#btstep3").attr('onclick','showStep(4)');

}

function EliminarPaquete2(idpaquete,i,j) {
  
  cellpaquete=idpaquete+'_'+i+'_'+j;

    $("#divcpaqueitem_"+cellpaquete).remove();
  
    for (var i = 0; i <arraypaqueteseleccionadocreado2.length; i++) {

      if (arraypaqueteseleccionadocreado2[i].key==cellpaquete) {
        arraypaqueteseleccionadocreado2.splice(i, 1); // 1 es la cantidad de elemento a eliminar
        break;

      }
      
    }

   
    var datos='idtemporalcarrito='+idpaquete;
    var pagina = "EliminarElemento.php";
    $.ajax({ 
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/temporalcarrito/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(resp){

      ObtenerTemporalCarrito(idnotapago);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });



}

function ObtenerListadoEspecialista2(cellpaquete) {
 var objeto=[];
  idpaqueteseleccionado="";
  console.log('cargando listado');
  console.log(arraypaqueteseleccionadocreado2);
  idespecialistasele="";
  for (var i = 0; i <arraypaqueteseleccionadocreado2.length; i++) {

      if (arraypaqueteseleccionadocreado2[i].key==cellpaquete) {
idpaqueteseleccionado=arraypaqueteseleccionadocreado2[i].idpaquete;

idespecialistasele=arraypaqueteseleccionadocreado2[i].idespecialista;

objeto=arraypaqueteseleccionadocreado2[i];
        break;

      }
      
    }

  //alert('obtener espe '+idpaqueteseleccionado);

    var horario=horainicialsele+'_'+horafinalsele;
    var datos='idsucursal='+idsucursal+"&idpaquete="+idpaqueteseleccionado+"&horaseleccionada="+horario+"&fecha="+fechaseleccionada+"&idespecialistasele="+idespecialistasele+"&idnotapago="+idnotapago+"&objeto="+JSON.stringify(objeto);
    var pagina = "ObtenerEspecialistaPaqueteSucursalModifica.php";
    $.ajax({ 
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(datos){
      var especialistas=datos.especialista;
      
      PintarDetalleEspecialistas(especialistas,cellpaquete);
     // PintarDetalleEspecialistas2(especialistas);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

}

function ObtenerListadoEspecialista3() {
 

    var horario=horainicialsele+'_'+horafinalsele;
    var datos='idsucursal='+idsucursal+"&idpaquete="+idpaqueteseleccionado+"&horaseleccionada="+horario+"&fecha="+fechaseleccionada;
    var pagina = "ObtenerEspecialistaPaqueteSucursal2.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(datos){
      var especialistas=datos.especialista;
      PintarDetalleEspecialistas(especialistas);
     // PintarDetalleEspecialistas2(especialistas);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

}

function PintarDetalleEspecialistas(especialistas,cellpaquete) {

  if ($(".seleccionarbarbero_"+cellpaquete).hasClass('slick-initialized')) {
    // Si existe, destruye la instancia
    $(".seleccionarbarbero_"+cellpaquete).slick('unslick');
       $(".seleccionarbarbero_"+cellpaquete).html(' ');

}


   $(".seleccionarbarbero_"+cellpaquete).slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
         prevArrow: '<button type="button" class="btn " style="    float: left;margin-top: 10px;    margin-right: 15px;"><</button>',
        nextArrow: '<button type="button" class="btn" style="    float: left;margin-top: 10px;margin-left: 10px;">></button>',
        // Agrega otras configuraciones según tus necesidades
    });


 var html="";
      if (especialistas.length>0) {
       for (var i = 0; i <especialistas.length; i++) {

        var nombrecom=especialistas[i].nombre+` `+especialistas[i].paterno;
        html = `
            <a class="list-group-item list-group-item-action especialistalista_${cellpaquete}" id="especialista_${especialistas[i].idespecialista}_${cellpaquete}" onclick="SeleccionarEspecialista(${especialistas[i].idespecialista},'${nombrecom}','${cellpaquete}')" style="background: #c7aa6a; color: white; margin-bottom: 1em;margin-top: 1em;width: 90px;height: 120px;float: left;    margin-left: 2px;">
                <div class="text-center">
                    <img src="${especialistas[i].foto}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" class="mb-2">
                    <div style="justify-content: center;
    display: flex;">${especialistas[i].nombre} ${especialistas[i].paterno}</div>
                </div>
            </a>
        `;


         $(`.seleccionarbarbero_${cellpaquete}`).slick('slickAdd', `<div>`+html+`</div>`);

       }


    $(`.seleccionarbarbero_${cellpaquete}`).find('.slick-list.draggable').css({
        width: '300px', // Establece el ancho deseado
        height: '200px', // Establece la altura deseada
        float:'left',
    });
      }


}

function SeleccionarEspecialista(idespecialista,nombrecom,cellpaquete) {
 $(".especialistalista_"+cellpaquete).removeClass('active');

 //$("#especialista_"+idespecialista+"_"+cellpaquete).addClass('active');
 idespecialistaseleccionado=idespecialista;
 //VerificarSiLlevavalor();
 //$("#btstep4").css('display','block');
 detalle[4]=nombrecom;

 for (var i = 0; i <arraypaqueteseleccionadocreado2.length; i++) {

  if (arraypaqueteseleccionadocreado2[i].key==cellpaquete) {
    arraypaqueteseleccionadocreado2[i].barbero=nombrecom;
    arraypaqueteseleccionadocreado2[i].idespecialista=idespecialistaseleccionado;
      break;
    }
  }

   $(".especialistalista_"+cellpaquete).each(function( index) {

        var id=$(this).attr('id');
        var dividir=id.split('_')[1];
        
        if (dividir==idespecialista) {
            var elementoPadre = document.getElementById(id);

        // Obtener el elemento dos hijos abajo
           var elementoDeseado = elementoPadre.querySelector('div > div').innerText;

            $(this).addClass('active');

        }



      })
    
 //Agregaradetalle(nombrecom);
 //$("#btstep4").attr('onclick','IrAresumen()');
 //$("#btnconfirmar"+cellpaquete).css('display','block');

 //$("#btstep4").attr('onclick','AbrirTiempo()');
 //Pintardetalle();
}


   function Pintardetalle() {
    var html="";
    if (detalle.length>0) {
     //$("#divdetalles").css('display','block');

     for (var i = 0; i < detalle.length; i++) { 
     console.log('impri '+detalle[i]);


       if (detalle[i]!=undefined && detalle[i]!='') {

if (typeof detalle[i] === 'string' && detalle[i].includes('|')) {

         separar=detalle[i].split('|');
       html+=separar[0]+'<span class="divintervalotiempo2">Tiempo'+separar[1]+'min.</span>'+' |';


         }else{
            if (i!=5) {
              html+=detalle[i]+'|';
            }

         
        }
        
       }
       
     }
    }

    $("#divdetalles").html(html);
   }


function ObtenerTiempo2(cellpaquete,diferencia) {
  
    var pagina = "ObtenerTiempo.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    success: function(resp){
      var resultado=resp.resultado;
      if (resultado.length>0) {

         PintarTiempo2(resultado,diferencia,cellpaquete);
         

       }


       },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });


}
function PintarTiempo2(resultado,diferencia,cellpaquete) {

  console.log('diferencia tiempo'+diferencia);
  var html="";
  if (resultado.length>0) {

    if ($("#seleccionarduracion_"+cellpaquete).hasClass('slick-initialized')) {
      // Si existe, destruye la instancia
      $("#seleccionarduracion_"+cellpaquete).slick('unslick');
  }


   $("#seleccionarduracion_"+cellpaquete).slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,

         prevArrow: '<button type="button" class="btn " style="    float: left;margin-top: 10px;    margin-right: 15px;"><</button>',
        nextArrow: '<button type="button" class="btn" style="    float: left;margin-top: 10px;margin-left: 10px;">></button>',
        // Agrega otras configuraciones según tus necesidades
    });


    
      

    for (var i = 0; i < resultado.length; i++) {
       activado="";
      if (resultado[i].valor==diferencia) {
        activado="active";
      }

      html=`
        <label class="btn btn_dorado `+activado+` divtiempoc_`+cellpaquete+`" id="tiempobtn_`+cellpaquete+`_`+resultado[i].valor+`_`+i+`" style="margin-right: 10px;    width:100%;height: 36px;
    text-transform: lowercase!important;
     width: 90px;    margin-top: 10px;
    float: left;    margin-left: 2px;
    ">`+resultado[i].valor+`min.
        <input type="checkbox" id="cates_`+i+`" class="catecheck" onchange="SeleccionarTiempo1(`+resultado[i].valor+`,'min','`+cellpaquete+`',`+i+`)" value="0" style="display:none;">
       </label>

      `;

      $(`#seleccionarduracion_${cellpaquete}`).slick('slickAdd', `<div>`+html+`</div>`);

    }


    $(`#seleccionarduracion_${cellpaquete}`).find('.slick-list.draggable').css({
        width: '300px', // Establece el ancho deseado
        height: '50px', // Establece la altura deseada
        float:'left',
    });

  }

  //$(".seleccionarduracion_"+cellpaquete).html(html);
}



  
function SeleccionarTiempo1(valor,min,cellpaquete,i) {
  
  $(".divtiempoc_"+cellpaquete).removeClass('active');

  valorseleccionado=valor;
  //$("#tiempobtn_"+cellpaquete+"_"+valor+"_"+i).addClass('active');
  concatenar=valor+''+min;

   for (var i = 0; i <arraypaqueteseleccionadocreado2.length; i++) {

    if (arraypaqueteseleccionadocreado2[i].key==cellpaquete) {
    arraypaqueteseleccionadocreado2[i].intervaloservicio=valorseleccionado;

    horainicial= arraypaqueteseleccionadocreado2[i].horainicial;
    horafinal= arraypaqueteseleccionadocreado2[i].horafinal;
    posicion=i;
    break;
    }
    
  }

  console.log('tiempo');
  $("#divintervalotiempo_"+cellpaquete).text(valorseleccionado);

   /*$(".divtiempoc_"+cellpaquete).each(function( index) {

        var id=$(this).attr('id');
        var dividir=id.split('_')[4];
          console.log(dividir+ 'tiempo'+valor);

        if (dividir==valor) {
            $(this).addClass('active');
          }

        });*/

   setTimeout(() => {
 $(".divtiempoc_"+cellpaquete).each(function(){
              var id=$(this).attr('id');
              
               var dividir=id.split('_')[4];
 console.log(valor+'-'+dividir);
              if (valor==dividir) {

                $(this).addClass('active');
               return 0;
              }

          });

 }, "1000");


setTimeout(() => {

  ObtenerListadoEspecialista2(cellpaquete);

 }, "1000");
  //Agregaradetalle(concatenar);
  

 // $("#btstep5").attr('onclick','VerificarCortesia()')

}


function ConfirmarStep3(idpaquete,i,j) {
  
  $("#info_"+idpaquete+"_"+i+"_"+j).css('display','none');
      cellpaquete=idpaquete+'_'+i+'_'+j;
  $("#btneditar"+idpaquete+`_`+i+`_`+j).css('display','block');

  console.log(arraypaqueteseleccionadocreado2);
  //alert('confirm'+cellpaquete);
  for (var i = 0; i < arraypaqueteseleccionadocreado2.length; i++) {
    console.log(arraypaqueteseleccionadocreado2[i].key +'=='+ cellpaquete);

    if (arraypaqueteseleccionadocreado2[i].key == cellpaquete) {

      

 // Obtener la referencia a la tabla
var contenedor = document.querySelector('.date-carousel_' + cellpaquete + '_wrapper');
// Obtener la tabla dentro del div contenedor
var tabla = contenedor.querySelector('.rescalendar_controls');
// Obtener todas las celdas de datos en la tabla
var input = tabla.querySelector('.refDate');
// Cambiar el valor del input
arraypaqueteseleccionadocreado2[i].fecha=convertirFormatoFecha(input.value);

  var index=0;
 $(".btncategointervalo1_"+cellpaquete).each(function() {

             var valordata=$(this).attr('data-hora');
           
             if ($(this).hasClass('active')) {
                var id=$(this).attr('id');
                var valordata2=$(this).attr('data-horafinal');

                arraypaqueteseleccionadocreado2[i].horainicial=valordata;

                arraypaqueteseleccionadocreado2[i].horafinal=valordata2;
               }
             index++;
                        
            });

console.log(arraypaqueteseleccionadocreado2[i].fecha);

console.log(arraypaqueteseleccionadocreado2[i].horainicial);


 $(".especialistalista_"+cellpaquete).each(function( index) {

        var id=$(this).attr('id');
        var dividir=id.split('_')[1];
        
      if ($(this).hasClass('active')) {           var elementoPadre = document.getElementById(id);

           var elementoDeseado = elementoPadre.querySelector('div > div').innerText;
          
         arraypaqueteseleccionadocreado2[i].idespecialista=dividir;
         arraypaqueteseleccionadocreado2[i].usuarioespecialista= elementoDeseado;  

        }



      });

 $(".divtiempoc_"+cellpaquete).each(function( index) {

      if ($(this).hasClass('active')) {    var id=$(this).attr('id');
            var dividir=id.split('_')[4];
            arraypaqueteseleccionadocreado2[i].intervaloservicio= dividir;  
      }
 });



 var datos="idnotapago="+idnotapago+"&objeto="+JSON.stringify(arraypaqueteseleccionadocreado2[i]);
  $.ajax({
    type: 'POST',
    url:'catalogos/temporalcarrito/ActualizarElemento.php', //Url a donde la enviaremos
    async:false,
    data:datos,
    dataType:'json',
    success: function(resp){



      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });


    

console.log( arraypaqueteseleccionadocreado2[i].idespecialista);


      $("#parrafofecha_"+cellpaquete).css('display','block');
      $("#parrafohora_"+cellpaquete).css('display','block');
      $("#parrafobarbero_"+cellpaquete).css('display','block');

      /*fecha=arraypaqueteseleccionadocreado2[i].fecha;
      hora=arraypaqueteseleccionadocreado2[i].hora.split('_')[0];
      barbero=arraypaqueteseleccionadocreado2[i].barbero;*/

      // Ejemplo de uso:

      fechaformato(fecha, function(fechaFormateada) {
          $("#fecha_"+cellpaquete).text(fechaFormateada);
          // Puedes hacer algo con la fecha formateada aquí
      });

      
      
      break;
    }
  }

  ObtenerTemporalCarrito(idnotapago);

  setTimeout(() => {

    console.log('validando...');
  console.log(arraypaqueteseleccionadocreado2);
Validacionpaquetes2();
}, "1000");

  
  
}


function Validacionpaquetes2() {
  
   faltadato=0;
  
  for (var i = 0; i < arraypaqueteseleccionadocreado2.length; i++) {
       bandera=1;

       if (arraypaqueteseleccionadocreado2[i].servicio==1) {
      if (arraypaqueteseleccionadocreado2[i].horainicial=='') {

        faltadato++;
        bandera=0;
      }

      

       if (arraypaqueteseleccionadocreado2[i].idespecialista=='') {
        faltadato++;
         bandera=0;
      }

       if (arraypaqueteseleccionadocreado2[i].fechacita=='') {
         faltadato++;
         bandera=0;
      }


      $("#diverror_"+arraypaqueteseleccionadocreado2[i].key).css('display','none');
      $("#divsucces_"+arraypaqueteseleccionadocreado2[i].key).css('display','none');
     
      if (bandera==0) {

        $("#diverror_"+arraypaqueteseleccionadocreado2[i].key).css('display','block');

      }else{
        
        $("#divsucces_"+arraypaqueteseleccionadocreado2[i].key).css('display','block');
        
      }

    }

  }

}

//function AgregarNuevo() {
  
//

function AgregarNuevo() {
   

    
  var datos="idsucursal=1";
  $.ajax({
    type: 'POST',
    url:'catalogos/pagos/CategoriasPrincipales.php', //Url a donde la enviaremos
    async:false,
    data:datos,
    dataType:'json',
    success: function(resp){

    var div=`<div id="" class="row categoriasprincipales"></div>`;
      $("#contenedor-modal-forms3").html(div);

      $("#step2").css('display','block');
      //var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0)">GUARDAR</button>`;
      $("#footer-modal-forms3").css('display','none');
      $("#titulo-modal-forms3").text('Categorias');
      $("#titulo-modal-forms3").addClass('titulomodalcita');
      $("#modal-footer").css('display','none');
      $("#modal-forms3").modal();
     
       var respuesta=resp.respuesta;
          PintarCategoriasnota(respuesta);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}


function PintarCategoriasnota(respuesta) {
  var html="";
  if (respuesta.length>0) {
    for (var i = 0; i < respuesta.length; i++) {
        //funcion="SeleccionarServicio("+respuesta[i].idcategoriapaquete+")";
        funcion="AbrirModalAgendar2("+respuesta[i].idcategoriapaquete+")";
      /*if (respuesta[i].detiposervicio==1) {

        funcion="SeleccionarServicio("+elementosFiltrados[i].idpaquete+","+elementosFiltrados[i].precioventa+")";

      }*/


         var foto = respuesta[i].ruta;

            html=`
               <div class="tarjeta cambiarfuente col-md-3" id="tarjeta_${i}" onclick="`+funcion+`" style="margin: 1em;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;"></div>
                                <div class="card-body divcpaqueitem" id="divcpaqueitem_`+respuesta[i].idpaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${respuesta[i].nombre}
                                   
                                    </p>

                                </div>
                            </div>
                        </div>

            `;

            $(".categoriasprincipales").append(html);
    }
  }
}


function AbrirModalAgendar2(idcategoriapaquete) {
    $("#buscador").css('display','none');

   $('#modal-forms3').on('shown.bs.modal', function () { 
 
        $("#picker4").fullCalendar('render');
      $("#step2").css('display','none');
      //ConsultarFechasCalendarioA();
      });

    $('#modal-forms3').on('hidden.bs.modal', function (e) {
      // Acciones a realizar una vez que se cierra el modal
          ObtenerTemporalCarrito(idnotapago);

    });

      
          
  var pagina = "agendarcitamenu2.php";
  
  var datos="idsucursal="+idsucursalseleccionada+"&idcategoriapaquete="+idcategoriapaquete+"&fechaselecte="+fechaselecte+"&horainicialselect="+horainicialselect+"&idespecialistaselect="+idespecialistaselect+"&idnotapago="+idnotapago;
  $.ajax({
    type: 'POST',
    url:'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(resp){

      $("#contenedor-modal-forms3").html(resp);

      $("#step2").css('display','block');
      //var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0)">GUARDAR</button>`;
      $("#footer-modal-forms3").css('display','none');
      $("#titulo-modal-forms3").text('Servicios');
      $("#titulo-modal-forms3").addClass('titulomodalcita');
      $("#modal-footer").css('display','none');
      $("#modal-forms3").modal();
    
  

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}


function Cargardatos2(fechaselecte2,horaselecte,idespecialista,llave,intervalotiempo,i) {
  console.log('cargando datos..'+llave);

 // Obtener la referencia a la tabla
var contenedor = document.querySelector('.date-carousel_' + llave + '_wrapper');
// Obtener la tabla dentro del div contenedor
var tabla = contenedor.querySelector('.rescalendar_controls');
// Obtener todas las celdas de datos en la tabla
var input = tabla.querySelector('.refDate');
// Cambiar el valor del input
input.value = convertirFormatoFechadiamesanio(fechaselecte2);
cellDate=convertirFormatoFechadiamesanio(fechaselecte2);

input.dispatchEvent(new Event('blur'));


const promiseA = new Promise((resolutionFunc, rejectionFunc) => {

  resolutionFunc(ObtenerHorariosStep3(cellDate,llave));
});
// En este punto, "promiseA" ya está resuelto.
promiseA.then((val) => {
  console.log($(".horariossele_"+llave));
  var dividir=horaselecte.split('_');
  setTimeout(() => {
 
      var i=0;
      $(".horariossele_"+llave).each(function( index) {
      

      if ($(this).data('hora')==dividir[0]) {

         var id=$(this).attr('id');
         var valordata2=$(this).attr('data-horafinal');
         

        SeleccionarHorario1(dividir[0],valordata2,0,llave);

        $(this).addClass('active');

        return 0;
      }
      i++;

  });

}, "1000");

  });

promiseA.then((val) => {
  setTimeout(() => {

      $(".especialistalista_"+llave).each(function( index) {

        var id=$(this).attr('id');
        var dividir=id.split('_')[1];
        
        if (dividir==idespecialista) {
            var elementoPadre = document.getElementById(id);

        // Obtener el elemento dos hijos abajo
           var elementoDeseado = elementoPadre.querySelector('div > div').innerText;
           SeleccionarEspecialista(idespecialista,elementoDeseado,llave);

            $(this).addClass('active');

        }



      })
    
        


    }, "1000");
});
promiseA.then((val) => {
  setTimeout(() => {

    var dividir=llave.split('_');
   // alert('a'+i);
  //ConfirmarStep2(dividir[0],dividir[1],dividir[2]);
  //ObtenerTiempo(llave,intervalotiempo);

   // SeleccionarTiempo1(intervalotiempo,'min',llave,i);
var elemento="tiempobtn_"+llave+"_"+intervalotiempo+"_"+i;
 //alert('active1');
     $(".divtiempoc_"+llave).each(function(){
              var id=$(this).attr('id');
              
               var dividir=id.split('_')[4];
 console.log(intervalotiempo+'-'+dividir);
              if (intervalotiempo==dividir) {

                $(this).addClass('active');
               return 0;
              }

          });

 }, "1200");

  });









}


function convertirFormatoFechadiamesanio(fechaOriginal) {
    // Dividir la fecha en día, mes y año
    var partesFecha = fechaOriginal.split('/');
    var dia = partesFecha[0];
    var mes = partesFecha[1];
    var año = partesFecha[2];

    // Crear un objeto Date con el nuevo formato
    var fechaFormateada = new Date(`${año}-${mes}-${dia}`);

    // Obtener la fecha en formato "día/mes/año"
    var diaFormateado = fechaFormateada.getDate();
    var mesFormateado = fechaFormateada.getMonth() + 1; // Se suma 1 porque los meses en JavaScript van de 0 a 11
    var añoFormateado = fechaFormateada.getFullYear();

    // Agregar ceros a la izquierda si es necesario
    diaFormateado = diaFormateado < 10 ? '0' + diaFormateado : diaFormateado;
    mesFormateado = mesFormateado < 10 ? '0' + mesFormateado : mesFormateado;

    // Obtener la fecha en formato "día/mes/año"
    var fechaString = `${diaFormateado}/${mesFormateado}/${añoFormateado}`;

    return fechaString;
}

function convertirFormatoFecha(fechaOriginal) {
    // Dividir la fecha en día, mes y año
    var partesFecha = fechaOriginal.split('/');
    var dia = partesFecha[0];
    var mes = partesFecha[1];
    var año = partesFecha[2];

    // Crear un objeto Date con el nuevo formato
    var fechaFormateada = new Date(`${año}-${mes}-${dia}`);

    // Obtener la fecha en formato "yyyy-mm-dd"
    var fechaString = fechaFormateada.toISOString().split('T')[0];

    return fechaString;
}

function CambiarProducto(llave) {
  
    
  var datos="idsucursal=1"+"&llave="+llave;
  $.ajax({
    type: 'POST',
    url:'catalogos/pagos/CategoriasPrincipales.php', //Url a donde la enviaremos
    async:false,
    data:datos,
    dataType:'json',
    success: function(resp){

    var div=`<div id="" class="row categoriasprincipales"></div>`;
      $("#contenedor-modal-forms4").html(div);

      $("#step2").css('display','block');
      //var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0)">GUARDAR</button>`;
      $("#footer-modal-forms4").css('display','none');
      $("#titulo-modal-forms4").text('Categorias');
      $("#titulo-modal-forms4").addClass('titulomodalcita');
      $("#modal-footer").css('display','none');
      $("#modal-forms4").modal();
    
       var respuesta=resp.respuesta;
          PintarCategorias2(respuesta,llave);



      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function PintarCategorias2(respuesta,llaveelemento) {
  var html="";
  if (respuesta.length>0) {
    for (var i = 0; i < respuesta.length; i++) {
        //funcion="SeleccionarServicio("+respuesta[i].idcategoriapaquete+")";
        funcion="AbrirModalAgendar3("+respuesta[i].idcategoriapaquete+",'"+llaveelemento+"')";
      /*if (respuesta[i].detiposervicio==1) {

        funcion="SeleccionarServicio("+elementosFiltrados[i].idpaquete+","+elementosFiltrados[i].precioventa+")";

      }*/


         var foto = respuesta[i].ruta;

            html=`
               <div class="tarjeta cambiarfuente col-md-3" id="tarjeta_${i}" onclick="`+funcion+`" style="margin: 1em;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;"></div>
                                <div class="card-body divcpaqueitem" id="divcpaqueitem_`+respuesta[i].idpaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${respuesta[i].nombre}
                                   
                                    </p>

                                </div>
                            </div>
                        </div>

            `;

            $(".categoriasprincipales").append(html);
    }
  }
}


function AbrirModalAgendar3(idcategoriapaquete,llaveelemento) {
    $("#buscador").css('display','none');

   $('#modal-forms4').on('shown.bs.modal', function () { 
 
        $("#picker4").fullCalendar('render');
      $("#step2").css('display','none');
     // ConsultarFechasCalendarioA();
      });

    $('#modal-forms4').on('hidden.bs.modal', function (e) {
      // Acciones a realizar una vez que se cierra el modal
     ObtenerTemporalCarrito(idnotapago);
    });

      
          
  var pagina = "agendarcitamenu3.php";

  var datos="idsucursal="+idsucursalseleccionada+"&idcategoriapaquete="+idcategoriapaquete+"&fechaselecte="+fechaselecte+"&horainicialselect="+horainicialselect+"&idespecialistaselect="+idespecialistaselect+"&llave="+llaveelemento+"&idnotapago="+idnotapago;
  $.ajax({
    type: 'POST',
    url:'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(resp){

      $("#contenedor-modal-forms4").html(resp);

      $("#step2").css('display','block');
      //var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0)">GUARDAR</button>`;
      $("#footer-modal-forms4").css('display','none');
      $("#titulo-modal-forms4").text('Servicios');
      $("#titulo-modal-forms4").addClass('titulomodalcita');
      $("#modal-footer").css('display','none');
      $("#modal-forms4").modal();
    
  

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}


function ObtenerTemporalCarrito(idnotapago) {

  var datos="idnotapago="+idnotapago;
  $.ajax({
    type: 'POST',
    url:'catalogos/temporalcarrito/ObtenerTemporalCarrito.php', //Url a donde la enviaremos
    async:false,
    dataType:'json',
    data:datos,
    success: function(resp){

      var pagos=resp.pagos;

      arraypaqueteseleccionado2=pagos;
   


      PintarProductosSeleccionadosStep3();
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}
/*function CambiarProducto(llave) {

  var datos="idsucursal=1"+"&llave="+llave;
  $.ajax({
    type: 'POST',
    url:'catalogos/pagos/CategoriasPrincipales.php', //Url a donde la enviaremos
    async:false,
    data:datos,
    dataType:'json',
    success: function(resp){

    var div=`<div id="" class="row categoriasprincipales"></div>`;
      $("#contenedor-modal-forms3").html(div);

      $("#step2").css('display','block');
      //var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0)">GUARDAR</button>`;
      $("#footer-modal-forms3").css('display','none');
      $("#titulo-modal-forms3").text('Categorias');
      $("#titulo-modal-forms3").addClass('titulomodalcita');
      $("#modal-footer").css('display','none');
      $("#modal-forms3").modal();
    
       var respuesta=resp.respuesta;
          PintarCategorias(respuesta);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
  
}*/

  function GuardarNotaCita(idnotapago) {
    var datos="idnotapago="+idnotapago;
    $.ajax({
    type: 'POST',
    url:'catalogos/temporalcarrito/GuardarNotaCarritoTemporal.php', //Url a donde la enviaremos
    async:false,
    dataType:'json',
    data:datos,
    success: function(resp){

      if (resp.respuesta==1) {
          aparecermodulos("catalogos/dashboard/vi_dashboard.php?idmenumodulo="+idmenumodulo+"&ac=1&msj=Se actualizó nota de pago","main");


      }
    
    
      
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
  }

			</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> 

