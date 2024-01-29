<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	/*header("Location: ../../login.php"); */ echo "login";

	exit;
}

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos las clases que vamos a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Dashboard.php");

require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Especialista.php");
/*require_once("../../clases/class.HorariosServicios.php");
*/
require_once("../../clases/class.Cita.php");	
require_once("../../clases/class.HorarioEspecialista.php");	
require_once("../../clases/class.Notapago.php");	
require_once("../../clases/class.HorariosSucursal.php");	
try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$dashboard = new Dashboard();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	$fechas=new Fechas();
	$especialista=new Especialista();
	$especialista->db=$db;
	$cita = new Cita();
	$cita->db=$db;
	$horarioespecialista=new HorarioEspecialista();
	$horarioespecialista->db=$db;
	$notapago=new Notapago();
	$notapago->db=$db;
	$horariosucursal=new HorariosSucursal();
	$horariosucursal->db=$db;
	$cita->idsucursal=$se->obtenerSesion('idsucursalsesion');
	$horarioespecialista->idsucursal=$se->obtenerSesion('idsucursalsesion');
	$especialista->idsucursal=$se->obtenerSesion('idsucursalsesion');
	//$horarioservicio = new HorariosSucursal();

	//$horarioservicio->db=$db;
	//enviamos la conexión a las clases que lo requieren
	$dashboard->db=$db;
	$md->db = $db;	
	$zonas->db=$db;
	$fecharecibida=$_POST['fecha'];
	$idsucursal=$se->obtenerSesion('idsucursalsesion');
	$fecha=date('Y-m-d',strtotime($fecharecibida));
	$intervaloconf=$dashboard->ObtenerIntervalo();

	$operacion=$_POST['operacion'];

	if ($operacion==1) {
		$fecha=date("Y-m-d",strtotime($fecha."- 1 days")); 
	}

	if($operacion==2){
	
		$fecha=date("Y-m-d",strtotime($fecha."+ 1 days")); 
	}
	

	$fechas->fecha=$fecha;
	$cita->fecha=$fecha;
	$dashboard->fechainicial=$fecha;
	$especialista->fecha=$fecha;
	//echo $primerdiames.''.$ultimodiames;die();
	$obtener=$cita->ObtenerCitasFechaEspeci();
	
	$obtenerfecha=$fechas->fecha_texto4($fecha);


	$horariosucursal->idsucursal=$idsucursal;
	$dia=$fechas->numeroDiaSemana($fecha);
	$obtenerhorariosucursal=$horariosucursal->ObtenerHorariosSucursal($dia);
	//var_dump($obtenerhorariosucursal);die();
	
	$horainicialsucursal='10:00';
	$horafinalsucursal='21:00';

		if (count($obtenerhorariosucursal)>0) {
			$horainicialsucursal=$obtenerhorariosucursal[0]->horainicial;
			$horafinalsucursal=$obtenerhorariosucursal[0]->horafinal;
		}
	$obtenerintervalos=$fechas->intervaloHora($horainicialsucursal,$horafinalsucursal,$intervaloconf);

	$obtenerzonas=$especialista->ObtenerEspecialistasT();
	

$estatus=array('Pendiente','En proceso','Completado','Cancelado','Caducado');
$claseestatus=array('#f7bb44','#38a2f7','#2b952a','red','gray');
$fechaactual=date('Y-m-d');
$horaactual=date('H:i');
	for ($i=0; $i <count($obtenerzonas) ; $i++) { 
		
			$obtenerzonas[$i]->intervalos=array();
			
				for ($k=0; $k <count($obtenerintervalos); $k++) { 
					
					$hora1intervalo=$obtenerintervalos[$k];
					$hora2intervalo=$obtenerintervalos[$k+1];
					
				

					$disponible=1;


			$horarioespecialista->dia=$fechas->numeroDiaSemana($fecha);
			$horarioespecialista->horainicial=substr($hora1intervalo, 0, 5);
			$horarioespecialista->horafinal=substr($hora2intervalo, 0, 5);;
			$horarioespecialista->idespecialista=$obtenerzonas[$i]->idespecialista;
			$horarioespecialista->idsucursal=$idsucursal;


			$verificarhorario=$horarioespecialista->VerificarHorario();
			$consultarsiestaocupado=[];
			$pasa=1;
			if (count($verificarhorario)>0) {
				$pasa=1;
			}




				if ($hora1intervalo!='' && $hora2intervalo!='' && $pasa==1 ) {
							# code...
						
					$especialista->idespecialista=$obtenerzonas[$i]->idespecialista;
					$especialista->horainicial=substr($hora1intervalo, 0, 5);
					$especialista->horafinal=substr($hora2intervalo, 0, 5);
					$especialista->fecha=$fecha;


					$consultarsiestaocupado=$especialista->Disponibilidad4();

					
					if (count($consultarsiestaocupado)>0) {

						$disponible=0;
						$est=$consultarsiestaocupado[0]->estatus;
						$consultarsiestaocupado[0]->textoestatus=$estatus[$est];

						$consultarsiestaocupado[0]->claseestatus=$claseestatus[$est];


						$hora_inicial = strtotime($consultarsiestaocupado[0]->horainicial);
						$hora_final = strtotime($consultarsiestaocupado[0]->horafinal);

						$diferencia_en_segundos = $hora_final - $hora_inicial;
						$diferencia_en_minutos = $diferencia_en_segundos / 60;

						$consultarsiestaocupado[0]->intervaloservicio=$diferencia_en_minutos;


						$idcita=$consultarsiestaocupado[0]->idcita;
						$notapago->idcita=$idcita;
						$verificarpago=$notapago->VerificarCita();
						$consultarsiestaocupado[0]->pagado=0;
						$consultarsiestaocupado[0]->tpv=$verificarpago[0]->tpv;

						if (count($verificarpago)>0) {

							if ($verificarpago[0]->estatus==1) {

								$consultarsiestaocupado[0]->pagado=1;
							}
							
						}

						
					}else{

			

						if ($fecharecibida== $fechaactual) {
						
						if ($horaactual>=$hora1intervalo) {
							$disponible=1;
								
								}else{
									$disponible=1;
								}

							}else{


						if ($fecharecibida<= $fechaactual) {
									# code...
								
								$disponible=1;
									}
								
							}

					}

				}else{
					
					$disponible=0;

				}

				/*if($pasa==0){

					$disponible=0;
				}*/
						$arrayintervalo = array('horainicialntervalo' =>$hora1intervalo ,'horafinalintervalo'=>$hora2intervalo,'disponible'=>$disponible,'servicio'=>$consultarsiestaocupado);

						array_push($obtenerzonas[$i]->intervalos, $arrayintervalo);


					

				}


				
			

	}


/*	$obtenerintervaloscon=$fechas->intervaloHora('00:00:00','23:59:00',$intervaloconf);

*/

	/**/


	$respuesta['respuesta']=1;
	$respuesta['fechaactual']=$obtenerfecha;
	$respuesta['horarios']=$obtener;
	$respuesta['intervalos']=$obtenerintervalos;
	$respuesta['pxintervalo']=$intervaloconf+50;
	$respuesta['zonas']=$obtenerzonas;
	$respuesta['fecha']=$fecha;
	$respuesta['intervaloconf']=$intervaloconf;
	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>