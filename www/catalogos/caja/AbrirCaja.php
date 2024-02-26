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

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$caja = new Caja();
	$f = new Funciones();
	
	//enviamos la conexión a las clases que lo requieren
	$caja->db=$db;

		
	$caja->idusuario=$_SESSION['se_sas_Usuario'];
	//$caja->fechainicio=date('Y-m-d H:i:s');
	$caja->montoinicial=$_POST['saldoinicial'];
	$caja->estatus=1;

	if ($caja->montoinicial=='') {
		$caja->montoinicial=0;
	}

	$obtenercaja=$caja->AbrirCaja();

	$se->crearSesion('idManejoCaja',$caja->idmanejocaja);
	//Recbimos parametros
	$respuesta['respuesta']=1;
	$respuesta['caja']=$obtenercaja;


	echo json_encode($respuesta);

	
				
	
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>