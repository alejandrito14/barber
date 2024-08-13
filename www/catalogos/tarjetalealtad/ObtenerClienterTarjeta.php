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
require_once("../../clases/class.Tarjetalealtad.php");
require_once('../../clases/class.Funciones.php');


try
{
	$db= new MySQL();
	$tarjetalealtad= new Tarjetalealtad();
	$f=new Funciones();
	$tarjetalealtad->db=$db;

	$idtarjetalealtad=$_POST['idtarjetalealtad'];
	$tarjetalealtad->idtarjetalealtad=$idtarjetalealtad;

	$clientes=$tarjetalealtad->ObtenerClienteTarjeta();
	




	$respuesta['clientes']=$clientes;
	echo json_encode($respuesta);
	
}
catch(Exception $e)
{
	$db->rollback();
	  

}
?>