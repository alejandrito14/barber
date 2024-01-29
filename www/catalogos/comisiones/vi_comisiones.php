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
require_once("../../clases/class.Comision.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.PagConfig.php");

//Declaración de objeto de clase conexión
$db = new MySQL();
$Comisiones = new Comision();
$bt = new Botones_permisos(); 
$f = new Funciones();
$confi=new PagConfig();
$confi->db=$db;
$Comisiones->db = $db;

//obtenemos todas las empreas que puede visualizar el usuario.

$Comisiones->tipo_usuario = $tipousaurio;
$Comisiones->lista_empresas = $lista_empresas;
$tipo=array('PORCENTAJE','MONTO');
$l_Comisiones = $Comisiones->ObtenerComisiones();
$l_Comisiones_row = $db->fetch_assoc($l_Comisiones);


$l_Comisiones_num = $db->num_rows($l_Comisiones);

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



$estatus=array('DESACTIVADO','ACTIVADO');

?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title" style="float: left;">LISTADO DE COMISIONES</h5>
    
    <div style="float:right;">
      <button type="button" onClick="abrir_filtro('modal-filtros');" class="btn btn-primary" style="float: right;display: none;"><i class="mdi mdi-account-search"></i>  BUSCAR</button>      
      
      <?php
    
        //SCRIPT PARA CONSTRUIR UN BOTON
        $bt->titulo = "NUEVO";
        $bt->icon = "mdi-plus-circle";
        $bt->funcion = "aparecermodulos('catalogos/comisiones/fa_comisiones.php?idmenumodulo=$idmenumodulo','main');";
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
                <label>MOSTRAR Comisiones EN LA APLICACIÓN

                  <input type="checkbox" name="v_activarComisiones" onchange="MostrarComisiones()" value="0" id="v_activarComisiones" style="margin-left: 1em; position: absolute;">
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
                <label>ACTIVAR Comisiones PARA TODOS
                  <input type="checkbox" name="v_activaranunciocliente" onchange="ActivarComisiones()" value="0" id="v_activaranunciocliente" style="margin-left: 1em; position: absolute;">
                </label>
              </div> -->
            </div>

    </div>
     

              
    </div>
  </div>


<div class="card">
  <div class="card-body">
    <div class="table-responsive" id="contenedor_Comisiones">
      <table id="tbl_Comisiones" cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
        <thead>
          <tr>
             
            <th style="text-align: center;">BARBERO</th> 
            <th style="text-align: center;">TIPO</th> 

            <th style="text-align: center;">MONTO</th>

            <th style="text-align: center;">ACCI&Oacute;N</th>
          </tr>
        </thead>
        <tbody>
          
          <?php
          if($l_Comisiones_num== 0){
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
              
            
              
              <td style="text-align: center;"><?php echo $f->imprimir_cadena_utf8($l_Comisiones_row['nombre']);?></td>

                <td style="text-align: center;">

                	<?php echo $f->imprimir_cadena_utf8($tipo[$l_Comisiones_row['tipo']]);?>
                    
                   </td>
            
              <td style="text-align: center;">
              	<?php
                  if ($l_Comisiones_row['tipo']==0) {
                  $l_Comisiones_row['monto']=  $l_Comisiones_row['monto'].'%';
                  }else{
                $l_Comisiones_row['monto']=   '$'.$l_Comisiones_row['monto'];
                  }

                 echo $f->imprimir_cadena_utf8($l_Comisiones_row['monto']);?>
              </td>

              <td style="text-align: center; font-size: 15px;">

                  <?php
                          //SCRIPT PARA CONSTRUIR UN BOTON
                  $bt->titulo = "";
                  $bt->icon = "mdi-table-edit";
                  $bt->funcion = "aparecermodulos('catalogos/comisiones/fa_comisiones.php?idmenumodulo=$idmenumodulo&idComisiones=".$l_Comisiones_row['idcomisionespecialista']."','main')";
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
                  $bt->funcion ="BorrarDatosComision('".$l_Comisiones_row['idcomisionespecialista']."','catalogos/comisiones/vi_comisiones.php','main','$idmenumodulo')";
                  $bt->estilos = "";
                  $bt->permiso = $permisos;
                  $bt->tipo = 3;
                  $bt->title="BORRAR";

                  $bt->armar_boton();
                ?>
          

                </td>


              </tr>
              <?php
            }while($l_Comisiones_row = $db->fetch_assoc($l_Comisiones));
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<script type="text/javascript">

 
   $('#tbl_Comisiones').DataTable( {   
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
      "ordering": false,
          "info":     false


    } );
</script>

