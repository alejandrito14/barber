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

$funcionboton="AbrirModalMetodo(".$idnotapago.",".$accion.")";
$funcionbotonmodal="RealizarpagoCompletado(".$idnotapago.",".$accion.")";

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

//$funcionboton2="RealizarpagoCompletado(".$idnotapago.",".$accion.")";


$funcionboton="RealizarpagoCompletado(".$idnotapago.",".$accion.")";
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


<div class="modal fade" id="modalprecio2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-alerta" style="text-align: center;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenedor-modal-alerta" style="overflow: auto; text-align: center;">
                  <div style="display: flex;justify-content: center;">
                    <div class="form-group">
                      <label>NUEVO PRECIO UNITARIO:</label>
                        <input type="number" name="txtprecio" id="txtprecio" class="form-control">
                    </div>
                  </div>



                </div>

                 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-primary" id="btnmodificar" >MODIFICAR</button>
    </div>

            </div>
        </div>
    </div>

 <div class="modal fade" id="modalverificacion2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-alerta" style="text-align: center;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenedor-modal-alerta" style="overflow: auto; text-align: center;">
                  <div style="display: flex;justify-content: center;">
                    <div class="form-group">
                      <label>USUARIO:</label>
                        <input type="text" name="txtusuario" id="txtusuario" class="form-control">
                    </div>
                  </div>

                  <div style="display: flex;justify-content: center;">
                    <div class="form-group">
                      <label>CONTRASEÑA:</label>
                        <input type="password" name="txtcontra" id="txtcontra" class="form-control">
                    </div>
                  </div>


                  <div style="display: flex;justify-content: center;">
                    <div class="form-group">
                      <div id="respuesta" style="color: red;"></div>
                      
                    </div>
                  </div>



                </div>

                 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" id="btnguardarprecio" >GUARDAR</button>
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




