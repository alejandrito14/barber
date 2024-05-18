<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.LeerQr.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new LeerQr();
	
	$token->db=$db;

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$idusuarios=$_POST['id_user'];
	$idqrgenerado=$_POST['idqrgenerado'];
	$lo->idusuarios=$idusuarios;
	$lo->idqrgenerado=$idqrgenerado;
	$lo->idcita=$_POST['idcita'];
	$arra=$lo->VerificarSihasidoleido();

	$validado=0;
	if (count($arra)>0) {
		$validado=1;
	}
	
	


	$respuesta['respuesta']=$validado;
	$respuesta['datosqr']=$arra;
	
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