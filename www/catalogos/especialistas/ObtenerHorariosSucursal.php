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
require_once('../../clases/class.HorariosEspecialista.php');


try
{
	$db= new MySQL();
	$cli= new Sucursal();
	$f=new Funciones();
	$cli->db=$db;
	$horariosespecialista=new HorariosEspecialista();
	$horariosespecialista->db=$db;

	$idusuarios=$_POST['idusuarios'];
	$cli->idusuario=$idusuarios;
	$obtenerespecialistasucursales=$cli->ObtenerEspecialistasucursal();
	$todassucursales=$cli->ObtenerSucursalesLista();

	if (count($obtenerespecialistasucursales)>0) {
		for ($i=0; $i <count($obtenerespecialistasucursales) ; $i++) { 
			
			$horariosespecialista->idespecialista=$obtenerespecialistasucursales[$i]->idespecialista;
			$horariosespecialista->idsucursal=$obtenerespecialistasucursales[$i]->idsucursal;


			$obtenerhorarios=$horariosespecialista->ObtenerHorariosEspecialista();

			$obtenerespecialistasucursales[$i]->horarios=$obtenerhorarios;
		}
	}
	$respuesta['sucursales']=$obtenerespecialistasucursales;
	$respuesta['todassucursales']=$todassucursales;
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