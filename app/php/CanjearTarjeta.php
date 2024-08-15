<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Tarjetalealtad.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Tarjetalealtad();
	$f=new Funciones();
	$fechas=new Fechas();

	//Enviamos la conexion a la clase
	$lo->db = $db;


	$idusuario=$_POST['idusuario'];

	$idtarjetalealtad=$_POST['idtarjetalealtad'];
	$idtarjetalealtadasignacion=$_POST['idtarjetalealtadasignacion'];
	$lo->idtarjetalealtad=$idtarjetalealtad;
	$lo->idtarjetalealtadasignacion=$idtarjetalealtadasignacion;
	$obtenerproductos=$lo->ObtenerBeneficiosTarjeta();

	$obtenertarjeta=$lo->Obtenertarjetalealtad();

	//verificarquenotengaencarrritocanje
	$tienecanjeenproceso=$lo->VerificarCanje();

	if (count($tienecanjeenproceso)>0) {
		$obtenertarjeta=[];
		//tiene un canje en proceso
	}

	$clienteasignacion=$lo->ObtenerClienteAsignacion();
		

	$respuesta['respuesta']=$obtenerproductos;
	$respuesta['tarjetalealtad']=$obtenertarjeta;
	$respuesta['clientetarjeta']=$clienteasignacion;
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