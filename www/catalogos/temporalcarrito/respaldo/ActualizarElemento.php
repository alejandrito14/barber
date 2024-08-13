<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	/* header("Location: ../login.php"); */ echo "login";
	exit;
}
require_once("../../clases/conexcion.php");

require_once("../../clases/class.Temporalcarrito.php");

try
{
	$db= new MySQL();
	$temporalcarrito= new Temporalcarrito();
	$temporalcarrito->db=$db;

	$idsucursal=$se->obtenerSesion('idsucursalseleccionada');
	$elementos=json_decode($_POST['objeto']);

	$idnota=$_POST['idnotapago'];

	


			
		
		
		$temporalcarrito->idusuarios=0;
        $temporalcarrito->idpaquete=$elementos->idpaquete;
        $temporalcarrito->cantidad=1;

        $temporalcarrito->costounitario=$elementos->costounitario;
		$temporalcarrito->nombrepaquete=$elementos->nombrepaquete;
			/*$costototal=$elementos->precioventa*$elementos->cantidad;
			;*/

         $temporalcarrito->costototal=$elementos->costototal;
         $temporalcarrito->idespecialista=$elementos->idespecialista;
           
         $temporalcarrito->nombrepaquete=$elementos->nombrepaquete;
         $temporalcarrito->idtemporalcarrito=$elementos->idtemporalcarrito;
         $temporalcarrito->fecha=$elementos->fecha;

         $temporalcarrito->intervaloservicio=$elementos->intervaloservicio;


         $temporalcarrito->horainicial=$elementos->horainicial;

		// Minutos a sumar
		$minutos_a_sumar = $elementos->intervaloservicio;
		// Convertir la hora inicial a un timestamp
		$timestamp = strtotime( $temporalcarrito->horainicial);
		// Sumar los minutos al timestamp
		$timestamp += $minutos_a_sumar * 60; // Multiplicamos por 60 para convertir los minutos a segundos
		// Formatear el nuevo timestamp como hora en formato "HH:MM"
		$hora_final = date("H:i", $timestamp);

		$temporalcarrito->horafinal=$hora_final;

		 $temporalcarrito->EdicionTemporalCarrito();

	


	$respuesta['respuesta'] = 1;

   //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;

} catch (Exception $e) {
    //$db->rollback();
    //echo "Error. ".$e;

    $array->resultado = "Error: " . $e;
    $array->msg       = "Error al ejecutar el php";
    $array->id        = '0';
    //Retornamos en formato JSON
    $myJSON = json_encode($array);
    echo $myJSON;
}
 ?>