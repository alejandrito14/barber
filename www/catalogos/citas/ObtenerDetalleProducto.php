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

require_once("../../clases/class.Paquetes.php");


	$codigo=$_SESSION['codservicio'];
	try {

		$db = new MySQL();

		$paquetes = new Paquetes();
		$paquetes->db=$db;
		$paquetes->idpaquete=$_POST['idpaquete'];	

		$obtenerpaquetes=$paquetes->ObtenerDatosPaquete();

		 $foto=$obtenerpaquetes[0]->foto;
                $ruta="";
                if ($foto!='') {
                    $ruta="./catalogos/paquetes/imagenespaquete/".$codigo."/".$foto;
                }

		$obtenerpaquetes[0]->ruta=$ruta;
		$respuesta['respuesta']=$obtenerpaquetes;

		$myJSON = json_encode($respuesta);
		echo $myJSON;
	

		
	} catch (Exception $e) {
		

	echo "Error. ".$e;
	}






?>