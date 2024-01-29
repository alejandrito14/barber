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
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Funciones.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$fechas = new Fechas();
	$f = new Funciones();
	$fecha=$_POST['fechadatos'];
	//enviamos la conexión a las clases que lo requieren
	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fecha))];

	$fechaformato=$diatexto.' '.date('d',strtotime($fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fecha))].' de '.date('Y', strtotime($fecha));

	
	//Recbimos parametros
	$respuesta['respuesta']=1;
	$respuesta['fecha']=$fechaformato;
	echo json_encode($respuesta);

	
				
	
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>