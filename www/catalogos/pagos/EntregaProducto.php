<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();
if(!isset($_SESSION['se_SAS']))
{
  /*header("Location: ../../login.php"); */ echo "login";

  exit;
}

//Inlcuimos las clases a utilizar
require_once "../../clases/conexcion.php";

require_once "../../clases/class.Funciones.php";
/*require_once "clases/class.MovimientoBitacora.php";
*/require_once "../../clases/class.Usuarios.php";
require_once "../../clases/class.Carrito.php";
require_once "../../clases/class.Cita.php";
require_once "../../clases/class.UsoCupon.php";


require_once("../../clases/class.ClienteStripe.php");
require_once("../../clases/class.Tipodepagos.php");
require_once("../../clases/class.PagConfig.php");

require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Servicios.php");
require_once("../../clases/class.Cupones.php");

$idnotapago=$_POST['idnotapago'];
$idusuarioentrega=$se->obtenerSesion('se_sas_Usuario');
$observaciones=$_POST['observaciones'];
try {
     $db = new MySQL();
     $notapago=new Notapago();

     $notapago->db=$db;
     $db->begin();


     $notapago->idnotapago=$idnotapago;
    $detallenota=$notapago->ObtenerdescripcionNota();

    $notapago->entregado=1;
    $notapago->fechaentrega=date('Y-m-d H:i:s');
    $notapago->idusuarioentrega=$idusuarioentrega;
    $notapago->observacionesentrega=$observaciones;
    $notapago->ActualizarNotaEntrega();

    if (count($detallenota)>0) {
      for ($i=0; $i <count($detallenota) ; $i++) { 
          $notapago->idnotapagodescripcion=$detallenota[$i]->idnotapago_descripcion;
          $notapago->ActualizarNotadescripcionEntrega();

      }
    }
      $db->commit();

   

    $respuesta['respuesta'] = 1;
    $respuesta['mensaje']   = "";
    $respuesta['idnotapago']=$notapago->idnotapago;

    //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;
  

  


} catch (Exception $e) {
  $db->rollback();
    //echo "Error. ".$e;
     $output = [
                'error' => 1,
                ]; 
     $array->resultado = "Error: Unknown error occurred";
     $array->msg = "Error al ejecutar el php";
     $array->id = '0';
     $array->respuesta=$e;
     $array->output=$output;
              //Retornamos en formato JSON 
     $myJSON = json_encode($array);
          echo $myJSON; 
}





?>