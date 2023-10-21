<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

$idmenumodulo = $_GET['idmenumodulo'];

if(!isset($_SESSION['se_SAS']))
{
	//header("Location: ../login.php");
    echo "login";
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sucursal.php");
require_once('../../clases/class.Funciones.php');


try
{
	$db= new MySQL();
	$cli= new Sucursal();
	$f=new Funciones();
	$cli->db=$db;
	
	$sucursales=$cli->ObtenerTodosSucursales();
	$respuesta['sucursales']=$sucursales;
	echo json_encode($respuesta);
	
}
catch(Exception $e)
{
	$db->rollback();
	     $v = explode ('|',$e);

		// echo $v[1];

	     $n = explode ("'",$v[1]);

		 $n[0];

		 echo $db->m_error($n[0]);	
}
?>