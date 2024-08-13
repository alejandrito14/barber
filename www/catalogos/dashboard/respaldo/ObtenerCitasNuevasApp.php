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
require_once("../../clases/class.Fechas.php");

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
	$fechas = new Fechas();


	$citas->idsucursal=$se->obtenerSesion('idsucursalsesion');

	//Recbimos parametros
	$citas->fecha=date('Y-m-d');
	$obtener=$citas->ObtenerCitasNocheckinApp();

	for ($i=0; $i < count($obtener); $i++) { 
		$obtener[$i]->fechaformato=$fechas->fecha_texto5($obtener[$i]->fechacita);
	}
	
	

	$respuesta['respuesta']=$obtener;
	

	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>