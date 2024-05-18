<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Importamos las clases que vamos a utilizar
require_once("clases/conexcion.php");

//require_once("clases/class.Categorias.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Especialista.php");
require_once("clases/class.Cita.php");
require_once("clases/class.HorarioEspecialista.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$f = new Funciones();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	$especialista=new Especialista();
	$especialista->db=$db;
	$citas=new Cita();
	$citas->db=$db;
	$horarioespecialista=new HorarioEspecialista();
	$horarioespecialista->db=$db;
	//$categorias = new Categorias();
	$fechas = new Fechas();
	//$categorias->db=$db;
	$idsucursal=$_POST['idsucursal'];
	$idpaquete=$_POST['idpaquete'];
	$fecha=$_POST['fecha'];
	$horaseleccionada=explode('_', $_POST['horaseleccionada']);

	$paquetes->idpaquete=$idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$costopaquete=$obtenerpaquete[0]->precioventa;
	$especialista->idpaquete=$idpaquete;
	$especialista->idsucursal=$idsucursal;
	$obtenerespecialistas=$especialista->ObtenerEspecialistas();
	$especialistasdisponibles=array();



	if (count($obtenerespecialistas)>0) {
		for ($i=0; $i < count($obtenerespecialistas); $i++) { $obtenerespecialistas[$i]->costo=$costopaquete;
			
			/*if ($obtenerespecialistas[$i]->costo=='') {

				

				
			}*/



			if ($obtenerespecialistas[$i]->preciofijo!='') {
				$obtenerespecialistas[$i]->costo=$obtenerespecialistas[$i]->preciofijo;

			}

			$citas->idespecialista=$obtenerespecialistas[$i]->idespecialista;
			$citas->fecha=$fecha;
			$citas->horainicial=$horaseleccionada[0];
			$citas->horafinal=$horaseleccionada[1];

			$horarioespecialista->dia=$fechas->numeroDiaSemana($fecha);
			$horarioespecialista->horainicial=$horaseleccionada[0];
			$horarioespecialista->horafinal=$horaseleccionada[1];
			$horarioespecialista->idespecialista=$obtenerespecialistas[$i]->idespecialista;
			$horarioespecialista->idsucursal=$idsucursal;

			$horarioespecialista->horainicial=$horaseleccionada[0];

			$horarioespecialista->fechaactual=date('Y-m-d');
			$horarioespecialista->fecha=$fecha;

			$especialista->fecha=$fecha;
			$especialista->horainicial=$horaseleccionada[0];
			$especialista->horafinal=$horaseleccionada[1];
			$especialista->idespecialista=$obtenerespecialistas[$i]->idespecialista;
			
		 	$buscarhoraausente=$especialista->BuscarHoraAusente();
			$pasa=0;
		 	if (count($buscarhoraausente)==0) {
		 		# code...
		 	

			$obtenerfechahorario=$horarioespecialista->ObtenerfechaHorario();

			//print_r($obtenerfechahorario);die();

			$obtenerhorario=$horarioespecialista->ObtenerHorario();
			

		

			if (count($obtenerfechahorario)>0) {


				$fechahinicial=$obtenerfechahorario[0]->horainicial;
				$fechahfinal=$obtenerfechahorario[0]->horafinal;

			/*echo $horaseleccionada[0].'>='.$fechahinicial.'<br>';

			echo $horaseleccionada[1].'<='.$fechahfinal;
*/
		

				if (date('H:i', strtotime($fechahinicial))<=date('H:i', strtotime($horaseleccionada[0]))  && 
    date('H:i', strtotime($horaseleccionada[1])) <= date('H:i', strtotime($fechahfinal)) ) {
   				
				$verificarfechahorario=$horarioespecialista->VerficarfechaHorario();

					if (count($verificarfechahorario)>0) {
						$pasa=1;
						//echo 'entro a verificarfecha';
					}

				}

			}else{

			if (count($obtenerfechahorario)==0 && count($obtenerhorario)>0) {


				$verificarhorario=$horarioespecialista->VerificarHorario();

				if (count($verificarhorario)>0) {
					$pasa=1;

					//echo 'entro a verificarhorario';

				}
			}


		}


}


			

			

		if ($pasa==1) {
				# code...
			

			/*$verificar=$citas->VerificarFechaHorarioEspecialista();*/

			$verificar=$citas->VerificacionCita2();

			//$verificarapartada=$citas->VerificarCitaApartada();

			if (count($verificar)==0 ) {
				
				array_push($especialistasdisponibles, $obtenerespecialistas[$i]);
				}



			}

		}
	}


	

	$respuesta['respuesta']=1;
	$respuesta['especialista']=$especialistasdisponibles;
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