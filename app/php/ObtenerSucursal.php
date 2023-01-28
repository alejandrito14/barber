<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Sucursal.php");

require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");



try
{
	
	//Declaramos obtenerpaquete[0]s de clases
	$db = new MySQL();
	$f=new Funciones();
	$fechas=new Fechas();

	$sucursalesfolios=new Sucursal();
	//Enviamos la conexion a la clase
	$lo->db = $db;
	$sucursalesfolios->db=$db;


	$idsucursal=$_POST['idsucursal'];

	$sucursalesfolios->idsucursales=$idsucursal;
	$consultarsucursal=$sucursalesfolios->buscar_sucursal();
	$rowsucursal=$db->fetch_assoc($consultarsucursal);
	$numsucursal=$db->num_rows($consultarsucursal);
	$validadosucursal=0;

	$obtenerimagenes=$sucursalesfolios->ObtenerImagenesSucursal();

		
	$respuesta['respuesta']=1;
	$respuesta['sucursal']=$rowsucursal;
	$respuesta['imagenes']=$obtenerimagenes;
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