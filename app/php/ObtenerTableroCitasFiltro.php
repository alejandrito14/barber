<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Especialista.php");
require_once("clases/class.Usuarios.php");

	
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
	$iduser=$_POST['idusuarios'];
	$lo->estatus=$_POST['estatus'];
	$lo->idusuarios=$iduser;

	$fechactual=date('Y-m-d');
		
		if ($fechafiltro=='') {
			$fechafiltro=$fechactual;
		}

	$usuarios=new Usuarios();
	$usuarios->db=$db;
	$usuarios->idusuarios=$iduser;
	$obtenerhijos=$usuarios->ObtenerHijos();
	$idusuario=$iduser;
	for ($i=0; $i < count($obtenerhijos); $i++) { 
		$idusuario.=','.$obtenerhijos[$i]->idusuarios;
	}
	$lo->idusuarios=$idusuario;
	

	$obtenertablero=$lo->ObtenerCitasUsuarioFiltro($fechafiltro);
$estatus=array('Pendiente','En proceso','Completado','Cancelado','Caducado');
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


			$fechachekin=date('H:i:s',strtotime($obtenertablero[$i]->fechacheckin));
			$fechachekout=date('H:i:s',strtotime($obtenertablero[$i]->finalizacita));;

			$obtenertablero[$i]->fechachekin=$fechachekin;
			$obtenertablero[$i]->fechachekout=$fechachekout;


if ($obtenertablero[$i]->estatus==0  ) {
				$est=0;
		$obtenertablero[$i]->estatuscita=0;
			}
			
if ($obtenertablero[$i]->estatus==1 && $obtenertablero[$i]->checkin==1 && $obtenertablero[$i]->checkout==0 ) {
				$est=1;
				$obtenertablero[$i]->estatuscita=1;
			}
			
			
    	if( $obtenertablero[$i]->estatus==4) {

				$est=4;
				$obtenertablero[$i]->estatuscita=4;
			}



			if ($obtenertablero[$i]->estatus==2 && $obtenertablero[$i]->checkin==1 && $obtenertablero[$i]->checkout==1 ) {
				$est=2;
				$obtenertablero[$i]->estatuscita=2;
			}

			if ($obtenertablero[$i]->estatus==3 && $obtenertablero[$i]->checkin==0 && $obtenertablero[$i]->checkout==0 ) {
				$est=3;
				$obtenertablero[$i]->estatuscita=3;
			}


			if ($obtenertablero[$i]->estatus==4) {

				$est=4;
				$obtenertablero[$i]->estatuscita=4;
			}

			$obtenertablero[$i]->textoestatus=$estatus[$est];
			

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