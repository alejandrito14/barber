<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	/* header("Location: ../login.php"); */ echo "login";
	exit;
}
require_once("../../clases/conexcion.php");

require_once("../../clases/class.Temporalcarrito.php");

try
{

	$idtemporalcarrito=$_POST['idtemporalcarrito'];

	$db= new MySQL();
	$temporalcarrito=new Temporalcarrito();
	$temporalcarrito->db=$db;
	$temporalcarrito->idtemporalcarrito=$idtemporalcarrito;
	$temporalcarrito->EliminarElemento();




	$respuesta['respuesta'] = 1;

   //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;

} catch (Exception $e) {
    //$db->rollback();
    //echo "Error. ".$e;

    $array->resultado = "Error: " . $e;
    $array->msg       = "Error al ejecutar el php";
    $array->id        = '0';
    //Retornamos en formato JSON
    $myJSON = json_encode($array);
    echo $myJSON;
}
 ?>