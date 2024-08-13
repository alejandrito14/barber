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

$idmenumodulo = $_GET['idmenumodulo'];

//validaciones para todo el sistema

$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion

//validaciones para todo el sistema


/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importación de clase conexión
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Tarjetalealtad.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.PagConfig.php");

//Declaración de objeto de clase conexión
$db = new MySQL();
$Tarjetaregalo = new Tarjetalealtad();
$bt = new Botones_permisos(); 
$f = new Funciones();
$confi=new PagConfig();
$confi->db=$db;
$Tarjetaregalo->db = $db;

//obtenemos todas las empreas que puede visualizar el usuario.

$Tarjetaregalo->tipo_usuario = $tipousaurio;
$Tarjetaregalo->lista_empresas = $lista_empresas;
$Tarjetaregalo->idsucursal=$se->obtenerSesion('idsucursalsesion');

$l_Tarjetaregalo = $Tarjetaregalo->ObtenerTodosTarjetalealtad();
$l_Tarjetaregalo_row = $db->fetch_assoc($l_Tarjetaregalo);


$l_Tarjetaregalo_num = $db->num_rows($l_Tarjetaregalo);

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



$estatus=array('DESATIVADO','ACTIVADO');

?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title" style="float: left;">LISTADO DE TARJETAS DE LEALTAD</h5>
    
    <div style="float:right;">
      <button type="button" onClick="abrir_filtro('modal-filtros');" class="btn btn-primary" style="float: right;display: none;"><i class="mdi mdi-account-search"></i>  BUSCAR</button>      
      
      <?php
    
        //SCRIPT PARA CONSTRUIR UN BOTON
        $bt->titulo = "NUEVO";
        $bt->icon = "mdi-plus-circle";
        $bt->funcion = "aparecermodulos('catalogos/tarjetalealtad/fa_tarjetalealtad.php?idmenumodulo=$idmenumodulo','main');";
        $bt->estilos = "float: right; margin-right:10px;";
        $bt->permiso = $permisos;
        $bt->tipo = 5;
        $bt->title="NUEVO";
        

        $bt->armar_boton();
      
      ?>
      
      <div style="clear: both;"></div>
    </div>
    
    <div style="clear: both;"></div>
  </div>
</div>


<div class="card" style="display: none;">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <!-- 
         <div class="form-group">
                <label>MOSTRAR Tarjetaregalo EN LA APLICACIÓN

                  <input type="checkbox" name="v_activarTarjetaregalo" onchange="MostrarTarjetaregalo()" value="0" id="v_activarTarjetaregalo" style="margin-left: 1em; position: absolute;">
                </label>
              </div> -->
      </div>
            <div class="col-md-12">
               <!-- <div class="form-group">
                <label>OBLIGAR A VISUALIZAR TODO EL ANUNCIO
                  <input type="checkbox" name="v_activaromitirfinal" onchange="MostrarOmitir()" value="0" id="v_activaromitirfinal" style="margin-left: 1em; position: absolute;">
                </label>
              </div> -->
            </div>


            <div class="col-md-12">
              <!--  <div class="form-group">
                <label>ACTIVAR Tarjetaregalo PARA TODOS
                  <input type="checkbox" name="v_activaranunciocliente" onchange="ActivarTarjetaregalo()" value="0" id="v_activaranunciocliente" style="margin-left: 1em; position: absolute;">
                </label>
              </div> -->
            </div>

    </div>
     

              
    </div>
  </div>


