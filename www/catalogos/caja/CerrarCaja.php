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
require_once("../../clases/class.Caja.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Notapago.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$caja = new Caja();
	$f = new Funciones();
	$notaspago= new Notapago();
	$db->begin();

	//enviamos la conexión a las clases que lo requieren
	$caja->db=$db;

		
	$caja->idusuario=$_SESSION['se_sas_Usuario'];
	$caja->fechafin=date('Y-m-d H:i:s');
	$caja->idmanejocaja=$se->obtenerSesion('idManejoCaja');
	$caja->montofinal=$_POST['saldofinal'];
	$caja->estatus=2;

	$caja->ActualizarCaja();

	$obtenercorte=$caja->ObtenerCaja();
	$fechainicial=$obtenercorte[0]->fechainicio;
	$caja->fechainicio=$fechainicial;

	$obtenernotaspagadassinmanejo=$caja->ObtenerNotasPagadasSinManejo();

	$obtenernotaspagadasapp=$caja->ObtenerNotasPagadasApp();

	$obtenernotaspagadas=$caja->ObtenerNotasPagadas();



	
	//Recbimos parametros
	$respuesta['respuesta']=1;
	$respuesta['caja']=$caja->idmanejocaja;
	$respuesta['obtenernotaspagadas']=$obtenernotaspagadas;
	$respuesta['obtenernotaspagadassinmanejo']=$obtenernotaspagadassinmanejo;

	$db->commit();

	echo json_encode($respuesta);
		
	
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>