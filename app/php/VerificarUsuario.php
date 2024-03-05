<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Usuarios.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Sucursal.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Usuarios();
	$lo->db=$db;
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$idusuario=$_POST['idusuario'];
	$lo->idusuario=$idusuario;

		

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['citasdia']=$obtenercitas;
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