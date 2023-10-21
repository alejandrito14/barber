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
		$obtenercitas=$lo->ObtenerCitasFecha();

			if (count($obtenercitas)>0) {
		for ($i=0; $i < count($obtenercitas); $i++) { 
			
$fechachekin=date('H:i:s',strtotime($obtenercitas[$i]->fechacheckin));
			$fechachekout=date('H:i:s',strtotime($obtenercitas[$i]->finalizacita));;

			$obtenercitas[$i]->fechacheckin=$fechachekin;
			$obtenercitas[$i]->fechacheckout=$fechachekout;

	}
}


	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fechaactual))];

	$fechaformato=$diatexto.' '.date('d',strtotime($fechaactual)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fechaactual))].' de '.date('Y', strtotime($fechaactual));

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['citados']=$fechascitas;
	$respuesta['citasdia']=$obtenercitas;
	$respuesta['fechaactual']=$fechaformato;

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