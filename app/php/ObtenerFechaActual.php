<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Importamos las clases que vamos a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Fechas.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$fechas=new Fechas();
	$fechaactual=date('Y-m-d');


	$diatexto=$fechas->diasSemana[date('N', strtotime($fechaactual))];

	$fechaformato=$diatexto.' '.date('d/m/Y',strtotime($fechaactual));

	$respuesta['respuesta']=1;
	$respuesta['fechaactual']=$fechaformato;
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