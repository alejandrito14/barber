<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Sucursal.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$lo->db=$db;
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$idusuario=$_POST['idusuario'];
	$mes=$_POST['mes'];
	$anio=$_POST['anio'];
	$estatuscarga=$_POST['estatuscarga'];


	$sucursal->idusuario=$idusuario;
	$obtenersucursal=$sucursal->AccesoSucursal();

	$lo->idsucursal=$obtenersucursal[0]->idsucursales;
	 $primerdia= date('Y-m-d', mktime(0,0,0, $mes, 1, $anio));

     $day = date("d", mktime(0,0,0, $mes+1, 0, $anio));
 
    $ultimodia=date('Y-m-d', mktime(0,0,0, $mes, $day, $anio));

 	 $fechainicio=strtotime($primerdia);
    $fechafin=strtotime($ultimodia);
    $fechascitas=array();
	$arrayfechasdisponibles=[];


    for($i=$fechainicio; $i<=$fechafin; $i+=86400){

    	$fechaconsulta=date("Y-m-d", $i);
    	
		$dia_semana = date("w", strtotime($fechaconsulta)); 

		$lo->fecha=$fechaconsulta;
		$existenfechas=$lo->ObtenerCitasFecha();
		
			if (count($existenfechas)>0) {
				

				array_push($fechascitas, $fechaconsulta);
			}
			 
	
		}
	
		$fechaactual=date('Y-m-d');

		$lo->fecha=$fechaactual;
		$lo->estatus=$estatuscarga;

		$obtenercitas=$lo->ObtenerCitasFechaEstatus();
	$estatus=array('Pendiente','En proceso','Completo','Cancelada','Caducada');

			if (count($obtenercitas)>0) {
		for ($i=0; $i < count($obtenercitas); $i++) { 

				$fechacita=$obtenercitas[$i]->fechacita;
			$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fechacita))];

			$fechaformato=$diatexto.' '.date('d',strtotime($fechacita)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fechacita))].' de '.date('Y', strtotime($fechacita));


			$obtenercitas[$i]->fechaformato=$fechaformato;
			
			$fechachekin=date('H:i:s',strtotime($obtenercitas[$i]->fechacheckin));
			$fechachekout=date('H:i:s',strtotime($obtenercitas[$i]->finalizacita));

			$obtenercitas[$i]->fechacheckin=$fechachekin;
			$obtenercitas[$i]->fechacheckout=$fechachekout;
			$fechaactual=date('Y-m-d');
			$fechacita=date('Y-m-d',strtotime($obtenercitas[$i]->fechacita));
			$horacita=date('H:i',strtotime($obtenercitas[$i]->horacita));
			$horaactual=date('H:i');

			if ($obtenercitas[$i]->estatus==0 && $fechacita>=$fechaactual) {
				$est=0;

				$obtenercitas[$i]->estatuscita=0;
			}


			if ($obtenercitas[$i]->estatus==1 && $obtenercitas[$i]->checkin==1 && $obtenercitas[$i]->checkout==0 ) {
				$est=1;
				$obtenercitas[$i]->estatuscita=1;
			}


			if ($obtenercitas[$i]->estatus==2 && $obtenercitas[$i]->checkin==1  && $obtenercitas[$i]->checkout==1 ) {
				$est=2;
				$obtenercitas[$i]->estatuscita=2;
			}

			if ($obtenercitas[$i]->estatus==3 && $obtenercitas[$i]->checkin==0 && $obtenercitas[$i]->checkout==0 ) {
				$est=3;
				$obtenercitas[$i]->estatuscita=3;
			}


			if ($obtenercitas[$i]->estatus==4) {

				$est=4;
				$obtenercitas[$i]->estatuscita=4;
			}


			$obtenercitas[$i]->textoestatus=$estatus[$est];

	}
}


	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fechaactual))];

	$fechaformato=$diatexto.' '.date('d',strtotime($fechaactual)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fechaactual))].' de '.date('Y', strtotime($fechaactual));


	$lo->idsucursal=$obtenersucursal[0]->idsucursales;
	$lo->fecha=$fechaactual;
	$obtenercitas2=$lo->ObtenerCitasNocheckin();
	//totalcitasrealizadas
	$lo->fecha=$fechaactual;
	$obtenercitasrealizadas=$lo->ObtenerCitascheckin();

	$lo->horaactual=date('H:i');

	$obtenerpendientes=$lo->ObtenerCitasPendientes();
	$obtenernorealizados=$lo->ObtenerCitasNoRealizados();
		
	$obtenercancelados=$lo->ObtenerCitasCanceladas();
	$obtenerenproceso=$lo->ObtenerCitasProceso();

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['citados']=$fechascitas;
	$respuesta['citasdia']=$obtenercitas;
	$respuesta['fechaactual']=$fechaformato;

	$respuesta['totalcitasdia']=count($obtenercitas2);
	$respuesta['totalcitasrealizadas']=count($obtenercitasrealizadas);
	$respuesta['totalpendientes']=count($obtenerpendientes);
	$respuesta['totalnorealizados']=count($obtenernorealizados);
	$respuesta['totalcancelados']=count($obtenercancelados);
	$respuesta['totalproceso']=count($obtenerenproceso);

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