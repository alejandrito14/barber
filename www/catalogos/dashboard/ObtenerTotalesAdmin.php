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
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Sucursal.php");
require_once("../../clases/class.Cita.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Notapago();
	$lo->db=$db;
	$cita=new Cita();
	$cita->db=$db;
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$idusuario=$_POST['idusuario'];
	$mes=$_POST['mes'];
	$anio=$_POST['anio'];
	$productofechasdia=[];
	$fechafiltro=$_POST['fecha'];
	$sucursal->idusuario=$idusuario;
	$obtenersucursal=$sucursal->AccesoSucursal();

	$lo->idsucursal=$se->obtenerSesion('idsucursalsesion');
	$idsucursal=$lo->idsucursal;
	if ($fechafiltro=='') {
		$fechafiltro=date('Y-m-d');	
	}
	
	$lo->fecha=$fechafiltro;
	$obtener=$lo->ListadoNotasProductos();

	$cita->idsucursal=$idsucursal;
	$cita->fecha=$fechafiltro;
	$obtenercitas=$cita->ObtenerCitasNocheckin();
	//totalcitasrealizadas
	$cita->fecha=$fechafiltro;
	$obtenercitasrealizadas=$cita->ObtenerCitascheckin();

	$cita->horaactual=date('H:i');

	$obtenerpendientes=$cita->ObtenerCitasPendientes();
	$obtenernorealizados=$cita->ObtenerCitasNoRealizados();
		
	$obtenercancelados=$cita->ObtenerCitasCanceladas();
	$obtenerenproceso=$cita->ObtenerCitasProceso();

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['totalproductosdia']=count($obtener);
	$respuesta['totalcitasdia']=count($obtenercitas);
	$respuesta['totalcitasrealizadas']=count($obtenercitasrealizadas);
	$respuesta['totalpendientes']=count($obtenerpendientes);
	$respuesta['totalnorealizados']=count($obtenernorealizados);
	$respuesta['totalcancelados']=count($obtenercancelados);
	$respuesta['totalproceso']=count($obtenerenproceso);
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