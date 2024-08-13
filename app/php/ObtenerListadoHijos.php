<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Importamos las clases que vamos a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Usuarios.php");
//require_once("clases/class.Categorias.php");
require_once("clases/class.Fechas.php");

require_once("clases/class.Funciones.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();

	$f = new Funciones();

	//$categorias = new Categorias();
	$fechas = new Fechas();
	$usuario = new Usuarios();
	$usuario->db=$db;
	//$categorias->db=$db;
	$idusuario=$_POST['id_user'];
	$usuario->idusuarios=$idusuario;
	$obtenerhijos=$usuario->ObtenerHijos();
	

	$respuesta['respuesta']=$obtenerhijos;
	
	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>