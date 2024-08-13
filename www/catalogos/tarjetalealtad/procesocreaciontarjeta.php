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

	$obtenertarjetas=$tarjetalealtad->ObtenerTarjetalealtad();

	for ($i=0; $i < count($obtenertarjetas); $i++) { 
		
		$tarjetalealtad->idtarjetalealtad=$obtenertarjetas[$i]->idtarjetalealtad;
		$obtenerproductosconfitarjeta=$tarjetalealtad->ObtenerProductosTarjeta();

		if ($obtenertarjetas[$i]->todoscliente==1) {
			

			}else{

		 $obtenerclientesconfitarjeta=$tarjetalealtad->ObtenerClienteTarjeta();

		}

	}



	$respuesta['clientes']=$clientes;
	echo json_encode($respuesta);
	
}
catch(Exception $e)
{
	$db->rollback();
	  

}
?>