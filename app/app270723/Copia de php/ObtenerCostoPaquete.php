<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Importamos las clases que vamos a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.HorariosSucursal.php");
//require_once("clases/class.Categorias.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Especialista.php");
require_once("clases/class.Cita.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$horariossucursal = new HorariosSucursal();
	$horariossucursal->db=$db;
	$f = new Funciones();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	$especialista=new Especialista();
	$especialista->db=$db;
	$citas=new Cita();
	$citas->db=$db;
	//$categorias = new Categorias();
	$fechas = new Fechas();
	//$categorias->db=$db;
	$idsucursal=$_POST['idsucursal'];
	$idpaquete=$_POST['idpaquete'];
	$idespecialista=$_POST['idespecialista'];
	$paquetes->idpaquete=$idpaquete;
	//$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$fecha=$_POST['fecha'];
	$hora=explode('_', $_POST['horario']);
	$horainicial=$hora[0];
	$horafinal=$hora[1];

	$especialista->idpaquete=$idpaquete;
	$especialista->idsucursal=$idsucursal;
	$especialista->idespecialista=$idespecialista;

	$obtener=$especialista->ObtenerCosto();


	$respuesta['respuesta']=1;
	$respuesta['costo']=$obtener;
	/*$respuesta['fechadia']=$fechadia;
	$respuesta['arrayfechasdias']=$arrayfechasdias;
*/
	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>