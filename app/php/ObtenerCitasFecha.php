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
	$fecha=$_POST['fecha'];

	$sucursal->idusuario=$idusuario;
	$obtenersucursal=$sucursal->AccesoSucursal();

	$lo->idsucursal=$obtenersucursal[0]->idsucursales;
	$fechafiltro=date('Y-m-d',strtotime($fecha));

	$lo->fecha=$fechafiltro;
	$obtenercitas=$lo->ObtenerCitasFecha();

		if (count($obtenercitas)>0) {
		for ($i=0; $i < count($obtenercitas); $i++) { 
			
$fechachekin=date('H:i:s',strtotime($obtenercitas[$i]->fechacheckin));
			$fechachekout=date('H:i:s',strtotime($obtenercitas[$i]->finalizacita));;

			$obtenercitas[$i]->fechacheckin=$fechachekin;
			$obtenercitas[$i]->fechacheckout=$fechachekout;

	}
}

	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fechafiltro))];

	$fechaformato=$diatexto.' '.date('d',strtotime($fechafiltro)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fechafiltro))].' de '.date('Y', strtotime($fechafiltro));

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['citasdia']=$obtenercitas;
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