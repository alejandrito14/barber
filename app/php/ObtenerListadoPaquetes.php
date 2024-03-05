<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Funciones.php");
/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Paquetes();
	$f=new Funciones();

	//Enviamos la conexion a la clase
	$lo->db = $db;


	//$idcategoria=$_POST['idcategoria'];
	$idsucursal=$_POST['idsucursal'];
	$iduser=$_POST['iduser'];
	$lo->idsucursal=$idsucursal;
	$lo->idusuario=$iduser;

	$obtenerpaquetes=$lo->PaquetesCategoria();

	for ($i=0; $i <count($obtenerpaquetes) ; $i++) { 
		$lo->idpaquete=$obtenerpaquetes[$i]->idpaquete;
		$obtenerfavorita=$lo->ObtenerPaqueteFavorito();
		$favorita=0;
		if (count($obtenerfavorita)>0) {
			$favorita=1;
		}

		$obtenerpaquetes[$i]->favorita=$favorita;
	}

	$respuesta['respuesta']=$obtenerpaquetes;
	
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