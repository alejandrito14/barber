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
	$sucursal->idusuario=$idusuario;
	$obtenersucursal=$sucursal->AccesoSucursal();

	$lo->idsucursal=$obtenersucursal[0]->idsucursales;
	
	$fechafiltro=date('Y-m-d');	
	$lo->fecha=$fechafiltro;
	$obtener=$lo->ListadoNotasProductos();

	$cita->idsucursal=$obtenersucursal[0]->idsucursales;
	$cita->fechacita=$fechafiltro;
	$obtenercitas=$cita->ObtenerCitasFecha();

		

		

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['totalproductosdia']=count($obtener);
	$respuesta['totalcitasdia']=count($obtenercitas);

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