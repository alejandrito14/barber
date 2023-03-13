<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Importamos las clases que vamos a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.HorariosSucursal.php");
//require_once("clases/class.Categorias.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Especialista.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$horariossucursal = new HorariosSucursal();
	$horariossucursal->db=$db;
	$f = new Funciones();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	$especialista=new Especialista();
	$especialista->db=$db;
	//$categorias = new Categorias();
	$fechas = new Fechas();
	//$categorias->db=$db;
	$idsucursal=$_POST['idsucursal'];
	
	$idpaquete=$_POST['idpaquete'];
	$paquetes->idpaquete=$idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();

	$intervalo=$obtenerpaquete[0]->intervaloservicio;

	$fecha=$_POST['fecha'];
	$horariossucursal->fecha=$fecha;
	$horariossucursal->idsucursal=$idsucursal;
	$dia=$fechas->dia_semana($fecha);
	$numdia=$dia['numdia'];
	$horas=$horariossucursal->ObtenerHorariosSucursal($numdia);
	//var_dump($horas);die();
	$arrayintervalos=array();
	for ($i=0; $i < count($horas); $i++) { 

		$horainicial=$horas[$i]->horainicial;
		$horafinal=$horas[$i]->horafinal;
		//print_r($horafinal);
		 $intervalos=$fechas->intervaloHora($horainicial,$horafinal,$intervalo);

		 array_push($arrayintervalos, $intervalos);
	}
	//var_dump($arrayintervalos);die();
	$horariossucursal->fecha=$fecha;

	$integrandointervalos=[];
	$especialista->idsucursal=$idsucursal;
	$especialista->idpaquete=$idpaquete;
	
		$horaactual=date('H:i:s');

	for ($k=0; $k < count($arrayintervalos[0]); $k++) { 
			
			$value=$k+1;
				if ($value<count($arrayintervalos[0])) {
					
					$horainicial=substr($arrayintervalos[0][$k],0,5);

					$horafinal=substr($arrayintervalos[0][$k+1],0,5);

					$horariossucursal->horainicial=$horainicial;
					$horariossucursal->horafinal=$horafinal;
					$verificar=$horariossucursal->VerificarHorario();
					$disponible=1;
						if (count($verificar)>0)  {
							$disponible=0;
						}


					$objeto=array('horainicial'=>$horainicial,'horafinal'=>$horafinal,'disponible'=>$disponible);


					if (date('Y-m-d',strtotime($horariossucursal->fecha))==date('Y-m-d')) {



					if(date('H:i:s',strtotime($horainicial)) >= $horaactual)
						{

						array_push($integrandointervalos, $objeto);

						}

					}else{

						array_push($integrandointervalos, $objeto);

					}

					


				}

		}



	/*var_dump($integrandointervalos);die();*/
	//enviamos la conexión a las clases que lo requieren
	/*$horariossucursal->db=$db;
	$fecha=$_POST['fecha'];
	$idpaquete=$_POST['idpaquete'];
	$idsucursal=$_POST['idsucursal'];

	$dia=$fechas->dia_semana($fecha);

	var_dump($dia);die();*/

	/*$horariossucursal->idsucursal=$idsucursal;
	$obtenerhorariossucursal=$horariossucursal->ObtenerHorariosSucursal();*/



	/*$lunes=$_POST['lunes'];
	$martes=$_POST['martes'];
	$miercoles=$_POST['miercoles'];
	$jueves=$_POST['jueves'];
	$viernes=$_POST['viernes'];
	$sabado=$_POST['sabado'];
	$domingo=$_POST['domingo'];
	$v_fechainicial=$_POST['v_fechainicial'];
	$v_fechafinal=$_POST['v_fechafinal'];
	$dias="";

	if ($lunes==1) {
		$dias.='1,';
	}
	if ($martes==1) {
		$dias.='2,';
	}
	if ($miercoles==1) {
		$dias.='3,';
	}
	if ($jueves==1) {
		$dias.='4,';
	}
	if ($viernes==1) {
		$dias.='5,';
	}
	if ($sabado==1) {
		$dias.='6,';
	}
	if ($domingo==1) {
		$dias.='0';
	}*/



	$respuesta['respuesta']=1;
	$respuesta['intervalos']=$integrandointervalos;
	/*$respuesta['fechadia']=$fechadia;
	$respuesta['arrayfechasdias']=$arrayfechasdias;
*/
	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>