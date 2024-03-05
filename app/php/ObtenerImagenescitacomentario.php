<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Imagencitacomentario.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Fechas.php");

//require_once("clases/class.MovimientoBitacora.php");
/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Imagencitacomentario();
	$f=new Funciones();
	$cita=new Cita();
	$cita->db=$db;	
	$fechas=new Fechas();

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$lo->idcita=$_POST['idcita'];
	$iduser=$_POST['iduser'];
	$tipo=$_POST['tipo'];
	$cita->idcita=$lo->idcita;
	$obtenercita=$cita->ObtenerCita();
	$idusuarios=$obtenercita[0]->idusuarios;


	$lo->idusuarioperfil=$idusuarios;
	$obtenerimagenes=$lo->ObtenerImagenesCitacomentario();


	for ($i=0; $i < count($obtenerimagenes); $i++) { 
		$sepuedeeliminar=0;
			if ($tipo==0) {
			$sepuedeeliminar=1;
	
			}else{

				if ($obtenerimagenes[$i]->idusuarioregistro==$iduser) {
					$sepuedeeliminar=1;

				}


			}
		$obtenerimagenes[$i]->sepuedeeliminar=$sepuedeeliminar;

		$obtenerimagenes[$i]->fechaformato=$fechas->fecha_texto5($obtenerimagenes[$i]->fechacreacion).' '.date('Y',strtotime($obtenerimagenes[$i]->fechacreacion)).' '.date('H:i',strtotime($obtenerimagenes[$i]->fechacreacion)).' Hrs.';

	}

	$respuesta['respuesta']=$obtenerimagenes;
	
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