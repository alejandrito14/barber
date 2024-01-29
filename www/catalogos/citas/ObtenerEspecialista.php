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
require_once("../../clases/class.Funciones.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$especialista = new Especialista();
	$especialista->db=$db;
	$f = new Funciones();
	$idespecialista=$_POST['idespecialista'];
	//enviamos la conexión a las clases que lo requieren
	$especialista->idespecialista=$idespecialista;
	$obtenerespecialista=$especialista->ObtenerEspecialista();
	$nombre=$obtenerespecialista[0]->nombre.' '.$obtenerespecialista[0]->paterno;
	//Recbimos parametros
	$respuesta['respuesta']=1;
	$respuesta['especialista']=$nombre;
	echo json_encode($respuesta);

	
				
	
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>