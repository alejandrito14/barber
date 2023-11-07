<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Paquetes.php");

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
	$db->begin();

	$cita->fecha=date('Y-m-d');
	$obtenercitas=$cita->ObtenerCitasPendientesCron();
	$citascaducadas=array();
	$horaactual=date('H:i');
	if (count($obtenercitas)>0) {
	
		
		for ($i=0; $i <count($obtenercitas) ; $i++) { 
		
			$horainicial=$obtenercitas[0]->horacita;
			$horafinal=date('H:i',strtotime($obtenercitas[0]->horafinal));
			
			if ($horafinal<=$horaactual) {
				
				$cita->idcita=$obtenercitas[$i]->idcita;
				$cita->estatus=4;
				$cita->ActualizarCitaCaducada();

				array_push($citascaducadas, $obtenercitas[$i]);
			}
		}
	}

	
	
	$db->commit();
	$respuesta['idusuarios']=$cita->idusuario;
	$respuesta['citascaducadas']=$citascaducadas;
	$respuesta['respuesta']=1;
	$respuesta['fecha']=$cita->fecha;
	$respuesta['hora']=$horaactual;
	$nombreArchivo = "salidacroncaducadas.txt";

	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	file_put_contents($nombreArchivo, $myJSON, FILE_APPEND);
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