<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Tarjetalealtad.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.PagConfig.php");
require_once("clases/class.Usuarios.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Tarjetalealtad();
	$f=new Funciones();
	$fechas=new Fechas();
	$config=new PagConfig();
	$config->db=$db;
	$usuarios=new Usuarios();

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$obtenerproductos=[];
	$idusuario=$_POST['idusuario'];
	$idsucursal=$_POST['idsucursal'];
	$obtenervalidaciontarjeta=$config->ObtenerInformacionConfiguracion();
	$habilitartarjetafuncion=$obtenervalidaciontarjeta['habilitartarjetafuncion'];
	

	 $usuarios->db=$db;
     $usuarios->idusuarios=$idusuario;
     $infousuario=$usuarios->ObtenerInformacionUsuario();
     $habilitartarjetausuario=$infousuario[0]->habilitartarjeta;
 
	$lo->idusuario=$idusuario;
	$lo->idsucursal=$idsucursal; 
	$idtarjetalealtadporcanjear=0;
	$asignacion=[];
	
	if ($habilitartarjetafuncion==1 && $habilitartarjetausuario==1) {
		// code...
	
	$obtenerasignada=$lo->ObtenerTarjetasAsignadas();
	
	if (count($obtenerasignada)>0) {
		
		for ($i=0; $i <count($obtenerasignada) ; $i++) { 


			$obtenerasignada[$i]->fechainicial=$fechas->fecha_texto5(date('Y-m-d',strtotime($obtenerasignada[$i]->fechainicial)));

			$obtenerasignada[$i]->fechafinal=$fechas->fecha_texto5(date('Y-m-d',strtotime($obtenerasignada[$i]->fechafinal)));

			if ($obtenerasignada[$i]->cantidadproducto==$obtenerasignada[$i]->cantidadrequerida) {
				
				$idtarjetalealtadporcanjear=$obtenerasignada[$i]->idtarjetalealtad;
				$asignacion=$obtenerasignada[$i];
				break;
			}
		}

	}

	if ($idtarjetalealtadporcanjear!=0) {
		
		$lo->idtarjetalealtad=$idtarjetalealtadporcanjear;
		$obtenerproductos=$lo->ObtenerBeneficiosTarjeta();

		$lo->idtarjetalealtadasignacion=$asignacion->{'idtarjetalealtadasignacion'};


		$tienecanjeenproceso=$lo->VerificarCanje();
		
		if (count($tienecanjeenproceso)>0) {
			$idtarjetalealtadporcanjear=0;
			//tiene un canje en proceso
		}
		

	}


}
	

	$respuesta['respuesta']=$obtenerproductos;
	$respuesta['tarjetalealtad']=$idtarjetalealtadporcanjear;
	$respuesta['asignacion']=$asignacion;
	$respuesta['clientetarjeta']=$infousuario;
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