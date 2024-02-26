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
require_once("../../clases/class.Carrito.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Usuarios.php");
require_once("../../clases/class.HistorialModificacion.php");

	try
	{
	//declaramos los objetos de clase
	$db = new MySQL();
	$carrito = new Carrito();
	$carrito->db=$db;
	$f = new Funciones();
	$usuarios=new Usuarios();
	$usuarios->db=$db;
	$historial=new HistorialModificacion();
	$historial->db=$db;
	$db->begin();

	//enviamos la conexión a las clases que lo requieren
	$carrito->db=$db;

	$carrito->idcarrito=$_POST['idcarrito'];
	$carrito->idusuarios=$se->obtenerSesion('usuariopago');


	$precio=$_POST['precio'];
	$usuario=$_POST['usuario'];
	$contrase=$_POST['contra'];

	$usuarios->usuario=$usuario;
	$usuarios->clave=$contrase;

	$obtener=$usuarios->ValidarUsuarioModificar();

	if (count($obtener)>0) {
		
		$carrito->costounitario=$precio;
		$cambio=1;

		
		$obtenercarrito=$carrito->ObtenerDelCarrito();
		$cantidad=$obtenercarrito[0]->cantidad;
		$multiplicar=$precio*$cantidad;
		$carrito->costototal=$multiplicar;
		$carrito->cantidad=$cantidad;
		$carrito->GuardarNuevoMonto();


		$historial->idusuario=$obtener[0]->idusuarios;
		$historial->preciomodificado=$obtenercarrito[0]->costounitario;
		$historial->nuevoprecio=$carrito->costounitario;
		$historial->idcarrito=$carrito->idcarrito;
		$historial->GuardarModificacion();

	}else{

		$cambio=0;

	}


	$db->commit();
	$respuesta['respuesta']=$cambio;
	echo json_encode($respuesta);
	
}catch(Exception $e)
	{
		$db->rollback();
		echo "Error. ".$e;
	}
?>