<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Calificacion.php");


try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Calificacion();
	$f=new Funciones();
	$lo->db=$db;
	$db->begin();


	$idsucursal=$_POST['idsucursal'];
	$lo->idsucursal=$idsucursal;
	$obtenercalificaciones=$lo->ObtenerCalificacionesSucursal();


	$db->commit();

	$respuesta['respuesta']=1;
	$respuesta['calificaciones']=$obtenercalificaciones;
	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	echo $myJSON;

}catch(Exception $e){
	$db->rollback();
	//echo "Error. ".$e;
	
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}
?>