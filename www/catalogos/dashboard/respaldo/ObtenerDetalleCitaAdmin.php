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
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Especialista.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$f=new Funciones();
	$fechas = new Fechas();
	$especialista=new Especialista();
	$especialista->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;

	$idcita=$_POST['idcita'];
	$idusuario=$_POST['iduser'];
	$lo->idcita=$idcita;
	$lo->idusuario=$idusuario;
	$especialista->idusuarios=$idusuario;
	

	$obtenerdetallecita=$lo->ObtenerdetallecitaAdmin();
	$obtenerdetallecita[0]->fecha=date('d-m-Y',strtotime($obtenerdetallecita[0]->fechacita));

	$obtenerdetallecita[0]->fechaformato=$fechas->fecha_texto5($obtenerdetallecita[0]->fechacita);

	$codigo=$se->obtenerSesion('codservicio');
    $obtener[0]->imagen=$codigo.'/'.$obtener[0]->imagen;


	$respuesta['respuesta']=$obtenerdetallecita[0];
	
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