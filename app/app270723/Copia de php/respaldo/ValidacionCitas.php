<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Cita.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Carrito();
	$f=new Funciones();
	$fechas=new Fechas();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	$cita=new Cita();
	$cita->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;


	//$idcategoria=$_POST['idcategoria'];
	$iduser=$_POST['id_user'];
	$lo->idusuarios=$iduser;
	$obtenercarrito=$lo->ObtenerCarrito();
	$citasapartada=0;
	$totalcarrito=0;
	for ($i=0; $i < count($obtenercarrito); $i++) { 
		    $totalcarrito=$totalcarrito+$obtenercarrito[$i]->costototal;
			$fechacita=date('Y-m-d',strtotime($obtenercarrito[$i]->fecha));
			$obtenercarrito[$i]->fechaformato=$fechas->fecha_texto5($fechacita).' '.$obtenercarrito[$i]->horainicial.'Hrs.';
			$paquetes->idpaquete=$obtenercarrito[$i]->idpaquete;
			$obtenerpaquete=$paquetes->ObtenerPaquete2();
			$obtenercarrito[$i]->precioante=0;

			if ($obtenerpaquete[0]->promocion==1) {
				$obtenercarrito[$i]->precioante=$obtenerpaquete[0]->precioventa;
			
			}

			if ($obtenercarrito[$i]->idcitaapartada!='') {

				$cita->idcitaapartado=$obtenercarrito[$i]->idcitaapartada;
				$cita->idusuario=$iduser;
				$obtenerdetallecita=$cita->ObtenerCitaCreada();

				$cita->horainicial=$obtenerdetallecita[$i]->horainicial;
				$cita->horafinal=$obtenerdetallecita[$i]->horafinal;
				$cita->idespecialista=$obtenerdetallecita[$i]->idespecialista;
				$existecita=$cita->ChecarHorarioEspecialista();

				if (count($existecita)>0) {
					$citasapartada++;
				}


			}
			
	}


	
	$respuesta['respuesta']=$obtenercarrito;
	$respuesta['citasapartada']=$citasapartada;
	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	echo $myJSON;die();

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