<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";

require_once "clases/class.Funciones.php";

require_once "clases/class.Cita.php";

require_once "clases/class.Tarjetalealtad.php";

require_once "clases/class.Canje.php";

require_once("clases/class.Notapago.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$notapago=new Notapago();
	$notapago->db=$db;
	$tarjetalealtad=new Tarjetalealtad();
	$tarjetalealtad->db=$db;
	$db->begin();

	$tarjetalealtad->EliminacionTotal();
	

	$tarjetalealtad->idsucursal=1;

	$obtenernotaspagadas=$notapago->Obtenernotaspagadas();
	
	for ($i=0; $i <count($obtenernotaspagadas); $i++) {  
		// code...
		$idnotapago=$obtenernotaspagadas[$i]->idnotapago;
		$tarjetalealtad->idnotapago=$idnotapago;
        $tarjetalealtad->Verificarproductosnota();
	}
	



	$db->commit();

	$respuesta['respuesta']=1;
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