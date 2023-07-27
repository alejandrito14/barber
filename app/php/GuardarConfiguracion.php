<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.PagConfig.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$f=new Funciones();
	$pagina=new PagConfig();
	$pagina->db=$db;

	$v_tiempocancelacion=$_POST['v_tiempocancelacion'];
	$v_habilitardevolucion=$_POST['v_habilitardevolucion'];
	$v_terminoscondiciones=$_POST['v_terminoscondiciones'];
	$pagina->v_tiempocancelacion=$v_tiempocancelacion;
	$pagina->v_habilitardevolucion=$v_habilitardevolucion;
	$pagina->v_terminoscondiciones=$v_terminoscondiciones;
	
	$pagina->ActualizarDatosConfi();

	
	


	$respuesta['respuesta']=1;

	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	echo $myJSON;

}catch(Exception $e){
	$db->rollback();
	//echo "Error. ".$e;
	
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}
?>