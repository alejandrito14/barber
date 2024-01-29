<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

 
if(!isset($_SESSION['se_SAS']))
{
	//header("Location: ../login.php");
	echo "login";
	exit;
}

require_once("../../clases/conexcion.php");

require_once("../../clases/class.Tiempo.php");


	try {

		$db = new MySQL();
		$tiempo = new Tiempo();
		$tiempo->db=$db;
		
		$obtenertiempos=$tiempo->ObtenerTiempos();
	

		$respuesta['resultado']=$obtenertiempos;

		$myJSON = json_encode($respuesta);
		echo $myJSON;
	

		
	} catch (Exception $e) {
		

	echo "Error. ".$e;
	}






?>