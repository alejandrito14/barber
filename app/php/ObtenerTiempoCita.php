<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Especialista.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$f=new Funciones();
	$fechas = new Fechas();
	$especialista=new Especialista();
	$especialista->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;

	$idcita=$_POST['idcita'];
	$idusuario=$_POST['iduser'];
	$lo->idcita=$idcita;
	$lo->idusuario=$idusuario;
	$especialista->idusuarios=$idusuario;
	/*$datosespecialista=$especialista->ObtenerIdEspecialista();
	$lo->idespecialista=$datosespecialista[0]->idespecialista;*/

	$obtenerdetallecita=$lo->ObtenerdetallecitaTiempo();
	$fechacheckin=date('Y-m-d H:i:s',strtotime($obtenerdetallecita[0]->fechacheckin));

	$actual=date('Y-m-d H:i:s');


	$fecha1 =  strtotime($fechacheckin);
	$fecha2 =  strtotime($actual);


	$diff = $fecha2 - $fecha1;

$dias = floor($diff / (60 * 60 * 24));
$horas = floor(($diff % (60 * 60 * 24)) / (60 * 60));
$minutos = floor(($diff % (60 * 60)) / 60);
$segundos = $diff % 60;
$centesimas = 0; // No hay centésimas en esta implementación



	$respuesta['respuesta']=$obtenerdetallecita[0];
	$respuesta['dias']=$dias;
	$respuesta['horas']=$horas;
	$respuesta['minutos']=$minutos;
	$respuesta['segundos']=$segundos;
	$respuesta['centesimas']=$centesimas;
	
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