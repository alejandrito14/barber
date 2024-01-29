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
require_once("../../clases/class.Comision.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");

$idmenumodulo = $_GET['idmenumodulo'];

//Se crean los objetos de clase
$db = new MySQL();
$emp = new Comision();
$f = new Funciones();
$bt = new Botones_permisos();

$emp->db = $db;

$emp->tipo_usuario = $tipousaurio;
$emp->lista_empresas = $lista_empresas;

//Validamos si cargar el formulario para nuevo registro o para modificacion
if(!isset($_GET['idComisiones'])){
	//El formulario es de nuevo registro
	$idComision = 0;

	//Se declaran todas las variables vacias
	$nombre = "";
	$depende = "0";
	$empresa="";
	$estatus =1;
	//$descripcion="";
		$ruta="images/sinfoto.png";

	$col = "col-md-12";
	$ver = "display:none;";
	$titulo='NUEVA COMISIÓN';
/*	$obtenerorden=$emp->ObtenerUltimoOrdenComisiones();
	$roworden=$db->fetch_assoc($obtenerorden);
	$num=$db->num_rows($obtenerorden);
	if ($num>0) {
		$orden=$roworden['ordenar']+1;
	}else{
		$orden=0;
	}*/


}else{
	//El formulario funcionara para modificacion de un registro

	//Enviamos el id de la empresa a modificar a nuestra clase empresas
	$idComision = $_GET['idComisiones'];
	$emp->idcomisionespecialista = $idComision;

	//Realizamos la consulta en tabla empresas
	$result_Comisiones = $emp->buscarComision();
	$result_Comisiones_row = $db->fetch_assoc($result_Comisiones);
	$tipo=$result_Comisiones_row['tipo'];
	$monto=$result_Comisiones_row['monto'];
	$estatus=$result_Comisiones_row['estatus'];
	$idespecialista=$result_Comisiones_row['idespecialista'];

 
	//Cargamos en las variables los datos de las empresas



	$col = "col-md-12";
	$ver = "";
	$titulo='EDITAR COMISIÓN';

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

<form id="f_comision" name="f_comision" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title m-b-0" style="float: left;"><?php echo $titulo; ?></h4>

			<div style="float: right;position:fixed!important;z-index:10;right:0;margin-right:2em;width: 20%;">
				
				<?php
			
					//SCRIPT PARA CONSTRUIR UN BOTON
					$bt->titulo = "GUARDAR";
					$bt->icon = "mdi mdi-content-save";
					$bt->funcion = "var resp=MM_validateForm('v_especialista','','R'); if(resp==1){ GuardarComisiones('f_comision','catalogos/comisiones/vi_comisiones.php','main','$idmenumodulo');}";
					$bt->estilos = "float: right;";
					$bt->permiso = $permisos;
					$bt->class='btn btn-success';
				
					//validamos que permiso aplicar si el de alta o el de modificacion
				if($idComision == 0)
					{
						$bt->tipo = 1;
					}else{
						$bt->tipo = 2;
					}
			
					$bt->armar_boton();
				?>
				
				<!--<button type="button" onClick="var resp=MM_validateForm('v_empresa','','R','v_direccion','','R','v_tel','','R','v_email','',' isEmail R'); if(resp==1){ GuardarEmpresa('f_empresa','catalogos/empresas/fa_empresas.php','main');}" class="btn btn-success" style="float: right;"><i class="mdi mdi-content-save"></i>  GUARDAR</button>-->
				
				<button type="button" onClick="aparecermodulos('catalogos/Comisiones/vi_Comisiones.php?idmenumodulo=<?php echo $idmenumodulo;?>','main');" class="btn btn-primary" style="float: right; margin-right: 10px;"><i class="mdi mdi-arrow-left-box"></i>VER LISTADO </button>
				<div style="clear: both;"></div>
				
				<input type="hidden" id="id" name="id" value="<?php echo $idComision; ?>" />
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




							
							<div class="col-md-6" >

							<div class="form-group m-t-20">
								<label>*BARBEROS:</label>
								<select id="v_especialista" class="form-control"></select>
							</div>

						
								<div class="form-group">

										<label>*TIPO DE COMISIÓN:</label>
										<div class="form-group mb-2" style="">
			<select id="v_tipocomision" class="form-control">
												<option disabled selected="" >SELECCIONAR TIPO DE COMISIÓN</option>
												<option value="0" <?php if($tipo == 0) { echo "selected"; } ?>>PORCENTAJE</option>

													<option value="1"  <?php if($tipo == 1) { echo "selected"; } ?>>MONTO</option>
											</select>
										</div>
									</div>

										<div class="form-group">

										<label>*CANTIDAD DE LA COMISÓN:</label>
										<div class="form-group mb-2" style="">
											<input type="number" class="form-control" name="" id="v_cantidadcomision" value="<?php echo $monto; ?>" style="">
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

					<div class="col-md-12">

							<div id="" class=" row categoriasprincipales"></div>

					</div>

					<div class="col-md-12">
						
						 <div id="categorias" class="categorias row" data-espacio="1" style="">
        <!-- Aquí se cargarán dinámicamente las categorías -->
  			  </div>
 						<div id="subcategorias" class="subcategorias" data-espacio="2">
        <!-- Aquí se cargarán dinámicamente las subcategorías -->
    	
    	 </div>


    	  <div id="servicios" class="servicios">
        <!-- Aquí se cargarán los servicios -->
   			 </div>


					</div>
									


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

var idcomision='<?php echo $idComision; ?>';
var idespecialista='<?php echo $idespecialista; ?>'



						ObtenerEspecialistasC(idespecialista);

						var idespecialista=0;
 					var idcategoriapaquete=0;
 					var detalle=[];
								ObtenerCategoriasPrincipalescomi();
 								var categorias = [
            //{ id: 1, nombre: "Cabello", subcategorias: [1, 2] },
           // { id: 2, nombre: "Uñas", servicios: [5, 6, 7] },
            // ... otras categorías ...
        ];

        var subcategorias = [
           // { id: 1, nombre: "Corte de pelo", subcategorias: [3, 4] },
            //{ id: 2, nombre: "Tinte", servicios: [8, 9] },
            // ... otras subcategorías ...
        ];

     

  
      var serviciospaquete = [];
      var todascategorias=[];

      function AbrirMasCategorias(idcategoriaf) {
      	idcategoriapaquete=idcategoriaf;
        const myPromise = new Promise((resolve, reject) => {
            resolve(ObtenerServicios2());
          
        });

        myPromise.then((successMessage) => {
       
        ObtenerTodasCategoriasC();

        });


         myPromise.then((successMessage) => {

            VerificarSiCategoriaTieneSub2().then((successMessage) => {
             
                if (successMessage.respuesta>0) {

                   $(".categorias").css('display','none');
                   $(".servi").css('display','none');

                  ObtenerCategorias2();

                    $(".categorias").css('display','');
               

                }else{
                  $(".categorias").css('display','none');
                 
                  viewPaquetes2(idcategoriapaquete);

                  $(".servi").css('display','none');
                  $("#servi_"+idcategoriapaquete).css('display','');
                }


            });
         
         });

        }


    function ObtenerTodasCategoriasC() {
     
     $.ajax({
          url:'catalogos/citas/ObtenerTodasCategorias.php', //Url a donde la enviaremos
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
              var respuesta=msj.categoriaspaquete;
              todascategorias=respuesta;
              console.log(todascategorias);
              }
          });
    }

	  
	   function ObtenerServicios2() {

         $.ajax({
          url:'catalogos/citas/ObtenerServicios.php', //Url a donde la enviaremos
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
              var respuesta=msj.paquetes;
                serviciospaquete=respuesta;
              }
          });
    }

    function VerificarSiCategoriaTieneSub2() {
    		
    	return new Promise((resolve, reject) => {

  var datos="idcategoriapaquete="+idcategoriapaquete;

  $.ajax({
          url:'catalogos/citas/VerificarSiCategoriaTieneSub.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
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

  });

    }


    function ObtenerCategorias2(argument) {
    var datos="idcategoriapaquete="+idcategoriapaquete;
      $.ajax({
          url:'catalogos/citas/ObtenerCategorias.php', //Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          dataType:'json',
          async:false,
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
              var respuesta=msj.categoriaspaquete;

                PintarCategoriasT(respuesta);


               $("#sub_"+idcategoriapaquete).css('display','');
              }
          });
    }

    function PintarCategoriasT(respuesta) {
    	
    	 var html="";
      if (respuesta.length>0) {

          for (var j = 0;j<respuesta.length ;j++) {
           
            var idcategoriapaquet=respuesta[j].idcategoriapaquete;
            var nombrecategoria=respuesta[j].nombre;
             funcion="AparecerSub("+idcategoriapaquet+",'"+nombrecategoria+"');AparecerServicios("+idcategoriapaquet+",'"+nombrecategoria+"');";
             $(".subcategorias").append(`<div  id="sub_`+idcategoriapaquet+`" class="row sub" style="display:none"></div>`);

            $(".servicios").append(`<div  id="servi_`+idcategoriapaquet+`" class="row servi" style="display:none;"></div>`);
            var foto = respuesta[j].ruta;

             html += `
                     <div class="tarjeta cambiarfuente faustina col-md-3" id="tarjeta_${idcategoriapaquet}" onclick="`+funcion+`" style="margin: 1em;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;">
                        </div>
                          <div class="card-body divcategoriaitem" id="divcategoriaitem_`+respuesta[j].idcategoriapaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                         


                          <input type="checkbox" class="checkboxca" id="checkboxca_`+respuesta[j].idcategoriapaquete+`" onchange="SeleccionarCategoriaC2(`+respuesta[j].idcategoriapaquete+`)" name="checkbox_`+respuesta[j].idcategoriapaquete+`">

                          <label for="checkbox_0" style="margin-left: 5px;">${respuesta[j].nombre}</label>


                                </div>
                            </div>
                        </div>`;

                      
                        if(respuesta[j].subcategorias.length>0){
                         viewsubcat(respuesta[j].subcategorias,respuesta[j].idcategoriapaquete);


                      }else{


                       viewPaquetes2(respuesta[j].idcategoriapaquete);

                  }

           }

           $(".categorias").html(html);
        }
    }



    function viewsubcat(subcategorias,idcategoriapaque) {
     
     
        for (var i = 0; i <subcategorias.length; i++) {
          var idcategoriapaquete=subcategorias[i].idcategoriapaquete;

          var foto = subcategorias[i].ruta;
          if ($("#sub_"+idcategoriapaquete).length == 0 ) {

             $(".subcategorias").append(`<div id="sub_`+idcategoriapaquete+`" class="sub" style="display:none"></div>`);
          }

          if ($("#servi_"+idcategoriapaquete).length == 0 ) {

            $(".servicios").append(`<div id="servi_`+idcategoriapaquete+`" class="row servi" style="display:none;"></div>`);
          }
         

           

          funcion="AparecerSub2("+idcategoriapaquete+");AparecerServicios("+idcategoriapaquete+");";
          html=`
              <div class="tarjeta cambiarfuente faustina col-md-3" id="tarjeta_${idcategoriapaquete}" onclick="`+funcion+`" style="width: 30%;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;"></div>
                                <div class="card-body divcategoriaitem" id="divcategoriaitem_`+subcategorias[i].idcategoriapaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${subcategorias[i].nombre}</p>
                                </div>
                            </div>
                        </div>

          `;


                 if(subcategorias[i].subcategorias!=''){
                         viewsubcat(subcategorias[i].subcategorias,subcategorias[i].idcategoriapaquete);
                      }else{


                       viewPaquetes2(subcategorias[i].idcategoriapaquete);
                     
                  }


           $("#sub_"+idcategoriapaque).append(html);
         
        }

    }


    function viewPaquetes2(idcategoriapaquete) {
      var html="";

      const elementosFiltrados = serviciospaquete.filter((elemento) => elemento.idcategoriapaquete == idcategoriapaquete);
      console.log(elementosFiltrados);
        if (elementosFiltrados.length>0) {

          for (var i = 0; i <elementosFiltrados.length; i++) {
          var tiempo = elementosFiltrados[i].intervaloservicio;

          if (elementosFiltrados[i].servicio==1) {
           funcion="SeleccionarServicio("+elementosFiltrados[i].idpaquete+","+elementosFiltrados[i].precioventa+",'"+elementosFiltrados[i].nombrepaquete+"','"+tiempo+"')";
         }else{

          funcion="SeleccionarProductoA("+elementosFiltrados[i].idpaquete+","+elementosFiltrados[i].precioventa+",'"+elementosFiltrados[i].nombrepaquete+"')";

         }


          if ($("#servi_"+idcategoriapaquete).length ==0) {

            $(".servicios").append(`<div id="servi_`+idcategoriapaquete+`" class="row servi" style="display:none;"></div>`);
          }

         var foto = elementosFiltrados[i].ruta;
         
            html=`
               <div class="tarjeta cambiarfuente faustina col-md-3" id="tarjeta_${i}" onclick="`+funcion+`" style="width: 30%;margin: 1em;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;">`

                        ;
                        
                     

                  html+=` </div>
                          <div class="card-body divcpaqueitem" id="divcpaqueitem_`+elementosFiltrados[i].idpaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">

                           <input type="checkbox" 
                           class="checkboxpaquete" id="checkboxpaquete_`+elementosFiltrados[i].idpaquete+`" name="checkbox_`+elementosFiltrados[i].idpaquete+`" 
                          >

                            <label for="checkbox_0" style="margin-left: 5px;">${elementosFiltrados[i].nombrepaquete}$${elementosFiltrados[i].precioventa}</label>
                                
                                   

                                </div>
                            </div>
                        </div>

            `;
         
            $("#servi_"+idcategoriapaquete).append(html);

           

          }
        }

     
    }

    		
    function ElegirPaquete(idpaquete) {
    		   // Desmarca todos los checkboxes del grupo
 
    // Marca solo el checkbox específico
   /* $("#checkboxpaquete_" +idpaquete).prop("checked", true);*/

    }


 function AparecerSub2(idcategoriapaquete) {

      selectCategoryAndAncestors(todascategorias,idcategoriapaquete)

       todascategorias.forEach(item => {
        if (item.idcategoriapaquete ==idcategoriapaquete) {
            if (item.iddepende === '0') {
                categoryFound = item;
            
            } else {

              $("#sub_"+item.iddepende).css('display','');

                //categoryFound = findParentCategory(data, item.iddepende);
            }
        }
    });
    }
   
   function AparecerSub(idcategoriapaquete,nombresub) {

      //Agregaradetalle(nombresub);
       var nom=detalle[0];
       if (nom!=undefined) {
               detalle[0]=nom+nombresub;

              }else{
      detalle[0]=nombresub;         
              }


      $(".sub").css('display','none');
      $("#sub_"+idcategoriapaquete).css('display','');
      //$(".divcategoriaitem").removeClass('activo');

     // $("#divcategoriaitem_"+idcategoriapaquete).addClass('activo');
      //  selectCategoryAndAncestors(todascategorias,idcategoriapaquete);


     
    } 
  function AparecerServicios(idcategoriapaquete,nombreca){

   
   //Agregaradetalle(nombreca);

    $("#divheaderservicio").css('display','block');
   $(".servi").css('display','none');
   $("#servi_"+idcategoriapaquete).css('display','');


  }



						function ObtenerEspecialistasC(idespecialista) {


				
							$.ajax({
								url: 'catalogos/comisiones/ObtenerEspecialistasC.php', //Url a donde la enviaremos
								type: 'POST', //Metodo que usaremos
								dataType:'json',
								async:false,
								error: function (XMLHttpRequest, textStatus, errorThrown) {
									var error;
									console.log(XMLHttpRequest);
									if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
									if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
									$("#contenedor_insumos").html(error);
								},
								success: function (msj) {
									
									var respuesta=msj.respuesta;
									PintarEspecialistasC(respuesta);

									if (idespecialista>0) {

										$("#v_especialista").val(idespecialista);
									}
									
								}
							});
				
							
				}

				function PintarEspecialistasC(respuesta) {
					var html="";
					if (respuesta.length>0) {
						for (var i = 0; i <respuesta.length; i++) {
							html+=`
								<option value="`+respuesta[i].idespecialista+`">`+respuesta[i].nombre+` `+respuesta[i].paterno+`</option>	`;

						}
					}


					$("#v_especialista").html(html);
				}


        if (idcomision>0) {


          setTimeout(function(){
            
             ObtenerPaqueteComision(idcomision);

            }, 1000);


        }


       /* function ObtenerCategoriasComision() {
          
          $.ajax({
                url: 'catalogos/comisiones/ObtenerCategoriasComision.php', //Url a donde la enviaremos
                type: 'POST', //Metodo que usaremos
                dataType:'json',
                async:false,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  var error;
                  console.log(XMLHttpRequest);
                  if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
                  if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
                  $("#contenedor_insumos").html(error);
                },
                success: function (msj) {
                  
                  
                  
                }
              });

        }

        function ObtenerSubcategoriasComision() {

           $.ajax({
                url: 'catalogos/comisiones/ObtenerSubcategoriasComision.php', //Url a donde la enviaremos
                type: 'POST', //Metodo que usaremos
                dataType:'json',
                async:false,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  var error;
                  console.log(XMLHttpRequest);
                  if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
                  if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
                  $("#contenedor_insumos").html(error);
                },
                success: function (msj) {
                  
                  
                  
                }
              });
          
        }
*/

        function ObtenerPaqueteComision(idcomisionespecialista) {
          var datos="idcomisionespecialista="+idcomisionespecialista;

          $.ajax({
                url: 'catalogos/comisiones/ObtenerPaqueteComision.php', //Url a donde la enviaremos
                type: 'POST', //Metodo que usaremos
                dataType:'json',
                async:false,
                data:datos,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  var error;
                  console.log(XMLHttpRequest);
                  if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
                  if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
                  $("#contenedor_insumos").html(error);
                },
                success: function (msj) {
                  
                  var paquetes=msj.respuesta;
                  var comisioncat=msj.comisioncat;
                  var comisionsub=msj.comisionsub;

                  if (comisioncat.length>0) {
                    for (var i = 0; i <comisioncat.length; i++) {

                      $("#checkboxca_"+comisioncat[i].idcategoria).prop('checked',true);

                      AbrirMasCategorias(comisioncat[i].idcategoria);

                    }
                  }

               setTimeout(function(){

                  if (comisionsub.length>0) {

                    for (var i = 0; i <comisionsub.length; i++) {
                      $("#checkboxca_"+comisionsub[i].idcategoria).prop('checked',true);
                      SeleccionarCategoriaC2(comisionsub[i].idcategoria);

                      AparecerSub(comisionsub[i].idcategoria,'');AparecerServicios(comisionsub[i].idcategoria,'');
                    }
                  }

                 }, 1000);


                  
               setTimeout(function(){


                  if (paquetes.length>0) {

                    for (var i = 0; i <paquetes.length; i++) {
                     
                     $("#checkboxpaquete_"+paquetes[i].idpaquete).prop('checked',true);


                    }
                  }

                 }, 1000);



                  
                  
                }
              });
        }


</script>

<?php

?>