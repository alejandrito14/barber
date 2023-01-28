<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Interes.php");
require_once("clases/class.Funciones.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Interes();
	$f=new Funciones();
	$db->begin();

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$idusuarios=$_POST['iduser'];
	$idintereses=explode(',', $_POST['arrayinteres']);
	


		if ($idintereses[0]!='') {
			for ($i=0; $i < count($idintereses); $i++) { 
				

				$lo->idusuarios=$idusuarios;
				$lo->idinteres=$idintereses[$i];
				$lo->GuardarInteresUsuario();
			}
		}
	
	$db->commit();


	  


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