<div class="card">
  <div class="card-body">
    <div class="table-responsive" id="contenedor_Tarjetaregalo">
      <table id="tbl_Tarjetaregalo" cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
        <thead>
          <tr>
             
            <th style="text-align: center;">TARJETA</th><th style="text-align: center;">DESCRIPCIÓN</th> 

           <th style="text-align: center;">PERIODO</th> 

            <th style="text-align: center;">ESTATUS</th>

            <th style="text-align: center;">ACCI&Oacute;N</th>
          </tr>
        </thead>
        <tbody>
          
          <?php
          if($l_Tarjetaregalo_num== 0){
            ?>
            <tr> 
              <td colspan="6" style="text-align: center">
                <h5 class="alert_warning">NO EXISTEN REGISTROS EN LA BASE DE DATOS.</h5>
              </td>
            </tr>
            <?php
          }else{
            do
            {
              ?>
              <tr>
              
            
              
              <td style="text-align: center;"><?php echo $f->imprimir_cadena_utf8($l_Tarjetaregalo_row['nombre']);?></td>
 <td style="text-align: center;"><?php echo $f->imprimir_cadena_utf8($l_Tarjetaregalo_row['descripcion']);?></td>
            <td style="text-align: center;"><?php echo date('d-m-Y',strtotime($l_Tarjetaregalo_row['fechainicial'])).' | '.date('d-m-Y',strtotime($l_Tarjetaregalo_row['fechafinal']));?></td>
            
              <td style="text-align: center;"><?php echo $estatus[$l_Tarjetaregalo_row['estatus']];?></td>

              <td style="text-align: center; font-size: 15px;">

                  

                  <?php
                          //SCRIPT PARA CONSTRUIR UN BOTON
                  $bt->titulo = "";
                  $bt->icon = "mdi-table-edit";
                  $bt->funcion = "aparecermodulos('catalogos/tarjetalealtad/fa_tarjetalealtad.php?idmenumodulo=$idmenumodulo&idtarjetalealtad=".$l_Tarjetaregalo_row['idtarjetalealtad']."','main')";
                  $bt->estilos = "";
                  $bt->permiso = $permisos;
                  $bt->tipo = 2;
                  $bt->title="EDITAR";
                  $bt->class='btn btn_colorgray';
                  $bt->armar_boton();


                  ?>
                  

                  <?php
                  //SCRIPT PARA CONSTRUIR UN BOTON
                  $bt->titulo = "";
                  $bt->icon = "mdi-delete-empty";
                  $bt->funcion = "BorrarDatosTarjetalealtad('".$l_Tarjetaregalo_row['idtarjetalealtad']."','idtarjetalealtad','tarjetalealtad','n','catalogos/tarjetalealtad/vi_tarjetaslealtad.php','main','$idmenumodulo')";
                  $bt->estilos = "";
                  $bt->permiso = $permisos;
                  $bt->tipo = 3;
                  $bt->title="BORRAR";

                  $bt->armar_boton();
                ?>
          
 
                <button type="button" onclick="AbrirModalTarjetaUsuario('<?php echo $l_Tarjetaregalo_row['idtarjetalealtad']; ?>')" class="btn btn_accion" style="" title="Asignación de tarjeta a usuarios">
                    <i class="mdi mdi-account-outline"></i>
                
                </button>


                  <button type="button" onclick="AbrirModalTarjeta('<?php echo $l_Tarjetaregalo_row['idtarjetalealtad']; ?>')" class="btn btn_accion" style="" title="Conteo de visitas">
                    <i class="mdi mdi-calendar"></i>
                
                </button>

                </td>


              </tr>
              <?php
            }while($l_Tarjetaregalo_row = $db->fetch_assoc($l_Tarjetaregalo));
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


 <div class="modal" id="modaltarjeta" tabindex="-1" role="dialog"> 
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Listado de Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="divtablatarjeta">
          <table id="tbltarjetausuario" cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
        <thead>
          <tr>
             
            <th style="text-align: center;">Usuario
            </th>
             <th style="text-align: center;">Conteo
            </th>

              <th style="text-align: center;">Estatus
            </th>
          </tr>
        </thead>
        <tbody id="datostablatarjeta">
          
        </tbody>
      </table>
         
       </div>
      
      </div>
      <div class="modal-footer">
      

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> 


     
       
      </div>
    </div>
  </div>
</div>




<div class="modal" id="modaltarjetavistas" tabindex="-1" role="dialog"> 
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Listado de Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="divtablatarjeta">
          <table id="tbltarjetausuario2" cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
        <thead>
          <tr>
             
            <th style="text-align: center;">Usuario
            </th>
             <th style="text-align: center;">Conteo de visitas
            </th>
            <th style="text-align: center;">Citas
            </th>
             
          </tr>
        </thead>
        <tbody id="datostablatarjetacitas">
          
        </tbody>
      </table>
         
       </div>
      
      </div>
      <div class="modal-footer">
      

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> 


     
       
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

 //cargarTabla();
   $('#tbl_Tarjetaregalo').DataTable( {   
      "pageLength": 100,
      "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ ",
            "sZeroRecords": "NO EXISTEN PROVEEDORES EN LA BASE DE DATOS.",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "desde 0 a 0 de 0 records",
            "sInfoFiltered": "(filtered desde _MAX_ total Registros)",
            "sSearch": "Buscar",
            "oPaginate": {
                   "sFirst":    "Inicio",
                   "sPrevious": "Anterior",
                   "sNext":     "Siguiente",
                   "sLast":     "Ultimo"
                   }
            },
       "sPaginationType": "full_numbers", 
      "paging":   true,
      "ordering": true,
      

    } );
</script>
