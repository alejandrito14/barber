<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Sucursal.php");

//require_once("clases/class.MovimientoBitacora.php");
/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Paquetes();
	$f=new Funciones();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;


	//$lo->idcarrito=$_POST['idcarrito'];
	$lo->idpaquete=$_POST['idpaquete'];
	$obtenercortesias=$lo->ObtenerCortesias();

	$obtenerpaquete=$lo->ObtenerPaquete2();

	$idsucursal=$obtenerpaquete[0]->idsucursal;

	$sucursal->idsucursales=$idsucursal;
	$obtener=$sucursal->ObtenerSucursal();

	$respuesta['respuesta']=$obtenercortesias;
	$respuesta['paquete']=$obtenerpaquete[0];
	$respuesta['sucursal']=$obtener[0];
	
	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	echo $myJSON;

}catch(Exception $e){
	//$db->rollback();
	//echo "Error. ".$e;
	
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}
?>