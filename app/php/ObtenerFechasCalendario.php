<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Sucursal.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Paquetes();
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal = new Sucursal();

	//Enviamos la conexion a la clase
	$lo->db = $db;


	$idpaquete=$_POST['idpaquete'];

	$idsucursal=$_POST['idsucursal'];
	$idespecialista=$_POST['idespecialista'];
	$mes=$_POST['mes'];
	$anio=$_POST['anio'];

    $primerdia= date('Y-m-d', mktime(0,0,0, $mes, 1, $anio));
     $day = date("d", mktime(0,0,0, $mes+1, 0, $anio));
 
    $ultimodia=date('Y-m-d', mktime(0,0,0, $mes, $day, $anio));

    $fechainicio=strtotime($primerdia);
    $fechafin=strtotime($ultimodia);

    $arraydisponible=array();

    $sucursal->idsucursal=$idsucursal;
	$obtenerzonaho=$sucursal->ObtenerHorarios();

	$intervaloshorarios=array();
	for ($i=0; $i < count($obtenerzonaho); $i++) { 
		$dia=$obtenerzonaho[$i]->dia;
		$horainicial=new DateTime($obtenerzonaho[$i]->horainicial);
		$horafinal=new Datetime($obtenerzonaho[$i]->horafinal);

		
		 $array=array();
		 $intervaloshorarios[$i]=array('dia'=>$dia,'horas'=>$array);
		 
		 $intervalos=$fechas->intervaloHora($obtenerzonaho[$i]->horainicial,$obtenerzonaho[$i]->horafinal,$row['intervalo']);
	
		 array_push($intervaloshorarios[$i]["horas"], $intervalos);
	}


    for($i=$fechainicio; $i<=$fechafin; $i+=86400){

    	$fechaconsulta=date("Y-m-d", $i);

    	$verificardisponibilidad=
		   


		}


	//echo $mes;
	
	$respuesta['respuesta']=1;
	
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