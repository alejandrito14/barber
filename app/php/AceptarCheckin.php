<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Usuarios.php");
require_once("clases/class.Funciones.php");
/*require_once("clases/class.MovimientoBitacora.php");
*/require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Sucursal.php");
require_once("clases/class.NotificacionPush.php");
require_once("clases/class.Qrgenerados.php");
require_once("clases/class.Especialista.php");

require_once("clases/class.Fechas.php");

require_once("clases/class.Paquetes.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Usuarios();
	$f=new Funciones();
	$cita = new Cita();
	$cita->db=$db;
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$notifica=new NotificacionPush();
	$notifica->db=$db;
	$qrgenerados=new Qrgenerados();
	$qrgenerados->db=$db;
	$especialista=new Especialista();
	$especialista->db=$db;

	$fechas = new Fechas();
	$paquetes = new Paquetes();
	$paquetes->db = $db;
	$db->begin();

	$idcita=$_POST['idcita'];
	$iduser=$_POST['iduser'];
	$cita->idcita=$idcita;
	$obtenercita=$cita->ObtenerdetallecitaAdmin();

	$idsucursal=$obtenercita[0]->idsucursal;
	$especialista->idusuarios=$iduser;
	$obtenerespecialista=$especialista->ObtenerIdEspecialista();

	$cita->idespecialista=$obtenerespecialista[0]->idespecialista;
	$obtenercita=$cita->ObtenerCitaEspecialista();
	$fechacita=date('Y-m-d',strtotime($obtenercita[0]->fechacita));
	$horainicial=date('H:i',strtotime($obtenercita[0]->horacita));
	$horafinal=date('H:i',strtotime($obtenercita[0]->horafinal));
	$fechaactual=date('Y-m-d');
	$horactual=date('H:i');
	$pasa=0;
	if ($fechaactual==$fechacita) {
		$pasa=1;
			
		if ($horactual>=$horainicial && $horactual<=$horafinal) {
				$pasa=1;
			}else{
				$pasa=0;
			}
	
	}else{
		$pasa=0;
	}

	
	$validado=1;

	if (count($obtenercita)>0) {
	if ($pasa==1) {
		# code...
	
	//if ($iduser==$idusuario) {
		$qrgenerados->idusuarios=$idusuario;
		$qrgenerados->idcita=$idcita;
		$qrgenerados->qrgenerado=$cadenareplace;

		//fwrite($logFile, "\n".date("d/m/Y H:i:s")." cadena encr ".$qrgenerados->idusuarios.'-'.$qrgenerados->idcita.'- '.$qrgenerados->qrgenerado) or die("Error escribiendo en el archivo");
		$validado=0;
		
		if (count($obtenercita)>0) {
			# code...
		
		$consultarqr=1;

		$idsucursal=0;

		
			# code...
		
		if ($consultarqr==1) {
			$validado=1;

			//fwrite($logFile, "\n".date("d/m/Y H:i:s")." valida ".$validado) or die("Error escribiendo en el archivo");


			$cita->qrgenerado=$consultarqr[0]->idqrgenerado;
			$cita->idusuarios=$idusuario;
			$cita->idcita=$idcita;
			$cita->idusuariocheckin=$iduser;


			$cita->ActualizarcitaChe();

			$idqrgenerado=$consultarqr[0]->idqrgenerado;
			//$qrgenerados->ActualizarEstatusqr($idqrgenerado);


	
	$obtenercita[0]->fecha=date('d-m-Y',strtotime($obtenercita[0]->fechacita));

	 $obtenercita[0]->fechaformato=$fechas->fecha_texto5($obtenercita[0]->fechacita);


     $paquetes->idpaquete=$obtenercita[0]->idpaquete;
     $obtenerpaquete=$paquetes->ObtenerPaquete2();
     $obtenercita[0]->precioante=0;

            if ($obtenerpaquete[0]->promocion==1) {
                $obtenercita[0]->precioante=$obtenerpaquete[0]->precioventa;

            }	





			}else{

				$validado=0;
			}
		}else{
			$validado=0;
		}

	}else{

		$validado=2;
	}
	
	}else{


		$validado=0;
	}

	
    $db->commit();

	$respuesta['validado']=$validado;
	$respuesta['idusuario']=$idusuario;
	$respuesta['cita']=$cita->idcita;
	$respuesta['detallecita']=$obtenercita;
	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	echo $myJSON;

}catch(Exception $e){
	//$db->rollback();
	//echo "Error. ".$e;
	
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}
?>