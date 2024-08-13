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
 $db->begin();
$idsucursal=$se->obtenerSesion('idsucursalseleccionada');
$elementos=json_decode($_POST['elementos']);
$valoredicion=$_POST['valoredicion'];
$idnota=$_POST['idnotapago'];

	for ($i=0; $i <count($elementos) ; $i++) { 


		$temporalcarrito->idsucursal=$elementos[$i]->idsucursal;

		if ($elementos[$i]->servicio==1) {
			for ($j=0; $j <$elementos[$i]->cantidad ; $j++) { 
					# code...
				
			
		if ($i==0 && $j==0) {
			
				# code...
			
			$temporalcarrito->idtemporalcarrito=$valoredicion;
			$temporalcarrito->idpaquete=$elementos[$i]->idpaquete;
			$temporalcarrito->nombrepaquete=$elementos[$i]->nombrepaquete;
			$temporalcarrito->costounitario=$elementos[$i]->precioventa;

			
			$temporalcarrito->cantidad=1;

			$costototal=$elementos[$i]->precioventa*$elementos[$i]->cantidad;
			$temporalcarrito->costototal=$costototal;

			$temporalcarrito->idcita=0;

            $temporalcarrito->nombrepaquete=$elementos[$i]->concepto;

            $temporalcarrito->titulosgrupos='';

            $temporalcarrito->idnota=$idnota;

			if ($valoredicion>0) {
			$temporalcarrito->Ediciontemporal();

			

				}else{



				$temporalcarrito->AgregarTemporalCarrito();
				}

		}

		if ($i!=0) {
			

			$temporalcarrito->idusuarios=0;
            $temporalcarrito->idpaquete=$elementos[$i]->idpaquete;
            $temporalcarrito->cantidad=1;

            $temporalcarrito->costounitario=$elementos[$i]->precioventa;

			$costototal=$elementos[$i]->precioventa*$elementos[$i]->cantidad;
			$temporalcarrito->costototal=$costototal;

            $temporalcarrito->idsucursal=$elementos[$i]->idsucursal;
            $temporalcarrito->idespecialista=$elementos[$i]->idespecialista;
            
            $temporalcarrito->idcita=0;
           
            $temporalcarrito->nombrepaquete=$elementos[$i]->concepto;

            $temporalcarrito->titulosgrupos='';

            $temporalcarrito->idnota=$idnota;
           // $temporalcarrito->idnotadescripcion=$obtenerpagosstripe[$i]->idnotapago_descripcion;
            $temporalcarrito->AgregarTemporalCarrito();
		}

		}
	}else{


			 $temporalcarrito->idusuarios=0;
            $temporalcarrito->idpaquete=$elementos[$i]->idpaquete;
            $temporalcarrito->cantidad=1;

            $temporalcarrito->costounitario=$elementos[$i]->precioventa;

			$costototal=$elementos[$i]->precioventa*$elementos[$i]->cantidad;
			$temporalcarrito->costototal=$costototal;

            $temporalcarrito->idsucursal=$elementos[$i]->idsucursal;
            $temporalcarrito->idespecialista=$elementos[$i]->idespecialista;
            
            $temporalcarrito->idcita=0;
           
            $temporalcarrito->nombrepaquete=$elementos[$i]->concepto;

            $temporalcarrito->titulosgrupos='';

            $temporalcarrito->idnota=$idnota;

		  $temporalcarrito->AgregarTemporalCarrito();

	}
}
  $db->commit();

	$respuesta['respuesta'] = 1;

   //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;

} catch (Exception $e) {
    $db->rollback();
    //echo "Error. ".$e;

    $array->resultado = "Error: " . $e;
    $array->msg       = "Error al ejecutar el php";
    $array->id        = '0';
    //Retornamos en formato JSON
    $myJSON = json_encode($array);
    echo $myJSON;
}
 ?>