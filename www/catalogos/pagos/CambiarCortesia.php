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

//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Pagos.php");

require_once("../../clases/class.Cita.php");
require_once('../../clases/class.MovimientoBitacora.php');

try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $f=new Funciones();
    $cita = new Cita();
    $pago=new Pagos();
    $md = new MovimientoBitacora();
    $md->db = $db;  
    $pago->db=$db;
    $cita->db=$db;
    $idcita = $_POST['idcita'];
    $idcortesia=$_POST['idcortesia'];

    $db->begin();

    $cita->idcita=$idcita;
    $cita->idcortesia=$idcortesia;
    $cita->CambiarCortesia();

   

    $md->guardarMovimiento($f->guardar_cadena_utf8('cambio cortesia'),'nota de pago',$f->guardar_cadena_utf8('Cambio de cortesia ID-'.$cita->idcita.' por usuario '.$_SESSION['se_sas_Usuario']));

    $db->commit();

    $respuesta['respuesta']=1;
    echo json_encode($respuesta);

    

} catch (Exception $e) {
    $db->rollback();
    //echo "Error. ".$e;

    $array->resultado = "Error: " . $e;
    $array->msg       = "Error al ejecutar el php";
    $array->id        = '0';
    //Retornamos en formato JSON
    $myJSON = json_encode($array);
    echo $myJSON;
}
?>