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
require_once('../../clases/class.Fechas.php');


try
{
	$db= new MySQL();
	$tarjetalealtad= new Tarjetalealtad();
	$f=new Funciones();
	$tarjetalealtad->db=$db;
	$fechas= new Fechas();


	$idtarjetalealtad=$_POST['idtarjetalealtad'];
	$tarjetalealtad->idtarjetalealtad=$idtarjetalealtad;

	$tarjetas=$tarjetalealtad->ObtenerUsuariosConTarjetaVisitas();
	

	for ($i=0; $i <count($tarjetas) ; $i++) { 
		
		$tarjetas[$i]->fechacompra=$fechas->fecha_texto5($tarjetas[$i]->fechacompra);

		$tarjetalealtad->idusuario=$tarjetas[$i]->idusuarios;
		$obtenercitasasigna=$tarjetalealtad->CitasAsignacion();

		$tarjetas[$i]->citasasignadas=$obtenercitasasigna;
		
	}



	$respuesta['tarjetas']=$tarjetas;
	echo json_encode($respuesta);
	
}
catch(Exception $e)
{
	$db->rollback();
	  
	  
}
?>