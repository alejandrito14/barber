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
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Notapago.php");

try
{
	$db= new MySQL();
	$temporalcarrito= new Temporalcarrito();
	$temporalcarrito->db=$db;
	$lo = new Notapago();
    $lo->db    = $db;
    $fechas=new Fechas();


    $idnotapago = $_POST['idnotapago'];


	$lo->idnotapago=$idnotapago;

    $temporalcarrito->idnota=$idnotapago;

    $resultado=$lo->Obtenernota();

	$obtenertemporal=$temporalcarrito->ObtenerTemporalCarrito();

 $codigo=$se->obtenerSesion('codservicio');


    for ($i=0; $i < count($obtenertemporal); $i++) { 
          $fecha=$obtenertemporal[$i]->fechacita;
            $diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fecha))];

            $fechaformato=$diatexto.' '.date('d',strtotime($fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fecha))].' de '.date('Y', strtotime($fecha));

            $obtenertemporal[$i]->fechaformato=$fechaformato;

            $horainicial=$obtenertemporal[$i]->horainicial;
             $horafinal=$obtenertemporal[$i]->horafinal;
            

            if ($horainicial!='' && $horafinal!='') {
               $intervaloservicio=$fechas->diferencia($horainicial,$horafinal);

                $obtenertemporal[$i]->intervaloservicio=$intervaloservicio;
            }

            $obtenertemporal[$i]->ruta='catalogos/paquetes/imagenespaquete/'.$codigo.'/'.$obtenertemporal[$i]->foto;
          
    }

    
  
    $respuesta['respuesta'] = 1;
    $respuesta['pagos']=$obtenertemporal;

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