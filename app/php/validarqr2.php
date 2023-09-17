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

	


	//Enviamos la conexion a la clase
	$lo->db = $db;
	$logFile = fopen("log.txt", 'a') or die("Error creando archivo");

	$textqr = json_decode($_POST['textqr']);
	$iduser=$_POST['id_user'];
	
	//fwrite($logFile, "\n".date("d/m/Y H:i:s")." recibiendo".$textqr) or die("Error escribiendo en el archivo");
	//fwrite($logFile, "\n".date("d/m/Y H:i:s")." cadena a des ".$textqr[0]) or die("Error escribiendo en el archivo");

	$cadenareplace=str_replace(' ','+',$textqr[0]);

	//fwrite($logFile, "\n".date("d/m/Y H:i:s")." nueva cadena a des ".$cadenareplace) or die("Error escribiendo en el archivo");

	$cadenaencrip=$f->decrypt($cadenareplace,'ISSINVERSA');

	
	fwrite($logFile, "\n".date("d/m/Y H:i:s")." cadena encr ".$cadenaencrip) or die("Error escribiendo en el archivo");

	$cadena=explode('|',$cadenaencrip);

	$idcita=$cadena[0];
	$idusuario=$cadena[1];
	$usuario=$cadena[2];
	$nombreusuario=$cadena[3];
	$paterno=$cadena[4];
	$materno=$cadena[5];
	$fechagenerado=$cadena[6];

	$cita->idcita=$idcita;
	$obtenercita=$cita->ObtenerdetallecitaAdmin();

	$idsucursal=$obtenercita[0]->idsucursal;
	$especialista->idusuarios=$iduser;
	$obtenerespecialista=$especialista->ObtenerIdEspecialista();

	$cita->idespecialista=$obtenerespecialista[0]->idespecialista;
	$obtenercita=$cita->ObtenerCitaEspecialista();


	$validado=1;
	//if ($iduser==$idusuario) {
		$qrgenerados->idusuarios=$idusuario;
		$qrgenerados->idcita=$idcita;
		$qrgenerados->qrgenerado=$cadenareplace;

		//fwrite($logFile, "\n".date("d/m/Y H:i:s")." cadena encr ".$qrgenerados->idusuarios.'-'.$qrgenerados->idcita.'- '.$qrgenerados->qrgenerado) or die("Error escribiendo en el archivo");
		$validado=0;
		
		if (count($obtenercita)>0) {
			# code...
		
		$consultarqr=$qrgenerados->ConsultarQrUsuario();

		$idsucursal=0;

		
			# code...
		
		if (count($consultarqr)>0) {
			$validado=1;

			//fwrite($logFile, "\n".date("d/m/Y H:i:s")." valida ".$validado) or die("Error escribiendo en el archivo");


			$cita->qrgenerado=$consultarqr[0]->idqrgenerado;
			$cita->idusuarios=$idusuario;
			$cita->idcita=$idcita;
			$cita->idusuariockeckin=$iduser;


			$cita->ActualizarcitaQr();

			$idqrgenerado=$consultarqr[0]->idqrgenerado;
			$qrgenerados->ActualizarEstatusqr($idqrgenerado);


	$cita->idusuario=$idusuario;
	$obtenerdetallecita=$cita->Obtenerdetallecita();
	$obtenerdetallecita[0]->fecha=date('d-m-Y',strtotime($obtenerdetallecita[0]->fechacita));

	 $obtenerdetallecita[0]->fechaformato=$fechas->fecha_texto5($obtenerdetallecita[0]->fechacita);


     $paquetes->idpaquete=$obtenerdetallecita[0]->idpaquete;
     $obtenerpaquete=$paquetes->ObtenerPaquete2();
     $obtenerdetallecita[0]->precioante=0;

            if ($obtenerpaquete[0]->promocion==1) {
                $obtenerdetallecita[0]->precioante=$obtenerpaquete[0]->precioventa;

            }	





		}else{

			$validado=0;
		}
	}else{
		$validado=0;
	}

	

	
    $db->commit();

	$respuesta['validado']=$validado;
	$respuesta['idusuario']=$idusuario;
	$respuesta['cita']=$cita->idcita;
	$respuesta['detallecita']=$obtenerdetallecita;
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