<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

 
if(!isset($_SESSION['se_SAS']))
{
	//header("Location: ../login.php");
	echo "login";
	exit;
}

require_once("../../clases/conexcion.php");

require_once("../../clases/class.Cita.php");

require_once("../../clases/class.Categoriaspaquete.php");

$codigo=$_SESSION['codservicio'];
	try {

		$db = new MySQL();

		$categorias = new Categoriaspaquete();
		$categorias->db=$db;
		

		$obtenercategorias=$categorias->ObtenerTodasCategorias();

	

		$respuesta['categoriaspaquete']=$obtenercategorias;

		$myJSON = json_encode($respuesta);
		echo $myJSON;
	

		
	} catch (Exception $e) {
		

	echo "Error. ".$e;
	}






?>