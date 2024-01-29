<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	/*header("Location: ../../login.php"); */ echo "login";

	exit;
}

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos las clases que vamos a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Especialista.php");



try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$especialista = new Especialista();
	//enviamos la conexión a las clases que lo requieren
	$especialista->db=$db;

	//Recbimos parametros
	$especialista->idsucursal=$se->obtenerSesion('idsucursalsesion');
	$obtener=$especialista->ObtenerEspecialistasT();


	$respuesta['respuesta']=$obtener;

	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>