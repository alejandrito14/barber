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


require_once("../../clases/conexcion.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Usuarios.php");
require_once("../../clases/class.HistorialModificacionNota.php");

	try
	{
	//declaramos los objetos de clase
	$db = new MySQL();
	$notapago = new Notapago();
	$notapago->db=$db;
	$f = new Funciones();
	$usuarios=new Usuarios();
	$usuarios->db=$db;
	$historial=new HistorialModificacionNota();
	$historial->db=$db;
	$db->begin();
 
	//enviamos la conexión a las clases que lo requieren
	$notapago->db=$db;

	$notapago->idnotapagodescripcion=$_POST['idnotadescripcion'];
	//$notapago->idusuarios=$se->obtenerSesion('usuariopago');


	$precio=$_POST['precio'];
	$usuario=$_POST['usuario'];
	$contrase=$_POST['contra'];

	$usuarios->usuario=$usuario;
	$usuarios->clave=$contrase;

	$obtener=$usuarios->ValidarUsuarioModificar();

	if (count($obtener)>0) {
		
		$notapago->costounitario=$precio;
		$cambio=1;

		
		$obtenernotadescripcion=$notapago->Obtenerdescripcion();
		$cantidad=$obtenernotadescripcion[0]->cantidad;
		$multiplicar=$precio*$cantidad;
		$notapago->costounitario=$precio;
		$notapago->monto=$multiplicar;
		$notapago->cantidad=$cantidad;
		$notapago->GuardarNuevoMonto();


		$historial->idusuario=$obtener[0]->idusuarios;
		$historial->preciomodificado=$obtenernotadescripcion[0]->costounitario;
		$multiplicar=$precio*$cantidad;
		$historial->nuevoprecio=$multiplicar;
		$historial->idnopagodescripcion=$obtenernotadescripcion[0]->idnotapago_descripcion;
		$historial->GuardarModificacion();

	}else{

		$cambio=0;

	}

	$notapago->idnotapago=$obtenernotadescripcion[0]->idnotapago;
	$obtenernota=$notapago->Obtenernota();
	$obtenerdescripcion=$notapago->ObtenerdescripcionNota();

	$suma=0;
	for ($i=0; $i < count($obtenerdescripcion); $i++) { 
		

		$suma=$suma+$obtenerdescripcion[$i]->monto;
	}
	$notapago->total=$suma;
	$notapago->subtotal=$suma;
	$notapago->ActualizarToTalnota();
	
	$db->commit();	
	$respuesta['respuesta']=$cambio;
	echo json_encode($respuesta);
	
}catch(Exception $e)
	{
		$db->rollback();
		echo "Error. ".$e;
	}
?>