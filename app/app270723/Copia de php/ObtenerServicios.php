<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Sucursal.php");

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


	//$idcategoria=$_POST['idcategoria'];
	$iduser=$_POST['idusuario'];
	$lo->idusuarios=$iduser;


	$sucursal->idusuario=$iduser;
	$obtenersucursal=$sucursal->AccesoSucursal();
	$servicio=$_POST['servicio'];
	$lo->servicio=$servicio;
	$lo->idsucursal=$obtenersucursal[0]->idsucursales;
	$obteneservicios=$lo->ObtenerPaquetesServicio();


	
	
	$respuesta['respuesta']=1;
	$respuesta['paquetes']=$obteneservicios;
	
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