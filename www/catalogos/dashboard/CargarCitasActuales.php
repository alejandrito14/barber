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
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Notapago.php");

require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$citas = new Cita();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	$notapago = new Notapago();
	$notapago->db=$db;
	//enviamos la conexión a las clases que lo requieren
	$md->db = $db;	
	$citas->db=$db;
	

	//Recbimos parametros
	$citas->fecha=date('Y-m-d');
	$obtener=$citas->ObtenerCitasNocheckin();
	
	$notapago->fecha=date('Y-m-d');
	$obtenernotas=$notapago->ListadoNotasDescripcionProductos();

	$obtenerrealizadas=$citas->ObtenerCitascheckin();


	$respuesta['respuesta']=$obtener;
	$respuesta['notas']=$obtenernotas;
	$respuesta['realizadas']=$obtenerrealizadas;

	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>