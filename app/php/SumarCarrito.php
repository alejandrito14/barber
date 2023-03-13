<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Funciones.php");
//require_once("clases/class.MovimientoBitacora.php");
/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Carrito();
	$f=new Funciones();

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$operacion=$_POST['operacion'];

	$lo->idcarrito=$_POST['idcarrito'];
	$obtenercarrito=$lo->ObtenerDelCarrito();
	$cantidad=$_POST['cantidad'];
	$costounitario=$obtenercarrito[0]->costounitario;

	/*if ($operacion==1) {
		$cantidad=$cantidad+1;
	}else{

		$cantidad=$cantidad-1;
	}*/
	$costototal=$costounitario*$cantidad;
	

	$lo->cantidad=$cantidad;
	$lo->costototal=$costototal;

	$lo->ActualizarTotal();

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