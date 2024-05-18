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


	$idpaquete=$_POST['idpaquete'];
	$lo->idpaquete=$idpaquete;

	$obtenerpaquete=$lo->ObtenerPaquete();
	$rowpaquete=$db->fetch_assoc($obtenerpaquete);

	$obtenergrupos=$lo->ObtPaqueteOpciones();


	$opciones=array();

	for ($i=0; $i < count($obtenergrupos); $i++) { 
		
		$lo->idgrupopaquete=$obtenergrupos[$i]->idgrupopaquetes;
		$lo->idgrupo=$obtenergrupos[$i]->idgrupo;
		$opcionesgrupo=$lo->ObtOpciones();

		array_push($opciones, $opcionesgrupo);

	}

	$rowimagenes=$lo->ObtImagenesPaquete();


	$objeto = array('paquete'=>$rowpaquete,'grupos'=>$obtenergrupos,'opciones'=>$opciones,'imagenespaquete'=>$rowimagenes);


	$respuesta['respuesta']=$objeto;
	
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