<div class="modal fade" id="modal-formsmetodo" tabindex="-1" role="dialog" style="overflow-y: scroll;" >
    <div class="modal-dialog modal-lg" id="largomodalmetodo">
        <div class="modal-content" id="">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-modal-forms">Agregar método de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="contenedor-modal-formsmetodo">
             

             <div class="row">
                  <div class="col-md-6">
                    <button type="button" class="btn btn-primary" style="margin-bottom: 10px;" onclick="agregarMetodoDePago()" id="botonAgregarMetodoPago">Agregar método de pago</button>

                    <div class="contenedormetodo"></div>

                  </div>
                  <div class="col-md-6">
                    
                    <div class="row totales">
                     
                    </div>
                  </div>

             </div>


            </div>

           <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

           <button type="button" class="btn  btn-success " id="btnpagarresumenmodal" style="background: rgb(0, 122, 255);border-color: rgb(0, 122, 255); display: block;" onclick="<?php echo $funcionbotonmodal; ?>">Pagar</button>

     
       
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
				 var idtipopago=0;
				var idnotapago="<?php echo $idnotapago; ?>";
			 var total=0;
      	//Detallepago(idnotapago);


        if (accion==3 || accion==4) {
          Detallepago(idnotapago);
          $(".litipodepago").css('display','none');
          $("#titulometodopago").css('display','none');
          $("#btnpagarresumen").attr('disabled',false);
          $("#divtotalnota").css('display','none');

        }else{

          $("#divtotalnota").css('display','block');
          ObtenerNotasPendientes(idnotapago);
          $("#titulometodopago").css('display','none');

           $("#btnpagarresumen").css('display','none');


        }



        function ObtenerNotasPendientes(idnotapago) {
           
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

             idtipopago=notaelegida[0].idtipopago;

            ObtenerTipodepagosCompletar(idtipopago);

          }
        });



        }

        function PintarNotasPendientes(respuesta,fechasnotas) {
          //.
          var html="";
          if (fechasnotas.length>0) {

            html+=` <ul class="list-group">`;

           for (var k = 0; k <fechasnotas.length; k++) {
            html+=`<li style="    list-style: none;background: lightsteelblue;">
             <div class="row" style="    padding: 10px;    margin-left:10px;
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
                     
                      <div class="row">
                      <div class="col-md-12">
                     <p class="text-muted " style="font-size:20px;margin:0px;">$`+formato_numero(detalle[j].monto,2,'.',',')+`</p>

                     </div>

                     <div class="col-md-12">
                     
                      <button type="button" onclick="ModificarPrecioNota(`+detalle[j].idnotapago_descripcion+`)" class="btn btn_colorgray" style="" title="MODIFICAR PRECIO">
                        <i class="mdi mdi-table-edit"></i>
                      </button>
                     </div>



                     </div>



                       
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


        function SeleccionarPago(idnotapago) {
         
         SumarPagos();

        }

        function SumarPagos() {
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

              if (suma>0) {
                $("#btnpagarresumen").css('display','block');
                $("#btnpagarresumen").attr('disabled',false);
              }else{

                 $("#btnpagarresumen").css('display','none');
              }
        }

  function VerdatellaNota(idnotapago) {
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
      /*var descuentos=resp.descuentos;
      if (descuentos.length>0) {
      Pintardescuentosdetalle(descuentos);  
      }

      var descuentosmembresia=resp.descuentosmembresia;
      if (descuentosmembresia.length>0) {
        Pintardescuentomembresiadetalle(descuentosmembresia);
      }

      var imagenescomprobante=resp.imagenescomprobante;

      if (imagenescomprobante.length > 0) {
        PintarImagenesComprobante(imagenescomprobante);
      }*/

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
    }

  });

        }


        function PintarDetalleHtml2() {
  /**/

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

function ModificarPrecioNota(idnotadescripcion) {


    $("#modalprecio2").modal();
  $("#txtprecio").val('');
  $("#btnmodificar").attr('onclick','ModificarPrecioModalNota('+idnotadescripcion+')')
 /* var datos="idnotadescripcion="+idnotadescripcion;
  var pagina="ModificarPrecioNota.php";
   $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'catalogos/pagos/'+pagina, //Url a donde la enviaremos
            data:datos,
            success: function(response) {
                // Manejar la respuesta del backend
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                // Manejar el error
            }
        });*/
}

function ModificarPrecioModalNota(idnotadescripcion) {
  
  var valor=$("#txtprecio").val();
  var datos="idnotadescripcion="+idnotadescripcion+"&precio="+valor;


  AbrirModalValidacion2(idnotadescripcion,valor);
  phoneFormatter2('txtusuario');
}

function AbrirModalValidacion2(idnotadescripcion,valor) {
  $("#modalprecio2").modal('hide');
  $("#modalverificacion2").modal();
  $("#respuesta").text('');
  $("#btnguardarprecio").attr('onclick','GuardarModificarNota('+idnotadescripcion+','+valor+')');
}
function GuardarModificarNota(idnotadescripcion,valor) {
  

  var txtcontra=$("#txtcontra").val();
  var txtusuario=$("#txtusuario").val();
  var datos="idnotadescripcion="+idnotadescripcion+"&precio="+valor+"&usuario="+txtusuario+"&contra="+txtcontra;

   elementoscheck=[];
   $(".inputpagos").each(function( index ) {

                if($(this).is(':checked'))
                {
                  var id=$(this).attr('id');
                  var idelemento=id.split('_')[1];
                  elementoscheck.push(idelemento);
                }

             });

   console.log(elementoscheck);

  $.ajax({
   url:'catalogos/pagos/GuardarModificarNota.php', //Url a donde la enviaremos
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
          $("#txtcontra").val('');
          $("#txtusuario").val('');
          if (msj.respuesta==1) {
            $("#modalverificacion2").modal('hide');
           

            let myPromise = new Promise(function(myResolve, myReject) {

                myResolve(ObtenerNotasPendientes(idnotapago));

            });

            // "Consuming Code" (Must wait for a fulfilled Promise)
            myPromise.then(
              function(value) { 
                if (elementoscheck.length>0) {


                  setTimeout(() => {
                 
                    for (var i =0; i < elementoscheck.length; i++) {
                       
                      $("#checkbox_"+elementoscheck[i]).prop('checked',true);
                      SeleccionarPago(elementoscheck[i]);
                   
                    }

            }, "1000");

                  
                   AbrirNotificacion('Se guardó los cambios correctamente','mdi mdi-checkbox-marked-circle');


                  }

               },
              function(error) { /* code if some error */ }
            );


          

          }else{


            $("#respuesta").text('Usuario o contraseña incorrecta');
          }
          
      }
  });
}

var tipopagos=[];

function AbrirModalMetodo(idnotapago,accion) {
  
  $("#modal-formsmetodo").modal();
    $(".contenedormetodo").html('');
tipopagos=[];
 ActualizarTotales();
  
}
function agregarMetodoDePago() {
   var contar = $(".metodopagodiv").length;
    contar++;

    $("#mensaje").text('');

    var objeto={
      elemento:contar,
      idtipopago:0,
      tipopago:"",
      montovisual:"",
      confoto:0,
      idbanco:0,
      digitostarjeta:"",
      tipotarjeta:"",
      datostarjeta:"",
      montocampo:0,

    };
    var falta=0;
    var suma=0;
     for (var i = 0; i < tipopagos.length; i++) {
    
      var contar=tipopagos[i].elemento;

      var elemento = "litipodepago_" + contar;
      var idtipopago=tipopagos[i].idtipopago;
      var montocampo=tipopagos[i].montocampo;
  $("#mensaje_"+elemento).text('');
      if (idtipopago==0 || idtipopago=='') {
        falta++;

        $("#mensaje_"+elemento).text('Es necesario seleccionar al menos un  método de pago');
      }

      var montocampo=tipopagos[i].montocampo;

      if (montocampo!=0) {
      suma=parseFloat(suma)+parseFloat(montocampo);
      }

      
      
    }

    if (suma==total) {
      falta=1;

      $("#mensaje").text("No se puede agregar otro método de pago, debido a que el total a pagar ya esta cubierto con un método de pago");
    }

    if (falta==0) {
    tipopagos.push(objeto);

    
    PintarMetodosPago();
    var suma=0;
    var contador=0;
    for (var i = 0; i < tipopagos.length; i++) {
    
      var contar=tipopagos[i].elemento;

      var elemento = "litipodepago_" + contar;
      var montocampo=tipopagos[i].montocampo;

      if (montocampo!=0) {
      suma=parseFloat(suma)+parseFloat(montocampo);
      }
      
    }
    var posicion=tipopagos.length-1;

   var monto= parseFloat(total)-parseFloat(suma);

    if (tipopagos[posicion].montocampo=='' && tipopagos[posicion].montocampo==0) {

      tipopagos[posicion].montocampo=monto;

      $("#montometodo_"+tipopagos[posicion].elemento).val(monto);
    }


  }else{




  }
   
}


function PintarMetodosPago(argument) {
  $(".contenedormetodo").html('');
  for (var i = 0; i < tipopagos.length; i++) {
    
      var contar=tipopagos[i].elemento;

      var elemento = "litipodepago_" + contar;
      var montocampo=tipopagos[i].montocampo;
      var idtipopagolistado=tipopagos[i].idtipopago;
      var tipopago=tipopagos[i].tipopago;
      var montovisual=tipopagos[i].montovisual;
      
      var confoto=tipopagos[i].confoto;
      var idbanco=tipopagos[i].idbanco;
      var digitostarjeta=tipopagos[i].digitostarjeta;
      var tipotarjeta=tipopagos[i].tipotarjeta;
      var datostarjeta=tipopagos[i].datostarjeta;

    var html = `

     <div class="card metodopagodiv metodopagodiv_`+elemento+`">
    <div class="card-header" id="headingOne">
     <h5>
     <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne`+contar+`" aria-expanded="true" aria-controls="collapseOne">
          Método de pago #`+(i+1)+`
        </button>

        <button type="button" onclick="BorrarMetodo('`+elemento+`')" class="btn btn_rojo" style="" title="BORRAR">
                <i class="mdi mdi-delete-empty"></i>
            </button>
        </h5>
     </div>
    <div id="collapseOne`+contar+`" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
     <div class="card-body">
     <div class="col-md-6" style="margin-top:10px;margin-bottom:10px;" id="titulometodopago_${contar}">
            <p>MONTO</p>
            <div class="row">
              <div class="col-md-2" style="justify-content: center;
    display: flex;
    align-items: center;
    ">$</div>
              <div class="col-md-10">
               <input type="number" class="form-control numberclass" id="montometodo_${contar}" value="`+montocampo+`" placeholder="$0.00"  style="float:left;" onkeyup="CopiarValor(this)">
              
              </div>
               <div id="mensajelblmontometodo_${elemento}" style="color:red;    margin-left: 40px;"></div>

            </div>
           
        </div>
        <div class="col-md-12" style="margin-top:30px;" id="titulometodopago_${contar}">
            <p>SELECCIONAR MÉTODO DE PAGO</p>
            <div class="divtipopago btn-group-toggle ${elemento}">
            </div>
        </div>
    `;

    html += `
        <div class="row" style="margin-top: 1em;margin-left:4px;">
            <div class="col-md-12 divbancos_${elemento}" style="display: none;">
                <p>SELECCIONAR BANCO</p>
                <div class="divbancos_${elemento} btn-group-toggle libancos_${elemento}"></div>

                <div id="mensajelblbancos_${elemento}" style="color:red;"></div>
            </div>
            <div class="col-md-4 divdigitos_${elemento}" style="display: none;margin-top:30px;">
                <label for="">DÍGITOS DE LA TARJETA</label>
                <input type="text" class="form-control" id="txtdigitostarjeta_${elemento}" value="`+digitostarjeta+`">

                 <div id="mensajelbldigitostarjeta_${elemento}" style="color:red;"></div>

            </div>
            <div class="col-md-12 divopcionestarjeta_${elemento}" style="display: none;">
                <label for="">OPCIONES DE TARJETA</label>
                <div class="btn-group-toggle ">
                    <label class="btn btn_colorgray2 btntipo_${elemento}" id="catetipo_1_${elemento}">
                        <input type="checkbox" id="catetipo_1_${elemento}" class="catechecktipo${elemento}" onchange="SeleccionarOpciontarjeta2(1,'${elemento}')" value="0"> 
                        DÉBITO
                    </label>
                    <label class="btn btn_colorgray2 btntipo_${elemento}" id="catetipo_2_${elemento}">
                        <input type="checkbox" id="catetipo_2_${elemento}" class="catechecktipo1" onchange="SeleccionarOpciontarjeta2(2,'${elemento}')" value="0"> 
                        CRÉDITO
                    </label>

              <div id="mensajelblopcionestarjeta_${elemento}" style="color:red;"></div>

                </div>
            </div>
        </div>


          <div class="">
      
     <div class="divtransferencia_`+elemento+`" style="display: none;">
      <div  >
        <div class="list media-list" style="list-style: none;">
           <div class="informacioncuenta_`+elemento+`" style="padding-right: 30px;"></div>
        </div>
        

       </div>
     </div>
       <div id="campomonto_`+elemento+`" style="display: none;margin-left: 9px;">
    <div class="subdivisiones" style="margin-top: 1.5em;width: 12em!important;" >
      <span style="margin-top: .5em;margin-left: .5em;">¿Con cuanto pagas?</span>
    </div>

    <div class="row" style="">
     <div  style="" class="col-md-4">
      

          <div style="">
            
            <div class="label-radio item-content">
              
              <div class="item-inner">
             
                <div class="">

                  <input type="text" name="montovisual_`+elemento+`" class="form-control" id="montovisual_`+elemento+`" style="float: left;padding-right: 30px;" value="`+montovisual+`" placeholder="$0.00"  />
                  <input type="number" name="montocliente`+elemento+`" id="montocliente`+elemento+`"  style="font-size: 18px;float: left;width: 60%;    margin-left: 1.2em;display: none;" placeholder="$0.00" value="`+montovisual+`"  />

               <div id="mensajelblmonto_${elemento}"></div>      
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
           
          </div>
  
</div>
</div> 



    <div class=" row">
              <div style="background-color:#dfdfdf;border-radius:10px;padding-top: .5px;padding-bottom: .5px;display: none;" id="aparecerimagen_`+elemento+`">
              <div class="">
                  <div class="row no-gap" style="text-align: center;"> 
                   <img src="" id="imagencomprobante" width="60" />
                  </div>
                </div>

                 <div class="block "> 
                     <div class="list media-list sortable" id="" style="">           

                    <ul id="lista-imagenescomprobante_`+elemento+`" class="list-group" style="margin-bottom: 1em;">
                        
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
    <div class="row" style="margin-top: 5px;">
    <span style="color:red;margin-left:20px;" id="mensaje_`+elemento+`"></span>
    </div>
 <div class="row" style="margin-top: 5px;">
          <div class="col-md-4" style="margin-left:10px;">
         <button type="button" class="btn  btn-success btn-lg btn-block" id="btnguardar_`+elemento+`" onclick="GuardarMetodo('`+elemento+`')">GUARDAR</button>   

       </div>
    </div>


  </div>
</div>


 </div>
    </div>
  </div>



    `;
 $(".contenedormetodo").append(html);
    // Llamar a la función para cargar las opciones de tipo de pago
    ObtenerTipodepagosCompletar2(idtipopago, elemento);

    if (montocampo=='') {

      $('#collapseOne'+contar).collapse();
    }

    if (idtipopagolistado>0) {

      SeleccionarTipodePago4(idtipopagolistado,elemento);

      if (idbanco>0) {

          SeleccionarBanco2(idbanco,elemento);

      }

      if (tipotarjeta!='') {
         SeleccionarOpciontarjeta2(tipotarjeta,elemento);
     
       }
    

    }


   
  }
}

function CopiarValor(objeto) {
  console.log(objeto);
  var valor=objeto.value;
  var id=objeto.id.split('_')[1];

  $("#montovisual_litipodepago_"+id).val(valor);


}

/*function PintarTotales() {
  var html="";




  $(".totales").html(html);
}*/

function ObtenerTipodepagosCompletar2(idtipodepago,elemento) {


  $.ajax({
          url:'catalogos/pagos/ObtenerTipodepagosCompletar.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
          error:function(XMLHttpRequest, textStatus, errorThrown){
              var error;
              console.log(XMLHttpRequest);
              if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
              if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
              $('#abc').html('<div class="alert_error">'+error+'</div>'); 
              //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
            },
          success:function(msj){

              if (msj.respuesta.length>0) {
                PintarTipoPagos3(msj.respuesta,idtipodepago,elemento);
              }
                
              }
          });
}

function PintarTipoPagos3(respuesta,idtipodepago,elemento) {
  var html="";


  if (respuesta.length>0) {
      for (var i = 0; i <respuesta.length; i++) {

        if (respuesta[i].idtipodepago!=idtipodepago) {
      html+=`
      <label class="btn btn_colorgray2 btntipodepago_`+elemento+`" id="catebtntipodepago_`+respuesta[i].idtipodepago+`_`+elemento+`">
      <input type="checkbox" id="cate_13" class="catechecktipo" onchange="SeleccionarTipodePago4(`+respuesta[i].idtipodepago+`,'`+elemento+`')" value="0"> 
        `+respuesta[i].tipo+`</label>
      `;
      }

    }
  }
  $("."+elemento).html(html);
}



function SeleccionarTipodePago4(idtipodepago,elemento) {
  CargarOpcionesTipopago4(idtipodepago,elemento);
}
 
function CargarOpcionesTipopago4(idtipopago,elemento){
  //var idtipopago=$("#tipopago").val();
  $(".btntipodepago_"+elemento).removeClass('active');
  var datos="idtipopago="+idtipopago;
  $("#catebtntipodepago_"+idtipopago+`_`+elemento).addClass('active');
  var pagina="Cargartipopago.php";
    $(".divtransferencia_"+elemento+"").css('display','none');
    $("#divagregartarjeta_"+elemento+"").css('display','none');
    $("#divlistadotarjetas_"+elemento+"").css('display','none');
     $("#mensaje_"+elemento).text('');
   // $("#btnpagarresumen").prop('disabled',true);
   // $("#btnatras").attr('onclick','Atras()');
   // $("#btnatras").css('display','none');
    $("#cambio_"+elemento+"").text('0.00');
    $("#campomonto_"+elemento+"").css('display','none');
    /*comisionporcentaje=0;
    comisionmonto=0;
    comisionpornota=0;
    cambiomonto=0;

  impuesto=0;
  clavepublica="";
  claveprivada="";
    confoto=0;*/
  //$("#btnpagarresumen").attr('disabled',true);
  if (idtipopago>0) {
  
      $.ajax({
      type: 'POST',
      dataType: 'json',
    url:'catalogos/pagos/Cargartipopago.php', //Url a donde la enviaremos
      data:datos,
      async:false,
      success: function(respuesta){
      var resultado=respuesta.respuesta;
        idtipodepagootro=idtipopago;

      comisionpornota=resultado.comisionpornota;
      tipocomisionpornota=resultado.tipocomisionpornota;
      habilitarpagar=resultado.habilitarpagar;
      $("#txtdigitostarjeta").val('');
      HabilitarOpcionespago4(resultado.idtipodepago,resultado.habilitarfoto,resultado.constripe,resultado.habilitarcampomonto,resultado.habilitarcampomontofactura,resultado.habilitarcatalogobanco,resultado.habilitarcampodigitos,resultado.habilitaropciontarjeta,elemento);
    if (resultado.habilitarfoto==1) {
      confoto=1;
        $(".divtransferencia_"+elemento+"").css('display','block');
        var html="";
       var datosdecuenta=resultado.cuenta.split('|');

              var html1="";
              for (var j = 0; j <datosdecuenta.length; j++) {
                    html1+='<p style="text-align:center;">'+datosdecuenta[j]+'</p>';
              }


              html+=` <li class="cuentas" id="cuenta_`+resultado.idtipodepago+`" style="" >
              <div class="">
                <div class="">
                 
                  <div class="" style="   text-align: justify;-webkit-line-clamp: 200;" >

                    <div style="    padding-left: 1em;padding-right: 1em;padding-top: .2em;padding-bottom: .2em;background: #dfdfdf;border-radius: 10px;font-size:16px;">
                  `+
                  html1
                  +`
                    </div>
                  </div>
                </div>
              </div>
            </li>`;

            html+=`
              <div id="habilitarfoto" style="display: block;">
      <div class="subdivisiones" style="margin-top: 1.5em" ><span style="margin-top: .5em;margin-left: .5em;">Comprobante</span></div>

           <div class=""  >
                  <div style="justify-content: center;">
                      <button type="button"  onclick="AbrirModalFotoComprobante()" class="btn btn-success botonesaccion botonesredondeado estiloboton" style="margin-top: 1em;background:#4cd964;margin-bottom:1em;width:100%;"> SUBIR comprobante</button>
                             <div class="check-list" style="    display: none;
                                          margin-right: 10em;
                                           top: -.2em;    width: 100%;margin-bottom: 1em;
                                          position: absolute;
                                             right: -6em;"><span></span></div>
                  </ul>

                      <div class="block m-0"> 
                       <div class="list media-list sortable" id="" style="">           

                      <div id="lista-imagenescomprobante" style="margin-bottom: 1em;">
                          
                      </div>
                  </div> 

                  </div>   
                  
                </div>

              </div>

            `;
            $(".informacioncuenta_"+elemento+"").html(html);
        }


        if (resultado.habilitarcampo==1) {

          campomonto=resultado.habilitarcampo;
         


        }

        if (resultado.constripe==1) {

          
         if (resultado.comisionporcentaje=='') {
            resultado.comisionporcentaje=0;
          }
          if (resultado.comisionmonto=='') {
            resultado.comisionmonto=0;
          }
          if (resultado.impuesto=='') {
            resultado.impuesto=0;
          }
        
          comisionporcentaje=resultado.comisionporcentaje;
          if (comisionporcentaje!=0) {
             $(".divcomision").css('display','block');

          }
          comisionmonto=resultado.comisionmonto;
          impuesto=resultado.impuesto;
          clavepublica=resultado.clavepublica;
          claveprivada=resultado.claveprivada;
          ObtenerTarjetasStripe(false,idtipopago);

          $(".btnnuevatarjeta").attr('onclick','NuevaTarjetaStripe()');
          $(".divnueva").css('display','block');
            HabilitarBotonPagar();
            CalcularTotales();
        }

        if (habilitarpagar==1) {
          $("#btnpagarresumen").attr('disabled',false);
          
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
}



function HabilitarOpcionespago4(idtipodepago,foto,stripe,habilitarcampo,habilitarcampomontofactura,habilitarcatalogobanco,habilitardigitos,habilitaropciontarjeta,elemento) {


     anterior=localStorage.getItem('idtipodepago');

  if (anterior==idtipodepago) {

   $("#tipodepago_"+idtipodepago).prop('checked',false);
    localStorage.setItem('idtipodepago',0);


  }else{

    $(".opcionestipodepago").prop('checked',false);
    $("#tipodepago_"+idtipodepago).prop('checked',true);
    idtipodepago=idtipodepago;

  }

/*  idtipodepago=localStorage.getItem('idtipodepago');
*/    if (idtipodepago>0) {

      $(".divdigitos_"+elemento+"").css('display','none');
      $(".divbancos_"+elemento+"").css('display','none');
      $(".divopcionestarjeta_"+elemento+"").css('display','none');
      $("#txtdigitostarjeta_"+elemento).val('');

      $("#habilitarfoto_"+elemento+"").css('display','none');
      $(".cuentas_"+elemento+"").css('display','none');

      $("#lista-imagenescomprobante_"+elemento+"").html('');

      $(".btntipo_"+elemento).removeClass('active');
      $(".btnbancos_"+elemento).removeClass('active');

      llevafoto=foto;
      idtipodepago=idtipodepago;
      rutacomprobante="";
      comentarioimagenes="";
      $(".check-list").css('display','none');

      campomonto=habilitarcampo;
      constripe=stripe;
      comisionmonto=0;
      comisionporcentaje=0;
      impuesto=0;
      comision=0;
      comisiontotal=0;

      $("#lista-imagenescomprobante_"+elemento+"").html('');
      resultimagencomprobante=[];


    if (foto==1) {
      $("#datosdecuenta_"+elemento+"").css('display','block');

      $("#cuenta_"+idtipodepago+"_"+elemento).css('display','block');

     // $("#datosdecuenta").html(cuenta);
      $("#habilitarfoto"+elemento+"").css('display','block');

      }else{

      $(".cuentas"+elemento+"").css('display','none');

      $("#cuenta_"+idtipodepago+"_"+elemento).css('display','none');

      $("#habilitarfoto"+elemento+"").css('display','none');
     // $("#datosdecuenta").css('display','none');

    }

    if (stripe==1) {

       montocliente=0;
        $("#montocliente"+elemento+"").val('');
      //  ObtenerPorcentajes();
        
    }

    if (habilitarcampo==1) {
      var sumatotalapagar1=total;
    
      $("#montocliente_"+elemento+"").val(parseFloat(sumatotalapagar1));
     // $("#montovisual_"+elemento+"").val(formato_numero(sumatotalapagar1,2,'.',','));
      
    
      $("#campomonto_"+elemento+"").css('display','block');


        var dividir=elemento.split('_')[1];
        var valor=$("#montometodo_"+dividir).val();

        $("#montovisual_"+elemento+"").val(valor);

       datostarjeta2="";
       datostarjeta="";
      // $("#montovisual_"+elemento+"").attr('onkeyup','ValidacionMonto()');

    }else{
        $("#campomonto_"+elemento+"").css('display','none');
    
    }


    if (habilitarcatalogobanco==1) {
      ObtenerBancos2(elemento);
        $(".divbancos_"+elemento+"").css('display','block');

        $(".btntipo_"+elemento).removeClass('active');

    }
    
    if (habilitardigitos==1) {

      $(".divdigitos_"+elemento+"").css('display','block');
    }
    if (habilitaropciontarjeta==1) {
      $(".divopcionestarjeta_"+elemento+"").css('display','block');
    }

    $(".opcionestipodepago_"+elemento+"").attr('checked',false);
    $("#tipodepago_"+idtipodepago).prop('checked',true);
  
  }else{

     $("#datosdecuenta_"+elemento+"").css('display','none');
     $("#campomonto_"+elemento+"").css('display','none');
     $("#habilitarfoto_"+elemento+"").css('display','none');

      $("#lista-imagenescomprobante_"+elemento+"").html('');
       llevafoto=foto
       idtipodepago=idtipodepago;
       rutacomprobante='';
       comentarioimagenes="";
       $(".check-list_"+elemento+"").css('display','none');
       $(".cuentas_"+elemento+"").css('display','none');
       comisionmonto=0;
       comisionporcentaje=0;
       impuesto=0;
       datostarjeta2='';
       datostarjeta='';

       imagencomprobante="";
     resultimagencomprobante=[];
     arraycomentarios=[];

  }

  //Recalcular4();

}



function ObtenerBancos2(elemento) {
  
    var pagina = "catalogos/pagos/Obtenerbancos.php";
      $.ajax({
      type: 'POST',
      dataType: 'json',
      url: pagina,
      async:false,
      success: function(res){
       
          PintarBancos2(res.respuesta,elemento);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });

}

function PintarBancos2(respuesta,elemento) {
  var html="";
  if (respuesta.length>0) {
    for (var i = 0; i <respuesta.length; i++) {
      html+=`<label class="btn btn_colorgray2 btnbancos_`+elemento+`" id="catebtnbanco_`+respuesta[i].idbancos+`_`+elemento+`">
      <input type="checkbox" id="cate_13" class="catechecktipo" onchange="SeleccionarBanco2(`+respuesta[i].idbancos+`,'`+elemento+`')" value="0"> 
        `+respuesta[i].nombrecorto+`</label>`;
    }
  }

  $(".libancos_"+elemento).html(html);
}

function SeleccionarBanco2(idbanco,elemento) {
  idbancoseleccionado=idbanco;

  $(".btnbancos_"+elemento+"").removeClass('active');
  
  $("#catebtnbanco_"+idbanco+"_"+elemento).addClass('active');
 
}

function SeleccionarOpciontarjeta2(idopciontarjeta,elemento) {

  $(".btntipo_"+elemento+"").removeClass('active');
  $("#catetipo_"+idopciontarjeta+"_"+elemento).addClass('active');

}

function BorrarMetodo(elemento) {

  $(".metodopagodiv_"+elemento).remove();
  var idelemento=elemento.split('_')[1];

  for (var i =0; i < tipopagos.length; i++) {
      
      if (tipopagos[i].elemento==idelemento) {
        tipopagos.splice(i,1);
      }
  }

  PintarMetodosPago();
  ActualizarTotales();
}


function GuardarMetodo(elemento) {
    
    var idelemento=elemento.split('_')[1];

    var montoelemento=$("#montometodo_"+idelemento).val();
    var montovisual=$("#montovisual_litipodepago_"+idelemento).val();



    var idtipopagoseleccionado=0;
    var idbancoseleccionado=0;
    var tipotarjetaseleccionada="";
    var textotipago="";
    var digitostarjeta=$("#txtdigitostarjeta_litipodepago_"+idelemento).val();

    $(".btntipodepago_litipodepago_"+idelemento).each(function() {

      if ($(this).hasClass('active')) {
        idelementoli=$(this).attr('id').split('_')[1];
        textotipago=$(this).text();
        idtipopagoseleccionado=idelementoli;

        return 0;
      }
    });
 if (idtipopagoseleccionado>0) {
  var datos="idtipopago="+idtipopagoseleccionado;
    var p1 = new Promise(function(resolve, reject) {

      $.ajax({
      type: 'POST',
      dataType: 'json',
       url:'catalogos/pagos/Cargartipopago.php', //Url a donde la enviaremos
      data:datos,
      async:false,
      success: function(respuesta){
      var resultado=respuesta.respuesta;

      resolve(resultado);

    }

  });

       });

    p1.then(function(resultado) {

      console.log(resultado);
      var jsontipopago=resultado;
      var bandera=1;

        $("#mensaje_"+elemento).html('');


   
      $(".btnbancos_litipodepago_"+idelemento).each(function() {

              if ($(this).hasClass('active')) {
                  idelementoli=$(this).attr('id').split('_')[1];
                  idbancoseleccionado=idelementoli;
                  return 0;
              }
        });

      $(".btntipo_litipodepago_"+idelemento).each(function() {
              if($(this).hasClass('active')) {
                 idelementoli=$(this).attr('id').split('_')[1];

                 tipotarjetaseleccionada=idelementoli;
              }

            });
          $("#mensajelblmonto_"+elemento).html('');
          $("#mensajelblmontometodo_"+elemento).html('');

          $("#mensajelblbancos_"+elemento).html('');
          $("#mensajelbldigitostarjeta_"+elemento).html('')
          $("#mensajelblopcionestarjeta_"+elemento).html('');
      var msj="";
       /*if (jsontipopago.habilitarcampomonto) {

          if (montovisual==0) {
            bandera=0;

            msj=`<p>Monto requerido</p>`;

            $("#mensajelblmonto_"+elemento).html(msj);
          }

      }*/
        if (montoelemento=='' || montoelemento==0) {
          bandera=0;

          $("#mensajelblmontometodo_"+elemento).html('Monto requerido');
        }

        if (jsontipopago.habilitarcatalogobanco==1) {
          if (idbancoseleccionado==0) {

            bandera=0;
            msj=`<p>Banco requerido</p>`;
            $("#mensajelblbancos_"+elemento).html(msj);
          }

        }

         if (jsontipopago.habilitarcampodigitos==1) {

            if (digitostarjeta=='') {
              bandera=0;
              msj=`<p>Dígitos de la tarjeta requerido</p>`;

              $("#mensajelbldigitostarjeta_"+elemento).html(msj);


            }

        }

         if (jsontipopago.habilitaropciontarjeta==1) {
            if (tipotarjetaseleccionada=='') {

              bandera=0;

              msj=`<p>Opciones de tarjeta requerido</p>`;
              $("#mensajelblopcionestarjeta_"+elemento).html(msj);
            }

        }


        if (bandera==1) {

      for (var i = 0; i < tipopagos.length; i++) {
       
          if (tipopagos[i].elemento==idelemento) {


            tipopagos[i].montocampo=montoelemento;
            tipopagos[i].idtipopago=idtipopagoseleccionado;
            tipopagos[i].idbanco=idbancoseleccionado;
            tipopagos[i].digitostarjeta=digitostarjeta;
            tipopagos[i].tipotarjeta=tipotarjetaseleccionada;
            tipopagos[i].montovisual=montovisual;
            tipopagos[i].tipopago=textotipago;
          
          }
      }

       
        $('#collapseOne'+idelemento).collapse('hide');
        $("#mensaje_"+elemento).text('');
        ActualizarTotales();

      }else{


       // $("#mensaje_"+elemento).html(msj);
      }
     

    });

   }else{

      $("#mensaje_"+elemento).text('Es necesario seleccionar al menos un  método de pago');

    }

}

function ActualizarTotales() {
  
  var totalestipo=0;
  var html="";
  $(".totales").html('');

   html+=`<div class="col-md-12">
    <div class="row">
   <div class="col-md-6">
   <p style="text-align: right;font-size:22px;">Total:</p></div>
     <div class="col-md-4">
    <p style="font-size:22px;font-weight:bold;">$`+formato_numero(
total,2,'.',',')+`</p>

      </div>
        <div class="col-md-2">
          <span class="mdi mdi-check-circle" id="divsucces_" style="display: none;     font-size: 25px;
    color: rgb(90, 183, 93); ">
                  </span>


          <span class="mdi mdi-close-circle" id="diverror_" style="display: none;  font-size: 25px; color: red;">
                    </span>
        </div>
    </div>


  </div>`;
  var suma=0;
  for (var i = 0; i < tipopagos.length; i++) {
     totalestipo=parseFloat(totalestipo)+parseFloat(tipopagos[i].montocampo);
     if (tipopagos[i].tipopago!='') {
       html+=`<div class="col-md-12">
    <div class="row">
      <div class="col-md-6">
       <p style="text-align: right;font-size:18px;">`+tipopagos[i].tipopago+`:
       </div>
      <div class="col-md-4">
        <p style="font-size:18px;">
         $`+formato_numero(tipopagos[i].montocampo,2,'.',',')+`</p>
      </div>

       <div class="col-md-2">

        </div>
      </div>
      `;
        if (tipopagos[i].montocampo>0) {
        suma=parseFloat(suma)+parseFloat(tipopagos[i].montocampo);
     }
   }

  }

  var diferencia=parseFloat(total)-parseFloat(suma);

  if (diferencia<0) {
      diferencia=0;
    }
  html+=`<div class="col-md-12">
    <div class="row">
   <div class="col-md-6">
   <p style="text-align: right;font-size:22px;">Diferencia:</p></div>
     <div class="col-md-4">
    <p style="font-size:22px;font-weight:bold;">$`+formato_numero(diferencia,2,'.',',')+`</p>

      </div>
        <div class="col-md-2">
         
        </div>
    </div>


  </div>`;

  /*if (suma==total) {

    $("#divsucces_").css('display','block');
     $("#diverror_").css('display','none');

    $("#btnpagarresumenmodal").attr('disabled',false);
    
  }else{
     $("#diverror_").css('display','block');
    $("#divsucces_").css('display','none');

  $("#btnpagarresumenmodal").attr('disabled',true);

  }*/

  html+=`
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
      <span id="mensaje" style="color:red;display:flex;justify-content:center;"></span>
      </div>

      </div>

   </div>


  `;


  $(".totales").append(html);


}



			</script>