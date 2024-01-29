<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");

require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Cita.php");



try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$f=new Funciones();
	$fechas=new Fechas();
	$cita = new Cita();
	$cita->db=$db;
	$idusuarios=$_POST['iduser'];
	$idcita=$_POST['idcita'];
	
	$horarioseleccionado=$_POST['horarioseleccionado'];
	$fechaseleccionada=$_POST['fechaseleccionada'];
	$idespecialistaseleccionado=$_POST['idespecialistaseleccionado'];
	$hora=explode('_', $horarioseleccionado);
	$horainicial=$hora[0];
	$horafinal=$hora[1];



	$idcortesiaseleccionado=$_POST['idcortesiaseleccionado'];
	$valorseleccionado=$_POST['valorseleccionado'];


  $hora_original = strtotime($hora[0]);
  $nueva_hora = date('H:i', strtotime('+'.$valorseleccionado.' minutes', $hora_original));


	$cita->idcita=$idcita;
	$cita->horainicial=$horainicial;
	$cita->horafinal=$nueva_hora;
	$cita->fecha=$fechaseleccionada;
	$cita->idespecialista=$idespecialistaseleccionado;
	$cita->idcortesia=$idcortesiaseleccionado;

	$cita->GuardarReagenda();
	


	$respuesta['respuesta']=1;
	
	
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