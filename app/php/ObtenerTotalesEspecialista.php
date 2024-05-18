<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Notapago.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Sucursal.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Especialista.php");
try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Notapago();
	$lo->db=$db;
	$cita=new Cita();
	$cita->db=$db;
	$especialista=new Especialista();
	$especialista->db=$db;

	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$idusuario=$_POST['idusuario'];
	$mes=$_POST['mes'];
	$anio=$_POST['anio'];
	$productofechasdia=[];
	$sucursal->idusuario=$idusuario;
	$obtenersucursal=$sucursal->AccesoSucursal();

	$lo->idsucursal=$obtenersucursal[0]->idsucursales;

	$especialista->idusuario=$idusuario;
	$obtenerespecialista=$especialista->AccesoSucursalEspecialista();

	$cita->idespecialista=$obtenerespecialista[0]->idespecialista;
	
	$fechafiltro=date('Y-m-d');	
	$lo->fecha=$fechafiltro;
	//$obtener=$lo->ListadoNotasProductos();

	$cita->idsucursal=$obtenersucursal[0]->idsucursales;
	$cita->fecha=$fechafiltro;

	//todas las citas del especialista
	$obtenercitas=$cita->ObtenerCitasNocheckinEspe();
	//totalcitasrealizadas
	$cita->fecha=$fechafiltro;
	$cita->fechacita=$fechafiltro;
	$obtenercitasrealizadas=$cita->ObtenerCitascheckinEspe();

	$cita->horaactual=date('H:i');

	$obtenerpendientes=$cita->ObtenerCitasPendientesEspe();
	$obtenernorealizados=$cita->ObtenerCitasNoRealizadosEspe();
		
	$obtenercancelados=$cita->ObtenerCitasCanceladasEspe();
	$obtenerenproceso=$cita->ObtenerCitasProcesoEspe();

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['totalproductosdia']=count($obtener);
	$respuesta['totalcitasdia']=count($obtenercitas);
	$respuesta['totalcitasrealizadas']=count($obtenercitasrealizadas);
	$respuesta['totalpendientes']=count($obtenerpendientes);
	$respuesta['totalnorealizados']=count($obtenernorealizados);
	$respuesta['totalcancelados']=0;
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