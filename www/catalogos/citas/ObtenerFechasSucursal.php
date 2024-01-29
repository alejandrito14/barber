<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Paquetes.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Sucursal.php");
require_once("../../clases/class.HorariosSucursal.php");
require_once("../../clases/class.Especialista.php");
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

	$horariossucursal = new HorariosSucursal();
	$horariossucursal->db=$db;
	$especialista = new Especialista();
	$especialista->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;
	$sucursal->db=$db;

	$idusuarios=$_POST['iduser'];
	$especialista->idusuarios=$idusuarios;
	$idsucursal=$_POST['idsucursal'];
	$idespecialista=$_POST['idespecialista'];
	
	$mes=$_POST['mes'];
	$anio=$_POST['anio'];

	$lo->idespecialista=$idespecialista;
	$lo->idsucursal=$idsucursal;

	$especialista->idespecialista=$idespecialista;
	$especialista->idsucursal=$idsucursal;

	$horariossucursal->idsucursal=$idsucursal;
	$obtenerzonaho=$horariossucursal->ObtenerTodosHorariosSucursal();
	

	$obtener=$lo->ObtenerPaquetesIntervalos();


	
	for($j=0; $j <count($obtener); $j++) { 
		# code...
	
	
	$intervalo=$obtener[$j]->intervaloservicio;


	 $primerdiames= date('Y-m-d', mktime(0,0,0, $mes, 1, $anio));



    $primerdia= date('Y-m-d');
     $day = date("d", mktime(0,0,0, $mes+1, 0, $anio));

     $nodisponible=[];

     $primerdiaresta=date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
     //fechas anteriores
      /*for($i=strtotime($primerdiames); $i<=strtotime($primerdiaresta); $i+=86400){
      	  $fechaconsulta=date("Y-m-d", $i);

      array_push($nodisponible,$fechaconsulta);
      }*/


 
    $ultimodia=date('Y-m-d', mktime(0,0,0, $mes, $day, $anio));

  
    $fechainicio=strtotime($primerdia);
    $fechafin=strtotime($ultimodia);

    $arraydisponible=array();

    
	$intervaloshorarios=array();
	for ($i=0; $i < count($obtenerzonaho); $i++) { 
		$dia=$obtenerzonaho[$i]->dia;
		$horainicial=new DateTime($obtenerzonaho[$i]->horainicial);
		$horafinal=new Datetime($obtenerzonaho[$i]->horafinal);

		
		 $array=array();
		 $intervaloshorarios[$i]=array('dia'=>$dia,'horas'=>$array);
		 
		 $intervalos=$fechas->intervaloHora($obtenerzonaho[$i]->horainicial,$obtenerzonaho[$i]->horafinal,$intervalo);
		 $conta=0;
		 for ($k=0; $k <count($intervalos) ; $k++) { 
		 	$horainicio=$intervalos[$k];

		 	$canti=count($intervalos)-1;

		 	$horafin="";
		 	if ($conta<$canti) {
		 		$horafin=$intervalos[$k+1];
		 	
		 		$objetoh=array('horainicial'=>$horainicio,'horafinal'=>$horafin,'disponible'=>0);
		 		array_push( $intervaloshorarios[$i]['horas'], $objetoh);

		 	}

		 	$conta++;
		 }
	
		
	}
}

	
	$integrandointervalos=[];
	$especialista->idsucursal=$idsucursal;
	$especialista->idpaquete=$idpaquete;
	
	//var_dump($intervaloshorarios);die();
	/*for ($k=0; $k < count($arrayintervalos[0]); $k++) { 
			
				$value=$k+1;
				if ($value<count($arrayintervalos[0])) {
					
					$horainicial=substr($arrayintervalos[0][$k],0,5);
					var_dump($horainicial);die();
					$horafinal=substr($arrayintervalos[0][$k+1],0,5);

					$horariossucursal->horainicial=$horainicial;
					$horariossucursal->horafinal=$horafinal;
					$verificar=$horariossucursal->VerificarHorario();
					$disponible=1;
						if (count($verificar)>0) {
							$disponible=0;
						}


					$objeto=array('horainicial'=>$horainicial,'horafinal'=>$horafinal,'disponible'=>$disponible);


					array_push($integrandointervalos, $objeto);


				}

		}
*/
		//var_dump($integrandointervalos);die();
	$arrayfechasdisponibles=[];
    for($i=$fechainicio; $i<=$fechafin; $i+=86400){

    	$fechaconsulta=date("Y-m-d", $i);
    	//$verificardisponibilidad=
		 $dia_semana = date("w", strtotime($fechaconsulta)); 

		 	$intervalodia=$sucursal->Buscardia($intervaloshorarios,$dia_semana);
		
		 	if (count($intervalodia)>0) {

		 		$buscarintervalodia=$intervalodia['horas'];

		 		for ($j=0; $j < count($buscarintervalodia); $j++) { 


		 			$especialista->fecha=$fechaconsulta;
		 			$especialista->horainicial=substr($buscarintervalodia[$j]['horainicial'],0,5);
		 			$especialista->horafinal=substr($buscarintervalodia[$j]['horafinal'],0,5);

		 			$minutoAnadir=1;
				$segundos_horaInicial=strtotime($horafinal);
				$segundos_minutoAnadir=$minutoAnadir*60;
				$nuevaHora=date("H:i",$segundos_horaInicial-$segundos_minutoAnadir);



		 			//$buscarhoraausente=$especialista->BuscarHoraAusente();

		 			/*if (count($buscarhoraausente)==0) {
		 				*/

		 				$buscarsiestadisponible=$especialista->EvaluarHorarioDisponible();

		 				
		 				$buscarsiestaapartada=$especialista->EvaluarHorarioApartado();


		 				if (count($buscarsiestadisponible)==0 && count($buscarsiestaapartada)==0 ) {
		 				
		 					$objetodisponible=array('fecha'=>$fechaconsulta,'horainicial'=>$especialista->horainicial,'horafinal'=>$especialista->horafinal);

		 					array_push($arrayfechasdisponibles, $objetodisponible);
		 				}
		 			//}

		 		}
		 	}

	
		}

		$fechas_unicas =  array_values(array_unique(array_map(function($item) {
			  return $item['fecha'];
			}, $arrayfechasdisponibles)));


			$fechaformato=$fechas->mesesEnEspañol[date('F',strtotime($primerdiames))].' '.date('Y', strtotime($primerdiames));
	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['disponible']=$fechas_unicas;
	$respuesta['nodisponible']=$nodisponible;
	$respuesta['fechaformato']=$fechaformato;
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