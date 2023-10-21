<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.WhatsapMensaje.php");
require_once("clases/class.Funciones.php");



try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$f=new Funciones();
	$mensaje=new WhatsapMensaje();
	$mensaje->db=$db;
	$mensaje->Version='v17.0';
	//$mensaje->phoneid='136352302900365';
	$mensaje->phoneid='162367660284534';
	$mensaje->tophone='529611328099';
	$texto='hola';
	$mensaje->accestoken='EAAPR4S8LbikBOyPRbuPW5ZC7ZCVppCNIuqywit2ZBwZBV2kLLW2JcnxJtnWEGuKldiTnogxV43mHgAeZBhtrirbCVLFJ7xQIrXmbNBDKIBhcDpFsCuSMs5XBZBzU3iV27NhsN7kn01ufZBGmlImcWasgxwFXPoacPrtRWEp8ofkQLhDVgCDpUxAHwxFmgdsQhRSqXhlWSwxhaYI';
	$mensaje->texto="1402";
	$mensaje->EnviarMensaje();
	


	
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