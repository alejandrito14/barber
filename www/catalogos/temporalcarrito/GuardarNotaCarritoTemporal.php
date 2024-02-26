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
require_once "../../clases/class.Cita.php";
require_once "../../clases/class.Notapago.php";
require_once "../../clases/class.Fechas.php";

try
{
	$db= new MySQL();
	$temporalcarrito= new Temporalcarrito();
	$temporalcarrito->db=$db;

	$temporalcarrito->db=$db;
	$notapago = new Notapago();
    $notapago->db    = $db;
    $fechas=new Fechas();
    $cita=new Cita();
    $cita->db=$db;

    $idusuariomodifica=$se->obtenerSesion('se_sas_Usuario');
    $fechamodifica=date('Y-m-d H:i:s');
    $idnotapago = $_POST['idnotapago'];
	$notapago->idnotapago=$idnotapago;

    $temporalcarrito->idnota=$idnotapago;

    $resultado=$notapago->Obtenernota();

	$obtenertemporal=$temporalcarrito->ObtenerTemporalCarrito();
	$subtotalsincomision=0;
	for ($i=0; $i < count($obtenertemporal); $i++) { 
		$cita->idcita=0;
		$tipo=0;
		
		if ($obtenertemporal[$i]->idnotadescripcion!='') {
			$tipo=1;
			  $cita->idusuario=$resultado[0]->idusuario;
                $cita->idcita=$obtenertemporal[$i]->idcitaapartada;

                $obtenerapartada=$cita->ObtenerdetallecitaAdmin();

                $cita->horacita=$obtenertemporal[$i]->horainicial;
                $cita->fechacita=$obtenertemporal[$i]->fechacita;
                $cita->estatus=0;
                
                $cita->idusuarios=$resultado[0]->idusuario;
                $cita->idespecialista=$obtenertemporal[$i]->idespecialista;

                $cita->horainicial=$obtenertemporal[$i]->horainicial;

                $cita->horafinal=$obtenertemporal[$i]->horafinal;


                $cita->idsucursal=$obtenertemporal[$i]->idsucursal;

                $idsucursal=$obtenertemporal[$i]->idsucursal;

                $cita->idpaquete=$obtenertemporal[$i]->idpaquete;
                $cita->costo=$obtenertemporal[$i]->costototal;
                $cita->idcortesia=0;
                $cita->horainicials='';
                $cita->horafinals='';


			 
              if ($obtenertemporal[$i]->idcitaapartada>0) {
           
                $cita->ActualizarCitaTemp();
                

            }else{
            	 $cita->idcita=0;
            	$cita->GuardarCita();
            }



             if ($obtenertemporal[$i]->tarjetaregalo==1) {
               $tipo=2;
             }
          


              
              
              $notapago->descripcion=$obtenertemporal[$i]->nombrepaquete;
              $notapago->cantidad=$obtenertemporal[$i]->cantidad;
              $notapago->monto=$obtenertemporal[$i]->costototal;
              $notapago->idpaquete=$obtenertemporal[$i]->idpaquete;
              $notapago->idcita=$cita->idcita;
              $notapago->costounitario=$obtenertemporal[$i]->costounitario;
               $notapago->tipo=$tipo;
               $notapago->idnotapago=$idnotapago;
               $notapago->monederoaplicado=0;

               $notapago->idcupon=0;
               $notapago->codigocupon=0;
               $notapago->montocupon=0;
               $notapago->idnotapagodescripcion=$obtenertemporal[$i]->idnotadescripcion;

               $notapago->ActualizarNotadescripcion();

		}else{


			if ($obtenertemporal[$i]->servicio==1) {
				$tipo=1;
				 $cita->horacita=$obtenertemporal[$i]->horainicial;
                $cita->fechacita=$obtenertemporal[$i]->fechacita;
                $cita->estatus=0;
                
                $cita->idusuarios=$resultado[0]->idusuario;
                $cita->idespecialista=$obtenertemporal[$i]->idespecialista;

                $cita->horainicial=$obtenertemporal[$i]->horainicial;

                $cita->horafinal=$obtenertemporal[$i]->horafinal;


                $cita->idsucursal=$obtenertemporal[$i]->idsucursal;

                $idsucursal=$obtenertemporal[$i]->idsucursal;

                $cita->idpaquete=$obtenertemporal[$i]->idpaquete;
                $cita->costo=$obtenertemporal[$i]->costototal;
                $cita->idcortesia=0;
                $cita->horainicials='';
                $cita->horafinals='';

            	$cita->CitaCreada();


			}


			$notapago->idcarrito=0;
              $notapago->descripcion=$obtenertemporal[$i]->nombrepaquete;
              $notapago->cantidad=$obtenertemporal[$i]->cantidad;
              $notapago->monto=$obtenertemporal[$i]->costototal;
              $notapago->idpaquete=$obtenertemporal[$i]->idpaquete;
              $notapago->idcita=$cita->idcita;
              $notapago->costounitario=$obtenertemporal[$i]->costounitario;
               $notapago->tipo=$tipo;
               $notapago->idnotapago=$idnotapago;
               $notapago->monederoaplicado=0;
               $notapago->idcupon=0;
               $notapago->codigocupon=0;
               $notapago->montocupon=0;
               $notapago->Creardescripcionpago();








		}



		 $subtotalsincomision=$subtotalsincomision+$obtenertemporal[$i]->costototal;
	}

			  $notapago->subtotal=$subtotalsincomision;
              $notapago->iva=0;
              $notapago->total=$subtotalsincomision;
				$notapago->comisiontotal=0;
				$notapago->montomonedero=0;
				$notapago->estatus=0;
				$notapago->idpagostripe=0;
				$notapago->descuento=0;
				$notapago->descuentomembresia=0;


             $notapago->ActualizarNotapago();




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