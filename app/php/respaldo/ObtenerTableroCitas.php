<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");

//require_once("clases/class.MovimientoBitacora.php");
/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$f=new Funciones();
	$fechas = new Fechas();

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$lo->estatus=$_POST['estatus'];
	$lo->idusuarios=$_POST['idusuarios'];
	$obtenertablero=$lo->ObtenerCitasUsuario();

	if (count($obtenertablero)>0) {
		for ($i=0; $i < count($obtenertablero); $i++) { 
			
			$obtenertablero[$i]->fechaformato=$fechas->fecha_texto5($obtenertablero[$i]->fechacita);
			$fecha=date('d/m/Y',strtotime($obtenertablero[$i]->fechacita));

			$obtenertablero[$i]->anio=date('Y',strtotime($obtenertablero[$i]->fechacita));
			$obtenertablero[$i]->fechacita=$fecha;
		}
	}



	$respuesta['respuesta']=$obtenertablero;
	
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