<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Especialista.php");

//require_once("clases/class.MovimientoBitacora.php");
/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$f=new Funciones();
	$fechas = new Fechas();
	$especialista=new Especialista();
	$especialista->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;
	$fechafiltro="";

	/*if (isset($_POST['hoy'])) {

		if ($_POST['hoy']==1) {
			$fechafiltro=date('Y-m-d');
		}
		
	}*/

	if (isset($_POST['fechafiltro'])) {
		$fechafiltro=$_POST['fechafiltro'];
	}

	$lo->estatus=$_POST['estatus'];
	$lo->idusuarios=$_POST['idusuarios'];

	$fechactual=date('Y-m-d');
		
		if ($fechafiltro=='') {
			$fechafiltro=$fechactual;
		}

	$obtenertablero=$lo->ObtenerCitasUsuarioFiltro($fechafiltro);

	if (count($obtenertablero)>0) {
		for ($i=0; $i < count($obtenertablero); $i++) { 
			$fechacita=$obtenertablero[$i]->fechacita;
			$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fechacita))];

			$fechaformato=$diatexto.' '.date('d',strtotime($fechacita)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fechacita))].' de '.date('Y', strtotime($fechacita));


			$obtenertablero[$i]->fechaformato=$fechaformato;

			$fecha=date('d/m/Y',strtotime($obtenertablero[$i]->fechacita));

			
				$porpasar=0;
			if (date('Y-m-d',strtotime($obtenertablero[$i]->fechacita))>=date('Y-m-d',strtotime($fechactual))){
					
						$porpasar=1;
				
				}

			$obtenertablero[$i]->anio='';
			$obtenertablero[$i]->fechacita=$fecha;


			$obtenertablero[$i]->porpasar=$porpasar;
		}
	}


	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fechafiltro))];

	$fechaformato=$diatexto.' '.date('d',strtotime($fechafiltro)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fechafiltro))].' de '.date('Y', strtotime($fechafiltro));


	$respuesta['respuesta']=$obtenertablero;
	$respuesta['fechafiltro']=$fechaformato;
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