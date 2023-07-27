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
require_once("../../clases/class.Notapago.php");

require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$notapago = new Notapago();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	//enviamos la conexión a las clases que lo requieren
	$md->db = $db;	
	$notapago->db=$db;
	
	$codigo=$se->obtenerSesion('codservicio');
	//Recbimos parametros
	$notapago->fecha=$_POST['fecha'];
	$obtener=$notapago->ListadoNotasDescripcionProductos();

	for ($i=0; $i < count($obtener); $i++) { 
		
		$obtener[$i]->imagen=$codigo.'/'.$obtener[$i]->imagen;
	}
	


	$respuesta['respuesta']=$obtener;

	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>