<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Sucursal.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Especialista.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Especialista();
	$f=new Funciones();
	$fechas = new Fechas();

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$idsucursal=$_POST['idsucursal'];
	$lo->idsucursal=$idsucursal;

	$obtenerespecialista=$lo->ObtenerEspecialistasSucursales();
	$respuesta['especialistas']=$obtenerespecialista;
	$respuesta['respuesta']=1;
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