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

//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Sucursal.php");
require_once("../../clases/class.Especialista.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$lo->db=$db;
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$especialista=new Especialista();
	$especialista->db=$db;
	$idusuario=$se->obtenerSesion('se_sas_Usuario');
	$idespecialista=$_POST['idespecialista'];
	$lo->idespecialista=$idespecialista;

	$sucursal->idusuario=$idusuario;
	$lo->idsucursal=$se->obtenerSesion('idsucursalsesion');
	

	$fecha=$_POST['fecha'];
	$lo->fecha=$fecha;
	$obtenercitas=$lo->ObtenerCitasFechaSinHorario();

	$estatus=array('Pendiente','En proceso','Completado','Cancelado','Caducado');
	$claseestatus=array('#f7bb44','#38a2f7','#2b952a','red','gray');

		for ($i=0; $i <count($obtenercitas) ; $i++) { 
			

			$hora_inicial = strtotime($obtenercitas[$i]->horains);
			$hora_final = strtotime($obtenercitas[$i]->horafs);

			$diferencia_en_segundos = $hora_final - $hora_inicial;
			$diferencia_en_minutos = $diferencia_en_segundos / 60;

			$obtenercitas[$i]->intervaloservicio=$diferencia_en_minutos;
			$est=$obtenercitas[$i]->estatus;
			$obtenercitas[$i]->textoestatus=$estatus[$est];
			$obtenercitas[$i]->claseestatus=$claseestatus[$est];


		}
	
		

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['citasdia']=$obtenercitas;
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