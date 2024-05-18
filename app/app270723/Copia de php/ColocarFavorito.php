<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Paquetes();
	$f=new Funciones();
	$fechas=new Fechas();

	//Enviamos la conexion a la clase
	$lo->db = $db;


	$idpaquete=$_POST['idpaquete'];
	$valor=$_POST['valor'];
	$idcliente=$_POST['iduser'];
	
	$lo->idpaquete=$idpaquete;
	$lo->idusuario=$idcliente;


	if ($valor==1) {
		
		$lo->GuardarFavorito();
	}else{

		$lo->EliminarFavorito();
	}
	
	
	$res = array('respuesta' =>1);

	/*$respuesta['respuesta']=$sucursales;
	$respuesta['imagenes']=$imagenes;*/
	
	//Retornamos en formato JSON 
	$myJSON = json_encode($res);
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