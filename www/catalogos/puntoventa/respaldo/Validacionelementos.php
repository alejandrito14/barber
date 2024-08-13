<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();
//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Carrito.php");
require_once("../../clases/class.Paquetes.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.PagConfig.php");
require_once("../../clases/class.Tipodepagos.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$cita = new Cita();
	$f=new Funciones();
	$carrito=new Carrito();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	$cita->db=$db;
	$carrito->db=$db;
	$fechas=new Fechas();
	$db->begin();

	$nodisponible=[];
  $paquetesseleccionados=json_decode($_POST['paquetes']);

	for ($i=0; $i <count($paquetesseleccionados) ; $i++) { 

	      if ($paquetesseleccionados[$i]->servicio==1) {

	      		$dividirhora=explode('_', $paquetesseleccionados[$i]->hora);
	      	 	$horainicial=$dividirhora[0];
	      	 	$horafinal=$paquetesseleccionados[$i]->horafinal;
	      	 	$idespecialista=$paquetesseleccionados[$i]->idespecialista;
	      	 	$fecha=$paquetesseleccionados[$i]->fecha;
	      	 	$cita->fechacita=$fecha;
	      	 	$cita->horafinal=$horafinal;
	      	 	$cita->horainicial=$horainicial;
	      	 	$cita->idespecialista=$idespecialista;
	      	 	$cita->fecha=$fecha;
	      	 	$disponibilidad=$cita->ChecarHorarioFechaEspecialista();

	      	 	if (count($disponibilidad)>0) {
	      	 		
	      	 		array_push($nodisponible, $paquetesseleccionados[$i]);
	      	 	}

	      }

	  }

	$respuesta['respuesta']=1;
	$respuesta['nodisponible']=$nodisponible;

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