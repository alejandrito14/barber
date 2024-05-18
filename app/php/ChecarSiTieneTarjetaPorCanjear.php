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

	$idsucursal=isset($_POST['idsucursal'])?$_POST['idsucursal']:0;
	$lo->idsucursal=$idsucursal;

	$lo->idusuario=$idusuario;
	$obtenertarjetasasignadas=$lo->ObtenerTarjetasAsignadas();


		for ($i=0; $i <count($obtenertarjetasasignadas) ; $i++) { 

			$obtenertarjetasasignadas[$i]->fechainicial=$fechas->fecha_texto5(date('Y-m-d',strtotime($obtenertarjetasasignadas[$i]->fechainicial)));

			$obtenertarjetasasignadas[$i]->fechafinal=$fechas->fecha_texto5(date('Y-m-d',strtotime($obtenertarjetasasignadas[$i]->fechafinal)));

			
			
			$cantidadrequerida=$obtenertarjetasasignadas[$i]->cantidadrequerida;
			$cantidadproducto=$obtenertarjetasasignadas[$i]->cantidadproducto;
			$obtenertarjetasasignadas[$i]->aparecerbtn=0;

			if ($cantidadrequerida==$cantidadproducto) {
				$obtenertarjetasasignadas[$i]->aparecerbtn=1;
			}
		}

	$respuesta['respuesta']=$obtenertarjetasasignadas;
	
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